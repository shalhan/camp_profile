@extends('master')

@section('header-content')
  Beranda
@endsection

@section('span-content')
  Paper
@endsection

@section('breadcrumb')
  Beranda
@endsection

@section('content')

<div class="row">
  <div class="col-md-3">
    <!-- small box citation -->
    <div class="small-box bg-green">
      <div class="hidden">
      {{$citation=0}}
      {{$totalPaper=0}}
      {{$hindex=0}}
      {{$i10index=0}}
      @foreach($view as $row)
        {{$citation+=(int)$row->citedby}}
        {{$totalPaper++}}
        @if($hindex < $row->citedby)
          {{$hindex++}}
        @endif
        @if($row->citedby >= 10)
        {{  $i10index++}}
        @endif
      @endforeach
      </div>
      <div class="inner">
        <h3>{{$citation}}</h3>
        <p>Citation</p>
      </div>

      <div class="icon">
        <i class="ion ion-stats-bars"></i>
      </div>
    </div>
  </div>
    <div class="col-md-3">
    <!-- small box hindex-->
    <div class="small-box bg-yellow">
      <div class="inner">
        <h3>{{$hindex}}</h3>
        <p>H-Index</p>
      </div>
      <div class="icon">
        <i class="ion ion-person-add"></i>
      </div>
    </div>
  </div>


  <div class="col-md-3">
    <!-- small box total-->
    <div class="small-box bg-red">
      <div class="inner">
        <h3>{{$i10index}}</h3>
        <p>i10-Index</p>
      </div>
      <div class="icon">
        <i class="ion ion-pie-graph"></i>
      </div>
    </div>
  </div>
    <div class="col-md-3">
    <!-- small box total-->
    <div class="small-box bg-aqua">
      <div class="inner">
        <h3>{{$totalPaper}}</h3>
        <p>Total Paper</p>
      </div>
      <div class="icon">
        <i class="ion ion-document-text"></i>
      </div>
    </div>
  </div>
</div>

<div class="row">
  <div class="col-xs-12">
    <div class="box">
      <div class="box-header clearfix">
        <h3 class="box-title">Paper Data Table</h3>
      </div>
      <!-- /.box-header -->
      <div class="box-body">
        <table id="example2" class="table table-bordered table-hover">
          <thead>
          <tr>
            <th>Paper</th>
            <th>Citedby</th>
            <th>Year</th>
          </tr>
          </thead>
          <tbody>
            @foreach($view as $row)
            <tr>
              <td>
                  <h4 class="paper_title"><a href="http://scholar.google.co.id/{{$row->link}}">{{ $row->judul }}</a></h4>
                  <p class="td_gray">{{ $row->author }}</p>
                  <p class="td_gray">{{ $row->jurnal }}</p>
              </td>
              <td>{{ $row->citedby }}</td>
              <td>{{ $row->year }}</td>
            </tr>
            @endforeach
        </tbody>
      </table>
    </div>
  </div>
</div>
</div>
@endsection
