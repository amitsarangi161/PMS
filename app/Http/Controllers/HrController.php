<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\activity;
use App\userrequest;
use Session;
use Mail;
use App\complaint;
use Auth;
use App\complaintlog;
use DB;
use App\todo;
use Carbon\Carbon;
use App\notice;
use App\document;
use App\department; 
use App\designation; 
use App\employeedetail;
use App\employeecompanydetail;
use App\employeebankaccountsdetail;
use App\employeedocument;
use Excel;
class HrController extends Controller
{
  //-------------PMS HR ------------//
public function updatedepartment(Request $request){
$id=$request->depid;
$departments=department::find($id);
$departments->departmentname=$request->departmentname;
$departments->save();
designation::where('deptartment_id',$id)->delete();
  $count=count($request->designationname);
  if($count>0){
    for($i=0;$i<$count;$i++){
      if($request->designationname[$i]!=''){
        $designation=new designation();
        $designation->deptartment_id=$id;
        $designation->designationname=$request->designationname[$i];
        $designation->save();
      }
    }
  }
  return back();
}
public function ajaxgetdept(Request $request){
 $departments=department::find($request->depid);
 $designations=designation::select('designationname')
                ->where('deptartment_id',$request->depid)
                ->get();

 return response()->json(compact('departments','designations'));
}
public function saveemployeedetails(Request $request){
      $check=employeedetail::where('email',$request->email)
            ->orWhere('phone',$request->phone)->count();
      if($check == 0){

        $employee=new employeedetail();
        $employee->employeename=$request->employeename;
        $employee->dob=$request->dob;
        $employee->email=$request->email;
        $employee->gender=$request->gender;
        $employee->phone=$request->phone;
        $employee->adharno=$request->adharno;
        $employee->bloodgroup=$request->bloodgroup;
        $employee->alternativephonenumber=$request->alternativephonenumber;
        $employee->presentaddress=$request->presentaddress;
        $employee->permanentaddress=$request->permanentaddress;
        $employee->save();

        $eid=$employee->id;
        $employeecompany=new employeecompanydetail();
        $employeecompany->employee_id=$eid;
        $employeecompany->department=$request->department;
        $employeecompany->designation=$request->designation;
        $employeecompany->dateofjoining=$request->dateofjoining;
        $employeecompany->joinsalary=$request->joinsalary;
        $employeecompany->save();

        $employeebankaccount=new employeebankaccountsdetail();
        $employeebankaccount->employee_id=$eid;
        $employeebankaccount->accountholdername=$request->accountholdername;
        $employeebankaccount->accountnumber=$request->accountnumber;
        $employeebankaccount->bankname=$request->bankname;
        $employeebankaccount->ifsc=$request->ifsc;
        $employeebankaccount->pan=$request->pan;
        $employeebankaccount->branch=$request->branch;
        $employeebankaccount->pfaccount=$request->pfaccount;
        $employeebankaccount->save();

        $employeedocument=new employeedocument();
        $employeedocument->employee_id=$eid;
        $rarefile = $request->file('resume');
        if($rarefile!='')
        {
        $u=time().uniqid(rand());
        $raupload ="image/resume";
        $uplogoimg=$u.$rarefile->getClientOriginalName();
        $success=$rarefile->move($raupload,$uplogoimg);
        $employeedocument->resume = $uplogoimg;
        }
        $rarefile = $request->file('offerletter');
        if($rarefile!='')
        {
        $u=time().uniqid(rand());
        $raupload ="image/offerletter";
        $uplogoimg=$u.$rarefile->getClientOriginalName();
        $success=$rarefile->move($raupload,$uplogoimg);
        $employeedocument->offerletter = $uplogoimg;
        }
        $rarefile = $request->file('joiningletter');
        if($rarefile!='')
        {
        $u=time().uniqid(rand());
        $raupload ="image/joiningletter";
        $uplogoimg=$u.$rarefile->getClientOriginalName();
        $success=$rarefile->move($raupload,$uplogoimg);
        $employeedocument->joiningletter = $uplogoimg;
        }
        $rarefile = $request->file('agreementpaper');
        if($rarefile!='')
        {
        $u=time().uniqid(rand());
        $raupload ="image/agreementpaper";
        $uplogoimg=$u.$rarefile->getClientOriginalName();
        $success=$rarefile->move($raupload,$uplogoimg);
        $employeedocument->agreementpaper = $uplogoimg;
        }
        $rarefile = $request->file('idproof');
        if($rarefile!='')
        {
        $u=time().uniqid(rand());
        $raupload ="image/idproof";
        $uplogoimg=$u.$rarefile->getClientOriginalName();
        $success=$rarefile->move($raupload,$uplogoimg);
        $employeedocument->idproof = $uplogoimg;
        }
        $employeedocument->save();

        $user=new User();
        $user->employee_id=$eid;
        $user->name=$request->employeename;
        $user->email=$request->email;
        $user->password=bcrypt($request->phone);
        $user->pass=$request->phone;
        $user->mobile=$request->phone;
        $user->usertype="USER";
        $user->save();
        Session::flash('message','Employee save successfully');
        return redirect('hrmain/employeelist');
      }
      else{
        Session::flash('duplicate','Employee Already Registered');
      }
       
}
public function editemployeedetails($id){
      $departments=department::all();
      $designations=designation::all();
      $editemployeedetail=employeedetail::find($id);
      $editcompanydetail=employeecompanydetail::find($id);
      $editemployeebankaccount=employeebankaccountsdetail::find($id);
      $editemployeedocument=employeedocument::find($id);
        //return $editemployeedocument;
        return view('hr.editemployeedetails',compact('editemployeedetail','editcompanydetail','editemployeebankaccount','editemployeedocument','departments','designations'));
    }
public function updateemployeedetails(Request $request,$id)
    {
        $updateemployee=employeedetail::find($id);
        $updateemployee->employeename=$request->employeename;
        $updateemployee->dob=$request->dob;
        $updateemployee->email=$request->email;
        $updateemployee->gender=$request->gender;
        $updateemployee->phone=$request->phone;
        $updateemployee->adharno=$request->adharno;
        $updateemployee->bloodgroup=$request->bloodgroup;
        $updateemployee->alternativephonenumber=$request->alternativephonenumber;
        $updateemployee->presentaddress=$request->presentaddress;
        $updateemployee->permanentaddress=$request->permanentaddress;
        $updateemployee->save();

        $eid=$updateemployee->id;

        $employeecompany=employeecompanydetail::find($eid);
        $employeecompany->employee_id=$eid;
        $employeecompany->department=$request->department;
        $employeecompany->designation=$request->designation;
        $employeecompany->dateofjoining=$request->dateofjoining;
        $employeecompany->joinsalary=$request->joinsalary;
        $employeecompany->save();

        $employeebankaccount=employeebankaccountsdetail::find($eid);
        $employeebankaccount->employee_id=$eid;
        $employeebankaccount->accountholdername=$request->accountholdername;
        $employeebankaccount->accountnumber=$request->accountnumber;
        $employeebankaccount->bankname=$request->bankname;
        $employeebankaccount->ifsc=$request->ifsc;
        $employeebankaccount->pan=$request->pan;
        $employeebankaccount->branch=$request->branch;
        $employeebankaccount->pfaccount=$request->pfaccount;
        $employeebankaccount->save();

        $employeedocument=employeedocument::find($eid);
        $employeedocument->employee_id=$eid;
        $rarefile = $request->file('resume');
        if($rarefile!='')
        {
        $u=time().uniqid(rand());
        $raupload ="image/resume";
        $uplogoimg=$u.$rarefile->getClientOriginalName();
        $success=$rarefile->move($raupload,$uplogoimg);
        $employeedocument->resume = $uplogoimg;
        }
        $rarefile = $request->file('offerletter');
        if($rarefile!='')
        {
        $u=time().uniqid(rand());
        $raupload ="image/offerletter";
        $uplogoimg=$u.$rarefile->getClientOriginalName();
        $success=$rarefile->move($raupload,$uplogoimg);
        $employeedocument->offerletter = $uplogoimg;
        }
        $rarefile = $request->file('joiningletter');
        if($rarefile!='')
        {
        $u=time().uniqid(rand());
        $raupload ="image/joiningletter";
        $uplogoimg=$u.$rarefile->getClientOriginalName();
        $success=$rarefile->move($raupload,$uplogoimg);
        $employeedocument->joiningletter = $uplogoimg;
        }
        $rarefile = $request->file('agreementpaper');
        if($rarefile!='')
        {
        $u=time().uniqid(rand());
        $raupload ="image/agreementpaper";
        $uplogoimg=$u.$rarefile->getClientOriginalName();
        $success=$rarefile->move($raupload,$uplogoimg);
        $employeedocument->agreementpaper = $uplogoimg;
        }
        $rarefile = $request->file('idproof');
        if($rarefile!='')
        {
        $u=time().uniqid(rand());
        $raupload ="image/idproof";
        $uplogoimg=$u.$rarefile->getClientOriginalName();
        $success=$rarefile->move($raupload,$uplogoimg);
        $employeedocument->idproof = $uplogoimg;
        }
        $employeedocument->save();
        Session::flash('message','Updated Employee successfully');
        return redirect('hrmain/employeelist');
      }

public function registeremployee(){
  $departments=department::all();
  $designations=designation::all();
  return view('hr.registeremployee',compact('departments','designations'));
}
public function importemployee(Request $request){
  $this->validate($request, [
      'select_file'  => 'required|mimes:xls,xlsx'
     ]);
      $path = $request->file('select_file')->getRealPath();
      $data = Excel::load($path)->get();
      //return $data;
      if($data->count()>0){
        foreach($data as $kay=>$value){
          $check=employeedetail::where('email',$value['employeename'])
          ->orWhere('phone',$value['mobile1'])->count();
          if($check==0){
          $employee=new employeedetail();
          $employee->employeename=$value['employeename'];
          $employee->dob=$value['dob'];
          $employee->email=$value['email'];
          $employee->gender=$value['gender'];
          $employee->phone=$value['mobile1'];
          $employee->alternativephonenumber=$value['mobile2'];
          $employee->adharno=$value['adharno'];
          $employee->bloodgroup=$value['bloodgroup'];
          $employee->presentaddress=$value['presentaddress'];
          $employee->permanentaddress=$value['permanentaddress'];
          $employee->save();
          $empid=$employee->id;
          $compemployee=new employeecompanydetail();
          $compemployee->employee_id=$empid;
          $compemployee->dateofjoining=$value['dateofjoining'];
          $compemployee->joinsalary=$value['joinsalary'];
          $compemployee->save();
          $empbank=new employeebankaccountsdetail();
          $empbank->employee_id=$empid;
          $empbank->accountholdername=$value['employeename'];
          $empbank->accountnumber=$value['acno'];
          $empbank->bankname=$value['bankname'];
          $empbank->ifsc=$value['ifsc'];
          $empbank->pan=$value['pan'];
          $empbank->branch=$value['branch'];
          $empbank->pfaccount=$value['pfaccount'];
          $empbank->save();
          $user=new User();
          $user->employee_id=$empid;
          $user->name=$value['employeename'];
          $user->email=$value['email'];
          $user->password=bcrypt($value['mobile1']);
          $user->pass=$value['mobile1'];
          $user->mobile=$value['mobile1'];
          $user->usertype='USER';
          $user->save();
        }
      }
      }
    Session::flash('status', 'Task was successful!');
    return back();
}
public function employeelist(){
  $employeedetails=employeedetail::all();
  return view('hr.employeelist',compact('employeedetails'));
}
public function department(){
  $all=array();
  $departments=department::all();
  foreach ($departments as $key => $department) {
   $designations=designation::select('designationname')
                ->where('deptartment_id',$department->id)
                ->get();
   $all[]=array('department'=>$department,'designation'=>$designations);
  }

  return view('hr.department',compact('all'));
}
public function adddepartment(Request $request){
  $department=new department();
  $department->departmentname=$request->departmentname;
  $department->save();
  $did=$department->id;
  $count=count($request->designationname);
  if($count>0){
    for($i=0;$i<$count;$i++){
      if($request->designationname[$i]!=''){
        $designation=new designation();
        $designation->deptartment_id=$did;
        $designation->designationname=$request->designationname[$i];
        $designation->save();
      }
    }
  }
  return back();
  
}
 //-------------END PMS HR ------------//

