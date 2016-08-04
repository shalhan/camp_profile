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
<div class="col-md-8 col-md-offset-2">
  <!-- general form elements -->
  <div class="box box-primary">
    <!-- /.box-header -->
    @if (count($errors) > 0)
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>

            @endforeach
        </ul>
    </div>
    @endif
    <form action="{{ route('insertData') }}" role="form" method="post" enctype="multipart/form-data">
      {{ csrf_field() }}
      <div class="box-body">
        <div class="form-group">
          <label for="name">Activity Name</label>
          <input type="text" class="form-control" id="inputName" placeholder="Enter name" name="activity">
        </div>
        <div class="form-group">
          <label for="inputCategory">Category</label>
          <input type="text" class="form-control" id="inputCategory" placeholder="Category" name="category">
        </div>
        <div class="form-group">
          <label for="fund">Cakupan</label>
          <input type="text" class="form-control" id="inputSource" placeholder="Cakupan" name="cakupan">
        </div>
        <!-- Date range -->
        <div class="form-group">
          <label>Date range:</label>

          <div class="input-group">
            <div class="input-group-addon">
              <i class="fa fa-calendar"></i>
            </div>
            <input type="text" class="form-control pull-right" id="reservation" name="daterange">
          </div>
          <!-- /.input group -->
        </div>
        <div class="form-group">
          <label for="fund">Source of funds</label>
          <input type="text" class="form-control" id="inputSource" placeholder="Source of funds" name="fund">
        </div>
        <div class="form-group">
          <label for="achievement">Achievement</label>
          <input type="text" class="form-control" id="inputAchievement" placeholder="Achievement" name="achievement">
        </div>
              <!-- /.input group -->
        <div class="form-group">
          <label>Description</label>
          <textarea class="form-control" rows="3" placeholder="Description" name="description"></textarea>
        </div>
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
