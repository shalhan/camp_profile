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
  <div class="col-xs-12">
    <div class="box">
      <div class="box-header">
        <h3 class="box-title">Paper Data</h3>
        <div class="fetching">
          <a href="" data-toggle="modal" data-target=".modal"><i class="fa fa-repeat"></i> Fetching Paper</a>
        </div>
        <div class="box-tools pull-right">
          <a href="{{ route('export-paper') }}"><p>EXPORT</p></a>
        </div>
      </div>
      <!-- /.box-header -->
      <div class="box-body">
        <table id="example1" class="table table-bordered table-hover">
          <thead>
          <tr>
            <th>Nama</th>
            <th>Paper</th>
            <th>Citedby</th>
            <th>Year</th>
          </tr>
          </thead>
          <tbody>
          @foreach($view as $row)
          <tr>
            <td>{{$row->nama}}</td>
            <td>
                <h4 class="paper_title">{{$row->judul}}</h4>
                <p class="td_gray">{{$row->author}}</p>
                <p class="td_gray">{{$row->jurnal}}</p>
            </td>
            <td>{{$row->citedby}}</td>
            <td>{{$row->year}}</td>
          </tr>
          @endforeach
        </tbody>
      </table>
    </div>
  </div>

    <div class="modal">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span></button>
            <h4 class="modal-title">Warning</h4>
          </div>
          <div class="modal-body">
            <p>Apakah anda yakin ingin melanjutkan proses&hellip;?</p>
          </div>
          <div class="modal-footer">
            <button  type="button" class="btn btn-primary"><a href="{{route('get-paper')}}" style="color: inherit;">Lanjutkan</a></button>
          </div>
        </div>
        <!-- /.modal-content -->
      </div>
      <!-- /.modal-dialog -->
    </div>
    <!-- /.modal -->
</div>
</div>
@endsection
