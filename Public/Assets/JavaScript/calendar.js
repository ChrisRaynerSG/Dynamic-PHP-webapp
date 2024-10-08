document.addEventListener('DOMContentLoaded', () => {
    const calendar = document.getElementById('bookingCalendar');
    const currentMonthYear = document.getElementById('currentMonthYear');
    let selectedDates = [];
    let rangeStart = null;
    let rangeEnd = null;
    let currentMonth = Date.currentMonth;
    let currentYear = Date.currentYear;

    // Function to handle day selection and range marking
    function selectDay(event) {
        const target = event.target;
        if (!target.classList.contains('booked') && !target.classList.contains('unavailable')) {
            const day = target.getAttribute('data-day');

            // Handle range selection logic
            if (rangeStart === null) {
                rangeStart = day;
                target.classList.add('selected');
            } else if (rangeEnd === null) {
                rangeEnd = day;

                // Ensure rangeEnd is after rangeStart
                if (parseInt(rangeEnd) < parseInt(rangeStart)) {
                    [rangeStart, rangeEnd] = [rangeEnd, rangeStart];
                }

                // Highlight the range
                highlightRange(parseInt(rangeStart), parseInt(rangeEnd));
            } else {
                // Reset range and reselect start date
                clearSelections();
                rangeStart = day;
                rangeEnd = null;
                target.classList.add('selected');
            }
        }
    }

    // Function to highlight the selected range
    function highlightRange(start, end) {
        const days = document.querySelectorAll('.calendar-day');
        days.forEach(dayElement => {
            const dayNumber = parseInt(dayElement.getAttribute('data-day'));
            if (dayNumber >= start && dayNumber <= end) {
                dayElement.classList.add('selected');
            }
        });
    }

    // Function to clear all selections
    function clearSelections() {
        const selectedElements = document.querySelectorAll('.selected');
        selectedElements.forEach(element => {
            element.classList.remove('selected');
        });
        rangeStart = null;
        rangeEnd = null;
    }

    // Attach click event listener to calendar days
    calendar.addEventListener('click', selectDay);

    // Navigation buttons logic
    document.getElementById('prevMonthBtn').addEventListener('click', () => {
        currentMonth--;
        if (currentMonth < 1) {
            currentMonth = 12;
            currentYear--;
        }
        window.location.href = `?month=${currentMonth}&year=${currentYear}`;
    });

    document.getElementById('nextMonthBtn').addEventListener('click', () => {
        currentMonth++;
        if (currentMonth > 12) {
            currentMonth = 1;
            currentYear++;
        }
        window.location.href = `?month=${currentMonth}&year=${currentYear}`;
    });

    // Confirm booking button logic
    document.getElementById('confirmBookingBtn').addEventListener('click', () => {
        if (rangeStart !== null && rangeEnd !== null) {
            alert(`Booking confirmed from ${rangeStart} to ${rangeEnd}.`);
            // Implement AJAX or form submission logic to save selected range
        } else {
            alert('No valid date range selected for booking.');
        }
    });
});