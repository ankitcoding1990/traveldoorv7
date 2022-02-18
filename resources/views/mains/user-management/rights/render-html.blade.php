<div id="menus">
  @foreach ($menus as $key => $menu)
  @php
    $submenus = $menu->activeSubMenus($menu->id);
  @endphp
  @php
      $parentMenuDisplay = 'd-none';
      $parentMenuToggle = '<span class="plus_minus plus" id="parentMenuToggle"><i class="fa fa-plus-square-o" aria-hidden="true"></i></span>';

      $userMenuIds = $userRights->pluck('menu_id')->toArray();
      $submenuIds = $submenus->pluck('id')->toArray();
      $matched = array_intersect($userMenuIds,$submenuIds);
      if(in_array($menu->id, $userMenuIds) || count($matched) > 0){
        $parentMenuDisplay = '';
        $parentMenuToggle = '<span class="plus_minus minus" id="parentMenuToggle"><i class="fa fa-minus-square-o" aria-hidden="true"></i></span>';
      }
  @endphp
    <div class="row menu-row">
      <div class="col-md-12">

        <div class="row">
          <div class="col-md-3">
            <h4 class="text-info">{{ $menu->menu_name }}</h4>
          </div>
          <div class="col-md-1">
            {!! $parentMenuToggle !!}
          </div>
        </div>


        <blockquote class="menu-list border p-4 {{ $parentMenuDisplay }}">
          @if($submenus->count() > 0)
            @foreach ($submenus as $submenu)
            {{-- include for submenus --}}
            @include('mains.user-management.rights.checks', ['user' => $user, 'menu' => $submenu])
            {{-- include for submenus --}}
            @endforeach
          @else
            {{-- include for parentmenu --}}
            @include('mains.user-management.rights.checks', ['user' => $user, 'menu' => $menu])
            {{-- /include for parentmenu --}}
          @endif
      </blockquote>
    </div>
  </div>
    <button class="btn btn-primary btn-fixed-bottom" type="submit">Update Permission</button>
  @endforeach
</div>
