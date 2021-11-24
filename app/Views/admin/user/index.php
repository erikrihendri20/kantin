<?= $this->extend('templates/user/index') ?>

<?= $this->section('content') ?>
<div class="row">
    <div class="col">
        <div class="card card-info">
            <div class="card-header">
                <h3 class="card-title">Tabel Pengguna Kantin</h3>
            </div>
            <!-- /.card-header -->
            <div class="card-body">
                <div id="tabel-1" style="overflow-x: scroll;">
                    
                </div>
                <a href="<?= base_url('Admin/User/Insert'); ?>" class="btn btn-primary">+ Tambah</a>
            </div>
            <!-- /.card-body -->
        </div>
    </div>
</div>

<?= $this->endSection(); ?>