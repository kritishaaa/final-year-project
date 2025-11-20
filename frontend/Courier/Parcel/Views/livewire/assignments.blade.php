<div>

    <div class="flex justify-end mb-4">
        <button wire:click="optimizeRoute"
            class="px-4 py-2 bg-green-600 hover:bg-green-700 text-white rounded-lg shadow-sm font-semibold transition">
            Optimize Route
        </button>
    </div>
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-4 p-4">


        @foreach ($assignments as $assignment)
            @php
                $parcel = $assignment->parcel;

                $statusColors = [
                    'assigned' => 'bg-blue-500',
                    'picked' => 'bg-amber-500',
                    'in_transit' => 'bg-purple-500',
                    'delivered' => 'bg-emerald-500',
                    'returned' => 'bg-rose-500',
                ];

                $statusBadgeColors = [
                    'assigned' => 'bg-blue-100 text-blue-700',
                    'picked' => 'bg-amber-100 text-amber-700',
                    'in_transit' => 'bg-purple-100 text-purple-700',
                    'delivered' => 'bg-emerald-100 text-emerald-700',
                    'returned' => 'bg-rose-100 text-rose-700',
                ];
            @endphp

            <div
                class="bg-white rounded-xl shadow-sm hover:shadow-lg transition-all duration-300 border border-gray-200 overflow-hidden group">

                {{-- Top Status Color Bar --}}
                <div class="h-1.5 {{ $statusColors[$assignment->status] ?? 'bg-gray-400' }}"></div>

                <div class="p-4">

                    {{-- Header With View Button --}}
                    <div class="flex items-center justify-between mb-4">

                        <div class="flex items-center gap-2">
                            <div
                                class="w-10 h-10 bg-gradient-to-br from-blue-500 to-blue-600 rounded-lg flex items-center justify-center shadow-sm">
                                <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor"
                                    viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4" />
                                </svg>
                            </div>
                            <div>
                                <p class="text-xs text-gray-500 font-medium">Tracking ID</p>
                                <h3 class="text-sm font-bold text-gray-900 font-mono">#{{ $parcel->tracking_code }}</h3>
                                <span
                                    class="text-xs px-2.5 py-1 rounded-full font-semibold {{ $statusBadgeColors[$assignment->status] ?? 'bg-gray-100 text-gray-700' }}">
                                    {{ ucfirst(str_replace('_', ' ', $assignment->status)) }}
                                </span>
                            </div>
                        </div>

                        <div class="flex items-center gap-2">

                            {{-- View Button --}}
                            <a href="{{ route('courier.parcels.view', $assignment->parcel->id) }}"
                                class="px-3 py-1 text-xs bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition font-semibold shadow-sm">
                                View
                            </a>

                            {{-- Status Badge --}}

                        </div>

                    </div>

                    {{-- Sender → Recipient --}}
                    <div class="mb-4 bg-gradient-to-r from-gray-50 to-gray-100 rounded-lg p-3 border border-gray-200">
                        <div class="space-y-2">

                            {{-- FROM --}}
                            <div class="flex items-start gap-2">
                                <div class="mt-0.5">
                                    <div class="w-6 h-6 bg-blue-100 rounded-full flex items-center justify-center">
                                        <div class="w-2.5 h-2.5 bg-blue-500 rounded-full"></div>
                                    </div>
                                </div>
                                <div class="flex-1 min-w-0">
                                    <p class="text-xs font-semibold text-gray-900 truncate">{{ $parcel->sender_name }}
                                    </p>
                                    <p class="text-xs text-gray-600 truncate">{{ $parcel->sender_address ?? '-' }}</p>
                                </div>
                            </div>

                            {{-- Connector --}}
                            <div class="flex items-center gap-2 pl-3">
                                <div class="w-px h-4 bg-gray-300"></div>
                                <svg class="w-4 h-4 text-gray-400" fill="none" stroke="currentColor"
                                    viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M19 14l-7 7m0 0l-7-7m7 7V3" />
                                </svg>
                            </div>

                            {{-- TO --}}
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
                                    <p class="text-xs font-semibold text-gray-900 truncate">
                                        {{ $parcel->recipient_name }}
                                    </p>
                                    <p class="text-xs text-gray-600 truncate">{{ $parcel->recipient_address }}</p>
                                </div>
                            </div>

                        </div>
                    </div>

                    {{-- Weight + Price --}}
                    <div class="flex items-center justify-between mb-4 pb-3 border-b border-gray-100">
                        <div class="flex items-center gap-4 text-sm">

                            <div class="flex items-center gap-1.5 text-gray-600">
                                <svg class="w-4 h-4 text-gray-400" fill="none" stroke="currentColor"
                                    viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M3 6l3 1m0 0l-3 9a5.002 5.002 0 006.001 0M6 7l3 9M6 7l6-2m6 2l3-1m-3 1l-3 9a5.002 5.002 0 006.001 0M18 7l3 9m-3-9l-6-2m0-2v2m0 16V5m0 16H9m3 0h3" />
                                </svg>
                                <span class="font-semibold text-gray-700">{{ number_format($parcel->weight, 1) }}
                                    kg</span>
                            </div>

                            <div class="w-px h-4 bg-gray-300"></div>

                            <div class="flex items-center gap-1.5 text-gray-600">
                                <svg class="w-4 h-4 text-gray-400" fill="none" stroke="currentColor"
                                    viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                                </svg>
                                <span class="font-bold text-gray-900">Rs. {{ number_format($parcel->price, 2) }}</span>
                            </div>

                        </div>
                    </div>

                    {{-- Status Update --}}
                    <form wire:submit.prevent="updateStatus({{ $assignment->id }}, $event.target.status.value)"
                        class="flex gap-2">

                        <select name="status" class="flex-1 px-3 py-2 text-sm border rounded-lg">
                            @foreach ($statusBadgeColors as $key => $label)
                                <option value="{{ $key }}"
                                    {{ $assignment->status === $key ? 'selected' : '' }}>
                                    {{ ucfirst(str_replace('_', ' ', $key)) }}
                                </option>
                            @endforeach
                        </select>

                        <button type="submit"
                            class="px-4 py-2 bg-blue-600 hover:bg-blue-700 text-white text-sm rounded-lg font-semibold shadow-sm transition-all">
                            Update
                        </button>

                    </form>

                </div>
            </div>
        @endforeach
    </div>
    @if (!empty($optimizedAssignments))
        <div class="mt-6 p-4 bg-gray-50 rounded-lg border border-gray-200">
            <h3 class="font-bold text-gray-800 mb-2">Optimized Route Summary</h3>
            <p>Total Distance: <span class="font-semibold">{{ number_format($totalDistance, 2) }} km</span></p>
            <p>Total Price: <span class="font-semibold">Rs. {{ number_format($totalPrice, 2) }}</span></p>

            <div class="mt-4 grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-4">
                @foreach ($optimizedAssignments as $assignment)
                    @php $parcel = $assignment['parcel']; @endphp
                    <div class="p-3 bg-white border rounded-lg shadow-sm">
                        <h4 class="font-bold">#{{ $parcel['tracking_code'] }}</h4>
                        <p class="text-sm text-gray-600">Recipient: {{ $parcel['recipient_name'] }}</p>
                        <p class="text-sm text-gray-600 truncate">Address: {{ $parcel['recipient_address'] }}</p>
                        <p class="text-sm text-gray-500">Distance from last stop:
                            {{ number_format($parcel['distance'], 2) }} km
                        </p>
                    </div>
                @endforeach
            </div>
        </div>
    @endif

    <div class="container py-5">

        <h2 class="mb-4">Optimized Delivery Route</h2>

        {{-- Summary of optimized route --}}
        @if (!empty($optimizedAssignments))
            <div class="card shadow-sm mb-4">
                <div class="card-body">
                    <h4 class="mb-3">Route Order</h4>
                    <ol>
                        @foreach ($optimizedAssignments as $item)
                            <li>
                                <strong>{{ $item['parcel']['tracking_code'] }}</strong>
                                — {{ $item['parcel']['recipient_name'] }}
                                ({{ $item['parcel']['destination_latitude'] }},
                                {{ $item['parcel']['destination_longitude'] }})
                            </li>
                        @endforeach
                    </ol>
                </div>
            </div>

            {{-- MAP CONTAINER --}}
            <div id="routeMap" style="height: 450px; width: 100%;" class="rounded shadow-sm">
            </div>
        @else
            <div class="alert alert-info">No route available.</div>
        @endif

    </div>
    {{-- LEAFLET CSS/JS --}}
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css">
    <script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"></script>

    <script>
        function loadRouteMap() {
            let container = document.getElementById('routeMap');
            if (!container) return;

            const route = @json($optimizedAssignments);
            if (!route || !route.length) return;

            container.innerHTML = ""; // reset

            const branch = {
                lat: {{ $courier->branch->latitude }},
                lng: {{ $courier->branch->longitude }}
            };

            const map = L.map('routeMap').setView([route[0].parcel.destination_latitude, route[0].parcel
                .destination_longitude
            ], 13);

            L.tileLayer("https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png", {
                maxZoom: 22
            }).addTo(map);

            let points = [];

            points.push([branch.lat, branch.lng]);
            L.marker([branch.lat, branch.lng]).addTo(map).bindPopup("Courier Base");

            route.forEach((item, index) => {
                let lat = item.parcel.destination_latitude;
                let lng = item.parcel.destination_longitude;

                points.push([lat, lng]);
                L.marker([lat, lng]).addTo(map)
                    .bindPopup(`Stop ${index + 1}<br>${item.parcel.tracking_code}`);
            });

            L.polyline(points, {
                color: "blue"
            }).addTo(map);
            map.fitBounds(points);
        }

        // RUN after Livewire loads + updates
        document.addEventListener("livewire:load", loadRouteMap);
        Livewire.hook('message.processed', loadRouteMap);
    </script>

</div>
