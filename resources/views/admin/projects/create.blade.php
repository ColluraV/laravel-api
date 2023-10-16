@extends('layouts.app')

@section('content')
    <div class="container-fluid darkBanner py-5 ">

        <div class="row form-container justify-content-center">
            <div class="col-12 col-md-8 col-lg-6">


                @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <form action="{{ route('admin.projects.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf()

                    <h1 class="form-title text-center">Compila il Form per modificare l'elemento nel database</h1>
                    <div class="my-3 mb-3">
                        <label for="title" class="form-label fw-bold">Titolo</label>
                        <input name="title" type="text" class="form-control" value="{{ old('title') }}">
                        <div class="form-text">Inserisci il titolo</div>
                    </div>
                    <div class="mb-3">
                        <label for="description" class="form-label fw-bold">Descrizione</label>
                        <input name="description" type="text" class="form-control" value="{{ old('description') }}">
                        <div class="form-text">Inserisci la descrizione</div>
                    </div>

                    <div class="mb-3">
                        <select class="form-select" name="type_id" aria-label="Floating label select example">
                            <option selected>{{ old('type_id') }}</option>
                            @foreach ($types as $type)
                                <option @if (old('type_id') == $type->id) selected @endif value="{{ $type->id }}">
                                    {{ $type->label }}</option>
                            @endforeach

                        </select>
                        <label for="type_id">Scegli la tipologia</label>
                    </div>

                    <div>
                        @foreach ($tecnologies as $tecnology)
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="checkbox" name="tecnologies[]"
                                    id="{{ $tecnology->id }}" value="{{ $tecnology->id }}">
                                <label class="form-check-label" for="{{ $tecnology->id }}">{{ $tecnology->name }}</label>
                            </div>
                        @endforeach
                    </div>


                    <div class="mb-3">
                        <label for="image" class="form-label fw-bold">Immagine</label>
                        <input name="image" type="file" class="form-control" accept="image/*">
                        <div class="form-text">Inserisci l'immagine di anteprima</div>
                    </div>
                    <div class="mb-3">
                        <label for="url_link" class="form-label fw-bold">Collegamento</label>
                        <input name="url_link" type="text" class="form-control" value="{{ old('url_link') }}">
                        <div class="form-text">Inserisci il link al progetto</div>
                    </div>
                    <div class="mb-3">
                        <label for="publication_date" class="form-label fw-bold">Data rilascio progetto</label>
                        <input name="publication_date" type="date" class="form-control"
                            value="{{ old('publication_date') }}">
                        <div class="form-text">Inserisci la data di pubblicazione</div>

                        <div class="d-flex text-center justify-content-center gap-2 my-4">
                            <a type="submit" href="{{ route('admin.projects.index') }}"
                                class="btn btn-secondary">Annulla</a>
                            <button class="btn btn-primary">Conferma</button>
                        </div>
                </form>
            </div>


        </div>



    @endsection
