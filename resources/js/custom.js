function sendAjax(url, data, callback, type){
    data = data || {};
    if (typeof type == 'undefined') type = 'json';
    $.ajax({
        type: 'post',
        url: url,
        data: data,
        // processData: false,
        // contentType: false,
        dataType: type,
        beforeSend: function(request) {
            return request.setRequestHeader('X-CSRF-Token', $("meta[name='csrf-token']").attr('content'));
        },
        success: function(json){
            if (typeof callback == 'function') {
                callback(json);
            }
        },
        error: function(XMLHttpRequest, textStatus, errorThrown){
            alert('Не удалось выполнить запрос! Ошибка на сервере.');
        },
    });
}

//добавить в корзину товар со страницы товара
$('.box-quantity .add-cart').click(function (e) {
    e.preventDefault();
    const btn = $(this);
    const url = $(this).closest('form').attr('action');
    const id = $(this).data('id');
    const qnt = $(this).closest('form').find('.number').val();

    sendAjax(url, {id, qnt}, function (json) {
       if (json.success) {
           $('.header-cart').replaceWith(json.header_cart)
           btn.text('В корзине');
           btn.attr('disabled', true);
       }
    });
})

//добавить товар с карточки товара
$('.add-cart-card').click(function (e) {
    e.preventDefault();
    const btn = $(this);
    const url = $(btn).attr('href');
    const id = $(this).closest('.single-product').data('id');

    sendAjax(url, {id, qnt: 1}, function (json) {
       if (json.success) {
           $('.header-cart').replaceWith(json.header_cart)
           btn.text('В корзине');
           btn.addClass('added');
       }
    });
})

//в список желаний
$('.favorites').click(function (e) {
    e.preventDefault();
    const btn = $(this);
    const url = $(btn).attr('href');
    const id = $(this).closest('.single-product').data('id');

    sendAjax(url, {id}, function (json) {
       if (json.success && json.added) {
           $('.header-favorites').replaceWith(json.header_favorites)
           btn.attr('title', 'В списке желаний');
           btn.addClass('added');
       } else if (json.success && json.added === false) {
           $('.header-favorites').replaceWith(json.header_favorites)
           btn.attr('title', 'В список желаний');
           btn.removeClass('added');
        }
    });
})

//удалить товар из корзины в шапке
$('.single-cart-box .del-icone').click(function (e) {
    e.preventDefault();
    const id = $(this).closest('.single-cart-box').data('id');
    const url = $(this).attr('href');

    sendAjax(url, {id}, function (json) {
        if (json.success) {
            $('.header-cart').replaceWith(json.header_cart)
        }
    });
})

//удалить товар из корзины
$('.cart-item-remove').click(function (e) {
    e.preventDefault();
    const tr = $(this).closest('tr');
    const id = $(tr).data('id');
    const url = $(this).attr('href');

    sendAjax(url, {id}, function (json) {
        if (json.success) {
            $('.header-cart').replaceWith(json.header_cart)
            tr.fadeOut(300, function(){ $(this).remove(); });
        }
    });
})

//изменение количества товара в корзине
$('.product-quantity input').change(function () {
    let qnt = $(this).val();
    const id = $(this).closest('tr').data('id');
    const url = '/ajax/cart/update/'

    if (!qnt || qnt <= 0) {
        qnt = 1;
        $(this).val('1');
    }

    sendAjax(url, {id, qnt}, function (json) {
        if (json.success) {
            $('.product-subtotal.val').text(json.current);
            $('.cart-subtotal .amount, .order-total .amount').text(json.total);
        }
    });
});

//отправка заказа
$('#checkout').submit(function (e) {
    e.preventDefault();
    const form = $(this);
    const url = $(form).attr('action');

    const data = $(form).serialize();

    sendAjax(url, data, function (json) {
       if (json.success && json.redirect) {
           location.href = json.redirect;
       }
    });
})

//количество товаров на странице
$('.page-sorter').change(function () {
   const per_page = $(this).find('option:selected').val();
   const url = $(this).data('url');

   location.href = url + '/?per_page=' + per_page;
});

//клик по стрелочке сортировки
$('.sorter-direction .fa').click(function () {
    let sort_direction = 'asc';
    if ($(this).hasClass('fa-arrow-up')) {
        $(this).removeClass('fa-arrow-up')
        $(this).addClass('fa-arrow-down')
    } else {
        $(this).removeClass('fa-arrow-down')
        $(this).addClass('fa-arrow-up')
        sort_direction = 'desc';
    }

    const sorter = $(this).closest('.toolbar-sorter').find('.name-sorter');
    const sort_by = $(sorter).find('option:selected').val();
    const url = $(sorter).data('url');

    location.href = url + '/?sort_by=' + sort_by + '&sort_direction=' + sort_direction;
})

//сортировка
$('.name-sorter').change(function () {
    const sort_by = $(this).find('option:selected').val();
    const url = $(this).data('url');

    const sort_direction = $('.sorter-direction .fa').hasClass('fa-arrow-down') ? 'asc' : 'desc';

    location.href = url + '/?sort_by=' + sort_by + '&sort_direction=' + sort_direction;
});
