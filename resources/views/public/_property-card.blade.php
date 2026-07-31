<div class="property-card">
    <div class="property-image">
        <img src="{{ $property->main_image ? asset('storage/' . $property->main_image) : 'https://placehold.co/600x400/1e3a8a/ffffff?text=Dream+Nest' }}" alt="{{ $property->title }}">
        <span class="property-badge {{ $property->status === 'for sale' ? 'sale' : 'rent' }}">
            {{ $property->status === 'for sale' ? 'À Vendre' : 'À Louer' }}
        </span>
    </div>
    <div class="property-details">
        <h3 class="property-title">{{ $property->title }}</h3>
        <p class="property-location">
            <i class="fas fa-map-marker-alt"></i>
            {{ $property->city }}{{ $property->state ? ', ' . $property->state : '' }}
        </p>
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
        <div class="property-actions">
            <a href="{{ route('property.show', $property->id) }}" class="btn-details">Voir Détails</a>
            @php
                $isFavorite = Auth::check() && $property->isFavoritedBy(Auth::id());
            @endphp
            <form action="{{ $isFavorite ? route('property.cancelfavorite', $property->id) : route('property.favorite', $property->id) }}" method="POST" class="favorite-form">
                @csrf
                @if($isFavorite)
                    @method('DELETE')
                @endif
                <button type="submit" class="btn-favorite {{ $isFavorite ? 'active' : '' }}" title="{{ $isFavorite ? 'Remove from Favorites' : 'Add to Favorites' }}">
                    <i class="fas fa-heart"></i>
                </button>
            </form>
        </div>
    </div>
</div>
