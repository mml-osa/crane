<?php

namespace App\Http\Controllers\Admin\Event;

use App\Http\Controllers\Controller;
use App\Models\Events\CcEventsCategory;
use App\Models\Select\CcVisibility;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class EventCategoryController extends Controller
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
        try{
            Controller::sessionVariables();
            $session = Auth::user();
            $CcEventsCategory = CcEventsCategory::ordered();
            $CcVisibility = CcVisibility::all();
            return view('admin.event.categories')
                ->with('session',$session)
                ->with('visibility',$CcVisibility)
                ->with('eventCategories',$CcEventsCategory);
        } catch (\Exception $e) { return redirect()->back()->with("error", "Event categories page not loading properly"); }
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
            CcEventsCategory::create($request->all());
            return redirect()->back()->with('success', 'Event category has been added successfully');
        } catch (\Exception $e) { return redirect()->back()->with("warning", "There was a problem adding the event category"); }
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
            CcEventsCategory::findOrFail($id)->update($request->all());
            return redirect()->back()->with('success', 'Event category has been updated successfully');
        }catch (\Exception $e) { return redirect()->back()->with("warning", "There was a problem updating event category"); }
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
