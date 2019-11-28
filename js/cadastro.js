/*
* 
*/
$('body').on('keydown', function(e) {
    if (e.keyCode == 13) {
        sendData()
    }
});

/*
* 
*/
function sendData() {
    var color = $('input[name=color]')
    for (i = 0; i < color.length; i++) {
        if (color[i].checked == true)
            var color_select = color[i].value
    }
    if ( $('#nick').val().length > 3 ) {
        if ( $('#pass').val().length > 2 ) {
            if ( $('#apelido').val().length > 4 ) {
                if ( $('#description').val().length > 6 ) {
                    if ( $('#token').val().length > 10 ) {
                        cadastroCall(color_select);//cadastroCall()
                    } else {
                        $('#token').focus()
                    }
                } else {
                    $('#description').focus()
                }
            } else {
                $('#apelido').focus()
            }
        } else {
            $('#pass').focus()
        }
    } else {
        $('#nick').focus()
    }    
}

/* ------------- Click ------------- */

/*
* Eventos de click
*/
$('#sign-up').click(function() {
    sendData()
});

/*
* 
*/
function cadastroCall(color) {
    $.ajax({
        url: './sign-up.php',
        type: 'POST',
        dataType: 'json',
        data: 'nick='+$("#nick").val()+'&pass='+$("#pass").val()+
        '&apelido='+$('#apelido').val()+'&description='+$('#description').val()+
        '&token='+$('#token').val()+'&img='+$('#img-selec').attr('data-img')+
        '&color='+color,
        beforeSend: function() {
            $("#load")
                .addClass("active")
            ;
        },
        success: function(response) {
            console.log(response)
        },
        error: function() {
            $('#error-modal')
                .modal({
                    inverted: true
                })
                .modal('show')
            ;
        },
        complete: function() {
            $("#load")
                .removeClass("active")
            ;
        }
    });
}


/* ------------- Click ------------- */

/* ------------- Popus ------------- */
/*
* Geral events
*/
