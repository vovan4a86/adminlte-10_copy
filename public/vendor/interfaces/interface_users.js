function userSave(form, e){
    e.preventDefault();

    const url = $(form).attr('action');
    const data = $(form).serialize();

    sendAjax(url, data, function(json){
        if (typeof json.errors != 'undefined') {
            applyFormValidate(form, json.errors);
            let errMsg = [];
            for (let key in json.errors) { errMsg.push(json.errors[key]);  }
            toastr.error(errMsg.join(' '), 'Ошибка валидации!')
        }
        if (typeof json.redirect != 'undefined') document.location.href = urldecode(json.redirect);
        if (typeof json.msg != 'undefined') toastr.success(json.msg, 'Успешно!');
    });
}

function userDelete(elem, e){
    e.preventDefault();
    if (!confirm('Удалить пользователя?')) return false;
    let url = $(elem).attr('href');
    sendAjax(url, {}, function(json){
        if (json.success === true) {
            $(elem).closest('tr').fadeOut(300, function(){
                $(this).remove();
                toastr.success('Пользователь удален.', 'Успешно!')
            });
        } else {
            toastr.error('Невозможно удалить пользователя.', 'Ошибка!')
        }
    });
}
