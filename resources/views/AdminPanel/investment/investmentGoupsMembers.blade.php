@extends('AdminPanel.Master')

@section('title')
    {{$group->group_name}}
@endsection

@section('content')

    <div class="main-content">
        <section class="section">
            <div class="section-header">
                <h1>@yield('title')</h1>
            </div>
            @if(Session::get('message'))
                <div class="alert alert-success">
                    <strong>{{Session::get('message')}}</strong>
                </div>
            @endif
            <div class="card">
                <div class="card-header">
                    {{--                    <a href="{{route('add_settings')}}" class="btn btn-primary "><i class="fa fa-plus"></i></a>--}}
                </div>
                <div class="card-body p-0">
                    <table class="table">
                        <thead>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">Member Name</th>
                            <th scope="col">Action</th>
                        </tr>
                        </thead>
                        <tbody>
                        @php($i =1)
                        @foreach($members as $member)
                            <tr>
                                <th scope="row">{{$i++}}</th>
                                {{--                                {{dd($members)}}--}}
                                <th>{{$member->invest_members->name}}</th>
                                <td>
                                    <a href="{{route('invest_member_details',['id'=>$member->id])}}" class="btn btn-sm btn-success"><i class="fa fa-info-circle"></i></a>

{{--                                    <a href="{{route('member_delete',['id'=>$member->id])}}" class="btn btn-sm btn-danger" ><i class="fa fa-trash"></i></a>--}}
                                </td>


                            </tr>
                        @endforeach

                    </table>
                </div>
            </div>
            <div class="section-body">
            </div>
            <div class="section-body">
            </div>
        </section>
    </div>

@endsection

