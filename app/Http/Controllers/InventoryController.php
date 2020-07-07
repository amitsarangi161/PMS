<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Session;
use App\productcatagory;
use App\product;
use App\stockentry;

class InventoryController extends Controller
{
	public function admininventory()
	{
	   return view('inventory.home');
	}
	
	public function productcatagory()
   {  
   	  $catagories=productcatagory::all();
   	  //return $catagories;
      return view('inventory.productcatagory',compact('catagories'));
   }
   public function savecatagory(Request $request)
  {
    $check=productcatagory::where('catagoryname',$request->catagoryname)->count();
    if($check==0){
      $catagory=new productcatagory();
      $catagory->catagoryname=$request->catagoryname;
      $rarefile = $request->file('catagoryimage');    
        if($rarefile!=''){
        $raupload = public_path() .'/img/catagoryimage/';
        $rarefilename=time().'.'.$rarefile->getClientOriginalName();
        $success=$rarefile->move($raupload,$rarefilename);
        $catagory->catagoryimage = $rarefilename;
        }
        $catagory->save();
        Session::flash('msg','catagory added successfully');
    }
    else{
      Session::flash('duplicateitem','This item already present edit it');
    }
     
    return back();

  }
  public function updatecatagory(Request $request)
    {
      $check=productcatagory::where('catagoryname',$request->catagoryname)->count();
      if($check==0){
        $catagory =productcatagory::find($request->pid);
        $catagory->catagoryname=$request->catagoryname;
      	$rarefile = $request->file('catagoryimage');    
        if($rarefile!=''){
        $raupload = public_path() .'/img/catagoryimage/';
        $rarefilename=time().'.'.$rarefile->getClientOriginalName();
        $success=$rarefile->move($raupload,$rarefilename);
        $catagory->catagoryimage = $rarefilename;
        }
        $catagory->save();
        Session::flash('msg','catagory Updated successfully');
      }
      else{
        Session::flash('duplicateitem','This item already present edit it');
      }
  return back();

    }
    public function products()
   {  
   	  $productcatagories=productcatagory::all();
   	  $products=product::select('products.*','productcatagories.catagoryname')
                       ->leftJoin('productcatagories','products.productcatagory_id','=','productcatagories.id')
                       ->get();
   	  //return $products;
      return view('inventory.products',compact('productcatagories','products'));
   }
   public function saveproduct(Request $request)
  {
    $check=product::where('productcatagory_id',$request->productcatagory_id)
          ->where('productname',$request->productname)->count();
    if($check==0){
     $product=new product();
     $product->productcatagory_id=$request->productcatagory_id;
     $product->productname=$request->productname;
     $product->productdescription=$request->productdescription;
     $product->save();
     Session::flash('msg','Product added successfully');
    }
  	else{
     Session::flash('duplicateitem','This item already present edit it');
    }
  return back();
  }
  public function updateproduct(Request $request)
    {
      $check=product::where('productcatagory_id',$request->productcatagory_id)
          ->where('productname',$request->productname)->count();
    if($check==0){
        $product =product::find($request->pid);
        $product->productcatagory_id=$request->productcatagory_id;
	     $product->productname=$request->productname;
	     $product->productdescription=$request->productdescription;
	     $product->save();
	     Session::flash('msg','Product updated successfully');
     }
     else{
     Session::flash('duplicateitem','This item already present edit it');
    }
        return back();


    }
    public function stockentry()
   {  
   	  $products=product::all();
   	  $stocks=stockentry::select('stockentries.*','products.productname')
                       ->leftJoin('products','stockentries.product_id','=','products.id')
                       ->get();
   	  //return $stocks;
      return view('inventory.stockentry',compact('products','stocks'));
   }
   public function savestock(Request $request)
  {
    $chk=stockentry::where('product_id',$request->product_id)->count();
    if($chk==0){
     $stock=new stockentry();
     $stock->product_id=$request->product_id;
     $stock->date=$request->date;
     $stock->unitrate=$request->unitrate;
     $stock->quantity=$request->quantity;
     $stock->save();
     Session::flash('msg','Sctock added successfully');
    }
  	else{
      Session::flash('duplicateitem','This item already present edit it');
    }
    return back();
  }
  public function updatestock(Request $request)
    {
       $check=product::where('productcatagory_id',$request->productcatagory_id)
          ->where('productname',$request->productname)->count();
    if($check==0){
        $stock =stockentry::find($request->pid);
         $stock->product_id=$request->product_id;
	     $stock->date=$request->date;
	     $stock->unitrate=$request->unitrate;
	     $stock->quantity=$request->quantity;
	     $stock->save();
     Session::flash('msg','Sctock updated successfully');
   }
   else{
      Session::flash('duplicateitem','This item already present edit it');
    }
     return back();
    }


}