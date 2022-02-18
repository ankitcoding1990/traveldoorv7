@php
    $basicNavRoutesArray=[
        'restaurants.create',
        'restaurants.edit',
        'restaurant.create',
        'restaurant.edit',
        ];
    $imagesNavRoutesArray=[
        'restaurant.images.create',
        'restaurant.images.edit',
        'supplier.restaurant.images.create',
        'supplier.restaurant.images.edit',
        ];    
@endphp
<div class="box service-tab">
    <ul class="nav nav-tabs">
        <li>
            <a class="nav-link {{ in_array($currentRoute, $basicNavRoutesArray) ? 'active' : 'disabled' }}" href="">Basic</a>
        </li>
        <li>
            <a class="nav-link {{ in_array($currentRoute, $imagesNavRoutesArray) ? 'active' : 'disabled' }}" href="">Images</a>
        </li>
        
        
    </ul>
</div>
