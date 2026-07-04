@extends('layouts.user')

@section('title', 'Sell Your Car | Nitro Motors USA')
@section('meta_description', 'Tell Nitro Motors USA about your vehicle and get a premium, market-aware path to selling your car.')

@section('content')
    @include('user.partials.page-hero', [
        'eyebrow' => 'Sell Your Car',
        'title' => 'Turn your vehicle into the next standout listing with less hassle.',
        'copy' => 'Share the details of your car, SUV, or truck and our team will review condition, market fit, and the strongest next-step strategy for selling with Nitro Motors USA.',
        'media' => "linear-gradient(135deg, rgba(10,10,10,0.18), rgba(10,10,10,0.64)), url('" . asset('demo/inventory/hero-sports-red.jpg') . "')",
    ])

    @include('user.partials.service-form-shell', [
        'sidebar' => view('user.sell._sell-sidebar'),
        'form' => view('user.sell._sell-form', [
            'years' => $years,
            'transmissions' => $transmissions,
            'states' => $states,
        ]),
    ])

    @include('user.partials.page-cta', [
        'eyebrow' => 'Need A Faster Answer?',
        'title' => 'Talk with our team about pricing, trade-in timing, and listing strategy.',
        'copy' => 'If you want to move quickly, book a call and we can walk through your vehicle details and next steps together.',
        'primaryLabel' => 'Book A Call',
        'primaryUrl' => route('appointment'),
        'secondaryLabel' => 'Contact Us',
        'secondaryUrl' => route('contact'),
    ])
@endsection
