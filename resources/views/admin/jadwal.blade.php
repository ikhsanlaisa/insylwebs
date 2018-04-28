@extends('layouts.headerfooter')
@section('content')
    <div class="content mt-3">
        <div class="animated fadeIn">
            <div class="row">

                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header">
                            <a type="submit" href="/tambah_jadwal" class="btn" style="border-radius: 20px">
                                <i class="fa fa-dot-circle-o"></i> Tambah Jadwal
                            </a>
                        </div>
                        @if(Session::has('message'))
                            <div class="alert alert-success">
                                <p>{{ Session::get('message') }}</p>
                            </div>
                        @endif
                        @if(!empty($jadwal))
                            <div class="card-body">
                                <table id="bootstrap-data-table" class="table table-striped table-bordered">
                                    <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Kelas </th>
                                        <th>Cabang Olahraga</th>
                                        <th>Lokasi</th>
                                        <th>Tanggal Pertandingan</th>
                                        <th>Action</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <?php $i = 1?>
                                    @foreach($jadwal as $j)
                                        <tr>
                                            <td><center>{{$i++}}</center></td>
                                            <td><center>{{$j->kelas->nama_kelas}} VS {{$j->kelas1->nama_kelas}}</center></td>
                                            <td><center>{{$j->cb_olahraga->cabang_olahraga}}</center></td>
                                            <td><center>{{$j->lokasi}}</center></td>
                                            <td><center>{{$j->date_time}}</center></td>
                                            <td>
                                                <center>
                                                    <form action="/deletedatajadwal/{{$j->id}}" method="post" >
                                                        {{csrf_field()}}
                                                        <input type="hidden" name="_method" value="delete">
                                                        <button type="button" class="btn btn-inline btn-success btn-sm ladda-button"
                                                                onclick="showModal({{ $j->id }})" title="edit" name="button"
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
                            <label class="col-sm-3 form-control-label">Nama Kelas 1:</label>
                            <div class="col-sm-9">
                                <select class="form-control" name="tim1" required>
                                    <option selected disabled>-Pilih Kelas 1-</option>
                                    @foreach($kelas as $k)
                                    <option value="{{$k->id}}">{{$k->nama_kelas}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-3 form-control-label">Nama Kelas 2:</label>
                            <div class="col-sm-9">
                                <select class="form-control" name="tim2" required>
                                    <option selected disabled>-Pilih Kelas 2-</option>
                                    @foreach($kelas as $k)
                                    <option value="{{$k->id}}">{{$k->nama_kelas}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-3 form-control-label">Cabang Olahraga:</label>
                            <div class="col-sm-9">
                                <select class="form-control" name="lomba" required>
                                    <option selected disabled>-Pilih Cabang Olahraga-</option>
                                    @foreach($lomba as $l)
                                    <option value="{{$l->id}}">{{$l->cabang_olahraga}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-3 form-control-label">Lokasi :</label>
                            <div class="col-sm-9">
                                <input type="text" id="lokasi" name="lokasi"
                                       placeholder="Lokasi" class="form-control">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-3 form-control-label">Tanggal Pertandingan :</label>
                            <div class="col-sm-9">
                                <input type="datetime-local" id="tgl" name="tgl"
                                       placeholder="Tanggal Tanding" class="form-control">
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
            document.getElementById('formEdit').action = "/updatejadwal/"+ id;
            console.log("diklik " + id);
            lokasi = document.getElementById('lokasi');
            date_time = document.getElementById('tgl');
            $.ajax({
                type: 'GET',
                url: '/detailjadwal/' + id,
                dataType: 'json',
                success: function (jadwal) {
                    if (jadwal[0] !== null) {
                        console.log('data = ' + jadwal);
                        console.log('datanya 2 = ' + jadwal[0].id);
                        lokasi.value = jadwal[0].lokasi;
                        date_time.value = jadwal[0].date_time;

                    } else {
                        console.log('null');
                        lokasi.value = "";
                        date_time.value = "";
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