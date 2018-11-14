<li id="question-{{$question->id}}" class="item-question">
    <div class="row">
        <div class="col-md-4">
            <div class="form-group">
                <h6>Question n°<span class="order">{{$question->order}}</span></h6>
                {!! Form::text( 'question[update]['.$question->id.'][wording]' , $question->wording , array( 'class' => 'form-control' , 'placeholder' => "Votre question" ) ) !!}
                {!! Form::hidden('question[update]['.$question->id.'][order]' , $question->order , array('class' => 'question-order')) !!}

                <button type="button" class="btn btn-outline-secondary icon-btn del-question" data-question="{{$question->id}}"  data-link="{{action('QuestionController@destroy' , array('id' => $question->id))}}"><i class="mdi mdi-border-color"></i></button>

                <div class="row">
                    <div class="form-group">
                        <div class="col-md-12">
                            <button type="button" class="btn btn-secondary add-answer" data-link="{{ action('AnswerController@store') }}">
                                <i class="fa fa-fw fa-save"></i>Nouvelle réponse
                            </button>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>

    <ul class="container-answers sortable">
        @forelse($question->answers as $answer)
            @include('answers.show')
            @empty
        @endforelse
    </ul>
</li>