function load_transaction() {
    $.get('/Penjual/HistoryTransaction/getTransaction',
    init_date_filter($('#filter-date').val()),
    (data) => {
        data['transaction'].map( (transaction , i) => {
            menu = data['menu'].filter( menu_item => transaction.id==menu_item.transaction_id )
            transaction['total_price'] = 0
    
            menu.map(item => {
                toping = data['toping'].filter( toping => item.transaction_menu_id == toping.transaction_menu_id )
                // item['toping'] = toping
                total_toping_price = 0
                toping.map(toping => {
                    total_toping_price += Number(toping.price)
                });
                transaction['total_price'] += (Number(total_toping_price)+Number(item.transaction_menu_price))*Number(item.count)
            });
            
        })
        render_table(data['transaction'])
    })
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
        'end-date':end_date
      }
    }
    return {
      'start-date' : start_date.getFullYear()+'-'+(start_date.getMonth()+1)+'-'+start_date.getDate(),
      'end-date' : end_date.getFullYear()+'-'+(end_date.getMonth()+1)+'-'+end_date.getDate(),
    }
}
  
  // convertmonth
function convert_month(month) {
    if(month=="01"||month=="1"){
      return "Jan"
    }else if(month=="02"||month=="2"){
      return "Feb"
    }else if(month=="03"||month=="3"){
      return "Mar"
    }else if(month=="04"||month=="4"){
      return "Apr"
    }else if(month=="05"||month=="5"){
      return "Mei"
    }else if(month=="06"||month=="6"){
      return "Jun"
    }else if(month=="07"||month=="7"){
      return "Jul"
    }else if(month=="08"||month=="8"){
      return "Ags"
    }else if(month=="09"||month=="9"){
      return "Sep"
    }else if(month=="10"||month=="10"){
      return "Okt"
    }else if(month=="11"||month=="11"){
      return "Nov"
    }else if(month=="12"||month=="12"){
      return "Des"
    }
}

function render_table(data) {
    thead = `
        <thead>
            <tr>
                <th>No</th>
                <th>Pembeli</th>
                <th>Status</th>
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
        "responsive": false, "lengthChange": false, "autoWidth": false,
        "buttons": ["csv", "excel" , "pdf"]
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

// function initDateFilter() {
//     const today = new Date
//     const yesterday = new Date(today)
//     yesterday.setDate(yesterday.getDate()-1)

//     $('#end-date').val(`${today.getFullYear()}-${((today.getMonth())<9) ? '0'+(today.getMonth()+1):(today.getMonth()+1)}-${today.getDate()}`)

//     $('#start-date').val(`${today.getFullYear()}-${((yesterday.getMonth())<9) ? '0'+(yesterday.getMonth()+1):(yesterday.getMonth()+1)}-${yesterday.getDate()}`)

//     $('.filter-date').change(() => {
//         load_transaction()
//     })
// }

$(document).ready( () => {
    $('#filter-date').change(() => {
        load_transaction()
    })
    load_transaction()
} )