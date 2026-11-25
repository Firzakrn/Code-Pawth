
<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">

    <meta name="viewport"
          content="width=device-width, initial-scale=1.0">

    <title>@yield('title', 'Dashboard') — CodePawth</title>

    <link
        href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap"
        rel="stylesheet">

    <style>
        * {
            box-sizing: border-box;
        }

        body {
            margin: 0;
            font-family: 'Plus Jakarta Sans', sans-serif;
            background: #f7fbff;
            color: #344b65;
        }

        .container {
            width: min(1120px, 92%);
            margin: auto;
        }

        .topbar {
            background: white;
            border-bottom: 1px solid #e1ecf6;
        }

        .nav {
            min-height: 76px;
            display: flex;
            justify-content: space-between;
            align-items: center;
            gap: 16px;
        }

        .brand {
            font-size: 21px;
            font-weight: 800;
            color: #344b65;
            text-decoration: none;
        }

        .nav-actions {
            display: flex;
            align-items: center;
            gap: 14px;
        }

        .nav-actions a {
            color: #719bc3;
            font-size: 13px;
            font-weight: 700;
            text-decoration: none;
        }

        main {
            padding: 45px 0;
        }

        h1 {
            font-size: 32px;
        }

        h2 {
            font-size: 20px;
        }

        .muted {
            color: #8295a9;
            font-size: 13px;
            line-height: 1.8;
        }

        .eyebrow {
            font-size: 11px;
            color: #719bc3;
            font-weight: 800;
        }

        .section {
            margin-top: 30px;
        }

        .grid {
            display: grid;
            grid-template-columns: repeat(2, 1fr);
            gap: 20px;
        }

        .card {
            padding: 25px;
            border-radius: 22px;
            border: 1px solid #e1ecf6;
            background: white;
        }

        .card.soft {
            background: #eaf4ff;
        }

        .emoji {
            font-size: 32px;
        }

        .button {
            display: inline-block;
            padding: 12px 18px;
            border: none;
            border-radius: 12px;
            background: #719bc3;
            color: white;
            font: inherit;
            font-size: 12px;
            font-weight: 800;
            text-decoration: none;
            cursor: pointer;
        }

        .button.secondary {
            color: #537caa;
            background: #d9ebfb;
        }

        .field {
            display: flex;
            flex-direction: column;
            gap: 8px;
            margin-bottom: 15px;
        }

        .field label {
            font-size: 12px;
            font-weight: 700;
        }

        .field input,
        .field select {
            width: 100%;
            padding: 12px;
            border: 1px solid #d7e7f5;
            border-radius: 11px;
        }

        .class-item {
            display: flex;
            justify-content: space-between;
            align-items: center;
            gap: 12px;
            padding: 15px;
            margin-top: 12px;
            background: #f8fbff;
            border-radius: 12px;
        }

        .pill {
            padding: 7px 12px;
            background: #e1efff;
            color: #537caa;
            border-radius: 20px;
            font-size: 11px;
            font-weight: 700;
        }

        .alert {
            padding: 13px;
            margin-bottom: 20px;
            border-radius: 12px;
        }

        .success {
            background: #eaf9f1;
            color: #24795a;
        }

        .error {
            background: #fff1f2;
            color: #b95062;
        }

        @media (max-width: 700px) {
            .grid {
                grid-template-columns: 1fr;
            }

            .nav {
                flex-wrap: wrap;
                padding: 15px 0;
            }

            h1 {
                font-size: 25px;
            }
        }
    </style>

    @stack('styles')
</head>

<body>

    <header class="topbar">

        <nav class="container nav">

            <a href="{{ route('home') }}"
               class="brand">
                🐾 CodePawth
            </a>

            <div class="nav-actions">

                <a href="{{ route('dashboard') }}">
                    Dashboard
                </a>

                @if (auth()->user()->role === 'murid')
                    <a href="{{ route('level-view') }}">
                        Belajar Mandiri
                    </a>
                @endif

                <form method="POST"
                      action="{{ route('logout') }}">
                    @csrf

                    <button type="submit" class="button">
                        Keluar
                    </button>
                </form>

            </div>

        </nav>

    </header>

    <main class="container">

        @if (session('success'))
            <div class="alert success">
                {{ session('success') }}
            </div>
        @endif

        @if ($errors->any())
            <div class="alert error">

                @foreach ($errors->all() as $error)
                    <p>{{ $error }}</p>
                @endforeach

            </div>
        @endif

        @yield('content')

    </main>

    @stack('scripts')

</body>
</html>