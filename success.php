<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Payment SUCCESS</title>
    <link rel="stylesheet" href="navbar.css">
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="navbar">
        <ul>
            <li><a href="index.php">Home</a></li>
            <li><a href="tips.php">Tips while Traveling</a></li>
            <li><a href="forum.php">Travel Forum</a></li>
            <li><a href="book.php">Book a Trip</a></li>
        </ul>
    </div>
    <h1>Transaction Completed</h1>
    <?php
    $from = $_GET['from'] ?? '';
    $to = $_GET['to'] ?? '';
    $days = $_GET['days'] ?? '';
    $flyers = $_GET['flyers'] ?? '';
    $fullName = $_GET['fullName'] ?? '';
    $email = $_GET['email'] ?? '';
    $phoneNumber = $_GET['phoneNumber'] ?? '';
    $date = $_GET['date'] ?? '';

    echo "FROM: $from TO: $to <br>";
    echo "$days - Day Trip <br>";
    echo "Reservation name under $fullName <br>";
    echo "E-mail: $email <br> Phone Number: $phoneNumber <br>";
    echo "Date: $date <br>"
    ?>
    <h2>You should be contacted in your e-mail with the receipt. </h2>
    <h2>Receipts are available 24 hours after the transaction.</h2>

    <form id="my-form" action="https://formspree.io/f/xqkrnkda" method="POST">
        <input type="hidden" id="from" name="from" />
        <input type="hidden" id="to" name="to" />
        <input type="hidden" id="days" name="days" />
        <input type="hidden" id="flyers" name="flyers" />
        <input type="hidden" id="fullName" name="fullName" />
        <input type="hidden" id="email" name="email" />
        <input type="hidden" id="phoneNumber" name="phoneNumber" />
        <input type="hidden" id="date" name="date" />
        <button id="my-form-button">Complete Booking</button>
        <p id="my-form-status"></p>
    </form>

    <script>
        var form = document.getElementById("my-form");

        async function handleSubmit(event) {
            event.preventDefault();
            var status = document.getElementById("my-form-status");
            var data = new FormData(event.target);
            fetch(event.target.action, {
                method: form.method,
                body: data,
                headers: {
                    'Accept': 'application/json'
                }
            }).then(response => {
                if (response.ok) {
                    status.innerHTML = "Trip Booked. Congrats! You should start packing";
                    form.reset()
                } else {
                    response.json().then(data => {
                        if (Object.hasOwn(data, 'errors')) {
                            status.innerHTML = data["errors"].map(error => error["message"]).join(", ")
                        } else {
                            status.innerHTML = "Oops! There was a problem submitting your form"
                        }
                    })
                }
            }).catch(error => {
                status.innerHTML = "Oops! There was a problem submitting your form"
            });
        }
        form.addEventListener("submit", handleSubmit)

        window.addEventListener('DOMContentLoaded', (event) => {
            const urlParams = new URLSearchParams(window.location.search);
            const fromParam = urlParams.get('from');
            const toParam = urlParams.get('to');
            const daysParam = urlParams.get('days');
            const flyersParam = urlParams.get('flyers');
            const fullNameParam = urlParams.get('fullName');
            const phoneNumberParam = urlParams.get('phoneNumber');
            const emailParam = urlParams.get('email');
            const dateParam = urlParams.get('date');

            if (fromParam && toParam && daysParam && flyersParam && fullNameParam && phoneNumberParam && emailParam && dateParam) {
                const fromInput = document.getElementById('from');
                const toInput = document.getElementById('to');
                const daysInput = document.getElementById('days');
                const flyersInput = document.getElementById('flyers');
                const fullNameInput = document.getElementById('fullName');
                const phoneNumberInput = document.getElementById('phoneNumber');
                const emailInput = document.getElementById('email');
                const dateInput = document.getElementById('date');

                fromInput.value = fromParam;
                toInput.value = toParam;
                daysInput.value = daysParam;
                flyersInput.value = flyersParam;
                fullNameInput.value = fullNameParam;
                phoneNumberInput.value = phoneNumberParam;
                emailInput.value = emailParam;
                dateInput.value = dateParam;
            }
        });
    </script>
</body>
</html>
