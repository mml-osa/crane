<?php

namespace App\Http\Controllers\Admin\Nav;

use App\Http\Controllers\Controller;
use App\Models\Events\CcEvents;
use App\Models\Nav\CcNav;
use App\Models\Nav\CcNavCat;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class NavCatController extends Controller
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
        //
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
        try {
            $session = Auth::user();
            $alias = strtolower(preg_replace('/\s+/', '-', $request->title));
            $request->merge(['alias'=>$alias,'create_id'=>$session->id,'update_id'=>$session->id]);
            CcNavCat::create($request->all());
            return redirect()->back()->with('success', 'Navigation category has been added successfully');
        } catch (\Exception $e) { return redirect()->back()->with("warning", "There was a problem adding the navigation category"); }
    }
    
    /**
     * Activate category from storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function publish(Request $request, $id)
    {
        try {
            $session = Auth::user();
            CcNavCat::findOrFail($id)->update(['published' => $request->switch,'update_id' => $session->id]);
            return redirect()->back()->with('success', 'Event has been published successfully');
        } catch (\Exception $e) { return redirect()->back()->with("error", "There was a problem publishing event"); }
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
        try {
            $session = Auth::user();
            $request->merge(['update_id' => $session->id]);
            CcNavCat::findOrFail($id)->update($request->all());
            return redirect()->back()->with('success', 'Navigation category has been updated successfully');
        }catch (\Exception $e) { return redirect()->back()->with("warning", "There was a problem updating post navigation category"); }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        try {
            CcNavCat::findOrFail($id)->delete(); return redirect()->back()->with('success', 'Navigation category has been delete successfully');
        } catch (\Exception $e) { return redirect()->back()->with("error", "There was an error deleting navigation category"); }
    }
}
