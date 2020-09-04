<div class="container-fluid">
    <!-- Welcome message -->
    <div class="card shadow mb-4">
        <div class="card-header py-2">
            <div class="row">
                <div class="col-sm-6">
                    <h6 class="m-0 font-weight-bold text-primary"><?= $page_title ?></h6>
                </div>
            </div>
        </div>
        <div class="card-body">

            <?php if ($this->session->flashdata('success')) { ?>

                <div class="alert alert-success" id="succes-alert">
                    <?= $this->session->flashdata('success'); ?>
                    
                </div>
            <?php } ?>

            <form action="save" method="post" class="">
                <input type="hidden" name="<?php echo $this->security->get_csrf_token_name(); ?>" value="<?php echo $this->security->get_csrf_hash(); ?>">
                <div class="form-group row">
                    <div class="col-md-6">
                        <lable class="col-form-label">Username/NIP</lable>
                        <input type="text" name="nip" id="nip" class="form-control form-control-sm" value="<?= $data_user['c_nip'] ?>" readonly>
                        <input type="hidden" name="id_pemohon" id="id_pemohon" class="form-control form-control-sm" value="<?= $data_user['c_id_pemohon'] ?>" readonly>
                    </div>

                    <div class="col-md-6">
                        <lable class="col-form-label">NIK</lable>
                        <input type="text" name="nik" id="nik" class="form-control form-control-sm" value="<?= $data_user['c_no_identitas'] ?>" readonly>
                    </div>
                </div>

                <div class="form-group row">
                    <div class="col-md-6">
                        <lable class="col-form-label">NPWP</lable>
                        <input type="text" name="npwp" id="npwp" class="form-control form-control-sm" value="<?= $data_user['c_npwp'] ?>">
                    </div>

                    <div class="col-md-6">
                        <lable class="col-form-label">NPWPD</lable>
                        <input type="text" name="npwpd" id="npwpd" class="form-control form-control-sm" value="<?= $data_user['c_npwpd'] ?>">
                    </div>
                </div>

                <div class="form-group row">
                    <div class="col-md-6">
                        <lable class="col-form-label">Jenis Usaha</lable>
                        <select name="jenis_usaha" id="jenis_usaha" class="form-control form-control-sm">
                            <option value="">Pilih</option>
                        </select>
                    </div>

                    <div class="col-md-6">
                        <lable class="col-form-label">Nama Pemohon</lable>
                        <input type="text" name="nama_pemohon" id="nama_pemohon" class="form-control form-control-sm" value="<?= $data_user['c_nama_pemohon'] ?>">
                    </div>
                </div>


                <div class="form-group row">
                    <div class="col-md-6">
                        <lable class="col-form-label">Nama Usaha</lable>
                        <input type="text" name="nama_badan_usaha" id="nama_badan_usaha" class="form-control form-control-sm" value="<?= $data_user['c_nama_badan_usaha'] ?>">
                    </div>

                    <div class="col-md-6">
                        <lable class="col-form-label">Penanggung Jawab</lable>
                        <input type="text" name="nama_penanggung_jawab" id="nama_penanggung_jawab" class="form-control form-control-sm" value="<?= $data_user['c_nama_penanggung_jawab'] ?>">
                    </div>
                </div>

                <div class="form-group row">
                    <div class="col-md-6">
                        <lable class="col-form-label">Jabatan Penanggung Jawab</lable>
                        <input type="text" name="jbt_penanggung_jawab" id="jbt_penanggung_jawab" class="form-control form-control-sm" value="<?= $data_user['c_jbt_penanggung_jawab'] ?>">
                    </div>

                    <div class="col-md-6">
                        <lable class="col-form-label">Alamat</lable>
                        <input type="text" name="alamat_pamohon" id="alamat_pemohon" class="form-control form-control-sm" value="<?= $data_user['c_alamat_pemohon'] ?>">
                    </div>
                </div>

                <div class="form-group row">
                    <div class="col-md-6">
                        <lable class="col-form-label">Kecamatan</lable>
                        <select name="id_kecamatan_pemohon" id="id_kecamatan_pemohon" onchange="getKelurahan(this)" class="form-control form-control-sm"></select>
                    </div>

                    <div class="col-md-6">
                        <lable class="col-form-label">Kelurahan</lable>
                        <select name="id_kelurahan_pemohon" id="id_kelurahan_pemohon" class="form-control form-control-sm">
                            <option value="">Pilih</option>
                        </select>
                    </div>
                </div>

                <div class="form-group row">
                    <div class="col-md-6">
                        <lable class="col-form-label">Kota</lable>
                        <input type="text" name="kota_pemohon" id="kota_pemohon" class="form-control form-control-sm" value="<?= $data_user['c_kota'] ?>">
                    </div>

                    <div class="col-md-6">
                        <lable class="col-form-label">No Telpon</lable>
                        <input type="text" name="telpon" id="telpon" class="form-control form-control-sm" value="<?= $data_user['c_telpon'] ?>">
                    </div>
                </div>

                <div class="form-group row">
                    <div class="col-md-6">
                        <lable class="col-form-label">E-mail</lable>
                        <input type="email" name="email" id="email" class="form-control form-control-sm" value="<?= $data_user['c_email'] ?>">
                    </div>

                    <div class="col-md-6">
                        <lable class="col-form-label">Photo</lable>
                        <div class="row pl-2">
                            <div class="col-md-6">
                                <input type="file" class="custom-file-input form-control-sm" id="customFile">
                                <label class="custom-file-label col-form-label-sm" for="customFile">Choose file</label>
                            </div>
                            <div class="col-md-6">
                                <button class="btn btn-secondary btn-sm" name="btn-upload" id="btn-upload"><span class="fas fa-upload"></span> Upload</button>
                            </div>
                        </div>
                        <div class="poto-profile"></div>
                    </div>
                </div>


        </div>
        <div class="card-footer">
            <div class="col-md-12">
                <button class="btn btn-secondary btn-sm float-right"><span class="fas fa-save"></span> Simpan</button>
            </div>
            </form>
        </div>
    </div>

</div>