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
            <form action="/postscore" id="formEdit" method="post" enctype="multipart/form-data"
                  class="form-horizontal">
                {{csrf_field()}}
                <div class="card-body card-block">
                    <div class="row form-group">
                        <div class="col col-md-3"><label for="text" class=" form-control-label">Jadwal </label></div>

                        <div class="col-6 col-md-6">
                            <select class="form-control" id="jadwal" name="jadwal" required>
                                <option selected disabled>-Pilih Jadwal-</option>
                                @foreach($jadwal as $j)
                                    <option value="{{$j->id}}">{{$j->date_time}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="row form-group">
                        <div class="col col-md-3"><label for="text" class=" form-control-label">Keterangan</label></div>
                        <div class="col-6 col-md-6"><textarea type="text" id="keterangan" name="keterangan"
                                                              placeholder="Keterangan" class="form-control"></textarea>
                        </div>
                    </div>
                    <div class="row form-group">
                        <div class="col col-md-3"><label for="text" class=" form-control-label">Cabang Olahraga</label>
                        </div>
                        <div class="col-6 col-md-6">
                            <input type="text" id="cabor" name="cabor"
                                                           placeholder="Nama Cabor" class="form-control" disabled>
                            <input type="text" id="caborid" name="caborid"
                                                           placeholder="Nama Cabor" class="form-control" hidden>
                        </div>
                    </div>
                    <div class="row form-group">
                        <div class="col col-md-3"><label for="text" class=" form-control-label">Tim 1</label></div>
                        <div class="col-6 col-md-6">
                            <input type="text" id="tim1" name="tim1"
                                                           placeholder="Nama Tim" class="form-control" disabled>
                            <input type="text" id="tim1id" name="tim1id"
                                                           placeholder="Nama Tim" class="form-control" hidden>
                        </div>
                    </div>
                    <div class="row form-group">
                        <div class="col col-md-3"><label for="text" class=" form-control-label">Tim 2</label></div>
                        <div class="col-6 col-md-6">
                            <input type="text" id="tim2" name="tim2"
                                                           placeholder="Nama Tim" class="form-control" disabled>
                            <input type="text" id="tim2id" name="tim2id"
                                                           placeholder="Nama Tim" class="form-control" hidden>
                        </div>
                    </div>
                    {{--<div class="row form-group">--}}
                        {{--<div class="col col-md-3"><label for="text" class=" form-control-label">Tim yang menang </label></div>--}}
                        {{--<div class="col-6 col-md-6">--}}
                            {{--<select class="form-control" id="jadwal" name="jadwal" required>--}}
                                {{--<option selected disabled>-Pilih Jadwal-</option>--}}
                                {{--@foreach($kelas as $k)--}}
                                    {{--<option value="{{$k->id}}">{{$k->nama_kelas}}</option>--}}
                                {{--@endforeach--}}
                            {{--</select>--}}
                        {{--</div>--}}
                    {{--</div>--}}
                    <div class="row form-group">
                        <div class="col col-md-3"><label for="text" class=" form-control-label">Score</label></div>
                        <div class="col-6 col-md-6"><input type="text" id="score" name="score"
                                                           placeholder="Score" class="form-control">
                        </div>
                    </div>
                    <div class="row form-group">
                        <div class="col col-md-3"><label for="text" class=" form-control-label">Lokasi</label></div>
                        <div class="col-6 col-md-6">
                            <input type="text" id="lokasi" name="lokasi"
                                                           placeholder="Lokasi" class="form-control" disabled>
                            <input type="text" id="lokasis" name="lokasis"
                                                           placeholder="Lokasi" class="form-control" hidden>
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

        $('#jadwal').on('change', function (e) {
            console.log(e);
            var a = e.target.value;
            cabor = document.getElementById('cabor');
            caborid = document.getElementById('caborid');
            tim1 = document.getElementById('tim1');
            tim1id = document.getElementById('tim1id');
            tim2 = document.getElementById('tim2');
            tim2id = document.getElementById('tim2id');
            lokasi = document.getElementById('lokasi');
            lokasis = document.getElementById('lokasis');
            $.get('/detaildatajadwal/' + a, function (data) {
//
                $.ajax({
                    type: 'GET',
                    url: '/detaildatajadwal/' + a,
                    dataType: 'json',
                    success: function (returnJSON) {
                        console.log(returnJSON);
                        if (returnJSON !== null) {
                            console.log('data = ' + returnJSON);
                            console.log('datanya 2 = ' + returnJSON.id);
//                            keterangan.value = jad.keterangan;
                            cabor.value = returnJSON.cabor.cabang_olahraga;
                            caborid.value = returnJSON.cabor.id;
                            tim1.value = returnJSON.tim1.nama_kelas;
                            tim1id.value = returnJSON.tim1.id;
                            tim2.value = returnJSON.tim2.nama_kelas;
                            tim2id.value = returnJSON.tim2.id;
//                            score.value = jad.score;
                            lokasi.value = returnJSON.jadwal.lokasi;
                            lokasis.value = returnJSON.jadwal.lokasi;

                        } else {
                            console.log('null')
                            keterangan.value = "";
                            tim1.value = "";
                            tim2.value = "";
                            score.value = "";
                            lokasi.value = "";
                        }

                    },
                    error: function (XMLHttpRequest, textStatus, errorThrown) {
                        console.log("error bro");
                        console.log(textStatus);
                        console.log(errorThrown);

                    }
                });
            });
        });
    </script>
@endsection