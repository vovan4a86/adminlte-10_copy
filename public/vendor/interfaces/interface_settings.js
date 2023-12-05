// $(function () {
// $('.setting-items-list').sortable({handle: '.handle'});
// $('.setting-gal-list').sortable({handle: '.images_move'});
// })

function settingsGroupEdit(elem){
	var block = $(elem).closest('li');
	block.find('.text a').hide();
	block.find('.tools').hide();
	block.find('.text').css('width', '85%');
	block.find('.text form').show().find('[name=name]').trigger('focus');
}

function settingsGroupCreate(form){
	let url = $(form).attr('action');
	let data = $(form).serialize();
	sendAjax(url, data, function(json){
		if (typeof json.view != 'undefined') {
			$('#setting-groups').append(urldecode(json.view));
		}
		if (typeof json.success != 'undefined' && json.success === true) {
			$(form).find('[name=name]').val('');
		}
	});
	return false;
}

function settingsGroupSave(form){
	let url = $(form).attr('action');
	let data = $(form).serialize();
	sendAjax(url, data, function(json){
		if (typeof json.view != 'undefined') {
			$(form).closest('li').replaceWith(urldecode(json.view));
		}
	});
	return false;
}

function settingsGroupDel(elem){
	if (!confirm('Удалить группу со всеми настройками?')) return false;
	let url = $(elem).data('url');
	sendAjax(url, {}, function(json){
		if (typeof json.success != 'undefined' && json.success === true) {
			$(elem).closest('li').fadeOut(300, function(){
			    $(this).remove();
			    location.href = json.location
			});
		}
	});
	return false;
}

function settingsSave(form, e){
	e.preventDefault();

	let url = $(form).attr('action');
	let data = new FormData();
	$.each($(form).serializeArray(), function(key, value){
	    data.append(value.name, value.value);
	});
	$.each(settingFiles, function(key, value){
	    data.append(key, value);
	});
	sendFiles(url, data, function(json){
		if (typeof json.redirect != 'undefined') document.location.href = urldecode(json.redirect);
		if (typeof json.msg != 'undefined') $(form).find('[type=submit]').after(autoHideMsg('green', urldecode(json.msg)));
		if (typeof json.success != 'undefined' && json.success == true) {
			settingFiles = {};
		}
	});
}

function settingsListItemAdd(elem){
	let row = $(elem).closest('table').find('tfoot tr:first').html();
	$(elem).closest('table').find('tbody').append('<tr>'+row+'</tr>');
	$(elem).closest('table').find('tbody').find('.s-editor').each(function(){
		let id = $(this).attr('id')+$(elem).closest('table').find('tbody').find('tr').length;
		$(this).removeClass('s-editor').attr('id', id);
		startCkeditor(id);
	});
	return false;
}

function settingsListItemDel(elem){
	$(elem).closest('tr').fadeOut(300, function(){ $(this).remove(); });
	return false;
}

function settingsFileDel(elem, e){
	e.preventDefault();
	if (!confirm('Удалить файл?')) return false;
	let value = $(elem).closest('.s-file-field').find('.s-file-field-value').val();
	if (/setting_file_/.test(value)) {
		delete settingFiles[value];
	}
	$(elem).closest('.s-file-field').find('.s-file-field-value').val('');
	$(elem).closest('.s-file-field').find('.s-file-item').html('');
}

let settingFiles = {};
let settingFileNextId = 0;
function settingAttacheGalleryImage(elem, e){
    $.each(e.target.files, function(key, file)
    {
        if(file['size'] > max_file_size){
            alert('Слишком большой размер файла. Максимальный размер 2Мб');
        } else {
            let field = 'setting_file_'+settingFileNextId;
            settingFiles[field] = file;
            settingFileNextId++;

            renderImage(file, function(imgSrc){
                let row = '<span class="images_item">'+
                    '<input type="hidden" name="'+$(elem).attr('name')+'" value="'+field+'">'+
                    '<span class="images_move"><i class="fa fa-arrows"></i></span>'+
                    '<img class="img-polaroid" src="'+imgSrc+'" style="cursor:pointer;" onclick="popupImage($(this).attr(\'src\'))">'+
                    '<a class="images_del" href="#" onclick="settingGalleryImageDel(this, event)"><span class="glyphicon glyphicon-trash"></span></a>'+
                    '</span>';

                $(elem).closest('.form-group').find('.setting-gal-list').append(row);
            });
        }
    });
    $('elem').val('');
}

function settingAttacheFile(elem, e){
    let value = $(elem).closest('.s-file-field').find('.s-file-field-value').val();
    if (/setting_file_/.test(value)) {
        delete settingFiles[value];
    }

    let name = $(elem).attr('name');
    let field = 'setting_file_'+settingFileNextId;
    settingFileNextId++;
    $.each(e.target.files, function(key, file)
    {
        if(file['size'] > max_file_size){
            alert('Слишком большой размер файла. Максимальный размер 2Мб');
        } else {
            settingFiles[field] = file;
            if (/image/.test(file.type)) {
                renderImage(file, function(imgSrc){
                    let row = '<span class="images_item">'+
                        '<img class="img-polaroid" src="'+imgSrc+'" style="cursor:pointer;" onclick="popupImage($(this).attr(\'src\'))">'+
                        '<a class="images_del" href="#" onclick="settingsFileDel(this, event)"><span class="glyphicon glyphicon-trash"></span></a>'+
                        '</span>';

                    $(elem).closest('.s-file-field').find('.s-file-item').html(row);
                });
            } else {
                let row = '<div class="margin">'+
                    '<span>Файл прикреплен</span>'+
                    '<a class="text-red" href="#" onclick="settingsFileDel(this, event)"><i class="fa fa-fw fa-trash-o"></i> удалить файл</a>'+
                    '</div>';

                $(elem).closest('.s-file-field').find('.s-file-item').html(row);
            }
        }
    });
    $(elem).val('');
    $(elem).closest('.s-file-field').find('.s-file-field-value').val(field);
}

function settingGalleryImageDel(elem, e){
	e.preventDefault();

	let block = $(elem).closest('.images_item');
	let file = block.find('input').val();
	if (typeof settingFiles[file] != 'indefined') delete settingFiles[file];
	block.remove();
}

function settingsSaveEdit(form, e){
	e.preventDefault();
	const url = $(form).attr('action');
	let data = $(form).serialize();
	let id = $(form).find('[name=id]').val();
	let group_id = $(form).find('[name=group_id]').val();
	sendAjax(url, data, function(json){
		if (typeof json.errors != 'undefined') {
			applyFormValidate(form, json.errors);
			let errMsg = [];
			for (let key in json.errors) { errMsg.push(json.errors[key]);  }
            toastr.error(errMsg.join(' '), 'Ошибка валидации!')
		}
		if (typeof json.msg != 'undefined') toastr.success(json.msg, 'Успешно!');

        if (typeof json.row != 'undefined') {
			if ($('.setting-item[data-id="'+id+'"]').length) $('.setting-item[data-id="'+id+'"]').replaceWith(urldecode(json.row));
			else $('#settings-group-'+group_id).append(urldecode(json.row));
		}
		if (typeof json.success != 'undefined' && json.success === true) {
			popupClose();
		}
	});
}

function settingsBlocParams(elem, e){
	let id = $(elem).closest('form').find('[name=id]').val();
	let type = $(elem).val();
	let url = $(elem).data('url');

	sendAjax(url, {id: id, type: type}, function(html){
		$('#setting-params').html(html);
	}, 'html');
}
