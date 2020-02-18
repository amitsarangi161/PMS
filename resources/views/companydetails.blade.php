@extends('layouts.app')
@section('content')
@php
if($compdetails){
$name=$compdetails->companyname;
$id=$compdetails->id;
$phone=$compdetails->phone;
$mobile=$compdetails->mobile;
$fax=$compdetails->fax;
$websitelink=$compdetails->websitelink;
$email=$compdetails->email;
$gst=$compdetails->gst;
$pan=$compdetails->pan;
$address=$compdetails->address;
$logo=$compdetails->logo;
$value="Update Details";
}
else{
$name='';
$id='';
$phone='';
$mobile='';
$fax='';
$websitelink='';
$email='';
$gst='';
$pan='';
$address='';
$logo='';
$value="Save Details";
}

@endphp
<div class="row">
        <div class="col-md-12">
          <div class="box box-success">
            <div class="box-header with-border">
              <h3 class="box-title">Company Details</h3>
            </div>
            <form method="post" action="/companysetup" enctype="multipart/form-data">
            	{{csrf_field()}}
              <div class="box-body">
                <div class="form-group col-md-6">
                  <label>Company Name</label>
                  <input type="text" class="form-control" palceholder="Comapny Name" required="" value="{{$name}}"name="name">
                </div>
                <div class="form-group col-md-6">
                  <label>Website</label>
                  <input type="text" class="form-control" palceholder="Website link" required="" value="{{$websitelink}}"name="website">
                </div>
                <div class="form-group col-md-6">
                  <label>Mobile No</label>
                  <input type="text" class="form-control" palceholder="mobile number" required="" value="{{$mobile}}"name="mobile">
                </div>
                <div class="form-group col-md-6">
                  <label>Phone No</label>
                  <input type="text" class="form-control" palceholder="phone number" required="" value="{{$phone}}"name="phone">
                </div>
                <div class="form-group col-md-6">
                  <label>Email</label>
                  <input type="email" class="form-control" palceholder="enter your email" required="" value="{{$email}}"name="email">
                </div>
                <div class="form-group col-md-6">
                  <label>Fax No</label>
                  <input type="text" class="form-control" palceholder="fax number" required="" value="{{$fax}}"name="fax">
                </div>
                <div class="form-group col-md-6">
                  <label>Pan</label>
                  <input type="text" class="form-control" palceholder="pan number" required="" value="{{$pan}}"name="pan">
                </div>
                <div class="form-group col-md-6">
                  <label>GST No</label>
                  <input type="text" class="form-control" palceholder="gst number" required="" value="{{$gst}}"name="gst">
                </div>
                <div class="form-group col-md-6">
                  <label>Address</label>
                  <textarea class="form-control" name="address" placeholder="Address" rows="3">{{$address}}</textarea>
                </div>
                <div class="form-group col-md-4">
                  <label>Logo</label>
                  <input type="file" required="" value="{{$name}}"name="logo" onchange="readURL(this);">
                </div>
                <div class="form-group col-md-2">
                  <img src="/img/company/{{$logo}}" id="imgshow" class="img-responsive">
                </div>
                <input type="hidden"  name="id"  value="{{$id}}">
                <div class="row">
	                <div class="form-group col-md-12">
	                	<button type="submit" class="btn btn-success btn-flat pull-right">{{$value}}</button>
	                </div>
            	</div>
            </div>
        </form>
    </div>
</div>
<script>
	 function readURL(input) {
    

       if (input.files && input.files[0]) {
            var reader = new FileReader();
              
            reader.onload = function (e) {
                $('#imgshow')
                    .attr('src', e.target.result)
            };

            reader.readAsDataURL(input.files[0]);

        }
    }
</script>
@endsection