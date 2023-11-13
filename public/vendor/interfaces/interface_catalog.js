let catalogImage = null;

function bindContextMenu(span) {
    // Add context menu to this node:
    $(span).contextMenu({menu: "catalogContext"}, function (action, el, pos) {
        // The event was bound to the <span> tag, but the node object
        // is stored in the parent <li> tag
        let node = $.ui.fancytree.getNode(el);
        switch (action) {
            case "add":
                // pageContent('/admin/catalog/edit?parent=' + node.key);
                document.location.href = '/admin/catalog/edit?parent=' + node.key
                break;
            case "edit":
                // pageContent('/admin/catalog/edit/' + node.key, 'get');
                document.location.href = '/admin/catalog/edit/' + node.key
                break;
            case "delete":
                if (confirm("Действительно удалить страницу?")) {
                    let url = '/admin/catalog/delete/' + node.key;
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
                alert("Todo: apply action '" + action + "' to node " + node);
        }
    });
}
$("#catalog-tree").fancytree({
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
        store: "local",     // 'cookie': use cookie, 'local': use localStore, 'session': use sessionStore
        types: "expanded"  // which status types to store
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
            const children = [];
            parent.visit(function (node) {
                children.push(node.key);
            })
            const d = {
                'id': node.key,
                'parent': parent.key,
                'sorted': children
            }
            sendAjax('/admin/catalog/reorder', d, function (json) {
                if (json.success) {
                    $.ui.fancytree.getTree().reload();
                } else {
                    toastr.error('Проблема с сортировкой', 'Ошибка!');
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
        url: '/admin/catalog/get-catalog-tree',
        cache: false
    },
    activate: function (e, data) {
        const node = data.node;
        if (node.data.href) {
            window.location.href = '/admin/catalog/products/' + data.node.key;
            // pageContent('/admin/catalog/products/' + data.node.key);
        }
    },
});

function catalogImageAttache(elem, e){
    $.each(e.target.files, function(key, file)
    {
        if(file['size'] > max_file_size){
            alert('Слишком большой размер файла. Максимальный размер 10Мб');
        } else {
            catalogImage = file;
            renderImage(file, function (imgSrc) {
                const item = '<img class="img-polaroid" src="' + imgSrc + '" height="100" data-image="' + imgSrc + '" ' +
                    'onclick="return popupImage($(this).data(\'image\'))" alt="image">';
                $('#catalog-image').html(item);
            });
        }
    });
    $(elem).val('');
}

function updateOrder(form, e) {
    e.preventDefault();
    let button = $(form).find('[type="submit"]');
    button.attr('disabled', 'disabled');
    let url = $(form).attr('action');
    let data = $(form).serialize();
    sendAjax(url, data, function (json) {
        button.removeAttr('disabled');
    });
}

function catalogSave(form, e) {
    e.preventDefault();
    const url = $(form).attr('action');
    let data = new FormData();
    $.each($(form).serializeArray(), function (key, value) {
        data.append(value.name, value.value);
    });

    if (catalogImage) {
        data.append('image', catalogImage);
    }

    sendFiles(url, data, function (json) {
        if (typeof json.errors != 'undefined') {
            applyFormValidate(form, json.errors);
            let errMsg = [];
            for (let key in json.errors) {
                errMsg.push(json.errors[key]);
            }
            toastr.error(errMsg.join(' '), 'Ошибка валидации!')
        } else {
            catalogImage = null;
        }
        if (typeof json.redirect != 'undefined') document.location.href = urldecode(json.redirect);
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
           $('#catalog-image').html(empty);
       }
    });


}

function productDelete(elem) {
    if (!confirm('Удалить товар?')) return false;
    var url = $(elem).attr('href');
    sendAjax(url, {}, function (json) {
        if (typeof json.msg != 'undefined') alert(urldecode(json.msg));
        if (json.success) {
            $(elem).closest('tr').fadeOut(300, function () {
                $(this).remove();
            });
        }
    });
    return false;
}

