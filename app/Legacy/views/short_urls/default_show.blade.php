<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="refresh" content="3;url={{ $shortUrl->destination_url }}">
    <title>Redirecting...</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600&display=swap" rel="stylesheet">
    <style>
        html, body {
            height: 100%;
            margin: 0;
            padding: 0;
            display: flex;
            flex-direction: column;
            align-items: center;
            text-align: center;
            font-family: 'Poppins', sans-serif;
            background-color: #031521; /* Neutral background */
        }
        body {
            min-height: 100vh; /* Ensures at least full viewport height */
            justify-content: center; /* Centering content vertically */
        }
        .content {
            width: 100%; /* Controls the content width */
            max-width: 600px; /* Ensures the content is not too wide on large screens */
            margin-top: 15vh; /* Sets top margin to 35% of the viewport height */
        }
        .logo {
            max-height: 40%; /* Adjust logo size */
            margin: 20px 0; /* Space around the logo */
            filter: drop-shadow(0px 10px 10px rgba(0,0,0,0.3)); /* Subtle shadow for depth */
        }
        .secured-text, .text, .url-text, .countdown {
            color: #f0f0f0; /* High contrast text for better readability */
            margin: 10px 0; /* Vertical spacing */
        }
        .secured-text {
            font-size: 44px; /* Adaptable font size */
        }
        .text {
            font-size: 34px; /* Adaptable font size */
        }
        .url-text, .countdown {
            font-size: 30px; /* Consistent font size for URLs and countdown */
        }
    </style>
</head>
<body>
    <div class="content">
        <p class="secured-text">Secured by</p>
        <img class="logo" src="https://www.qrla.io/wp-content/uploads/2024/01/POSTER_LOGO_GREEN@4x-2.png" alt="QR Code Security Logo">
        <p class="url-text">https://qrla.io/{{ $shortUrl->short_code }}</p>
        <p class="text">Redirecting to</p>
        <p class="url-text">{{ $shortUrl->destination_url }}</p>
        <p class="countdown" id="countdown">3</p>
    </div>
    <script>
        let timeLeft = 3;
        const countdownElement = document.getElementById('countdown');
        
        const timer = setInterval(() => {
            timeLeft--;
            countdownElement.textContent = `${timeLeft}`;
            if (timeLeft <= 0) clearInterval(timer);
        }, 1000);
    </script>
</body>
</html>
