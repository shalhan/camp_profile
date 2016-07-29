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


@section('content')
<div class="row">
  <div class="col-md-10 col-md-offset-1">
    <div class="box box-success post-activity">
      @foreach ($view as $row)
      <div class="box-header with-border">
        <h3 class="box-title">{{ ucwords($row->nama_kegiatan) }}</h3>
        <div class="box-tools pull-right">
          <a href="{{ url('activity-details/delete/' . $row->id_activities) }}"><p class="delete">DELETE</p></a>
        </div>
      </div>
      <div class="box-body">
        <div class="img">
          <img src="{{ asset ("/uploads/$row->img") }}"><br><br>
        </div>
        <div class="detail">
          <div class="cakupan">Cakupan : {{ ucwords($row->cakupan) }}</div>
          <div class="start-date">Mulai : {{ $row->tgl_mulai }}</div>
          <div class="end-date">Selesai : {{ $row->tgl_selesai }}</div>
          <div class="sumber-dana">Sumber Dana : {{ ucwords($row->sumber_dana) }}</div>
          <div class="pencapaian">Pencapaian : {{ ucwords($row->pencapaian) }}</div><hr>
          <div class="deskripsi"><p>{{ ucfirst($row->deskripsi) }}</p></div>
        </div>
        @endforeach
      </div>
    </div>
  </div>
</div>
@endsection
