@extends('layouts.public')

@section('title', $property->title)

@section('content')
<section class="header-D">
    <div class="container9">
        <div class="welcome-text9">
            @forelse($images as $image)
                <div class="mySlides">
                    <div class="numbertext">{{ $loop->iteration }} / {{ $images->count() }}</div>
                    <img src="{{ asset('storage/' . $image) }}" alt="{{ $property->title }}">
                </div>
            @empty
                <div class="mySlides">
                    <div class="numbertext">1 / 1</div>
                    <img src="https://placehold.co/1200x800/1e3a8a/ffffff?text=Dream+Nest" alt="{{ $property->title }}">
                </div>
            @endforelse

            <a class="prev" onclick="plusSlides(-1)">&#10094;</a>
            <a class="next" onclick="plusSlides(1)">&#10095;</a>

            <div class="row">
                @forelse($images as $image)
                    <div class="column">
                        <img class="demo cursor" src="{{ asset('storage/' . $image) }}" onclick="currentSlide({{ $loop->iteration }})" alt="Pic">
                    </div>
                @empty
                    <div class="column">
                        <img class="demo cursor" src="https://placehold.co/1200x800/1e3a8a/ffffff?text=Dream+Nest" onclick="currentSlide(1)" alt="Pic">
                    </div>
                @endforelse
            </div>
        </div>
    </div>
    <div class="container11">
        <div class="column11">
            <div class="welcome-text11">
                <h3 target>{{ $property->title }}</h3>
                <h3>{{ number_format($property->price, 0, ',', ' ') }} DZD</h3>
                <ul>
                    <li>Address: {{ $property->city }}{{ $property->state ? ', ' . $property->state : '' }}</li>
                    @if($property->bedrooms)
                        <li>Bedrooms: {{ $property->bedrooms }}</li>
                    @endif
                    @if($property->bathrooms)
                        <li>Bathrooms: {{ $property->bathrooms }}</li>
                    @endif
                    @if($property->area)
                        <li>Area: {{ number_format($property->area, 2, '.', ' ') }} m²</li>
                    @endif
                    <li>Status: {{ $property->status === 'for sale' ? 'À Vendre' : 'À Louer' }}</li>
                    <li>Posted on {{ $property->created_at->format('d F Y h:i a') }}</li>
                </ul>
            </div>
            <div class="welcome-text11">
                <h3 target>Description</h3>
                <p class="des">{{ $property->description }}</p>
            </div>
            <div id="welcome-text13">
                <div id="map">
                    <iframe
                        src="https://www.google.com/maps?q={{ urlencode($property->city . ' ' . $property->state) }}&output=embed"
                        width="1335"
                        height="450"
                        style="border: 0;"
                        allowfullscreen=""
                        loading="lazy"
                        referrerpolicy="no-referrer-when-downgrade"
                    ></iframe>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection
