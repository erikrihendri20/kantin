<?= $this->extend('templates/user/index') ?>

<?= $this->section('content') ?>


<div class="row">
    <?php foreach ($stand as $s) : ?>
        <div class="col-sm-12 col-md-4">
            
            <div class="card">
                <img src="<?= base_url('assets/img/user/canteen/'.$s['stand_picture']); ?>" class="card-img-top" alt="...">
                <div class="card-body pb-1">
                    <h5 class="card-title"><?= ($s['canteen_info_name']) ? strtoupper($s['canteen_info_name']) : strtoupper($s['user_name']); ?> <sup class="text-muted"><?= ($s['canteen_info_rating']) ? $s['canteen_info_rating'] : 0; ?><i class="fas fa-star text-warning"></i></sup></h5>
                    <p class="card-text"><?= ($s['canteen_info_description']) ? $s['canteen_info_description'] : 'no desc'; ?></p>
                </div>
                <div class="card-body pt-1">
                    <a href="<?= base_url('Pembeli/Order/menu?stand=' . $s['user_id']); ?>" class="card-link">Kunjungi</a>
                </div>
            </div>

        </div>
    <?php endforeach ?>
</div>


<?= $this->endSection(); ?>