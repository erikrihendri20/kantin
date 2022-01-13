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

function load_transaction() {
    $.get('/Penjual/Dashboard/getTransaction' , (data) => {
        data.rating = 0
        data.total_price = 0
        groups = []
        data.transaction.map( transaction => {
          data.rating += Number(transaction.transaction_rating)
          menu = data.transaction_menu.filter( menu_item => transaction.id==menu_item.transaction_id )
          subtotal_price=0
  
          menu.map(item => {
            
            toping = data.transaction_toping.filter( toping => item.transaction_menu_id == toping.transaction_menu_id )
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
          data.total_price += Number(transaction.total_price)
  
          // date
          const date = transaction.updated_at.split(' ')[0]
          if (!groups[date]) {
              groups[date] = 0;
          }
  
          groups[date] += Number(transaction.total_price)

          // Object.keys(menu).map((date) => {
          //   data.groups.push(date)
          //   data.group_price.push(groups[date])
          // });

        } )
        data.groups = []
        data.group_price = []
        Object.keys(groups).map((date) => {
            data.groups.push(date)
            data.group_price.push(groups[date])
        });
        data.rating = data.rating/data.transaction.length
        render_dashboard(data)
    })
}

function render_dashboard(data) {
    // render agregat transaction
    $('#transaction-aggregate').html(data.transaction.length)
    // render count menu
    $('#menu-aggregate').html(data.menu.length)
    // render aggregate rating
    $('#rating-aggregate').html(data.rating)
    // render aggregate income
    $('#income-aggregate').html(formatRupiah(data.total_price.toString(),'Rp'))

    // render transaction line-chart
    render_line_chart(data)
}

var chart_option = {
    maintainAspectRatio : false,
    responsive : true,
    legend: {
      display: false
    },
    scales: {
      xAxes: [{
        gridLines : {
          display : false,
        }
      }],
      yAxes: [{
        gridLines : {
          display : false,
        }
      }]
    }
}


var data_transaction = {
    labels  : [],
    datasets: [
      {
        label               : 'Data penjualan',
        backgroundColor     : 'rgba(60,141,188,0.9)',
        borderColor         : 'rgba(60,141,188,0.8)',
        pointRadius          : true,
        pointColor          : '#3b8bba',
        pointStrokeColor    : 'rgba(60,141,188,1)',
        pointHighlightFill  : '#fff',
        pointHighlightStroke: 'rgba(60,141,188,1)',
        data                : []
      },
    ]
}

var transaction_line_chart_canvas = $('#transaction-line-cart').get(0).getContext('2d')
var transaction_line_chart_option = $.extend(true, {}, chart_option)
var transaction_line_chart_data = $.extend(true, {}, data_transaction)
transaction_line_chart_data.datasets[0].fill = false;
transaction_line_chart_option.datasetFill = false;

var transaction_line_chart = new Chart(transaction_line_chart_canvas, {
      type: 'line',
      data: transaction_line_chart_data,
      options: transaction_line_chart_option
})

function render_line_chart(data) {
    globalThis.transaction_line_chart.data.labels = data.groups
    globalThis.transaction_line_chart.data.datasets[0].data = data.group_price
    globalThis.transaction_line_chart.update()
    console.log('asdasd')
    // data_transaction_line_chart.labels = data.groups
    // data_transaction_line_chart.datasets.data = data.group_price

}

$(document).ready( () => {
    load_transaction()
} )