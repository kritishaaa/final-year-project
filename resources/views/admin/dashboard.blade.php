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
    <link rel="stylesheet" href="{{ asset('assets/css/dashboard.css') }}" />


    <div class="container-fluid px-1 py-2">
        <div class="row mb-4">
            <div class="col-12">
                <div class="welcome-card">
                    <div
                        class="d-flex flex-column flex-md-row justify-content-between align-items-start align-items-md-center">

                        <!-- LEFT SIDE -->
                        <div>
                            <h3 class="fw-bold mb-2">Welcome back, Superadmin! 👋</h3>
                            <p class="text-muted mb-3">Here’s your quick snapshot for today.</p>
                            <div class="date-time-badge d-flex align-items-center gap-2 px-3 py-2">
                                <span class="d-flex align-items-center gap-1">
                                    <span>Today's Date:</span>
                                    <i class="fa fa-calendar"></i>
                                    <span id="current-date"></span>
                                </span>

                                <span class="separator">|</span>

                                <span class="d-flex align-items-center gap-1">
                                    <i class="fa fa-clock"></i>
                                    <span id="current-time"></span>
                                </span>
                            </div>

                        </div>

                        <!-- RIGHT SIDE BADGE -->
                        <div class="d-flex align-items-center gap-3 mt-4 mt-md-0">
                            <div class="stat-badge">
                                <div class="stat-icon">
                                    <i class="fa fa-building"></i>
                                </div>
                                <div class="ms-3">
                                    <small class="d-block">Total Branches</small>
                                    <div class="fs-3 fw-bold text-dark">{{ $totalBranches }}</div>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>

        <div class="row g-4 mb-4">

            <div class="col-md-3">
                <div class="info-card">
                    <div class="d-flex align-items-center justify-content-between mb-2">
                        <div class="card-icon icon-yellow">
                            <i class="fa fa-box"></i>
                        </div>
                        <div>

                            <h6 class="text-dark">Total Parcels</h6>
                            <h3 class="fw-bold text-brown  text-center">{{ number_format($totalParcels) }}</h3>
                        </div>

                    </div>

                </div>
            </div>

            <div class="col-md-3">
                <div class="info-card">
                    <div class="d-flex align-items-center justify-content-between mb-2">
                        <div class="card-icon icon-green">
                            <i class="fa fa-check-circle"></i>
                        </div>
                        <div>
                            <h6 class="text-dark">Delivered</h6>
                            <h3 class="fw-bold text-brown text-center">
                                {{ number_format($statusCounts['delivered'] ?? 0) }}</h3>
                        </div>

                    </div>
                </div>
            </div>

            <div class="col-md-3">
                <div class="info-card">
                    <div class="d-flex align-items-center justify-content-between mb-2">
                        <div class="card-icon icon-blue">
                            <i class="fa fa-truck"></i>
                        </div>
                        <div>

                            <h6 class="text-dark">In Transit</h6>
                            <h3 class="fw-bold text-brown  text-center">
                                {{ number_format($statusCounts['in_transit'] ?? 0) }}</h3>
                        </div>

                    </div>
                </div>
            </div>

            <div class="col-md-3">
                <div class="info-card">
                    <div class="d-flex align-items-center justify-content-between mb-2">
                        <div class="card-icon icon-red">
                            <i class="fa fa-clock"></i>
                        </div>
                        <div>

                            <h6 class="text-dark">Pending</h6>
                            <h3 class="fw-bold text-brown  text-center">{{ number_format($totalStaff) }}</h3>
                        </div>
                    </div>
                </div>
            </div>

        </div>

        <div class="row g-4 mb-4">
            <div class="col-12 col-lg-8">
                <div class="dashboard-card">
                    <h5 class="card-title mb-4">Parcels in Last 7 Days</h5>
                    <canvas id="parcelBarChart" height="110"></canvas>
                </div>
            </div>
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

        </div>

        <div class="row g-4">
            <div class="col-12 col-lg-4">
                <div class="dashboard-card end-item">
                    <h5 class="card-title mb-4">Top 5 Active Couriers</h5>
                    <table class="table table-borderless mb-0 table-dark-text">
                        <thead>
                            <tr>
                                <th>Courier</th>

                                <th>Assigned Parcels</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($topCouriers as $courier)
                                <tr>
                                    <td>{{ $courier->user->name ?? 'N/A' }}</td>
                                    <td>{{ $courier->parcel_assignments_count }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="col-12 col-lg-4">
                <div class="dashboard-card end-item">
                    <h5 class="card-title mb-4">Top 5 Active Branches</h5>
                    <table class="table table-borderless mb-0">
                        <thead>
                            <tr>
                                <th>Branch</th>
                                <th>Parcels</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($topBranches as $branchData)
                                <tr>
                                    <td>{{ $branchData->fromBranch->name ?? 'N/A' }}</td>
                                    <td>{{ $branchData->parcel_count }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>

            <div class="col-12 col-lg-4">

                <div class="dashboard-card end-item">
                    <h5 class="card-title mb-3">Recent Parcel Activity</h5>
                    <ul class="list-group list-group-flush">
                        @foreach ($recentActivities as $activity)
                            <li class="list-group-item d-flex justify-content-between align-items-center">
                                <div>
                                    <strong class="dark-font">{{ $activity->parcel->tracking_code ?? 'N/A' }}</strong> -
                                    {{ $activity->status }}
                                    <small class="d-block text-muted dark-font">{{ $activity->message }}</small>
                                </div>
                                <span class="text-sm text-muted dark-font">{{ $activity->created_at->format('d M, H:i') }}</span>
                            </li>
                        @endforeach
                    </ul>
                </div>
            </div>
        </div>
        <!-- Nepali Date Converter -->
        <script src="https://cdn.jsdelivr.net/npm/nepali-date-converter@3.3.4/dist/nepali-date-converter.umd.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

        <script>
            document.addEventListener("DOMContentLoaded", function() {

                // Check if library is loaded
                if (typeof NepaliDate === "undefined") {
                    console.error("NepaliDate library failed to load ❌");
                    return;
                }

                const dateEl = document.getElementById("current-date");
                const timeEl = document.getElementById("current-time");

                function updateDateTime() {
                    const now = new Date();

                    // Nepali Date
                    const np = new NepaliDate(now);
                    const nepDate = np.format("MMMM DD, YYYY (ddd)", "np");

                    // Nepali Time
                    const nepTime = new Intl.DateTimeFormat("ne-NP", {
                        timeStyle: "medium",
                        numberingSystem: "deva",
                        hour12: false
                    }).format(now);

                    dateEl.textContent = nepDate;
                    timeEl.textContent = nepTime;
                }

                updateDateTime();
                setInterval(updateDateTime, 1000);
            });
        </script>

        <script>
            const ctx = document.getElementById('parcelBarChart').getContext('2d');
            const parcelBarChart = new Chart(ctx, {
                type: 'bar',
                data: {
                    labels: @json($days), // use day names instead of dates
                    datasets: [{
                        label: 'Parcels',
                        data: @json($counts),
                        backgroundColor: '#34d399',
                        borderRadius: 6,
                    }]
                },
                options: {
                    responsive: true,
                    plugins: {
                        legend: {
                            display: false
                        },
                        tooltip: {
                            mode: 'index',
                            intersect: false
                        }
                    },
                    scales: {
                        y: {
                            beginAtZero: true,
                            ticks: {
                                stepSize: 1
                            }
                        },
                        x: {
                            ticks: {
                                color: '#5a4b36'
                            }
                        }
                    }
                }
            });
        </script>

    </div>

</x-layout.app>
