<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\AppointmentRequest;
use App\Models\ConsignmentRequest;
use App\Models\ContactInquiry;
use App\Models\Inventory;
use App\Models\ShippingRequest;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data = [
            'heading' => 'Dashboard',
            'title' => 'View Dashboard',
            'active' => 'dashboard',
            'stats' => [
                [
                    'label' => 'Inventory',
                    'count' => Inventory::count(),
                    'route' => route('admin.inventory.index'),
                    'accent' => 'blue',
                ],
                [
                    'label' => 'Contact Inquiries',
                    'count' => ContactInquiry::count(),
                    'route' => route('admin.contact-inquiries.index'),
                    'accent' => 'red',
                ],
                [
                    'label' => 'Appointment Requests',
                    'count' => AppointmentRequest::count(),
                    'route' => route('admin.appointment-requests.index'),
                    'accent' => 'blue',
                ],
                [
                    'label' => 'Shipping Requests',
                    'count' => ShippingRequest::count(),
                    'route' => route('admin.shipping-requests.index'),
                    'accent' => 'red',
                ],
                [
                    'label' => 'Consignment Requests',
                    'count' => ConsignmentRequest::count(),
                    'route' => route('admin.consignment-requests.index'),
                    'accent' => 'blue',
                ],
            ],
            'recentConsignmentRequests' => ConsignmentRequest::latest()->take(5)->get(),
        ];

        return view('admin.dashboard.dashboard', $data);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
