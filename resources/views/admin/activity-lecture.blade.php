@extends('master')

@section('header-content')
  Aktifitas
@endsection

@section('span-content')
  Dosen
@endsection

@section('breadcrumb')
  Dosen
@endsection

@section('content')
<div class="row">
  @if(Session::has('empty_table'))
  <div class="callout callout-warning">
      <h4>Warning!</h4>
      <p>{{Session::get('empty_table')}}</p>
    </div>
  @endif
  <div class="col-xs-12">
    <div class="modal export">

      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span></button>
            <h4 class="modal-title">Export</h4>
          </div>
          <form action="{{ route('export-all-lecture-activity') }}" role="form" method="post">
            {{ csrf_field() }}
            <div class="modal-body">
              <div class="form-group">
                    <div class="radio">
                      <label>
                        <input type="radio" name="export" id="optionsRadios1" value="0" checked="" data-id="filter_year">
                        Export semua data
                      </label>
                    </div>
                    <div class="radio">
                      <label>
                        <input type="radio" name="export" id="optionsRadios2" value="1" data-id="all">
                          Filter
                      </label>
                    </div>
                  </div>

                  <hr />
                  <div id="filter_year" class="row none">
                    <div class="col-md-4">
                      <div  class="form-group">
                        <label>Nama</label>
                        <select class="form-control" name="nama">
                          <option value="0">Semua</option>
                          {{$viewNama = ""}}
                          @foreach($view as $row)
                            @if($viewNama != $row->nama)
                              {{$viewNama = $row->nama}}
                              <option value="{{$row->id_people}}">{{$viewNama}}</option>
                            @endif
                          @endforeach
                        </select>
                      </div>
                    </div>
                    <div class="col-md-4">
                      <div  class="form-group">
                        <label>Tahun</label>
                        <select class="form-control" name="year">
                          <option value="0">Semua</option>
                          <?php $viewYear = array() ?>
                          @foreach($view as $row)
                            @if(!in_array($row->year, $viewYear))
                              {{array_push($viewYear, $row->year)}}
                            @endif
                          @endforeach

                          @foreach($viewYear as $row)
                            <option value="{{$row}}">{{$row}}</option>
                          @endforeach
                        </select>
                      </div>
                    </div>
                  </div>
                  <div id="all" class="none"></div>

            </div>

          <div class="modal-footer">
            <button type="submit" class="btn btn-primary" >Export</button>
          </div>
            </form>
        </div>
        <!-- /.modal-content -->
      </div>
      <!-- /.modal-dialog -->
    </div>
      <div class="box">
        <div class="box-header">
          <h3 class="box-title">All lecture</h3>
          <div class="box-tools pull-right">
            <a href="" data-toggle="modal" data-target=".export">EXPORT</a>
          </div>
        </div>
        <!-- /.box-header -->
        <div class="box-body">
          <table id="example1" class="table table-bordered table-hover">
            <thead>
            <tr>
              <th>Nama</th>
              <th>Kegiatan</th>
              <th>Mulai</th>
              <th>Selesai</th>
              <th>Pencapaian</th>
            </tr>
            </thead>
            <tbody>
            @foreach($view as $row)
            <tr class="select-row" data-href="{{ url('activity-details/' . $row->id_activities) }}">
              <td>{{$row->nama}}</td>
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

</div>
@endsection
