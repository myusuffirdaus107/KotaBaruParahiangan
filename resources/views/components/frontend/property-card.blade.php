 @props([
    'property',
    'imageHeight' => 'h-210',
    'href'        => null,
])

@php
    $link    = $href ?? route('properties.hunian');
    $imgSrc  = $property->images->count()
                ? asset('storage/' . $property->images->first()->image_path)
                : 'https://images.unsplash.com/photo-1564013799919-ab600027ffc6?w=600&h=400&fit=crop';
    $isAvail = $property->status === 'available';
    $catName = $property->category->name ?? 'Hunian';
@endphp

<a href="{{ $link }}" class="lp-card h-100">
    <div class="lp-card-img {{ $imageHeight }}">
        <img src="{{ $imgSrc }}" alt="{{ $property->title }}" loading="lazy">
        <span class="pill {{ $isAvail ? 'avail' : 'sold' }}">
            {{ $isAvail ? 'Tersedia' : 'Sold Out' }}
        </span>
    </div>
    <div class="lp-card-body">
        <div class="cat">{{ $catName }}</div>
        <h3>{{ $property->title }}</h3>
        <div class="meta">
            @if($property->location)
                <span><i class="fas fa-map-marker-alt"></i> {{ $property->location }}</span>
            @endif
            @if(!empty($property->developer))
                <span><i class="fas fa-building"></i> {{ $property->developer }}</span>
            @endif
        </div>
    </div>
</a>