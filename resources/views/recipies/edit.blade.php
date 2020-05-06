@extends('layouts.template')
@section('content')
    <h1>Edit your recipe!</h1>
<hr>
    <form method="PUT" action="{{ action('RecipiesController@update', $recipes->id) }}">
        @csrf
        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
        <div class="form-group">
            <label for="title">Recipe name</label>
            <input type="text" class="form-control" id="recipeName"  name="recipeName" value = "{{$recipes->name}}">
        </div>

        <div class="form-group">
            <label for="timeToCook">Prep time(in minutes)</label>
            <input type="text" class="form-control" id="timeToCook" name="timeToCook" value = "{{$recipes->timeToMake}}"/>
        </div>

        <div class="form-group">
            <label for="serves">Serves</label>
            <input type="text" class="form-control" id="serves" name="serves" value = "{{$recipes->serves}}"/>
        </div>
        
        </div class="form-group" >
        <button type="submit" style="margin:20px" class="btn btn-primary">Submit</button>
        </div>

    </form>
@endsection
        
