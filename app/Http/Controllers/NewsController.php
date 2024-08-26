<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\validate;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;


class NewsController extends Controller
{
    public function get(){
        $news = DB::table('news')->select('*')->orderBy('created_at','desc')->get();
        // category_menu
        $categories = DB::table('categories')->select('*')->get();
        // authors
        $authors = DB::table('users')->get();
        $navigational = "index";
        return view('index',[
            'news'=>$news,
            'authors'=>$authors,
            'categories'=>$categories,
            'navigational'=>$navigational]);
    }
    public function about(){
        // category_menu
        $categories = DB::table('categories')->select('*')->get();
        $navigational = "about";
        return view('about_us',['categories'=>$categories,'navigational'=>$navigational]);
    }
    public function get_all_view(){
        $news = DB::table('news')->select('*')->get();
        $authors = DB::table('users')
        ->join('news', 'users.id', '=', 'news.id_user')
        ->select('users.*')
        ->distinct()
        ->get();
        $categories = DB::table('categories')->select('*')->get();
        $navigational = "all";
        return view('all_news',[
            'news'=>$news,
            'categories'=>$categories,
            'authors' => $authors, 
            'navigational'=>$navigational,
            'filterCategories' => [],
            'filterDates' => [],
            'filterAuthors' => [],
            'checked' => true
        ]);
    }
    public function get_id($id){
        $news = DB::table('news')->select('*')->where('id',$id)->first();
        // category_menu
        $categories = DB::table('categories')->select('*')->get();
        // comments
        $comments = DB::table('comments')->select('*')->where('id_news',$news->id)->orderBy('created_at','desc')->get();
        // reply comments
        $reply_comments = DB::table('reply_comments')->select('*')->where('id_news',$news->id)->get();
        // filter comments
        $filter_comments = DB::table('filter_comments')->get();
        // users
        $users = DB::table('users')->get();
        // author
        $author = DB::table('users')->where('id',$news->id_user)->first();

        $id_category = $news->category;
        $news_category = DB::table('news')->select('*')->where('category',$id_category)->get();
        $navigational = "";
        if(Auth::check()){
            DB::table('histories')->insert([
                'title' => $news->title,
                'image' => $news->image,
                'id_user' => Auth::user()->id,
                'id_news' => $news->id
            ]);
        }
        return view('news_detail',[
            'news'=>$news,
            'author'=>$author,
            'categories'=>$categories,
            'news_category'=>$news_category,
            'comments'=>$comments,
            'reply_comments'=>$reply_comments,
            'filter_comments'=>$filter_comments,
            'users'=>$users,
            'navigational'=>$navigational]);
    }
    public function get_news_search(){
        $content = request()->input('content');
        $news = DB::table('news')
        ->select('*')
        ->where('title','like','%'.$content.'%')
        ->orWhere('keywords', 'like', '%' . $content . '%')
        ->get();
        // category_menu
        $categories = DB::table('categories')->select('*')->get();
        $authors = DB::table('users')
        ->join('news', 'users.id', '=', 'news.id_user')
        ->select('users.*')
        ->distinct()
        ->get();
        $navigational = "";
        $value_search = $content;
        return view('search',[
            'news'=>$news,
            'categories'=>$categories,
            'navigational'=>$navigational, 
            'value_search'=>$value_search,
            'filterCategories'=> [],
            'filterDates'=> [],
            'filterAuthors'=> [],
            'authors'=> $authors,
            "checked" => true
        ]);
    }
    public function list(){
        $news = DB::table('news')->orderBy('id','desc')->get();
        // authors
        $authors = DB::table('users')->get();
        $display = "news.list";
        return view('admin.news', [
            'news'=>$news,
            'authors'=>$authors, 
            'display' => $display,
            'focus'=> request()->query('focus')
        ]);
    }

    public function create(){
        $categories = DB::table('categories')->get();
        $display = "news.create";
        return view('admin.news', ['display' => $display,'categories'=> $categories]);
    }

    public function delete($id) {
        DB::table('reply_comments')->where('id_news',$id)->delete();
        DB::table('comments')->where('id_news',$id)->delete();
        DB::table('histories')->where('id_news',$id)->delete();
        $user = DB::table('news')->where('id', $id)->delete();
        return redirect()->route('news.list')->with('success','Đã xóa thành công!');
    }

    public function update($id){
        $news = DB::table('news')->where('id',$id)->first();
        // author
        $author = DB::table('users')->where('id',$news->id_user)->first();
        $categories = DB::table('categories')->get();
        $display = "news.update";
        return view('admin.news', [
            'news' => $news, 
            'author' => $author, 
            'display' => $display,
            'categories'=> $categories
    ]);
    }
    public function admin_update(validate $request,$id){
        $validated = $request->validated();

        $author = $request->input('author') ?? 'Ẩn danh';
        $news = DB::table('news')->where('id',$id)->first();
        $oldImage = $news->image;
        if ($request->hasFile('image')) {
            if ($oldImage && file_exists(public_path('images/' . $oldImage))) {
                unlink(public_path('images/' . $oldImage));
            }
            $file = $request->file('image');
            $filename = time() . '_' . $file->getClientOriginalName();
            $file->move(public_path('images'), $filename);
        } else {
            $filename = $news->image;
        }
        DB::table('news')->where('id',$id)->update([
            'title' => $request->input('title'),
            'keywords' => $request->input('keywords'),
            'category' => $request->input('category'),
            'image' => $filename,
            'description' => $request->input('description'),
            'content' => $request->input('content'),
        ]);
    
        return redirect()->route('news.list')->with('success', 'Cập nhật tin tức thành công!');
    }
    public function admin_create(validate $request) {
        $request->validated();

        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $filename = time() . '_' . $file->getClientOriginalName();
            $file->move(public_path('images'), $filename);
        } else {
            $filename = null;
        }
        DB::table('news')->insert([
            'title' => $request->input('title'),
            'keywords' => $request->input('keywords'),
            'category' => $request->input('category'),
            'image' => $filename,
            'description' => $request->input('description'),
            'content' => $request->input('content'),
            'id_user' => Auth::user()->id,
        ]);
    
        return redirect()->route('news.list')->with('success', 'Thêm tin tức thành công!');
    }
}
