@extends('layouts.public')

@section('title', 'Properties for Rent')

@section('content')
<section class="section" style="padding-top: 140px;">
    <div class="container">
        <div class="section-header">
            <h2>Properties for Rent</h2>
            <p>Discover rental properties that suit your lifestyle</p>
        </div>

        @if($RentProperties->count() > 0)
            <div class="property-grid">
                @foreach($RentProperties as $property)
                    @include('public._property-card', ['property' => $property])
                @endforeach
            </div>

            @if(method_exists($RentProperties, 'links'))
                <div style="margin-top: 40px;">
                    {{ $RentProperties->links() }}
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
