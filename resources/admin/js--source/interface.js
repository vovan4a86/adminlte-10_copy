export const sendAjax = (url, data, callback, type) => {
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
            toastr.error('Не удалось выполнить ajax запрос!', 'Ошибка на сервере.')
            console.log(XMLHttpRequest);
        },
    });
}

export const sendAjaxProcess = (url, data, callback, type) => {
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
            toastr.error('Не удалось выполнить ajax запрос!', 'Ошибка на сервере.')
            console.log(XMLHttpRequest);
        },
    });
}

export const pageContent = (url) => {
    sendAjax(url, {}, function (html) {
        $('#page-content').html(html);
    }, 'html');
    return false;
}

let autoHideMsgNextId = 0;
export const autoHideMsg = (color, text, time) => {
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
