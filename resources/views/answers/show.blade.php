<div  id="answer-{{$answer->id}}">

    <div class="row">
        <div class="col-md-4">
            <div class="form-group">
                {!! Form::text( 'answer[update]['.$answer->id.'][wording]' , $answer->wording , array( 'class' => 'form-control' , 'placeholder' => "Votre réponse" ) ) !!}
                {!! Form::hidden('answer[update]['.$answer->id.'][order]') !!}

                <button type="button" class="btn btn-outline-secondary icon-btn del-answer" data-anwser="{{$answer->id}}"  data-link="{{action('AnswerController@destroy' , array('id' => $answer->id))}}"><i class="mdi mdi-border-color"></i></button>
            </div>
        </div>
    </div>

    <div class="form-group">

        <div class="col-lg-10">
            <div class="radio">
                {!! Form::label('good1-'.$answer->id, 'Oui', ['class' => '']) !!}
                {!! Form::radio('answer[update]['.$answer->id.'][good]', '1', ($answer->good == 1) , ['id' => 'good1-'.$answer->id]) !!}

            </div>
            <div class="radio">
                {!! Form::label('good0-'.$answer->id, 'Non', ['class' => '']) !!}
                {!! Form::radio('answer[update]['.$answer->id.'][good]', '0', ($answer->good == 0), ['id' => 'good0-'.$answer->id]) !!}
            </div>
        </div>
    </div>

</div>