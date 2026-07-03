@extends('layouts.admin')

@section('content')
    <style>
        .seo-shell,
        .seo-panel {
            background: #ffffff;
            border: 1px solid #d9e4ff;
            border-radius: 18px;
            box-shadow: 0 16px 38px rgba(14, 30, 84, 0.08);
        }

        .seo-shell {
            padding: 28px;
        }

        .seo-kicker {
            color: #d62034;
            font-size: 0.82rem;
            font-weight: 800;
            letter-spacing: 0.08em;
            text-transform: uppercase;
            margin-bottom: 12px;
        }

        .seo-title {
            margin: 0;
            font-size: 2.1rem;
            color: #0b1f4d;
            font-weight: 800;
        }

        .seo-copy {
            margin-top: 10px;
            margin-bottom: 26px;
            color: #60708d;
            max-width: 760px;
        }

        .seo-grid {
            display: grid;
            grid-template-columns: repeat(2, minmax(0, 1fr));
            gap: 18px;
        }

        .seo-field label {
            display: block;
            margin-bottom: 8px;
            color: #172033;
            font-weight: 700;
        }

        .seo-field small {
            display: block;
            margin-top: 6px;
            color: #60708d;
        }

        .seo-field input,
        .seo-field textarea {
            width: 100%;
            border: 1px solid #cad7fb;
            border-radius: 14px;
            background: #f8fbff;
            color: #0f172a;
            padding: 14px 15px;
        }

        .seo-field input {
            height: 54px;
        }

        .seo-field textarea {
            min-height: 140px;
            resize: vertical;
        }

        .seo-field input:focus,
        .seo-field textarea:focus {
            outline: none;
            border-color: #2563eb;
            box-shadow: 0 0 0 4px rgba(37, 99, 235, 0.12);
            background: #ffffff;
        }

        .seo-panel {
            padding: 22px;
            margin-top: 24px;
        }

        .seo-panel h2 {
            margin-bottom: 8px;
            color: #0b1f4d;
        }

        .seo-panel p {
            color: #60708d;
            margin-bottom: 18px;
        }

        .seo-toggle {
            display: flex;
            align-items: center;
            gap: 10px;
            color: #172033;
            font-weight: 700;
        }

        .seo-actions {
            margin-top: 24px;
            display: flex;
            justify-content: flex-end;
        }

        .seo-save {
            min-height: 52px;
            padding: 0 22px;
            border: 0;
            border-radius: 14px;
            background: linear-gradient(90deg, #d62034 0%, #2563eb 100%);
            color: #ffffff;
            font-weight: 800;
        }

        @media (max-width: 767.98px) {
            .seo-grid {
                grid-template-columns: 1fr;
            }
        }
    </style>

    <div class="seo-shell">
        <div class="seo-kicker">Search Visibility</div>
        <h1 class="seo-title">SEO Settings</h1>
        <p class="seo-copy">Control Google Search Console verification, default SEO tags, structured business data, indexing behavior, and the base metadata used across the public website.</p>

        <form method="POST" action="{{ route('admin.seo-settings.update') }}">
            @csrf
            @method('PUT')

            <div class="seo-grid">
                <div class="seo-field">
                    <label for="site_title">Site Title</label>
                    <input id="site_title" type="text" name="site_title" value="{{ old('site_title', $settings->site_title) }}" placeholder="Nitro Motors USA">
                </div>

                <div class="seo-field">
                    <label for="default_meta_title">Default Meta Title</label>
                    <input id="default_meta_title" type="text" name="default_meta_title" value="{{ old('default_meta_title', $settings->default_meta_title) }}" placeholder="Nitro Motors USA | Premium Car Marketplace">
                </div>

                <div class="seo-field">
                    <label for="canonical_base_url">Canonical Base URL</label>
                    <input id="canonical_base_url" type="url" name="canonical_base_url" value="{{ old('canonical_base_url', $settings->canonical_base_url) }}" placeholder="https://www.example.com">
                    <small>Used for canonical URLs, sitemap, and robots entries.</small>
                </div>

                <div class="seo-field">
                    <label for="default_og_image">Default Social Share Image URL</label>
                    <input id="default_og_image" type="url" name="default_og_image" value="{{ old('default_og_image', $settings->default_og_image) }}" placeholder="https://www.example.com/og-image.jpg">
                </div>
            </div>

            <div class="seo-panel">
                <h2>Meta Defaults</h2>
                <p>These fill in the gaps for pages that do not define their own SEO copy.</p>
                <div class="seo-field">
                    <label for="default_meta_description">Default Meta Description</label>
                    <textarea id="default_meta_description" name="default_meta_description">{{ old('default_meta_description', $settings->default_meta_description) }}</textarea>
                </div>
                <div class="seo-field" style="margin-top: 18px;">
                    <label for="default_meta_keywords">Meta Keywords</label>
                    <textarea id="default_meta_keywords" name="default_meta_keywords" placeholder="used cars, premium cars, dealership, Miami">{{ old('default_meta_keywords', $settings->default_meta_keywords) }}</textarea>
                </div>
            </div>

            <div class="seo-panel">
                <h2>Search Console and Verification</h2>
                <p>Paste the verification values from Google Search Console and Bing Webmaster Tools.</p>
                <div class="seo-grid">
                    <div class="seo-field">
                        <label for="google_search_console_verification">Google Search Console Verification</label>
                        <input id="google_search_console_verification" type="text" name="google_search_console_verification" value="{{ old('google_search_console_verification', $settings->google_search_console_verification) }}" placeholder="google-site-verification token">
                    </div>
                    <div class="seo-field">
                        <label for="bing_webmaster_verification">Bing Webmaster Verification</label>
                        <input id="bing_webmaster_verification" type="text" name="bing_webmaster_verification" value="{{ old('bing_webmaster_verification', $settings->bing_webmaster_verification) }}" placeholder="msvalidate.01 token">
                    </div>
                    <div class="seo-field">
                        <label for="google_analytics_measurement_id">Google Analytics Measurement ID</label>
                        <input id="google_analytics_measurement_id" type="text" name="google_analytics_measurement_id" value="{{ old('google_analytics_measurement_id', $settings->google_analytics_measurement_id) }}" placeholder="G-XXXXXXXXXX">
                    </div>
                    <div class="seo-field">
                        <label for="robots_directive">Robots Directive</label>
                        <input id="robots_directive" type="text" name="robots_directive" value="{{ old('robots_directive', $settings->robots_directive) }}" placeholder="index,follow,max-image-preview:large">
                    </div>
                </div>
                <label class="seo-toggle" style="margin-top: 20px;">
                    <input type="checkbox" name="enable_indexing" value="1" {{ old('enable_indexing', $settings->enable_indexing) ? 'checked' : '' }}>
                    <span>Allow search engines to index the site</span>
                </label>
            </div>

            <div class="seo-panel">
                <h2>Business Structured Data</h2>
                <p>This helps search engines understand your dealership and can support richer search results.</p>
                <div class="seo-grid">
                    <div class="seo-field">
                        <label for="business_name">Business Name</label>
                        <input id="business_name" type="text" name="business_name" value="{{ old('business_name', $settings->business_name) }}">
                    </div>
                    <div class="seo-field">
                        <label for="business_phone">Business Phone</label>
                        <input id="business_phone" type="text" name="business_phone" value="{{ old('business_phone', $settings->business_phone) }}">
                    </div>
                    <div class="seo-field">
                        <label for="business_email">Business Email</label>
                        <input id="business_email" type="email" name="business_email" value="{{ old('business_email', $settings->business_email) }}">
                    </div>
                    <div class="seo-field">
                        <label for="business_address">Business Address</label>
                        <input id="business_address" type="text" name="business_address" value="{{ old('business_address', $settings->business_address) }}">
                    </div>
                </div>
            </div>

            <div class="seo-actions">
                <button type="submit" class="seo-save">Save SEO Settings</button>
            </div>
        </form>
    </div>
@endsection
