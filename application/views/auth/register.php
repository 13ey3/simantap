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
        <form class="user">
        <input type="hidden" name="<?php echo $this->security->get_csrf_token_name(); ?>" value="<?php echo $this->security->get_csrf_hash(); ?>">
          <div class="row">
            <div class="form-group col-sm-6">
              <input type="text" class="form-control form-control-user" id="nik" name="nik" placeholder="NIK sesuai e-ktp">
            </div>
            
            <div class="form-group col-sm-6">
              <input type="email" class="form-control form-control-user" id="email" name="email" placeholder="contoh@mail.com">
            </div>
          </div>
          <div class="row">
            <div class="form-group col-sm-6">
              <input type="password" class="form-control form-control-user" id="password" name="password" placeholder="Password">
            </div>

            <div class="form-group col-sm-6">
              <input type="password" class="form-control form-control-user" id="conf-pass" name="conf-pass" placeholder="Confirm Password">
            </div>
          </div>
          <div class="row">
            <div class="col-md-12 text-center">
              <p id="captImg"><?= $captcha_img ?></p>
              <a href="javascript:void(0);" class="refreshCaptcha">
                <img src="<?= base_url()?>/publik/captcha/refresh.png" alt="">
              </a>
            </div>
          </div>
          <a href="<?= site_url('register/register_confirm')?>" class="btn btn-primary btn-user btn-block">
            Daftar
          </a>
        </form>

        <div class="text-center">
          <a class="small" href="<?= site_url('login') ?>">Sudah punya akun!</a>
        </div>
      </div>
    </div>
  </div>

</div>
<!-- ./Login page -->