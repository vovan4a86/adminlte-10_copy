let newsImage = null;

function newsImageAttache(elem, e){
    $.each(e.target.files, function(key, file)
    {
        if(file['size'] > max_file_size){
            alert('Слишком большой размер файла. Максимальный размер 10Мб');
        } else {
            newsImage = file;
            renderImage(file, function (imgSrc) {
                const item = '<img class="img-polaroid" src="' + imgSrc + '" height="100" data-image="' + imgSrc + '" ' +
                    'onclick="return popupImage($(this).data(\'image\'))" alt="image">';
                $('#news-image').html(item);
            });
        }
    });
    $(elem).val('');
}

function newsSave(form, e) {
    e.preventDefault();
    const url = $(form).attr('action');
    let data = new FormData();
    $.each($(form).serializeArray(), function (key, value) {
        data.append(value.name, value.value);
    });

    if (newsImage) {
        data.append('image', newsImage);
    }

    sendFiles(url, data, function (json) {
        if (typeof json.errors != 'undefined') {
            applyFormValidate(form, json.errors);
            var errMsg = [];
            for (var key in json.errors) {
                errMsg.push(json.errors[key]);
            }
            // $(form).find('[type=submit]').after(autoHideMsg('red', urldecode(errMsg.join(' '))));
            toastr.error(errMsg.join(' '), 'Ошибка валидации!')
        } else {
            pageImage = null;
        }
        if (typeof json.redirect != 'undefined') document.location.href = urldecode(json.redirect);
        // if (typeof json.msg != 'undefined') $(form).find('[type=submit]').after(autoHideMsg('green', urldecode(json.msg)));
        if (typeof json.msg != 'undefined') toastr.success(json.msg, 'Успешно!');
    });
    return false;
}

function deleteImage(elem, e) {
    e.preventDefault();
    const url = $(elem).attr('href');

    sendAjax(url, {}, function(json) {
       if (json.success) {
           const empty = ' <p class="text-yellow">Изображение не загружено.</p>'
           $('#news-image').html(empty);
       }
    });
}

function deleteNews (elem, e) {
    e.preventDefault();
    const url = $(elem).attr('href');

    sendAjax(url, {}, function (json) {
        if (json.success) {
            const empty = ' <p class="text-yellow">Изображение не загружено.</p>'
            $('#page-image').html(empty);
        }
    });


}

function deleteNewsCategory (elem, e) {
    e.preventDefault();
    const url = $(elem).attr('href');

    sendAjax(url, {}, function (json) {
        if (json.success) {
            $(elem).closest('tr').fadeOut(function () {
                $(this).remove();
            })
        }
    });
}

function addNewsTag (elem, e) {
    e.preventDefault();
    const url = $(elem).data('url');
    const name = $(elem).closest('.row').find('input[name=tag]').val();

    sendAjax(url, {name}, function (json) {
        if (json.success) {
            if (json.item) {
                $('.tags').append(json.item);
            }
            $('input[name=tag]').val('');
        }
    });
}

function addNewsTagEnter(elem, e) {
    //если нажали Enter
    if (e.keyCode === 13) {
        addNewsTag(elem, e)
    }
}

function deleteTag (elem) {
    const url = '/admin/news/delete-tag';
    const news_id = $('input[name=id]').val();
    const tag_item = $(elem).closest('.tag-item');
    const tag_id = $(tag_item).data('id');

    sendAjax(url, {news_id, tag_id}, function (json) {
        if (json.success) {
            $(tag_item).fadeOut(function () {
                $(this).remove();
            })
        }
    });
}
