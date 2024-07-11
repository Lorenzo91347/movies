<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Event Selection</title>
</head>

<body>
    <h1>Select an Event</h1>
    <form action="index.php" method="post">
        <label for="event_type">Choose an event type:</label>
        <select name="event_type" id="event_type">
            <option value="movie">Movie</option>
            <option value="play">Play</option>
            <option value="concert">Concert</option>
        </select>
        <br><br>
        <label for="event_duration">Enter duration (hours):</label>
        <input type="number" name="event_duration" id="event_duration" pattern="^\d+(\.\d{1,2})?$" step="any" min="1" max="5">
        <br><br>
        <label for="time_frame">enter the time of day:</label>
        <select name="time_frame" id="time_frame">
            <option value="morning">Morning</option>
            <option value="afternoon">Afternoon</option>
            <option value="evening">Evening</option>
        </select>
        <button type="submit">Submit</button>
    </form>

    <?php
    if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['event_type']) && isset($_POST['event_duration']) && isset($_POST['time_frame'])) {
        require_once 'Event.php';
        require_once 'classes/Movie.php';
        require_once 'classes/Play.php';
        require_once 'classes/Concert.php';

        $eventType = $_POST['event_type'];
        $eventDuration = $_POST['event_duration'];
        $eventTimeFrame = $_POST['time_frame'];

        // Validate event duration format
        if (filter_var($eventDuration, FILTER_VALIDATE_FLOAT) === false || !preg_match('/^\d+(\.\d{1,2})?$/', $eventDuration) || $event_duration < 1 || $event_duration > 5) {
            echo "Invalid duration input. Please enter a number in the format 1.11.,minimum 1 and maximum 5";
            exit;
        }

        $eventDuration = (float) $eventDuration;
        $event = null;

        switch ($eventType) {
            case 'movie':
                $event = new Movie($eventDuration, $eventTimeFrame);
                break;
            case 'play':
                $event = new Play($eventDuration, $eventTimeFrame);
                break;
            case 'concert':
                $event = new Concert($eventDuration, $eventTimeFrame);
                break;
            default:
                echo "Invalid event type selected.";
                exit;
        }

        if ($event) {
            $price = $event->pricing();
            echo "<h2>Selected Event: " . $event->getType() . "</h2>";
            echo "<h2>Selected Time of Day: " . $eventTimeFrame . "</h2>";
            echo "<p>Price for $eventDuration hour(s): $" . $price . "</p>";
        }
    }
    ?>
</body>

</html>