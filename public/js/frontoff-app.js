$(document).ready(function(){


    /**
     * Podium
     */
    if ($('#podium').length > 0) {
        reloadPodium()
    }

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
