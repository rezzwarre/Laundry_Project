@extends('layouts.admin')

@section('title', 'Edit Transaksi ' . $transaksi->kode_invoice)

@section('content')
<div class="row">
    <div class="col-md-8 mx-auto">
        <div class="card shadow mb-4">
            <div class="card-header py-3 bg-warning text-dark">
                <h6 class="m-0 font-weight-bold">🛠️ Edit Transaksi: {{ $transaksi->kode_invoice }}</h6>
            </div>
            <div class="card-body">
                <form action="{{ route('admin.transaksi.update', $transaksi->id) }}" method="POST">
                    @csrf
                    @method('PUT') {{-- Wajib untuk method Update --}}

                    {{-- Status Pengerjaan (Paling sering diubah) --}}
                    <div class="mb-3">
                        <label class="form-label font-weight-bold">Status Pengerjaan</label>
                        <select name="status_kerja" class="form-control form-select">
                            {{-- Perbaikan: Sesuaikan dengan nama kolom yang benar jika berbeda, asumsikan 'status_pengerjaan' --}}
                            @foreach(['Menunggu', 'Dijemput', 'Diproses', 'Selesai', 'Diantar', 'Diambil'] as $status)
                                <option value="{{ $status }}" 
                                    {{ old('status_kerja', $transaksi->status_pengerjaan) == $status ? 'selected' : '' }}>
                                    {{ $status }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    {{-- Status Pembayaran --}}
                    <div class="mb-3">
                        <label class="form-label font-weight-bold">Status Pembayaran</label>
                        {{-- Perbaikan: Sesuaikan dengan nama kolom yang benar jika berbeda, asumsikan 'status_pembayaran' --}}
                        <select name="status_bayar" class="form-control form-select">
                            <option value="Belum Lunas" {{ old('status_bayar', $transaksi->status_pembayaran) == 'Belum Lunas' ? 'selected' : '' }}>Belum Lunas</option>
                            <option value="Lunas" {{ old('status_bayar', $transaksi->status_pembayaran) == 'Lunas' ? 'selected' : '' }}>Lunas</option>
                        </select>
                        @error('status_bayar') <div class="invalid-feedback d-block">{{ $message }}</div> @enderror
                    </div>

                    <hr>
                    <h6 class="font-weight-bold mb-3 text-secondary">DATA TRANSAKSI (HATI-HATI MENGUBAH)</h6>

                    {{-- Pilih Pelanggan --}}
                    {{-- <div class="mb-3">
                        <label class="form-label">Pelanggan</label>
                        <select name="id_user" class="form-control form-select @error('id_user') is-invalid @enderror" disabled>
                            @foreach($customers as $user)
                                <option value="{{ $user->id }}" 
                                    {{ old('id_user', $transaksi->id_user) == $user->id ? 'selected' : '' }}>
                                    {{ $user->nama }}
                                </option>
                            @endforeach
                        </select>
                        <!-- nilai tetap terkirim -->
                        <input type="hidden" name="id_user" value="{{ $transaksi->id_user }}">
                    </div> --}}

                    <div class="mb-3">
                        <label class="form-label">Pelanggan</label>

                            @if ($transaksi->id_user)
                            {{-- TRANSAKSI ONLINE --}}
                                <select class="form-control form-select" disabled>
                                    @foreach($customers as $user)
                                        <option value="{{ $user->id }}"
                                            {{ $transaksi->id_user == $user->id ? 'selected' : '' }}>
                                                {{ $user->nama }}
                                        </option>
                                     @endforeach
                                </select>

                            {{-- tetap terkirim --}}
                        <input type="hidden" name="id_user" value="{{ $transaksi->id_user }}">

                        @else
                            {{-- TRANSAKSI KASIR --}}
                        <input type="text" class="form-control" 
                            value="{{ $transaksi->nama_pelanggan }}" disabled>

                            {{-- id_user memang NULL --}}
                        <input type="hidden" name="id_user" value="">
                        @endif
            </div>


                    {{-- Baris Layanan & Jumlah --}}
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label class="form-label">Pilih Layanan (Jasa)</label>
                            <select name="id_jasa" id="select-jasa" class="form-control form-select @error('id_jasa') is-invalid @enderror">
                                @foreach($services as $jasa)
                                    {{-- MODIFIKASI: Menambahkan data-harga, data-satuan, dan data-kategori --}}
                                    <option value="{{ $jasa->id }}" 
                                            data-harga="{{ $jasa->harga }}"
                                            data-satuan="{{ $jasa->jenis_barang }}"
                                            data-kategori="{{ strtolower($jasa->kategori) }}" 
                                            {{ old('id_jasa', $transaksi->id_jasa) == $jasa->id ? 'selected' : '' }}>
                                        {{ $jasa->jenis_jasa }} - Rp{{ number_format($jasa->harga, 0, ',', '.') }}/{{ $jasa->jenis_barang }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <div class="col-md-6 mb-3">
                            <label class="form-label">Jumlah / Berat</label>
                            {{-- Menghapus min="1" dan step agar diatur oleh JS --}}
                            <input type="number" name="jumlah_barang" id="input-jumlah" 
                                class="form-control @error('jumlah_barang') is-invalid @enderror" 
                                value="{{ old('jumlah_barang', $transaksi->jumlah_barang) }}">
                            {{-- Menambahkan ID untuk pesan satuan dinamis --}}
                            <small id="satuan-info" class="text-muted">Satuan dan input akan diatur otomatis.</small>
                            @error('jumlah_barang') <div class="invalid-feedback d-block">{{ $message }}</div> @enderror
                        </div>
                    </div>
                    
                    {{-- Input Hidden untuk Total Harga --}}
                    <input type="hidden" name="total_harga" id="input-total-harga" value="{{ old('total_harga', $transaksi->total_harga) }}">

                    <div class="alert alert-info d-flex justify-content-between align-items-center">
                        <span>Total Harga Saat Ini (Estimasi Perubahan):</span>
                        {{-- Mengatur nilai awal tampilan harga ke total harga dari DB --}}
                        <h3 class="mb-0 font-weight-bold" id="tampilan-harga">Rp{{ number_format($transaksi->total_harga, 0, ',', '.') }}</h3>
                    </div>

                    <div class="mb-4">
                            <label for="description" class="form-label fw-bold">deskripsi Lengkap</label>
                            <textarea 
                                class="form-control @error('description') is-invalid @enderror" 
                                id="description" 
                                name="description" 
                                rows="6" 
                                placeholder="Jelaskan detail layanan Anda, misalnya: Syarat & Ketentuan, durasi, dll."
                                required
                            >{{ old('description', $transaksi->description ?? '') }}</textarea>
                            
                            {{-- Penanganan Error untuk field description --}}
                            @error('description')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                            <div class="form-text">Maksimal 1000 karakter.</div>
                        </div>
                    
                        <div class="mb-3">
                            <label class="form-label">Antar Jemput? (Rp5.000)</label><br>

                            <input type="radio" disabled {{ $transaksi->antar_jemput ? 'checked' : '' }}> Ya
                            <input type="radio" disabled {{ !$transaksi->antar_jemput ? 'checked' : '' }}> Tidak

                            <!-- nilai tetap dikirim -->
                            <input type="hidden" name="antar_jemput" value="{{ $transaksi->antar_jemput ? 1 : 0 }}">
                        </div>
                        
                    <div class="mb-3">
                        <label hidden class="form-label">Tanggal Terima</label>
                        <input type="date" name="tanggal_terima" class="form-control" value="{{ old('tanggal_terima', $transaksi->tanggal_terima) }}">
                    </div>

                    <button type="submit" class="btn btn-warning btn-lg w-100 mt-3">
                        <i class="fas fa-save"></i> Perbarui Transaksi
                    </button>
                    <a href="{{ route('admin.transaksi.index') }}" class="btn btn-secondary w-100 mt-2">Batal</a>
                </form>
            </div>
        </div>
    </div>
</div>

{{-- Script JS yang sama dari Create untuk kalkulasi dinamis, DENGAN PERBAIKAN --}}
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const selectJasa = document.getElementById('select-jasa');
        const inputJumlah = document.getElementById('input-jumlah');
        const tampilanHarga = document.getElementById('tampilan-harga');
        const satuanInfo = document.getElementById('satuan-info');
        const inputTotalHarga = document.getElementById('input-total-harga');

        function hitungHarga() {
            const selectedOption = selectJasa.options[selectJasa.selectedIndex];
            const hargaSatuan = parseFloat(selectedOption.getAttribute('data-harga')) || 0;
            let jumlah = parseFloat(inputJumlah.value) || 0;
            
            // Deklarasikan 'total' di awal fungsi
            let total = 0; 
            
            // Pastikan input jumlah valid sebelum menghitung
            if (inputJumlah.disabled || isNaN(jumlah)) {
                total = 0;
            } else {
                const kategori = (selectedOption.getAttribute('data-kategori') || '').toLowerCase();
                
                // Jika kategori adalah 'jumlah', bulatkan input ke integer
                if (kategori === 'jumlah') {
                    jumlah = Math.round(jumlah);
                    // Update input field agar user melihat nilai bulat
                    inputJumlah.value = jumlah;
                }
                
                // Hitung total
                total = hargaSatuan * jumlah;
                
                // Pembulatan ke dua desimal untuk total harga
                total = Math.round(total * 100) / 100;
            }
            
            // Format Rupiah untuk tampilan
            tampilanHarga.innerText = "Rp " + new Intl.NumberFormat('id-ID').format(total);
            
            // Kirim nilai total harga murni (desimal) ke input hidden untuk Controller
            inputTotalHarga.value = total;
        }

        function updateInputKondisional() {
            const selectedOption = selectJasa.options[selectJasa.selectedIndex];
            const kategori = (selectedOption.getAttribute('data-kategori') || '').toLowerCase();
            const satuan = selectedOption.getAttribute('data-satuan') || ''; 
            
            // Set inputJumlah.disabled ke false sebelum mengatur atribut lain
            inputJumlah.disabled = false; 

            if (kategori === 'berat') {
                // Kategori Berat: Boleh Desimal (0.01 Kg)
                inputJumlah.setAttribute('step', '0.01');
                inputJumlah.setAttribute('min', '0.00');
                satuanInfo.textContent = `Satuan: ${satuan} (Contoh: 1.5 ${satuan}). Boleh desimal.`;
                
                // Atur nilai default/minimum
                if (parseFloat(inputJumlah.value) < 0.01) {
                    inputJumlah.value = '1.00';
                }
            } else if (kategori === 'jumlah') {
                // Kategori Jumlah: Hanya Integer
                inputJumlah.setAttribute('step', '1');
                inputJumlah.setAttribute('min', '0');
                satuanInfo.textContent = `Satuan: ${satuan} (Contoh: 2 ${satuan}). Hanya bilangan bulat.`;
                
                // Pastikan nilai di input adalah integer positif
                inputJumlah.value = Math.max(1, Math.round(parseFloat(inputJumlah.value) || 1));
                
            } else {
                // Jika tidak ada jasa yang terpilih (meskipun di edit harusnya ada)
                inputJumlah.disabled = true;
                inputJumlah.value = '0';
                inputJumlah.setAttribute('step', '1');
                inputJumlah.setAttribute('min', '0');
                satuanInfo.textContent = 'Pilih layanan untuk mengaktifkan input.';
            }
            
            // WAJIB: Hitung harga setelah input disesuaikan
            hitungHarga(); 
        }

        // --- Event Listeners ---
        selectJasa.addEventListener('change', updateInputKondisional);
        inputJumlah.addEventListener('input', hitungHarga);
        
        // Panggil inisialisasi pada saat halaman dimuat
        updateInputKondisional();
    });
</script>
@endsection