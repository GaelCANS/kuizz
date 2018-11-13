<div id="tpl-answer" class="d-none">
    <div class="new-answer item-answer">

        <div class="row">
            <div class="col-md-4">
                <div class="form-group">
                    {!! Form::text( 'answer[create][wording][]' , "" , array( 'class' => 'form-control' , 'placeholder' => "Votre réponse" ) ) !!}
                    {!! Form::hidden('answer[create][order][]' , "" , array('class' => 'answer-order')) !!}
                    {!! Form::hidden('answer[create][question_id][]' , "QUESTION_ID" , array('class' => 'answer-question-id')) !!}

                    <button type="button" class="btn btn-outline-secondary icon-btn del-answer" data-answer="create"><i class="mdi mdi-border-color"></i></button>
                </div>
            </div>
        </div>

        <div class="form-group">

            <div class="col-lg-10">
                <div class="radio">
                    {!! Form::label('create1-UNIQID', 'Oui', ['class' => '']) !!}
                    {!! Form::radio('answer[create][good][]', '1', false , ['id' => 'create1-UNIQID']) !!}

                </div>
                <div class="radio">
                    {!! Form::label('create0-UNIQID', 'Non', ['class' => '']) !!}
                    {!! Form::radio('answer[create][good][]', '0', true, ['id' => 'create0-UNIQID']) !!}
                </div>
            </div>
        </div>

    </div>
</div>