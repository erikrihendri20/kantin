$(document).ready( () => {
    flash = $('.flash').data('flash') 
    if ($('.flash').data('flash')) {
        data = flash.split('|') 
        Swal.fire(data[0], data[1], data[2])
    }
})