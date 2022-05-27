function getParam() {
    queryString = window.location.search
    urlParams = new URLSearchParams(queryString)
    return urlParams.get('reported_id')
}

function load_report(params) {
    $.get('/Admin/Report/getReport' , (data) => {
        data.report.map(report => {
            const reporter = data.user.find( user => user.id == report.reporter)
            const reported = data.user.find( user => user.id == report.reported)
            report.reported = reported
            report.reporter = reporter
        })
        render_table_1(data)
        render_table_2(data)
    })
}

$(document).ready( () => {
    load_report()
})

function render_table_1(data) {
    const report = data.report.filter(report => report.cleaning==0)
    head = `<thead>
        <tr>
            <th>No</th>
            <th>ID Transaksi</th>
            <th>Pelapor</th>
            <th>Pelanggar</th>
            <th>Keluhan</th>
            <th>Tindakan</th>
        </tr>
    </thead>`
    row = ``
    report.forEach((d , i) => {
        row += `<tr>
            <td>${i+1}</td>
            <td>${d.transaction_id}</td>
            <td>${d.reporter.name}</td>
            <td>${d.reported.name}</td>
            <td>${d.comment}</td>
            <td>
                <a type="button" class="badge badge-success forgive" data-id="${d.id}" data-reported="${d.reported.name}">Hapus</a>
            </td>
        </tr>`
    })
    body = `<tbody>${row}</tbody>`
    table = `<table id="report_table" class="table table-bordered table-hover" >${head+body}</table>`
    $("#tabel-1").html(table)
    $("#button-action").html(`
        <a type="button" id="forgive-all" class="btn btn-success">Hapus Semua</a>
        <a type="button" id="ban" class="btn btn-danger">Blokir</a>`)
    $('.forgive').click( (e) => {
        Swal.fire({
            title: 'Apakah kamu yakin?',
            text: `menghapus pelanggaran pengguna ${$(e.target).data('reported')}!`,
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Ya, hapus',
            cancelButtonText: 'Batal',
        }).then((result) => {
            if (result.isConfirmed) {
                $.post(
                    '/Admin/Report/forgive' ,
                    {
                        id:$(e.target).data('id'),
                        reported:getParam()
                    },
                    (data) => {
                        load_report()
                        Swal.fire({
                            icon: 'success',
                            title: 'Berhasil!',
                            text: `Pelanggaran pengguna ${$(e.target).data('reported')} berhasil dihapus`
                        })
                    }
                )
            }
        })
        
    } )

    $('#ban').click( e => {
        Swal.fire({
            title: 'Apakah kamu yakin?',
            text: `memblokir pengguna!`,
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Ya, blokir',
            cancelButtonText: 'Batal',
        }).then((result) => {
            if (result.isConfirmed) {
                $.post(
                    '/Admin/Report/ban' ,
                    {
                        reported:getParam()
                    },
                    (data) => {
                        load_report()
                        Swal.fire({
                            icon: 'success',
                            title: 'Berhasil!',
                            text: 'Berhasil memblokir pengguna'
                        })
                    }
                )
            }
        })
    })
    $('#forgive-all').click( e => {
        Swal.fire({
            title: 'Apakah kamu yakin?',
            text: `menghapus semua pelanggaran!`,
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Ya, hapus',
            cancelButtonText: 'Batal',
        }).then((result) => {
            if (result.isConfirmed) {
                $.post(
                    '/Admin/Report/forgive' ,
                    {
                        reported:getParam()
                    },
                    (data) => {
                        load_report()
                        Swal.fire({
                            icon: 'success',
                            title: 'Berhasil!',
                            text: 'Semua pelanggaran berhasil dihapus'
                        })
                    }
                )
            }
        })
    })
}
function render_table_2(data) {
    const report = data.report.filter(report => report.cleaning==1)
    head = `<thead>
        <tr>
            <th>No</th>
            <th>ID Transaksi</th>
            <th>Pelapor</th>
            <th>Pelanggar</th>
            <th>Keluhan</th>
        </tr>
    </thead>`
    row = ``
    report.forEach((d , i) => {
        row += `<tr>
            <td>${i+1}</td>
            <td>${d.transaction_id}</td>
            <td>${d.reporter.name}</td>
            <td>${d.reported.name}</td>
            <td>${d.comment}</td>
        </tr>`
    })
    body = `<tbody>${row}</tbody>`
    table = `<table id="report_table_2" class="table table-bordered table-hover" >${head+body}</table>`
    $("#tabel-2").html(table)
}