@extends('components.sidebar')

@section('content')
    <div class="min-h-screen font-admin">
        <div class="">
            <div class="mb-2 flex items-center gap-3">
                <img src="images/iconPemasukan.svg" class="bg-green-500 rounded-full p-1 shadow" alt="">
                <h1 class="text-2xl md:text-3xl font-extrabold text-slate-700 tracking-tight flex items-center gap-2">
                    Jurnal Pemasukan
                    <span class="ml-2 px-3 py-1 bg-sky-100 text-sky-700 rounded-full text-xs font-semibold shadow-sm">Admin
                        Panel</span>
                </h1>
            </div>
            <!-- Info Section -->
            <div class="mb-6 flex items-center gap-2 text-slate-500 text-sm">
                <img src="images/iconInfo.svg" class="w-5 h-5" alt="">
                <span>Catat transaksi pemasukan dengan detail lengkap. Pastikan semua informasi terisi dengan benar.</span>
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
                                <label class="block text-slate-600 text-sm font-semibold mb-1">Kategori Pemasukan</label>
                                <select
                                    class="w-full border border-slate-200 rounded-md py-2 px-3 bg-slate-50 focus:outline-none focus:border-sky-400 transition">
                                    <option value="">Pilih Kategori</option>
                                    <option value="pendapatan_jasa">Pendapatan Jasa</option>
                                    <option value="pendapatan_penjualan">Pendapatan Penjualan</option>
                                    <option value="pendapatan_bunga">Pendapatan Bunga</option>
                                    <option value="pendapatan_lain">Pendapatan Lain-lain</option>
                                </select>
                            </div>
                            <div>
                                <label class="block text-slate-600 text-sm font-semibold mb-1">Metode Pembayaran</label>
                                <select
                                    class="w-full border border-slate-200 rounded-md py-2 px-3 bg-slate-50 focus:outline-none focus:border-sky-400 transition">
                                    <option value="">Pilih Metode</option>
                                    <option value="kas">Kas</option>
                                    <option value="bank">Bank Transfer</option>
                                    <option value="debit">Kartu Debit</option>
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

                <!-- Table Detail Transaksi -->
                <div class="flex-[2] bg-white rounded-xl shadow border border-slate-200 sticky top-6 self-start">
                    <div class="border-b border-slate-200 p-4 flex justify-between items-center">
                        <h2 class="font-bold text-slate-600 flex items-center gap-2">
                            <svg class="w-5 h-5 text-green-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                            </svg>
                            Detail Pemasukan
                        </h2>
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
                                <!-- Table rows will be dynamically added here -->
                            </tbody>
                            <tfoot>
                                <tr class="bg-slate-50">
                                    <td colspan="2" class="px-6 py-4 text-right text-slate-700 font-semibold">Total</td>
                                    <td class="px-6 py-4 text-right text-green-700 font-semibold">Rp 0</td>
                                    <td class="px-6 py-4 text-right text-green-700 font-semibold">Rp 0</td>
                                    <td></td>
                                </tr>
                            </tfoot>
                        </table>
                    </div>

                    <!-- Tombol Aksi -->
                    <div class="flex flex-wrap gap-3 p-4 border-t border-slate-200">
                        <button type="button"
                            class="bg-slate-400 hover:bg-slate-500 text-white font-semibold px-6 py-2 rounded-md shadow transition focus:outline-none focus:ring-2 focus:ring-slate-200">
                            Reset
                        </button>
                        <button type="button"
                            class="bg-sky-500 hover:bg-sky-600 text-white font-semibold px-6 py-2 rounded-md shadow transition focus:outline-none focus:ring-2 focus:ring-sky-200">
                            Tambah Baris
                        </button>
                        <button type="button"
                            class="bg-green-500 hover:bg-green-600 text-white font-semibold px-6 py-2 rounded-md shadow transition focus:outline-none focus:ring-2 focus:ring-green-200">
                            Simpan
                        </button>
                    </div>
                </div>
            </div>

            <!-- Filter Section -->
            <div class="mt-8 bg-white rounded-xl shadow border border-slate-200 p-6">
                <h3 class="text-lg font-semibold text-slate-700 mb-4">Filter Pemasukan</h3>
                <div class="grid grid-cols-1 md:grid-cols-4 gap-4 mb-4">
                    <div>
                        <label class="block text-slate-600 mb-1 text-sm font-medium">Tanggal Mulai</label>
                        <input type="date" class="w-full border border-slate-200 rounded-lg py-2 px-3">
                    </div>
                    <div>
                        <label class="block text-slate-600 mb-1 text-sm font-medium">Tanggal Selesai</label>
                        <input type="date" class="w-full border border-slate-200 rounded-lg py-2 px-3">
                    </div>
                    <div>
                        <label class="block text-slate-600 mb-1 text-sm font-medium">Kategori</label>
                        <select class="w-full border border-slate-200 rounded-lg py-2 px-3">
                            <option value="">Semua Kategori</option>
                            <option value="pendapatan_jasa">Pendapatan Jasa</option>
                            <option value="pendapatan_penjualan">Pendapatan Penjualan</option>
                            <option value="pendapatan_bunga">Pendapatan Bunga</option>
                            <option value="pendapatan_lain">Pendapatan Lain-lain</option>
                        </select>
                    </div>
                    <div>
                        <label class="block text-slate-600 mb-1 text-sm font-medium">Format</label>
                        <select class="w-full border border-slate-200 rounded-lg py-2 px-3">
                            <option value="">Pilih Format</option>
                            <option value="pdf">PDF</option>
                            <option value="excel">Excel</option>
                        </select>
                    </div>
                </div>
                <div class="flex justify-end">
                    <button type="button"
                        class="bg-green-500 hover:bg-green-600 text-white font-semibold px-6 py-2 rounded-md shadow transition focus:outline-none focus:ring-2 focus:ring-green-200">
                        Download Laporan
                    </button>
                </div>
            </div>
        </div>
    </div>
@endsection 