@extends('app')

@section('content')

    <div class="row">

        <div class="col-md-8 col-md-offset-2">

            <p>We were unable to begin your authorization request, please forward the information below to the service provider that directed you here.</p>

            <ul>
            @foreach($errors->all() as $error)
                <li>
                    {{ $error }}
                </li>
            @endforeach
            </ul>

        </div>

    </div>

@endsection
