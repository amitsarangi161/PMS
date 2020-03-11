@extends('layouts.app')
@section('content')
<style type="text/css">
  .select2-selection__choice {

    background-color: #134b86!important;
    border: 1px solid #134b86!important;
    border-radius: 2px!important;

}
</style>
 <section class="content">

      <div class="row">
        <div class="col-md-3">

          <!-- Profile Image -->
          <div class="box box-primary">
            <div class="box-body box-profile">
              

              <h3 class="profile-username text-center">Project Name:{{$project->projectname}}</h3>

              <p class="text-muted text-center">Client Name:{{$project->orgname}}</p>

              <ul class="list-group list-group-unbordered">
                <li class="list-group-item">
                  <b>Project Id</b> <a class="pull-right">{{$project->projectid}}</a>
                </li>
                <li class="list-group-item">
                  <b>Start Date</b> <a class="pull-right">{{$project->startdate}}</a>
                </li>
                <li class="list-group-item">
                  <b>End Date</b> <a class="pull-right">{{$project->startdate}}</a>
                </li>
                 <li class="list-group-item">
                  <b>Priority</b> <a class="pull-right">{{$project->priority}}</a>
                </li>

                 <li class="list-group-item">
                  <b>Order Form</b> <a class="pull-right"><a href="/img/orderform/{{$project->orderform}}" download>
        Click Here to download
         </a></a>
                </li>
              
              </ul>

              <a href="#" class="btn btn-primary btn-block"><b>{{$project->status}}</b></a>
              <a href="/projects/editproject/{{$project->id}}" target="_blank" class="btn btn-info btn-block"><b>EDIT</b></a>
            </div>
            <!-- /.box-body -->
          </div>
          <!-- /.box -->

          <!-- About Me Box -->
          
          <!-- /.box -->
        </div>
        <!-- /.col -->
        <div class="col-md-9">
          <div class="nav-tabs-custom">
            <ul class="nav nav-tabs">
                <li class="active"><a href="#all" data-toggle="tab">ALL</a></li>
              @foreach($activities as $key=>$activity)
           
                     <li><a href="#{{$activity->id}}" data-toggle="tab">{{$activity->activityname}}</a></li>
           
              @endforeach
             
            </ul>
            <div class="tab-content">


               @foreach($activities as $key=>$activity)
                  @php
                    $pid=$project->id;
                    $aid=$activity->acid;

                    $projectreports=\App\projectreport::select('projectreports.*','users.name')
                                  ->where('projectreports.projectid',$pid)
                                  ->where('projectreports.activityid',$aid)
                                   ->leftJoin('users','projectreports.userid','=','users.id')
                                  ->orderBy('projectreports.updated_at','DESC')
                                   ->get();
                    @endphp
                    
<div class="tab-pane" id="{{$activity->id}}">
                <!-- Post -->

                   


    @foreach($projectreports as $projectreport)
    <div class="panel panel-primary">
        <div class="panel-heading">
          <div class="row">
            <div class="col-lg-4 col-md-4 col-sm-3 col-xs-12">
              <h5 class="text-center">{{$projectreport->name}} &nbsp !! &nbsp {{$activity->activityname}}</h5>
            </div>
            <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
              <h5 class="text-center">{{$projectreport->subject}}</h5>
            </div>
            <div class="col-lg-4 col-md-4 col-sm-5 col-xs-12">
              <h6 class="text-center">{{$projectreport->reportfordate}} || <span>{{$projectreport->created_at}}</span></h6>
            </div>
          </div>
        </div>
        <div class="panel-body">
          <h5 class="text-justify">{!! $projectreport->description !!}</h5>
        </div>
        <div class="panel-footer">
          <div class="row">
            <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
              <h5 class="text-center"><i class="fa fa-user"></i> Author ||<span>{{$projectreport->author}}</span></h5>
            </div>
            <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
              <h5 class="text-center"><span>Verified BY: {{$projectreport->acceptedby}}</span></h5>
            </div>
            <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
              @if($projectreport->status=='VERIFIED')
              <div class="col-sm-6">
                <a href="/viewverifiedreport/{{$projectreport->id}}" class="btn btn-success" target="_blank">VERIFIED</a>
               <!--  <button type="button" class="btn btn-success">VERIFIED</button> -->
              </div>
              @else
              <div class="col-sm-6">
              <!--   <a href="/viewnotverifiedreport/{{$projectreport->id}}" class="btn btn-danger">NOT VERIFIED</a> -->
                <button type="button" class="btn btn-danger" onclick="openverifymodal('{{$projectreport->id}}');">NOT VERIFIED</button>
              </div>
              @endif
            </div>
          </div>
        </div>
  </div>
                
