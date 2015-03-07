@extends('app')

@section('content')

    <div class="row">

        <div class="col-md-8 col-md-offset-2">

            <p>The app <em class="app-name">{{ $client->getName() }}</em> would like to access data on your behalf.</p>

            @if($requestedScopes)

                <p>They are requesting access to the following:</p>

                <ul>
                    @foreach($requestedScopes as $scope)
                        <li>
                            <dl>
                                <dt>{{ $scope->getName() }}</dt>
                                <dd>{{ $scope->getDescription() }}</dd>
                            </dl>
                        </li>
                    @endforeach
                </ul>

            @endif

            <p>By clicking "authorize", you are creating a connection between the two apps to allow them to share data as it pertains to you.</p>

            <form action="{{ $storeUrl }}" method="POST">
                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                <button id="cancel" name="authorized" value="0">Cancel</button>
                <button id="authorize" name="authorized" value="1">Authorize</button>
            </form>

        </div>

    </div>

@endsection
