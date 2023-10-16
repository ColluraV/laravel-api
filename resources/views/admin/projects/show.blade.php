@extends('layouts.app')
@section('content')
<h1>prova show</h1>

<div class="d-flex flex-column darkBg">
    <a href={{ route('admin.projects.index') }} class="btn btn-primary m-5">Indietro</a>

    <div class="d-flex justify-content-center flex-wrap text-center">


        <div class="col-12 col-lg-4 px-5 d-flex flex-column justify-content-center">
            <h1 class="text-white">{{ $project->title }}</h1>

            <p>Descrizione progetto:</p>
            <h2>{{ $project->description }}</h2>
            <p>immagine sotto</p>
            <img src="{{ asset('/storage/'. $project->image)}}" alt="">


            {{-- funziona anche con:--}}
              {{--<img src="{{ '/storage/'. $project->image }}" alt="" class="img-fluid"> --}}
            <p class="white-mb0">Link:</p>
            <p>{{$project->url_link}}</p>
            <p class="white-mb0">Data pubblicazione :</p>
            <p>{{$project->publication_date->format("d/m/Y")}}</p>
            <p>@if($project->type) {{$project->type->label}}@else // @endif</p>
            
            @foreach ($project->tecnologies as $tecnology)
                <p>{{ $tecnology->name }}</p>
            @endforeach
            

        </div>
    </div>

    <div class="d-flex justify-content-center">
        <a href={{ route('admin.projects.edit', $project->id) }} class="btn btn-warning my-5 mx-2">Modifica</a>
        <form class="my-5 mx-2" action="{{ route('admin.projects.destroy', ['id' => $project->id]) }}" method="POST">
            @csrf

            @method('DELETE')
            <input type="submit" class="btn btn-danger" value="Elimina">

        </form>
    </div>


</div>




@endsection