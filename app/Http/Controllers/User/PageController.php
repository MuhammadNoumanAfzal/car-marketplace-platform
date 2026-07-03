<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class PageController extends Controller
{
    public function home(): View
    {
        return view('user.home', [
            'slides' => $this->slides(),
            'featuredInventory' => $this->featuredInventory(),
            'journeys' => $this->journeys(),
            'reasons' => $this->reasons(),
            'trustStats' => $this->trustStats(),
            'reviews' => $this->reviews(),
        ]);
    }

    public function about(): View
    {
        return view('user.about.about', [
            'highlights' => [
                [
                    'title' => 'Buyer-first experience',
                    'copy' => 'Every touchpoint is designed to feel guided, transparent, and properly premium from the first inquiry onward.',
                ],
                [
                    'title' => 'Market-aware presentation',
                    'copy' => 'We position each vehicle with stronger photography, cleaner specs, and a sharper digital showroom presence.',
                ],
                [
                    'title' => 'Nationwide support',
                    'copy' => 'Remote buying, trade-in coordination, and delivery planning are built into the process from day one.',
                ],
            ],
            'pillars' => [
                [
                    'label' => 'Mission',
                    'title' => 'Make premium car buying feel clear, modern, and trustworthy.',
                    'copy' => 'Nitro Motors USA exists to remove the friction that usually surrounds high-value vehicle shopping and selling.',
                ],
                [
                    'label' => 'Vision',
                    'title' => 'Build a digital-first dealership brand customers genuinely trust.',
                    'copy' => 'We want every listing, reply, and handoff to reflect a higher standard of automotive presentation and service.',
                ],
            ],
            'experts' => [
                ['name' => 'Jordan Hayes', 'role' => 'Inventory Specialist'],
                ['name' => 'Elena Brooks', 'role' => 'Client Experience Lead'],
                ['name' => 'Marcus Reid', 'role' => 'Trade-In Advisor'],
            ],
            'trustStats' => $this->trustStats(),
            'reasons' => $this->reasons(),
        ]);
    }

    public function testimonials(): View
    {
        return view('user.about.testimonial', [
            'reviews' => $this->reviews(),
            'featuredReviews' => [
                $this->reviews()[0],
                $this->reviews()[4],
            ],
        ]);
    }

    public function directions(): View
    {
        return view('user.about.direction', [
            'directions' => [
                'Take FL-836 toward NW 72nd Avenue and exit toward Miami International Airport.',
                'Continue to NW 79th Avenue and follow local signs toward the showroom district.',
                'Nitro Motors USA is located at 1450 NW 79th Avenue with guest parking available nearby.',
            ],
            'landmarks' => [
                'Minutes from Miami International Airport',
                'Close to Dolphin Expressway access',
                'Near major hotel and rental car routes',
            ],
        ]);
    }

    public function contact(): View
    {
        return view('user.contact.contact', [
            'topics' => [
                'General inquiry',
                'Vehicle availability',
                'Financing support',
                'Trade-in question',
                'Schedule a visit',
            ],
        ]);
    }

    public function sendContact(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'name' => ['required', 'string', 'max:100'],
            'email' => ['required', 'email', 'max:120'],
            'phone' => ['nullable', 'string', 'max:30'],
            'topic' => ['required', 'string', 'max:80'],
            'message' => ['required', 'string', 'max:1500'],
        ]);

        logger()->info('Nitro Motors USA contact inquiry received.', $validated);

        return redirect()
            ->route('contact')
            ->with('status', 'Thanks for reaching out. Our team will get back to you shortly.');
    }

    public function appointment(): View
    {
        return view('user.appointment.appointment', [
            'appointmentTypes' => [
                'Showroom visit',
                'Virtual walkaround',
                'Financing consultation',
                'Trade-in review',
                'Vehicle delivery call',
            ],
            'timeSlots' => [
                '10:00 AM',
                '11:30 AM',
                '1:00 PM',
                '3:00 PM',
                '5:30 PM',
            ],
        ]);
    }

    public function bookAppointment(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'name' => ['required', 'string', 'max:100'],
            'email' => ['required', 'email', 'max:120'],
            'phone' => ['required', 'string', 'max:30'],
            'appointment_type' => ['required', 'string', 'max:100'],
            'preferred_date' => ['required', 'date'],
            'preferred_time' => ['required', 'string', 'max:30'],
            'notes' => ['nullable', 'string', 'max:1500'],
        ]);

        logger()->info('Nitro Motors USA appointment request received.', $validated);

        return redirect()
            ->route('appointment')
            ->with('status', 'Your appointment request has been received. Our team will confirm your booking shortly.');
    }

    public function shipping(): View
    {
        return view('user.services.shipping', [
            'transportTypes' => [
                'Open carrier',
                'Enclosed carrier',
                'Expedited shipping',
            ],
            'pickupWindows' => [
                'Within 3 days',
                'This week',
                'Within 2 weeks',
                'Flexible',
            ],
        ]);
    }

    public function sendShipping(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'name' => ['required', 'string', 'max:100'],
            'email' => ['required', 'email', 'max:120'],
            'phone' => ['required', 'string', 'max:30'],
            'vehicle_year' => ['required', 'string', 'max:10'],
            'vehicle_make' => ['required', 'string', 'max:80'],
            'vehicle_model' => ['required', 'string', 'max:80'],
            'origin' => ['required', 'string', 'max:120'],
            'destination' => ['required', 'string', 'max:120'],
            'transport_type' => ['required', 'string', 'max:60'],
            'pickup_window' => ['required', 'string', 'max:60'],
            'notes' => ['nullable', 'string', 'max:1500'],
        ]);

        logger()->info('Nitro Motors USA shipping request received.', $validated);

        return redirect()
            ->route('services.shipping')
            ->with('status', 'Your shipping request has been received. Our team will send you a transport quote shortly.');
    }

    public function consignment(): View
    {
        return view('user.services.consighment', [
            'years' => range(date('Y'), date('Y') - 15),
            'transmissions' => [
                'Automatic',
                'Manual',
                'CVT',
                'Dual-clutch',
            ],
            'states' => [
                'Florida',
                'Texas',
                'California',
                'New York',
                'Georgia',
            ],
        ]);
    }

    public function sendConsignment(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'vehicle_year' => ['required', 'string', 'max:10'],
            'make' => ['required', 'string', 'max:80'],
            'model' => ['required', 'string', 'max:80'],
            'trim' => ['nullable', 'string', 'max:80'],
            'exterior_color' => ['nullable', 'string', 'max:50'],
            'interior_color' => ['nullable', 'string', 'max:50'],
            'cylinders' => ['nullable', 'string', 'max:20'],
            'liters' => ['nullable', 'string', 'max:20'],
            'mileage' => ['required', 'string', 'max:30'],
            'transmission' => ['required', 'string', 'max:40'],
            'lien_holder' => ['nullable', 'string', 'max:120'],
            'additional_options' => ['nullable', 'string', 'max:1500'],
            'first_name' => ['required', 'string', 'max:60'],
            'last_name' => ['required', 'string', 'max:60'],
            'address' => ['required', 'string', 'max:150'],
            'city' => ['required', 'string', 'max:80'],
            'state' => ['required', 'string', 'max:80'],
            'zip' => ['required', 'string', 'max:20'],
            'email' => ['required', 'email', 'max:120'],
            'phone' => ['required', 'string', 'max:30'],
        ]);

        logger()->info('Nitro Motors USA consignment request received.', $validated);

        return redirect()
            ->route('services.consignment')
            ->with('status', 'Your consignment request has been received. Our team will review the vehicle details and contact you shortly.');
    }

    private function slides(): array
    {
        return [
            [
                'eyebrow' => 'Performance Collection',
                'title' => 'Premium vehicles, presented with the confidence serious buyers expect.',
                'description' => 'Discover handpicked inventory, transparent guidance, and a cleaner buying experience built for customers looking for standout cars across the USA.',
                'name' => '2024 Porsche 911 Carrera',
                'background' => 'https://images.unsplash.com/photo-1492144534655-ae79c964c9d7?auto=format&fit=crop&w=1800&q=80',
                'car_image' => 'https://images.unsplash.com/photo-1503376780353-7e6692767b70?auto=format&fit=crop&w=1200&q=80',
            ],
            [
                'eyebrow' => 'Luxury SUV Spotlight',
                'title' => 'From family-ready luxury SUVs to weekend icons, every listing should feel first class.',
                'description' => 'We help buyers compare the right options faster with polished presentation, responsive support, and a straightforward path from inquiry to delivery.',
                'name' => '2023 BMW X7 M60i',
                'background' => 'https://images.unsplash.com/photo-1502877338535-766e1452684a?auto=format&fit=crop&w=1800&q=80',
                'car_image' => 'https://images.unsplash.com/photo-1555215695-3004980ad54e?auto=format&fit=crop&w=1200&q=80',
            ],
            [
                'eyebrow' => 'Electric Luxury',
                'title' => 'Modern showroom, effortless buying and selling.',
                'description' => 'Source or sell your next vehicle with cleaner presentation, clearer communication, and nationwide support.',
                'name' => '2024 Mercedes-Benz EQE SUV',
                'background' => 'https://images.unsplash.com/photo-1511919884226-fd3cad34687c?auto=format&fit=crop&w=1800&q=80',
                'car_image' => 'https://images.unsplash.com/photo-1553440569-bcc63803a83d?auto=format&fit=crop&w=1400&q=80',
            ],
        ];
    }

    private function journeys(): array
    {
        return [
            [
                'kicker' => 'Buy With Confidence',
                'title' => 'How To Buy A Car',
                'intro' => 'A straightforward path from search to delivery.',
                'steps' => [
                    'Browse inventory and shortlist the vehicles that fit your budget.',
                    'Talk with our team for specs, walkarounds, financing, and trade-in guidance.',
                    'Reserve your vehicle and complete paperwork with nationwide delivery support.',
                ],
            ],
            [
                'kicker' => 'Sell With Ease',
                'title' => 'How To Sell Your Car',
                'intro' => 'Fast valuation, clear offers, and less back-and-forth.',
                'steps' => [
                    'Share your vehicle details, VIN, mileage, and recent photos.',
                    'Receive a market-aware quote after our quick review process.',
                    'Accept the offer and let us coordinate inspection, paperwork, and pickup.',
                ],
            ],
        ];
    }

    private function featuredInventory(): array
    {
        return [
            [
                'year' => '2020',
                'make' => 'Toyota',
                'model' => 'Sequoia Platinum',
                'price' => '$42,900',
                'doc_fee' => '$367',
                'filing_fee' => '$99',
                'tag_fee' => '$27',
                'total_price' => '$43,393',
                'mileage' => '67,420',
                'stock' => 'NMU20481',
                'image' => 'https://images.unsplash.com/photo-1494976388531-d1058494cdd8?auto=format&fit=crop&w=1200&q=80',
            ],
            [
                'year' => '2021',
                'make' => 'Mercedes-Benz',
                'model' => 'GLE 350',
                'price' => '$48,500',
                'doc_fee' => '$367',
                'filing_fee' => '$99',
                'tag_fee' => '$27',
                'total_price' => '$48,993',
                'mileage' => '38,155',
                'stock' => 'NMU21834',
                'image' => 'https://images.unsplash.com/photo-1511919884226-fd3cad34687c?auto=format&fit=crop&w=1200&q=80',
            ],
            [
                'year' => '2022',
                'make' => 'BMW',
                'model' => 'X5 xDrive40i',
                'price' => '$56,800',
                'doc_fee' => '$367',
                'filing_fee' => '$99',
                'tag_fee' => '$27',
                'total_price' => '$57,293',
                'mileage' => '24,910',
                'stock' => 'NMU22792',
                'image' => 'https://images.unsplash.com/photo-1555215695-3004980ad54e?auto=format&fit=crop&w=1200&q=80',
            ],
        ];
    }

    private function reasons(): array
    {
        return [
            ['title' => 'Curated Inventory', 'copy' => 'We focus on vehicles with strong condition, smart specs, and premium buyer appeal.'],
            ['title' => 'Transparent Process', 'copy' => 'From pricing to paperwork, the experience stays clear and easy to follow.'],
            ['title' => 'Nationwide Support', 'copy' => 'Remote buying, shipping coordination, and trade-in help for customers across the USA.'],
            ['title' => 'Modern Presentation', 'copy' => 'A stronger digital showroom that reflects a high-end automotive brand.'],
        ];
    }

    private function trustStats(): array
    {
        return [
            ['value' => '250+', 'label' => 'Vehicles sourced and listed'],
            ['value' => '4.9/5', 'label' => 'Average customer satisfaction'],
            ['value' => '48h', 'label' => 'Average offer turnaround'],
            ['value' => '30+', 'label' => 'States served nationwide'],
        ];
    }

    private function reviews(): array
    {
        return [
            [
                'name' => 'Marcus T.',
                'location' => 'Orlando, FL',
                'quote' => 'The whole process felt cleaner than any dealership experience I have had before. Quick answers, no pressure, and a car that arrived exactly as described.',
            ],
            [
                'name' => 'Jasmine R.',
                'location' => 'Houston, TX',
                'quote' => 'They helped me compare options, sort financing, and even made the remote purchase process feel easy. The communication was the best part.',
            ],
            [
                'name' => 'Daniel S.',
                'location' => 'Phoenix, AZ',
                'quote' => 'I sold my SUV through Nitro Motors and got a fair offer without wasting time. Super smooth handoff and very professional team.',
            ],
            [
                'name' => 'Sofia M.',
                'location' => 'Tampa, FL',
                'quote' => 'The team made the financing and paperwork side feel simple. Everything was explained clearly and the car looked even better in person.',
            ],
            [
                'name' => 'Anthony P.',
                'location' => 'Charlotte, NC',
                'quote' => 'I bought remotely and expected stress, but the process was organized from start to finish. Great updates, honest details, and smooth delivery.',
            ],
            [
                'name' => 'Brianna L.',
                'location' => 'Dallas, TX',
                'quote' => 'Selling my vehicle through Nitro Motors was quick and professional. The offer was fair and the pickup process was handled without delays.',
            ],
        ];
    }
}
