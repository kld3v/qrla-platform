<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Contact Card</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@100;200;300;400;500;600;700;800;900&display=swap" rel="stylesheet">

    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #eaeaea;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
        }

        .card__container {
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
        }
        .card {
            background-color: #e0f0c1;
            border-radius: 20px;
            border: 2px solid #000;
            padding: 20px;
            width: 280px;
            text-align: center;
            box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.1);
            display: flex;
            flex-direction: column;
            justify-content: space-evenly;
            align-items: stretch;
        }

        .profile {
            margin-bottom: 20px;
        }

        .profile p {
            font-size: 20px;
        }

        .avatar {
            width: 60px;
            height: 60px;
            border-radius: 50%;
            margin: 0 auto 10px auto;
        }

        h2 {
            margin: 0;
            font-size: 32px;
        }

        p {
            margin: 5px 0;
            font-size: 16px;
            color: #041522;
        }

        .role-company {
            font-size: 12px;
            color: #555;
            margin-top: 4px;
        }

        .contact-info {
            margin-bottom: 20px;
        }

        .contact-item {
            display: flex;
            align-items: center;
            margin-bottom: 10px;
            border: solid 2px #000;
            border-radius: 16px;
            padding: 16px;
        }

        .icon {
            margin-right: 10px;
            width: 24px;
            height: 24px;
        }

        .text {
            color: #041522;
            align-self: center;
            justify-self: center;
        }

        .secured-by {
            margin-bottom: 20px;
        }
        .secured-by p {
            font-size: 20px;
        }

        .qrla {
            color: #66ff66;
            font-weight: bold;
            width: 96px;
            margin-bottom: -17px;
            margin-left: -8px; 
        }

        .add-to-contacts {
            margin-top: 20px;
            display: flex;
            justify-content: center;
            align-items: center;
        }

        .add-to-contacts a {
            background-color: #a3ff00;
            color: #041522;
            padding: 16px 20px;
            border: 3px solid #000;
            border-radius: 16px;
            cursor: pointer;
            font-size: 20px;
            display: flex;
            justify-content: center;
            align-items: center;
            text-decoration: none;
        }

        #addToContactIcon {
            height: 40px;
            margin-left: 16px;
        }
        .add-to-contacts button:hover {
            background-color: #8fff00;
        }

        .poppins-thin {
            font-family: 'Poppins', sans-serif;
            font-weight: 100;
            font-style: normal;
        }

        .poppins-extralight {
            font-family: 'Poppins', sans-serif;
            font-weight: 200;
            font-style: normal;
        }

        .poppins-light {
            font-family: 'Poppins', sans-serif;
            font-weight: 300;
            font-style: normal;
        }

        .poppins-regular {
            font-family: 'Poppins', sans-serif;
            font-weight: 400;
            font-style: normal;
        }

        .poppins-medium {
            font-family: 'Poppins', sans-serif;
            font-weight: 500;
            font-style: normal;
        }

        .poppins-semibold {
            font-family: 'Poppins', sans-serif;
            font-weight: 600;
            font-style: normal;
        }

        .poppins-bold {
            font-family: 'Poppins', sans-serif;
            font-weight: 700;
            font-style: normal;
        }

        .poppins-extrabold {
            font-family: 'Poppins', sans-serif;
            font-weight: 800;
            font-style: normal;
        }

        .poppins-black {
            font-family: 'Poppins', sans-serif;
            font-weight: 900;
            font-style: normal;
        }

        .poppins-thin-italic {
            font-family: 'Poppins', sans-serif;
            font-weight: 100;
            font-style: italic;
        }

        .poppins-extralight-italic {
            font-family: 'Poppins', sans-serif;
            font-weight: 200;
            font-style: italic;
        }

        .poppins-light-italic {
            font-family: 'Poppins', sans-serif;
            font-weight: 300;
            font-style: italic;
        }

        .poppins-regular-italic {
            font-family: 'Poppins', sans-serif;
            font-weight: 400;
            font-style: italic;
        }

        .poppins-medium-italic {
            font-family: 'Poppins', sans-serif;
            font-weight: 500;
            font-style: italic;
        }

        .poppins-semibold-italic {
            font-family: 'Poppins', sans-serif;
            font-weight: 600;
            font-style: italic;
        }

        .poppins-bold-italic {
            font-family: 'Poppins', sans-serif;
            font-weight: 700;
            font-style: italic;
        }

        .poppins-extrabold-italic {
            font-family: 'Poppins', sans-serif;
            font-weight: 800;
            font-style: italic;
        }

        .poppins-black-italic {
            font-family: 'Poppins', sans-serif;
            font-weight: 900;
            font-style: italic;
        }
    </style>
</head>
<body>
    <div class="card__container">
        <div class="card">
            <div class="profile">
                <div class="avatar">
                    <img src="{{ asset('assets/circle-user-solid.svg') }}" alt="user-icon">
                </div>
                <h2 class="poppins-bold">{{ $contactCard->name }}</h2>
                <p class="role-company poppins-light">
                    @if ($contactCard->position && $contactCard->company)
                        {{ $contactCard->position }} at {{ $contactCard->company }}
                    @elseif ($contactCard->position)
                        {{ $contactCard->position }}
                    @elseif ($contactCard->company)
                        {{ $contactCard->company }}
                    @endif
                </p>
            </div>

            @foreach($contactCard->phone_numbers as $phone)
            <div class="contact-item">
                <img class="icon" src="{{ asset('assets/phone-solid.svg') }}" alt="phone-icon">
                <span class="text poppins-light">{{ $phone['type'] }}: {{ $phone['number'] }}</span>
            </div>
            @endforeach

            <div class="contact-item">
                <img class="icon" src="{{ asset('assets/envelope-solid.svg') }}" alt="email-icon">
                <!-- Email icon -->
                <span class="text poppins-light">{{ $contactCard->email }}</span>
            </div>
            <div class="contact-item">
                <img class="icon" src="{{ asset('assets/globe-solid.svg') }}" alt="website-icon">
                <!-- Globe icon -->
                <span class="text poppins-light">{{ $contactCard->website }}</span>
            </div>

            <div class="secured-by poppins-light">
                <p>
                    Secured by
                    <img class="qrla" src="{{ asset('assets/qrla.png') }}" alt="QRLA Logo">
                </p>
            </div>
        </div>
        <div class="add-to-contacts">
            <a href="{{ route('contact_cards.download', ['short_code' => $short_code]) }}" class="poppins-bold button__add-to-contacts">
                Add to Contacts
                <img id="addToContactIcon" src="{{ asset('assets/addContact.svg') }}">
            </a>
        </div>
    </div>
</body>
</html>
