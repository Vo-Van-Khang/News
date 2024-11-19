<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\validate;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class CommentController extends Controller
{
    public function comment(validate $request,$id){
        $request->validated();
        $comment = DB::table("comments")->insert([
            "id_user" => Auth::user()->id,
            "content" => $request->comment,
            "id_news" => $id,
        ]);
        return response()->json([
            'success' => true
        ]);
    }
    public function reply_comment(validate $request,$id){
        $request->validated();
        $comment = DB::table("reply_comments")->insert([
            "id_user" => Auth::user()->id,
            "content" => $request->comment,
            "id_news" => $id,
            "id_comment" => $request->id_comment,
            "name_reply" => $request->name_reply,
        ]);
        return response()->json([
            'success' => true
        ]);
    }
    public function delete_comment($id, $delete){
        DB::table("reply_comments")->where("id_comment", $delete)->delete();
        DB::table("comments")->where("id", $delete)->delete();
        return response()->json([
            'success'=>true
        ]);
    }
    public function delete_reply_comment($id, $delete){
        DB::table("reply_comments")->where("id", $delete)->delete();
        return redirect()->route('news', $id)->with("success","xóa bình luận thành công!");
    }

    public function comment_list(){
        $comments = DB::table("comments")->orderBy('created_at','desc')->get(); 
        $reply_comments = DB::table("reply_comments")->get(); 
        return view('admin.comment',['comments'=>$comments,'reply_comments'=>$reply_comments,'display'=>'comment.list']);
    }
    public function filter_comment_list(){
        $filter_comments = DB::table("filter_comments")->orderBy('created_at','desc')->get();  
        return view('admin.comment',['filter_comments'=>$filter_comments, 'display'=>'filter_comment.list']);
    }
    public function admin_comment_delete($id){
        DB::table("reply_comments")->where("id_comment", $id)->delete();
        DB::table("comments")->where("id", $id)->delete();
        return redirect()->route('comment.list')->with("success","xóa bình luận thành công!");
    }
    public function admin_reply_comment_delete($id){
        DB::table("reply_comments")->where("id", $id)->delete();
        return redirect()->route('comment.list')->with("success","xóa bình luận thành công!");
    }
    public function admin_filter_comment_delete($id){
        DB::table("filter_comments")->where("id", $id)->delete();
        return redirect()->route('filter_comment.list')->with("success","xóa lọc bình luận thành công!");
    }

    public function create_view(){
        return view('admin.comment',['display'=>'filter_comment.create']);
    }
    public function update($id){
        $filter_comment = DB::table('filter_comments')->where('id',$id)->first();
        return view('admin.comment',['filter_comment'=>$filter_comment, 'display'=>'filter_comment.update']);
    }
    public function admin_create(validate $request){
        $request->validated();
        DB::table("filter_comments")->insert([
            'content' => $request->filter_comment,
            'id_user'=> Auth::user()->id
        ]);
        return redirect()->route('filter_comment.list')->with("success","Thêm lọc bình luận thành công!");
    }
    public function admin_update(validate $request,$id){
        $request->validated();
        DB::table("filter_comments")->where('id',$id)->update([
            'content' => $request->filter_comment
        ]);
        return redirect()->route('filter_comment.list')->with("success","Cập nhật lọc bình luận thành công!");
    }
}
