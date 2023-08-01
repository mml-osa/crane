<?php

namespace App\Http\Controllers\Admin\Auth;

use App\Http\Controllers\Controller;
use App\Models\Auth\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Schema;

class CreateMigrateDb extends Controller
{
  /**
   * Display a listing of the resource.
   *
   * @return \Illuminate\Http\Response
   */

  public function setup()
  {
//       try {
//         $users = User::all();
//       } catch (\Exception $e) {
//         return view('welcome');
//       }
//    $db_con = Schema::hasTable(env('DB_DATABASE'));
//    $users = User::first();
//    dd(env('DB_DATABASE'));
    if (!Schema::hasTable('users')) {
      return view('setup');
    };
    return redirect(route('login'));
  }

  public function create()
  {
    Artisan::call('mysql:create');
    return redirect(route('migrate'));
  }

  public function migrate()
  {
    Artisan::call('migrate');
    return redirect(route('login'));
  }
}
