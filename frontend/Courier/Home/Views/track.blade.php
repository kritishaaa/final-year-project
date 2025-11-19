<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Parcel Details - Tracking System</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        :root {
            --primary: #0066cc;
            --primary-dark: #004fa3;
            --success: #10b981;
            --warning: #f59e0b;
            --danger: #ef4444;
            --info: #06b6d4;
            --light-bg: #f8fafc;
            --border-color: #e2e8f0;
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, 'Helvetica Neue', Arial, sans-serif;
            background: linear-gradient(135deg, #f5f7fa 0%, #e9ecef 100%);
            color: #1f2937;
            line-height: 1.6;
        }

        .container {
            max-width: 1400px;
            margin: 0 auto;
            padding: 2rem;
        }

        /* Header Section */
        .header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 2rem;
        }

        .header-left h1 {
            font-size: 2rem;
            font-weight: 700;
            color: #1f2937;
            margin-bottom: 0.5rem;
        }

        .header-left p {
            color: #6b7280;
            font-size: 0.95rem;
        }

        .header-right {
            display: flex;
            gap: 1rem;
        }

        .btn {
            padding: 0.75rem 1.5rem;
            border-radius: 0.5rem;
            border: none;
            cursor: pointer;
            font-size: 0.95rem;
            font-weight: 500;
            transition: all 0.3s ease;
            display: flex;
            align-items: center;
            gap: 0.5rem;
            text-decoration: none;
        }

        .btn-primary {
            background-color: var(--primary);
            color: white;
        }

        .btn-primary:hover {
            background-color: var(--primary-dark);
            transform: translateY(-2px);
            box-shadow: 0 8px 16px rgba(0, 102, 204, 0.2);
        }

        .btn-secondary {
            background-color: white;
            color: var(--primary);
            border: 2px solid var(--border-color);
        }

        .btn-secondary:hover {
            border-color: var(--primary);
            background-color: #f0f9ff;
        }

        /* Main Grid */
        .main-grid {
            display: grid;
            grid-template-columns: 2fr 1fr;
            gap: 2rem;
        }

        /* Card Styles */
        .card {
            background: white;
            border-radius: 1rem;
            padding: 1.5rem;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.07);
            transition: all 0.3s ease;
            margin-bottom: 2rem;
        }

        .card:hover {
            box-shadow: 0 12px 24px rgba(0, 0, 0, 0.1);
            transform: translateY(-4px);
        }

        .card-header {
            display: flex;
            align-items: center;
            gap: 1rem;
            margin-bottom: 1.5rem;
            padding-bottom: 1rem;
            border-bottom: 2px solid var(--light-bg);
        }

        .card-header h3 {
            font-size: 1.25rem;
            font-weight: 600;
            color: #1f2937;
        }

        .icon {
            width: 40px;
            height: 40px;
            display: flex;
            align-items: center;
            justify-content: center;
            border-radius: 0.75rem;
            font-size: 1.5rem;
        }

        .icon-primary {
            background-color: #dbeafe;
            color: var(--primary);
        }

        .icon-success {
            background-color: #dcfce7;
            color: var(--success);
        }

        /* Tracking Info */
        .tracking-info {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 2rem;
            align-items: center;
        }

        .tracking-item {
            display: flex;
            gap: 1rem;
        }

        .tracking-code {
            font-size: 1.75rem;
            font-weight: 700;
            color: var(--primary);
            word-break: break-all;
        }

        .status-badge {
            display: inline-block;
            padding: 0.5rem 1.25rem;
            border-radius: 9999px;
            font-size: 0.9rem;
            font-weight: 600;
            white-space: nowrap;
        }

        .status-delivered {
            background-color: #dcfce7;
            color: var(--success);
        }

        .status-transit {
            background-color: #cffafe;
            color: var(--info);
        }

        .status-pending {
            background-color: #fef3c7;
            color: #92400e;
        }

        .status-cancelled {
            background-color: #fee2e2;
            color: var(--danger);
        }

        /* Two Column Cards */
        .two-col {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 2rem;
        }

        .info-row {
            margin-bottom: 1.5rem;
        }

        .info-row:last-child {
            margin-bottom: 0;
        }

        .info-label {
            font-size: 0.85rem;
            color: #6b7280;
            font-weight: 600;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            margin-bottom: 0.5rem;
        }

        .info-value {
            font-size: 1.1rem;
            color: #1f2937;
            font-weight: 500;
        }

        .info-value-highlight {
            color: var(--primary);
            font-weight: 600;
        }

        /* Route Section */
        .route-container {
            display: flex;
            align-items: center;
            justify-content: space-between;
            position: relative;
            padding: 2rem 0;
        }

        .route-line {
            position: absolute;
            left: 15%;
            right: 15%;
            height: 4px;
            background: linear-gradient(to right, var(--primary), var(--success));
            top: 50%;
            z-index: 0;
        }

        .route-point {
            text-align: center;
            position: relative;
            z-index: 1;
            flex: 1;
        }

        .route-circle {
            width: 80px;
            height: 80px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0 auto 1rem;
            color: white;
            font-size: 2rem;
            box-shadow: 0 8px 16px rgba(0, 0, 0, 0.1);
        }

        .circle-primary {
            background: linear-gradient(135deg, var(--primary), var(--primary-dark));
        }

        .circle-success {
            background: linear-gradient(135deg, var(--success), #059669);
        }

        .route-label {
            font-size: 0.85rem;
            color: #6b7280;
            margin-bottom: 0.5rem;
        }

        .route-name {
            font-weight: 600;
            color: #1f2937;
            font-size: 1rem;
        }

        .distance-box {
            text-align: center;
            background: var(--light-bg);
            padding: 1rem;
            border-radius: 0.75rem;
            border: 2px solid var(--border-color);
        }

        .distance-value {
            font-size: 1.5rem;
            font-weight: 700;
            color: var(--primary);
        }

        .distance-label {
            font-size: 0.8rem;
            color: #6b7280;
            margin-top: 0.25rem;
        }

        /* Timeline */
        .timeline {
            position: relative;
            padding-left: 0;
        }

        .timeline-item {
            position: relative;
            padding-left: 60px;
            padding-bottom: 2rem;
        }

        .timeline-item:last-child {
            padding-bottom: 0;
        }

        .timeline-item::before {
            content: '';
            position: absolute;
            left: 24px;
            top: 55px;
            bottom: -10px;
            width: 2px;
            background: var(--border-color);
        }

        .timeline-item:last-child::before {
            display: none;
        }

        .timeline-marker {
            position: absolute;
            left: 0;
            top: 0;
            width: 50px;
            height: 50px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            font-size: 1.5rem;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.15);
        }

        .marker-success {
            background: var(--success);
        }

        .marker-info {
            background: var(--info);
        }

        .marker-warning {
            background: var(--warning);
        }

        .marker-primary {
            background: var(--primary);
        }

        .timeline-content {
            background: var(--light-bg);
            padding: 1rem;
            border-radius: 0.75rem;
            border-left: 4px solid var(--border-color);
            transition: all 0.3s ease;
        }

        .timeline-content:hover {
            background: white;
            border-left-color: var(--primary);
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.08);
        }

        .timeline-time {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 0.75rem;
        }

        .timeline-message {
            font-weight: 500;
            color: #1f2937;
            margin-bottom: 0.5rem;
        }

        .timeline-meta {
            font-size: 0.85rem;
            color: #6b7280;
        }

        /* Responsive */
        @media (max-width: 1024px) {
            .main-grid {
                grid-template-columns: 1fr;
            }

            .tracking-info {
                grid-template-columns: 1fr;
            }

            .two-col {
                grid-template-columns: 1fr;
            }
        }

        @media (max-width: 768px) {
            .header {
                flex-direction: column;
                align-items: flex-start;
                gap: 1rem;
            }

            .header-right {
                width: 100%;
            }

            .btn {
                flex: 1;
                justify-content: center;
            }

            .route-container {
                flex-direction: column;
                gap: 2rem;
            }

            .route-line {
                display: none;
            }

            .container {
                padding: 1rem;
            }
        }
    </style>
