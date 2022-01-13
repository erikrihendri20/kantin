<?= $this->extend('templates/user/index') ?>

<?= $this->section('content') ?>
<form action="<?= base_url('Pembeli/Checkout'); ?>" method="POST">

<div class="mb-4">
    <div class="row">
        <div class="col" id="daftar-menu">
            
        </div>
    </div>
    <div class="row pb-4">
        <div class="col">
            <nav aria-label="Page navigation example">
                <ul class="pagination" id="ul-pagin">
                </ul>
            </nav>
        </div>
    </div>
</div>

<button id="reset-cart" class="badge badge-danger">
    Hapus Pesanan
</button>

<button class="btn btn-light text-dark px-0 py-0" type="submit" id="footer-cart">
    <a class="bg-light py-2 pr-2" id="footer-cart-price"><p id="footer-cart-price-text">Total Pembayaran : <span id="nominal-price-total" class="price-total">Rp.0</span></p></a>
    <a id="footer-cart-count" class="bg-info py-2 "><p id="footer-cart-count-text"><i class="fas fa-shopping-cart"></i></p></a>
</button>
</form>

<?= $this->endSection(); ?>