@extends('components.sidebar')

@section('content')
    <div class="min-h-screen bg-gray-50/30 font-admin">
        <!-- Header -->
        <div class="">
            <div class="mb-8">
                <div class="flex items-center gap-3">
                    <div class="bg-blue-500 rounded-full p-3 shadow-lg">
                        <img src="images/iconSaldo.svg" class="w-8 h-8" alt="">
                    </div>
                    <div>
                        <h1 class="text-3xl font-extrabold text-slate-700 tracking-tight">Laporan Saldo Awal</h1>
                        <p class="text-slate-500 mt-1">Laporan saldo awal akun per periode akuntansi</p>
                    </div>
                    <span class="ml-auto px-3 py-1 bg-sky-100 text-sky-700 rounded-full text-xs font-semibold shadow-sm">
                        Laporan Keuangan
                    </span>
                </div>
            </div>

            <!-- Info Cards -->
            <div class="grid grid-cols-1 md:grid-cols-4 gap-6 mb-8">
                <div class="bg-white rounded-xl shadow border border-slate-200 p-6">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-sm font-medium text-slate-600">Periode</p>
                            <p class="text-xl font-bold text-slate-700 mt-1">Januari 2024</p>
                            <p class="text-xs text-green-600 mt-1">Periode Aktif</p>
                        </div>
                        <div class="bg-blue-100 rounded-full p-3">
                            <img src="images/iconPeriode.svg" class="w-6 h-6" alt="">
                        </div>
                    </div>
                </div>

                <div class="bg-white rounded-xl shadow border border-slate-200 p-6">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-sm font-medium text-slate-600">Total Debet</p>
                            <p class="text-xl font-bold text-green-600 mt-1">Rp 25.000.000</p>
                            <p class="text-xs text-green-500 mt-1">+2.5% dari periode lalu</p>
                        </div>
                        <div class="bg-green-100 rounded-full p-3">
                            <svg class="w-6 h-6 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4">
                                </path>
                            </svg>
                        </div>
                    </div>
                </div>

                <div class="bg-white rounded-xl shadow border border-slate-200 p-6">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-sm font-medium text-slate-600">Total Kredit</p>
                            <p class="text-xl font-bold text-red-600 mt-1">Rp 25.000.000</p>
                            <p class="text-xs text-red-500 mt-1">+2.5% dari periode lalu</p>
                        </div>
                        <div class="bg-red-100 rounded-full p-3">
                            <svg class="w-6 h-6 text-red-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 12H4"></path>
                            </svg>
                        </div>
                    </div>
                </div>

                <div class="bg-white rounded-xl shadow border border-slate-200 p-6">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-sm font-medium text-slate-600">Status</p>
                            <p class="text-xl font-bold text-blue-600 mt-1">Seimbang</p>
                            <p class="text-xs text-blue-500 mt-1">✓ Debet = Kredit</p>
                        </div>
                        <div class="bg-blue-100 rounded-full p-3">
                            <svg class="w-6 h-6 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                            </svg>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Filter Section -->
            <div class="bg-white rounded-xl shadow border border-slate-200 p-6 mb-8">
                <h3 class="text-lg font-semibold text-slate-700 mb-4">Filter Laporan</h3>
                <form class="grid grid-cols-1 md:grid-cols-4 gap-4 mb-4">
                    <div>
                        <label class="block text-slate-600 mb-1 text-sm font-medium">Periode</label>
                        <select
                            class="w-full border border-slate-200 rounded-lg focus:border-blue-500 focus:ring-blue-500 text-sm py-2 px-3">
                            <option value="">Pilih Periode</option>
                            <option value="2024-01" selected>Januari 2024</option>
                            <option value="2023-12">Desember 2023</option>
                            <option value="2023-11">November 2023</option>
                        </select>
                    </div>
                    <div>
                        <label class="block text-slate-600 mb-1 text-sm font-medium">Kategori Akun</label>
                        <select
                            class="w-full border border-slate-200 rounded-lg focus:border-blue-500 focus:ring-blue-500 text-sm py-2 px-3">
                            <option value="">Semua Kategori</option>
                            <option value="asset">Asset</option>
                            <option value="liability">Liability</option>
                            <option value="equity">Equity</option>
                            <option value="revenue">Revenue</option>
                            <option value="expense">Expense</option>
                        </select>
                    </div>
                    <div>
                        <label class="block text-slate-600 mb-1 text-sm font-medium">Status</label>
                        <select
                            class="w-full border border-slate-200 rounded-lg focus:border-blue-500 focus:ring-blue-500 text-sm py-2 px-3">
                            <option value="">Semua Status</option>
                            <option value="active" selected>Aktif</option>
                            <option value="inactive">Tidak Aktif</option>
                        </select>
                    </div>
                    <div class="flex items-end gap-2">
                        <button type="submit"
                            class="flex-1 bg-blue-500 hover:bg-blue-600 text-white font-medium py-2 px-4 rounded-lg transition focus:outline-none focus:ring-2 focus:ring-blue-200">
                            Tampilkan
                        </button>
                        <button type="button"
                            class="bg-slate-400 hover:bg-slate-500 text-white font-medium py-2 px-4 rounded-lg transition focus:outline-none focus:ring-2 focus:ring-slate-200">
                            Reset
                        </button>
                    </div>
                </form>

                <!-- Download Options -->
                <div class="border-t border-slate-200 pt-4">
                    <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-4">
                        <div class="flex items-center gap-2 text-sm text-slate-600">
                            <svg class="w-4 h-4 text-blue-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M13 16h-1v-4h-1m1-4h.01M12 20a8 8 0 100-16 8 8 0 000 16z"></path>
                            </svg>
                            <span>Pilih format untuk mengunduh laporan</span>
                        </div>
                        <div class="flex items-center gap-2">
                            <select class="rounded-lg border-slate-200 focus:border-blue-500 focus:ring-blue-500 text-sm">
                                <option value="">Pilih Format</option>
                                <option value="pdf">PDF</option>
                                <option value="excel">Excel</option>
                                <option value="csv">CSV</option>
                            </select>
                            <button type="button"
                                class="inline-flex items-center px-4 py-2 border border-transparent shadow text-sm font-medium rounded-lg text-white bg-green-600 hover:bg-green-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-green-500">
                                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4"></path>
                                </svg>
                                Download
                            </button>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Report Table -->
            <div class="bg-white rounded-xl shadow border border-slate-200">
                <div class="border-b border-slate-200 p-4 flex justify-between items-center">
                    <h2 class="font-bold text-slate-600 flex items-center gap-2">
                        <svg class="w-5 h-5 text-blue-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M9 17v-2m3 2v-4m3 4v-6m2 10H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z">
                            </path>
                        </svg>
                        Laporan Saldo Awal - Januari 2024
                    </h2>
                    <div class="flex items-center gap-4">
                        <div class="flex items-center gap-2 text-sm text-slate-600">
                            <span class="font-medium">Total Akun:</span>
                            <span class="px-2 py-1 bg-blue-100 text-blue-700 rounded-lg text-xs font-medium">
                                7
                            </span>
                        </div>
                        <div class="flex items-center gap-2 text-sm text-slate-600">
                            <span class="font-medium">Status:</span>
                            <span class="px-2 py-1 bg-green-100 text-green-700 rounded-lg text-xs font-medium">
                                Seimbang
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
                                    Kode Akun</th>
                                <th scope="col"
                                    class="px-6 py-3 text-left text-xs font-medium text-slate-500 uppercase tracking-wider">
                                    Nama Akun</th>
                                <th scope="col"
                                    class="px-6 py-3 text-left text-xs font-medium text-slate-500 uppercase tracking-wider">
                                    Kategori</th>
                                <th scope="col"
                                    class="px-6 py-3 text-right text-xs font-medium text-slate-500 uppercase tracking-wider">
                                    Debet</th>
                                <th scope="col"
                                    class="px-6 py-3 text-right text-xs font-medium text-slate-500 uppercase tracking-wider">
                                    Kredit</th>
                                <th scope="col"
                                    class="px-6 py-3 text-center text-xs font-medium text-slate-500 uppercase tracking-wider">
                                    Status</th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-slate-200">
                            <!-- Asset -->
                            <tr class="bg-blue-50">
                                <td colspan="7" class="px-6 py-3">
                                    <h4 class="font-bold text-blue-700 text-sm">ASSET</h4>
                                </td>
                            </tr>
                            <tr class="hover:bg-slate-50">
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-slate-600">1</td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-slate-500 font-medium">1001</td>
                                <td class="px-6 py-4 text-sm text-slate-600">Kas</td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <span
                                        class="inline-flex px-2 py-1 text-xs font-semibold rounded-full bg-green-100 text-green-800">
                                        Asset
                                    </span>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-slate-600 text-right font-medium">
                                    15.000.000</td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-slate-600 text-right">0</td>
                                <td class="px-6 py-4 whitespace-nowrap text-center">
                                    <span
                                        class="inline-flex px-2 py-1 text-xs font-semibold rounded-full bg-green-100 text-green-800">
                                        Aktif
                                    </span>
                                </td>
                            </tr>
                            <tr class="hover:bg-slate-50">
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-slate-600">2</td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-slate-500 font-medium">1101</td>
                                <td class="px-6 py-4 text-sm text-slate-600">Bank</td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <span
                                        class="inline-flex px-2 py-1 text-xs font-semibold rounded-full bg-green-100 text-green-800">
                                        Asset
                                    </span>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-slate-600 text-right font-medium">
                                    5.000.000</td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-slate-600 text-right">0</td>
                                <td class="px-6 py-4 whitespace-nowrap text-center">
                                    <span
                                        class="inline-flex px-2 py-1 text-xs font-semibold rounded-full bg-green-100 text-green-800">
                                        Aktif
                                    </span>
                                </td>
                            </tr>
                            <tr class="hover:bg-slate-50">
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-slate-600">3</td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-slate-500 font-medium">1201</td>
                                <td class="px-6 py-4 text-sm text-slate-600">Piutang Dagang</td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <span
                                        class="inline-flex px-2 py-1 text-xs font-semibold rounded-full bg-green-100 text-green-800">
                                        Asset
                                    </span>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-slate-600 text-right font-medium">
                                    3.800.000</td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-slate-600 text-right">0</td>
                                <td class="px-6 py-4 whitespace-nowrap text-center">
                                    <span
                                        class="inline-flex px-2 py-1 text-xs font-semibold rounded-full bg-green-100 text-green-800">
                                        Aktif
                                    </span>
                                </td>
                            </tr>
                            <tr class="hover:bg-slate-50">
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-slate-600">4</td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-slate-500 font-medium">1301</td>
                                <td class="px-6 py-4 text-sm text-slate-600">Perlengkapan Kantor</td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <span
                                        class="inline-flex px-2 py-1 text-xs font-semibold rounded-full bg-green-100 text-green-800">
                                        Asset
                                    </span>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-slate-600 text-right font-medium">
                                    1.200.000</td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-slate-600 text-right">0</td>
                                <td class="px-6 py-4 whitespace-nowrap text-center">
                                    <span
                                        class="inline-flex px-2 py-1 text-xs font-semibold rounded-full bg-green-100 text-green-800">
                                        Aktif
                                    </span>
                                </td>
                            </tr>

                            <!-- Liability -->
                            <tr class="bg-yellow-50">
                                <td colspan="7" class="px-6 py-3">
                                    <h4 class="font-bold text-yellow-700 text-sm">LIABILITY</h4>
                                </td>
                            </tr>
                            <tr class="hover:bg-slate-50">
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-slate-600">5</td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-slate-500 font-medium">2001</td>
                                <td class="px-6 py-4 text-sm text-slate-600">Utang Dagang</td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <span
                                        class="inline-flex px-2 py-1 text-xs font-semibold rounded-full bg-yellow-100 text-yellow-800">
                                        Liability
                                    </span>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-slate-600 text-right">0</td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-slate-600 text-right font-medium">
                                    3.000.000</td>
                                <td class="px-6 py-4 whitespace-nowrap text-center">
                                    <span
                                        class="inline-flex px-2 py-1 text-xs font-semibold rounded-full bg-green-100 text-green-800">
                                        Aktif
                                    </span>
                                </td>
                            </tr>
                            <tr class="hover:bg-slate-50">
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-slate-600">6</td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-slate-500 font-medium">2101</td>
                                <td class="px-6 py-4 text-sm text-slate-600">Utang Bank</td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <span
                                        class="inline-flex px-2 py-1 text-xs font-semibold rounded-full bg-yellow-100 text-yellow-800">
                                        Liability
                                    </span>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-slate-600 text-right">0</td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-slate-600 text-right font-medium">
                                    5.000.000</td>
                                <td class="px-6 py-4 whitespace-nowrap text-center">
                                    <span
                                        class="inline-flex px-2 py-1 text-xs font-semibold rounded-full bg-green-100 text-green-800">
                                        Aktif
                                    </span>
                                </td>
                            </tr>

                            <!-- Equity -->
                            <tr class="bg-blue-50">
                                <td colspan="7" class="px-6 py-3">
                                    <h4 class="font-bold text-blue-700 text-sm">EQUITY</h4>
                                </td>
                            </tr>
                            <tr class="hover:bg-slate-50">
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-slate-600">7</td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-slate-500 font-medium">3001</td>
                                <td class="px-6 py-4 text-sm text-slate-600">Modal Pemilik</td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <span
                                        class="inline-flex px-2 py-1 text-xs font-semibold rounded-full bg-blue-100 text-blue-800">
                                        Equity
                                    </span>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-slate-600 text-right">0</td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-slate-600 text-right font-medium">
                                    17.000.000</td>
                                <td class="px-6 py-4 whitespace-nowrap text-center">
                                    <span
                                        class="inline-flex px-2 py-1 text-xs font-semibold rounded-full bg-green-100 text-green-800">
                                        Aktif
                                    </span>
                                </td>
                            </tr>
                        </tbody>
                        <tfoot>
                            <tr class="bg-slate-100">
                                <td colspan="4" class="px-6 py-4 text-right font-bold text-slate-700">TOTAL</td>
                                <td class="px-6 py-4 whitespace-nowrap text-right font-bold text-green-600">25.000.000</td>
                                <td class="px-6 py-4 whitespace-nowrap text-right font-bold text-red-600">25.000.000</td>
                                <td></td>
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
