
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
    return prefix == undefined ? rupiah : (rupiah ? 'Rp' + rupiah : ',00')
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

  var areaChartData = {
    labels  : [],
    datasets: [
      {
        label               : 'Penjualan',
        backgroundColor     : 'rgba(60,141,188,0.9)',
        borderColor         : 'rgba(60,141,188,0.8)',
        pointRadius          : false,
        pointColor          : '#3b8bba',
        pointStrokeColor    : 'rgba(60,141,188,1)',
        pointHighlightFill  : '#fff',
        pointHighlightStroke: 'rgba(60,141,188,1)',
        data                : []
      },
    ]
  }

  var barChartCanvas = $('#transaction-bar-chart').get(0).getContext('2d')
  var barChartData = $.extend(true, {}, areaChartData)
  var temp = areaChartData.datasets[0]
  barChartData.datasets[0] = temp

  var barChartOptions = {
    responsive              : true,
    maintainAspectRatio     : false,
    datasetFill             : false
  }

  income_chart = new Chart(barChartCanvas, {
    type: 'bar',
    data: barChartData,
    options: barChartOptions
  })

  function render_income_chart(data) {
    labels = []
    dataset = []
    data.tenant.map((t) => {
        labels.push(t.name)
        dataset.push(t.total_price)
    })
    globalThis.income_chart.data.labels = labels
    globalThis.income_chart.data.datasets[0].data = dataset
    globalThis.income_chart.update()
  }


