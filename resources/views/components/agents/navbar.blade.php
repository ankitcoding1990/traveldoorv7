
  <div class="art-bg">
    <!--  <img src="https://adminvoice-admin-template.multipurposethemes.com/images/art1.svg" alt="" class="art-img light-img">
     <img src="https://adminvoice-admin-template.multipurposethemes.com/images/art2.svg" alt="" class="art-img dark-img">
     <img src="https://adminvoice-admin-template.multipurposethemes.com/images/art-bg.svg" alt="" class="wave-img light-img">
     <img src="https://adminvoice-admin-template.multipurposethemes.com/images/art-bg2.svg" alt="" class="wave-img dark-img"> -->
 </div>
 <header class="main-header">
   <!-- Logo -->
   <a href="{{route('agent.dashboard')}}" class="logo">



     <!-- mini logo -->
     <div class="logo-mini">

           <span class="light-logo">
               @if(auth()->guard('agent')->user()->agent_logo)
               <img src="{{ asset('assets/uploads/agent_logos') }}/{{auth()->guard('agent')->user()->agent_logo}}" alt="logo" style="width:auto;height:60px; object-fit:contain">
           @else
           <img src="{{ asset('assets/images/logo-traveldoor.png') }}" alt="logo" style="width:auto;height:60px; object-fit:contain">
           @endif
           </span>
           <span class="dark-logo"><img src="" alt="logo"></span>


     </div>
   </a>
   <!-- Header Navbar -->
   <nav class="navbar navbar-static-top">

     <div class="app-menu">
       <ul class="header-megamenu nav">
           <li class="btn-group nav-item">
               <a href="#" class="nav-link rounded" id="expand" data-toggle="push-menu" role="button">
                   <i class="nav-link-icon mdi mdi-menu text-white"></i>
               </a>
           </li>
           <li class="btn-group nav-item">
               <a href="#" data-provide="fullscreen" class="nav-link rounded" title="Full Screen">
                   <i class="nav-link-icon mdi mdi-crop-free text-white"></i>
               </a>
           </li>
           <!-- <li class="btn-group nav-item d-xl-inline-flex d-none">
               <a href="#" class="nav-link rounded" data-toggle="dropdown" aria-expanded="false">
                   <i class="nav-link-icon mdi mdi-view-dashboard text-white mx-5 mx-lg-0"> </i>
                   <span class="d-xl-inline-block d-none">MEGA
                   <i class="mdi mdi-dots-vertical ml-2"></i></span>
               </a>
               <div class="dropdown-menu dropdown-grid">
                   <div class="dropdown-mega-menu">
                       <div class="row">
                           <div class="col-lg-4 col-12">
                               <ul class="nav flex-column">
                                   <li class="nav-item-header nav-item">
                                       Overview
                                   </li>
                                   <li class="nav-item">
                                       <a href="javascript:void(0);" class="nav-link">
                                           <i class="nav-link-icon fa fa-inbox mr-10">
                                           </i>
                                           <span>
                                               Contacts
                                           </span>
                                       </a>
                                   </li>
                                   <li class="nav-item">
                                       <a href="javascript:void(0);" class="nav-link">
                                           <i class="nav-link-icon fa fa-book mr-10">
                                           </i>
                                           <span>
                                               Incidents
                                           </span>
                                           <div class="ml-auto badge badge-pill badge-danger">5
                                           </div>
                                       </a>
                                   </li>
                                   <li class="nav-item">
                                       <a href="javascript:void(0);" class="nav-link">
                                           <i class="nav-link-icon fa fa-picture-o mr-10">
                                           </i>
                                           <span>
                                               Companies
                                           </span>
                                       </a>
                                   </li>
                                   <li class="nav-item">
                                       <a href="javascript:void(0);" class="nav-link disabled">
                                           <i class="nav-link-icon fa fa-dashboard mr-10">
                                           </i>
                                           <span>
                                               Dashboards
                                           </span>
                                       </a>
                                   </li>
                               </ul>
                           </div>
                           <div class="col-lg-4 col-12 bx-1">
                               <ul class="nav flex-column">
                                   <li class="nav-item-header nav-item">
                                       Favourites
                                   </li>
                                   <li class="nav-item">
                                       <a href="javascript:void(0);" class="nav-link">
                                           Reports Conversions
                                       </a>
                                   </li>
                                   <li class="nav-item">
                                       <a href="javascript:void(0);" class="nav-link">
                                           Quick Start
                                           <div class="ml-auto badge badge-success">New</div>
                                       </a>
                                   </li>
                                   <li class="nav-item">
                                       <a href="javascript:void(0);" class="nav-link">Users &amp; Groups</a>
                                   </li>
                                   <li class="nav-item">
                                       <a href="javascript:void(0);" class="nav-link">Proprieties</a>
                                   </li>
                               </ul>
                           </div>
                           <div class="col-lg-4 col-12">
                               <ul class="nav flex-column">
                                   <li class="nav-item-header nav-item">
                                       Sales & Marketing
                                   </li>
                                   <li class="nav-item">
                                       <a href="javascript:void(0);" class="nav-link">Queues
                                       </a>
                                   </li>
                                   <li class="nav-item">
                                       <a href="javascript:void(0);" class="nav-link">Resource Groups
                                       </a>
                                   </li>
                                   <li class="nav-item">
                                       <a href="javascript:void(0);" class="nav-link">Goal Metrics
                                           <div class="ml-auto badge badge-warning">3
                                           </div>
                                       </a>
                                   </li>
                                   <li class="nav-item">
                                       <a href="javascript:void(0);" class="nav-link">Campaigns
                                       </a>
                                   </li>
                               </ul>
                           </div>
                       </div>
                   </div>
               </div>
           </li>
           <li class="dropdown nav-item d-xl-inline-flex d-none">
               <a href="#" aria-haspopup="true"  data-toggle="dropdown" class="nav-link rounded" aria-expanded="false">
                   <i class="nav-link-icon mdi mdi-apps text-white mx-5 mx-lg-0"></i>
                   <span class="d-xl-inline-block d-none">PROJECTS
                   <i class="fa fa-angle-down ml-2"></i></span>
               </a>
               <div class="dropdown-menu overflow-hidden">
                   <div class="dropdown-menu-header-inner bg-img" style="background-image: url('');" data-overlay="5">
                       <div class="p-30 text-left w-250">
                           <h5 class="text-white">Overview</h5>
                           <h6 class="text-white">Unlimited options</h6>
                           <div class="menu-header-btn-pane">
                               <button class="mr-2 btn btn-success btn-sm">Settings</button>
                               <button class="btn-icon btn-icon-only btn btn-info btn-sm">
                                   <i class="fa fa-cog"></i>
                               </button>
                           </div>
                       </div>
                   </div>
                   <div class="p-10">
                       <button type="button" class="btn btn-flat btn-light no-shadow w-p100 text-left"><i class="mdi mdi-file-multiple mr-10"> </i>Graphic Design</button>
                       <button type="button" class="btn btn-flat btn-light no-shadow w-p100 text-left"><i class="mdi mdi-file-multiple mr-10"> </i>App Development</button>
                       <button type="button" class="btn btn-flat btn-light no-shadow w-p100 text-left"><i class="mdi mdi-file-multiple mr-10"> </i>Icon Design</button>
                       <div tabindex="-1" class="dropdown-divider"></div>
                       <button type="button" class="btn btn-flat btn-light no-shadow w-p100 text-left"><i class="mdi mdi-file-multiple mr-10"> </i>Miscellaneous</button>
                       <button type="button" class="btn btn-flat btn-light no-shadow w-p100 text-left"><i class="mdi mdi-file-multiple mr-10"> </i>Frontend Dev</button>
                   </div>
                 </div>
           </li> -->
       </ul>
     </div>

     <div class="navbar-custom-menu r-side">
       <ul class="nav navbar-nav">
         <!-- full Screen -->
       <!--   <li class="search-bar d-sm-inline-flex d-none">
             <div class="lookup lookup-circle lookup-right">
                <input type="text" name="s">
             </div>
         </li>	 -->
         <!-- Messages -->
        <!--  <li class="dropdown messages-menu">
           <a href="#" class="dropdown-toggle" data-toggle="dropdown" title="Messages">
             <i class="mdi mdi-email"></i>
           </a>
           <ul class="dropdown-menu animated bounceIn">
             <li class="header">
               <div class="p-20">
                   <div class="flexbox">
                       <div>
                           <h4 class="mb-0 mt-0">Messages</h4>
                       </div>
                       <div>
                           <a href="#" class="text-danger">Clear All</a>
                       </div>
                   </div>
               </div>
             </li>
             <li> -->
               <!-- inner menu: contains the actual data -->
               <!-- <ul class="menu sm-scrol"> -->
                 <!-- <li> --><!-- start message -->
                   <!-- <a href="#">
                     <div class="pull-left">
                       <img src="" class="rounded-circle" alt="User Image">
                     </div>
                     <div class="mail-contnet">
                        <h4>
                         Lorem Ipsum
                         <small><i class="fa fa-clock-o"></i> 15 mins</small>
                        </h4>
                        <span>Lorem ipsum dolor sit amet, consectetur adipiscing elit.</span>
                     </div>
                   </a>
                 </li> -->
                 <!-- end message -->
                 <!-- <li>
                   <a href="#">
                     <div class="pull-left">
                       <img src="" class="rounded-circle" alt="User Image">
                     </div>
                     <div class="mail-contnet">
                        <h4>
                         Nullam tempor
                         <small><i class="fa fa-clock-o"></i> 4 hours</small>
                        </h4>
                        <span>Curabitur facilisis erat quis metus congue viverra.</span>
                     </div>
                   </a>
                 </li>
                 <li>
                   <a href="#">
                     <div class="pull-left">
                       <img src="" class="rounded-circle" alt="User Image">
                     </div>
                     <div class="mail-contnet">
                        <h4>
                         Proin venenatis
                         <small><i class="fa fa-clock-o"></i> Today</small>
                        </h4>
                        <span>Vestibulum nec ligula nec quam sodales rutrum sed luctus.</span>
                     </div>
                   </a>
                 </li>
                 <li> -->
                   <!-- <a href="#">
                     <div class="pull-left">
                       <img src="" class="rounded-circle" alt="User Image">
                     </div>
                     <div class="mail-contnet">
                        <h4>
                         Praesent suscipit
                       <small><i class="fa fa-clock-o"></i> Yesterday</small>
                        </h4>
                        <span>Curabitur quis risus aliquet, luctus arcu nec, venenatis neque.</span>
                     </div>
                   </a>
                 </li> -->
                <!--  <li>
                   <a href="#">
                     <div class="pull-left">
                       <img src="" class="rounded-circle" alt="User Image">
                     </div>
                     <div class="mail-contnet">
                        <h4>
                         Donec tempor
                         <small><i class="fa fa-clock-o"></i> 2 days</small>
                        </h4>
                        <span>Praesent vitae tellus eget nibh lacinia pretium.</span>
                     </div>
                   </a>
                 </li>
               </ul>
             </li>
             <li class="footer">
                 <a href="#">See all e-Mails</a>
             </li>
           </ul>
         </li> -->
         <!-- Notifications -->
