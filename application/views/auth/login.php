<?php
$form_attr = array('class' => 'user', 'id' => 'login_form');
?>
<!-- Login page -->
<div class="row justify-content-center my-5 my-md-2 my-lg-5">

  <div class="col-md-8 col-sm-10 col-lg-6 order-sm-1 order-md-1 order-lg-0">
    <div class="card-taransparant bg-card-login my-5 my-md-3 my-sm-1 my-lg-5 shadow-sm">
      <div class="card-body">
        <div class="row">
          <div class="col-1">
            <img src="<?= site_url() ?>/publik/img/logo.png" alt="Ambon Manise" class="logo-pemda">
          </div>
          <div class="col">
            <h3 class="text-gray-800">Simantap Online</h1>
              <span class="text-gray-800">Aplikasi Permohonan Izin Kota Ambon</span>
          </div>
        </div>
        <hr>
        <ul class="text-gray-800">
          <li>Download Buku Panduan <a href="" class="text-gray-500">DISINI !</a></li>
          <li>Masukkan Username dan Password jika mempunyai akun</li>
          <li>Perizinan Kota Ambon sudah menggukanakan digital signature BSRE</li>
        </ul>
        <hr>
        <div class="text-center pb-4">
          <img src="<?= site_url() ?>/publik/img/logo-bsre.png" alt="Ambon Manise" class="logo-bsre">
        </div>
      </div>
    </div>
  </div>

  <div class="col-md-8 col-sm-10 col-lg-6  order-sm-0 order-md-0 order-lg-1">
    <div class="card border-0 shadow my-5 my-md-3 my-sm-1 my-lg-5">
      <div class="card-body px-5">
        <div class="text-center">
          <h1 class="h4 text-gray-900 mb-4">Login ke SIMANTAP</h1>
        </div>
        <form class="user" action="login/auth" method="POST">
          <input type="hidden" name="<?php echo $this->security->get_csrf_token_name(); ?>" value="<?php echo $this->security->get_csrf_hash(); ?>">
          <div class="form-group">
            <input type="text" class="form-control form-control-user" id="username" name="username" aria-describedby="emailHelp" placeholder="Masukan username">
          </div>
          <div class="form-group">
            <input type="password" class="form-control form-control-user" id="password" name="password" placeholder="Password" required>
          </div>
          <div class="form-group pl-3">
            <div class="custom-control custom-checkbox small">
              <!-- <input type="checkbox" class="custom-control-input" name="showPassword" id="showPassword"> -->
              <!-- <label for="showPassword" class="custom-control-label">Tampil Password</label> -->
            </div>
          </div>
          <button class="btn btn-primary btn-user btn-block" type="submit">Login</button>
          <!-- <a href="" class="btn btn-primary btn-user btn-block">
            Login
          </a> -->
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