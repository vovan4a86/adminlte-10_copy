// import 'jquery.fancytree/dist/skin-lion/ui.fancytree.css';
import 'jquery-ui';

//https://github.com/mar10/fancytree/
import {createTree} from 'jquery.fancytree';
import 'jquery.fancytree/dist/modules/jquery.fancytree.edit';
import 'jquery.fancytree/dist/modules/jquery.fancytree.filter';
import 'jquery.fancytree/dist/modules/jquery.fancytree.dnd5';
import 'jquery.fancytree/dist/modules/jquery.fancytree.persist';
import './plugins/contextmenu/jquery.contextMenu-custom'

import {renderImage, popup, sendAjax, sendFiles, popupAjax} from "./interface";

import 'summernote';
import 'jquery-contextmenu';
import $ from "jquery"; //https://swisnl.github.io/jQuery-contextMenu/

const tree = createTree('#pages-tree', {
    tooltip: true,
    minExpandLevel: 2,
    extensions: ['dnd5'],
    //перетаскивание
    dnd5: {
        autoExpandMS: 1500,
        preventRecursion: true, // Prevent dropping nodes on own descendants
        preventVoidMoves: true, // Prevent dropping nodes 'before self', etc.

        // --- Drag Support --------------------------------------------------------

        dragStart: function (node, data) {
            // Called on source node when user starts dragging `node`.
            // This method MUST be defined to enable dragging for tree nodes!
            // We can
            //   - Add or modify the drag data using `data.dataTransfer.setData()`.
            //   - Call `data.dataTransfer.setDragImage()` and set `data.useDefaultImage` to false.
            //   - Return false to cancel dragging of `node`.

            // Set the allowed effects (i.e. override the 'effectAllowed' option)
            data.effectAllowed = "all";  // or 'copyMove', 'link'', ...

            // Set a drop effect (i.e. override the 'dropEffectDefault' option)
            // One of 'copy', 'move', 'link'.
            // In order to use a common modifier key mapping, we can use the suggested value:
            data.dropEffect = data.dropEffectSuggested;

            // We could also define a custom image here (not on IE though):
            //data.dataTransfer.setDragImage($("<div>TEST</div>").appendTo("body")[0], -10, -10);
            //data.useDefaultImage = false;

            // Return true to allow the drag operation
            if (node.isFolder()) {
                return false;
            }
            return true;
        },
        dragDrag: function (node, data) {
            // Called on source node every few milliseconds while `node` is dragged.
            // Implementation of this callback is optional and rarely required.
        },
        dragEnd: function (node, data) {
            // Called on source node when the drag operation has terminated.
            // Check `data.isCancelled` to see if a drop occurred.
            // Implementation of this callback is optional and rarely required.
            // Note caveat:
            // If the drop handler removed or moved the dragged source element,
            // `node` and `data` may not contain expected values, or this event
            // is not triggered at all.
        },

        // --- Drop Support --------------------------------------------------------

        dragEnter: function (node, data) {
            // Called on target node when s.th. is dragged over `node`.
            // `data.otherNode` may be a Fancytree source node or null for
            // non-Fancytree droppables.
            // This method MUST be defined to enable dropping over tree nodes!
            //
            // We may
            //   - Set `data.dropEffect` (defaults to '')
            //   - Call `data.setDragImage()`
            //
            // Return
            //   - true to allow dropping (calc the hitMode from the cursor position)
            //   - false to prevent dropping (dragOver and dragLeave are not called)
            //   - a list (e.g. ["before", "after"]) to restrict available hitModes
            //   - a string "over", "before, or "after" to force a hitMode
            //   - Any other return value will calc the hitMode from the cursor position.

            // Example:
            // Prevent dropping a parent below another parent (only sort nodes under
            // the same parent):
            //if(node.parent !== data.otherNode.parent){
            //  return false;
            //}
            // Example:
            // Don't allow dropping *over* a node (which would create a child). Just
            // allow changing the order:
            //return ["before", "after"];

            // Accept everything:
            return true;
        },
        dragOver: function (node, data) {
            // Called on target node every few milliseconds while some source is
            // dragged over it.
            // `data.hitMode` contains the calculated insertion point, based on cursor
            // position and the response of `dragEnter`.
            //
            // We may
            //   - Override `data.hitMode`
            //   - Set `data.dropEffect` (defaults to the value that of dragEnter)
            //     (Note: IE will ignore this and use the value from dragenter instead!)
            //   - Call `data.dataTransfer.setDragImage()`

            // Set a drop effect (i.e. override the 'dropEffectDefault' option)
            // One of 'copy', 'move', 'link'.
            // In order to use a common modifier key mapping, we can use the suggested value:
            data.dropEffect = data.dropEffectSuggested;
        },
        dragExpand: function (node, data) {
            // Called when a dragging cursor lingers over a parent node.
            // (Optional) Return false to prevent auto-expanding `node`.
        },
        dragLeave: function (node, data) {
            // Called when s.th. is no longer dragged over `node`.
            // Implementation of this callback is optional and rarely required.
        },
        dragDrop: function (node, data) {
            // This function MUST be defined to enable dropping of items on the tree.
            //
            // The source data is provided in several formats:
            //   `data.otherNode` (null if it's not a FancytreeNode from the same page)
            //   `data.otherNodeData` (Json object; null if it's not a FancytreeNode)
            //   `data.dataTransfer.getData()`
            //
            // We may access some meta data to decide what to do:
            //   `data.hitMode` ("before", "after", or "over").
            //   `data.dataTransfer.dropEffect`,`.effectAllowed`
            //   `data.originalEvent.shiftKey`, ...
            //
            // Example:

            let transfer = data.dataTransfer;

            node.debug("drop", data);

            if (data.otherNode) {
                // Drop another Fancytree node from same frame
                // (maybe from another tree however)
                let sameTree = (data.otherNode.tree === data.tree);

                data.otherNode.moveTo(node, data.hitMode);
            } else if (data.otherNodeData) {
                // Drop Fancytree node from different frame or window, so we only have
                // JSON representation available
                node.addChild(data.otherNodeData, data.hitMode);
            } else {
                // Drop a non-node
                node.addNode({
                    title: transfer.getData("text")
                }, data.hitMode);
            }
            // Expand target node when a child was created:
            node.setExpanded();
            const parent = node.parent;
            const children = [];
            parent.visit(function (node) {
                children.push(node.key);
            })
            const d = {
                'id': transfer.key,
                'parent': node.key,
                'sorted': children
            }
            sendAjax('/admin/pages/reorder', d, function (json) {
                if (json.success) {
                    // $.ui.fancytree.getTree().reload();
                }
            });
        }
    },
    // сохр. состояние дерева в куки/storage
    // persist: {
    //     // Available options with their default:
    //     cookieDelimiter: "~",    // character used to join key strings
    //     cookiePrefix: undefined, // 'fancytree-<treeId>-' by default
    //     cookie: { // settings passed to jquery.cookie plugin
    //         raw: false,
    //         expires: "",
    //         path: "",
    //         domain: "",
    //         secure: false
    //     },
    //     expandLazy: false, // true: recursively expand and load lazy nodes
    //     expandOpts: undefined, // optional `opts` argument passed to setExpanded()
    //     overrideSource: true,  // true: cookie takes precedence over `source` data attributes.
    //     store: "auto",     // 'cookie': use cookie, 'local': use localStore, 'session': use sessionStore
    //     types: "active expanded focus selected"  // which status types to store
    // },
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
    activate: function (e, data) {
        const node = data.node;
        $("#echoActive").text(node.title);
        if (node.data.href) {
            // pageContent('/admin/pages/edit/' + data.node.key);
            location.href = '/admin/pages/edit/' + data.node.key;
        }
    },
});

