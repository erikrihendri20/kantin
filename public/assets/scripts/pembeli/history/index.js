var data_compare = {}

function load_transaction() {
    $.get('/Pembeli/History/getMenu',
    init_date_filter($('#filter-date').val()),
    (data) => {
        render_transaction(data)
    })
}

function render_transaction(data) {
    transactions = ''
    data['transaction'].map( (transaction , i) => {

        menu = data['menu'].filter( menu_item => transaction.id==menu_item.transaction_id )
        
        menu_html = ''


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
                topings += `<li class="list-group-item custom-background-toping py-1 px-2 toping-item list-item-toping">${toping.name} <span class="text-muted toping-item">(Rp${toping.price})</span></li> `
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

        transactions += `
            <div class="row">
                <div class="col">
                    <div class="card card-${(transaction.status==5) ? 'success' : 'secondary'}">
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
                        ${menu_html}
                        <div class="mx-2">
                            <table id="price-table">
                                <tbody >
                                    <tr>
                                        <td id="label-subtotal-order">Subtotal Pesanan</td>
                                        <td id="price-subtotal-order" class="price price-subtotal-order" data-price="0" id>Rp${total_price}</td>
                                    </tr>
                                    <tr>
                                        <td id="label-subtotal-order"><p class="mb-0">Status: ${(transaction.status==5) ? 'Berhasil<i class="far fa-check-circle text-success"></i>' : 'Gagal<i class="fas fa-ban text-danger"></i>'}</p></td>
                                        ${(!transaction.rating&&transaction.status!=9) ? '<td id="price-subtotal-order" class="price price-subtotal-order pt-0" data-price="0" id><a class="badge badge-primary rating" data-id="'+transaction.id+'">Beri rating</a></td>' : ''}
                                    </tr>
                                </tbody>
                            </table>
                        </div>
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
    $('#history').html(transactions)
    $('#history').append(`
            <div class="modal" id="modal" tabindex="-1" role="dialog" aria-labelledby="modalLabel" aria-hidden="true" style="display: none;">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modalLabel">Rating Menu dan Kantin</h5>
                    <button type="button" class="close" id="close-modal" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col text-warning d-flex justify-content-center">
                            <div class="star" style="display: inline-block;">
                                <i class="far fa-star one dash" id="dash-1" style="display: inline-block;"></i>
                                <i class="fas fa-star one solid" id="solid-1" style="display: none;"></i>
                
                                <i class="far fa-star two dash" id="dash-2" style="display: inline-block;"></i>
                                <i class="fas fa-star two solid" id="solid-2" style="display: none;"></i>
                
                                <i class="far fa-star three dash" id="dash-3" style="display: inline-block;"></i>
                                <i class="fas fa-star three solid" id="solid-3" style="display: none;"></i>
                
                                <i class="far fa-star four dash" id="dash-4" style="display: inline-block;"></i>
                                <i class="fas fa-star four solid" id="solid-4" style="display: none;"></i>
                
                                <i class="far fa-star five dash" id="dash-5" style="display: inline-block;"></i>
                                <i class="fas fa-star five solid" id="solid-5" style="display: none;"></i>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col">
                            <div class="form-group">
                                <textarea class="form-control" id="comment" placeholder="masukan"></textarea>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" id="save-rating" class="btn btn-primary">Beri Bintang</button>
                </div>
                </div>
            </div>
            </div>
    `)
    dashs = $('i.dash')
    solids = $('i.solid')

    $('.rating').click((e) => {
        $('#modal').css('display','block')
        $('#save-rating').data('val',null)
        for (let i = 0; i < solids.length; i++) {
            $(solids[i]).css('display','none')
            $(dashs[i]).css('display','inline-block')
        }
        $('#save-rating').data('id',$(e.target).data('id'))
        $('#comment').val('')
    })
    
    for (let i = 0; i < dashs.length; i++) {
        $(dashs[i]).click( (e) => {
            $('#save-rating').data('val',i+1)
            for (let j = 0; j <= i; j++) {
                $(solids[j]).css('display','inline-block')
            }
            for (let k = 0; k <= i; k++) {
                $(dashs[k]).css('display','none')
            }
        } )
    }
    for (let i = 0; i < solids.length; i++) {
        $(solids[i]).click( (e) => {
            $('#save-rating').data('val',i+1)
            for (let j = i+1; j <= solids.length; j++) {
                $(dashs[j]).css('display','inline-block')
            }
            for (let j = i+1; j <= dashs.length; j++) {
                $(solids[j]).css('display','none')
            }
        } )
    }

    $('#close-modal').click( () => {
        $('#modal').css('display' , 'none')
    })
    
    $('#save-rating').click(e => {
        transaction_id = $(e.target).data('id')
        val = $(e.target).data('val')
        comment = $('#comment').val()
        $.post(
            `/Pembeli/History/rating`,
            {transaction_id,val,comment},
            (data) => {
                console.log(data)
                load_transaction()
                $('#modal').css('display' , 'none')
            }
        )
    })

}

function refresh_history() {
    $('#refresh-button').click( (e) => {
        load_transaction()
    } )
}

function init_date_filter(param) {
    const timeStamp = new Date().getTime();
    if(param==2){
      end_date = new Date()
      start_date = new Date(timeStamp - (24 * 60 * 60 * 1000))
    }else if(param==3){
      end_date = new Date()
      start_date = new Date(timeStamp - (7 * 24 * 60 * 60 * 1000))
    }else if(param==4){
      end_date = new Date()
      start_date = new Date(timeStamp - (30 * 24 * 60 * 60 * 1000))
    }else{
      end_date = ''
      start_date = ''
      return {
        'start-date':start_date,
        'end-date':end_date,
        'status':$('#status').val()
      }
    }
    return {
      'start-date' : start_date.getFullYear()+'-'+(start_date.getMonth()+1)+'-'+start_date.getDate(),
      'end-date' : end_date.getFullYear()+'-'+(end_date.getMonth()+1)+'-'+end_date.getDate(),
      'status' : $('#status').val()
    }
}

$(document).ready( (data) => {
    init_date_filter(3)
    $('#filter-date').change(() => {
        load_transaction()
    })
    $('#status').change(() => {
        load_transaction()
    })
    load_transaction()
    refresh_history()
} )