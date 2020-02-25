@extends('layouts.account')
@section('content')
   @if(Session::has('msg'))
   <p class="alert alert-success text-center">{{ Session::get('msg') }}</p>
   @endif
   @if(Session::has('status'))
   <p class="alert alert-success text-center">{{ Session::get('status') }}</p>
   @endif
   @if(Session::has('error'))
    <p class="alert alert-danger text-center">{{ Session::get('error') }}</p>
   @endif

   @if ($errors->any())
          <div class="alert alert-danger">
              <ul>
                  @foreach ($errors->all() as $error)
                      <li>{{ $error }}</li>
                  @endforeach
              </ul>
          </div><br />
      @endif
<div class="box">
   <div class="box-header">
    <div class="row">
        <p>
            <span class="pull-right"><button type="submit" class="btn bg-navy btn-flat margin" data-toggle="modal" data-target="#importvendor" onclick="importvendor();"><i class="fa fa-file-excel-o"></i> Import Vendor</button>
                <a href="/VendorImportSample.xlsx" download="/vendorsample.xlsx" class="btn bg-orange btn-flat margin"><i class="fa fa-download"></i> Sample</a>
          </span>
          
        </p>
    </div>
  </div>
<div class="box-body">
<div class="table-responsive">
<table class="table  table-hover table-bordered table-striped datatable">
       <thead class="bg-navy">
       	   <tr>
       	   	<th>ID</th>
       	   	<th>VENDOR NAME</th>
       	   	<th>MOBILE</th>
       	   	<th>DETAILS</th>
            <th>GSTN</th>
            <th>PAN Number</th>
            <th>Service Tax Number</th>
       	   	<th>EDIT</th>
       	   <!-- 	<th>DELETE</th> -->
       	   </tr>
       </thead>
       <tbody>
       	@foreach($vendors as $vendor)
           <tr>
           	<td>{{$vendor->id}}</td>
           	<td>{{$vendor->vendorname}}</td>
           	<td>{{$vendor->mobile}}</td>
           	<td>{{$vendor->details}}</td>
            <td>{{$vendor->gstno}}</td>
            <td>{{$vendor->panno}}</td>
            <td>{{$vendor->servicetaxno}}</td>
           	<!-- <td>
              <a href="{{ asset('/img/vendor/'.$vendor->vendoridproof )}}" target="_blank">
              <img style="height:70px;width:95px;" alt="click to view the file" src="{{ asset('/img/vendor/'.$vendor->vendoridproof )}}">
              </a>
            </td> -->
           <!-- 	<td>
               <a href="{{ asset('/img/vendor/'.$vendor->photo )}}" target="_blank">
              <img style="height:70px;width:95px;" alt="click to view the file" src="{{ asset('/img/vendor/'.$vendor->photo )}}">
              </a>
            </td> -->
           	<td><a href="/editvendor/{{$vendor->id}}" class="btn btn-primary">EDIT</a></td>
           </tr>
       	@endforeach
       
       </tbody>
	</table>
</div>
</div>

<div class="modal fade in" id="importvendor">
  <div class="modal-dialog modal-sm">
    <div class="modal-content">
      <form method="post" enctype="multipart/form-data" action="/importvendor">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">×</span>
      </button>
        <h4 class="modal-title text-center">Upload Vendor Excel</h4>
      </div>
      <div class="modal-body">
        
        
          {{ csrf_field() }}
          <div class="form-group">
        <label>Select File for Upload Vendor</label>
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
    function importvendor(){
    alert("Do You Want To Upload Vendor Excel"); 
  }
</script>
@endsection