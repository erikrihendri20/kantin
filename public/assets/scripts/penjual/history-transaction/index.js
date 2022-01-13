function load_transaction() {
    $.get('/Penjual/HistoryTransaction/getTransaction',
    {
        'start-date' : $('#start-date').val(),
        'end-date' : $('#end-date').val(),
    },
    (data) => {
        data['transaction'].map( (transaction , i) => {
            menu = data['menu'].filter( menu_item => transaction.id==menu_item.transaction_id )
    
            subtotal_price=0
            menu.map(item => {
                toping = data['toping'].filter( toping => item.transaction_menu_id == toping.transaction_menu_id )
                // item['toping'] = toping
                total_toping_price = 0
                toping.map(toping => {
                    total_toping_price += Number(toping.price)
                });
                subtotal_menu_price = (Number(total_toping_price)+Number(item.transaction_menu_price))*Number(item.count)
                subtotal_price += subtotal_menu_price
            });
            transaction['subtotal_price'] = subtotal_price
            transaction['tax'] = (subtotal_price<10000) ? 0 : ((subtotal_price<20000) ? 500 : 1000)
            transaction['total_price'] = subtotal_price+transaction['tax']
        })
        render_table(data['transaction'])
    })
}

function render_table(data) {
    thead = `
        <thead>
            <tr>
                <th>No</th>
                <th>Pembeli</th>
                <th>Status</th>
                <th>Subtotal Harga</th>
                <th>Pajak</th>
                <th>Total Harga</th>
                <th>Tanggal</th>
            </tr>
        </thead>
    `
    tr = ``
    data.map( (transaction , i) => {
        tr += `
            <tr>
                <td>${i+1}</td>
                <td>${transaction.name}</td>
                <td>${(transaction.status==5)?'berhasil':'dibatalkan'}</td>
                <td>${transaction.subtotal_price}</td>
                <td>${transaction.tax}</td>
                <td>${transaction.total_price}</td>
                <td>${transaction.updated_at}</td>
            </tr>
        `
    })
    table = `
        <table class="table table-bordered table-hover" id="history-transaction-table">
            ${thead}
            <tbody>
                ${tr}
            </tbody>
        </table>
    `

    $('#history-transaction').html(table)

    $("#history-transaction-table").DataTable({
        "responsive": true, "lengthChange": false, "autoWidth": false,
        "buttons": ["csv", "excel"]
      }).buttons().container().appendTo('#history-transaction-table_wrapper .col-md-6:eq(0)');
    // $('#history-transaction-table').DataTable({
    //     "paging": true,
    //     "lengthChange": false,
    //     "searching": false,
    //     "ordering": true,
    //     "info": true,
    //     "autoWidth": false,
    //     "responsive": true,
    // });
}

function filter_date() {
    $('.filter-date').change( (e) => {
        load_transaction()
    })
}

$(document).ready( () => {
    filter_date()
    load_transaction()
} )