  public function deletedocument($id)
  {
       document::find($id)->delete();

       Session::flash('msg','Document Deleted Successfully');
       return back();
  }

   public function savedocument(Request $request)
   {
        $document=new document();
        $document->docname=$request->docname;

        $rarefile = $request->file('attachment');    
        if($rarefile!=''){
        $raupload = public_path() .'/img/doc/';
        $rarefilename=time().'.'.$rarefile->getClientOriginalName();
        $success=$rarefile->move($raupload,$rarefilename);
        $document->attachment = $rarefilename;
        }
        $document->save();
        Session::flash('msg','Document saved Successfully');
        return back();

   }

   public function adddocuments()
   {
      $documents=document::all();
      return view('hr.adddocuments',compact('documents'));
   }

    public function viewnotice($id)
    {
        $notice=notice::find($id);

        return view('viewnotice',compact('notice'));
    }

    public function activenotice($id)
    {
        $notice=notice::find($id);
       $notice->status="ACTIVE";
       $notice->save();
       return back();
    }

     public function deactivenotice($id)
     {
       $notice=notice::find($id);
       $notice->status="DEACTIVE";
       $notice->save();

       return back();
     }  

     public function updatenotice(Request $request,$id)
     {
        $notice=notice::find($id);
        $notice->subject=$request->subject;
        $notice->description=$request->description;

        $rarefile = $request->file('attachment');    
        if($rarefile!=''){
        $raupload = public_path() .'/img/notice/';
        $rarefilename=time().'.'.$rarefile->getClientOriginalName();
        $success=$rarefile->move($raupload,$rarefilename);
        $notice->attachment = $rarefilename;
        }
        $notice->save();
       
        return redirect('/notices/viewallnotice');
     }
     public function editnotice($id)
     {
        $notice=notice::find($id);

        return view('editnotice',compact('notice'));
     }

