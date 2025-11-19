@php

    use Carbon\Carbon;

    $userId = auth()->id();
    $courier = \Src\Courier\Models\Courier::where('user_id', $userId)->firstOrFail();

    // Parcel IDs assigned to this courier
    $assignedParcelIds = \Src\Parcel\Models\ParcelAssignment::where('courier_id', $courier->id)->pluck('parcel_id');

    // Status counts
    $statusCounts = \Src\Parcel\Models\Parcel::whereIn('id', $assignedParcelIds)
        ->select('status', \DB::raw('count(*) as count'))
        ->groupBy('status')
        ->pluck('count', 'status')
        ->toArray();

    // Last 7 days delivered parcels
    $last7 = collect();
    for ($i = 6; $i >= 0; $i--) {
        $day = Carbon::today()->subDays($i);
        $count = \Src\Parcel\Models\Parcel::whereIn('id', $assignedParcelIds)
            ->where('status', 'delivered')
            ->whereDate('updated_at', $day)
            ->count();
        $last7->push([
            'label' => $day->format('M d'),
            'count' => $count,
        ]);
    }

    // Recent parcels (with branch relationships)
    $recentParcels = \Src\Parcel\Models\Parcel::with('fromBranch', 'toBranch')
        ->whereIn('id', $assignedParcelIds)
        ->orderBy('created_at', 'desc')
        ->limit(6)
        ->get();
