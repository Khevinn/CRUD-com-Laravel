@extends('layouts.app')
@section('content')

<div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="pull-left">   
                <h2>Create a new hero</h2>
            </div>
        </div>

        <form action="{{ route('heroes.store') }} " method="POST">
@csrf

    <div class="row" >
        <div class="col">
            <div class="form-group">
                <strong>Heroes:</strong>
                <input type="text" name="name" class="form-control">
            </div>
        </div>
    </div>    

    <div class="row">
        <div class="col">
            <div class="form-group">
                <strong>Description:</strong>
                <textarea class="form-control" name="description"> </textarea>
            </div>
        </div>
    </div>      

    <div class="row">
        <div class="col text-center">
            <button type="submit" class="btn col btn-primary">CREATE</button>
            </div>
        </div>  
    </div>      


</form>




@endsection