     public function viewallnotice()
     {

          $notices=notice::all();
          return view('viewallnotice',compact('notices'));

     }
    
     public function savenotice(Request $request)
     {
        $notice=new notice();
        $notice->subject=$request->subject;
        $notice->description=$request->description;

        $rarefile = $request->file('attachment');    
        if($rarefile!=''){
        $raupload = public_path() .'/img/notice/';
        $rarefilename=time().'.'.$rarefile->getClientOriginalName();
        $success=$rarefile->move($raupload,$rarefilename);
        $notice->attachment = $rarefilename;
        }
        $notice->save();
        Session::flash('msg','Notice Saved Successfully');
        return back();
       
     }
     public function createnotice()
    {
        return view('createnotice');
    }
    public function userviewallmytodo()
      {
           $todos=todo::where('userid',Auth::id())->get();

           return view('hr.userviewallmytodo',compact('todos'));
      }
     public function mymessages()
    {
        $users=User::all();
          $uid=Auth::id();
          
      /*    $messages =  chat::whereRaw("(sender, `reciver`, `created_at`) IN (
          SELECT   sender, `reciver`, MAX(`created_at`)
          FROM     chats
          WHERE     `reciver`=$uid
            or    `sender`=$uid
          GROUP BY convertationid)")
          ->orderBy('created_at','desc')
          ->get();
*/


            $messages=DB::table('chats')
                ->where(function($query) use ($uid){
                      $query->where('sender',$uid);
                      $query->orWhere('reciver',$uid);
                        })
                     ->orderBy('created_at', 'desc')
                     ->get()
                     ->unique('convertationid');

  /*$sub = chat::orderBy('created_at','DESC');

    $messages = DB::table(DB::raw("({$sub->toSql()}) as sub"))
   ->where(function($query) use ($uid){
                      $query->where('sender',$uid);
                      $query->orWhere('reciver',$uid);
                  })
    ->groupBy('convertationid')
    ->get();
     */ 

        /* $messages=chat::select('chats.*','u1.name as sendername','u2.name as recivername')
             
             ->leftJoin('users as u1','chats.sender','=','u1.id')
             ->leftJoin('users as u2','chats.reciver','=','u2.id')
             ->where(function($query) use ($uid){
                      $query->where('chats.sender',$uid);
                      $query->orWhere('chats.reciver',$uid);
                  })
               ->groupBy('chats.sender','chats.reciver')
               
                ->get();*/

         
         return view('hr.mymessages',compact('messages','users'));
    }

