import $ from 'jquery';
import {test} from "./pages";

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

export const sendFiles = (url, data, callback, type) => {
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
        error: function (XMLHttpRequest, textStatus, errorThrown) {
            toastr.error('Не удалось выполнить ajax запрос!', 'Ошибка на сервере.')
            console.log(XMLHttpRequest);
            // alert('Не удалось выполнить запрос! Ошибка на сервере.');
        }
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

export const renderImage = (file, callback) => {
    let reader = new FileReader();
    reader.onload = function (event) {
        if (typeof callback == 'function') {
            callback(event.target.result);
        }
    };
    reader.readAsDataURL(file);
}

//https://bootstrap-4.ru/docs/4.0/components/modal/#via-javascript
//есть большие и малые размеры
export const popup = (content, title = 'Информация', callback) => {
    const modal = '<div class="modal fade" tabindex="-1" role="dialog">\n' +
        '  <div class="modal-dialog modal-lg" role="document">\n' +
        '    <div class="modal-content">\n' +
        '      <div class="modal-header">\n' +
        '        <h5 class="modal-title">' + title + '</h5>\n' +
        '        <button type="button" class="close" data-dismiss="modal" aria-label="Close">\n' +
        '          <span aria-hidden="true">&times;</span>\n' +
        '        </button>\n' +
        '      </div>\n' +
        '      <div class="modal-body">\n' +
        content +
        '      </div>\n' +
        // '      <div class="modal-footer">\n' +
        // '        <button type="button" class="btn btn-secondary" data-dismiss="modal">Закрыть</button>\n' +
        // '      </div>\n' +
        '    </div>\n' +
        '  </div>\n' +
        '</div>';
    $('body').append(modal);
    $('.modal').modal({
        'backdrop': false,
        'show': true
    });
    $('.close').click(function () {
        $(this).closest('.modal').fadeOut(300, function () {
            $(this).remove();
        })
    });

    if (typeof callback == 'function') {
        callback();
    }
}

export const popupAjax = (url, title, callback) => {
    sendAjax(url, {}, function (html) {
        popup(html, title, callback);
    }, 'html');
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
