<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  @if(!isset($testing))
  <meta http-equiv="refresh" content="3;url={{ $destination_url }}">
  @endif
  <title>Redirecting...</title>
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600&display=swap" rel="stylesheet">
  <style>
  body {
    margin: 0;
    padding: 0;
    font-family: 'Poppins', sans-serif;
    display: flex;
    justify-content: center;
    align-items: center;
    width: 100vw;
    height: 100vh;
    /* CSS Gradient Background with Subtle Transition */
    background: linear-gradient(to bottom, #041522, #020b11);
    color: white;
    text-align: center;
    overflow: hidden;
    /* Prevent scrolling */
  }

  .container {
    display: flex;
    flex-direction: column;
    /* Space between items */
    align-items: center;
    width: 100%;
    height: 100%;
    padding: 20px;
    box-sizing: border-box;
    padding-top: 80px;
    padding-bottom: 80px;
    overflow: scroll;
  }

  .inner-reticle-asset {
    position: absolute;
    top: 40px;
  }

  .secured-by {
    display: flex;
    align-items: center;
  }

  .secured-text,
  .visiting-text,
  .url-text,
  .protect-text {
    font-size: 4vw;
    /* Responsive font size */
    margin: 0.5vw;
  }

  .logo {
    width: 540px;
    /* Responsive width */
    max-width: 100%;
    margin: 1vw 0;
  }

  .qrla_title {
    width: 320px;

  }

  .app-logo {
    width: 15vw;
    /* Responsive width */
    max-width: 100%;
    margin: 1vw 0;
  }

  .countdown {
    font-size: 5vw;
    /* Responsive font size */
    font-weight: bold;
    margin: 1vw 0;
  }

  .secured-by img,
  .qrla_approved,
  .logo,
  .app-logo {
    max-width: 100%;
  }

  .logo-wrapper {
    position: relative;
    display: flex;
    flex-direction: column;
    align-items: center;
  }

  .logoWrapper__success--text {
    color: #A0F906;
    font-weight: bold;
    font-size: 30px;
  }

  .securing__text {
    font-size: 32px;
    /* Adjust the font size as needed */
    fill: #fff;
    /* Text color */
    text-anchor: middle;
    /* Center the text on the curve */
  }

  .success__text {
    font-size: 40px;
    /* Adjust the font size as needed */
    fill: #A0F906;
    font-weight: bold;
    /* Text color */
    text-anchor: middle;
    /* Center the text on the curve */
  }


  .visiting-text {
    font-size: 26px;
    /* Adjust the font size as needed */
    fill: #fff;
    /* Text color */
    text-anchor: middle;
    /* Center the text on the curve */
    margin-top: -80px;
  }

  .svg-container__visiting-text {
    margin-top: -40px;
  }

  svg {
    width: 100%;
    min-height: 200px;
    /* Adjust height as needed */
    display: block;
    margin: 0 auto;
  }

  .below-image__green-text {
    color: #A0F906;

    font-size: 30px;
    text-align: center;
  }
  </style>
</head>

<body>
  <div class="container">


    <img class="qrla_title" src="{{ asset('assets/redirects/QRLA_title.png') }}" alt="QRLA Title">


    <svg viewBox="0 0 500 150">
      <!-- Define the curve path -->
      <path id="curve" d="M 50,100 Q 250, 40 450,100" fill="transparent" />
      <!-- Place text on the path -->
      <text class="securing__text">
        <textPath href="#curve" startOffset="50%">
          Securing your journey
        </textPath>
      </text>
    </svg>
    <div class="logo-wrapper">
      <div id="lottie-container" style="width: 600px; height: 600px"></div>
      <svg viewBox="0 0 500 150">
        <!-- Define the curve path -->
        <path id="curve" d="M 50,100 Q 250,-50 450,100" fill="transparent" />
        <!-- Place text on the path -->
        <text class="success__text">
          <textPath href="#curve" startOffset="50%">
            Success!
          </textPath>
        </text>
      </svg>
    </div>
    <!-- <p class="countdown" id="countdown">3</p> -->
    <svg class="svg-container__visiting-text" viewBox="0 0 500 150">
      <!-- Define the curve path -->
      <path id="curve" d="M 50,100 Q 250,-50 450,100" fill="transparent" />
      <!-- Place text on the path -->
      <text class="visiting-text">
        <textPath href="#curve" startOffset="50%">
          You are visiting...
        </textPath>
      </text>
    </svg>
    <img class="logo" src="{{ asset($logoPath) }}" alt="User Logo">
    <p class="below-image__green-text">{{ $domain }}</p>
  </div>

  <script src="https://cdnjs.cloudflare.com/ajax/libs/bodymovin/5.10.2/lottie.min.js"></script>
  <script>
  document.addEventListener('DOMContentLoaded', () => {
    lottie.loadAnimation({
      container: document.getElementById('lottie-container'), // The DOM element to render the animation
      renderer: 'svg', // Render as SVG (can also be 'canvas' or 'html')
      loop: false, // Set to true for looping the animation
      autoplay: true, // Set to true to start the animation automatically
      path: '/assets/lottie_shieldAnimation.json', // Path to your Lottie JSON file
    })
  })




  // document.getElementById('appLogo').addEventListener('click', () => {
  //   const userAgent = navigator.userAgent || navigator.vendor || window.opera;

  //   if (/android/i.test(userAgent)) {
  //     window.location.href =
  //       'https://play.google.com/store/apps/details?id=com.qrlaapp&hl=en&gl=US'; // Android link
  //   } else if (/iPad|iPhone|iPod/.test(userAgent) && !window.MSStream) {
  //     window.location.href = 'https://apps.apple.com/gb/app/qrla/id6478059792'; // iOS link
  //   } else {
  //     window.location.href = 'https://apps.apple.com/gb/app/qrla/id6478059792'; // Default to iOS link
  //   }
  // });
  </script>
</body>

</html>