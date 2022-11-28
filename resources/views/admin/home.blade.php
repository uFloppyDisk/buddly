@extends('admin.layouts.panel')

@section('content')
    <div class="container">
        <div class="row justify-content-center my-2">
            <h3>Welcome, {{ Auth::user()->name_full }}</h3>
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
                            <td>{{ $user->age }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection