@extends('layouts.user')

@section('title', $post['title'] . ' | Nitro Motors USA')
@section('meta_description', $post['seo_description'] ?: ($post['excerpt'] ?: 'Read the latest insights from Nitro Motors USA.'))
@section('og_image', $post['image'])

@section('styles')
    <style>
        .story-page {
            position: relative;
            padding: 7.75rem 0 4.5rem;
        }

        .story-shell {
            margin: 0 auto;
            width: 100%;
            max-width: 1420px;
            padding: 0 1rem;
        }

        .story-intro {
            overflow: hidden;
            border: 1px solid rgba(255, 255, 255, 0.08);
            border-radius: 1.9rem;
            background:
                radial-gradient(circle at top left, rgba(225, 29, 46, 0.26), transparent 24%),
                linear-gradient(135deg, rgba(22, 22, 24, 0.98), rgba(7, 7, 9, 0.98));
            box-shadow: 0 26px 70px rgba(0, 0, 0, 0.3);
        }

        .story-intro__grid {
            display: grid;
        }

        .story-intro__copy {
            padding: 1.35rem;
        }

        .story-back {
            display: inline-flex;
            align-items: center;
            gap: 0.7rem;
            color: rgba(255, 255, 255, 0.7);
            font-size: 0.82rem;
            font-weight: 700;
            letter-spacing: 0.16em;
            text-decoration: none;
            text-transform: uppercase;
        }

        .story-kicker,
        .story-rail__label,
        .story-action__eyebrow {
            font-size: 0.72rem;
            font-weight: 700;
            letter-spacing: 0.28em;
            text-transform: uppercase;
        }

        .story-kicker {
            display: inline-flex;
            margin-top: 1.2rem;
            padding: 0.55rem 0.8rem;
            border-radius: 999px;
            background: rgba(225, 29, 46, 0.12);
            color: #f87171;
        }

        .story-title {
            margin-top: 0.9rem;
            color: #fff;
            font-family: theme('fontFamily.display');
            font-size: clamp(2.15rem, 4.6vw, 4.25rem);
            font-weight: 700;
            line-height: 0.92;
            text-transform: uppercase;
        }

        .story-meta {
            display: flex;
            flex-wrap: wrap;
            gap: 0.65rem;
            margin-top: 1.15rem;
        }

        .story-meta__pill {
            display: inline-flex;
            align-items: center;
            min-height: 2.6rem;
            border: 1px solid rgba(255, 255, 255, 0.1);
            border-radius: 999px;
            background: rgba(255, 255, 255, 0.05);
            padding: 0 1rem;
            color: rgba(255, 255, 255, 0.78);
            font-size: 0.8rem;
            font-weight: 600;
        }

        .story-excerpt {
            max-width: 42rem;
            margin-top: 1.1rem;
            color: rgba(255, 255, 255, 0.76);
            font-size: 0.95rem;
            line-height: 1.8;
        }

        .story-intro__media {
            min-height: 18rem;
            background-size: cover;
            background-position: center;
        }

        .story-layout {
            display: grid;
            gap: 1.15rem;
            margin-top: 1.15rem;
        }

        .story-rail {
            display: grid;
            gap: 1rem;
        }

        .story-rail__card,
        .story-action {
            border-radius: 1.5rem;
            padding: 1.15rem;
            box-shadow: 0 18px 42px rgba(0, 0, 0, 0.18);
        }

        .story-rail__card {
            border: 1px solid rgba(255, 255, 255, 0.08);
            background:
                linear-gradient(180deg, rgba(25, 25, 28, 0.98), rgba(10, 10, 12, 0.98));
        }

        .story-rail__label {
            color: rgba(255, 255, 255, 0.42);
        }

        .story-rail__value {
            margin-top: 0.8rem;
            color: #ffffff;
            font-family: theme('fontFamily.display');
            font-size: 1.25rem;
            font-weight: 700;
            line-height: 1.1;
            text-transform: uppercase;
        }

        .story-rail__copy {
            margin-top: 0.8rem;
            color: rgba(255, 255, 255, 0.7);
            font-size: 0.9rem;
            line-height: 1.75;
        }

        .story-action {
            border: 1px solid rgba(255, 255, 255, 0.08);
            background:
                radial-gradient(circle at top right, rgba(225, 29, 46, 0.22), transparent 35%),
                linear-gradient(180deg, rgba(19, 19, 21, 0.98), rgba(8, 8, 10, 0.98));
        }

        .story-action__eyebrow {
            color: #fb7185;
        }

        .story-action__title {
            margin-top: 0.9rem;
            color: #fff;
            font-family: theme('fontFamily.display');
            font-size: 1.45rem;
            font-weight: 700;
            line-height: 1.02;
            text-transform: uppercase;
        }

        .story-action__copy {
            margin-top: 0.95rem;
            color: rgba(255, 255, 255, 0.72);
            font-size: 0.9rem;
            line-height: 1.75;
        }

        .story-action__buttons {
            display: flex;
            flex-wrap: wrap;
            gap: 0.8rem;
            margin-top: 1.2rem;
        }

        .story-action__button {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            min-height: 3rem;
            border-radius: 999px;
            padding: 0 1.2rem;
            font-size: 0.78rem;
            font-weight: 700;
            letter-spacing: 0.16em;
            text-decoration: none;
            text-transform: uppercase;
            transition: transform 0.2s ease, background-color 0.2s ease, border-color 0.2s ease;
        }

        .story-action__button:hover {
            transform: translateY(-2px);
        }

        .story-action__button--primary {
            background: #fff;
            color: #18181b;
        }

        .story-action__button--secondary {
            border: 1px solid rgba(255, 255, 255, 0.14);
            color: #fff;
        }

        .story-article {
            overflow: hidden;
            border: 1px solid rgba(255, 255, 255, 0.08);
            border-radius: 1.9rem;
            background:
                radial-gradient(circle at top, rgba(225, 29, 46, 0.08), transparent 18%),
                linear-gradient(180deg, rgba(21, 21, 24, 0.99), rgba(10, 10, 12, 0.99));
            color: #f4f4f5;
            box-shadow: 0 24px 60px rgba(0, 0, 0, 0.2);
        }

        .story-article__head {
            padding: 1.35rem 1.35rem 1.15rem;
            border-bottom: 1px solid rgba(255, 255, 255, 0.08);
        }

        .story-article__stamp {
            color: #f87171;
            font-size: 0.74rem;
            font-weight: 700;
            letter-spacing: 0.24em;
            text-transform: uppercase;
        }

        .story-article__lede {
            max-width: 52rem;
            margin-top: 1rem;
            color: rgba(255, 255, 255, 0.72);
            font-size: 0.95rem;
            line-height: 1.8;
        }

        .story-article__body {
            padding: 1.35rem 1.35rem 2rem;
            font-size: 0.96rem;
            line-height: 1.9;
        }

        .story-article__body h1,
        .story-article__body h2,
        .story-article__body h3,
        .story-article__body h4 {
            margin-top: 2rem;
            color: #ffffff;
            font-family: theme('fontFamily.display');
            font-weight: 700;
            line-height: 1.08;
            text-transform: uppercase;
        }

        .story-article__body h1 {
            font-size: 2.25rem;
        }

        .story-article__body h2 {
            font-size: 1.8rem;
        }

        .story-article__body h3,
        .story-article__body h4 {
            font-size: 1.35rem;
        }

        .story-article__body p + p,
        .story-article__body ul,
        .story-article__body ol,
        .story-article__body blockquote {
            margin-top: 1.15rem;
        }

        .story-article__body ul,
        .story-article__body ol {
            padding-left: 1.4rem;
        }

        .story-article__body ul {
            list-style: disc;
        }

        .story-article__body ol {
            list-style: decimal;
        }

        .story-article__body li + li {
            margin-top: 0.4rem;
        }

        .story-article__body a {
            color: #fb7185;
            text-decoration: underline;
            text-underline-offset: 0.18rem;
        }

        .story-article__body blockquote {
            border-left: 4px solid rgba(248, 113, 113, 0.45);
            padding: 0.3rem 0 0.3rem 1rem;
            color: rgba(255, 255, 255, 0.75);
            font-style: italic;
            background: rgba(255, 255, 255, 0.03);
        }

        .story-footer {
            display: flex;
            flex-wrap: wrap;
            gap: 0.9rem;
            margin-top: 1.4rem;
        }

        .story-footer__link {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            min-height: 3rem;
            border: 1px solid rgba(255, 255, 255, 0.12);
            border-radius: 999px;
            padding: 0 1.2rem;
            color: #fff;
            font-size: 0.78rem;
            font-weight: 700;
            letter-spacing: 0.16em;
            text-decoration: none;
            text-transform: uppercase;
            transition: transform 0.2s ease, border-color 0.2s ease;
        }

        .story-footer__link:hover {
            transform: translateY(-2px);
            border-color: rgba(225, 29, 46, 0.3);
        }

        @media (min-width: 768px) {
            .story-shell {
                padding: 0 2rem;
            }

            .story-intro__copy,
            .story-article__head,
            .story-article__body {
                padding-left: 1.75rem;
                padding-right: 1.75rem;
            }

            .story-intro__copy {
                padding-top: 1.75rem;
                padding-bottom: 1.75rem;
            }

            .story-article__body {
                padding-bottom: 2.4rem;
            }
        }

        @media (min-width: 1100px) {
            .story-intro__grid {
                grid-template-columns: minmax(0, 1.08fr) minmax(22rem, 0.92fr);
            }

            .story-layout {
                grid-template-columns: 18rem minmax(0, 1fr);
                align-items: start;
            }

            .story-rail {
                position: sticky;
                top: 7rem;
            }
        }
    </style>
@endsection

@section('content')
    <section class="story-page" data-reveal-section>
        <div class="story-shell">
            <div class="story-intro reveal-card" data-reveal>
                <div class="story-intro__grid">
                    <div class="story-intro__copy">
                        <a href="{{ route('blog.index') }}" class="story-back">&#8592; Back to Journal</a>
                        <p class="story-kicker">Nitro Motors USA Story</p>
                        <h1 class="story-title">{{ $post['title'] }}</h1>

                        <div class="story-meta">
                            <span class="story-meta__pill">{{ $post['published_at'] }}</span>
                            <span class="story-meta__pill">{{ $post['author_name'] }}</span>
                            <span class="story-meta__pill">Nitro Journal</span>
                        </div>

                        @if (!empty($post['excerpt']))
                            <p class="story-excerpt">{{ $post['excerpt'] }}</p>
                        @endif
                    </div>

                    <div class="story-intro__media" style="background-image: url('{{ $post['image'] }}')"></div>
                </div>
            </div>

            <div class="story-layout">
                <aside class="story-rail reveal-card" data-reveal data-reveal-delay="70">
                    <div class="story-rail__card">
                        <p class="story-rail__label">Published</p>
                        <p class="story-rail__value">{{ $post['published_at'] }}</p>
                    </div>

                    <div class="story-rail__card">
                        <p class="story-rail__label">Written By</p>
                        <p class="story-rail__value">{{ $post['author_name'] }}</p>
                    </div>

                    <div class="story-rail__card">
                        <p class="story-rail__label">Why It Matters</p>
                        <p class="story-rail__copy">Straightforward advice for buyers, sellers, and trade-in customers who want a cleaner next step.</p>
                    </div>

                    <div class="story-action">
                        <p class="story-action__eyebrow">Need A Real Plan?</p>
                        <h2 class="story-action__title">Let's map out your next vehicle move.</h2>
                        <p class="story-action__copy">Talk with our team about inventory, financing, trade-ins, shipping, or selling strategy.</p>
                        <div class="story-action__buttons">
                            <a href="{{ route('contact') }}" class="story-action__button story-action__button--primary">Contact Us</a>
                            <a href="{{ route('inventory.all') }}" class="story-action__button story-action__button--secondary">Browse Inventory</a>
                        </div>
                    </div>
                </aside>

                <article class="story-article reveal-card" data-reveal data-reveal-delay="120">
                    <div class="story-article__head">
                        <p class="story-article__stamp">Editorial Read</p>
                        @if (!empty($post['excerpt']))
                            <p class="story-article__lede">{{ $post['excerpt'] }}</p>
                        @endif
                    </div>

                    <div class="story-article__body">{!! $post['content'] !!}</div>
                </article>
            </div>

            <div class="story-footer reveal-card" data-reveal data-reveal-delay="160">
                <a href="{{ route('blog.index') }}" class="story-footer__link">More Articles</a>
                <a href="{{ route('appointment') }}" class="story-footer__link">Book A Call</a>
            </div>
        </div>
    </section>
@endsection
