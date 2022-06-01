$(document).ready(function () {
    let quillDescripcion = new Quill('#descripcion-editor',
    {
        modules: {
            toolbar: false
        },
        theme: 'snow',
        readOnly: true,
    });
    quillDescripcion.root.innerHTML = $('#descripcion').val();
    let quillIncidencias = new Quill('#incidencias-editor',
    {
        modules: {
            toolbar: false
        },
        theme: 'snow',
        readOnly: true,
    });

    var qrc = new QRCode(document.getElementById("qrcode"), $('#qrcode-val').text());
});

