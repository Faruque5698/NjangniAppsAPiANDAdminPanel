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
                <h1>About</h1>
            </div>
            @if(Session::get('message'))
                <div class="alert alert-success">
                    <strong>{{Session::get('message')}}</strong>
                </div>
            @endif
            <div class="card">
                <div class="card-header d-flex d-warp justify-content-between">
                    <h4>Social Icon List</h4>
                    <a  class="btn btn-info" data-toggle="modal" data-target="#addModal" style="color: white">Add Social Links</a>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered text-center">
                            <thead class="text-center">
                            <tr>
                                <th>#</th>
                                <th>Icon Name</th>
                                <th>Icon</th>
                                <th>Page URL</th>
                                <th>Action</th>
                            </tr>
                            </thead>
                            <tbody class="text-center">

{{--                                    <tr>--}}
{{--                                        <td>{{ $key+1 }}</td>--}}
{{--                                        <td>{{ Str::ucfirst($item->name) }}</td>--}}

{{--                                        <td ><span class="badge badge-primary">{!! $item->icon !!}</span></td>--}}
{{--                                        <td>{{ $item->url }}</td>--}}
{{--                                        <td>--}}
{{--                                            <a data-toggle="modal" data-target="#editModal-{{ $item->id }}" class="btn btn-success"><i class="fa fa-pen text-light"></i></a>--}}
{{--                                            <a href="#" class="btn btn-danger" data-toggle="modal" data-target="#delete-{{$item->id}}"><i class="fa-solid fa-trash-can text-light"></i></a>--}}
{{--                                        </td>--}}
{{--                                    </tr>--}}



                            </tbody>

                        </table>
                    </div>
{{--                    <div>--}}
{{--                        {{ $socialIcon->links() }}--}}
{{--                    </div>--}}
                </div>

            </div>

        </section>



        <!-- Modal -->
        <div class="modal fade" id="addModal" tabindex="-1" role="dialog" aria-labelledby="addModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="addModalLabel">Add Social Icon</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form action="" id="AddSocialIconForm" method="POST" enctype="multipart/form-data">
                            @csrf

                            <div class="form-group">
                                <label class="control-label" for="name">Icon Name</label>
                                <input class="form-control" type="text" id="name" name="name" required value="{{ old('name') }}" placeholder="enter icon name" />
                            </div>
                            <div class="form-group">
                                <label for="icon">Icon</label>
                                <input class="form-control" type="text" id="icon" name="icon" required value="{{ old('icon') }}" placeholder="example: <i class='fab fa-facebook-f'></i>" />
                            </div>
                            <div class="form-group">
                                <label for="url">Page Url</label>
                                <input class="form-control" type="text" id="url" name="url" required value="{{ old('url') }}" placeholder="enter page url" />
                            </div>

                            <div class="modal-footer">
                                <button type="button" class="btn btn-dark" data-dismiss="modal">Close</button>
                                <button type="submit" class="btn btn-primary">Create</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>


        <div class="modal fade" id="updateModal" tabindex="-1" role="dialog" aria-labelledby="addModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="addModalLabel">Update Social Icon</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form action="" id="UpdateSocialIconForm" method="POST" enctype="multipart/form-data">
                            @csrf

                            <div class="form-group">
                                <label class="control-label" for="name">Icon Name</label>
                                <input class="form-control" type="text" id="edit_name" name="name" required value="{{ old('name') }}" placeholder="enter icon name" />
                                <input class="form-control" type="hidden" id="edit_id" name="id"/>
                            </div>
                            <div class="form-group">
                                <label for="icon">Icon</label>
                                <input class="form-control" type="text" id="edit_icon" name="icon" required value="{{ old('icon') }}" placeholder="example: <i class='fab fa-facebook-f'></i>" />
                            </div>
                            <div class="form-group">
                                <label for="url">Page Url</label>
                                <input class="form-control" type="text" id="edit_url" name="url" required value="{{ old('url') }}" placeholder="enter page url" />
                            </div>

                            <div class="modal-footer">
                                <button type="button" class="btn btn-dark" data-dismiss="modal">Close</button>
                                <button type="submit" class="btn btn-primary">Update</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
@endsection

