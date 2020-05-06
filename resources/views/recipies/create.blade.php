@php
    $categories = App\Category::all();
@endphp

@extends('layouts.template')
@section('content')
    <h1>Add your recipe!</h1>
<hr>
    <form method="POST" action="{{ action('RecipiesController@store') }}">
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
            <input type="text" class="form-control" id="recipeName"  name="recipeName">
        </div>
        <div class="form-group">
            <label for="category">Category</label>
            <select class="form-control" name="category" id="category">
                @foreach($categories as $category)
                    <option>{{$category->name}}</option>
                @endforeach
            </select>
        </div>

        <div class="form-group">
            <label for="timeToCook">Prep time(in minutes)</label>
            <input type="text" class="form-control" id="timeToCook" name="timeToCook"/>
        </div>

        <div class="form-group">
            <label for="serves">Serves</label>
            <input type="text" class="form-control" id="serves" name="serves"/>
        </div>

        <label for="ingridients">Ingredients</label><br/>
        </div class="form-group">
            <textarea type="text" id="ingridients" name="ingridients" placeholder="Put each ingredient on its own line."></textarea>        
        </div>

        
        </div class="form-group" >
        <button type="submit" style="margin:20px" class="btn btn-primary">Submit</button>
        </div>

    </form>
@endsection
        
