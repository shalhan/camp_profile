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

@section('sidebar')
<li><a href="{{ url('dashboard') }}"><i class="fa fa-dashboard"></i> <span>Dashboard</span></a></li>
<li class="active"><a href="{{ url('activity') }}"><i class="fa fa-table"></i> <span>Activity</span></a></li>
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
            <tr class="select-row" data-href="{{ url('activity-details') }}">
              <td>Lomba Gemastik</td>
              <td>29 April 2016</td>
              <td>3 Mei 2016</td>
              <td>Juara 1 UI/UX</td>
            </tr>
            <tr class="select-row">
              <td>Lomba Gemastik</td>
              <td>29 April 2016</td>
              <td>3 Mei 2016</td>
              <td>Juara 1 UI/UX</td>
            </tr>
            <tr class="select-row">
              <td>Lomba Gemastik</td>
              <td>29 April 2016</td>
              <td>3 Mei 2016</td>
              <td>Juara 1 UI/UX</td>
            </tr>
            <tr class="select-row">
              <td>Lomba Gemastik</td>
              <td>29 April 2016</td>
              <td>3 Mei 2016</td>
              <td>Juara 1 UI/UX</td>
            </tr>
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
