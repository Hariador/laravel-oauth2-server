@extends('app')

@section('content')

    <ul>
    @foreach($errors as $error)
        <li>
            {{ $error }}
        </li>
    @endforeach
    </ul>

@endsection
