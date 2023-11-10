let pageImage = null;

function pageImageAttache(elem, e){
    $.each(e.target.files, function(key, file)
    {
        if(file['size'] > max_file_size){
            alert('Слишком большой размер файла. Максимальный размер 2Мб');
        } else {
            pageImage = file;
            renderImage(file, function (imgSrc) {
                const item = '<img class="img-polaroid" src="' + imgSrc + '" height="100" data-image="' + imgSrc + '" ' +
                    'onclick="return popupImage($(this).data(\'image\'))" alt="">';
                $('#page-image').html(item);
            });
        }
    });
    $(elem).val('');
}

function pageSave(form, e) {
    e.preventDefault();
    const url = $(form).attr('action');
    let data = new FormData();
    $.each($(form).serializeArray(), function (key, value) {
        data.append(value.name, value.value);
    });
    $.each(settingFiles, function (key, value) {
        data.append(key, value);
    });

    if (pageImage) {
        data.append('image', pageImage);
    }

    sendFiles(url, data, function (json) {
        if (typeof json.errors != 'undefined') {
            applyFormValidate(form, json.errors);
            var errMsg = [];
            for (var key in json.errors) {
                errMsg.push(json.errors[key]);
            }
            $(form).find('[type=submit]').after(autoHideMsg('red', urldecode(errMsg.join(' '))));
        } else {
            pageImage = null;
        }
        if (typeof json.redirect != 'undefined') document.location.href = urldecode(json.redirect);
        if (typeof json.msg != 'undefined') $(form).find('[type=submit]').after(autoHideMsg('green', urldecode(json.msg)));
        if (typeof json.success != 'undefined' && json.success === true) {
            settingFiles = {};
        }
    });
    return false;
}

function deleteImage(elem, e) {
    e.preventDefault();
    const url = $(elem).attr('href');

    sendAjax(url, {}, function(json) {
       if (json.success) {
           const empty = ' <p class="text-yellow">Изображение не загружено.</p>'
           $('#page-image').html(empty);
       }
    });


}
