<?= $this->extend('templates/auth/index') ?>

<?= $this->section('content') ?>

  <form action="" method="post">
    <div class="input-group mb-3">
      <input type="email" name="email" class="form-control" placeholder="Email">
      <div class="input-group-append">
        <div class="input-group-text">
          <span class="fas fa-envelope"></span>
        </div>
      </div>
    </div>
    <div class="input-group mb-3">
      <input type="password" name="password" class="form-control" placeholder="Password">
      <div class="input-group-append">
        <div class="input-group-text">
          <span class="fas fa-lock"></span>
        </div>
      </div>
    </div>
    <div class="row">
      <div class="col">
        <button type="submit" name="submit" class="btn btn-primary btn-block">Masuk</button>
      </div>
    </div>
  </form>

  <hr class="bg-secondary">
  
  <div class="social-auth-links text-center mt-2 mb-3">
    <a href="#" class="btn btn-block btn-primary">
      <img src="<?= base_url('assets/img/sipadu.png'); ?>" style="width: 20px;" alt="sipadu"></i> Masuk dengan sipadu
    </a>
  </div>
  
  <!-- <p class="mb-1">
    <a href="forgot-password.html">I forgot my password</a>
  </p> -->
  <p class="mb-0">
    Belum mempunyai akun? 
    <a href="register.html" class="text-center">Daftar</a>
  </p>

<?= $this->endSection(); ?>