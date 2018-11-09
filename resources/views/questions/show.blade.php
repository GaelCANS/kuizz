<div class="row">
    <div class="col-md-4">
        <div class="form-group">
            <h6>Question n°{{$question->order}}</h6>
            {!! Form::text( 'question[update]['.$question->id.'][wording]' , $question->wording , array( 'class' => 'form-control' , 'placeholder' => "Votre question" ) ) !!}
            {!! Form::hidden('question[update]['.$question->id.'][order]') !!}
        </div>
    </div>
</div>

<div class="container-answers">
    @forelse($question->answers as $answer)
        @include('answers.show')
        @empty
    @endforelse
</div>