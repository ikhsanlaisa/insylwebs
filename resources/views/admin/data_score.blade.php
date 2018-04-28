@extends('layouts.headerfooter')
@section('content')
    <div class="content mt-3">
        <div class="animated fadeIn">
            <div class="row">

                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header">
                            <a type="submit" href="/tambah_score" class="btn" style="border-radius: 20px">
                                <i class="fa fa-dot-circle-o"></i> Tambah Score
                            </a>
                        </div>
                        @if(Session::has('message'))
                            <div class="alert alert-success">
                                <p>{{ Session::get('message') }}</p>
                            </div>
                        @endif
                        @if(!empty($score))
                            <div class="card-body">
                                <table id="bootstrap-data-table" class="table table-striped table-bordered">
                                    <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Jadwal</th>
                                        <th>Cabor</th>
                                        <th>Kelas</th>
                                        <th>Score</th>
                                        <th>Keterangan</th>
                                        <th>Lokasi</th>
                                        <th>Action</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <?php $i = 1?>
                                    @foreach($score as $s)
                                        <tr>
                                            <td>{{$i++}}</td>
                                            <td>{{$s->jadwal->date_time}}</td>
                                            <td>{{$s->cabor}}</td>
                                            <td>{{$s->tim1}} vs {{$s->tim2}}</td>
                                            <td>{{$s->score}}</td>
                                            <td>{{$s->keterangan}}</td>
                                            <td>{{$s->lokasi}}</td>
                                            <td>
                                                <center>
                                                    <form action="/deletescore/{{$s->id}}" method="post" >
                                                        {{csrf_field()}}
                                                        <input type="hidden" name="_method" value="delete">
                                                        <button type="button" class="btn btn-inline btn-success btn-sm ladda-button"
                                                                onclick="showModal({{ $s->id }})" title="edit" name="button"
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
                            <label class="col-sm-3 form-control-label">Jadwal :</label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control" name="jadwal" id="jadwal" disabled>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-3 form-control-label">Cabang Olahraga :</label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control" name="cabor" id="cabor" disabled>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-3 form-control-label">Kelas :</label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control" name="kelas" id="kelas" disabled>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-3 form-control-label">Score :</label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control" name="score" id="score">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-3 form-control-label">Keterangan :</label>
                            <div class="col-sm-9">
                                <textarea type="text" class="form-control" name="keterangan" id="keterangan"></textarea>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-3 form-control-label">Lokasi :</label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control" name="lokasi" id="lokasi" disabled>
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
            document.getElementById('formEdit').action = "/updatedatascore/"+ id;
            console.log("diklik " + id);
            jadwal = document.getElementById('jadwal');
            cabor = document.getElementById('cabor');
            kelas = document.getElementById('kelas');
            score = document.getElementById('score');
            keterangan = document.getElementById('keterangan');
            lokasi = document.getElementById('lokasi');
            $.ajax({
                type: 'GET',
                url: '/detailscore/' + id,
                dataType: 'json',
                success: function (data) {
                    if (data !== null) {
                        console.log(data);
                        console.log('datanya 2 = ' + data.scr.id);
                        jadwal.value = data.jad.date_time;
                        kelas.value = data.scr.tim1 + " vs " + data.scr.tim2;
                        cabor.value = data.scr.cabor;
                        score.value = data.scr.score;
                        keterangan.value = data.scr.keterangan;
                        lokasi.value = data.scr.lokasi;

                    } else {
                        console.log('null')
                        cabang_olahraga.value = "";
                        pj.value = "";
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