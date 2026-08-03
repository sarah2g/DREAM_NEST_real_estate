@extends('layouts.public')

@section('title', 'Contactez-nous')

@section('content')
<section class="section contact-section">
    <div class="container">
        <div class="section-header">
            <h2>Contactez-nous</h2>
            <p>Une question sur nos biens immobiliers ? Écrivez-nous, nous vous répondrons rapidement.</p>
        </div>

        @if (session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif

        <div class="contact-wrapper">
            <div class="contact-info">
                <h3>Dream Nest Immobilier</h3>
                <p>Votre partenaire de confiance pour trouver le bien de vos rêves.</p>

                <div class="contact-item">
                    <i class="fas fa-map-marker-alt"></i>
                    <div>
                        <strong>Adresse</strong>
                        <span>Alger, Algérie</span>
                    </div>
                </div>

                <div class="contact-item">
                    <i class="fas fa-phone-alt"></i>
                    <div>
                        <strong>Téléphone</strong>
                        <span>+213 55 00 00 00</span>
                    </div>
                </div>

                <div class="contact-item">
                    <i class="fas fa-envelope"></i>
                    <div>
                        <strong>Email</strong>
                        <span>contact@dreamnest.dz</span>
                    </div>
                </div>

                <div class="contact-item">
                    <i class="fas fa-clock"></i>
                    <div>
                        <strong>Horaires</strong>
                        <span>Lun - Sam : 9h00 - 18h00</span>
                    </div>
                </div>
            </div>

            <form method="POST" action="{{ route('contact.store') }}" class="contact-form">
                @csrf

                @if($property)
                    <div class="form-note">
                        Vous nous contactez au sujet du bien :
                        <strong>{{ $property->title }}</strong>
                        ({{ number_format($property->price, 0, ',', ' ') }} DZD)
                    </div>
                @endif

                <div class="form-group">
                    <label for="name">Nom complet</label>
                    <input
                        id="name"
                        name="name"
                        type="text"
                        class="form-input @error('name') is-invalid @enderror"
                        value="{{ old('name', auth()->user()->name) }}"
                        placeholder="Votre nom complet"
                        required
                    >
                    @error('name')
                        <span class="form-error">{{ $message }}</span>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="email">Email</label>
                    <input
                        id="email"
                        name="email"
                        type="email"
                        class="form-input @error('email') is-invalid @enderror"
                        value="{{ old('email', auth()->user()->email) }}"
                        placeholder="votre@email.com"
                        required
                    >
                    @error('email')
                        <span class="form-error">{{ $message }}</span>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="phone">Téléphone <span class="optional">(optionnel)</span></label>
                    <input
                        id="phone"
                        name="phone"
                        type="text"
                        class="form-input @error('phone') is-invalid @enderror"
                        value="{{ old('phone', auth()->user()->phone) }}"
                        placeholder="+213 55 00 00 00"
                    >
                    @error('phone')
                        <span class="form-error">{{ $message }}</span>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="message">Message</label>
                    <textarea
                        id="message"
                        name="message"
                        rows="6"
                        class="form-input @error('message') is-invalid @enderror"
                        placeholder="Décrivez votre demande..."
                        required
                    >{{ old('message') }}</textarea>
                    @error('message')
                        <span class="form-error">{{ $message }}</span>
                    @enderror
                </div>

                <button type="submit" class="contact-submit">
                    Envoyer le message
                </button>
            </form>
        </div>
    </div>
</section>
@endsection
