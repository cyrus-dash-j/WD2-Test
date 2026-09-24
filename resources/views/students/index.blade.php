@extends('layouts.app')

@section('title', '3D Dashboard')

@section('styles')
<style>
    .page-header { display: flex; align-items: center; justify-content: space-between; margin-bottom: 36px; text-shadow: 0 1px 2px rgba(0,0,0,0.05); }
    .page-title h2 { font-size: 28px; font-weight: 800; color: #0f172a; letter-spacing: -0.75px; }

    /* 3D Extruded Blocks Grid */
    .metrics-grid { display: grid; grid-template-columns: repeat(auto-fit, minmax(220px, 1fr)); gap: 24px; margin-bottom: 36px; }
    .metric-card { 
        background: #ffffff; 
        border: 1px solid rgba(255, 255, 255, 0.7); 
        border-radius: 16px; 
        padding: 24px; 
        display: flex; 
        flex-direction: column; 
        gap: 6px; 
        box-shadow: 0 10px 25px -5px rgba(0,0,0,0.05), 0 8px 16px -6px rgba(0,0,0,0.05), inset 0 1px 0 #ffffff;
        position: relative;
        transform-style: preserve-3d;
        transform: translateZ(0);
        transition: transform 0.2s ease;
    }
    .metric-card:hover { transform: translateZ(15px) translateY(-2px); box-shadow: 0 20px 35px -10px rgba(0,0,0,0.08), inset 0 1px 0 #ffffff; }
    .metric-title { font-size: 12px; font-weight: 700; color: #64748b; text-transform: uppercase; letter-spacing: 0.75px; }
    .metric-value { font-size: 32px; font-weight: 800; color: #0f172a; }

    /* Recessed 3D Filter Bar Layout */
    .filter-bar { 
        background: #f1f5f9; 
        border: 1px solid #e2e8f0; 
        border-radius: 16px; 
        padding: 16px 24px; 
        margin-bottom: 36px; 
        display: flex; 
        gap: 16px; 
        flex-wrap: wrap; 
        align-items: center; 
        box-shadow: inset 0 2px 6px rgba(0, 0, 0, 0.06); /* Carves bar into background layer */
    }
    .search-wrapper { flex: 1; min-width: 260px; }
    .search-input, .filter-select { 
        padding: 12px 18px; 
        border-radius: 10px; 
        border: 1px solid #cbd5e1; 
        font-size: 14px; 
        outline: none; 
        background: #ffffff; 
        box-shadow: 0 2px 4px rgba(0,0,0,0.02), inset 0 1px 2px rgba(0,0,0,0.02);
        transition: all 0.15s ease;
    }
    .search-input:focus, .filter-select:focus { 
        border-color: #3b82f6; 
        box-shadow: 0 0 0 4px rgba(59, 130, 246, 0.15), 0 4px 10px rgba(0,0,0,0.05); 
    }

    .student-grid { display: grid; grid-template-columns: repeat(auto-fill, minmax(320px, 1fr)); gap: 32px; }
    .empty-state { grid-column: 1 / -1; background: #ffffff; border: 2px dashed #cbd5e1; border-radius: 16px; padding: 48px; text-align: center; color: #64748b; box-shadow: inset 0 2px 8px rgba(0,0,0,0.02); }
</style>
@endsection

@section('content')

    <div class="page-header">
        <div class="page-title">
            <h2>Students Management System</h2>
            <p style="color: #64748b; font-size: 14px; margin-top: 4px;">Dynamic volumetric records environment.</p>
        </div>
        @auth
            <a href="{{ route('students.create') }}" class="btn btn-primary">Add Student Profile</a>
        @else
            <a href="{{ route('login') }}" class="btn btn-secondary">Sign in to add a record</a>
        @endauth
    </div>

    <div class="metrics-grid">
        <div class="metric-card">
            <span class="metric-title">Registered Data</span>
            <span class="metric-value" id="count-total">{{ $students->count() }}</span>
        </div>
        <div class="metric-card">
            <span class="metric-title">Active Filter Matches</span>
            <span class="metric-value" id="count-visible" style="color: #3b82f6;">{{ $students->count() }}</span>
        </div>
        <div class="metric-card">
            <span class="metric-title">University</span>
            <span class="metric-value">{{ $students->pluck('program')->unique()->count() }}</span>
        </div>
    </div>

    <div class="filter-bar">
        <div class="search-wrapper">
            <input type="text" id="searchInput" class="search-input" placeholder="Query records instantly by matching parameter text strings...">
        </div>
        <select id="programFilter" class="filter-select">
            <option value="ALL">All Curriculums</option>
            @foreach($students->pluck('program')->unique() as $program)
                <option value="{{ $program }}">{{ $program }}</option>
            @endforeach
        </select>
    </div>

    <!-- Container Rendering Logic Target Framework -->
    <div class="student-grid" id="studentGrid">
        @forelse($students as $student)
            @include('components.student-card', ['student' => $student])
        @empty
            <div class="empty-state">
                <p style="font-size: 16px; font-weight: 600; color: #334155; margin-bottom: 4px;">No student logs mapped</p>
                <p style="font-size: 14px; color: #94a3b8;">Click the action button above to initialize new student profiles.</p>
            </div>
        @endforelse

        <div class="empty-state" id="jsEmptyState" style="display: none;">
            <p style="font-size: 16px; font-weight: 600; color: #334155; margin-bottom: 4px;">Zero query alignments located</p>
            <p style="font-size: 14px; color: #94a3b8;">Refine parameters inside the selection options or search string field values.</p>
        </div>
    </div>

@endsection

@section('scripts')
<script>
    document.addEventListener('DOMContentLoaded', () => {
        const searchInput = document.getElementById('searchInput');
        const programFilter = document.getElementById('programFilter');
        const cards = document.querySelectorAll('.student-card');
        const jsEmptyState = document.getElementById('jsEmptyState');
        const countVisible = document.getElementById('count-visible');
        const normalize = value => value.toLowerCase().replace(/\s+/g, ' ').trim();

        const filterDashboard = () => {
            const query = normalize(searchInput?.value || '');
            const selectedProgram = normalize(programFilter?.value || 'ALL');
            let visibleCount = 0;

            cards.forEach(card => {
                const searchableText = normalize([
                    card.dataset.name || '',
                    card.dataset.program || '',
                    card.dataset.searchable || '',
                ].join(' '));
                const matchesSearch = searchableText.includes(query);
                const matchesProgram = selectedProgram === 'all' || normalize(card.dataset.program || '') === selectedProgram;

                if (matchesSearch && matchesProgram) {
                    card.style.display = 'flex';
                    visibleCount++;
                } else {
                    card.style.display = 'none';
                }
            });

            if (countVisible) countVisible.textContent = visibleCount;
            if (jsEmptyState) jsEmptyState.style.display = (visibleCount === 0) ? 'block' : 'none';
        };

        searchInput?.addEventListener('input', filterDashboard);
        programFilter?.addEventListener('change', filterDashboard);
    });
</script>
@endsection
