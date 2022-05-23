let algo;
$(document).ready( function () {
    // $('#mitabla').DataTable();
    $("#mitabla").DataTable({
        language: { url: "https://cdn.datatables.net/plug-ins/1.11.3/i18n/es_es.json" },
        // responsive: true,
        rowReorder: true,
        columnDefs: [
        { orderable: true, className: 'reorder', targets: 0 },
        { orderable: false, targets: '_all' }
        ]
    });
    $('.aulas').click( function()
    {
        let id = $(this).closest('tr').prop('dataset')['aulaId'];
        let aula = $(this).text();
        console.log(aula);

        $.ajax({
            type: "get",
            url: `itemsAulas/${id}`,
            dataType: "json",
            success: function (data) {
                $('#modal-tittle').text(`Aula: ${aula}`);
                algo = data;
                let tablaContent;
                tablaContent += `<thead><th>Nombre</th><th>Descripción</th><th>Aula</th></thead>`;
                tablaContent += '<tbody>';
                // for (let i = 0; i < data.length; i++) {
                //     tablaContent += `<tr><td>${data[i].nombre}</td><td>${data[i].descripcion}</td><td>${aula}</td></tr>`;
                // }
                // data.forEach((objeto) => {tablaContent += `<tr><td>${objeto.nombre}</td><td>${objeto.descripcion}</td><td>${aula}</td></tr>`;})
                for ( valor in data)
                {
                    tablaContent += `<tr><td>${data[valor].nombre}</td><td>${data[valor].descripcion}</td><td>${aula}</td></tr>`;
                }
                tablaContent += '</tbody>';
                tablaContent += `<thead><th>Nombre</th><th>Descripción</th><th>Aula</th></thead>`;
                $('#modal-table').html(tablaContent);
            },
            error: function(e) {
                console.log(e.responseText);
              }
        });
    })
} );
