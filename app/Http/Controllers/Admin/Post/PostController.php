<?php

   namespace App\Http\Controllers\Admin\Post;

   use App\Http\Controllers\Controller;
   use App\Models\Media\CcMediaAlbum;
   use App\Models\Media\CcMediaItem;
   use App\Models\Nav\CcNav;
   use App\Models\Post\CcPost;
   use App\Models\Post\CcPostCategory;
   use App\Models\Post\CcPostMedia;
   use App\Models\Select\CcRole;
   use App\Models\Select\CcVisibility;
   use Carbon\Carbon;
   use Illuminate\Http\Request;
   use Illuminate\Support\Facades\Auth;

   class PostController extends Controller
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
            $CcPost = CcPost::ordered();
            return view('admin.posts.index')
               ->with('posts', $CcPost)
               ->with('roles', $CcRole)
               ->with('session', $session);
         } catch (\Exception $e) {
            return redirect()->back()->with("error", "Post page not loading properly. Please try again");
         }
      }

      public function create()
      {
         try {
            Controller::sessionVariables();
            $session = Auth::user();
            $CcNav = CcNav::ordered();
            $CcPostCategory = CcPostCategory::ordered();
            $CcRole = CcRole::all();
            $CcVisibility = CcVisibility::all();
            $CcMediaAlbum = CcMediaAlbum::all();
            $CcMediaItem = CcMediaItem::all();
            return view('admin.posts.create')
               ->with('postCategories', $CcPostCategory)
               ->with('navs', $CcNav)
               ->with('roles', $CcRole)
               ->with('visibility', $CcVisibility)
               ->with('albums', $CcMediaAlbum)
               ->with('items', $CcMediaItem)
               ->with('session', $session);
         } catch (\Exception $e) {return redirect()->back()->with("error", "Create posts page not loading properly");}
      }

      public function store(Request $request)
      {
//         try {
            $session = Auth::user();
            $createDate = $request->create_date;
            if ($createDate == null) {$createDate = now();}
            $alias = strtolower(preg_replace('/\s+/', '-', $request->title));
            $request->merge(['alias' => $alias, 'create_date' => $createDate, 'create_id' => $session->id, 'update_id' => $session->id]);

            $category = CcPostCategory::where('alias','general')->first();
            if ($category == null){
              $createCat = CcPostCategory::create(['title'=>'General','alias'=>'general','published'=>1,'create_id'=>Auth::user()->id]);
              $request->merge(['cat_id' => $createCat->id]);
            }

            $post = CcPost::create($request->all());
            if ($post) {
               $post_id = $post['id'];
               $items = $request->items;
               $type_id = $request->type_id;

               if ($items != null) {
                  for ($ii = 0; $ii < count($items); $ii++) {
                     $item = $items[$ii];
                     CcPostMedia::create([
                        'item_id' => $item,
                        'post_id' => $post_id,
                        'post_alias' => $alias,
                        'type_id' => $type_id,
                        'create_id' => $session->id,
                        'update_id' => $session->id
                     ]);
                  }
               }
            }
            return redirect(route('posts.edit', $post_id))->with('success', 'Post content has been added successfully!');
//         } catch (\Exception $e) {return redirect()->back()->withInput($request->all())->with("error", "There was a problem adding post content");}
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
            CcPost::findOrFail($id)->update(['published' => $request->switch]);
            return redirect()->back()->with("success", "Post status updated successfully");
         } catch (\Exception $e) {
            return redirect()->back()->with("error", "There was a problem updating post status post");
         }
      }

      public function show($id)
      {
         //
      }

      public function edit($id)
      {
         try {
            Controller::sessionVariables();
            $session = Auth::user();
            $CcPost = CcPost::findOrFail($id);
            $CcNav = CcNav::ordered();
            $CcPostCategory = CcPostCategory::ordered();
            $CcRole = CcRole::ordered();
            $CcVisibility = CcVisibility::all();
            $CcMediaAlbum = CcMediaAlbum::ordered();
            $CcPostMedia = CcPostMedia::ordered();
            $CcMediaItem = CcMediaItem::ordered();
            return view('admin.posts.edit')
               ->with('posts', $CcPost)
               ->with('navs', $CcNav)
               ->with('postCategories', $CcPostCategory)
               ->with('roles', $CcRole)
               ->with('visibility', $CcVisibility)
               ->with('albums', $CcMediaAlbum)
               ->with('items', $CcMediaItem)
               ->with('postMedia', $CcPostMedia)
               ->with('session', $session);
         } catch (\Exception $e) {
            return redirect()->back()->with("error", "Edit posts page not loading properly");
         }
      }

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
         $content = CcPost::findOrFail($id)->update($request->all());
         if ($content) {
            $content_items = $request->items;
            if ($content_items != null) {
               $type_id = $request->type_id;
               for ($ii = 0; $ii < count($content_items); $ii++) {
                  $item = $content_items[$ii];
                  CcPostMedia::create([
                     'item_id' => $item,
                     'post_id' => $id,
                     'type_id' => $type_id,
                     'create_id' => $session->id,
                     'update_id' => $session->id
                  ]);
               }
            }
         }

         return redirect()->back()->with('success', 'Post content updated successfully.');
      } catch (\Exception $e) { return redirect()->back()->with("error", "There was a problem updating Post content");}
      }

      public function remove_featured($id)
      {
         try {
            CcPostMedia::findOrFail($id)->delete();
            return redirect()->back()->with('success', 'Featured image has been removed successfully');
         } catch (\Exception $e) {
            return redirect()->back()->with("error", "There was an error removing featured image");
         }
      }

      public function remove_featured_all($id)
      {
         try {
            CcPostMedia::where('post_id', $id)->delete();
            return redirect()->back()->with('success', 'Featured images has been removed successfully');
         } catch (\Exception $e) {
            return redirect()->back()->with("error", "There was an error removing featured images");
         }
      }

      public function destroy($id)
      {
         try {
            CcPost::findOrFail($id)->delete();
            return redirect()->back()->with('success', 'Post has been delete successfully');
         } catch (\Exception $e) {
            return redirect()->back()->with("error", "There was an error deleting post");
         }
      }

   }
