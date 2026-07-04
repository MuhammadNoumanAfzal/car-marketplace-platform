<div class="section-heading section-heading--left mb-6">
    <p class="section-label">Vehicle Submission</p>
    <h2 class="section-title mt-4">Tell us about the vehicle and how you want to sell it.</h2>
</div>

<form action="{{ route('sell-your-car.send') }}" method="POST" class="contact-form">
    @csrf

    <div class="service-form-group">
        <h3 class="service-form-group__title">Vehicle Profile</h3>

        <div class="contact-form__grid">
            <label class="contact-field">
                <span class="contact-field__label">Year</span>
                <select name="vehicle_year" class="contact-field__input">
                    <option value="">Select year</option>
                    @foreach ($years as $year)
                        <option value="{{ $year }}" @selected((string) old('vehicle_year') === (string) $year)>{{ $year }}</option>
                    @endforeach
                </select>
                @error('vehicle_year') <span class="contact-field__error">{{ $message }}</span> @enderror
            </label>

            <label class="contact-field">
                <span class="contact-field__label">Make</span>
                <input type="text" name="make" value="{{ old('make') }}" class="contact-field__input" placeholder="Mercedes-Benz, BMW, Porsche...">
                @error('make') <span class="contact-field__error">{{ $message }}</span> @enderror
            </label>
        </div>

        <div class="contact-form__grid">
            <label class="contact-field">
                <span class="contact-field__label">Model</span>
                <input type="text" name="model" value="{{ old('model') }}" class="contact-field__input" placeholder="GLE 450, 911 Carrera, X5...">
                @error('model') <span class="contact-field__error">{{ $message }}</span> @enderror
            </label>

            <label class="contact-field">
                <span class="contact-field__label">Trim</span>
                <input type="text" name="trim" value="{{ old('trim') }}" class="contact-field__input" placeholder="AMG Line, Premium Plus, Touring...">
                @error('trim') <span class="contact-field__error">{{ $message }}</span> @enderror
            </label>
        </div>

        <div class="contact-form__grid">
            <label class="contact-field">
                <span class="contact-field__label">Exterior Color</span>
                <input type="text" name="exterior_color" value="{{ old('exterior_color') }}" class="contact-field__input" placeholder="Black, White, Silver...">
                @error('exterior_color') <span class="contact-field__error">{{ $message }}</span> @enderror
            </label>

            <label class="contact-field">
                <span class="contact-field__label">Interior Color</span>
                <input type="text" name="interior_color" value="{{ old('interior_color') }}" class="contact-field__input" placeholder="Black, Tan, Red...">
                @error('interior_color') <span class="contact-field__error">{{ $message }}</span> @enderror
            </label>
        </div>

        <div class="contact-form__grid">
            <label class="contact-field">
                <span class="contact-field__label">Mileage</span>
                <input type="text" name="mileage" value="{{ old('mileage') }}" class="contact-field__input" placeholder="Current mileage">
                @error('mileage') <span class="contact-field__error">{{ $message }}</span> @enderror
            </label>

            <label class="contact-field">
                <span class="contact-field__label">Transmission</span>
                <select name="transmission" class="contact-field__input">
                    <option value="">Select transmission</option>
                    @foreach ($transmissions as $transmission)
                        <option value="{{ $transmission }}" @selected(old('transmission') === $transmission)>{{ $transmission }}</option>
                    @endforeach
                </select>
                @error('transmission') <span class="contact-field__error">{{ $message }}</span> @enderror
            </label>
        </div>

        <div class="contact-form__grid">
            <label class="contact-field">
                <span class="contact-field__label">Cylinders</span>
                <input type="text" name="cylinders" value="{{ old('cylinders') }}" class="contact-field__input" placeholder="4, 6, 8...">
                @error('cylinders') <span class="contact-field__error">{{ $message }}</span> @enderror
            </label>

            <label class="contact-field">
                <span class="contact-field__label">Engine Size</span>
                <input type="text" name="liters" value="{{ old('liters') }}" class="contact-field__input" placeholder="2.0L, 3.0L, 5.0L...">
                @error('liters') <span class="contact-field__error">{{ $message }}</span> @enderror
            </label>
        </div>

        <label class="contact-field">
            <span class="contact-field__label">Lien Holder</span>
            <input type="text" name="lien_holder" value="{{ old('lien_holder') }}" class="contact-field__input" placeholder="If there is an active lien, tell us who holds it">
            @error('lien_holder') <span class="contact-field__error">{{ $message }}</span> @enderror
        </label>

        <label class="contact-field">
            <span class="contact-field__label">Vehicle Notes</span>
            <textarea name="additional_options" rows="6" class="contact-field__input contact-field__textarea" placeholder="Share VIN, title status, packages, service history, accident history, modifications, condition notes, desired price, payoff amount, or anything else we should know.">{{ old('additional_options') }}</textarea>
            @error('additional_options') <span class="contact-field__error">{{ $message }}</span> @enderror
        </label>
    </div>

    <div class="service-form-group">
        <h3 class="service-form-group__title">Owner Contact Details</h3>

        <div class="contact-form__grid">
            <label class="contact-field">
                <span class="contact-field__label">First Name</span>
                <input type="text" name="first_name" value="{{ old('first_name') }}" class="contact-field__input" placeholder="Enter your first name">
                @error('first_name') <span class="contact-field__error">{{ $message }}</span> @enderror
            </label>

            <label class="contact-field">
                <span class="contact-field__label">Last Name</span>
                <input type="text" name="last_name" value="{{ old('last_name') }}" class="contact-field__input" placeholder="Enter your last name">
                @error('last_name') <span class="contact-field__error">{{ $message }}</span> @enderror
            </label>
        </div>

        <div class="contact-form__grid">
            <label class="contact-field">
                <span class="contact-field__label">Address</span>
                <input type="text" name="address" value="{{ old('address') }}" class="contact-field__input" placeholder="Street address">
                @error('address') <span class="contact-field__error">{{ $message }}</span> @enderror
            </label>

            <label class="contact-field">
                <span class="contact-field__label">City</span>
                <input type="text" name="city" value="{{ old('city') }}" class="contact-field__input" placeholder="City">
                @error('city') <span class="contact-field__error">{{ $message }}</span> @enderror
            </label>
        </div>

        <div class="contact-form__grid">
            <label class="contact-field">
                <span class="contact-field__label">State</span>
                <select name="state" class="contact-field__input">
                    <option value="">Select state</option>
                    @foreach ($states as $state)
                        <option value="{{ $state }}" @selected(old('state') === $state)>{{ $state }}</option>
                    @endforeach
                </select>
                @error('state') <span class="contact-field__error">{{ $message }}</span> @enderror
            </label>

            <label class="contact-field">
                <span class="contact-field__label">ZIP Code</span>
                <input type="text" name="zip" value="{{ old('zip') }}" class="contact-field__input" placeholder="ZIP code">
                @error('zip') <span class="contact-field__error">{{ $message }}</span> @enderror
            </label>
        </div>

        <div class="contact-form__grid">
            <label class="contact-field">
                <span class="contact-field__label">Email</span>
                <input type="email" name="email" value="{{ old('email') }}" class="contact-field__input" placeholder="you@example.com">
                @error('email') <span class="contact-field__error">{{ $message }}</span> @enderror
            </label>

            <label class="contact-field">
                <span class="contact-field__label">Phone</span>
                <input type="text" name="phone" value="{{ old('phone') }}" class="contact-field__input" placeholder="+1 (305) 555-0147">
                @error('phone') <span class="contact-field__error">{{ $message }}</span> @enderror
            </label>
        </div>
    </div>

    <div class="contact-form__actions">
        <button type="submit" class="hero-actions__primary">
            <span>Submit Vehicle</span>
            <span class="hero-actions__arrow">&#8594;</span>
        </button>
        <button type="reset" class="service-reset-button">Reset</button>
    </div>
</form>
