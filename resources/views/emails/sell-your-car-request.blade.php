<h2>New Sell Your Car Request</h2>

<p><strong>Name:</strong> {{ $requestData['first_name'] }} {{ $requestData['last_name'] }}</p>
<p><strong>Email:</strong> {{ $requestData['email'] }}</p>
<p><strong>Phone:</strong> {{ $requestData['phone'] }}</p>
<p><strong>Vehicle:</strong> {{ $requestData['vehicle_year'] }} {{ $requestData['make'] }} {{ $requestData['model'] }}{{ !empty($requestData['trim']) ? ' - ' . $requestData['trim'] : '' }}</p>
<p><strong>Mileage:</strong> {{ $requestData['mileage'] }}</p>
<p><strong>Transmission:</strong> {{ $requestData['transmission'] }}</p>
<p><strong>Exterior Color:</strong> {{ $requestData['exterior_color'] ?? 'N/A' }}</p>
<p><strong>Interior Color:</strong> {{ $requestData['interior_color'] ?? 'N/A' }}</p>
<p><strong>Engine:</strong> {{ $requestData['cylinders'] ?? 'N/A' }} cylinders / {{ $requestData['liters'] ?? 'N/A' }} liters</p>
<p><strong>Lien Holder:</strong> {{ $requestData['lien_holder'] ?? 'None provided' }}</p>
<p><strong>Owner Address:</strong> {{ $requestData['address'] }}, {{ $requestData['city'] }}, {{ $requestData['state'] }} {{ $requestData['zip'] }}</p>
<p><strong>Vehicle Notes:</strong><br>{!! nl2br(e($requestData['additional_options'] ?? 'No additional notes provided.')) !!}</p>
