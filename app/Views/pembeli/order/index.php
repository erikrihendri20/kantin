<?= $this->extend('templates/user/index') ?>

<?= $this->section('content') ?>


<div class="row">
    <?php foreach ($stand as $s) : ?>
        <div class="col-sm-12 col-md-4">
            
            <div class="card" style="height: 500px;">
                <img src="<?= base_url('assets/img/user/canteen/'.$s['stand_picture']); ?>" class="card-img-top" style="object-fit: cover; width:100%; height:344px;" alt="...">
                <div class="card-body pb-1">
                    <h5 class="card-title font-weight-bold"><?= ($s['canteen_info_name']) ? strtoupper($s['canteen_info_name']) : strtoupper($s['user_name']); ?> <sup class="text-secondary"><?= ($s['canteen_info_rating']) ? $s['canteen_info_rating'] : 0; ?><sup><i class="fas fa-star text-warning"></i></sup></sup></h5>
                    <p class="card-text mb-0"> <?= ($s['count_buyer']) ? 'dinilai oleh '.$s['count_buyer'].' orang' : 'belum ada yang menilai'; ?></p>
                    <p class="card-text"><?= ($s['canteen_info_description']) ? $s['canteen_info_description'] : 'no desc'; ?></p>
                </div>
                <div class="card-body">
                    <a href="<?= base_url('Pembeli/Order/menu?stand=' . $s['user_id']); ?>" class="card-link">Kunjungi</a>
                </div>
            </div>

        </div>
    <?php endforeach ?>
</div>


<?= $this->endSection(); ?>