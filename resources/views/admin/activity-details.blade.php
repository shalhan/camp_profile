@extends('master')

@section('header-content')
 Aktivitas
@endsection

@section('span-content')
 Detail
@endsection

@section('breadcrumb')
 Aktivitas
@endsection

@section('content')
<div class="row">
 <div class="col-md-8">
     <div class="box">
       <div class="box-header">
         <h3 class="box-title">File</h3>
       </div>
       <!-- /.box-header -->
       <div class="box-body no-padding">
         <table class="table table-striped">
           <tr>
             <th></th>
             <th>Nama</th>
             <th></th>
             <th style="width: 40px"></th>
           </tr>
           @foreach($file as $row)
           <tr>
             @if($row->ext == "csv")
             <td class="ext"><img src="{{ asset('/assets/img/icons/csv.png') }}"</td>
             @elseif($row->ext == "pdf")
             <td class="ext"><img src="{{ asset('/assets/img/icons/pdf.png') }}"</td>
             @elseif($row->ext == "doc" || $row->ext == "docx")
             <td class="ext"><img src="{{ asset('/assets/img/icons/doc.png') }}"</td>
             @elseif($row->ext == "png")
             <td class="ext"><img src="{{ asset('/assets/img/icons/png.png') }}"</td>
             @elseif($row->ext == "jpg" || $row->ext == "jpeg")
             <td class="ext"><img src="{{ asset('/assets/img/icons/jpg.png') }}"</td>
             @else
             <td class="ext"><img src="{{ asset('/assets/img/icons/file.png') }}"</td>
             @endif

             <td>{{$row->file}}</td>
             <td></td>
             <td><a href="{{ url('student-activity-details/delete-file/'. $row->id_files) }}" ><i class="fa fa-trash"></i></a></td>
           </tr>
           @endforeach
       </tbody>
     </table>
   </div>
 </div>
</div>
 <div class="col-md-4">
   <div class="box">

     <div class="box-header with-border">
       <h3 class="box-title">{{ ucwords($view->nama_kegiatan) }}</h3>
     </div>
     <div class="box-body">
       <div class="detail">
         <div class="row">
           <div class="col-sm-5">
             <p class="category">Category &nbsp;</p>
           </div>
           <div class="col-sm-7">
             <p>:&nbsp;{{ ucwords($view->nama_cat) }}</p>
           </div>
           <div class="col-sm-5">
             <p class="cakupan">Cakupan &nbsp;</p>
           </div>
           <div class="col-sm-7">
             <p>:&nbsp;{{ ucwords($view->nama) }}</p>
           </div>
           <div class="col-sm-5">
             <p class="cakupan">Mulai &nbsp;</p>
           </div>
           <div class="col-sm-7">
             <p>:&nbsp;{{ $view->tgl_mulai }}</p>
           </div>
           <div class="col-sm-5">
             <p class="cakupan">Selesai &nbsp;</p>
           </div>
           <div class="col-sm-7">
             <p>:&nbsp;{{ $view->tgl_selesai }}</p>
           </div>
           <div class="col-sm-5">
             <p class="cakupan">Sumber Dana &nbsp;</p>
           </div>
           <div class="col-sm-7">
             <p>:&nbsp;{{ ucwords($view->sumber_dana) }}</p>
           </div>
           <div class="col-sm-5">
             <p class="cakupan">Pencapaian &nbsp;</p>
           </div>
           <div class="col-sm-7">
             <p>:&nbsp;{{ ucwords($view->pencapaian) }}</p>
           </div>
         </div><hr>
         <div class="deskripsi"><p>{{ ucfirst($view->deskripsi) }}</p></div>
       </div>
     </div>
   </div>
</div>
@endsection
