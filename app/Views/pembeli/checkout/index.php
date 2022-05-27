<?= $this->extend('templates/user/index') ?>

<?= $this->section('content') ?>
<form action="<?= base_url('Pembeli/Pay'); ?>" method="POST">
  <div class="row ">
    <div class="col ">
        <div class="card card-info mb-5">
        <!-- /.card-header -->
          <div class="card-header">
              <h5 class="card-title"><i class="fas fa-clipboard"></i> Detail</h5>
    
              <div class="card-tools">
              <button type="button" class="btn btn-tool" data-card-widget="collapse">
                  <i class="fas fa-minus"></i>
              </button>
              </div>
          </div>
          <div class="card-body px-0 bg-light py-0">
              <div class="row">
                  <div class="col" id="detail-order">

                  </div>
              <!-- /.col -->
              </div>
              <div class="row m-2">
                <div class="col">
                  <div class="custom-control custom-switch custom-switch-off-warning custom-switch-on-info">
                    <input type="checkbox" class="custom-control-input" id="order-option">
                    <label class="custom-control-label" for="order-option">Makan di tempat</label>
                  </div>
                </div>
              </div>
              <!-- /.row -->
          </div>
        <!-- ./card-body -->
        </div>
    </div>
  </div>
<!--  -->



<button class="btn btn-light text-dark px-0 py-0" type="submit" id="footer-cart">
    <a class="bg-light py-2 pr-2" id="footer-cart-price"><p id="footer-cart-price-text">Total Pembayaran : <span id="nominal-price-total" class="price-total">Rp.0</span></p></a>
    <a id="footer-cart-count" class="bg-info py-2 "><p id="footer-cart-count-text">Pesan Sekarang</p></a>
</button>
</form>

<?= $this->endSection(); ?>