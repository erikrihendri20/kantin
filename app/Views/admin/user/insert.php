<?= $this->extend('templates/user/index') ?>

<?= $this->section('content') ?>
<?php $val = service('validation'); ?>

<div class="row">
    <div class="col">
        <div class="card card-info">
          <div class="card-header">
            <h3 class="card-title">Formulir Tambah Pengguna</h3>
          </div>
          <div class="card-body">
            <form action="" method="POST">
  
                <div class="input-group mb-3">
                  <div class="input-group-prepend">
                    <span class="input-group-text"><i class="fas fa-ad"></i></span>
                  </div>
                  <input type="text" class="form-control <?= ($val->hasError('name')) ? 'is-invalid' : ''; ?>" value="<?= old('name'); ?>" placeholder="Nama" name="name">
                  <div class="invalid-feedback">
                      <?= $val->getError('name'); ?>
                  </div>
                </div>
  
                <div class="input-group mb-3">
                  <div class="input-group-prepend">
                    <span class="input-group-text"><i class="fas fa-envelope"></i></span>
                  </div>
                  <input type="text" class="form-control <?= ($val->hasError('email')) ? 'is-invalid' : ''; ?>" value="<?= old('email'); ?>" placeholder="Email" name="email">
                  <div class="invalid-feedback">
                      <?= $val->getError('email'); ?>
                  </div>
                </div>
  
                <div class="input-group mb-3">
                  <div class="input-group-prepend">
                    <span class="input-group-text"><i class="fas fa-key"></i></span>
                  </div>
                  <input type="password" class="form-control <?= ($val->hasError('password')) ? 'is-invalid' : ''; ?>" value="<?= old('password'); ?>" placeholder="Password" name="password">
                  <div class="invalid-feedback">
                      <?= $val->getError('password'); ?>
                  </div>
                </div>
  
                <div class="input-group mb-3">
                  <div class="input-group-prepend">
                    <span class="input-group-text"><i class="fas fa-key"></i></span>
                  </div>
                  <input type="password" class="form-control <?= ($val->hasError('konfirmasi_password')) ? 'is-invalid' : ''; ?>" value="<?= old('konfirmasi_password'); ?>" placeholder="Konfirmasi Password" name="konfirmasi_password">
                  <div class="invalid-feedback">
                      <?= $val->getError('konfirmasi_password'); ?>
                  </div>
                </div>
  
                <div class="input-group mb-3">
                  <div class="input-group-prepend">
                    <span class="input-group-text"><i class="fas fa-user-tag"></i></span>
                  </div>
                  <select class="form-control" name="role">
                      <?php foreach ($role as $r) : ?>
                          <option value="<?= $r['id']; ?>" <?= (old('role')==$r['id']) ? 'selected' : ''; ?>><?= $r['name']; ?></option>
                      <?php endforeach ?>
                  </select>
                </div>
  
                <button name="submit" class="btn btn-primary">Simpan</button>
  
  
            </form>
          </div>
          <!-- /.card-body -->
        </div>
    </div>
</div>

<?= $this->endSection(); ?>