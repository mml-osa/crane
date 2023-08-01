<?php

namespace App\Http\Controllers\Admin\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\Pages\CcPage;
use App\Models\Post\CcPost;
use App\Models\Post\CcPostComment;
use App\Models\Services\CcServices;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
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

    public function index()
    {
        Controller::sessionVariables();
        $session = Auth::user();
        $CcPost = CcPost::ordered();
        $CcPage = CcPage::ordered();
        $CcServices = CcServices::ordered();
        $CcPostComment = CcPostComment::ordered();
        return view('admin/dashboard/index')
            ->with('session',$session)
            ->with('pages',$CcPage)
            ->with('posts',$CcPost)
            ->with('services',$CcServices)
            ->with('comments',$CcPostComment)
            ;
    }
}
