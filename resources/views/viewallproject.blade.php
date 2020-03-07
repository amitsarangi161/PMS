@extends('layouts.app')
@section('content')

<style type="text/css">
    .b {
    white-space: nowrap; 
    width: 120px; 
    overflow: hidden;
    text-overflow: ellipsis; 
   
}
</style>
@if(Session::has('message'))
<p class="alert alert-success">{{ Session::get('message') }}</p>
@endif
@if(Session::has('error'))
<p class="alert alert-danger">{{ Session::get('error') }}</p>
@endif
@if(count($errors) > 0)
    <div class="alert alert-danger">
     Upload Validation Error<br><br>
     <ul>
      @foreach($errors->all() as $error)
      <li>{{ $error }}</li>
      @endforeach
     </ul>
    </div>
@endif
<h3 class="text-center"><strong>ALL PROJECTS</strong></h3>
<div class="box">
  <div class="box-header">
    <div class="row">
        <p>
          <a href="/projects/addproject" class="btn btn-success btn-flat margin"><i class="fa fa-plus"></i> Add Project
          </a>
            <span class="pull-right"><button type="submit" class="btn bg-navy btn-flat margin" data-toggle="modal" data-target="#importproject" onclick="importproject();"><i class="fa fa-file-excel-o"></i> Import Project</button>
                <a href="/Project Import Sample.xlsx" download="/Project Import Sample.xlsx" class="btn bg-orange btn-flat margin"><i class="fa fa-download"></i> Sample</a>
          </span>
          
        </p>
    </div>
  </div>
<div class="box-body">
    <div style="overflow-x:auto;">
<table class="table table-responsive table-hover table-bordered table-striped datatable">
    <thead>
        <tr class="bg-navy" style="font-size: 10px;">
            <th>ID</th>
            <th>FOR CLIENT</th>
            <th>CLIENT NAME</th>
            <th>PROJECT NAME</th>
            <th>DATE OF COMMENCEMENT</th>
            <th>END DATE</th>
            <th>ESTIMATED COST</th>
            <th>PRIORITY</th>
            <th>STATUS</th>
            <th>DAY REMAIN FROM TODAY</th>
            <th>VIEW</th>
            <th>EDIT</th>
            <!-- <th>DELETE</th> -->
        </tr>
    </thead>
    <tbody>
        @foreach($projects as $project)
           @php
               $date = Carbon\Carbon::parse($project->enddate. '11:59:59');
               $now = Carbon\Carbon::now();

               $diff = $date->diffInDays($now);
               if($project->status=='COMPLETED')
               {
               	   $txtcolor='label bg-green';
                $rowcolor='#0cd50c';
               }
               elseif($diff<=5 && $project->status!='COMPLETED')
               {
                $txtcolor='label bg-red';
                $rowcolor='#f9191999';
               }
               else
               {
               	  $txtcolor='label bg-blue';
               	  $rowcolor='#fff';
               }

            @endphp
        <tr style="background-color: {{$rowcolor}};font-size: 12px;">
            <td>{{$project->id}}</td>
            <td>{{$project->clientname}}</td>
            <td>{{$project->clientname}}</td>
            <td><p class="b" title="{{$project->projectname}}">{{$project->projectname}}</p></td>
            <td>{{$project->startdate}}</td>
            <td>{{$project->enddate}}</td>
            <td>{{$project->cost}}</td>
            <td>{{$project->priority}}</td>
            @if($project->status!='COMPLETED')
            <td><span class="label label-success" ondblclick="changestatus('{{$project->id}}','{{$project->projectname}}');" title="Double click to change the status">{{$project->status}}</span></td>
            @else
            <td><span class="label label-danger" ondblclick="changestatus('{{$project->id}}','{{$project->projectname}}');" title="Double click to change the status">{{$project->status}}</span></td>

            @endif

             @if($date<$now)
            <td><small class="{{$txtcolor}}">-{{$diff}}</small></td>
            @else
              <td><small class="{{$txtcolor}}">{{$diff}}</small></td>

            @endif

            <td>
             <a href="/projects/adminprojectdetails/{{$project->id}}" class="btn btn-primary">VIEW DETAILS</a>
           </td>
           
            <td><a href="/projects/editproject/{{$project->id}}" class="btn btn-primary">EDIT</a></td>
        </tr>

        @endforeach
    </tbody>
</table>
</div>
</div>
</div>


<div id="myModal" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">CHANGE STATUS</h4>
      </div>
      <div class="modal-body">
        <form action="/changestatus" method="post">
          {{csrf_field()}}
       <table class="table table-responsive table-hover table-bordered table-striped">
        <input type="hidden" name="pid" id="pid">
        <tr>
          <td>PROJECT NAME</td>
          <td><input type="text" readonly="" id='pname' class="form-control"></td>
        </tr>
        <tr>
          <td>STATUS</td>
          <td>
            <select name="status" class="form-control">
              <option value="STARTED">STARTED</option>
              <option value="ON PROGRESS">ON PROGRESS</option>
              <option value="HALTED">HALTED</option>
              <option value="COMPLETED">COMPLETED</option>
              
            </select>
          </td>
        </tr>
        <tr>
          <td><button type="submit" class="btn btn-primary">CHANGE</button></td>
        </tr>
        
       </table>   

        </form>
       
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
    </div>

  </div>
</div>
<div class="modal fade in" id="importproject">
  <div class="modal-dialog modal-sm">
    <div class="modal-content">
        <form method="post" enctype="multipart/form-data" action="/importproject">
      <div class="modal-header bg-navy">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true" style="color: #fff;">×</span>
      </button>
        <h4 class="modal-title text-center">Upload Project Excel</h4>
      </div>
      <div class="modal-body">
        
              
                {{ csrf_field() }}
                <div class="form-group">
                <label>Select File for Upload Project</label>
                    <input type="file" name="select_file" />
                    <span class="text-muted">.xls, .xslx</span>
                </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default btn-flat pull-left" data-dismiss="modal">Close</button>
        <button type="submit" class="btn btn-success btn-flat">Upload</button>
      </div>
        </form>
    </div>
  </div>
</div>
<script type="text/javascript">
	function changestatus(id,pname)
	{
		$("#pname").val(pname);
		$("#pid").val(id);
        $("#myModal").modal('show');
	}

    function importproject(){
        alert("Do You Want To Upload Project Excel");
    }
  $(".alert-success").delay(5000).fadeOut(800); 
    $(".alert-danger").delay(5000).fadeOut(800);
</script>
@endsection
