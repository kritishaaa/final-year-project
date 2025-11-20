<x-layout.app header="Parcel List">

    <div class="card p-3">
        <div class="d-flex justify-content-between align-items-center">
            <h5 class="text-primary fw-bold mb-0">Parcels</h5>
            <a href="{{ route('admin.parcels.create') }}" class="btn btn-info d-flex align-items-center">
                <i class="bx bx-plus me-1"></i>
                Add Parcel
            </a>
        </div>
    </div>

    <div class="container mx-auto px-4 py-8">
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
            @foreach ($parcels as $parcel)
                <div
                    class="bg-white rounded-lg shadow-md hover:shadow-xl transition-shadow duration-300 overflow-hidden border border-gray-200">
                    <!-- Header with Tracking Code and Status -->
                    <div class="bg-gradient-to-r from-blue-500 to-blue-600 text-white px-6 py-4">
                        <div class="flex justify-between items-start">
                            <div>
                                <p class="text-xs font-semibold uppercase tracking-wide opacity-90">Tracking Code</p>
                                <p class="text-lg font-bold mt-1">{{ $parcel->tracking_code }}</p>
                            </div>
                            <span
                                class="px-3 py-1 rounded-full text-xs font-semibold
                        @if ($parcel->status == 'delivered') bg-green-100 text-green-800
                        @elseif($parcel->status == 'in_transit') bg-yellow-100 text-yellow-800
                        @elseif($parcel->status == 'pending') bg-gray-100 text-gray-800
                        @else bg-blue-100 text-blue-800 @endif">
                                {{ ucfirst(str_replace('_', ' ', $parcel->status)) }}
                            </span>
                        </div>
                    </div>

                    <!-- Parcel Details -->
                    <div class="px-6  pt-3 space-y-4">
                        <!-- Sender & Recipient -->
                        <div class="d-flex justify-content-between gap-3">
                            <!-- Sender -->
                            <div class="flex-grow-1 d-flex align-items-start gap-2 p-2 border rounded bg-light"
                                style="height: 80px; overflow: hidden;" data-bs-toggle="tooltip"
                                title="{{ $parcel->sender_name }}">
                                <svg class="w-5 h-5 text-gray-400 flex-shrink-0" fill="none" stroke="currentColor"
                                    viewBox="0 0 24 24" width="24" height="24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                                </svg>
                                <div class="text-truncate">
                                    <p class="text-muted small mb-0">Sender</p>
                                    <p class="fw-bold mb-0 text-truncate">{{ $parcel->sender_name }}</p>
                                </div>
                            </div>

                            <!-- Recipient -->
                            <div class="flex-grow-1 d-flex align-items-start gap-2 p-2 border rounded bg-light"
                                style="height: 80px; overflow: hidden;" data-bs-toggle="tooltip"
                                title="{{ $parcel->recipient_name }}">
                                <svg class="w-5 h-5 text-gray-400 flex-shrink-0" fill="none" stroke="currentColor"
                                    viewBox="0 0 24 24" width="24" height="24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z" />
                                </svg>
                                <div class="text-truncate">
                                    <p class="text-muted small mb-0">Recipient</p>
                                    <p class="fw-bold mb-0 text-truncate">{{ $parcel->recipient_name }}</p>
                                </div>
                            </div>
                        </div>

                        <!-- Branch, Weight, Price -->
                        <div class="pt-3 border-t border-gray-100 space-y-2">
                            <div class="flex justify-between items-center">
                                <span class="text-xs text-gray-500">From Branch:</span>
                                <span
                                    class="text-sm font-medium text-gray-700">{{ $parcel->fromBranch->name ?? 'N/A' }}</span>
                            </div>
                            <div class="flex justify-between items-center">
                                <span class="text-xs text-gray-500">Weight:</span>
                                <span class="text-sm font-medium text-gray-700">{{ $parcel->weight }} kg</span>
                            </div>
                            <div class="flex justify-between items-center">
                                <span class="text-xs text-gray-500">Price:</span>
                                <span
                                    class="text-lg font-bold text-blue-600">₹{{ number_format($parcel->price, 2) }}</span>
                            </div>
                        </div>
                    </div>

                    <!-- Action Buttons -->
                    <div class="px-6 py-4 bg-gray-50 border-t border-gray-200 flex gap-2">
                        <a href="{{ route('admin.parcels.view', $parcel->id) }}"
                            class="flex-1 bg-blue-500 hover:bg-blue-600 text-white text-center py-2 px-4 rounded-md text-sm font-medium transition-colors duration-200">
                            View
                        </a>
                        <a href="{{ route('admin.parcels.edit', $parcel->id) }}"
                            class="flex-1 bg-gray-600 hover:bg-gray-700 text-white text-center py-2 px-4 rounded-md text-sm font-medium transition-colors duration-200">
                            Edit
                        </a>
                        <form action="{{ route('admin.parcels.destroy', $parcel->id) }}" method="POST" class="flex-1"
                            onsubmit="return confirm('Are you sure you want to delete this parcel?');">
                            @csrf
                            @method('DELETE')
                            <button type="submit"
                                class="w-full bg-red-500 hover:bg-red-600 text-white py-2 px-4 rounded-md text-sm font-medium transition-colors duration-200">
                                Delete
                            </button>
                        </form>
                    </div>
                </div>
            @endforeach
        </div>
    </div>

    <div class="mt-4">
        {{ $parcels->links() }} {{-- Pagination --}}
    </div>
</x-layout.app>
