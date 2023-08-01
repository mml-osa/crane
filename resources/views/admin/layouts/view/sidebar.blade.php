<?
use Illuminate\Support\Facades\Auth;
?>

<div class="page-sidebar-wrapper">
  <!-- BEGIN SIDEBAR -->
  <!-- DOC: Set data-auto-scroll="false" to disable the sidebar from auto scrolling/focusing -->
  <!-- DOC: Change data-auto-speed="200" to adjust the sub menu slide up/down speed -->
  <div class="page-sidebar navbar-collapse collapse">
    <!-- BEGIN SIDEBAR MENU -->
    <!-- DOC: Apply "page-sidebar-menu-light" class right after "page-sidebar-menu" to enable light sidebar menu style(without borders) -->
    <!-- DOC: Apply "page-sidebar-menu-hover-submenu" class right after "page-sidebar-menu" to enable hoverable(hover vs accordion) sub menu mode -->
    <!-- DOC: Apply "page-sidebar-menu-closed" class right after "page-sidebar-menu" to collapse("page-sidebar-closed" class must be applied to the body element) the sidebar sub menu mode -->
    <!-- DOC: Set data-auto-scroll="false" to disable the sidebar from auto scrolling/focusing -->
    <!-- DOC: Set data-keep-expand="true" to keep the submenues expanded -->
    <!-- DOC: Set data-auto-speed="200" to adjust the sub menu slide up/down speed -->
    <ul class="page-sidebar-menu  page-header-fixed page-sidebar-menu-light " data-keep-expanded="false"
        data-auto-scroll="true" data-slide-speed="200" style="padding-top: 20px">
      <!-- DOC: To remove the sidebar toggler from the sidebar you just need to completely remove the below "sidebar-toggler-wrapper" LI element -->
      <!-- BEGIN SIDEBAR TOGGLER BUTTON -->
      <li class="sidebar-toggler-wrapper hide">
        <div class="sidebar-toggler">
          <span></span>
        </div>
      </li>
      <!-- END SIDEBAR TOGGLER BUTTON -->
      <!-- DOC: To remove the search box from the sidebar you just need to completely remove the below "sidebar-search-wrapper" LI element -->
      {{--            <li class="sidebar-search-wrapper">--}}
      {{--                <!-- BEGIN RESPONSIVE QUICK SEARCH FORM -->--}}
      {{--                <!-- DOC: Apply "sidebar-search-bordered" class the below search form to have bordered search box -->--}}
      {{--                <!-- DOC: Apply "sidebar-search-bordered sidebar-search-solid" class the below search form to have bordered & solid search box -->--}}
      {{--                <form class="sidebar-search  " action="http://keenthemes.com/preview/metronic/theme/admin_1/page_general_search_3.html" method="POST">--}}
      {{--                    <a href="javascript:;" class="remove">--}}
      {{--                        <i class="icon-close"></i>--}}
      {{--                    </a>--}}
      {{--                    <div class="input-group">--}}
      {{--                        <input type="text" class="form-control" placeholder="Search...">--}}
      {{--                        <span class="input-group-btn">--}}
      {{--                            <a href="javascript:;" class="btn submit">--}}
      {{--                                <i class="icon-magnifier"></i>--}}
      {{--                            </a>--}}
      {{--                        </span>--}}
      {{--                    </div>--}}
      {{--                </form>--}}
      {{--                <!-- END RESPONSIVE QUICK SEARCH FORM -->--}}
      {{--            </li>--}}

      <!-- Dashboard -->
      <li class="nav-item start @if (strpos($_SERVER['REQUEST_URI'], "admin/dashboard")) active @endif">
        <a href="{{route('dashboard')}}" class="nav-link nav-toggle">
          <i class="icon-speedometer"></i>
          <span class="title">Dashboard</span>
        </a>
      </li>

      <!-- Features Column -->
      <li class="heading"><h3 class="uppercase">Features</h3></li>

      <!-- Pages Links -->
      <li class="nav-item @if (strpos($_SERVER['REQUEST_URI'], "pages")) active @endif">
        <a href="javascr ipt:;" class="nav-link nav-toggle">
          <i class="icon-notebook"></i>
          <span class="title">Pages</span>
          <span class="arrow"></span>
        </a>
        <ul class="sub-menu">
          <li class="nav-item @if (strpos($_SERVER['REQUEST_URI'], "pages/all")) active @endif">
            <a href="{{route('pages.index')}}" class="nav-link ">
              <?php $pageCount = \App\Models\Pages\CcPage::count(); ?>
              <span class="title">All Pages</span>
              <span class="badge badge-primary">{{$pageCount}}</span>
            </a>
          </li>
          <li class="nav-item @if (strpos($_SERVER['REQUEST_URI'], "pages/create")) active @endif">
            <a href="{{ route('pages.create') }}" class="nav-link ">
              <span class="title">New Page</span>
            </a>
          </li>
          <li class="nav-item @if (strpos($_SERVER['REQUEST_URI'], "pages/category")) active @endif">
            <a href="{{ route('pages.category') }}" class="nav-link ">
              <span class="title">Page Categories</span>
              <?php $itemCount = \App\Models\Pages\CcPagesCategory::all()->count(); ?>
              <span class="badge badge-primary">{{$itemCount}}</span>
            </a>
          </li>
        </ul>
      </li>

      <li class="nav-item @if (strpos($_SERVER['REQUEST_URI'], "nav")) active @endif">
        <a href="javascr ipt:;" class="nav-link nav-toggle">
          <i class="icon-folder"></i>
          <span class="title">Menu</span>
          <span class="arrow"></span>
        </a>
        <ul class="sub-menu">
          <li class="nav-item @if (strpos($_SERVER['REQUEST_URI'], "nav/manage")) active @endif">
            <a href="{{route('nav.index')}}" class="nav-link ">
              <?php $navCount = \App\Models\Nav\CcNav::count(); ?>
              <span class="title">Manage</span>
              <span class="badge badge-primary">{{$navCount}}</span>
            </a>
          </li>
        </ul>
      </li>

      <!-- Posts Links -->
      <li class="nav-item @if (strpos($_SERVER['REQUEST_URI'], "posts")) active @endif">
        <a href="javascript:;" class="nav-link nav-toggle">
          <i class="icon-note"></i>
          <span class="title">Posts</span>
          <span class="arrow"></span>
        </a>
        <ul class="sub-menu">
          <li class="nav-item @if (strpos($_SERVER['REQUEST_URI'], "posts/all")) active @endif">
            <a href="{{route('posts.index')}}" class="nav-link ">
              <?php $postCount = \App\Models\Post\CcPost::count(); ?>
              <span class="title">All Posts</span>
              <span class="badge badge-primary">{{$postCount}}</span>
            </a>
          </li>
          <li class="nav-item @if (strpos($_SERVER['REQUEST_URI'], "posts/new")) active @endif">
            <a href="{{route('posts.create')}}" class="nav-link ">
              <span class="title">New Post</span>
            </a>
          </li>
          <li class="nav-item @if (strpos($_SERVER['REQUEST_URI'], "posts/category")) active @endif">
            <a href="{{ route('posts.category') }}" class="nav-link ">
              <?php $catsCount = \App\Models\Post\CcPostCategory::count(); ?>
              <span class="title">Post Category</span>
              <span class="badge badge-primary">{{$catsCount}}</span>
            </a>
          </li>
        </ul>
      </li>

      <!-- Events Links -->
      <li class="nav-item @if (strpos($_SERVER['REQUEST_URI'], "event")) active @endif">
        <a href="javascript:;" class="nav-link nav-toggle">
          <i class="icon-graduation"></i>
          <span class="title">Events</span>
          <span class="arrow"></span>
        </a>
        <ul class="sub-menu">
          <li class="nav-item @if (strpos($_SERVER['REQUEST_URI'], "event/all")) active @endif">
            <a href="{{route('event.index')}}" class="nav-link ">
              <?php $eventsCount = \App\Models\Events\CcEvents::count(); ?>
              <span class="title">All Events</span>
              <span class="badge badge-primary">{{$eventsCount}}</span>
            </a>
          </li>
          <li class="nav-item @if (strpos($_SERVER['REQUEST_URI'], "event/create")) active @endif">
            <a href="{{route('event.create')}}" class="nav-link ">
              <span class="title">New Event</span>
            </a>
          </li>
        </ul>
      </li>

      <!-- Services Links -->
      <li class="nav-item @if (strpos($_SERVER['REQUEST_URI'], "services")) active @endif">
        <a href="javascript:;" class="nav-link nav-toggle">
          <i class="icon-bulb"></i>
          <span class="title">Services</span>
          <span class="arrow"></span>
        </a>
        <ul class="sub-menu">
          <li class="nav-item  ">
            <a href="{{ route('services.index') }}" class="nav-link ">
              <span class="title">All Services</span>
              <?php $itemCount = \App\Models\Services\CcServices::all()->count(); ?>
              <span class="badge badge-primary">{{$itemCount}}</span>
            </a>
          </li>
          <li class="nav-item  ">
            <a href="{{ route('services.create') }}" class="nav-link ">
              <span class="title">New Service</span>
            </a>
          </li>
          <li class="nav-item  ">
            <a href="{{ route('services.category') }}" class="nav-link ">
              <span class="title">Service Categories</span>
              <?php $itemCount = \App\Models\Services\CcServicesCategory::all()->count(); ?>
              <span class="badge badge-primary">{{$itemCount}}</span>
            </a>
          </li>
        </ul>
      </li>

      <!-- Team Links -->
      <li class="nav-item @if (strpos($_SERVER['REQUEST_URI'], "team")) active @endif">
        <a href="javascript:;" class="nav-link nav-toggle">
          <i class="icon-users"></i>
          <span class="title">Team</span>
          <span class="arrow"></span>
        </a>
        <ul class="sub-menu">
          <li class="nav-item  ">
            <a href="{{ route('team.index') }}" class="nav-link ">
              <span class="title">All Members</span>
              <?php $itemCount = \App\Models\Team\CcTeam::all()->count(); ?>
              <span class="badge badge-primary">{{$itemCount}}</span>
            </a>
          </li>
          <li class="nav-item  ">
            <a href="{{ route('team.create') }}" class="nav-link ">
              <span class="title">New Member</span>
            </a>
          </li>
          <li class="nav-item  ">
            <a href="{{ route('team.category') }}" class="nav-link ">
              <span class="title">Team Categories</span>
              <?php $itemCount = \App\Models\Services\CcServicesCategory::all()->count(); ?>
              <span class="badge badge-primary">{{$itemCount}}</span>
            </a>
          </li>
        </ul>
      </li>

      <!-- Media Links -->
      <li class="nav-item @if (strpos($_SERVER['REQUEST_URI'], "media")) active @endif">
        <a href="javascript:;" class="nav-link nav-toggle">
          <i class="icon-picture"></i>
          <span class="title">Media</span>
          <span class="arrow"></span>
        </a>
        <ul class="sub-menu">
          <li class="nav-item @if (strpos($_SERVER['REQUEST_URI'], "media/album")) active @endif">
            <a href="{{route('media.album')}}" class="nav-link ">
              <span class="title">Album</span>
              <?php $albumCount = \App\Models\Media\CcMediaAlbum::count(); ?>
              <span class="badge badge-primary">{{$albumCount}}</span>
            </a>
          </li>
          <li class="nav-item @if (strpos($_SERVER['REQUEST_URI'], "media/image")) active @endif">
            <a href="{{route('media.image')}}" class="nav-link ">
              <span class="title">Images</span>
              <?php
              $itemCount = \App\Models\Media\CcMediaItem::all();
              $imageCount = 0;
              foreach ($itemCount as $items) if ($items->mediaAlbum->mediaType['alias'] == 'image') {
                $imageCount = $items->count();
              };
              ?>
              <span class="badge badge-primary">{{$imageCount}}</span>
            </a>
          </li>
          <li class="nav-item @if (strpos($_SERVER['REQUEST_URI'], "media/audio")) active @endif">
            <a href="{{route('media.audio')}}" class="nav-link ">
              <span class="title">Audio</span>
              <span class="badge badge-primary">0</span>
            </a>
          </li>
          <li class="nav-item @if (strpos($_SERVER['REQUEST_URI'], "media/videos")) active @endif">
            <a href="{{route('media.video')}}" class="nav-link ">
              <span class="title">Videos</span>
              <span class="badge badge-primary">0</span>
            </a>
          </li>
          <li class="nav-item @if (strpos($_SERVER['REQUEST_URI'], "media/document")) active @endif">
            <a href="{{route('media.document')}}" class="nav-link ">
              <span class="title">Documents</span>
              <span class="badge badge-primary">0</span>
            </a>
          </li>
        </ul>
      </li>

      <!-- Comments Links -->
      <li class="nav-item @if (strpos($_SERVER['REQUEST_URI'], "comment")) active @endif">
        <a href="dashboard_28a36.html?p=" class="nav-link nav-toggle">
          <i class="icon-speech"></i>
          <span class="title">Comments</span>
          <span class="arrow"></span>
        </a>
        <ul class="sub-menu">
          <li class="nav-item  ">
            <?php $commentCount = \App\Models\Post\CcPostComment::count(); ?>
            <a href="{{route('comment.index')}}" class="nav-link ">
              <span class="title">All Comments</span>
              <span class="badge badge-primary">{{$commentCount}}</span>
            </a>
          </li>
          <li class="nav-item  ">
            <a href="{{route('comment.create')}}" class="nav-link ">
              <span class="title">New Comment</span>
            </a>
          </li>
        </ul>
      </li>

      <!-- Projects Links -->
      <li class="nav-item @if (strpos($_SERVER['REQUEST_URI'], "projects")) active @endif">
        <a href="javascript:;" class="nav-link nav-toggle">
          <i class="icon-bar-chart"></i>
          <span class="title">Projects</span>
          <span class="arrow"></span>
        </a>
        <ul class="sub-menu">
          <li class="nav-item  ">
            <a href="charts_amcharts.html" class="nav-link ">
              <span class="title">All Projects</span>
            </a>
          </li>
          <li class="nav-item  ">
            <a href="charts_flotcharts.html" class="nav-link ">
              <span class="title">New Project</span>
            </a>
          </li>
          <li class="nav-item  ">
            <a href="charts_flowchart.html" class="nav-link ">
              <span class="title">Project Categories</span>
            </a>
          </li>
        </ul>
      </li>

      <!-- Profile Links -->
      <li class="nav-item @if (strpos($_SERVER['REQUEST_URI'], "admin/profile")) active @endif">
        <a href="javascript:;" class="nav-link nav-toggle">
          <i class="icon-info"></i>
          <span class="title">Profile</span>
          <span class="arrow"></span>
        </a>
        <ul class="sub-menu">
          <li class="nav-item @if (strpos($_SERVER['REQUEST_URI'], "profile/logo")) active @endif">
            <a href="{{route('profile.logo.index')}}" class="nav-link ">
              <span class="title">Logo</span>
            </a>
          </li>
          <li class="nav-item @if (strpos($_SERVER['REQUEST_URI'], "profile/about")) active @endif">
            <a href="{{route('profile.about.index')}}" class="nav-link ">
              <span class="title">About</span>
            </a>
          </li>
          <li class="nav-item @if (strpos($_SERVER['REQUEST_URI'], "profile/address")) active @endif">
            <a href="{{route('profile.address.index')}}" class="nav-link ">
              <span class="title">Address</span>
            </a>
          </li>
          <li class="nav-item @if (strpos($_SERVER['REQUEST_URI'], "profile/email")) active @endif">
            <a href="{{route('profile.email.index')}}" class="nav-link ">
              <span class="title">Email</span>
            </a>
          </li>
          <li class="nav-item @if (strpos($_SERVER['REQUEST_URI'], "profile/phone")) active @endif">
            <a href="{{route('profile.phone.index')}}" class="nav-link ">
              <span class="title">Phone</span>
            </a>
          </li>
          <li class="nav-item @if (strpos($_SERVER['REQUEST_URI'], "profile/social")) active @endif">
            <a href="{{route('profile.social.index')}}" class="nav-link ">
              <span class="title">Social</span>
            </a>
          </li>
        </ul>
      </li>

      <!-- Forms Links -->
      <li class="nav-item @if (strpos($_SERVER['REQUEST_URI'], "forms")) active @endif">
        <a href="javascript:;" class="nav-link nav-toggle">
          <i class="icon-doc"></i>
          <span class="title">Forms</span>
          <span class="arrow"></span>
        </a>
        <ul class="sub-menu">
          <li class="nav-item @if (strpos($_SERVER['REQUEST_URI'], "forms/applications")) active @endif">
            <a href="{{route('forms.applications')}}" class="nav-link ">
              <span class="title">Applications</span>
            </a>
          </li>
          <li class="nav-item @if (strpos($_SERVER['REQUEST_URI'], "forms/newsletter")) active @endif">
            <a href="{{route('forms.newsletter')}}" class="nav-link ">
              <span class="title">Newsletter</span>
            </a>
          </li>
        </ul>
      </li>

      <!-- Setting Links -->
      <li class="nav-item @if (strpos($_SERVER['REQUEST_URI'], "setting")) active @endif">
        <a href="javascript:;" class="nav-link nav-toggle">
          <i class="icon-settings"></i>
          <span class="title">Setting</span>
          <span class="arrow"></span>
        </a>
        <ul class="sub-menu">
          <li class="nav-item  ">
            <a href="layout_content_grey.html" class="nav-link ">
              <span class="title">Pricing</span>
            </a>
          </li>
          <li class="nav-item  ">
            <a href="#landing" data-toggle="modal" data-target="#landing" class="nav-link ">
              <span class="title">Landing Page</span>
              @if(session('landing') != null && session('landing')->state == 1)
                <span
                  class="badge badge-danger"> Deactivate </span>
              @else
                <span class="badge badge-success"> Activate </span>
              @endif
            </a>
          </li>
          <li class="nav-item">
            <a href="#maintenance" data-toggle="modal" data-target="#maintenance" class="nav-link ">
              <span class="title">Maintenance</span>
            </a>
          </li>
        </ul>
      </li>

      <!-- Commerce Column -->
      <li class="heading"><h3 class="uppercase">eCommerce</h3></li>

      <!-- Dashboard -->
      <li class="nav-item start @if (strpos($_SERVER['REQUEST_URI'], "commerce/dashboard")) active @endif">
        <a href="{{route('commerce.dashboard')}}" class="nav-link nav-toggle">
          <i class="icon-speedometer"></i>
          <span class="title">Dashboard</span>
        </a>
      </li>

      <!-- Products Links -->
      <?php $productCount = \App\Models\Commerce\CcProduct::all()->count(); ?>
      <?php $productCatCount = \App\Models\Commerce\CcProductCategory::all()->count(); ?>
      <li class="nav-item @if (strpos($_SERVER['REQUEST_URI'], "commerce/products")) active @endif">
        <a href="javascript:;" class="nav-link nav-toggle">
          <i class="icon-list"></i>
          <span class="title">Products</span>
          <span class="arrow"></span>
        </a>
        <ul class="sub-menu">
          <li class="nav-item @if (strpos($_SERVER['REQUEST_URI'], "products/all")) active @endif">
            <a href="{{route('products.index')}}" class="nav-link ">
              <span class="title">All Products</span>
              <span class="badge badge-primary">{{$productCount}}</span>
            </a>
          </li>
          <li class="nav-item @if (strpos($_SERVER['REQUEST_URI'], "products/new")) active @endif">
            <a href="{{route('products.create')}}" class="nav-link ">
              <span class="title">New Product</span>

            </a>
          </li>
          <li class="nav-item @if (strpos($_SERVER['REQUEST_URI'], "products/categories")) active @endif">
            <a href="{{route('products.categories.index')}}" class="nav-link ">
              <span class="title">Product Categories</span>
              <span class="badge badge-primary">{{$productCatCount}}</span>
            </a>
          </li>
        </ul>
      </li>

      <!-- Order History -->
      <li class="nav-item @if (strpos($_SERVER['REQUEST_URI'], "e-commerce/order-history")) active @endif">
        <a href="{{route('commerce.dashboard')}}" class="nav-link nav-toggle">
          <i class="icon-clock"></i>
          <span class="title">Order History</span>
        </a>
      </li>

      <!-- System Column -->
      <li class="heading"><h3 class="uppercase">System</h3></li>

      <!-- Users Links -->
      <li class="nav-item @if (strpos($_SERVER['REQUEST_URI'], "users/all")) active @endif">
        <a href="javascript:;" class="nav-link nav-toggle">
          <i class="icon-users"></i>
          <span class="title">Users</span>
          <span class="arrow"></span>
        </a>
        <ul class="sub-menu">
          <li class="nav-item @if (strpos($_SERVER['REQUEST_URI'], "all-users")) active @endif">
            <a href="{{ route('users') }}" class="nav-link ">
              <span class="title">All Users</span>
            </a>
          </li>
          <li class="nav-item @if (strpos($_SERVER['REQUEST_URI'], "new-user")) active @endif ">
            <a data-toggle="modal" data-target="#newUserAccount" class="nav-link ">
              <span class="title">New User</span>
            </a>
          </li>
          <li class="nav-item  ">
            <a href="#." class="nav-link ">
              <span class="title">Log History</span>
            </a>
          </li>
        </ul>
      </li>

      <!-- Account Column -->
      <li class="heading"><h3 class="uppercase">My Account</h3></li>

      <!-- My Profile -->
      <li class="nav-item @if (strpos($_SERVER['REQUEST_URI'], "users/profile")) active @endif">
        <a href="{{route('users.profile',$session->id)}}" class="nav-link nav-toggle">
          <i class="icon-user"></i>
          <span class="title">Profile</span>
        </a>
      </li>

      <!-- Logout -->
      <li class="nav-item">
        <a href="{{route('logout')}}" class="nav-link nav-toggle"
           onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
          <i class="icon-lock"></i>
          <span class="title">Log Out</span>
        </a>
      </li>
    </ul>
    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
      @csrf
    </form>

    <!-- END SIDEBAR MENU -->
  </div>
  <!-- END SIDEBAR -->
  <div class="modal fade" id="landing" tabindex="-1" role="form" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
          <h4 class="modal-title">@if(session('landing') != null && session('landing')->state == 0)
              Publish
            @else
              Unpublish
            @endif Landing Page </h4>
        </div>
        <div class="modal-body text-center"> Are you sure you want
          to @if(session('landing') != null && session('landing')->state == 0)
            activate
          @else
            deactivate
          @endif the landing page?
        </div>
        <div class="modal-footer">
          <form class="form-horizontal" method="post" action="{{ route('landing.publish') }}">
            @csrf
            @if(session('landing') != null && session('landing')->state == 0)
              <input type="hidden" name="switch" value="1">
            @else
              <input type="hidden" name="switch" value="0">
            @endif
            <button type="submit" class="btn btn-sm blue">Yes</button>
            <button type="button" class="btn btn-sm dark btn-outline" data-dismiss="modal">No</button>
          </form>
        </div>
      </div>
      <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
  </div>

  <div class="modal fade" id="maintenance" tabindex="-1" role="form" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
          <h4 class="modal-title">Enable Maintenance</h4>
        </div>
        <div class="modal-body text-center"> Are you sure you want to turn on maintenance mode?</div>
        <div class="modal-footer">
          <form class="form-horizontal" method="post" action="{{ route('downtime') }}">
            @csrf
            <button type="submit" class="btn btn-sm blue">Yes</button>
            <button type="button" class="btn btn-sm dark btn-outline" data-dismiss="modal">No</button>
          </form>
        </div>
      </div>
      <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
  </div>
</div>
