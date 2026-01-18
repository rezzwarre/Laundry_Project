@extends('layouts.admin')

@section('title', 'Admin')

@section('content')
    <a href="{{ route('admin.user_admin.create') }}" class="btn btn-primary mb-3">Tambah Admin</a>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <table class="table table-bordered">
        <thead>
            <tr>
                <th>No</th>
                <th>Username</th>
                <th>Nama</th>
                <th>Aksi</th>>
            </tr>
        </thead>
        <tbody>
            @foreach($user_admin as $admin)
            <tr>
                <td>{{ $loop->iteration }}</td>
                <td>{{ $admin->username }}</td>
                <td>{{ $admin->nama }}</td>
                <td>  
                    {{-- Form Delete --}}
                    <form action="{{ route('admin.user_admin.destroy', $admin->id_admin) }}" method="POST" class="d-inline">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Yakin ingin menghapus?')">Hapus</button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
@endsection