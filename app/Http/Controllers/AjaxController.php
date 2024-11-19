<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;

class AjaxController extends Controller
{
    public function comments($id){
        $comments = DB::table("comments")->where('id_news',$id)->orderBy('created_at','desc')->get(); 
        $reply_comments = DB::table("reply_comments")->where('id_news',$id)->get(); 
        $users = DB::table("users")->get(); 
        return response()->json([
            'comments' => $comments,
            'reply_comments' => $reply_comments,
            'users' => $users,
            'auth_user_id' => auth()->id() // Trả về ID người dùng hiện tại để so sánh quyền
        ]);
    }
}
