@extends('components.sidebar')

@section('content')
    <div class="min-h-screen font-admin">
        <div>
            <!-- Info Section -->
            <div class="mb-6 w-full flex flex-col md:flex-row md:items-start md:justify-between gap-4">
                <div class="flex items-center gap-3">
                    <img src="images/iconAktifitas.svg" class="bg-blue-500 rounded-full p-2 shadow w-12 h-12" alt="">
                    <div>
                        <h1
                            class="text-2xl md:text-3xl font-extrabold text-slate-700 tracking-tight flex items-center gap-2">
                            Laporan Aktivitas
                            <span
                                class="ml-2 px-3 py-1 bg-sky-100 text-sky-700 rounded-full text-xs font-semibold shadow-sm">
                                Admin Panel
                            </span>
                        </h1>
                        <div class="text-slate-500 text-sm mt-1 flex items-center gap-2">
                            Perbandingan aktivitas keuangan antar periode
                        </div>
                    </div>
                </div>
            </div>

            <!-- Filter Section -->
            <div class="bg-white rounded-xl shadow border border-slate-200 p-6 mb-6">
                <div class="flex items-center justify-between mb-6">
                    <div class="flex items-center gap-2">
                        <svg class="w-5 h-5 text-blue-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M3 4a1 1 0 011-1h16a1 1 0 011 1v2.586a1 1 0 01-.293.707l-6.414 6.414a1 1 0 00-.293.707V17l-4 4v-6.586a1 1 0 00-.293-.707L3.293 7.207A1 1 0 013 6.5V4z">
                            </path>
                        </svg>
                        <h2 class="font-bold text-slate-600">Download Laporan Aktivitas</h2>
                    </div>
                    <div class="flex items-center gap-2 text-sm text-slate-600">
                        <span class="font-medium">Status:</span>
                        <span class="px-2 py-1 bg-green-100 text-green-700 rounded-lg text-xs font-medium">
                            Siap Download
                        </span>
                    </div>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                    <!-- Periode Pertama -->
                    <div>
                        <label class="block text-sm font-medium text-slate-600 mb-3">Periode Pertama</label>
                        <div class="space-y-3">
                            <select
                                class="bg-slate-50 border border-slate-300 text-slate-900 text-sm rounded-lg focus:ring-indigo-500 focus:border-indigo-500 block w-full p-3">
                                <option value="">Pilih Bulan</option>
                                <option value="1">Januari</option>
                                <option value="2">Februari</option>
                                <option value="3">Maret</option>
                                <option value="4">April</option>
                                <option value="5">Mei</option>
                                <option value="6">Juni</option>
                                <option value="7">Juli</option>
                                <option value="8">Agustus</option>
                                <option value="9">September</option>
                                <option value="10">Oktober</option>
                                <option value="11">November</option>
                                <option value="12">Desember</option>
                            </select>
                            <input type="number"
                                class="bg-slate-50 border border-slate-300 text-slate-900 text-sm rounded-lg focus:ring-indigo-500 focus:border-indigo-500 block w-full p-3"
                                placeholder="Tahun" value="2024">
                        </div>
                    </div>

                    <!-- Periode Kedua -->
                    <div>
                        <label class="block text-sm font-medium text-slate-600 mb-3">Periode Kedua</label>
                        <div class="space-y-3">
                            <select
                                class="bg-slate-50 border border-slate-300 text-slate-900 text-sm rounded-lg focus:ring-indigo-500 focus:border-indigo-500 block w-full p-3">
                                <option value="">Pilih Bulan</option>
                                <option value="1">Januari</option>
                                <option value="2">Februari</option>
                                <option value="3">Maret</option>
                                <option value="4">April</option>
                                <option value="5">Mei</option>
                                <option value="6">Juni</option>
                                <option value="7">Juli</option>
                                <option value="8">Agustus</option>
                                <option value="9">September</option>
                                <option value="10">Oktober</option>
                                <option value="11">November</option>
                                <option value="12">Desember</option>
                            </select>
                            <input type="number"
                                class="bg-slate-50 border border-slate-300 text-slate-900 text-sm rounded-lg focus:ring-indigo-500 focus:border-indigo-500 block w-full p-3"
                                placeholder="Tahun" value="2024">
                        </div>
                    </div>

                    <!-- Format dan Download -->
                    <div class="space-y-3">
                        <label class="block text-sm font-medium text-slate-600">Format Laporan</label>
                        <select
                            class="bg-slate-50 border border-slate-300 text-slate-900 text-sm rounded-lg focus:ring-indigo-500 focus:border-indigo-500 block w-full p-3">
                            <option value="">Pilih Format</option>
                            <option value="pdf">PDF</option>
                            <option value="excel">Excel</option>
                        </select>

                        <button
                            class="w-full text-white bg-indigo-600 hover:bg-indigo-700 focus:ring-4 focus:ring-indigo-300 font-medium rounded-lg text-sm px-6 py-3 focus:outline-none transition-colors mt-6">
                            <svg class="w-5 h-5 inline mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z">
                                </path>
                            </svg>
                            Download Laporan
                        </button>
                    </div>
                </div>
            </div>

            <!-- Summary Cards -->
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-6">
                <!-- Pendapatan Card -->
                <div class="bg-white rounded-xl shadow border border-slate-200 p-6">
                    <div class="flex items-center justify-between mb-4">
                        <div class="flex items-center gap-3">
                            <div class="p-2 bg-green-100 rounded-lg">
                                <svg class="w-6 h-6 text-green-600" fill="none" stroke="currentColor"
                                    viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M12 4v16m8-8H4"></path>
                                </svg>
                            </div>
                            <div>
                                <h3 class="text-lg font-semibold text-slate-800">Total Pendapatan</h3>
                                <p class="text-sm text-slate-500">Perbandingan antar periode</p>
                            </div>
                        </div>
                    </div>
                    <div class="space-y-3">
                        <div class="flex justify-between items-center p-3 bg-green-50 rounded-lg">
                            <span class="text-sm text-slate-600">Periode Pertama</span>
                            <span class="text-lg font-semibold text-green-600">Rp 150.000.000</span>
                        </div>
                        <div class="flex justify-between items-center p-3 bg-blue-50 rounded-lg">
                            <span class="text-sm text-slate-600">Periode Kedua</span>
                            <span class="text-lg font-semibold text-blue-600">Rp 180.000.000</span>
                        </div>
                        <div class="flex justify-between items-center pt-2 border-t border-slate-200">
                            <span class="text-sm font-medium text-slate-700">Selisih</span>
                            <span class="text-sm font-semibold text-green-600">+Rp 30.000.000 (+20%)</span>
                        </div>
                    </div>
                </div>

                <!-- Beban Card -->
                <div class="bg-white rounded-xl shadow border border-slate-200 p-6">
                    <div class="flex items-center justify-between mb-4">
                        <div class="flex items-center gap-3">
                            <div class="p-2 bg-rose-100 rounded-lg">
                                <svg class="w-6 h-6 text-rose-600" fill="none" stroke="currentColor"
                                    viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 12H4">
                                    </path>
                                </svg>
                            </div>
                            <div>
                                <h3 class="text-lg font-semibold text-slate-800">Total Beban</h3>
                                <p class="text-sm text-slate-500">Perbandingan antar periode</p>
                            </div>
                        </div>
                    </div>
                    <div class="space-y-3">
                        <div class="flex justify-between items-center p-3 bg-rose-50 rounded-lg">
                            <span class="text-sm text-slate-600">Periode Pertama</span>
                            <span class="text-lg font-semibold text-rose-600">Rp 100.000.000</span>
                        </div>
                        <div class="flex justify-between items-center p-3 bg-blue-50 rounded-lg">
                            <span class="text-sm text-slate-600">Periode Kedua</span>
                            <span class="text-lg font-semibold text-blue-600">Rp 120.000.000</span>
                        </div>
                        <div class="flex justify-between items-center pt-2 border-t border-slate-200">
                            <span class="text-sm font-medium text-slate-700">Selisih</span>
                            <span class="text-sm font-semibold text-rose-600">+Rp 20.000.000 (+20%)</span>
                        </div>
                    </div>
                </div>

                <!-- Surplus/Defisit Card -->
                <div class="bg-white rounded-xl shadow border border-slate-200 p-6">
                    <div class="flex items-center justify-between mb-4">
                        <div class="flex items-center gap-3">
                            <div class="p-2 bg-blue-100 rounded-lg">
                                <svg class="w-6 h-6 text-blue-600" fill="none" stroke="currentColor"
                                    viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M13 7h8m0 0v8m0-8l-8 8-4-4-6 6"></path>
                                </svg>
                            </div>
                            <div>
                                <h3 class="text-lg font-semibold text-slate-800">Surplus/Defisit</h3>
                                <p class="text-sm text-slate-500">Perbandingan antar periode</p>
                            </div>
                        </div>
                    </div>
                    <div class="space-y-3">
                        <div class="flex justify-between items-center p-3 bg-blue-50 rounded-lg">
                            <span class="text-sm text-slate-600">Periode Pertama</span>
                            <span class="text-lg font-semibold text-blue-600">Rp 50.000.000</span>
                        </div>
                        <div class="flex justify-between items-center p-3 bg-blue-50 rounded-lg">
                            <span class="text-sm text-slate-600">Periode Kedua</span>
                            <span class="text-lg font-semibold text-blue-600">Rp 60.000.000</span>
                        </div>
                        <div class="flex justify-between items-center pt-2 border-t border-slate-200">
                            <span class="text-sm font-medium text-slate-700">Selisih</span>
                            <span class="text-sm font-semibold text-blue-600">+Rp 10.000.000 (+20%)</span>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Table Section -->
            <div class="bg-white rounded-xl shadow border border-slate-200">
                <div class="border-b border-slate-200 p-4 flex justify-between items-center">
                    <h2 class="font-bold text-slate-600 flex items-center gap-2">
                        <svg class="w-5 h-5 text-blue-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M9 17v-2m3 2v-4m3 4v-6m2 10H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z">
                            </path>
                        </svg>
                        Data Aktivitas
                    </h2>
                    <div class="flex items-center gap-4">
                        <div class="flex items-center gap-2 text-sm text-slate-600">
                            <span class="font-medium">Status:</span>
                            <span class="px-2 py-1 bg-green-100 text-green-700 rounded-lg text-xs font-medium">
                                Aktif
                            </span>
                        </div>
                    </div>
                </div>

                <div class="overflow-x-auto">
                    <table class="min-w-full divide-y divide-slate-200">
                        <thead>
                            <tr class="bg-slate-50">
                                <th scope="col"
                                    class="px-6 py-3 text-left text-xs font-medium text-slate-500 uppercase tracking-wider">
                                    Nama Akun
                                </th>
                                <th scope="col"
                                    class="px-6 py-3 text-right text-xs font-medium text-slate-500 uppercase tracking-wider">
                                    Periode Pertama
                                </th>
                                <th scope="col"
                                    class="px-6 py-3 text-right text-xs font-medium text-slate-500 uppercase tracking-wider">
                                    Periode Kedua
                                </th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-slate-200">
                            <!-- Pendapatan -->
                            <tr class="bg-slate-50">
                                <td colspan="3" class="px-6 py-3 text-left text-sm font-semibold text-slate-700">
                                    PENDAPATAN
                                </td>
                            </tr>
                            <tr class="hover:bg-slate-50">
                                <td class="px-6 py-4 text-sm text-slate-600">Pendapatan Jasa</td>
                                <td class="px-6 py-4 text-right text-sm font-medium text-green-600">Rp 100.000.000</td>
                                <td class="px-6 py-4 text-right text-sm font-medium text-green-600">Rp 120.000.000</td>
                            </tr>
                            <tr class="hover:bg-slate-50">
                                <td class="px-6 py-4 text-sm text-slate-600">Pendapatan Bunga</td>
                                <td class="px-6 py-4 text-right text-sm font-medium text-green-600">Rp 50.000.000</td>
                                <td class="px-6 py-4 text-right text-sm font-medium text-green-600">Rp 60.000.000</td>
                            </tr>
                            <tr class="bg-slate-50">
                                <td class="px-6 py-4 text-sm font-medium text-slate-700">Total Pendapatan</td>
                                <td class="px-6 py-4 text-right text-sm font-medium text-slate-700">Rp 150.000.000</td>
                                <td class="px-6 py-4 text-right text-sm font-medium text-slate-700">Rp 180.000.000</td>
                            </tr>

                            <!-- Beban -->
                            <tr class="bg-slate-50">
                                <td colspan="3" class="px-6 py-3 text-left text-sm font-semibold text-slate-700">
                                    BEBAN
                                </td>
                            </tr>
                            <tr class="hover:bg-slate-50">
                                <td class="px-6 py-4 text-sm text-slate-600">Beban Gaji</td>
                                <td class="px-6 py-4 text-right text-sm font-medium text-rose-600">Rp 60.000.000</td>
                                <td class="px-6 py-4 text-right text-sm font-medium text-rose-600">Rp 70.000.000</td>
                            </tr>
                            <tr class="hover:bg-slate-50">
                                <td class="px-6 py-4 text-sm text-slate-600">Beban Operasional</td>
                                <td class="px-6 py-4 text-right text-sm font-medium text-rose-600">Rp 30.000.000</td>
                                <td class="px-6 py-4 text-right text-sm font-medium text-rose-600">Rp 35.000.000</td>
                            </tr>
                            <tr class="hover:bg-slate-50">
                                <td class="px-6 py-4 text-sm text-slate-600">Beban Penyusutan</td>
                                <td class="px-6 py-4 text-right text-sm font-medium text-rose-600">Rp 10.000.000</td>
                                <td class="px-6 py-4 text-right text-sm font-medium text-rose-600">Rp 15.000.000</td>
                            </tr>
                            <tr class="bg-slate-50">
                                <td class="px-6 py-4 text-sm font-medium text-slate-700">Total Beban</td>
                                <td class="px-6 py-4 text-right text-sm font-medium text-slate-700">Rp 100.000.000</td>
                                <td class="px-6 py-4 text-right text-sm font-medium text-slate-700">Rp 120.000.000</td>
                            </tr>
                        </tbody>
                        <tfoot>
                            <tr class="bg-slate-100 font-bold">
                                <td class="px-6 py-4 text-sm text-slate-800">SURPLUS/DEFISIT</td>
                                <td class="px-6 py-4 text-right text-sm text-blue-600">Rp 50.000.000</td>
                                <td class="px-6 py-4 text-right text-sm text-blue-600">Rp 60.000.000</td>
                            </tr>
                        </tfoot>
                    </table>
                </div>

                <!-- Pagination -->
                <div class="bg-white px-4 py-3 border-t border-slate-200 sm:px-6">
                    <div class="flex items-center justify-between">
                        <div class="flex-1 flex justify-between sm:hidden">
                            <a href="#"
                                class="relative inline-flex items-center px-4 py-2 border border-slate-300 text-sm font-medium rounded-lg text-slate-700 bg-white hover:bg-slate-50">
                                Previous
                            </a>
                            <a href="#"
                                class="ml-3 relative inline-flex items-center px-4 py-2 border border-slate-300 text-sm font-medium rounded-lg text-slate-700 bg-white hover:bg-slate-50">
                                Next
                            </a>
                        </div>
                        <div class="hidden sm:flex-1 sm:flex sm:items-center sm:justify-between">
                            <div>
                                <p class="text-sm text-slate-700">
                                    Showing
                                    <span class="font-medium">1</span>
                                    to
                                    <span class="font-medium">7</span>
                                    of
                                    <span class="font-medium">7</span>
                                    results
                                </p>
                            </div>
                            <div>
                                <nav class="relative z-0 inline-flex rounded-md shadow -space-x-px"
                                    aria-label="Pagination">
                                    <a href="#"
                                        class="relative inline-flex items-center px-2 py-2 rounded-l-lg border border-slate-300 bg-white text-sm font-medium text-slate-500 hover:bg-slate-50">
                                        <span class="sr-only">Previous</span>
                                        <svg class="h-5 w-5" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"
                                            fill="currentColor" aria-hidden="true">
                                            <path fill-rule="evenodd"
                                                d="M12.707 5.293a1 1 0 010 1.414L9.414 10l3.293 3.293a1 1 0 01-1.414 1.414l-4-4a1 1 0 010-1.414l4-4a1 1 0 011.414 0z"
                                                clip-rule="evenodd" />
                                        </svg>
                                    </a>
                                    <a href="#" aria-current="page"
                                        class="z-10 bg-blue-50 border-blue-500 text-blue-600 relative inline-flex items-center px-4 py-2 border text-sm font-medium">
                                        1
                                    </a>
                                    <a href="#"
                                        class="relative inline-flex items-center px-2 py-2 rounded-r-lg border border-slate-300 bg-white text-sm font-medium text-slate-500 hover:bg-slate-50">
                                        <span class="sr-only">Next</span>
                                        <svg class="h-5 w-5" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"
                                            fill="currentColor" aria-hidden="true">
                                            <path fill-rule="evenodd"
                                                d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z"
                                                clip-rule="evenodd" />
                                        </svg>
                                    </a>
                                </nav>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
