<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ContactInquiry;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class ContactInquiryController extends Controller
{
    public function index(Request $request): View
    {
        $search = trim((string) $request->query('q'));

        $inquiries = ContactInquiry::query()
            ->when($search !== '', function ($query) use ($search) {
                $query->where(function ($subQuery) use ($search) {
                    $subQuery
                        ->where('name', 'like', "%{$search}%")
                        ->orWhere('email', 'like', "%{$search}%")
                        ->orWhere('phone', 'like', "%{$search}%")
                        ->orWhere('topic', 'like', "%{$search}%")
                        ->orWhere('message', 'like', "%{$search}%");
                });
            })
            ->latest()
            ->paginate(12)
            ->withQueryString();

        return view('admin.contact-inquiries.index', [
            'heading' => 'Contact Inquiries',
            'title' => 'Contact Inquiries',
            'active' => 'contact-inquiries',
            'inquiries' => $inquiries,
            'search' => $search,
        ]);
    }

    public function show(ContactInquiry $contactInquiry): View
    {
        return view('admin.contact-inquiries.show', [
            'heading' => 'Contact Inquiries',
            'title' => 'Inquiry Details',
            'active' => 'contact-inquiries',
            'inquiry' => $contactInquiry,
        ]);
    }

    public function destroy(ContactInquiry $contactInquiry): RedirectResponse
    {
        $contactInquiry->delete();

        return redirect()
            ->route('admin.contact-inquiries.index')
            ->with('status', 'Inquiry deleted successfully.')
            ->with('status_type', 'success')
            ->with('status_title', 'Inquiry Removed');
    }
}
