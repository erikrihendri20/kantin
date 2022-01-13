<?= $this->extend('templates/user/index') ?>

<?= $this->section('content') ?>
<form action="<?= base_url('Penjual/MyCanteen/updateCanteen'); ?>" method="POST" id="form-my-canteen" enctype="multipart/form-data">
    <div class="card card-solid">
        <div class="card-body">
          <div class="row">
            <div class="col-12 col-sm-6">
              <div class="col-12">
                <img src="<?= base_url('assets/img/user/canteen/'.$canteen['stand_picture']) ?>" id="preview-photo" class="product-image" alt="Product Image">
                <input type="file" class="mt-2" name="photo" id="photo">
              </div>
            </div>
            <div class="col-12 col-sm-6">
              <div class="form-group">
                  <label for="canteen-name">Nama Kantin</label>
                  <input type="text" class="form-control" name="canteen-name" placeholder="Isikan nama kantin anda" value="<?= $canteen['canteen_info_name'] ?>" id="canteen-name">
              </div>
              <hr>

                <div class="form-group">
                    <label for="description">Deskripsi</label>
                    <textarea class="form-control" id="description" placeholder="Isikan deskripsi kantin anda" name="description" rows="4"><?= $canteen['canteen_info_description'] ?></textarea>
                </div>
              <div class="mt-4">


                <div class="form-group">
                    <label for="canteen-status">Status Kantin</label>
                    <select id="canteen-status" name="canteen-status" class="form-control">
                        <option value="2" <?= ($canteen['status']==2) ? 'selected' : ''; ?>>
                            Buka
                        </option>
                        <option value="1" <?= ($canteen['status']==1) ? 'selected' : ''; ?>>
                            Tutup
                        </option>
                    </select>
                </div>
                

                <div class="form-group">
                    <label for="open-hours">Jam Buka</label>
                    <input type="time" id="open-hours" name="open-hours" class="form-control" value="<?= $canteen['open_hours']; ?>">
                </div>
                
                <div class="form-group">
                    <label for="close-hours">Jam Tutup</label>
                    <input type="time" id="close-hours" name="close-hours" class="form-control" value="<?= $canteen['close_hours']; ?>">
                </div>


                <label for="rating-canteen">Rating Kantin</label>
                <div class="btn btn-default btn-lg btn-flat" style="width: 100%;">
                  <i class="fas fa-star fa-lg mr-2"></i>
                  <?= $canteen['canteen_info_rating']; ?>
                </div>
              </div>


              <button class="btn btn-info mt-2 float-right" type="submit" name="submit">Simpan</button>
            </div>
          </div>
        </div>
        <!-- /.card-body -->
    </div>
</form>

<?= $this->endSection(); ?>