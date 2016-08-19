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

@section('sidebar')
<li><a href="{{ url('admin-dashboard') }}"><i class="fa fa-dashboard"></i> <span>Dashboard</span></a></li>
<li><a href="{{ url('admin-activity-lecture') }}"><i class="fa fa-table"></i> <span>Lecture</span></a></li>
<li><a href="{{ url('admin-activity-student') }}"><i class="fa fa-book"></i> <span>Student</span></a></li>
@endsection

@section('content')
<div class="row">
<div class="col-md-10 col-md-offset-1">
  <!-- general form elements -->
  <div class="box box-primary">
    <!-- /.box-header -->
    <!-- form start -->
    <form role="form">
      <div class="box-body">
        <div class="form-group">
          <label for="name">Activity Name</label>
          <input type="text" class="form-control" id="inputName" placeholder="Enter name">
        </div>
        <div class="form-group">
          <label for="inputCategory">Category</label>
          <input type="text" class="form-control" id="inputCategory" placeholder="Category">
        </div>
        <!-- Date range -->
        <div class="form-group">
          <label>Date range:</label>

          <div class="input-group">
            <div class="input-group-addon">
              <i class="fa fa-calendar"></i>
            </div>
            <input type="text" class="form-control pull-right" id="reservation">
          </div>
          <!-- /.input group -->
        </div>
        <div class="form-group">
          <label for="fund">Source of funds</label>
          <input type="text" class="form-control" id="inputSource" placeholder="Source of funds">
        </div>
        <div class="form-group">
          <label for="achievement">Achievement</label>
          <input type="text" class="form-control" id="inputAchievement" placeholder="Achievement">
        </div>
              <!-- /.input group -->
        <div class="form-group">
          <label>Description</label>
          <textarea class="form-control" rows="3" placeholder="Description"></textarea>
        </div>

        <div class="form-group">
          <label for="exampleInputFile">Image</label>
          <input type="file" id="image">
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
