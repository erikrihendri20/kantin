<?= $this->extend('templates/dev/index') ?>

<?= $this->section('content') ?>

<div class="row">
    <div class="col">
        <button type="button" class="btn btn-primary" style="margin-bottom: 10px; border:none; float: right;" data-toggle="modal" data-target="#addModal">
          Daftar API Key
        </button>
    </div>
</div>

<div class="row">
    <div class="col">
        <div class="card card-danger">
            <!-- /.card-header -->
                <div class="card-header">
                    <h5 class="card-title">API Key</h5>

                    <div class="card-tools">
                    <button type="button" class="btn btn-tool" data-card-widget="collapse">
                        <i class="fas fa-minus"></i>
                    </button>
                    </div>
                </div>
                <div class="card-body" style="overflow-x: scroll;">
                    <div class="row">
                        <div class="col">
                            <table id="api-table" class="table table-bordered table-striped">
                                <thead>
                                    <tr>
                                        <th>Application Name</th>
                                        <th>Application Type</th>
                                        <th>Api Key</th>
                                        <th>URL</th>
                                        <th>Information</th>
                                        <th>Status</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach ($api as $key => $value) : ?>
                                        <tr>
                                            <td><?= $value['application_name']; ?></td>
                                            <td><?php if($value['application_type']==1){
                                                echo 'Web Application';
                                            }elseif($value['application_type'] == 2){
                                                echo 'Android';
                                            }elseif($value['application_type'] == 3){
                                                echo 'IOS';
                                            }elseif($value['application_type'] == 4){
                                                echo 'Chrome Application';
                                            }elseif($value['application_type'] == 5){
                                                echo 'Desktop';
                                            }; ?></td>
                                            <td><?= $value['api_key']; ?> <sup><i class="far fa-copy api-copy" style="float: right;" onmouseover="this.style.cursor='pointer'" data-api_key="<?= $value['api_key']; ?>"></i></sup></td>
                                            <td><?= (strlen($value['url'])>20) ? substr($value['url'],0,20).'..' : $value['url']; ?></td>
                                            <td><?= (strlen($value['information'])>20) ? substr($value['information'],0,20).'..' : $value['information'];; ?></td>
                                            <td><?= ($value['status']==1) ? 'aktif' : 'tidak aktif'; ?></td>
                                            <td>
                                                <button class="badge badge-danger delete-button" style="border: none;" data-id="<?= $value['id']; ?>">Hapus</button>
                                                <button type="button" class="badge badge-success" style="border:none;" data-toggle="modal" data-target="#editModal<?= $value['id']; ?>">Edit</button>

                                                <div class="modal fade" id="editModal<?= $value['id']; ?>" tabindex="-1" aria-labelledby="editModal<?= $value['id']; ?>Label" aria-hidden="true">
                                                    <div class="modal-dialog">
                                                        <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h5 class="modal-title" id="editModal<?= $value['id']; ?>Label">Daftar API Key</h5>
                                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                            <span aria-hidden="true">&times;</span>
                                                            </button>
                                                        </div>
                                                        <form action="<?= base_url('Dev/Dashboard/editApiKey/'.$value['id']); ?>" method="POST">
                                                            <div class="modal-body">
                                                                <div class="form-group">
                                                                    <input value="<?= $value['application_name']; ?>" type="text" name="application_name" class="form-control" id="formGroupExampleInput" placeholder="Nama Aplikasi">
                                                                </div>
                                                                <div class="form-group">
                                                                    <select id="inputState" class="form-control" name="application_type">
                                                                        <option value="">Application Type</option>
                                                                        <option <?= ($value['application_type']==1) ? 'selected' : ''; ?> value="1">Web Application</option>
                                                                        <option <?= ($value['application_type']==2) ? 'selected' : ''; ?> value="2">Android</option>
                                                                        <option <?= ($value['application_type']==3) ? 'selected' : ''; ?> value="3">IOS</option>
                                                                        <option <?= ($value['application_type']==4) ? 'selected' : ''; ?> value="4">Chrome App</option>
                                                                        <option <?= ($value['application_type']==5) ? 'selected' : ''; ?> value="5">Desktop</option>
                                                                    </select>
                                                                </div>
                                                                <div class="form-group">
                                                                    <input value="<?= $value['url']; ?>" type="text" name="url" class="form-control" id="formGroupExampleInput" placeholder="URL">
                                                                </div>
                                                                <div class="form-group">
                                                                    <input value="<?= $value['information']; ?>" type="text" name="information" class="form-control" id="formGroupExampleInput" placeholder="information">
                                                                </div>
                                                            </div>
                                                            <div class="modal-footer">
                                                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                                                                <button type="submit" class="btn btn-primary">Simpan</button>
                                                            </div>
                                                            </div>
                                                        </form>
                                                    </div>
                                                </div>
                                            </td>
                                        </tr>
                                    <?php endforeach ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            <!-- ./card-body -->
        </div>
    </div>
</div>

<div class="modal fade" id="addModal" tabindex="-1" aria-labelledby="addModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="addModalLabel">Daftar API Key</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form action="<?= base_url('Dev/Dashboard/addApiKey'); ?>" method="POST">
        <div class="modal-body">
            <div class="form-group">
                <input type="text" name="application_name" class="form-control" id="formGroupExampleInput" placeholder="Nama Aplikasi">
            </div>
            <div class="form-group">
                <select id="inputState" class="form-control" name="application_type">
                    <option selected value="">Application Type</option>
                    <option value="1">Web Application</option>
                    <option value="2">Android</option>
                    <option value="3">IOS</option>
                    <option value="4">Chrome App</option>
                    <option value="5">Desktop</option>
                </select>
            </div>
            <div class="form-group">
                <input type="text" name="url" class="form-control" id="formGroupExampleInput" placeholder="URL">
            </div>
            <div class="form-group">
                <input type="text" name="information" class="form-control" id="formGroupExampleInput" placeholder="information">
            </div>
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
            <button type="submit" class="btn btn-primary">Simpan</button>
        </div>
        </div>
    </form>
  </div>
</div>

<?= $this->endSection(); ?>