@extends('AdminPanel.Master')

@section('title')


@endsection

@section('content')
    <div class="main-content">
        <section class="section">
            <div class="section-header">
                <h1>Profile</h1>
            </div>
            @php
                $admin = Auth()->user();
            @endphp
            <div class="text-right">
                <a class="btn btn-primary mb-2" href="{{route('profiles')}}"><i class="fa fa-key"></i> Admin profile</a>
            </div>
            @if(Session::get('message'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    <strong>Successfully</strong> Password Updated
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>

            @endif
            <div class="row">

                <div class="col-sm-4 col-md-4 col-lg-4">
                    <div class="card">
                        <div class="card-header d-flex bg-primary text-light">
                            {{--                        @if(!empty($admin->image))--}}
                            {{--                            <img style="width: 40px; height:40px"--}}
                            {{--                                 class="img-fluid rounded-circle mr-2"--}}
                            {{--                                 src="{{asset($admin->image)}}"--}}
                            {{--                                 alt="admin-image">--}}
                            {{--                        @else--}}
                            {{--                            <img class="img-thumbnail" src="{{asset('assets/image/default.jpg')}}" id="user" style="width: 200px; height: 200px;" />--}}
                            {{--                        @endif--}}
                            <h4 class="text-light">User Profile</h4>
                        </div>
                        <div class="card-body">
                            <div class="d-flex justify-content-between">
                                <p class="font-weight-bold">Name</p>
                                <p class="font-weight-bold">{{$admin->name}}</p>
                            </div>
                            <hr width="100%" class="pt-2 m-0" >
                            <div class="d-flex justify-content-between">
                                <p class="font-weight-bold">Role</p>
                                <p class="font-weight-bold">{{$admin->role}}</p>
                            </div>
                            <hr width="100%" class="pt-2 pb-2 m-0">
                            <div class="d-flex justify-content-between">
                                <p class="font-weight-bold">Email</p>
                                <p class="font-weight-bold">{{$admin->email}}</p>
                            </div>
                            <hr width="100%" class="pt-2 pb-2 m-0">
                            <div class="d-flex justify-content-between">
                                <p class="font-weight-bold">Mobile No</p>
                                <p class="font-weight-bold">{{$admin->mobile_no}}</p>
                            </div>

                        </div>


                    </div>

                </div>
                <div  class="col-sm-8 col-md-8 col-lg-8">
                    <div class="card bg-light">
                        <div class="card-header  text-dark">
                            <h4 class="text-dark">Change Password</h4>
                        </div>
                        <div class="card-body bg-white">
                            <form action="{{ route('admin_password_reset_post') }}" method="POST">
                                @csrf
                                <table class="table  text-justify">

                                    <div class="form-group">
                                        <tr>
                                            <th style="width: 170px"  class="text-left"><label for="old_password">Password</label></th>
                                            <td><input type="password"
                                                       name="old_password"
                                                       id="old_password"
                                                       class="form-control @error('old_password') is-invalid @enderror"
                                                       placeholder="current password">
                                                @error('old_password')
                                                <div class="alert alert-danger">{{ $message }}</div>
                                                @enderror
                                            </td>
                                        </tr>
                                    </div>
                                    <div class="form-group">
                                        <tr>
                                            <th style="width: 170px"  class="text-left"><label for="password">New Password</label></th>
                                            <td><input type="password"
                                                       name="password"
                                                       id="password"
                                                       class="form-control @error('password') is-invalid @enderror"
                                                       placeholder="new password">
                                                @error('password')
                                                <div class="alert alert-danger">{{ $message }}</div>
                                                @enderror
                                            </td>
                                        </tr>
                                    </div>
                                    <div class="form-group">
                                        <tr>
                                            <th style="width: 170px"  class="text-left"><label for="password_confirmation">Confirm Password</label></th>
                                            <td><input type="password"
                                                       name="password_confirmation"
                                                       id="password_confirmation"
                                                       class="form-control "
                                                       placeholder="confirm password">
                                            </td>
                                        </tr>
                                    </div>
                                    <div class="form-group">
                                        <tr>
                                            <th style="width: 170px"  class="text-left"></th>
                                            <td><button class="btn btn-primary btn-lg btn-block">Save Changes</button></td>
                                        </tr>
                                    </div>

                                </table>


                            </form>

                        </div>


                    </div>
                </div>
            </div>

        </section>
    </div>


@endsection
@section('js')

    <script>
        var getImagePreview = function (event){
            // alert("ok");
            var output = document.getElementById('user')
            output.src = URL.createObjectURL(event.target.files[0]);
        }

    </script>

@endsection
