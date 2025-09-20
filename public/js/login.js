$(function() {
    $('input').each(function(i, element) {
        if ($(element).attr('required')) {
            $(element).addClass('border border-right-0 border-top-0 border-left-0 border-danger');
            
            $('label[for="' + $(element).attr('id') + '"').append(' <span style="color: red;">*</span>');
        }
    });

    $('form#form').submit(function(e) {
        e.preventDefault();
        
        const formData = new FormData(this);

        $.ajax({
            url: $(this).attr('action'),
            method: $(this).attr('method'),
            data: formData,
            processData: false,
            contentType: false,
            dataType: 'json',
            cache: false,
            beforeSend: function() {
                $('#authBtn').prop('disabled', true);
            },
            success: function(response) {
                $('#msg').html(response.message).hide().fadeIn(2000);

                if (response.error) {
                    $('#msg').removeClass('alert alert-success shadow').addClass('alert alert-warning shadow');
                    return;
                }

                $('#msg').removeClass('alert alert-warning shadow').addClass('alert alert-success shadow');

                window.location.href = 'arealogada/principal';
            },
            error: function(jqXHR, textStatus, errorThrown) {
                console.log(jqXHR, textStatus, errorThrown);
                $('#msg').html('Não foi possível realizar o seu login.').hide().fadeIn(2000);
            },
            complete: function() {
                $('#authBtn').prop('disabled', false);
            }
        });
    });

    $('form#userRegister').submit(function(e) {
        e.preventDefault();
        
        const data = $(this).serialize();

        $.ajax({
            url: $(this).attr('action'),
            method: $(this).attr('method'),
            data: data,
            dataType: 'json',
            cache: false,
            beforeSend: function() {
                $('#registerBtn').prop('disabled', true);
            },
            success: function(response) {
                $('#registerMsg').html(response.message).hide().fadeIn(2000);

                if (response.error) {
                    $('#registerMsg').removeClass('alert alert-success shadow').addClass('alert alert-warning shadow');
                    return;
                }

                $('#registerMsg').removeClass('alert alert-warning shadow').addClass('alert alert-success shadow');

                window.location.href = '/login';
            },
            error: function(jqXHR, textStatus, errorThrown) {
                console.log(jqXHR, textStatus, errorThrown);
                $('#registerMsg').html('Não foi possível realizar o seu cadastro.').hide().fadeIn(2000);
            },
            complete: function() {
                $('#registerBtn').prop('disabled', false);
            }
        });
    });
});