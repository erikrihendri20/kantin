$("#comment-table").DataTable({
  "responsive": false, "lengthChange": false, "autoWidth": false,
  // "buttons": ["csv", "excel" , "pdf"]
}).buttons().container().appendTo('#comment-table_wrapper .col-md-6:eq(0)');