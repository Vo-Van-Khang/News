<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class HistoryController extends Controller
{
    public function get(){
        $histories = DB::table("histories")->where('id_user',Auth::user()->id)->orderBy('created_at','desc')->get();
        return view('auth.history',['histories'=>$histories,'navigation' => 'history']);
    }
    public function delete($id){
        DB::table('histories')->where('id',$id)->delete();
        return redirect()->route('history')->with('success','Đã xóa lịch sử thành công!');
    }
    public function delete_all(Request $request){

        $deletes = $request->input('id', []);
        if (is_array($deletes) && !empty($deletes)) {
            DB::table('histories')->whereIn('id', $deletes)->delete();
            return redirect()->route('history')->with('success', 'Đã xóa lịch sử thành công!');
        }

        return redirect()->route('history')->with('error', 'Không có lịch sử nào đã chọn để xóa.');
    }

    
}
