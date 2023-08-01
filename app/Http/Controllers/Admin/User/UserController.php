<?php
   
   namespace App\Http\Controllers\Admin\User;
   
   use App\Http\Controllers\Controller;
   use App\Models\Auth\User;
   use App\Models\Auth\CcUserProfile;
   use App\Models\Select\CcRole;
   use Illuminate\Http\Request;
   use Illuminate\Support\Facades\Auth;
   use Illuminate\Support\Facades\File;
   use Illuminate\Support\Facades\Hash;
   use Illuminate\Support\Facades\Storage;
   use Illuminate\Support\Facades\Validator;
   
   class UserController extends Controller
   {
      /**
       * Create a new controller instance.
       *
       * @return void
       */
      public function __construct()
      {
         $this->middleware('auth');
      }
      
      /**
       * Display a listing of the resource.
       *
       * @return \Illuminate\Http\Response
       */
      public function index()
      {
         try {
            $characters = '0123456789`~@#$%^&*()_+-=[]\|}{?/;.><abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
            $charactersLength = strlen($characters);
            $randomString = '';
            for ($i = 0; $i < 25; $i++) {
               $randomString .= $characters[rand(0, $charactersLength - 1)];
            }
            $session = Auth::user();
            $User = User::ordered();
            $UserProfile = CcUserProfile::ordered();
            $CcRole = CcRole::ordered();
            return view('admin.users.index')
               ->with('users', $User)
               ->with('profiles', $UserProfile)
               ->with('session', $session)
               ->with('roles', $CcRole)
               ->with('randstring', $randomString);
         } catch (\Exception $e) {
            return redirect()->back()->with("error", "Manage users page not loading properly");
         }
      }
      
      /**
       * Show the form for profile.
       *
       * @param int $id
       * @return \Illuminate\Http\Response
       */
      public function profile($id)
      {
         try {
            $session = Auth::user();
            $User = User::findOrFail($id);
            $UserProfile = CcUserProfile::where('user_id', $id)->first();
            $CcRole = CcRole::ordered();
            return view('admin.users.profile')
               ->with('user', $User)
               ->with('profile', $UserProfile)
               ->with('session', $session)
               ->with('roles', $CcRole);
         } catch (\Exception $e) {
            return redirect()->back()->with("error", "User profile page not loading properly");
         }
      }
      
      /**
       * Show the form for profile.
       *
       * @param int $id
       * @return \Illuminate\Http\Response
       */
      public function avatar(Request $request, $id)
      {
         try {
            $UserProfile = CcUserProfile::where('user_id', $id)->first();
            $avatar = $request->avatar;
            $session = Auth::user();
            
            if ($request->hasFile('avatar')) {
               //Validate image type
               $fileArray = array('avatar' => $avatar);
               $rules = array('avatar' => 'mimes:jpeg,jpg,png,gif|required|max:1000'); // max 10000kb);
               $validator = Validator::make($fileArray, $rules);
               if ($validator->fails()) {
                  // Redirect or return json to frontend with a helpful message to inform the user
                  // that the provided file was not an adequate type
                  return redirect()->back()->with("error", "Image type not supported. Supported files are JPEG,JPG,PNG and GIF ONLY!");
               } else {
                  $path = storage_path("app/public/user/avatar/$UserProfile->avatar");
                  if (File::exists($path)) {
                     Storage::delete("public/user/avatar/$UserProfile->avatar");
                  }
                  //Get Filename With The Extension
                  $filenameWithExt = $avatar->getClientOriginalName();
                  //Get Just Filename
                  $fileName = pathinfo($filenameWithExt, PATHINFO_FILENAME);
                  //Get Just Extension
                  $fileExtension = $avatar->getClientOriginalExtension();
                  //Filename To Store
                  $fileNameToStore = 'AVA' . '-' . $UserProfile->user['username'] . '-' . time() . '.' . $fileExtension;
                  //Upload Image
                  $path = $avatar->storeAs("public/user/avatar/", $fileNameToStore);
                  $UserProfile->update(['avatar' => $fileNameToStore, 'update_id' => $session->id]);
               }
            } else {
               return redirect("admin/users/profile/$id#tab_2-2")->with("error", "No image detected!");
            }
            return redirect("admin/users/profile/$id#tab_2-2")->with("success", "Avatar was updated successfully");
         } catch (\Exception $e) {
            return redirect("admin/users/profile/$id#tab_2-2")->with("error", "There was a problem updating user avatar");
         }
      }
      
      /**
       * Display a listing of the resource.
       * @param \Illuminate\Http\Request $request
       * @param int $id
       * @return \Illuminate\Http\RedirectResponse
       */
      public function password(Request $request, $id)
      {
         $request->validate($this->rules());
         try {
            $session = Auth::user();
            $password = $request->password;
            $current_password = $request->current_password;
            $password_confirmation = $request->password_confirmation;
            $password_hash = Hash::make($password);
            $User = User::findOrFail($id);
            $password_compare = $User['password'];
            if (!Hash::check($current_password, $password_compare)) {
               return redirect("admin/users/profile/$id#tab_3-3")->withErrors(['current_password' => 'Current Password entered is not correct!']);
            } elseif ($password != $password_confirmation) {
               return redirect("admin/users/profile/$id#tab_3-3")->withErrors(['password_confirmation' => 'New Password and Confirm Password do not match.']);
            } elseif ($password == $current_password) {
               return redirect("admin/users/profile/$id#tab_3-3")->withErrors(['password' => 'New Password and Current Password cannot be the same.']);
            } elseif (strlen($password) < 8) {
               return redirect("admin/users/profile/$id#tab_3-3")->withErrors(['password' => 'New Password cannot be less than 8 characters.']);
            } else {
               $User->update(['password' => $password_hash, 'update_id' => $session->id]);
               return redirect("admin/users/profile/$id#tab_3-3")->with('success', 'Your password has been updated successfully.');
            }
         } catch (\Exception $e) {
            return redirect("admin/users/profile/$id#tab_3-3")->with("error", "There was a problem updating your password");
         }
      }
      
      /**
       * Get the password reset validation rules.
       *
       * @return array
       */
      protected function rules()
      {
         return [
            'current_password' => ['required', 'string'],
            'password' => ['required', 'string'],
            'password_confirmation' => ['required', 'string']
         ];
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
            'username' => ['required', 'string', 'max:191'],
            'email' => ['required', 'string', 'email', 'max:191', 'unique:users', 'unique:admins'],
         ]);
      }
      
      /**
       * Store a newly created resource in storage.
       *
       * @param \Illuminate\Http\Request $request
       * @return \Illuminate\Http\Response
       */
      public function store(Request $request)
      {
         try {
            $session = Auth::user();
//            dd($request->password);
            if ($session->userRole['alias'] != 'administrator') {
               return redirect()->back()->with("error", "Sorry, you must be an administrator to be able to add user account. Contact your systems administrator");
            } else {
               $password = Hash::make($request->password);
               $request->merge(['password' => $password, 'create_id' => $session->id, 'update_id' => $session->id]);
               $User = User::create($request->all());
               if ($User) {
                  $user_id = $User->id;
                  $request->merge(['user_id' => $user_id, 'create_id' => $session->id, 'update_id' => $session->id]);
                  $usersProfile = CcUserProfile::create($request->all());
               }
               return redirect()->back()->with('success', 'User account has been created successfully!');
            }
         } catch (\Exception $e) {
            return redirect()->back()->withInput($request->all())->with("error", "There was a problem creating user account");
         }
      }
      
      /**
       * Activate category from storage.
       *
       * @param \Illuminate\Http\Request $request
       *
       * @return \Illuminate\Http\RedirectResponse
       */
      public function active(Request $request, $id)
      {
         try {
            $session = Auth::user();
            if ($session->userRole['alias'] != 'administrator') {
               return redirect()->back()->with("error", "Sorry, you must be an administrator to be able to update user account active status. Contact your systems administrator");
            } else {
               $request->merge(['update_id' => $session->id]);
               if ($request->switch == 1) {
                  $active = "activated";
               } else {
                  $active = "deactivated";
               }
               $User = User::findOrFail($id)->update(['active' => $request->switch]);
               return redirect()->back()->with("success", "User account $active successfully");
            }
         } catch (\Exception $e) {
            return redirect()->back()->with("error", "There was a problem updating user account status post");
         }
      }
      
      /**
       * Update the specified resource in storage.
       *
       * @param \Illuminate\Http\Request $request
       * @param int $id
       * @return \Illuminate\Http\Response
       */
      public function update(Request $request, $id)
      {
         try {
            $session = Auth::user();
            if ($session->userRole['alias'] != 'administrator') {
               return redirect()->back()->with("error", "Sorry, you must be an administrator to be able to update user account. Contact your systems administrator");
            } else {
               if ($id == $session->id && $request->email != $session->email) {
                  $this->validator($request->all())->validate();
               }
               $request->merge(['update_id' => $session->id]);
               $userUpdate = User::findOrFail($id)->update($request->all());
               $usersProfilesUpdate = CcUserProfile::where('user_id', $id)->first()->update($request->all());
               return redirect("admin/users/profile/$id#tab_1-1")->with("success", "User account updated successfully.");
            }
         } catch (\Exception $e) {
            redirect("admin/users/profile/$id#tab_1-1")->with("error", "There was a problem updating your account");
         }
      }
      
      /**
       * Update the specified resource in storage.
       *
       * @param \Illuminate\Http\Request $request
       * @param int $id
       * @return \Illuminate\Http\RedirectResponse
       */
      public function role(Request $request, $id)
      {
         try {
            $userSession = Auth::user();
            if ($userSession->userRole['alias'] != 'administrator') {
               return redirect()->back()->with("error", "Sorry, you must be an administrator to be able to update user account role. Contact your systems administrator");
            } else {
               $request->merge(['role_id' => $request->role_id, 'update_id' => $userSession->id]);
               $User = User::where('id', $id)->update(['role_id' => $request->role_id]);
               return redirect("admin/users/profile/$id#tab_4-4")->with("success", "User account role updated successfully.");
            }
         } catch (\Exception $e) {
            return redirect("admin/users/profile/$id#tab_4-4")->with("error", "There was a problem updating your user account role");
         }
      }
      
      /**
       * Remove the specified resource from storage.
       *
       * @param int $id
       * @return \Illuminate\Http\Response
       */
      public function destroy($id)
      {
         try {
            $userSession = Auth::user();
            if ($userSession->userRole['alias'] != 'administrator') {
               return redirect()->back()->with("error", "Sorry, you must be an administrator to be able to delete user account. Contact your systems administrator");
            } else {
               $User = User::findOrFail($id)->delete();
               return redirect()->back()->with('success', 'User account has been removed successfully');
            }
         } catch (\Exception $e) {
            return redirect()->back()->with("error", "There was an error removing user account");
         }
      }
   }
