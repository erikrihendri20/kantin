var data_compare = {}

function load_transaction() {
    $.get('/Pembeli/WaitingList/getMenu',
    (data) => {
        render_transaction(data)
    })
}

bootstrap_color = [
    "primary",
    "secondary",
    "success",
    "danger",
    "warning",
    "info",
    "light",
    "dark",
    "muted",
    "white",
]

function render_transaction(data) {
    transactions = ''

    data['transaction'].map( (transaction , i) => {

        menu = data['menu'].filter( menu_item => transaction.id==menu_item.transaction_id )
        
        
        // transaction['menu'] = menu
        index_color = i%10
        
        menu_html = ''


        subtotal_price=0
        menu.map(item => {
            toping = data['toping'].filter( toping => item.transaction_menu_id == toping.transaction_menu_id )
            item['toping'] = toping
            item['total_toping_price'] = 0
            toping.map(toping => {
                item['total_toping_price'] += Number(toping.price)
            });
            subtotal_menu_price = (Number(item.total_toping_price)+Number(item.transaction_menu_price))*Number(item.count)
            subtotal_price += subtotal_menu_price

            // item['tax'] = (subtotal_price<10000) ? 0 : ((subtotal_price<20000) ? 500 : 1000) 
            // item['total_price'] = Number(subtotal_price)+Number(tax)
            menu_html += `
                <div class="dropdown-item navbar-cart-item custom-background-cart mb-1">
                    <!-- Message Start -->
                    <div class="media">
                        <img src="/assets/img/menu/${item.photo}" class="img-size-50 mr-3 img-circle">
                        <div class="media-body">
                            <h3 class="dropdown-item-title">
                            ${item.name}<span class="text-sm text-muted">(${item.count} pcs)</span>
                            </h3>
                            <p class="text-sm mb-0">Harga : <span class="text-danger">${subtotal_menu_price}</span></p>
                        </div>
                    </div>
                    <!-- Message End -->
                </div>
            `
        });
        tax = (subtotal_price<10000) ? 0 : ((subtotal_price<20000) ? 500 : 1000)
        total_price = subtotal_price+tax

        status_transaction = ''
        switch (transaction['status']) {
            case '2':
                status_transaction = `
                    <p class="mx-2 my-0">Status: menunggu antrian <i class="far fa-clock text-secondary"></i><p>
                    <button type="button" data-id="${transaction.id}" class="custom-badge cancle-order badge badge-danger mx-2 mb-2" >Batalkan Pesanan</button>
                `
                break;
            case '3':
                status_transaction = `
                    <p class="mx-2 my-0">Status: pesanan sedang disiapkan <i class="fas fa-spinner text-warning"></i><p>
                `
                break;
            case '4':
                status_transaction = `
                    <p class="mx-2 my-0">Status: pesanan sudah siap <i class="fas fa-utensils text-primary"></i><p>
                    <button type="button" data-id="${transaction.id}" class="custom-badge take-order badge badge-success mx-2 mb-2" >Terima Pesanan</button>
                `
                break;
            case '5':
                status_transaction = `
                    <p class="mx-2 my-0">Status: pesanan sudah diambil <i class="fas fa-check text-success"></i><p>
                `
                break;
            case '9':
                status_transaction = `
                    <p class="mx-2 my-0">Status: pesanan dibatalkan <i class="fas fa-ban text-danger"></i><p>
                `
                break;
        
            default:
                break;
        }
        transactions += `
            <div class="row">
                <div class="col px-0 ">
                    <div class="card card-${bootstrap_color[index_color]} card-menu">
                    <!-- /.card-header -->
                    <div class="card-header card-menu">
                        <h5 class="card-title"><i class="fas fa-clipboard"></i> Kode Orderan - ${transaction.id}</h5>
            
                        <div class="card-tools">
                        <button type="button" class="btn btn-tool" data-card-widget="collapse">
                            <i class="fas fa-minus"></i>
                        </button>
                        </div>
                    </div>
                    <div class="card-body px-0 bg-light py-0">  
                        ${menu_html}
                        <div class="mx-2">
                            <table id="price-table">
                                <tbody >
                                    <tr>
                                        <td id="label-subtotal-order">Subtotal Pesanan</td>
                                        <td id="price-subtotal-order" class="price price-subtotal-order" data-price="0" id>Rp${subtotal_price}</td>
                                    </tr>

                                    <tr>
                                        <td id="label-tax">Pajak</td>
                                        <td id="price-tax" class="price price-tax" data-price="0" id>Rp${tax}</td>
                                    </tr>

                                    <tr >
                                        <td id="label-total">Total</td>
                                        <td id="price-total" class="price price-total price-total" data-price="0" id>Rp${total_price}</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                        ${status_transaction}
                    </div>
                    <!-- ./card-body -->
                    </div>
                </div>
            </div>
        `

    } )
    if(JSON.stringify(globalThis.data_compare)===JSON.stringify(data)){
        return false
    }
    globalThis.data_compare=data
    $('#waiting-list').html(transactions)
    $('.cancle-order').click( (e) => {
        $.post('/Pembeli/WaitingList/cancleOrder',
        {
            transaction_id : $(e.target).data('id')
        },
        (data) => {
            Swal.fire({
                icon: 'success',
                title: 'Berhasil!',
                text: 'Pesanan dibatalkan'
            })
        }).fail( (xhr) => {
            Swal.fire({
                icon: 'error',
                title: 'Gagal!',
                text: 'Pesanan tidak dapat dibatalkan',
                footer: 'silahkan ke kedai untuk membatalkan'
            })
        } ).done( (e) => {
            load_transaction()

        })
    } )
    $('.take-order').click( (e) => {
        $.post('/Pembeli/WaitingList/takeOrder',
        {
            transaction_id : $(e.target).data('id')
        },
        (data) => {
            Swal.fire({
                icon: 'success',
                title: 'Berhasil!',
                text: 'Pesanan diambil'
            })
        }).fail( (xhr) => {
            Swal.fire({
                icon: 'error',
                title: 'Gagal!',
                text: 'Pesanan sudah diambil',
                footer: 'silahkan ke kedai jika terdapat kesalahan'
            })
        } ).done( (e) => {
            load_transaction()

        })
    } )
    
}

function refresh_order() {
    $('#refresh-button').click( (e) => {
        load_transaction()
    } )
}

function auto_refresh() {
    setInterval((e) => 
        {
            load_transaction()
        },
        1000
    )
}

$(document).ready( (data) => {
    load_transaction()
    refresh_order()
    auto_refresh()
} )