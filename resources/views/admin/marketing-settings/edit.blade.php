@extends('layouts.admin')

@section('content')
    <style>
        .marketing-shell,
        .marketing-panel {
            background: #ffffff;
            border: 1px solid #d9e4ff;
            border-radius: 18px;
            box-shadow: 0 16px 38px rgba(14, 30, 84, 0.08);
        }

        .marketing-shell {
            padding: 28px;
        }

        .marketing-kicker {
            color: #d62034;
            font-size: 0.82rem;
            font-weight: 800;
            letter-spacing: 0.08em;
            text-transform: uppercase;
            margin-bottom: 12px;
        }

        .marketing-title {
            margin: 0;
            font-size: 2.1rem;
            color: #0b1f4d;
            font-weight: 800;
        }

        .marketing-copy {
            margin-top: 10px;
            margin-bottom: 26px;
            color: #60708d;
            max-width: 760px;
        }

        .marketing-grid {
            display: grid;
            grid-template-columns: repeat(2, minmax(0, 1fr));
            gap: 18px;
        }

        .marketing-field label {
            display: block;
            margin-bottom: 8px;
            color: #172033;
            font-weight: 700;
        }

        .marketing-field small {
            display: block;
            margin-top: 6px;
            color: #60708d;
        }

        .marketing-field input,
        .marketing-field textarea {
            width: 100%;
            border: 1px solid #cad7fb;
            border-radius: 14px;
            background: #f8fbff;
            color: #0f172a;
            padding: 14px 15px;
        }

        .marketing-field input {
            height: 54px;
        }

        .marketing-field textarea {
            min-height: 180px;
            resize: vertical;
        }

        .marketing-field input:focus,
        .marketing-field textarea:focus {
            outline: none;
            border-color: #2563eb;
            box-shadow: 0 0 0 4px rgba(37, 99, 235, 0.12);
            background: #ffffff;
        }

        .marketing-panel {
            padding: 22px;
            margin-top: 24px;
        }

        .marketing-panel h2 {
            margin-bottom: 8px;
            color: #0b1f4d;
        }

        .marketing-panel p {
            color: #60708d;
            margin-bottom: 18px;
        }

        .marketing-actions {
            margin-top: 24px;
            display: flex;
            justify-content: flex-end;
        }

        .marketing-save {
            min-height: 52px;
            padding: 0 22px;
            border: 0;
            border-radius: 14px;
            background: linear-gradient(90deg, #d62034 0%, #2563eb 100%);
            color: #ffffff;
            font-weight: 800;
        }

        @media (max-width: 767.98px) {
            .marketing-grid {
                grid-template-columns: 1fr;
            }
        }
    </style>

    <div class="marketing-shell">
        <div class="marketing-kicker">Ad Tracking</div>
        <h1 class="marketing-title">Marketing Pixels</h1>
        <p class="marketing-copy">Manage tracking IDs for Meta, Instagram, TikTok, Google, Snapchat, Pinterest, LinkedIn, and any extra custom scripts you need on the storefront.</p>

        <form method="POST" action="{{ route('admin.marketing-settings.update') }}">
            @csrf
            @method('PUT')

            <div class="marketing-grid">
                <div class="marketing-field">
                    <label for="meta_pixel_id">Meta Pixel ID</label>
                    <input id="meta_pixel_id" type="text" name="meta_pixel_id" value="{{ old('meta_pixel_id', $settings->meta_pixel_id) }}" placeholder="Facebook / Instagram Pixel ID">
                    <small>This covers both Facebook and Instagram via Meta Pixel.</small>
                </div>

                <div class="marketing-field">
                    <label for="google_tag_id">Google Tag ID</label>
                    <input id="google_tag_id" type="text" name="google_tag_id" value="{{ old('google_tag_id', $settings->google_tag_id) }}" placeholder="Example: AW-XXXXXXXXX or G-XXXXXXXXXX">
                    <small>Use your Google Ads or Google Analytics tag ID.</small>
                </div>

                <div class="marketing-field">
                    <label for="tiktok_pixel_id">TikTok Pixel ID</label>
                    <input id="tiktok_pixel_id" type="text" name="tiktok_pixel_id" value="{{ old('tiktok_pixel_id', $settings->tiktok_pixel_id) }}" placeholder="TikTok Pixel ID">
                </div>

                <div class="marketing-field">
                    <label for="snapchat_pixel_id">Snapchat Pixel ID</label>
                    <input id="snapchat_pixel_id" type="text" name="snapchat_pixel_id" value="{{ old('snapchat_pixel_id', $settings->snapchat_pixel_id) }}" placeholder="Snap Pixel ID">
                </div>

                <div class="marketing-field">
                    <label for="pinterest_tag_id">Pinterest Tag ID</label>
                    <input id="pinterest_tag_id" type="text" name="pinterest_tag_id" value="{{ old('pinterest_tag_id', $settings->pinterest_tag_id) }}" placeholder="Pinterest Tag ID">
                </div>

                <div class="marketing-field">
                    <label for="linkedin_partner_id">LinkedIn Partner ID</label>
                    <input id="linkedin_partner_id" type="text" name="linkedin_partner_id" value="{{ old('linkedin_partner_id', $settings->linkedin_partner_id) }}" placeholder="LinkedIn Partner ID">
                </div>
            </div>

            <div class="marketing-panel">
                <h2>Custom Head Scripts</h2>
                <p>Paste any extra tracking or verification code that belongs inside the public site `<head>`.</p>
                <div class="marketing-field">
                    <textarea id="custom_head_scripts" name="custom_head_scripts" placeholder="<script>...</script>">{{ old('custom_head_scripts', $settings->custom_head_scripts) }}</textarea>
                </div>
            </div>

            <div class="marketing-panel">
                <h2>Custom Body Scripts</h2>
                <p>Paste scripts or noscript tags that should load right after the opening body area.</p>
                <div class="marketing-field">
                    <textarea id="custom_body_scripts" name="custom_body_scripts" placeholder="<noscript>...</noscript>">{{ old('custom_body_scripts', $settings->custom_body_scripts) }}</textarea>
                </div>
            </div>

            <div class="marketing-actions">
                <button type="submit" class="marketing-save">Save Marketing Settings</button>
            </div>
        </form>
    </div>
@endsection