$.contextMenu({
    selector: "#pages-tree span.fancytree-title",
    items: {
        "add": {
            name: "Добавить", icon: "add",
            callback: function (key, opt) {
                const node = $.ui.fancytree.getNode(opt.$trigger);
                location.href = '/admin/pages/edit?parent=' + node.key;
            }
        },
        "edit": {
            name: "Редактировать", icon: "edit",
            callback: function (key, opt) {
                const node = $.ui.fancytree.getNode(opt.$trigger);
                location.href = '/admin/pages/edit/' + node.key;
            }
        },
        "delete": {
            name: "Удалить", icon: "delete", disabled: false,
            callback: function (key, opt) {
                const node = $.ui.fancytree.getNode(opt.$trigger);
                if (confirm("Действительно удалить страницу?")) {
                    let url = '/admin/pages/delete/' + node.key;
                    sendAjax(url, {}, function (json) {
                        if (json.success) {
                            node.remove();
                            location.href = '/admin/pages/edit/1'; //главная
                        } else {
                            toastr.error('Не удалось удалить страницу!');
                        }
                    })
                }
            }
        },
    },
    callback: function (itemKey, opt) {
        let node = $.ui.fancytree.getNode(opt.$trigger);
        alert("select " + itemKey + " on " + node);
    }
});

