/*
* Função de sleep
*/
const sleep = (milliseconds) => {
    return new Promise(resolve => setTimeout(resolve, milliseconds))
}
const doSomething = async () => {
    await sleep(1000)
}

const sleepLogin = async () => {
    await sleep(3000)
}

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
    if ( $("#nick").val().length > 3 ) {
        if ( $("#pass").val().length > 2 ) {
            loginCall()
        } else {
            $("#pass").focus()
        }
    } else {
        $("#nick").focus()
    }    
}

/* ------------- Click ------------- */

/*
* Eventos de click
*/
$("#sign-in").click(function() {
    sendData()
});

/*
* 
*/
function loginCall() {
    $.ajax({
        url: './sign-in.php',
        type: 'POST',
        dataType: 'json',
        data: 'nick='+$("#nick").val()+'&pass='+$("#pass").val(),
        beforeSend: function() {
            $("#load")
                .addClass("active")
            ;
        },
        success: function(response) {
            console.log(response)
            if (response.response == "ok")
                window.location.href = "./perfil"
            else
                $("#pass").val("")
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


$('#forgot-passwd')
    .click(function(){
        $('#recovery-login').modal('show')
    })
;
/* ------------- Click ------------- */

/* ------------- Popus ------------- */
/*
* Popus Área
*/
$('#forgot-passwd')
  .popup()
;
/* ------------- Popus ------------- */


/*
* Geral events
*/
$('.message .close')
  .on('click', function() {
    $(this)
      .closest('.message')
      .transition('fade')
    ;
  })
;