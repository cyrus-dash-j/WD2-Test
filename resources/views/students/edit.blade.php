@extends('layouts.app')

@section('title', 'Edit Student')

@section('styles')
<style>
    .form-container-card { background: #ffffff; border: 1px solid #e5e7eb; border-radius: 16px; padding: 32px; box-shadow: 0 1px 3px rgba(0,0,0,0.05); max-width: 850px; margin: 0 auto; }
    .form-grid-row { display: grid; grid-template-columns: repeat(2, 1fr); gap: 24px; margin-bottom: 24px; }
    @media (max-width: 640px) { .form-grid-row { grid-template-columns: 1fr; gap: 16px; } }
    .input-field-group { display: flex; flex-direction: column; gap: 8px; }
    .input-field-group label { font-size: 13px; font-weight: 600; color: #4b5563; text-transform: uppercase; letter-spacing: 0.5px; }
    .custom-input { width: 100%; padding: 12px 16px; border-radius: 8px; border: 1px solid #d1d5db; font-size: 14px; outline: none; transition: all 0.15s; }
    .custom-input:focus { border-color: #2563eb; box-shadow: 0 0 0 4px rgba(37, 99, 235, 0.1); }
    .image-upload-zone { border: 2px dashed #cbd5e1; border-radius: 12px; padding: 24px; text-align: center; background: #f8fafc; cursor: pointer; transition: all 0.2s ease; display: flex; flex-direction: column; align-items: center; gap: 8px; justify-content: center; min-height: 120px; }
    .image-upload-zone:hover { border-color: #2563eb; background: #f0fdf4; }
    .hidden-file-input { display: none; }
    .live-preview-box { width: 80px; height: 80px; border-radius: 50%; object-fit: cover; border: 3px solid #ffffff; box-shadow: 0 4px 6px rgba(0,0,0,0.1); }
    .form-buttons-action-row { display: flex; align-items: center; justify-content: flex-end; gap: 12px; border-top: 1px solid #f1f5f9; padding-top: 24px; margin-top: 32px; }
    .error-inline-msg { color: #dc2626; font-size: 13px; font-weight: 500; margin-top: 4px; }
</style>
@endsection

@section('content')

    <div class="page-header" style="max-width: 850px; margin: 0 auto 32px auto;">
        <div class="page-title">
            <h2>Edit Student Details</h2>
            <p style="color: #6b7280; font-size: 14px; margin-top: 4px;">Modify database record fields for #{{ $student->id }}.</p>
        </div>
        <a href="{{ route('students.index') }}" class="btn btn-secondary">⬅️ Return to List</a>
    </div>

    <div class="form-container-card">
        <form action="{{ route('students.update', $student->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            <h3 style="font-size: 14px; color: #2563eb; text-transform: uppercase; letter-spacing: 0.5px; margin-bottom: 20px; border-bottom: 1px solid #eff6ff; padding-bottom: 8px;">1. Personal Identity Metrics</h3>
            
            <div class="form-grid-row">
                <div class="input-field-group">
                    <label for="firstname">First Name</label>
                    <input type="text" id="firstname" name="firstname" class="custom-input" value="{{ old('firstname', $student->firstname) }}" maxlength="50" required>
                    @error('firstname') <span class="error-inline-msg">{{ $message }}</span> @enderror
                </div>
                <div class="input-field-group">
                    <label for="lastname">Last Name</label>
                    <input type="text" id="lastname" name="lastname" class="custom-input" value="{{ old('lastname', $student->lastname) }}" maxlength="50" required>
                    @error('lastname') <span class="error-inline-msg">{{ $message }}</span> @enderror
                </div>
            </div>

            <div class="form-grid-row">
                <div class="input-field-group">
                    <label for="birthday">Date of Birth</label>
                    <input type="date" id="birthday" name="birthday" class="custom-input" value="{{ old('birthday', $student->birthday) }}" required>
                    @error('birthday') <span class="error-inline-msg">{{ $message }}</span> @enderror
                </div>
                <div class="input-field-group">
                    <label>Profile Image Modification</label>
                    <div class="image-upload-zone" onclick="document.getElementById('profile_image').click()">
                        <div id="upload-zone-prompt" style="display: {{ $student->profile_image ? 'none' : 'block' }}">
                            <span style="font-size: 20px; display: block; margin-bottom: 2px;">📸</span>
                            <span style="font-size: 13px; color: #4b5563; font-weight: 500;">Select profile replacement photo</span>
                        </div>
                        <img id="image-live-preview" class="live-preview-box" 
                             src="{{ $student->profile_image ? asset('storage/' . $student->profile_image) : '#' }}" 
                             style="display: {{ $student->profile_image ? 'block' : 'none' }}" alt="File Preview">
                        <input type="file" id="profile_image" name="profile_image" class="hidden-file-input" accept="image/*">
                    </div>
                    @error('profile_image') <span class="error-inline-msg">{{ $message }}</span> @enderror
                </div>
            </div>

            <h3 style="font-size: 14px; color: #2563eb; text-transform: uppercase; letter-spacing: 0.5px; margin-bottom: 20px; border-bottom: 1px solid #eff6ff; padding-bottom: 8px; margin-top: 32px;">2. Academic Affiliation</h3>
            
            <div class="form-grid-row">
                <div class="input-field-group">
                    <label for="school">School / University Campus</label>
                    <input type="text" id="school" name="school" class="custom-input" value="{{ old('school', $student->school) }}" maxlength="50" required>
                    @error('school') <span class="error-inline-msg">{{ $message }}</span> @enderror
                </div>
                <div class="form-grid-row" style="margin-bottom: 0; gap: 16px;">
                    <div class="input-field-group">
                        <label for="program">Program Code</label>
                        <input type="text" id="program" name="program" class="custom-input" value="{{ old('program', $student->program) }}" maxlength="10" required>
                        @error('program') <span class="error-inline-msg">{{ $message }}</span> @enderror
                    </div>
                    <div class="input-field-group">
                        <label for="year">Curriculum Year</label>
                        <input type="number" id="year" name="year" class="custom-input" value="{{ old('year', $student->year) }}" min="1" max="10" required>
                        @error('year') <span class="error-inline-msg">{{ $message }}</span> @enderror
                    </div>
                </div>
            </div>

            <h3 style="font-size: 14px; color: #2563eb; text-transform: uppercase; letter-spacing: 0.5px; margin-bottom: 20px; border-bottom: 1px solid #eff6ff; padding-bottom: 8px; margin-top: 32px;">3. Geographic Location Details</h3>
            
            <div class="form-grid-row">
                <div class="input-field-group">
                    <label for="province">State / Province</label>
                    <input type="text" id="province" name="province" class="custom-input" value="{{ old('province', $student->province) }}" maxlength="50" required>
                    @error('province') <span class="error-inline-msg">{{ $message }}</span> @enderror
                </div>
                <div class="input-field-group">
                    <label for="country">Country</label>
                    <input type="text" id="country" name="country" class="custom-input" value="{{ old('country', $student->country) }}" maxlength="50" required>
                    @error('country') <span class="error-inline-msg">{{ $message }}</span> @enderror
                </div>
            </div>

            <div class="form-buttons-action-row">
                <a href="{{ route('students.index') }}" class="btn btn-secondary" style="padding: 12px 24px;">Cancel Modifications</a>
                <button type="submit" class="btn btn-warning" style="padding: 12px 28px;">💾 Apply Operational Updates</button>
            </div>
        </form>
    </div>

@endsection

@section('scripts')
<script>
    document.addEventListener('DOMContentLoaded', () => {
        const fileInput = document.getElementById('profile_image');
        const livePreview = document.getElementById('image-live-preview');
        const textPrompt = document.getElementById('upload-zone-prompt');

        fileInput?.addEventListener('change', function() {
            const file = this.files[0];
            if (file) {
                const reader = new FileReader();
                reader.onload = function(e) {
                    livePreview.src = e.target.result;
                    livePreview.style.display = 'block';
                    textPrompt.style.display = 'none';
                }
                reader.readAsDataURL(file);
            }
        });
    });
</script>
@endsection
