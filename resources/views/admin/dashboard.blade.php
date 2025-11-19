@php
    use Illuminate\Support\Facades\DB;
    use Carbon\Carbon;

    $totalBranches = DB::table('branches')->count();
    $totalParcels = DB::table('parcels')->count();
    $totalStaff = DB::table('users')->where('role', '!=', 1)->count();

    // Parcels by status
    $statusCounts = DB::table('parcels')
        ->select('status', DB::raw('count(*) as count'))
        ->groupBy('status')
        ->pluck('count', 'status')
        ->toArray();

    // Last 7 days delivered counts
    $last7 = collect();
    for ($i = 6; $i >= 0; $i--) {
        $day = Carbon::today()->subDays($i);
        $count = DB::table('parcels')->where('status', 'delivered')->whereDate('updated_at', $day)->count();
        $last7->push(['label' => $day->format('M d'), 'count' => $count]);
    }

    // Parcels per branch
    $branches = DB::table('branches')
        ->leftJoin('parcels', 'branches.id', '=', 'parcels.from_branch_id')
        ->select('branches.name', DB::raw('count(parcels.id) as parcel_count'))
        ->groupBy('branches.name')
        ->get();
@endphp

<x-layout.app header="{{ __('Dashboard') }}">
    <div class="container-fluid px-4 py-4">

        <!-- Welcome Card -->
        <div class="row mb-4">
            <div class="col-12">
                <div class="welcome-card">
                    <div
                        class="d-flex flex-column flex-md-row justify-content-between align-items-start align-items-md-center">
                        <div>
                            <h3 class="fw-bold mb-2">Welcome back, Superadmin!</h3>
                            <p class="text-muted mb-0">Here's what's happening with your courier operations today.</p>
                        </div>
                        <div class="d-flex align-items-center gap-3 mt-3 mt-md-0">
                            <div class="stat-badge">
                                <div class="stat-icon">
                                    <i class="fa fa-building"></i>
                                </div>
                                <div class="ms-3">
                                    <small class="text-muted d-block">Total Branches</small>
                                    <div class="fs-3 fw-bold">{{ $totalBranches }}</div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Quick Stats -->
        <div class="row g-3 mb-4">
            <div class="col-12 col-md-6 col-xl-3">
                <div class="stat-card stat-card-blue">
                    <div class="stat-card-icon">
                        <i class="fa fa-box"></i>
                    </div>
                    <div>
                        <small class="stat-label">Total Parcels</small>
                        <div class="stat-value">{{ number_format($totalParcels) }}</div>
                    </div>
                </div>
            </div>
            <div class="col-12 col-md-6 col-xl-3">
                <div class="stat-card stat-card-green">
                    <div class="stat-card-icon">
                        <i class="fa fa-check-circle"></i>
                    </div>
                    <div>
                        <small class="stat-label">Delivered</small>
                        <div class="stat-value">{{ number_format($statusCounts['delivered'] ?? 0) }}</div>
                    </div>
                </div>
            </div>
            <div class="col-12 col-md-6 col-xl-3">
                <div class="stat-card stat-card-orange">
                    <div class="stat-card-icon">
                        <i class="fa fa-truck"></i>
                    </div>
                    <div>
                        <small class="stat-label">In Transit</small>
                        <div class="stat-value">{{ number_format($statusCounts['in_transit'] ?? 0) }}</div>
                    </div>
                </div>
            </div>
            <div class="col-12 col-md-6 col-xl-3">
                <div class="stat-card stat-card-purple">
                    <div class="stat-card-icon">
                        <i class="fa fa-users"></i>
                    </div>
                    <div>
                        <small class="stat-label">Total Staff</small>
                        <div class="stat-value">{{ number_format($totalStaff) }}</div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Charts & Status -->
        <div class="row g-4">
            <!-- Status Breakdown -->
            <div class="col-12 col-lg-4">
                <div class="dashboard-card">
                    <h5 class="card-title mb-4">Parcel Status Breakdown</h5>

                    @php
                        $statuses = [
                            'pending' => ['label' => 'Pending', 'color' => '#3b82f6'],
                            'assigned' => ['label' => 'Assigned', 'color' => '#8b5cf6'],
                            'in_transit' => ['label' => 'In Transit', 'color' => '#f59e0b'],
                            'delivered' => ['label' => 'Delivered', 'color' => '#10b981'],
                            'cancelled' => ['label' => 'Cancelled', 'color' => '#ef4444'],
                        ];
                    @endphp

                    @foreach ($statuses as $key => $status)
                        @php
                            $count = $statusCounts[$key] ?? 0;
                            $pct = $totalParcels ? round(($count / $totalParcels) * 100) : 0;
                        @endphp
                        <div class="status-item">
                            <div class="d-flex justify-content-between align-items-center mb-2">
                                <div class="d-flex align-items-center">
                                    <span class="status-dot" style="background-color: {{ $status['color'] }}"></span>
                                    <span class="status-label">{{ $status['label'] }}</span>
                                </div>
                                <div class="d-flex align-items-center gap-2">
                                    <span class="status-count">{{ number_format($count) }}</span>
                                    <span class="status-pct">{{ $pct }}%</span>
                                </div>
                            </div>
                            <div class="progress-modern">
                                <div class="progress-bar-modern"
                                    style="width: {{ $pct }}%; background-color: {{ $status['color'] }}">
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>

            <!-- Charts Column -->
            {{-- <div class="col-12 col-lg-8">
                <!-- Deliveries Chart -->
                <div class="dashboard-card mb-4">
                    <h5 class="card-title mb-4">Delivery Trend - Last 7 Days</h5>
                    <canvas id="deliveriesChart" height="100"></canvas>
                </div>

                <!-- Branch Chart -->
                <div class="dashboard-card">
                    <h5 class="card-title mb-4">Parcels Distribution by Branch</h5>
                    <canvas id="branchChart" height="100"></canvas>
                </div>
            </div> --}}
        </div>

    </div>

    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
 
    <style>
        /* Base Typography */
        body {
            font-family: 'Inter', -apple-system, BlinkMacSystemFont, 'Segoe UI', 'Roboto', sans-serif;
            background-color: #f8fafc;
            color: #1e293b;
        }

        /* Welcome Card */
        .welcome-card {
            background: linear-gradient(135deg, #e6a27d 0%, #e27450 100%);
            color: white;
            padding: 2rem;
            border-radius: 16px;
            box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1), 0 2px 4px -1px rgba(0, 0, 0, 0.06);
        }

        .welcome-card h3 {
            color: white;
            font-size: 1.5rem;
        }

        .welcome-card .text-muted {
            color: rgba(255, 255, 255, 0.85) !important;
        }

        .stat-badge {
            background: rgba(255, 255, 255, 0.15);
            backdrop-filter: blur(10px);
            padding: 1rem 1.5rem;
            border-radius: 12px;
            display: flex;
            align-items: center;
            border: 1px solid rgba(255, 255, 255, 0.2);
        }

        .stat-icon {
            width: 48px;
            height: 48px;
            background: rgba(255, 255, 255, 0.2);
            border-radius: 10px;
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            font-size: 1.5rem;
        }

        /* Quick Stat Cards */
        .stat-card {
            background: white;
            padding: 1.5rem;
            border-radius: 12px;
            display: flex;
            align-items: center;
            gap: 1rem;
            box-shadow: 0 1px 3px 0 rgba(0, 0, 0, 0.1), 0 1px 2px 0 rgba(0, 0, 0, 0.06);
            transition: transform 0.2s, box-shadow 0.2s;
            border-left: 4px solid;
        }

        .stat-card:hover {
            transform: translateY(-2px);
            box-shadow: 0 10px 15px -3px rgba(0, 0, 0, 0.1), 0 4px 6px -2px rgba(0, 0, 0, 0.05);
        }

        .stat-card-blue {
            border-color: #3b82f6;
        }

        .stat-card-green {
            border-color: #10b981;
        }

        .stat-card-orange {
            border-color: #f59e0b;
        }

        .stat-card-purple {
            border-color: #8b5cf6;
        }

        .stat-card-icon {
            width: 56px;
            height: 56px;
            border-radius: 12px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.5rem;
            flex-shrink: 0;
        }

        .stat-card-blue .stat-card-icon {
            background: #eff6ff;
            color: #3b82f6;
        }

        .stat-card-green .stat-card-icon {
            background: #ecfdf5;
            color: #10b981;
        }

        .stat-card-orange .stat-card-icon {
            background: #fffbeb;
            color: #f59e0b;
        }

        .stat-card-purple .stat-card-icon {
            background: #f5f3ff;
            color: #8b5cf6;
        }

        .stat-label {
            color: #64748b;
            font-size: 0.875rem;
            font-weight: 500;
            text-transform: uppercase;
            letter-spacing: 0.05em;
            display: block;
            margin-bottom: 0.25rem;
        }

        .stat-value {
            font-size: 1.875rem;
            font-weight: 700;
            color: #1e293b;
            line-height: 1;
        }

        /* Dashboard Cards */
        .dashboard-card {
            background: white;
            padding: 1.75rem;
            border-radius: 12px;
            box-shadow: 0 1px 3px 0 rgba(0, 0, 0, 0.1), 0 1px 2px 0 rgba(0, 0, 0, 0.06);
            height: 100%;
        }

        .card-title {
            font-size: 1.125rem;
            font-weight: 700;
            color: #1e293b;
            margin: 0;
        }

        /* Status Items */
        .status-item {
            margin-bottom: 1.5rem;
        }

        .status-item:last-child {
            margin-bottom: 0;
        }

        .status-dot {
            width: 10px;
            height: 10px;
            border-radius: 50%;
            display: inline-block;
            margin-right: 0.75rem;
        }

        .status-label {
            font-size: 0.9375rem;
            font-weight: 500;
            color: #475569;
        }

        .status-count {
            font-size: 1rem;
            font-weight: 700;
            color: #1e293b;
        }

        .status-pct {
            font-size: 0.875rem;
            color: #64748b;
            min-width: 45px;
            text-align: right;
        }

        .progress-modern {
            height: 8px;
            background-color: #f1f5f9;
            border-radius: 8px;
            overflow: hidden;
        }

        .progress-bar-modern {
            height: 100%;
            border-radius: 8px;
            transition: width 0.6s ease;
        }

        /* Responsive adjustments */
        @media (max-width: 768px) {
            .welcome-card h3 {
                font-size: 1.25rem;
            }

            .stat-value {
                font-size: 1.5rem;
            }

            .dashboard-card {
                padding: 1.25rem;
            }
        }
    </style>

</x-layout.app>
