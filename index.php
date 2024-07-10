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
        <input type="text" name="event_duration" id="event_duration" pattern="^\d+(\.\d{1,2})?$">
        <br><br>
        <button type="submit">Submit</button>
    </form>

    <?php
    if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['event_type']) && isset($_POST['event_duration'])) {
        require_once 'Event.php';
        require_once 'classes/Movie.php';
        require_once 'classes/Play.php';
        require_once 'classes/Concert.php';

        $eventType = $_POST['event_type'];
        $eventDuration = $_POST['event_duration'];

        // Validate event duration format
        if (filter_var($eventDuration, FILTER_VALIDATE_FLOAT) === false || !preg_match('/^\d+(\.\d{1,2})?$/', $eventDuration)) {
            echo "Invalid duration input. Please enter a number in the format 1.11.";
            exit;
        }

        $eventDuration = (float) $eventDuration;
        $event = null;

        switch ($eventType) {
            case 'movie':
                $event = new Movie($eventDuration);
                break;
            case 'play':
                $event = new Play($eventDuration);
                break;
            case 'concert':
                $event = new Concert($eventDuration);
                break;
            default:
                echo "Invalid event type selected.";
                exit;
        }

        if ($event) {
            $price = $event->pricing();
            echo "<h2>Selected Event: " . $event->getType() . "</h2>";
            echo "<p>Price for $eventDuration hour(s): $" . $price . "</p>";
        }
    }
    ?>
</body>

</html>