function formatRupiah(angka, prefix) {
    var number_string = angka.replace(/[^,\d]/g, '').toString(),
        split = number_string.split(','),
        sisa = split[0].length % 3,
        rupiah = split[0].substr(0, sisa),
        ribuan = split[0].substr(sisa).match(/\d{3}/gi)
    if (ribuan) {
        separator = sisa ? '.' : '';
        rupiah += separator + ribuan.join('.')
    }
    rupiah = split[1] != undefined ? rupiah + ',' + split[1] : rupiah;
    return prefix == undefined ? rupiah : (rupiah ? 'Rp. ' + rupiah : '')
}

function getParamStand() {
    queryString = window.location.search
    urlParams = new URLSearchParams(queryString)
    return urlParams.get('stand')
}

function render_menu(data) {
    $('#daftar-menu').html('')
    data.forEach(menu => {
        toping = ``
        menu['toping'].forEach(t => {
            toping+=`
            <li class="list-group-item my-0 py-0 bg-transparent">
                <input type="checkbox" id="toping-${t.id}" class="toping menu-id-${menu.menu_id}" ${(t['checked'] ? 'checked' : '')} data-menu_id="${t['menu_id']}" data-toping_id="${t['id']}" value="option1">
                <label for="toping-${t.id}">${t['name']} <small>(${t.price})</small></label>
            </li>`
        })
        price = (menu.count) ? ((menu.count!=0) ? menu.price*menu.count : menu.price)  : menu.price
        $('#daftar-menu').append(`
            <div class="col-12">
                <div class="card ${(menu.count)? 'bg-info' : ''}" id="card-${menu.menu_id}">
                    <div class="row">
                        <div class="col-3 d-flex justify-content-center align-self-center">
                            <img class="card-img-top img-menu" src="/assets/img/menu/${menu.photo}" alt="Card image cap">
                        </div>
                        <div class="col-9 ">
                            <div class="card-body">
                                <h5 class="card-title font-weight-bold text-uppercase">${(menu.menu_name.length>20) ? menu.menu_name.slice(0,20) + '..' : menu.menu_name}<small class="text-muted">*4.6</small></h5>
                                <br>
                                <p class="card-text my-0">${(menu.description.length>50) ? menu.description.slice(0,50) + '..' : menu.description}</p>
                                
                                <p class="card-text font-weight-bold my-0" id="price-${menu.menu_id}" data-price="${menu.price}">${formatRupiah(price.toString() , 'Rp')}</p>
                                <button type="button" class="quantity-menu-minus btn btn-danger" data-id="${menu.menu_id}">-</button>
                                <input type="text" class="quantity-menu-input" readonly data-id="${menu.menu_id}" id="quantity-menu-input-${menu.menu_id}" value="${(menu.count) ? menu.count : 0}"></input>
                                <button type="button" class="quantity-menu-plus btn btn-success" data-id="${menu.menu_id}">+</button>
                            </div>
                            <ul class="list-group list-group-flush" id="list-toping-${menu.menu_id}" style="display:${(!menu.count)?'none':''}" >
                                ${toping}
                            </ul>
                        </div>
                    </div>
                </div>
            </div>`
        )
    })
    if(data.length==0){
        $('#daftar-menu').html('<div>menu tidak ditemukan</div>')
    }

    $('.toping').change( (e) => {
        value = $(e.target).prop('checked')
        menu_id = $(e.target).data('menu_id')
        toping_id = $(e.target).data('toping_id')
        canteen_id = getParamStand()
        update_toping(canteen_id , menu_id , toping_id , value)
    })
    change_quantity()
    // $('.quantity-menu-input').change( (e) => {
    //     checkout(data)
    // } )
}

function update_toping(canteen_id , menu_id , toping_id , value){
    $.post(
        '/Pembeli/Order/updateToping' , 
        {
            canteen_id,
            menu_id, 
            toping_id,
            value
        },
        (data) => {
            load_cart()
        }
    )
}

function change_background(menu_id , color) {
    $('#card-'+menu_id).attr('class' , `card bg-${color}`)

}

function cart(menu_id , count) {
    $.post(
        '/Pembeli/Order/updateCart',
        {
            menu_id:menu_id,
            count:count,
            canteen_id:canteen_id
        },
        (data) => {
            load_cart()
        }
    ).fail(function(xhr, status, error) {
        if(xhr.responseJSON.messages.error=='different canteen'){
            Swal.fire({
                title: 'Berganti Kedai!',
                text: "Apakah anda yakin akan ingin berganti kedai?",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Ganti',
                cancelButtonText: 'Batal'
              }).then((result) => {
                if (result.isConfirmed) {
                    $.post(
                        '/Pembeli/Order/updateCart',
                        {
                            menu_id:menu_id,
                            count:count,
                            canteen_id:canteen_id,
                            change_canteen:true
                        },
                        (data) => {
                            load_cart()
                        }
                    )
                  Swal.fire(
                    'Berhasil',
                    'Berganti Kedai',
                    'success'
                  )
                }
            })
        }
    })
}

