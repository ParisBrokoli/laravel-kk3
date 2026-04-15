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
</style>

<div class="form-header">
    <h2>Add New Employee</h2>
    <p>Fill in the information below to register a new employee in the system.</p>
</div>

<div class="card">
    <form action="{{ route('karyawan.create')}}" method="POST" class="form-body">
        @csrf

        <div class="form-group">
            <label for="nama">Full Name</label>
            <input type="text" name="nama" id="nama" placeholder="e.g. John Doe" required>
        </div>

        <div class="form-group">
            <label for="posisi">Position</label>
            <input type="text" name="posisi" id="posisi" placeholder="e.g. Lead Developer" required>
        </div>
        
        <div class="form-actions">
            <button type="submit" class="btn btn-primary">
                <i class="fas fa-save"></i> Save Employee
            </button>
            <a href="{{ route('karyawan') }}" class="btn btn-secondary">
                Cancel
            </a>
        </div>
    </form>
</div>
@endsection