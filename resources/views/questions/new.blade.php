<li id="tpl-question" class=" new-question d-none">
    <div class="row">
        <div class="col-md-4">
            <div class="form-group">
                <h6>Question n°<span class="order"></span></h6>
                {!! Form::text( 'question[create][][wording]' , "" , array( 'class' => 'form-control' , 'placeholder' => "Votre question" ) ) !!}
                {!! Form::hidden('question[update][][order]' , "" , array('class' => 'question-order')) !!}

                <button type="button" class="btn btn-outline-secondary icon-btn del-question" data-question="create"><i class="mdi mdi-border-color"></i></button>

                <div class="row">
                    <div class="form-group">
                        <div class="col-md-12">
                            <button type="button" class="btn btn-secondary add-answer">
                                <i class="fa fa-fw fa-save"></i>Nouvelle réponse
                            </button>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>

    <div class="container-answers">
    </div>
</li>