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
                <div class="form-horizontal">
                <div class="form-group">
                  <label for="inputEmail3" class=" col-sm-3">Emp. Name</label>
                  <div class="col-sm-9">
                    <input type="text" value="{{$editemployeedetail->employeename}}" name="employeename"class="form-control" id="inputEmail3" placeholder="Employee Name">
                  </div>
                </div>
                <div class="form-group">
                  <label for="inputEmail3" class=" col-sm-3">Qualification</label>
                  <div class="col-sm-9">
                    <input type="text" value="{{$editemployeedetail->qualification}}" name="qualification"class="form-control" id="inputEmail3" placeholder="Qualification Name">
                  </div>
                </div>
                <div class="form-group">
                  <label for="inputEmail3" class=" col-sm-3">Experence In Company</label>
                  <div class="col-sm-9">
                    <input type="text" value="{{$editemployeedetail->experencecomp}}" name="experencecomp"class="form-control" id="inputEmail3" placeholder="Experence In Which Company">
                  </div>
                </div>
                <div class="form-group">
                  <label for="inputEmail3" class=" col-sm-3">DOB</label>

                  <div class="col-sm-9">
                    <input type="text" value="{{$editemployeedetail->dob}}" name="dob" class="form-control datepicker" placeholder="Date of Birth">
                  </div>
                </div>
                <div class="form-group">
                  <label for="inputEmail3" class=" col-sm-3">Email</label>
                  <div class="col-sm-9">
                    <input type="email" value="{{$editemployeedetail->email}}" name="email"class="form-control" id="inputEmail3" placeholder="Email">
                  </div>
                </div>
                <div class="form-group">
                  <label for="inputEmail3" class=" col-sm-3">Gender</label>

                  <div class="col-sm-9">
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
                  <label for="inputEmail3" class=" col-sm-3">Personal Mobile No.</label>

                  <div class="col-sm-9">
                    <input type="text" value="{{$editemployeedetail->phone}}" name="phone"class="form-control" id="inputEmail3" placeholder="Phone Number">
                  </div>
                </div>
                <div class="form-group">
                  <label for="inputEmail3" class=" col-sm-3">Alternative No.</label>

                  <div class="col-sm-9">
                    <input type="text" value="{{$editemployeedetail->alternativephonenumber}}" name="alternativephonenumber"class="form-control" id="inputEmail3" placeholder="Alternative Phone Number">
                  </div>
                </div>

                <div class="form-group">
                  <label for="inputEmail3" class=" col-sm-3">Adhar No.</label>

                  <div class="col-sm-9">
                    <input type="text" value="{{$editemployeedetail->adharno}}" name="adharno"class="form-control" id="inputEmail3" placeholder="Adhar Number">
                  </div>
                </div>

                <div class="form-group">
                  <label for="inputEmail3" class=" col-sm-3">Blood Group</label>

                  <div class="col-sm-9">
                    <input type="text" value="{{$editemployeedetail->bloodgroup}}" name="bloodgroup"class="form-control" id="inputEmail3" placeholder="Blood Group">
                  </div>
                </div>

                <div class="form-group">
                  <label for="inputEmail3" class=" col-sm-3">
                  Father's Name</label>

                  <div class="col-sm-9">
                    <input type="text" value="{{$editemployeedetail->fathername}}" name="fathername"class="form-control" id="inputEmail3" placeholder="Father's Name">
                  </div>
                </div>
                <div class="form-group">
                  <label for="inputEmail3" class=" col-sm-3">
                  Marital Status</label>

                  <div class="col-sm-9">
                    <input type="text" value="{{$editemployeedetail->maritalstatus}}" name="maritalstatus"class="form-control" id="inputEmail3" placeholder="Marital Status">
                  </div>
                </div>

                <div class="form-group">
                  <label for="inputEmail3" class=" col-sm-3">Present Address</label>

                  <div class="col-sm-9">
                    <textarea class="form-control" id="presentaddress" name="presentaddress" autocomplete="off" type="text" placeholder="Present Address" rows="5">{{$editemployeedetail->presentaddress}}</textarea>
                  </div>
                </div>

                <div class="form-group">
                  <label for="inputEmail3" class=" col-sm-3">Permanent Address</label>

                  <div class="col-sm-9">
                    <textarea class="form-control" id="permanentaddress" name="permanentaddress" autocomplete="off" type="text" placeholder="Permanent Address" rows="5">
                      {{$editemployeedetail->permanentaddress}}
                    </textarea>
                  </div>
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
                <div class="form-horizontal">
                <div class="form-group">
                  <label class=" col-sm-3">Department</label>

                  <div class="col-sm-9">
                    <select class="form-control select2" name="department" style="width: 100%;">
                      <option value="">Select</option>
                      @foreach($departments as $department)
                      <option value="{{$department->id}}" {{$editcompanydetail->department==$department->id ? 'selected="selected"':''}}>{{$department->departmentname}}</option>
                      @endforeach
                    </select>
                  </div>
                </div>
                <div class="form-group">
                  <label for="inputEmail3" class=" col-sm-3">Designation</label>

                  <div class="col-sm-9">
                    <select class="form-control select2" name="designation" style="width: 100%;">
                      <option value="">Select</option>
                      @foreach($designations as $designation)
                      <option value="{{$designation->id}}" {{$editcompanydetail->designation==$designation->id ? 'selected="selected"':''}}>{{$designation->designationname}}</option>
                      @endforeach
                    </select>
                  </div>
                </div>
                <div class="form-group">
                  <label for="inputEmail3" class=" col-sm-3">Employee Code</label>

                  <div class="col-sm-9">
                    <input type="text" value="{{$editcompanydetail->empcode}}" name="empcode"class="form-control" placeholder="Enter Employee Code">
                  </div>
               </div>
               <div class="form-group">
                  <label for="inputEmail3" class=" col-sm-3">Date of joining</label>

                  <div class="col-sm-9">
                    <input type="text" value="{{$editcompanydetail->dateofjoining}}" name="dateofjoining"class="form-control datepicker" placeholder="Date of Joining">
                  </div>
               </div>
               <div class="form-group">
                  <label for="inputEmail3" class=" col-sm-3">Date of Confirmation</label>

                  <div class="col-sm-9">
                    <input type="text" value="{{$editcompanydetail->dateofconfirmation}}" name="dateofconfirmation"class="form-control datepicker" placeholder="Date of Confirmation">
                  </div>
               </div>
               <div class="form-group">
                  <label for="inputEmail3" class=" col-sm-3">Joining Salary</label>

                  <div class="col-sm-9">
                    <input type="text" value="{{$editcompanydetail->joinsalary}}" name="joinsalary"class="form-control" placeholder="Joining Salary">
                  </div>
               </div>
               <div class="form-group">
                  <label for="inputEmail3" class=" col-sm-3">Total Year Experience</label>

                  <div class="col-sm-9">
                    <input type="text" value="{{$editcompanydetail->totalyrexprnc}}" name="totalyrexprnc"class="form-control" placeholder="Joining Salary">
                  </div>
               </div>
               <div class="form-group">
                  <label  class=" col-sm-3">Official Email</label>

                  <div class="col-sm-9">
                    <input type="text" value="{{$editcompanydetail->ofcemail}}" name="ofcemail"class="form-control" placeholder="Official Email Id">
                  </div>
                </div>
                <div class="form-group">
                  <label  class=" col-sm-3">CUG Mobile No</label>

                  <div class="col-sm-9">
                    <input type="text" value="{{$editcompanydetail->cugmob}}" name="cugmob"class="form-control" placeholder="CUG Mobile Number">
                  </div>
                </div>
                <div class="form-group">
                  <label  class="col-sm-3">Skill Sets</label>

                  <div class="col-sm-9">
                    <input type="text" value="{{$editcompanydetail->skillsets}}" name="skillsets"class="form-control" placeholder="Skill Sets">
                  </div>
                </div>
                <div class="form-group">
                  <label  class="col-sm-3">Location</label>

                  <div class="col-sm-9">
                    <input type="text" value="{{$editcompanydetail->location}}" name="location"class="form-control" placeholder="Location">
                  </div>
                </div>
                <div class="form-group">
                  <label  class="col-sm-3">Reporting To</label>

                  <div class="col-sm-9">
                    <input type="text" value="{{$editcompanydetail->reportingto}}" name="reportingto"class="form-control" placeholder="Reporting To">
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
              <h3 class="box-title">Employee  Bank Account Details</h3>
            </div>
            <!-- /.box-header -->
            <!-- form start -->
            <div class="form-horizontal">
              <div class="box-body">

                <div class="form-group">
                  <label for="inputEmail3" class=" col-sm-3">Ac. Name</label>

                  <div class="col-sm-9">
                    <input type="text" value="{{$editemployeebankaccount->accountholdername}}" name="accountholdername"class="form-control" id="inputEmail3" placeholder="Account Holder Name">
                  </div>
                </div>

                <div class="form-group">
                  <label for="inputEmail3" class=" col-sm-3">Salary Ac. No.</label>

                  <div class="col-sm-9">
                    <input type="text" value="{{$editemployeebankaccount->accountnumber}}" name="accountnumber"class="form-control" id="inputEmail3" placeholder="Salary Account Number">
                  </div>
                </div>

                <div class="form-group">
                  <label for="inputEmail3" class=" col-sm-3">Bank Name</label>

                  <div class="col-sm-9">
                    <input type="text" value="{{$editemployeebankaccount->bankname}}" name="bankname"class="form-control" id="inputEmail3" placeholder="Enter Bank Name">
                  </div>
                </div>

                <div class="form-group">
                  <label for="inputEmail3" class=" col-sm-3">Ifsc</label>

                  <div class="col-sm-9">
                    <input type="text" value="{{$editemployeebankaccount->ifsc}}" name="ifsc"class="form-control" id="inputEmail3" placeholder="Enter Ifsc Number">
                  </div>
                </div>

                <div class="form-group">
                  <label for="inputEmail3" class=" col-sm-3">Pan No.</label>

                  <div class="col-sm-9">
                    <input type="text" value="{{$editemployeebankaccount->pan}}" name="pan"class="form-control" id="inputEmail3" placeholder="Enter Pan Number">
                  </div>
                </div>

                <div class="form-group">
                  <label for="inputEmail3" class=" col-sm-3">Branch</label>

                  <div class="col-sm-9">
                    <input type="text" value="{{$editemployeebankaccount->branch}}" name="branch"class="form-control" id="inputEmail3" placeholder="Enter Branch Name">
                  </div>
                </div>
                <div class="form-group">
                  <label for="inputEmail3" class=" col-sm-3">PF Account</label>

                  <div class="col-sm-9">
                    <input type="text" value="{{$editemployeebankaccount->pfaccount}}" name="pfaccount"class="form-control" id="inputEmail3" placeholder="PF Account Number">
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
                  <label for="inputEmail3" class=" col-sm-3">Resume</label>

                  <div class="col-sm-6">
                    <input name="resume" onchange="readURL1(this)" type="file">
                  </div>
                  <div class="col-sm-3">
                    <img id="imgshow1" src="/image/resume/{{$editemployeedocument->resume}}" style="height: 70px;width: 70px;">
                  </div>
                </div>

                <div class="form-group">
                  <label for="inputEmail3" class=" col-sm-3">Offer Letter</label>
                  <div class="col-sm-6">
                    <input name="offerletter" onchange="readURL2(this)" type="file">
                  </div>
                  <div class="col-sm-3">
                    <img id="imgshow2" src="/image/offerletter/{{$editemployeedocument->offerletter}}" style="height: 70px;width: 70px;">
                  </div>
                </div>

                <div class="form-group">
                  <label for="inputEmail3" class=" col-sm-3">Joining Letter</label>
                  <div class="col-sm-6">
                    <input name="joiningletter" onchange="readURL3(this)" type="file">
                  </div>
                  <div class="col-sm-3">
                    <img id="imgshow3" src="/image/joiningletter/{{$editemployeedocument->joiningletter}}" style="height: 70px;width: 70px;">
                  </div>
                </div>

                <div class="form-group">
                  <label for="inputEmail3" class=" col-sm-3">Agreement Paper</label>
                  <div class="col-sm-6">
                    <input name="agreementpaper" onchange="readURL4(this)" type="file">
                  </div>
                  <div class="col-sm-3">
                    <img  id="imgshow4" src="/image/agreementpaper/{{$editemployeedocument->agreementpaper}}" style="height: 70px;width: 70px;">
                  </div>
                </div>

                <div class="form-group">
                  <label for="inputEmail3" class=" col-sm-3">ID Proof</label>
                  <div class="col-sm-6">
                    <input name="idproof" onchange="readURL5(this)" type="file">
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
                <button type="submit" class="btn btn-flat btn-info pull-right">Update Employee Details</button>
              </div>
              <!-- /.box-footer -->
        </form>

