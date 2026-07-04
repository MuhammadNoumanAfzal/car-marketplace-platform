<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\TradeInRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class TradeInRequestController extends Controller
{
    public function index(Request $request): View
    {
        $search = trim((string) $request->query('q'));

        $tradeInRequests = TradeInRequest::query()
            ->when($search !== '', function ($query) use ($search) {
                $query->where(function ($subQuery) use ($search) {
                    $subQuery
                        ->where('first_name', 'like', "%{$search}%")
                        ->orWhere('last_name', 'like', "%{$search}%")
                        ->orWhere('email', 'like', "%{$search}%")
                        ->orWhere('phone', 'like', "%{$search}%")
                        ->orWhere('current_vehicle_year', 'like', "%{$search}%")
                        ->orWhere('current_make', 'like', "%{$search}%")
                        ->orWhere('current_model', 'like', "%{$search}%")
                        ->orWhere('desired_vehicle', 'like', "%{$search}%")
                        ->orWhere('condition_notes', 'like', "%{$search}%");
                });
            })
            ->latest()
            ->paginate(12)
            ->withQueryString();

        return view('admin.trade-in-requests.index', [
            'heading' => 'Trade-In Requests',
            'title' => 'Trade-In Requests',
            'active' => 'trade-in-requests',
            'tradeInRequests' => $tradeInRequests,
            'search' => $search,
        ]);
    }

    public function show(TradeInRequest $tradeInRequest): View
    {
        return view('admin.trade-in-requests.show', [
            'heading' => 'Trade-In Requests',
            'title' => 'Trade-In Request Details',
            'active' => 'trade-in-requests',
            'tradeInRequest' => $tradeInRequest,
        ]);
    }

    public function destroy(TradeInRequest $tradeInRequest): RedirectResponse
    {
        $tradeInRequest->delete();

        return redirect()
            ->route('admin.trade-in-requests.index')
            ->with('status', 'Trade-in request deleted successfully.')
            ->with('status_type', 'success')
            ->with('status_title', 'Request Removed');
    }
}
