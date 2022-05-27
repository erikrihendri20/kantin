<?= $this->extend('templates/user/index') ?>

<?= $this->section('content') ?>
<?php $val = service('validation'); ?>
<div class="row">
    <div class="col">
        <div class="card card-info">
            <div class="card-header">
                <h3 class="card-title">Edit Pengguna Kantin</h3>
            </div>
            <!-- /.card-header -->
            <div class="card-body">
                <form action="" method="POST">

                  <div class="input-group mb-3">
                    <div class="input-group-prepend">
                      <span class="input-group-text"><i class="fas fa-user-tag"></i></span>
                    </div>
                    <select class="form-control" name="role">
                        <?php foreach ($role as $r) : ?>
                            <option value="<?= $r['id']; ?>" <?php 
                                if(old('role')==$r['id']){
                                    echo 'selected';
                                }elseif($user['role']==$r['id']) {
                                    echo 'selected';
                                }
                            ?>><?= $r['name']; ?></option>
                        <?php endforeach ?>
                    </select>
                  </div>
                  <div class="input-group mb-3">
                    <div class="input-group-prepend">
                      <span class="input-group-text"><i class="fas fa-flag"></i></span>
                    </div>
                    <select class="form-control" name="status">
                        <option value="1" <?= ($user['status']==1) ? 'selected' : ' '; ?>>aktif</option>
                        <option value="0" <?= ($user['status']==0) ? 'selected' : ' '; ?>>tidak aktif</option>
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