<?php
defined('BASEPATH') || exit('No direct script access allowed');

class Workflow_m extends CI_Model
{
    public function get_workflow($id_ijin, $id_group)
    {
        return $this->db->select('workflow_id, id_group, id_group_induk')
            ->from('simantap_workflow')
            ->where('id_jenis_ijin', $id_ijin)
            ->where('id_group', $id_group)
            ->get();
    }

    public function insert_simatap_task($idreg, $id_ijin, $data_task, $session)
    {
        $data = array(
            'id_register' => $idreg,
            'workflow_id' => $data_task['idworkflow'],
            'id_user'     => $session['userid'],
            'tgl_update'  => date('Y-m-d H:i:s'),
            'task_status' => TRUE,           // TRUE IF HAVE DONE, FALSE IF NOT DONE
            'task_state'  => 'Proses',         // SET BY "PROSES", "BATAL", "SELESAI"
            'task_start'  => $data_task['idgroup'],               // SET BY GROUP USER 
            'task_process' => $data_task['idgroupinduk'],               // SET BY GROUP PARENT USER
            'task_finish' => '9999',           // SET BY 9999         
        );
        $this->db->insert('simantap_task', $data);

        $induk = explode(',', $data_task['idgroupinduk']);
        foreach ($induk as $value) {
            $sql = "SELECT * FROM simantap_workflow WHERE id_jenis_ijin = '$id_ijin' AND id_group = '$value'";
            $query = $this->db->query($sql, false);
            $row = $query->row();

            $workflowparentid  = $row->id_group_induk;
            $workflowid = $row->workflow_id;

            $data_task_next = [
                'id_register'  => $idreg,
                'workflow_id'  => $workflowid,
                'id_user'     => $session['userid'],
                'task_status'  => FALSE,
                'task_state'   => 'Proses',
                'task_start'   => $value,
                'task_process' => $workflowparentid,
                'task_finish'  => '9999'
            ];

            $this->db->insert('simantap_task', $data_task_next);
        }
    }

    function update_task($state_approval, $taskid, $verifikasi_note = "")
    {
        $this->db->select('id_register, b.id_jenis_ijin, task_process ', false);
        $this->db->from('simantap_task a');
        $this->db->join('simantap_workflow b', 'a.workflow_id = b.workflow_id', 'left');
        $this->db->where('task_id', $taskid);
        $query = $this->db->get();
        $row = $query->row();
        $proses      = $row->task_process;
        $idjenisijin = $row->id_jenis_ijin;
        $idregister  = $row->id_register;

        if ($proses == '9999') {  // mean state = finish
            $taskstate = 'Selesai';
        } else {
            $taskstate = 'Proses';
        };

        $today = date('Y-m-d H:i:s');
        $data = array(
            'task_status'   => 'TRUE',
            'tgl_update'    => $today,
            'id_user'       => $this->session->userdata('gid_user'),
            'task_state'    => $taskstate,
            'catatan'       => $verifikasi_note
        );

        $this->db->where('task_id', $taskid);
        $this->db->update('simantap_task', $data); // OK

        if (!$state_approval) {
            $taskstate = 'Batal';
            $data = array(
                'task_status'   => 'TRUE',
                'tgl_update'    => $today,
                'id_user'       => $this->session->userdata('gid_user'),
                'task_state'    => $taskstate,
                'task_process'  => '9999',
                'catatan'       => $verifikasi_note
            );

            $this->db->where('task_id', $taskid);
            $this->db->update('simantap_task', $data);
        }


        $data = array(
            'status_proses'      => $taskstate,
            'tgl_update_proses'  => $today,
        );

        $this->db->where('id_register', $idregister);
        $this->db->update('perijinan', $data);

        if ($taskstate == 'Proses') {
            $parents = explode(",", $proses);
            if ($taskstate == 'Batal') {
                $parents = array(9999);
            }
            foreach ($parents as $value) :
                $this->db->select('workflow_id, id_group_induk');
                $this->db->from('simantap_workflow');
                $this->db->where('id_jenis_ijin', $idjenisijin);
                $this->db->where('id_group', $value);
                $query = $this->db->get();
                $row = $query->row();
                $workflowid    = $row->workflow_id;
                $idgroupinduk = $row->id_group_induk;

                $sql_array_task_next = array(
                    'id_register'  => $idregister,
                    'workflow_id'  => $workflowid,
                    'id_user'      => $this->session->userdata('gid_user'),
                    'task_status'  => 'FALSE',
                    'task_state'   => 'Proses',
                    'task_start'   => $value,
                    'task_process' => $idgroupinduk,
                    'task_finish'  => '9999',
                );
                $this->db->insert('simantap_task', $sql_array_task_next);
            endforeach;
        }
    }
}
