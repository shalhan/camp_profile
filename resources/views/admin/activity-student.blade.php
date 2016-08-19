@extends('master')

@section('header-content')
  Activity
@endsection

@section('span-content')
  Student
@endsection

@section('breadcrumb')
  Student
@endsection


@section('content')
<div class="row">
  <div class="col-xs-12">
      <div class="box">
        <div class="box-header">
          <h3 class="box-title">All student</h3>
        </div>
        <!-- /.box-header -->
        <div class="box-body">
          <table id="example1" class="table table-bordered table-hover">
            <thead>
            <tr>
              <th>Nama</th>
              <th>NIM</th>
              <th>Kegiatan</th>
              <th>Mulai</th>
              <th>Selesai</th>
              <th>Pencapaian</th>
            </tr>
            </thead>
            <tbody>
            @foreach($view as $row)
            <tr class="select-row" data-href="{{ url('activity-details/' . $row->id_activities) }}">
              <td>{{ucwords(strtolower($row->nama))}}</td>
              <td>{{$row->id_people}}</td>
              <td>{{$row->nama_kegiatan}}</td>
              <td>{{$row->tgl_mulai}}</td>
              <td>{{$row->tgl_selesai}}</td>
              <td>{{$row->pencapaian}}</td>
            </tr>
            @endforeach
          </tbody>
        </table>
      </div>
    </div>
  </div>

</div>
@endsection
