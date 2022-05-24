$(document).ready(function ()
{
    $("#mitabla").DataTable(
    {
        language: { url: "https://cdn.datatables.net/plug-ins/1.11.3/i18n/es_es.json" },
        responsive: true,
        rowReorder: true,
        columnDefs: [
        { orderable: true, className: 'reorder', targets: 0 },
        { orderable: false, targets: '_all' }
        ]
    });

    $('.gg-add').click(function()
    {
        $(this).closest('tr').next().slideToggle();
        console.log($(this).closest('tr').next());
    })
    $('.aulas').click( function()
    {
        let id = $(this).closest('tr').prop('dataset')['aulaId'];
        let aula = $(this).text();

        $.ajax({
            type: "get",
            url: `itemsAulas/${id}`,
            dataType: "json",
            success: function (data) {
                $('#modal-tittle').text(`Aula: ${aula}`);
                let tablaContent;
                tablaContent += `<thead><th>Nombre</th><th>Descripción</th><th>Aula</th></thead>`;
                tablaContent += '<tbody>';
                for ( valor in data)
                {
                    tablaContent += `<tr><td>${data[valor].nombre}</td><td>${data[valor].descripcion}</td><td>${aula}</td></tr>`;
                }
                tablaContent += '</tbody>';
                tablaContent += `<thead><th>Nombre</th><th>Descripción</th><th>Aula</th></thead>`;
                $('#modal-table').html(tablaContent);
                $('.ui.longer.modal').modal('show');
            },
            error: function(e) {
                console.log(e.responseText);
              }
        });
    })

    $('.replicas').click( function()
    {
        let id = $(this).closest('tr').prop('dataset')['aulaId'];
        let replicas = $(this).text();

        $.ajax({
            type: "get",
            url: `replicasPorObjeto/${id}`,
            dataType: "json",
            success: function (data) {
                $('#modal-tittle').text(`Total: ${replicas}`);
                let tablaContent;
                tablaContent += `<thead><th>Codigo QR</th><th>Incidencias</th><th>Objeto</th></thead>`;
                tablaContent += '<tbody>';
                for ( valor in data)
                {
                    tablaContent += `<tr><td>${data[valor].nombre}</td><td>${data[valor].incidencias}</td><td>${data[valor].nombre}</td></tr>`;
                }
                tablaContent += '</tbody>';
                tablaContent += `<thead><th>Nombre</th><th>Descripción</th><th>Aula</th></thead>`;
                $('#modal-table').html(tablaContent);
                $('.ui.longer.modal').modal('show');
            },
            error: function(e) {
                console.log(e.responseText);
              }
        });
    })
});
