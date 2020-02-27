@extends('layouts.hr')
@section('content')

<div class="box">
  <div class="box-header">
    <div class="row">
        <p>
          <a href="/registeremployee" class="btn btn-success btn-flat margin"><i class="fa fa-plus"></i> Add New Employee
          </a>
            <span class="pull-right"><button type="submit" class="btn bg-navy btn-flat margin" data-toggle="modal" data-target="#importemployee" onclick="importemployee();"><i class="fa fa-file-excel-o"></i> Import Employee Database</button>
                <a href="/Employee Import Sample.xlsx" download="/Employee Import Sample.xlsx" class="btn bg-orange btn-flat margin"><i class="fa fa-download"></i> Sample</a>
          </span>
          
        </p>
    </div>
  </div>
@if(Session::has('message'))
<p class="alert alert-success">{{ Session::get('message') }}</p>
@endif
@if(Session::has('error'))
<p class="alert alert-danger">{{ Session::get('error') }}</p>
@endif
@if(count($errors) > 0)
    <div class="alert alert-danger">
     Upload A Valid Excel File<br><br>
     <ul>
      @foreach($errors->all() as $error)
      <li>{{ $error }}</li>
      @endforeach
     </ul>
    </div>
@endif
      <div class="box-body table-responsive">

        <table class="table table-bordered table-striped datatable1">
        <thead>
          <tr class="bg-navy">
            <td>Emp. Id</td>
            <td>Employee Name</td>
            <td>Blood Group</td>
            <td>Mobile No</td>
            <td>Alternate Mobile No</td>
            <td>Email</td>
            <td>Address</td>
            <td>Status</td>
            <td>Action</td>
          </tr>
        </thead>
        <tbody>
          @foreach($employeedetails as $key=>$employeedetail)
          <tr>
            <td><button class="btn btn-success btn-sm btn-flat">{{$employeedetail->id}}</button></td>
            <td>{{$employeedetail->employeename}}</td>
            <td>{{$employeedetail->bloodgroup}}</td>
            <td>{{$employeedetail->phone}}</td>
            <td>{{$employeedetail->alternativephonenumber}}</td>
            <td>{{$employeedetail->email}}</td>
            <td>{{$employeedetail->presentaddress}}</td>
            <td><button class="btn btn-success btn-flat" onclick="employeestatus('{{$employeedetail->id}}');">ACTIVE</button></td>
            <td><a href="/editemployeedetails/{{$employeedetail->id}}" onclick="return confirm('are you sure to edit employee ??')" ><button class="btn btn-primary btn-flat">Edit</button></a></td>
          </tr>
          @endforeach
        </tbody>
      </table>
  </div>

</div>

<div class="modal fade in" id="importemployee">
  <div class="modal-dialog modal-sm">
    <div class="modal-content">
    	<form method="post" enctype="multipart/form-data" action="/importemployee">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">×</span>
      </button>
        <h4 class="modal-title text-center">Upload Employee Excel</h4>
      </div>
      <div class="modal-body">
      	
			  
			    {{ csrf_field() }}
			    <div class="form-group">
				<label>Select File for Upload Employee</label>
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

<div class="modal fade in" id="employeestatus">
  <div class="modal-dialog modal-sm">
    <div class="modal-content">
      <form method="post" enctype="multipart/form-data" action="/employeestatus">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">×</span>
      </button>
        <h4 class="modal-title text-center">Change  Status</h4>
      </div>
      <div class="modal-body">
          {{ csrf_field() }}
          <input type="text" name="empid" id="id">
          <div class="form-group">
            <label>Change  Status</label>
            <select class="form-control" name="active">
              <option value="PRESENT">PRESENT</option>
              <option value="RESIGN">RESIGN</option>
              <option value="TERMINATED">TERMINATED </option>
              <option value="LEFT WITHOUT INFORMATION">LEFT WITHOUT INFORMATION</option>
            </select>
          </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default btn-flat pull-left" data-dismiss="modal">Close</button>
        <button type="submit" class="btn btn-success btn-flat">Change Status</button>
      </div>
        </form>
    </div>
  </div>
</div>
<script type="text/javascript">
	function importemployee(){
		alert("Do You Want To Upload Employee Excel"); 
	}
  $(".alert-success").delay(5000).fadeOut(800); 
    $(".alert-danger").delay(15000).fadeOut(800);

  function employeestatus(userid){
    $("#employeestatus").modal('show');
    $("#id").val(userid);
  }
</script>
@endsection