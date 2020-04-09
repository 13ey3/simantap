<?php
  $form_attr = array('class' => 'user', 'id' => 'login_form');
?>
<!-- Login page -->
<div class="row justify-content-center">

  <div class="col-xl-6 col-lg-5 col-md-6 col-sm-10">
    <div class="card-taransparant my-6">
      <div class="card-body">
          <div class="row">
            <div class="col-1">
              <img src="<?= site_url()?>/publik/img/logo.png" alt="Ambon Manise" class="logo-pemda">
            </div>
            <div class="col">
              <h3 class="text-gray-200">Simantap Online</h1>
              <span class="text-gray-400">Aplikasi Permohonan Izin Kota Ambon</span>
            </div>
          </div>
        <hr>
          <ul class="text-gray-400">
            <li>Download Buku Panduan <a href="" class="text-gray-500">DISINI !</a></li>
            <li>Masukkan Username dan Password jika mempunyai akun</li>
            <li>Perizinan Kota Ambon sudah menggukanakan digital signature BSRE</li>
          </ul>
        <hr>
        <div class="text-center">
          <img src="<?= site_url()?>/publik/img/logo-bsre.png" alt="Ambon Manise" class="logo-bsre">
        </div>
      </div>
    </div>
  </div>

  <div class="col-xl-6 col-lg-5 col-md-6 col-sm-10">
    <div class="card border-0 shadow-lg my-6">
      <div class="card-body">
        <div class="text-center">
          <h1 class="h4 text-gray-900 mb-4">Login</h1>
        </div>
        <form class="user">
          <input type="hidden" name="<?php echo $this->security->get_csrf_token_name(); ?>" value="<?php echo $this->security->get_csrf_hash(); ?>">
          <div class="form-group">
            <input type="text" class="form-control form-control-user" id="useranme" name="username" aria-describedby="emailHelp" placeholder="Masukan username / NIP">
          </div>
          <div class="form-group">
            <input type="password" class="form-control form-control-user" id="password" name="password" placeholder="Password">
          </div>
          <a href="<?= site_url('main') ?>" class="btn btn-primary btn-user btn-block">
            Login
          </a>
        </form>

        <div class="text-center">
          <a class="small" href="#">Lupa Password?</a>
        </div>
        <div class="text-center">
          <a class="small" href="<?= site_url('register') ?>">Daftar pengguna baru!</a>
        </div>
      </div>
    </div>
  </div>

</div>
<!-- ./Login page -->