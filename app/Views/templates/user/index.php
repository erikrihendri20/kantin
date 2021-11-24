<?= $this->include('templates/user/header') ?>
<?= $this->include('templates/user/sidebar') ?>

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0"><?= end($nav)['title']; ?></h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <?php for ($i=0; $i < count($nav) - 1; $i++) : ?>
                <li class="breadcrumb-item"><a href="<?= base_url($nav[$i]['url']); ?>"><?= $nav[$i]['title']; ?></a></li>
              <?php endfor ?>
              <li class="breadcrumb-item active"><?= end($nav)['title'] ?></li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <div class="flash" data-flash="<?= session()->flash; ?>">
        </div>
        <?= $this->renderSection('content'); ?>
      </div>
      <!-- /.container-fluid -->
    </section>
    <!-- /.content -->
</div>

<?= $this->include('templates/user/footer') ?>


