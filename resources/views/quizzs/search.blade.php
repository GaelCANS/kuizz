{!! Form::model( $data , [ 'class' => 'form-horizontal' , 'url' => route("filter-quizz" ) , 'method' => "post" ] ) !!}
<div class="row">
    <div class="col-7 grid-margin mx-auto"style="border: 1px solid #fff;border-radius: 4px;padding: 15px;">
        <div class="card bg-transparent">
            <div class="row">

                <div class="col-4">
                    <h6>Créateur</h6>
                    {!! Form::select('user',$users , null, ['class' => ' js-states form-control toggle-tous force-placeholder', 'data-allow-clear' => 'true', ]) !!}
                </div>
                <div class="col-4">
                    <h6>Nom</h6>
                    <li class="btn-group">
                        {!! Form::text('keywords' , null , array("class"=>"form-control", "placeholder"=>"Rechercher")) !!}
                    </li>
                </div>
                <div class="col-4 text-right pt-4">
                    <a href="{{route('clear-filter-quizz')}}"><button type="button" class="btn btn-info icon-btn">Effacer</button></a>
                    <button type="submit" class="btn btn-primary icon-btn">Filtrer</button>
                </div>

            </div>
        </div>
    </div>
</div>

{!! Form::close() !!}