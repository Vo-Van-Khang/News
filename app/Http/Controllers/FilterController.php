<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;

class FilterController extends Controller
{
    public function get_filter_all(Request $request)
    {
        $checked = true;
        // Lấy tất cả các dữ liệu từ request
        $filterCategories = $request->input('category', []);
        $filterDates = $request->input('date', []);
        $filterAuthors = $request->input('author', []);
        
        // Khởi tạo query
        $query = DB::table('news');
        
        // Lọc theo loại
        if (!empty($filterCategories)) {
            $query->whereIn('category', $filterCategories);
        }

        // Lọc theo ngày tạo
        if (!empty($filterDates)) {
            $today = now()->startOfDay();
            $weekStart = now()->startOfWeek();
            $monthStart = now()->startOfMonth();
            $yearStart = now()->startOfYear();
            $checked = false;
            if (in_array('today', $filterDates)) {
                $query->whereDate('created_at', '=', $today);
            }
            if (in_array('this_week', $filterDates)) {
                $query->whereDate('created_at', '>=', $weekStart);
            }
            if (in_array('this_month', $filterDates)) {
                $query->whereDate('created_at', '>=', $monthStart);
            }
            if (in_array('this_year', $filterDates)) {
                $query->whereDate('created_at', '>=', $yearStart);
            }
        }

        // Lọc theo tác giả
        if (!empty($filterAuthors)) {
            $query->whereIn('id_user', $filterAuthors);
        }
        
        // Thực hiện truy vấn
        $filteredNews = $query->get();

        // Lấy tất cả các danh mục và tác giả để truyền về view
        $categories = DB::table('categories')->get();
        $authors = DB::table('users')
        ->join('news', 'users.id', '=', 'news.id_user')
        ->select('users.*')
        ->distinct()
        ->get();

        // Truyền dữ liệu đến view
        return view('all_news', [
            'news' => $filteredNews,
            'categories' => $categories,
            'authors' => $authors,
            'navigational' => 'all',
            'filterCategories'=> $filterCategories,
            'filterDates'=> $filterDates,
            'checked' => $checked,
            'filterAuthors'=> $filterAuthors
        ]);
    }
    public function get_filter_search(Request $request)
    {
        $content = request()->input('search');
        $checked = true;
        // Lấy tất cả các dữ liệu từ request
        $filterCategories = $request->input('category', []);
        $filterDates = $request->input('date', []);
        $filterAuthors = $request->input('author', []);
        
        // Khởi tạo query
        $query = DB::table('news');
        
        if(!empty($content)){
            $query->where('title','LIKE','%'.$content.'%');
        }
        // Lọc theo loại
        if (!empty($filterCategories)) {
            $query->whereIn('category', $filterCategories);
        }

        // Lọc theo ngày tạo
        if (!empty($filterDates)) {
            $today = now()->startOfDay();
            $weekStart = now()->startOfWeek();
            $monthStart = now()->startOfMonth();
            $yearStart = now()->startOfYear();
            $checked = false;
            if (in_array('today', $filterDates)) {
                $query->whereDate('created_at', '=', $today);
            }
            if (in_array('this_week', $filterDates)) {
                $query->whereDate('created_at', '>=', $weekStart);
            }
            if (in_array('this_month', $filterDates)) {
                $query->whereDate('created_at', '>=', $monthStart);
            }
            if (in_array('this_year', $filterDates)) {
                $query->whereDate('created_at', '>=', $yearStart);
            }
        }

        // Lọc theo tác giả
        if (!empty($filterAuthors)) {
            $query->whereIn('id_user', $filterAuthors);
        }
        
        // Thực hiện truy vấn
        $filteredNews = $query->get();

        // Lấy tất cả các danh mục và tác giả để truyền về view
        $categories = DB::table('categories')->get();
        $authors = DB::table('users')
        ->join('news', 'users.id', '=', 'news.id_user')
        ->select('users.*')
        ->distinct()
        ->get();
        // Truyền dữ liệu đến view
        return view('search', [
            'news' => $filteredNews,
            'categories' => $categories,
            'authors' => $authors,
            'navigational' => '',
            'filterCategories'=> $filterCategories,
            'filterDates'=> $filterDates,
            'filterAuthors'=> $filterAuthors,
            'value_search' => $content,
            'checked' => $checked,
        ]);
    }
}
