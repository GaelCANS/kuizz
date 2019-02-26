<li id="question-{{$question->id}}" class="item-question">
    <div class="row">
        <div class="col-12">
            <div class="form-group">
                <h6 data-toggle="collapse" data-target="#content-{{$question->id}}">Question n°<span class="order">{{$question->order}}</span></h6>
                {!! Form::text( 'question[update]['.$question->id.'][wording]' , $question->wording , array( 'class' => 'form-control' , 'placeholder' => "Votre question" ) ) !!}
                {!! Form::hidden('question[update]['.$question->id.'][order]' , $question->order , array('class' => 'question-order')) !!}



            </div>
        </div>
    </div>

    <div class="collapse"  id="content-{{$question->id}}">

        <div class="row">
            <div class="col-12">
                <div class="form-group">

                    <div class="col-md-12" style="margin-bottom: 20px">
                        {!! Form::text( 'question[update]['.$question->id.'][comment]' , $question->comment , array( 'class' => 'form-control' , 'placeholder' => "Un commentaire ?" ) ) !!}
                    </div>

                    <div class="col-md-12">
                        {!! Form::textarea( 'question[update]['.$question->id.'][response]' , $question->response , array( 'class' => 'form-control response-detail' , 'placeholder' => "Une explication visible pour la réponse" ) ) !!}
                    </div>

                    <button type="button" class="btn btn-outline-secondary icon-btn del-question" data-question="{{$question->id}}"  data-link="{{action('QuestionController@destroy' , array('id' => $question->id))}}"><i class="mdi mdi-delete"></i></button>

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
    </div>
</li>