function aggregate(data) {
    data.rating = 0
    data.total_price = 0
    groups = [[],[]]
    menu_groups = []
    total_menu_groups = []
    menu_per_transaction = []
    
    data.transaction.map( transaction => {
        data.rating += Number(transaction.rating)
        menu = data.transaction_menu.filter( menu_item => transaction.id==menu_item.transaction_id )
        subtotal_price=0
        menu.map(item => {
      
            const menu_name = item.name
            if (!menu_groups[menu_name]) {
                menu_groups[menu_name] = {
                count : 0,
                rating : item.rating
                }
            }
            menu_groups[menu_name]['count'] += 1
    
            const menu_date = item.updated_at.split(' ')[0]
            if (!total_menu_groups[menu_date]) {
                total_menu_groups[menu_date] = 0
            }
            total_menu_groups[menu_date] += 1
            
            toping = data.transaction_toping.filter( toping => item.transaction_menu_id == toping.transaction_menu_id )
            // item['toping'] = toping
            total_toping_price = 0
            toping.map(toping => {
                total_toping_price += Number(toping.price)
            });
            subtotal_menu_price = (Number(total_toping_price)+Number(item.transaction_menu_price))*Number(item.count)
            subtotal_price += subtotal_menu_price
        });
        transaction['total_price'] = subtotal_price
        data.total_price += Number(transaction.total_price)
  
        // date
        timeStamp = transaction.updated_at.split(' ')[0]
        date = timeStamp.split('-')[2]+' '+convert_month(timeStamp.split('-')[1])+' '+timeStamp.split('-')[0]
        date_jm = transaction.updated_at.split(' ')[1]
        date_opt = timeStamp.split('-')[2]+' '+convert_month(timeStamp.split('-')[1])+' '+ date_jm.split(':')[0] + ':' + date_jm.split(':')[1]
        if (!groups[0][date]) {
            groups[0][date] = 0;
        }
    
        if (!groups[1][date_opt]) {
            groups[1][date_opt] = 0;
        }
    
        groups[0][date] += Number(transaction.total_price)
        groups[1][date_opt] += Number(transaction.total_price)
    
    } )
    data.tenant.map((t) => {
      t.total_price = 0
      t.transaction = data.transaction.filter((transaction) => {
        return transaction.canteen_id == t.id
      })
      t.transaction.map((transaction) => {
        t.total_price += Number(transaction.total_price)
      })
    })

    data.groups = []
      data.group_price = []
      
      if(Object.keys(groups[0]).length>1){
        Object.keys(groups[0]).map((date) => {
            data.groups.push(date)
            data.group_price.push(groups[0][date])
        });
      }else{
        Object.keys(groups[1]).map((date) => {
            data.groups.push(date)
            data.group_price.push(groups[1][date])
        });
      }
      data.menu_groups = []
      data.menu_rating_groups_name = []
      data.menu_rating_groups_value = []
      Object.keys(menu_groups).map((menu_group) => {
        data.menu_groups.push({
          name : menu_group,
          count : menu_groups[menu_group]['count'],
        })
        data.menu_rating_groups_name.push(menu_group)
        data.menu_rating_groups_value.push(menu_groups[menu_group]['rating'])
      });
      data.total_menu_groups = []
      Object.keys(total_menu_groups).map((menu_group) => {
        data.total_menu_groups.push({
          name : menu_group,
          count : total_menu_groups[menu_group]
        })
      });
      data.menu_groups.sort((a , b) => b.count - a.count)
      data.rating = data.rating/data.transaction.length

    return data
}
  
  function load_transaction() {
    $.get('/Admin/Dashboard/getTransaction' ,init_date_filter($('#filter-date').val()), (data) => {
        data = aggregate(data)
        render_customer_aggregate(data.transaction)
        render_transaction_aggregate(data.transaction)
        render_tenant_aggregate(data.tenant)
        render_income_aggregate(data)
        render_income_chart(data)
        render_info(data)
        render_table_last_order(data)
        render_fav_menu_chart(data)
    })
    
  }

  function render_customer_aggregate(transaction) {
    user_id = {}
    customer_count = 0
    transaction.map((t) => {
        if(user_id[t.user_id]==undefined){
            user_id[t.user_id] = 1
        }else{
            user_id[t.user_id] += 1
        }
    })
    $('#customer-aggregate').html(Object.keys(user_id).length)
  }

  function render_transaction_aggregate(transaction) {
    $('#transaction-aggregate').html(transaction.length)
  }

  function render_tenant_aggregate(tenant) {
    $('#tenant-aggregate').html(tenant.length)
  }
  function render_income_aggregate(data) {
      $('#income-aggregate').html(formatRupiah(data.total_price.toString() , 'Rp'))
  }


  $(document).ready( () => {
    $('#filter-date').change((e) =>{
      load_transaction()
    })
    load_transaction()
  } )



  function render_info(data) {
    try {
      if($('#filter-date').val() == 2){
        $('#title-bar-chart').html(`Penjualan hari ini`)
      }else if($('#filter-date').val() == 3){
        $('#title-bar-chart').html(`Penjualan minggu ini`)
      }else if($('#filter-date').val() == 4){
        $('#title-bar-chart').html(`Penjualan bulan ini`)
      }else{
        $('#title-bar-chart').html(`Penjualan seluruh waktu`)
      }
    } catch (error) {
      $('#title-bar-chart').html(`Belum terdapat data penjualan`)
    }
    transaction_length = data.transaction_menu.length
    $('#fav-order').html('')
    try {
      data.menu_groups.map((menu_group) => {
        $('#fav-order').append(`
            <div class="progress-group">
              <span >${menu_group.name}</span>
              <span class="float-right"><b>${menu_group.count}/${transaction_length}</b></span>
              <div class="progress progress-sm">
                <div class="progress-bar bg-primary" style="width: ${menu_group.count*100/transaction_length}%"></div>
              </div>
            </div>
        `)
      })
    } catch (error) {
      $('#fav-order').html('Belum terdapat menu yang terjual')
    }
    
    data_compare_price = data.group_price.slice(-2)
    try {
      difference = data_compare_price[1] - data_compare_price[0]
      percentage = difference/data_compare_price[0]*100
      
    } catch (error) {
      difference = 0
      percentage = 0
      
    }
    icon_carage = (percentage>0) ? '<i class="fas fa-caret-up"></i>' : (percentage<0) ? '<i class="fas fa-caret-down"></i>' : '<i class="fas fa-caret-left"></i>'
    if(percentage>0){
      $('#total-price-percentage').removeClass('text-success')
      $('#total-price-percentage').removeClass('text-danger')
      $('#total-price-percentage').removeClass('text-warning')
      $('#total-price-percentage').addClass('text-success')
    }else if(percentage<0){
      $('#total-price-percentage').removeClass('text-success')
      $('#total-price-percentage').removeClass('text-danger')
      $('#total-price-percentage').removeClass('text-warning')
      $('#total-price-percentage').addClass('text-danger')
    }else{
      $('#total-price-percentage').removeClass('text-success')
      $('#total-price-percentage').removeClass('text-danger')
      $('#total-price-percentage').removeClass('text-warning')
      $('#total-price-percentage').addClass('text-warning')
    }
    try {
      $('#total-price-value').html(formatRupiah(data_compare_price[1].toString(),'Rp'))
    } catch (error) {
      try {
        $('#total-price-value').html(formatRupiah(data_compare_price[0].toString(),'Rp'))
      } catch (error) {
        $('#total-price-value').html(formatRupiah("0",'Rp'))
      }
      
    }
    try {
      $('#total-price-value').html(formatRupiah(data_compare_price[1].toString(),'Rp'))
    } catch (error) {
      try {
        $('#total-price-value').html(formatRupiah(data_compare_price[0].toString(),'Rp'))
      } catch (error) {
        $('#total-price-value').html(formatRupiah("0",'Rp'))
      }
      
    }
    $('#total-price-percentage').html(icon_carage+ percentage.toFixed(3) + '%')
    
    data_compare_menu = data.total_menu_groups.slice(-2)
    try {
      difference = data_compare_menu[1]['count'] - data_compare_menu[0]['count']
      percentage = difference/data_compare_menu[0]['count']*100
    } catch (error) {
      difference = 0
      percentage = 0
      
    }
    icon_carage = (percentage>0) ? '<i class="fas fa-caret-up"></i>' : (percentage<0) ? '<i class="fas fa-caret-down"></i>' : '<i class="fas fa-caret-left"></i>'
    if(percentage>0){
      $('#total-menu-percentage').removeClass('text-success')
      $('#total-menu-percentage').removeClass('text-danger')
      $('#total-menu-percentage').removeClass('text-warning')
      $('#total-menu-percentage').addClass('text-success')
    }else if(percentage<0){
      $('#total-menu-percentage').removeClass('text-success')
      $('#total-menu-percentage').removeClass('text-danger')
      $('#total-menu-percentage').removeClass('text-warning')
      $('#total-menu-percentage').addClass('text-danger')
    }else{
      $('#total-menu-percentage').removeClass('text-success')
      $('#total-menu-percentage').removeClass('text-danger')
      $('#total-menu-percentage').removeClass('text-warning')
      $('#total-menu-percentage').addClass('text-warning')
    }
    try {
      $('#total-menu-value').html(data_compare_menu[1]['count'])
    } catch (error) {
      try {
        $('#total-menu-value').html(data_compare_menu[0]['count'])
      } catch (error) {
        $('#total-menu-value').html('0')
      }
      
    }
    $('#total-menu-percentage').html(icon_carage+ percentage.toFixed(3) + '%')
    }


    var pie_cart_menu_rating_data = {
      labels: [],
      datasets: [
        {
          data: [],
          backgroundColor : [],
        }
      ]
      }
      var pie_cart_menu_rating_option = {
      maintainAspectRatio : false,
      responsive : true,
      legend : {
        display : false
      }
      }
      
      var pie_cart_menu_rating_canvas = $('#pie-cart-rating').get(0).getContext('2d')
      var pie_cart_menu_rating_data = pie_cart_menu_rating_data;
      //Create pie or douhnut chart
      // You can switch between pie and douhnut using the method below.
      pie_cart_menu_rating_chart = new Chart(pie_cart_menu_rating_canvas , {
      type: 'pie',
      data: pie_cart_menu_rating_data,
      options: pie_cart_menu_rating_option
      })

      
