<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use App\Models\User;

class Category extends Model
{
    use HasFactory;

    // public $timestamps = false;
    public $table = 'category';
    public static function getRecords()
    {
        $data = DB::select('Select * from `category`');
        return json_encode(array('success' => 'true', 'data' => $data));
    }

    public static function getCategoryDropdown()
    {
        $data = DB::select('Select * from `category`');
        return $data;
    }

    public static function saveRecord($data)
    {
        if (array_key_exists('id', $data) && $data['id'] != '') {
            $category = Category::find($data['id']);
        } else {
            $category = new Category;
        }

            $category->parent_id = $data['category_id'];
            $category->name = $data['name'];


            if ($category->save()) {
                return true;
            } else {
                return false;
            }
    }

    public static function getDataById($id)
    {
        $data = Category::find($id);
        return $data;
    }
    public static function destroy($id)
    {
        DB::delete('DELETE FROM category WHERE id = ?', [$id]);
        return true;
    }

    public static function getCategoryTree()
    {
        $html = '<ul>';
        $data = DB::select('Select * from `category` where parent_id=0');
        foreach($data as $cat){
            $html.= '<li>'.$cat->name;
            $childData = DB::select('Select * from `category` where parent_id='.$cat->id);
            if(!empty($childData)){
                $html.= self::getChildCat($cat->id);
            }
            $html.= '</li>';
        }
        $html .= '</ul>';
        return $html;
    }

    public static function getChildCat($id){
        $html = '<ul>';
        $data = DB::select('Select * from `category` where parent_id='.$id);
        foreach($data as $cat){
            $html.= '<li>'.$cat->name;
            $childData = DB::select('Select * from `category` where parent_id='.$cat->id);
            if(!empty($childData)){
                $html.= self::getChildCat($cat->id);
            }
            $html.= '</li>';
        }
        $html .= '</ul>';
        return $html;
    }

}