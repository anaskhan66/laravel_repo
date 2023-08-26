<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Support\Facades\Crypt;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use App\Models\Category;
use App\Models\User;
use App\Http\Controllers\Controller;

class CategoryController extends Controller
{
    function Index()
    {
        return view('admin/category');
    }
   
    function treeView()
    {
        $categoryHtml = Category::getCategoryTree();
        return view('admin/treeView',['categoryHtml'=>$categoryHtml]);
    }

    function Create(Request $request)
    {

        if ($request->isMethod('get') && !empty($request->id)) {
            $data = Category::getDataById($request->id);
            return view('admin/createCategory', ['data' => $data]);
        }
        if ($request->isMethod('post')) {
            $data['category_id'] = $request->category_id;
            $data['name'] = $request->name;

      


            if ($request->id != '') {
                $data['id'] = $request->id;
                $msg = 'Category Updated Successfully';
            } else {
                $msg = 'New Category Added Successfully';
            }
            $result = Category::saveRecord($data);
            if ($result) {
                return redirect('/category')->with('success', $msg);
            } else {
                return redirect('/')->with('failure', 'Something went wrong');
            }
        }
        return view('admin/createCategory', ['data' => []]);
    }

    function Delete(Request $request)
    {
        $result = Category::destroy($request->id);
        if ($result) {
            echo ("Category deleted successfully.");
        } else {
            echo 'Something went wrong';
        }
    }
    public static function getCategoryById($empid)
    {
        $empdata = DB::table('category')->where('category_id','=',$empid)->get();
        return json_encode(array('success'=>'true','data'=>$empdata,'error_code'=>'10001'));
    }
}