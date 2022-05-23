$(document).ready( function () {
    // $('#mitabla').DataTable();
    $("#mitabla").DataTable({
        language: { url: "https://cdn.datatables.net/plug-ins/1.11.3/i18n/es_es.json" },
        rowReorder: true,
        columnDefs: [
        { orderable: true, className: 'reorder', targets: 0 },
        { orderable: false, targets: '_all' }
        ]
    });
    console.log('hola mundo');
} );
