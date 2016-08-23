@extends('master')

@section('header-content')
  Activity
@endsection

@section('span-content')
  Lecture
@endsection

@section('breadcrumb')
  Lecture
@endsection

@section('content')
<div class="row">
  @if(Session::has('empty_table'))
  <div class="callout callout-warning">
      <h4>Warning!</h4>
      <p>{{Session::get('empty_table')}}</p>
    </div>
  @endif
  <div class="col-xs-12">
      <div class="box">
        <div class="box-header">
          <h3 class="box-title">All lecture</h3>
          <div class="box-tools pull-right">
            <a href="{{ route('export-all-lecture-activity')}}"><p>EXPORT</p></a>
          </div>
        </div>
        <!-- /.box-header -->
        <div class="box-body">
          <table id="example1" class="table table-bordered table-hover">
            <thead>
            <tr>
              <th>Nama</th>
              <th>Kegiatan</th>
              <th>Mulai</th>
              <th>Selesai</th>
              <th>Pencapaian</th>
            </tr>
            </thead>
            <tbody>
            @foreach($view as $row)
            <tr class="select-row" data-href="{{ url('activity-details/' . $row->id_activities) }}">
              <td>{{$row->nama}}</td>
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
