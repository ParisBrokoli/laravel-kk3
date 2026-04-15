@extends('layouts.main')

@section('content')
<style>
    .form-header {
        margin-bottom: 2.5rem;
    }
    .form-header h2 {
        font-size: 1.5rem;
        margin-bottom: 0.5rem;
    }
    .form-header p {
        color: var(--text-muted);
        font-size: 0.95rem;
    }
    .form-body {
        padding: 2.5rem;
    }
    .form-group {
        margin-bottom: 1.5rem;
    }
    .form-actions {
        display: flex;
        gap: 1rem;
        margin-top: 2rem;
    }
    .info-badge {
        display: inline-block;
        padding: 0.25rem 0.5rem;
        background: var(--glass);
        border-radius: 6px;
        font-size: 0.8rem;
        color: var(--primary);
        margin-bottom: 1rem;
    }
</style>

<div class="form-header">
    <div class="info-badge">Editing Record #{{ $karyawan->id }}</div>
    <h2>Update Employee Profile</h2>
    <p>Modify the details for <strong>{{ $karyawan->nama }}</strong> and save the changes.</p>
</div>

<div class="card">
    <form action="{{ route('karyawan.update', $karyawan->id) }}" method="POST" class="form-body">
        @csrf
        @method('PUT')

        <div class="form-group">
            <label for="nama">Full Name</label>
            <input type="text" name="nama" id="nama" value="{{ $karyawan->nama }}" placeholder="e.g. John Doe" required>
        </div>

        <div class="form-group">
            <label for="posisi">Position</label>
            <input type="text" name="posisi" id="posisi" value="{{ $karyawan->posisi }}" placeholder="e.g. Lead Developer" required>
        </div>
        
        <div class="form-actions">
            <button type="submit" class="btn btn-primary">
                <i class="fas fa-check-circle"></i> Update Changes
            </button>
            <a href="{{ route('karyawan') }}" class="btn btn-secondary">
                Cancel
            </a>
        </div>
    </form>
</div>
@endsection