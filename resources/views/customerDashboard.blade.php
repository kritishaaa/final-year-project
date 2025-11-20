@php
    use Carbon\Carbon;
    use Src\Courier\Models\Courier;
    use Src\Parcel\Models\Parcel;
    use Src\Parcel\Models\ParcelTrack;
    $today = Carbon::today();
    $last7Days = collect();

    for ($i = 6; $i >= 0; $i--) {
        $date = $today->copy()->subDays($i);
        $dayName = $date->format('D');
        $count = Parcel::whereDate('created_at', $date->toDateString())->count();

        $last7Days->push([
            'day' => $dayName,
            'count' => $count,
        ]);
    }

    $days = $last7Days->pluck('day');
    $counts = $last7Days->pluck('count');

    $topCouriers = Courier::withCount('parcelAssignments')->orderByDesc('parcel_assignments_count')->take(5)->get();
    $topBranches = Parcel::select('from_branch_id')
        ->selectRaw('COUNT(*) as parcel_count')
        ->groupBy('from_branch_id')
        ->orderByDesc('parcel_count')
        ->take(5)
        ->with('fromBranch')
        ->get();

    

    $recentActivities = ParcelTrack::select('parcel_id', 'status', 'message', 'location', 'created_at')
        ->with('parcel')
        ->orderByDesc('created_at')
        ->get()
        ->unique('parcel_id')
        ->take(10);
@endphp
<x-layout.courier-app header="{{ __('Dashboard') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/dashboard.css') }}" />


    <div class="container-fluid px-1 py-2">
        <div class="row mb-4">
            <div class="col-12">
                <div class="welcome-card">
                    <div
                        class="d-flex flex-column flex-md-row justify-content-between align-items-start align-items-md-center">

                        <!-- LEFT SIDE -->
                        <div>
                            <h3 class="fw-bold mb-2">Welcome back </h3>
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
                        {{-- <div class="d-flex align-items-center gap-3 mt-4 mt-md-0">
                            <div class="stat-badge">
                                <div class="stat-icon">
                                    <i class="fa fa-building"></i>
                                </div>
                                <div class="ms-3">
                                    <small class="d-block">Total Branches</small>
                                    <div class="fs-3 fw-bold text-dark">{{ $totalBranches }}</div>
                                </div>
                            </div>
                        </div> --}}

                    </div>
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

</x-layout.courier-app>
