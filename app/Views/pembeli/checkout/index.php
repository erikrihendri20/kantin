<?= $this->extend('templates/user/index') ?>

<?= $this->section('content') ?>
<form action="<?= base_url('Pembeli/Pay'); ?>" method="POST">
<div class="row">
    <div class="col px-0 ">
        <div class="card card-light card-menu">
          <!-- /.card-header -->
          <div class="card-header card-menu">
            <h5 class="card-title"><i class="fas fa-clipboard"></i> Detail Pesanan</h5>

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
            <!-- /.row -->
          </div>
          <!-- ./card-body -->
        </div>
    </div>
</div>
<div class="row">
    <div class="col px-0 ">
        <div class="card card-light card-menu">
          <!-- /.card-header -->
          <div class="card-header card-menu">
            <h5 class="card-title"><i class="fas fa-pen-square"></i> Catatan</h5>

            <div class="card-tools">
              <button type="button" class="btn btn-tool" data-card-widget="collapse">
                <i class="fas fa-minus"></i>
              </button>
            </div>
          </div>
          <div class="card-body card-menu-body">
            <div class="row">
                <div class="col" id="catatan">
                    
                    <div class="form-group">
                        <textarea class="form-control" id="noted" placeholder="Contoh format catatan khusus
nasi goreng : pedas
jus jambu : tidak pakai es
nasi campur : tidak pakai sayur" name="noted" rows="4"></textarea>
                    </div>
                    
                </div>
              <!-- /.col -->
            </div>
            <!-- /.row -->
          </div>
          <!-- ./card-body -->
        </div>
    </div>
</div>
<div class="row pb-5">
    <div class="col px-0 ">
        <div class="card card-light card-menu">
          <!-- /.card-header -->
          <div class="card-header card-menu">
            <h5 class="card-title"><i class="fas fa-dollar-sign"></i> Pembayaran</h5>

            <div class="card-tools">
              <button type="button" class="btn btn-tool" data-card-widget="collapse">
                <i class="fas fa-minus"></i>
              </button>
            </div>
          </div>
          <div class="card-body">
            <div class="row">
                <div class="col">
                    <table id="price-table">
                        <tbody  >
                            <tr>
                                <td id="label-subtotal-order">Subtotal Pesanan</td>
                                <td id="price-subtotal-order" class="price" data-price="0" id>Rp0</td>
                            </tr>

                            <tr>
                                <td id="label-tax">Pajak</td>
                                <td id="price-tax" class="price" data-price="0" id>Rp0</td>
                            </tr>

                            <tr >
                                <td id="label-total">Total</td>
                                <td id="price-total" class="price price-total" data-price="0" id>Rp0</td>
                            </tr>
                            
                        </tbody>
                    </table>
                </div>
              <!-- /.col -->
            </div>
            <!-- /.row -->
          </div>
          <!-- ./card-body -->
        </div>
    </div>
</div>



<button class="btn btn-light text-dark px-0 py-0" type="submit" id="footer-cart">
    <a class="bg-light py-2 pr-2" id="footer-cart-price"><p id="footer-cart-price-text">Total Pembayaran : <span id="nominal-price-total" class="price-total">Rp.0</span></p></a>
    <a id="footer-cart-count" class="bg-info py-2 "><p id="footer-cart-count-text">Pesan Sekarang</p></a>
</button>
</form>

<?= $this->endSection(); ?>