<?php
/*
namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;

class RegisterController extends Controller
{
    use RegistersUsers;

    protected $redirectTo = '/test';

    public function __construct()
    {
        $this->middleware('guest');
    }
    public function register()
    {
        $email=request('email');
        $pass=Hash::make(request('password'));
        $login=request('name');
        $type=request('choices');

        $inserted = DB::insert('INSERT INTO users (email, password,name,type) VALUES (:email, :pass,:name,:type)', [
            'email' => $email,
            'pass' => $pass,
            'name' => $login,
            'type' => $type
        ]);
        return view('auth.login');

    }

    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
            'choices' => ['required', 'string'],
        ]);
    }*/

   

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class RegisterController extends Controller
{
    use RegistersUsers;

    protected $redirectTo = '/test';

    public function __construct()
    {
        $this->middleware('guest');
    }

    public function register(Request $request)
    {
        // Validate the request data
        $this->validator($request->all())->validate();

        // Get the input data
        $email = $request->input('email');
        $pass = Hash::make($request->input('password'));
        $login = $request->input('name');
        $type = $request->input('choices');

        // Insert the data into the database
        $inserted = DB::insert('INSERT INTO users (email, password, name, type) VALUES (:email, :pass, :name, :type)', [
            'email' => $email,
            'pass' => $pass,
            'name' => $login,
            'type' => $type
        ]);

        // Redirect to the login page
        return redirect()->route('login');
    }

    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name' => ['required', 'string', 'min:6','max:255','unique:users'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
            'choices' => ['required', 'string'],
        ]);
    }


    protected function create(array $data)
    {
        // Debugging statement
        \Log::info('Creating user with data: ', $data);

        return User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
            'type' => $data['choices'],
        ]);
    }
}





