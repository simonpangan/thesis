@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">{{ __('Dashboard') }}
                        <div class="card-body">.

                            @if (session('status'))
                                <div class="alert alert-success" role="alert">
                                    {{ session('status') }}
                                </div>
                            @endif

                        

                            <table class="table table-bordered table-responsive-lg">
                                <tr>
                                    <th>AccountIDs</th>
                                    <th>Name</th>
                                    <th>Username </th>
                                    <th>Email Address </th>
                                    <th>email_verified_at</th>
                                    <th>Status</th>
                                </tr>
                                @foreach ($accounts as $account)
                                    <tr>
                                        <td>{{ $account->AccountID }}</td>
                                        <td>{{ $account->Name }}</td>
                                        <td>{{ $account->Username }}</td>
                                        <td>{{ $account->EmailAddress }}</td>
                                        <td>{{ $account->email_verified_at }}</td>
                                        <td>
                                            @if ($account->isOnline())
                                                <li class="text-success">
                                                    Online
                                                </li>
                                            @else.
                                            
                                                <li class="text-muted">
                                                    Offline
                                                </li>
                                            @endif
                                        </td>
                                        <td>{{ \Carbon\Carbon::parse($account->last_seen)->diffForHumans() }}</td>
                                   
                                    </tr>
                                @endforeach
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