<!-- 		  <li class="dropdown notifications-menu">
           <a href="#" class="dropdown-toggle" data-toggle="dropdown" title="Notifications">
             <i class="mdi mdi-bell"></i>
           </a>
           <ul class="dropdown-menu animated bounceIn">
             <li class="header">
               <div class="p-20">
                   <div class="flexbox">
                       <div>
                           <h4 class="mb-0 mt-0">Notifications</h4>
                       </div>
                       <div>
                           <a href="#" class="text-danger">Clear All</a>
                       </div>
                   </div>
               </div>
             </li>
             <li> -->
               <!-- inner menu: contains the actual data -->
<!-- 				<ul class="menu sm-scrol">
                 <li>
                   <a href="#">
                     <i class="fa fa-users text-info"></i> Curabitur id eros quis nunc suscipit blandit.
                   </a>
                 </li>
                 <li>
                   <a href="#">
                     <i class="fa fa-warning text-warning"></i> Duis malesuada justo eu sapien elementum, in semper diam posuere.
                   </a>
                 </li>
                 <li>
                   <a href="#">
                     <i class="fa fa-users text-danger"></i> Donec at nisi sit amet tortor commodo porttitor pretium a erat.
                   </a>
                 </li>
                 <li>
                   <a href="#">
                     <i class="fa fa-shopping-cart text-success"></i> In gravida mauris et nisi
                   </a>
                 </li>
                 <li>
                   <a href="#">
                     <i class="fa fa-user text-danger"></i> Praesent eu lacus in libero dictum fermentum.
                   </a>
                 </li>
                 <li>
                   <a href="#">
                     <i class="fa fa-user text-primary"></i> Nunc fringilla lorem
                   </a>
                 </li>
                 <li>
                   <a href="#">
                     <i class="fa fa-user text-success"></i> Nullam euismod dolor ut quam interdum, at scelerisque ipsum imperdiet.
                   </a>
                 </li>
               </ul>
             </li>
             <li class="footer">
                 <a href="#">View all</a>
             </li>
           </ul>
         </li> -->

         <!-- User Account-->
         <li class=" notifications-menu">
             <div id="google_translate_element" style="margin-top: 20px;"></div>
         </li>
         <li class="dropdown user user-menu">
           <a href="#" class="dropdown-toggle" data-toggle="dropdown" title="User">
             <img src="{{ asset('assets/images/user.png')}}" class="user-image rounded-circle" alt="User Image">
           </a>
           <ul class="dropdown-menu animated flipInX">
             <!-- User image -->
             <li class="user-header bg-img" style="background-image: url('{{ asset('assets/images/color-plate/theme-oceansky.jpg')}}')" data-overlay="3">
                 <div class="flexbox align-self-center">
                     <img src="{{ asset('assets/images/user.png')}}" class="float-left rounded-circle" alt="User Image">
                   <h4 class="user-name align-self-center">
                       <span>{{ $agent_logo = auth()->guard('agent')->user()->name }}</span>
                       <small>{{ $agent_logo = auth()->guard('agent')->user()->email }}</small>
                   </h4>
                 </div>
             </li>
             <!-- Menu Body -->
             <li class="user-body">
                   <a class="dropdown-item" href="{{route('agent.profile.show', encrypt($agent->id))}}"><i class="ion ion-person"></i> My Profile</a>
                   <a class="dropdown-item" href="javascript:void(0)"><i class="ion ion-bag"></i> My Balance</a>
               			<a class="dropdown-item" href="javascript:void(0)"><i class="ion ion-email-unread"></i> Inbox</a>
                   <div class="dropdown-divider"></div>
                   <a class="dropdown-item" href="javascript:void(0)"><i class="ion ion-settings"></i> Account Setting</a>
                   <div class="dropdown-divider"></div>
                   <a class="dropdown-item" href="{{route('agent.logout')}}"><i class="ion-log-out"></i> Logout</a>
             </li>
           </ul>
         </li>


         <!-- Control Sidebar Toggle Button -->
    <!--      <li>
           <a href="#" data-toggle="control-sidebar" title="Setting"><i class="fa fa-cog fa-spin"></i></a>
         </li> -->

       </ul>
     </div>
   </nav>
 </header>
