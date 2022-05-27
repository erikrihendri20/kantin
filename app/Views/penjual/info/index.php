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
                <!-- menerima pesanan -->
                <div class="row">
                    <div class="col">
                        <h4>Menerima Pesanan</h4>
                        <ul>
                            <li>
                                Ketika anda masuk ke dalam aplikasi, anda akan langsung diarahkan ke halaman daftar pesanan.
                            </li>
                            <li>
                                Apabila anda tidak diarahkan langsung ke daftar pesanan, anda dapat menekan tombol <i class="fas fa-clipboard-list"></i> pada menu yang berada di sebelah kiri layar.
                            </li>
                            <li>
                                Pada menu ini anda dapat:
                                <ul>
                                    <li>
                                        Melihat daftar menu yang telah dipesan oleh pelanggan.
                                    </li>
                                    <li>
                                        Menerima pesanan pelanggan (mengubah status menjadi <i>diterima</i>).
                                    </li>
                                    <li>
                                        Menolak pesanan pelanggan (mengubah status menjadi <i>dibatalkan</i>).
                                    </li>
                                    <li>
                                        Mengubah status pesanan menjadi <i>diproses</i> (mengubah status menjadi <i>diproses</i>).
                                    </li>
                                    <li>
                                        Mengubah status pesanan menjadi <i>selesai</i> (mengubah status menjadi <i>selesai</i>).
                                    </li>
                                </ul>
                            </li>
                        </ul>
                    </div>
                </div>

                <!-- pembayaran -->
                <div class="row">
                    <div class="col">
                        <h4>Pembayaran</h4>
                        <ul>
                            <li>
                                Anda dapat menekan tombol <i class="fas fa-money-bill"></i> untuk dapat mengakses daftar pelanggan yang sudah dan belum membayar pesanan.
                            </li>
                            <li>
                                Ketika pelanggan sudah mengambil pesanan dan sudah melakukan pembayaran anda dapat mengubah status pesanan menjadi <i>sudah dibayar</i> (mengubah status menjadi <i>sudah dibayar</i>).
                            </li>
                        </ul>
                    </div>
                </div>
                
                <!-- profil kantin -->
                <div class="row">
                    <div class="col">
                        <h4>Profil Kantin (Kantinku)</h4>
                        <ul>
                            <li>
                                Anda dapat menekan tombol <i class="fas fa-cog"></i> untuk dapat mengakses profil kantin. disini anda dapat melihat dan merubah profil kantin anda. Beberapa hal yang dapat anda ubah seperti:
                            </li>
                            <li>
                                Foto profil kantin
                            </li>
                            <li>
                                Deskripsi kantin
                            </li>
                            <li>
                                Status kantin (Buka / Tutup)
                            </li>
                            <li>
                                Jam Buka
                            </li>
                            <li>
                                Jam Tutup
                            </li>
                        </ul>
                    </div>
                </div>

                <!-- daftar menu -->
                <div class="row">
                    <div class="col">
                        <ul>
                            <li>
                                Anda dapat menekan tombol <i class="fas fa-utensils"></i> untuk dapat mengakses daftar menu yang ada di kantin anda.
                            </li>
                            <li>
                                Pada halaman ini anda dapat melihat, menambahkan, mengubah, dan menghapus menu yang ada di kantin anda.
                            </li>
                            <li>
                                Anda juga dapat melihat detail tiap menu dengan menekan tombol <a href="" class="badge badge-warning">detail</a>
                            </li>
                            <li>
                                Setelah menekan tombol <a href="" class="badge badge-warning">detail</a> anda akan diarahkan ke halaman detail menu.
                            </li>
                            <li>
                                Pada halaman detail menu anda dapat melihat informasi lengkap dari menu yang anda pilih sebelumnya. anda juga dapat menambahkan, mengubah, dan menghapus toping tambahan yang ada pada menu yang anda pilih.
                            </li>
                        </ul>
                    </div>
                </div>

                <!-- dashboard penjualan -->
                <div class="row">
                    <div class="col">
                        <h4>Dashboard Penjualan</h4>
                        <ul>
                            <li>
                                Pada halaman ini anda akan disajikan rekapitulasi penjualan kantin anda, pada periode tertentu.
                            </li>
                            <li>
                                Untuk dapat mengakses dashboard penjualan, anda dapat menekan tombol <i class="fas fa-utensils"></i> pada menu yang berada di sebelah kiri layar.
                            </li>
                        </ul>
                    </div>
                </div>

                <!-- riwayat penjualan -->
                <div class="row">
                    <div class="col">
                        <h4>Riwayat Penjualan</h4>
                        <ul>
                            <li>
                                Pada halaman ini anda akan disajikan riwayat penjualan kantin anda, pada periode tertentu.
                            </li>
                            <li>
                                Untuk dapat mengakses riwayat penjualan, anda dapat menekan tombol <i class="fas fa-history"></i> pada menu yang berada di sebelah kiri layar.
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

                <!-- penilaian -->
                <div class="row">
                    <div class="col">
                        <h4>Penilaian</h4>
                        <ul>
                            <li>
                                Pada halaman ini anda dapat melihat penilaian dan juga komentar terhadap transaksi yang sudah dilakukan oleh pelanggan.
                            </li>
                            <li>
                                Untuk dapat mengakses halaman penilaian, anda dapat menekan tombol <i class="fas fa-star"></i> pada menu yang berada di sebelah kiri layar.
                            </li>
                        </ul>
                    </div>
                </div>

                <!-- kritik saran -->
                <div class="row">
                    <div class="col">
                        <h4>Kritik dan Saran</h4>
                        <ul>
                            <li>
                                Jika anda memiliki kritik atau masukan yang ingin anda sampaikan kepada pihak pengelola kantin anda dapat memberikannya pada aplikasi ini.
                            </li>
                            <li>
                                Silahkan tekan tombol <i class="fas fa-comment-dots"></i> yang berada pada menu di sebelah kiri layar anda.
                            </li>
                            <li>
                                Tuliskan kritik dan saran anda.
                            </li>
                            <li>
                                Jika dirasa sudah, silahkan tekan tombol <button class="btn btn-primary">Kirim</button>
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