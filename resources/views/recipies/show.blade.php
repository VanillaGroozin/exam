@extends('layouts.template')

@section('content')
    <a href = '/Recipe' class = 'btn btn-default'>Go back</a>
    <div>
        <h1>{{$recipes->name}}</h1>
        <h2>Time to make: {{$recipes->timeToMake}} m. Serves: {{$recipes->serves}}</h2>
        <h2>Ingridients:<h2>
        @foreach($recipes->Ingredient as $ingredient)
            <h3> - {{$ingredient->name}}<h3>
        @endforeach       
    </div>
@endsection
        
