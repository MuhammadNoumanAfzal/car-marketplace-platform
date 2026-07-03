@extends('layouts.user')

@section('title', 'Consignment | Nitro Motors USA')
@section('meta_description', 'Submit your vehicle for consignment with Nitro Motors USA and let our team review the details.')

@section('content')
    @include('user.partials.page-hero', [
        'eyebrow' => 'Consignment',
        'title' => 'Submit your vehicle for premium presentation and consignment support.',
        'copy' => 'Share the vehicle details, ownership information, and contact data so our team can review the listing opportunity and next steps.',
        'media' => "linear-gradient(135deg, rgba(10,10,10,0.22), rgba(10,10,10,0.64)), url('https://images.unsplash.com/photo-1503376780353-7e6692767b70?auto=format&fit=crop&w=1400&q=80')",
    ])

    @include('user.partials.service-form-shell', [
        'sidebar' => view('user.services._consignment-sidebar'),
        'form' => view('user.services._consignment-form', [
            'years' => $years,
            'transmissions' => $transmissions,
            'states' => $states,
        ]),
    ])
@endsection
