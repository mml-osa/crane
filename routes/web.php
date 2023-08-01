<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Schema;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/uptime', function () {
  $exitCode = Artisan::call('up');
});

//CUSTOM WEB ROUTES
Route::group(['namespace' => 'Web'], function () {
  Route::get('/', 'WebController@index')->name('home');
  Route::get('/blog/{alias}', 'WebController@detail')->name('blog.detail');
  Route::get('/news/{item}', 'WebController@detail')->name('news.detail');
  Route::get('/services/{alias}', 'WebController@service')->name('service.detail');
  Route::post('/contact/submit', 'WebController@contact')->name('contact.submit');
  Route::get('/schedule/create', 'WebController@meetingCreate')->name('schedule.create');
  Route::post('/schedule/submit', 'WebController@meeting')->name('schedule.submit');
  Route::get('/brochure/create', 'WebController@brochureCreate')->name('brochure.create');
  Route::post('/meeting/submit', 'WebController@brochure')->name('brochure.submit');
  Route::post('/comments/submit/{id}', 'WebController@comments')->name('comments.store');
  Route::post('/application/submit', 'WebController@application')->name('forms.applications.submit');
  Route::get('/application/form', 'WebController@application_form')->name('forms.applications.form');
  Route::get('/online-store', 'CommerceController@index')->name('online.store');
//  if (Schema::hasTable('users')){
//    $navs = \App\Models\Nav\CcNav::where('published','1')->get();
//    foreach ($navs as $nav) {
//      Route::get("/$nav->url/", "WebController@index")->name("$nav->route");
//    }
//  }
});

