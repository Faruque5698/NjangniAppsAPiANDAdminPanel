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
            <a class="btn btn-primary mb-2" href="{{route('password_settings')}}"><i class="fa fa-key"></i> Password Settings</a>
        </div>
        @if(Session::get('message'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                <strong>Successfully</strong> {{Session::get('message')}}
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
                    <div class="card-header text-dark">
                        <h4 class="text-dark">Profile Information</h4>
                    </div>
                    <div class="card-body bg-white">
                        <form action="{{route('profile_update')}}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="row">
                                <div class="col-sm-5 col-md-5 col-lg-5 text-center ">
                                    <div class="image-upload">
                                        <div class="thumb">
                                            <div class="avatar-preview">
                                                <div class="row">
                                                    <div class="col-sm-12 col-md-12">
                                                        @if (!empty($admin->image))
                                                            <img class="img-thumbnail rounded-circle"
                                                                 src="{{asset($admin->image)}}"
                                                                 id="user"
                                                                 style="width: 200px; height: 200px;" />
                                                        @else
                                                            <img class="img-thumbnail"
                                                                 src="{{asset('assets/image/default.jpg')}}"
                                                                 id="user" style="width: 200px; height: 200px;" />
                                                        @endif
                                                        <div class="avatar-edit">
                                                            <input type="file" class="profilePicUpload" id="profilePicUpload1" name="image" onchange="getImagePreview(event)" />
                                                            <label for="profilePicUpload1" class=" font-weight-bold bg-success text-white">@lang('Upload Image') </label>
                                                            <span class="font-weight-bold text-dark small mb-5">Supported files jpeg,jpg,png. Image will be resized into 400x400px </span>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                </div>
                                <div class="col-sm-7 col-md-7 col-lg-7">
                                    <div class="form-group">
                                        <label for="name">Name</label>
                                        <input type="text"
                                               name="name"
                                               id="name"
                                               required
                                               class="form-control"
                                               placeholder="name"
                                               value="{{$admin->name??''}}">
                                        <input type="hidden"
                                               name="id"
                                               id="name"
                                               required
                                               class="form-control"
                                               placeholder="Id"
                                               value="{{$admin->id??''}}">
                                    </div>
                                    <div class="form-group">
                                        <label for="email">Email</label>
                                        <input type="email"
                                               name="email"
                                               id="email"
                                               required
                                               class="form-control"
                                               placeholder="enter email"
                                               value="{{ $admin->email??''}}">
                                    </div>
                                    <div class="form-group">
                                        <label for="email">Email</label>
                                        <input type="text"
                                               name="mobile_no"
                                               id="email"
                                               required
                                               class="form-control"
                                               placeholder="enter Mobile Number"
                                               value="{{ $admin->mobile_no??''}}">
                                    </div>

                                </div>
                                <button class="btn btn-large btn-block btn-primary mt-4" width="100%">Save Change</button>
                            </div>
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
