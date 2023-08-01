<?php

namespace App\Http\Controllers\Admin\Event;

use App\Http\Controllers\Controller;
use App\Models\Events\CcEvents;
use App\Models\Events\CcEventsCategory;
use App\Models\Media\CcMediaAlbum;
use App\Models\Media\CcMediaItem;
use App\Models\Post\CcPostMedia;
use App\Models\Select\CcRole;
use App\Models\Select\CcVisibility;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class EventController extends Controller
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
            $session = Auth::user();
            $CcEvents = CcEvents::ordered();
            $CcEventsCategory = CcEventsCategory::ordered();
            return view('admin.event.index')
                ->with('session',$session)
                ->with('eventCategories',$CcEventsCategory)
                ->with('events',$CcEvents);
        } catch (\Exception $e) { return redirect()->back()->with("error", "Event page not loading properly"); }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        try{
            Controller::sessionVariables();
            $session = Auth::user();
            $CcVisibility = CcVisibility::all();
            $CcMediaAlbum = CcMediaAlbum::all();
            $CcEventsCategory = CcEventsCategory::ordered();
            return view('admin.event.create')
                ->with('session',$session)
                ->with('visibility',$CcVisibility)
                ->with('eventCategories',$CcEventsCategory)
                ->with('mediaAlbums',$CcMediaAlbum);
        } catch (\Exception $e) { return redirect()->back()->with("error", "Create event page not loading properly"); }
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
            Controller::sessionVariables();
            $session = Auth::user();
            $alias = strtolower(preg_replace('/\s+/', '-', $request->title));
            $request->merge(['alias' => $alias,'create_id' => $session->id,'update_id' => $session->id]);
            $events = CcEvents::create($request->all());

            if ($events)
            {
                $id = $events['id'];
                $items = $request->items;
                $type_id = $request->type_id;

                if ($items != null)
                {
                    for($ii = 0; $ii < count($items) ; $ii++) {
                        $item = $items[$ii];
                        CcPostMedia::create([
                            'item_id' => $item,
                            'post_id' => $id,
                            'post_alias' => $alias,
                            'type_id' => $type_id,
                            'create_id' => Auth::user()->id
                        ]);
                    }
                }
            }
            return redirect(route('event.edit',$id))->with('success', 'Event has been added successfully!');
//        } catch (\Exception $e) { return redirect()->back()->withInput($request->all())->with(["error", "There was a problem creating event"]); }
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
            CcEvents::findOrFail($id)->update(['published' => $request->switch,'update_id' => $session->id]);
            return redirect()->back()->with('success', 'Event has been published successfully');
        } catch (\Exception $e) { return redirect()->back()->with("error", "There was a problem publishing event"); }
    }

    /**
     * Activate category from storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function current(Request $request, $id)
    {
        try {
            $session = Auth::user();
            CcEvents::findOrFail($id)->update(['current' => $request->switch,'update_id' => $session->id]);
            return redirect()->back()->with('success', 'Event has been set as current successfully');
        } catch (\Exception $e) { return redirect()->back()->with("error", "There was a problem setting event as current"); }
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
        try{
            $session = Auth::user();
            $CcEventCurrent = CcEvents::findOrFail($id)->first();
            $CcEvents = CcEvents::all();
            $CcEventsCategory = CcEventsCategory::all();
            $CcMediaAlbum = CcMediaAlbum::all();
            $CcMediaItem = CcMediaItem::all();
            $CcPostMedia = CcPostMedia::all();
            $CcVisibility = CcVisibility::all();
            return view('admin.event.edit')
                ->with('event',$CcEventCurrent)
                ->with('events',$CcEvents)
                ->with('albums', $CcMediaAlbum)
                ->with('links', $CcPostMedia)
                ->with('eventCategories', $CcEventsCategory)
                ->with('session', $session)
                ->with('visibility',$CcVisibility)
                ->with('items', $CcMediaItem);
        } catch (\Exception $e) { return redirect()->back()->with("error", "Event edit page not loading properly"); }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\View\View
     */
    public function copy($id)
    {
        try{
            $session = Auth::user();
            $CcEventsCurrent = CcEvents::findOrFail($id)->first();
            $CcEvents = CcEvents::all();
            $CcMediaAlbum = CcMediaAlbum::all();
            $CcMediaItem = CcMediaItem::all();
            $CcPostMedia = CcPostMedia::all();
            return view('admin.event.copy')
                ->with('event',$CcEventsCurrent)
                ->with('events',$CcEvents)
                ->with('albums', $CcMediaAlbum)
                ->with('links', $CcPostMedia)
                ->with('items', $CcMediaItem)
                ->with('session', $session);
        } catch (\Exception $e) { return redirect()->back()->with("error", "Event edit page not loading properly"); }
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
            $events = CcEvents::findOrFail($id)->update($request->all());
            if ($events)
            {
                $events_items = $request->items;
                if ($events_items != null)
                {
                    $type_id = $request->type_id;
                    for($ii = 0; $ii < count($events_items) ; $ii++) {
                        $item = $events_items[$ii];
                        CcPostMedia::create([
                            'item_id' => $item,
                            'post_id' => $id,
                            'type_id' => $type_id,
                            'update_id' => Auth::user()->id
                        ]);
                    }
                }
            }
            return redirect()->back()->with('success', 'Event was updated successfully.');
        } catch (\Exception $e) { return redirect()->back()->with("error", "There was a problem updating event"); }
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
            CcEvents::findOrFail($id)->delete(); return redirect()->back()->with('success', 'Event has been delete successfully');
        } catch (\Exception $e) { return redirect()->back()->with("error", "There was an error deleting event"); }
    }
}
