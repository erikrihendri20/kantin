<?= $this->extend('templates/user/index') ?>
<?= $this->section('content') ?>

<div class="row">
    <div class="col-md-6">
        <div class="form-group">
            <select id="status" name="canteen-status" class="form-control filter-history">
                <option value="5" class="status-option">
                    Transaksi Berhasil
                </option>
                <option value="9" class="status-option">
                    Transaksi Gagal
                </option>
            </select>
        </div>
    </div>
    <div class="col-md-6">
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

<div id="history">
    
</div>



<button type="button" id="refresh-button" class="badge badge-primary">segarkan riwayat</button>

<?= $this->endSection(); ?>