// let algo;
$(document).ready( function () {
    // $('#mitabla').DataTable();
    $("#mitabla").DataTable({
        language: { url: "https://cdn.datatables.net/plug-ins/1.11.3/i18n/es_es.json" },
        // responsive: true,
        rowReorder: true,
        columnDefs: [
        { orderable: false, className: 'reorder', targets: 0 },
        { orderable: true, targets: '_all' }
        ]
    });
    $('.aulas').click( function()
    {
        let id = $(this).closest('tr').prop('dataset')['aulaId'];
        let aula = $(this).text();
        // console.log(aula);

        $.ajax({
            type: "get",
            url: `itemsAulas/${id}`,
            dataType: "json",
            success: function (data) {
                $('#modal-tittle').text(`Aula: ${aula}`);
                // algo = data;
                let tablaContent;
                tablaContent += `<thead><th>Nombre</th><th>Descripción</th><th>Aula</th></thead>`;
                tablaContent += '<tbody>';
                for ( valor in data)
                {
                    tablaContent += `<tr><td>${data[valor].nombre}</td><td>${data[valor].descripcion}</td><td>${aula}</td></tr>`;
                }
                tablaContent += '</tbody>';
                tablaContent += `<tfoot><th>Nombre</th><th>Descripción</th><th>Aula</th></tfoot>`;
                $('#modal-table').html(tablaContent);
                $('#modal-table-show').modal('show');
            },
            error: function(e) {
                console.log(e.responseText);
              }
        });
    })

    $('.departamentos').click( function()
    {
        let id = $(this).closest('tr').prop('dataset')['departamentoId'];
        let departamento = $(this).text();
        // console.log(aula);

        $.ajax({
            type: "get",
            url: `itemsDepartamento/${id}`,
            dataType: "json",
            success: function (data) {
                $('#modal-tittle').text(`Departamento: ${departamento}`);
                // algo = data;
                let tablaContent;
                tablaContent += `<thead><th>Nombre</th><th>Descripción</th><th>Aula</th><th>Departamento</th></thead>`;
                tablaContent += '<tbody>';
                for ( valor in data)
                {
                    tablaContent += `<tr><td>${data[valor].nombre}</td><td>${data[valor].descripcion}</td><td>${data[valor].aula}</td><td>${departamento}</td></tr>`;
                }
                tablaContent += '</tbody>';
                tablaContent += `<tfoot><th>Nombre</th><th>Descripción</th><th>Aula</th><th>Departamento</th></tfoot>`;
                $('#modal-table').html(tablaContent);
                $('#modal-table-show').modal('show');
            },
            error: function(e) {
                console.log(e.responseText);
              }
        });
    })

    $('.imagen-show').click(function()
    {
        let imagenUrl = $(this).closest('tr').data('imagenUrl')
        // $('#modal-tittle').text(`Imagen`);
        if (imagenUrl)
        {
            $('#img-error').hide();
            $('#imagen-show').attr('src', 'storage/' + imagenUrl).show();
            $('#modal-img').modal('show');
        }
        else
        {
            $('#img-error').show();
            $('#imagen-show').hide();
            $('#modal-img').modal('show');
        }
    });
} );