       public function complainttoresolve(Request $request)
   {
     $statuses=complaint::groupBy('status')->get();
      complaint::where('active','1')->update(['active'=>'0']);

     if($request->has('type'))
      {

          $filterreq=$request->type;
          $uid=Auth::id();
          $complaints=complaint::select('complaints.*','u1.name as to','u2.name as from','u3.name as ccname')
                 ->leftJoin('users as u1','complaints.touserid','=','u1.id')
                 ->leftJoin('users as u2','complaints.fromuserid','=','u2.id')
                  ->leftJoin('users as u3','complaints.cc','=','u3.id')
                  ->where('complaints.status',$request->type)
                 ->where(function($query) use ($uid){
                      $query->where('complaints.touserid',$uid);
                      $query->orWhere('complaints.cc',$uid);
                  })
                 ->orderBy('complaints.updated_at','DESC')
                 ->get();
      }
      else
      {
        $filterreq="";
         $complaints=complaint::select('complaints.*','u1.name as to','u2.name as from','u3.name as ccname')
                 ->leftJoin('users as u1','complaints.touserid','=','u1.id')
                 ->leftJoin('users as u2','complaints.fromuserid','=','u2.id')
                  ->leftJoin('users as u3','complaints.cc','=','u3.id')
                 ->where('complaints.touserid',Auth::id())
                 ->orWhere('complaints.cc',Auth::id())
                 ->orderBy('complaints.updated_at','DESC')
                 ->get();
      }

    
                
  
                
    return view('hr.complainttoresolve',compact('complaints','statuses','filterreq'));
   }
      public function viewcomplaintdetails($id)
  {
       $complaint=complaint::select('complaints.*','u1.name as to','u2.name as from','u3.name as ccname')
                 ->leftJoin('users as u1','complaints.touserid','=','u1.id')
                 ->leftJoin('users as u2','complaints.fromuserid','=','u2.id')
                 ->leftJoin('users as u3','complaints.cc','=','u3.id')
                 ->where('complaints.id',$id)
                 ->first();

       $complaintlogs=complaintlog::select('complaintlogs.*','users.name')
                      ->leftJoin('users','complaintlogs.writerid','=','users.id')
                      ->where('complaintid',$id)
                      ->orderBy('complaintlogs.created_at','DESC')
                      ->get();
      return view('hr.viewcomplaintdetails',compact('complaint','complaintlogs'));
  }
     public function complaint(Request $request)
   {  
     if($request->has('type'))
      {
          $filterreq=$request->type;
         $complaints=complaint::select('complaints.*','u1.name as to','u2.name as from','u3.name as ccname')
                 ->leftJoin('users as u1','complaints.touserid','=','u1.id')
                 ->leftJoin('users as u2','complaints.fromuserid','=','u2.id')
                 ->leftJoin('users as u3','complaints.cc','=','u3.id')
                 ->where('complaints.status',$request->type)
                 ->where('complaints.fromuserid',Auth::id())
                 ->orderBy('complaints.updated_at','DESC')
                 ->get();
      }

      else
      {
         $filterreq="";
         $complaints=complaint::select('complaints.*','u1.name as to','u2.name as from','u3.name as ccname')
                 ->leftJoin('users as u1','complaints.touserid','=','u1.id')
                 ->leftJoin('users as u2','complaints.fromuserid','=','u2.id')
                 ->leftJoin('users as u3','complaints.cc','=','u3.id')
                 ->where('complaints.fromuserid',Auth::id())
                 ->orderBy('complaints.updated_at','DESC')
                 ->get();

      }
     
      $statuses=complaint::groupBy('status')->get();
      $users=User::all();

      return view('hr.complaint',compact('users','complaints','filterreq','statuses'));

     
   }
    public function hrapproverequest(Request $request)
    {
       $user=new User();

    	  $this->validate($request,[
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'username'=>'required|string|max:255|unique:users',
            'mobile'=>'required|string|max:10|min:10|unique:users',
       ]);
       $user->name=$request->name;
       $user->email=$request->email;
       $user->mobile=$request->mobile;
       $user->usertype=$request->usertype;
       $user->username=$request->username;
       $user->password= bcrypt($request->userpassword);
       $user->designation=$request->designation;
       $user->pass=$request->userpassword;
        
       $user->save();
       $u=userrequest::find($request->uid);
       $u->status='0';
       $u->save();
        $email=$user->email;
        $uname=$request->username;
        $password=$user->pass;
        $name=$user->name;

        $mail= Mail::send('mail.mail', compact('email','uname','password','name'), function($message) use($email) {
     $message->to($email, 'Primary Client');
     $message->cc("info@stepltest.com",'Primary Client');
     $message->subject('Registration Confirmation');
         $message->from('subudhitechnoengineers@gmail.com','Subudhi Technoengineers');
        
      });
       return back();
    Session::flash('msg','User Updated Successfully');
    }
	public function registerrequest()
	{
		$userrequests=userrequest::where('status','1')->get();
		return view('hr.registerrequest',compact('userrequests'));
	}
    public function home()
    {
        $todos=todo::where('userid',Auth::id())->whereDate('datetime', Carbon::today())->paginate(10);

    	return view('hr.home',compact('todos'));
    }
       public function adduser()
   {
     
      $users=User::select('users.*','activities.activityname')
             ->leftJoin('assignedactivities','assignedactivities.userid','=','users.id')
             ->leftJoin('activities','assignedactivities.activityassigned','=','activities.id')
             ->groupBy('users.id')
             ->get();
      $activities=activity::all();

      return view('hr.adduser',compact('users','activities'));
   }

