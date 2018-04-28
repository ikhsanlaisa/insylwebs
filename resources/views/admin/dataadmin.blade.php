@extends('layouts.headerfooter')
@section('content')
    <div class="content mt-3">
        <div class="animated fadeIn">
            <div class="row">

                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header">
                            <strong class="card-title">Data Table</strong>
                        </div>
                        @if(Session::has('message'))
                            <div class="alert alert-success">
                                <p>{{ Session::get('message') }}</p>
                            </div>
                        @endif
                        @if(!empty($user))
                            <div class="card-body">
                                <table id="bootstrap-data-table" class="table table-striped table-bordered">
                                    <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Name</th>
                                        <th>Email</th>
                                        <th>Action</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <?php $i = 1?>
                                    @foreach($user as $u)
                                    <tr>
                                        <td>{{$i++}}</td>
                                        <td>{{$u->nama}}</td>
                                        <td>{{$u->email}}</td>
                                        <td>
                                            <center>
                                                @if (Auth::user()->email)
                                                <form action="/deletedataadmin/{{$u->id}}" method="post" >
                                                    {{csrf_field()}}
                                                    <input type="hidden" name="_method" value="delete">
                                                    <button type="button" class="btn btn-inline btn-success btn-sm ladda-button"
                                                            onclick="showModal({{ $u->id }})" title="edit" name="button"
                                                            data-toggle="modal" data-target="#modaledit"><span
                                                                class="fa fa-edit"></span></button>
                                                <button type="delete" name="delete" id="btnhapus" value="delete"
                                                        class="btn btn-inline btn-danger btn-sm ladda-button"
                                                        onclick="return confirm('Are you sure to delete this data');"><i
                                                            class="fa fa-trash"></i></button>
                                                </form>
                                                    @endif
                                            </center>
                                        </td>
                                    </tr>
                                    @endforeach
                                    <?php ;?>
                                    </tbody>
                                </table>
                            </div>
                        @endif
                    </div>
                </div>


            </div>
        </div><!-- .animated -->
    </div><!-- .content -->

    <!-- modal -->
    <div class="modal fade"
         id="modaledit"
         tabindex="-1"
         role="dialog"
         aria-labelledby="myModalLabel"
         aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="myModalLabel">Edit Data</h4>
                </div>
                <form id="formEdit" action="" method="post" enctype="multipart/form-data">
                    {{csrf_field()}}
                    <input type="hidden" name="_method" value="put">

                    <div class="modal-body">
                        <div class="form-group row">
                            <label class="col-sm-3 form-control-label">Name :</label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control" name="user" id="user">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-3 form-control-label">Email :</label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control" name="email" id="email">
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-rounded btn-default" data-dismiss="modal">Close</button>
                        <button type="submit" name="update" class="btn btn-rounded btn-primary">Save changes</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <!-- end modal -->
    <script>
        function ValidateSize(file) {
            var FileSize = file.files[0].size / 1024 / 1024;
            if (FileSize > 2) {
                alert('File size exceeds 2 MB');
                $(file).val('');
            } else {

            }
        }
        function showModal(id) {
            document.getElementById('formEdit').action = "/updatedataadmin/"+ id;
            console.log("diklik " + id);
            nama = document.getElementById('user');
            email = document.getElementById('email');
            $.ajax({
                type: 'GET',
                url: '/detaildataadmin/' + id,
                dataType: 'json',
                success: function (admin) {
                    if (admin[0] !== null) {
                        console.log('data = ' + admin);
                        console.log('datanya 2 = ' + admin[0].id);
                        nama.value = admin[0].nama;
                        email.value = admin[0].email;

                    } else {
                        console.log('null')
                        nama.value = "";
                        email.value = "";
                    }

                },
                error: function (XMLHttpRequest, textStatus, errorThrown) {
                    console.log("error bro");
                    console.log(textStatus);
                    console.log(errorThrown);

                }
            });
        }
    </script>
@endsection