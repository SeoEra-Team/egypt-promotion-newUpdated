<script>
    document.addEventListener("DOMContentLoaded", function() {
        const timer = document.querySelector(".time-wepper");
        const deadline = timer.getAttribute("data-deadline-date");
        // Extract only the date part (yyyy-mm-dd) from the datetime string
        const dateOnly = deadline.split(" ")[0];
        // Create a Date object set to midnight of the deadline date
        const countDownDate = new Date(`${dateOnly}T00:00:00`).getTime();

        const daysEl = timer.querySelector(".days");
        const hoursEl = timer.querySelector(".hours");
        const minutesEl = timer.querySelector(".minutes");
        const secondsEl = timer.querySelector(".seconds");

        const interval = setInterval(function() {
            const now = new Date().getTime();
            const distance = countDownDate - now;

            if (distance <= 0) {
                clearInterval(interval);
                daysEl.textContent = "0";
                hoursEl.textContent = "0";
                minutesEl.textContent = "0";
                secondsEl.textContent = "0";
                return;
            }

            const days = Math.floor(distance / (1000 * 60 * 60 * 24));
            const hours = Math.floor(
                (distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60)
            );
            const minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
            const seconds = Math.floor((distance % (1000 * 60)) / 1000);

            daysEl.textContent = days;
            hoursEl.textContent = hours;
            minutesEl.textContent = minutes;
            secondsEl.textContent = seconds;
        }, 1000);
    });

    document.addEventListener("DOMContentLoaded", function() {
        const deadline = document.querySelector(".time_wepper").getAttribute("data-deadline-date");
        // Extract only the date part (yyyy-mm-dd) from the datetime string
        const dateOnly = deadline.split(" ")[0];
        // Create a Date object set to midnight of the deadline date
        const countDownDate = new Date(`${dateOnly}T00:00:00`).getTime();

        const x = setInterval(function() {
            const now = new Date().getTime();
            const distance = countDownDate - now;

            const days = Math.floor(distance / (1000 * 60 * 60 * 24));
            const hours = Math.floor((distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
            const minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
            const seconds = Math.floor((distance % (1000 * 60)) / 1000);

            document.getElementById("days").innerText = days.toString().padStart(2, "0");
            document.getElementById("hours").innerText = hours.toString().padStart(2, "0");
            document.getElementById("minutes").innerText = minutes.toString().padStart(2, "0");
            document.getElementById("seconds").innerText = seconds.toString().padStart(2, "0");

            if (distance < 0) {
                clearInterval(x);
                document.getElementById("days").innerText = "00";
                document.getElementById("hours").innerText = "00";
                document.getElementById("minutes").innerText = "00";
                document.getElementById("seconds").innerText = "00";
            }
        }, 1000);
    });
</script>
