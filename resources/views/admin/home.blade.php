@extends('admin.layouts.panel')

@section('content')
    <div class="container">
        <div class="row justify-content-center my-2">
            <h3>Welcome, {{ Auth::user()->name_full }}</h3>
        </div>
        <div>
            <h2>Quick Actions</h2>
            <div class="row">
                <div class="col-auto">
                    <div class="card">
                        <div class="card-header">Maintenence</div>
                        <div class="card-body">
                            <a href="#" class="btn btn-primary" role="button">Turn On</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row table-responsive">
            <h2>Recent Users</h2>
            <table class="table table-striped table-sm">
                <thead>
                    <tr>
                        <th scope="col">Created At</th>
                        <th scope="col">Full Name</th>
                        <th scope="col">Email Address</th>
                        <th scope="col">Age</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($db_recent_new_users as $user)
                        <tr>
                            <td>{{ $user->created_at }}</td>
                            <td>
                                {{ $user->name_full }}
                                @if ($user->type == 100)
                                    <span class="badge text-bg-secondary text-white">Buddly+</span>
                                @endif
                            </td>
                            <td>{{ $user->email }}</td>
                            <td>
                                @php
                                    $profile = $user->profile;
                                    $birthdate = !is_null($profile) ? $profile->birthdate : null;
                                @endphp
                                @if (!is_null($birthdate))
                                @php
                                    $birthdate = date_create($birthdate);
                                    $today = date_create(date('Y-m-d', time()));
                                @endphp
                                {{ date_diff($birthdate, $today)->format('%y') }}
                                @else
                                    <i class="text-muted">NULL</i>
                                @endif
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection