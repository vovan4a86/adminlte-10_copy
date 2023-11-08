import $ from 'jquery';
// import 'jquery-ui';
import 'jquery.fancytree';
// import './fancytree/jquery.fancytree-all-deps'
// import 'summernote';

export const sendAjax = (url, data, callback, type) => {
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

export const pageContent = (url) => {
    sendAjax(url, {}, function (html) {
        $('#page-content').html(html);
    }, 'html');
    return false;
}

console.log('custom');

//дерево страниц
// const tree = createTree('#tree', {
//     extensions: ['edit', 'filter'],
//     source: {},
// });

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

//файловый инпут
// bsCustomFileInput.init()

// $('#summernote').summernote({
//     height: 400
// });
