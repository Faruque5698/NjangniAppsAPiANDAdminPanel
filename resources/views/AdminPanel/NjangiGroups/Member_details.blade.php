@extends('AdminPanel.Master')

@section('title')
    Member Details
@endsection

@section('content')

    <div class="main-content">
        <section class="section">
            <div class="section-header">
                <h1>@yield('title')</h1>
            </div>
            <table class="table">
                <thead>
                <tr>
                    <th scope="col">Id</th>
                    <th scope="col">{{$member->members->id}}</th>
                </tr>
                <tr>
                    <th scope="col">Name</th>
                    <th scope="col">{{$member->members->name}}</th>
                </tr>
                <tr>
                    <th scope="col">Email</th>
                    <th scope="col">{{$member->members->email}}</th>
                </tr>
                <tr>
                    <th scope="col">Role</th>
                    <th scope="col">{{$member->members->role}}</th>
                </tr>

                </thead>

            </table>

            <div class="section-body">
            </div>
        </section>
    </div>

@endsection
