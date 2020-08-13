<!-- Login page -->
<div class="row justify-content-center">
  <div class="col-xl-10 col-lg-10 col-md-10">
    <div class="card border-0 shadow-lg my-6">
      <div class="card-header">
        <div class="text-center">
          <h1 class="h4 text-gray-900 mb-4">Registerasi Pengguna Baru</h1>
        </div>
      </div>
      <div class="card-body">
        <form class="user" action="register" method="POST">
          <input type="hidden" name="<?php echo $this->security->get_csrf_token_name(); ?>" value="<?php echo $this->security->get_csrf_hash(); ?>">
          <div class="row">
            <div class="form-group col-sm-6">
              <input type="text" class="form-control form-control-user" id="nik" name="nik" value="<?= set_value('nik') ?>" placeholder="NIK sesuai e-ktp">
              <?= form_error('nik') ?>
            </div>

            <div class="form-group col-sm-6">
              <input type="email" class="form-control form-control-user" id="email" name="email" value="<?= set_value('email') ?>" placeholder="contoh@mail.com">
              <?= form_error('email') ?>
            </div>
          </div>
          <div class="row">
            <div class="form-group col-sm-6">
              <input type="password" class="form-control form-control-user" id="password" name="password" placeholder="Password">
              <?= form_error('password') ?>
            </div>

            <div class="form-group col-sm-6">
              <input type="password" class="form-control form-control-user" id="passConf" name="passConf" placeholder="Confirm Password">
              <?= form_error('passConf') ?>
            </div>
          </div>
          <div class="row">
            <div class="col-md-12">
              <div class="row justify-content-center">
                <p id="captImg" class="pr-2"><?= $captcha_img ?></p>
                <a href="javascript:void(0);" class="refreshCaptcha pr-2">
                  <img src="<?= base_url() ?>/publik/img/refresh.png" alt="">
                </a>
                <input type="text" name="kode_captcha" id="kode_captcha" class="col-sm-3 form-control form-control-sm">
              </div>
              <div class="row justify-content-center">
                <?= form_error('kode_captcha'); ?>
              </div>
            </div>
          </div>
          <button type="submit" class="btn btn-primary btn-user btn-block">
            Daftar
          </button>
        </form>

        <div class="text-center">
          <a class="small" href="<?= site_url('login') ?>">Sudah punya akun!</a>
        </div>
      </div>
    </div>
  </div>

</div>
<!-- ./Login page -->