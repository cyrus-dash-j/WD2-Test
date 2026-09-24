@props(['student'])

<style>
    /* Sculpted 3D Isometric Float Profile Card */
    .student-card { 
        background: #ffffff; 
        border: 1px solid rgba(255, 255, 255, 0.8);
        border-radius: 24px; 
        padding: 28px; 
        display: flex; 
        flex-direction: column; 
        align-items: center; 
        text-align: center; 
        position: relative; 
        transition: transform 0.3s cubic-bezier(0.175, 0.885, 0.32, 1.275), box-shadow 0.3s ease, border-color 0.3s ease; 
        cursor: pointer;
        /* Layered multi-stage 3D ambient shadow definitions */
        box-shadow: 
            0 4px 6px -1px rgba(0, 0, 0, 0.05), 
            0 10px 20px -5px rgba(0, 0, 0, 0.05), 
            0 20px 30px -10px rgba(0, 0, 0, 0.05),
            inset 0 1px 0 #ffffff;
        transform-style: preserve-3d;
        transform: perspective(1000px) rotateX(0deg) rotateY(0deg) translateZ(0px);
    }
    
    /* Pop-forward volumetric elevation mapping on cursor hover */
    .student-card:hover { 
        transform: perspective(1000px) rotateX(4deg) rotateY(-2deg) translateZ(25px) translateY(-6px);
        border-color: rgba(255, 255, 255, 1);
        box-shadow: 
            0 10px 15px -3px rgba(0, 0, 0, 0.03), 
            0 25px 40px -10px rgba(0, 0, 0, 0.08), 
            0 40px 60px -15px rgba(0, 0, 0, 0.12),
            inset 0 1px 0 #ffffff;
    }
    
    /* Floating Beveled Ribbon Tag Component */
    .year-badge { 
        position: absolute; 
        top: 18px; 
        right: 18px; 
        background: linear-gradient(135deg, #f8fafc 0%, #e2e8f0 100%); 
        color: #475569; 
        font-size: 11px; 
        font-weight: 700; 
        padding: 5px 12px; 
        border-radius: 30px; 
        border: 1px solid #cbd5e1; 
        text-transform: uppercase; 
        transform: translateZ(15px); /* Forces element to hover physically in mid-air above card */
        box-shadow: 0 4px 8px rgba(0,0,0,0.05);
    }
    
    /* Convex Frame 3D Avatar Profile Image Ring */
    .card-avatar, .card-avatar-placeholder { 
        width: 96px; 
        height: 96px; 
        border-radius: 50%; 
        margin-bottom: 20px; 
        border: 4px solid #ffffff; 
        transform: translateZ(30px); /* Extrudes avatar out furthest from card baseline background */
        box-shadow: 0 8px 20px rgba(0,0,0,0.12);
    }
    .card-avatar { object-fit: cover; background: #f8fafc; }
    .card-avatar-placeholder { 
        background: linear-gradient(135deg, #e0e7ff 0%, #c7d2fe 100%); 
        color: #4f46e5; 
        display: flex; 
        align-items: center; 
        justify-content: center; 
        font-weight: 700; 
        font-size: 26px; 
    }
    
    .card-name { font-size: 19px; font-weight: 800; color: #0f172a; letter-spacing: -0.4px; margin-bottom: 4px; transform: translateZ(15px); }
    .card-id { font-size: 11px; color: #94a3b8; font-family: monospace; margin-bottom: 14px; transform: translateZ(10px); display: block; }
    
    /* Glossy Plastic Injection Pill Capsule Program Badge */
    .badge-program { 
        display: inline-flex; 
        padding: 5px 14px; 
        font-size: 12px; 
        font-weight: 700; 
        border-radius: 8px; 
        background: linear-gradient(180deg, #eff6ff 0%, #dbeafe 100%); 
        color: #1e40af; 
        border: 1px solid #bfdbfe; 
        margin-bottom: 20px; 
        transform: translateZ(20px);
        box-shadow: 0 4px 10px rgba(30, 64, 175, 0.08);
    }
    
    /* Solid Base Panel Data Matrix row mapping */
    .card-info-row { 
        width: 100%; 
        background: #f8fafc;
        border-radius: 14px;
        border: 1px solid #edf2f7;
        padding: 14px 16px; 
        margin-top: auto; 
        display: flex; 
        flex-direction: column; 
        gap: 8px; 
        text-align: left; 
        transform: translateZ(5px);
        box-shadow: inset 0 1px 3px rgba(0,0,0,0.02);
    }
    .info-item { font-size: 13px; color: #334155; display: flex; justify-content: space-between; align-items: center; }
    .info-label { color: #64748b; font-size: 12px; font-weight: 500; }
    .info-value { font-weight: 600; text-align: right; color: #1e293b; }
    
    /* Action Controls row structure */
    .card-actions { width: 100%; display: grid; grid-template-columns: 1fr 1fr; gap: 10px; margin-top: 20px; transform: translateZ(12px); }
</style>

<div class="student-card" 
     data-name="{{ strtolower($student->firstname . ' ' . $student->lastname) }}"
    data-program="{{ $student->program }}"
    data-searchable="{{ strtolower($student->id . ' ' . $student->year . ' ' . $student->school . ' ' . $student->province . ' ' . $student->country) }}"
     onclick="window.location='{{ route('students.show', $student->id) }}'">
    
    <span class="year-badge">Yr {{ $student->year }}</span>

    @if($student->profile_image)
        <img src="{{ asset('storage/' . $student->profile_image) }}" class="card-avatar" alt="Profile">
    @else
        <div class="card-avatar-placeholder">
            {{ strtoupper(substr($student->firstname, 0, 1) . substr($student->lastname, 0, 1)) }}
        </div>
    @endif

    <h3 class="card-name">{{ $student->lastname }}, {{ $student->firstname }}</h3>
    <span class="card-id">ID#{{ $student->id }}</span>
    
    <span class="badge-program">{{ $student->program }}</span>

    <div class="card-info-row">
        <div class="info-item">
            <span class="info-label">College</span>
            <span class="info-value">{{ $student->school }}</span>
        </div>
        <div class="info-item">
            <span class="info-label">Region</span>
            <span class="info-value" style="font-size:12px;">{{ $student->province }}, {{ $student->country }}</span>
        </div>
    </div>

    @auth
        <div class="card-actions" onclick="event.stopPropagation();">
            <a href="{{ route('students.edit', $student->id) }}" class="btn btn-secondary btn-sm" style="color: #d97706;">Edit Profile</a>
            <form action="{{ route('students.destroy', $student->id) }}" method="POST" onsubmit="return confirm('Permanently delete this student record?');" style="width:100%; margin:0;">
                @csrf
                @method('DELETE')
                <button type="submit" class="btn btn-danger btn-sm" style="width: 100%;">Delete</button>
            </form>
        </div>
    @endauth
</div>
