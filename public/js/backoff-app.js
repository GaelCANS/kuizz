$(document).ready(function(){

    /**
     * Commun
     *
     * Initialisation du select2
     */
    $('select[multiple]').select2();
    $('select.select2').select2();


    /**
     * Quizz
     */
    $('#container-questions').on('click' , '.del-question' , function () {
        if(confirm("Voulez-vous supprimer cette question ?")) {

            var link = $(this).data('link');
            var id = $(this).data('question');

            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            $.ajax({
                    method: "DELETE",
                    url: link,
                    data: {}
                })
                .done(function( data ) {
                    $('#question-'+data.id).remove();
                });
        }
    });

});