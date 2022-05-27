<?= $this->extend('templates/dev/index') ?>

<?= $this->section('content') ?>

<div class="row">
    <div class="col">
        <div class="card card-danger">
            <!-- /.card-header -->
                <div class="card-header">
                    <h5 class="card-title">API Documentation</h5>

                    <div class="card-tools">
                    <button type="button" class="btn btn-tool" data-card-widget="collapse">
                        <i class="fas fa-minus"></i>
                    </button>
                    </div>
                </div>
                <div class="card-body" style="overflow-x: auto;">
                    <div class="regist-api">
                        <h3><strong>Daftar API</strong></h3>
                        <hr>
                        <ul>
                            <li>
                                <p>Tekan tombol <i class="fas fa-sign-in-alt"></i> pada menu disamping, atau klik <a href="<?= base_url('Dev/Auth/login'); ?>">daftar</a></p>
                            </li>
                            <li>
                                <p>Login menggunakan akun google yang anda miliki</p>
                            </li>
                            <li>
                                <p>Pilih menu Dashboard</p>
                            </li>
                            <li>
                                <p>Klik tombol <button class="btn btn-primary">Daftar API Key</button> di sisi atas kanan layar</p>
                            </li>
                            <li>
                                <p>Isi kelengkapan formulir Daftar API Key</p>
                            </li>
                            <li>
                                <p>Setelah selesai tombol <button class="btn btn-primary">Simpan</button></p>
                            </li>
                        </ul>
                    </div>
                    
                    <h3><strong>Domain</strong></h3>
                    <hr>
                    <p>Domain ini digunakan untuk mengakses data yang ada di web kantin</p>
                    <div class="bg-dark p-2" id="url">
                        <?= base_url('Dev/Transaction'); ?>
                    </div>
                    <div id="parameter" class="mt-3">
                        <h5><strong>Parameter</strong></h5>
                        <div class="table-div" style="overflow-x: auto;">
                            <table class="table table-bordered table-striped">
                                <thead>
                                    <tr>
                                        <th>Nama</th>
                                        <th>Tipe</th>
                                        <th>Deskripsi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>key</td>
                                        <td>String</td>
                                        <td>Key digunakan untuk mengakses API (klik <a href="<?= base_url("Dev/Auth/login"); ?>">daftar</a> jika anda belum mempunyai API key)</td>
                                    </tr>
                                    <tr>
                                        <td>status</td>
                                        <td>String</td>
                                        <td>Status digunakan untuk mengetahui informasi status transaksi. status transaksi dapat diisi dengan
                                            [1,2,3,4,5,9]
    <pre>1 = menu belum di checkout
    2 = menu sudah di checkout
    3 = menu sedang disiapkan
    4 = menu sudah siap
    5 = transaksi sudah selesai
    9 = pesanan dibatalkan</pre>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>start_date</td>
                                        <td>String</td>
                                        <td>Transaksi akan ditampilkan mulai dari start date (format yyyy-mm-dd, contoh:2021-10-10)</td>
                                    </tr>
                                    <tr>
                                        <td>end_date</td>
                                        <td>String</td>
                                        <td>Transaksi akan ditampilkan sampai end date (format yyyy-mm-dd, contoh:2021-10-10)</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <div class="card mt-3">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-6">
                                    <p>Coba Kirim Request Sederhana Ke Server</p>
                                </div>
                                <div class="col-md-6">
                                    <button type="button" class="btn btn-success float-right" data-toggle="modal" data-target="#requestApi">
                                        <i class="fas fa-code"></i> Coba
                                    </button>
                                    
                                    <!-- Modal -->
                                    <div class="modal fade" id="requestApi" tabindex="-1" aria-labelledby="requestApiLabel" aria-hidden="true">
                                      <div class="modal-dialog">
                                        <div class="modal-content">
                                          <div class="modal-header">
                                            <h5 class="modal-title" id="requestApiLabel">Kirim Request Sederhana</h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                              <span aria-hidden="true">&times;</span>
                                            </button>
                                          </div>
                                          <div class="modal-body">
<p>Domain - Service ini digunakan untuk menampilkan data kantin</p>
<div id="request" class="bg-dark p-2">
    <div class="row">
        <div class="col" id="modals_url">
            <?= base_url('Dev/Transaction'); ?>
        </div>
        <div class="col">
            <i class="fas fa-copy float-right" id="copy_url" style="cursor: pointer;"></i>
        </div>
    </div>
</div>
<form>
  <div class="form-group">
    <label for="status">Status</label>
    <input type="text" class="form-control" id="status">
  </div>
  <div class="form-group">
    <label for="start_date">Start Date</label>
    <input type="text" class="form-control" id="start_date">
  </div>
  <div class="form-group">
    <label for="end_date">End Date</label>
    <input type="text" class="form-control" id="end_date">
  </div>
  <div class="form-group">
    <label for="api_key">Key</label>
    <input type="text" class="form-control" id="api_key">
  </div>