<script>
  function readURL1(input) {
    if (input.files && input.files[0]) {
        var reader = new FileReader();

        reader.onload = function (e) {
            $('#imgshow1').attr('src', e.target.result);
        }

        reader.readAsDataURL(input.files[0]);
    }
  }
  function readURL2(input) {
    if (input.files && input.files[0]) {
        var reader = new FileReader();

        reader.onload = function (e) {
            $('#imgshow2').attr('src', e.target.result);
        }

        reader.readAsDataURL(input.files[0]);
    }
  }
  function readURL3(input) {
    if (input.files && input.files[0]) {
        var reader = new FileReader();

        reader.onload = function (e) {
            $('#imgshow3').attr('src', e.target.result);
        }

        reader.readAsDataURL(input.files[0]);
    }
  }
  function readURL4(input) {
    if (input.files && input.files[0]) {
        var reader = new FileReader();

        reader.onload = function (e) {
            $('#imgshow4').attr('src', e.target.result);
        }

        reader.readAsDataURL(input.files[0]);
    }
  }
  function readURL5(input) {
    if (input.files && input.files[0]) {
        var reader = new FileReader();

        reader.onload = function (e) {
            $('#imgshow5').attr('src', e.target.result);
        }

        reader.readAsDataURL(input.files[0]);
    }
  }
</script>

@endsection