<ul>
@foreach($quizz->questions as $question)
    <li>{{$question->wording}}</li>
    @php
    $question->load('Answers')
    @endphp
    <ul>
        @foreach($question->answers as $answer)
            <li class="@if($answer->good)good @else wrong @endif">
                <input type="checkbox" disabled @if(\App\Answer::hasAnswered($answer->id, $user->id)) checked @endif>
                {{$answer->wording}}
            </li>
        @endforeach
    </ul>
@endforeach
</ul>
