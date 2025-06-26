@extends('components.sidebar')

@section('content')
    <div class="min-h-screen font-admin">
        <div class="">
            <div class="mb-2 flex items-center gap-3">
                <img src="images/iconJurnal.svg" class="bg-blue-500 rounded-full p-1 shadow" alt="">
                <h1 class="text-2xl md:text-3xl font-extrabold text-slate-700 tracking-tight flex items-center gap-2">
                    Jurnal Umum
                    <span class="ml-2 px-3 py-1 bg-sky-100 text-sky-700 rounded-full text-xs font-semibold shadow-sm">Admin
                        Panel</span>
                </h1>
            </div>
            <!-- Info Section pindah ke bawah header -->
            <div class="mb-6 flex items-center gap-2 text-slate-500 text-sm">
                <img src="images/iconInfo.svg" class="w-5 h-5" alt="">
                <span>Isi data jurnal umum, lalu tambahkan detail transaksi di tabel kanan. Pastikan total debet dan kredit
                    seimbang sebelum simpan.</span>
            </div>

            <div class="flex flex-col md:flex-row gap-6 items-start">
                <!-- Form Input -->
                <div class="flex-1/2 bg-white/90 border border-slate-200 rounded-lg shadow p-6 mb-6 md:mb-0">
                    <form>
                        <div class="grid grid-cols-1 gap-4">
                            <div>
                                <label class="block text-slate-600 text-sm font-semibold mb-1">Tanggal</label>
                                <input type="date"
                                    class="w-full border border-slate-200 rounded-md py-2 px-3 bg-slate-50 focus:outline-none focus:border-sky-400 transition" />
                            </div>
                            <div>
                                <label class="block text-slate-600 text-sm font-semibold mb-1">Pilih Jenis</label>
                                <select
                                    class="w-full border border-slate-200 rounded-md py-2 px-3 bg-slate-50 focus:outline-none focus:border-sky-400 transition">
                                    <option>Pilih Jenis</option>
                                    <option>Kas Masuk</option>
                                    <option>Kas Keluar</option>
                                </select>
                            </div>
                            <div>
                                <label class="block text-slate-600 text-sm font-semibold mb-1">Kategori</label>
                                <select
                                    class="w-full border border-slate-200 rounded-md py-2 px-3 bg-slate-50 focus:outline-none focus:border-sky-400 transition">
                                    <option>Pilih Kategori</option>
                                    <option>Operasional</option>
                                    <option>Investasi</option>
                                </select>
                            </div>
                            <div>
                                <label class="block text-slate-600 text-sm font-semibold mb-1">Keterangan</label>
                                <textarea rows="2"
                                    class="w-full border border-slate-200 rounded-md py-2 px-3 bg-slate-50 focus:outline-none focus:border-sky-400 transition"></textarea>
                            </div>
                        </div>
                    </form>
                </div>

                <!-- Table Jurnal Umum -->
                <div class="flex-[2] bg-white rounded-xl shadow border border-slate-200 sticky top-6 self-start"
                    x-data="{
                        rows: [
                            { rekening: '', debet: 0, kredit: 0 }
                        ],
                        rekeningOptions: ['Kas', 'Bank', 'Utang Dagang'],
                        addRow() {
                            this.rows.push({ rekening: '', debet: 0, kredit: 0 });
                        },
                        removeRow(idx) {
                            this.rows.splice(idx, 1);
                        },
                        resetRows() {
                            this.rows = [{ rekening: '', debet: 0, kredit: 0 }];
                        },
                        get totalDebet() {
                            return this.rows.reduce((sum, r) => sum + Number(r.debet), 0);
                        },
                        get totalKredit() {
                            return this.rows.reduce((sum, r) => sum + Number(r.kredit), 0);
                        }
                    }">
                    <div class="border-b border-slate-200 p-4 flex justify-between items-center">
                        <h2 class="font-bold text-slate-600 flex items-center gap-2">
                            <svg class="w-5 h-5 text-blue-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M9 17v-2m3 2v-4m3 4v-6m2 10H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z">
                                </path>
                            </svg>
                            Detail Transaksi
                        </h2>
                        <div class="flex items-center gap-4">
                            <div class="flex items-center gap-2 text-sm text-slate-600">
                                <span class="font-medium">Total Baris:</span>
                                <span class="px-2 py-1 bg-blue-100 text-blue-700 rounded-lg text-xs font-medium"
                                    x-text="rows.length">
                                </span>
                            </div>
                            <div class="flex items-center gap-2 text-sm text-slate-600">
                                <span class="font-medium">Status:</span>
                                <span class="px-2 py-1 bg-green-100 text-green-700 rounded-lg text-xs font-medium">
                                    Aktif
                                </span>
                            </div>
                        </div>
                    </div>

                    <!-- Table -->
                    <div class="overflow-x-auto">
                        <table class="min-w-full divide-y divide-slate-200">
                            <thead>
                                <tr class="bg-slate-50">
                                    <th scope="col"
                                        class="px-6 py-3 text-left text-xs font-medium text-slate-500 uppercase tracking-wider">
                                        No</th>
                                    <th scope="col"
                                        class="px-6 py-3 text-left text-xs font-medium text-slate-500 uppercase tracking-wider">
                                        Rekening</th>
                                    <th scope="col"
                                        class="px-6 py-3 text-right text-xs font-medium text-slate-500 uppercase tracking-wider">
                                        Debet</th>
                                    <th scope="col"
                                        class="px-6 py-3 text-right text-xs font-medium text-slate-500 uppercase tracking-wider">
                                        Kredit</th>
                                    <th scope="col"
                                        class="px-6 py-3 text-center text-xs font-medium text-slate-500 uppercase tracking-wider">
                                        Aksi</th>
                                </tr>
                            </thead>
                            <tbody class="bg-white divide-y divide-slate-200">
                                <template x-for="(row, idx) in rows" :key="idx">
                                    <tr class="hover:bg-slate-50">
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-slate-600" x-text="idx+1"></td>
                                        <td class="px-6 py-4">
                                            <select x-model="row.rekening"
                                                class="w-full border border-slate-200 rounded-md py-2 px-3 bg-slate-50 focus:outline-none focus:border-sky-400 transition text-sm">
                                                <option value="">Pilih Rekening</option>
                                                <template x-for="opt in rekeningOptions" :key="opt">
                                                    <option x-text="opt"></option>
                                                </template>
                                            </select>
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-right">
                                            <input type="number" min="0" x-model="row.debet"
                                                class="w-32 border border-green-200 rounded-full px-3 py-1 text-green-700 bg-green-50 font-semibold text-sm shadow-sm focus:outline-none focus:border-green-400 text-center" />
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-right">
                                            <input type="number" min="0" x-model="row.kredit"
                                                class="w-32 border border-rose-200 rounded-full px-3 py-1 text-rose-700 bg-rose-50 font-semibold text-sm shadow-sm focus:outline-none focus:border-rose-400 text-center" />
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-center">
                                            <button type="button" @click="removeRow(idx)" x-show="rows.length > 1"
                                                class="bg-rose-400 hover:bg-rose-500 text-white rounded-md px-2 py-2 shadow transition focus:outline-none focus:ring-2 focus:ring-rose-200 font-semibold"
                                                title="Hapus">
                                                <img src="images/iconSampah.svg" class="w-5 min-w-5 min-h-5" alt="">
                                            </button>
                                        </td>
                                    </tr>
                                </template>
                            </tbody>
                            <tfoot>
                                <tr class="bg-slate-50">
                                    <td colspan="2" class="px-6 py-4 text-right text-slate-700">Total</td>
                                    <td class="px-6 py-4 text-right text-green-700"
                                        x-text="'Rp ' + totalDebet.toLocaleString('id-ID', {minimumFractionDigits:2})"></td>
                                    <td class="px-6 py-4 text-right text-rose-700"
                                        x-text="'Rp ' + totalKredit.toLocaleString('id-ID', {minimumFractionDigits:2})">
                                    </td>
                                    <td></td>
                                </tr>
                            </tfoot>
                        </table>
                    </div>

                    <!-- Tombol Aksi -->
                    <div class="flex flex-wrap gap-3 p-4 border-t border-slate-200">
                        <button type="button" @click="resetRows"
                            class="bg-slate-400 hover:bg-slate-500 text-white font-semibold px-6 py-2 rounded-md shadow transition focus:outline-none focus:ring-2 focus:ring-slate-200">
                            Reset
                        </button>
                        <button type="button" @click="addRow"
                            class="bg-sky-500 hover:bg-sky-600 text-white font-semibold px-6 py-2 rounded-md shadow transition focus:outline-none focus:ring-2 focus:ring-sky-200">
                            Tambah
                        </button>
                        <button type="button"
                            class="bg-green-500 hover:bg-green-600 text-white font-semibold px-6 py-2 rounded-md shadow transition focus:outline-none focus:ring-2 focus:ring-green-200">
                            Simpan
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Alpine.js CDN -->
    <script src="//unpkg.com/alpinejs" defer></script>
@endsection
