<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Mail\BrochureMail;
use App\Mail\ContactMail;
use App\Models\Auth\User;
use App\Models\Commerce\CcProduct;
use App\Models\Commerce\CcProductCategory;
use App\Models\Forms\CcApplications;
use App\Models\Media\CcMediaAlbum;
use App\Models\Media\CcMediaItem;
use App\Models\Nav\CcNav;
use App\Models\Pages\CcPage;
use App\Models\Pages\CcPagesMedia;
use App\Models\Post\CcPost;
use App\Models\Post\CcPostCategory;
use App\Models\Post\CcPostComment;
use App\Models\Post\CcPostCommentReply;
use App\Models\Profile\CcSocial;
use App\Models\Services\CcServices;
use App\Models\Services\CcServicesCategory;
use App\Models\Team\CcTeam;
use App\Models\Team\CcTeamCategory;
use App\Models\Team\CcTeamMedia;
use App\Rules\Captcha;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;

class WebController extends Controller
{
  public function index()
  {
//    try {
      Controller::sessionVariables();
      $baseUrl = basename(parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH));
      if (session('landing') != null && session('landing')->state == 1 && !Auth::check()) {
        return view("landing.index");
      } else {
        $blade = "index";
        $urlMain = $_SERVER['REQUEST_URI'];
        $urlSplit = explode('/', $urlMain);
        $urlCount = count($urlSplit) - 2;
        $url = $baseUrl;

        if ($baseUrl == env('APP_ALIAS') || $baseUrl == "") {
          $url = "home";
        }
//        if (strpos($_SERVER['REQUEST_URI'], "services") || strpos($_SERVER['REQUEST_URI'], "niche-apps")) {
//          $blade = $baseUrl;
//          $url = $urlSplit[$urlCount];
//        }

        $CcCurrentPage = CcPage::where('alias', $baseUrl)->first();
        $CcNav = CcNav::where('published', 1)->ordered();
        $CcTeam = CcTeam::where('published', 1)->ordered();
        $CcTeamCategory = CcTeamCategory::where('published', 1)->ordered();
        $CcTeamMedia = CcTeamMedia::ordered();
        $CcPage = CcPage::where('published', 1)->ordered();
        $CcPost = CcPost::where('published', 1)->ordered();
        $CcPostSingle = CcPost::where('published', 1)->ordered()->first();
        $CcPostPaginate = CcPost::where('published', 1)->orderBy('create_date', 'desc')->paginate(10);
        $CcMediaAlbum = CcMediaAlbum::all();
        $CcMediaItem = CcMediaItem::where('published', 1)->ordered();
        $CcPostCategory = CcPostCategory::ordered();
        $CcServices = CcServices::where('published', 1)->ordered();
        $CcServicesCategory = CcServicesCategory::where('published', 1)->ordered();
        $CcCurrentService = CcServices::where('alias', $baseUrl)->first();
        $CcProduct = CcProduct::where('published', 1)->get();
        $CcProductCategory = CcProductCategory::where('published', 1)->get();
        $CcSocial = CcSocial::where('published', 1)->get();
        if (strpos($_SERVER['REQUEST_URI'], "services")) {
          $baseUrl = "services";
        }
        return view("web.$url.$blade")
          ->with('currentPage', $CcCurrentPage)
          ->with('currentService', $CcCurrentService)
          ->with('navs', $CcNav)
          ->with('teams', $CcTeam)
          ->with('teamsMedia', $CcTeamMedia)
          ->with('teamsCategories', $CcTeamCategory)
          ->with('pages', $CcPage)
          ->with('posts', $CcPost)
          ->with('postSingle', $CcPostSingle)
          ->with('postsPaginate', $CcPostPaginate)
          ->with('mediaAlbums', $CcMediaAlbum)
          ->with('mediaItems', $CcMediaItem)
          ->with('postsCategories', $CcPostCategory)
          ->with('services', $CcServices)
          ->with('servicesCategories', $CcServicesCategory)
          ->with('products', $CcProduct)
          ->with('socials', $CcSocial)
          ->with('productsCategories', $CcProductCategory);
      }
//    } catch (\Exception $e) {return redirect()->back()->with("error", "Home page not loading properly");}
  }

  public function detail(Request $request, $alias)
  {
    try {
      Controller::sessionVariables();
      $baseUrl = basename(parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH));
      $urlMain = $_SERVER['REQUEST_URI'];
      $urlSplit = explode('/', $urlMain);
      $urlCount = count($urlSplit) - 2;
      $page = $urlSplit[$urlCount];

      $CcPagesMedia = CcPagesMedia::ordered();
      $CcNav = CcNav::where('published', 1)->ordered();
      $CcPost = CcPost::where('alias', $alias)->where('published', 1)->first();
      $CcPosts = CcPost::where('published', 1)->ordered();
      $CcPostComment = CcPostComment::where('post_id', $CcPost->id)->where('published', 1)->ordered();
      $CommentCount = CcPostComment::where('post_id', $CcPost->id)->where('reply', 0)->where('published', 1)->count();
      $CcMediaAlbum = CcMediaAlbum::ordered();
      $CcMediaItem = CcMediaItem::ordered();
      $CcServices = CcServices::where('published', 1)->ordered();
      $CcServicesCategory = CcServicesCategory::where('published', 1)->ordered();
      $CcCurrentPage = CcPage::where('alias', $page)->first();
      $CcCurrentService = CcServices::where('alias', $baseUrl)->first();
      if ($CcPost != null) {
        $views = $CcPost->views;
        $view_id = $CcPost->view_id;
        $idenHash = Hash::make(request()->ip());
        if (!Hash::check(request()->ip(), $view_id)) {
          $CcPost->update(['views' => $views + 1, 'view_id' => $idenHash]);
        }
      }
      return view("web.$page.detail")
        ->with('pageMedia', $CcPagesMedia)
        ->with('postDetail', $CcPost)
        ->with('posts', $CcPosts)
        ->with('comments', $CcPostComment)
        ->with('commentCount', $CommentCount)
        ->with('views', $views)
        ->with('mediaAlbums', $CcMediaAlbum)
        ->with('mediaItems', $CcMediaItem)
        ->with('navs', $CcNav)
        ->with('services', $CcServices)
        ->with('servicesCategories', $CcServicesCategory)
        ->with('currentPage', $CcCurrentPage)
        ->with('currentService', $CcCurrentService);
    } catch (\Exception $e) {
      return redirect()->back()->with("error", "Page not loading properly");
    }
  }

  public function service(Request $request, $alias)
  {
//        try {
    Controller::sessionVariables();
    $baseUrl = basename(parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH));
    $urlMain = $_SERVER['REQUEST_URI'];
    $urlSplit = explode('/', $urlMain);
    $urlCount = count($urlSplit) - 2;
    $page = $urlSplit[$urlCount];

    $CcNav = CcNav::where('published', 1)->ordered();
    $CcPost = CcPost::where('alias', $alias)->where('published', 1)->first();
    $CcPosts = CcPost::where('published', 1)->ordered();
    $CcMediaAlbum = CcMediaAlbum::ordered();
    $CcMediaItem = CcMediaItem::ordered();
    $CcServices = CcServices::where('published', 1)->ordered();
    $CcServicesCategory = CcServicesCategory::where('published', 1)->ordered();
    $CcCurrentService = CcServices::where('alias', $alias)->first();
