@extends('layouts.template')
@section('content')
    <div>
        <h1>Larecipies</h1>
        <p>You can find and add recipies at this page</p>

        <input type="text" placeholder="Search..">
        <input type="button"/>        
    </div>
    <div class='well'>
            @if(count($recipes)>0)
                @foreach($recipes as $recipe)
                    <div>
                        <h3><a href ="/Recipe/{{$recipe->id}}"> {{$recipe->name}} </a></h3>
                        <small>Time to make: {{$recipe->timeToMake}} m. Serves: {{$recipe->serves}}</small>
                    </div>
                @endforeach
                {{$recipes->links()}}
            @else
                <p>No recipies yet</p>
            @endif
@endsection
        
