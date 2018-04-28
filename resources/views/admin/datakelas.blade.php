@extends('layouts.headerfooter')
@section('content')
    <div class="content mt-3">
        <div class="animated fadeIn">
            <div class="row">

                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header">
                            <a type="submit" href="/tambah_kelas" class="btn" style="border-radius: 20px">
                                <i class="fa fa-dot-circle-o"></i> Tambah Kelas
                            </a>
                        </div>
                        @if(Session::has('message'))
                            <div class="alert alert-success">
                                <p>{{ Session::get('message') }}</p>
                            </div>
                        @endif
                        @if(!empty($kelas))
                            <div class="card-body">
                                <table id="bootstrap-data-table" class="table table-striped table-bordered">
                                    <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Foto </th>
                                        <th>Nama Kelas</th>
                                        <th>Action</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <?php $i = 1?>
                                    @foreach($kelas as $k)
                                        <tr>
                                            <td><center>{{$i++}}</center></td>
                                            <td><center><img src="images/kelas/{{ $k->foto }}" class="img-thumbnail" width="100" height="100"/></center></td>
                                            <td><center>{{$k->nama_kelas}}</center></td>
                                            <td>
                                                <center>
                                                <form action="/deletedatakelas/{{$k->id}}" method="post" >
                                                    {{csrf_field()}}
                                                    <input type="hidden" name="_method" value="delete">
                                                    <button type="button" class="btn btn-inline btn-success btn-sm ladda-button"
                                                            onclick="showModal({{ $k->id }})" title="edit" name="button"
                                                            data-toggle="modal" data-target="#modaledit"><span
                                                                class="fa fa-edit"></span></button>

                                                    <button type="delete" name="delete" id="btnhapus" value="delete" class="btn btn-inline btn-danger btn-sm ladda-button" onclick="return confirm('Are you sure to delete this data');"><i class="fa fa-trash"></i></button>
                                                </form>
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
        </div>
    </div><!-- .animated -->

    <!-- modal -->

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
                            <label class="col-sm-3 form-control-label">Nama Kelas :</label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control" name="kelas" id="kelas">
                            </div>
                        </div>
                        <div class="row form-group">
                            <div class="col col-md-3"><label for="file-input" class=" form-control-label">Upload Foto</label></div>
                            <div class="col-12 col-md-9">
                                <input type="file" id="file-input" name="foto" id="foto" class="form-control-file" onchange="ValidateSize(this)" accept="image/*">
                                <small style="color:red">*Max file 200Kb</small>
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
            document.getElementById('formEdit').action = "/updatedatakelas/"+ id;
            console.log("diklik " + id);
            nama_kelas = document.getElementById('kelas');
            foto = document.getElementById('foto');
            $.ajax({
                type: 'GET',
                url: '/detaildatakelas/' + id,
                dataType: 'json',
                success: function (data) {
                    if (data !== null) {
                        console.log(data);
                        console.log('datanya 2 = ' + data.id);
                        nama_kelas.value = data.nama_kelas;

                    } else {
                        console.log('null')
                        nama_kelas.value = "";
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