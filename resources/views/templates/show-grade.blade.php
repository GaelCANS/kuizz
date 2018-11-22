<div id="grade-{{$grade->id}}" class="item-grade">

    <div class="row">
        <div class="col-md-4">
            <div class="form-group">

                {!! Form::text( 'grade['.$grade->id.'][name]' , $grade->name , array( 'class' => 'form-control' , 'placeholder' => "Le nom du grade" ) ) !!}
                {!! Form::text( 'grade['.$grade->id.'][step]' , $grade->step , array( 'class' => 'form-control' , 'placeholder' => "Pourentage d'atteinte" ) ) !!}

                <button type="button" class="btn btn-outline-secondary icon-btn del-grade" data-question="{{$template->id}}"  data-link="{{action('GradeController@destroy' , array('id' => $grade->id))}}"><i class="mdi mdi-delete"></i></button>

            </div>
        </div>
    </div>

</div>