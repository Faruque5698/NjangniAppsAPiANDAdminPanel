@extends('AdminPanel.Master')

@section('title')
    User List
@endsection

@section('css')

@endsection


@section('content')
    <div class="main-content">
        <section class="section">
            <div class="section-header">
                <h1>General Settings</h1>
            </div>
            @if(Session::get('message'))
            <div class="alert alert-success">
                <strong>{{Session::get('message')}}</strong>
            </div>
            @endif
            <div class="card">
                <div class="card-header">
{{--                    <a href="{{route('add_settings')}}" class="btn btn-primary "><i class="fa fa-plus"></i></a>--}}
                    <h3>User List</h3>
                </div>
                <div class="card-body p-0">


                    <table class="table">
                        <thead>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">Image</th>
                            <th scope="col">Name</th>
                            <th scope="col">Email</th>
                            <th scope="col">Mobile No</th>
                            <th scope="col">Role</th>
                            <th scope="col">Is Ban</th>

                        </tr>
                        </thead>
                        <tbody>
                        @php($i =1)
                        @foreach($users as $user)

                        <tr>
                            <td scope="row">{{$i++}}</td>

                            <td><img src="{{asset($user->image)}}" alt="" width="100px" height="100px"></td>
                            <td>{{$user->name}}</td>
                            <td>{{$user->email}}</td>
                            <td>{{$user->mobile_no}}</td>
                            <td>{{$user->role}}</td>
                            <td>
                                @if($user->is_ban == 0)
                                <a href="{{route('banned',['id'=>$user->id])}}" type="" style="color: white;" class="banned_btn btn btn-success btn-sm mr-1">Un Banned</a>
                                    @else
                                    <a  href="{{route('unbanned',['id'=>$user->id])}}" type=""value="{{$user->id}}" class="unBanned_btn btn btn-danger btn-sm mr-1"> Banned</a>

                                    @endif
                            </td>




                        </tr>
                        @endforeach


                    </table>
                </div>

            </div>

        </section>
    </div>
@endsection

@section('js')

    <script>
    {{--    $(document).on('click', '.banned_btn', function (e) {--}}
    {{--            e.preventDefault();--}}

    {{--            let user_id = $(this).val();--}}

    {{--            // alert(icon_id)--}}



    {{--            $.ajax({--}}
    {{--                type: "GET",--}}
    {{--                url: "/banned/" + user_id,--}}
    {{--                success: function (response) {--}}

    {{--                    if (response.status == 200) {--}}
    {{--                        swal("Successfully", "User Banned!", "danger");--}}
    {{--                    }--}}

    {{--                }--}}
    {{--            });--}}
    {{--        });--}}

    {{--</script>--}}
@endsection
