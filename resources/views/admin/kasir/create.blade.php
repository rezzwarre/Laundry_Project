@extends('layouts.admin')

@section('title', 'Transaksi Cepat (Kasir)')

@section('content')
    <div class="row">
        <div class="col-md-10 mx-auto">

            <div class="card shadow">
                <div class="card-header bg-success text-white">
                    <h5 class="mb-0">🧾 Transaksi Cepat (Kasir)</h5>
                </div>

                <div class="card-body">
                    <form action="{{ route('admin.kasir.store') }}" method="POST">
                        @csrf

                        {{-- DATA PELANGGAN --}}
                        <h6 class="fw-bold text-secondary mb-3">DATA PELANGGAN</h6>

                        <div class="row">
                            <div class="col-md-4 mb-3">
                                <label class="form-label">Nama Pelanggan</label>
                                <input type="text" name="nama_pelanggan"
                                    class="form-control @error('nama_pelanggan') is-invalid @enderror"
                                    value="{{ old('nama_pelanggan') }}" required>
                                @error('nama_pelanggan') <div class="invalid-feedback">{{ $message }}</div> @enderror
                            </div>

                            <div class="col-md-4 mb-3">
                                <label class="form-label">No. HP</label>
                                <input type="text" name="no_hp_pelanggan"
                                    class="form-control @error('no_hp_pelanggan') is-invalid @enderror"
                                    value="{{ old('no_hp_pelanggan') }}" required>
                                @error('no_hp_pelanggan') <div class="invalid-feedback">{{ $message }}</div> @enderror
                            </div>

                            <div class="col-md-4 mb-3">
                                <label class="form-label">Alamat (Opsional)</label>
                                <input type="text" name="alamat_pelanggan" class="form-control"
                                    value="{{ old('alamat_pelanggan') }}">
                            </div>
                        </div>

                        <hr>

                        {{-- DATA LAYANAN --}}
                        <h6 class="fw-bold text-secondary mb-3">DATA LAYANAN</h6>

                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label class="form-label font-weight-bold">Pilih Layanan (Jasa)</label>

                                <select name="id_jasa" id="select-jasa"
                                    class="form-control form-select @error('id_jasa') is-invalid @enderror">
                                    <option value="" data-harga="0" data-satuan="" data-kategori="">-- Pilih Jasa --
                                    </option>
                                    @foreach($jasas as $jasa)
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

                            <div class="col-md-4 mb-3">
                                <label class="form-label">Status Pembayaran</label>
                                <select name="status_pembayaran"
                                    class="form-select @error('status_pembayaran') is-invalid @enderror" required>
                                    <option value="Lunas">Lunas</option>
                                    <option value="Belum Lunas">Belum Lunas</option>
                                </select>
                            </div>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Antar Jemput</label><br>
                            <input type="checkbox" name="antar_jemput" value="1" id="antar_jemput">
                            <label for="antar_jemput">Ya (+Rp5.000)</label>
                        </div>

                        <hr>

                        {{-- TOTAL --}}
                        <h6 class="fw-bold text-secondary mb-3">TOTAL</h6>

                        {{-- INFORMASI PENTING: Input Hidden Total Harga untuk Controller --}}
                        <input type="hidden" name="total_harga" id="input-total-harga" value="0">


                        {{-- Informasi Tagihan (Otomatis) --}}
                        <div class="alert alert-info d-flex justify-content-between align-items-center">
                            <span>Estimasi Total Harga:</span>
                            <h3 class="mb-0 font-weight-bold" id="tampilan-harga">Rp 0</h3>
                        </div>

                        <div class="text-end">
                            <button type="submit" class="btn btn-success btn-lg">
                                💾 Simpan & Cetak
                            </button>
                            <a href="{{ route('admin.transaksi.index') }}" class="btn btn-secondary btn-lg">
                                Batal
                            </a>
                        </div>

                    </form>
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