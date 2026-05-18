<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ruang Pulih</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">
    <style>
        * {
            box-sizing: border-box;
            margin: 0;
            padding: 0;
        }

        html,
        body {
            width: 100%;
            height: 100%;
            overflow: hidden;
            font-family: Arial, sans-serif;
        }

        .home-page {
            align-items: center;
            background-image: url("{{ asset('assets/images/background.png') }}");
            background-position: center;
            background-repeat: no-repeat;
            background-size: cover;
            display: flex;
            flex-direction: column;
            height: 100vh;
            justify-content: flex-start;
            min-height: 720px;
            padding: 38px 24px 48px;
            text-align: center;
        }

        .home-title {
            color: #2b7d4f;
            font-size: clamp(44px, 4.6vw, 72px);
            font-weight: 800;
            line-height: 1.08;
            margin-top: 0;
        }

        .home-subtitle {
            color: #2b7d4f;
            font-size: clamp(24px, 2.1vw, 36px);
            line-height: 1.25;
            margin-top: 26px;
            max-width: 760px;
        }

        .home-logo {
            background: #fff;
            border-radius: 50%;
            height: clamp(180px, 18vw, 310px);
            margin-top: 26px;
            object-fit: contain;
            width: clamp(180px, 18vw, 310px);
        }

        .start-button {
            align-items: center;
            background: #2f8658;
            border-radius: 36px;
            box-shadow: 0 6px 12px rgba(0, 0, 0, 0.22);
            color: #fff;
            display: inline-flex;
            font-size: clamp(22px, 1.7vw, 30px);
            font-weight: 800;
            gap: 14px;
            justify-content: center;
            margin-top: 28px;
            min-width: min(360px, 82vw);
            padding: 17px 38px;
            text-decoration: none;
        }

        .start-button:hover {
            background: #267348;
        }

        @media (max-height: 820px) {
            .home-page {
                min-height: 640px;
                padding-top: 28px;
            }

            .home-subtitle {
                margin-top: 16px;
            }

            .home-logo {
                margin-top: 18px;
            }

            .start-button {
                margin-top: 20px;
                padding: 15px 34px;
            }
        }

        @media (max-width: 640px) {
            .home-page {
                min-height: 100vh;
                padding-top: 42px;
            }

            .home-title {
                font-size: 40px;
            }

            .home-subtitle {
                font-size: 22px;
            }

            .home-logo {
                height: 180px;
                width: 180px;
            }

            .start-button {
                border-radius: 22px;
                font-size: 22px;
                min-width: 0;
                padding: 14px 28px;
            }
        }
    </style>
</head>
<body>
    <main class="home-page">
        <h1 class="home-title">
            Selamat Datang di<br>
            Ruang Pulih <i class="fa-solid fa-leaf" aria-hidden="true"></i>
        </h1>

        <p class="home-subtitle">
            Ruang aman untuk memahami dan menjaga<br>
            kesehatan mentalmu.
        </p>

        <img class="home-logo" src="{{ asset('assets/images/logo.png') }}" alt="Logo Ruang Pulih">

        <a class="start-button" href="{{ route('edukasi.index') }}">
            Mulai Sekarang <i class="fa-solid fa-arrow-right" aria-hidden="true"></i>
        </a>
    </main>
</body>
</html>
