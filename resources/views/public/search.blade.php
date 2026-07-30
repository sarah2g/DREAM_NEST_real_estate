@extends('layouts.public')

@section('title', 'Search Properties')

@section('content')
<div class="container1">
    <div id="root">
        <form action="" method="GET" id="searchForm">
            <div class="group">
                <label for="city">City</label>
                <input type="text" class="city" name="city" id="city" value="{{ request('city') }}">
            </div>
            <div class="group">
                <label for="property-type">Property Type</label>
                <select name="property_type" id="property-type">
                    <option value="home">House</option>
                    <option value="apartments">Apartments</option>
                    <option value="commercial buildings">Commercial Buildings</option>
                    <option value="villas">Villas</option>
                </select>
            </div>
            <div class="group">
                <label for="min-price">Min Price</label>
                <select name="min_price" id="min-price">
                    <option value="">No min</option>
                    <option value="1-10">1mn(10lakhs) - 10mn(100lakhs)</option>
                    <option value="11-20">11mn(110lakhs) - 20mn(200lakhs)</option>
                    <option value="21-30">21mn(210lakhs) - 30mn(300lakhs)</option>
                    <option value="31-40">31mn(310lakhs) - 40mn(400lakhs)</option>
                    <option value="41-50">41mn(410lakhs) - 50mn(500lakhs)</option>
                    <option value="51-60">51mn(510lakhs) - 60mn(600lakhs)</option>
                    <option value="61-70">61mn(610lakhs) - 70mn(700lakhs)</option>
                    <option value="71-80">71mn(710lakhs) - 80mn(800lakhs)</option>
                    <option value="81-90">81mn(810lakhs) - 90mn(900lakhs)</option>
                    <option value="91-100">91mn(910lakhs) - 100mn(1000lakhs)</option>
                </select>
            </div>
            <div class="group">
                <label for="max-price">Max Price</label>
                <select name="max_price" id="max-price">
                    <option value="">No max</option>
                    <option value="1-10">1mn(10lakhs) - 10mn(100lakhs)</option>
                    <option value="11-20">11mn(110lakhs) - 20mn(200lakhs)</option>
                    <option value="21-30">21mn(210lakhs) - 30mn(300lakhs)</option>
                    <option value="31-40">31mn(310lakhs) - 40mn(400lakhs)</option>
                    <option value="41-50">41mn(410lakhs) - 50mn(500lakhs)</option>
                    <option value="51-60">51mn(510lakhs) - 60mn(600lakhs)</option>
                    <option value="61-70">61mn(610lakhs) - 70mn(700lakhs)</option>
                    <option value="71-80">71mn(710lakhs) - 80mn(800lakhs)</option>
                    <option value="81-90">81mn(810lakhs) - 90mn(900lakhs)</option>
                    <option value="91-100">91mn(910lakhs) - 100mn(1000lakhs)</option>
                </select>
            </div>
            <div class="group">
                <label for="bedrooms">No. of bedrooms</label>
                <select name="bedrooms" id="bedrooms">
                    <option value="">No</option>
                    <option value="2">2</option>
                    <option value="3">3</option>
                    <option value="4">4</option>
                    <option value="5">5</option>
                </select>
            </div>
            <div class="group">
                <label for="added-to-site">Added to site</label>
                <select name="added_to_site" id="added-to-site">
                    <option value="">Anytime</option>
                    <option value="2023-01-01-2023-06-30">23/01/01-23/06/30</option>
                    <option value="2023-07-01-2023-12-31">23/07/01-23/12/31</option>
                </select>
            </div>
            <div class="flex group">
                <div class="flex-col">
                    <input type="radio" name="sale_or_rent" id="sale" value="sale" checked>
                    <label for="sale">Sale</label>
                </div>
                <div class="flex-col">
                    <input type="radio" name="sale_or_rent" id="rent" value="rent">
                    <label for="rent">Rent</label>
                </div>
            </div>
            <div class="flex group">
                <button class="btn" type="submit">Search</button>
            </div>
        </form>
    </div>
</div>
<!-- afficher les catégories dans la page de recherche -->
<section class="section section--after-search">
    <div class="container">
        <div class="section-header">
            <h2>Property Categories</h2>
            <p>Explore properties by category</p>
        </div>
        <div class="category-grid">
                @foreach($categories as $category)
                <div class="category-card">
                    <a href="#">
                       
                        <h3>{{ $category->name }}</h3>
                    </a>
                </div>
            @endforeach
        </div>
    </div>
</section>
<!-- afficher les propriétés en vedette dans la page de recherche -->
<section class="section">
    <div class="container">
        <div class="section-header">
            <h2>Featured Properties</h2>
            <p>Discover our most popular properties</p>
        </div>
        @if($featuredProperties->count() > 0)
            <div class="property-grid">
                @foreach($featuredProperties as $property)
                    <div class="property-card">
                        <div class="property-image">
                            <img src="{{ $property->main_image ? asset('storage/' . $property->main_image) : 'https://placehold.co/600x400/1e3a8a/ffffff?text=Dream+Nest' }}" alt="{{ $property->title }}">
                            <span class="property-badge {{ $property->status === 'for sale' ? 'sale' : 'rent' }}">
                                {{ $property->status === 'for sale' ? 'À Vendre' : 'À Louer' }}
                            </span>
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
        @else
            <div class="empty-state">
                <div class="empty-icon">⭐</div>
                <h3>Aucune propriété vedette</h3>
                <p>Les propriétés vedettes apparaîtront ici</p>
            </div>
        @endif
    </div>
</section>

<!-- afficher $lastProperties dans la page de recherche -->
<section class="section">
    <div class="container">
        <div class="section-header">
            <h2>Latest Properties</h2>
            <p>The latest properties added to our platform</p>
        </div>

        @if($lastProperties->count() > 0)
            <div class="property-grid">
                @foreach($lastProperties as $property)
                    <div class="property-card">
                        <div class="property-image">
                            <img src="{{ $property->main_image ? asset('storage/' . $property->main_image) : 'https://placehold.co/600x400/1e3a8a/ffffff?text=Dream+Nest' }}" alt="{{ $property->title }}">
                            <span class="property-badge {{ $property->status === 'for sale' ? 'sale' : 'rent' }}">
                                {{ $property->status === 'for sale' ? 'À Vendre' : 'À Louer' }}
                            </span>
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
        @else
            <div class="empty-state">
                <div class="empty-icon">🏠</div>
                <h3>Aucune propriété pour le moment</h3>
                <p>Les propriétés seront ajoutées prochainement</p>
            </div>
        @endif
    </div>
</section>
<!-- afficher la liste des propriétés favorites dans la page de recherche -->
<div class="container2">
    <form class="form2" id="favorites-form">
        <h1 class="for-text">Favourite Property List</h1>
         <div class="favorites-list">
            @if($favoriteProperties->count() > 0)
                @foreach($favoriteProperties as $property)
                    <div class="favorite-item">
                        <h3>{{ $property->title }}</h3>
                        <p>{{ $property->city }}{{ $property->state ? ', ' . $property->state : '' }}</p>
                        <p>{{ number_format($property->price, 0, ',', ' ') }} DZD</p>
                        <a href="{{ route('properties.show', $property) }}" class="btn-details">Voir Détails</a>
                    </div>
                @endforeach
            @else
                <div class="empty-state">
                    <div class="empty-icon">💖
                    </div>
                    <h3>Aucune propriété favorite</h3>
                    <p>Les propriétés que vous avez ajoutées à vos favoris apparaîtront ici</p>
                </div>
            @endif
        </div>
    </form>
</div>
@endsection
