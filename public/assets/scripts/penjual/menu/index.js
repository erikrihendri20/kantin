function formatRupiah(angka, prefix) {
    var number_string = angka.replace(/[^,\d]/g, '').toString(),
        split = number_string.split(','),
        sisa = split[0].length % 3,
        rupiah = split[0].substr(0, sisa),
        ribuan = split[0].substr(sisa).match(/\d{3}/gi);
    // tambahkan titik jika yang di input sudah menjadi angka ribuan
    if (ribuan) {
        separator = sisa ? '.' : '';
        rupiah += separator + ribuan.join('.');
    }
    rupiah = split[1] != undefined ? rupiah + ',' + split[1] : rupiah;
    return prefix == undefined ? rupiah : (rupiah ? 'Rp. ' + rupiah : '');
}

function render_menu(data) {
    $('#daftar-menu').html('')
    data.forEach(menu => {
        $('#daftar-menu').append(`
            <div class="col-12">
                <div class="card">
                    <div class="row">
                        <div class="col-3 d-flex justify-content-center align-self-center">
                            <img class="card-img-top" src="/assets/img/menu/${menu.photo}" alt="Card image cap">
                        </div>
                        <div class="col-9 ">
                            <div class="card-body">
                                <h5 class="card-title font-weight-bold text-uppercase">${(menu.menu_name.length>20) ? menu.menu_name.slice(0,20) + '..' : menu.menu_name}<small class="text-muted">*4.6</small></h5>
                                <br>
                                <p class="card-text my-0">${(menu.description.length>50) ? menu.description.slice(0,50) + '..' : menu.description}</p>
                                <p class="card-text font-weight-bold my-0">${formatRupiah(menu.price , 'Rp')}</p>
                                <a href="/Penjual/Menu/detail/${menu.id}" class="badge badge-warning my-0" style="border:none">Detail</a>
                                <a href="/Penjual/Menu/edit/${menu.id}" my-0" class="badge badge-success" style="border:none">Edit</a>
                                <button class="badge badge-danger delete my-0" data-id="${menu.id}" data-name="${menu.menu_name}" style="border:none">Hapus</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>`
        )
    });
}


function manage_pagin(position , pagin_length) {
    $('.pagin-number').parent().css('display' , 'none')
    if(position==1){
        for (let i = 1; i <= position+2; i++) {
            $(`#${i}`).parent().css('display' , 'block')
        }
        if(pagin_length>3){
            $('#next-last').parent().css('display' , 'block')
            $('#next').parent().css('display' , 'block')
        }else{
            $('#next-last').parent().css('display' , 'none')
            $('#next').parent().css('display' , 'none')
        }
        $('#prev-first').parent().css('display' , 'none')
        $('#prev').parent().css('display' , 'none')
    }
    else if(position==pagin_length){
        for (let i = pagin_length-2; i <= pagin_length; i++) {
            $(`#${i}`).parent().css('display' , 'block')
        }
        $('#prev-first').parent().css('display' , 'block')
        $('#prev').parent().css('display' , 'block')
        $('#next-last').parent().css('display' , 'none')
        $('#next').parent().css('display' , 'none')
    }
    else if(position>1){
        for (let i = position-1; i < position+2; i++) {
            $(`#${i}`).parent().css('display' , 'block')
        }
        $('#prev-first').parent().css('display' , 'block')
        $('#next-last').parent().css('display' , 'block')
        $('#prev').parent().css('display' , 'block')
        $('#next').parent().css('display' , 'block')
    }
}

