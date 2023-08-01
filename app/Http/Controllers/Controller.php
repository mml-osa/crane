<?php

namespace App\Http\Controllers;

use App\Models\Media\CcMediaAlbum;
use App\Models\Media\CcMediaItem;
use App\Models\Nav\CcNav;
use App\Models\Profile\CcAbout;
use App\Models\Profile\CcAddress;
use App\Models\Profile\CcEmail;
use App\Models\Profile\CcLogo;
use App\Models\Profile\CcPhone;
use App\Models\Profile\CcSocial;
use App\Models\Setting\CcLanding;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Support\Facades\Auth;

class Controller extends BaseController
{
  use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

  public function sessionVariables()
  {
    $BannerAlbum = CcMediaAlbum::where('alias', 'banner')->first();
    if ($BannerAlbum != null) {
      $BannerImg = CcMediaItem::where('album_id', $BannerAlbum->id)->get();
    }
    $Landing = CcLanding::first();
    $LandingImg = CcMediaAlbum::where('alias', 'landing')->first();
    $session = Auth::user();
    $Logo = CcLogo::where('published', 1)->first();
    $Favicon = CcLogo::where('favicon', 1)->first();
    $CcAbout = CcAbout::first();
    $CcAddress = CcAddress::where('main', 1)->first();
    $EmailMain = CcEmail::where('main', 1)->first();
    $FormMail = CcEmail::where('mail', 1)->first();
    $PhoneMain = CcPhone::where('main', 1)->first();
    $Email = CcEmail::all();
    $Address = CcAddress::all();
    $Phone = CcPhone::all();
    $CcMediaItem = CcMediaItem::where('published', 1)->ordered();
    $CcSocial = CcSocial::all();
    $CcNav = CcNav::all();
    session([
      'session' => $session,
      'logo' => $Logo,
      'favicon' => $Favicon,
      'landing' => $Landing,
      'landingImage' => $LandingImg,
      'bannerImg' => $BannerImg ?? null,
      'profile' => $CcAbout,
      'addressMain' => $CcAddress,
      'emails' => $Email,
      'phones' => $Phone,
      'addresses' => $Address,
      'emailMain' => $EmailMain,
      'formMail' => $FormMail,
      'phoneMain' => $PhoneMain,
      'mediaItems' => $CcMediaItem,
      'socials' => $CcSocial,
      'navs' => $CcNav,
    ]);
  }
}
