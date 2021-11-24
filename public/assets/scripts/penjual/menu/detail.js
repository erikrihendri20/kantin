function render_toping(data) {
    $('#list-toping').html(``)
    data.forEach(toping => {
        $('#list-toping').append(`
            <li class="list-group-item">
                <h5 class="my-0 font-weight-bold text-capitalize">${toping.name}</h5>
                <p class="my-0">Rp.${toping.price}</p>
                <a href="/Penjual/Menu/editToping/${$('#list-toping').data('id')}/${toping.id}" my-0" class="badge badge-success my-0" style="border:none">Edit</a>
                <button class="badge badge-danger delete my-0" data-id="${toping.id}" data-name="${toping.name}" style="border:none">Hapus</button>
            </li>
        `)
    });
}

function delete_toping(data) {
    Swal.fire({
        title: 'Apakah anda yakin?',
        text: `Menghapus toping "${data.name}"`,
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Hapus',
        cancelButtonText: 'Batal'
    }).then((result) => {
        if (result.isConfirmed) {
          $.get('/Penjual/Menu/deleteToping/'+data.id , (data) => {
            Swal.fire(
              'Dihapus!',
              `toping ${data.name} berhasil dihapus.`,
              'success'
            )
            load_toping()
          }).fail( () => {
            Swal.fire(
              'Gagal!',
              'toping tidak ditemukan.',
              'warning'
            )
          } )
        }
    })
}

function load_toping() {
    $.get(
        `/Penjual/Menu/getToping/${$('#list-toping').data('id')}`,
        (data) => {
            render_toping(data)
            $('.delete').click( (e)=> {
                delete_toping({
                    id: $(e.target).data('id'),
                    name: $(e.target).data('name')
                })
            } )
        }
    )
}

$(document).ready( () => {
    load_toping()
})