<?php

namespace App\Http\Controllers\Admin\Profile;

use App\Http\Controllers\Controller;
use App\Models\Profile\CcAddress;
use App\Models\Profile\CcEmail;
use App\Models\Profile\CcPhone;
use App\Models\Select\CcCountry;
use App\Models\Setting\CcSwitch;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PhoneController extends Controller
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
        $CcPhone = CcPhone::ordered();
        $CcCountry = CcCountry::ordered();
        $CcSwitch = CcSwitch::all();
        return view('admin.profile.phone')
            ->with('session',$session)
            ->with('phones',$CcPhone)
            ->with('switches',$CcSwitch)
            ->with('countries',$CcCountry);
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
            CcPhone::create($request->all());
            return redirect()->back()->with('success', 'Phone number has been added successfully');
        } catch (\Exception $e) { return redirect()->back()->with("warning", "There was a problem adding the phone number"); }
    }

    /**
     * Activate category from storage.
     *
     * @param  \Illuminate\Http\Request  $request
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function main(Request $request,$id)
    {
        try {
            $session = Auth::user();
            if ($request->switch == 1){$publish = "marked";} else{$publish = "marked";}
            $request->merge(['update_id' => $session->id]);
            CcPhone::findOrFail($id)->update(['main' => $request->switch]);
            $Phones = CcPhone::all();
            foreach($Phones as $Phone) {if ($Phone->id != $id) {$Phone->update(['main' => 0]);} }
            return redirect()->back()->with("success", "Phone $publish successfully");
        } catch (\Exception $e) { return redirect()->back()->with("warning", "There was a problem marking phone as main.");}
    }

    /**
     * Activate category from storage.
     *
     * @param  \Illuminate\Http\Request  $request
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function publish(Request $request,$id)
    {
        try {
            $session = Auth::user();
            if ($request->switch == 1){$publish = "published";} else{$publish = "unpublished";}
            $request->merge(['update_id' => $session->id]);
            CcPhone::findOrFail($id)->update(['published' => $request->switch]);
            return redirect()->back()->with("success", "Phone $publish successfully");
        } catch (\Exception $e) { return redirect()->back()->with("warning", "There was a problem publishing phone.");}
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
        $CcPhone = CcPhone::findOrFail($id);
        $alias = strtolower(preg_replace('/\s+/', '-', $request->title));
        $request->merge(['alias'=>$alias,'update_id'=>$session->id]);
        $CcPhone->update($request->all());
        return redirect()->back()->with('success', 'Phone number has been updated successfully');
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
            $CcPhone = CcPhone::findOrFail($id);
            $CcPhone->delete();
            return redirect()->back()->with('success', 'Phone number has been removed successfully');
        } catch (\Exception $e) { return redirect()->back()->with("warning", "There was an error removing phone number"); }
    }
}
