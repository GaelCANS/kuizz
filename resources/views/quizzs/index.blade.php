@extends('backoff.app')

@section('content')

    <h4 class="page-title d-none">Quizz</h4>
    <a href="{{action('QuizzController@create')}}"><button type="button" class="btn btn-secondary btn-xs mb-2" title="Ajouter">+ Ajouter un quizz</button></a>

    <div class="row">
        <div class="col-12 grid-margin">
            <div class="card">
                <div class="card-body">
                    <div class="row">
                        <div class="col-12">
                            <div class="table-responsive">
                                <table class="table table-hover ajax-action">
                                    <thead>
                                    <tr>
                                        <th>Nom</th>
                                        <th>Responsable</th>
                                        <th>Template</th>
                                        <th>Actions</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @forelse($quizzs as $quizz)
                                        <tr>
                                            <th>{{$quizz->name}}</th>
                                            <th>--</th>
                                            <th>{{$quizz->template}}</th>
                                            <th>
                                                <a href="{{action("QuizzController@show" , $quizz)}}" title="Modifier"><button type="button" class="btn btn-outline-secondary icon-btn"><i class="mdi mdi-border-color"></i></button></a>
                                                <a href="{{action("QuizzController@destroy" , $quizz)}}"  title="Supprimer" data-confirm="Voulez-vous vraiment supprimer" data-method="delete"><button type="button" class="btn btn-outline-secondary icon-btn"><i class="mdi mdi-delete"></i></button></a>
                                            </th>
                                        </tr>
                                    @empty
                                    @endforelse
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>


@endsection
