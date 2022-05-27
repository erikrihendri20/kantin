$("#api-table").DataTable({
    "responsive": false, "lengthChange": true, "autoWidth": false,
  }).buttons().container().appendTo('#api-table_wrapper .col-md-6:eq(0)');
  
$('.api-copy').click((e) => {
    api_key = $(e.target).data('api_key')
    navigator.clipboard.writeText(api_key);
    Swal.fire({
        icon: 'success',
        title: 'Berhasil Menyalin Api Key',
        text: 'Menyalin papan klip: ' + api_key,
    })
})

$('.delete-button').click((e) => {
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
        window.location.href = '/Dev/Dashboard/deleteApiKey/' + api_key
        }else{
            return false
        }
    })
})
