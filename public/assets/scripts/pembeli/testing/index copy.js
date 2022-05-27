start = new Date()


function order(menu_id , count) {
    
    $.post(
        '/Pembeli/Order/updateCart',
        {
            menu_id:menu_id,
            count:count,
            canteen_id:3
        },
        (data) => {
            add_toping(data['transaction']['canteen_id'] , data['transaction_menu'][0]['menu_id'] , 1 , 'true' , data)
        }
    )
}

function add_toping(canteen_id , menu_id , toping_id , value , data_transaction){
    $.post(
        '/Pembeli/Order/updateToping' , 
        {
            canteen_id,
            menu_id, 
            toping_id,
            value
        },
        (data) => {
            checkout(data_transaction)
        }
    )
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
        }
    )
}

$(document).ready( () => {
    setInterval((e) => 
    {
        $.get('/Pembeli/Testing/getStatusCanteen' , (data) => {
            if(data['status']==2){
                order(1,5)
                numberTransaction()
            }
        })
    },
    500
    )
    
} )

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








