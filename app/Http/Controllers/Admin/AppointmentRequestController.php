<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\AppointmentRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class AppointmentRequestController extends Controller
{
    public function index(Request $request): View
    {
        $search = trim((string) $request->query('q'));

        $appointments = AppointmentRequest::query()
            ->when($search !== '', function ($query) use ($search) {
                $query->where(function ($subQuery) use ($search) {
                    $subQuery
                        ->where('name', 'like', "%{$search}%")
                        ->orWhere('email', 'like', "%{$search}%")
                        ->orWhere('phone', 'like', "%{$search}%")
                        ->orWhere('appointment_type', 'like', "%{$search}%")
                        ->orWhere('preferred_time', 'like', "%{$search}%")
                        ->orWhere('notes', 'like', "%{$search}%");
                });
            })
            ->latest()
            ->paginate(12)
            ->withQueryString();

        return view('admin.appointment-requests.index', [
            'heading' => 'Appointment Requests',
            'title' => 'Appointment Requests',
            'active' => 'appointment-requests',
            'appointments' => $appointments,
            'search' => $search,
        ]);
    }

    public function show(AppointmentRequest $appointmentRequest): View
    {
        return view('admin.appointment-requests.show', [
            'heading' => 'Appointment Requests',
            'title' => 'Appointment Details',
            'active' => 'appointment-requests',
            'appointment' => $appointmentRequest,
        ]);
    }

    public function destroy(AppointmentRequest $appointmentRequest): RedirectResponse
    {
        $appointmentRequest->delete();

        return redirect()
            ->route('admin.appointment-requests.index')
            ->with('status', 'Appointment request deleted successfully.')
            ->with('status_type', 'success')
            ->with('status_title', 'Appointment Removed');
    }
}
