  <!-- /.content-wrapper -->
  <footer class="main-footer">
    <strong>Copyright &copy; 2021 <a href="<?= base_url(); ?>">Kantin STIS</a>.</strong>
    All rights reserved.
    <!-- <div class="float-right d-none d-sm-inline-block">
      <b>Version</b> 3.1.0
    </div> -->
  </footer>

  <!-- Control Sidebar -->
  <aside class="control-sidebar control-sidebar-dark">
    <!-- Control sidebar content goes here -->
  </aside>
  <!-- /.control-sidebar -->
</div>
<!-- ./wrapper -->

<!-- jQuery -->
<script src="<?= base_url('assets/admin-lte/plugins/jquery/jquery.min.js'); ?>"></script>
<!-- jQuery UI 1.11.4 -->
<script src="<?= base_url('assets/admin-lte/plugins/jquery-ui/jquery-ui.min.js'); ?>"></script>
<!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
<script>
  $.widget.bridge('uibutton', $.ui.button)
</script>
<!-- Bootstrap 4 -->
<script src="<?= base_url('assets/admin-lte/plugins/bootstrap/js/bootstrap.bundle.min.js'); ?>"></script>
<!-- overlayScrollbars -->
<script src="<?= base_url('assets/admin-lte/plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js'); ?>"></script>
<!-- AdminLTE App -->
<script src="<?= base_url('assets/admin-lte/dist/js/adminlte.js'); ?>"></script>



<!-- data table -->
<script src="<?= base_url('assets/admin-lte/plugins/datatables/jquery.dataTables.min.js'); ?>"></script>
<script src="<?= base_url('assets/admin-lte/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js'); ?>"></script>
<script src="<?= base_url('assets/admin-lte/plugins/datatables-responsive/js/dataTables.responsive.min.js'); ?>"></script>
<script src="<?= base_url('assets/admin-lte/plugins/datatables-responsive/js/responsive.bootstrap4.min.js'); ?>"></script>
<script src="<?= base_url('assets/admin-lte/plugins/datatables-buttons/js/dataTables.buttons.min.js'); ?>"></script>
<script src="<?= base_url('assets/admin-lte/plugins/datatables-buttons/js/buttons.bootstrap4.min.js'); ?>"></script>
<script src="<?= base_url('assets/admin-lte/plugins/jszip/jszip.min.js'); ?>"></script>
<script src="<?= base_url('assets/admin-lte/plugins/pdfmake/pdfmake.min.js'); ?>"></script>
<script src="<?= base_url('assets/admin-lte/plugins/pdfmake/vfs_fonts.js'); ?>"></script>
<script src="<?= base_url('assets/admin-lte/plugins/datatables-buttons/js/buttons.html5.min.js'); ?>"></script>
<script src="<?= base_url('assets/admin-lte/plugins/datatables-buttons/js/buttons.print.min.js'); ?>"></script>
<script src="<?= base_url('assets/admin-lte/plugins/datatables-buttons/js/buttons.colVis.min.js'); ?>"></script>

<!-- AdminLTE for demo purposes -->
<!-- <script src="<?= base_url('assets/admin-lte/dist/js/demo.js'); ?>"></script> -->
<!-- AdminLTE dashboard demo (This is only for demo purposes) -->
<!-- <script src="<?= base_url('assets/admin-lte/dist/js/pages/dashboard.js'); ?>"></script> -->

<!-- sweetalert -->
<script src="<?= base_url('assets/sweetalert2/dist/sweetalert2.all.min.js'); ?>"></script>

<!-- myscript -->
<script src="<?= base_url('assets/scripts/index.js')?>"></script>
<script src="<?= base_url('assets/scripts') . '/' . $scripts; ?>.js"></script>
</body>
</html>
