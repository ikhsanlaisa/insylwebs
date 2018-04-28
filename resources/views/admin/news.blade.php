@extends('layouts.headerfooter')
@section('content')
    <div class="content mt-3">
        <div class="animated fadeIn">
            <div class="row">

                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header">
                            <a type="submit" href="/tambah_news" class="btn" style="border-radius: 20px">
                                <i class="fa fa-dot-circle-o"></i> Tambah News
                            </a>
                        </div>
                        @if(Session::has('message'))
                            <div class="alert alert-success">
                                <p>{{ Session::get('message') }}</p>
                            </div>
                        @endif
                        @if(!empty($news))
                            <div class="card-body">
                                <table id="bootstrap-data-table" class="table table-striped table-bordered">
                                    <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Foto</th>
                                        <th>Judul </th>
                                        <th>Description</th>
                                        <th>Action</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <?php $i = 1?>
                                    @foreach($news as $n)
                                        <tr>
                                            <td><center>{{$i++}}</center></td>
                                            <td><center><img src="images/news/{{ $n->foto }}" class="img-thumbnail" width="100" height="100"/></center></td>
                                            <td><center>{{$n->judul}}</center></td>
                                            <td><center>{{$n->description}}</center></td>
                                            <td>
                                                <center>
                                                    <form action="/deletenews/{{$n->id}}" method="post" >
                                                        {{csrf_field()}}
                                                        <input type="hidden" name="_method" value="delete">
                                                        <button type="button" class="btn btn-inline btn-success btn-sm ladda-button"
                                                                onclick="showModal({{ $n->id }})" title="edit" name="button"
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
                        <div class="row form-group">
                            <div class="col col-md-3"><label for="text" class=" form-control-label">Judul</label></div>
                            <div class="col-6 col-md-6"><input type="text" id="judul" name="judul"
                                                               placeholder="Nama Tim" class="form-control">
                            </div>
                        </div>

                        <div class="row form-group">
                            <div class="col col-md-3"><label for="text" class=" form-control-label">Keterangan</label></div>
                            <div class="col-6 col-md-6"><textarea type="text" id="description" name="description"
                                                                  placeholder="Keterangan" class="form-control"></textarea>
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
            document.getElementById('formEdit').action = "/updatenews/"+ id;
            console.log("diklik " + id);
            judul = document.getElementById("judul");
            description = document.getElementById("description");
            foto = document.getElementById('foto');
            $.ajax({
                type: 'GET',
                url: '/detailnews/' + id,
                dataType: 'json',
                success: function (newss) {
                    if (newss !== null) {
                        console.log('data = ' + newss);
                        console.log('datanya 2 = ' + newss[0].id);
                        judul.value = newss[0].judul;
                        description.value = newss[0].description;
                        foto.value = newss[0].foto;
                    } else {
                        console.log('null');
                        judul.value = "";
                        description.value = "";
                        foto.value ="";
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