    public function saveuser(Request $request)
   {
      
     $user=new User();
       $this->validate($request,[
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'userpassword' => 'required|min:6',
            'usertype'=>'required|string',
            'username'=>'required|string|max:255|unique:users',
            'mobile'=>'required|string|max:10|min:10|unique:users',



       ]);
       $user->name=$request->name;
       $user->email=$request->email;
       $user->mobile=$request->mobile;
       $user->usertype=$request->usertype;
       $user->username=$request->username;
       $user->password= bcrypt($request->userpassword);
       $user->pass=$request->userpassword;
       $user->designation=$request->designation;
       $user->save();

        $email=$user->email;
        $uname=$user->username;
        $password=$user->pass;
        $name=$user->name;

        $mail= Mail::send('mail.mail', compact('email','uname','password','name'), function($message) use($email) {
     $message->to($email, 'Primary Client');
     $message->cc("info@stepltest.com",'Primary Client');
     $message->subject('Registration Confirmation');
         $message->from('subudhitechnoengineers@gmail.com','Subudhi Technoengineers');
        
      });
      
    Session::flash('msg','User Added Successfully');
         return back();
   }

       public function updateuser(Request $request)
       {
      $user=User::find($request->uid);
      $user->name=$request->name;
       $user->email=$request->email;
       $user->mobile=$request->mobile;
       $user->usertype=$request->usertype;
       $user->username=$request->username;
       $user->password= bcrypt($request->userpassword);
       $user->designation=$request->designation;
       $user->pass=$request->userpassword;
      
       $user->save();
    Session::flash('msg','User Updated Successfully');
    return back();
   }
}