</form>
<p><strong>Output</strong></p>
<div id="response" class="bg-dark p-2">
{}
</div>
                                          </div>
                                          <div class="modal-footer">
                                            <button type="button" id="send-request" class="btn btn-success">Kirim</button>
                                          </div>
                                        </div>
                                      </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div id="success-200" class="mt-3">
                        <h5><strong>Success 200</strong></h5>
                        <div class="table-div" style="overflow-x: auto;">
                            <table class="table table-bordered table-striped">
                                <thead>
                                    <tr>
                                        <th>Nama</th>
                                        <th>Tipe</th>
                                        <th>Deskripsi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>status</td>
                                        <td>String</td>
                                        <td>Status transaksi</td>
                                    </tr>
                                    <tr>
                                        <td>data-availability</td>
                                        <td>String</td>
                                        <td>Informasi ketersediaan data</td>
                                    </tr>
                                    <tr>
                                        <td>data</td>
                                        <td>Object[]</td>
                                        <td>Response Data</td>
                                    </tr>
                                    <tr>
                                        <td>&nbsp;&nbsp;&nbsp;&nbsp;status</td>
                                        <td>String</td>
                                        <td>Status digunakan untuk mengetahui informasi status transaksi. status transaksi dapat diisi dengan
                                            [1,2,3,4,5,9]
    <pre>1 = menu belum di checkout
    2 = menu sudah di checkout
    3 = menu sedang disiapkan
    4 = menu sudah siap
    5 = transaksi sudah selesai
    9 = pesanan dibatalkan</pre>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>&nbsp;&nbsp;&nbsp;&nbsp;date</td>
                                        <td>String</td>
                                        <td>Berisi informasi transaksi terjadi</td>
                                    </tr>
                                    <tr>
                                        <td>&nbsp;&nbsp;&nbsp;&nbsp;pembeli</td>
                                        <td>String</td>
                                        <td>Berisi nama pelanggan yang disamarkan</td>
                                    </tr>
                                    <tr>
                                        <td>&nbsp;&nbsp;&nbsp;&nbsp;menu</td>
                                        <td>Object[]</td>
                                        <td>Kumpulan menu yang dibeli oleh pelanggan</td>
                                    </tr>
                                    <tr>
                                        <td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;nama</td>
                                        <td>String</td>
                                        <td>Nama menu</td>
                                    </tr>
                                    <tr>
                                        <td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;price</td>
                                        <td>String</td>
                                        <td>Harga menu</td>
                                    </tr>
                                    <tr>
                                        <td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;count</td>
                                        <td>String</td>
                                        <td>Jumlah menu</td>
                                    </tr>
                                    <tr>
                                        <td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;toping</td>
                                        <td>Object[]</td>
                                        <td>Toping tambahan yang dipilih oleh pelanggan</td>
                                    </tr>
                                    <tr>
                                        <td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;nama</td>
                                        <td>String</td>
                                        <td>nama toping</td>
                                    </tr>
                                    <tr>
                                        <td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;price</td>
                                        <td>String</td>
                                        <td>harga toping</td>
                                    </tr>


                                </tbody>
                            </table>
                        </div>
                    </div>
                    <div id="success-response" class="mt-3">
                        <h5><strong>Success Response</strong></h5>
                        <div class="bg-dark p-2">
<pre><code class="text-light">{
    "status": 200,
    "data-availability": "available",
    "data": [
        {
            "status": "5",
            "date": "2022-05-22 19:17:30",
            "pembeli": "3294d935e00f537b26b5b5aa3313f00d",
            "menu": [
                {
                    "name": "bebek sinjay",
                    "price": "20000",
                    "count": "2",
                    "toping": [
                        {
                            "toping_name": "extra sambel",
                            "price": "3000"
                        }
                    ]
                },
                {
                    "name": "pecel mediun",
                    "price": "10000",
                    "count": "2",
                    "toping": [
                        {
                            "toping_name": "extra peyek",
                            "price": "2000"
                        }
                    ]
                }
            ]
        }
    ]
}</code></pre>
                        </div>
                    </div>
                    <div id="success-4xx" class="mt-3">
                        <h5><strong>Error 4xx</strong></h5>
                        <div class="table-div" style="overflow-x: auto;">
                            <table class="table table-bordered table-striped">
                                <thead>
                                    <tr>
                                        <th>Nama</th>
                                        <th>Deskripsi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <th>required api_key</th>
                                        <th>membutuhkan parameter api_key untuk mengakses data</th>
                                    </tr>
                                    <tr>
                                        <th>api not found</th>
                                        <th>api tidak ditemukan</th>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <div id="error-response" class="mt-3">
                        <h5><strong>Error Response</strong></h5>
                        <div class="bg-dark p-2">
<pre><code class="text-light">{
    "status":"error",
    "message":"required api_key"
}</code></pre>
                        </div>
                    </div>
                    
                </div>
            <!-- ./card-body -->
        </div>
    </div>
</div>





<?= $this->endSection(); ?>