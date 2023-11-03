$('#user_form').on('submit', function (e) {
    e.preventDefault();
    const url = $(this).attr('action');
    let data = $(this).serialize();
    // data.append( 'file', $( '#file' )[0].files[0] );

    $.ajax({
        method: 'POST',
        url: url,
        data: data,
        dataType: 'json',
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        beforeSend: function (xhr) {
            // xhr.overrideMimeType("text/plain; charset=x-user-defined");
        },
        success: function (data) {
            if (data.errors) {
                let errMsg = [];
                for (let key in data.errors) {
                    errMsg.push(data.errors[key]);
                }
                $('#answer').append(autoHideMsg('red', urldecode(errMsg.join(' | '))));
            }
            if (data.success) {
                $('#answer').append(autoHideMsg('green', urldecode(data.msg)));
            }
        },
        error: function (data) {
            console.error(data.errors);
        }
    })
})