@section('js')
{{--    <script src="https://cdn.ckeditor.com/4.16.1/standard/ckeditor.js"></script>--}}
{{--    <script>--}}
{{--        CKEDITOR.replace( 'dsc' );--}}
{{--    </script>--}}
{{--        <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>--}}
{{--            <script--}}
{{--                src="https://code.jquery.com/jquery-3.6.0.min.js"--}}
{{--                integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4="--}}
{{--                crossorigin="anonymous"></script>--}}


    <script>
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $(document).ready(function (){

            fetchSocailIcon();
            function fetchSocailIcon(){

                $.ajax({
                    type:"GET",
                    url:"fetch_socialIcon",
                    dataType:"json",
                    success:function (response){
                        // alert(response.icon)

                        $('tbody').html("");

                        $.each(response.icon, function (key, icon){
                            $('tbody').append('<tr>\
                            <td>'+icon.id+'</td>\
                        <td>'+icon.name+'</td>\
                        <td>'+icon.icon+'</td>\
                        <td>'+icon.url+'</td>\
                        <td><button type="button"value="'+icon.id+'" class="edit_btn btn btn-success btn-sm mr-1">Update</button><button type="button"value="'+icon.id+'" class="delete_btn btn btn-danger btn-sm">Delete</button></td>\
                    </tr>');
                        })

                    }
                })
            }


            $(document).on('click', '.edit_btn', function (e) {
                e.preventDefault();

                let icon_id = $(this).val();

                // alert(icon_id)

                $('#updateModal').modal('show');

                $.ajax({
                    type: "GET",
                    url: "editSocialIcon/" + icon_id,
                    success: function (response) {

                        if (response.status == 404) {
                            // alert(response.message);
                            swal("Error", "", "danger");
                            $('#updateModal').modal('hide');
                        } else {
                            $('#edit_name').val(response.icon.name);
                            $('#edit_id').val(response.icon.id);
                            $('#edit_icon').val(response.icon.icon);
                            $('#edit_url').val(response.icon.url);
                            // $("#image").attr("src", response.employee.image);
                            // console.log(response.employee.name);
                        }

                    }
                });
            });

            $(document).on('submit', '#UpdateSocialIconForm', function (e){
                e.preventDefault();

                // alert('Hello')


                let formData = new FormData($('#UpdateSocialIconForm')[0]);
                $.ajax({
                    type:"POST",
                    url:"UpdateSaveIcon",
                    data:formData,
                    contentType:false,
                    processData:false,
                    success:function (response){
                        // alert("hello")
                        console.log(response)
                        if(response.status == 200){

                            // alert(response.status)
                            $('#UpdateSocialIconForm').find('input').val('');
                            $('#updateModal').modal('hide');
                            fetchSocailIcon();
                            swal("Successfully", "Data Updated!", "success");


                            //
                        }
                    }
                })
                // $('#addModal').modal('hide');

            })


            $(document).on('submit', '#AddSocialIconForm', function (e){
                e.preventDefault();

                // alert('Hello')


                let formData = new FormData($('#AddSocialIconForm')[0]);
                $.ajax({
                    type:"POST",
                    url:"SaveIcon",
                    data:formData,
                    contentType:false,
                    processData:false,
                    success:function (response){
                        // alert("hello")
                        console.log(response)
                        if(response.status == 200){

                            // alert(response.status)
                            $('#AddSocialIconForm').find('input').val('');
                            $('#addModal').modal('hide');
                            fetchSocailIcon();
                            swal("Successfully", "Data Saved", "success");


                        //
                        }
                    }
                })
                // $('#addModal').modal('hide');

            })

            $(document).on('click', '.delete_btn', function (e){
                e.preventDefault();

                let icon_id = $(this).val();

                swal({
                    title: "Are you sure?",
                    text: "Once deleted, you will not be able to recover this data!",
                    icon: "warning",
                    buttons: true,
                    dangerMode: true,
                })
                    .then((willDelete) => {
                        if (willDelete) {
                            $.ajax({
                                type:"GET",
                                url:"delete_icon/"+icon_id,
                                success:function (response){
                                    fetchSocailIcon();
                                    swal("Poof! Your imaginary file has been deleted!", {
                                        icon: "success",
                                    });

                                }
                            })

                        } else {
                            swal("Your data is safe!");
                        }
                    });


                //

            //
            //
            //
            });
        })
    </script>

@endsection
