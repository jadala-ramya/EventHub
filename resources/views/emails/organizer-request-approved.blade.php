<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Organizer Request Approved</title>
</head>
<body>
    <h2>Your Organizer Request Was Approved</h2>

    <p>Hello,</p>

    <p>Your organizer request has been verified and approved by the admin.</p>

    <p><strong>Organization:</strong> {{ $requestData->organization_name }}</p>
    <p><strong>Login Email:</strong> {{ $requestData->contact_email ?? optional($requestData->user)->email }}</p>
    @if(!empty($oneTimePassword))
    <p><strong>One-Time Password:</strong> <code>{{ $oneTimePassword }}</code></p>
    <p>You can now log in using these credentials here: <a href="{{ route('login') }}">Login Page</a></p>
    @endif

    <p>Alternatively, click the link below to continue with your organizer registration:</p>

    <p><a href="{{ $continueLink }}">Continue Organizer Registration</a></p>

    <p>If the link does not work, copy and paste this URL into your browser:</p>

    <p>{{ $continueLink }}</p>

    <p>Thank you,<br>EventHub Team</p>
</body>
</html>
