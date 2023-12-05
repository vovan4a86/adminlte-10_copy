import $ from 'jquery';
import '../plugins/jquery.autocomplete.min';
import {showCompleteDialog} from './popups'

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
            console.error(errorThrown);
            alert('Не удалось выполнить запрос! Ошибка на сервере.');
        },
    });
}

export const sendAjaxWithFile = (url, data, callback, type) => {
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
            console.error(errorThrown);
            alert('Не удалось выполнить запрос! Ошибка на сервере.');
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
        error: function (jqXHR, textStatus, errorThrown) {
            console.error(errorThrown);
            alert('Не удалось выполнить запрос! Ошибка на сервере.');
        }
    });
}

export const popupClose = (el) => {
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

export const resetForm = (form) => {
    $(form).trigger('reset');
    $(form).find('.err-msg-block').remove();
    $(form).find('.has-error').remove();
    $(form).find('.invalid').attr('title', '').removeClass('invalid');
}

//Обратный звонок
$('#callback').submit(function (e) {
    e.preventDefault();
    var form = $(this);
    var data = form.serialize();
    var url = form.attr('action');
    sendAjax(url, data, function (json) {
        if (typeof json.errors !== 'undefined') {
            let focused = false;
            for (var key in json.errors) {
                if (!focused) {
                    form.find('#' + key).focus();
                    focused = true;
                }
                form.find('#' + key).after('<span class="has-error">' + json.errors[key] + '</span>');
            }
            form.find('.popup__action').after('<div class="err-msg-block has-error">Заполните, пожалуйста, обязательные поля.</div>');
        } else {
            resetForm(form);
            form.find('.is-close').click();
            showCompleteDialog();
        }
    });
});
$('.b-callback__grid').submit(function (e) {
    e.preventDefault();
    var form = $(this);
    var data = form.serialize();
    var url = form.attr('action');
    sendAjax(url, data, function (json) {
        if (typeof json.errors !== 'undefined') {
            let focused = false;
            for (var key in json.errors) {
                if (!focused) {
                    form.find('#' + key).focus();
                    focused = true;
                }
                form.find('#' + key).after('<span class="has-error">' + json.errors[key] + '</span>');
            }
            form.find('.b-callback__item').after('<div class="err-msg-block has-error">Заполните, пожалуйста, обязательные поля.</div>');
        } else {
            resetForm(form);
            form.find('.is-close').click();
            showCompleteDialog();
        }
    });
});

//Отправить заявку в свободной форме
$('#message').submit(function (e) {
    e.preventDefault();
    var form = $(this);
    var data = form.serialize();
    var url = form.attr('action');
    sendAjax(url, data, function (json) {
        if (typeof json.errors !== 'undefined') {
            let focused = false;
            for (var key in json.errors) {
                if (!focused) {
                    form.find('#' + key).focus();
                    focused = true;
                }
                form.find('#' + key).after('<span class="has-error">' + json.errors[key] + '</span>');
            }
            form.find('.popup__action').after('<div class="err-msg-block has-error">Заполните, пожалуйста, обязательные поля.</div>');
        } else {
            resetForm(form);
            form.find('.is-close').click();
            showCompleteDialog();
        }
    });
});
//Заявка
$('.b-form__body').submit(function (e) {
    e.preventDefault();
    var form = $(this);
    var data = form.serialize();
    var url = form.attr('action');
    sendAjax(url, data, function (json) {
        if (typeof json.errors !== 'undefined') {
            let focused = false;
            for (var key in json.errors) {
                if (!focused) {
                    form.find('#' + key).focus();
                    focused = true;
                }
                form.find('#' + key).after('<span class="has-error">' + json.errors[key] + '</span>');
            }
            form.find('.b-form__action').after('<div class="err-msg-block has-error">Заполните, пожалуйста, обязательные поля.</div>');
        } else {
            resetForm(form);
            form.find('.is-close').click();
            showCompleteDialog();
        }
    });
});

//Загрузить каталог
$('#catalog-file').change(function (e) {
    e.preventDefault();
    let id = $(this).data('id');
    let url = '/ajax/catalog-file-add/';
    var inputFile = $('input[name=file]');
    var data = new FormData();
    data.append('id', id);
    data.append('catfile', inputFile.prop('files')[0]);

    sendAjaxWithFile(url, data, function (json) {
        if (json.success) {
            $('#catalog-file-box').replaceWith(json.file);
            inputFile.val('');
        } else {
            alert('Ошибка загрузки файла');
        }
    });
})

//autocomplete search
$('.header__search .h-search__input').autocomplete({
    serviceUrl: '/search',
    onSelect: function (suggestion) {
        document.location.href = suggestion.data.url;
    },
    ajaxSettings: {
        dataType: 'json',
    },
    paramName: 'q',
    minLength: 3,
    transformResult: function (response) {
        return {
            suggestions: $.map(response.data, function (dataItem) {
                return {
                    value: dataItem.name, data: {
                        name: dataItem.name,
                        url: dataItem.url,
                    }
                };
            })
        };
    }
});

///////// Cart ///////////
let Cart = {
    add: function (id, count, callback) {
        sendAjax('/ajax/add-to-cart',
            {id, count}, (result) => {
                if (typeof callback == 'function') {
                    callback(result);
                }
            });
    },

    update: function (id, count, callback) {
        sendAjax('/ajax/update-to-cart',
            {id, count}, (result) => {
                if (typeof callback == 'function') {
                    callback(result);
                }
            });
    },

    edit: function (id, count, callback) {
        sendAjax('/ajax/edit-cart-product',
            {id, count}, (result) => {
                if (typeof callback == 'function') {
                    callback(result);
                }
            });
    },

    remove: function (id, callback) {
        sendAjax('/ajax/remove-from-cart',
            {id: id}, (result) => {
                if (typeof callback == 'function') {
                    callback(result);
                }
            });
    },

    purge: function (callback) {
        sendAjax('/ajax/purge-cart',
            {}, (result) => {
                if (typeof callback == 'function') {
                    callback(result);
                }
            });
    },
}

//cart item add
$('.product__order.btn-reset').click(function () {
    const elem = $(this);
    if ($(elem).prop('disabled')) return;
    const id = $(elem).data('id');
    Cart.add(id, 1, function (res) {
        if (res.success) {
            $('.link-basket').replaceWith(res.header_cart);
            $('.header-mob__basket').innerHTML(res.header_cart_mob);
            $('.product__order').replaceWith(res.btn);
        }
    }.bind(this));
});

//cart item delete
$('.order-view__delete.btn-reset').click(function () {
    const elem = $(this);
    const id = $(elem).closest('.order-view__row').data('id');
    Cart.remove(id, function (res) {
        $(elem).closest('.order-view__row').fadeOut(300, function () {
            $(elem).remove();
        });
        $('.link-basket').replaceWith(res.header_cart);
        $('.header-mob__basket').innerHTML(res.header_cart_mob);
    })
});

//cart item +
$('.counter__btn.counter__btn--next.btn-reset').click(function () {
    const elem = $(this);
    let val = $(elem).closest('.counter').find('.counter__input').val();
    const id = $(elem).closest('.order-view__row').data('id');
    val++;
    Cart.update(id, val, function (res) {
        if (!res.success) {
            console.log(res.error)
        }
    });
});

//cart item -
$('.counter__btn.counter__btn--prev.btn-reset').click(function () {
    const elem = $(this);
    let val = $(elem).closest('.counter').find('.counter__input').val();
    const id = $(elem).closest('.order-view__row').data('id');
    if (val > 1) {
        val--;
    }
    Cart.update(id, val, function (res) {
        if (!res.success) {
            console.log(res.error)
        }
    });
});

//send order
$('.order__container').submit(function (e) {
	e.preventDefault();
	let form = $(this);
	let data = $(form).serialize();
	let url = $(form).attr('action');
	sendAjax(url, data, function (json) {
		if (typeof json.errors != 'undefined') {
			// validForm($(form), json.errors);
			let errMsg = [];
			for (var key in json.errors) {
				errMsg.push(json.errors[key]);
			}
			var strError = errMsg.join('<br />');
			$(form).find('.order__data').after('<div class="err-msg-block">' + strError + '</div>');
		}
		if (json.success !== true) {
			console.log('Что-то не так');
		} else {
			location.href = json.redirect;
		}
	})
});
