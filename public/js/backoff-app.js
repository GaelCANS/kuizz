$(document).ready(function(){

    /**
     * Commun
     *
     * Initialisation du select2
     */
    $('select[multiple]').select2()
    $('select.select2').select2()


    /**
     * Quizz - question
     */
    $('#container-questions').on('click' , '.del-question' , function () {
        if(confirm("Voulez-vous supprimer cette question ?")) {
            if ($(this).data('question') == 'create') {
                deteleNewQuestion($(this));
            }
            else {
                deleteQuestion($(this));
            }
        }
    })

    /**
     * Quizz - question
     */
    $('#add-question').on('click' , function () {
        addQuestion($(this))
    })

    /**
     * Quizz - answer
     */
    $('#container-questions').on('click' , '.add-answer' , function () {
        addAnswer($(this))
    })

    /**
     * Quizz - answer
     */
    $('#container-questions').on('click' , '.del-answer' , function () {
        if(confirm("Voulez-vous supprimer cette réponse ?")) {
            if ($(this).data('answer') == 'create') {
                deteleNewAnswer($(this))
            }
            else {
                deleteAnswer($(this))
            }
        }
    })


    /**
     * Quizz - question
     */
    $(".sortable").sortable({
        placeholder: "ui-state-highlight",
        stop: refreshQuestionOrder,
    });

});


/**
 * Quizz - question
 */
function refreshQuestionOrder()
{
    var i = 1
    $('#container-questions .item-question').each(function(){
        $(this).find('.question-order').val(i)
        $(this).find('span.order').text(i)
        i++
    })

    refreshAnswerOrder()
}


/**
 * Quizz - answer
 */
function refreshAnswerOrder()
{
    $('#container-questions .item-question').each(function () {
        var i = 1
        $(this).find('.item-answer').each(function () {
            $(this).find('.answer-order').val(i)
            i++
        })

    })

}

/**
 * Quizz - question
 */
function deleteQuestion(obj)
{
    var link = obj.data('link')
    var id = obj.data('question')

    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    })

    $.ajax({
            method: "DELETE",
            url: link,
            data: {}
        })
        .done(function( data ) {
            removeItem($('#question-'+data.id))
            refreshQuestionOrder()
        })
}

/**
 * Quizz - question
 */
function deteleNewQuestion(obj)
{
    removeItem(obj.parent('.new-question'))
    refreshQuestionOrder()
}

/**
 * Quizz - answer
 */
function deleteAnswer(obj)
{
    var link = obj.data('link')
    var id = obj.data('answer')

    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    })

    $.ajax({
            method: "DELETE",
            url: link,
            data: {}
        })
        .done(function( data ) {
            removeItem($('#answer-'+data.id))
            refreshAnswerOrder()
        })
}

/**
 * Quizz - answer
 */
function deteleNewAnswer(obj)
{
    removeItem(obj.parents('.new-answer'))
    refreshAnswerOrder()
}

/**
 * Commun
 *
 * Destruction d'un élément
 */
function removeItem(selector)
{
    selector.remove()
}

/**
 * Quizz- question
 */
function addQuestion(obj)
{
    var link = obj.data('link')
    var id = $('#container-questions').data('quizz')

    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    })

    $.ajax({
            method: "POST",
            url: link,
            data: {quizz_id:id}
        })
        .done(function( data ) {
            $('#container-questions').append(data.html)
        })
}

/**
 * Quizz- answer
 */
function addAnswer(obj)
{
    var link = obj.data('link')
    var id = obj.parents('.item-question').attr('id').replace('question-','')

    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    })

    $.ajax({
            method: "POST",
            url: link,
            data: {question_id:id}
        })
        .done(function( data ) {
            $('#question-'+data.question_id+' .container-answers').append(data.html)

            $('#question-'+data.question_id+' .container-answers').sortable({
                placeholder: "ui-state-highlight",
                stop: refreshQuestionOrder,
            });
        })
}