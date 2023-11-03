// import $ from "jquery";
// import {createTree} from 'jquery.fancytree';
// import 'jquery.fancytree/dist/modules/jquery.fancytree.edit';
// import 'jquery.fancytree/dist/modules/jquery.fancytree.filter';

function urldecode(str) {
    return decodeURIComponent((str + '').replace(/\+/g, '%20'));
}

function sendAjax(url, data, callback, type) {
    data = data || {};
    if (typeof type == 'undefined') type = 'json';
    $.ajax({
        type: 'post',
        url: url,
        data: data,
        // processData: false,
        // contentType: false,
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
            alert('Не удалось выполнить запрос! Ошибка на сервере.');
        },
    });
}

function pageContent(url) {
    sendAjax(url, {}, function (html) {
        $('#page-content').html(html);
    }, 'html');
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

// const tree = createTree('#tree', {
//     source: {
//         url: '/admin/pages/get-pages-tree',
//         cache: false
//     },
//     activate: function (e, data) {
//         const node = data.node;
//         $("#echoActive").text(node.title);
//         if (node.data.href) {
//             // window.open(node.data.href, node.data.target);
//             pageContent('/admin/pages/edit/' + data.node.key);
//         }
//     }
// });

console.log('123');
$("#tree").fancytree({
    ajax: {
        type: "GET",
        cache: false, // false: Append random '_' argument to the request url to prevent caching.
        // timeout: 0, // >0: Make sure we get an ajax error if server is unreachable
        dataType: "json", // Expect json format and pass json object to callbacks.
    },
    source: {
        url: '/admin/pages/get-pages-tree',
        cache: false
    },
    activate: function(e, data) {
        const node = data.node;
        $("#echoActive").text(node.title);
        if( node.data.href ){
            // window.open(node.data.href, node.data.target);
            pageContent('/admin/pages/edit/' + data.node.key);
        }
    }
});
