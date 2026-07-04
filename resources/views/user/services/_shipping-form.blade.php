<div class="section-heading section-heading--left mb-6">
    <p class="section-label">Request Shipping</p>
    <h2 class="section-title mt-4">Tell us the route and vehicle details for your transport quote.</h2>
</div>

<form action="{{ route('services.shipping.send') }}" method="POST" class="contact-form">
    @csrf

    <div class="contact-form__grid">
        <label class="contact-field">
            <span class="contact-field__label">Full Name</span>
            <input type="text" name="name" value="{{ old('name') }}" class="contact-field__input" placeholder="Enter your full name">
            @error('name') <span class="contact-field__error">{{ $message }}</span> @enderror
        </label>

        <label class="contact-field">
            <span class="contact-field__label">Email Address</span>
            <input type="email" name="email" value="{{ old('email') }}" class="contact-field__input" placeholder="you@example.com">
            @error('email') <span class="contact-field__error">{{ $message }}</span> @enderror
        </label>
    </div>

    <div class="contact-form__grid">
        <label class="contact-field">
            <span class="contact-field__label">Phone Number</span>
            <input type="text" name="phone" value="{{ old('phone') }}" class="contact-field__input" placeholder="+1 (312) 735-9915">
            @error('phone') <span class="contact-field__error">{{ $message }}</span> @enderror
        </label>

        <label class="contact-field">
            <span class="contact-field__label">Transport Type</span>
            <select name="transport_type" class="contact-field__input">
                <option value="">Select transport type</option>
                @foreach ($transportTypes as $type)
                    <option value="{{ $type }}" @selected(old('transport_type') === $type)>{{ $type }}</option>
                @endforeach
            </select>
            @error('transport_type') <span class="contact-field__error">{{ $message }}</span> @enderror
        </label>
    </div>

    <div class="contact-form__grid">
        <label class="contact-field">
            <span class="contact-field__label">Vehicle Year</span>
            <input type="text" name="vehicle_year" value="{{ old('vehicle_year') }}" class="contact-field__input" placeholder="2024">
            @error('vehicle_year') <span class="contact-field__error">{{ $message }}</span> @enderror
        </label>

        <label class="contact-field">
            <span class="contact-field__label">Vehicle Make</span>
            <input type="text" name="vehicle_make" value="{{ old('vehicle_make') }}" class="contact-field__input" placeholder="Porsche">
            @error('vehicle_make') <span class="contact-field__error">{{ $message }}</span> @enderror
        </label>
    </div>

    <div class="contact-form__grid">
        <label class="contact-field">
            <span class="contact-field__label">Vehicle Model</span>
            <input type="text" name="vehicle_model" value="{{ old('vehicle_model') }}" class="contact-field__input" placeholder="911 Carrera">
            @error('vehicle_model') <span class="contact-field__error">{{ $message }}</span> @enderror
        </label>

        <label class="contact-field">
            <span class="contact-field__label">Pickup Window</span>
            <select name="pickup_window" class="contact-field__input">
                <option value="">Select pickup window</option>
                @foreach ($pickupWindows as $window)
                    <option value="{{ $window }}" @selected(old('pickup_window') === $window)>{{ $window }}</option>
                @endforeach
            </select>
            @error('pickup_window') <span class="contact-field__error">{{ $message }}</span> @enderror
        </label>
    </div>

    <div class="contact-form__grid">
        <label class="contact-field">
            <span class="contact-field__label">Pickup Location</span>
            <input type="text" name="origin" value="{{ old('origin') }}" class="contact-field__input" placeholder="City, State or ZIP">
            @error('origin') <span class="contact-field__error">{{ $message }}</span> @enderror
        </label>

        <label class="contact-field">
            <span class="contact-field__label">Delivery Location</span>
            <input type="text" name="destination" value="{{ old('destination') }}" class="contact-field__input" placeholder="City, State or ZIP">
            @error('destination') <span class="contact-field__error">{{ $message }}</span> @enderror
        </label>
    </div>

    <label class="contact-field">
        <span class="contact-field__label">Notes</span>
        <textarea name="notes" rows="6" class="contact-field__input contact-field__textarea" placeholder="Share condition notes, timing details, or anything our transport team should know.">{{ old('notes') }}</textarea>
        @error('notes') <span class="contact-field__error">{{ $message }}</span> @enderror
    </label>

    <div class="contact-form__actions">
        <button type="submit" class="hero-actions__primary">
            <span>Request Shipping Quote</span>
            <span class="hero-actions__arrow">&#8594;</span>
        </button>
    </div>
</form>
