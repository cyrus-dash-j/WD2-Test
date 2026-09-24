<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ config('app.name', 'AMA University') }}</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=DM+Sans:wght@400;500;600;700&family=Space+Grotesk:wght@500;600;700&display=swap" rel="stylesheet">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <style>
        :root { --ama-blue: #062f6b; --ama-blue-deep: #041d43; --ama-red: #d71920; --ama-gold: #f5b335; --ink: #17243a; --muted: #6b7890; }
        * { box-sizing: border-box; }
        body { margin: 0; min-height: 100vh; background: #eef3f9; color: var(--ink); font-family: 'DM Sans', sans-serif; }
        .auth-page { min-height: 100vh; display: grid; place-items: center; padding: 28px 18px; background: radial-gradient(circle at 12% 10%, rgba(245,179,53,.22), transparent 30%), linear-gradient(135deg, #eef3f9, #fff); }
        .auth-layout { width: min(960px, 100%); display: grid; grid-template-columns: .9fr 1.1fr; overflow: hidden; border-radius: 24px; background: #fff; box-shadow: 0 24px 70px rgba(4,29,67,.15); }
        .auth-aside { padding: 48px 38px; background: linear-gradient(155deg, var(--ama-blue-deep), var(--ama-blue)); color: #fff; }
        .auth-mark { width: 46px; height: 46px; display: grid; place-items: center; margin-bottom: 52px; border-radius: 13px; background: var(--ama-red); font-family: 'Space Grotesk', sans-serif; font-size: 21px; font-weight: 700; }
        .auth-aside h1 { margin: 0; font-family: 'Space Grotesk', sans-serif; font-size: clamp(27px, 4vw, 42px); line-height: 1.05; }
        .auth-aside p { max-width: 270px; margin: 18px 0 0; color: #c9d7ea; line-height: 1.65; }
        .auth-aside a { display: inline-block; margin-top: 34px; color: #fff; font-size: 13px; font-weight: 700; text-decoration: none; }
        .auth-form { padding: 48px clamp(26px, 6vw, 68px); }
        .auth-form h2 { margin: 0 0 8px; font-family: 'Space Grotesk', sans-serif; font-size: 30px; color: var(--ama-blue-deep); }
        .auth-form > p { margin: 0 0 28px; color: var(--muted); font-size: 14px; }
        .auth-form label { color: var(--ink); font-size: 13px; font-weight: 700; }
        .auth-form input:not([type=checkbox]) { width: 100%; margin-top: 7px; border: 1px solid #ccd7e6; border-radius: 9px; padding: 12px 13px; color: var(--ink); outline: none; }
        .auth-form input:not([type=checkbox]):focus { border-color: var(--ama-blue); box-shadow: 0 0 0 3px rgba(6,47,107,.12); }
        .auth-form button, .auth-form a { font-family: inherit; }
        .auth-form .auth-button { border: 0; border-radius: 9px; padding: 12px 19px; background: var(--ama-red); color: #fff; cursor: pointer; font-weight: 700; }
        .auth-form .auth-link { color: var(--ama-blue); font-size: 13px; font-weight: 700; text-decoration: none; }
        .auth-form .text-gray-600, .auth-form .text-gray-500 { color: var(--muted); }
        .auth-form .text-red-600 { color: var(--ama-red); }
        @media (max-width: 680px) { .auth-layout { grid-template-columns: 1fr; } .auth-aside { padding: 30px; } .auth-mark { margin-bottom: 28px; } .auth-aside p { margin-top: 12px; } .auth-aside a { margin-top: 18px; } .auth-form { padding: 32px 26px; } }
    </style>
</head>
<body>
    <div class="auth-page"><div class="auth-layout"><aside class="auth-aside"><div class="auth-mark">A</div><h1>Welcome to the student portal.</h1><p>Browse student records publicly or sign in to manage the directory.</p><a href="{{ route('students.index') }}">Browse student directory →</a></aside><main class="auth-form">{{ $slot }}</main></div></div>
</body>
</html>
