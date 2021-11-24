<?= $this->extend('templates/user/index') ?>

<?= $this->section('content') ?>

<div class="row">
    <div class="col" id="daftar-menu">
        
    </div>
</div>
<div class="row">
    <div class="col">
        <nav aria-label="Page navigation example">
            <ul class="pagination" id="ul-pagin">
            </ul>
        </nav>
    </div>
</div>

<button class="btn btn-secondary buy-button text-dark py-2 px-2" id="cart-total">
    <p class="price bg-light mr-2 py-1 px-1" id="cart-total-price">Rp.0</p>
    <i class="fas fa-shopping-cart text-light"></i>
</button>

<?= $this->endSection(); ?>