<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\SellYourCarRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class SellYourCarRequestController extends Controller
{
    public function index(Request $request): View
    {
        $search = trim((string) $request->query('q'));

        $sellYourCarRequests = SellYourCarRequest::query()
            ->when($search !== '', function ($query) use ($search) {
                $query->where(function ($subQuery) use ($search) {
                    $subQuery
                        ->where('first_name', 'like', "%{$search}%")
                        ->orWhere('last_name', 'like', "%{$search}%")
                        ->orWhere('email', 'like', "%{$search}%")
                        ->orWhere('phone', 'like', "%{$search}%")
                        ->orWhere('vehicle_year', 'like', "%{$search}%")
                        ->orWhere('make', 'like', "%{$search}%")
                        ->orWhere('model', 'like', "%{$search}%")
                        ->orWhere('trim', 'like', "%{$search}%")
                        ->orWhere('state', 'like', "%{$search}%")
                        ->orWhere('additional_options', 'like', "%{$search}%");
                });
            })
            ->latest()
            ->paginate(12)
            ->withQueryString();

        return view('admin.sell-your-car-requests.index', [
            'heading' => 'Sell Your Car Requests',
            'title' => 'Sell Your Car Requests',
            'active' => 'sell-your-car-requests',
            'sellYourCarRequests' => $sellYourCarRequests,
            'search' => $search,
        ]);
    }

    public function show(SellYourCarRequest $sellYourCarRequest): View
    {
        return view('admin.sell-your-car-requests.show', [
            'heading' => 'Sell Your Car Requests',
            'title' => 'Sell Your Car Request Details',
            'active' => 'sell-your-car-requests',
            'sellYourCarRequest' => $sellYourCarRequest,
        ]);
    }

    public function destroy(SellYourCarRequest $sellYourCarRequest): RedirectResponse
    {
        $sellYourCarRequest->delete();

        return redirect()
            ->route('admin.sell-your-car-requests.index')
            ->with('status', 'Sell Your Car request deleted successfully.')
            ->with('status_type', 'success')
            ->with('status_title', 'Request Removed');
    }
}
