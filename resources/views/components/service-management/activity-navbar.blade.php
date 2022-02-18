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
<div class="activity-tab">
    <ul class="nav nav-tabs">
        <li>
            <a class="nav-link {{ $activeNav == 'basic' ? 'active' : '' }}" href="{{ $id != null ? ($supplier != true ? route('activities.edit', encrypt($id)) : route('activity.edit', encrypt($id))) : ($supplier != true ? route('activity.create') : route('activities.create')) }}">Basic</a>
        </li>
        <li>
            <a class="nav-link {{ $activeNav == 'pricings' ? 'active' : '' }}" href="{{ $id != null ? (count($activity->pricings) > 0 ? ($supplier != true ? route('activity.prices.edit', [encrypt($id), encrypt(json_encode($activity->pricings->pluck('id')))]) : route('supplier.activity.prices.edit', encrypt($id))) : '#') : '#' }}">Pricing</a>
        </li>
        <li>
            <a class="nav-link {{ $activeNav == 'bookings' ? 'active' : '' }}" href="{{ $id != null ? (count($activity->booking) > 0 ? ($supplier != true ? route('activity.booking.edit',[encrypt($id), encrypt(json_encode($activity->booking->pluck('id')))]) : route('supplier.activity.booking.edit', encrypt($id))) : '#') : '#' }}">Booking</a>
        </li>
        <li>
            <a class="nav-link {{ $activeNav == 'images' ? 'active' : '' }}" href="{{ $id != null ? (count($activity->images) > 0 ? ($supplier != true ?route('activity-img-upload', encrypt($id)) : route('supplier.activity.images.edit', encrypt($id))) : '#') : '#' }}">Images</a>
        </li>
        <li>
            <a class="nav-link {{ $activeNav == 'description' ? 'active' : '' }}" href="{{ $id != null ? ($mode == 'edit' ? ($supplier != true ? route('activity.description.edit', encrypt($id)) : route('supplier.activity.description.edit', encrypt($id)) ) : '#') : '#' }}">Description</a>
        </li>
    </ul>
</div>
