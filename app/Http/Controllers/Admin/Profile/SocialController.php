<?php

namespace App\Http\Controllers\Admin\Profile;

use App\Http\Controllers\Controller;
use App\Models\Profile\CcAddress;
use App\Models\Profile\CcEmail;
use App\Models\Profile\CcPhone;
use App\Models\Profile\CcSocial;
use App\Models\Select\CcCountry;
use App\Models\Setting\CcSwitch;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SocialController extends Controller
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
        $CcSocial = CcSocial::ordered();
        $CcCountry = CcCountry::ordered();
        $CcSwitch = CcSwitch::all();
        return view('admin.profile.social')
            ->with('session',$session)
            ->with('socials',$CcSocial)
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
            CcSocial::create($request->all());
            return redirect()->back()->with('success', 'Social media details has been added successfully');
        } catch (\Exception $e) { return redirect()->back()->with("warning", "There was a problem adding social media details"); }
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
            $CcSocial = CcSocial::findOrFail($id);
            $request->merge(['update_id' => $session->id]);
            $CcSocial->update($request->all());
            return redirect()->back()->with('success', 'Social media details has been updated successfully');
        } catch (\Exception $e) { return redirect()->back()->with("warning", "There was a problem updating social media details"); }
        
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
      CcSocial::findOrFail($id)->update(['published' => $request->switch]);
      return redirect()->back()->with("success", "Social media link $publish successfully");
    } catch (\Exception $e) { return redirect()->back()->with("warning", "There was a problem publishing phone.");}
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
            $CcSocial = CcSocial::findOrFail($id);
            $CcSocial->delete();
            return redirect()->back()->with('success', 'Social media has been removed successfully');
        } catch (\Exception $e) { return redirect()->back()->with("warning", "There was an error removing social media details"); }
    }
}