function pick_random_color(count) {
  letters = "0123456789ABCDEF"
  colors = []
  for (let i = 0; i < count; i++) {
    color = '#'
    for (let j = 0; j < 6; j++) {
      color += letters[Math.floor(Math.random() * 16)]
    }
    colors.push(color)
  }
  return colors
  }
      
function render_fav_menu_chart(data) {
  sum = data.menu_rating_groups_value.reduce((a, b) => a + b, 0)
  if(sum==0){
    $('#chart-no-data').html('<p>pengguna belum memberikan rating</p>')
  }else{
    $('#chart-no-data').html('')
    globalThis.pie_cart_menu_rating_chart.data.datasets[0].backgroundColor = pick_random_color(data.menu_rating_groups_name.length)
    globalThis.pie_cart_menu_rating_chart.data.datasets[0].data = data.menu_rating_groups_value
    globalThis.pie_cart_menu_rating_chart.data.labels = data.menu_rating_groups_name
    globalThis.pie_cart_menu_rating_chart.update()
  }
  
}

function render_table_last_order(data) {
  console.log(data)

  // $('#lates-lates-order').html()
  thead = `
    <thead>
      <tr>
        <th>No</th>
        <th>ID Transaksi</th>
        <th>Nama</th>
        <th>Tenan</th>
        <th>Status</th>
        <th>Harga</th>
        <th>Tanggal</th>
      </tr>
    </thead>
  `
  tr = ``
  data.transaction.forEach((transaction , i) => {
    if(i>4){
      return false
    }
    status_transaction = (transaction.status==5) ? '<span class="bg-success" style="border-radius:5px">Berhasil</span>' : '<span class="bg-danger" style="border-radius:5px">Gagal</span>'
    tr += `
    <tr>
      <td>${i+1}</td>
      <td>${transaction.id}</td>
      <td>${transaction.name}</td>
      <td>${transaction.canteen_name}</td>
      <td>${status_transaction}</td>
      <td>${transaction.total_price}</td>
      <td>${transaction.updated_at}</td>
    </tr>
    `
    
  });
  
  table=`<table class="table table-bordered table-hover py-0" id="lates-order-table">${thead}<tbody>${tr}</tbody></table>`
  $('#lates-order-div').html(table)
  
  
  $("#lates-order-table").DataTable({
    "responsive": false, "lengthChange": false, "autoWidth": false,
    "buttons": ["csv", "excel" , "pdf"]
  }).buttons().container().appendTo('#lates-order-table_wrapper .col-md-6:eq(0)');
  }