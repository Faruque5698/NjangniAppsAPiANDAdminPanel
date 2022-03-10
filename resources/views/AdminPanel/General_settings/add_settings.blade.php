@extends('AdminPanel.Master')

@section('title')
    General Settings
@endsection

@section('css')

@endsection


@section('content')
    <div class="main-content">
        <section class="section">
            <div class="section-header">
                <h1>General Settings</h1>
            </div>
            <div class="card card-primary">
                <div class="card-header">
                    <h3 class="card-title">Add Settings</h3>
                </div>
                @if(Session::get('message'))

                    <div class="alert alert-warning alert-dismissible fade show" role="alert">
                        <strong>{{Session::get('message')}}</strong>
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>

                        @endif

                    </div>
                    <!-- /.card-header -->
                    <!-- form start -->
                    <form action="{{route('save_settings')}}" method="post" enctype="multipart/form-data">
                        @csrf

                        <div class="card-body">
                            <div class="form-group">
                                <label >App Name</label>
                                <input type="text" class="form-control @error('name') is-invalid @enderror"  name="name" placeholder="Enter App Name">
                            </div>
                            @error('name')
                            <div class="alert alert-danger">{{ $message }}</div>
                            @enderror
                            <div class="form-group">
                                <label >Logo</label>
                                <input type="file" class="form-control @error('logo') is-invalid @enderror" onchange="getImagePreview(event)" name="logo"   id="logo_image" >
                                <img class="mt-2" id="preview" src="{{asset('assets/img')}}/previewIcon.png" width="100px" height="100px">
                            </div>
                            @error('logo')
                            <div class="alert alert-danger">{{ $message }}</div>
                        @enderror

{{--                            <div class="form-group">--}}
{{--                                <label >Publication Status</label>--}}
{{--                                <select class="form-control" name="status">--}}
{{--                                    <option >---Select Status---</option>--}}
{{--                                    <option value="1">Active</option>--}}
{{--                                    <option value="0">Inactive</option>--}}
{{--                                </select>--}}
{{--                            </div>--}}

                            <!-- /.card-body -->

                            <div class="card-footer">
                                <button type="submit" class="btn btn-primary">Add Settings</button>
                            </div>
                        </div>
                    </form>
            </div>
        </section>
    </div>
@endsection

@section('js')

    <script>
        var getImagePreview = function (event){
            // alert("ok");
            var output = document.getElementById('preview')
            output.src = URL.createObjectURL(event.target.files[0]);
        }

    </script>




@endsection
