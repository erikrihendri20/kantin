<?= $this->extend('templates/user/index') ?>

<?= $this->section('content') ?>

<div class="row">
    <div class="col">
        <div class="card card-solid">
            <div class="card-body">
            <div class="row">
                <div class="col-12 col-sm-6">
                <div class="col-12">
                    <img src="<?= base_url('assets/img/menu/' . $menu['photo']); ?>" class="product-image" alt="Product Image">
                </div>
                </div>
                <div class="col-12 col-sm-6">
                <h3 class="my-3"><span class="font-weight-bold">[<?= strtoupper($penjual['name']); ?>]</span><?= strtoupper($menu['name']) ?></h3>
                <p><?= $menu['description']; ?></p>

                <hr>


                <div class="bg-gray py-2 px-3 mt-4">
                    <h2 class="mb-0">
                    Rp <?= $menu['price']; ?>
                    </h2>
                </div>

                <div class="mt-4">
                    <div class="btn btn-default btn-lg btn-flat">
                        <i class="
                        <?php switch ($type['id']) {
                            case '1':
                                echo 'fas fa-utensils';
                                break;
                            
                            case '2':
                                echo 'fas fa-candy-cane';
                                break;
                            
                            case '3':
                                echo 'fas fa-mug-hot';
                                break;
                            
                            case '4':
                                echo 'fas fa-question';
                                break;
                            
                            default:
                                # code...
                                break;
                        } ?>
                        fa-lg mr-2"></i>
                            <?= $type['name']; ?>
                    </div>

                    <a href="<?= base_url('Penjual/Menu/insertToping/' . $menu['id']); ?>" class="btn btn-primary btn-lg btn-flat">
                        <i class="fas fa-ice-cream fa-lg mr-2"></i>
                        Tambah Toping
                    </a>
                    
                </div>

                </div>
            </div>
            <div class="row mt-4">
                <div class="col">
                    <div class="card">
                      <div class="card-header">
                        <h3>Toping: </h3>
                      </div>
                      <ul class="list-group list-group-flush" id="list-toping" data-id=<?= $menu['id']; ?>>
                        
                      </ul>
                    </div>
                </div>
            </div>
            </div>
            <!-- /.card-body -->
        </div>

    </div>
    
</div>

<?= $this->endSection(); ?>