@extends('layouts.admin')

@section('title', 'Pengelolaan Jenis Jasa')

@section('content')
    <a href="{{ route('admin.jenis_jasa.create') }}" class="btn btn-primary mb-3">Tambah Jenis Jasa Baru</a>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <table class="table table-bordered">
        <thead>
            <tr>
                <th>#</th>
                <th>Jenis Jasa</th>
                <th>Jenis Barang</th>
                <th>Harga / Satuan</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            @foreach($jenis_jasas as $jasa)
            <tr>
                <td>{{ $loop->iteration }}</td>
                <td>{{ $jasa->jenis_jasa }}</td>
                <td>{{ $jasa->jenis_barang }}</td>
                <td>Rp{{ number_format($jasa->harga, 0, ',', '.') }}</td>
                <td>
                    <a href="{{ route('admin.jenis_jasa.edit', $jasa->id) }}" class="btn btn-sm btn-warning">Edit</a>
                    {{-- Form Delete --}}
                    <form action="{{ route('admin.jenis_jasa.destroy', $jasa->id) }}" method="POST" class="d-inline">
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