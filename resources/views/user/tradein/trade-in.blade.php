@extends('layouts.user')

@section('title', 'Trade-In | Nitro Motors USA')
@section('meta_description', 'Tell Nitro Motors USA about your current vehicle and your next target so we can help plan a cleaner trade-in path.')

@section('content')
    @include('user.partials.page-hero', [
        'eyebrow' => 'Trade-In',
        'title' => 'Upgrade into your next vehicle with a clearer trade-in strategy.',
        'copy' => 'Share what you drive now, what you want next, and how soon you want to move so our team can help line up value, budget, and timing.',
        'media' => "linear-gradient(135deg, rgba(10,10,10,0.18), rgba(10,10,10,0.64)), url('" . asset('demo/inventory/hero-sequoia-silver.jpg') . "')",
    ])

    @include('user.partials.service-form-shell', [
        'sidebar' => view('user.tradein._tradein-sidebar'),
        'form' => view('user.tradein._tradein-form', [
            'years' => $years,
            'states' => $states,
            'timelines' => $timelines,
            'budgets' => $budgets,
        ]),
    ])
@endsection
