<?php

namespace App\Http\Controllers\Admin\Profile;

use App\Http\Controllers\Controller;
use App\Models\Profile\CcAbout;
use App\Models\Profile\CcLogo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AboutController extends Controller
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
        Controller::sessionVariables();
        $session = Auth::user();
        $CcAbout = CcAbout::first();
        return view('admin.profile.about')
            ->with('session',$session)
            ->with('about',$CcAbout);
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
//        try {
            $session = Auth::user();
            $request->merge(['create_id'=>$session->id,'update_id'=>$session->id]);
            CcAbout::create($request->all()); return redirect()->back()->with('success', 'About has been added successfully');
//        } catch (\Exception $e) { return redirect()->back()->with("warning", "There was a problem creating the category type"); }
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
        $session = Auth::user();
        $CcAbout = CcAbout::findOrFail($id);
        $merge = $request->merge(['update_id'=>$session->id]);
        $CcAbout->update($request->all());
        return redirect()->back()->with('success', 'About has been updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
