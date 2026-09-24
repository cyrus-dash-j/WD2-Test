<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', 'Student Directory') - AMA University</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=DM+Sans:wght@400;500;600;700&family=Space+Grotesk:wght@500;600;700&display=swap" rel="stylesheet">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <style>
        :root { --ama-blue: #062f6b; --ama-blue-deep: #041d43; --ama-red: #d71920; --ama-gold: #f5b335; --ink: #17243a; --muted: #6b7890; --line: #dfe6f0; }
        * { box-sizing: border-box; }
        body { margin: 0; min-height: 100vh; background: #f4f7fb; color: var(--ink); font-family: 'DM Sans', sans-serif; }
        a { color: inherit; }
        .sidebar { width: 272px; min-height: 100vh; position: fixed; z-index: 20; display: flex; flex-direction: column; padding: 28px 18px; background: linear-gradient(160deg, var(--ama-blue-deep), var(--ama-blue)); color: #fff; box-shadow: 12px 0 30px rgba(4, 29, 67, .12); }
        .brand { display: flex; align-items: center; gap: 12px; padding: 0 12px 28px; border-bottom: 1px solid rgba(255,255,255,.16); text-decoration: none; }
        .brand-mark { width: 42px; height: 42px; display: grid; place-items: center; border-radius: 12px; background: var(--ama-red); color: #fff; font-family: 'Space Grotesk', sans-serif; font-weight: 700; box-shadow: 0 6px 16px rgba(215,25,32,.3); }
        .brand strong { display: block; font-family: 'Space Grotesk', sans-serif; font-size: 15px; letter-spacing: .02em; }
        .brand small { display: block; margin-top: 3px; color: #b9c8df; font-size: 11px; }
        .sidebar-menu { display: flex; flex: 1; flex-direction: column; gap: 8px; padding: 28px 0; margin: 0; list-style: none; }
        .sidebar-item a { display: flex; align-items: center; gap: 10px; padding: 13px 14px; border-radius: 10px; color: #c3d1e8; text-decoration: none; font-weight: 600; transition: .2s ease; }
        .sidebar-item a:hover, .sidebar-item.active a { background: rgba(255,255,255,.12); color: #fff; }
        .sidebar-item.active a { box-shadow: inset 3px 0 var(--ama-gold); }
        .sidebar-foot { padding: 14px; border-top: 1px solid rgba(255,255,255,.16); color: #b9c8df; font-size: 12px; line-height: 1.5; }
        .main-content { min-width: 0; margin-left: 272px; }
        .top-navbar { min-height: 78px; position: sticky; top: 0; z-index: 10; display: flex; align-items: center; justify-content: space-between; gap: 20px; padding: 14px 42px; background: rgba(255,255,255,.92); border-bottom: 1px solid var(--line); backdrop-filter: blur(14px); }
        .welcome-label { color: var(--muted); font-size: 14px; font-weight: 600; }
        .welcome-label strong { color: var(--ama-blue); }
        .account { position: relative; }
        .account-trigger { display: flex; align-items: center; gap: 10px; padding: 4px 8px 4px 4px; border: 1px solid transparent; border-radius: 12px; background: transparent; cursor: pointer; color: var(--ink); }
        .account-trigger:hover, .account-trigger:focus { border-color: var(--line); background: #f7f9fc; outline: none; }
        .avatar { width: 40px; height: 40px; display: grid; place-items: center; border-radius: 50%; background: var(--ama-red); color: #fff; font-family: 'Space Grotesk', sans-serif; font-weight: 700; }
        .account-name { max-width: 190px; overflow: hidden; text-overflow: ellipsis; white-space: nowrap; font-size: 13px; font-weight: 700; }
        .chevron { width: 8px; height: 8px; border-right: 2px solid currentColor; border-bottom: 2px solid currentColor; transform: rotate(45deg) translateY(-2px); }
        .account-menu { position: absolute; right: 0; top: calc(100% + 10px); width: 220px; padding: 8px; border: 1px solid var(--line); border-radius: 14px; background: #fff; box-shadow: 0 18px 38px rgba(4,29,67,.16); }
        .account-menu a, .account-menu button { display: block; width: 100%; padding: 11px 12px; border: 0; border-radius: 9px; background: transparent; color: var(--ink); text-align: left; text-decoration: none; font: inherit; font-size: 13px; cursor: pointer; }
        .account-menu a:hover, .account-menu button:hover { background: #f1f5fa; color: var(--ama-blue); }
        .account-meta { padding: 9px 12px 12px; border-bottom: 1px solid var(--line); margin-bottom: 5px; }
        .account-meta strong { display: block; font-size: 13px; }
        .account-meta small { display: block; margin-top: 3px; color: var(--muted); font-size: 11px; overflow: hidden; text-overflow: ellipsis; white-space: nowrap; }
        .guest-actions { display: flex; align-items: center; gap: 10px; }
        .guest-actions a { color: var(--ama-blue); font-size: 13px; font-weight: 700; text-decoration: none; }
        .content-body { width: 100%; max-width: 1440px; margin: 0 auto; padding: 42px; }
        .btn { display: inline-flex; align-items: center; justify-content: center; gap: 8px; padding: 11px 18px; border: 0; border-radius: 9px; cursor: pointer; font: inherit; font-size: 13px; font-weight: 700; text-decoration: none; transition: .2s ease; }
        .btn-primary { background: var(--ama-red); color: #fff; box-shadow: 0 5px 12px rgba(215,25,32,.2); }
        .btn-primary:hover { background: #b9141a; transform: translateY(-1px); }
        .btn-secondary { background: #fff; border: 1px solid var(--line); color: var(--ama-blue); }
        .btn-secondary:hover { border-color: var(--ama-blue); background: #f6f9fd; }
        .btn-warning { background: var(--ama-gold); color: #382400; }
        .btn-danger { background: var(--ama-red); color: #fff; }
        .btn-sm { padding: 8px 11px; font-size: 12px; }
        .alert-success { margin-bottom: 24px; padding: 14px 16px; border-left: 4px solid #1e9b68; border-radius: 8px; background: #eaf8f0; color: #17613f; font-weight: 600; }
        [x-cloak] { display: none !important; }
        @media (max-width: 800px) { .sidebar { width: 76px; padding: 18px 10px; } .brand { justify-content: center; padding: 0 0 20px; } .brand-copy, .sidebar-item span, .sidebar-foot { display: none; } .sidebar-item a { justify-content: center; padding: 13px 0; } .main-content { margin-left: 76px; } .top-navbar { padding: 12px 20px; } .account-name, .chevron { display: none; } .content-body { padding: 28px 20px; } }
    @media (max-width: 520px) { .welcome-label { font-size: 12px; } .guest-actions a:first-child { display: none; } .content-body { padding: 22px 14px; } }
    </style>
    @yield('styles')
</head>
<body>
    <aside class="sidebar">
        <a class="brand" href="{{ route('students.index') }}"><span class="brand-mark">A</span><span class="brand-copy"><strong>SRMS</strong><small>Student Directory</small></span></a>
        <ul class="sidebar-menu">
            <li class="sidebar-item active"><a href="{{ route('students.index') }}"><span aria-hidden="true">▦</span><span>Students</span></a></li>
            @auth
                <li class="sidebar-item"><a href="{{ route('students.create') }}"><span aria-hidden="true">＋</span><span>Add student</span></a></li>
            @endauth
        </ul>
        <div class="sidebar-foot">SRMS<br>Student records portal</div>
    </aside>
    <div class="main-content">
        <header class="top-navbar">
            <div class="welcome-label">@auth <strong>Welcome {{ Auth::user()->email }}</strong> @else <strong>Welcome Guest</strong> @endauth</div>
            @auth
                <div class="account" x-data="{ open: false }" @click.outside="open = false" @keydown.escape.window="open = false">
                    <button type="button" class="account-trigger" @click="open = !open" :aria-expanded="open.toString()" aria-label="Open account menu"><span class="avatar">{{ strtoupper(substr(Auth::user()->name, 0, 2)) }}</span><span class="account-name">{{ Auth::user()->name }}</span><span class="chevron" aria-hidden="true"></span></button>
                    <div x-cloak x-show="open" x-transition class="account-menu"><div class="account-meta"><strong>{{ Auth::user()->name }}</strong><small>{{ Auth::user()->email }}</small></div><a href="{{ route('dashboard') }}">Dashboard</a><a href="{{ route('profile.edit') }}">Profile settings</a><form method="POST" action="{{ route('logout') }}">@csrf<button type="submit">Log out</button></form></div>
                </div>
            @else
                <div class="guest-actions"><a href="{{ route('login') }}">Log in</a><a class="btn btn-primary" href="{{ route('register') }}">Create account</a></div>
            @endauth
        </header>
        <main class="content-body">@if(session('success')) <div class="alert-success">{{ session('success') }}</div> @endif @yield('content') @isset($slot) {{ $slot }} @endisset</main>
    </div>
    @yield('scripts')
</body>
</html>
