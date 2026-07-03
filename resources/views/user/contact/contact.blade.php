@extends('layouts.user')

@section('title', 'Contact Us | Nitro Motors USA')
@section('meta_description', 'Contact Nitro Motors USA for inventory questions, financing support, showroom appointments, and premium buyer guidance.')

@section('content')
    @include('user.partials.page-hero', [
        'eyebrow' => 'Contact Us',
        'title' => 'Reach the team behind the Nitro Motors USA experience.',
        'copy' => 'Ask about inventory, financing, remote buying, trade-ins, or visit scheduling. We keep the process clear, responsive, and easy to move forward with.',
        'media' => "linear-gradient(135deg, rgba(10,10,10,0.22), rgba(10,10,10,0.64)), url('https://images.unsplash.com/photo-1503376780353-7e6692767b70?auto=format&fit=crop&w=1400&q=80')",
    ])

    <section class="relative z-10 bg-asphalt pb-16">
        <div class="mx-auto grid w-full max-w-[1600px] gap-5 px-4 sm:px-8 lg:grid-cols-[0.9fr_1.1fr] lg:px-12 xl:px-16">
            <div class="contact-panel">
                <div class="contact-panel__section">
                    <p class="contact-panel__eyebrow">Showroom</p>
                    <h2 class="contact-panel__title">Nitro Motors USA</h2>
                    <p class="contact-panel__copy">1450 NW 79th Avenue<br>Miami, FL 33126</p>
                </div>

                <div class="contact-panel__section">
                    <p class="contact-panel__eyebrow">Reach Us</p>
                    <p class="contact-panel__copy">Phone: +1 (305) 555-0147<br>Email: sales@nitromotorsusa.com</p>
                </div>

                <div class="contact-panel__section">
                    <p class="contact-panel__eyebrow">Working Hours</p>
                    <p class="contact-panel__copy">Monday - Friday: 10:00 AM - 7:00 PM<br>Saturday - Sunday: By Appointment</p>
                </div>

                <div class="contact-panel__badge">
                    <span class="contact-panel__badge-label">Response Time</span>
                    <span class="contact-panel__badge-value">Usually within 24 hours</span>
                </div>
            </div>

            <div id="quick-contact" class="contact-form-card">
                <div class="section-heading section-heading--left mb-6">
                    <p class="section-label">Send A Message</p>
                    <h2 class="section-title mt-4">Tell us what you need and we will point you in the right direction.</h2>
                </div>

                @if (session('status'))
                    <div class="contact-alert" role="status">
                        {{ session('status') }}
                    </div>
                @endif

                <form action="{{ route('contact.send') }}" method="POST" class="contact-form">
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
                            <input type="text" name="phone" value="{{ old('phone') }}" class="contact-field__input" placeholder="+1 (305) 555-0147">
                            @error('phone')
                                <span class="contact-field__error">{{ $message }}</span>
                            @enderror
                        </label>

                        <label class="contact-field">
                            <span class="contact-field__label">Topic</span>
                            <select name="topic" class="contact-field__input">
                                <option value="">Select a topic</option>
                                @foreach ($topics as $topic)
                                    <option value="{{ $topic }}" @selected(old('topic') === $topic)>{{ $topic }}</option>
                                @endforeach
                            </select>
                            @error('topic')
                                <span class="contact-field__error">{{ $message }}</span>
                            @enderror
                        </label>
                    </div>

                    <label class="contact-field">
                        <span class="contact-field__label">Message</span>
                        <textarea name="message" rows="6" class="contact-field__input contact-field__textarea" placeholder="Tell us about the vehicle, timeline, or support you need.">{{ old('message') }}</textarea>
                        @error('message')
                            <span class="contact-field__error">{{ $message }}</span>
                        @enderror
                    </label>

                    <div class="contact-form__actions">
                        <button type="submit" class="hero-actions__primary">
                            <span>Send Inquiry</span>
                            <span class="hero-actions__arrow">&#8594;</span>
                        </button>
                        <a href="{{ route('directions') }}" class="hero-actions__secondary">
                            <span class="hero-actions__secondary-line"></span>
                            <span>View Directions</span>
                        </a>
                    </div>
                </form>
            </div>
        </div>
    </section>
@endsection
