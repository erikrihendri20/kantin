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
        price = (menu.count) ? ((menu.count!=0) ? menu.price*menu.count : menu.price)  : menu.price
        $('#daftar-menu').append(`
            <div class="col-12">
                <div class="card ${(menu.count)? 'bg-warning' : ''}" id="card-${menu.menu_id}">
                    <div class="row">
                        <div class="col-3 d-flex justify-content-center align-self-center">
                            <img class="card-img-top img-menu" src="/assets/img/menu/${menu.photo}" alt="Card image cap">
                        </div>
                        <div class="col-9 ">
                            <div class="card-body">
                                <h5 class="card-title font-weight-bold text-uppercase">${(menu.menu_name.length>20) ? menu.menu_name.slice(0,20) + '..' : menu.menu_name}<small class="text-muted">*4.6</small></h5>
                                <br>
                                <p class="card-text my-0">${(menu.description.length>50) ? menu.description.slice(0,50) + '..' : menu.description}</p>
                                <p class="card-text font-weight-bold my-0">${menu.kantin_name}</p>
                                <p class="card-text font-weight-bold my-0" id="price-${menu.menu_id}" data-price="${menu.price}">${formatRupiah(price.toString() , 'Rp')}</p>
                                <button class="quantity-menu-minus btn btn-danger" data-id="${menu.menu_id}">-</button>
                                <input type="text" class="quantity-menu-input" readonly data-id="${menu.menu_id}" id="quantity-menu-input-${menu.menu_id}" value="${(menu.count) ? menu.count : 0}"></input>
                                <button class="quantity-menu-plus btn btn-success" data-id="${menu.menu_id}">+</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>`
        )
    });
    // button quantity
    change_quantity()
}

function change_background(menu_id , color) {
    $('#card-'+menu_id).attr('class' , `card bg-${color}`)
}

function cart(menu_id , status , count) {
    $.post(
        '/Pembeli/Pesan/addCart',
        {
            menu_id:menu_id,
            status:status,
            count:count
        },
        (data) => {
            cart_total()
        }
    )
}


function change_quantity() {
    $('.quantity-menu-plus').click( (e) => {
        menu_id = $(e.target).data('id')
        val = $('#quantity-menu-input-'+menu_id).val()
        $('#quantity-menu-input-'+menu_id).val(parseInt(val)+1)
        new_price = (parseInt(val)+1)*$('#price-'+menu_id).data('price')
        $('#price-'+menu_id).html(formatRupiah(new_price.toString() , 'Rp'))
        cart(menu_id , 1 , $('#quantity-menu-input-'+menu_id).val())
        if(val==0){
            change_background(menu_id,'warning')
        }
    } )

    $('.quantity-menu-minus').click( (e) => {
        menu_id = $(e.target).data('id')
        val = $('#quantity-menu-input-'+menu_id).val()
        if(val>0){
            $('#quantity-menu-input-'+menu_id).val(parseInt(val)-1)
            new_price = (val!=1) ? (parseInt(val)-1)*$('#price-'+menu_id).data('price') : $('#price-'+menu_id).data('price') 
            $('#price-'+menu_id).html(formatRupiah(new_price.toString() , 'Rp'))
            cart(menu_id , 1 , $('#quantity-menu-input-'+menu_id).val())
            if(val==1){
                change_background(menu_id,'light')
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

function pagin(keyword=null) {
    $.get(
        `/Pembeli/Pesan/getPaginMenu` , 
        {keyword},
        (data_length) => {
            per_page_length = 10
            pagin_length = Math.ceil(data_length/per_page_length)
            position = ($('.pagin-active').children().data('id')) ? $('.pagin-active').children().data('id') : 1
            li = `<li class="page-item active pagin-active"><button class="page-link pagin-number" data-id="1" id="1">1</button></li>`
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

function load_menu(keyword=null , limit , indeks) {

    $.get(
        `/Pembeli/Pesan/getMenu`,
        {keyword , limit:limit , indeks:indeks},
        (data) => {
            $.get('/Pembeli/Pesan/getMenuTransaction' , 
                (transaction) => {
                    transaction.forEach( (t) => {
                        try {
                            data.find( (d) => d.menu_id==t.menu_id ).status = 1
                            data.find( (d) => d.menu_id==t.menu_id ).count = t.count
                        } catch (error) {
                            
                        }
                    } )
                    // render menu
                    // pagin(data)
                    render_menu(data)
                    
                }
            )
            
        }
        
    )
}


function cart_total() {
    $.get(
        `/Pembeli/Pesan/getCartTotal`,
        (data) => {
            (data.total_menu) ? $('#cart-total').attr('class' , 'btn btn-primary buy-button text-dark py-2 px-2') : $('#cart-total').attr('class' , 'btn btn-secondary buy-button text-dark py-2 px-2')
            total_menu = (data.total_menu) ? data.total_menu : 0
            price_total = formatRupiah((data.total_price) ? data.total_price.toString() : '0','Rp')
            $('#cart-total-price').html(`${ total_menu } Item | ${price_total}`)
            $('#cart-navbar').html((total_menu != 0) ? total_menu : '')
        }
    )
}

$(document).ready( () => {
    pagin()
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
    cart_total()

    $('#cart-total').click( (e) => {
        $.get(
            `/Pembeli/Pesan/getCartTotal`,
            (data) => {
                if(data.total_price){
                    document.location.href= '/Pembeli/Pesan/cart'
                }else{
                    
                    Swal.fire(
                        'Gagal!',
                        `keranjang masih kosong.`,
                        'warning'
                    )
                }

            }
        )
    })

    $('#button-cart-navbar').click( (e) =>{
        $.get(
            `/Pembeli/Pesan/getCartTotal`,
            (data) => {
                if(data.total_price){
                    document.location.href= '/Pembeli/Pesan/cart'
                }else{
                    Swal.fire(
                        'Gagal!',
                        `keranjang masih kosong.`,
                        'warning'
                    )
                }
            }
        )   
    })
})