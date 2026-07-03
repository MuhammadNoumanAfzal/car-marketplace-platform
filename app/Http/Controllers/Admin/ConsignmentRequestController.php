<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ConsignmentRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class ConsignmentRequestController extends Controller
{
    public function index(Request $request): View
    {
        $search = trim((string) $request->query('q'));

        $consignmentRequests = ConsignmentRequest::query()
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

        return view('admin.consignment-requests.index', [
            'heading' => 'Consignment Requests',
            'title' => 'Consignment Requests',
            'active' => 'consignment-requests',
            'consignmentRequests' => $consignmentRequests,
            'search' => $search,
        ]);
    }

    public function show(ConsignmentRequest $consignmentRequest): View
    {
        return view('admin.consignment-requests.show', [
            'heading' => 'Consignment Requests',
            'title' => 'Consignment Request Details',
            'active' => 'consignment-requests',
            'consignmentRequest' => $consignmentRequest,
        ]);
    }

    public function destroy(ConsignmentRequest $consignmentRequest): RedirectResponse
    {
        $consignmentRequest->delete();

        return redirect()
            ->route('admin.consignment-requests.index')
            ->with('status', 'Consignment request deleted successfully.')
            ->with('status_type', 'success')
            ->with('status_title', 'Consignment Request Removed');
    }
}
