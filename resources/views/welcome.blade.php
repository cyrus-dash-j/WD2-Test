<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Student Record Management System</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=DM+Sans:wght@400;500;600;700&family=Space+Grotesk:wght@500;600;700&display=swap" rel="stylesheet">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <style>
        :root { --blue: #062f6b; --deep: #041d43; --red: #d71920; --gold: #f5b335; --ink: #17243a; --muted: #6b7890; --line: #dfe6f0; }
        * { box-sizing: border-box; }
        body { margin: 0; color: var(--ink); background: #f4f7fb; font-family: 'DM Sans', sans-serif; }
        a { color: inherit; }
        .landing { min-height: 100vh; background: radial-gradient(circle at 80% 12%, rgba(245,179,53,.23), transparent 28%), #f4f7fb; }
        .landing-nav { width: min(1180px, calc(100% - 40px)); margin: auto; padding: 24px 0; display: flex; align-items: center; justify-content: space-between; }
        .landing-brand { display: flex; align-items: center; gap: 11px; color: var(--deep); text-decoration: none; font-family: 'Space Grotesk', sans-serif; font-weight: 700; }
        .mark { width: 40px; height: 40px; display: grid; place-items: center; border-radius: 11px; color: #fff; background: var(--red); }
        .landing-actions { display: flex; align-items: center; gap: 18px; font-size: 13px; font-weight: 700; }
        .landing-actions a { text-decoration: none; }
        .landing-actions .action { padding: 10px 15px; border-radius: 8px; color: #fff; background: var(--red); }
        .hero { width: min(1180px, calc(100% - 40px)); margin: auto; padding: 80px 0 90px; display: grid; grid-template-columns: 1.05fr .95fr; gap: 70px; align-items: center; }
        .eyebrow { color: var(--red); font-size: 12px; font-weight: 700; letter-spacing: .14em; text-transform: uppercase; }
        h1 { max-width: 650px; margin: 15px 0 20px; color: var(--deep); font-family: 'Space Grotesk', sans-serif; font-size: clamp(42px, 7vw, 80px); line-height: .98; letter-spacing: -.04em; }
        .hero-copy { max-width: 520px; color: var(--muted); font-size: 17px; line-height: 1.7; }
        .hero-actions { display: flex; flex-wrap: wrap; gap: 12px; margin-top: 30px; }
        .hero-actions a { padding: 13px 18px; border-radius: 9px; font-size: 13px; font-weight: 700; text-decoration: none; }
        .primary { color: #fff; background: var(--red); box-shadow: 0 8px 16px rgba(215,25,32,.2); }
        .secondary { color: var(--blue); border: 1px solid var(--line); background: #fff; }
        .hero-panel { position: relative; min-height: 370px; padding: 26px; overflow: hidden; border-radius: 22px; background: var(--blue); color: #fff; box-shadow: 0 20px 45px rgba(4,29,67,.18); }
        .hero-panel:after { content: ''; position: absolute; width: 220px; height: 220px; right: -75px; bottom: -90px; border: 34px solid rgba(245,179,53,.8); border-radius: 50%; }
        .panel-label { position: relative; z-index: 1; color: #b9c8df; font-size: 12px; font-weight: 700; letter-spacing: .12em; text-transform: uppercase; }
        .panel-number { position: relative; z-index: 1; margin-top: 42px; font-family: 'Space Grotesk', sans-serif; font-size: 82px; line-height: 1; }
        .panel-caption { position: relative; z-index: 1; max-width: 220px; margin-top: 8px; color: #dce6f4; line-height: 1.5; }
        .preview { width: min(1180px, calc(100% - 40px)); margin: auto; padding: 0 0 70px; }
        .preview-head { display: flex; justify-content: space-between; align-items: end; gap: 20px; margin-bottom: 18px; }
        .preview h2 { margin: 0; color: var(--deep); font-family: 'Space Grotesk', sans-serif; font-size: 27px; }
        .preview-head a { color: var(--red); font-size: 13px; font-weight: 700; text-decoration: none; }
        .preview-grid { display: grid; grid-template-columns: repeat(3, 1fr); gap: 14px; }
        .preview-card { padding: 18px; border: 1px solid var(--line); border-radius: 12px; background: #fff; }
        .preview-card strong { display: block; color: var(--deep); font-family: 'Space Grotesk', sans-serif; }
        .preview-card span { display: block; margin-top: 7px; color: var(--muted); font-size: 12px; }
        @media (max-width: 760px) { .hero { grid-template-columns: 1fr; gap: 36px; padding: 45px 0 60px; } .hero-panel { min-height: 250px; } .preview-grid { grid-template-columns: 1fr; } }
        @media (max-width: 480px) { .landing-nav, .hero, .preview { width: min(100% - 28px, 1180px); } .landing-actions a:first-child { display: none; } h1 { font-size: 48px; } }
    </style>
</head>
<body>
    <div class="landing">
        <nav class="landing-nav"><a class="landing-brand" href="{{ route('students.index') }}"><span class="mark">A</span><span>AJAX University<br><small style="font-family: 'DM Sans', sans-serif; color: var(--muted); font-size: 11px; font-weight: 500;">Student Record Management System</small></span></a><div class="landing-actions">@auth<a href="{{ route('profile.edit') }}">Profile</a><a class="action" href="{{ route('students.index') }}">Open directory</a>@else<a href="{{ route('login') }}">Log in</a><a class="action" href="{{ route('register') }}">Register</a>@endauth</div></nav>
        <main>
            <section class="hero"><div><div class="eyebrow"></div><h1>Student records</h1><p class="hero-copy"><div class="hero-actions"><a class="primary" href="{{ route('students.index') }}">Browse directory</a>@guest<a class="secondary" href="{{ route('login') }}">Sign in to manage</a>@endguest</div></div><div class="hero-panel"><div class="panel-label">Public directory</div><div class="panel-number">{{ $students->count() }}</div><div class="panel-caption">Student records ready to explore</div></div></section>
            <section class="preview"><div class="preview-head"><h2>Recent records</h2><a href="{{ route('students.index') }}">View all records →</a></div><div class="preview-grid">@forelse($students as $student)<a class="preview-card" href="{{ route('students.show', $student) }}"><strong>{{ $student->lastname }}, {{ $student->firstname }}</strong><span>{{ $student->program }} · {{ $student->school }}</span></a>@empty<div class="preview-card"><strong>No records yet</strong><span>The directory is ready for its first student profile.</span></div>@endforelse</div></section>
        </main>
    </div>
</body>
</html>
