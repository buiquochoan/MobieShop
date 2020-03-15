<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Socialite;
use App\Models\User;
use Auth;
use Validator;
use Illuminate\Support\Facades\Hash;

class HomeController extends Controller
{
    //
    public function redirectProvider($social)
    {
    	# code...
    	return Socialite::driver($social)->redirect();
    }
    public function handleProviderCallback($social)
    {
    	# code...
    	$user = Socialite::driver($social)->user();
    	$authUser = $this->findOrCreateUser($user);
    	Auth::login($authUser);
    	return redirect('/');
    }
    private function findOrCreateUser($user){
    	$authUser = User::where('social_id',$user->id)->first();
    	if($authUser){
    		return $authUser;
    	}else{
    		return User::create([
    			'name' => $user->name,
    			'email' => $user->email,
    			'password' => '',
    			'social_id' => $user->id,
    			'ruler' => 0,
    			'status' => 0,
    			'avatar' => $user->avatar,
    		]);
    	}

    }
    public function logout(){
    	if(Auth::check()){
    		Auth::logout();
    		return redirect('/');
    	}
    }
    public function register(Request $request){
    	$validator = Validator::make($request->all(), [
            'name' => 'required|min:2|max:255|unique:users',
            'email' => 'required|email|min:2|max:255',
            'password' => 'required',
            're_password' => 'required|same:password'
        ],
        [
            'min' => ':attribute phải từ 2 đến 255 ký tự',
            'max' => ':attribute phải từ 2 đến 255 ký tự',
            'unique' => ':attribute đã được sử dụng',
            'required' => ':attribute không được để trống',
            'email' => ':attribute phải đúng định dạng email',
            're_password.same' => 'Nhập lại không trùng mật khẩu'
        ],
        [
             'name' => 'Tên đăng nhập',   
             'email'=>'Email',
             'password' => 'Mật khẩu',
        ]);
        if ($validator->fails()) {
            return back()->withErrors($validator, 'register')->withInput();
        }
        $data = $request->all();
        $data['password'] = Hash::make($request->password);
        if(User::create($data)){
        	return back()->with('thongBao','Đăng ký thành công');
        }else{
        	return back()->with('thongBao','Đăng ký thất bại');
        }
    }
}