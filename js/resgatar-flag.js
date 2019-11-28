
$('body').on('keydown', function(e) {
    if (e.keyCode == 13) {
        resgatarSend()
    }
});

/*
* 
*/
function resgatarSend() {
    if ( $("#flag").val().length > 60 ) {
        resgatarCall()
    } else {
        $("#flag").focus()
    }    
}
/*
* 
*/
function resgatarCall() {
    $.ajax({
        url: './resgatar-flag.php',
        type: 'POST',
        dataType: 'json',
        data: 'token='+$("#flag").val(),
        beforeSend: function() {
            
        },
        success: function(response) {
            if ( response.resgate == "ok" ) {
                $('.ui.positive.message.hidden')
                    .transition('browse')
                ;
            } else {
                $('.ui.negative.message.hidden')
                    .transition('shake')
                ;
            }
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
            $("#flag").val('')
            $("#flag").focus()
        }
    });
}

/* ------------- Click ------------- */

/* ------------- Popus ------------- */
/*
* Popus Área
*/
/* ------------- Popus ------------- */
