async function load_cart() {
    $.get(
        '/Pembeli/Checkout/getMenu',
        (data) => {
            render_cart(data)
        }
    )
}

function render_cart(data) {
    total_price = 0
    transaction_html = ``
    data['transaction'].map(transaction => {
        menu_html = ``
        transaction_total_price = 0
        transaction.time_estimate = 0
        transaction['menu_transaction'] = data['menu_transaction'].filter(menu => transaction.id==menu.transaction_id);
        transaction['menu_transaction'].map( menu => {
            transaction.time_estimate += parseFloat(menu.time_estimate)*menu.count
            transaction_total_price+=menu['transaction_menu_price']*menu.count
            topings = data['toping_transaction'].filter( toping => menu.transaction_menu_id == toping.transaction_menu_id)
            menu['toping'] = topings
            topings.map( toping => {
                transaction_total_price+= Number(toping.price)*Number(menu.count)
            } )
            
            topings = ``
            
            menu['toping'].map( toping => {
                topings += `<li class="list-group-item custom-background-toping py-1 px-2 toping-item list-item-toping">${toping.name} <span class="text-muted toping-item">(Rp${toping.price})</span></li>`
            } )
            card_toping = `
                <div class="card  my-0 custom-background-toping-header">
                    <!-- /.card-header -->
                    
                    <div class="card-body px-0 py-0">
                        <div class="row">
                            <div class="col">
                                <ul class="list-group list-group-flush">
                                ${topings}
                                </ul>
                            </div>
                        <!-- /.col -->
                        </div>
                        <!-- /.row -->
                    </div>
                    <!-- ./card-body -->
                </div>
            `

            menu_html += `
                <div class="dropdown-item navbar-cart-item custom-background-cart mb-1">
                    <!-- Message Start -->
                    <div class="media">
                        <img src="/assets/img/menu/${menu.photo}" class="img-size-50 mr-3 img-circle">
                        <div class="media-body">
                            <h3 class="dropdown-item-title">
                            ${menu.name}<span class="text-sm text-muted">(${menu.count} pcs)</span>
                            </h3>
                            <p class="text-sm mb-1">Harga: Rp${(Number(menu.transaction_menu_price))*menu.count} </p>
                            
                            ${(topings) ? card_toping : ''}
                        </div>
                    </div>
                    <!-- Message End -->
                </div>
            `
        })
        total_price+=transaction_total_price
        // render transaction
        transaction_html+= `
            <div class="card card-secondary mb-0 mt-2">
            <!-- /.card-header -->
            
            <div class="card-body px-0  py-0">
                <div class="row">
                    <div class="col ">
                        <div class="pl-3 bg-secondary">Pesanan Kantin - ${transaction.id}</div>
                    </div>
                <!-- /.col -->
                </div>
                <!-- /.row -->
                <div class="row">
                    <div class="col">
                        ${menu_html}
                        <div class="form-group mb-0" >
                <textarea class="form-control textarea-noted" name="${transaction.id}"  id="noted" placeholder="Contoh format nasi goreng : pedas
jus jambu : tidak pakai es" name="noted" rows="2"></textarea>
            </div>
                    </div>
                <!-- /.col -->
                </div>
                <div class="row">
                    <div class="col mx-2 mt-1 subtotal">
                    <table id="price-table">
                        <tbody  >
                            <tr>
                                <td id="label-subtotal-order">Perkiraan waktu</td>
                                <td id="price-subtotal-order" class="price text-success" data-price="0" id>${transaction.time_estimate} menit</td>
                            </tr>
                            <tr>
                                <td id="label-subtotal-order">Subtotal Pesanan</td>
                                <td id="price-subtotal-order" class="price text-danger" data-price="0" id>Rp${transaction_total_price}</td>
                            </tr>
                            
                        </tbody>
                    </table>
                    </div>
                <!-- /.col -->
                </div>

                <!-- /.row -->
            </div>
            <!-- ./card-body -->
            </div>
        `
    })
    $('#detail-order').html(transaction_html)
    $('#nominal-price-total').html(`Rp${total_price}`)
    $('#order-option').change((e) => {
        $.post('/Pembeli/Checkout/changeOrderOption', {option:($(e.target).prop('checked')) ? 1 : 0} , (data) => {
            if($(e.target).prop('checked')){
                $(e.target).parent().find('label').html('Bungkus')
            }else{
                $(e.target).parent().find('label').html('Makan di tempat')
            }
        })
    })
}

async function pay() {
    
}

$(document).ready( () => {
    load_cart()
    pay()
    $.get('/Pembeli/Checkout/getOrderOption', (data) => {
        if(data.order_option == 1){
            $('#order-option').prop('checked', true)
            $('#order-option').parent().find('label').html('Bungkus')
        }else{
            $('#order-option').prop('checked', false)
            $('#order-option').parent().find('label').html('Makan di tempat')
        }
    })
})