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
                        @if(!empty($user))
                            <div class="card-body">
                                <table id="bootstrap-data-table" class="table table-striped table-bordered">
                                    <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Name</th>
                                        <th>Email</th>
                                        <th>Tanggal Lagir</th>
                                        <th>No. Hp</th>
                                        <th>Alamat</th>
                                        <th>Foto</th>
                                        <th>Action</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <?php $i=1?>
                                    @foreach($user as $u)
                                        <tr>
                                            <td>{{$i++}}</td>
                                            <td>{{$u->nama}}</td>
                                            <td>{{$u->email}}</td>
                                            <td>{{$u->tgl_lahir}}</td>
                                            <td>{{$u->no_hp}}</td>
                                            <td>{{$u->alamat}}</td>
                                            <td>{{$u->fot}}</td>
                                            <td>
                                                <center>
                                                    <button type="delete" name="delete" id="btnhapus" value="delete"
                                                            class="btn btn-inline btn-danger btn-sm ladda-button"
                                                            onclick="return confirm('Are you sure to delete this data');"><i
                                                                class="fa fa-trash"></i></button>
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
@endsection