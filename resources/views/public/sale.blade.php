@extends('layouts.public')

@section('title', 'Properties for Sale')

@section('content')
<section class="section" style="padding-top: 140px;">
    <div class="container">
        <div class="section-header">
            <h2>Properties for Sale</h2>
            <p>Find your dream home among our selection</p>
        </div>

        @if($SaleProperties->count() > 0)
            <div class="property-grid">
                @foreach($SaleProperties as $property)
                    @include('public._property-card', ['property' => $property])
                @endforeach
            </div>

            @if(method_exists($SaleProperties, 'links'))
                <div style="margin-top: 40px;">
                    {{ $SaleProperties->links() }}
                </div>
            @endif
        @else
            <div class="empty-state">
                <div class="empty-icon">🏠</div>
                <h3>No properties for sale at the moment</h3>
                <p>Check back soon for new listings</p>
            </div>
        @endif
    </div>
</section>
@endsection
