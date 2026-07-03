<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\MarketingSetting;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class MarketingSettingController extends Controller
{
    public function edit(): View
    {
        return view('admin.marketing-settings.edit', [
            'heading' => 'Marketing Pixels',
            'title' => 'Marketing Pixels',
            'active' => 'marketing-settings',
            'settings' => MarketingSetting::current(),
        ]);
    }

    public function update(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'meta_pixel_id' => ['nullable', 'string', 'max:255'],
            'google_tag_id' => ['nullable', 'string', 'max:255'],
            'tiktok_pixel_id' => ['nullable', 'string', 'max:255'],
            'snapchat_pixel_id' => ['nullable', 'string', 'max:255'],
            'pinterest_tag_id' => ['nullable', 'string', 'max:255'],
            'linkedin_partner_id' => ['nullable', 'string', 'max:255'],
            'custom_head_scripts' => ['nullable', 'string'],
            'custom_body_scripts' => ['nullable', 'string'],
        ]);

        MarketingSetting::current()->update($validated);

        return redirect()
            ->route('admin.marketing-settings.edit')
            ->with([
                'status' => 'Tracking pixels and custom scripts updated successfully.',
                'status_type' => 'success',
                'status_title' => 'Marketing settings saved',
            ]);
    }
}
