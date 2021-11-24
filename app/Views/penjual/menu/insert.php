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
                    <span class="input-group-text" style="width: 40px;"><i class="fas fa-utensils"></i></span>
                  </div>
                  <input type="text" class="form-control <?= ($val->hasError('name')) ? 'is-invalid' : ''; ?>" value="<?= old('name'); ?>" placeholder="Nama Menu" name="name">
                  <div class="invalid-feedback">
                      <?= $val->getError('name'); ?>
                  </div>
                </div>

                <div class="input-group mb-3">
                  <div class="input-group-prepend">
                    <span class="input-group-text" style="width: 40px;"><i class="fas fa-caret-square-down"></i></span>
                  </div>
                  <select class="form-control" name="type">
                      <?php foreach ($menu_types as $m) : ?>
                          <option value="<?= $m['id']; ?>"><?= $m['name']; ?></option>
                      <?php endforeach ?>
                  </select>
                </div>
  
                <div class="input-group mb-3">
                  <div class="input-group-prepend">
                    <span class="input-group-text" style="width: 40px;"><i class="fas fa-dollar-sign"></i></span>
                  </div>
                  <input type="number" class="form-control <?= ($val->hasError('price')) ? 'is-invalid' : ''; ?>" value="<?= old('price'); ?>" placeholder="Harga" name="price" min=0>
                  <div class="invalid-feedback">
                      <?= $val->getError('price'); ?>
                  </div>
                </div>

                <div class="form-group">
                    <textarea class="form-control" rows="3" placeholder="Deskripsi makanan ..." name="description"></textarea>
                </div>
                
                <div class="form-group">
                    <img src="<?= base_url('assets/img/menu/default.png'); ?>" id="preview-photo" style="max-width: 200px; max-height: 200px; " alt="..." class="img-thumbnail">
                    <input type="file" name="photo" id="photo" class="pt-3 <?= ($val->hasError('photo')) ? 'is-invalid' : ''; ?>" accept="image/png, image/gif, image/jpeg">
                    <div class="invalid-feedback">
                      <?= $val->getError('photo'); ?>
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