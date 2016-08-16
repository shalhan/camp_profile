@extends('master')

@section('header-content')
  Dashboard
@endsection

@section('span-content')
  Paper
@endsection

@section('breadcrumb')
  Dashboard
@endsection

@section('content')

<div class="row">
  <div class="col-md-6">
    <!-- BAR CHART -->
    <div class="box box-success">
      <div class="box-header with-border">
        <h3 class="box-title">Bar Chart</h3>

        <div class="box-tools pull-right">
          <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
          </button>
          <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
        </div>
      </div>
      <div class="box-body">
        <div class="chart">
          <canvas id="barChart" style="height:230px"></canvas>
        </div>
      </div>
      <!-- /.box-body -->
    </div>
  </div>
  <div class="col-lg-3 col-xs-6">
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
        @if($hindex > $row->citedby)
          $hindex+=1
        @endif
        @if($row->citedby >= 10)
          $i10index++;
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

  <div class="col-lg-3 col-xs-6">
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
    <!-- small box total-->
    <div class="small-box bg-aqua">
      <div class="inner">
        <h3>{{$totalPaper}}</h3>
        <p>Total Paper</p>
      </div>
      <div class="icon">
        <i class="ion ion-bag"></i>
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
                  <h4 class="paper_title">{{ $row->judul }}</h4>
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
