<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>New Consignment Request</title>
</head>

<body style="margin:0;padding:24px;background:#f3f7ff;font-family:Arial,sans-serif;color:#0f172a;">
    <div style="max-width:720px;margin:0 auto;background:#ffffff;border:1px solid #d9e4ff;border-radius:16px;overflow:hidden;">
        <div style="padding:20px 24px;background:linear-gradient(90deg,#153b8a 0%,#2563eb 100%);color:#ffffff;">
            <div style="font-size:12px;font-weight:700;letter-spacing:.08em;text-transform:uppercase;color:#fecdd3;">Consignment Request</div>
            <h1 style="margin:8px 0 0;font-size:28px;line-height:1.2;">Nitro Motors USA</h1>
        </div>

        <div style="padding:24px;">
            <p style="margin:0 0 18px;font-size:16px;line-height:1.6;">A new consignment request was submitted from the website.</p>

            <table cellpadding="0" cellspacing="0" border="0" width="100%" style="border-collapse:collapse;">
                <tr><td style="padding:10px 0;border-bottom:1px solid #e5ecff;width:180px;font-weight:700;color:#31519b;">Owner</td><td style="padding:10px 0;border-bottom:1px solid #e5ecff;">{{ $requestData['first_name'] }} {{ $requestData['last_name'] }}</td></tr>
                <tr><td style="padding:10px 0;border-bottom:1px solid #e5ecff;font-weight:700;color:#31519b;">Email</td><td style="padding:10px 0;border-bottom:1px solid #e5ecff;">{{ $requestData['email'] }}</td></tr>
                <tr><td style="padding:10px 0;border-bottom:1px solid #e5ecff;font-weight:700;color:#31519b;">Phone</td><td style="padding:10px 0;border-bottom:1px solid #e5ecff;">{{ $requestData['phone'] }}</td></tr>
                <tr><td style="padding:10px 0;border-bottom:1px solid #e5ecff;font-weight:700;color:#31519b;">Vehicle</td><td style="padding:10px 0;border-bottom:1px solid #e5ecff;">{{ $requestData['vehicle_year'] }} {{ $requestData['make'] }} {{ $requestData['model'] }}{{ $requestData['trim'] ? ' - ' . $requestData['trim'] : '' }}</td></tr>
                <tr><td style="padding:10px 0;border-bottom:1px solid #e5ecff;font-weight:700;color:#31519b;">Mileage</td><td style="padding:10px 0;border-bottom:1px solid #e5ecff;">{{ $requestData['mileage'] }}</td></tr>
                <tr><td style="padding:10px 0;border-bottom:1px solid #e5ecff;font-weight:700;color:#31519b;">Transmission</td><td style="padding:10px 0;border-bottom:1px solid #e5ecff;">{{ $requestData['transmission'] }}</td></tr>
                <tr><td style="padding:10px 0;border-bottom:1px solid #e5ecff;font-weight:700;color:#31519b;">Location</td><td style="padding:10px 0;border-bottom:1px solid #e5ecff;">{{ $requestData['city'] }}, {{ $requestData['state'] }} {{ $requestData['zip'] }}</td></tr>
                <tr><td style="padding:10px 0;border-bottom:1px solid #e5ecff;font-weight:700;color:#31519b;">Lien Holder</td><td style="padding:10px 0;border-bottom:1px solid #e5ecff;">{{ $requestData['lien_holder'] ?: 'None provided' }}</td></tr>
            </table>

            <div style="margin-top:22px;">
                <div style="font-size:12px;font-weight:700;letter-spacing:.08em;text-transform:uppercase;color:#d62034;margin-bottom:10px;">Additional Options</div>
                <div style="padding:18px;border:1px solid #d9e4ff;border-radius:14px;background:#f8fbff;font-size:15px;line-height:1.7;white-space:pre-line;">{{ $requestData['additional_options'] ?: 'No additional options provided.' }}</div>
            </div>
        </div>
    </div>
</body>

</html>