@endforeach


  </div>


 @endforeach

<!-- FOR ALL TAB -->
                    @php
                    $pid1=$project->id;
                   

                    $projectreports1=\App\projectreport::select('projectreports.*','users.name','activities.activityname')
                                  ->where('projectreports.projectid',$pid1)
                                   ->leftJoin('users','projectreports.userid','=','users.id')
                                    ->leftJoin('activities','projectreports.activityid','=','activities.id')
                                  ->orderBy('projectreports.updated_at','DESC')
                                   ->get();
                    @endphp


  <div class="active tab-pane" id="all">
     @foreach($projectreports1 as $projectreport)

    <div class="panel panel-primary">
        <div class="panel-heading">
          <div class="row">
            <div class="col-lg-4 col-md-4 col-sm-3 col-xs-12">
              <h5 class="text-center">{{$projectreport->name}} !! {{$projectreport->activityname}}</h5>
            </div>
            <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
              <h5 class="text-center">{{$projectreport->subject}}</h5>
            </div>
            <div class="col-lg-4 col-md-4 col-sm-5 col-xs-12">
              <h6 class="text-center">{{$projectreport->reportfordate}} || <span>{{$projectreport->created_at}}</span></h6>
            </div>
          </div>
        </div>
        <div class="panel-body">
          <h5 class="text-justify">{!! $projectreport->description !!}</h5>
        </div>
        <div class="panel-footer">
          <div class="row">
            <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
              <h5 class="text-center"><i class="fa fa-user"></i> Author ||<span>{{$projectreport->author}}</span></h5>
            </div>
            <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
              <h5 class="text-center"><span>Verified BY: {{$projectreport->acceptedby}}</span></h5>
            </div>
            <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
              @if($projectreport->status=='VERIFIED')
              <div class="col-sm-6">
                <a href="/viewverifiedreport/{{$projectreport->id}}" class="btn btn-success" target="_blank">VERIFIED</a>
               
              </div>
              @else
              <div class="col-sm-6">
            <!--     <a href="/viewnotverifiedreport/{{$projectreport->id}}" class="btn btn-danger">NOT VERIFIED</a> -->
                <button type="button" class="btn btn-danger" onclick="openverifymodal('{{$projectreport->id}}');">NOT VERIFIED</button>
              </div>
              @endif
            </div>
          </div>
        </div>
  </div>
                
@endforeach


  </div>




              <!-- /.tab-pane -->
            </div>
            <!-- /.tab-content -->
          </div>
          <!-- /.nav-tabs-custom -->
        </div>
        <!-- /.col -->
      </div>
      <!-- /.row -->

    </section>
    <!-- /.content -->



<div id="myModal" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">REPORT VERIFY</h4>
      </div>
      <div class="modal-body">
         <form action="/adminverifyreport/1" method="post">
            {{csrf_field()}}
            <input type="hidden" name="reportid" id="reportid">
            <table class="table table-responsive table-hover table-bordered table-striped">
                 
         
         <tr>
            <td>REMARKS</td>
            <td>
            <textarea class="form-control" name="remarks"> </textarea>
               
           
         </td>
         </tr>
         <tr>
            <td><button type="submit" class="btn btn-success">CHANGE STATUS</button></td>
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

