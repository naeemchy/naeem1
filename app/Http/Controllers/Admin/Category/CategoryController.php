<?php

namespace App\Http\Controllers\Admin\Category;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Model\Admin\Category;
use App\Model\Admin\Brands;
use DB;
class CategoryController extends Controller
{
   public function __construct()
    {
        $this->middleware('auth:admin');
    }

    public function Category()
    {
        $category = Category::all();
        return view('admin.category.category',compact('category'));
    }

    public function StoreCategory(Request $request)
    {
        $validatedData = $request->validate([
        'category_name' => 'required|unique:categories|max:55',
    		]);

        // $data=array();
        // $data['category_name'] = $request->category_name;
        // DB::table('categories')->insert($data);

        $category = new Category();
        $category->category_name = $request->category_name;
        $category->save();

        $notification=array(
                        'messege'=>'Category Insert Done!',
                        'alert-type'=>'success'
                         );
                       return Redirect()->back()->with($notification);
    }

    public function DeleteCategory($id)
    {
        DB::table('categories')->where('id',$id)->delete();
        $notification=array(
                        'messege'=>'Category Deleted Done!',
                        'alert-type'=>'success'
                         );
                       return Redirect()->back()->with($notification);
    }
    public function EditCategory($id)
    {
        $category = DB::table('categories')->where('id',$id)->first();
        return view('admin.category.edit_category',compact('category'));
    }

    public function UpdateCategory(Request $request,$id){
    	$validatedData = $request->validate([
        'category_name' => 'required|max:55',
    	]);
    	$data=array();
        $data['category_name'] = $request->category_name;
        $update = DB::table('categories')->where('id',$id)->update($data);
        if ($update) {
        	 $notification=array(
                        'messege'=>'Category Updated Done!',
                        'alert-type'=>'success'
                         );
                       return Redirect()->route('categories')->with($notification);
        }else{
        	 $notification=array(
                        'messege'=>'Category Nothing to Updated !',
                        'alert-type'=>'success'
                         );
                       return Redirect()->route('categories')->with($notification);
        }
    }
    public function brand()
    {
        $brand = Brands::all();
        return view('admin.category.brand',compact('brand'));
    }
    public function StoreBrand(Request $request)
    {
        $validatedData = $request->validate([
        'brand_name' => 'required|unique:brands|max:55',
    	]);

         $data=array();
         $data['brand_name'] = $request->brand_name;
         $image = $request->file('brand_logo');
         if($image){
   			//$image_name=str_random(20);
   			$image_name=date('dmy_H_s_i');
   			$ext=strtolower($image->getClientOriginalExtension());
   			$image_full_name=$image_name.'.'.$ext;
   			$upload_path='public/media/brand/';
   			$image_url=$upload_path.$image_full_name;
   			$success=$image->move($upload_path,$image_full_name);
   		
   			$data['brand_logo']=$image_url;
   			$brand=DB::table('brands')
   					->insert($data);

   			$notification=array(
                        'messege'=>'successfully Brand Insert with image!',
                        'alert-type'=>'success'
                         );
                       return Redirect()->back()->with($notification);
   			}else{
   		
   				$brand=DB::table('brands')
   					->insert($data);
   				$notification=array(
                        'messege'=>'successfully Brand Insert Without image!',
                        'alert-type'=>'success'
                         );
                       return Redirect()->back()->with($notification);
   		}		

    }
    public function DeleteBrand($id)
    {
       $data = DB::table('brands')->where('id',$id)->first();
       $image = $data->brand_logo;
       unlink($image);
       $brand=DB::table('brands')->where('id',$id)->delete();
   				$notification=array(
                        'messege'=>'successfully Brand Deleted!',
                        'alert-type'=>'success'
                         );
                       return Redirect()->back()->with($notification);
    }
    public function EditBrand($id)
    {
        $brands = DB::table('brands')->where('id',$id)->first();
        return view('admin.category.edit_brands',compact('brands'));
    }
    public function UpdateBrand(Request $request,$id){
    	$oldlogo=$request->old_image;
    	$data=array();
         $data['brand_name'] = $request->brand_name;
         $image = $request->file('brand_logo');
         if($image){
   			unlink($oldlogo);
   			$image_name=date('dmy_H_s_i');
   			$ext=strtolower($image->getClientOriginalExtension());
   			$image_full_name=$image_name.'.'.$ext;
   			$upload_path='public/media/brand/';
   			$image_url=$upload_path.$image_full_name;
   			$success=$image->move($upload_path,$image_full_name);
   		
   			$data['brand_logo']=$image_url;
   			$brand=DB::table('brands')->where('id',$id)->update($data);
   			$notification=array(
                        'messege'=>'successfully Brand Updated with image!',
                        'alert-type'=>'success'
                         );
                       return Redirect()->route('brands')->with($notification);
   			}else{
   		
   				$brand=DB::table('brands')->where('id',$id)->update($data);
   				$notification=array(
                        'messege'=>'successfully Brand Updated Without image!',
                        'alert-type'=>'success'
                         );
                      return Redirect()->route('brands')->with($notification);
   		}		

    }
    public function Subcategories()
    {
    	$category=DB::table('categories')->get();
    	$subcat = DB::table('subcategories')
    			  ->join('categories','subcategories.category_id','categories.id')
    			  ->select('subcategories.*','categories.category_name')
    			  ->get();
        return view('admin.category.sub_categories',compact('category','subcat'));
    }

    public function subcategory(Request $request)
    {
    	$validatedData = $request->validate([
        'category_id' => 'required',
        'subcategory_name' => 'required',
    	]);

    	$data=array();
        $data['category_id'] = $request->category_id;
        $data['subcategory_name'] = $request->subcategory_name;
        DB::table('subcategories')->insert($data);
        $notification=array(
                        'messege'=>'subcategories successfully added!',
                        'alert-type'=>'success'
                         );
                       return Redirect()->back()->with($notification);
    }

    public function Deletesubcategory($id){
    	 DB::table('subcategories')->where('id',$id)->delete();
    	 $notification=array(
                        'messege'=>'subcategories Deleted!',
                        'alert-type'=>'success'
                         );
                       return Redirect()->back()->with($notification);
    }
    
    public function Editsubcategory($id){
    	$subcat = DB::table('subcategories')->where('id',$id)->first();
    	$category=DB::table('categories')->get();
    	 return view('admin.category.edit_sub_categories',compact('subcat','category'));
    }

    public function Updatesubcategory(Request $request,$id){
    	$data=array();
        $data['category_id'] = $request->category_id;
        $data['subcategory_name'] = $request->subcategory_name;
        DB::table('subcategories')->where('id',$id)->update($data);
        $notification=array(
                        'messege'=>'subcategories successfully Updated!',
                        'alert-type'=>'success'
                         );
                       return Redirect()->route('sub.categories')->with($notification);
    }
}
