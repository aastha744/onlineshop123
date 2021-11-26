$(function() {

    cart_total();

    $('.toast').toast('show');

    $('#logout-link').click(function (e) {
        e.preventDefault();

        $('#logout-form').submit();
    });

    $('.delete-review').click(function (e) {
        e.preventDefault();

        if(confirm('Are you sure you want to delete this review?')) {
            $(this).parent('form').submit();
        }
    });

    $('.edit-review').click(function () {
        let url = $(this).data('url');
        let comment = $(this).data('comment');
        let rating = $(this).data('rating');

        $('#review-form').attr('action', url);
        $('#comment').val(comment);
        $('#rating-'+rating).prop('checked', true);
    });

    $('.cart-add').click(function () {
        let slug = $(this).data('slug');
        let qty = $('#cart-qty-' + slug).val();
        let url = $(this).data('url') + '/' + qty;
        let token = $('meta[name=csrf-token]').attr('content');

        $.ajax({
            url: url,
            method: 'POST',
            headers: {
                'X-CSRF-TOKEN': token
            }
        }).done(function (response) {
            $('#cart-qty-' + slug).val(1);

            cart_total();

            let html = `<div class="toast align-items-center text-white bg-success border-0" role="alert" aria-live="assertive" aria-atomic="true">
                            <div class="d-flex">
                                <div class="toast-body">
                                    ${response}
                                </div>
                                <button type="button" class="btn-close btn-close-white me-2 m-auto" data-bs-dismiss="toast" aria-label="Close"></button>
                            </div>
                        </div>`;

            $('.toast-container').html(html);
            $('.toast').toast('show');
        }).fail(function (response) {
            let html = `<div class="toast align-items-center text-white bg-danger border-0" role="alert" aria-live="assertive" aria-atomic="true">
                            <div class="d-flex">
                                <div class="toast-body">
                                    ${response.responseText}
                                </div>
                                <button type="button" class="btn-close btn-close-white me-2 m-auto" data-bs-dismiss="toast" aria-label="Close"></button>
                            </div>
                        </div>`;

            $('.toast-container').html(html);
            $('.toast').toast('show');
        });

    });

    $('.cart-delete').click(function() {
        if(confirm('Are you sure you want to remove this item from cart?')) {
            let url = $(this).data('url');
            let token = $('meta[name=csrf-token]').attr('content');

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
    });

    $('.btn-cancel').click(function(e) {
        e.preventDefault();

        if(confirm('Are you sure you want to cancel this order?')) {
            $(this).parent('form').submit();
        }
    });

    $('.nav-item.dropdown').mouseenter(function() {
        $(this).addClass('show');
        $(this).children('.dropdown-menu').addClass('show');
        $(this).children('.dropdown-toggle').attr('aria-expanded', 'true');
    }).mouseleave(function() {
        $(this).removeClass('show');
        $(this).children('.dropdown-menu').removeClass('show');
        $(this).children('.dropdown-toggle').attr('aria-expanded', 'false');
    });

    $('.img-small').on('mouseenter click', function() {
        var src = $(this).data('src');
        $('.img-large').css("background-image", "url('"+src+"')");
    });

    var imgLarge = $('.img-large');

    imgLarge.mousemove(function(event) {
        var relX = event.pageX - $(this).offset().left;
        var relY = event.pageY - $(this).offset().top;
        var width = $(this).width();
        var height = $(this).height();
        var x = (relX / width) * 100;
        var y = (relY / height) * 100;
        $(this).css("background-position", x+"% "+y+"%");
    });

    imgLarge.mouseout(function() {
        $(this).css("background-position", "center");
    });

    $( window ).resize(function() {
        setImgLarge();
        setImgSmall();
    });

    setImgLarge();
    setImgSmall();

});

function cart_total() {
    let url = $('#header-item').data('url');

    $.get(url).done(function(response) {
        $('#header-qty').html(response.total_qty);
        $('#header-price').html('Rs. '+response.total_amount);
    });
}

function setImgLarge() {
    var imgLarge = $('.img-large');
    var width = imgLarge.width();
    imgLarge.height(width * 2/3);
}

function setImgSmall() {
    var imgSmall = $('.img-small');
    var width = imgSmall.width();
    imgSmall.height(width);
}
