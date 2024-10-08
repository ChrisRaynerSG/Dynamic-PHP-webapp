<?php
include('Includes/Navbar.php');

$currentMonth = date('n');
$currentYear = date('Y'); 

if (isset($_GET['month']) && isset($_GET['year'])) {
    $currentMonth = $_GET['month'];
    $currentYear = $_GET['year'];
}

function getDaysInMonth($month, $year) {
    return cal_days_in_month(CAL_GREGORIAN, $month, $year);
}

$today = date('Y-m-d');

function generateMonthDays($month, $year) {
    global $today;
    $daysInMonth = getDaysInMonth($month, $year);
    $days = [];

    for ($day = 1; $day <= $daysInMonth; $day++) {
        $dateString = date('Y-m-d', mktime(0, 0, 0, $month, $day, $year));
        $isPast = $dateString < $today;
        $days[] = [
            'day' => $day,
            'isPast' => $isPast
        ];
    }

    return $days;
}

$daysInCurrentMonth = generateMonthDays($currentMonth, $currentYear);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Book a stay at Rayner Lodge. Check availability and reserve your spot.">
    <title>Rayner Lodge Booking</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">
    <link href="/Assets/Css/booking.css" rel="stylesheet">
</head>
<body>

<div class="container my-5">
    <h2 class="mb-4">Book Your Stay at Rayner Lodge</h2>

    <div class="d-flex justify-content-between mb-3">
        <button class="btn btn-secondary" id="prevMonthBtn">Previous Month</button>
        <h4 id="currentMonthYear"><?php echo date("F Y", mktime(0, 0, 0, $currentMonth, 1, $currentYear)); ?></h4>
        <button class="btn btn-secondary" id="nextMonthBtn">Next Month</button>
    </div>

    <div class="calendar" id="bookingCalendar">
        <div class="calendar-header">Sun</div>
        <div class="calendar-header">Mon</div>
        <div class="calendar-header">Tue</div>
        <div class="calendar-header">Wed</div>
        <div class="calendar-header">Thu</div>
        <div class="calendar-header">Fri</div>
        <div class="calendar-header">Sat</div>

        <?php
        $firstDayOfMonth = date('w', mktime(0, 0, 0, $currentMonth, 1, $currentYear));

        for ($i = 0; $i < $firstDayOfMonth; $i++) {
            echo "<div class='calendar-day'></div>";
        }

        foreach ($daysInCurrentMonth as $dayData) {
            $day = $dayData['day'];
            $isPast = $dayData['isPast'];
            $dayClass = $isPast ? 'unavailable' : '';
            echo "<div class='calendar-day $dayClass' data-day='$day'>$day</div>";
        }
        ?>
    </div>

    <div class="d-flex justify-content-end">
        <button class="btn btn-primary" id="confirmBookingBtn">Confirm Booking</button>
    </div>
</div>

<?php
include('Includes/Footer.php');
?>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
<script src = "/Assets/JavaScript/calendar.js"></script>
</body>
</html>
