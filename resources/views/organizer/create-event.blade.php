<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>
    <script>

function toggleSeatField()
{
    const type =
        document.getElementById('eventType').value;

    const seatField =
        document.getElementById('seatField');

    if(type === 'seated')
    {
        seatField.classList.remove('hidden');
    }
    else
    {
        seatField.classList.add('hidden');
    }
}

</script>
    <div class="mb-5">

        <label class="block mb-2 font-semibold">
            Event Type
        </label>

        <select name="event_type" id="eventType" onchange="toggleSeatField()" class="w-full p-3 border rounded-xl">

            <option value="standing">
                Standing Event
            </option>

            <option value="seated">
                Seated Event
            </option>

        </select>

    </div>

    <div id="seatField" class="hidden mb-5">

        <label class="block mb-2 font-semibold">
            Total Seats
        </label>

        <input type="number" name="total_seats" class="w-full p-3 border rounded-xl">
    </div>

</body>

</html>
