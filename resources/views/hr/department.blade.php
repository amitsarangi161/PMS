@extends('layouts.hr')
@section('content')

<div class="box">
		<div class="box-header">
			<button type="button" class="btn  btn-success btn-flat" data-toggle="modal" data-target="#modal-default"><i class="fa fa-plus"></i> Department</button>

		</div>
	    <div class="box-body">
	    	<table class="table table-bordered table-striped datatable">
			  <thead>
			    <tr class="bg-navy">
			      <td>Sl. No</td>
			      <td>Department Name</td>
			      <td>Designations</td>
			      <td>Action</td>
			    </tr>
			  </thead>
			  <tbody>
			  	@foreach($all as $key=>$value)
			  	<tr>
			  		<td>{{++$key}}</td>
			  		<td>{{$value['department']['departmentname']}}</td>
			  		<td>
			  			<ol>
			  			@foreach($value['designation'] as $des)
			  			<li>
			  			{{$des['designationname']}}
			  			</li>
			  			@endforeach
			  		</ol>
			  		</td>
			  		<td><button class="btn btn-primary btn-flat">Edit</button></td>
			  	</tr>
			  	@endforeach
			  </tbody>
			</table>
	</div>

</div>

<div class="modal fade in" id="modal-default">
  <div class="modal-dialog">
    <div class="modal-content">
    	<form method="post" action="/adddepartment">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">×</span>
      </button>
        <h4 class="modal-title">New Department</h4>
      </div>
      <div class="modal-body">
      	
      		{{csrf_field()}}
            <div class="form-group">
                <div>
                    <label class="control-label">Department</label>
                    <input class="form-control" name="departmentname" type="text"placeholder="Enter Department Name">
                </div>
            </div>

            <div class="form-group">
                <div>
                    <label class="control-label">Designations</label>
                    <input class="form-control" name="designationname[]" type="text" value="" placeholder="Designation #1" style="width: 60%;">
                </div>
            </div>
            <div id="insertBefore"></div>
            <div class="form-group">
                <button type="button" id="plusButton" onclick="addMore();" class="btn btn-sm btn-info btn-flat">
                    Add Designation <i class="fa fa-plus"></i>
                </button>
            </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default btn-flat pull-left" data-dismiss="modal">Close</button>
        <button type="submit" class="btn btn-success btn-flat">Submit</button>
      </div>
      	</form>
    </div>
  </div>
</div>

<script>
	var count=1;
	function addMore(){
		++count;
		$("#insertBefore").append('<input class="form-control input-medium designation" name="designationname[]" style="width: 60%;margin-bottom:10px;" type="text" value="" placeholder="Designation #'+count+'" id="row'+count+'">');
	}


</script>
@endsection