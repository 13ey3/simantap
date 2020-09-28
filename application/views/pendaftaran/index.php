<div class="container-fluid">
  <!-- Welcome message -->
  <?php
  $user = $this->session->userdata('usertype');

  if ($user != 13) {
  ?>
    <ul class="nav nav-pills mb-3" role="tablist" id="nav-pendaftaran">
      <li class="nav-item" role="presentation"><a href="#data-pemohon" data-toggle="pill" class="nav-link active" id="tab-pemohon" role="tab" aria-controls="pills-home" aria-selected="true">Pemohon</a></li>
      <li class="nav-item" role="presentation"><a href="#data-permohonan" data-toggle="pill" class="nav-link" id="tab-permohonan" role="tab" role="tab" aria-controls="pills-home" aria-selected="false">Permohonan</a></li>
      <li class="nav-item" role="presentation"><a href="#data-lama" data-toggle="pill" class="nav-link" id="tab-data-lama" role="tab" role="tab" aria-controls="pills-home" aria-selected="false">Permohonan Lama</a></li>
    </ul>

    <div class="tab-content" id="tabContent">
      <div class="tab-pane fade active show" id="data-pemohon" role="tabpanel">

        <?php $this->load->view('pendaftaran/pemohon'); ?>
      </div>

      <div class="tab-pane fade" id="data-permohonan" role="tabpanel">

        <?php $this->load->view('pendaftaran/permohonan'); ?>
      </div>

      <div class="tab-pane fade" id="data-lama" role="tabpanel">

        <?php $this->load->view('pendaftaran/data_permohonan_lama'); ?>
      </div>
    </div>
  <?php
  } else {
    $this->load->view('pendaftaran/permohonan');
  }
  ?>


</div>

<div class="modal fade" id="jeniIjinModal" tabindex="-1" role="dialog" aria-labelledby="jenisIjinModal" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="jenisIjinModal">Pilih Jenis Ijin</h5>
        <button class="close" type="button" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">×</span>
        </button>
      </div>
      <form action="pendaftaran/tambah" method="POST">
        <div class="modal-body">
          <div class="form-group">
            <label for="">Pilih Jenis Ijin</label>
            <select id="comboJenisIjinModal" class="form-control form-control-sm">
            </select>
          </div>

        </div>
        <div class="modal-footer">
          <button class="btn btn-secondary btn-sm" type="button" data-dismiss="modal">Cancel</button>
          <button type="submit" class="btn btn-primary btn-sm">Lanjut</button>
        </div>
      </form>
    </div>
  </div>
</div>