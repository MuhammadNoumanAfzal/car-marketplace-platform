<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ShippingRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class ShippingRequestController extends Controller
{
    public function index(Request $request): View
    {
        $search = trim((string) $request->query('q'));

        $shippingRequests = ShippingRequest::query()
            ->when($search !== '', function ($query) use ($search) {
                $query->where(function ($subQuery) use ($search) {
                    $subQuery
                        ->where('name', 'like', "%{$search}%")
                        ->orWhere('email', 'like', "%{$search}%")
                        ->orWhere('phone', 'like', "%{$search}%")
                        ->orWhere('vehicle_year', 'like', "%{$search}%")
                        ->orWhere('vehicle_make', 'like', "%{$search}%")
                        ->orWhere('vehicle_model', 'like', "%{$search}%")
                        ->orWhere('origin', 'like', "%{$search}%")
                        ->orWhere('destination', 'like', "%{$search}%")
                        ->orWhere('transport_type', 'like', "%{$search}%")
                        ->orWhere('pickup_window', 'like', "%{$search}%")
                        ->orWhere('notes', 'like', "%{$search}%");
                });
            })
            ->latest()
            ->paginate(12)
            ->withQueryString();

        return view('admin.shipping-requests.index', [
            'heading' => 'Shipping Requests',
            'title' => 'Shipping Requests',
            'active' => 'shipping-requests',
            'shippingRequests' => $shippingRequests,
            'search' => $search,
        ]);
    }

    public function show(ShippingRequest $shippingRequest): View
    {
        return view('admin.shipping-requests.show', [
            'heading' => 'Shipping Requests',
            'title' => 'Shipping Request Details',
            'active' => 'shipping-requests',
            'shippingRequest' => $shippingRequest,
        ]);
    }

    public function destroy(ShippingRequest $shippingRequest): RedirectResponse
    {
        $shippingRequest->delete();

        return redirect()
            ->route('admin.shipping-requests.index')
            ->with('status', 'Shipping request deleted successfully.')
            ->with('status_type', 'success')
            ->with('status_title', 'Shipping Request Removed');
    }
}
