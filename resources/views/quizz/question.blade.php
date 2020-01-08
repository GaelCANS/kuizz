@extends('frontoff.app' , array('template' => $quizz->template))

@section('content')

    {!! Form::model(
        null,
        array(
            'class'         => 'form-horizontal',
            'url'           => action('QuizzController@answered' , $quizz->url),
            'method'        => 'Post',
            'id'            => 'quizz-form',
            'data-dr'       => $quizz->display_responses,
            'data-submit'   => 0,
            'data-resptime' => $quizz->response_delay > 0 ? $quizz->response_delay*1000 : 1500,
            'data-mod'      => $modulo
        )
    ) !!}


    <div class="col-12" id="panel1">
        <div class="panel panel-default">
            <div class="panel-heading">
                <h3 class="panel-title">
                    <div class="row">
                        <span class="col-xs-12 col-md-2"><small>{{$question->displayOrder($quizz)}}/{{$quizz->countQuestion}}</small></span>
                        <div class="qcr-m" style="display: none">
                            <div class="qcr" data-qcr="{{24*$modulo}}">{{$question->response}}</div>
                            <div class="qcr" data-qcr="{{24*$modulo+1}}">{{$response_false}}</div>
                        </div>
                        <span class="cold-xs-12 col-md-8 title-quizz">{{$quizz->comment}}</span>
                        <span class="col-xs-12 col-md-2"><i class="fa fa-clock-o" aria-hidden="true"></i> <span id="getting-started" data-time="{{$quizz->timing}}" class="text-right" style="width:30px;"></span></span>
                    </div>
                </h3>


            </div>
            <div class="panel-body two-col text-center">
                <div id="bulb-container">
                    <span id="bulb-timer"></span>
                    <img src="{{ URL::to('/') }}/img/bulb.png" width="100px" id="bulb">
                </div>
                <span style="margin:20px 0px;display:block" class="wording-question">{{$question->wording}}</span>

                <div class="answers-content">
                    @foreach($question->answers->shuffle() as $answer)
                        <div class="row">
                            <div class="col-md-12">

                                <div class="well well-sm">
                                    <div class="checkbox">
                                        <label class="question-answer" @if ($quizz->display_response == 0) data-sr="@if ($answer->good){{22*$modulo}}@else{{22*$modulo+1}}@endif" @endif>
                                            @if ($quizz->single_response == 0)
                                                <input type="radio" name="answer" class="btn-answer" value="{{$answer->id}}">
                                            @else
                                                <input type="checkbox" name="answer[{{$answer->id}}]" class="btn-answer" value="1">
                                            @endif
                                            <?= ( $answer['wording'] ) ?>
                                            <span class="icon-result glyphicon glyphicon-{{ rand(0,1) == '1' ? 'ok' : 'remove' }}"></span>
                                        </label>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>




            <div class="panel-footer">
                <div class="row">
                    <div class="col-md-12">
                        <button type="submit" id="submit-form-btn" class="btn btn-primary btn-sm btn-block">
                            @if ($question->isLast($quizz)) {{ trans('quizz.'.$quizz->template->texts.'.next') }} @else {{ trans('quizz.'.$quizz->template->texts.'.end') }} @endif
                        </button>

                        <button type="button" id="submit-form-btn-2" class="btn btn-primary btn-sm btn-block" style="display: none">
                            @if ($question->isLast($quizz)) {{ trans('quizz.'.$quizz->template->texts.'.next') }} @else {{ trans('quizz.'.$quizz->template->texts.'.end') }} @endif
                        </button>

                    </div>
                </div>
            </div>
        </div>
    </div>


    </div>


    {!! Form::close() !!}

@endsection