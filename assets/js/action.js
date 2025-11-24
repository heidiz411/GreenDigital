"use strict"
$(document).ready(function () {
    let $body = $('body');
    $body.on('click', '.btn-modal', function (e) {
        let form_view = $(this).data('view');
        let modal_title = $(this).data('title');
        let $modal = $('#myModal');
        let $modal_title = $modal.find('.modal-title');
        $modal_title.text(modal_title);
        let $modal_body = $modal.find('.modal-body');
        $modal_body.load(form_view);

        $modal.modal('show');
        let $id = $(this).data('id');
        let $controllers = $(this).data('controllers');
        if ($id != null && $controllers != null) {
            $.ajax({
                url: $controllers,
                type: 'POST',
                data: {
                    id: $id
                },
                dataType: 'json',
                success: function (res) {
                    $.each(res, function (key, value) {
                        $modal.find('input[name=' + key + ']').val(value);
                        $modal.find('textarea[name=' + key + ']').val(value);
                        $modal.find('select[name=' + key + ']').val(value);
                        $modal.find('small[name=' + key + ']').text(value);
                        if (key == 'password') {
                            $modal.find('input[name=' + key + ']').val('');
                            $modal.find('input[name=' + key + ']').attr('required', false);
                        }
                        if (key == 'list_image') {
                            $modal.find('input[name=' + key + ']').prop('required', false);
                        }
                        if (key == 'image') {
                            $modal.find('img[name=' + key + ']').attr('src', '../uploads/' + value);
                        }
                    })
                }
            });
        } else {
            let form = $modal.find('.form-ajax');
            form.trigger('reset');
        }
    });

    $body.on('submit', '.form-ajax', function (e) {
        e.preventDefault();
        let $url = $(this).attr('action');
        let $method = $(this).attr('method');
        let $data = new FormData(this);

        $.ajax({
            url: $url,
            type: $method,
            data: $data,
            processData: false,
            contentType: false,
            dataType: 'json',
            success: function (res) {
                if (res.alert) {
                    alert(res.alert);
                    $('.modal-hide').modal('hide');
                }
                if (res.page) {
                    window.location = res.page;
                }
                if (res.reload) {
                    setTimeout(() => {
                        window.location.reload();
                    }, 1000)
                }
                if (res.message) {
                    $('.message').html('<div class="alert alert-danger"><button type="button" class="btn-close float-end" data-bs-dismiss="alert" aria-label="Close"></button>' + res.message + '</div>')
                }

            }, error: function (res) {
                $('.message').html('<div class="alert alert-danger"><button type="button" class="btn-close float-end" data-bs-dismiss="alert" aria-label="Close"></button>เกิดข้อผิดพลาด กรุณาลองอีกครั้ง</div>')

            }
        });
    })

    $body.on('click', '.btn-delete', function (e) {
        e.preventDefault();
        let $id = $(this).data('id');
        let $controllers = $(this).data('controllers');

        if (confirm("คุณต้องการลบหรือไม่")) {
            $.ajax({
                url: $controllers,
                type: 'POST',
                data: {
                    id: $id
                },
                dataType: 'json',
                success: function (res) {
                    if (res.alert) {
                        alert(res.alert);
                    }
                    if (res.page) {
                        window.location = res.page;
                    }
                    if (res.reload) {
                        setTimeout(() => {
                            window.location.reload();
                        }, 1000)
                    }
                }, error: function (res) {
                    alert('เกิดข้อผิดพลาด');
                }
            });
        }
    })

});