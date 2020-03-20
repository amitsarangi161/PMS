@extends('layouts.inventory')

@section('content')

@if(Session::has('msg'))
   <p class="alert alert-success text-center">{{ Session::get('msg') }}</p>
 @endif
 @if(Session::has('duplicateitem'))
   <p class="alert alert-danger text-center">{{ Session::get('duplicateitem') }}</p>
 @endif
<table class="table table-responsive table-hover table-bordered table-striped">
	 <tr class="bg-navy">
	 	<td class="text-center">STOCK ENTRY</td>
	 </tr>
</table>

<div class="well" >
<form action="/savestock" method="post" enctype="multipart/form-data">
	{{csrf_field()}}

	<table class="table table-responsive table-hover table-bordered table-striped">
	 <tr>
	 	<td width="20%"><strong>Choose a Product<span style="color: red"> *</span></strong></td>
	 	<td width="80%">
	 		<select name="product_id" class="form-control select2" style="width:100%;" required="">
	 	 		<option value="">Select a catagory</option>
	 	 		@foreach($products as $product)
	 	 		<option value="{{$product->id}}">{{$product->productname}}</option>
	 	 		@endforeach
	 	 	</select>
	 	</td>
	 </tr>
	 <tr>
	 	<td width="20%"><strong>Date<span style="color: red"> *</span></strong></td>
	 	<td width="80%">
	 		<input type="text" name="date" class="form-control datepicker" placeholder="Date" readonly="" required="">
	 	</td>
	 	
	 </tr>
	 <tr>
	 	<td width="20%"><strong>Unit Price<span style="color: red"> *</span></strong></td>
	 	<td width="80%">
	 		<input type="text" class="form-control" placeholder="Unit Price" name="unitrate" required="">
	 	</td>
	 	
	 </tr>
	 <tr>
	 	<td width="20%"><strong>Quantity<span style="color: red"> *</span></strong></td>
	 	<td width="80%">
	 		<input type="text" class="form-control" placeholder="Enter quantity" name="quantity" required="">
	 	</td>
	 	
	 </tr>
	 <tr>
	 	<td colspan="2" style="text-align: right;"><button type="submit" class="btn btn-success">ADD STOCK</button></td>
	 </tr>
</table>
</form>
</div>

<div class="table-responsive">
	<table class="table table-hover table-bordered table-striped datatable">
       <thead class="bg-navy">
       	   <tr>
       	   	<th>ID</th>
       	   	<th>PRODUCT NAME</th>
       	   	<th>DATE</th>
       	   	<th>UNIT RATE</th>
       	   	<th>QUANTITY</th>
       	   	<th>EDIT</th>
       	   <!-- 	<th>DELETE</th> -->
       	   </tr>
       </thead>
       <tbody>
       	
     	@foreach($stocks as $stock)
       	<tr>
       		<td>{{$stock->id}}</td>
       		<td>{{$stock->productname}}</td>
       		<td>{{$stock->date}}</td>
       		<td>{{$stock->unitrate}}</td>
       		<td>{{$stock->quantity}}</td>
       		<td>
       		<button type="button" class="btn btn-primary" onclick="editstock('{{$stock->id}}','{{$stock->date}}','{{$stock->unitrate}}','{{$stock->quantity}}','{{$stock->product_id}}')">EDIT</button>
       		</td>
       		
       	</tr>
       		@endforeach
       
       	
       
       </tbody>
	</table>
</div>

	<div id="myModal" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">EDIT STOCKS</h4>
      </div>
      <div class="modal-body">
      	<form action="/updatestock" method="post" enctype="multipart/form-data">
      		{{csrf_field()}}
        <table class="table table-responsive table-hover table-bordered table-striped">
        <input type="hidden" name="pid" id="pid">
      <tr>
	 	 <td><strong>Choose a Product<span style="color: red"> *</span></strong></td>
	 	 <td>
	 	 	<select name="product_id" class="form-control" id="product_id">
	 	 		<option>Select a catagory</option>
	 	 		@foreach($products as $product)
	 	 		<option value="{{$product->id}}">{{$product->productname}}</option>
	 	 		@endforeach
	 	 	</select>
	 	 </td>
	 
	 	
	 </tr>
	 <tr>
	 	<td><strong>Date<span style="color: red"> *</span></strong></td>
	 	<td>
	 		<input type="text" class="form-control datepicker" id="date" placeholder="Enter Date" name="date" required>
	 	</td>
	 	
	 </tr>
	 <tr>
	 	<td><strong>Unit Rate<span style="color: red"> *</span></strong></td>
 		<td>
 			<input type="text" class="form-control" id="unitrate" placeholder="Enter unitrate" name="unitrate" required>
 		</td>
	 	
	 </tr>
	 <tr>
	 	<td><strong>Quantity<span style="color: red"> *</span></strong></td>
 		<td>
 			<input type="text" class="form-control" id="quantity" placeholder="Enter quantity" name="quantity" required>
 		</td>
	 	
	 </tr>
	 <tr>
	 	<td colspan="2" style="text-align: right;"><button type="submit" class="btn btn-success">UPDATE STOCKS</button></td>
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

	<script type="text/javascript">
$('.alert').delay(10000).fadeOut(1000);
		function editstock(id,date,unitrate,quantity,product_id) {
			$("#pid").val(id);
			$("#date").val(date);
			$("#unitrate").val(unitrate);
			$("#product_id").val(product_id);
			$("#quantity").val(quantity);
			$("#myModal").modal('show');

			
		}
		function readURL1(input) {
    	if (input.files && input.files[0]) {
        var reader = new FileReader();

        reader.onload = function (e) {
            $('#imgshow1').attr('src', e.target.result);
        }

        reader.readAsDataURL(input.files[0]);
    }
}
	</script>


@endsection