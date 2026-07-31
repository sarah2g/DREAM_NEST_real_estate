@extends('layouts.public')

@section('title', 'Search Properties')

@section('content')
<div class="container1">
    <div id="root">
        <form action="{{ route('home') }}" method="GET" id="searchForm">
            <div class="group">
                <label for="city">City</label>
                <input type="text" name="city" id="city" list="city-list" value="{{ request('city') }}" placeholder="Algiers, Oran...">
                <datalist id="city-list">
                    @foreach($cities as $city)
                        <option value="{{ $city }}">
                    @endforeach
                </datalist>
            </div>
            <div class="group">
                <label for="property-type">Property Type</label>
                <select name="property_type" id="property-type">
                    <option value="">All Types</option>
                    @foreach($categories as $category)
                        <option value="{{ $category->id }}" {{ request('property_type') == $category->id ? 'selected' : '' }}>
                            {{ $category->name }}
                        </option>
                    @endforeach
                </select>
            </div>
            <div class="group">
                <label for="min-price">Min Price (DZD)</label>
                <select name="min_price" id="min-price">
                    <option value="">No min</option>
                    <option value="1000000" {{ request('min_price') == '1000000' ? 'selected' : '' }}>1,000,000</option>
                    <option value="5000000" {{ request('min_price') == '5000000' ? 'selected' : '' }}>5,000,000</option>
                    <option value="10000000" {{ request('min_price') == '10000000' ? 'selected' : '' }}>10,000,000</option>
                    <option value="20000000" {{ request('min_price') == '20000000' ? 'selected' : '' }}>20,000,000</option>
                    <option value="50000000" {{ request('min_price') == '50000000' ? 'selected' : '' }}>50,000,000</option>
                </select>
            </div>
            <div class="group">
                <label for="max-price">Max Price (DZD)</label>
                <select name="max_price" id="max-price">
                    <option value="">No max</option>
                    <option value="5000000" {{ request('max_price') == '5000000' ? 'selected' : '' }}>5,000,000</option>
                    <option value="10000000" {{ request('max_price') == '10000000' ? 'selected' : '' }}>10,000,000</option>
                    <option value="20000000" {{ request('max_price') == '20000000' ? 'selected' : '' }}>20,000,000</option>
                    <option value="50000000" {{ request('max_price') == '50000000' ? 'selected' : '' }}>50,000,000</option>
                    <option value="100000000" {{ request('max_price') == '100000000' ? 'selected' : '' }}>100,000,000</option>
                </select>
            </div>
            <div class="group">
                <label for="bedrooms">Bedrooms</label>
                <select name="bedrooms" id="bedrooms">
                    <option value="">Any</option>
                    @foreach(range(1, 6) as $n)
                        <option value="{{ $n }}" {{ request('bedrooms') == $n ? 'selected' : '' }}>{{ $n }}+</option>
                    @endforeach
                </select>
            </div>
            <div class="flex group" style="flex-direction: row; gap: 16px; align-items: center; padding-top: 22px;">
                <div class="flex-col">
                    <input type="radio" name="sale_or_rent" id="sale" value="sale" {{ request('sale_or_rent') !== 'rent' ? 'checked' : '' }}>
                    <label for="sale">Sale</label>
                </div>
                <div class="flex-col">
                    <input type="radio" name="sale_or_rent" id="rent" value="rent" {{ request('sale_or_rent') === 'rent' ? 'checked' : '' }}>
                    <label for="rent">Rent</label>
                </div>
            </div>
            <div class="flex group" style="align-items: end;">
                <button class="btn" type="submit">Search</button>
            </div>
        </form>
    </div>
</div>

@if($isSearch)
    <section class="section section--after-search">
        <div class="container">
            <div class="section-header">
                <h2>Search Results</h2>
                <p>{{ $properties->total() }} {{ $properties->total() > 1 ? 'properties found' : 'property found' }}</p>
            </div>
            @if($properties->count() > 0)
                <div class="property-grid">
                    @foreach($properties as $property)
                        @include('public._property-card', ['property' => $property])
                    @endforeach
                </div>
                @if(method_exists($properties, 'links'))
                    <div style="margin-top: 40px;">
                        {{ $properties->links() }}
                    </div>
                @endif
            @else
                <div class="empty-state">
                    <div class="empty-icon">🔍</div>
                    <h3>No properties match your search</h3>
                    <p>Try adjusting your filters or browse our categories below</p>
                </div>
            @endif
        </div>
    </section>
@endif

<section class="section {{ $isSearch ? '' : 'section--after-search' }}">
    <div class="container">
        <div class="section-header">
            <h2>Property Categories</h2>
            <p>Explore properties by category</p>
        </div>
        <div class="category-grid">
            @foreach($categories as $category)
                <div class="category-card">
                    <a href="{{ route('home', ['property_type' => $category->id]) }}">
                        <h3>{{ $category->name }}</h3>
                    </a>
                </div>
            @endforeach
        </div>
    </div>
</section>

<section class="section">
    <div class="container">
        <div class="section-header">
            <h2>Featured Properties</h2>
            <p>Discover our most popular properties</p>
        </div>
        @if($featuredProperties->count() > 0)
            <div class="property-grid">
                @foreach($featuredProperties as $property)
                    @include('public._property-card', ['property' => $property])
                @endforeach
            </div>
        @else
            <div class="empty-state">
                <div class="empty-icon">⭐</div>
                <h3>No featured properties yet</h3>
                <p>Featured properties will appear here</p>
            </div>
        @endif
    </div>
</section>

<section class="section">
    <div class="container">
        <div class="section-header">
            <h2>Latest Properties</h2>
            <p>The latest properties added to our platform</p>
        </div>
        @if($lastProperties->count() > 0)
            <div class="property-grid">
                @foreach($lastProperties as $property)
                    @include('public._property-card', ['property' => $property])
                @endforeach
            </div>
        @else
            <div class="empty-state">
                <div class="empty-icon">🏠</div>
                <h3>No properties yet</h3>
                <p>Properties will be added soon</p>
            </div>
        @endif
    </div>
</section>

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
                        <a href="{{ route('property.show', $property->id) }}" class="btn-details">Voir Détails</a>
                        <form action="{{ route('property.cancelfavorite', $property->id) }}" method="POST" style="display: inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn-remove">Remove from Favorites</button>
                        </form>
                    </div>
                @endforeach
            @else
                <div class="empty-state">
                    <div class="empty-icon">💖</div>
                    <h3>No favorite properties</h3>
                    <p>Properties you add to favorites will appear here</p>
                </div>
            @endif
        </div>
    </form>
</div>
@endsection
