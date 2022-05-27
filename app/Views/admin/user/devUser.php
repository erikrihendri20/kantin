<?= $this->extend('templates/user/index') ?>

<?= $this->section('content') ?>
<div class="row">
    <div class="col">
        <div class="card card-info">
            <div class="card-header">
                <h3 class="card-title">Tabel Pengguna Dev</h3>
            </div>
            <!-- /.card-header -->
            <div class="card-body">
                <div id="div-table" style="overflow-x: scroll;">
                    <table id="dev-user-table" class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Nama</th>
                                <th>Email</th>
                                <th>Role</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($users as $key => $value) : ?>
                                <tr>
                                    <td><?= $key + 1 ?></td>
                                    <td><?= $value['name'] ?></td>
                                    <td><?= $value['email'] ?></td>
                                    <td><?= $value['role'] ?></td>
                                    <td>
                                        <a class="badge badge-warning" style="border: none;" href="<?= base_url('Admin/User/devApi/'.$value['id']); ?>">detail</a>
                                        <button type="button" class="badge badge-success" style="border:none;" data-toggle="modal" data-target="#editModal<?= $value['id']; ?>">edit</button>
                                        <button class="badge badge-danger delete-button" style="border: none;" data-id="<?= $value['id']; ?>">hapus</button>

    
                                        <div class="modal fade" id="editModal<?= $value['id']; ?>" tabindex="-1" aria-labelledby="editModal<?= $value['id']; ?>Label" aria-hidden="true">
                                            <div class="modal-dialog">
                                                <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="editModal<?= $value['id']; ?>Label">Daftar Pengguna Dev</h5>
                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                    </button>
                                                </div>
                                                <form action="<?= base_url('Admin/User/editDevUser/'.$value['id']); ?>" method="POST">
                                                    <div class="modal-body">
                                                        <div class="form-group">
                                                            <input value="<?= $value['name']; ?>" type="text" name="name" class="form-control" id="formGroupExampleInput" placeholder="Nama">
                                                        </div>
                                                        <div class="form-group">
                                                            <select id="inputState" class="form-control" name="role">
                                                                <option value="">Role</option>
                                                                <option <?= ($value['role']==1) ? 'selected' : ''; ?> value="1">Pengguna</option>
                                                                <option <?= ($value['role']==2) ? 'selected' : ''; ?> value="2">Super Admin</option>
                                                            </select>
                                                        </div>
                                                        <div class="form-group">
                                                            <input value="<?= $value['email']; ?>" type="email" name="email" class="form-control" id="formGroupExampleInput">
                                                        </div>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                                                        <button type="submit" name="submit" class="btn btn-primary">Simpan</button>
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
                <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#addModal">
                    + Tambah
                </button>
            </div>
            <!-- /.card-body -->
        </div>
    </div>
</div>

<div class="modal fade" id="addModal" tabindex="-1" aria-labelledby="addModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="addModalLabel">Tambah Pengguna Dev</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form action="<?= base_url('Admin/User/insertDevUser'); ?>" method="POST">
        <div class="modal-body">
            <div class="form-group">
                <input type="text" name="name" class="form-control" id="formGroupExampleInput" placeholder="Nama">
            </div>
            <div class="form-group">
                <select id="inputState" class="form-control" name="role">
                    <option selected value="">Role</option>
                    <option value="1">Pengguna</option>
                    <option value="2">Admin</option>
                </select>
            </div>
            <div class="form-group">
                <input type="text" name="email" class="form-control" id="formGroupExampleInput" placeholder="Email">
            </div>
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
            <button type="submit" name="submit" class="btn btn-primary">Simpan</button>
        </div>
        </div>
    </form>
  </div>
</div>

<?= $this->endSection(); ?>