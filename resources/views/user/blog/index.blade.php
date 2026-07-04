@extends('layouts.user')

@section('title', 'Blog | Nitro Motors USA')
@section('meta_description', 'Read buying tips, financing guidance, trade-in insights, and premium vehicle advice from Nitro Motors USA.')
@section('og_image', asset('demo/inventory/hero-highlander-blue.jpg'))

@section('styles')
    <style>
        .journal-page {
            position: relative;
            padding: 7.75rem 0 4.5rem;
        }

        .journal-page::before {
            content: "";
            position: absolute;
            inset: 5.75rem 0 auto;
            height: 26rem;
            background:
                radial-gradient(circle at top left, rgba(225, 29, 46, 0.28), transparent 34%),
                linear-gradient(135deg, rgba(250, 244, 233, 0.96), rgba(237, 228, 212, 0.94));
            border-top: 1px solid rgba(255, 255, 255, 0.08);
            border-bottom: 1px solid rgba(255, 255, 255, 0.08);
            z-index: 0;
        }

        .journal-shell {
            position: relative;
            z-index: 1;
            margin: 0 auto;
            width: 100%;
            max-width: 1520px;
            padding: 0 1rem;
        }

        .journal-hero {
            display: grid;
            gap: 1.25rem;
            padding-top: 0.25rem;
        }

        .journal-kicker,
        .journal-stat__label,
        .journal-card__eyebrow,
        .journal-empty__eyebrow {
            font-size: 0.72rem;
            font-weight: 700;
            letter-spacing: 0.28em;
            text-transform: uppercase;
        }

        .journal-kicker {
            color: #991b1b;
        }

        .journal-title {
            max-width: 11ch;
            margin: 0.55rem 0 0;
            color: #18181b;
            font-family: theme('fontFamily.display');
            font-size: clamp(2.55rem, 5.4vw, 4.85rem);
            font-weight: 700;
            line-height: 0.9;
            text-transform: uppercase;
        }

        .journal-copy {
            max-width: 36rem;
            margin-top: 1rem;
            color: rgba(24, 24, 27, 0.74);
            font-size: 0.94rem;
            line-height: 1.8;
        }

        .journal-stats {
            display: grid;
            gap: 0.8rem;
            grid-template-columns: repeat(3, minmax(0, 1fr));
        }

        .journal-stat {
            border: 1px solid rgba(24, 24, 27, 0.08);
            border-radius: 1.4rem;
            background: rgba(255, 255, 255, 0.58);
            padding: 0.8rem 0.9rem;
            backdrop-filter: blur(10px);
        }

        .journal-stat__value {
            display: block;
            margin-top: 0.45rem;
            color: #18181b;
            font-family: theme('fontFamily.display');
            font-size: 1.35rem;
            font-weight: 700;
        }

        .journal-stat__label {
            color: rgba(24, 24, 27, 0.45);
            letter-spacing: 0.18em;
        }

        .journal-feature {
            display: grid;
            gap: 0;
            overflow: hidden;
            border: 1px solid rgba(255, 255, 255, 0.08);
            border-radius: 1.8rem;
            background: #121214;
            box-shadow: 0 24px 70px rgba(0, 0, 0, 0.28);
        }

        .journal-feature__media {
            min-height: 17rem;
            background-size: cover;
            background-position: center;
        }

        .journal-feature__content {
            display: flex;
            flex-direction: column;
            justify-content: space-between;
            gap: 1rem;
            padding: 1.45rem;
            background:
                radial-gradient(circle at top right, rgba(225, 29, 46, 0.18), transparent 32%),
                linear-gradient(180deg, #121214 0%, #09090b 100%);
        }

        .journal-feature__eyebrow {
            display: inline-flex;
            align-items: center;
            gap: 0.65rem;
            color: #f4f4f5;
            font-size: 0.72rem;
            font-weight: 700;
            letter-spacing: 0.24em;
            text-transform: uppercase;
        }

        .journal-feature__eyebrow::before {
            content: "";
            width: 2.5rem;
            height: 1px;
            background: linear-gradient(90deg, #e11d2e, rgba(255, 255, 255, 0.18));
        }

        .journal-feature__title {
            margin-top: 0.8rem;
            color: #fff;
            font-family: theme('fontFamily.display');
            font-size: clamp(1.75rem, 2.6vw, 2.8rem);
            font-weight: 700;
            line-height: 0.96;
            text-transform: uppercase;
        }

        .journal-feature__title a {
            color: inherit;
            text-decoration: none;
        }

        .journal-feature__meta {
            margin-top: 0.8rem;
            color: rgba(255, 255, 255, 0.62);
            font-size: 0.76rem;
            font-weight: 700;
            letter-spacing: 0.18em;
            text-transform: uppercase;
        }

        .journal-feature__copy {
            max-width: 34rem;
            color: rgba(255, 255, 255, 0.78);
            font-size: 0.92rem;
            line-height: 1.75;
        }

        .journal-feature__actions {
            display: flex;
            flex-wrap: wrap;
            gap: 0.75rem;
            padding-top: 0.3rem;
        }

        .journal-feature__link,
        .journal-card__link {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            min-height: 2.8rem;
            border-radius: 999px;
            padding: 0 1.05rem;
            text-decoration: none;
            transition: transform 0.2s ease, background-color 0.2s ease, border-color 0.2s ease;
        }

        .journal-feature__link {
            background: #f3f4f6;
            color: #111827;
            font-size: 0.74rem;
            font-weight: 700;
            letter-spacing: 0.16em;
            text-transform: uppercase;
        }

        .journal-feature__link--ghost {
            border: 1px solid rgba(255, 255, 255, 0.16);
            background: transparent;
            color: #fff;
        }

        .journal-feature__link:hover,
        .journal-card__link:hover {
            transform: translateY(-2px);
        }

        .journal-board {
            display: grid;
            gap: 1rem;
            margin-top: 1.1rem;
        }

        .journal-card {
            position: relative;
            overflow: hidden;
            border: 1px solid rgba(255, 255, 255, 0.1);
            border-radius: 1.5rem;
            background:
                linear-gradient(180deg, rgba(21, 21, 24, 0.98), rgba(10, 10, 12, 0.98));
            box-shadow: 0 20px 46px rgba(0, 0, 0, 0.16);
            transition: transform 0.25s ease, border-color 0.25s ease;
        }

        .journal-card:hover {
            transform: translateY(-4px);
            border-color: rgba(225, 29, 46, 0.3);
        }

        .journal-card--light {
            border-color: rgba(24, 24, 27, 0.08);
            background:
                radial-gradient(circle at top left, rgba(225, 29, 46, 0.1), transparent 28%),
                linear-gradient(180deg, rgba(249, 245, 238, 0.98), rgba(237, 230, 220, 0.98));
        }

        .journal-card--light .journal-card__eyebrow,
        .journal-card--light .journal-card__meta {
            color: rgba(24, 24, 27, 0.54);
        }

        .journal-card--light .journal-card__title,
        .journal-card--light .journal-card__copy {
            color: #18181b;
        }

        .journal-card--light .journal-card__link {
            border-color: rgba(24, 24, 27, 0.08);
            color: #18181b;
        }

        .journal-card__media {
            height: 11rem;
            background-size: cover;
            background-position: center;
        }

        .journal-card__body {
            display: flex;
            flex-direction: column;
            gap: 0.75rem;
            padding: 1.1rem;
        }

        .journal-card__eyebrow {
            color: rgba(255, 255, 255, 0.42);
        }

        .journal-card__title {
            color: #fff;
            font-family: theme('fontFamily.display');
            font-size: 1.3rem;
            font-weight: 700;
            line-height: 1.05;
            text-transform: uppercase;
        }

        .journal-card__title a {
            color: inherit;
            text-decoration: none;
        }

        .journal-card__copy {
            color: rgba(255, 255, 255, 0.72);
            font-size: 0.84rem;
            line-height: 1.7;
        }

        .journal-card__meta {
            color: rgba(255, 255, 255, 0.5);
            font-size: 0.74rem;
            font-weight: 700;
            letter-spacing: 0.16em;
            text-transform: uppercase;
        }

        .journal-card__link {
            align-self: flex-start;
            border: 1px solid rgba(255, 255, 255, 0.12);
            color: #fff;
            font-size: 0.7rem;
            font-weight: 700;
            letter-spacing: 0.16em;
            text-transform: uppercase;
        }

        .journal-empty {
            padding: 1.6rem;
            border: 1px solid rgba(255, 255, 255, 0.1);
            border-radius: 1.6rem;
            background: linear-gradient(180deg, rgba(21, 21, 24, 0.98), rgba(10, 10, 12, 0.98));
        }

        .journal-empty__eyebrow {
            color: #fb7185;
        }

        .journal-empty__title {
            margin-top: 0.9rem;
            color: #fff;
            font-family: theme('fontFamily.display');
            font-size: 2.1rem;
            font-weight: 700;
            line-height: 1.02;
            text-transform: uppercase;
        }

        .journal-empty__copy {
            max-width: 38rem;
            margin-top: 1rem;
            color: rgba(255, 255, 255, 0.72);
            line-height: 1.9;
        }

        @media (min-width: 768px) {
            .journal-shell {
                padding: 0 2rem;
            }

            .journal-board {
                grid-template-columns: repeat(2, minmax(0, 1fr));
            }

            .journal-card:nth-child(3n + 1) .journal-card__media {
                height: 13rem;
            }
        }

        @media (min-width: 1100px) {
            .journal-hero {
                grid-template-columns: minmax(0, 1.1fr) minmax(20rem, 26rem);
                align-items: end;
            }

            .journal-feature {
                grid-template-columns: minmax(0, 1.05fr) minmax(0, 0.95fr);
            }

            .journal-board {
                grid-template-columns: repeat(3, minmax(0, 1fr));
            }

            .journal-card:nth-child(5n + 1) {
                grid-column: span 2;
                display: grid;
                grid-template-columns: minmax(0, 1fr) minmax(22rem, 0.92fr);
            }

            .journal-card:nth-child(5n + 1) .journal-card__media {
                order: 2;
                height: 100%;
                min-height: 100%;
            }

            .journal-card:nth-child(5n + 1) .journal-card__body {
                padding: 1.3rem;
            }
        }

        @media (max-width: 767px) {
            .journal-page::before {
                inset: 5.4rem 0 auto;
                height: 22rem;
            }

            .journal-stats {
                grid-template-columns: 1fr;
            }
        }
    </style>
@endsection

@section('content')
    @php
        $featuredPost = $posts[0] ?? null;
        $boardPosts = array_slice($posts, 1);
    @endphp

    <section class="journal-page" data-reveal-section>
        <div class="journal-shell">
            <div class="journal-hero reveal-card" data-reveal>
                <div>
                    <p class="journal-kicker">Nitro Journal</p>
                    <h1 class="journal-title">Stories for the next move.</h1>
                    <p class="journal-copy">
                        A complete reset for the blog: sharper reads, a more editorial layout, and practical articles on buying,
                        financing, trade-ins, shipping, and premium vehicle ownership.
                    </p>
                </div>

                <div class="journal-stats">
                    <div class="journal-stat">
                        <span class="journal-stat__label">Published</span>
                        <span class="journal-stat__value">{{ count($posts) }}</span>
                    </div>
                    <div class="journal-stat">
                        <span class="journal-stat__label">Focus</span>
                        <span class="journal-stat__value">Buyer Tips</span>
                    </div>
                    <div class="journal-stat">
                        <span class="journal-stat__label">Style</span>
                        <span class="journal-stat__value">Editorial</span>
                    </div>
                </div>
            </div>

            @if ($featuredPost)
                <article class="journal-feature reveal-card" data-reveal data-reveal-delay="90">
                    <div class="journal-feature__media" style="background-image: url('{{ $featuredPost['image'] }}')"></div>

                    <div class="journal-feature__content">
                        <div>
                            <p class="journal-feature__eyebrow">Featured Article</p>
                            <h2 class="journal-feature__title">
                                <a href="{{ route('blog.detail', $featuredPost['slug']) }}">{{ $featuredPost['title'] }}</a>
                            </h2>
                            <p class="journal-feature__meta">{{ $featuredPost['published_at'] }} / {{ $featuredPost['author_name'] }}</p>
                        </div>

                        <div>
                            <p class="journal-feature__copy">{{ $featuredPost['excerpt'] }}</p>
                            <div class="journal-feature__actions">
                                <a href="{{ route('blog.detail', $featuredPost['slug']) }}" class="journal-feature__link">Read Feature</a>
                                <a href="{{ route('contact') }}" class="journal-feature__link journal-feature__link--ghost">Talk To Our Team</a>
                            </div>
                        </div>
                    </div>
                </article>
            @endif

            @if (!empty($boardPosts))
                <div class="journal-board">
                    @foreach ($boardPosts as $post)
                        <article
                            class="journal-card {{ $loop->iteration % 2 === 0 ? 'journal-card--light' : '' }} reveal-card"
                            data-reveal
                            data-reveal-delay="{{ $loop->index * 70 }}"
                        >
                            <div class="journal-card__media" style="background-image: url('{{ $post['image'] }}')"></div>
                            <div class="journal-card__body">
                                <p class="journal-card__eyebrow">Issue {{ str_pad((string) ($loop->iteration + 1), 2, '0', STR_PAD_LEFT) }}</p>
                                <h2 class="journal-card__title">
                                    <a href="{{ route('blog.detail', $post['slug']) }}">{{ $post['title'] }}</a>
                                </h2>
                                <p class="journal-card__copy">{{ $post['excerpt'] }}</p>
                                <p class="journal-card__meta">{{ $post['published_at'] }} / {{ $post['author_name'] }}</p>
                                <a href="{{ route('blog.detail', $post['slug']) }}" class="journal-card__link">Open Story</a>
                            </div>
                        </article>
                    @endforeach
                </div>
            @elseif (!$featuredPost)
                <div class="journal-empty reveal-card" data-reveal>
                    <p class="journal-empty__eyebrow">Coming Soon</p>
                    <h2 class="journal-empty__title">Fresh articles are on the way.</h2>
                    <p class="journal-empty__copy">
                        We are preparing blog posts on financing, vehicle sourcing, shipping, and trade-in strategy.
                    </p>
                </div>
            @endif
        </div>
    </section>
@endsection
