@extends('layouts.hr')
@section('content')

<div class="row">
	<p>
		<a href="#" class="btn btn-success btn-flat margin"><i class="fa fa-plus"></i> Add Employee</a>

		<button type="submit" class="btn bg-navy btn-flat margin pull-right" data-toggle="modal" data-target="#importemployee" onclick="importemployee();"><i class="fa fa-file-excel-o"></i> Import Employee</button>
	</p>
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
<script type="text/javascript">
	function importemployee(){
		alert("Do You Want To Upload Employee Excel");
	}
</script>
@endsection