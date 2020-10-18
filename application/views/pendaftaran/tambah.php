<div class="container-fluid">
  <!-- Welcome message -->

  <!-- DataTales Example -->
  <div class="card shadow-sm mb-4">
    <div class="card-header py-2">
      <div class="row">
        <div class="col-sm-6">
          <h6 class="m-0 font-weight-bold text-primary"><?= $page_title ?></h6>
        </div>
      </div>
    </div>

    <div class="card-body">
      <form action="simpan" method="POST" name="tambah-permohonan" onsubmit="return validasiForm()">
        <div class="h6">Data Pemohon</div>
        <hr style="margin-top: .1rem; margin-bottom: .8rem;">

        <div class="form-group row px-2">
          <input type="hidden" name="<?php echo $this->security->get_csrf_token_name(); ?>" value="<?php echo $this->security->get_csrf_hash(); ?>">
          <label class="col-sm-5  col-lg-3 col-form-label-sm">No. Induk Perizinan</label>
          <div class="col-sm-7 col-lg-3">
            <input type="text" class="form-control form-control-sm" name="nip" id="nip" onblur="getDataPemohon()">
            <span class="error-message" id="error_nip"></span>
          </div>

          <label class="col-sm-5  col-lg-3 col-form-label-sm">NIK</label>
          <div class="col-sm-7 col-lg-3">
            <input type="text" class="form-control form-control-sm" name="nik" id="nik">
          </div>
        </div>

        <div class="form-group row px-2">
          <label class="col-sm-5  col-lg-3 col-form-label-sm">Nama Pemohon</label>
          <div class="col-sm-7 col-lg-3">
            <input type="text" class="form-control form-control-sm" name="nama_pemohon" id="nama_pemohon">
          </div>

          <label class="col-sm-5  col-lg-3 col-form-label-sm">Jenis Usaha</label>
          <div class="col-sm-7 col-lg-3">
            <input type="text" class="form-control form-control-sm" name="jenis_usaha" id="jenis_usaha">
          </div>
        </div>

        <div class="form-group row px-2">
          <label class="col-sm-5  col-lg-3 col-form-label-sm">Kecamatan</label>
          <div class="col-sm-7 col-lg-3">
            <input type="text" class="form-control form-control-sm" name="kecamatan" id="kecamatan">
          </div>

          <label class="col-sm-5  col-lg-3 col-form-label-sm">Kelurahan</label>
          <div class="col-sm-7 col-lg-3">
            <input type="text" class="form-control form-control-sm" name="kelurahan" id="kelurahan">
          </div>
        </div>

        <div class="form-group row px-2">
          <label class="col-sm-5  col-lg-3 col-form-label-sm">Kab./Kota</label>
          <div class="col-sm-7 col-lg-3">
            <input type="text" class="form-control form-control-sm" name="kab_kot_pemohon" id="kab_kot_pemohon">
          </div>

          <label class="col-sm-5  col-lg-3 col-form-label-sm">Alamat</label>
          <div class="col-sm-7 col-lg-3">
            <textarea class="form-control" name="alamat_pemohon" id="alamat_pemohon" rows="3"></textarea>
          </div>
        </div>

        <div class="h6">Data Permohonan</div>
        <hr style="margin-top: .1rem; margin-bottom: .8rem;">

        <div class="form-group row px-2">
          <label class="col-sm-5  col-lg-3 col-form-label-sm">Jenis Ijin</label>
          <div class="col-sm-7 col-lg-3">
            <select name="id_jenis_ijin" id="id_jenis_ijin" class="form-control form-control-sm" onchange="getKelengkapanDokumen(this)">
            </select>
            <span class="error-message" id="error_id_jenis_ijin"></span>
          </div>
        </div>

        <div class="form-group row px-2">
          <label class="col-sm-5  col-lg-3 col-form-label-sm">No. Surat Permohonan</label>
          <div class="col-sm-7 col-lg-3">
            <input type="text" class="form-control form-control-sm" name="no_surat_permohonan" id="no_surat_permohonan">
            <span class="error-message" id="error_no_surat_permohonan"></span>
          </div>

          <label class="col-sm-5  col-lg-3 col-form-label-sm">Tanggal Permohonan</label>
          <div class="col-sm-7 col-lg-3">
            <input type="date" class="form-control form-control-sm" name="tgl_permohonan" id="tgl_permohonan">
            <span class="error-message" id="error_tgl_permohonan"></span>
          </div>
        </div>

        <div class="form-group row px-2">
          <label class="col-sm-5  col-lg-3 col-form-label-sm">Kecamaatan</label>
          <div class="col-sm-7 col-lg-3">
            <select name="kec_usaha" id="kec_usaha" class="form-control form-control-sm" onchange="getKelurahanAjax(this)">
            </select>
            <span class="error-message" id="error_kec_usaha"></span>
          </div>

          <label class="col-sm-5  col-lg-3 col-form-label-sm">Kelurahan</label>
          <div class="col-sm-7 col-lg-3">
            <select name="kel_usaha" id="kel_usaha" class="form-control form-control-sm" onchange="">
              <option value="">Pilih</option>
            </select>
            <span class="error-message" id="error_kel_usaha"></span>
          </div>
        </div>

        <div class="form-group row px-2">
          <label class="col-sm-5  col-lg-3 col-form-label-sm">Alamat Usaha</label>
          <div class="col-sm-7 col-lg-3">
            <textarea class="form-control" name="alamat_usaha" id="alamat_usaha" rows="3"></textarea>
            <span class="error-message" id="error_alamat_usaha"></span>
          </div>
        </div>

        <div class="form-group row px-2">
          <label class="col-sm-5  col-lg-3 col-form-label-sm">Kelengkapan Dokumen</label>
          <div class="col-sm-8">
            <div id="kelengkapan_dokumen"></div>
          </div>
        </div>



    </div>
    <div class="card-footer">
      <a href="<?= base_url() ?>" class="btn btn-secondary btn-sm">
        <i class="fas fa-arrow-circle-left"></i> Kembali
      </a>
      <button class="btn btn-primary btn-sm float-right" type="submit">
        <i class="fas fa-save"></i> Simpan
      </button>
    </div>
    </form>
  </div>
</div>