<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\validate;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Password;

class UserController extends Controller
{
 
    public function register(){
        return view('auth.register');
    }
    public function login(){
        return view('auth.login');
    }
    public function forgot(){
        return view('auth.password.forgot_password');
    }
    public function forgot_password(validate $request){
       // Xác thực địa chỉ email
       $request->validated();

       // Gửi liên kết đặt lại mật khẩu
       $response = Password::sendResetLink($request->only('email'));

       // Kiểm tra phản hồi và trả về thông báo tương ứng
        switch ($response) {
        case Password::RESET_LINK_SENT:
            $message = 'Chúng tôi đã gửi liên kết đặt lại mật khẩu qua email!';
            return back()->with('success', $message);
        case Password::INVALID_USER:
            $message = 'Không tìm thấy người dùng với địa chỉ email này.';
            return back()->withErrors(['email' => $message]);
        case Password::RESET_THROTTLED:
            $message = 'Vui lòng chờ trước khi thử lại.';
            return back()->withErrors(['email' => $message]);
        default:
            $message = 'Đã xảy ra lỗi, vui lòng thử lại sau.';
            return back()->withErrors(['email' => $message]);
        }
    }
    public function reset_view(Request $request, $token = null)
    {
        return view('auth.password.reset')->with(
            ['token' => $token, 'email' => $request->email]
        );
    }
    public function reset(validate $request){
    $request->validate([
        'password' => 'required|confirmed|min:8',
    ],[
        'password.required' => 'Mật khẩu là bắt buộc.',
        'password.confirmed' => 'Mật khẩu của bạn không khớp nhau.',
        'password.min' => 'Mật khẩu phải có ít nhất 8 ký tự.',
    ]);

    // Tìm người dùng theo email
    $user = DB::table('users')->where('email', $request->email)->first();

    if (!$user) {
        return back()->withErrors(['email' => 'Email không tồn tại.']);
    }

    // Cập nhật mật khẩu mới cho người dùng
    $updated = DB::table('users')
        ->where('email', $request->email)
        ->update(['password' => Hash::make($request->password)]);

    if ($updated) {
        // Xóa token reset password nếu cần
        DB::table('password_reset_tokens')->where('email', $request->email)->delete();

        return redirect()->route('login')->with('success', 'Mật khẩu đã được đặt lại thành công!');
    } else {
        return back()->withErrors(['email' => 'Có lỗi xảy ra khi đặt lại mật khẩu.']);
    }
}
    public function account(){
        return view('auth.account',['navigation' => 'information']);
    }
    public function account_update(validate $request){
        $request->validated();
        // $user = DB::table('users')->where('id',Auth::user()->id)->first();
        $oldImage = Auth::user()->image;
        if ($request->hasFile('image')) {
            if ($oldImage && file_exists(public_path('images/' . $oldImage))) {
                unlink(public_path('images/' . $oldImage));
            }
            $file = $request->file('image');
            $filename = time() . '_' . $file->getClientOriginalName();
            $file->move(public_path('images'), $filename);
        } else {
            $filename = Auth::user()->image;
        }
        $user = DB::table('users')->where('id',Auth::user()->id)->update([
            "name" => $request->name,
            "image" => $filename,
        ]);
        return redirect()->route('account')->with('success','Cập nhật thành công');
    }
    public function create(){
        $validated = request()->validate([
            'username' => 'required|min:3|max:40',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|confirmed|min:8',
            'image' => "sometimes|mimes:jpeg,png,jpg,gif,svg,webp|max:2048"
        ],[
            'username.required' => 'Tên là bắt buộc.',
            'username.min' => 'Tên phải nhiều hơn 3 kí tự.',
            'username.max' => 'Tên phải ít hơn 40 kí tự.',
            'email.required' => 'Email là bắt buộc.',
            'email.email' => 'Không đúng định dạng email.',
            'email.unique' => 'Email đã tồn tại.',
            'password.required' => 'Mật khẩu là bắt buộc.',
            'password.confirmed' => 'Mật khẩu của bạn không khớp nhau.',
            'password.min' => 'Mật khẩu phải có ít nhất 8 ký tự.',
            'image.mimes' => 'Hình ảnh phải thuộc loại: jpeg, png, jpg, gif, svg, webp.',
            'image.max' => 'Kích thước hình ảnh không vượt quá 2048 kb.',
        ]);

        $hashedPassword = Hash::make($validated['password']);
        if (request()->hasFile('image')) {
            $file = request()->file('image');
            $filename = time() . '_' . $file->getClientOriginalName();
            $file->move(public_path('images'), $filename);
        } else {
            $filename = null;
        }
        DB::table('users')->insert([
            'name' => $validated['username'],
            'email' => $validated['email'],
            'password' => $hashedPassword,
            'image'=> $filename,
            'role' => 'guest'
        ]);

        return redirect()->route('login')->with('success','Đăng kí thành công!');
    }

