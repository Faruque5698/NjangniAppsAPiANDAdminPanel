@extends('AdminPanel.Master')

@section('title')
    Apps Details
@endsection

@section('css')

@endsection


@section('content')
    <div class="main-content">
        <section class="section">
            <div class="section-header">
                <h1>Apps Details</h1>
            </div>

            <div class="col-sm-12 col-md-8 col-lg-8 offset-md-2 offset-lg-2">
                @if(Session::get('message'))
                    <div class="alert alert-success">
                        <strong>{{Session::get('message')}}</strong>
                    </div>
                @endif
                <div class="card">
                    <div class="card-header">
                        <h4>Apps Details</h4>
                    </div>
                    <form action="{{route('update_about')}}" method="POST">
                        @csrf
                        <div class="card-body">
                            <div class="form-group">
                                <label for="email">Email Number</label>
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <div class="input-group-text">
                                            {{-- <i class="fas fa-email"></i> --}}
                                            <i class="fa fa-envelope"></i>
                                        </div>
                                    </div>
                                    <input
                                        type="email"
                                        class="form-control phone-number"
                                        name='email'
                                        id="email"
                                        value="{{ $about->email?? '' }}"
                                        placeholder="enter app email"
                                    />
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="app_details">App Details</label>
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <div class="input-group-text">

                                            <i class="fas fa-th"></i>
                                        </div>
                                    </div>
                                    <textarea
                                        name="description"
                                        id="app_details"

                                        class="form-control pwstrength ">{{ $about->description ??'' }}</textarea>
                                </div>


                            </div>
                            <div class="form-group">
                                <button class="btn btn-primary btn-block">Save Changes</button>
                            </div>
                        </div>
                    </form>

                </div>

            </div>
            <div class="section-body">
            </div>
            <hr>

{{--                @if(Session::get('message_1'))--}}
{{--                    <div class="alert alert-success">--}}
{{--                        <strong>{{Session::get('message_1')}}</strong>--}}
{{--                    </div>--}}
{{--                @endif--}}
{{--                <div class="card">--}}
{{--                    <div class="card-header">--}}
{{--                        <h3>Social Setting</h3>--}}
{{--                        --}}{{--                    <a href="" class="btn btn-primary "data-toggle="modal" data-target="#AddAppDetails"><i class="fa fa-plus"></i></a>--}}
{{--                    </div>--}}
{{--                    <div class="card-body p-0">--}}
{{--                        <table class="table">--}}
{{--                            <thead>--}}
{{--                            <tr>--}}
{{--                                <th scope="col">#</th>--}}
{{--                                <th scope="col">Name</th>--}}
{{--                                <th scope="col">Icon</th>--}}
{{--                                <th scope="col">Url</th>--}}
{{--                                <th scope="col">Status</th>--}}
{{--                                <th scope="col">Action</th>--}}
{{--                            </tr>--}}
{{--                            </thead>--}}
{{--                            <tbody>--}}
                            {{--                        @php($i =1)--}}
                            {{--                        @foreach($settings as $setting)--}}
{{--                            <tr>--}}
{{--                                <th scope="row">{{$about->id}}</th>--}}
{{--                                <td>{{$about->email}}</td>--}}
{{--                                <td>{!! $about->description !!}</td>--}}
{{--                                <td>{{$about->status == 'active'?'Active':'Inactive'}}</td>--}}
{{--                                <td>--}}
{{--                                    @if($about->status == 'active')--}}
{{--                                        <a href="{{route('about_inactive',['id'=>$about->id])}}" class="btn btn-sm btn-info"--}}
{{--                                        ><i class="fa fa-arrow-circle-up"></i></a>--}}
{{--                                    @else--}}
{{--                                        <a href="{{route('about_active',['id'=>$about->id])}}" class="btn btn-sm btn-warning"--}}
{{--                                        ><i class="fa fa-arrow-circle-down"></i></a>--}}
{{--                                    @endif--}}

{{--                                    --}}{{--                                    <a href="{{route('setting_edit',['id'=>$setting->id])}}" class="btn btn-sm btn-success"><i class="fa fa-edit"></i></a>--}}

{{--                                    --}}{{--                                    <a href="{{route('delete_settings',['id'=>$setting->id])}}" class="btn btn-sm btn-danger" ><i class="fa fa-trash"></i></a>--}}
{{--                                </td>--}}


{{--                            </tr>--}}
                            {{--                        @endforeach--}}

{{--                        </table>--}}
{{--                    </div>--}}
{{--                </div>--}}
{{--                <div class="section-body">--}}
{{--                </div>--}}
{{--                <hr>--}}
{{--                <div class="card">--}}
{{--                    <div class="card-header">--}}
{{--                        <h2> About</h2>--}}
{{--                    </div>--}}
{{--                    <form action="{{route('update_about')}}" method="post" enctype="multipart/form-data">--}}
{{--                        @csrf--}}

{{--                        <div class="card-body">--}}
{{--                            <div class="modal-body">--}}
{{--                                <div class="form-group mb-3">--}}
{{--                                    <label for="">Email</label>--}}
{{--                                    <input type="email" value="" class="form-control" required name="email">--}}
{{--                                </div>--}}
{{--                                <div class="form-group mb-3">--}}
{{--                                    <label for="">Description</label>--}}
{{--                                    <textarea  id="dsc" class="form-control"  name="description"></textarea>--}}
{{--                                </div>--}}
{{--                            </div>--}}
{{--                            <div class="card-footer">--}}
{{--                                <button type="submit" class="btn btn-primary">Update Settings</button>--}}
{{--                            </div>--}}
{{--                        </div>--}}
{{--                    </form>--}}

{{--            </div>--}}

{{--        </section>--}}



        <!-- Modal -->

@endsection

@section('js')
    <script src="https://cdn.ckeditor.com/4.16.1/standard/ckeditor.js"></script>
    <script>
        CKEDITOR.replace( 'dsc' );
    </script>



@endsection
