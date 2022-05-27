$("#dev-user-table").DataTable({
  "responsive": false, "lengthChange": true, "autoWidth": false,
}).buttons().container().appendTo('#dev-user-table_wrapper .col-md-6:eq(0)');




$('.delete-button').click((e) => {
  dev_user_id = $(e.target).data('id')
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
      window.location.href = '/Admin/User/deleteDevUser/' + dev_user_id
    }else{
      return false
    }
      
  })
})




// $(document).ready(function() {
//   load_dev_user()


// })

// function load_dev_user() {
//   $.get('/Admin/User/getDevUsers', (data) => {
//     render_table(data)
//   })


// }

// function render_table(data) {
//   thead = `
//       <thead>
//           <tr>
//               <th>No</th>
//               <th>Nama</th>
//               <th>Email</th>
//               <th>Role</th>
//               <th>Aksi</th>
//           </tr>
//       </thead>
//   `
//   tr = ``
//   data.map((dev_user, i) => {
//     tr += `
//         <tr>
//             <td>${i+1}</td>
//             <td>${dev_user.name}</td>
//             <td>${dev_user.email}</td>
//             <td>${dev_user.role}</td>
//             <td>
//               <a href="/Admin/User/detailDevUser/${dev_user.id}" class="badge badge-warning delete-button" style="border: none;">detail</a>
//               <button class="badge badge-danger delete-button" style="border: none;" data-id="${dev_user.id}">hapus</button>
//               <button type="button" class="badge badge-success" style="border:none;" data-toggle="modal" data-target="#editModal${dev_user.id}">edit</button>

//               <div class="modal fade" id="editModal${dev_user.id}" tabindex="-1" aria-labelledby="editModal${dev_user.id}Label" aria-hidden="true">
//                   <div class="modal-dialog">
//                       <div class="modal-content">
//                       <div class="modal-header">
//                           <h5 class="modal-title" id="editModal${dev_user.id}Label">Daftar API Key</h5>
//                           <button type="button" class="close" data-dismiss="modal" aria-label="Close">
//                           <span aria-hidden="true">&times;</span>
//                           </button>
//                       </div>
//                       <form action="/Admin/User/editDevUser/${dev_user.id}" method="POST">
//                           <div class="modal-body">
//                               <div class="form-group">
//                                   <input value="${dev_user.name}" type="text" name="name" class="form-control" id="formGroupExampleInput" placeholder="Nama">
//                               </div>
//                               <div class="form-group">
//                                   <select id="inputState" class="form-control" name="role">
//                                       <option value="">Role</option>
//                                       <option ${(dev_user.role==1) ? 'selected' : ''} value="1">Pengguna</option>
//                                       <option ${(dev_user.role==2) ? 'selected' : ''} value="2">Admin</option>
//                                   </select>
//                               </div>
//                               <div class="form-group">
//                                   <input value="${dev_user.email}" type="email" name="email" class="form-control" id="formGroupExampleInput" placeholder="email">
//                               </div>
//                           </div>
//                           <div class="modal-footer">
//                               <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
//                               <button type="submit" name="submit" class="btn btn-primary">Simpan</button>
//                           </div>
//                           </div>
//                       </form>
//                   </div>
//               </div>
//             </td>
//         </tr>
//     `
//   })
//   table = `
//       <table class="table table-bordered table-hover" id="dev-user-table">
//           ${thead}
//           <tbody>
//               ${tr}
//           </tbody>
//       </table>
//   `

//   $('#div-table').html(table)

//   $("#dev-user-table").DataTable({
//     "responsive": true, "lengthChange": false, "autoWidth": false,
//     "buttons": ["csv", "excel" , "pdf"]
//   }).buttons().container().appendTo('#dev-user-table_wrapper .col-md-6:eq(0)');

//   $('.delete-button').click((e) => {
//     dev_user_id = $(e.target).data('id')
//     Swal.fire({
//         title: 'Apakah anda yakin?',
//         text: "Anda tidak akan dapat mengembalikan data ini!",
//         icon: 'warning',
//         showCancelButton: true,
//         confirmButtonColor: '#3085d6',
//         cancelButtonColor: '#d33',
//         confirmButtonText: 'Ya, hapus!'
//     }).then((result) => {
//         $.get('/Admin/User/deleteDevUser/'+dev_user_id, (data) => {
//           Swal.fire(
//             'Terhapus!',
//             'Data anda telah terhapus.',
//             'success'
//           )
//           load_dev_user()
//         }).fail((err) => {
//           Swal.fire(
//             'Gagal!',
//             'Data anda gagal terhapus.',
//             'error'
//           )
//         })
//     })
//   })
// }