$(function () {

    $('.toast').toast('show');

    $('.with-editor').trumbowyg({
        svgPath: $('base').attr('href')+'/node_modules/trumbowyg/dist/ui/icons.svg'
    });

    $('#logout-link').click(function (e) {
        e.preventDefault();

        $('#logout-form').submit();
    });

    $('.delete-item').click(function (e) {
        e.preventDefault();

        if(confirm('Are you sure you want to delete this item?')) {
            $(this).parent('form').submit();
        }
    });

    $('.with-slug').on('keyup change paste', function () {
        let data = $(this).val();
        let url = $(this).data('url');

        $.get(url, {s: data}).done(function(response) {
            $('#slug').val(response);
        }).fail(function (response) {
            let html = `<div class="toast align-items-center text-white bg-danger border-0" role="alert" aria-live="assertive" aria-atomic="true">
                            <div class="d-flex">
                                <div class="toast-body">
                                    ${response.responseText}
                                </div>
                                <button type="button" class="btn-close btn-close-white me-2 m-auto" data-bs-dismiss="toast" aria-label="Close"></button>
                            </div>
                        </div>`;

            $('#toastPlacement').html(html);

            $('.toast').toast('show');
        });
    });

    $('#files').change(function () {
        let files = document.querySelector('#files').files;
        $('#img-container').html('');

        for (let i = 0; i < files.length; i++) {
            let file = files[i];

            let reader = new FileReader();

            reader.readAsDataURL(file);

            reader.onload = function (e) {
                let img = e.target.result;
                let html = `<div class="col-4 mt-3">
                                <div class="img-preview border border-1" style="background-image: url(${img})"></div>
                            </div>`;

                $('#img-container').append(html);
            }
        }
    });

    $('.delete-image').click(function () {
        let url = $(this).data('url');

        let token = $('meta[name=csrf-token]').attr('content');

        if(confirm('Are you sure you want to delete this image?')) {
            $.ajax({
                url: url,
                method: 'DELETE',
                headers: {
                    'X-CSRF-TOKEN': token
                }
            }).done(function () {
                location.reload();
            }).fail(function () {
                location.reload();
            });
        }
    })
});
