<x-layout.app header="{{ __('Dashboard') }}">
<div class="container-fluid mt-4">

    <!-- Welcome Card -->
    <div class="row mb-4">
        <div class="col-12">
            <div class="card shadow border-0 rounded-3" style="">
                <div class="card-body d-flex flex-column flex-md-row justify-content-between align-items-center">
                    <div>
                        {{-- <h4>Welcome, {{ session('login_name') }}!</h4> --}}
                        <h4 class="fw-bold">Welcome, Superadmin!</h4>
                        <p class="mb-0">Use the menu to manage your courier tasks.</p>
                    </div>
                    <i class="fa fa-truck fa-3x opacity-75 mt-3 mt-md-0"></i>
                </div>
            </div>
        </div>
    </div>

    <!-- Stats Cards -->
    <div class="row g-4">

        <!-- Total Branches -->
        <div class="col-12 col-sm-6 col-md-4">
            <div class="card shadow-sm border-0 rounded-3 hover-card">
                <div class="card-body d-flex align-items-center justify-content-between">
                    <div>
                        {{-- <h3 class="mb-1">{{ \DB::table('branches')->count() }}</h3> --}}
                        <p class="mb-0 text-muted fw-semibold">Total Branches</p>
                    </div>
                    <i class="fa fa-building fa-2x" style="color: #e8634b;"></i>
                </div>
            </div>
        </div>

        <!-- Total Parcels -->
        <div class="col-12 col-sm-6 col-md-4">
            <div class="card shadow-sm border-0 rounded-3 hover-card">
                <div class="card-body d-flex align-items-center justify-content-between">
                    <div>
                        {{-- <h3 class="mb-1">{{ \DB::table('parcels')->count() }}</h3> --}}
                        <p class="mb-0 text-muted fw-semibold">Total Parcels</p>
                    </div>
                    <i class="fa fa-boxes fa-2x" style="color: #e8634b;"></i>
                </div>
            </div>
        </div>

        <!-- Total Staff -->
        <div class="col-12 col-sm-6 col-md-4">
            <div class="card shadow-sm border-0 rounded-3 hover-card">
                <div class="card-body d-flex align-items-center justify-content-between">
                    <div>
                        {{-- <h3 class="mb-1">{{ \DB::table('users')->where('type', '!=', 1)->count() }}</h3> --}}
                        <p class="mb-0 text-muted fw-semibold">Total Staff</p>
                    </div>
                    <i class="fa fa-users fa-2x" style="color: #e8634b;"></i>
                </div>
            </div>
        </div>

    </div>

</div>

<style>
    /* Hover effect for cards */
    .hover-card {
        transition: all 0.3s ease;
        cursor: pointer;
        background-color: #fff;
    }
    .hover-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 15px 30px rgba(0,0,0,0.1);
    }

    /* Card rounded corners */
    .card {
        border-radius: 12px !important;
    }

    /* Text muted custom */
    .text-muted {
        color: #555 !important;
    }

    /* Responsive icon sizing */
    @media(max-width: 768px){
        .card-body i {
            font-size: 1.5rem !important;
        }
    }
</style>

</x-layout.app>
