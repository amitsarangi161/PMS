@extends('layouts.hr')
@section('content')

<div class="row">
  @if(Session::has('message'))
  <div class="alert alert-success"><span class="glyphicon glyphicon-ok"></span> {!! session('message') !!}</div>
  @endif
	<div class="col-md-6">
          <!-- Horizontal Form -->
          <form action="/updateemployeedetails/{{$editemployeedetail->id}}" method="post" enctype="multipart/form-data" class="form-horizontal">
          {{csrf_field()}}
          <div class="box box-info">
            <div class="box-header with-border">
              <h3 class="box-title">Employee Details</h3>
            </div>
            <!-- /.box-header -->
            <!-- form start -->
              <div class="box-body">
                <div class="form-group">
                  <label for="inputEmail3" class="col-sm-2 control-label">Employee Name</label>

                  <div class="col-sm-10">
                    <input type="text" name="employeename"class="form-control" value="{{$editemployeedetail->employeename}}" id="inputEmail3" placeholder="Employee Name">
                  </div>
                </div>
                <div class="form-group">
                  <label for="inputEmail3" class="col-sm-2 control-label">DOB</label>

                  <div class="col-sm-10">
                    <input type="text" value="{{$editemployeedetail->dob}}" name="dob" class="form-control datepicker" placeholder="Date of Birth">
                  </div>
                </div>
                <div class="form-group">
                  <label for="inputEmail3" class="col-sm-2 control-label">Email</label>
                  <div class="col-sm-10">
                    <input type="email" value="{{$editemployeedetail->email}}" name="email"class="form-control" id="inputEmail3" placeholder="Email">
                  </div>
                </div>
                <div class="form-group">
                  <label for="inputEmail3" class="col-sm-2 control-label">Gender</label>

                  <div class="col-sm-10">
                    <label class="radio-inline">
                      <input type="radio" name="gender" value="male" {{ $editemployeedetail->gender == 'male' ? 'checked' : '' }}>Male
                    </label>
                    <label class="radio-inline">
                       <input type="radio" value="female" name="gender" {{ $editemployeedetail->gender == 'female' ? 'checked' : '' }}>Female
                    </label>
                    <label class="radio-inline">
                       <input type="radio" value="other" name="gender" {{ $editemployeedetail->gender == 'other' ? 'checked' : '' }}>Other
                    </label>
                  </div>
                </div>

                <div class="form-group">
                  <label for="inputEmail3" class="col-sm-2 control-label">Phone No.</label>

                  <div class="col-sm-10">
                    <input type="text" value="{{$editemployeedetail->phone}}" name="phone"class="form-control" id="inputEmail3" placeholder="Phone Number">
                  </div>
                </div>

                <div class="form-group">
                  <label for="inputEmail3" class="col-sm-2 control-label">Adhar No.</label>

                  <div class="col-sm-10">
                    <input type="text" value="{{$editemployeedetail->adharno}}" name="adharno"class="form-control" id="inputEmail3" placeholder="Adhar Number">
                  </div>
                </div>

                <div class="form-group">
                  <label for="inputEmail3" class="col-sm-2 control-label">Blood Group</label>

                  <div class="col-sm-10">
                    <input type="text" value="{{$editemployeedetail->bloodgroup}}" name="bloodgroup"class="form-control" id="inputEmail3" placeholder="Blood Group">
                  </div>
                </div>

                <div class="form-group">
                  <label for="inputEmail3" class="col-sm-2 control-label">Alternative No.</label>

                  <div class="col-sm-10">
                    <input type="text" value="{{$editemployeedetail->alternativephonenumber}}" name="alternativephonenumber"class="form-control" id="inputEmail3" placeholder="Alternative Phone Number">
                  </div>
                </div>

                <div class="form-group">
                  <label for="inputEmail3" class="col-sm-2 control-label">Present Address</label>

                  <div class="col-sm-10">
                    <textarea class="form-control" id="presentaddress" name="presentaddress" autocomplete="off" type="text" placeholder="Present Address">{{$editemployeedetail->presentaddress}}</textarea>
                  </div>
                </div>

                <div class="form-group">
                  <label for="inputEmail3" class="col-sm-2 control-label">Permanent Address</label>

                  <div class="col-sm-10">
                    <textarea class="form-control" id="permanentaddress" name="permanentaddress" autocomplete="off" type="text" placeholder="Permanent Address">
                    {{$editemployeedetail->permanentaddress}}
                    </textarea>
                  </div>
                </div>

              
              </div>
          </div>
      </div>

      	<div class="col-md-6" class="form-horizontal">
          <!-- Horizontal Form -->
          <div class="box box-info">
            <div class="box-header with-border">
              <h3 class="box-title">Employee Company Details</h3>
            </div>
            <!-- /.box-header -->
            <!-- form start -->
              <div class="box-body">
                
                <div class="form-group">
                  <label for="inputEmail3" class="col-sm-2 control-label">Department</label>

                  <div class="col-sm-10">
                    <select class="form-control select2" name="department" style="width: 100%;">
                      <option>Select</option>
                      @foreach($departments as $department)
                      <option value="{{$department->id}}" {{$editcompanydetail->department==$department->id ? 'selected="selected"':''}}>{{$department->departmentname}}</option>
                      @endforeach
                    </select>
                  </div>
                </div>
                
                <br>
                <div class="form-group">
                  <label for="inputEmail3" class="col-sm-2 control-label">Designation</label>

                  <div class="col-sm-10">
                    <select class="form-control select2" name="designation" style="width: 100%;">
                      <option value="">Select</option>
                      @foreach($designations as $designation)
                      <option value="{{$designation->id}}" {{$editcompanydetail->designation==$designation->id ? 'selected="selected"':''}}>{{$designation->designationname}}</option>
                     @endforeach
                    </select>
                  </div>
                </div>
               <br>
               <div class="form-group">
                  <label for="inputEmail3" class="col-sm-2 control-label">Date of joining</label>

                  <div class="col-sm-10">
                    <input type="text" value="{{$editcompanydetail->dateofjoining}}" name="dateofjoining"class="form-control datepicker" placeholder="Date of Joining">
                  </div>
               </div>
               <br>
               <br>
               <div class="form-group">
                  <label for="inputEmail3" class="col-sm-2 control-label">Joining Salary</label>

                  <div class="col-sm-10">
                    <input type="text" value="{{$editcompanydetail->joinsalary}}" name="joinsalary"class="form-control" placeholder="Joining Salary">
                  </div>
               </div>
              </div>
          </div>
      </div>

      <div class="col-md-6">
          <!-- Horizontal Form -->
          <div class="box box-info">
            <div class="box-header with-border">
              <h3 class="box-title">Employee  Banka Account Details</h3>
            </div>
            <!-- /.box-header -->
            <!-- form start -->
            <div class="form-horizontal">
              <div class="box-body">

                <div class="form-group">
                  <label for="inputEmail3" class="col-sm-2 control-label">Ac. Name</label>

                  <div class="col-sm-10">
                    <input type="text" value="{{$editemployeebankaccount->accountholdername}}" name="accountholdername"class="form-control" id="inputEmail3" placeholder="Account Holder Name">
                  </div>
                </div>

                <div class="form-group">
                  <label for="inputEmail3" class="col-sm-2 control-label">Ac. No.</label>

                  <div class="col-sm-10">
                    <input type="text" value="{{$editemployeebankaccount->accountnumber}}" name="accountnumber"class="form-control" id="inputEmail3" placeholder="Account Number">
                  </div>
                </div>

                <div class="form-group">
                  <label for="inputEmail3" class="col-sm-2 control-label">Bank Name</label>

                  <div class="col-sm-10">
                    <input type="text" value="{{$editemployeebankaccount->bankname}}" name="bankname"class="form-control" id="inputEmail3" placeholder="Account Number">
                  </div>
                </div>

                <div class="form-group">
                  <label for="inputEmail3" class="col-sm-2 control-label">Ifsc</label>

                  <div class="col-sm-10">
                    <input type="text" value="{{$editemployeebankaccount->ifsc}}" name="ifsc"class="form-control" id="inputEmail3" placeholder="Account Number">
                  </div>
                </div>

                <div class="form-group">
                  <label for="inputEmail3" class="col-sm-2 control-label">Pan No.</label>

                  <div class="col-sm-10">
                    <input type="text" value="{{$editemployeebankaccount->pan}}" name="pan"class="form-control" id="inputEmail3" placeholder="Account Number">
                  </div>
                </div>

                <div class="form-group">
                  <label for="inputEmail3" class="col-sm-2 control-label">Branch</label>

                  <div class="col-sm-10">
                    <input type="text" value="{{$editemployeebankaccount->branch}}" name="branch"class="form-control" id="inputEmail3" placeholder="Account Number">
                  </div>
                </div>
                <div class="form-group">
                  <label for="inputEmail3" class="col-sm-2 control-label">PF Account</label>

                  <div class="col-sm-10">
                    <input type="text" value="{{$editemployeebankaccount->pfaccount}}" name="pfaccount"class="form-control" id="inputEmail3" placeholder="Account Number">
                  </div>
                </div>
             
              </div>
            </div>
          </div>
      </div>
      <div class="col-md-6">
          <!-- Horizontal Form -->
          <div class="box box-info">
            <div class="box-header with-border">
              <h3 class="box-title">Employee Documents</h3>
            </div>
            <!-- /.box-header -->
            <!-- form start -->
            <div class="form-horizontal">
              <div class="box-body">

                <div class="form-group">
                  <label for="inputEmail3" class="col-sm-2 control-label">Resume</label>

                  <div class="col-sm-6">
                    <input name="resume" onchange="readURL1(this);" type="file">
                  </div>
                  <div class="col-sm-3">
                  <img id="imgshow1" src="/image/resume/{{$editemployeedocument->resume}}" style="height: 70px;width: 70px;">
                  </div>
                </div>

                <div class="form-group">
                  <label for="inputEmail3" class="col-sm-2 control-label">Offer Letter</label>
                  <div class="col-sm-6">
                    <input name="offerletter" onchange="readURL2(this);" type="file">
                  </div>
                  <div class="col-sm-3">
                  <img id="imgshow2" src="/image/offerletter/{{$editemployeedocument->offerletter}}" style="height: 70px;width: 70px;">
                  </div>
                </div>

                <div class="form-group">
                  <label for="inputEmail3" class="col-sm-2 control-label">Joining Letter</label>
                  <div class="col-sm-6">
                    <input name="joiningletter" onchange="readURL3(this);" type="file">
                  </div>
                  <div class="col-sm-3">
                  <img id="imgshow3" src="/image/joiningletter/{{$editemployeedocument->joiningletter}}" style="height: 70px;width: 70px;">
                  </div>
                </div>

                <div class="form-group">
                  <label for="inputEmail3" class="col-sm-2 control-label">Agreement Paper</label>
                  <div class="col-sm-6">
                    <input name="agreementpaper" onchange="readURL4(this);" type="file">
                  </div>
                  <div class="col-sm-3">
                  <img  id="imgshow4" src="/image/agreementpaper/{{$editemployeedocument->agreementpaper}}" style="height: 70px;width: 70px;">
                  </div>
                </div>

                <div class="form-group">
                  <label for="inputEmail3" class="col-sm-2 control-label">ID Proof</label>
                  <div class="col-sm-6">
                    <input name="idproof" onchange="readURL5(this);" type="file">
                  </div>
                  <div class="col-sm-3">
                  <img id="imgshow5" src="/image/idproof/{{$editemployeedocument->idproof}}" style="height: 70px;width: 70px;">
                  </div>
                </div>


              

              </div>
              
            </div>
          </div>
      </div>
