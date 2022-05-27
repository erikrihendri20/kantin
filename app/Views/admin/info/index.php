<?= $this->extend('templates/user/index') ?>

<?= $this->section('content') ?>


<div class="row">
    <div class="col">
        <div class="card card-info">
        <!-- /.card-header -->
            <div class="card-header">
                <h5 class="card-title"><i class="fas fa-clipboard"></i> Informasi</h5>

                <div class="card-tools">
                <button type="button" class="btn btn-tool" data-card-widget="collapse">
                    <i class="fas fa-minus"></i>
                </button>
                </div>
            </div>
            <div class="card-body">
                <!-- dashboard -->
                <div class="row">
                    <div class="col">
                        <h4>Memesan menu</h4>
                        <ul>
                            <li>
                                Pada menu ini anda dapat melihat rangkuman informasi mengenai aktifitas yang ada di kantin, seperti jumlah pembeli, jumlah transaksi, dan pendapatan tiap tenan.
                            </li>
                            <li>
                                Untuk dapat mengakses halaman ini, anda dapat menekan tombol <i class="fas fa-tachometer-alt"></i> yang terdapat pada menu di sebelah kiri layar anda.
                            </li>
                        </ul>
                    </div>
                </div>
                <!-- laporan -->
                <div class="row">
                    <div class="col">
                        <h4>Laporan</h4>
                        <ul>
                            <li>
                                Pada menu ini anda dapat melihat pelanggaran yang dilakukan oleh pengguna kantin.
                            </li>
                            <li>
                                Untuk dapat mengakses halaman ini, anda dapat menekan tombol <i class="fas fa-exclamation"></i> yang terdapat pada menu di sebelah kiri layar anda.
                            </li>
                        </ul>
                    </div>
                </div>
                <!-- daftar pengguna -->
                <div class="row">
                    <div class="col">
                        <h4>Daftar Pengguna</h4>
                        <ul>
                            <li>
                                Pada menu ini anda dapat melihat daftar pengguna yang terdaftar di kantin.
                            </li>
                            <?php if(session()->role==1): ?>
                            <li>
                            Pengguna yang dapat dikelola antara lain memiliki peran atau <i>role</i> sebagai admin, penjual dan pembeli.
                            </li>
                            <?php else : ?>
                            <li>
                                Pengguna yang dapat dikelola antara lain memiliki peran atau <i>role</i> sebagai penjual dan pembeli.
                            </li>
                            <?php endif ?>
                            <li>
                                Untuk dapat mengakses halaman ini, anda dapat menekan tombol <i class="fas fa-user"></i> yang terdapat pada menu di sebelah kiri layar anda.
                            </li>
                        </ul>
                    </div>
                </div>
                <!-- dev -->
                <div class="row">
                    <div class="col">
                        <h4>Developer</h4>
                        <ul>
                            <li>
                                Pada menu ini anda dapat melihat daftar developer yang berinteraksi dengan aplikasi ini.
                            </li>
                            <li>
                                Untuk dapat mengakses halaman ini, anda dapat menekan tombol <i class="fab fa-dev"></i> yang terdapat pada menu di sebelah kiri layar anda.
                            </li>
                            <li>
                                Selain itu anda juga dapat melihat daftar credential developer yang terdaftar di kantin.
                            </li>
                            <li>
                                Untuk mengakses halaman ini, anda dapat menekan tombol <i class="fas fa-key"></i> yang terdapat pada menu di sebelah kiri layar anda.
                            </li>
                        </ul>
                    </div>
                </div>
                <!-- profil -->
                <div class="row">
                    <div class="col">
                        <h4>Profil</h4>
                        <ul>
                            <li>
                                Anda dapat melihat profil anda dengan menekan tombol <i class="fas fa-user"></i> yang berada menu di sebelah kiri layar anda.
                            </li>
                            <li>
                                Anda juga dapat mengubah data profil anda pada halaman ini, data yang dapat anda ubah antara lain:
                                <ul>
                                    <li>
                                        nama
                                    </li>
                                    <li>
                                        foto
                                    </li>
                                    <li>
                                        password
                                    </li>
                                </ul>
                            </li>
                        </ul>
                    </div>
                </div>
                <!-- kritik dan saran -->
                <div class="row">
                    <div class="col">
                        <h4>Kritik dan Saran</h4>
                        <ul>
                            <li>
                                Pada menu ini anda dapat melihat daftar kritik dan saran yang diberikan oleh pengguna kantin.
                            </li>
                            <li>
                                Untuk dapat mengakses halaman ini, anda dapat menekan tombol <i class="fas fa-comment"></i> yang terdapat pada menu di sebelah kiri layar anda.
                            </li>
                        </ul>
                    </div>
                </div>
                <!-- informasi -->
                <div class="row">
                    <div class="col">
                        <h4>Informasi</h4>
                        <ul>
                            <li>
                                Jika anda mengalami kendala dalam mengoperasikan anda dapat melihat informasi yang dapat anda dapatkan melalui aplikasi ini, dengan cara menekan tombol <i class="fas fa-info"></i> yang berada pada menu di sebelah kiri layar anda.
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        <!-- ./card-body -->
        </div>
    </div>
</div>

<?= $this->endSection(); ?>