@endphp
<x-layout.courier-app header="{{ __('Dashboard') }}">
    <div class="container-fluid px-4 py-4">

        <!-- Welcome Card -->
        <div class="row mb-4">
            <div class="col-12">
                <div class="welcome-card shadow-lg">
                    <div
                        class="d-flex flex-column flex-md-row justify-content-between align-items-start align-items-md-center">
                        <div>
                            <h3 class="fw-bold mb-2">Welcome, {{ auth()->user()->name ?? 'Courier' }}!</h3>
                            <p class="text-light mb-0">Track your parcels and recent activity.</p>
                        </div>
                        <div class="d-flex align-items-center gap-3 mt-3 mt-md-0">
                            <div
                                class="stat-badge bg-white text-dark px-3 py-2 rounded shadow-sm d-flex align-items-center">
                                <div class="stat-icon bg-primary text-white me-2">
                                    <i class="fa fa-box"></i>
                                </div>
                                <div>
                                    <small class="d-block text-muted">Assigned Parcels</small>
                                    <div class="fw-bold fs-5">{{ count($assignedParcelIds) }}</div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Status Cards -->
        <div class="row g-3 mb-4">
            @php
                $statusClasses = [
                    'Total Parcels' => 'stat-card-blue',
                    'Delivered' => 'stat-card-green',
                    'In Transit' => 'stat-card-orange',
                    'Pending' => 'stat-card-purple',
                ];
                $statusIcons = [
                    'Total Parcels' => 'fa-box',
                    'Delivered' => 'fa-check-circle',
                    'In Transit' => 'fa-truck',
                    'Pending' => 'fa-clock',
                ];
                $statusValues = [
                    'Total Parcels' => count($assignedParcelIds),
                    'Delivered' => $statusCounts['delivered'] ?? 0,
                    'In Transit' => $statusCounts['in_transit'] ?? 0,
                    'Pending' => $statusCounts['pending'] ?? 0,
                ];
            @endphp

            @foreach ($statusValues as $label => $value)
                <div class="col-12 col-md-6 col-xl-3">
                    <div class="stat-card {{ $statusClasses[$label] }} shadow-sm hover-scale">
                        <div class="stat-card-icon bg-white text-dark">
                            <i class="fa {{ $statusIcons[$label] }}"></i>
                        </div>
                        <div>
                            <small class="stat-label text-muted">{{ $label }}</small>
                            <div class="stat-value">{{ $value }}</div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>

        <!-- Main Content -->
        <div class="row g-4">

            <!-- Recent Parcels -->
            <div class="col-12 col-lg-7">
                <div class="dashboard-card shadow-sm">
                    <h5 class="card-title mb-4">Recent Parcels</h5>

                    @if ($recentParcels->isEmpty())
                        <p class="text-muted">You have no parcels yet.</p>
                    @else
                        <div class="table-responsive">
                            <table class="table table-hover table-sm align-middle">
                                <thead class="table-light">
                                    <tr>
                                        <th>#</th>
                                        <th>Tracking ID</th>
                                        <th>Status</th>
                                        <th>From</th>
                                        <th>To</th>
                                        <th>Date</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($recentParcels as $parcel)
                                        <tr class="hover-row">
                                            <td>{{ $parcel->id }}</td>
                                            <td>{{ $parcel->tracking_id ?? '-' }}</td>
                                            <td>
                                                <span
                                                    class="badge {{ $parcel->status === 'delivered' ? 'bg-success' : ($parcel->status === 'in_transit' ? 'bg-warning text-dark' : ($parcel->status === 'pending' ? 'bg-secondary' : 'bg-info')) }}">
                                                    {{ ucfirst(str_replace('_', ' ', $parcel->status)) }}
                                                </span>
                                            </td>
                                            <td>{{ $parcel->fromBranch->name ?? '-' }}</td>
                                            <td>{{ $parcel->toBranch->name ?? '-' }}</td>
                                            <td>{{ \Carbon\Carbon::parse($parcel->created_at)->format('M d, Y') }}</td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    @endif
                </div>
            </div>

            <!-- Last 7 Days Activity -->
            <div class="col-12 col-lg-5">
                <div class="dashboard-card shadow-sm">
                    <h5 class="card-title mb-4">Activity (Last 7 days delivered)</h5>
                    <ul class="list-group list-group-flush">
                        @foreach ($last7 as $day)
                            <li class="list-group-item d-flex justify-content-between align-items-center hover-scale">
                                <span>{{ $day['label'] }}</span>
                                <span class="badge bg-gradient-primary rounded-pill">{{ $day['count'] }}</span>
                            </li>
                        @endforeach
                    </ul>
                </div>
            </div>
        </div>

    </div>

    <style>
        .welcome-card {
            background: linear-gradient(135deg, #e49271 0%, #d69d68 100%);
            color: #fff;
            padding: 1.5rem;
            border-radius: 12px;
            transition: transform 0.3s ease;
        }

        .welcome-card:hover {
            transform: translateY(-5px);
        }

        .stat-card {
            background: #fff;
            padding: 1rem;
            border-radius: 10px;
            display: flex;
            gap: 1rem;
            align-items: center;
            border-left: 4px solid;
            transition: transform 0.2s ease, box-shadow 0.2s ease;
        }

        .hover-scale:hover {
            transform: translateY(-4px);
            box-shadow: 0 6px 12px rgba(0, 0, 0, 0.1);
        }

        .stat-card-icon {
            width: 48px;
            height: 48px;
            border-radius: 8px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.2rem;
        }

        .stat-card-blue {
            border-color: #3b82f6;
            color: #3b82f6;
        }

        .stat-card-green {
            border-color: #10b981;
            color: #10b981;
        }

        .stat-card-orange {
            border-color: #f59e0b;
            color: #f59e0b;
        }

        .stat-card-purple {
            border-color: #f6955c;
            color: #8b5cf6;
        }

        .stat-card-teal {
            border-color: #14b8a6;
            color: #14b8a6;
        }

        .stat-value {
            font-size: 1.5rem;
            font-weight: 700
        }

        .dashboard-card {
            background: #fff;
            padding: 1.25rem;
            border-radius: 10px
        }

        .hover-row:hover {
            background-color: rgba(59, 130, 246, 0.05);
        }

        .bg-gradient-primary {
            background: linear-gradient(90deg, #e6bea4, #e09070);
            color: #fff;
        }
    </style>
</x-layout.courier-app>
