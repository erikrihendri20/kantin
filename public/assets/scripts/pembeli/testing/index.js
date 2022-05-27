canteen_id = [3,4,5,6,7,8]
start = new Date()

function order() {
    sample = canteen_id[Math.floor(Math.random()*canteen_id.length)]
    // getmenu
    $.get('/Pembeli/Order/getMenu' , {
        'canteen_id' : sample,
        'limit' : 20,
        'indeks' : 0
    }, (data) => {
        menu_to_order = fetch_menu(data)
        menu_to_order.forEach( menu => {
            add_cart(menu , sample)
        })
        setTimeout(() => {
            checkout()
        }, 10000);
    })
}

function checkout() {
    $.get('/Pembeli/Checkout/getMenu' , (data) => {
        pay(data)
    })
}

function pay(data) {
    transactions = {}
    data['transaction'].forEach(transaction =>  {
        transactions[transaction.id] = transaction.noted
    })
    $.post(
        '/Pembeli/Pay',
        transactions,
        (data) => {
            order()
            numberTransaction()
        }
    )
}

function add_cart(menu , sample) {
    $.post(
        '/Pembeli/Order/updateCart',
        {
            menu_id:menu.menu_id,
            count:menu.count,
            canteen_id:sample
        },
        (data) => {
            menu.toping.forEach(toping => {
                add_toping(sample, menu.menu_id , toping.id , 'true')
            })
        }
    )
}

function add_toping(canteen_id , menu_id , toping_id , value){
    $.post(
        '/Pembeli/Order/updateToping' , 
        {
            canteen_id,
            menu_id, 
            toping_id,
            value
        },
        (data) => {

        }
    )
}

function fetch_menu(data) {
    menu_id = []
    data.menu.forEach(menu => {
        menu_id.push(menu.menu_id)
    });
    group_menu = []
    for (let i = 0; i < Math.ceil(menu_id.length/2); i++) {
        id = menu_id[Math.floor(Math.random()*menu_id.length)]
        if(!group_menu['menu-'+id]){
            toping = data.toping.filter( t => t.menu_id == id)
            group_menu['menu-'+id] = {
                'count' : 1,
                'menu_id' : id,
                'toping' : toping
            }
        }else{
            group_menu['menu-'+id]['count'] += 1
        }
    }
    choosen_menu = []
    Object.keys(group_menu).map((key) => {
        choosen_menu.push(group_menu[key])
    });
    return choosen_menu
}

$(document).ready(() => {
    $.get('/Pembeli/Testing/getStatusCanteen' , (data) => {
        if(data['status']==2){
            order()
            // numberTransaction()
        }
    })
    // setInterval(() => {
    //     $.get('/Pembeli/Testing/getStatusCanteen' , (data) => {
    //         if(data['status']==2){
    //             order()
    //             numberTransaction()
    //         }
    //     })
    // }, 10000);
})

function numberTransaction() {
    $.get('/Pembeli/Testing/getNumberTransaction' , (data) => {
        $('#numberTransaction').html(`Jumlah Transaksi : ${data['transaction']}`)
        $('#numberMenu').html(`Jumlah Menu : ${data['menu']}`)
        $('#numberToping').html(`Jumlah Toping : ${data['toping']}`)
        end = new Date()
        timer = end-start
        if(timer<60000){
            stopwatch = timer/1000+'detik'
        }else if(timer<3600000){
            stopwatch = timer/60000+'menit'
        }
        $('#time').html(`waktu : ${stopwatch}`)

    })
}
