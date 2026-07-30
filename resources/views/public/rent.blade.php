@extends('layouts.public')

@section('title', 'Properties for Rent')

@section('content')
<section class="section" style="padding-top: 140px;">
    <div class="container">
        <div class="section-header">
            <h2>Properties for Rent</h2>
            <p>Discover rental properties that suit your lifestyle</p>
        </div>

        @if($properties->count() > 0)
            <div class="property-grid">
                @foreach($properties as $property)
                    <div class="property-card">
                        <div class="property-image">
                            <img src="{{ $property->main_image ? asset('storage/' . $property->main_image) : 'https://placehold.co/600x400/1e3a8a/ffffff?text=Dream+Nest' }}" alt="{{ $property->title }}">
                            <span class="property-badge rent">À Louer</span>
                        </div>
                        <div class="property-details">
                            <h3 class="property-title">{{ $property->title }}</h3>
                            <p class="property-location">{{ $property->city }}{{ $property->state ? ', ' . $property->state : '' }}</p>
                            <p class="property-price">{{ number_format($property->price, 0, ',', ' ') }} DZD</p>
                            <div class="property-meta">
                                @if($property->bedrooms)
                                    <span><i class="fas fa-bed"></i> {{ $property->bedrooms }} ch.</span>
                                @endif
                                @if($property->bathrooms)
                                    <span><i class="fas fa-bath"></i> {{ $property->bathrooms }} sdb.</span>
                                @endif
                                @if($property->area)
                                    <span><i class="fas fa-vector-square"></i> {{ number_format($property->area, 0, ',', ' ') }} m²</span>
                                @endif
                            </div>
                            <a href="{{ route('properties.show', $property) }}" class="btn-details">Voir Détails</a>
                        </div>
                    </div>
                @endforeach
            </div>

            @if(method_exists($properties, 'links'))
                <div style="margin-top: 40px;">
                    {{ $properties->links() }}
                </div>
            @endif
        @else
            <div class="empty-state">
                <div class="empty-icon">🏠</div>
                <h3>No rental properties at the moment</h3>
                <p>Check back soon for new listings</p>
            </div>
        @endif
    </div>
</section>
@endsection
