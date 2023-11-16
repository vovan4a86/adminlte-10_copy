let max_file_size = 10485760;

$(function () {
    $(document).on('click', '.popup-ajax', function (e) {
        e.preventDefault();
        popupAjax($(this).attr('href'));
    });
});
$(document).ready(function () {
    $('.summernote').summernote({
        height: 250
    });
})

//modal window
function popup(content) {
    const modal = '<div class="modal" tabindex="-1" role="dialog">\n' +
        '  <div class="modal-dialog modal-lg" role="document">\n' +
        '    <div class="modal-content">\n' +
        '      <div class="modal-header">\n' +
        '        <button type="button" class="close" data-dismiss="modal" aria-label="Close" onclick="popupClose()">\n' +
        '          <span aria-hidden="true">&times;</span>\n' +
        '        </button>\n' +
        '      </div>\n' +
        '      <div class="modal-body">\n' +
        content +
        '      </div>\n' +
        // '      <div class="modal-footer">\n' +
        // '        <button type="button" onclick="popupClose()" class="btn btn-secondary" data-dismiss="modal">Закрыть</button>\n' +
        // '        <button type="submit" class="btn btn-primary">Сохранить</button>\n' +
        // '      </div>\n' +
        '    </div>\n' +
        '  </div>\n' +
        '</div>'
    $('body').append(modal);
    $('.modal').fadeIn(300);
}

function popupClose(el) {
    if (typeof (el) !== 'undefined') {
        $(el).closest('.modal').fadeOut(300, function () {
            $(this).remove();
        });
    } else {
        $('.modal').fadeOut(300, function () {
            $(this).remove();
        });
    }


    return false;
}

function popupImage(src) {
    popup('<div style="text-align: center;">' +
        '<img class="img-polaroid popup-image" src="' + src + '" alt=""/>' +
        '</div>');
}

function popupAjax(url) {
    sendAjax(url, {}, function (html) {
        popup(html);
    }, 'html');
}

function urldecode(str) {
    return decodeURIComponent((str + '').replace(/\+/g, '%20'));
}

function applyFormValidate(form, ErrMsg) {
    $(form).find('.invalid').attr('title', '').removeClass('invalid');
    for (let key in ErrMsg) {
        $(form).find('[name="' + urldecode(key) + '"]').addClass('invalid').attr('title', urldecode(ErrMsg[key].join(' ')));
    }
    $(form).find('.invalid').eq(0).trigger('focus');
}

function sendAjax(url, data, callback, type) {
    data = data || {};
    if (typeof type == 'undefined') type = 'json';
    $.ajax({
        type: 'post',
        url: url,
        data: data,
        dataType: type,
        beforeSend: function (request) {
            return request.setRequestHeader('X-CSRF-Token', $("meta[name='csrf-token']").attr('content'));
        },
        success: function (json) {
            if (typeof callback == 'function') {
                callback(json);
            }
        },
        error: function (XMLHttpRequest, textStatus, errorThrown) {
            toastr.error('Не удалось выполнить ajax запрос!', 'Ошибка на сервере.');
            console.log(XMLHttpRequest);
        },
    });
}

function sendAjaxProcess(url, data, callback, type) {
    data = data || {};
    if (typeof type == 'undefined') type = 'json';
    $.ajax({
        type: 'post',
        url: url,
        data: data,
        processData: false,
        contentType: false,
        dataType: type,
        beforeSend: function (request) {
            return request.setRequestHeader('X-CSRF-Token', $("meta[name='csrf-token']").attr('content'));
        },
        success: function (json) {
            if (typeof callback == 'function') {
                callback(json);
            }
        },
        error: function (XMLHttpRequest, textStatus, errorThrown) {
            toastr.error('Не удалось выполнить ajax запрос!', 'Ошибка на сервере.');
            console.log(XMLHttpRequest);
        },
    });
}

function sendFiles(url, data, callback, type) {
    if (typeof type == 'undefined') type = 'json';
    $.ajax({
        url: url,
        type: 'POST',
        data: data,
        cache: false,
        dataType: type,
        processData: false, // Don't process the files
        contentType: false, // Set content type to false as jQuery will tell the server its a query string request
        beforeSend: function (request) {
            return request.setRequestHeader('X-CSRF-Token', $("meta[name='csrf-token']").attr('content'));
        },
        success: function (json, textStatus, jqXHR) {
            if (typeof callback == 'function') {
                callback(json);
            }
        },
        error: function (jqXHR, textStatus, errorThrown) {
            toastr.error('Не удалось выполнить ajax запрос!', 'Ошибка на сервере.');
            console.log(XMLHttpRequest);
        }
    });
}

function renderImage(file, callback) {
    var reader = new FileReader();
    reader.onload = function (event) {
        if (typeof callback == 'function') {
            callback(event.target.result);
        }
    };
    reader.readAsDataURL(file);
}

function pageContent(url, ajaxType = 'post') {
    sendAjax(url, {}, function (html) {
        $('#page-content').html(html);
    }, 'html', ajaxType);
    return false;
}

let autoHideMsgNextId = 0;
function autoHideMsg(color, text, time) {
    if (typeof time == 'undefined') time = 5000;
    let id = 'auto-hide-msg-' + (autoHideMsgNextId++);
    let msg = '<div id="' + id + '" class="auto-hide-msg text-' + color + '">' + text + '</div>';
    setTimeout(function () {
        $('#' + id).fadeOut(500, function () {
            $(this).remove();
        });
    }, time);
    return msg;
}
