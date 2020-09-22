<div class="row justify-content-center">

  <div class="col-md-8 col-sm-10 col-lg-6">
    <div class="col-md-12">
      <div class="mt-5">
        <div class="row justify-content-center">
          <img src="<?= site_url() ?>/publik/img/logo.png" alt="Ambon Manise" class="img-fluid mx-auto" style="max-height: 150px;" >
        </div>
      </div>
      <div class="card border-1 shadow mt-1">
        <div class="card-body px-5">
          <div class="text-center">
            <h1 class="h4 text-gray-900 mb-4">Login ke SIMANTAP</h1>
          </div>
          <form class="user" action="auth" method="POST">
            <input type="hidden" name="<?php echo $this->security->get_csrf_token_name(); ?>" value="<?php echo $this->security->get_csrf_hash(); ?>">
            <div class="form-group">
              <label class="form-label">Masuk username/NIP</label>
              <input type="text" class="form-control form-control-user" id="username" name="username" aria-describedby="emailHelp">
            </div>
            <div class="form-group">
              <label class="form-label">Password</label>
              <input type="password" class="form-control form-control-user" id="password" name="password" required>
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
        </div>
      </div>

    </div>
  </div>

</div>
<!-- ./Login page -->