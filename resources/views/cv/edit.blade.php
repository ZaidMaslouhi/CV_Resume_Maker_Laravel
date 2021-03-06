
@extends('layouts.app')


@section('content')

<div class="container">
    <div class="row">
        <div class="col-md-7 mx-auto">
            <form action="{{ url('cvs/'.$cv->id) }}" method="post" enctype="multipart/form-data">
                {{-- enctype: For upload files --}}
                @method('PUT')      {{-- for Put Method --}}
                @csrf               {{-- for Token --}}

                <div class="form-group">
                    <label for="titre">Titre</label>
                    <input type="text" class="form-control @if($errors->get('titre')) is-invalid @endif"
                           name="titre" id="titre" value="{{ $cv->titre }}">
                    {{-- ERROR MESSAGES --}}
                    @if($errors->get('titre'))
                        <div class="alert alert-danger my-2" role="alert">
                            <ul>
                                @foreach ($errors->get('titre') as $message)
                                    <li>{{ $message }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif
                </div>

                <div class="form-group">
                    <label for="presentation">Presentation</label>
                    <textarea class="form-control @if($errors->get('presentation')) is-invalid @endif"
                              name="presentation" id="presentation">{{ $cv->presentation }}</textarea>
                    {{-- ERROR MESSAGES --}}
                    @if($errors->get('presentation'))
                        <div class="alert alert-danger my-2" role="alert">
                            <ul>
                                @foreach ($errors->get('presentation') as $message)
                                    <li>{{ $message }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif
                </div>

                <div class="custom-file my-2 mb-4">
                    <input type="file" class="custom-file-input" name="photo" id="photo">
                    <label class="custom-file-label" for="photo">Chosir un image</label>
                </div>

                <button type="submit" class="btn btn-success">Modifier</button>
            </form>

        </div>
    </div>
</div>


@endsection
