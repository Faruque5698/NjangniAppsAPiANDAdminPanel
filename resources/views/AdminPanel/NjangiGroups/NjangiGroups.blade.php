@extends('AdminPanel.Master')

@section('title')
    Njangi Group
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
                            <th scope="col">Creator Name</th>
                            <th scope="col">Group Image</th>
                            <th scope="col">Group Name</th>
                            <th scope="col">Contribution Amount</th>
                            <th scope="col">Contribution Level</th>
                            <th scope="col">Status</th>
                            <th scope="col">Action</th>
                        </tr>
                        </thead>
                        <tbody>
                        @php($i =1)
                        @foreach($groups as $group)
                            <tr>
                                <th scope="row">{{$i++}}</th>
                                <th>{{$group->creator_id}}</th>
                                <td><img src="{{$group->group_image}}" alt="" width="100px " height="100px"></td>
                                <td>{{$group->group_name}}</td>
                                <td>{{$group->contribution_amount}}</td>
                                <td>{{$group->contribution_level}}</td>
                                <td>{{$group->status == 'active'?'active':'inactive'}}</td>
                                <td>
{{--                                    @if($setting->status == 'active')--}}
{{--                                        <a href="{{route('setting_inactive',['id'=>$setting->id])}}" class="btn btn-sm btn-info"--}}
{{--                                        ><i class="fa fa-arrow-circle-up"></i></a>--}}
{{--                                    @else--}}
{{--                                        <a href="{{route('setting_active',['id'=>$setting->id])}}" class="btn btn-sm btn-warning"--}}
{{--                                        ><i class="fa fa-arrow-circle-down"></i></a>--}}
{{--                                    @endif--}}

                                    <a href="{{route('njangi_group_members_list',['id'=>$group->id])}}" class="btn btn-sm btn-success"><i class="fa fa-info-circle"></i></a>

{{--                                    <a href="{{route('delete_njangi_group',['id'=>$group->id])}}" class="btn btn-sm btn-danger" ><i class="fa fa-trash"></i></a>--}}
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

