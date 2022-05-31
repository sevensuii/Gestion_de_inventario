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
                tablaContent += `<tfoot><th>Nombre</th><th>Descripción</th><th>Aula</th></tfoot>`;
                $('#modal-table').html(tablaContent);
                $('#modal-table-show').modal('show');
            },
            error: function(e) {
                console.log(e.responseText);
              }
        });
    })

    $('.replicas').click( function()
    {
        let id = $(this).closest('tr').prop('dataset')['objetoId'];
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
                    tablaContent += `<tr><td>${data[valor].codigo_qr}</td><td>${data[valor].incidencias}</td><td>${data[valor].nombre}</td></tr>`;
                }
                tablaContent += '</tbody>';
                tablaContent += `<tfoot><th>Codigo QR</th><th>Incidencias</th><th>Objeto</th></tfoot>`;
                $('#modal-table').html(tablaContent);
                $('#modal-table-show').modal('show');
            },
            error: function(e) {
                console.log(e.responseText);
              }
        });
    })

    $('.delete-item').click(function()
    {
        let id = $(this).closest('tr').prop('dataset')['objetoId'];
        let tr = $(this).closest('tr');

        $.ajax({
            type: "get",
            url: `/objetos/destroy/${id}`,
            beforeSend: function()
            {
                $('#loader').toggleClass('active')
            },
            success: function (response)
            {
                $('#loader').toggleClass('active')
                tr.fadeOut();
                $('body').toast({
                        message: `Se ha eliminado el objeto`,
                        showProgress: 'bottom',
                        classProgress: 'green'
                });
            },
            error: function(res)
            {
                console.log(res);
                $('#loader').toggleClass('active')
                $('body').toast({
                    title: 'Error',
                    message: `Algo ha ido mal`,
                    showProgress: 'bottom',
                    classProgress: 'red'
            });
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
    // let islaArray = ['lanzarote', 'fuerteventura', 'gran canaria', 'tenerife', 'la palma', 'la gomera', 'el hierro', 'la graciosa'];
    // let valores = document.querySelectorAll('#canarias li').text.toLowerCase();
    // let respuesta = prompt(`Ingrese el nombre de la canaria`);
    // if (valores.includes(respuesta.toLowerCase()) && islaArray.includes(respuesta.toLowerCase()))
    // {
    //     let warningNodo = document.createElement('div');
    //     warningNodo.classList.add('warning');
    //     warningNodo.innerHTML = `Warning, la palabra ${respuesta} ya existe`;
    //     document.querySelector('body').appendChild(warningNodo);
    //     setTimeout(function()
    //     {
    //         warningNodo.remove();
    //         // si esto no funciona
    //         // document.querySelector('body').removeChild(warningNodo);
    //         //y si esto tampoco
    //         // document.querySelectorAll('.warning').remove();
    //     }, 4000);
    // }
    // else if (islaArray.includes(respuesta.toLowerCase()))
    // {
    //     let nuevaIsla = document.createElement('li');
    //     nuevaIsla.innerHTML = respuesta;
    //     document.querySelector('#canarias').appendChild(nuevaIsla);
    // }
    // else
    // {
    //     let errorNodo = document.createElement('div');
    //     errorNodo.classList.add('error');
    //     errorNodo.innerHTML = `Error, no pertenece ${respuesta}`;
    //     document.querySelector('body').appendChild(errorNodo);
    //     setTimeout(function()
    //     {
    //         errorNodo.remove();
    //         // si este no funciona prueba como en el caso anterior
    //     }
    //     , 4000);
    // }
});


