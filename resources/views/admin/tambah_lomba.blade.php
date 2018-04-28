@extends('layouts.headerfooter')
@section('content')
    <!-- page content -->
    <div class="col-lg-10 centered">
        <div class="card">
            <div class="card-header">
                <strong>Tambah</strong> Lomba
            </div>
            @if(Session::has('message'))
                <div class="alert alert-success">
                    <p>{{ Session::get('message') }}</p>
                </div>
            @endif
            <form action="/postlomba" method="post" enctype="multipart/form-data" class="form-horizontal">
                {{csrf_field()}}
            <div class="card-body card-block">
                    <div class="row form-group">
                        <div class="col col-md-3"><label for="text" class=" form-control-label">Nama Lomba</label></div>
                        <div class="col-6 col-md-6"><input type="text" id="lomba" name="lomba"
                                                            placeholder="Nama Lomba" class="form-control">
                        </div>
                    </div>
                    <div class="row form-group">
                        <div class="col col-md-3"><label for="text" class=" form-control-label">Penangnggung Jawab</label>
                        </div>
                        <div class="col-6 col-md-6"><input type="text" id="pj" name="pj"
                                                           placeholder="Penanggung Jawab" class="form-control">
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
@endsection