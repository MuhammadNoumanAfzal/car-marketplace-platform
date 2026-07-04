<div class="section-heading section-heading--left mb-6">
    <p class="section-label">Trade-In Request</p>
    <h2 class="section-title mt-4">Tell us about your current vehicle and what you want next.</h2>
</div>

<form action="{{ route('trade-in.send') }}" method="POST" class="contact-form">
    @csrf

    <div class="service-form-group">
        <h3 class="service-form-group__title">Current Vehicle</h3>

        <div class="contact-form__grid">
            <label class="contact-field">
                <span class="contact-field__label">Year</span>
                <select name="current_vehicle_year" class="contact-field__input">
                    <option value="">Select year</option>
                    @foreach ($years as $year)
                        <option value="{{ $year }}" @selected((string) old('current_vehicle_year') === (string) $year)>{{ $year }}</option>
                    @endforeach
                </select>
                @error('current_vehicle_year') <span class="contact-field__error">{{ $message }}</span> @enderror
            </label>

            <label class="contact-field">
                <span class="contact-field__label">Make</span>
                <input type="text" name="current_make" value="{{ old('current_make') }}" class="contact-field__input" placeholder="BMW, Lexus, Toyota...">
                @error('current_make') <span class="contact-field__error">{{ $message }}</span> @enderror
            </label>
        </div>

        <div class="contact-form__grid">
            <label class="contact-field">
                <span class="contact-field__label">Model</span>
                <input type="text" name="current_model" value="{{ old('current_model') }}" class="contact-field__input" placeholder="X5, RX 350, Tacoma...">
                @error('current_model') <span class="contact-field__error">{{ $message }}</span> @enderror
            </label>

            <label class="contact-field">
                <span class="contact-field__label">Trim</span>
                <input type="text" name="current_trim" value="{{ old('current_trim') }}" class="contact-field__input" placeholder="Optional trim">
                @error('current_trim') <span class="contact-field__error">{{ $message }}</span> @enderror
            </label>
        </div>

        <div class="contact-form__grid">
            <label class="contact-field">
                <span class="contact-field__label">Mileage</span>
                <input type="text" name="current_mileage" value="{{ old('current_mileage') }}" class="contact-field__input" placeholder="Current mileage">
                @error('current_mileage') <span class="contact-field__error">{{ $message }}</span> @enderror
            </label>

            <label class="contact-field">
                <span class="contact-field__label">VIN</span>
                <input type="text" name="current_vin" value="{{ old('current_vin') }}" class="contact-field__input" placeholder="Optional VIN">
                @error('current_vin') <span class="contact-field__error">{{ $message }}</span> @enderror
            </label>
        </div>

        <label class="contact-field">
            <span class="contact-field__label">Payoff Balance</span>
            <input type="text" name="trade_payoff" value="{{ old('trade_payoff') }}" class="contact-field__input" placeholder="If you still owe on the vehicle, share the approximate payoff">
            @error('trade_payoff') <span class="contact-field__error">{{ $message }}</span> @enderror
        </label>
    </div>

    <div class="service-form-group">
        <h3 class="service-form-group__title">Next Vehicle Goals</h3>

        <label class="contact-field">
            <span class="contact-field__label">Desired Vehicle</span>
            <input type="text" name="desired_vehicle" value="{{ old('desired_vehicle') }}" class="contact-field__input" placeholder="What are you hoping to move into next?">
            @error('desired_vehicle') <span class="contact-field__error">{{ $message }}</span> @enderror
        </label>

        <div class="contact-form__grid">
            <label class="contact-field">
                <span class="contact-field__label">Budget Range</span>
                <select name="budget_range" class="contact-field__input">
                    <option value="">Select budget range</option>
                    @foreach ($budgets as $budget)
                        <option value="{{ $budget }}" @selected(old('budget_range') === $budget)>{{ $budget }}</option>
                    @endforeach
                </select>
                @error('budget_range') <span class="contact-field__error">{{ $message }}</span> @enderror
            </label>

            <label class="contact-field">
                <span class="contact-field__label">Purchase Timeline</span>
                <select name="purchase_timeline" class="contact-field__input">
                    <option value="">Select timeline</option>
                    @foreach ($timelines as $timeline)
                        <option value="{{ $timeline }}" @selected(old('purchase_timeline') === $timeline)>{{ $timeline }}</option>
                    @endforeach
                </select>
                @error('purchase_timeline') <span class="contact-field__error">{{ $message }}</span> @enderror
            </label>
        </div>

        <label class="contact-field">
            <span class="contact-field__label">Condition Notes</span>
            <textarea name="condition_notes" rows="6" class="contact-field__input contact-field__textarea" placeholder="Tell us about condition, service history, accident history, modifications, or what matters most in the trade-in conversation.">{{ old('condition_notes') }}</textarea>
            @error('condition_notes') <span class="contact-field__error">{{ $message }}</span> @enderror
        </label>
    </div>

    <div class="service-form-group">
        <h3 class="service-form-group__title">Contact Details</h3>

        <div class="contact-form__grid">
            <label class="contact-field">
                <span class="contact-field__label">First Name</span>
                <input type="text" name="first_name" value="{{ old('first_name') }}" class="contact-field__input" placeholder="First name">
                @error('first_name') <span class="contact-field__error">{{ $message }}</span> @enderror
            </label>

            <label class="contact-field">
                <span class="contact-field__label">Last Name</span>
                <input type="text" name="last_name" value="{{ old('last_name') }}" class="contact-field__input" placeholder="Last name">
                @error('last_name') <span class="contact-field__error">{{ $message }}</span> @enderror
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
                <input type="text" name="phone" value="{{ old('phone') }}" class="contact-field__input" placeholder="+1 (312) 735-9915">
                @error('phone') <span class="contact-field__error">{{ $message }}</span> @enderror
            </label>
        </div>

        <div class="contact-form__grid">
            <label class="contact-field">
                <span class="contact-field__label">City</span>
                <input type="text" name="city" value="{{ old('city') }}" class="contact-field__input" placeholder="City">
                @error('city') <span class="contact-field__error">{{ $message }}</span> @enderror
            </label>

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
        </div>
    </div>

    <div class="contact-form__actions">
        <button type="submit" class="hero-actions__primary">
            <span>Submit Trade-In</span>
            <span class="hero-actions__arrow">&#8594;</span>
        </button>
        <button type="reset" class="service-reset-button">Reset</button>
    </div>
</form>
