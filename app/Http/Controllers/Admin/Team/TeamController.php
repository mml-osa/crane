<?php

namespace App\Http\Controllers\Admin\Team;

use App\Http\Controllers\Controller;
use App\Models\Media\CcMediaAlbum;
use App\Models\Media\CcMediaItem;
use App\Models\Nav\CcNav;
use App\Models\Select\CcRole;
use App\Models\Select\CcVisibility;
use App\Models\Team\CcTeam;
use App\Models\Team\CcTeamCategory;
use App\Models\Team\CcTeamMedia;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TeamController extends Controller
{
   public function __construct()
   {
      $this->middleware('auth');
   }
   
   public function index()
   {
      try {
         Controller::sessionVariables();
         $session = Auth::user();
         $CcRole = CcRole::ordered();
         $CcTeam = CcTeam::ordered();
         return view('admin.team.index')
            ->with('teams', $CcTeam)
            ->with('roles', $CcRole)
            ->with('session', $session);
      } catch (\Exception $e) {
         return redirect()->back()->with("error", "Team members page not loading properly. Please try again");
      }
   }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
       try {
          Controller::sessionVariables();
          $session = Auth::user();
          $CcNav = CcNav::ordered();
          $CcTeamCategory = CcTeamCategory::ordered();
          $CcRole = CcRole::all();
          $CcVisibility = CcVisibility::all();
          $CcMediaAlbum = CcMediaAlbum::all();
          $CcMediaItem = CcMediaItem::all();
          return view('admin.team.create')
             ->with('teamCategories', $CcTeamCategory)
             ->with('navs', $CcNav)
             ->with('roles', $CcRole)
             ->with('visibility', $CcVisibility)
             ->with('albums', $CcMediaAlbum)
             ->with('items', $CcMediaItem)
             ->with('session', $session);
       } catch (\Exception $e) {return redirect()->back()->with("error", "Create team page not loading properly");}
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
          $createDate = $request->create_date;
          if ($createDate == null) {
             $createDate = now();
          }
          $alias = strtolower(preg_replace('/\s+/', '-', $request->title));
          $request->merge(['alias' => $alias, 'create_date' => $createDate, 'create_id' => $session->id, 'update_id' => $session->id]);
          $team = CcTeam::create($request->all());
          if ($team) {
             $team_id = $team['id'];
             $items = $request->items;
             $type_id = $request->type_id;
         
             if ($items != null) {
                for ($ii = 0; $ii < count($items); $ii++) {
                   $item = $items[$ii];
                   CcTeamMedia::create([
                      'item_id' => $item,
                      'team_id' => $team_id,
                      'team_alias' => $alias,
                      'type_id' => $type_id,
                      'create_id' => $session->id,
                      'update_id' => $session->id
                   ]);
                }
             }
          }
          return redirect(route('team.edit', $team_id))->with('success', 'Team member has been added successfully!');
       } catch (\Exception $e) {return redirect()->back()->withInput($request->all())->with("error", "There was a problem adding team member");}
    }
   
   public function publish(Request $request, $id)
   {
      try {
         $session = Auth::user();
         if ($request->switch == 1) {
            $publish = "published";
         } else {
            $publish = "unpublished";
         }
         $request->merge(['update_id' => $session->id]);
         CcTeam::findOrFail($id)->update(['published' => $request->switch]);
         return redirect()->back()->with("success", "Team Member status updated successfully");
      } catch (\Exception $e) {
         return redirect()->back()->with("error", "There was a problem updating team member status post");
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
       try {
          Controller::sessionVariables();
          $session = Auth::user();
          $CcTeam = CcTeam::findOrFail($id);
          $CcNav = CcNav::ordered();
          $CcTeamCategory = CcTeamCategory::ordered();
          $CcRole = CcRole::ordered();
          $CcVisibility = CcVisibility::all();
          $CcMediaAlbum = CcMediaAlbum::ordered();
          $CcTeamMedia = CcTeamMedia::ordered();
          $CcMediaItem = CcMediaItem::ordered();
          return view('admin.team.edit')
             ->with('team', $CcTeam)
             ->with('navs', $CcNav)
             ->with('teamCategories', $CcTeamCategory)
             ->with('roles', $CcRole)
             ->with('visibility', $CcVisibility)
             ->with('albums', $CcMediaAlbum)
             ->with('items', $CcMediaItem)
             ->with('teamMedia', $CcTeamMedia)
             ->with('session', $session);
       } catch (\Exception $e) {
          return redirect()->back()->with("error", "Edit team member page not loading properly");
       }
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
          $createDate = $request->create_date;
          if ($createDate == null) {
             $createDate = now();
             $request->merge(['create_date' => $createDate]);
          }
          $content = CcTeam::findOrFail($id)->update($request->all());
          if ($content) {
             $content_items = $request->items;
             if ($content_items != null) {
                $type_id = $request->type_id;
                for ($ii = 0; $ii < count($content_items); $ii++) {
                   $item = $content_items[$ii];
                   CcTeamMedia::create([
                      'item_id' => $item,
                      'team_id' => $id,
                      'type_id' => $type_id,
                      'create_id' => $session->id,
                      'update_id' => $session->id
                   ]);
                }
             }
          }
      
          return redirect()->back()->with('success', 'Team member updated successfully.');
       } catch (\Exception $e) { return redirect()->back()->with("error", "There was a problem updating team member");}
    }
   
   public function remove_featured($id)
   {
      try {
         CcTeamMedia::findOrFail($id)->delete();
         return redirect()->back()->with('success', 'Featured image has been removed successfully');
      } catch (\Exception $e) {
         return redirect()->back()->with("error", "There was an error removing featured image");
      }
   }
   
   public function remove_featured_all($id)
   {
      try {
         CcTeamMedia::where('team_id', $id)->delete();
         return redirect()->back()->with('success', 'Featured images has been removed successfully');
      } catch (\Exception $e) {
         return redirect()->back()->with("error", "There was an error removing featured images");
      }
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
          CcTeam::findOrFail($id)->delete();
          return redirect()->back()->with('success', 'Team member has been removed successfully');
       } catch (\Exception $e) {
          return redirect()->back()->with("error", "There was an error deleting team member");
       }
    }
}
