@extends('layouts.headerfooter')
@section('content')
    <!-- page content -->
    <div class="col-lg-10 centered">
        <div class="card">
            <div class="card-header">
                <strong>Tambah</strong> Kontak
            </div>
            @if(Session::has('message'))
                <div class="alert alert-success">
                    <p>{{ Session::get('message') }}</p>
                </div>
            @endif
            <form action="/postkontak" method="post" enctype="multipart/form-data" class="form-horizontal">
                {{csrf_field()}}
                <div class="card-body card-block">
                    <div class="row form-group">
                        <div class="col col-md-3"><label for="text" class=" form-control-label">Nama</label></div>
                        <div class="col-6 col-md-6"><input type="text" id="nama" name="nama"
                                                           placeholder="Nama" class="form-control">
                        </div>
                    </div>
                    <div class="row form-group">
                        <div class="col col-md-3"><label for="text" class=" form-control-label">Email</label></div>
                        <div class="col-6 col-md-6"><input type="text" id="email" name="email"
                                                           placeholder="Email" class="form-control">
                        </div>
                    </div>
                    <div class="row form-group">
                        <div class="col col-md-3"><label for="text" class=" form-control-label">No. Telepon</label></div>
                        <div class="col-6 col-md-6"><input type="text" id="telp" name="telp"
                                                           placeholder="No. Telepon" class="form-control">
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
                <div class="card-footer">
                    <center>
                        <button type="submit" name="submit" class="btn btn-primary btn-sm">
                            <i class="fa fa-dot-circle-o"></i> Submit
                        </button>
                    </center>
                </div>
            </form>
        </div>
    </div>
    <!-- /page content -->
    <script>
        function ValidateSize(file) {
            var FileSize = file.files[0].size / 1024 / 1024;
            if (FileSize > 2) {
                alert('File size exceeds 2 MB');
                $(file).val('');
            } else {

            }
        }
    </script>
@endsection