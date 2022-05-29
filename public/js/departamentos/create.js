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
    quillDescripcion.on('text-change', function (delta, oldDelta, source) {
        console.log(quillDescripcion.root.innerHTML);
        // let data = JSON.stringify(delta.ops);
        // console.log(data);
        // console.log(JSON.parse(data));
        // $('#descripcion').val(data);
    });
    $('#descripcion-editor').on('click', function (e) {
        quillDescripcion.root.innerHTML = '<p>asdasd</p><p>dasd</p><h2>ddd</h2><p>fdf</p><p><strong>fdsf</strong></p>';
    })

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
    $('button[data-action="decrement"], button[data-action="increment"]').click(function(e) {
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
});

