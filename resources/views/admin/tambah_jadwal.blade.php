@extends('layouts.headerfooter')
@section('content')
    <!-- page content -->
    <div class="col-lg-10 centered">
        <div class="card">
            <div class="card-header">
                <strong>Tambah</strong> Kelas
            </div>
            @if(Session::has('message'))
                <div class="alert alert-success">
                    <p>{{ Session::get('message') }}</p>
                </div>
            @endif
            <form action="/postjadwal" method="post" enctype="multipart/form-data" class="form-horizontal">
                {{csrf_field()}}
                <div class="card-body card-block">
                    <div class="row form-group">
                        <div class="col col-md-3"><label for="text" class=" form-control-label">Nama Kelas 1</label></div>
                        <div class="col-6 col-md-6">
                            <select class="form-control" name="tim1" required>
                                <option selected disabled>-Pilih Kelas 1-</option>
                                <?php foreach ($kelas as $k) : ?>
                                <option value="{{$k->id}}">{{$k->nama_kelas}}</option>
                                <?php endforeach ?>
                            </select>
                        </div>
                    </div>
                    <div class="row form-group">
                        <div class="col col-md-3"><label for="text" class=" form-control-label">Nama Kelas 2</label></div>
                        <div class="col-6 col-md-6">
                            <select class="form-control" name="tim2" required>
                                <option selected disabled>-Pilih Kelas 2-</option>
                                <?php foreach ($kelas as $k) : ?>
                                <option value="{{$k->id}}">{{$k->nama_kelas}}</option>
                                <?php endforeach ?>
                            </select>
                        </div>
                    </div>
                    <div class="row form-group">
                        <div class="col col-md-3"><label for="text" class=" form-control-label">Cabang Olahraga</label></div>
                        <div class="col-6 col-md-6"><select class="form-control" name="olahraga_id" required>
                                <option selected disabled>-Pilih Lomba-</option>
                                <?php foreach ($lomba as $l) : ?>
                                <option value="{{$l->id}}">{{$l->cabang_olahraga}}</option>
                                <?php endforeach ?>
                            </select>
                        </div>
                    </div>
                    <div class="row form-group">
                        <div class="col col-md-3"><label for="text" class=" form-control-label">Lokasi</label></div>
                        <div class="col-6 col-md-6"><input type="text" id="lokasi" name="lokasi"
                                                           placeholder="Lokasi" class="form-control">
                        </div>
                    </div>
                    <div class="row form-group">
                        <div class="col col-md-3"><label for="text" class=" form-control-label">Tanggal Tanding</label></div>
                        <div class="col-6 col-md-6"><input type="datetime-local" id="tgl" name="tgl"
                                                           placeholder="Tanggal Tanding" class="form-control">
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