$('#send-request').click((e) => {
    req_status = $('#status').val()
    req_start_date = $('#start_date').val()
    req_end_date = $('#end_date').val()
    req_api_key = $('#api_key').val()
    req = {
        status: req_status,
        start_date: req_start_date,
        end_date: req_end_date,
        api_key: req_api_key
    }
    url = $('#url').html()
    $('#modals_url').html((url+`?status=${req_status}&start_date=${req_start_date}&end_date=${req_end_date}&api_key=${req_api_key}`).replace(/\s/g, ''))
    $.get('/Dev/Transaction' , req , (data) => {
        $('#response').html(`
        <pre><code class="text-light">${JSON.stringify(data)}</code></pre>
        `)
        // console.log(data)
    }).fail((err) => {
        $('#response').html(err.responseText)
    })
})

$('#copy_url').click((e) => {
    req_status = $('#status').val()
    req_start_date = $('#start_date').val()
    req_end_date = $('#end_date').val()
    req_api_key = $('#api_key').val()
    url = ($('#url').html()+`?status=${req_status}&start_date=${req_start_date}&end_date=${req_end_date}&api_key=${req_api_key}`).replace(/\s/g, '')
    navigator.clipboard.writeText(url);
    Swal.fire({
        icon: 'success',
        title: 'Berhasil Menyalin URL',
        text: 'Menyalin papan klip: ' + url,
    })
})