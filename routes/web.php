<?php
use App\Http\Controllers\CommentController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\NewsController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\FilterController;
use App\Http\Controllers\HistoryController;
use App\Http\Controllers\CategoryController;

Route::get('/',[NewsController::class,'get'])->name('index');

Route::get('/about', [NewsController::class,'about'])->name('about');

Route::get('/news/{id}', [NewsController::class,'get_id'])->name('news');

Route::get('/search',[NewsController::class,'get_news_search'])->name('search');
Route::post('/search',[FilterController::class,'get_filter_search']);

Route::get('/category/{id}',[CategoryController::class,'get_news_category'])->name('category');

Route::get('/all',[NewsController::class,'get_all_view'])->name('all');
Route::post('/all',[FilterController::class,'get_filter_all']);

Route::get('/account',[UserController::class,'account'])->name('account')->middleware('auth');
Route::post('/account',[UserController::class,'account_update']);

Route::get('/history',[HistoryController::class,'get'])->name('history')->middleware('auth');
Route::get('/history/delete/{id}',[HistoryController::class,'delete'])->name('history.delete')->middleware('auth');
Route::post('/history/delete/all',[HistoryController::class,'delete_all'])->name('history.delete_all')->middleware('auth');

Route::middleware(['checkRoleMiddleware'])->group(function () {
    //Admin category
    Route::get('/admin/category/list',[CategoryController::class,'list'])->name('category.list');

    Route::get('/admin/category/delete/{id}',[CategoryController::class,'delete'])->name('category.delete');

    Route::get('/admin/category/update/{id}',[CategoryController::class,'update'])->name('category.update');
    Route::post('/admin/category/update/{id}',[CategoryController::class,'admin_update']);

    Route::get('/admin/category/create',[CategoryController::class,'create'])->name('category.create');
    Route::post('/admin/category/create',[CategoryController::class,'admin_create']);
    //Admin news
    Route::get('/admin/news/list',[NewsController::class,'list'])->name('news.list');

    Route::get('/admin/news/delete/{id}',[NewsController::class,'delete'])->name('news.delete');

    Route::get('/admin/news/update/{id}',[NewsController::class,'update'])->name('news.update');
    Route::post('/admin/news/update/{id}',[NewsController::class,'admin_update']);

    Route::get('/admin/news/create',[NewsController::class,'create'])->name('news.create');
    Route::post('/admin/news/create',[NewsController::class,'admin_create']);
    //Admin user
    Route::get('/admin/user/list',[UserController::class,'list'])->name('user.list');

    Route::get('/admin/user/delete/{id}',[UserController::class,'delete'])->name('user.delete');

    Route::get('/admin/user/update/{id}',[UserController::class,'update'])->name('user.update');
    Route::post('/admin/user/update/{id}',[UserController::class,'admin_update']);

    Route::get('/admin/user/create',[UserController::class,'create_view'])->name('user.create');
    Route::post('/admin/user/create',[UserController::class,'admin_create']);
    //Admin comment
    Route::get('/admin/comment/list',[CommentController::class,'comment_list'])->name('comment.list');
    Route::get('/admin/filter_comment/list',[CommentController::class,'filter_comment_list'])->name('filter_comment.list');

    Route::get('/admin/comment/delete/{id}',[CommentController::class,'admin_comment_delete'])->name('admin_comment.delete');
    Route::get('/admin/reply_comment/delete/{id}',[CommentController::class,'admin_reply_comment_delete'])->name('admin_reply_comment.delete');

    Route::get('/admin/filter_comment/delete/{id}',[CommentController::class,'admin_filter_comment_delete'])->name('admin_filter_comment.delete');

    Route::get('/admin/filter_comment/update/{id}',[CommentController::class,'update'])->name('filter_comment.update');
    Route::post('/admin/filter_comment/update/{id}',[CommentController::class,'admin_update']);

    Route::get('/admin/filter_comment/create',[CommentController::class,'create_view'])->name('filter_comment.create');
    Route::post('/admin/filter_comment/create',[CommentController::class,'admin_create']);
});

Route::get('/register',[UserController::class,'register'])->name('register');
Route::post('/register',[UserController::class,'create']);

Route::get('/login',[UserController::class,'login'])->name('login');
Route::post('/login',[UserController::class,'get_user']);

Route::get('/forgot',[UserController::class,'forgot'])->name('forgot');
Route::post('/forgot',[UserController::class,'forgot_password']);

Route::get('/password/reset/{token}', [UserController::class, 'reset_view'])->name('password.reset');
Route::post('/password/reset/{token}',[UserController::class,'reset']);

Route::get('/logout',[UserController::class,'logout'])->name('logout')->middleware('auth');

Route::post('/comment/{id}',[CommentController::class,'comment'])->name('comment');
Route::post('/reply_comment/{id}',[CommentController::class,'reply_comment'])->name('reply_comment');
Route::get('/comment/{id}/delete/{delete}',[CommentController::class,'delete_comment'])->name('comment.delete')->middleware('auth');
Route::get('/reply_comment/{id}/delete/{delete}',[CommentController::class,'delete_reply_comment'])->name('comment.reply_delete')->middleware('auth');


