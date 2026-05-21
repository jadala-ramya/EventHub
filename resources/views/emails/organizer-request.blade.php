<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <h2>New Organizer Request</h2>

<p><strong>Full Name:</strong> {{ $data['full_name'] }}</p>

<p><strong>Phone:</strong> {{ $data['phone'] }}</p>

<p><strong>Organization:</strong> {{ $data['organization_name'] }}</p>

<p><strong>Event Details:</strong></p>

<p>{{ $data['event_details'] }}</p>

<p><strong>ID Proof:</strong>
    <a href="{{ url('storage/'.$data['id_proof']) }}" target="_blank">View Proof</a>
</p>

<p><strong>Request ID:</strong> {{ $data['request_id'] }}</p>

<p><strong>Approve Request:</strong>
    <a href="{{ url('/admin/organizer-requests') }}">Open admin request dashboard</a>
</p>

</body>
</html>
