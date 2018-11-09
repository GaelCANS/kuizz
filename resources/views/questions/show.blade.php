<div id="question-{{$question->id}}">
    <div class="row">
        <div class="col-md-4">
            <div class="form-group">
                <h6>Question n°{{$question->order}}</h6>
                {!! Form::text( 'question[update]['.$question->id.'][wording]' , $question->wording , array( 'class' => 'form-control' , 'placeholder' => "Votre question" ) ) !!}
                {!! Form::hidden('question[update]['.$question->id.'][order]') !!}

                <button type="button" class="btn btn-outline-secondary icon-btn del-question" data-question="{{$question->id}}"  data-link="{{action('QuestionController@destroy' , array('id' => $question->id))}}"><i class="mdi mdi-border-color"></i></button>

            </div>
        </div>
    </div>

    <div class="container-answers">
        @forelse($question->answers as $answer)
            @include('answers.show')
            @empty
        @endforelse
    </div>
</div>