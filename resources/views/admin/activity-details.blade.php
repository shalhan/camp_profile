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
         <div class="box-box-tools pull-right">
           <div class="add">
             <a href="" data-toggle="tooltip" title="Compress" ><i class="fa fa-compress"></i></a>
             <a href="" data-toggle="tooltip" title="Download All" ><i class="fa fa-download"></i></a>
             <a href="" data-toggle="modal" data-target=".upload" ><i class="fa fa-plus"></i></a>
           </div>
         </div>
       </div>
       <!-- /.box-header -->
       <div class="box-body">
        <table id="example1" class="table table-bordered table-hover">
          @if(Session::has('noCompressFile'))
          <div class="callout callout-danger">
              <p>{{Session::get('noCompressFile')}}</p>
            </div>
          @elseif(Session::has('successCompress'))
          <div class="callout callout-success">
              <p>{{Session::get('successCompress')}}</p>
            </div>
          @elseif(Session::has('emptyFile'))
          <div class="callout callout-danger">
              <p>{{Session::get('emptyFile')}}</p>
            </div>
            @elseif(Session::has('updateCompressFile'))
            <div class="callout callout-warning">
                <p>{{Session::get('updateCompressFile')}}</p>
              </div>
          @endif
          <thead>
             <tr>
               <th></th>
               <th>Nama</th>
               <th>Ukuran file</th>
             </tr>
           </thead>
           <tbody>
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
             <td>{{number_format($row->size / 1000, 1)}} kB</td>
             <!-- <td class="action-icon">
               <a href="" ><i class="fa fa-download gray"></i></a>
               <a href="" data-toggle="modal" data-target=".rename"><i class="fa fa-pencil gray"></i></a>
               <a href="" ><i class="fa fa-trash gray"></i></a>

             </td> -->
             <!-- <td><a href="{{ url('student-activity-details/delete-file/'. $row->id_files) }}" ><i class="fa fa-trash"></i></a></td> -->
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
             <p>:&nbsp;{{ ucwords($view->nama_cak) }}</p>
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
