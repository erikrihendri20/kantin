<?= $this->extend('templates/user/index') ?>

<?= $this->section('content') ?>


<div class="row">
    <div class="col">
        <div class="card card-danger">
        <!-- /.card-header -->
            <div class="card-header">
                <h5 class="card-title"><i class="fas fa-clipboard"></i> Data Penjualan</h5>

                <div class="card-tools">
                <button type="button" class="btn btn-tool" data-card-widget="collapse">
                    <i class="fas fa-minus"></i>
                </button>
                </div>
            </div>
            <div class="card-body">
                <div class="row">
                  <div class="col">
                      <div class="form-group">
                        <select name="filter-date" class="form-control" id="filter-date">
                          <option value="1">Semua</option>
                          <option value="2">Hari ini</option>
                          <option selected value="3">Seminggu terakhir</option>
                          <option value="4">Sebulan terakhir</option>
                        </select>
                      </div>
                  </div>
                </div>
                <div class="row">
                    <div class="col" id="history-transaction" style="overflow-x: scroll;">

                    </div>
                </div>
            </div>
        <!-- ./card-body -->
        </div>
    </div>
</div>

<?= $this->endSection(); ?>