Route::group(['namespace' => 'Admin'], function () {
  Auth::routes(['verify' => true]);
  Route::get('/logout', 'Auth\LoginController@logout')->name('logout');
  Route::get('/login', 'Auth\LoginController@showLoginForm')->name('login');
  Route::get('/cm-admin', 'Auth\CreateMigrateDb@setup')->name('cm-admin');
  Route::get('/create', 'Auth\CreateMigrateDb@create')->name('create');
  Route::get('/migrate', 'Auth\CreateMigrateDb@migrate')->name('migrate');
  Route::post('/login', 'Auth\LoginController@login')->name('login');
  Route::get('/register', 'Auth\RegisterController@showRegistrationForm')->name('register');
//        Route::get('/login', function () { return redirect(route('login')); });
//        Route::get('/admin', function () { return redirect(route('login')); });

  Route::group(['middleware' => ['verified', 'active', 'auth', 'web'], 'prefix' => 'cm-admin'], function () {

    Route::get('/dashboard', 'Dashboard\DashboardController@index')->name('dashboard');
    Route::get('/downtime', function () {
      $exitCode = Artisan::call('down');
    })->name('downtime');

    //LANDING PAGE
    //*********************************************************************************************//
    Route::post('/landing', 'Setting\LandingController@publish')->name('landing.publish');

    // ADMIN CATEGORIES
    //*********************************************************************************************//
    Route::group(['prefix' => 'pages', 'namespace' => 'Page'], function () {
      Route::get('/category', 'PagesCategoryController@index')->name('pages.category');
      Route::post('/category/new', 'PagesCategoryController@store')->name('pages.category.store');
      Route::post('/category/publish/{id}', 'PagesCategoryController@publish')->name('pages.category.publish');
      Route::post('/category/update/{id}', 'PagesCategoryController@update')->name('pages.category.update');
      Route::post('/category/delete/{id}', 'PagesCategoryController@destroy')->name('pages.category.destroy');

      Route::get('/all', 'PagesController@index')->name('pages.index');
      Route::get('/create', 'PagesController@create')->name('pages.create');
      Route::get('/edit/{id}', 'PagesController@edit')->name('pages.edit');
      Route::post('/store', 'PagesController@store')->name('pages.store');
      Route::post('/update/{id}', 'PagesController@update')->name('pages.update');
      Route::post('/publish/{id}', 'PagesController@publish')->name('pages.publish');
      Route::post('/featured/remove/{id}/{featured}', 'PagesController@remove_featured')->name('pages.featured.remove');
//            Route::post('/page/featured/all/{id}', 'PagesController@remove_featured_all')->name('pages.featured.all');
      Route::post('/destroy/{id}', 'PagesController@destroy')->name('pages.destroy');
    });

    // USERS ROUTES
    //*********************************************************************************************//
    Route::group(['prefix' => 'users', 'namespace' => 'User'], function () {
      Route::get('/all', 'UserController@index')->name('users');
      Route::get('/profile/{id}', 'UserController@profile')->name('users.profile');
      Route::post('/update/{id}', 'UserController@update')->name('users.update');
      Route::post('/active/{id}', 'UserController@active')->name('users.active');
      Route::post('/role/{id}', 'UserController@role')->name('users.account.role');
      Route::post('/password/{id}', 'UserController@password')->name('users.password.change');
      Route::post('/avatar/{id}', 'UserController@avatar')->name('users.avatar.change');
      Route::post('/destroy/{id}', 'UserController@destroy')->name('users.destroy');
      Route::post('/all-users/store', 'UserController@store')->name('users.store');
    });

    //POSTS CATEGORIES
    //*********************************************************************************************//
    Route::group(['prefix' => 'posts', 'namespace' => 'Post'], function () {
      Route::get('/category', 'PostCategoryController@index')->name('posts.category');
      Route::post('/category/new', 'PostCategoryController@store')->name('posts.category.store');
      Route::post('/category/publish/{id}', 'PostCategoryController@publish')->name('posts.category.publish');
      Route::post('/category/update/{id}', 'PostCategoryController@update')->name('posts.category.update');
      Route::post('/category/delete/{id}', 'PostCategoryController@destroy')->name('posts.category.destroy');

      //POSTS ROUTES
      Route::get('/all', 'PostController@index')->name('posts.index');
      Route::get('/new', 'PostController@create')->name('posts.create');
      Route::post('/new', 'PostController@store')->name('posts.store');
      Route::post('/publish/{id}', 'PostController@publish')->name('posts.publish');
      Route::get('/edit/{id}', 'PostController@edit')->name('posts.edit');
      Route::post('/update/{id}', 'PostController@update')->name('posts.update');
      Route::get('/detail/{id}', 'PostController@detail')->name('posts.detail');
      Route::post('/post/featured/remove/{id}', 'PostController@remove_featured')->name('posts.featured.remove');
      Route::post('/post/featured/all/{id}', 'PostController@remove_featured_all')->name('posts.featured.all');
      Route::post('/destroy/{id}', 'PostController@destroy')->name('posts.destroy');
    });

    //TEAM CATEGORIES
    //*********************************************************************************************//
    Route::group(['prefix' => 'team', 'namespace' => 'Team'], function () {
      Route::get('/category', 'TeamCategoryController@index')->name('team.category');
      Route::post('/category/new', 'TeamCategoryController@store')->name('team.category.store');
      Route::post('/category/publish/{id}', 'TeamCategoryController@publish')->name('team.category.publish');
      Route::post('/category/update/{id}', 'TeamCategoryController@update')->name('team.category.update');
      Route::post('/category/delete/{id}', 'TeamCategoryController@destroy')->name('team.category.destroy');

      //TEAM ROUTES
      Route::get('/all', 'TeamController@index')->name('team.index');
      Route::get('/new', 'TeamController@create')->name('team.create');
      Route::post('/new', 'TeamController@store')->name('team.store');
      Route::post('/publish/{id}', 'TeamController@publish')->name('team.publish');
      Route::get('/edit/{id}', 'TeamController@edit')->name('team.edit');
      Route::post('/update/{id}', 'TeamController@update')->name('team.update');
      Route::get('/detail/{id}', 'TeamController@detail')->name('team.detail');
      Route::post('/post/featured/remove/{id}', 'TeamController@remove_featured')->name('team.featured.remove');
      Route::post('/post/featured/all/{id}', 'TeamController@remove_featured_all')->name('team.featured.all');
      Route::post('/destroy/{id}', 'TeamController@destroy')->name('team.destroy');
    });

    //SERVICES CATEGORIES
    //*********************************************************************************************//
    Route::group(['prefix' => 'services', 'namespace' => 'Services'], function () {
      Route::get('/category', 'ServicesCategoryController@index')->name('services.category');
      Route::post('/category/new', 'ServicesCategoryController@store')->name('services.category.store');
      Route::post('/category/publish/{id}', 'ServicesCategoryController@publish')->name('services.category.publish');
      Route::post('/category/update/{id}', 'ServicesCategoryController@update')->name('services.category.update');
      Route::post('/category/delete/{id}', 'ServicesCategoryController@destroy')->name('services.category.destroy');

      //POSTS ROUTES
      Route::get('/all', 'ServicesController@index')->name('services.index');
      Route::get('/new', 'ServicesController@create')->name('services.create');
      Route::post('/new', 'ServicesController@store')->name('services.store');
      Route::post('/publish/{id}', 'ServicesController@publish')->name('services.publish');
      Route::get('/edit/{id}', 'ServicesController@edit')->name('services.edit');
      Route::post('/update/{id}', 'ServicesController@update')->name('services.update');
//                Route::get('/detail/{id}', 'ServicesController@detail')->name('services.detail');
      Route::post('/featured/remove/{id}/{featured}', 'ServicesController@remove_featured')->name('services.featured.remove');
//            Route::post('/post/featured/all/{id}', 'ServicesController@remove_featured_all')->name('services.featured.all');
      Route::post('/destroy/{id}', 'ServicesController@destroy')->name('services.destroy');
    });

    //WEBSITE PROFILE ROUTES
    //*********************************************************************************************//
    Route::group(['prefix' => 'profile', 'namespace' => 'Profile'], function () {
      Route::group(['prefix' => 'logo'], function () {
        Route::get('/', 'LogoController@index')->name('profile.logo.index');
        Route::get('/create', 'LogoController@create')->name('profile.logo.create');
        Route::post('/store', 'LogoController@store')->name('profile.logo.store');
        Route::post('/publish/{id}', 'LogoController@publish')->name('profile.logo.publish');
        Route::post('/favicon/{id}', 'LogoController@favicon')->name('profile.logo.favicon');
        Route::post('/update/{id}', 'LogoController@update')->name('profile.logo.update');
        Route::post('/destroy/{id}', 'LogoController@destroy')->name('profile.logo.destroy');
      });
      Route::group(['prefix' => 'about'], function () {
        Route::get('/', 'AboutController@index')->name('profile.about.index');
        Route::post('/store', 'AboutController@store')->name('profile.about.store');
        Route::post('/update/{id}', 'AboutController@update')->name('profile.about.update');
      });
      Route::group(['prefix' => 'address'], function () {
        Route::get('/', 'AddressController@index')->name('profile.address.index');
        Route::get('/create', 'AddressController@create')->name('profile.address.create');
        Route::post('/store', 'AddressController@store')->name('profile.address.store');
        Route::post('/publish/{id}', 'AddressController@publish')->name('profile.address.publish');
        Route::post('/favicon/{id}', 'AddressController@favicon')->name('profile.address.favicon');
        Route::post('/update/{id}', 'AddressController@update')->name('profile.address.update');
        Route::post('/main/{id}', 'AddressController@main')->name('profile.address.main');
        Route::post('/destroy/{id}', 'AddressController@destroy')->name('profile.address.destroy');
      });
      Route::group(['prefix' => 'email'], function () {
        Route::get('/', 'EmailController@index')->name('profile.email.index');
        Route::get('/create', 'EmailController@create')->name('profile.email.create');
        Route::post('/store', 'EmailController@store')->name('profile.email.store');
        Route::post('/publish/{id}', 'EmailController@publish')->name('profile.email.publish');
        Route::post('/favicon/{id}', 'EmailController@favicon')->name('profile.email.favicon');
        Route::post('/update/{id}', 'EmailController@update')->name('profile.email.update');
        Route::post('/main/{id}', 'EmailController@main')->name('profile.email.main');
        Route::post('/mail/{id}', 'EmailController@mail')->name('profile.email.mail');
        Route::post('/destroy/{id}', 'EmailController@destroy')->name('profile.email.destroy');
      });
      Route::group(['prefix' => 'phone'], function () {
        Route::get('/', 'PhoneController@index')->name('profile.phone.index');
        Route::get('/create', 'PhoneController@create')->name('profile.phone.create');
        Route::post('/store', 'PhoneController@store')->name('profile.phone.store');
        Route::post('/publish/{id}', 'PhoneController@publish')->name('profile.phone.publish');
        Route::post('/favicon/{id}', 'PhoneController@favicon')->name('profile.phone.favicon');
        Route::post('/update/{id}', 'PhoneController@update')->name('profile.phone.update');
        Route::post('/main/{id}', 'PhoneController@main')->name('profile.phone.main');
        Route::post('/destroy/{id}', 'PhoneController@destroy')->name('profile.phone.destroy');
      });
      Route::group(['prefix' => 'social'], function () {
        Route::get('/', 'SocialController@index')->name('profile.social.index');
        Route::get('/create', 'SocialController@create')->name('profile.social.create');
        Route::post('/store', 'SocialController@store')->name('profile.social.store');
        Route::post('/publish/{id}', 'SocialController@publish')->name('profile.social.publish');
        Route::post('/favicon/{id}', 'SocialController@favicon')->name('profile.social.favicon');
        Route::post('/update/{id}', 'SocialController@update')->name('profile.social.update');
        Route::post('/main/{id}', 'SocialController@main')->name('profile.social.main');
        Route::post('/destroy/{id}', 'SocialController@destroy')->name('profile.social.destroy');
      });
    });


    //WEBSITE NAVIGATION ROUTES
    //*********************************************************************************************//
    Route::group(['prefix' => 'navigation', 'namespace' => 'Nav'], function () {
      Route::group(['prefix' => 'nav'], function () {
        Route::get('/', 'NavController@index')->name('nav.index');
//                    Route::get('/{id}', 'NavController@catNav')->name('cat.nav.index');
        Route::get('/create', 'NavController@create')->name('nav.create');
        Route::post('/store', 'NavController@store')->name('nav.store');
        Route::post('/publish/{id}', 'NavController@publish')->name('nav.publish');
        Route::post('/favicon/{id}', 'NavController@favicon')->name('nav.favicon');
        Route::post('/update/{id}', 'NavController@update')->name('nav.update');
        Route::post('/destroy/{id}', 'NavController@destroy')->name('nav.destroy');

        Route::group(['prefix' => 'category'], function () {
          Route::get('/create', 'NavCatController@create')->name('nav.cat.create');
          Route::post('/store', 'NavCatController@store')->name('nav.cat.store');
          Route::post('/publish/{id}', 'NavCatController@publish')->name('nav.cat.publish');
          Route::post('/update/{id}', 'NavCatController@update')->name('nav.cat.update');
          Route::post('/destroy/{id}', 'NavCatController@destroy')->name('nav.cat.destroy');
        });
      });
    });

    //E-COMMERCE ROUTES
    //*********************************************************************************************//
    Route::group(['prefix' => 'commerce', 'namespace' => 'Commerce'], function () {
      Route::get('commerce/dashboard', 'DashboardController@index')->name('commerce.dashboard');

      Route::group(['prefix' => 'products', 'namespace' => 'Products'], function () {
        //PRODUCTS ROUTES
        Route::get('/all', 'ProductsController@index')->name('products.index');
        Route::get('/new', 'ProductsController@create')->name('products.create');
        Route::post('/new/store', 'ProductsController@store')->name('products.store');
        Route::post('/publish/{id}', 'ProductsController@publish')->name('products.publish');
        Route::get('/edit-post/{id}', 'ProductsController@edit')->name('products.edit');
        Route::post('/update/item{id}', 'ProductsController@update')->name('products.update');
        Route::get('/detail/{id}', 'ProductsController@detail')->name('products.detail');
        Route::post('/product/featured/remove/{id}', 'ProductsController@remove_featured')->name('products.featured.remove');
        Route::post('/product/featured/all/{id}', 'ProductsController@remove_featured_all')->name('products.featured.all');
        Route::post('/destroy/{id}', 'ProductsController@destroy')->name('products.destroy');

        //PRODUCTS CATEGORIES ROUTES
        Route::get('categories/all', 'ProductsCategoryController@index')->name('products.categories.index');
//          Route::get('/new', 'ProductsCategoryController@create')->name('products.categories.create');
        Route::post('/new', 'ProductsCategoryController@store')->name('products.categories.store');
        Route::post('/publish/item/{id}', 'ProductsCategoryController@publish')->name('products.categories.publish');
        // Route::get('/edit-post/{id}', 'ProductsController@edit')->name('products.edit');
        Route::post('/update/{id}', 'ProductsCategoryController@update')->name('products.categories.update');
//          Route::get('/detail/{id}', 'ProductsController@detail')->name('products.detail');
//          Route::post('/post/featured/remove/{id}', 'ProductsController@remove_featured')->name('products.featured.remove');
//          Route::post('/post/featured/all/{id}', 'ProductsController@remove_featured_all')->name('products.featured.all');
        Route::post('/destroy/item/{id}', 'ProductsCategoryController@destroy')->name('products.categories.destroy');
      });

    });

    //MEDIA ALBUM ROUTES
    //*********************************************************************************************//
    Route::group(['prefix' => 'media', 'namespace' => 'Media'], function () {
      Route::group(['prefix' => 'image'], function () {
        Route::get('/', 'MediaContentController@image')->name('media.image');
        Route::get('/create/{id}/{type}', 'MediaContentController@create')->name('media.image.create');
        Route::post('/store/{id}/{type}', 'MediaContentController@store')->name('media.image.store');
        Route::post('/caption/store', 'MediaContentController@caption')->name('media.image.caption.store');
        Route::post('/edit/{id}', 'MediaImageController@edit')->name('media.image.edit');
        Route::post('/publish/{id}', 'MediaImageController@publish')->name('media.image.publish');
        Route::post('/update/{id}', 'MediaImageController@update')->name('media.image.update');
        Route::post('/remove/{id}', 'MediaImageController@remove')->name('media.image.remove');
        Route::post('/destroy/{id}', 'MediaImageController@destroy')->name('media.image.destroy');
      });
      Route::group(['prefix' => 'audio'], function () {
        Route::get('/', 'MediaContentController@audio')->name('media.audio');
        Route::get('/create/{id}', 'MediaAudioController@create')->name('media.audio.create');
        Route::post('/store/{id}', 'MediaAudioController@store')->name('media.audio.store');
        Route::post('/caption/store', 'MediaAudioController@caption')->name('media.audio.caption.store');
        Route::post('/edit/{id}', 'MediaAudioController@edit')->name('media.audio.edit');
        Route::post('/publish/{id}', 'MediaAudioController@publish')->name('media.audio.publish');
        Route::post('/update/{id}', 'MediaAudioController@update')->name('media.audio.update');
        Route::post('/remove/{id}', 'MediaAudioController@remove')->name('media.audio.remove');
        Route::post('/destroy/{id}', 'MediaAudioController@destroy')->name('media.audio.destroy');
      });
      Route::group(['prefix' => 'video'], function () {
        Route::get('/', 'MediaContentController@video')->name('media.video');
        Route::get('/create/{id}', 'MediaVideoController@create')->name('media.video.create');
        Route::post('/store/{id}', 'MediaVideoController@store')->name('media.video.store');
        Route::post('/caption/store', 'MediaVideoController@caption')->name('media.video.caption.store');
        Route::post('/edit/{id}', 'MediaVideoController@edit')->name('media.video.edit');
        Route::post('/publish/{id}', 'MediaVideoController@publish')->name('media.video.publish');
        Route::post('/update/{id}', 'MediaVideoController@update')->name('media.video.update');
        Route::post('/remove/{id}', 'MediaVideoController@remove')->name('media.video.remove');
        Route::post('/destroy/{id}', 'MediaVideoController@destroy')->name('media.video.destroy');
      });
      Route::group(['prefix' => 'document'], function () {
        Route::get('/', 'MediaContentController@document')->name('media.document');
        Route::get('/create/{id}', 'MediaDocumentController@create')->name('media.document.create');
        Route::post('/store/{id}', 'MediaDocumentController@store')->name('media.document.store');
        Route::post('/caption/store', 'MediaDocumentController@caption')->name('media.document.caption.store');
        Route::post('/edit/{id}', 'MediaDocumentController@edit')->name('media.document.edit');
        Route::post('/publish/{id}', 'MediaDocumentController@publish')->name('media.document.publish');
        Route::post('/update/{id}', 'MediaDocumentController@update')->name('media.document.update');
        Route::post('/remove/{id}', 'MediaDocumentController@remove')->name('media.document.remove');
        Route::post('/destroy/{id}', 'MediaDocumentController@destroy')->name('media.document.destroy');
      });
      Route::group(['prefix' => 'album'], function () {
        Route::get('/', 'MediaAlbumController@index')->name('media.album');
        Route::post('/store', 'MediaAlbumController@store')->name('media.album.store');
        Route::post('/publish{id}', 'MediaAlbumController@publish')->name('media.album.publish');
        Route::post('/update{id}', 'MediaAlbumController@update')->name('media.album.update');
        Route::post('/destroy{id}', 'MediaAlbumController@destroy')->name('media.album.destroy');
      });
//                Route::group(['prefix' => 'content'], function () {
//                    Route::get('/create/{id}', 'MediaContentController@create')->name('media.content.create');
//                    Route::post('/store/{id}', 'MediaContentController@store')->name('media.content.store');
//                    Route::post('/edit/{item_id}/{type_id}', 'MediaContentController@edit')->name('media.content.edit');
//                    Route::post('/update/{item_id}/{album_id}', 'MediaContentController@update')->name('media.content.update');
//                    Route::post('/publish/{id}', 'MediaContentController@publish')->name('media.content.publish');
//                    Route::post('/destroy/{id}', 'MediaContentController@destroy')->name('media.content.destroy');
//                });
    });

    Route::group(['prefix' => 'comment', 'namespace' => 'Comment'], function () {
      Route::get('/all', 'CommentController@index')->name('comment.index');
      Route::get('/new', 'CommentController@create')->name('comment.create');
      Route::post('/new', 'CommentController@store')->name('comment.store');
      Route::post('/publish/{id}', 'CommentController@publish')->name('comment.publish');
      Route::get('/edit/{id}', 'CommentController@edit')->name('comment.edit');
      Route::post('/update/{id}', 'CommentController@update')->name('comment.update');
      Route::get('/detail/{id}', 'CommentController@detail')->name('comment.detail');
      Route::post('/destroy/{id}', 'CommentController@destroy')->name('comment.destroy');
    });

    Route::group(['prefix' => 'forms', 'namespace' => 'Forms'], function () {
      Route::get('/applications', 'FormsController@index')->name('forms.applications');
      Route::post('/applications/{id}', 'FormsController@destroy')->name('forms.applications.destroy');
      Route::get('/newsletter', 'FormsController@store')->name('forms.newsletter');
//                Route::post('/publish/{id}', 'CommentController@publish')->name('comment.publish');
//                Route::get('/edit/{id}', 'CommentController@edit')->name('comment.edit');
//                Route::post('/update/{id}', 'CommentController@update')->name('comment.update');
//                Route::get('/detail/{id}', 'CommentController@detail')->name('comment.detail');
//                Route::post('/destroy/{id}', 'CommentController@destroy')->name('comment.destroy');
    });

    //EVENTS ROUTES
    //*********************************************************************************************//
    Route::group(['prefix' => 'event', 'namespace' => 'Event'], function () {
      Route::get('/all', 'EventController@index')->name('event.index');
      Route::get('/create', 'EventController@create')->name('event.create');
      Route::post('/store', 'EventController@store')->name('event.store');
      Route::post('/current/{id}', 'EventController@current')->name('event.current');
      Route::post('/publish/{id}', 'EventController@publish')->name('event.publish');
      Route::get('/copy/{id}', 'EventController@copy')->name('event.copy');
      Route::get('/edit/{id}', 'EventController@edit')->name('event.edit');
      Route::post('/update/{id}', 'EventController@update')->name('event.update');
      Route::post('/destroy/{id}', 'EventController@destroy')->name('event.destroy');

      Route::group(['prefix' => 'category'], function () {
        Route::get('/', 'EventCategoryController@index')->name('event.category');
        Route::post('/new', 'EventCategoryController@store')->name('event.category.store');
        Route::post('/publish/{id}', 'EventCategoryController@publish')->name('event.category.publish');
        Route::post('/update/{id}', 'EventCategoryController@update')->name('event.category.update');
        Route::post('/delete/{id}', 'EventCategoryController@destroy')->name('event.category.destroy');
      });
    });
  });
});
