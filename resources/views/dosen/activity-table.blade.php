@extends('master')

@section('header-content')
  Activity
@endsection

@section('span-content')
  List
@endsection

@section('breadcrumb')
  Activity
@endsection

@section('content')
<div class="row">
  <div class="col-xs-12">
      <div class="box">
        <!-- /.box-header -->
        <div class="box-body">
          <table id="example2" class="table table-bordered table-hover">
            <thead>
            <tr>
              <th>Activity</th>
              <th>Start</th>
              <th>End</th>
              <th>Achievment</th>
            </tr>
            </thead>
            <tbody>
            @foreach($view as $row)
            <tr class="select-row" data-href="{{ url('activity-details/' . $row->id_activities) }}">
              <input type="hidden" value="{{ $row->id_activities }}" name="id">
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
  <div class="floating-button">
    <a href="/app/public/activity-add"><i class="ion ion-plus-circled"></i></a>
  </div>
</div>
@endsection
