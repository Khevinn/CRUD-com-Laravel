@extends('layouts.app')
@section('content')


 <div class="row">
        <div class="col">
            <div class="pull-left">   
                <h2>Edit hero name</h2>
            </div>
        </div>
    </div>

    <form action="{{ route('heroes.update', $hero->id) }}" method="POST">
        @csrf
        @method('PUT')

    <div class="row">
        <div class="col">
            <div class="form-group">
                <strong>Heroes:</strong>
                <input type="text" name="name" class="form-control" value="{{ $hero->name }}">
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col">
            <div class="form-group">
                <strong>Description:</strong>
                <textarea class="form-control" name="description" >{{ $hero->description }} </textarea>
            </div>
        </div>
    </div>

    <div class="col text-center">
        <button type="submit" class="btn btn-primary col">Update</button>
    </div>
</form>



















@endsection