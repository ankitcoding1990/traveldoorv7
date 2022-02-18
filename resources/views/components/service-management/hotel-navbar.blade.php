@push('style')
    <style>
        .activity-tab ul.nav.nav-tabs li:first-child a {
            border-top-left-radius: 8px !important;
        }

        .activity-tab ul.nav.nav-tabs li:last-child a {
            border-top-right-radius: 8px !important;
        }

        .activity-tab a.nav-link {
            border-radius: 0px !important;
            font-size: 16px;
        }

        .activity-tab a.active {
            background: #234076 !important;
            border: 1px solid #234076 !important;
            font-weight: 600;
        }

        .add-blackout-days {
            background: #ec407a !important;
            border: 0;
        }

        .activity-tab .btn-success.add-blackout-days:hover {
            background: #e2175b !important;
        }

        .activity-tab ul.nav.nav-tabs {
            border: 0;
        }

        @media screen and (max-width:600px) {
            .activity-tab a.nav-link {
                font-size: 14px;
            }
        }

    </style>
@endpush
  {{-- @dd($hotel->id); --}}
<div class="activity-tab">
    <ul class="nav nav-tabs">

        <li>
            <a class="nav-link {{ $activeNav == 'basic' ? 'active' : '' }}" href="{{ $id != null ? ($supplier != true ? route('hotels.edit', encrypt($id)) : route('hotels.edit', encrypt($id))) : ($supplier != true ? route('hotels.create') : route('hotels.create')) }}">Basic</a>
        </li>
        <li>
            <a class="nav-link {{ $activeNav == 'amenities' ? 'active' : '' }}" href="{{ $id != null ? ($supplier != true ? route('hotels.amenities.edit', encrypt($id)) : route('hotel.amenities.edit', encrypt($id))) : '' }}">Amenities</a>
        </li>
        <li>
            <a class="nav-link {{ $activeNav == 'images' ? 'active' : '' }}" href="{{ $id != null ? ($supplier != true ? route('hotels.images.edit', encrypt($id)) : route('hotel.images.edit', encrypt($id))) : '' }}">Images</a>
        </li>
        {{-- <li>
            <a class="nav-link {{ $activeNav == 'amenities' ? 'active' : '' }}" href="{{ $id != null ? (count($hotel->amenities) > 0 ? ($supplier != true ? route('hotels.amenities.create', [encrypt($id), encrypt(json_encode($hotel->amenities->pluck('id')))]) : route('hotel.amenities.create', encrypt($id))) : '#') : '#' }}">Amenities</a>
        </li> --}}
        {{-- <li>
            <a class="nav-link {{ $activeNav == 'images' ? 'active' : '' }}" href="{{ $id != null ? (count($hotel->images) > 0 ? ($supplier != true ?route('hotels.images.upload', encrypt($id)) : route('hotel.images.upload', encrypt($id))) : '#') : '#' }}">Images</a>
        </li> --}}
        <li>
            <a class="nav-link {{ $activeNav == 'description' ? 'active' : '' }}" href="{{ $id != null ? ($mode == 'edit' ? ($supplier != true ? route('hotels.description.edit', encrypt($id)) : route('hotel.description.edit', encrypt($id)) ) : '#') : '#' }}">Description</a>
        </li>
    </ul>
</div>
