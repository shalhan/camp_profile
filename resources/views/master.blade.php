<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>AdminLTE 2 | Starter</title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <!-- Bootstrap 3.3.6 -->
  <link rel="stylesheet" href="{{ asset("/bower_components/AdminLTE/bootstrap/css/bootstrap.min.css") }}">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.5.0/css/font-awesome.min.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/ionicons/2.0.1/css/ionicons.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="{{ asset("/bower_components/AdminLTE/dist/css/AdminLTE.min.css") }}">
  <!-- DataTables -->
  <link rel="stylesheet" href="{{ asset("/bower_components/AdminLTE/plugins/datatables/dataTables.bootstrap.css") }}">
  <!-- daterange picker -->
  <link rel="stylesheet" href="{{ asset("/bower_components/AdminLTE/plugins/daterangepicker/daterangepicker.css") }}">
  <!-- My Own Styles -->
  <link rel="stylesheet" href="{{ asset("/bower_components/AdminLTE/dist/css/styles.css") }}">
  <!-- Select2 -->
  <link rel="stylesheet" href="{{ asset("/bower_components/AdminLTE/plugins/select2/select2.min.css")}}">

  <link rel="stylesheet" href="{{ asset("/bower_components/AdminLTE/dist/css/skins/skin-blue.min.css") }}">


  <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
  <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
  <!--[if lt IE 9]>
  <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
  <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
  <![endif]-->
</head>
<body class="hold-transition skin-blue fixed sidebar-mini ">
  <div class="wrapper">

    <!-- Main Header -->
    @include('header')

    <!-- Sidebar -->
    <!-- Left side column. contains the logo and sidebar -->
    <aside class="main-sidebar ">

      <!-- sidebar: style can be found in sidebar.less -->
      <section class="sidebar">

        <!-- Sidebar user panel (optional) -->
        <div class="user-panel">
          <div class="pull-left image">
            <img src="{{ asset("/uploads/avatar.png") }}" class="img-circle" alt="User Image">
          </div>

          <div class="pull-left info">
            @if(Session::has('studentName'))
            <p class="username">{{Session::get('studentName')}}</p>
            @elseif(Session::has('lectureId'))
            <p class="username">{{ Session::get('lectureName') }}</p>
            @else
            <p class="username">{{ Session::get('admin') }}</p>
            @endif
            <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
            <!-- Status -->
            <!-- <a href="#"><i class="fa fa-circle text-success"></i> Online</a> -->
          </div>

        </div>

        <!-- search form (Optional) -->
        <form action="#" method="get" class="sidebar-form">
          <div class="input-group">
            <input type="text" name="q" class="form-control" placeholder="Search...">
                <span class="input-group-btn">
                  <button type="submit" name="search" id="search-btn" class="btn btn-flat"><i class="fa fa-search"></i>
                  </button>
                </span>
          </div>
        </form>
        <!-- /.search form -->

        <!-- Sidebar Menu -->
        <ul class="sidebar-menu">
          <li class="header">MAIN NAVIGATION</li>
          <!-- Optionally, you can add icons to the links -->
          @if(Session::has('studentName'))
          <li class="{{ set_active('student-dashboard') }}"><a href="{{ route('student-dashboard') }}"><i class="fa fa-dashboard"></i> <span>Dashboard</span></a></li>
          @elseif(Session::has('lectureId'))
          <li class="{{ set_active('dashboard') }}"><a href="{{ url('dashboard') }}"><i class="fa fa-dashboard"></i> <span>Beranda</span></a></li>
          <li class="{{ set_active('activity') }}"><a href="{{ url('activity') }}"><i class="fa fa-table"></i> <span>Aktifitas</span></a></li>
          @else
          <li class="{{ set_active('admin-dashboard') }}"><a href="{{ route('admin-dashboard') }}"><i class="fa fa-dashboard"></i> <span>Beranda</span></a></li>
          <li class="{{ set_active('paper') }}"><a href="{{ route('paper') }}"><i class="fa fa-file-text-o"></i> <span>Paper</span></a></li>
          <li class="treeview {{ set_active(['activity-lecture', 'activity-student']) }}">
          <a href="#">
            <i class="fa fa-share"></i> <span>Aktifitas</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu menu-open" style="display: block;">
            <li class="{{ set_active('activity-lecture') }}"><a href="{{ route('activity-lecture') }}"><i class="fa fa-table"></i> <span>Dosen</span></a></li>
            <li class="{{ set_active('activity-student') }}"><a href="{{ route('activity-student') }}"><i class="fa fa-book"></i> <span>Mahasiswa</span></a></li>
          </ul>
        </li>


          <li class="{{ set_active('setting') }}"><a href="{{ route('setting') }}"><i class="fa fa-cog"></i> <span>Pengaturan</span></a></li>
          @endif
        </ul>
        <!-- /.sidebar-menu -->
      </section>
      <!-- /.sidebar -->
    </aside>



    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
      <!-- Content Header (Page header) -->
      <section class="content-header">
        <h1>
          @yield('header-content')
          <small>@yield('span-content')</small>
        </h1>
        <ol class="breadcrumb">
          <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
          <li class="active">@yield('breadcrumb')</li>
        </ol>

      <!-- Main content -->
      <section class="content">

        @yield('content')

      </section><!-- /.content -->
    </div><!-- /.content-wrapper -->

    <!-- Main Footer -->
    @include('footer')

  </div><!-- ./wrapper -->