    public function get_user(validate $request){
        $validated = $request->validated();

        if(auth()->attempt($validated)){
            request()->session()->regenerate();
            return redirect()->route('index')->with('success','Đăng nhập thành công!');
        }
        $email = request()->input('email');
        $password = request()->input('password');
        
        $user = DB::table('users')->where('email',$email)->first();
        if($user != null){
            if($password !== $user->password){
                return redirect()->route('login')->with('error','Mật khẩu không chính xác!')->withInput();
            }
        }else{
            return redirect()->route('login')->with('error','Email không tồn tại!')->withInput();
        }
    }

    public function logout()
    {
        Auth::logout();

        request()->session()->regenerateToken();  
        request()->session()->invalidate();

        return redirect()->route('index')->with('success','Đăng xuất thành công!'); 
    }

    public function list(){
        $users = DB::table('users')->orderBy('id','desc')->get();
        $display = "user.list";
        return view('admin.user', ['users'=>$users, 'display' => $display, 'focus'=> request()->query('focus')]);
    }

    public function create_view(){
        $display = "user.create";
        return view('admin.user', ['display' => $display]);
    }

    public function delete($id) {
        DB::table('reply_comments')->where('id_user', $id)->delete();
        DB::table('comments')->where('id_user', $id)->delete();
        DB::table('histories')->where('id_user', $id)->delete();
        $user = DB::table('users')->where('id', $id)->delete();
        return redirect()->route('user.list')->with('success','Đã xóa thành công!');
    }

    public function update($id){
        $user = DB::table('users')->where('id', $id)->first();
        $display = "user.update";
        return view('admin.user',['user' => $user, 'display' => $display]);
    }
    public function admin_update(validate $request, $id){
        $validated = $request->validated();

        $user = DB::table('users')->where('id',$id)->first();
        $oldImage = $user->image;
        if ($request->hasFile('image')) {
            if ($oldImage && file_exists(public_path('images/' . $oldImage))) {
                unlink(public_path('images/' . $oldImage));
            }
            $file = $request->file('image');
            $filename = time() . '_' . $file->getClientOriginalName();
            $file->move(public_path('images'), $filename);
        } else {
            $filename = $user->image;
        }
        if($user->role === 'admin'){
            $user = DB::table('users')->where('id', $id)->update([
                'name'=>$request->input('name'),
                'image'=>$filename
            ]);
        }else{
            $user = DB::table('users')->where('id', $id)->update([
                'name'=>$request->input('name'),
                'image'=>$filename,
                'role' => $request->input('role'),
            ]);
        }
        return redirect()->route('user.list')->with('success','Cập nhật thành công!');
    }
    public function admin_create(validate $request) {
        $emailExists = DB::table('users')->where('email', $request->input('email'))->exists();
        if ($emailExists) {
            return redirect()->back()->withErrors(['email' => 'Email này đã được sử dụng.'])->withInput();
        }

        $validated = $request->validated();
        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $filename = time() . '_' . $file->getClientOriginalName();
            $file->move(public_path('images'), $filename);
        } else {
            $filename = null;
        }
    
        DB::table('users')->insert([
            'name' => $request->input('name'),
            'email' => $request->input('email'),
            'password' => bcrypt($request->input('password')),
            'image' => $filename,
            'role' => $request->input('role')
        ]);
    
        return redirect()->route('user.list')->with('success', 'Thêm người dùng thành công!');
    }
    
}
