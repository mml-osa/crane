<?php

namespace App\Http\Controllers\Admin\Auth;

use App\Http\Controllers\Controller;
use App\Models\Auth\CcUserProfile;
use App\Models\Pages\CcPage;
use App\Models\Pages\CcPagesCategory;
use App\Models\Profile\CcAbout;
use App\Models\Profile\CcAddress;
use App\Models\Profile\CcEmail;
use App\Models\Profile\CcPhone;
use App\Models\Select\CcCountry;
use App\Models\Select\CcRole;
use App\Models\Select\CcVisibility;
use App\Providers\RouteServiceProvider;
use App\Models\Auth\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Contracts\Auth\Authenticatable;

class RegisterController extends Controller
{
  /*
  |--------------------------------------------------------------------------
  | Register Controller
  |--------------------------------------------------------------------------
  |
  | This controller handles the registration of new users as well as their
  | validation and creation. By default this controller uses a trait to
  | provide this functionality without requiring any additional code.
  |
  */

  use RegistersUsers;

  /**
   * Where to redirect users after registration.
   *
   * @var string
   */
  protected $redirectTo = RouteServiceProvider::HOME;

  /**
   * Create a new controller instance.
   *
   * @return void
   */
  public function __construct()
  {
    $this->middleware('guest');
  }

  /**
   * Show the application registration form.
   *
   * @return \Illuminate\View\View
   */
  public function showRegistrationForm()
  {
    $roles = CcRole::where('alias','administrator')->first();
    $countries = CcCountry::all()->sortBy('country_name');
    $User = \App\Models\Auth\User::first();
    if ($User != null) {
      return redirect(route('login'));
    } else {
      return view('admin.auth.register')
        ->with('roles', $roles)
        ->with('countries', $countries);
    }
  }

  /**
   * Handle a registration request for the application.
   *
   * @param \Illuminate\Http\Request $request
   * @return \Illuminate\Http\Response
   */
  public function register(Request $request)
  {
    $this->validator($request->all())->validate();
    event(new Registered($user = $this->create($request->all())));
    $userProfile = CcUserProfile::create([
      'user_id' => $user->id,
      'first_name' => $request['first_name'],
      'last_name' => $request['last_name'],
      'create_id' => $user->id,
    ]);

    if ($userProfile){
      $alias = strtolower(preg_replace('/\s+/', '-', $request->organization_name));
      $about = CcAbout::create([
        'title' => $request->organization_name,
        'alias' => $alias,
        'create_id' => $user->id,
      ]);
    }else{
      return redirect()->back()->withErrors('Error setting up account. Please check Organization Name input field and try again!');
    }

    if ($about){
      $alias = strtolower(preg_replace('/\s+/', '-', $request->organization_name));
      $email = CcEmail::create([
        'title' => 'Main',
        'alias' => 'main',
        'email' => $request->email,
        'main' => 1,
        'mail' => 1,
        'published' => 1,
        'create_id' => $user->id,
      ]);
    }else{
      return redirect()->back()->withErrors('Error setting up account. Please check Organization Email input field and try again!');
    }

    if ($email){
      $address = CcAddress::create([
        'title' => 'Main',
        'alias' => 'main',
        'address' => $request->address,
        'postal' => $request->postal,
        'city' => $request->city,
        'country' => $request->country,
        'main' => 1,
        'published' => 1,
        'create_id' => $user->id,
      ]);
    }else{
      return redirect()->back()->withErrors('Error setting up account. Please check Address input field and try again!');
    }

    if ($address){
      $phone = CcPhone::create([
        'title' => 'Main',
        'alias' => 'main',
        'phone' => $request->phone,
        'main' => 1,
        'published' => 1,
        'create_id' => $user->id,
      ]);
    }else{
      return redirect()->back()->withErrors('Error setting up account. Please check Phone input field and try again!');
    }

    if ($phone){
      CcPagesCategory::where('alias','general')->update(['create_id'=>$user->id]);
      CcPage::where('alias','home')->update(['create_id'=>$user->id]);
    }

    $this->guard()->login($user);
    if ($response = $this->registered($request, $user)) {
      return $response;
    }
    return $request->wantsJson()
      ? new Response('', 201)
      : redirect($this->redirectPath());
  }

  /**
   * Get the guard to be used during registration.
   *
   * @return \Illuminate\Contracts\Auth\StatefulGuard
   */
  protected function guard()
  {
    return Auth::guard();
  }

  /**
   * The user has been registered.
   *
   * @param \Illuminate\Http\Request $request
   * @param mixed $user
   * @return mixed
   */
  protected function registered(Request $request, $user)
  {
    //
  }

  /**
   * Get a validator for an incoming registration request.
   *
   * @param array $data
   * @return \Illuminate\Contracts\Validation\Validator
   */
  protected function validator(array $data)
  {
    return Validator::make($data, [
      'username' => ['required', 'string', 'max:255'],
      'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
      'password' => ['required', 'string', 'min:8', 'confirmed'],
    ]);
  }

  /**
   * Create a new user instance after a valid registration.
   *
   * @param array $data
   * @return \App\Models\Auth\
   */
  protected function create(array $data)
  {
    $User = User::all();
    return User::create([
      'username' => $data['username'],
      'email' => $data['email'],
      'password' => Hash::make($data['password']),
      'active' => 1,
      'role_id' => $data['role_id'],
    ]);
  }
}
