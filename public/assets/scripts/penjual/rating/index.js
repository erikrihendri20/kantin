$("#rating-table").DataTable({
  "responsive": false, "lengthChange": false, "autoWidth": false,
  // "buttons": ["csv", "excel" , "pdf"]
}).buttons().container().appendTo('#rating-table_wrapper .col-md-6:eq(0)');