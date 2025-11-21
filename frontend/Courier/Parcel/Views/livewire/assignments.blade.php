<div>

    <div class="flex justify-end mb-4">
        <button wire:click="optimizeRoute"
            class="px-4 py-2 bg-green-600 hover:bg-green-700 text-white rounded-lg shadow-sm font-semibold transition">
            Optimize Route
        </button>
        <button onclick="printPDF()" class="ms-2 px-4 py-2 bg-blue-600 text-white rounded">
            Print Route
        </button>
        <div id="pdfLoader" style="display:none;">Generating PDF...</div>
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
    <div id="printArea">
        @if (!empty($optimizedAssignments))
            <div class="mt-6 p-6 bg-gradient-to-r from-blue-50 to-blue-100 rounded-xl shadow-lg border border-gray-200">
                <h3 class="font-extrabold text-gray-800 mb-4 text-xl">Optimized Route Summary</h3>
                <p class="text-lg font-semibold text-gray-700">Total Distance: <span
                        class="font-bold text-indigo-600">{{ number_format($totalDistance, 2) }} km</span></p>
                <p class="text-lg font-semibold text-gray-700">Total Price: <span class="font-bold text-green-600">Rs.
                        {{ number_format($totalPrice, 2) }}</span></p>

                <div class="mt-6 grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
                    @foreach ($optimizedAssignments as $assignment)
                        @php $parcel = $assignment['parcel']; @endphp

                        <div
                            class="p-4 bg-white border border-gray-300 rounded-lg shadow-md hover:shadow-xl transition-shadow duration-300">
                            <h4 class="font-semibold text-xl text-blue-700">#{{ $parcel['tracking_code'] }}</h4>
                            <p class="text-sm text-gray-600">Recipient: <span
                                    class="font-medium text-gray-800">{{ $parcel['recipient_name'] }}</span></p>
                            <p class="text-sm text-gray-600 truncate">Address: {{ $parcel['recipient_address'] }}</p>
                            <p class="text-sm text-gray-600 truncate">Phone: {{ $parcel['sender_contact'] }}</p>
                            <p class="text-sm text-gray-500">Distance from last stop: <span
                                    class="font-semibold text-blue-500">{{ number_format($parcel['distance'], 2) }}
                                    km</span></p>
                        </div>
                    @endforeach
                </div>
            </div>

        @endif

        <div class="mb-3">

            {{-- <h2 class="mb-4">Optimized Delivery Route</h2> --}}

            {{-- Summary of optimized route --}}
            @if (!empty($optimizedAssignments))
                <div
                    class="mt-6 p-6 bg-gradient-to-r from-blue-50 to-blue-100 rounded-xl shadow-lg border border-gray-200">
                    <h4 class="text-2xl font-semibold text-gray-800 mb-4">
                        <h2 class="text-2xl font-semibold text-gray-800 mb-4">Optimized Delivery Route</h2>
                    </h4>
                    <ol class="space-y-4">
                        @foreach ($optimizedAssignments as $item)
                            <li
                                class="p-4 bg-white border border-gray-300 rounded-lg shadow-md hover:shadow-xl transition-all duration-300">
                                <div class="flex justify-between items-center">
                                    <span
                                        class="font-semibold text-indigo-600">{{ $item['parcel']['tracking_code'] }}</span>
                                    <span
                                        class="font-medium text-gray-800">{{ $item['parcel']['recipient_name'] }}</span>
                                </div>
                                <div class="mt-2 text-xs text-gray-500">
                                    <span>Coordinates: </span>
                                    <span
                                        class="font-semibold text-blue-500">({{ $item['parcel']['destination_latitude'] }},
                                        {{ $item['parcel']['destination_longitude'] }})</span>
                                </div>
                            </li>
                        @endforeach
                    </ol>
                </div>

                {{-- MAP CONTAINER --}}
            @else
                <div class="alert alert-info" style="color: #000;">No route available.</div>
            @endif
            <div wire:ignore class="mt-4">
                <div id="routeMap" style="height: 450px; width: 100%;" class="rounded shadow-sm"></div>
            </div>

        </div>
    </div>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/html2canvas/1.4.1/html2canvas.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.5.1/jspdf.umd.min.js"></script>

    <script src="https://rawcdn.githack.com/mapbox/leaflet-image/gh-pages/leaflet-image.js"></script>

    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css">
    <script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"></script>
    <script>
        let optimizedRouteData = [];
        let map; // Make map global for printing

        document.addEventListener("livewire:initialized", () => {
            Livewire.on("route-optimized", (data) => {
                optimizedRouteData = data.route;
                loadRouteMap();
            });
        });

        function loadRouteMap() {
            const container = document.getElementById("routeMap");
            if (!container) return;
            if (!optimizedRouteData || optimizedRouteData.length === 0) return;

            // Reset map if it exists
            if (container._leaflet_id) container._leaflet_id = null;

            // Initialize map
            map = L.map("routeMap").setView(
                [optimizedRouteData[0].parcel.destination_latitude, optimizedRouteData[0].parcel.destination_longitude],
                13
            );

            L.tileLayer("https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png", {
                maxZoom: 22
            }).addTo(map);

            let points = [];

            // Courier Base
            const branch = {
                lat: {{ $courier->branch->latitude }},
                lng: {{ $courier->branch->longitude }}
            };
            points.push([branch.lat, branch.lng]);

            const baseIcon = L.icon({
                iconUrl: '/icons/base.png',
                iconSize: [35, 35]
            });
            L.marker([branch.lat, branch.lng], {
                    icon: baseIcon
                })
                .addTo(map)
                .bindPopup("Courier Base")
                .bindTooltip("Base", {
                    permanent: true,
                    direction: "top"
                });

            // Stop markers
            const stopIcon = L.icon({
                iconUrl: '/icons/stop.png',
                iconSize: [25, 25]
            });

            optimizedRouteData.forEach((item, index) => {
                const lat = item.parcel.destination_latitude;
                const lng = item.parcel.destination_longitude;
                points.push([lat, lng]);

                L.marker([lat, lng], {
                        icon: stopIcon
                    })
                    .addTo(map)
                    .bindPopup(`Stop ${index + 1}: ${item.parcel.tracking_code}`)
                    .bindTooltip(`${index + 1}`, {
                        permanent: true,
                        direction: "top"
                    });
            });

            // Road route with OSRM
            const osrmCoordString = points.map(p => `${p[1]},${p[0]}`).join(";");
            const osrmUrl =
                `https://router.project-osrm.org/route/v1/driving/${osrmCoordString}?overview=full&geometries=geojson`;

            fetch(osrmUrl)
                .then(res => res.json())
                .then(data => {
                    if (!data.routes || !data.routes.length) return;
                    const geojson = data.routes[0].geometry;
                    L.geoJSON(geojson, {
                        style: {
                            color: "blue",
                            weight: 4
                        }
                    }).addTo(map);
                    map.fitBounds(L.geoJSON(geojson).getBounds());
                })
                .catch(err => console.error("OSRM error:", err));
        }
    </script>

    <script>
        async function printPDF() {
            const {
                jsPDF
            } = window.jspdf;

            // Select the content
            const element = document.getElementById("printArea");

            // Disable tooltips/popups for clean print
            document.querySelectorAll('.leaflet-tooltip').forEach(el => el.style.display = 'none');
            document.querySelectorAll('.leaflet-popup').forEach(el => el.style.display = 'none');

            // Capture screenshot
            const canvas = await html2canvas(element, {
                useCORS: true,
                scale: 2, // high quality
                logging: false,
                allowTaint: true
            });

            const imgData = canvas.toDataURL("image/png");
            const pdf = new jsPDF("p", "mm", "a4");

            const pdfWidth = pdf.internal.pageSize.getWidth();
            const pdfHeight = (canvas.height * pdfWidth) / canvas.width;

            pdf.addImage(imgData, "PNG", 0, 0, pdfWidth, pdfHeight);

            pdf.save("route-print.pdf");
        }
    </script>

</div>