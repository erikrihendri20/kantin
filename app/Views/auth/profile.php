<?= $this->extend('templates/user/index') ?>

<?php $val = service('validation') ?>
<?= $this->section('content') ?>

<div class="row">
    <div class="col">
        <div class="card card-info">
          <div class="card-header">
            <h3 class="card-title">Formulir Tambah Menu</h3>
          </div>
          <div class="card-body">
            <form action="" method="POST" enctype="multipart/form-data">
  
                <div class="input-group mb-3">
                  <div class="input-group-prepend">
                    <span class="input-group-text" style="width: 40px;"><i class="fas fa-user"></i></span>
                  </div>
                  <input type="text" class="form-control <?= ($val->hasError('name')) ? 'is-invalid' : ''; ?>" value="<?= (old('name')) ? old('name') : $user['name']; ?>" placeholder="Nama Menu" name="name">
                  <div class="invalid-feedback">
                      <?= $val->getError('name'); ?>
                  </div>
                </div>

                <div class="input-group mb-3">
                  <div class="input-group-prepend">
                    <span class="input-group-text" style="width: 40px;"><i class="fas fa-at"></i></span>
                  </div>
                  <input type="text" class="form-control <?= ($val->hasError('email')) ? 'is-invalid' : ''; ?>" value="<?= $user['email']; ?>" placeholder="Nama Menu" name="email" readonly>
                  <div class="invalid-feedback">
                      <?= $val->getError('email'); ?>
                  </div>
                </div>
                
                <div class="form-group">
                    <img src="<?= ($user['photo']=="default.png") ? base_url('assets/img/user/default.png') : base_url('assets/img/user/'.$user['photo']); ?>" id="preview-photo" style="max-width: 200px; max-height: 200px; " alt="..." class="img-thumbnail">
                    <input type="file" name="photo" id="photo" class="pt-3 <?= ($val->hasError('photo')) ? 'is-invalid' : ''; ?>" accept="image/png, image/gif, image/jpeg">
                    <div class="invalid-feedback">
                      <?= $val->getError('photo'); ?>
                  </div>
                </div>

                <div class="input-group mb-3">
                  <div class="input-group-prepend">
                    <span class="input-group-text" style="width: 40px;"><i class="fas fa-key"></i></span>
                  </div>
                  <input type="password" class="form-control <?= ($val->hasError('new-password')) ? 'is-invalid' : ''; ?>" placeholder="Password baru" name="new-password">
                  <div class="invalid-feedback">
                      <?= $val->getError('new-password'); ?>
                  </div>
                </div>

                <div class="input-group mb-3">
                  <div class="input-group-prepend">
                    <span class="input-group-text" style="width: 40px;"><i class="fas fa-key"></i></span>
                  </div>
                  <input type="password" class="form-control <?= ($val->hasError('confirm-password')) ? 'is-invalid' : ''; ?>" placeholder="Konfrmasi password" name="confirm-password">
                  <div class="invalid-feedback">
                      <?= $val->getError('confirm-password'); ?>
                  </div>
                </div>

                <div class="input-group mb-3">
                  <div class="input-group-prepend">
                    <span class="input-group-text" style="width: 40px;"><i class="fas fa-key"></i></span>
                  </div>
                  <input type="password" class="form-control <?= ($val->hasError('old-password')) ? 'is-invalid' : ''; ?>" placeholder="Password" name="old-password">
                  <div class="invalid-feedback">
                      <?= $val->getError('old-password'); ?>
                  </div>
                </div>

                <button name="submit" class="btn btn-primary">Simpan</button>
  
            </form>
            
          </div>
          <!-- /.card-body -->
        </div>
    </div>
</div>

<?= $this->endSection(); ?>