@extends('layouts.headerfooter')
@section('content')
    <!-- page content -->
    <div class="col-lg-10 centered">
        <div class="card">
            <div class="card-header">
                <strong>Tambah</strong> Score
            </div>
            @if(Session::has('message'))
                <div class="alert alert-success">
                    <p>{{ Session::get('message') }}</p>
                </div>
            @endif
            <form action="/postnews" id="formEdit" method="post" enctype="multipart/form-data"
                  class="form-horizontal">
                {{csrf_field()}}
                <div class="card-body card-block">
                    <div class="row form-group">
                        <div class="col col-md-3"><label for="text" class=" form-control-label">Judul</label></div>
                        <div class="col-6 col-md-6"><input type="text" id="judul" name="judul"
                                                           placeholder="Judul" class="form-control">
                        </div>
                    </div>

                    <div class="row form-group">
                        <div class="col col-md-3"><label for="text" class=" form-control-label">Keterangan</label></div>
                        <div class="col-6 col-md-6"><textarea type="text" id="description" name="description"
                                                              placeholder="description" class="form-control"></textarea>
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
@endsection