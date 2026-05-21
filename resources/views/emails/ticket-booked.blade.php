<!DOCTYPE html>
<html>
<head>
    <title>Event Ticket</title>
</head>
<body style="font-family: Arial; background: #f5f5f5; padding: 40px;">

    <div style="max-width: 600px; background: white; padding: 40px; border-radius: 20px; margin: auto;">

        <h1 style="color: #4f46e5;">
            🎟️ Booking Confirmed
        </h1>

        <p>
            Hello {{ $booking->user->name }},
        </p>

        <p>
            Your booking has been successfully submitted.
        </p>

        <hr>

        <h2>
            {{ $booking->event->title }}
        </h2>

        <p>
            📍 Venue:
            {{ $booking->event->venue }}
        </p>

        <p>
            📅 Date:
            {{ $booking->event->date }}
        </p>

        <p>
            ⏰ Time:
            {{ $booking->event->time }}
        </p>

        <p>
            🎟️ Ticket Number:
            #EVT{{ $booking->id }}
        </p>

        <br>

        <a href="{{ route('ticket.show', $booking->id) }}"
           style="background:#4f46e5;color:white;padding:12px 20px;border-radius:10px;text-decoration:none;display:inline-block;font-weight:bold;">
            View Ticket
        </a>

    </div>

</body>
</html>