</head>

<body>
    <div class="container">
        <!-- Header -->
        <div class="header">
            <div class="header-left">
                <h1>Parcel Details</h1>
                <p>Complete information about this parcel</p>
            </div>
            <div class="header-right">
                <div class="d-flex gap-2">
                    <a href="javascript:history.back()" class="btn btn-primary rounded-3">
                        <i class="bx bx-edit-alt me-1"></i> Back
                    </a>


                </div>
            </div>
        </div>

        <!-- Main Content -->
        <div class="main-grid">
            <!-- Left Column -->
            <div>
                <!-- Tracking & Status Card -->
                <div class="card">
                    <div class="card-header">
                        <div class="icon icon-primary">📍</div>
                        <h3>Tracking Information</h3>
                    </div>
                    <div class="tracking-info">
                        <div>
                            <div class="info-label">Tracking Code</div>
                            <div class="tracking-code">{{ $parcel->tracking_code }}</div>
                        </div>
                        <div>
                            <div class="info-label">Current Status</div>
                            <div style="margin-top: 0.5rem;">
                                <span class="status-badge status-transit">{{ $parcel->status }}</span>
                            </div>
                            <div class="info-row" style="margin-top: 1rem;">
                                <div class="info-label">Created</div>
                                <div class="info-value">{{ $parcel->created_at->format('M d, Y h:i A') }}</div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Sender & Recipient Cards -->
                <div class="two-col">
                    <!-- Sender Card -->
                    <div class="card">
                        <div class="card-header">
                            <div class="icon icon-primary">👤</div>
                            <h3>Sender Information</h3>
                        </div>
                        <div class="info-row">
                            <div class="info-label">Name</div>
                            <div class="info-value">{{ $parcel->sender_name }}</div>
                        </div>
                        <div class="info-row">
                            <div class="info-label">Contact</div>
                            <div class="info-value">{{ $parcel->sender_contact }}</div>
                        </div>
                        <div class="info-row">
                            <div class="info-label">Address</div>
                            <div class="info-value">{{ $parcel->sender_address }}</div>
                        </div>
                    </div>

                    <!-- Recipient Card -->
                    <div class="card">
                        <div class="card-header">
                            <div class="icon icon-success">📦</div>
                            <h3>Recipient Information</h3>
                        </div>
                        <div class="info-row">
                            <div class="info-label">Name</div>
                            <div class="info-value">{{ $parcel->recipient_name }}</div>
                        </div>
                        <div class="info-row">
                            <div class="info-label">Contact</div>
                            <div class="info-value">{{ $parcel->recipient_contact }}</div>
                        </div>
                        <div class="info-row">
                            <div class="info-label">Address</div>
                            <div class="info-value">{{ $parcel->recipient_address }}</div>
                        </div>
                    </div>
                </div>

                <!-- Route Information -->
                <div class="card">
                    <div class="card-header">
                        <div class="icon icon-primary">🗺️</div>
                        <h3>Route Information</h3>
                    </div>
                    <div class="route-container">
                        <div class="route-point">
                            <div class="route-circle circle-primary">📍</div>
                            <div class="route-label">Origin Branch</div>
                            <div class="route-name">{{ $parcel->fromBranch->name ?? 'N/A' }}</div>
                        </div>

                        <div class="distance-box">
                            <div class="distance-value">{{ $parcel->distance }}</div>
                            <div class="distance-label">km</div>
                        </div>

                        <div class="route-point">
                            <div class="route-circle circle-success">📍</div>
                            <div class="route-label">Destination Branch</div>
                            <div class="route-name">{{ $parcel->recipient_address ?? 'N/A' }}</div>
                        </div>
                    </div>
                </div>

                <!-- Tracking Timeline -->
                <div class="card">
                    <div class="card-header">
                        <div class="icon icon-primary">⏱️</div>
                        <h3>Tracking History</h3>
                    </div>



                    <div class="timeline">
                        @foreach ($parcelTracks as $track)
                            <div class="timeline-item">
                                <div class="timeline-marker marker-success">✓</div>
                                <div class="timeline-content">
                                    <div class="timeline-time">
                                        <span class="status-badge status-delivered">{{ $track->status }}</span>
                                        <span class="timeline-meta"> {{ $track->created_at->diffForHumans() }}</span>
                                    </div>
                                    <div class="timeline-message">{{ $track->message }}</div>

                                    <div class="timeline-meta">{{ $track->created_at->format('M d, Y - h:i A') }}</div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>

            <!-- Right Column -->
            <div>
                <!-- Parcel Details Card -->
                <div class="card">
                    <div class="card-header">
                        <div class="icon icon-primary">📦</div>
                        <h3>Parcel Details</h3>
                    </div>
                    <div class="info-row">
                        <div class="info-label">Weight</div>
                        <div class="info-value"><strong>2.5</strong> kg</div>
                    </div>
                    <div style="border-top: 1px solid var(--border-color); padding: 1rem 0; margin: 1rem 0;">
                        <div class="info-label">Distance</div>
                        <div class="info-value"><strong>2,845</strong> km</div>
                    </div>
                    <div style="border-top: 1px solid var(--border-color); padding: 1rem 0; margin: 1rem 0;">
                        <div class="info-label">Status</div>
                        <div style="margin-top: 0.5rem;">
                            <span class="status-badge status-delivered">✓ Delivered</span>
                        </div>
                    </div>
                    <div style="border-top: 1px solid var(--border-color); padding: 1rem 0; margin: 1rem 0;">
                        <div class="info-label">Created Date</div>
                        <div class="info-value">Nov 15, 2024<br><span style="font-size: 0.9rem; color: #6b7280;">2:30
                                PM</span></div>
                    </div>
                </div>

                <!-- Quick Actions Card -->


                <!-- Assigned Couriers Card -->
                <div class="card">
                    <div class="card-header">
                        <div class="icon icon-primary">👥</div>
                        <h3>Assigned Couriers</h3>
                    </div>
                    <div style="overflow-x: auto;">
                        <table style="width: 100%; font-size: 0.9rem;">
                            <thead>
                                <tr style="border-bottom: 2px solid var(--border-color);">
                                    <th
                                        style="text-align: left; padding: 0.75rem 0; color: #6b7280; font-weight: 600;">
                                        #</th>
                                    <th
                                        style="text-align: left; padding: 0.75rem 0; color: #6b7280; font-weight: 600;">
                                        Name</th>
                                    <th
                                        style="text-align: left; padding: 0.75rem 0; color: #6b7280; font-weight: 600;">
                                        Assigned At</th>
                                    <th
                                        style="text-align: left; padding: 0.75rem 0; color: #6b7280; font-weight: 600;">
                                        Status</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($assignedCouriers as $index => $courier)
                                    <tr>
                                        <td>{{ $index + 1 }}</td>
                                        <td>{{ $courier->courier->user?->name }}</td>
                                        <td>{{ $courier->created_at->format('d M, Y') }}</td>
                                        <td>{{ $courier->status }}</td>

                                    </tr>
                                @endforeach
                                {{-- <tr style="border-bottom: 1px solid var(--border-color);">
                                    <td style="padding: 0.75rem 0;">1</td>
                                    <td>Mike Davis</td>
                                    <td>Nov 17, 2024</td>
                                    <td><span class="status-badge status-transit">Active</span></td>
                                </tr>
                                <tr>
                                    <td style="padding: 0.75rem 0;">2</td>
                                    <td>James Wilson</td>
                                    <td>Nov 16, 2024</td>
                                    <td><span class="status-badge"
                                            style="background-color: #f3f4f6; color: #6b7280;">Completed</span></td>
                                </tr> --}}
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>

</html>
