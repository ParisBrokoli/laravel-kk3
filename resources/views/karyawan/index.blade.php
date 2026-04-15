@extends('layouts.main')

@section('content')
<style>
    :root {
        --accent: #22d3ee;
        --accent-hover: #0891b2;
        --surface: #1e293b;
        --surface-light: #334155;
    }

    header {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 2.5rem;
        background: rgba(30, 41, 59, 0.5);
        padding: 1.5rem;
        border-radius: 20px;
        backdrop-filter: blur(10px);
        border: 1px solid rgba(255, 255, 255, 0.05);
    }

    h1 {
        font-size: 2rem;
        font-weight: 800;
        letter-spacing: -0.05em;
        background: linear-gradient(135deg, #fff 0%, var(--accent) 100%);
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent;
    }

    .search-row {
        display: grid;
        grid-template-columns: 1fr auto;
        gap: 1rem;
        margin-bottom: 2rem;
    }

    .search-box {
        position: relative;
    }

    .search-box i {
        position: absolute;
        left: 1.25rem;
        top: 50%;
        transform: translateY(-50%);
        color: var(--accent);
    }

    .search-input {
        padding-left: 3rem;
        border-radius: 14px;
        height: 54px;
        font-size: 1rem;
        background: var(--surface);
    }

    .table-container {
        background: var(--surface);
        border-radius: 24px;
        overflow: hidden;
        border: 1px solid rgba(255, 255, 255, 0.05);
        box-shadow: 0 25px 50px -12px rgba(0, 0, 0, 0.5);
    }

    table {
        width: 100%;
        border-collapse: collapse;
    }

    th {
        padding: 1.25rem 1.5rem;
        background: rgba(255, 255, 255, 0.02);
        color: var(--text-muted);
        font-weight: 600;
        font-size: 0.8rem;
        text-transform: uppercase;
        letter-spacing: 0.1em;
        text-align: left;
    }

    th a {
        color: inherit;
        text-decoration: none;
        display: flex;
        align-items: center;
        gap: 0.5rem;
    }

    th a:hover {
        color: var(--accent);
    }

    td {
        padding: 1.25rem 1.5rem;
        border-bottom: 1px solid rgba(255, 255, 255, 0.03);
        vertical-align: middle;
    }

    tr:hover td {
        background: rgba(34, 211, 238, 0.03);
    }

    .emp-name {
        font-weight: 700;
        color: #fff;
        font-size: 1.05rem;
    }

    .dept-tag {
        background: rgba(34, 211, 238, 0.1);
        color: var(--accent);
        padding: 0.35rem 0.75rem;
        border-radius: 8px;
        font-size: 0.75rem;
        font-weight: 700;
        border: 1px solid rgba(34, 211, 238, 0.2);
    }

    .pos-text {
        color: var(--text-muted);
        font-size: 0.9rem;
    }

    .salary-badge {
        font-family: 'JetBrains Mono', 'Fira Code', monospace;
        color: #4ade80;
        font-weight: 600;
        font-size: 0.95rem;
    }

    .action-group {
        display: flex;
        gap: 0.75rem;
    }

    .icon-btn {
        width: 40px;
        height: 40px;
        border-radius: 12px;
        display: flex;
        align-items: center;
        justify-content: center;
        color: var(--text-muted);
        transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        background: var(--surface-light);
    }

    .icon-btn:hover {
        transform: scale(1.1);
    }

    .btn-edit:hover { background: rgba(251, 191, 36, 0.2); color: #fbbf24; }
    .btn-delete:hover { background: rgba(248, 113, 113, 0.2); color: #f87171; }

    .pagination-bar {
        padding: 1.5rem;
        background: rgba(0, 0, 0, 0.1);
    }

    /* Custom Scrollbar */
    ::-webkit-scrollbar { width: 8px; }
    ::-webkit-scrollbar-track { background: var(--bg-dark); }
    ::-webkit-scrollbar-thumb { background: var(--surface-light); border-radius: 10px; }
    ::-webkit-scrollbar-thumb:hover { background: var(--accent); }
</style>

<header>
    <div>
        <h1>Workspace</h1>
        <p style="color: var(--text-muted); font-size: 0.9rem;">Manage your team members and roles</p>
    </div>
    <a href="/karyawan/tambah" class="btn btn-primary">
        <i class="fas fa-plus"></i> New Employee
    </a>
</header>

<form action="/karyawan" method="GET" class="search-row">
    <div class="search-box">
        <i class="fas fa-search"></i>
        <input type="text" name="search" class="search-input" placeholder="Find someone..." value="{{ $search ?? '' }}">
    </div>
    <button type="submit" class="btn btn-secondary">Search</button>
</form>

<div class="table-container">
    <table>
        <thead>
            <tr>
                <th><a href="{{ request()->fullUrlWithQuery(['sort' => 'nama', 'order' => $order == 'asc' ? 'desc' : 'asc']) }}">Employee <i class="fas fa-sort"></i></a></th>
                <th>Department</th>
                <th><a href="{{ request()->fullUrlWithQuery(['sort' => 'posisi', 'order' => $order == 'asc' ? 'desc' : 'asc']) }}">Role <i class="fas fa-sort"></i></a></th>
                <th>Monthly Salary</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($karyawan as $k)
            <tr>
                <td>
                    <div class="emp-name">{{ $k->nama }}</div>
                    <div style="font-size: 0.75rem; color: var(--text-muted);">EMP-{{ str_pad($k->id, 4, '0', STR_PAD_LEFT) }}</div>
                </td>
                <td>
                    <span class="dept-tag">{{ $k->departemen->nama_departemen ?? 'Unassigned' }}</span>
                </td>
                <td><span class="pos-text">{{ $k->posisi }}</span></td>
                <td>
                    @php $latestSalary = $k->gajis->last(); @endphp
                    <div class="salary-badge">
                        {{ $latestSalary ? 'Rp ' . number_format($latestSalary->jumlah_gaji, 0, ',', '.') : 'Not Set' }}
                    </div>
                </td>
                <td>
                    <div class="action-group">
                        <a href="{{ route('karyawan.edit', $k->id) }}" class="icon-btn btn-edit">
                            <i class="fas fa-edit"></i>
                        </a>
                        <form action="{{ route('karyawan.delete', $k->id) }}" method="POST" onsubmit="return confirm('Archive this record?')">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="icon-btn btn-delete" style="background: var(--surface-light); border: none; cursor: pointer;">
                                <i class="fas fa-trash-alt"></i>
                            </button>
                        </form>
                    </div>
                </td>
            </tr>
            @empty
            <tr>
                <td colspan="5" style="text-align: center; padding: 4rem; color: var(--text-muted);">
                    <i class="fas fa-users-slash" style="font-size: 3rem; margin-bottom: 1rem; display: block; opacity: 0.2;"></i>
                    No team members found matching your criteria.
                </td>
            </tr>
            @endforelse
        </tbody>
    </table>
    
    <div class="pagination-bar">
        {{ $karyawan->appends(request()->query())->links() }}
    </div>
</div>
@endsection