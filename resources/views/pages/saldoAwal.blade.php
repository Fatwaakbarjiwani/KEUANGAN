@extends('components.sidebar')

@section('content')
    <div class="min-h-screen font-admin">
        <div>
            <!-- Info Section -->
            <div class="mb-4 w-full flex flex-col md:flex-row md:items-start md:justify-between gap-4">
                <div class="flex items-center gap-3">
                    <img src="images/iconSaldo.svg" class="bg-blue-500 rounded-full p-2 shadow w-12 h-12" alt="">
                    <div>
                        <h1
                            class="text-2xl md:text-3xl font-extrabold text-slate-700 tracking-tight flex items-center gap-2">
                            Saldo Awal
                            <span
                                class="ml-2 px-3 py-1 bg-sky-100 text-sky-700 rounded-full text-xs font-semibold shadow-sm">Admin
                                Panel</span>
                        </h1>
                        <div class="text-slate-500 text-sm mt-1 flex items-center gap-2">
                            Kelola saldo awal akun, edit nilai debet/kredit langsung pada tabel.
                        </div>
                    </div>
                </div>
                @php
                    $saldoAwal = [
                        ['code' => '1001', 'rekening' => 'Kas', 'debet' => 15000000, 'kredit' => 0],
                        ['code' => '1101', 'rekening' => 'Bank', 'debet' => 5000000, 'kredit' => 0],
                        ['code' => '2001', 'rekening' => 'Utang Dagang', 'debet' => 0, 'kredit' => 3000000],
                        ['code' => '3001', 'rekening' => 'Modal Pemilik', 'debet' => 0, 'kredit' => 17000000],
                    ];
                    $totalDebet = array_sum(array_column($saldoAwal, 'debet'));
                    $totalKredit = array_sum(array_column($saldoAwal, 'kredit'));
                @endphp
                <div class="flex gap-4 mt-2 md:mt-0">
                    <!-- Total Debet Card -->
                    <div class="flex flex-col items-center">
                        <div
                            class="relative bg-gradient-to-r from-green-400/90 to-green-600/90 rounded-xl shadow px-4 py-1 flex flex-col items-center min-w-[140px]">
                            <div class="absolute -top-4 left-1/2 -translate-x-1/2 bg-white rounded-full shadow p-1">
                                <svg class="w-7 h-7 text-green-500" fill="none" stroke="currentColor" stroke-width="2"
                                    viewBox="0 0 24 24">
                                    <circle cx="12" cy="12" r="10" stroke="currentColor" stroke-width="2"
                                        fill="none" />
                                    <path d="M8 12l2 2l4-4" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                        stroke-linejoin="round" />
                                </svg>
                            </div>
                            <span class="text-xs text-white/80 font-semibold tracking-wide mt-5">Total Debet</span>
                            <span class="text-white text-lg font-extrabold mt-1 drop-shadow flex items-center gap-1">
                                Rp {{ number_format($totalDebet, 0, ',', '.') }}
                            </span>
                        </div>
                    </div>
                    <!-- Total Kredit Card -->
                    <div class="flex flex-col items-center">
                        <div
                            class="relative bg-gradient-to-r from-rose-400/90 to-rose-600/90 rounded-xl shadow px-4 py-1 flex flex-col items-center min-w-[140px]">
                            <div class="absolute -top-4 left-1/2 -translate-x-1/2 bg-white rounded-full shadow p-1">
                                <svg class="w-7 h-7 text-rose-500" fill="none" stroke="currentColor" stroke-width="2"
                                    viewBox="0 0 24 24">
                                    <circle cx="12" cy="12" r="10" stroke="currentColor" stroke-width="2"
                                        fill="none" />
                                    <path d="M16 12H8" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                        stroke-linejoin="round" />
                                </svg>
                            </div>
                            <span class="text-xs text-white/80 font-semibold tracking-wide mt-5">Total Kredit</span>
                            <span class="text-white text-lg font-extrabold mt-1 drop-shadow flex items-center gap-1">
                                Rp {{ number_format($totalKredit, 0, ',', '.') }}
                            </span>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Table with Edit/Save Action -->
            <div x-data="{
                editIndex: null,
                rows: @js($saldoAwal),
                editDebet: null,
                editKredit: null,
                startEdit(idx) {
                    this.editIndex = idx;
                    this.editDebet = this.rows[idx].debet;
                    this.editKredit = this.rows[idx].kredit;
                },
                saveEdit(idx) {
                    this.rows[idx].debet = Number(this.editDebet);
                    this.rows[idx].kredit = Number(this.editKredit);
                    this.editIndex = null;
                }
            }" class="bg-white rounded-xl shadow border border-slate-200" x-init="$watch('rows', value => {}, { deep: true })">
                <div class="border-b border-slate-200 p-4 flex justify-between items-center">
                    <h2 class="font-bold text-slate-600 flex items-center gap-2">
                        <svg class="w-5 h-5 text-blue-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M9 17v-2m3 2v-4m3 4v-6m2 10H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z">
                            </path>
                        </svg>
                        Data Saldo Awal
                    </h2>
                    <div class="flex items-center gap-4">
                        <div class="flex items-center gap-2 text-sm text-slate-600">
                            <span class="font-medium">Total Akun:</span>
                            <span class="px-2 py-1 bg-blue-100 text-blue-700 rounded-lg text-xs font-medium">
                                {{ count($saldoAwal) }}
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
                                    Kode</th>
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
                            <template x-for="(row, i) in rows" :key="i">
                                <tr class="hover:bg-slate-50">
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-slate-600" x-text="i+1"></td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-slate-500" x-text="row.code"></td>
                                    <td class="px-6 py-4 text-sm text-slate-600" x-text="row.rekening"></td>
                                    <td class="px-6 py-4 whitespace-nowrap text-right">
                                        <template x-if="editIndex === i">
                                            <input type="number" min="0" x-model="editDebet"
                                                class="w-28 md:w-36 border border-green-200 rounded-full px-4 py-1 text-green-700 bg-green-50 text-sm shadow-sm focus:outline-none focus:border-green-400 text-center" />
                                        </template>
                                        <template x-if="editIndex !== i">
                                            <span x-show="row.debet" class="text-sm font-medium text-green-600"
                                                x-text="'Rp ' + Number(row.debet).toLocaleString('id-ID')"></span>
                                            <span x-show="!row.debet" class="text-slate-400 text-sm">-</span>
                                        </template>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-right">
                                        <template x-if="editIndex === i">
                                            <input type="number" min="0" x-model="editKredit"
                                                class="w-28 md:w-36 border border-rose-200 rounded-full px-4 py-1 text-rose-700 bg-rose-50 text-sm shadow-sm focus:outline-none focus:border-rose-400 text-center" />
                                        </template>
                                        <template x-if="editIndex !== i">
                                            <span x-show="row.kredit" class="text-sm font-medium text-rose-600"
                                                x-text="'Rp ' + Number(row.kredit).toLocaleString('id-ID')"></span>
                                            <span x-show="!row.kredit" class="text-slate-400 text-sm">-</span>
                                        </template>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-center">
                                        <button type="button" x-show="editIndex !== i" @click="startEdit(i)"
                                            class="flex items-center justify-center mx-auto bg-amber-400 hover:bg-amber-500 text-white rounded-md p-1 shadow transition focus:outline-none focus:ring-2 focus:ring-amber-200"
                                            title="Edit">
                                            <img src="images/iconEdit.svg" class="w-5 h-5" alt="">
                                        </button>
                                        <button type="button" x-show="editIndex === i" @click="saveEdit(i)"
                                            class="flex items-center justify-center mx-auto bg-green-500 hover:bg-green-600 text-white rounded-md p-1 shadow transition focus:outline-none focus:ring-2 focus:ring-green-200"
                                            title="Simpan">
                                            <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2"
                                                viewBox="0 0 24 24">
                                                <path d="M5 13l4 4L19 7" stroke-linecap="round" stroke-linejoin="round" />
                                            </svg>
                                        </button>
                                    </td>
                                </tr>
                            </template>
                        </tbody>
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
                                    <span class="font-medium">{{ count($saldoAwal) }}</span>
                                    of
                                    <span class="font-medium">{{ count($saldoAwal) }}</span>
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

    <!-- Alpine.js CDN -->
    <script src="//unpkg.com/alpinejs" defer></script>
@endsection
