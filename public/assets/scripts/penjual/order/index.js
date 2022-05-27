var data_compare = {}

function load_transaction() {
    // status_filter = $('#status').val()
    $.get('/Penjual/Order/getTransaction',
    {
        keyword : $('#navbar-search').val()
    },
    (data) => {
        const result = data
        if(JSON.stringify(globalThis.data_compare)===JSON.stringify(result)){
            return false
        }
        globalThis.data_compare=result
        render_transaction(data)
    })
}

// function say() {
//     var msg = new SpeechSynthesisUtterance('Hello World');
//     window.speechSynthesis.speak(msg);
// }

// $(document).ready(() => {
//     say()
//     console.log()
// })

function render_transaction(data) {
    transactions = ''

    data['transaction'].map( (transaction , i) => {
        total_price=0
        menu = data['menu'].filter( menu_item => transaction.id==menu_item.transaction_id )
        menu_html = ''
        
        menu.map(item => {
            toping = data['toping'].filter( toping => item.transaction_menu_id == toping.transaction_menu_id )
            total_toping_price = 0
            topings = ``
            toping.map(toping => {
                total_toping_price += Number(toping.price)
                topings += `<li class="list-group-item custom-background-toping py-1 px-2 toping-item list-item-toping">${toping.name} <span class="text-muted toping-item">(Rp${toping.price})</span> ${(transaction['status']==2) ? '<i class="delete-toping far fa-trash-alt float-right text-danger" data-id="'+toping['id']+'" data-name="'+toping['name']+'"></i>' : ''}</li>`
            });
            

            total_price += (Number(total_toping_price)+Number(item.transaction_menu_price))*Number(item.count)
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
                        <img src="/assets/img/menu/${item.photo}" class="img-size-50 mr-3 img-circle">
                        <div class="media-body">
                            <h3 class="dropdown-item-title">
                            ${item.name}<span class="text-sm text-muted">(${item.count} pcs)</span>
                            </h3>
                            <p class="text-sm mb-0">Harga <span>Rp${item.transaction_menu_price}</span></p>
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
                    <button type="button" data-id="${transaction.id}" data-name="${transaction.name}" class="custom-badge accept-order badge badge-primary ml-2 mb-2" >Terima Pesanan</button>
                    <button type="button" data-id="${transaction.id}" data-name="${transaction.name}" class="custom-badge cancle-order badge badge-danger mb-2" >Tolak Pesanan</button>
                `
                break;
            case '3':
                status_transaction = `
                    <p class="mx-2 my-0">Status: pesanan sedang disiapkan <i class="fas fa-spinner text-warning"></i><p>
                    <button type="button" data-id="${transaction.id}" data-name="${transaction.name}" class="custom-badge serve-order badge badge-warning mx-2 mb-2" >Pesanan siap</button>
                    <button type="button" data-id="${transaction.id}" data-name="${transaction.name}" class="custom-badge cancle-order badge badge-danger mb-2" >Batalkan Pesanan</button>
                `
                break;
                
            default:
                break;
        }
        transactions += `
        
            <div class="row">
                <div class="col">
                    <div class="card card-light card-menu">
                    <!-- /.card-header -->
                    <div class="card-header card-menu">
                        <h5 class="card-title"><i class="fas fa-clipboard"></i> ${transaction.id}</h5>
            
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
                                    : ${transaction.name}
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
                                <div class="row">
                                    <div class="col">
                                        <div class="form-group mb-0" >
                                <textarea class="form-control textarea-noted" readonly name="${transaction.id}"  id="tidak ada catatan" placeholder="no noted" name="noted" rows="2">${transaction.noted}</textarea>
                            </div>
                                    </div>
                                <!-- /.col -->
                                </div>
                                    <tr>
                                        <td id="label-total-order">total Pesanan</td>
                                        <td id="price-total-order" class="price price-total-order text-danger" data-price="0" id>Rp${total_price}</td>
                                    </tr>
                                    <tr>
                                        <td id="label-total-order" colspan="2" class="p-0">${(transaction.order_option==1) ? '<span class="text-primary">Bungkus</span>' : '<span class="text-warning">Makan di Tempat</span>'}</td>
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
    // if(JSON.stringify(globalThis.data_compare)===JSON.stringify(data)){
    //     return false
    // }
    // globalThis.data_compare=data
    $('#waiting-list').html(transactions)
    $('.cancle-order').click( (e) => {
        Swal.fire({
            title: 'Apakah kamu yakin?',
            text: `membatalkan pesanan ${$(e.target).data('name')}!`,
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Ya, batalkan',
            cancelButtonText: 'Tidak',
        }).then((result) => {
            if (result.isConfirmed) {
                $.post('/Penjual/Order/cancleOrder',
                {
                    transaction_id : $(e.target).data('id')
                },
                (data) => {
                    Swal.fire({
                        icon: 'success',
                        title: 'Berhasil!',
                        text: `Pesanan ${$(e.target).data('name')} dibatalkan`
                    })
                }).done( (e) => {
                    load_transaction()
                })
            }
        })
    } )
    $('.accept-order').click( (e) => {
        Swal.fire({
            title: 'Apakah kamu yakin?',
            text: `menerima pesanan ${$(e.target).data('name')}!`,
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Ya, terima',
            cancelButtonText: 'Tidak',
        }).then((result) => {
            if (result.isConfirmed) {
                $.post('/Penjual/Order/acceptOrder',
                {
                    transaction_id : $(e.target).data('id')
                },
                (data) => {
                    Swal.fire({
                        icon: 'success',
                        title: 'Berhasil!',
                        text: `Pesanan ${$(e.target).data('name')} diterima`
                    })
                }).fail( (xhr) => {
                    Swal.fire({
                        icon: 'error',
                        title: 'Gagal!',
                        text: 'tidak dapat menerima pesanan'
                    })
                } ).done( (e) => {
                    load_transaction()
                })
            }
        })
    } )
    $('.serve-order').click( (e) => {
        Swal.fire({
            title: 'Apakah kamu yakin?',
            text: `menyajikan pesanan ${$(e.target).data('name')}!`,
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Ya, hidangkan',
            cancelButtonText: 'Tidak',
        }).then((result) => {
            if (result.isConfirmed) {
                $.post('/Penjual/Order/serveOrder',
                {
                    transaction_id : $(e.target).data('id')
                },
                (data) => {
                    Swal.fire({
                        icon: 'success',
                        title: 'Berhasil!',
                        text: `Pesanan ${$(e.target).data('name')} sudah siap`
                    })
                }).fail( (xhr) => {
                    Swal.fire({
                        icon: 'error',
                        title: 'Gagal!',
                        text: 'tidak dapat menyelesaikan pesanan'
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
            confirmButtonText: 'Ya, hapus',
            cancelButtonText: 'Tidak',
        }).then((result) => {
            if (result.isConfirmed) {
                $.post(
                    '/Penjual/Order/updateToping' ,
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
        5000
    )
}

function filter() {
    // $('status').change( () => {
    //     load_transaction()
    // })
    $('#navbar-search').change(() => {
        load_transaction()
    })
}

$(document).ready( (data) => {
    load_transaction()
    refresh_order()
    auto_refresh()
    filter()
} )