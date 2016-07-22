@extends('master')

@section('header-content')
  Activity
@endsection

@section('span-content')
  Details
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
  <div class="col-md-10 col-md-offset-1">
    <div class="box box-success post-activity">
      <div class="box-header with-border">
        <h3 class="box-title">Lomba Gemastik</h3>
        <div class="box-tools pull-right">
          <a href=""><p class="delete">DELETE</p></a>
        </div>
      </div>
      <div class="box-body">
        <div class="img">
          <img src="{{ asset("/bower_components/AdminLTE/dist/img/gemastik.jpg") }}"><br><br>
        </div>
        <div class="detail">
          <div class="cakupan">Cakupan : Nasional</div>
          <div class="start-date">Mulai : 29 April 2016</div>
          <div class="end-date">Selesai : 3 Mei 2016</div>
          <div class="sumber-dana">Sumber Dana : Departemen Ilmu Komputer</div>
          <div class="pencapaian">Pencapaian : Juara 1 UI/UX</div><hr>
          <div class="deskripsi">
            <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor
               incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,
               quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo
               consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse
               cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat
               non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.
             </p>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
@endsection
