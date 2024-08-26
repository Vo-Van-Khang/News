<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\validate;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class CategoryController extends Controller
{
    public function get_news_category($id){
        // category_name
        $name = DB::table('categories')->select('*')->where('id',$id)->first();
        // category_news
        $news = DB::table('news')->select('*')->where('category',$id)->get()->chunk(4);
        // authors
        $authors = DB::table('users')->get();
        $stacks = [];
        for ($i=0; $i < count($news); $i++) { 
            if(count($news[$i]) == 4){
                array_push($stacks,$news[$i]);
            }
        }
        // category_menu
        $categories = DB::table('categories')->select('*')->get();
        $navigational = $name->id;
        return view('category',[
            'name'=>$name,
            'authors'=>$authors,
            'stacks'=>$stacks,
            'categories'=>$categories,
            'navigational'=>$navigational
        ]);
    }

    public function list(){
        $categories = DB::table('categories')->orderBy('id','desc')->get();
        $items_FK = [];
        foreach ($categories as $category) {
            $news = DB::table('news')->where('category',$category->id)->first();
            if($news != null){
                array_push($items_FK,$category->id);
            }
        }
        $display = "category.list";
        return view('admin.category',['categories' => $categories, 'items_FK' => $items_FK, 'display' => $display, 'focus'=> request()->query('focus')]);
    }

    public function delete($id){
        $category = DB::table('categories')->where('id', $id)->delete();
        return redirect()->route('category.list')->with('success','Đã xóa thành công!');
    }

    public function update($id){
        $category = DB::table('categories')->where('id', $id)->first();
        $display = "category.update";
        return view('admin.category',['category' => $category, 'display' => $display]);
    }
    public function admin_update(validate $request, $id){
        $validated = $request->validated();
        $category = DB::table('categories')->where('id',$id)->first();
        $oldImage = $category->image;
        if ($request->hasFile('image')) {
            if ($oldImage && file_exists(public_path('images/' . $oldImage))) {
                unlink(public_path('images/' . $oldImage));
            }
            $file = $request->file('image');
            $filename = time() . '_' . $file->getClientOriginalName();
            $file->move(public_path('images'), $filename);
        } else {
            $filename = $category->image;
        }
        $category = DB::table('categories')->where('id', $id)->update([
            'name'=>$request->input('name'),
            'description'=>$request->input('description'),
            'image'=>$filename]);
        return redirect()->route('category.list')->with('success','Cập nhật thành công!');
    }

    public function create(){
        $display = "category.create";
        return view('admin.category',['display' => $display]);
    }

    public function admin_create(validate $request){
        $validated = $request->validated();
        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $filename = time() . '_' . $file->getClientOriginalName();
            $file->move(public_path('images'), $filename);
        } else {
            $filename = null;
        }
        $category = DB::table('categories')->insert([
            'name'=>$request->input('name'),
            'description'=>$request->input('description'),
            'image'=>$filename,
            'id_user'=>Auth::user()->id,
        ]);
        return redirect()->route('category.list')->with('success','Thêm mới thành công!');
    }
}
