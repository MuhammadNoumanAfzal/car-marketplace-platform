@extends('layouts.admin')
@section('content')
    <style>
        .admin-dashboard-shell {
            display: grid;
            gap: 22px;
        }

        .admin-hero {
            position: relative;
            overflow: hidden;
            display: grid;
            grid-template-columns: minmax(0, 1.4fr) minmax(320px, 0.8fr);
            gap: 18px;
            padding: 28px;
            background: linear-gradient(135deg, #08142f 0%, #0f2760 58%, #163b89 100%);
            border-radius: 24px;
            box-shadow: 0 24px 60px rgba(8, 20, 47, 0.24);
        }

        .admin-hero::before,
        .admin-hero::after {
            content: "";
            position: absolute;
            border-radius: 999px;
            pointer-events: none;
        }

        .admin-hero::before {
            width: 280px;
            height: 280px;
            right: -60px;
            top: -120px;
            background: radial-gradient(circle, rgba(214, 32, 52, 0.32) 0%, rgba(214, 32, 52, 0) 70%);
        }

        .admin-hero::after {
            width: 260px;
            height: 260px;
            left: -80px;
            bottom: -160px;
            background: radial-gradient(circle, rgba(37, 99, 235, 0.28) 0%, rgba(37, 99, 235, 0) 70%);
        }

        .admin-hero-copy,
        .admin-hero-side {
            position: relative;
            z-index: 1;
        }

        .admin-hero-kicker {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            padding: 8px 14px;
            border-radius: 999px;
            background: rgba(255, 255, 255, 0.08);
            color: rgba(255, 255, 255, 0.88);
            font-size: 0.82rem;
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: 0.08em;
            margin-bottom: 16px;
        }

        .admin-hero h1 {
            margin: 0;
            font-size: 2.35rem;
            line-height: 1.04;
            font-weight: 800;
            color: #ffffff;
            max-width: 12ch;
        }

        .admin-hero p {
            margin: 14px 0 0;
            max-width: 560px;
            color: rgba(234, 241, 255, 0.78);
            font-size: 1rem;
        }

        .admin-hero-actions {
            display: flex;
            flex-wrap: wrap;
            gap: 12px;
            margin-top: 22px;
        }

        .admin-hero-button,
        .admin-hero-button-alt {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            min-height: 48px;
            padding: 0 18px;
            border-radius: 999px;
            font-weight: 700;
            text-decoration: none !important;
        }

        .admin-hero-button {
            background: linear-gradient(90deg, #d62034 0%, #2563eb 100%);
            color: #ffffff !important;
            box-shadow: 0 16px 34px rgba(214, 32, 52, 0.24);
        }

        .admin-hero-button-alt {
            border: 1px solid rgba(255, 255, 255, 0.18);
            background: rgba(255, 255, 255, 0.06);
            color: #ffffff !important;
        }

        .admin-hero-side {
            display: grid;
            grid-template-columns: repeat(2, minmax(0, 1fr));
            gap: 14px;
            align-content: start;
        }

        .admin-hero-mini {
            padding: 18px;
            border-radius: 18px;
            background: rgba(255, 255, 255, 0.08);
            border: 1px solid rgba(255, 255, 255, 0.08);
            backdrop-filter: blur(10px);
        }

        .admin-hero-mini-label {
            color: rgba(234, 241, 255, 0.72);
            font-size: 0.8rem;
            text-transform: uppercase;
            letter-spacing: 0.06em;
            font-weight: 700;
        }

        .admin-hero-mini-value {
            margin-top: 10px;
            color: #ffffff;
            font-size: 1.7rem;
            font-weight: 800;
            line-height: 1;
        }

        .admin-hero-mini-note {
            margin-top: 8px;
            color: rgba(234, 241, 255, 0.72);
            font-size: 0.92rem;
        }

        .admin-dashboard-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(220px, 1fr));
            gap: 18px;
        }

        .admin-stat-card,
        .admin-panel {
            background: #ffffff;
            border: 1px solid #d9e4ff;
            border-radius: 18px;
            box-shadow: 0 16px 38px rgba(14, 30, 84, 0.08);
        }

        .admin-stat-card {
            padding: 22px;
            text-decoration: none !important;
            transition: transform 0.2s ease, box-shadow 0.2s ease;
            color: #0f172a;
            min-height: 176px;
        }

        .admin-stat-card:hover {
            transform: translateY(-3px);
            box-shadow: 0 20px 44px rgba(14, 30, 84, 0.14);
        }

        .admin-stat-card.blue {
            background: linear-gradient(135deg, #ffffff 0%, #eef4ff 100%);
        }

        .admin-stat-card.red {
            background: linear-gradient(135deg, #ffffff 0%, #fff0f3 100%);
        }

        .admin-stat-label {
            font-size: 0.88rem;
            font-weight: 700;
            letter-spacing: 0.04em;
            text-transform: uppercase;
            color: #4f5f7f;
            margin-bottom: 10px;
        }

        .admin-stat-count {
            font-size: 2rem;
            font-weight: 800;
            line-height: 1;
            margin-bottom: 12px;
            color: #0b1f4d;
        }

        .admin-stat-link {
            font-size: 0.96rem;
            font-weight: 700;
            color: #d62034;
        }

        .admin-stat-meta {
            margin-top: 10px;
            color: #60708d;
            font-size: 0.92rem;
        }

        .admin-panel {
            padding: 24px;
        }

        .admin-panel h2 {
            margin-bottom: 8px;
            color: #0b1f4d;
        }

        .admin-panel-copy {
            margin-bottom: 18px;
            color: #5b6780;
        }

        .admin-recent-table {
            width: 100%;
            border-collapse: collapse;
        }

        .admin-recent-table th,
        .admin-recent-table td {
            padding: 14px 12px;
            border-bottom: 1px solid #e7eeff;
            vertical-align: middle;
        }

        .admin-recent-table th {
            font-size: 0.84rem;
            text-transform: uppercase;
            letter-spacing: 0.04em;
            color: #5b6780;
        }

        .admin-recent-table td {
            color: #172033;
        }

        .admin-view-link {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            padding: 10px 16px;
            border-radius: 999px;
            background: linear-gradient(90deg, #1d4ed8 0%, #2563eb 100%);
            color: #ffffff !important;
            font-weight: 700;
            text-decoration: none !important;
        }

        .admin-empty-state {
            padding: 18px 0 6px;
            color: #5b6780;
        }

        .admin-analytics-grid {
            display: grid;
            grid-template-columns: minmax(0, 1.3fr) minmax(320px, 0.7fr);
            gap: 22px;
        }

        .admin-analytics-stack {
            display: grid;
            gap: 22px;
        }

        .admin-chart-head,
        .admin-panel-head {
            display: flex;
            align-items: flex-start;
            justify-content: space-between;
            gap: 12px;
            margin-bottom: 18px;
        }

        .admin-chart-head h2,
        .admin-panel-head h2 {
            margin: 0;
        }

        .admin-panel-note {
            color: #60708d;
            font-size: 0.93rem;
        }

        .admin-line-chart {
            height: 280px;
            border-radius: 18px;
            background:
                linear-gradient(to top, rgba(29, 78, 216, 0.05), rgba(29, 78, 216, 0)),
                #f7faff;
            border: 1px solid #e5eeff;
            padding: 18px;
        }

        .admin-line-chart svg {
            width: 100%;
            height: 200px;
            overflow: visible;
        }

        .admin-line-chart-footer {
            display: grid;
            grid-template-columns: repeat(6, minmax(0, 1fr));
            gap: 10px;
            margin-top: 12px;
            font-size: 0.84rem;
            color: #5b6780;
        }

        .admin-line-chart-footer span {
            text-align: center;
            font-weight: 700;
        }

        .admin-donut-wrap {
            display: grid;
            gap: 20px;
        }

        .admin-donut {
            width: 220px;
            height: 220px;
            margin: 0 auto;
            border-radius: 50%;
            position: relative;
        }

        .admin-donut::after {
            content: "";
            position: absolute;
            inset: 24px;
            border-radius: 50%;
            background: #ffffff;
            box-shadow: inset 0 0 0 1px #edf2ff;
        }

        .admin-donut-center {
            position: absolute;
            inset: 0;
            z-index: 1;
            display: grid;
            place-items: center;
            text-align: center;
        }

        .admin-donut-center strong {
            display: block;
            font-size: 2rem;
            color: #0b1f4d;
        }

        .admin-donut-center span {
            color: #60708d;
            font-weight: 700;
        }

        .admin-legend {
            display: grid;
            gap: 12px;
        }

        .admin-legend-item {
            display: grid;
            grid-template-columns: auto 1fr auto;
            gap: 10px;
            align-items: center;
        }

        .admin-legend-swatch {
            width: 12px;
            height: 12px;
            border-radius: 999px;
        }

        .admin-legend-label {
            color: #172033;
            font-weight: 700;
        }

        .admin-legend-value {
            color: #60708d;
            font-weight: 700;
        }

        .admin-makes {
            display: grid;
            gap: 14px;
        }

        .admin-make-row {
            display: grid;
            gap: 8px;
        }

        .admin-make-meta {
            display: flex;
            justify-content: space-between;
            gap: 12px;
            color: #172033;
            font-weight: 700;
        }

        .admin-make-bar {
            height: 12px;
            border-radius: 999px;
            background: #edf2ff;
            overflow: hidden;
        }

        .admin-make-bar > span {
            display: block;
            height: 100%;
            border-radius: inherit;
            background: linear-gradient(90deg, #d62034 0%, #2563eb 100%);
        }

        .admin-activity-list {
            display: grid;
            gap: 14px;
        }

        .admin-activity-item {
            display: grid;
            grid-template-columns: auto 1fr auto;
            gap: 14px;
            align-items: center;
            padding: 14px 0;
            border-bottom: 1px solid #eef3ff;
        }

        .admin-activity-item:last-child {
            border-bottom: 0;
            padding-bottom: 0;
        }

        .admin-activity-dot {
            width: 12px;
            height: 12px;
            border-radius: 999px;
        }

        .admin-activity-dot.blue {
            background: #2563eb;
            box-shadow: 0 0 0 6px rgba(37, 99, 235, 0.1);
        }

        .admin-activity-dot.red {
            background: #d62034;
            box-shadow: 0 0 0 6px rgba(214, 32, 52, 0.1);
        }

        .admin-activity-title {
            font-weight: 700;
            color: #172033;
        }

        .admin-activity-meta {
            color: #60708d;
            font-size: 0.92rem;
            margin-top: 2px;
        }

        .admin-activity-time {
            color: #60708d;
            font-size: 0.88rem;
            white-space: nowrap;
        }

        @media (max-width: 1199.98px) {
            .admin-hero,
            .admin-analytics-grid {
                grid-template-columns: 1fr;
            }
        }

        @media (max-width: 767.98px) {
            .admin-hero {
                padding: 22px;
            }

            .admin-hero h1 {
                font-size: 1.95rem;
            }

            .admin-hero-side {
                grid-template-columns: 1fr 1fr;
            }

            .admin-line-chart-footer {
                grid-template-columns: repeat(3, minmax(0, 1fr));
            }

            .admin-activity-item {
                grid-template-columns: auto 1fr;
            }

            .admin-activity-time {
                grid-column: 2;
            }
        }
    </style>

    @php
        $leadMax = max(1, $monthlyLeadSeries->max('count'));
        $points = $monthlyLeadSeries->values()->map(function ($point, $index) use ($monthlyLeadSeries, $leadMax) {
            $width = 560;
            $height = 180;
            $count = max(0, (int) $point['count']);
            $x = $monthlyLeadSeries->count() > 1 ? ($index / ($monthlyLeadSeries->count() - 1)) * $width : $width / 2;
            $y = $height - (($count / $leadMax) * ($height - 20)) - 10;
            return ['x' => round($x, 2), 'y' => round($y, 2), 'count' => $count, 'label' => $point['label']];
        });
        $pointString = $points->map(fn ($point) => $point['x'] . ',' . $point['y'])->implode(' ');
        $areaString = '0,190 ' . $pointString . ' 560,190';
        $inventoryTotal = max(1, $inventorySummary['total']);
        $availableAngle = round(($inventorySummary['available'] / $inventoryTotal) * 360, 2);
        $soldAngle = round(($inventorySummary['sold'] / $inventoryTotal) * 360, 2);
        $featuredAngle = round(($inventorySummary['featured'] / $inventoryTotal) * 360, 2);
        $topMakeMax = max(1, (int) $topMakes->max('total'));
    @endphp

    <div class="admin-dashboard-shell">
        <section class="admin-hero">
            <div class="admin-hero-copy">
                <div class="admin-hero-kicker">Nitro Motors Admin Overview</div>
                <h1>Clean control over inventory and incoming leads.</h1>
                <p>You can see what is selling, what is featured, and where buyer interest is coming from without digging through separate screens.</p>

                <div class="admin-hero-actions">
                    <a href="{{ route('admin.inventory.create') }}" class="admin-hero-button">Add Inventory</a>
                    <a href="{{ route('admin.consignment-requests.index') }}" class="admin-hero-button-alt">Review Seller Leads</a>
                </div>
            </div>

            <div class="admin-hero-side">
                <div class="admin-hero-mini">
                    <div class="admin-hero-mini-label">Total Inventory Value</div>
                    <div class="admin-hero-mini-value">${{ number_format($inventorySummary['value'], 0) }}</div>
                    <div class="admin-hero-mini-note">Based on current listed prices.</div>
                </div>
                <div class="admin-hero-mini">
                    <div class="admin-hero-mini-label">Average Price</div>
                    <div class="admin-hero-mini-value">${{ number_format($inventorySummary['average_price'], 0) }}</div>
                    <div class="admin-hero-mini-note">Across all inventory records.</div>
                </div>
                <div class="admin-hero-mini">
                    <div class="admin-hero-mini-label">Lead Volume</div>
                    <div class="admin-hero-mini-value">{{ $leadSummary['total'] }}</div>
                    <div class="admin-hero-mini-note">Contact, shipping, appointments, and consignments.</div>
                </div>
                <div class="admin-hero-mini">
                    <div class="admin-hero-mini-label">Featured Units</div>
                    <div class="admin-hero-mini-value">{{ $inventorySummary['featured'] }}</div>
                    <div class="admin-hero-mini-note">Highlighted on the storefront.</div>
                </div>
            </div>
        </section>

        <div class="admin-dashboard-grid">
            @foreach ($stats as $stat)
                <a href="{{ $stat['route'] }}" class="admin-stat-card {{ $stat['accent'] }}">
                    <div class="admin-stat-label">{{ $stat['label'] }}</div>
                    <div class="admin-stat-count">{{ $stat['count'] }}</div>
                    <div class="admin-stat-link">Open section</div>
                    <div class="admin-stat-meta">{{ $stat['meta'] }}</div>
                </a>
            @endforeach
        </div>

        <div class="admin-analytics-grid">
            <div class="admin-analytics-stack">
                <section class="admin-panel">
                    <div class="admin-chart-head">
                        <div>
                            <h2>Lead Trend</h2>
                            <div class="admin-panel-note">Last six months of incoming website requests.</div>
                        </div>
                        <div class="admin-panel-note">{{ $leadSummary['total'] }} total leads</div>
                    </div>

                    <div class="admin-line-chart">
                        <svg viewBox="0 0 560 200" preserveAspectRatio="none" aria-label="Lead trend chart">
                            <defs>
                                <linearGradient id="leadAreaGradient" x1="0" x2="0" y1="0" y2="1">
                                    <stop offset="0%" stop-color="rgba(37,99,235,0.30)" />
                                    <stop offset="100%" stop-color="rgba(37,99,235,0.02)" />
                                </linearGradient>
                                <linearGradient id="leadLineGradient" x1="0" x2="1" y1="0" y2="0">
                                    <stop offset="0%" stop-color="#d62034" />
                                    <stop offset="100%" stop-color="#2563eb" />
                                </linearGradient>
                            </defs>

                            @for ($i = 0; $i <= 4; $i++)
                                @php
                                    $y = 18 + ($i * 40);
                                @endphp
                                <line x1="0" y1="{{ $y }}" x2="560" y2="{{ $y }}" stroke="#dfe8fb" stroke-dasharray="4 6" />
                            @endfor

                            <polygon points="{{ $areaString }}" fill="url(#leadAreaGradient)"></polygon>
                            <polyline points="{{ $pointString }}" fill="none" stroke="url(#leadLineGradient)" stroke-width="4" stroke-linecap="round" stroke-linejoin="round"></polyline>

                            @foreach ($points as $point)
                                <circle cx="{{ $point['x'] }}" cy="{{ $point['y'] }}" r="6" fill="#ffffff" stroke="#2563eb" stroke-width="3"></circle>
                                <text x="{{ $point['x'] }}" y="{{ max(16, $point['y'] - 14) }}" text-anchor="middle" fill="#0b1f4d" font-size="12" font-weight="700">{{ $point['count'] }}</text>
                            @endforeach
                        </svg>

                        <div class="admin-line-chart-footer">
                            @foreach ($monthlyLeadSeries as $month)
                                <span>{{ $month['label'] }}</span>
                            @endforeach
                        </div>
                    </div>
                </section>

                <section class="admin-panel">
                    <div class="admin-panel-head">
                        <div>
                            <h2>Recent Activity</h2>
                            <div class="admin-panel-note">Latest movement across leads and inventory updates.</div>
                        </div>
                    </div>

                    @if ($recentActivity->isEmpty())
                        <div class="admin-empty-state">No recent activity found yet.</div>
                    @else
                        <div class="admin-activity-list">
                            @foreach ($recentActivity as $activity)
                                <a href="{{ $activity['route'] }}" class="admin-activity-item" style="text-decoration: none;">
                                    <span class="admin-activity-dot {{ $activity['accent'] }}"></span>
                                    <div>
                                        <div class="admin-activity-title">{{ $activity['type'] }}: {{ $activity['title'] }}</div>
                                        <div class="admin-activity-meta">{{ $activity['meta'] }}</div>
                                    </div>
                                    <div class="admin-activity-time">{{ $activity['timestamp']->diffForHumans() }}</div>
                                </a>
                            @endforeach
                        </div>
                    @endif
                </section>
            </div>

            <div class="admin-analytics-stack">
                <section class="admin-panel">
                    <div class="admin-panel-head">
                        <div>
                            <h2>Inventory Mix</h2>
                            <div class="admin-panel-note">Availability and featured listing balance.</div>
                        </div>
                    </div>

                    <div class="admin-donut-wrap">
                        <div class="admin-donut" style="background: conic-gradient(#2563eb 0deg {{ $availableAngle }}deg, #d62034 {{ $availableAngle }}deg {{ $availableAngle + $soldAngle }}deg, #93c5fd {{ $availableAngle + $soldAngle }}deg {{ min(360, $availableAngle + $soldAngle + $featuredAngle) }}deg, #eaf0ff {{ min(360, $availableAngle + $soldAngle + $featuredAngle) }}deg 360deg);">
                            <div class="admin-donut-center">
                                <div>
                                    <strong>{{ $inventorySummary['total'] }}</strong>
                                    <span>Total units</span>
                                </div>
                            </div>
                        </div>

                        <div class="admin-legend">
                            <div class="admin-legend-item">
                                <span class="admin-legend-swatch" style="background:#2563eb;"></span>
                                <span class="admin-legend-label">Available</span>
                                <span class="admin-legend-value">{{ $inventorySummary['available'] }}</span>
                            </div>
                            <div class="admin-legend-item">
                                <span class="admin-legend-swatch" style="background:#d62034;"></span>
                                <span class="admin-legend-label">Sold</span>
                                <span class="admin-legend-value">{{ $inventorySummary['sold'] }}</span>
                            </div>
                            <div class="admin-legend-item">
                                <span class="admin-legend-swatch" style="background:#93c5fd;"></span>
                                <span class="admin-legend-label">Featured</span>
                                <span class="admin-legend-value">{{ $inventorySummary['featured'] }}</span>
                            </div>
                        </div>
                    </div>
                </section>

                <section class="admin-panel">
                    <div class="admin-panel-head">
                        <div>
                            <h2>Top Makes</h2>
                            <div class="admin-panel-note">Which brands are filling your inventory most often.</div>
                        </div>
                    </div>

                    @if ($topMakes->isEmpty())
                        <div class="admin-empty-state">Add a few inventory records to see brand distribution here.</div>
                    @else
                        <div class="admin-makes">
                            @foreach ($topMakes as $make)
                                <div class="admin-make-row">
                                    <div class="admin-make-meta">
                                        <span>{{ $make->make }}</span>
                                        <span>{{ $make->total }}</span>
                                    </div>
                                    <div class="admin-make-bar">
                                        <span style="width: {{ round(($make->total / $topMakeMax) * 100, 2) }}%;"></span>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    @endif
                </section>
            </div>
        </div>

        <section class="admin-panel">
            <div class="admin-panel-head">
                <div>
                    <h2>Recent Consignment Requests</h2>
                    <div class="admin-panel-note">Seller submissions coming in from the public website.</div>
                </div>
            </div>

            @if ($recentConsignmentRequests->isEmpty())
                <div class="admin-empty-state">No consignment requests have been submitted yet.</div>
            @else
                <div class="table-responsive">
                    <table class="admin-recent-table">
                        <thead>
                            <tr>
                                <th>Name</th>
                                <th>Vehicle</th>
                                <th>Phone</th>
                                <th>Submitted</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($recentConsignmentRequests as $request)
                                <tr>
                                    <td>{{ $request->first_name }} {{ $request->last_name }}</td>
                                    <td>{{ $request->vehicle_year }} {{ $request->make }} {{ $request->model }}</td>
                                    <td>{{ $request->phone }}</td>
                                    <td>{{ $request->created_at->format('M d, Y h:i A') }}</td>
                                    <td>
                                        <a href="{{ route('admin.consignment-requests.show', $request) }}" class="admin-view-link">View</a>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            @endif
        </section>
    </div>
@endsection
