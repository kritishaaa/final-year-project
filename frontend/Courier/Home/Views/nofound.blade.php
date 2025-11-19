<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tracking Not Found</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', 'Roboto', 'Oxygen', 'Ubuntu', 'Cantarell', sans-serif;
            background: linear-gradient(135deg, #f5f7fa 0%, #c3cfe2 100%);
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 20px;
        }

        .container {
            background: white;
            border-radius: 12px;
            box-shadow: 0 20px 60px rgba(0, 0, 0, 0.08);
            max-width: 600px;
            width: 100%;
            padding: 60px 40px;
            text-align: center;
        }

        .error-icon {
            width: 80px;
            height: 80px;
            margin: 0 auto 30px;
            background: linear-gradient(135deg, #ff6b6b 0%, #ee5a6f 100%);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 40px;
        }

        h1 {
            font-size: 32px;
            font-weight: 700;
            color: #1a202c;
            margin-bottom: 12px;
            line-height: 1.2;
        }

        .tracking-code {
            font-size: 16px;
            color: #718096;
            margin-bottom: 24px;
            padding: 12px 16px;
            background: #f7fafc;
            border-radius: 8px;
            font-family: 'Courier New', monospace;
            word-break: break-all;
        }

        .divider {
            height: 1px;
            background: #e2e8f0;
            margin: 32px 0;
        }

        .message-section {
            margin-bottom: 32px;
        }

        .message-title {
            font-size: 18px;
            font-weight: 600;
            color: #2d3748;
            margin-bottom: 12px;
        }

        .message-text {
            font-size: 15px;
            color: #4a5568;
            line-height: 1.6;
            margin-bottom: 16px;
        }

        .info-box {
            background: linear-gradient(135deg, #e6f7ff 0%, #f0f9ff 100%);
            border-left: 4px solid #3b82f6;
            padding: 16px;
            border-radius: 8px;
            text-align: left;
            margin-bottom: 24px;
        }

        .info-box p {
            font-size: 14px;
            color: #1e40af;
            line-height: 1.5;
        }

        .admin-contact {
            background: #f8fafc;
            border: 1px solid #e2e8f0;
            border-radius: 8px;
            padding: 24px;
            margin-top: 32px;
        }

        .admin-contact h3 {
            font-size: 16px;
            font-weight: 600;
            color: #2d3748;
            margin-bottom: 12px;
        }

        .admin-contact p {
            font-size: 14px;
            color: #4a5568;
            margin-bottom: 16px;
            line-height: 1.5;
        }

        .contact-info {
            background: white;
            padding: 12px;
            border-radius: 6px;
            margin: 8px 0;
            font-size: 14px;
            color: #2b6cb0;
        }

        .contact-info strong {
            color: #1a202c;
        }

        .button-group {
            display: flex;
            gap: 12px;
            margin-top: 32px;
            flex-wrap: wrap;
        }

        .btn {
            flex: 1;
            padding: 12px 24px;
            border: none;
            border-radius: 8px;
            font-size: 15px;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.3s ease;
            min-width: 140px;
        }

        .btn-primary {
            background: linear-gradient(135deg, #3b82f6 0%, #2563eb 100%);
            color: white;
        }

        .btn-primary:hover {
            transform: translateY(-2px);
            box-shadow: 0 10px 20px rgba(37, 99, 235, 0.2);
        }

        .btn-secondary {
            background: white;
            color: #3b82f6;
            border: 2px solid #3b82f6;
        }

        .btn-secondary:hover {
            background: #f0f9ff;
            transform: translateY(-2px);
        }

        @media (max-width: 600px) {
            .container {
                padding: 40px 24px;
            }

            h1 {
                font-size: 24px;
            }

            .button-group {
                flex-direction: column;
            }

            .btn {
                width: 100%;
            }
        }
    </style>
</head>

<body>
    <div class="container">
        <div class="error-icon">⚠️</div>

        <h1>Tracking Code Not Found</h1>

        <div class="tracking-code">
            Tracking Code: <strong>{{ $code }}</strong>
        </div>

        <div class="divider"></div>

        <div class="message-section">
            <div class="message-title">We couldn't find your parcel</div>
            <div class="message-text">
                The tracking code you entered doesn't match any parcels in our system. This could happen if:
            </div>

            <div class="info-box">
                <p>• The tracking code was entered incorrectly</p>
                <p>• The parcel hasn't been registered yet</p>
                <p>• The tracking code has expired</p>
                <p>• There may be a system delay (wait a few minutes and try again)</p>
            </div>
        </div>

        <div class="divider"></div>



        <div class="button-group">
            <button class="btn btn-secondary" onclick="history.back()">Go Back</button>
            <button class="btn btn-primary" onclick="window.location.href='/'">Try Again</button>
        </div>
    </div>
</body>

</html>
