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
        <div class="card-body px-2 pt-0 pb-2">
            <div class="row">
                <div class="col">
                    <div class="form-group my-0">
                        <label for="start-date" class="my-0">Dari tanggal</label>
                        <input type="date" id="start-date" name="start-date" class="form-control filter-date">
                    </div>
                </div>
                <div class="col">
                    <div class="form-group my-0">
                        <label for="end-date" class="my-0">Sampai Tanggal</label>
                        <input type="date" id="end-date" name="end-date" class="form-control filter-date">
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col" id="history-transaction">

                </div>
            </div>
        </div>
        <!-- ./card-body -->
        </div>
    </div>
</div>

<?= $this->endSection(); ?>