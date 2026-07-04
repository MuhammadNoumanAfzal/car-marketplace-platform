<h2>New Trade-In Request</h2>

<p><strong>Name:</strong> {{ $requestData['first_name'] }} {{ $requestData['last_name'] }}</p>
<p><strong>Email:</strong> {{ $requestData['email'] }}</p>
<p><strong>Phone:</strong> {{ $requestData['phone'] }}</p>
<p><strong>Current Vehicle:</strong> {{ $requestData['current_vehicle_year'] }} {{ $requestData['current_make'] }} {{ $requestData['current_model'] }}{{ !empty($requestData['current_trim']) ? ' - ' . $requestData['current_trim'] : '' }}</p>
<p><strong>Mileage:</strong> {{ $requestData['current_mileage'] }}</p>
<p><strong>VIN:</strong> {{ $requestData['current_vin'] ?? 'N/A' }}</p>
<p><strong>Payoff Balance:</strong> {{ $requestData['trade_payoff'] ?? 'Not provided' }}</p>
<p><strong>Desired Vehicle:</strong> {{ $requestData['desired_vehicle'] ?? 'Not provided' }}</p>
<p><strong>Budget Range:</strong> {{ $requestData['budget_range'] ?? 'Not provided' }}</p>
<p><strong>Purchase Timeline:</strong> {{ $requestData['purchase_timeline'] ?? 'Not provided' }}</p>
<p><strong>Location:</strong> {{ ($requestData['city'] ?? 'N/A') . ', ' . ($requestData['state'] ?? 'N/A') }}</p>
<p><strong>Condition Notes:</strong><br>{!! nl2br(e($requestData['condition_notes'] ?? 'No additional notes provided.')) !!}</p>
