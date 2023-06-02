<?php
 
namespace App\Http\Controllers;
 
use Illuminate\Http\Request;
use Hash;
use Session;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
 
class CustomAuthController extends Controller
{
 
	public function index()
	{
		return view('auth.login');
	}  
	   
 
	public function customLogin(Request $request)
	{
		$request->validate([
			'email' => 'required',
			'password' => 'required',
		]);
		
		$credentials = $request->only('email', 'password');
		if (Auth::attempt($credentials)) {
			$userID = Auth::id(); 
			$user = User::where('id',$userID)->first();
			return view('auth/dashboard')->with('user',$user);
		}
		return redirect("login")->withSuccess('Login details are not valid');
	}
 
 
 
	public function registration()
	{
		return view('auth.registration');
	}
	   
 
	public function customRegistration(Request $request)
	{  
		$request->validate([
			'firstname' => 'required',
			'lastname' => 'required',
			'email' => 'required|email|unique:users',
			'password' => 'required|min:6',
		]);
			
		$data = $request->all();
		$check = $this->create($data);
		  
		return redirect("dashboard")->withSuccess('You have signed-in');
	}
 
 
	public function create(array $data)
	{
		return User::create([
			'firstname' => $data['firstname'],
			'lastname' => $data['lastname'],
			'email' => $data['email'],
			'password' => Hash::make($data['password'])
		]);
		//return redirect("login")->withSuccess('Your Account has been created');
		return redirect()->route('login')->with('success','Your Account Has Been created successfully');
	}    
	public function dashboard()
	{
		if(Auth::check()){
			return view('auth.dashboard');
		}
		return redirect("login")->withSuccess('You are not allowed to access');
	}
	 
 
	public function signOut() {
		Session::flush();
		Auth::logout();
   
		return Redirect('login');
	}
	
}