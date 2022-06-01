$(document).ready(function () {
    let toolbarOptions = [ 'bold', 'italic', 'underline', 'strike', 'blockquote', 'link', 'image', 'color', 'emoji', 'code', 'clean' ];
    let quillDescripcion = new Quill('#descripcion-editor',
    {
        modules: {
            toolbar: [
                [{ 'font': [] }, { 'header': [1, 2, 3, false] }],
                ['bold', 'italic', 'underline', 'strike'],        // toggled buttons
                ['blockquote', 'code-block'],

                [{ 'header': 1 }, { 'header': 2 }],               // custom button values
                [{ 'list': 'ordered'}, { 'list': 'bullet' }],
                [{ 'script': 'sub'}, { 'script': 'super' }],      // superscript/subscript
                [{ 'indent': '-1'}, { 'indent': '+1' }],          // outdent/indent
                [{ 'direction': 'rtl' }],                         // text direction

                // [{ 'size': ['small', false, 'large', 'huge'] }],  // custom dropdown

                [{ 'color': [] }, { 'background': [] }],          // dropdown with defaults from theme
                [{ 'align': [] }],

                ["link", "image", "video", "formula"],
                ['clean']
            ]
        },
        theme: 'snow',
        readOnly: false,
    });
    // $('#descripcion-editor').change(function (e) {
    //     $('#descripcion').val(quillDescripcion.innerHTML);
    // });
    // documento cargado completamente, copia el valor del input al edior
    quillDescripcion.root.innerHTML = $('#descripcion').val();
    // cambia el valor del input cada vez que el editor cambia
    quillDescripcion.on('text-change', function (delta, oldDelta, source) {
        // console.log(quillDescripcion.root.innerHTML);
        $('#descripcion').val(quillDescripcion.root.innerHTML);
        // let data = JSON.stringify(delta.ops);
        // console.log(data);
        // console.log(JSON.parse(data));
        // $('#descripcion').val(data);
    });

    $('#imageInput').on('change', function() {
        $input = $(this);
        if($input.val().length > 0) {
            fileReader = new FileReader();
            fileReader.onload = function (data) {
            $('.image-preview').attr('src', data.target.result);
            }
            fileReader.readAsDataURL($input.prop('files')[0]);
            $('.image-button').css('display', 'none');
            $('.image-preview').css('display', 'block');
            $('.change-image').css('display', 'block');
        }
    });

    $('.change-image').on('click', function() {
        $control = $(this);
        $('#imageInput').val('');
        $preview = $('.image-preview');
        $preview.attr('src', '');
        $preview.css('display', 'none');
        $control.css('display', 'none');
        $('.image-button').css('display', 'block');
    });

    // Contador para aniadir imagenes
    $('.prevent-default').click(function(e) {
        e.preventDefault();});

    function decrement(e) {
        const btn = e.target.parentNode.parentElement.querySelector(
        'button[data-action="decrement"]'
        );
        const target = btn.nextElementSibling;
        let value = Number(target.value);
        if (value > 1) {
        value--;
        }
        target.value = value;
    }

    function increment(e) {
        const btn = e.target.parentNode.parentElement.querySelector(
        'button[data-action="decrement"]'
        );
        const target = btn.nextElementSibling;
        let value = Number(target.value);
        value++;
        target.value = value;
    }

    const decrementButtons = document.querySelectorAll(
        `button[data-action="decrement"]`
    );

    const incrementButtons = document.querySelectorAll(
        `button[data-action="increment"]`
    );

    decrementButtons.forEach(btn => {
        btn.addEventListener("click", decrement);
    });

    incrementButtons.forEach(btn => {
        btn.addEventListener("click", increment);
    });

    // Envio del formulario
    $('#submitBtn').on('click', function(e)
    {

    });

    let inciEdit = $('.incidencias-editor');
    for (let i = 0; i < inciEdit.length; i++) {
        let edit = new Quill(inciEdit[i],
        {
            modules: {
                toolbar: [
                    [{ 'font': [] }, { 'header': [1, 2, 3, false] }],
                    ['bold', 'italic', 'underline', 'strike'],        // toggled buttons
                    ['blockquote', 'code-block'],

                    [{ 'header': 1 }, { 'header': 2 }],               // custom button values
                    [{ 'list': 'ordered'}, { 'list': 'bullet' }],
                    [{ 'script': 'sub'}, { 'script': 'super' }],      // superscript/subscript
                    [{ 'indent': '-1'}, { 'indent': '+1' }],          // outdent/indent
                    [{ 'direction': 'rtl' }],                         // text direction

                    // [{ 'size': ['small', false, 'large', 'huge'] }],  // custom dropdown

                    [{ 'color': [] }, { 'background': [] }],          // dropdown with defaults from theme
                    [{ 'align': [] }],

                    ["link", "image", "video", "formula"],
                    ['clean']
                ]
            },
            theme: 'snow',
            readOnly: false,
        });
        // console.log(inciEdit[i].innerHTML);

        // edit.root.innerHTML = inciEdit[i].closest('tr').data('editor');
    }

    $('.guardar').click(function(e)
    {
        let miTr = $(this).closest('tr');
        let id = miTr.data('id');
        // let incidencia = JSON.stringify( miTr.find('.ql-editor').html());
        let incidencia = miTr.find('.ql-editor').html();

        // console.log(incidencia, id);
        $.ajax({
            type: "get",
            url: `/replica/update`,
            data: {incidencia: incidencia, id: id},
            beforeSend: function()
            {
                $('#loader').toggleClass('active')
            },
            success: function (response)
            {
                $('#loader').toggleClass('active')
                $('body').toast({
                        message: `Se ha actualizado la replica`,
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
    });

    $('.borrar').click(function(e)
    {
        let miTr = $(this).closest('tr');
        let id = miTr.data('id');
        // let incidencia = JSON.stringify( miTr.find('.ql-editor').html());
        let incidencia = miTr.find('.ql-editor').html();

        // console.log(incidencia, id);
        $.ajax({
            type: "get",
            url: `/replica/destroy`,
            data: {id: id},
            beforeSend: function()
            {
                $('#loader').toggleClass('active')
            },
            success: function (response)
            {
                $('#loader').toggleClass('active')
                miTr.fadeOut();
                $('body').toast({
                        message: `Se ha eliminado la replica`,
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
    });

    $('#generar').click(function(e)
    {
        // let miTr = $(this).closest('tr');
        // let id = miTr.data('id');
        // let incidencia = JSON.stringify( miTr.find('.ql-editor').html());
        // let incidencia = miTr.find('.ql-editor').html();
        let id = $('#item_id').val();
        let cantidad = $('#cantidad').val();

        // console.log(incidencia, id);
        $.ajax({
            type: "get",
            url: `/replica/create`,
            data: {id: id, cantidad: cantidad},
            beforeSend: function()
            {
                $('#loader').toggleClass('active')
            },
            success: function (response)
            {
                $('#loader').toggleClass('active')
                $('body').toast({
                        message: `Se han generado replicas`,
                        showProgress: 'bottom',
                        classProgress: 'green'
                });
                location.reload();
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
    });

    $('.qrcode').click(function()
    {
        let imagenUrl = $(this).data('qr')
        // $('#modal-tittle').text(`Imagen`);
        if (imagenUrl)
        {
            var qrc = new QRCode(document.getElementById("qrcode"), $(this).data('qr'));
            $('#modal-img').modal('show');
        }
    });


});
