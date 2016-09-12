@extends('master')

@section('header-content')
  Activity
@endsection

@section('span-content')
  Add
@endsection

@section('breadcrumb')
  Activity
@endsection

@section('content')
<div class="row">
  <div class="col-md-10 col-md-offset-1">
    @if(Session::has('empty_activity'))
    <div class="callout callout-danger">
        <p>{{Session::get('empty_activity')}}</p>
      </div>
    @endif
    <!-- general form elements -->
    <div class="box box-primary">
      <!-- /.box-header -->
      <!-- form start -->
      <form action="{{ route('insertActivity') }}" role="form" method="post">
        {{ csrf_field() }}
        <div class="box-body">
          <div class="form-group">
            <label for="name">Nama Kegiatan</label>
            <input type="text" class="form-control" id="inputName" placeholder="Enter name" name="activity">
          </div>
          <div class="row">
              <div class="col-md-6">
                <div class="form-group">
                  <label>Kategori</label>
                  <select class="form-control select2" style="width: 100%;" name="category">
                    @foreach($viewCat as $row)
                    <option value="{{$row->id_category}}">{{$row->nama_cat}}</option>
                    @endforeach
                  </select>
                </div>
            </div>
            <div class="col-md-6">
              <div class="form-group">
                <label>Cakupan</label>
                <select class="form-control select2" style="width: 100%;" name="cakupan">
                  @foreach($viewCak as $row)
                  <option value="{{$row->id_cakupan}}">{{$row->nama_cak}}</option>

                  @endforeach
                </select>
              </div>
            </div>
        </div>

          <!-- Date range -->
          <div class="form-group">
            <label>Lama Kegiatan</label>

            <div class="input-group">
              <div class="input-group-addon">
                <i class="fa fa-calendar"></i>
              </div>
              <input type="text" class="form-control pull-right" id="reservation" name="daterange">
            </div>
            <!-- /.input group -->
          </div>
          <div class="form-group">
            <label for="fund">Sumber Dana</label>
            <input type="text" class="form-control" id="inputSource" placeholder="Source of funds" name="fund">
          </div>
          <div class="form-group">
            <label for="achievement">Pencapaian</label>
            <input type="text" class="form-control" id="inputAchievement" placeholder="Achievement" name="achievement">
          </div>
                <!-- /.input group -->
          <div class="form-group">
            <label>Deskripsi</label>
            <textarea class="form-control" rows="3" placeholder="Description" name="description"></textarea>
          </div>

          <!-- <div class="form-group">
            <label for="exampleInputFile">Image</label>
            <input type="file" id="image" name="imgActivities[]" multiple>
          </div> -->

        </div>
        <!-- /.box-body -->

        <div class="box-footer">
          <button type="submit" class="btn btn-primary">Submit</button>
        </div>
      </form>
    </div>
  </div>
</div>

@endsection
