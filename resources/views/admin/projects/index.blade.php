@extends('layouts.app')
@section('content')
    <h1>projects/index.blade </h1>

    <div class=" text-center darkBg p-3">

        <h1>Benvenuto</h1>

        <p>scegli il progetto che ti interessa oppure</p>
        <p><a style="" href="{{ route('admin.projects.create') }}">aggiungine uno</a></p>

        <div class=" text-center">


            <div class=" darkBanner ">

                <div class="text-center relative">


                    <div id="cards_container" class="row flex-wrap gy-5">

                        {{-- ////////////// cards in ciclo for //////////////// --}}
                        @foreach ($projects as $project)
                            <div class="col-12 col-md-4 col-lg-2">
                                <a href="{{ route('admin.projects.show', $project->id) }}">

                                    <div class="card border-0 rounded-0 h-100">

                                        <img src="{{ asset('storage/' . $project->image) }}" alt="">
                                        <div class="card-body d-flex flex-column text-white bg-dark"> {{-- //////nome////// --}}
                                            {{ $project['description'] }}
                                        </div>
                                        <div class="overlay"> {{-- //////info in hover////// --}}

                                            <div class="absolute top hidden justify-content-center">
                                                {{ ucfirst($project['url_link']) }}</div>
                                            <div class="absolute bottom hidden justify-content-center">Data pubblicazione:
                                                {{ $project['publication_date']->format('d/m/Y') }}</div>
                                            {{--<div class="absolute top hidden justify-content-center">
                                                {{ $project('type_id') }}</div>--}}

                                        </div>


                                    </div>

                                </a>
                            </div>
                        @endforeach

                    </div>
                </div>


            </div>
        </div>
    @endsection
