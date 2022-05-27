<?= $this->extend('templates/user/index') ?>

<?= $this->section('content') ?>

<div class="row mb-3">
    <div class="col">
        <a href="<?= base_url('Penjual/Menu/insert'); ?>" class="btn btn-primary">+Tambah Menu</a>
    </div>
</div>

<div class="row">
    <div class="col">
        <div class="form-group">
            <select id="status" name="canteen-status" class="form-control filter-history">
                <option value="1" class="status-option">
                    Tersedia
                </option>
                <option value="0" class="status-option">
                    Kosong
                </option>
            </select>
        </div>
    </div>
</div>



<div class="row" id="daftar-menu">
    
</div>

<div class="row">
    <div class="col">
        <nav aria-label="Page navigation example">
            <ul class="pagination" id="ul-pagin">
            </ul>
        </nav>
    </div>
</div>

<?= $this->endSection(); ?>