</div>
            <!-- /.box-body -->
              <div class="box-footer">
                <button type="submit" class="btn btn-info pull-right">Update</button>
              </div>
              <!-- /.box-footer -->
        </form>

<script>

  function readURL1(input) {
        

       if (input.files && input.files[0]) {
            var reader = new FileReader();
              
            reader.onload = function (e) {
                $('#imgshow1')
                    .attr('src', e.target.result)
                    .width(70)
                    .height(70);        
            };

            reader.readAsDataURL(input.files[0]);

        }
    }
    function readURL2(input) {
        

       if (input.files && input.files[0]) {
            var reader = new FileReader();
              
            reader.onload = function (e) {
                $('#imgshow2')
                    .attr('src', e.target.result)
                    .width(70)
                    .height(70);        
            };

            reader.readAsDataURL(input.files[0]);

        }
    }
    function readURL3(input) {
        

       if (input.files && input.files[0]) {
            var reader = new FileReader();
              
            reader.onload = function (e) {
                $('#imgshow3')
                    .attr('src', e.target.result)
                    .width(70)
                    .height(70);        
            };

            reader.readAsDataURL(input.files[0]);

        }
    }
    function readURL4(input) {
        

       if (input.files && input.files[0]) {
            var reader = new FileReader();
              
            reader.onload = function (e) {
                $('#imgshow4')
                    .attr('src', e.target.result)
                    .width(70)
                    .height(70);        
            };

            reader.readAsDataURL(input.files[0]);

        }
    }
    function readURL5(input) {
        

       if (input.files && input.files[0]) {
            var reader = new FileReader();
              
            reader.onload = function (e) {
                $('#imgshow5')
                    .attr('src', e.target.result)
                    .width(70)
                    .height(70);        
            };

            reader.readAsDataURL(input.files[0]);

        }
    }
</script>


@endsection