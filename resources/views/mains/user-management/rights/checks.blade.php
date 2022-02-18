@php
    $menuDetail = $user->rights($menu->id);
@endphp
<div class="row border-bottom p-2 menu-item">
  <div class="col-md-12">
    {{-- row --}}
    <div class="row">
      <div class="col-md-2">

      </div>
      <div class="col-md-1  text-center">
          <label>Full</label>
      </div>
      <div class="col-md-1 text-center">
          <label>Add</label>
      </div>
      <div class="col-md-1 text-center">
          <label>View</label>
      </div>
      <div class="col-md-1 text-center">
          <label>Edit</label>
      </div>
      <div class="col-md-1 text-center">
        <label>Delete</label>
    </div>
      <div class="col-md-1 text-center">
          <label>Pdf/Excel</label>
      </div>

      <div class="col-md-1 text-center">
          <label>Admin</label>
      </div>
    </div>
    {{-- /row --}}
  </div>
  <div class="col-md-12">
    <div class="row">
      @php
          $menuDetail = $user->rights($menu->id);
      @endphp
      <div class="col-md-2">
        <label class="rights_menu font-weight-bold text-info" id="rights_menu1">{{ $menu->menu_name }}</label>
      </div>
      <div class="col-md-1 text-center checkbox">
          @php
              $rightFullId = $menu->id.'_full';
          @endphp
          {!! Form::checkbox('rights['.$menu->id.'][full]', 1, $menuDetail->full ?? null, ['id' => $rightFullId, 'onclick="fullRight($(this))"', 'class' => 'menu-full-access']) !!}
          <label for="{{ $rightFullId }}"></label>
      </div>
      <div class="col-md-1 text-center checkbox">
          @php
              $rightAddId = $menu->id.'_add';
          @endphp
          {!! Form::checkbox('rights['.$menu->id.'][add]', 1, $menuDetail->add ?? null, ['id' => $rightAddId]) !!}
          <label for="{{ $rightAddId }}"></label>
      </div>
      <div class="col-md-1 text-center checkbox">
          @php
              $rightViewId = $menu->id.'_view';
          @endphp
          {!! Form::checkbox('rights['.$menu->id.'][view]', 1, $menuDetail->view ?? null, ['id' => $rightViewId]) !!}
          <label for="{{ $rightViewId }}"></label>
      </div>
      <div class="col-md-1 text-center checkbox">
          @php
              $rightEditId = $menu->id.'_edit';
          @endphp
          {!! Form::checkbox('rights['.$menu->id.'][edit]', 1, $menuDetail->edit ?? null, ['id' => $rightEditId]) !!}
          <label for="{{ $rightEditId }}"></label>
      </div>
      <div class="col-md-1 text-center checkbox">
        @php
            $rightDeleteId = $menu->id.'_delete';
        @endphp
        {!! Form::checkbox('rights['.$menu->id.'][delete]', 1, $menuDetail->delete ?? null, ['id' => $rightDeleteId]) !!}
        <label for="{{ $rightDeleteId }}"></label>
    </div>
    <div class="col-md-1 text-center">
        @php
            $rightReportId = $menu->id.'report';
        @endphp
        {!! Form::checkbox('rights['.$menu->id.'][report]', 1, $menuDetail->report ?? null, ['id' => $rightReportId]) !!}
        <label for="{{ $rightReportId }}"></label>
      </div>
      <div class="col-md-1 text-center checkbox">
        @php
            $rightAdminId = $menu->id.'_admin';
        @endphp
        {!! Form::checkbox('rights['.$menu->id.'][admin]', 1, $menuDetail->admin ?? null, ['id' => $rightAdminId, 'class' => 'menu-item-check-admin', 'onchange="checkAdminRoles($(this))"']) !!}
        <label for="{{ $rightAdminId }}"></label>
      </div>
      <div class="col-md-3 ">
        <div class="select-admin-actions d-none">
          @php
            $adminRightActions = [
              'add' =>  'Add',
              'view' =>  'View',
              'edit' =>  'Edit',
              'delete' =>  'Delete',
              'report'  =>  'Pdf/Excel'
            ];
        @endphp
        {!! Form::select('rights['.$menu->id.'][admin_roles][]', $adminRightActions, $menuDetail->admin_roles ?? null, ['class' => 'select-multiple', 'multiple']) !!}
        </div>
      </div>
    </div>
  </div>
</div>
