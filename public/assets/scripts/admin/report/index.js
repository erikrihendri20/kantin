$.get('/Admin/Report/getReport' , {scope:'global'}, (data) => {
    render_table(data)
})

function render_table(data) {
    head = `<thead>
        <tr>
            <th>No</th>
            <th>Pelanggar</th>
            <th>Jumlah Pelanggaran</th>
            <th>Tindakan</th>
        </tr>
    </thead>`
    row = ``
    data.forEach((d , i) => {
        row += `<tr>
            <td>${i+1}</td>
            <td>${d.reported_user_name}</td>
            <td>${d.penalty_count}</td>
            <td>
                <a type="button" href="/Admin/Report/details?reported_id=${d.reported_user_id}" class="badge badge-warning my-badge">detail</a>
            </td>
        </tr>`
    })
    body = `<tbody>${row}</tbody>`
    table = `<table id="report_table" class="table table-bordered table-hover" >${head+body}</table>`
    $("#tabel-1").html(table)
    $("#report_table").DataTable({
        "lengthChange": false, "autoWidth": false,
        "buttons": ["csv", "excel"]
    }).buttons().container().appendTo('#report_table_wrapper .col-md-6:eq(0)');
}