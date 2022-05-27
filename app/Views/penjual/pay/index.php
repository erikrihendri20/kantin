<?= $this->extend('templates/user/index') ?>

<?= $this->section('content') ?>

<!-- <div class="row">
    <div class="col">
        <div class="form-group">
            <select id="status" name="canteen-status" class="form-control filter-history">
                <option value="0" class="status-option">
                    Semua
                </option>
                <option value="4" class="status-option">
                    Belum membayar
                </option>
            </select>
        </div>
    </div>
</div> -->

<div id="waiting-list">
    
</div>

<button type="button" id="refresh-button" class="badge badge-primary">refresh order</button>

<?= $this->endSection(); ?>