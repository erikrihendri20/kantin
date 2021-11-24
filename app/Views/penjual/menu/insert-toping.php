<?= $this->extend('templates/user/index') ?>

<?php $val = service('validation') ?>
<?= $this->section('content') ?>

<div class="row">
    <div class="col">
        <div class="card card-info">
          <div class="card-header">
            <h3 class="card-title">Formulir Tambah Toping</h3>
          </div>
          <div class="card-body">
            <form action="" method="POST" enctype="multipart/form-data">
  
                <div class="input-group mb-3">
                  <div class="input-group-prepend">
                    <span class="input-group-text" style="width: 40px;"><i class="fas fa-utensils"></i></span>
                  </div>
                  <input type="text" class="form-control <?= ($val->hasError('name')) ? 'is-invalid' : ''; ?>" value="<?= old('name'); ?>" placeholder="Nama Toping" name="name">
                  <div class="invalid-feedback">
                      <?= $val->getError('name'); ?>
                  </div>
                </div>

  
                <div class="input-group mb-3">
                  <div class="input-group-prepend">
                    <span class="input-group-text" style="width: 40px;"><i class="fas fa-dollar-sign"></i></span>
                  </div>
                  <input type="number" class="form-control <?= ($val->hasError('price')) ? 'is-invalid' : ''; ?>" value="<?= old('price'); ?>" placeholder="Harga Toping" name="price" min=0>
                  <div class="invalid-feedback">
                      <?= $val->getError('price'); ?>
                  </div>
                </div>

                <button name="submit" class="btn btn-primary">Simpan</button>
                <a href="<?= base_url('Penjual/Menu'); ?>" class="btn btn-danger">Kembali</a>
  
            </form>
            
          </div>
          <!-- /.card-body -->
        </div>
    </div>
</div>

<?= $this->endSection(); ?>