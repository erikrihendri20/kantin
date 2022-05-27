<?= $this->extend('templates/user/index') ?>

<?= $this->section('content') ?>


<div class="row">
    <div class="col">
        <div class="card card-info">
        <!-- /.card-header -->
            <div class="card-header">
                <h5 class="card-title"><i class="fas fa-clipboard"></i> Kritik dan Saran</h5>

                <div class="card-tools">
                <button type="button" class="btn btn-tool" data-card-widget="collapse">
                    <i class="fas fa-minus"></i>
                </button>
                </div>
            </div>
            <div class="card-body">
                
                <div class="row">
                    <div class="col" id="history-transaction">
                        <form action="<?= base_url('Pembeli/Testimonial/sendTestimonial'); ?>" method="POST">
                            <div class="form-group">
                                <label for="message">Kritik dan Saran</label>
                                <textarea class="form-control" id="message" name="message" rows="6"></textarea>
                            </div>
                            <button class="btn btn-primary" type="submit">Kirim</button>
                        </form>
                        <p class="text-secondary">Kritik dan saran yang anda berikan akan menjadi masukan bagi kantin untuk meningkatkan pelayanan kepada pelanggan</p>
                    </div>
                </div>
            </div>
        <!-- ./card-body -->
        </div>
    </div>
</div>

<?= $this->endSection(); ?>