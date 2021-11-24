function formatRupiah(angka, prefix) {
    var number_string = angka.replace(/[^,\d]/g, '').toString(),
        split = number_string.split(','),
        sisa = split[0].length % 3,
        rupiah = split[0].substr(0, sisa),
        ribuan = split[0].substr(sisa).match(/\d{3}/gi);
    // tambahkan titik jika yang di input sudah menjadi angka ribuan
    if (ribuan) {
        separator = sisa ? '.' : '';
        rupiah += separator + ribuan.join('.');
    }
    rupiah = split[1] != undefined ? rupiah + ',' + split[1] : rupiah;
    return prefix == undefined ? rupiah : (rupiah ? 'Rp. ' + rupiah : '');
}

function render_cart(data) {
    $('#cart-menu').html('')
    data.forEach(menu => {
        price = (menu.count) ? ((menu.count!=0) ? menu.price*menu.count : menu.price)  : menu.price
        item_toping = ''
        toping = ''
        if(menu.toping){
            menu.toping.forEach( (t) => {
                item_toping+=`
                    <li class="list-group-item py-0">
                        <div class="form-check">
                            <input class="form-check-input toping" type="checkbox" data-toping_id="${t.id}" data-menu_id="${menu.menu_id}" id="toping-${menu.menu_id}-${t.id}">
                            <label class="form-check-label" for="toping-${menu.menu_id}-${t.id}">
                                <span class="font-weight-bold">${t.name}</span> (<span class="text-secondary">${t.price}</span>)
                            </label>
                        </div>
                    </li>
                `
            } )
            toping = `
            <div class="row">
                <div class="col">
                    <div class="card-body">
                        <div class="card my-0">
                            <div class="card-header py-0">
                                Toping : 
                            </div>
                            <ul class="list-group list-group-flush">
                                ${item_toping}
                            </ul>
                        </div> 
                    </div>
                </div>
            </div>
            `
            $('#cart-menu').append(`
                <div class="col-12">
                    <div class="card">
                        <div class="row">
                            <div class="col-3 d-flex justify-content-center align-self-center">
                                <img class="card-img-top img-menu" src="/assets/img/menu/${menu.photo}" alt="Card image cap">
                            </div>
                            <div class="col-9 ">
                                <div class="card-body">
                                    <h5 class="card-title font-weight-bold text-uppercase">${(menu.menu_name.length>20) ? menu.menu_name.slice(0,20) + '..' : menu.menu_name}<small class="text-muted">*4.6</small></h5>
                                    <br>
                                    <p class="card-text font-weight-bold my-0" id="price-${menu.menu_id}" data-price="${menu.price}">${formatRupiah(price.toString() , 'Rp')}</p>
                                </div>
                            </div>
                        </div>
                        ${toping}
                    </div>
                </div>`
            )
        }else{
            $('#cart-menu').append(`
                <div class="col-12">
                    <div class="card">
                        <div class="row">
                            <div class="col-3 d-flex justify-content-center align-self-center">
                                <img class="card-img-top img-menu" src="/assets/img/menu/${menu.photo}" alt="Card image cap">
                            </div>
                            <div class="col-9 ">
                                <div class="card-body">
                                    <h5 class="card-title font-weight-bold text-uppercase">${(menu.menu_name.length>20) ? menu.menu_name.slice(0,20) + '..' : menu.menu_name}<small class="text-muted">*4.6</small></h5>
                                    <br>
                                    <p class="card-text font-weight-bold my-0" id="price-${menu.menu_id}" data-price="${menu.price}">${formatRupiah(price.toString() , 'Rp')}</p>
                                </div>
                            </div>
                        </div>
                        ${toping}
                    </div>
                </div>`
            )
        }
    });
    $('.toping').change( (e) => {
        value = $(e.target).prop('checked')
        menu_id = $(e.target).data('menu_id')
        toping_id = $(e.target).data('toping_id')
        $.post(
            '/Pembeli/Pesan/setToping' , 
            {menu_id , toping_id , value} ,
            (data) => {
                console.log(data)
                
            }
        )
    })
    checkTopingManager()
}

function load_cart() {
    $.get('/Pembeli/Pesan/getItemCart' , 
    (data) => {
        render_cart(data)
    })
}

function checkTopingManager() {
    $.get(
        '/Pembeli/Pesan/getTopingTransaction' ,
        (data) => {
            data.forEach( (d) => {
                $(`#toping-${d.menu_id}-${d.toping_id}`).prop( "checked", true )
            } )
        }
    )
}

$(document).ready( () => {
    load_cart()
})