@extends('frontend.layouts.app')

@section('title', $property->title)

@section('content')
<div class="container mt-5">
    <div class="row">
        {{-- Gallery Section --}}
        <div class="col-md-7 mb-4">
            <div class="swiper propertySwiper mb-3">
                <div class="swiper-wrapper">
                    @forelse($property->images as $image)
                        <div class="swiper-slide">
                            <img src="{{ asset('storage/' . $image->image_path) }}" class="img-fluid rounded" alt="Property Image" style="width: 100%; height: 500px; object-fit: cover;">
                        </div>
                    @empty
                        <div class="swiper-slide">
                            <img src="https://via.placeholder.com/600x500?text=No+Image" class="img-fluid rounded" alt="No Image" style="width: 100%; height: 500px; object-fit: cover;">
                        </div>
                    @endforelse
                </div>
                @if($property->images->count() > 1)
                    <div class="swiper-button-next"></div>
                    <div class="swiper-button-prev"></div>
                @endif
                <div class="swiper-pagination"></div>
            </div>

            {{-- Thumbnail Gallery --}}
            @if($property->images->count() > 1)
                <div class="swiper propertyThumbs">
                    <div class="swiper-wrapper">
                        @foreach($property->images as $image)
                            <div class="swiper-slide">
                                <img src="{{ asset('storage/' . $image->image_path) }}" class="img-fluid rounded" style="cursor: pointer; height: 100px; object-fit: cover;" alt="Thumbnail">
                            </div>
                        @endforeach
                    </div>
                </div>
            @endif

            {{-- Description --}}
            <div class="mt-4">
                <h3>Description</h3>
                <p>{!! nl2br($property->description) !!}</p>
            </div>

            {{-- Specifications --}}
            <div class="mt-4">
                <h3>Specifications</h3>
                <div class="row">
                    <div class="col-md-6 mb-3">
                        <strong>Category:</strong> {{ $property->category->name }}
                    </div>
                    <div class="col-md-6 mb-3">
                        <strong>Location:</strong> {{ $property->location }}
                    </div>
                    <div class="col-md-6 mb-3">
                        <strong>Price:</strong> <span class="property-price">Rp {{ number_format($property->price, 0, ',', '.') }}</span>
                    </div>
                    <div class="col-md-6 mb-3">
                        <strong>Status:</strong> <span class="badge" style="background-color: {{ $property->status === 'available' ? '#10b981' : '#ef4444' }};">{{ ucfirst(str_replace('_', ' ', $property->status)) }}</span>
                    </div>
                </div>
            </div>

            {{-- Download Brochure --}}
            @if($property->brochure)
                <div class="mt-4">
                    <a href="{{ asset('storage/' . $property->brochure) }}" class="btn btn-outline-primary" download>
                        <i class="fas fa-download"></i> Download E-Brochure
                    </a>
                </div>
            @endif
        </div>

        {{-- Inquiry Form & Related Properties --}}
        <div class="col-md-5">
            {{-- Inquiry Form --}}
            @if($property->status === 'available')
                <div class="card mb-4" style="position: sticky; top: 20px;">
                    <div class="card-body">
                        <h4 class="card-title mb-4">
                            <i class="fas fa-envelope"></i> Interested? Send Inquiry
                        </h4>
                        <form action="{{ route('inquiry.store') }}" method="POST">
                            @csrf
                            <input type="hidden" name="property_id" value="{{ $property->id }}">

                            <div class="mb-3">
                                <label for="name" class="form-label">Your Name <span class="text-danger">*</span></label>
                                <input type="text" class="form-control @error('name') is-invalid @enderror" id="name" name="name" value="{{ old('name') }}" required>
                                @error('name')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label for="email" class="form-label">Email <span class="text-danger">*</span></label>
                                <input type="email" class="form-control @error('email') is-invalid @enderror" id="email" name="email" value="{{ old('email') }}" required>
                                @error('email')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label for="phone" class="form-label">Phone Number <span class="text-danger">*</span></label>
                                <input type="tel" class="form-control @error('phone') is-invalid @enderror" id="phone" name="phone" value="{{ old('phone') }}" required>
                                @error('phone')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label for="message" class="form-label">Message <span class="text-danger">*</span></label>
                                <textarea class="form-control @error('message') is-invalid @enderror" id="message" name="message" rows="5" required>{{ old('message') }}</textarea>
                                @error('message')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <button type="submit" class="btn btn-primary w-100">
                                <i class="fas fa-paper-plane"></i> Send Inquiry
                            </button>
                        </form>
                    </div>
                </div>
            @else
                <div class="alert alert-warning">
                    <i class="fas fa-exclamation-triangle"></i> This property is currently sold out.
                </div>
            @endif

            {{-- Related Properties --}}
            @if($relatedProperties->count() > 0)
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">
                            <i class="fas fa-list"></i> Related Properties
                        </h5>
                        @foreach($relatedProperties as $related)
                            <div class="d-flex mb-3 pb-3" style="border-bottom: 1px solid #ddd;">
                                @if($related->images->count() > 0)
                                    <img src="{{ asset('storage/' . $related->images->first()->image_path) }}" class="rounded" style="width: 80px; height: 80px; object-fit: cover; margin-right: 10px;">
                                @else
                                    <img src="https://via.placeholder.com/80x80" class="rounded" style="width: 80px; height: 80px; object-fit: cover; margin-right: 10px;">
                                @endif
                                <div flex-grow-1>
                                    <h6 class="mb-2">
                                        <a href="{{ route('property.show', $related->slug) }}" class="text-decoration-none">{{ $related->title }}</a>
                                    </h6>
                                    <p class="mb-1 text-muted" style="font-size: 0.9rem;">
                                        <i class="fas fa-map-marker-alt"></i> {{ $related->location }}
                                    </p>
                                    <p class="property-price mb-0" style="font-size: 1.1rem;">Rp {{ number_format($related->price, 0, ',', '.') }}</p>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            @endif
        </div>
    </div>
</div>
@endsection

@section('scripts')
<script>
    var thumbsSwiper = new Swiper('.propertyThumbs', {
        spaceBetween: 10,
        slidesPerView: 4,
        freeMode: true,
        watchSlidesProgress: true,
    });

    var mainSwiper = new Swiper('.propertySwiper', {
        spaceBetween: 10,
        thumbs: {
            swiper: thumbsSwiper,
        },
        navigation: {
            nextEl: '.swiper-button-next',
            prevEl: '.swiper-button-prev',
        },
        pagination: {
            el: '.swiper-pagination',
            clickable: true,
        },
    });
</script>
@endsection
