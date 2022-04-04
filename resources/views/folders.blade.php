

@extends('layout')


@section ('content')
     <h1 class="text-3xl font-bold mt-5">
        Выберите голосование:
    </h1>

     <ul class="ml-5 mt-5">
    @foreach($folders as $folder)
        <li> <a href="{{ route('folder', $folder->id) }}" class="text-xl hover:underline">{{$folder->name}}</a> </li>


    @endforeach
    </ul>

@endsection
