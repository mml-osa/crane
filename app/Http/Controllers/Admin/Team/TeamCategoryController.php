<?php

namespace App\Http\Controllers\Admin\Team;

use App\Http\Controllers\Controller;
use App\Models\Select\CcRole;
use App\Models\Team\CcTeam;
use App\Models\Team\CcTeamCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TeamCategoryController extends Controller
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
//      try{
         Controller::sessionVariables();
         $session = Auth::user();
         $CcRole = CcRole::ordered();
         $CcTeamCategory = CcTeamCategory::ordered();
         return view('admin.team.categories')
            ->with('session',$session)
            ->with('roles',$CcRole)
            ->with('teamCategories',$CcTeamCategory);
//      } catch (\Exception $e) { return redirect()->back()->with("error", "Team members categories page not loading properly"); }
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
          CcTeamCategory::create($request->all());
          return redirect()->back()->with('success', 'Team category has been added successfully');
       } catch (\Exception $e) { return redirect()->back()->with("warning", "There was a problem adding the team category"); }
    }
   
   public function publish(Request $request,$id)
   {
      try {
         $session = Auth::user();
         if ($request->switch == 1) {
            $publish = "published";
         } else {
            $publish = "unpublished";
         }
         $request->merge(['update_id' => $session->id]);
         CcTeamCategory::findOrFail($id)->update(['published' => $request->switch]);
         return redirect()->back()->with("success", "Team category status updated successfully");
      } catch (\Exception $e) {
         return redirect()->back()->with("error", "There was a problem updating team category team");
      }
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
          $CcTeamCategory = CcTeamCategory::findOrFail($id);
          $request->merge(['update_id' => $session->id]);
          $CcTeamCategory->update($request->all());
          return redirect()->back()->with('success', 'Team category has been updated successfully');
       }catch (\Exception $e) { return redirect()->back()->with("warning", "There was a problem updating team category"); }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
//       try {
          CcTeam::where('cat_id',$id);
          CcTeamCategory::findOrFail($id)->delete();
          return redirect()->back()->with('success', 'Team category has been delete successfully');
//       } catch (\Exception $e) { return redirect()->back()->with("error", "There was an error deleting team"); }
    }
}
