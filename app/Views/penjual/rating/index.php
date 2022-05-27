<?= $this->extend('templates/user/index') ?>

<?= $this->section('content') ?>


<div class="row">
    <div class="col">
        <div class="card card-danger">
        <!-- /.card-header -->
            <div class="card-header">
                <h5 class="card-title"><i class="fas fa-clipboard"></i> Komentar</h5>

                <div class="card-tools">
                <button type="button" class="btn btn-tool" data-card-widget="collapse">
                    <i class="fas fa-minus"></i>
                </button>
                </div>
            </div>
            <div class="card-body">
                <div class="row">
                  <div class="col" style="overflow-x: scroll;">
                      <table id="rating-table" class="table table-bordered table-hover">
                          <thead>
                              <tr>
                                  <th>No</th>
                                  <th>Pembeli</th>
                                  <th>Rating</th>
                                  <th>Komentar</th>
                              </tr>
                          </thead>
                            <tbody>
                                <?php foreach ($rating as $key => $value): ?>
                                <tr>
                                    <td><?= $key+1; ?></td>
                                    <td><?= $value['name'] ?></td>
                                    <td><?= $value['rating'] ?></td>
                                    <td><?= $value['comment'] ?></td>
                                </tr>
                                <?php endforeach; ?>
                            </tbody>
                      </table>
                  </div>
                </div>
            </div>
        <!-- ./card-body -->
        </div>
    </div>
</div>

<?= $this->endSection(); ?>