<div class="row">
          <div class="col-md-12">
          <div class="nav-tabs-custom">
            <ul class="nav nav-tabs text-center">
              <li class="active"><a href="#projectdetails" data-toggle="tab"><i class="fa fa-th"></i> Project Details</a></li>
              <li><a href="#assignproject" data-toggle="tab">
                <i class="fa fa-users" ></i> Assign Project</a></li>
            </ul>
            <div class="tab-content">
              <div class="tab-pane active" id="projectdetails">
                <div class="panel panel-primary">
                  <div class="panel-heading">
                    PROJECT DETAILS
                  </div>
                  <div class="panel-body">                    
                  </div>
                    <div class="col-md-6">
                      <div class="form-group">
                        <label for="exampleInputEmail1">CLIENT NAME</label>
                        <input type="email" class="form-control" id="exampleInputEmail1" value="{{$project->clientname}}" placeholder="Enter email">
                      </div>
                    </div>
                    <div class="col-md-6">
                      <div class="form-group">
                        <label for="exampleInputEmail1">DISTRICT NAME</label>
                        <input type="email" class="form-control" id="exampleInputEmail1" value="{{$project->districtname}}" placeholder="Enter email">
                      </div>
                    </div>
                  </div>
                  <div class="panel-body">
                    <div class="col-md-6">
                      <div class="form-group">
                        <label for="exampleInputEmail1">DIVISION NAME</label>
                        <input type="email" class="form-control" id="exampleInputEmail1" value="{{$project->divisionname}}" placeholder="Enter email">
                      </div>
                    </div>
                    <div class="col-md-6">
                      <div class="form-group">
                        <label for="exampleInputEmail1">PROJECT NAME</label>
                        <input type="email" class="form-control" id="exampleInputEmail1"value="{{$project->projectname}}" placeholder="Enter email">
                      </div>
                    </div>
                  </div>
                  <div class="panel-body">
                    <div class="col-md-6">
                      <div class="form-group">
                        <label for="exampleInputEmail1">PROJECT COST</label>
                        <input type="email" class="form-control" id="exampleInputEmail1" value="{{$project->cost}}" placeholder="Enter email">
                      </div>
                    </div>
                    <div class="col-md-6">
                      <div class="form-group">
                        <label for="exampleInputEmail1">PRIORITY</label>
                        <input type="email" class="form-control" id="exampleInputEmail1"value="{{$project->priority}}" placeholder="Enter email">
                      </div>
                    </div>
                  </div>
                  <div class="panel-body">
                    <div class="col-md-6">
                      <div class="form-group">
                        <label for="exampleInputEmail1">PAPER COST</label>
                        <input type="email" class="form-control" id="exampleInputEmail1" value="{{$project->papercost}}" placeholder="Enter email">
                      </div>
                    </div>
                    <div class="col-md-6">
                      <div class="form-group">
                        <label for="exampleInputEmail1">LOA NUMBER</label>
                        <input type="email" class="form-control" id="exampleInputEmail1"value="{{$project->loano}}" placeholder="Enter email">
                      </div>
                    </div>
                  </div>
                  <div class="panel-body">
                    <div class="col-md-6">
                      <div class="form-group">
                        <label for="exampleInputEmail1">AGREEMENT NUMBER</label>
                        <input type="email" class="form-control" id="exampleInputEmail1" value="{{$project->agreementno}}" placeholder="Enter email">
                      </div>
                    </div>
                    <div class="col-md-6">
                      <div class="form-group">
                        <label for="exampleInputEmail1">DATE OF COMMENCEMENT </label>
                        <input type="email" class="form-control" id="exampleInputEmail1"value="{{$project->startdate}}" placeholder="Enter email">
                      </div>
                    </div>
                  </div>
                   <div class="panel-body">
                    <div class="col-md-6">
                      <div class="form-group">
                        <label for="exampleInputEmail1">DATE OF COMPLETION</label>
                        <input type="email" class="form-control" id="exampleInputEmail1" value="{{$project->enddate}}" placeholder="Enter email">
                      </div>
                    </div>
                    <div class="col-md-6">
                      <div class="form-group">
                        <label for="exampleInputEmail1">ISD DATE </label>
                        <input type="email" class="form-control" id="exampleInputEmail1"value="{{$project->isddate}}" placeholder="Enter email">
                      </div>
                    </div>
                  </div>
                   <div class="panel-body">
                    <div class="col-md-6">
                      <div class="form-group">
                        <label for="exampleInputEmail1">ISD VALID UPTO</label>
                        <input type="email" class="form-control" id="exampleInputEmail1" value="{{$project->isdvalidupto}}" placeholder="Enter email">
                      </div>
                    </div>
                    <div class="col-md-6">
                      <div class="form-group">
                        <label for="exampleInputEmail1">ISD AMOUNT</label>
                        <input type="email" class="form-control" id="exampleInputEmail1"value="{{$project->isdamount}}" placeholder="Enter email">
                      </div>
                    </div>
                  </div>
                    <div class="panel-body">
                    <div class="col-md-6">
                      <div class="form-group">
                        <label for="exampleInputEmail1">EMD DATE</label>
                        <input type="email" class="form-control" id="exampleInputEmail1" value="{{$project->emddate}}" placeholder="Enter email">
                      </div>
                    </div>
                    <div class="col-md-6">
                      <div class="form-group">
                        <label for="exampleInputEmail1">EMD VALID UPTO </label>
                        <input type="email" class="form-control" id="exampleInputEmail1"value="{{$project->emdvalidupto}}" placeholder="Enter email">
                      </div>
                    </div>
                  </div>
                  <div class="panel-body">
                    <div class="col-md-6">
                      <div class="form-group">
                        <label for="exampleInputEmail1">EMD AMOUNT</label>
                        <input type="email" class="form-control" id="exampleInputEmail1" value="{{$project->emdamount}}" placeholder="Enter email">
                      </div>
                    </div>
                    <div class="col-md-6">
                      <div class="form-group">
                        <label for="exampleInputEmail1">APS DATE</label>
                        <input type="email" class="form-control" id="exampleInputEmail1"value="{{$project->apsdate}}" placeholder="Enter email">
                      </div>
                    </div>
                  </div>
                  <div class="panel-body">
                    <div class="col-md-6">
                      <div class="form-group">
                        <label for="exampleInputEmail1">APS VALID UPTO</label>
                        <input type="email" class="form-control" id="exampleInputEmail1" value="{{$project->apsvalidupto}}" placeholder="Enter email">
                      </div>
                    </div>
                    <div class="col-md-6">
                      <div class="form-group">
                        <label for="exampleInputEmail1">APS AMOUNT</label>
                        <input type="email" class="form-control" id="exampleInputEmail1"value="{{$project->apsamount}}" placeholder="Enter email">
                      </div>
                    </div>
                  </div>
                  <div class="panel-body">
                    <div class="col-md-6">
                      <div class="form-group">
                        <label for="exampleInputEmail1">BG DATE</label>
                        <input type="email" class="form-control" id="exampleInputEmail1" value="{{$project->bgdate}}" placeholder="Enter email">
                      </div>
                    </div>
                    <div class="col-md-6">
                      <div class="form-group">
                        <label for="exampleInputEmail1">BG VALID UPTO</label>
                        <input type="email" class="form-control" id="exampleInputEmail1"value="{{$project->bgvalidupto}}" placeholder="Enter email">
                      </div>
                    </div>
                  </div>
                  <div class="panel-body">
                    <div class="col-md-6">
                      <div class="form-group">
                        <label for="exampleInputEmail1">BG AMOUNT</label>
                        <input type="email" class="form-control" id="exampleInputEmail1" value="{{$project->bgamount}}" placeholder="Enter email">
                      </div>
                    </div>
                    <div class="col-md-6">
                      <div class="form-group">
                        <label for="exampleInputEmail1">DD DATE</label>
                        <input type="email" class="form-control" id="exampleInputEmail1"value="{{$project->dddate}}" placeholder="Enter email">
                      </div>
                    </div>
                  </div>
                  <div class="panel-body">
                    <div class="col-md-6">
                      <div class="form-group">
                        <label for="exampleInputEmail1">DD VALID UPTO</label>
                        <input type="email" class="form-control" id="exampleInputEmail1" value="{{$project->ddvalidupto}}" placeholder="Enter email">
                      </div>
                    </div>
                    <div class="col-md-6">
                      <div class="form-group">
                        <label for="exampleInputEmail1">DD AMOUNT</label>
                        <input type="email" class="form-control" id="exampleInputEmail1"value="{{$project->ddamount}}" placeholder="Enter email">
                      </div>
                    </div>
                  </div>
               </div>
              </div>

              <div class="tab-pane" id="assignproject">
                <form class="form-horizontal" method="post" action="/assignuserforproject">
                  {{ csrf_field() }}
                    <div class="panel panel-primary">
                  <div class="panel-heading">
                    ASSIGN PROJECT TO USER
                  </div>
                  <div class="panel-body">
                    
                      <div class="box-body">
                        <div class="row">
                          <div class="col-md-6">
                              <div class="form-group">
                                <label  class="col-sm-4 control-label">Project Name</label>

                              <div class="col-sm-8">
                                <input type="hidden"  class="form-control" value="{{$project->id}}" name="project_id">
                                <input type="text"  class="form-control" value="{{$project->projectname}}" disabled="">
                              </div>
                              </div>
                          </div>
                          <div class="col-md-6">
                              <div class="form-group">
                                <label  class="col-sm-4 control-label">Select  User</label>

                              <div class="col-sm-8">
                                <select name="employee_id" required="" class="form-control select2" style="width: 100%;"  multiple="multiple" data-placeholder="Select User">
                                @foreach($users as $user)
                                  <option value="{{$user->employee_id}}">{{$user->name}}</option>
                                @endforeach
                                </select>
                              </div>
                              </div>
                              <button type="submit" class="btn btn-success btn-flat pull-right">Assign Usre</button>                              
                          </div>
                        </div>
                      </div>
                  </div>
               </div>
               </form>
                  </div>
              </div>
            </div>
          </div>
        
</div>
<script type="text/javascript">
   
   function openverifymodal(id) {
       //alert(id);
       $("#reportid").val(id);
       $("#myModal").modal('show');
   }
</script>


@endsection