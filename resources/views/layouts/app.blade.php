<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Dashboard') - Student System</title>
    <link href="https://googleapis.com" rel="stylesheet">
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <style>
        * { box-sizing: border-box; margin: 0; padding: 0; font-family: 'Inter', sans-serif; }
        
        /* 3D Global Environment Background Layer */
        body { 
            background: radial-gradient(circle at 50% 0%, #f8fafc 0%, #e2e8f0 100%); 
            color: #1f2937; 
            display: flex; 
            min-height: 100vh; 
            overflow-x: hidden; 
            perspective: 1000px; /* Activates global 3D workspace engine */
        }
        
        /* 3D Sidebar - Looks like a solid block jutting out */
        .sidebar { 
            width: 260px; 
            background: linear-gradient(135deg, #1e293b 0%, #0f172a 100%); 
            color: #ffffff; 
            display: flex; 
            flex-direction: column; 
            position: fixed; 
            height: 100vh; 
            z-index: 20;
            box-shadow: 5px 0 25px rgba(0, 0, 0, 0.15), inset -1px 0 0 rgba(255,255,255,0.05);
        }
        .sidebar-brand { 
            padding: 24px; 
            font-size: 20px; 
            font-weight: 700; 
            letter-spacing: -0.5px; 
            border-bottom: 1px solid #334155; 
            text-shadow: 0 2px 4px rgba(0,0,0,0.3);
        }
        .sidebar-menu { list-style: none; padding: 24px 16px; display: flex; flex-direction: column; gap: 12px; flex: 1; }
        .sidebar-item a { display: flex; align-items: center; padding: 14px 16px; color: #94a3b8; text-decoration: none; font-weight: 500; border-radius: 10px; transition: all 0.2s cubic-bezier(0.4, 0, 0.2, 1); }
        
        /* Active item appears pushed forward */
        .sidebar-item.active a { 
            background: linear-gradient(135deg, #3b82f6 0%, #1d4ed8 100%); 
            color: #ffffff; 
            transform: translateZ(10px);
            box-shadow: 0 4px 15px rgba(29, 78, 216, 0.35), inset 0 1px 0 rgba(255,255,255,0.2);
        }
        .sidebar-item a:hover:not(.active) { background-color: rgba(255,255,255,0.05); color: #ffffff; }
        
        .main-content { margin-left: 260px; flex: 1; min-width: 0; display: flex; flex-direction: column; }
        
        /* Floating Navbar Layer */
        .top-navbar { 
            height: 70px; 
            background: rgba(255, 255, 255, 0.85); 
            backdrop-filter: blur(12px);
            border-bottom: 1px solid rgba(226, 232, 240, 0.8); 
            display: flex; 
            align-items: center; 
            justify-content: space-between; 
            padding: 0 40px; 
            position: sticky; 
            top: 0; 
            z-index: 10; 
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.02);
        }
        .content-body { padding: 40px; max-width: 1400px; width: 100%; margin: 0 auto; }
        
        /* Premium 3D Beveled Buttons */
        .btn { 
            display: inline-flex; 
            align-items: center; 
            justify-content: center; 
            padding: 10px 20px; 
            font-size: 14px; 
            font-weight: 600; 
            border-radius: 10px; 
            border: none; 
            cursor: pointer; 
            text-decoration: none; 
            transition: all 0.15s cubic-bezier(0.4, 0, 0.2, 1); 
            transform-style: preserve-3d;
        }
        .btn-primary { 
            background: linear-gradient(180deg, #3b82f6 0%, #2563eb 100%); 
            color: #ffffff; 
            box-shadow: 0 4px 0 #1d4ed8, 0 6px 12px rgba(37, 99, 235, 0.25);
        }
        .btn-primary:hover { transform: translateY(-1px); box-shadow: 0 5px 0 #1d4ed8, 0 8px 16px rgba(37, 99, 235, 0.3); }
        .btn-primary:active { transform: translateY(3px); box-shadow: 0 1px 0 #1d4ed8, 0 2px 4px rgba(37, 99, 235, 0.2); }
        
        .btn-secondary { 
            background: linear-gradient(180deg, #ffffff 0%, #f1f5f9 100%); 
            border: 1px solid #cbd5e1; color: #334155; 
            box-shadow: 0 3px 0 #cbd5e1, 0 4px 8px rgba(0,0,0,0.03);
        }
        .btn-secondary:hover { transform: translateY(-1px); box-shadow: 0 4px 0 #cbd5e1, 0 6px 12px rgba(0,0,0,0.05); }
        .btn-secondary:active { transform: translateY(2px); box-shadow: 0 1px 0 #cbd5e1, 0 1px 3px rgba(0,0,0,0.05); }

        .btn-warning { 
            background: linear-gradient(180deg, #fbbf24 0%, #f59e0b 100%); color: white;
            box-shadow: 0 3px 0 #b45309, 0 4px 8px rgba(245, 158, 11, 0.2);
        }
        .btn-warning:hover { transform: translateY(-1px); box-shadow: 0 4px 0 #b45309, 0 6px 12px rgba(245, 158, 11, 0.3); }
        .btn-warning:active { transform: translateY(2px); box-shadow: 0 1px 0 #b45309, 0 1px 3px rgba(245, 158, 11, 0.1); }

        .btn-danger { 
            background: linear-gradient(180deg, #f87171 0%, #ef4444 100%); color: white;
            box-shadow: 0 3px 0 #b91c1c, 0 4px 8px rgba(239, 68, 68, 0.2);
        }
        .btn-danger:hover { transform: translateY(-1px); box-shadow: 0 4px 0 #b91c1c, 0 6px 12px rgba(239, 68, 68, 0.3); }
        .btn-danger:active { transform: translateY(2px); box-shadow: 0 1px 0 #b91c1c, 0 1px 3px rgba(239, 68, 68, 0.1); }

        .btn-sm { padding: 6px 12px; font-size: 12px; border-radius: 8px; }
        .alert-success { background: #ecfdf5; border-left: 5px solid #10b981; color: #065f46; padding: 16px; border-radius: 12px; margin-bottom: 24px; box-shadow: 0 4px 12px rgba(16, 185, 129, 0.1); font-weight: 500; }
    </style>
    @yield('styles')
</head>
<body>

    <div class="sidebar">
        <div class="sidebar-brand"> Student Management System</div>
        <ul class="sidebar-menu">
            <li class="sidebar-item active">
                <a href="{{ route('students.index') }}">Students</a>
            </li>
            @auth
            <li class="sidebar-item" style="margin-top: auto; padding-top: 20px;">
                <form method="POST" action="{{ route('logout') }}" id="logout-form" style="display: none;">@csrf</form>
                <a href="#" onclick="event.preventDefault(); document.getElementById('logout-form').submit();" style="color: #f87171;">Logout</a>
            </li>
            @endauth
        </ul>
    </div>

    <div class="main-content">
        <header class="top-navbar">
            <div style="font-weight: 600; color: #475569;">@auth  {{ Auth::user()->name }} @else System Access @endauth</div>
            <div style="width: 42px; height: 42px; border-radius: 50%; background: linear-gradient(135deg, #cbd5e1 0%, #94a3b8 100%); display: flex; align-items: center; justify-content: center; font-weight: bold; color: #ffffff; box-shadow: 0 2px 8px rgba(0,0,0,0.1);">
                @auth {{ strtoupper(substr(Auth::user()->name, 0, 2)) }} @else GS @endauth
            </div>
        </header>

        <main class="content-body">
            @if(session('success')) <div class="alert-success">{{ session('success') }}</div> @endif
            @yield('content')
            @isset($slot) {{ $slot }} @endisset
        </main>
    </div>

</body>
</html>