function pagin(keyword=null) {
    $.get(
        `/Penjual/Menu/getPaginMenu` , 
        {keyword},
        (data_length) => {
            per_page_length = 10
            pagin_length = Math.ceil(data_length/per_page_length)
            position = ($('.pagin-active').children().data('id')) ? $('.pagin-active').children().data('id') : 1
            if(pagin_length>1){
                li = `<li class="page-item active pagin-active"><button class="page-link pagin-number" data-id="1" id="1">1</button></li>`
            }else{
                li = ``
            }
            for (let i = 2; i <= pagin_length; i++) {
                li += `<li class="page-item"><button class="page-link pagin-number" data-id="${i}" id="${i}">${i}</button></li>`
            }
            $('#ul-pagin').html(`
                <li class="page-item"><button class="page-link" id="prev"><</button></li>
                <li class="page-item"><button class="page-link" id="prev-first">..</button></li>
                ${li}
                <li class="page-item"><button class="page-link" id="next-last">..</button></li>
                <li class="page-item"><button class="page-link" id="next">></button></li>
            `)
            
            manage_pagin(position , pagin_length)
            $('.pagin-number').click( (e) => {
                $('.page-item , active').attr('class' , 'page-item' )
                $(e.target).parent().attr('class' , 'page-item active pagin-active')
                position = ($('.pagin-active').children().data('id')) ? $('.pagin-active').children().data('id') : 1
                load_menu(keyword , per_page_length , (position-1)*per_page_length)
                manage_pagin(position , pagin_length)
            } )
            $('#prev').click( (e) => {
                target = parseInt($('.pagin-active').children().attr('id'))
                if(target>1){
                    $('.page-item , active').attr('class' , 'page-item' )
                    $(`#${target-1}`).parent().attr('class' , 'page-item active pagin-active')
                    load_menu(keyword , per_page_length , (target-2)*per_page_length)
                    manage_pagin(target-1 , pagin_length)
                }
            } )
            $('#next').click( (e) => {
                target = parseInt($('.pagin-active').children().attr('id'))
                if(target<pagin_length){
                    $('.page-item , active').attr('class' , 'page-item' )
                    $(`#${target+1}`).parent().attr('class' , 'page-item active pagin-active')
                    load_menu(keyword , per_page_length , (target)*per_page_length)
                    manage_pagin(target+1 , pagin_length)
                }
            } )

            $('#prev-first').click( (e) => {
                    $('.page-item , active').attr('class' , 'page-item' )
                    $(`#1`).parent().attr('class' , 'page-item active pagin-active')
                    load_menu(keyword , per_page_length , 0)
                    manage_pagin(1 , pagin_length)
            } )
            $('#next-last').click( (e) => {
                    $('.page-item , active').attr('class' , 'page-item' )
                    $(`#${pagin_length}`).parent().attr('class' , 'page-item active pagin-active')
                    load_menu(keyword , per_page_length , (pagin_length-1)*per_page_length)
                    manage_pagin(pagin_length , pagin_length)
            } )

            load_menu(keyword , per_page_length , (position-1)*per_page_length)
        })
}

function delete_menu(data) {
    Swal.fire({
        title: 'Apakah anda yakin?',
        text: `Menghapus menu "${data.name}"`,
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Hapus',
        cancelButtonText: 'Batal'
    }).then((result) => {
        if (result.isConfirmed) {
          $.get('/Penjual/Menu/delete/'+data.id , (data) => {
            Swal.fire(
              'Dihapus!',
              `menu ${data.name} berhasil dihapus.`,
              'success'
            )
            load_menu()
          }).fail( () => {
            Swal.fire(
              'Gagal!',
              'menu tidak ditemukan.',
              'warning'
            )
          } )
        }
    })
}

function load_menu(keyword=null , limit , indeks) {
    $.get(
        `/Penjual/Menu/getMenu` ,
        {keyword : keyword , limit , indeks},  
        (data) => {
            // render menu
            render_menu(data)
            // delete menu
            $('.delete').click( (e) => {
                delete_menu({
                    id : $(e.target).data('id'),
                    name : $(e.target).data('name')
                })
            })
        }
        
    )
}


$(document).ready( () => {
    pagin('')
    $('#navbar-search-button').click( () => {
        keyword = $('#navbar-search').val()
        pagin(keyword)
    } )
    $('#navbar-search').keypress( (event) => {
        var keycode = (event.keyCode ? event.keyCode : event.which);
        if(keycode == '13'){
            keyword = $('#navbar-search').val()
            pagin(keyword)
        }
    } )
})