$("#api-table").DataTable({
  "responsive": false, "lengthChange": true, "autoWidth": false,
}).buttons().container().appendTo('#api-table_wrapper .col-md-6:eq(0)');




$('.delete-button').click((e) => {
  currentUrl = window.location.href
  currentUrl = currentUrl.split('?')[0]
  currentUrl = currentUrl.split('#')[0]
  parm = currentUrl.split('/')
  var dev_user_id = ''
  parm.map((p, i) => {
    if (p == 'devApi') {
      if(parm[i+1] != undefined) {
        dev_user_id = parm[i+1]
      }
    }
  })
  api_key = $(e.target).data('id')
  Swal.fire({
      title: 'Apakah anda yakin?',
      text: "Anda tidak akan dapat mengembalikan data ini!",
      icon: 'warning',
      showCancelButton: true,
      confirmButtonColor: '#3085d6',
      cancelButtonColor: '#d33',
      confirmButtonText: 'Ya, hapus!'
  }).then((result) => {
    if(result.isConfirmed) {
      window.location.href = '/Admin/User/deleteApiKey/' + api_key + '?dev_user_id=' + dev_user_id
    }else{
      return false
    }
  })
})