$('.summernote').summernote({
    height: 300
});
// page actions ***********************************
$('#page-form').submit(function (e) {
    e.preventDefault();
    const form = this;
    const url = $(form).attr('action');
    let data = new FormData();
    $.each($(form).serializeArray(), function (key, value) {
        data.append(value.name, value.value);
    });
    // $.each(settingFiles, function (key, value) {
    //     data.append(key, value);
    // });

    const image = $(form).find('#image')[0].files[0];
    if (image) {
        data.append('image', image);
    }

    sendFiles(url, data, function (json) {
        if (typeof json.errors != 'undefined') {
            applyFormValidate(form, json.errors);
            let errMsg = [];
            for (let key in json.errors) {
                errMsg.push(json.errors[key]);
            }
            $(form).find('[type=submit]').after(autoHideMsg('red', urldecode(errMsg.join(' '))));
            toastr.error('Ошибка!');
        }
        if (typeof json.redirect != 'undefined') document.location.href = json.redirect;
        if (typeof json.msg != 'undefined') {
            toastr.success(json.msg);
            // $(form).find('[type=submit]').after(autoHideMsg('green', urldecode(json.msg)));
        }
        if (typeof json.row != 'undefined') {
            let id = $('#page-id').val();
            $('#pages-tree li[data-id=' + id + '] .tree-item').replaceWith(urldecode(json.row));
            let parent = $('#page-content [name=parent_id]').val();
            let cur_parent = $('#pages-tree li[data-id=' + id + ']').closest('ul').closest('li').data('id') || 0;
            if (cur_parent != parent) {
                let item = $('#pages-tree li[data-id=' + id + ']').clone();
                $('#pages-tree li[data-id=' + id + ']').remove();
                if (parent == 0) {
                    $('#pages-tree > .tree-lvl').append(item);
                } else {
                    $('#pages-tree li[data-id=' + parent + '] > ul').append(item);
                }
            }
            // console.log('id = ' + id + ', parent = ' + parent + ', cur_parent = ' + cur_parent);
        }
    });
    return false;
});

$('#image').change((e) => {
    const container = $('#page-image');
    const image_file = e.target.files[0];

    if(image_file['size'] > 10 * 1024 * 1024) {
        toastr.error('Максимальный размер изображения 10 Мб.');
    } else {
        renderImage(image_file, function (src) {
            const item = '<img class="img-polaroid" src="' + src + '" height="100" alt="page_image">';
            $(container).html(item);
        });
    }
})

$(document).ready(function () {
    $('.popup-ajax').click((e) => {
        e.preventDefault();
        const url = $(this).find('.popup-ajax').attr('href');
        popupAjax(url);
    })
})

//tests
$('.toast-btn').click((e) => {
    e.preventDefault();
    toastr.success('Успешно!');
})

$('.popup-btn').click(() => {
    popup('Модальное окно с инфой.')
})

//так не работает, подгружаем в php файле <script>
// export const applySummernote = () => {
//     $('.summernote').summernote({
//         height: 300
//     });
// }
// applySummernote();
