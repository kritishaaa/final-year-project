<x-layout.app header="Parcel List">

    <div class="card p-3 mb-4">
        <div class="d-flex justify-content-between align-items-center">
            <h5 class="text-primary fw-bold mb-0">Parcels</h5>
            <a href="{{ route('admin.parcels.create') }}" class="btn btn-info d-flex align-items-center">
                <i class="bx bx-plus me-1"></i>
                Add Parcel
            </a>
        </div>
    </div>

    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-4 p-4">
        @foreach ($parcels as $parcel)
            @php
                $statusColors = [
                    'pending' => 'bg-amber-500',
                    'in_transit' => 'bg-blue-500',
                    'delivered' => 'bg-emerald-500',
                ];
                $statusBadgeColors = [
                    'pending' => 'bg-amber-100 text-amber-700',
                    'in_transit' => 'bg-blue-100 text-blue-700',
                    'delivered' => 'bg-emerald-100 text-emerald-700',
                ];
            @endphp

            <div
                class="bg-white rounded-xl shadow-sm hover:shadow-lg transition-all duration-300 border border-gray-200 overflow-hidden group">
                {{-- Status Indicator Bar --}}
                <div class="h-1.5 {{ $statusColors[$parcel->status] ?? 'bg-gray-400' }}"></div>

                {{-- Card Content --}}
                <div class="p-4">
                    {{-- Header --}}
                    <div class="flex items-center justify-between mb-4">
                        <div class="flex items-center gap-2">
                            <div
                                class="w-10 h-10 bg-gradient-to-br from-blue-500 to-blue-600 rounded-lg flex items-center justify-center shadow-sm">
                                <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4" />
                                </svg>
                            </div>
                            <div>
                                <p class="text-xs text-gray-500 font-medium">Tracking ID</p>
                                <h3 class="text-sm font-bold text-gray-900 font-mono">#{{ $parcel->tracking_code }}</h3>
                            </div>
                        </div>
                        <span
                            class="text-xs px-2.5 py-1 rounded-full font-semibold {{ $statusBadgeColors[$parcel->status] ?? 'bg-gray-100 text-gray-700' }}">
                            {{ ucfirst(str_replace('_', ' ', $parcel->status)) }}
                        </span>
                    </div>

                    {{-- Route Information --}}
                    <div class="mb-4 bg-gradient-to-r from-gray-50 to-gray-100 rounded-lg p-3 border border-gray-200">
                        <div class="space-y-2">
                            {{-- From --}}
                            <div class="flex items-start gap-2">
                                <div class="mt-0.5">
                                    <div class="w-6 h-6 bg-blue-100 rounded-full flex items-center justify-center">
                                        <div class="w-2.5 h-2.5 bg-blue-500 rounded-full"></div>
                                    </div>
                                </div>
                                <div class="flex-1 min-w-0">
                                    <p class="text-xs font-semibold text-gray-900 truncate">{{ $parcel->sender_name }}</p>
                                    <p class="text-xs text-gray-600 truncate">From: {{ $parcel->fromBranch->name ?? 'N/A' }}</p>
                                </div>
                            </div>

                            {{-- Connector Line --}}
                            <div class="flex items-center gap-2 pl-3">
                                <div class="w-px h-4 bg-gray-300"></div>
                                <svg class="w-4 h-4 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M19 14l-7 7m0 0l-7-7m7 7V3" />
                                </svg>
                            </div>

                            {{-- To --}}
                            <div class="flex items-start gap-2">
                                <div class="mt-0.5">
                                    <div class="w-6 h-6 bg-green-100 rounded-full flex items-center justify-center">
                                        <svg class="w-3.5 h-3.5 text-green-600" fill="none" stroke="currentColor"
                                            viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z" />
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M15 11a3 3 0 11-6 0 3 3 0 016 0z" />
                                        </svg>
                                    </div>
                                </div>
                                <div class="flex-1 min-w-0">
                                    <p class="text-xs font-semibold text-gray-900 truncate">{{ $parcel->recipient_name }}</p>
                                    <p class="text-xs text-gray-600 truncate">Destination</p>
                                </div>
                            </div>
                        </div>
                    </div>

                    {{-- Parcel Details --}}
                    <div class="flex items-center justify-between mb-4 pb-3 border-b border-gray-100">
                        <div class="flex items-center gap-4 text-sm">
                            <div class="flex items-center gap-1.5 text-gray-600">
                                <svg class="w-4 h-4 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M3 6l3 1m0 0l-3 9a5.002 5.002 0 006.001 0M6 7l3 9M6 7l6-2m6 2l3-1m-3 1l-3 9a5.002 5.002 0 006.001 0M18 7l3 9m-3-9l-6-2m0-2v2m0 16V5m0 16H9m3 0h3" />
                                </svg>
                                <span class="font-semibold text-gray-700">{{ number_format($parcel->weight, 1) }} kg</span>
                            </div>
                            <div class="w-px h-4 bg-gray-300"></div>
                            <div class="flex items-center gap-1.5 text-gray-600">
                                <svg class="w-4 h-4 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                                </svg>
                                <span class="font-bold text-gray-900">₹{{ number_format($parcel->price, 2) }}</span>
                            </div>
                        </div>
                    </div>

                    {{-- Action Buttons --}}
                    <div class="flex gap-2">
                        <a href="{{ route('admin.parcels.view', $parcel->id) }}"
                            class="flex-1 flex items-center justify-center gap-1.5 bg-white border-2 border-blue-600 text-blue-600 py-2.5 rounded-lg hover:bg-blue-50 transition-all duration-200 font-semibold text-sm group">
                            <svg class="w-4 h-4 group-hover:scale-110 transition-transform" fill="none"
                                stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                            </svg>
                            View
                        </a>

                        <a href="{{ route('admin.parcels.edit', $parcel->id) }}"
                            class="flex-1 flex items-center justify-center gap-1.5 bg-gradient-to-r from-gray-600 to-gray-700 hover:from-gray-700 hover:to-gray-800 text-white py-2.5 rounded-lg transition-all duration-200 font-semibold text-sm shadow-sm hover:shadow-md group">
                            <svg class="w-4 h-4 group-hover:scale-110 transition-transform" fill="none"
                                stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                            </svg>
                            Edit
                        </a>

                        <form action="{{ route('admin.parcels.destroy', $parcel->id) }}" method="POST" class="flex-1"
                            onsubmit="return confirm('Are you sure you want to delete this parcel?');">
                            @csrf
                            @method('DELETE')
                            <button type="submit"
                                class="w-full flex items-center justify-center gap-1.5 bg-gradient-to-r from-red-500 to-red-600 hover:from-red-600 hover:to-red-700 text-white py-2.5 rounded-lg transition-all duration-200 font-semibold text-sm shadow-sm hover:shadow-md group">
                                <svg class="w-4 h-4 group-hover:scale-110 transition-transform" fill="none"
                                    stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                </svg>
                                Delete
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        @endforeach
    </div>

    <div class="mt-4 px-4">
        {{ $parcels->links() }} {{-- Pagination --}}
    </div>
</x-layout.app>