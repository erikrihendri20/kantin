  <!-- /.content-wrapper -->
  <!-- <footer class="main-footer">
    <strong>Copyright &copy; 2021 <a href="<?= base_url(); ?>">Kantin STIS</a>.</strong>
    All rights reserved.

  </footer> -->

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
<?php if(in_array('datatable' , $plugins)): ?>
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
<?php endif ?>
<?php if(in_array('chartjs' , $plugins)): ?>
<script src="<?= base_url('assets/admin-lte/plugins/chart.js/Chart.min.js'); ?>"></script>
<?php endif ?>

<!-- AdminLTE for demo purposes -->
<!-- <script src="<?= base_url('assets/admin-lte/dist/js/demo.js'); ?>"></script> -->
<!-- AdminLTE dashboard demo (This is only for demo purposes) -->
<!-- <script src="<?= base_url('assets/admin-lte/dist/js/pages/dashboard.js'); ?>"></script> -->

<!-- sweetalert -->
<script src="<?= base_url('assets/sweetalert2/dist/sweetalert2.all.min.js'); ?>"></script>

<!-- myscript -->
<script src="<?= base_url('assets/scripts/index.js')?>"></script>
<script src="<?= base_url('assets/scripts') . '/' . $scripts; ?>.js"></script>

<?php if(session()->role==4): ?>
  <script>
    notify = null

    function diffTwoTime(date1, date2) {
        var diff = {}                           // Initialisation du retour
        var tmp = date2 - date1
        tmp = Math.floor(tmp/1000)             // Nombre de secondes entre les 2 dates
        diff.sec = tmp % 60                    // Extraction du nombre de secondes
        tmp = Math.floor((tmp-diff.sec)/60)    // Nombre de minutes (partie entière)
        diff.min = tmp % 60                    // Extraction du nombre de minutes
        tmp = Math.floor((tmp-diff.min)/60)    // Nombre d'heures (entières)
        diff.hour = tmp % 24                   // Extraction du nombre d'heures
        tmp = Math.floor((tmp-diff.hour)/24)   // Nombre de jours restants
        diff.day = tmp
        return diff
    }

    function load_notify(){
      $(document).ready(function() {
        $.get('/Pembeli/Notify/getNotifyPembeli' , (data) => {
          if(JSON.stringify(data)!=JSON.stringify(globalThis.notify)){
            $('#notify-content').html(``);
            globalThis.notify = data
            count = 0;
            data.forEach(n => {
              if(n.status !=1){
  
                count+=Number(n.notify)
                diff = diffTwoTime(new Date(n.updated_at) , new Date())
                if(diff.day>0){
                  time = diff.day + " hari"
                }else if(diff.hour>0){
                  time = diff.hour + " jam"
                }else if(diff.min>0){
                  time = diff.min + " menit"
                }else{
                  time = diff.sec + " detik"
                }
                switch (n.status) {
                  case "1":
                    status = "dalam keranjang"
                    break;
                    
                  case "2":
                    status = "dalam antrian"
                    break;
                    
                  case "3":
                    status = "sedang disiapkan"
                    break;
                    
                  case "4":
                    status = "sudah siap"
                    break;
  
                  case "9":
                    status = "dibatalkan"
                    break;
                    
                  default:
                    status = "pesanan sudah diambil"
                    break;
                }
                $('#notify-content').append(`
                  <a  id="${n.id}" class="dropdown-item ${(n.notify==1) ? 'bg-success' : ''}">
                    <i class="fas fa-envelope mr-2"></i>pesanan ${n.id + " " +status} 
                    <span class="float-right text-muted text-sm">${time}</span>
                  </a>
                `)
                $('#'+n.id).click( () => {
                  $.get('/Pembeli/Notify/setNotify/0/'+n.id , (data) => {
                    if(n.status==5||n.status==9){
                      // console.log(n.id)
                      window.location.href = "/Pembeli/History#"+n.id
                    }else{
                      // console.log(n.id)
                      window.location.href = "/Pembeli/WaitingList#"+n.id
                    }
                  })
                })
              }
            })
            $('#count-notify').html(count)
            $('#count-notify-1').html((count == 0 ) ? 'tidak ada notifikasi terbaru' : 'ada ' + count + ' notifikasi')
          }
        })
      });
    }
    
    load_notify()
    setInterval(load_notify , 5000)
  </script>
<?php endif ?>
</body>
</html>
