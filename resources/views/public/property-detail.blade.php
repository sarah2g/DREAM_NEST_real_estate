@extends('layouts.public')

@section('title', ($property->category->name ?? 'Property') . ' in ' . $property->city)

@section('content')
<div class="header-C">
    <div class="header-D">
        <div class="container9">
            <div class="welcome-text9">
                <div class="container11">
                    <div>
                        <h3 target="">{{ $property->title }}</h3>
                        <p class="des">{{ $property->description }}</p>
                        <ul>
                            <li><strong>Price:</strong> {{ number_format($property->price, 0, ',', ' ') }} DZD</li>
                            @if ($property->bedrooms)
                                <li><strong>Bedrooms:</strong> {{ $property->bedrooms }}</li>
                            @endif
                            @if ($property->bathrooms)
                                <li><strong>Bathrooms:</strong> {{ $property->bathrooms }}</li>
                            @endif
                            @if ($property->area)
                                <li><strong>Area:</strong> {{ number_format($property->area, 0, ',', ' ') }} m²</li>
                            @endif
                            <li><strong>Location:</strong> {{ $property->city }}{{ $property->state ? ', ' . $property->state : '' }}</li>
                            <li><strong>Added:</strong> {{ $property->created_at->format('M d, Y') }}</li>
                        </ul>
                    </div>
                    <div id="welcome-text13">
                        <div id="map">
                            <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d126743.58540662608!2d79.85691865066453!3d6.92183232317968!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3ae253d10f0a4ec3%3A0x9d39cbb5d20891a3!2sColombo%2C%20Sri%20Lanka!5e0!3m2!1sen!2s!4v1701123456789!5m2!1sen!2s"
                                width="100%" height="450" style="border:0;" allowfullscreen="" loading="lazy"></iframe>
                        </div>
                    </div>
                </div>

                <div class="container12">
                    <div class="slideshow-container">
                        @forelse($property->images as $index => $image)
                            <div class="mySlides @if($loop->first) block @endif">
                                <div class="numbertext">{{ $loop->iteration }} / {{ $loop->count }}</div>
                                <img src="{{ asset('storage/' . $image->image_path) }}" style="width:100%">
                            </div>
                        @empty
                            <div class="mySlides block">
                                <div class="numbertext">1 / 1</div>
                                <img src="https://placehold.co/800x500/1e3a8a/ffffff?text=Dream+Nest" style="width:100%">
                            </div>
                        @endforelse

                        @if($property->images->count() > 1)
                            <a class="prev" onclick="plusSlides(-1)">&#10094;</a>
                            <a class="next" onclick="plusSlides(1)">&#10095;</a>
                        @endif
                    </div>

                    @if($property->images->count() > 1)
                        <div class="row">
                            @foreach($property->images as $index => $image)
                                <div class="column">
                                    <img class="demo cursor @if($loop->first) active @endif" src="{{ asset('storage/' . $image->image_path) }}" style="width:100%" onclick="currentSlide({{ $loop->iteration }})" alt="{{ $property->title }}">
                                </div>
                            @endforeach
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
