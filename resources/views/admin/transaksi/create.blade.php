@extends('layouts.admin')

@section('title', 'Transaksi Baru')

@section('content')
    <div class="row">
        <div class="col-md-8">
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Form Transaksi Laundry</h6>
                </div>
                <div class="card-body">
                    <form action="{{ route('admin.transaksi.store') }}" method="POST">
                        @csrf

                        {{-- Pilih Pelanggan (dengan tombol Tambah Baru) --}}
                        <div class="mb-3">
                            <label class="form-label font-weight-bold">Pelanggan</label>
                            <div class="input-group">
                                <select name="id_user"
                                    class="form-control form-select @error('id_user') is-invalid @enderror">
                                    <option value="">-- Pilih Pelanggan --</option>
                                    @foreach($customers as $user)
                                        <option value="{{ $user->id }}">{{ $user->nama }} (ID: {{ $user->id }})</option>
                                    @endforeach
                                </select>
                            </div>
                            @error('id_user') <div class="invalid-feedback d-block">{{ $message }}</div> @enderror
                        </div>

                        {{-- Baris Layanan & Jumlah --}}
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label class="form-label font-weight-bold">Pilih Layanan (Jasa)</label>

                                <select name="id_jasa" id="select-jasa"
                                    class="form-control form-select @error('id_jasa') is-invalid @enderror">
                                    <option value="" data-harga="0" data-satuan="" data-kategori="">-- Pilih Jasa --
                                    </option>
                                    @foreach($services as $jasa)
                                        {{-- MODIFIKASI: Menambahkan data-kategori --}}
                                        <option value="{{ $jasa->id }}" data-harga="{{ $jasa->harga }}"
                                            data-satuan="{{ $jasa->jenis_barang }}"
                                            data-kategori="{{ strtolower($jasa->kategori) }}">
                                            {{ $jasa->jenis_jasa }} -
                                            Rp{{ number_format($jasa->harga, 0, ',', '.') }}/{{ $jasa->jenis_barang }}
                                        </option>
                                    @endforeach
                                </select>
                                @error('id_jasa') <div class="invalid-feedback">{{ $message }}</div> @enderror
                            </div>

                            <div class="col-md-6 mb-3">
                                <label class="form-label font-weight-bold">Jumlah / Berat</label>
                                {{-- MODIFIKASI: Diatur default-nya oleh JS --}}
                                <input type="number" name="jumlah_barang" id="input-jumlah"
                                    class="form-control @error('jumlah_barang') is-invalid @enderror" value="0" min="0"
                                    step="1" disabled>
                                {{-- Menambahkan ID untuk pesan satuan dinamis --}}
                                <small id="satuan-info" class="text-muted">Pilih layanan untuk mengaktifkan input.</small>
                                @error('jumlah_barang') <div class="invalid-feedback">{{ $message }}</div> @enderror
                            </div>
                        </div>

                        {{-- INFORMASI PENTING: Input Hidden Total Harga untuk Controller --}}
                        <input type="hidden" name="total_harga" id="input-total-harga" value="0">


                        {{-- Informasi Tagihan (Otomatis) --}}
                        <div class="alert alert-info d-flex justify-content-between align-items-center">
                            <span>Estimasi Total Harga:</span>
                            <h3 class="mb-0 font-weight-bold" id="tampilan-harga">Rp 0</h3>
                        </div>

                        <div class="mb-4">
                            <label for="description" class="form-label fw-bold">deskripsi Lengkap</label>
                            <textarea class="form-control @error('description') is-invalid @enderror" id="description"
                                name="description" rows="6"
                                placeholder="Jelaskan detail layanan Anda, misalnya: Syarat & Ketentuan, durasi, dll."
                                required>{{ old('description') }}</textarea>

                            {{-- Penanganan Error untuk field description --}}
                            @error('description')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                            <div class="form-text">Maksimal 1000 karakter.</div>
                        </div>

                        {{-- Tanggal & Pembayaran (Tetap) --}}
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label class="form-label">Tanggal Terima</label>
                                <input type="date" name="tanggal_terima" class="form-control" value="{{ date('Y-m-d') }}">
                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="form-label font-weight-bold">Status Pembayaran</label>
                                <select name="status_bayar" class="form-control form-select">
                                    <option value="Belum Lunas">Belum Lunas</option>
                                    <option value="Lunas">Lunas (Bayar Sekarang)</option>
                                </select>
                            </div>
                        </div>

                        <div class="row mt-3">
                            <div class="col-md-6 mb-2">
                                <button type="submit" class="btn btn-success btn-lg w-100">
                                    <i class="fas fa-save"></i> Simpan Transaksi
                                </button>
                            </div>

                            <div class="col-md-6 mb-2">
                                <a href="{{ route('admin.transaksi.index') }}" class="btn btn-secondary btn-lg w-100">
                                    <i class="fas fa-times"></i> Batal
                                </a>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        {{-- Card Informasi Samping (Opsional) --}}
        <div class="col-md-4">
            {{-- ... (kode Card Info Cepat tetap sama) ... --}}
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-secondary">Info Cepat</h6>
                </div>
                <div class="card-body">
                    <p>Pastikan pelanggan sudah terdaftar sebelum membuat transaksi. Jika belum, daftarkan di menu
                        Pelanggan.</p>
                    <hr>
                    <strong>Alur Kerja:</strong>
                    <ol class="pl-3">
                        <li>Terima barang</li>
                        <li>Input data di sini</li>
                        <li>Cetak Struk (di halaman detail)</li>
                        <li>Proses Cuci</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>


    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const selectJasa = document.getElementById('select-jasa');
            const inputJumlah = document.getElementById('input-jumlah');
            const tampilanHarga = document.getElementById('tampilan-harga');
            const satuanInfo = document.getElementById('satuan-info');
            const inputTotalHarga = document.getElementById('input-total-harga');

            function hitungHarga() {
                const selectedOption = selectJasa.options[selectJasa.selectedIndex];
                const hargaSatuan = parseFloat(selectedOption.getAttribute('data-harga')) || 0;
                let jumlah = parseFloat(inputJumlah.value) || 0;

                // PERBAIKAN: Deklarasikan 'total' di awal fungsi
                let total = 0;

                if (inputJumlah.disabled || isNaN(jumlah)) {
                    total = 0;
                } else {
                    const kategori = (selectedOption.getAttribute('data-kategori') || '').toLowerCase();

                    if (kategori === 'jumlah') {
                        jumlah = Math.round(jumlah);
                        inputJumlah.value = jumlah;
                    }

                    // PERBAIKAN: Hapus kata kunci 'let' di sini
                    total = hargaSatuan * jumlah;

                    total = Math.round(total * 100) / 100;
                }

                // Ini sekarang akan berfungsi dengan benar
                tampilanHarga.innerText = "Rp " + new Intl.NumberFormat('id-ID').format(total);
                inputTotalHarga.value = total;
            }

            function updateInputKondisional() {
                const selectedOption = selectJasa.options[selectJasa.selectedIndex];
                const kategori = (selectedOption.getAttribute('data-kategori') || '').toLowerCase();
                const satuan = selectedOption.getAttribute('data-satuan') || '';

                if (kategori === 'berat') {
                    // Kategori Berat: Boleh Desimal
                    inputJumlah.disabled = false;
                    inputJumlah.setAttribute('step', '0.1'); // Mengizinkan dua desimal
                    inputJumlah.setAttribute('min', '0.1');
                    satuanInfo.textContent = `Satuan: ${satuan} (Contoh: 1.5 ${satuan}). Boleh desimal.`;

                    // Atur nilai default/minimum
                    if (parseFloat(inputJumlah.value) < 0.01 || inputJumlah.value === '0') {
                        inputJumlah.value = '1.0';
                    }
                } else if (kategori === 'jumlah') {
                    // Kategori Jumlah: Hanya Integer
                    inputJumlah.disabled = false;
                    inputJumlah.setAttribute('step', '1'); // Hanya mengizinkan integer
                    inputJumlah.setAttribute('min', '1');
                    satuanInfo.textContent = `Satuan: ${satuan} (Contoh: 2 ${satuan}). Hanya bilangan bulat.`;

                    // Pastikan nilai di input adalah integer positif
                    inputJumlah.value = Math.max(1, Math.round(parseFloat(inputJumlah.value) || 1));

                } else {
                    // Default: Jasa belum dipilih
                    inputJumlah.disabled = true;
                    inputJumlah.value = '0';
                    inputJumlah.setAttribute('step', '1');
                    inputJumlah.setAttribute('min', '0');
                    satuanInfo.textContent = 'Pilih layanan untuk mengaktifkan input.';
                }

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