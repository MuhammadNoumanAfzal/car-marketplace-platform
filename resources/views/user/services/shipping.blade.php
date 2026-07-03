@extends('layouts.user')

@section('title', 'Vehicle Shipping | Nitro Motors USA')
@section('meta_description', 'Request premium vehicle shipping support from Nitro Motors USA with enclosed, open, and expedited transport options.')

@section('content')
    @include('user.partials.page-hero', [
        'eyebrow' => 'Shipping',
        'title' => 'Move your vehicle with cleaner logistics and premium support.',
        'copy' => 'Request nationwide vehicle transport with clear communication, flexible pickup timing, and support built around premium inventory.',
        'media' => "linear-gradient(135deg, rgba(10,10,10,0.22), rgba(10,10,10,0.64)), url('https://images.unsplash.com/photo-1492144534655-ae79c964c9d7?auto=format&fit=crop&w=1400&q=80')",
    ])

    @include('user.partials.service-form-shell', [
        'sidebar' => view('user.services._shipping-sidebar'),
        'form' => view('user.services._shipping-form', [
            'transportTypes' => $transportTypes,
            'pickupWindows' => $pickupWindows,
        ]),
    ])
@endsection
