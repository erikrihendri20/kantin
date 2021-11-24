function renderTabelUser(data) {
  head = `<thead>
      <tr>
          <th>No</th>
          <th>Nama</th>
          <th>Email</th>
          <th>Status</th>
          <th>Tindakan</th>
      </tr>
  </thead>`
  row = ``
  no = 1
  data.forEach(d => {
      row += `<tr>
          <td>${no++}</td>
          <td>${d.name}</td>
          <td>${d.email}</td>
          <td>${d.role}</td>
          <td>
            <a type="button" href="/Admin/User/edit/${d.id}" class="badge badge-success my-badge">Edit</a>
            <button type="button" data-id="${d.id}" data-name="${d.name}" class="badge badge-danger delete my-badge">Hapus</button>
          </td>
      </tr>`
  })
  body = `<tbody>${row}</tbody>`
  table = `<table id="tabel_daftar_user" class="table table-bordered table-hover">${head+body}</table>`
  $("#tabel-1").html(table)
}

function loadDataUser() {
  $.get(
      '/Admin/User/getUsers' , 
      (data) => {
          // render tabel
          renderTabelUser(data)
          // delete user
          $('.delete').click( (e) => {
            delete_user({
              id : $(e.target).data('id'),
              name : $(e.target).data('name'),
            })
          } )
          // call data tabel
          $("#tabel_daftar_user").DataTable({
              "lengthChange": false, "autoWidth": false,
              "buttons": ["csv", "excel", "pdf", "print"]
          }).buttons().container().appendTo('#tabel_daftar_user_wrapper .col-md-6:eq(0)');
      }
  )
}

function delete_user(user) {
  Swal.fire({
    title: 'Apakah anda yakin?',
    text: `Menghapus pengguna ${user.name} user tersebut`,
    icon: 'warning',
    showCancelButton: true,
    confirmButtonColor: '#3085d6',
    cancelButtonColor: '#d33',
    confirmButtonText: 'Hapus',
    cancelButtonText: 'Batal'
  }).then((result) => {
    if (result.isConfirmed) {
      $.get('/Admin/User/delete/'+user.id , (data) => {
        Swal.fire(
          'Dihapus!',
          `data pengguna ${data.name} berhasil dihapus.`,
          'success'
        )
        loadDataUser()
      }).fail( () => {
        Swal.fire(
          'Gagal!',
          'data pengguna tidak ditemukan.',
          'warning'
        )
      } )
    }
  })
}

$(document).ready( () => {
    loadDataUser()
})