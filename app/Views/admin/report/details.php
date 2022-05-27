<?= $this->extend('templates/user/index') ?>

<?= $this->section('content') ?>
<div class="row">
    <div class="col">
        <div class="card card-info">
            <div class="card-header">
                <h3 class="card-title">Tabel Detail Pelaporan</h3>
            </div>
            <!-- /.card-header -->
            <div class="card-body">
                <div id="tabel-1" style="overflow-x: scroll;">

                </div>
                <div id="button-action">
                    
                </div>
            </div>
            <!-- /.card-body -->
        </div>
    </div>
</div>
<div class="row">
    <div class="col">
        <div class="card card-info">
            <div class="card-header">
                <h3 class="card-title">Tabel Detail Pelaporan Dihapus</h3>
            </div>
            <!-- /.card-header -->
            <div class="card-body">
                <div id="tabel-2" style="overflow-x: scroll;">

                </div>
            </div>
            <!-- /.card-body -->
        </div>
    </div>
</div>

<?= $this->endSection(); ?>