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
            overflow: hidden;
            display: flex;
            flex-direction: column;
            font-family: 'Poppins', sans-serif;
        }
        .top, .bottom {
            width: 100%;
            height: 50%;
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            text-align: center;
        }
        .top {
            background-color: #{{ $shortUrl->top_color }};
        }
        .bottom {
            background-color: #{{ $shortUrl->bottom_color }};
        }
        .logo {
            max-height: 35%; /* Reduced size to fit text around */
            margin: 20px 0; /* Adds space around the logo */
            filter: drop-shadow(0px 10px 10px rgba(0,0,0,0.5));
        }
        .secured-text {
            color: #FFFFFF; /* Sets text color to white */
            font-size: 60px; /* Sets font size */
            margin: 5px 0; /* Adds spacing around text */
        }
        .redirect-text {
            color: #FFFFFF; /* Sets text color to white */
            font-size: 40px; /* Sets font size */
            margin: 5px 0; /* Adds spacing around text */
        }
        .url-text {
            font-size: 36px; /* Smaller font for URL */
            color: #FFFFFF;
            margin-bottom: 15px; /* Extra space below the URL */
        }
        .countdown {
            color: #FFFFFF; /* Set countdown text color */
            font-size: 40px; /* Set countdown font size */
        }
    </style>
</head>
<body>
    <div class="top">
        <p class="secured-text">Secured by</p>
        <img class="logo" src="https://www.qrla.io/wp-content/uploads/2024/01/POSTER_LOGO_GREEN@4x-2.png" alt="QR Code Security Logo">
        <p class="url-text">https://qrla.io/{{ $shortUrl->short_code }}</p>
    </div>
    <div class="bottom">
        <p class="redirect-text">Redirecting to</p>
        <p class="url-text">{{ $shortUrl->destination_url }}</p>
        <img class="logo" src="{{ $shortUrl->bottom_logo }}" alt="Redirecting Logo">
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
