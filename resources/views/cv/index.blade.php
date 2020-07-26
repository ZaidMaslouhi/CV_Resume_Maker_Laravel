
@extends('layouts.app')


@section('content')

<div class="container">
    <div class="row">
        <div class="col-md-10 mx-auto">

            <h1 class="text-center display-3 text-primary mb-5">La liste de mes Cvs</h1>
            <a href="{{ url('cvs/create') }}" class="btn btn-info float-right mb-3">Nouveau Cv</a>
            <div class="clearfix"></div>
            <div class="row row-cols-1 row-cols-md-2">

                @foreach($cvs as $cv)
                    <div class="col-md-4 mb-4">
                        <div class="card h-100">
                            <img src="{{ asset('storage/'.$cv->photo) }}" class="card-img-top" alt="">
                            <div class="card-body mb-0 d-flex flex-column justify-content-end">
                                <h5 class="card-title">{{ $cv->titre }} <br> <span class="lead small text-muted">{{ $cv->user->name }}</span></h5>
                                <p class="card-text">{{ $cv->presentation }}</p>
                                <p class="card-text"><small class="text-muted">{{ $cv->created_at }}</small></p>
                            </div>
                            <div class="card-footer text-center">
                                <a href="{{ url('cvs/'.$cv->id) }}" class="btn btn-outline-primary mr-1">Details</a>
                                <a href="{{ url('cvs/'.$cv->id.'/edit') }}" class="btn btn-outline-success mr-1">Editer</a>
                            @CAN('delete', $cv)
                                <form action="{{ url('cvs/'.$cv->id) }}" method="POST" class="d-inline">
                                    @csrf               {{-- for Token --}}
                                    @method('DELETE')      {{-- for Delete Method --}}
                                    <button type="submit" class="btn btn-outline-danger">Enlever</button>
                                </form>
                            @ENDCAN
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>

        </div>
    </div>
</div>



@endsection
