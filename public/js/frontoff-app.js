$(document).ready(function(){


    /**
     * Podium
     */
    if ($('#podium').length > 0) {
        reloadPodium()
    }

    /**
     * Quizz
     */
    if ($('#getting-started').length > 0) {
        timer()
    }

    /**
     * Quizz
     */
    $('#submit-form-btn-2').on('click',function () {
        $('#quizz-form').data('submit',1)
    })

    /**
     * Quizz
     */
    $('#quizz-form').on('submit', function (e) {
        var form = this
        $('#submit-form-btn').attr('disabled' , true)
        e.preventDefault()
        if ($('#quizz-form').data('dr') == 1) {
            var response_delay = 1500
            //var response_delay = $('#quizz-form').data('resptime')

            showResp()
            var qrc = getQRC()

            // Show explain case
            if (qrc != '') {

                showQRC(qrc)
                
                var downloadTimer = setInterval(function(){

                    if ($('#quizz-form').data('submit') != 0)
                        form.submit()

                },1000);

            }
            // Show reponse
            else {
                setTimeout(function () {
                    form.submit()
                }, response_delay)
            }

        }
            // Std case
        else {
            form.submit()
        }
    } )

});


/**
 * Template- grade
 */
function addGrade(obj)
{
    var link = obj.data('link')
    var id = obj.data('template')

    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    })

    $.ajax({
            method: "POST",
            url: link,
            data: {template_id:id}
        })
        .done(function( data ) {
            $('#container-grades').append(data.html)
        })
}


/**
 * Podium
 */
function reloadPodium()
{
    var link = $('#podium').data('link')

    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    })

    $.ajax({
            method: "POST",
            url: link,
            data: {}
        })
        .done(function( data ) {
            $('#podium').html(data.html)
            $('#podium').attr('ids',data.ids)
            $('#nb-participants').html(data.participants)
        })

    setTimeout(reloadPodium,9000);
}




/**
 * Question
 */
function timerBulb(timeleft)
{
    var downloadTimer = setInterval(function(){

        /*if(timeleft <= 0)
         $('#quizz-form').submit();
         else*/
        $("#bulb-timer").text(--timeleft)
    },1000);
}

/**
 * Question
 */
function timer()
{

    var timeleft = $('#getting-started').data('time');
    if (timeleft == 0) return false
    var downloadTimer = setInterval(function(){

        if(timeleft <= 0)
            $('#quizz-form').submit();
        else
            $("#getting-started").text(0 + --timeleft)
    },1000);

    return false
    // Création de la date à J+30 secondes
    var futur=new Date()
    var timer = $('#getting-started').data('time')

    if (timer > 0) {
        futur.setSeconds(futur.getSeconds() + timer)

        // Création de la date au format attendu
        var timerEnd =
            futur.getFullYear().toString() +
            '/' +
            (futur.getMonth() + 1) +
            '/' +
            _.pad(futur.getDate(), 2, '0') +
            ' ' +
            _.pad(futur.getHours(), 2, '0') +
            ':' +
            _.pad(futur.getMinutes(), 2, '0') +
            ':' +
            _.pad(futur.getSeconds(), 2, '0')

        // Init du compte à rebours
        $("#getting-started")
            .countdown(timerEnd, function (event) {
                    console.log(event.strftime())
                    $(this).text(
                        event.strftime('%S')
                    )
                }
            )

        $("#getting-started").on('finish.countdown', function () {
            $('#quizz-form').submit();
        })
    }
}



/**
 * Question
 */
function submitForm(form)
{
    console.log(form)
    console.log('submitform')

    if ($('#quizz-form').data('submit') == 1)  {
        $('#quizz-form').submit()
    }
    else {
        console.log('on passe pas')
        //submitForm(form)
    }
}

/**
 * Question
 */
function getQRC()
{
    var qrc = ''
    var mdl = $('#quizz-form').data('mod')
    $('.qcr-m .qcr').each(function () {
        if ($(this).data('qcr')%mdl == 0) {
            var str = $(this).text()
            qrc = CryptoJS.AES.decrypt(str.toString(), 'maloo');
            qrc = qrc.toString(CryptoJS.enc.Utf8)
        }
    })
    return qrc
}

/**
 * Question
 */
function showResp()
{
    var mdl = $('#quizz-form').data('mod')
    $('.question-answer').each(function () {
        $(this).addClass( ($(this).data('sr')%mdl == 0) ? "oooook" : "kooooo" )
    })
}

/**
 * Question
 */
function showQRC(qrc)
{
    $('.answers-content').fadeOut(1500, function () {
        var widthPB = $('.panel-body').css('width')
        $('.panel-body').append('<small class="text-left">'+qrc+'</small>').css('width',widthPB).addClass('panel-body-idea')
        $('#bulb-container').show()
        //timerBulb(response_delay/1000-1)
        $('#submit-form-btn').hide()
        $('#submit-form-btn-2').show()
    })
}