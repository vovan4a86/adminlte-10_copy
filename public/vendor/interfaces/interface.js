var max_file_size = 10097152;
$(function () {
    $(document).on('click', '.popup-ajax', function (e) {
        e.preventDefault();
        popupAjax($(this).attr('href'));
    });
});

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
    popup('<img class="img-polaroid popup-image" src="' + src + '"/>');
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
    for (var key in ErrMsg) {
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
            alert('Не удалось выполнить запрос! Ошибка на сервере.');
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
            alert('Не удалось выполнить запрос! Ошибка на сервере.');
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


// --- Implement Cut/Copy/Paste --------------------------------------------
var clipboardNode = null;
var pasteMode = null;

function copyPaste(action, node) {
    switch (action) {
        case "cut":
        case "copy":
            clipboardNode = node;
            pasteMode = action;
            break;
        case "paste":
            if (!clipboardNode) {
                alert("Clipoard is empty.");
                break;
            }
            if (pasteMode == "cut") {
                // Cut mode: check for recursion and remove source
                var cb = clipboardNode.toDict(true);
                if (node.isDescendantOf(cb)) {
                    alert("Cannot move a node to it's sub node.");
                    return;
                }
                node.addChildren(cb);
                node.render();
                clipboardNode.remove();
            } else {
                // Copy mode: prevent duplicate keys:
                var cb = clipboardNode.toDict(true, function (dict, node) {
                    dict.title = "Copy of " + dict.title;
                    delete dict.key; // Remove key, so a new one will be created
                });
                alert("cb = " + JSON.stringify(cb));
//        node.addChildren(cb);
//                node.render();
                node.applyPatch(cb);
            }
            clipboardNode = pasteMode = null;
            break;
        default:
            alert("Unhandled clipboard action '" + action + "'");
    }
}

// --- Contextmenu helper --------------------------------------------------
function bindContextMenu(span) {
    // Add context menu to this node:
    $(span).contextMenu({menu: "myMenu"}, function (action, el, pos) {
        // The event was bound to the <span> tag, but the node object
        // is stored in the parent <li> tag
        var node = $.ui.fancytree.getNode(el);
        switch (action) {
            case "add":
                // alert(node.key)
                pageContent('/admin/pages/edit?parent=' + node.key);
                break;
            case "edit":
                pageContent('/admin/pages/edit/' + node.key);
                break;
            case "delete":
                if (confirm("Действительно удалить страницу?")) {
                    var url = '/admin/pages/delete/' + node.key;
                    sendAjax(url, {}, function (json) {
                        if (json.success) {
                            node.remove();
                        } else {
                            alert(json.msg);
                        }
                    })
                }
                break;
            default:
                alert("Todo: appply action '" + action + "' to node " + node);
        }
    });
}

$(document).ready(function () {
    $("#tree").fancytree({
        extensions: ["dnd", "persist"],
        click: function (event, data) {
            // Close menu on click
            if ($(".contextMenu:visible").length > 0) {
                $(".contextMenu").hide();
         return false;
            }
        },
        createNode: function (event, data) {
            bindContextMenu(data.node.span);
        },
        /*Bind context menu for every node when its DOM element is created.
          We do it here, so we can also bind to lazy nodes, which do not
          exist at load-time. (abeautifulsite.net menu control does not
          support event delegation)*/
        //сохр. состояние дерева в куки/storage
        persist: {
            // Available options with their default:
            cookieDelimiter: "~",    // character used to join key strings
            cookiePrefix: undefined, // 'fancytree-<treeId>-' by default
            cookie: { // settings passed to jquery.cookie plugin
                raw: false,
                expires: "",
                path: "",
                domain: "",
                secure: false
            },
            expandLazy: false, // true: recursively expand and load lazy nodes
            expandOpts: undefined, // optional `opts` argument passed to setExpanded()
            overrideSource: true,  // true: cookie takes precedence over `source` data attributes.
            store: "auto",     // 'cookie': use cookie, 'local': use localStore, 'session': use sessionStore
            types: "active expanded focus selected"  // which status types to store
        },
        //drag'n'drop
        dnd: {
            autoExpandMS: 400,
            draggable: { // modify default jQuery draggable options
                zIndex: 1000,
                scroll: false,
                containment: "parent",
                revert: "invalid"
            },
            preventRecursiveMoves: true, // Prevent dropping nodes on own descendants
            preventVoidMoves: true, // Prevent dropping nodes 'before self', etc.

            dragStart: function (node, data) {
                // This function MUST be defined to enable dragging for the tree.
                // Return false to cancel dragging of node.
                //    if( data.originalEvent.shiftKey ) ...
                //    if( node.isFolder() ) { return false; }
                return true;
            },
            dragEnter: function (node, data) {
                /* data.otherNode may be null for non-fancytree droppables.
                 * Return false to disallow dropping on node. In this case
                 * dragOver and dragLeave are not called.
                 * Return 'over', 'before, or 'after' to force a hitMode.
                 * Return ['before', 'after'] to restrict available hitModes.
                 * Any other return value will calc the hitMode from the cursor position.
                 */
                // Prevent dropping a parent below another parent (only sort
                // nodes under the same parent):
                //    if(node.parent !== data.otherNode.parent){
                //      return false;
                //    }
                // Don't allow dropping *over* a node (would create a child). Just
                // allow changing the order:
                //    return ["before", "after"];
                // Accept everything:
                return true;
            },
            dragExpand: function (node, data) {
                // return false to prevent auto-expanding data.node on hover
            },
            dragOver: function (node, data) {
            },
            dragLeave: function (node, data) {
            },
            dragStop: function (node, data) {
                const parent = node.parent;
                const d = {
                    'id': node.key,
                    'parent': parent.key,
                    // 'sorted': parent.children
                }
                sendAjax('/admin/pages/reorder', d, function (json) {
                    if (json.success) {
                        $.ui.fancytree.getTree().reload();
                    }
                });
            },
            dragDrop: function (node, data) {
                // This function MUST be defined to enable dropping of items on the tree.
                // data.hitMode is 'before', 'after', or 'over'.
                // We could for example move the source to the new target:
                data.otherNode.moveTo(node, data.hitMode);
            }
        },
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
                // window.open(node.data.href, node.data.target);
                pageContent('/admin/pages/edit/' + data.node.key);
            }
        },
    });


    $('#summernote').summernote({
        height: 200
    });
    bsCustomFileInput.init();
});
