<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use Src\Courier\Models\Courier;
use Src\Parcel\Models\Parcel;
use Src\Parcel\Models\ParcelTrack;

class DashboardController extends Controller
{


    public function __invoke()
    {

        $today = Carbon::today();
        $last7Days = collect();

        for ($i = 6; $i >= 0; $i--) {
            $date = $today->copy()->subDays($i);
            $dayName = $date->format('D');
            $count = Parcel::whereDate('created_at', $date->toDateString())->count();

            $last7Days->push([
                'day' => $dayName,
                'count' => $count
            ]);
        }

        $days = $last7Days->pluck('day');
        $counts = $last7Days->pluck('count');

        $topCouriers = Courier::withCount('parcelAssignments')
            ->orderByDesc('parcel_assignments_count')
            ->take(5)
            ->get();
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
        return view('admin.dashboard', compact('days', 'counts', 'topCouriers', 'topBranches', 'recentActivities'));
    }
}
