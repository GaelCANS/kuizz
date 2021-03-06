@extends('backoff.app')

@section('content')
    <div class="row">
        <h2 class="page-title text-center d-inline-block mx-auto pb-4">Liste des Quizz <a href="{{action('QuizzController@create')}}" class="ml-3 ">
                <button type="button" class="btn btn-secondary btn-xs" title="Ajouter">+ Créer un quizz</button>
            </a></h2>

    </div>

            @include('quizzs.search')

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
                                        <th>Créateur</th>
                                        <th>Thème</th>
                                        <th>Actions</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @forelse($quizzs as $quizz)
                                        <tr>
                                            <th>{{$quizz->name}}</th>
                                            <th>{{utf8_decode($quizz->user->name)}}</th>
                                            <th>{{$quizz->template->name}}</th>
                                            <th>
                                                <a href="{{action("QuizzController@show" , $quizz)}}" title="Modifier"><button type="button" class="btn btn-outline-secondary icon-btn"><i class="mdi mdi-border-color"></i></button></a>
                                                <a href="{{action("QuizzController@duplicate" , $quizz)}}" title="Dupliquer"><button type="button" class="btn btn-outline-secondary icon-btn"><i class="mdi mdi-content-copy"></i></button></a>
                                                <a href="{{action("QuizzController@destroy" , $quizz)}}"  title="Supprimer" data-confirm="Voulez-vous vraiment supprimer" data-method="delete"><button type="button" class="btn btn-outline-secondary icon-btn"><i class="mdi mdi-delete"></i></button></a>
                                                <a href="javascript:;" data-link="{{action("QuizzController@send" , $quizz)}}" class="send-quizz @if ($quizz->sendable == 0) disabled @endif" title="Envoyer les réponses/diplômes" ><button type="button" class="btn btn-outline-secondary icon-btn"><i class="mdi mdi-send"></i></button></a>
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

    <div class="row">
        <div class="col-md-12">
            <nav class="float-right">
                <ul id="tab" class="pagination">
                    {!! str_replace( '/?' , '?' , $quizzs->appends(\Illuminate\Support\Facades\Input::except('page'))->render() ) !!}
                </ul>
            </nav>
        </div>
    </div>

    <div  id="loading-msg" style="display:none;">
        <div class="text-center" >
            <img src="{{URL::to('/')}}/img/ajax-loader.gif" alt="">
            <br>
            L'envoi peut prendre quelques minutes.
        </div>
    </div>

    @include('quizzs.modal')

@endsection
