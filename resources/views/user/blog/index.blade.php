@extends('layouts.user')

@section('title', 'Blog | Nitro Motors USA')
@section('meta_description', 'Read buying tips, financing guidance, trade-in insights, and premium vehicle advice from Nitro Motors USA.')

@section('content')
    @include('user.partials.page-hero', [
        'eyebrow' => 'Blog',
        'title' => 'Insights for buying smarter, trading cleaner, and selling with more confidence.',
        'copy' => 'Explore practical guidance from the Nitro Motors USA team on inventory strategy, financing, trade-ins, remote buying, and premium vehicle ownership.',
        'media' => "linear-gradient(135deg, rgba(10,10,10,0.22), rgba(10,10,10,0.64)), url('" . asset('demo/inventory/hero-highlander-blue.jpg') . "')",
    ])

    <section class="relative z-10 bg-asphalt pb-20" data-reveal-section>
        <div class="mx-auto w-full max-w-[1600px] px-4 sm:px-8 lg:px-12 xl:px-16">
            <div class="blog-grid">
                @forelse ($posts as $post)
                    <article class="blog-card reveal-card" data-reveal data-reveal-delay="{{ $loop->index * 60 }}">
                        <a href="{{ route('blog.detail', $post['slug']) }}" class="blog-card__media">
                            <div class="blog-card__image" style="background-image:url('{{ $post['image'] }}')"></div>
                        </a>
                        <div class="blog-card__body">
                            <p class="blog-card__meta">{{ $post['published_at'] }} · {{ $post['author_name'] }}</p>
                            <h2 class="blog-card__title">
                                <a href="{{ route('blog.detail', $post['slug']) }}">{{ $post['title'] }}</a>
                            </h2>
                            <p class="blog-card__copy">{{ $post['excerpt'] }}</p>
                            <a href="{{ route('blog.detail', $post['slug']) }}" class="hero-actions__secondary">
                                <span class="hero-actions__secondary-line"></span>
                                <span>Read Article</span>
                            </a>
                        </div>
                    </article>
                @empty
                    <div class="blog-empty">
                        <p class="section-label">Coming Soon</p>
                        <h2 class="section-title mt-4">Fresh articles are on the way.</h2>
                        <p class="section-copy mt-4">We are preparing blog posts on financing, vehicle sourcing, shipping, and trade-in strategy.</p>
                    </div>
                @endforelse
            </div>
        </div>
    </section>
@endsection
