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
          
          <tr>
            <td>{{$nama}}</td>
            <td>{{$citation}}</td>
            <td></td>
            <td></td>
            <td></td>
          </tr>

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
            <td>{{number_format($summary['meanCitation'],2)}}</td>
            <td></td>
            <td></td>
          </tr>
          <tr>
            <td>Median</td>
            <td></td>
            <td></td>
            <td></td>
          </tr>
          <tr>
            <td>Min</td>
            <td>{{$summary['minCitation']}}</td>
            <td></td>
            <td></td>
          </tr>
          <tr>
            <td>Max</td>
            <td>{{$summary['maxCitation']}}</td>
            <td></td>
            <td></td>
          </tr>
          <tr>
            <td>STDEV</td>
            <td></td>
            <td></td>
            <td></td>
          </tr>

        </tbody>
      </table>
    </div>
  </div>
</div>
  </div>
</div>
@endsection