function change_quantity() {
    $('.quantity-menu-plus').click( (e) => {
        menu_id = $(e.target).data('id')
        val = $('#quantity-menu-input-'+menu_id).val()
        $('#quantity-menu-input-'+menu_id).val(parseInt(val)+1)
        new_price = (parseInt(val)+1)*$('#price-'+menu_id).data('price')
        $('#price-'+menu_id).html(formatRupiah(new_price.toString() , 'Rp'))
        cart(menu_id , $('#quantity-menu-input-'+menu_id).val())
        if(val==0){
            change_background(menu_id,'info')
            $(`#list-toping-${menu_id}`).css('display','block')
        }
    } )

    $('.quantity-menu-minus').click( (e) => {
        menu_id = $(e.target).data('id')
        val = $('#quantity-menu-input-'+menu_id).val()
        if(val>0){
            $('#quantity-menu-input-'+menu_id).val(parseInt(val)-1)
            new_price = (val!=1) ? (parseInt(val)-1)*$('#price-'+menu_id).data('price') : $('#price-'+menu_id).data('price') 
            $('#price-'+menu_id).html(formatRupiah(new_price.toString() , 'Rp'))
            cart(menu_id , $('#quantity-menu-input-'+menu_id).val())
            if(val==1){
                change_background(menu_id,'light')
                $(`#list-toping-${menu_id}`).css('display','none')
                $(`.menu-id-${menu_id}`).prop('checked', false)
            }
        }
    } )
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

async function pagin(keyword=null) {
    canteen_id = getParamStand()


    $.get(
        `/Pembeli/Order/getPaginMenu` , 
        {keyword , canteen_id},
        (data_length) => {
            per_page_length = 10
            pagin_length = Math.ceil(data_length/per_page_length)
            position = ($('.pagin-active').children().data('id')) ? $('.pagin-active').children().data('id') : 1
            if(pagin_length>1){
                li = `<li class="page-item active pagin-active"><button class="page-link pagin-number" data-id="1" id="1">1</button></li>`
            }else{
                li =``
            }

            for (let i = 2; i <= pagin_length; i++) {
                li += `<li class="page-item"><button type="button" class="page-link pagin-number" data-id="${i}" id="${i}">${i}</button></li>`
            }
            $('#ul-pagin').html(`
                <li class="page-item"><button type="button" class="page-link" id="prev"><</button></li>
                <li class="page-item"><button type="button" class="page-link" id="prev-first">..</button></li>
                ${li}
                <li class="page-item"><button type="button" class="page-link" id="next-last">..</button></li>
                <li class="page-item"><button type="button" class="page-link" id="next">></button></li>
            `)
            
            manage_pagin(position , pagin_length)
            $('.pagin-number').click( (e) => {
                $('.page-item , active').attr('class' , 'page-item' )
                $(e.target).parent().attr('class' , 'page-item active pagin-active')
                position = ($('.pagin-active').children().data('id')) ? $('.pagin-active').children().data('id') : 1
                load_menu(keyword , canteen_id , per_page_length , (position-1)*per_page_length)
                manage_pagin(position , pagin_length)
            } )
            $('#prev').click( (e) => {
                target = parseInt($('.pagin-active').children().attr('id'))
                if(target>1){
                    $('.page-item , active').attr('class' , 'page-item' )
                    $(`#${target-1}`).parent().attr('class' , 'page-item active pagin-active')
                    load_menu(keyword , canteen_id , per_page_length , (target-2)*per_page_length)
                    manage_pagin(target-1 , pagin_length)
                }
            } )
            $('#next').click( (e) => {
                target = parseInt($('.pagin-active').children().attr('id'))
                if(target<pagin_length){
                    $('.page-item , active').attr('class' , 'page-item' )
                    $(`#${target+1}`).parent().attr('class' , 'page-item active pagin-active')
                    load_menu(keyword , canteen_id , per_page_length , (target)*per_page_length)
                    manage_pagin(target+1 , pagin_length)
                }
            } )

            $('#prev-first').click( (e) => {
                    $('.page-item , active').attr('class' , 'page-item' )
                    $(`#1`).parent().attr('class' , 'page-item active pagin-active')
                    load_menu(keyword , canteen_id , per_page_length , 0)
                    manage_pagin(1 , pagin_length)
            } )
            $('#next-last').click( (e) => {
                    $('.page-item , active').attr('class' , 'page-item' )
                    $(`#${pagin_length}`).parent().attr('class' , 'page-item active pagin-active')
                    load_menu(keyword , canteen_id , per_page_length , (pagin_length-1)*per_page_length)
                    manage_pagin(pagin_length , pagin_length)
            } )

            load_menu(keyword , canteen_id , per_page_length , (position-1)*per_page_length)
        })
}

async function load_menu(keyword=null , canteen_id , limit , indeks) {
    
    
    $.get(
        `/Pembeli/Order/getMenu`,
        {keyword , canteen_id , limit:limit , indeks:indeks},
        (data) => {

            data['toping'].map((val) => {
                toping_transaction = data['toping_transaction'].find( (toping_transaction) => val.id==toping_transaction.toping_id )
                if(toping_transaction){
                    val['checked'] = true
                }
            })

            data['menu'].forEach((val,i) => {
                toping = data['toping'].filter( toping => val.menu_id==toping.menu_id )
                val['toping'] = toping

                menu_transaction = data['menu_transaction'].find( menu_transaction => val.menu_id == menu_transaction.menu_id )
                if(menu_transaction){
                    val['count'] = menu_transaction['count']
                }
            })

            render_menu(data['menu'])
        } 
        
    )
}

async function load_cart() {
    $.get(
        '/Pembeli/Order/getCartTotal',
        (data) => {
            data['count'] = data['menu_transaction'].length
            if(data.count>0){
                $('#footer-cart').attr('type' , 'submit')
                $('#footer-cart-count').removeClass('bg-secondary')
                $('#footer-cart-count').addClass('bg-info')
            }else{
                $('#footer-cart').attr('type' , 'button')
                $('#footer-cart-count').removeClass('bg-info')
                $('#footer-cart-count').addClass('bg-secondary')
            }
            data['total_price'] = 0
            data['menu_transaction'].map( menu => {
                data['total_price']+=menu['transaction_menu_price']*menu['count']
                topings = data['toping_transaction'].filter( toping => menu.transaction_menu_id == toping.transaction_menu_id)
                topings.forEach( toping => {
                    data['total_price']+= Number(toping.price)*Number(menu.count)
                } )
            })
            render_cart(data)
            // checkout(data)
        }
    )
}

function render_cart(data){
    
    
    
    item = ``
    
    data['menu_transaction'].forEach( (menu , i) => {
        item += `
            <a href="#card-${menu.menu_id}" class="dropdown-item navbar-cart-item">
                <!-- Message Start -->
                <div class="media">
                <img src="/assets/img/menu/${menu.photo}" alt="User Avatar" class="img-size-50 mr-3 img-circle">
                <div class="media-body">
                    <h3 class="dropdown-item-title">
                    ${menu.name}
                    </h3>
                    <p class="text-sm">Harga: ${menu.transaction_menu_price}</p>
                    <p class="text-sm text-muted">Jumlah: ${menu.count}</p>
                </div>
                </div>
                <!-- Message End -->
            </a>
        `
    })
    
    $('#navbar-cart').html(`
        ${item}
    `)
    if(data['menu_transaction'].length==0){
        $('#navbar-cart').html(`
            <a class="dropdown-item navbar-cart-item">
                <p>keranjang belanjaan kosong</p>
            </a>
        `)
    }

    // $('#view-all-navbar-cart-item').click((e) => {
    //     // e.preventDefault()
    //     $('#navbar-cart-item').css('display','block')
    // })

    $('.navbar-count-cart').html(data['count'])

    
    
    $('#nominal-price-total').html(`Rp.${data.total_price}`)
}

async function search() {
    $('#navbar-search-button').click( () => {
        keyword = $('#navbar-search').val()
        pagin(keyword)
    } )

    $('#navbar-search').keypress( (event) => {
        var keycode = (event.keyCode ? event.keyCode : event.which)
        if(keycode == '13'){
            keyword = $('#navbar-search').val()
            pagin(keyword)
        }
    } )
}

// function checkout(data) {
//     if(data.count>0){
//         $('#footer-cart').attr('type' , 'submit')
//     }else{
//         $('#footer-cart').attr('type' , 'button')
        
//     }
// }

function reset_cart() {
    $('#reset-cart').click( () => {
        $.get('/Pembeli/Order/deleteCart' , 
        (data) => {
        })
    })
}

$(document).ready( () => {
    // init
    pagin()
    search()
    load_cart()
    reset_cart()
})