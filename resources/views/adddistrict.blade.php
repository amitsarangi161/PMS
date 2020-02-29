@extends('layouts.app')

@section('content')

@if(Session::has('msg'))
   <p class="alert alert-success text-center">{{ Session::get('msg') }}</p>
 @endif
<table class="table table-responsive table-hover table-bordered table-striped">
	 <tr class="bg-navy">
	 	<td class="text-center">ADD DISTRICT</td>
	 </tr>
</table>


<div class="well" >
<form action="/savedistrict" method="post">
	{{csrf_field()}}

	<table class="table table-responsive table-hover table-bordered table-striped">
	 <tr>
	 	 <td><strong>DISTRICT NAME<span style="color: red"> *</span></strong></td>
	 	 <td><input type="text" autocomplete="off" name="districtname" placeholder="Enter District Name" class="form-control" required></td>
	 
	 	
	 </tr>
	 <tr>
	 	<td colspan="2" style="text-align: right;"><button type="submit" class="btn btn-success">Save</button></td>
	 </tr>
</table>
</form>
</div>

<div class="table-responsive">
	<table class="table  table-hover table-bordered table-striped datatable">
       <thead class="bg-navy">
       	   <tr>
       	   	<th>ID</th>
       	   	<th>DISTRICT NAME</th>
       	   </tr>
       </thead>
       <tbody>
       	@foreach($districts as $district)

       	<tr>
       		<td>{{$district->id}}</td>
       		<td>{{$district->districtname}}</td>
       	</tr>
       	@endforeach
       </tbody>
	</table>
</div>

@endsection