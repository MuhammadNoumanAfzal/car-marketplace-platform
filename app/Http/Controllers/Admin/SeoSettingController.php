<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\SeoSetting;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class SeoSettingController extends Controller
{
    public function edit(): View
    {
        return view('admin.seo-settings.edit', [
            'heading' => 'SEO Settings',
            'title' => 'SEO Settings',
            'active' => 'seo-settings',
            'settings' => SeoSetting::current(),
        ]);
    }

    public function update(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'site_title' => ['nullable', 'string', 'max:255'],
            'default_meta_title' => ['nullable', 'string', 'max:255'],
            'default_meta_description' => ['nullable', 'string', 'max:1000'],
            'default_meta_keywords' => ['nullable', 'string', 'max:1000'],
            'canonical_base_url' => ['nullable', 'url', 'max:255'],
            'google_search_console_verification' => ['nullable', 'string', 'max:255'],
            'bing_webmaster_verification' => ['nullable', 'string', 'max:255'],
            'google_analytics_measurement_id' => ['nullable', 'string', 'max:255'],
            'default_og_image' => ['nullable', 'url', 'max:500'],
            'business_name' => ['nullable', 'string', 'max:255'],
            'business_phone' => ['nullable', 'string', 'max:100'],
            'business_email' => ['nullable', 'email', 'max:255'],
            'business_address' => ['nullable', 'string', 'max:255'],
            'robots_directive' => ['nullable', 'string', 'max:255'],
            'enable_indexing' => ['nullable', 'boolean'],
        ]);

        $validated['enable_indexing'] = $request->boolean('enable_indexing');

        SeoSetting::current()->update($validated);

        return redirect()
            ->route('admin.seo-settings.edit')
            ->with([
                'status' => 'SEO settings updated successfully.',
                'status_type' => 'success',
                'status_title' => 'SEO saved',
            ]);
    }
}
