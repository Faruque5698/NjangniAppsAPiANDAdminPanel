


@extends('AdminPanel.Master')

@section('title')
    App Settings
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
                <form action="{{route('update_settings')}}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="card-header primary">
                        <h4>General Settings</h4>
                    </div>
                    <div class="card-body">

                        <div class="form-group">
                            <label class="control-label" for="app_name">App Name</label>
                            <input
                                class="form-control"
                                type="text"
                                placeholder="Enter app name"
                                id="app_name"
                                name="name"
                                value="{{ $settings->name?? '' }}"
                            />
                        </div>
                        {{--                    <div class="form-group">--}}
                        {{--                        <label>Radio Streaming Url</label>--}}
                        {{--                        <input--}}
                        {{--                            class="form-control"--}}
                        {{--                            type="text"--}}
                        {{--                            placeholder="Enter radio streaming url"--}}
                        {{--                            id="radio_streaming_url"--}}
                        {{--                            name="radio_streaming_url"--}}
                        {{--                            value="{{ $settings->radio_streaming_url??'' }}"--}}
                        {{--                        />--}}
                        {{--                    </div>--}}
                        {{--                    <div class="form-group">--}}
                        {{--                        <label>Metadata Link</label>--}}
                        {{--                        <input--}}
                        {{--                            class="form-control"--}}
                        {{--                            type="text"--}}
                        {{--                            placeholder="Enter metadata link"--}}
                        {{--                            id="metadata_link"--}}
                        {{--                            name="metadata_link"--}}
                        {{--                            value="{{$settings->metadata_link??''}}"--}}
                        {{--                        />--}}
                        {{--                    </div>--}}
                        <div class="form-group">
                            <label>Footer Text</label>
                            <input
                                class="form-control"
                                type="text"
                                placeholder="Enter footer text"
                                id="footer_text"
                                name="footer_text"
                                value="{{$settings->footer_text??''}}"
                            />
                        </div>

                        <div class="row">
                            <div class="form-group col-6 offset-3">
                                <div class="image-upload">
                                    <div class="thumb">
                                        <div class="avatar-preview">
                                            <div class="row">
                                                <div class="col-sm-6 col-md-4 offset-md-2 text-center">

                                                    @if (!empty($settings->logo))
                                                        <img class="img-thumbnail"
                                                             src="{{$settings->logo}}"
                                                             id="logo" style="width: 200px; height: 200px;">
                                                    @else
                                                        <img src="{{ asset('assets/image/default.jpg')}}" id="logo" style="width: 200px; height: 200px;">
                                                    @endif
                                                    <div class="avatar-edit">
                                                        <input type="file" class="profilePicUpload" id="profilePicUpload1"  name="logo" onchange="loadFile(event,'logo')">
                                                        <label for="profilePicUpload1" class="bg-success text-light">@lang('Logo') </label>
                                                        <span class="font-weight-bold text-danger small">Size should be 512 X 512 </span>
                                                    </div>
                                                </div>
                                                <div class="col-sm-6 col-md-4 text-center">
                                                    @if (!empty($settings->fab_icon))
                                                        <img class="img-thumbnail"
                                                             src="{{$settings->fab_icon}}"
                                                             id="favicon" style="width: 200px; height: 200px;">
                                                    @else
                                                        <img src="{{ asset('assets/image/default.jpg')}}" id="favicon" style="width: 200px; height: 200px;">
                                                    @endif
                                                    <div class="avatar-edit">
                                                        <input type="file" class="profilePicUpload" id="profilePicUpload2"  name="fav_icon" onchange="loadFile(event,'favicon')">
                                                        <label for="profilePicUpload2" class="bg-success text-light">@lang('Favicon') </label>
                                                        <span class="font-weight-bold text-danger small ">Size should be 80 X 80 </span>
                                                    </div>
                                                </div>

                                            </div>
                                        </div>

                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card-footer text-right">
                        <button  class="btn btn-primary btn-block">Save Changes</button>
                    </div>
                </form>
            </div>
        </section>
    </div>


@endsection
    @section('js')
        <script>
            loadFile = function(event, id) {
                var output = document.getElementById(id);
                output.src = URL.createObjectURL(event.target.files[0]);
            };
        </script>
    @endsection


