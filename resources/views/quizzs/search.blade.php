{!! Form::model( $data , [ 'class' => 'form-horizontal' , 'url' => route("filter-quizz" ) , 'method' => "post" ] ) !!}
<div class="row">
    <div class="col-lg-10 col-md-12 grid-margin">
        <div class="card bg-transparent">
            <div class="row">
                <div class="col-md-4">
                    {!! Form::select('user',$users , null, ['class' => ' js-states form-control toggle-tous force-placeholder', 'data-allow-clear' => 'true' ]) !!}
                </div>
                <div class="col-md-4">
                    <li class="btn-group ml-auto mr-0 border-0">
                        {!! Form::text('keywords' , null , array("class"=>"form-control", "placeholder"=>"Rechercher")) !!}
                    </li>
                </div>
                <div class="col-md-4">
                    <a href="{{route('clear-filter-quizz')}}"><button type="button" class="btn btn-info icon-btn">Effacer</button></a>
                    <button type="submit" class="btn btn-primary icon-btn">Filtrer</button>
                </div>

            </div>
        </div>
    </div>
</div>

{!! Form::close() !!}