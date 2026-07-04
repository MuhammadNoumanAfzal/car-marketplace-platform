@extends('layouts.user')

@section('title', $post['title'] . ' | Nitro Motors USA')
@section('meta_description', $post['seo_description'] ?: ($post['excerpt'] ?: 'Read the latest insights from Nitro Motors USA.'))

@section('content')
    @include('user.partials.page-hero', [
        'eyebrow' => 'Blog Article',
        'title' => $post['title'],
        'copy' => $post['excerpt'] ?: 'Practical guidance from Nitro Motors USA for buyers, sellers, and trade-in customers.',
        'media' => "linear-gradient(135deg, rgba(10,10,10,0.2), rgba(10,10,10,0.62)), url('" . $post['image'] . "')",
    ])

    <section class="relative z-10 bg-asphalt pb-20" data-reveal-section>
        <div class="mx-auto w-full max-w-[1100px] px-4 sm:px-8 lg:px-12">
            <article class="blog-detail reveal-card" data-reveal>
                <div class="blog-detail__meta">{{ $post['published_at'] }} · {{ $post['author_name'] }}</div>
                <div class="blog-detail__content">{!! $post['content'] !!}</div>
            </article>
        </div>
    </section>

    @include('user.partials.page-cta', [
        'eyebrow' => 'Need Personal Guidance?',
        'title' => 'Talk with our team about financing, trade-ins, inventory, or your next move.',
        'copy' => 'If you want advice tailored to your vehicle or budget, we can help you move from reading to action.',
        'primaryLabel' => 'Contact Us',
        'primaryUrl' => route('contact'),
        'secondaryLabel' => 'Book A Call',
        'secondaryUrl' => route('appointment'),
    ])
@endsection
