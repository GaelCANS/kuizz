@extends('frontoff.app' , array('template' => $quizz->template->stylesheet))

@section('content')

    {!! Form::model(
        null,
        array(
            'class'     => 'form-horizontal',
            'url'       => action('QuizzController@answered' , $quizz->url),
            'method'    => 'Post',
            'id'        => 'quizz-form'
        )
    ) !!}

            <div class="col-md-3">
            </div>

            <div class="col-md-12" id="panel1">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h3 class="panel-title">
                            <span  style="float:left;"><small>{{$question->order}}/{{$quizz->questions->count()}}</small></span>
                            <span class="title-quizz">{{$quizz->comment}}</span>
                            <small style="float:right;width:60px;"><i class="fa fa-clock-o" aria-hidden="true"></i> <span id="getting-started" data-time="{{$quizz->timing}}" class="text-right" style="width:30px;"></span></small>
                        </h3>


                    </div>
                    <div class="panel-body two-col">
                        <span style="margin:20px 0px;display:block">{{$question->wording}}</span>
                        @foreach($question->answers as $answer)
                            <div class="row">
                                <div class="col-md-12">

                                    <div class="well well-sm">
                                        <div class="checkbox">
                                            <label class="@if ($answer->good) oooooook @endif">
                                                <input type="@if ($quizz->single_response == 0){{"radio"}}@else{{"checkbox"}}@endif" name="answer[{{$answer->id}}]" class="btn-answer" value="1">
                                                <?= utf8_encode( $answer['wording'] ) ?>
                                                <span class="icon-result glyphicon glyphicon-<?php echo $answer['is_good'] == '1' ? 'ok' : 'remove' ?>"></span>
                                            </label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                    <div class="panel-footer">
                        <div class="row">
                            <div class="col-md-12">
                                <button type="submit" id="submit-form-btn" class="btn btn-primary btn-sm btn-block">
                                    @if ($question->order != $quizz->questions->count()) {{ trans('quizz.'.$quizz->template->texts.'.next') }} @else {{ trans('quizz.'.$quizz->template->texts.'.end') }} @endif
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>


        </div>

    {!! Form::close() !!}

@endsection