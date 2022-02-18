      <!-- Left side column. contains the logo and sidebar -->
      <aside class="main-sidebar">
        <section class="sidebar">
          <ul class="sidebar-menu" data-widget="tree">

            <li class="link-a {}_menu">
               <li class="treeview {}_menu">
                 <a href="{{ route('dashboard') }}">
                     <i class="fa fa-home"></i>
                     <span>Dashboard</span>
                     <span class="pull-right-container"><i class="fa fa-angle-right pull-right"></i></span>
                 </a>
             </li>
             @if (auth()->user()->isAdmin())
               <li class="treeview {}_menu">
                  <a href='#'>
                      <i class="fa fa-user"></i>
                      <span>User Management</span>
                      <span class="pull-right-container"><i class="fa fa-angle-right pull-right"></i></span>
                  </a>
                  <ul class="treeview-menu">
                      <li>
                        <a href="{{ route('users.index') }}"><i class="fa fa-circle-o"></i> Users</a>
                     </li>
                     <li>
                       <a href="{{ route('menus.index') }}"><i class="fa fa-circle-o"></i> Menus</a>
                    </li>
                    <li>
                      <a href="{{ route('user-rights.index') }}"><i class="fa fa-circle-o"></i> Permissions</a>
                   </li>
                  </ul>
              </li>
             @endif

            @foreach ($menus as $key => $parentMenu)
              @php
                $menuPermission  = false;
                if ($parentMenu->submenus->count() > 0) {
                  $menuPermission = auth()->user()->hasSubAvailbleRoutes($parentMenu->submenus->pluck('menu_file')->toArray());
                }else{
                  $menuPermission = $user->hasRoutePermission($parentMenu->menu_file);
                }
              @endphp
              @if ($menuPermission)

              <li class="{{$parentMenu->submenus->count() > 0 ? 'treeview' : ''}}">
                @php
                    $parentRouteLink = '#';
                    if ($parentMenu->submenus->count() == 0) {


                      if(Route::has($parentMenu->menu_file)){
                        $parentRouteLink = route($parentMenu->menu_file);
                      }

                    }
                @endphp
                <a href="{{$parentRouteLink}}">
                    <i class="{{$parentMenu->icon_class}}"></i>
                    <span>{{$parentMenu->menu_name}}</span>
                    <span class="pull-right-container"><i class="fa fa-angle-right pull-right"></i></span>
                </a>
                @if ($parentMenu->submenus->count() > 0)
                  <ul class="treeview-menu">
                    @foreach ($parentMenu->submenus as $subMenu)
                      @if (auth()->user()->hasRoutePermission($subMenu->menu_file))
                        <li>
                          <a href="{{ Route::has($subMenu->menu_file) ? route($subMenu->menu_file) : '#'}}"><i class="fa fa-circle-o"></i> {{ $subMenu->menu_name }}</a>
                        </li>
                      @endif
                    @endforeach
                  </ul>
                @endif
                </li>
              @endif
            @endforeach
          </ul>
      </aside>
{{-- /IncludeNav --}}