<!-- REQUIRED JS SCRIPTS -->

<!-- jQuery 2.2.3 -->
<script src="{{ asset("/bower_components/AdminLTE/plugins/jQuery/jquery-2.2.3.min.js") }}"></script>
<!-- Bootstrap 3.3.6 -->
<script src="{{ asset("/bower_components/AdminLTE/bootstrap/js/bootstrap.min.js") }}"></script>
<!-- Select2 -->
<script src="{{ asset("/bower_components/AdminLTE/plugins/select2/select2.full.min.js")}}"></script>
<!-- ChartJS 1.0.1 -->
<script src="{{ asset("/bower_components/AdminLTE/plugins/chartjs/Chart.min.js") }}"></script>
<!-- Data Tables -->
<script src="{{ asset("/bower_components/AdminLTE/plugins/datatables/jquery.dataTables.min.js") }}"></script>
<script src="{{ asset("/bower_components/AdminLTE/plugins/datatables/dataTables.bootstrap.min.js") }}"></script>
<!-- date-range-picker -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.11.2/moment.min.js"></script>
<script src="{{ asset("/bower_components/AdminLTE/plugins/daterangepicker/daterangepicker.js") }}"></script>
<!-- SlimScroll -->
<script src="{{ asset("/bower_components/AdminLTE/plugins/slimScroll/jquery.slimscroll.min.js") }}"></script>
<!-- AdminLTE App -->
<script src="{{ asset("/bower_components/AdminLTE/dist/js/app.min.js") }}"></script>



<script>
function changeCat(id){
  document.getElementById("category" + id).innerHTML = '<div class="input-group input-group-sm"><input type="text" class="form-control"  name="category"  placeholder="input category.."><span class="input-group-btn"><button type="submit" class="btn btn-info btn-flat"><i class="fa fa-check"></i></button><button type="button" class="btn btn-info btn-danger" onclick=cancel() ><i class="fa fa-times"></i></button></span></div>';
}

function changeCak(id){
  document.getElementById("cakupan" + id).innerHTML = '<div class="input-group input-group-sm"><input type="text" class="form-control" name="category" placeholder="input cakupan.."><span class="input-group-btn"><button type="submit" class="btn btn-info btn-flat"><i class="fa fa-check"></i></button><button type="button" class="btn btn-info btn-danger"><i class="fa fa-times"></i></button></span></div>';
}

function addCat(count){
  var table = document.getElementById("category-table");
    var row = table.insertRow(count);
    var cell1 = row.insertCell(0);
    var cell2 = row.insertCell(1);
    cell1.innerHTML = '<form action="{{route('add-category')}}" method="post">{{csrf_field()}}<div class="input-group input-group-sm"><input type="text" class="form-control" name="newcategory" placeholder="input new category.."><span class="input-group-btn"><button type="submit" class="btn btn-info btn-flat"><i class="fa fa-check"></i></button><button type="button" class="btn btn-info btn-danger"><i class="fa fa-times"></i></button></span></div></form>';

}

function addCak(count){
  var table = document.getElementById("cakupan-table");
    var row = table.insertRow(count);
    var cell1 = row.insertCell(0);
    var cell2 = row.insertCell(1);
    cell1.innerHTML = '<form action="{{route('add-cakupan')}}" method="post">{{csrf_field()}}<div class="input-group input-group-sm"><input type="text" class="form-control" name="newcakupan" placeholder="input new category.."><span class="input-group-btn"><button type="submit" class="btn btn-info btn-flat"><i class="fa fa-check"></i></button><button type="button" class="btn btn-info btn-danger"><i class="fa fa-times"></i></button></span></div></form>';
}

function cancel(){
  location.reload();
}


</script>

<script>
  $(".select2").select2();
</script>
<script>
  $(function () {
    $("#example1").DataTable();
    $('#example2').DataTable({
      "paging": true,
      "lengthChange": false,
      "searching": false,
      "ordering": true,
      "info": true,
      "autoWidth": false
    });
  });
</script>

<script>
//Date range picker
$('#reservation').daterangepicker({
  locale: {
    format: 'YYYY-MM-DD'
  }
});
</script>
<script>
jQuery(document).ready(function($) {
    $(".select-row").click(function() {
        window.document.location = $(this).data("href");
    });
});
</script>
<!-- export spesific data -->
<script>
$(':radio').change(function (event) {
    var id = $(this).data('id');
    $('#' + id).addClass('none').siblings().removeClass('none');
});
</script>

<!--close export modal-->




</body>
</html>
