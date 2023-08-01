<?php

namespace App\Http\Controllers\Admin\Forms;

use App\Http\Controllers\Controller;
use App\Models\Forms\CcApplications;
use App\Models\Select\CcRole;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class FormsController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        try{
            Controller::sessionVariables();
            $session = Auth::user();
            $CcRole = CcRole::ordered();
            $CcApplications = CcApplications::all();
            return view('admin.forms.applications')
                ->with('applications',$CcApplications)
                ->with('roles',$CcRole)
                ->with('session',$session);
        } catch (\Exception $e) { return redirect()->back()->with("error", "Page not loading properly. Please try again"); }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    public function destroy($id)
    {
        try {
            CcApplications::findOrFail($id)->delete();
            return redirect()->back()->with('success', 'Application has been delete successfully');
        } catch (\Exception $e) { return redirect()->back()->with("error", "There was an error deleting application"); }
    }
}
