tax_code = 0



async function load_cart() {
    $.get(
        '/Pembeli/Order/getCartTotal',
        (data) => {
            data['subtotal_price'] = 0
            data['menu_transaction'].map( menu => {
                data['subtotal_price']+=menu['transaction_menu_price']*menu['count']
                topings = data['toping_transaction'].filter( toping => menu.transaction_menu_id == toping.transaction_menu_id)
                menu['toping'] = topings
                topings.forEach( toping => {
                    data['subtotal_price']+= Number(toping.price)*Number(menu.count)
                } )
            })
            if(data['subtotal_price']<10000){
                data['tax'] = 0
                tax_code = 0
            }else if(data['subtotal_price']<20000){
                data['tax'] = 500
                tax_code = 1
            }else{
                data['tax'] = 1000
                tax_code = 2
            }
            render_cart(data)
        }
    )
}

function render_cart(data) {
    menu = ''
    data['menu_transaction'].map( item => {
        topings = ``
        toping_price = 0
        
        item['toping'].map( toping => {
            topings += `<li class="list-group-item custom-background-toping py-1 px-2 toping-item list-item-toping">${toping.name} <span class="text-muted toping-item">(Rp${toping.price})</span></li>`
        } )
        card_toping = `
            <div class="card card-menu my-0 custom-background-toping-header">
                <!-- /.card-header -->
                <div class="card-header card-menu py-1 px-2 custom-background-toping">
                    <h5 class="card-title toping-item"><i class="fas fa-candy-cane"></i> Toping</h5>

                    <div class="card-tools toping-item">
                    <button type="button" class="btn btn-tool toping-item mr-3" data-card-widget="collapse">
                        <i class="fas fa-minus"></i>
                    </button>
                    </div>
                </div>
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

        menu += `
            <div class="dropdown-item navbar-cart-item custom-background-cart mb-1">
                <!-- Message Start -->
                <div class="media">
                    <img src="/assets/img/menu/${item.photo}" class="img-size-50 mr-3 img-circle">
                    <div class="media-body">
                        <h3 class="dropdown-item-title">
                        ${item.name}<span class="text-sm text-muted">(${item.count} pcs)</span>
                        </h3>
                        <p class="text-sm mb-1">Total Harga: Rp${(Number(item.transaction_menu_price) + Number(toping_price))*item.count} </p>
                        
                        ${(topings) ? card_toping : ''}
                    </div>
                </div>
                <!-- Message End -->
            </div>
        `
    } )

    $('#detail-order').html(menu)
    if(data['subtotal_price']==0){
        window.location.href = '/Pembeli/Pesan'
    }

    $('#nominal-price-total').html(`Rp.${Number(data['subtotal_price']) + Number(data['tax'])}`)
    $('#price-total').html(`Rp.${Number(data['subtotal_price']) + Number(data['tax'])}`)
    $('#price-tax').html(`Rp.${data['tax']}`)
    $('#price-subtotal-order').html(`Rp.${data['subtotal_price']}`)
}

async function pay() {
    
}

$(document).ready( () => {
    load_cart()
    pay()
})