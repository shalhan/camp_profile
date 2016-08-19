@extends('master')

@section('header-content')
  Dashboard
@endsection

@section('span-content')
  List
@endsection

@section('breadcrumb')
  Dashboard
@endsection

@section('content')
<div class="row">
  <div class="col-xs-12">
      <div class="box">
        <!-- /.box-header -->
        <form method="post">
          <div class="box-body">
            <div class="box-header">
              <div class="box-box-tools pull-right">
                <a href=""><p>EXPORT</p></a>
              </div>
            </div>
            <table id="example2" class="table table-bordered table-hover">
              <thead>
              <tr>
                <th>Kegiatan</th>
                <th>Mulai</th>
                <th>Selesai</th>
                <th>Pencapaian</th>
              </tr>
              </thead>
              <tbody>
              @foreach($view as $row)
              <tr class="select-row" data-href="{{ url('student-activity-details/' . $row->id_activities) }}">
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
      </form>
    </div>
  </div>
  <div class="floating-button">
    <a href="/app/public/student-activity-add"><i class="ion ion-plus-circled"></i></a>
  </div>
</div>
@endsection
