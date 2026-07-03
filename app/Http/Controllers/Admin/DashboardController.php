<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\AppointmentRequest;
use App\Models\ConsignmentRequest;
use App\Models\ContactInquiry;
use App\Models\Inventory;
use App\Models\MarketingSetting;
use App\Models\SeoSetting;
use App\Models\ShippingRequest;
use Carbon\Carbon;
use Illuminate\Support\Collection;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $inventoryCount = Inventory::count();
        $contactCount = ContactInquiry::count();
        $appointmentCount = AppointmentRequest::count();
        $shippingCount = ShippingRequest::count();
        $consignmentCount = ConsignmentRequest::count();
        $availableCount = Inventory::where('status', 'available')->count();
        $soldCount = Inventory::where('status', 'sold')->count();
        $featuredCount = Inventory::where('is_featured', true)->count();
        $inventoryValue = (float) Inventory::sum('price');
        $averagePrice = (float) Inventory::avg('price');
        $leadTotal = $contactCount + $appointmentCount + $shippingCount + $consignmentCount;

        $months = collect(range(5, 0, -1))
            ->map(fn (int $offset) => now()->startOfMonth()->subMonths($offset))
            ->push(now()->startOfMonth());

        $monthlyLeadSeries = $months->map(function (Carbon $monthStart) {
            $monthEnd = (clone $monthStart)->endOfMonth();

            $count = ContactInquiry::whereBetween('created_at', [$monthStart, $monthEnd])->count()
                + AppointmentRequest::whereBetween('created_at', [$monthStart, $monthEnd])->count()
                + ShippingRequest::whereBetween('created_at', [$monthStart, $monthEnd])->count()
                + ConsignmentRequest::whereBetween('created_at', [$monthStart, $monthEnd])->count();

            return [
                'label' => $monthStart->format('M'),
                'count' => $count,
            ];
        });

        $topMakes = Inventory::query()
            ->select('make')
            ->selectRaw('COUNT(*) as total')
            ->whereNotNull('make')
            ->where('make', '!=', '')
            ->groupBy('make')
            ->orderByDesc('total')
            ->limit(5)
            ->get();

        $recentActivity = $this->buildRecentActivity();
        $marketingSetting = MarketingSetting::current();
        $seoSetting = SeoSetting::current();
        $pixelStatuses = [
            [
                'label' => 'Meta / Instagram',
                'value' => $marketingSetting->meta_pixel_id,
                'accent' => 'blue',
            ],
            [
                'label' => 'Google',
                'value' => $marketingSetting->google_tag_id,
                'accent' => 'red',
            ],
            [
                'label' => 'TikTok',
                'value' => $marketingSetting->tiktok_pixel_id,
                'accent' => 'blue',
            ],
            [
                'label' => 'Snapchat',
                'value' => $marketingSetting->snapchat_pixel_id,
                'accent' => 'red',
            ],
            [
                'label' => 'Pinterest',
                'value' => $marketingSetting->pinterest_tag_id,
                'accent' => 'blue',
            ],
            [
                'label' => 'LinkedIn',
                'value' => $marketingSetting->linkedin_partner_id,
                'accent' => 'red',
            ],
        ];
        $seoStatuses = [
            [
                'label' => 'Google Search Console',
                'value' => $seoSetting->google_search_console_verification,
            ],
            [
                'label' => 'Bing Webmaster',
                'value' => $seoSetting->bing_webmaster_verification,
            ],
            [
                'label' => 'Google Analytics',
                'value' => $seoSetting->google_analytics_measurement_id,
            ],
            [
                'label' => 'Canonical Base URL',
                'value' => $seoSetting->canonical_base_url,
            ],
        ];

        $data = [
            'heading' => 'Dashboard',
            'title' => 'View Dashboard',
            'active' => 'dashboard',
            'stats' => [
                [
                    'label' => 'Inventory',
                    'count' => $inventoryCount,
                    'route' => route('admin.inventory.index'),
                    'accent' => 'blue',
                    'meta' => $availableCount . ' available / ' . $soldCount . ' sold',
                ],
                [
                    'label' => 'Contact Inquiries',
                    'count' => $contactCount,
                    'route' => route('admin.contact-inquiries.index'),
                    'accent' => 'red',
                    'meta' => 'Website contact leads',
                ],
                [
                    'label' => 'Appointment Requests',
                    'count' => $appointmentCount,
                    'route' => route('admin.appointment-requests.index'),
                    'accent' => 'blue',
                    'meta' => 'Booked from storefront',
                ],
                [
                    'label' => 'Shipping Requests',
                    'count' => $shippingCount,
                    'route' => route('admin.shipping-requests.index'),
                    'accent' => 'red',
                    'meta' => 'Transport inquiries',
                ],
                [
                    'label' => 'Consignment Requests',
                    'count' => $consignmentCount,
                    'route' => route('admin.consignment-requests.index'),
                    'accent' => 'blue',
                    'meta' => 'Seller leads',
                ],
            ],
            'inventorySummary' => [
                'total' => $inventoryCount,
                'available' => $availableCount,
                'sold' => $soldCount,
                'featured' => $featuredCount,
                'value' => $inventoryValue,
                'average_price' => $averagePrice,
            ],
            'leadSummary' => [
                'total' => $leadTotal,
                'contact' => $contactCount,
                'appointment' => $appointmentCount,
                'shipping' => $shippingCount,
                'consignment' => $consignmentCount,
            ],
            'monthlyLeadSeries' => $monthlyLeadSeries,
            'topMakes' => $topMakes,
            'recentActivity' => $recentActivity,
            'pixelStatuses' => $pixelStatuses,
            'seoStatuses' => $seoStatuses,
            'recentConsignmentRequests' => ConsignmentRequest::latest()->take(5)->get(),
        ];

        return view('admin.dashboard.dashboard', $data);
    }

    private function buildRecentActivity(): Collection
    {
        $items = collect();

        ContactInquiry::latest()->take(3)->get()->each(function (ContactInquiry $item) use ($items) {
            $items->push([
                'type' => 'Contact',
                'title' => $item->name ?: $item->email,
                'meta' => $item->email,
                'timestamp' => $item->created_at,
                'route' => route('admin.contact-inquiries.show', $item),
                'accent' => 'red',
            ]);
        });

        AppointmentRequest::latest()->take(3)->get()->each(function (AppointmentRequest $item) use ($items) {
            $items->push([
                'type' => 'Appointment',
                'title' => $item->name ?: $item->email,
                'meta' => $item->appointment_type ?: 'Appointment request',
                'timestamp' => $item->created_at,
                'route' => route('admin.appointment-requests.show', $item),
                'accent' => 'blue',
            ]);
        });

        ShippingRequest::latest()->take(3)->get()->each(function (ShippingRequest $item) use ($items) {
            $items->push([
                'type' => 'Shipping',
                'title' => $item->name ?: $item->email,
                'meta' => trim(($item->origin ?: 'Origin') . ' to ' . ($item->destination ?: 'Destination')),
                'timestamp' => $item->created_at,
                'route' => route('admin.shipping-requests.show', $item),
                'accent' => 'red',
            ]);
        });

        ConsignmentRequest::latest()->take(3)->get()->each(function (ConsignmentRequest $item) use ($items) {
            $items->push([
                'type' => 'Consignment',
                'title' => trim($item->first_name . ' ' . $item->last_name),
                'meta' => trim($item->vehicle_year . ' ' . $item->make . ' ' . $item->model),
                'timestamp' => $item->created_at,
                'route' => route('admin.consignment-requests.show', $item),
                'accent' => 'blue',
            ]);
        });

        Inventory::latest()->take(3)->get()->each(function (Inventory $item) use ($items) {
            $items->push([
                'type' => 'Inventory',
                'title' => trim($item->year . ' ' . $item->make . ' ' . $item->model),
                'meta' => strtoupper((string) $item->status) . ' / Stock ' . $item->stock,
                'timestamp' => $item->created_at,
                'route' => route('admin.inventory.show', $item),
                'accent' => 'blue',
            ]);
        });

        return $items->sortByDesc('timestamp')->take(8)->values();
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