//            if ($CcPost != null) {
//                $views = null;
//                $views = $CcCurrentService->views;
//                $view_id = $CcCurrentService->view_id;
//                $idenHash = Hash::make(request()->ip());
//                if (!Hash::check(request()->ip(), $view_id)) {
//                    $CcPost->update(['views' => $views + 1, 'view_id' => $idenHash]);
//                }
//            }
    return view("web.$page.$alias")
      ->with('postDetail', $CcPost)
      ->with('posts', $CcPosts)
//                ->with('views', $views)
      ->with('mediaAlbums', $CcMediaAlbum)
      ->with('mediaItems', $CcMediaItem)
      ->with('navs', $CcNav)
      ->with('services', $CcServices)
      ->with('servicesCategories', $CcServicesCategory)
      ->with('currentService', $CcCurrentService);
//        } catch (\Exception $e) {return redirect()->back()->with("error", "Page not loading properly");}
  }

  public function contact(Request $request)
  {
    Controller::sessionVariables();
    if ($request->phone != null) {
      $validatedData = $request->validate([
        'name' => 'required|max:255',
        'email' => 'required|max:255',
        'subject' => 'required',
        'message' => 'required',
        'phone' => 'required',
//        'g-recaptcha-response' => ['required', new Captcha]
//       ],[ 'g-recaptcha-response.required' => 'The recaptcha field is required.'

      ]);

    } else {
      $validatedData = $request->validate([
        'name' => 'required|max:255',
        'email' => 'required|max:255',
        'subject' => 'required',
        'message' => 'required',
//        'g-recaptcha-response' => ['required', new Captcha]
//      ],[ 'g-recaptcha-response.required' => 'The recaptcha field is required.'
      ]);
    }
    // try {
    Mail::send(new ContactMail($request));
//    return redirect()->back()->with('success', 'Your message has been sent successfully');
    return response()->json(['success'=>'Successfully']);
    // } catch (\Exception $e) { return redirect()->back()->withInput($request->all())->with("error", "There was a problem sending your message");}
  }

  public function meetingCreate(Request $request)
  {
    $CcNav = CcNav::where('published', 1)->ordered();
    return view('web.cloud.schedule')
      ->with('navs', $CcNav);
  }

  public function comments(Request $request, $id)
  {
    try {
      $validatedData = $request->validate([
        'name' => 'required|max:255',
        'email' => 'required|max:255',
        'comment' => 'required',
//                'g-recaptcha-response' => new Captcha()
      ]);
      if ($request->reply == 1) {
        $request->merge(['comment_id' => $id,]);
        CcPostCommentReply::create($request->all());
        CcPostComment::where('id', $id)->update(['reply' => 1]);
      } else {
        $request->merge(['post_id' => $id,]);
        CcPostComment::create($request->all());
      }
      return redirect()->back()->with('success', 'Thank you for leaving behind a comment. Your comment will be published live soon after review. We appreciate your views.');
    } catch (\Exception $e) {
      return redirect()->back()->withInput($request->all())->with("error", "There was a problem posting comment");
    }
  }

  public function send_application(Request $request)
  {

    ini_set('memory_limit', '400M');
    ini_set('allow_url_fopen', 1);

//        try{

    if ($request->experience === 'Yes') {
      $request->validate(['experience_detail' => 'required']);
    }
    if ($request->police === 'Yes') {
      $request->validate(['police_detail' => 'required']);
    }

    $photo = $request->photo;

    $fileArray = array('image' => $photo);
    $rules = array('image' => 'mimes:jpeg,jpg,png,gif|required|max:2000'); // max 10000kb);
    $validator = Validator::make($fileArray, $rules);
    if ($validator->fails()) {
      // Redirect or return json to frontend with a helpful message to inform the user
      // that the provided file was not an adequate type
      return redirect()->back()->with("error", "Image type not supported. Supported files are JPEG,JPG,PNG and GIF ONLY!");
    } else {
      //Get Filename With The Extension
      $photoNameWithExt = $photo->getClientOriginalName();
      //Get Just Filename
      $fileName = pathinfo($photoNameWithExt, PATHINFO_FILENAME);
      //Get Just Extension
      $photoExtension = $photo->getClientOriginalExtension();
      //Filename To Store
      $photoNameToStore = $request->surname . '-' . time() . '.' . $photoExtension;
      //Upload Image
      $path = $photo->storeAs("web/album/applicants/", $photoNameToStore);
    }

    $data = [
      'app_email' => $request->app_email,
      'sender' => $request->email,
      'subject' => "Volunteer Application",
      'photo' => $photoNameToStore,
      'surname' => $request->surname,
      'other_names' => $request->other_names,
      'phone_number' => $request->phone_number,
      'age' => $request->age,
      'language' => $request->language,
      'semester_residence' => $request->semester_residence,
      'vacation_residence' => $request->vacation_residence,
      'university' => $request->university,
      'program' => $request->program,
      'level' => $request->level,
      'gpa' => $request->gpa,
      'laptop' => $request->laptop,
      'internet' => $request->internet,
      'study_days' => $request->study_days,
      'goal_what' => $request->goal_what,
      'goal_why' => $request->goal_why,
      'experience' => $request->experience,
      'experience_detail' => $request->experience_detail,
      'strengths' => $request->strengths,
      'weakness' => $request->weakness,
      'important_feature' => $request->important_feature,
      'police' => $request->police,
      'police_detail' => $request->police_detail,
    ];

    $pdf = PDF::loadView('web.apply.pdf', $data);

    $files = $request->schedule;
    if ($files !== null) {
      Mail::send('web.apply.message', $data, function ($message) use ($data, $pdf, $files) {
        $to = ['mail@michaellaryea.me', 'michaella@stlghana.com'];
//                    $copy = ['andrewsot@stlghana.com','michaella@stlghana.com','mail@michaellaryea.me'];
        $message
          ->subject($data["subject"])
          ->from("no-reply@safghana.org", "SAF Ghana")
          ->replyTo($data["app_email"])
          ->to($to)
//                        ->cc($copy)
          ->attachData($pdf->output(), "Application.pdf")
          ->attach($files->getRealPath(), array(
              'as' => $files->getClientOriginalName(), 'mime' => $files->getMimeType())
          );
      });
    } else {
      Mail::send('web.apply.message', $data, function ($message) use ($data, $pdf) {
        $to = ['mail@michaellaryea.me', 'michaella@stlghana.com'];
//                    $copy = ['andrewsot@stlghana.com','michaella@stlghana.com','mail@michaellaryea.me'];
        $message
          ->subject($data["subject"])
          ->from("no-reply@safghana.org", "SAF Ghana")
          ->replyTo($data["app_email"])
          ->to($to)
//                        ->cc($copy)
          ->attachData($pdf->output(), "Application.pdf");
      });
    }

    Storage::delete("web/album/applicants/$photoNameToStore");
    return redirect()->back()->with('success', 'Thank you for submitting your application as a volunteer. We will contact you shortly with the details you have provided.');
//        } catch (\Exception $e) { return redirect()->back()->withInput($request->all())->with("error", "There was a problem sending your application - ".$e->getMessage()." | ".$e->getFile()." | ".$e->getLine());}
  }

  public function application(Request $request)
  {
//        try {
    CcApplications::create($request->all());
    return redirect()->back()->with('success', 'Application submitted successfully');
//        } catch (\Exception $e) { return redirect()->back()->with("warning", "There was a problem submitting your application. Please try again"); }
  }
}
