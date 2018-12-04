@extends('mails.layout' , array('template' => $quizz->template))

@section('content')

    <table cellpadding="32" cellspacing="0" border="0" align="center" style="border-collapse: collapse; mso-table-lspace: 0pt; mso-table-rspace: 0pt; background: white; border-radius: 0.5rem; margin-bottom: 1rem;">
        <tr>
            <td width="546" valign="top" style="border-collapse: collapse;text-align: left">
                <div style="max-width: 600px; margin: 0 auto;text-align: left">

                    <div style="background: white;text-align: left; border-radius: 0.5rem; margin-bottom: 1rem;" align="">

                        <p>{{ trans('quizz.'.$quizz->template->texts.'.mail-bonjour') }} {{$user->name}}</p>
                        <p>{{ trans('quizz.'.$quizz->template->texts.'.mail-intro' , array('name' => $quizz->name) ) }}</p>

                        <ul>
                            @foreach($quizz->questions as $question)
                                <li>
                                    {{$question->wording}}
                                    @if (trim($question->comment) != '')
                                        <br><small>{{$question->comment}}</small>
                                    @endif
                                </li>
                                @php
                                $question->load('Answers')
                                @endphp
                                <ul>
                                    @foreach($question->answers as $answer)
                                        <li style="color:@if($answer->good)green @else red @endif";>
                                            <input type="checkbox" disabled @if(\App\Answer::hasAnswered($answer->id, $user->id)) checked @endif>
                                            {{$answer->wording}}
                                        </li>
                                    @endforeach
                                </ul>
                            @endforeach
                        </ul>

                        <p>{{ trans('quizz.'.$quizz->template->texts.'.mail-outro') }}</p>


                    </div>

                </div>
            </td>
        </tr>
    </table>

@endsection