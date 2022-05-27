<?= $this->extend('templates/user/index') ?>

<?= $this->section('content') ?>
<div class="row">
  <div class="col">
      <div class="form-group">
        <select name="filter-date" class="form-control" id="filter-date">
          <option value="1">Semua</option>
          <option value="2">Hari ini</option>
          <option selected value="3">Seminggu terakhir</option>
          <option value="4">Sebulan terakhir</option>
        </select>
      </div>
  </div>
</div>

<div class="row">
  <div class="col-12 col-sm-6 col-md-3">
    <div class="info-box">
      <span class="info-box-icon bg-info elevation-1"><i class="fas fa-store-alt"></i></span>

      <div class="info-box-content">
        <span class="info-box-text">Jumlah Tenan</span>
        <span class="info-box-number" id="tenant-aggregate">
          0
        </span>
      </div>
      <!-- /.info-box-content -->
    </div>
    <!-- /.info-box -->
  </div>
  <!-- /.col -->
  <div class="col-12 col-sm-6 col-md-3">
    <div class="info-box mb-3">
      <span class="info-box-icon bg-danger elevation-1"><i class="fas fa-user-tag"></i></span>

      <div class="info-box-content">
        <span class="info-box-text">Jumlah Pembeli</span>
        <span class="info-box-number" id="customer-aggregate">0</span>
      </div>
      <!-- /.info-box-content -->
    </div>
    <!-- /.info-box -->
  </div>
  
  <!-- /.col -->

  <!-- fix for small devices only -->
  <div class="clearfix hidden-md-up"></div>

  <div class="col-12 col-sm-6 col-md-3">
    <div class="info-box mb-3">
      <span class="info-box-icon bg-warning elevation-1"><i class="fas fa-handshake"></i></span>

      <div class="info-box-content">
        <span class="info-box-text">Transaksi</span>
        <span class="info-box-number" id="transaction-aggregate">0</span>
      </div>
      <!-- /.info-box-content -->
    </div>
    <!-- /.info-box -->
  </div>

  <!-- /.col -->
  <div class="col-12 col-sm-6 col-md-3">
    <div class="info-box mb-3">
      <span class="info-box-icon bg-success elevation-1"><i class="fas fa-dollar-sign"></i></span>

      <div class="info-box-content">
        <span class="info-box-text">Pendapatan</span>
        <span class="info-box-number" id="income-aggregate">0</span>
      </div>
      <!-- /.info-box-content -->
    </div>
    <!-- /.info-box -->
  </div>
  
  <!-- /.col -->
</div>
<!-- /.row -->

<div class="row">
  <div class="col">
    <div class="card">
      <div class="card-header">
        <h5 class="card-title">Rekapitulasi Penjualan</h5>

        <div class="card-tools">
          <button type="button" class="btn btn-tool" data-card-widget="collapse">
            <i class="fas fa-minus"></i>
          </button>
          <button type="button" class="btn btn-tool" data-card-widget="remove">
            <i class="fas fa-times"></i>
          </button>
        </div>
      </div>
      <!-- /.card-header -->
      <div class="card-body">
        <div class="row">
          <div class="col">
            <p class="text-center">
              <strong id="title-bar-chart">Penjualan:</strong>
            </p>

            <div class="chart">
              <!-- Sales Chart Canvas -->
              <canvas id="transaction-bar-chart" height="180" style="height: 180px;"></canvas>
            </div>
            <!-- /.chart-responsive -->
          </div>
          <!-- /.col -->
          
          <!-- /.col -->
        </div>
        <!-- /.row -->
      </div>
      <!-- ./card-body -->
      <div class="card-footer">
        
        <!-- /.row -->
      </div>
      <!-- /.card-footer -->
    </div>
    <!-- /.card -->
  </div>
  <!-- /.col -->
</div>
<!-- /.row -->

<div class="row">
  <div class="col-md-6">

    <!-- TABLE: LATEST ORDERS -->
    <div class="card">
      <div class="card-header border-transparent">
        <h3 class="card-title">Rating Menu</h3>

        <div class="card-tools">
          <button type="button" class="btn btn-tool" data-card-widget="collapse">
            <i class="fas fa-minus"></i>
          </button>
          <button type="button" class="btn btn-tool" data-card-widget="remove">
            <i class="fas fa-times"></i>
          </button>
        </div>
      </div>
      <!-- /.card-header -->
      <div class="card-body ">
        <div class="chart" style="height: 250px;">
          <!-- Sales Chart Canvas -->
          <canvas id="pie-cart-rating"></canvas>
        </div>
        <!-- /.table-responsive -->
      </div>
      <!-- /.card-footer -->
    </div>
    <!-- /.card -->
  </div>
  <div class="col-md-6">
    <div class="card">
      <div class="card-header border-transparent">
        <h3 class="card-title">Menu Yang Banyak Dipesan</h3>

        <div class="card-tools">
          <button type="button" class="btn btn-tool" data-card-widget="collapse">
            <i class="fas fa-minus"></i>
          </button>
          <button type="button" class="btn btn-tool" data-card-widget="remove">
            <i class="fas fa-times"></i>
          </button>
        </div>
      </div>
      <!-- /.card-header -->
      <div class="card-body">
        <div class="" id="fav-order" style="height: 250px; overflow-y: auto;" >
      
          
        </div>
        <!-- /.table-responsive -->
      </div>
      <!-- /.card-footer -->
    </div>    
  </div>
</div>

<!-- Main row -->
<div class="row">
  <!-- Left col -->
  <div class="col">

    <!-- TABLE: LATEST ORDERS -->
    <div class="card">
      <div class="card-header border-transparent">
        <h3 class="card-title">Pemesanan Terakhir</h3>

        <div class="card-tools">
          <button type="button" class="btn btn-tool" data-card-widget="collapse">
            <i class="fas fa-minus"></i>
          </button>
          <button type="button" class="btn btn-tool" data-card-widget="remove">
            <i class="fas fa-times"></i>
          </button>
        </div>
      </div>
      <!-- /.card-header -->
      <div class="card-body py-0">
        <div class="table-responsive" id="lates-order-div">
          
        </div>
        <!-- /.table-responsive -->
      </div>
      <!-- /.card-body -->
      <div class="card-footer clearfix">
        <a href="<?= base_url('Penjual/HistoryTransaction'); ?>" class="btn btn-sm btn-secondary float-right">View All Orders</a>
      </div>
      <!-- /.card-footer -->
    </div>
    <!-- /.card -->
  </div>
  <!-- /.col -->

  
  
  <!-- /.col -->


</div>

<?= $this->endSection(); ?>



