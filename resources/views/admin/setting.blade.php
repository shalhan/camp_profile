@extends('master')

@section('header-content')
  Pengaturan
@endsection

@section('span-content')

@endsection

@section('breadcrumb')
  Pengaturan
@endsection

@section('content')
<div class="row">
    <div class="col-md-6">
      <div class="box">
        <div class="box-header">
          <h3 class="box-title">Category</h3>
          <div class="box-box-tools pull-right">
            <div class="add">
              <i onclick="addCat({{$count}})" class="fa fa-plus"></i>
            </div>
          </div>
        </div>
        <!-- /.box-header -->
        <div class="box-body">
          <table id="category-table" class="table table-condensed">
            @foreach($view as $row)

              <tr>

                <input type="hidden" value="{{$row->id_category}}">
                <td style="width:80%;">
                  <form action="{{ url('setting/update-category/' . $row->id_category)}}" method="post">
                    {{csrf_field()}}
                    <div id="category{{$row->id_category}}">{{$row->nama_cat}}</div>
                  </form>
                </td>

                <td class="setting">
                  <a class="click" onclick="changeCat({{$row->id_category}})">Edit</a>
                </td>
                <td class="setting">
                  <a href="{{url('setting/delete-category/' . $row->id_category)}}" class="delete"> Delete</a>
                </td>
              </tr>


            @endforeach

          </table>
        </div>
        <!-- /.box-body -->
      </div>
      <!-- /.box -->
    </div>
  <div class="col-md-6">
    <div class="box">
      <div class="box-header">
        <h3 class="box-title">Cakupan</h3>
        <div class="box-box-tools pull-right">
          <div class="add">
            <i onclick="addCak({{$count2}})" class="fa fa-plus"></i>
          </div>
        </div>
      </div>
      <!-- /.box-header -->
      <div class="box-body">
        <table id="cakupan-table" class="table table-condensed">
          @foreach($view2 as $row)
          <tr>

            <input type="hidden" value="{{$row->id_cakupan}}">
            <form action="{{ url('setting/update-cakupan/' . $row->id_cakupan)}}" method="post">
              {{csrf_field()}}
              <td style="width:80%;" id="cakupan{{$row->id_cakupan}}">{{$row->nama_cak}}</td>
            </form>
            <td class="setting">
              <a class="click" onclick="changeCak({{$row->id_cakupan}})">Edit</a>
            </td>
            <td class="setting">
              <a href="{{url('setting/delete-cakupan/' . $row->id_cakupan)}}" class="delete" > Delete</a>
            </td>
          </tr>
          @endforeach
          <tr></tr>
        </table>
      </div>
      <!-- /.box-body -->
    </div>
    <!-- /.box -->
  </div>
</div>

</div>


@endsection
