@extends('layouts.user')

@section('title', 'Book An Appointment | Nitro Motors USA')
@section('meta_description', 'Book a showroom visit, virtual walkaround, or consultation with Nitro Motors USA.')

@section('content')
    @include('user.partials.page-hero', [
        'eyebrow' => 'Appointment',
        'title' => 'Book time with the Nitro Motors USA team.',
        'copy' => 'Schedule a showroom visit, virtual walkaround, trade-in review, or financing consultation through a cleaner, faster appointment flow.',
        'media' => "linear-gradient(135deg, rgba(10,10,10,0.22), rgba(10,10,10,0.64)), url('https://images.unsplash.com/photo-1494976388531-d1058494cdd8?auto=format&fit=crop&w=1400&q=80')",
    ])

    <section class="relative z-10 bg-asphalt pb-16" data-reveal-section>
        <div class="mx-auto grid w-full max-w-[1600px] gap-5 px-4 sm:px-8 lg:grid-cols-[0.9fr_1.1fr] lg:px-12 xl:px-16">
            <div class="contact-panel reveal-card" data-reveal>
                <div class="contact-panel__section">
                    <p class="contact-panel__eyebrow">Appointments</p>
                    <h2 class="contact-panel__title">Choose the type of appointment that fits your next step.</h2>
                    <p class="contact-panel__copy">Book in-person showroom visits, remote consultations, or guided calls about inventory, financing, and delivery planning.</p>
                </div>

                <div class="contact-panel__section">
                    <p class="contact-panel__eyebrow">Availability</p>
                    <p class="contact-panel__copy">Monday - Friday: 10:00 AM - 7:00 PM<br>Saturday - Sunday: By Appointment</p>
                </div>

                <div class="contact-panel__section">
                    <p class="contact-panel__eyebrow">Showroom</p>
                    <p class="contact-panel__copy">4238 Lindley Ln<br>Downers Grove, IL 60515<br>Phone: +1 (312) 735-9915</p>
                </div>

                <div class="contact-panel__badge">
                    <span class="contact-panel__badge-label">Confirmation</span>
                    <span class="contact-panel__badge-value">Typically confirmed within one business day</span>
                </div>
            </div>

            <div id="quick-contact" class="contact-form-card reveal-card" data-reveal data-reveal-delay="100">
                <div class="section-heading section-heading--left mb-6">
                    <p class="section-label">Book Appointment</p>
                    <h2 class="section-title mt-4">Send your preferred date and time and we will confirm the best slot.</h2>
                </div>

                @if (session('status'))
                    <div class="contact-alert" role="status">
                        {{ session('status') }}
                    </div>
                @endif

                <form action="{{ route('appointment.book') }}" method="POST" class="contact-form">
                    @csrf

                    <div class="contact-form__grid">
                        <label class="contact-field">
                            <span class="contact-field__label">Full Name</span>
                            <input type="text" name="name" value="{{ old('name') }}" class="contact-field__input" placeholder="Enter your full name">
                            @error('name')
                                <span class="contact-field__error">{{ $message }}</span>
                            @enderror
                        </label>

                        <label class="contact-field">
                            <span class="contact-field__label">Email Address</span>
                            <input type="email" name="email" value="{{ old('email') }}" class="contact-field__input" placeholder="you@example.com">
                            @error('email')
                                <span class="contact-field__error">{{ $message }}</span>
                            @enderror
                        </label>
                    </div>

                    <div class="contact-form__grid">
                        <label class="contact-field">
                            <span class="contact-field__label">Phone Number</span>
                            <input type="text" name="phone" value="{{ old('phone') }}" class="contact-field__input" placeholder="+1 (312) 735-9915">
                            @error('phone')
                                <span class="contact-field__error">{{ $message }}</span>
                            @enderror
                        </label>

                        <label class="contact-field">
                            <span class="contact-field__label">Appointment Type</span>
                            <select name="appointment_type" class="contact-field__input">
                                <option value="">Select an appointment type</option>
                                @foreach ($appointmentTypes as $type)
                                    <option value="{{ $type }}" @selected(old('appointment_type') === $type)>{{ $type }}</option>
                                @endforeach
                            </select>
                            @error('appointment_type')
                                <span class="contact-field__error">{{ $message }}</span>
                            @enderror
                        </label>
                    </div>

                    <div class="contact-form__grid">
                        <label class="contact-field">
                            <span class="contact-field__label">Preferred Date</span>
                            <input type="date" name="preferred_date" value="{{ old('preferred_date') }}" class="contact-field__input">
                            @error('preferred_date')
                                <span class="contact-field__error">{{ $message }}</span>
                            @enderror
                        </label>

                        <label class="contact-field">
                            <span class="contact-field__label">Preferred Time</span>
                            <select name="preferred_time" class="contact-field__input">
                                <option value="">Select a preferred time</option>
                                @foreach ($timeSlots as $slot)
                                    <option value="{{ $slot }}" @selected(old('preferred_time') === $slot)>{{ $slot }}</option>
                                @endforeach
                            </select>
                            @error('preferred_time')
                                <span class="contact-field__error">{{ $message }}</span>
                            @enderror
                        </label>
                    </div>

                    <label class="contact-field">
                        <span class="contact-field__label">Notes</span>
                        <textarea name="notes" rows="6" class="contact-field__input contact-field__textarea" placeholder="Share the vehicle, questions, or appointment details you want us to prepare for.">{{ old('notes') }}</textarea>
                        @error('notes')
                            <span class="contact-field__error">{{ $message }}</span>
                        @enderror
                    </label>

                    <div class="contact-form__actions">
                        <button type="submit" class="hero-actions__primary">
                            <span>Request Appointment</span>
                            <span class="hero-actions__arrow">&#8594;</span>
                        </button>
                        <a href="{{ route('contact') }}" class="hero-actions__secondary">
                            <span class="hero-actions__secondary-line"></span>
                            <span>Contact Us</span>
                        </a>
                    </div>
                </form>
            </div>
        </div>
    </section>
@endsection
