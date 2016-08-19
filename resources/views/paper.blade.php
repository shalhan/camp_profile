@extends('master')

@section('header-content')
  Paper
@endsection

@section('span-content')
  Summary
@endsection

@section('breadcrumb')
  Paper
@endsection

@section('content')
<div class="row">
  <div class="col-md-8">
    <div class="box">
      <div class="box-header">
        <h3 class="box-title">Dosen</h3>
      </div>
      <!-- /.box-header -->
      <div class="box-body">
        <table id="example1" class="table table-bordered table-hover">
          <thead>
          <tr>
            <th>Nama</th>
            <th>Citation</th>
            <th>H-Index</th>
            <th>i10-Index</th>
            <th></th>
          </tr>
          </thead>
          <tbody>

          @foreach($data as $row)
          <tr>
            <td>{{$row[0]}}</td>
            <td>{{$row[1]}}</td>
            <td>{{$row[2]}}</td>
            <td>{{$row[3]}}</td>
            <td></td>
          </tr>
          @endforeach
        </tbody>
      </table>
    </div>
  </div>
</div>
  <div class="col-md-4">
    <div class="box">
      <div class="box-header">
        <h3 class="box-title">Summary</h3>
      </div>
      <!-- /.box-header -->
      <div class="box-body">
        <table id="example1" class="table table-bordered table-hover">
          <thead>
          <tr>
            <th></th>
            <th>Citations</th>
            <th>H-Index</th>
            <th>i10-Index</th>
          </tr>
          </thead>
          <tbody>

          <tr>
            <td>Mean</td>
            <td>{{number_format($summary['meanCitation'], 2)}}</td>
            <td>{{number_format($summary['meanHindex'],2)}}</td>
            <td>{{number_format($summary['meani10Index'],2)}}</td>
          </tr>
          <tr>
            <td>Median</td>
            <td>{{number_format($summary['medianCitation'], 2)}}</td>
            <td>{{number_format($summary['medianHindex'], 2)}}</td>
            <td>{{number_format($summary['medianI10index'], 2)}}</td>
          </tr>
          <tr>
            <td>Min</td>
            <td>{{$summary['minCitation']}}</td>
            <td>{{$summary['minHindex']}}</td>
            <td>{{$summary['minI10index']}}</td>
          </tr>
          <tr>
            <td>Max</td>
            <td>{{$summary['maxCitation']}}</td>
            <td>{{$summary['maxHindex']}}</td>
            <td>{{$summary['maxI10index']}}</td>
          </tr>
          <tr>
            <td>STDEV</td>
            <td>{{number_format($summary['stdevCitation'], 2)}}</td>
            <td>{{number_format($summary['stdevHindex'], 2)}}</td>
            <td>{{number_format($summary['stdevI10index'], 2)}}</td>
          </tr>

        </tbody>
      </table>
    </div>
  </div>
</div>
  </div>
</div>
@endsection
