var data_compare = {}

function load_transaction() {
    $.get('/Pembeli/WaitingList/getMenu',
    (data) => {
        render_transaction(data)
    })
}

function render_transaction(data) {
    transactions = ''
    data['transaction'].map( (transaction , i) => {
        menu = data['menu'].filter( menu_item => transaction.id==menu_item.transaction_id )
        menu_html = ''
        diff = transaction.time_estimate - diffTwoTime(new Date(transaction.updated_at), new Date()).min
        total_price=0
        menu.map(item => {
            toping = data['toping'].filter( toping => item.transaction_menu_id == toping.transaction_menu_id )
            item['toping'] = toping
            item['total_toping_price'] = 0
            toping.map(toping => {
                item['total_toping_price'] += Number(toping.price)
            });
            subtotal_menu_price = (Number(item.total_toping_price)+Number(item.transaction_menu_price))*Number(item.count)
            total_price += subtotal_menu_price

            topings = ``
            
            item['toping'].map( toping => {
                topings += `<li class="list-group-item custom-background-toping py-1 px-2 toping-item list-item-toping">${toping.name} <span class="text-muted toping-item">(Rp${toping.price})</span> ${(transaction['status']==2) ? '<i class="delete-toping far fa-trash-alt float-right text-danger" data-id="'+toping['id']+'" data-name="'+toping['name']+'"></i>' : ''}</li> `
            } )

            card_toping = `
                <div class="card my-0 custom-background-toping-header">
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
                        <img src="/assets/img/menu/${item.photo}" class="img-size-50 mr-3 img-circle">
                        <div class="media-body">
                            <h3 class="dropdown-item-title">
                            ${item.name}<span class="text-sm text-muted">(${item.count} pcs)</span>
                            </h3>
                            <p class="text-sm mb-0">Harga : <span>${item.transaction_menu_price}</span></p>
                            ${(topings) ? card_toping : ''}
                        </div>
                    </div>
                    <!-- Message End -->
                </div>
            `
        });
        status_transaction = ''
        switch (transaction['status']) {
            case '2':
                status_transaction = `
                    <p class="mx-2 my-0">Status: menunggu antrian <i class="far fa-clock text-secondary"></i><p>
                    <button type="button" data-id="${transaction.id}" data-name="${transaction.user_name}" class="custom-badge cancle-order badge badge-danger mx-2 mb-2" >Batalkan Pesanan</button>
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
                `
                break;
            default:
                break;
        }
        transactions += `
            <div class="row" id="${transaction.id}">
                <div class="col">
                    <div class="card card-secondary">
                    <!-- /.card-header -->
                    <div class="card-header">
                        <h5 class="card-title"><i class="fas fa-clipboard"></i> Kode Orderan - ${transaction.id}</h5>
            
                        <div class="card-tools">
                        <button type="button" class="btn btn-tool" data-card-widget="collapse">
                            <i class="fas fa-minus"></i>
                        </button>
                        </div>
                    </div>
                    <div class="card-body px-0 bg-light py-0">  
                        <table class="ml-3">
                            <tr>
                                <td>
                                    Nama
                                </td>
                                <td>
                                    : ${(transaction.canteen_name) ? transaction.canteen_name : transaction.user_name}
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    Email
                                </td>
                                <td>
                                    : ${transaction.email}
                                </td>
                            </tr>
                        </table>
                        ${menu_html}
                        
                        <div class="mx-2">
                            <table id="price-table">
                                <tbody >
                                    <tr>
                                        <td id="label-subtotal-order">Perkiraan Waktu</td>
                                        <td id="price-subtotal-order" class="price price-subtotal-order" data-price="0" id>${(diff > 0) ? diff + ' menit' : "-"}</td>
                                    </tr>
                                    <tr>
                                        <td id="label-subtotal-order">Subtotal Pesanan</td>
                                        <td id="price-subtotal-order" class="price price-subtotal-order" data-price="0" id>Rp${total_price}</td>
                                    </tr>
                                    <tr>
                                        <td id="label-subtotal-order" colspan="2">${(transaction.order_option==1) ? '<span class="text-primary">Bungkus</span>' : '<span class="text-warning">Makan di Tempat</span>'}</td>
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
    $('#waiting-list').html(transactions)
    $('.cancle-order').click( (e) => {
        Swal.fire({
            title: 'Apakah kamu yakin?',
            text: `membatalkan pembelian di kedai ${$(e.target).data('name')}!`,
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Ya, batalkan',
            cancelButtonText: 'Tidak',
        }).then((result) => {
            if (result.isConfirmed) {
                $.post('/Pembeli/WaitingList/cancleOrder',
                {
                    transaction_id : $(e.target).data('id')
                },
                (data) => {
                    Swal.fire({
                        icon: 'success',
                        title: 'Berhasil!',
                        text: `Pesanan di kedai ${$(e.target).data('name')} dibatalkan`
                    })
                }).fail( (xhr) => {
                    Swal.fire({
                        icon: 'error',
                        title: 'Gagal!',
                        text: `Pesanan di kedai ${$(e.target).data('name')} tidak dapat dibatalkan`,
                        footer: `silahkan pergi ke kedai ${$(e.target).data('name')} untuk membatalkan pesanan`
                    })
                } ).done( (e) => {
                    load_transaction()
                })
            }
        })
    } )
    $('.delete-toping').click( (e) => {
        Swal.fire({
            title: 'Apakah kamu yakin?',
            text: `menghapus toping ${$(e.target).data('name')}!`,
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Ya, batalkan',
            cancelButtonText: 'Tidak',
        }).then((result) => {
            if (result.isConfirmed) {
                $.post(
                    '/Pembeli/WaitingList/updateToping' ,
                    {
                        id:$(e.target).data('id')
                    },
                    (data) => {
                        Swal.fire({
                            icon: 'success',
                            title: 'Berhasil!',
                            text: `Toping ${$(e.target).data('name')} dibatalkan`
                        })
                    }
                )
            }
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
        10000
    )
}

$(document).ready( (data) => {
    load_transaction()
    refresh_order()
    auto_refresh()
} )