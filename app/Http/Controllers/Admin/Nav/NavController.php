<?php

   namespace App\Http\Controllers\Admin\Nav;

   use App\Http\Controllers\Controller;
   use App\Models\Events\CcEvents;
   use App\Models\Nav\CcNav;
   use App\Models\Nav\CcNavCat;
   use App\Models\Nav\CcNavTarget;
   use App\Models\Pages\CcPage;
   use App\Models\Services\CcServices;
   use Illuminate\Http\Request;
   use Illuminate\Support\Facades\Auth;

   class NavController extends Controller
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
//         try {
            Controller::sessionVariables();
            $session = Auth::user();
            $cat = \request()->cat;
            $CcNav = CcNav::ordered();
            $CcServices = CcServices::ordered();
            $CcPage = CcPage::ordered();
            $CcNavTarget = CcNavTarget::ordered();
            $CcCatNav = null;
            if ($cat != null) {
               $CcCatNav = CcNav::where('cat_id', $cat)->ordered();
            }
            $CcNavCat = CcNavCat::ordered();
            return view('admin.nav.index')
               ->with('session', $session)
               ->with('navs', $CcNav)
               ->with('catNav', $CcCatNav)
               ->with('services', $CcServices)
               ->with('pages', $CcPage)
               ->with('targets', $CcNavTarget)
               ->with('navCats', $CcNavCat);
//         } catch (\Exception $e) {return redirect()->back()->with("error", "Page not loading properly. Please try again");}
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
       * @param \Illuminate\Http\Request $request
       * @return \Illuminate\Http\Response
       */
      public function store(Request $request)
      {
//         try {
            $session = Auth::user();
            $order = CcNav::where('sub',1)->orderBy('order', 'DESC')->first();
            $navTitle = CcNav::where('id',$request->parent_id)->first();
            $alias = strtolower(preg_replace('/\s+/', '-', $request->title));
            if ($request->sub == 1){ $route = $navTitle->alias.'.'.$alias; }else{ $route = $alias; }
            if ($request->sub == 1){ $url = $navTitle->alias.'/'.$alias; }else{ $url = $alias; }
            $request->merge(['alias'=>$alias,'route'=>$route,'order'=>$order->order+1,'create_id'=>$session->id, 'update_id'=>$session->id]);
            CcNav::create($request->all());
            return redirect()->back()->with('success', 'Navigation has been added successfully');
//         } catch (\Exception $e) {return redirect()->back()->with("warning", "There was a problem adding the navigation");}
      }

      /**
       * Activate category from storage.
       *
       * @param \Illuminate\Http\Request $request
       * @param int $id
       * @return \Illuminate\Http\RedirectResponse
       */
      public function publish(Request $request, $id)
      {
         try {
            $session = Auth::user();
            CcNav::findOrFail($id)->update(['published' => $request->switch, 'update_id' => $session->id]);
            return redirect()->back()->with('success', 'Event has been published successfully');
         } catch (\Exception $e) {
            return redirect()->back()->with("error", "There was a problem publishing event");
         }
      }

      /**
       * Display the specified resource.
       *
       * @param int $id
       * @return \Illuminate\Http\Response
       */
      public function show($id)
      {
         //
      }

      /**
       * Show the form for editing the specified resource.
       *
       * @param int $id
       * @return \Illuminate\Http\Response
       */
      public function edit($id)
      {
         //
      }

      /**
       * Update the specified resource in storage.
       *
       * @param \Illuminate\Http\Request $request
       * @param int $id
       * @return \Illuminate\Http\Response
       */
      public function update(Request $request, $id)
      {
//        try {
         $sub = $request->sub;
         if($sub == null){$sub = '0';}
         $session = Auth::user();
         $request->merge(['sub'=>$sub, 'update_id'=>$session->id]);
         CcNav::findOrFail($id)->update($request->all());
         return redirect()->back()->with('success', 'Navigation has been updated successfully');
//        }catch (\Exception $e) { return redirect()->back()->with("warning", "There was a problem updating post navigation"); }
      }

      /**
       * Remove the specified resource from storage.
       *
       * @param int $id
       * @return \Illuminate\Http\Response
       */
      public function destroy($id)
      {
         try {
            CcNav::findOrFail($id)->delete();
            return redirect()->back()->with('success', 'Navigation has been delete successfully');
         } catch (\Exception $e) {
            return redirect()->back()->with("error", "There was an error deleting navigation");
         }
      }
   }
