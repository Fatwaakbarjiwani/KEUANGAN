@extends('components.sidebar')

@section('content')
    <div class="min-h-screen font-admin">
        <div x-data="neracaSaldoApp()">
            <!-- Info Section -->
            <div class="mb-6 w-full flex flex-col md:flex-row md:items-start md:justify-between gap-4">
                <div class="flex items-center gap-3">
                    <img src="images/iconNeracaSaldo.svg" class="bg-blue-500 rounded-full p-2 shadow w-12 h-12" alt="">
                    <div>
                        <h1
                            class="text-2xl md:text-3xl font-extrabold text-slate-700 tracking-tight flex items-center gap-2">
                            Neraca Saldo
                            <span
                                class="ml-2 px-3 py-1 bg-sky-100 text-sky-700 rounded-full text-xs font-semibold shadow-sm">
                                Admin Panel
                            </span>
                        </h1>
                        <div class="text-slate-500 text-sm mt-1 flex items-center gap-2">
                            Laporan neraca saldo menampilkan saldo setiap akun pada periode tertentu
                        </div>
                    </div>
                </div>
            </div>

            <!-- Filter Section -->
            <div class="bg-white rounded-xl shadow border border-slate-200 p-6 mb-6">
                <form @submit.prevent="fetchNeracaSaldo" class="grid grid-cols-1 md:grid-cols-4 gap-6">
                    <!-- Periode ID -->
                    <div>
                        <label class="block text-sm font-medium text-slate-600 mb-3">Periode ID</label>
                        <input type="number" min="1" x-model="form.periode_id"
                            class="bg-slate-50 border border-slate-300 text-slate-900 text-sm rounded-lg focus:ring-indigo-500 focus:border-indigo-500 block w-full p-3"
                            placeholder="Masukkan ID Periode" required>
                    </div>
                    <!-- Level -->
                    <div>
                        <label class="block text-sm font-medium text-slate-600 mb-3">Level</label>
                        <input type="number" min="1" x-model="form.level"
                            class="bg-slate-50 border border-slate-300 text-slate-900 text-sm rounded-lg focus:ring-indigo-500 focus:border-indigo-500 block w-full p-3"
                            placeholder="Level" required>
                    </div>
                </form>
                <div class="flex gap-2 mt-6">
                    <button type="button" @click="resetForm"
                        class="flex-1 text-slate-600 bg-slate-100 hover:bg-slate-200 focus:ring-4 focus:ring-slate-300 font-medium rounded-lg text-sm px-4 py-3 focus:outline-none transition-colors">
                        <svg class="w-4 h-4 inline mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15">
                            </path>
                        </svg>
                        Reset
                    </button>
                    <template x-if="!dataLoaded">
                        <button type="button" @click="fetchNeracaSaldo"
                            class="flex-1 text-white bg-indigo-600 hover:bg-indigo-700 focus:ring-4 focus:ring-indigo-300 font-medium rounded-lg text-sm px-4 py-3 focus:outline-none transition-colors">
                            <svg class="w-5 h-5 inline mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z">
                                </path>
                            </svg>
                            Tampil
                        </button>
                    </template>
                    <template x-if="dataLoaded">
                        <button type="button" @click="downloadPDF"
                            class="flex-1 text-white bg-green-600 hover:bg-green-700 focus:ring-4 focus:ring-green-300 font-medium rounded-lg text-sm px-4 py-3 focus:outline-none transition-colors">
                            <svg class="w-5 h-5 inline mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z">
                                </path>
                            </svg>
                            Download PDF
                        </button>
                    </template>
                </div>
            </div>

            <!-- Summary Cards Dinamis -->
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-6">
                <div class="bg-white rounded-xl shadow border border-slate-200 p-6">
                    <div class="flex items-center justify-between mb-4">
                        <h3 class="text-sm font-medium text-slate-600">Total Debet</h3>
                        <div class="bg-green-100 rounded-full p-2">
                            <svg class="w-5 h-5 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4">
                                </path>
                            </svg>
                        </div>
                    </div>
                    <p class="text-2xl font-bold text-slate-800" x-text="formatRupiah(totalDebet)"></p>
                    <p class="text-sm text-green-600 mt-1"></p>
                </div>
                <div class="bg-white rounded-xl shadow border border-slate-200 p-6">
                    <div class="flex items-center justify-between mb-4">
                        <h3 class="text-sm font-medium text-slate-600">Total Kredit</h3>
                        <div class="bg-rose-100 rounded-full p-2">
                            <svg class="w-5 h-5 text-rose-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 12H4"></path>
                            </svg>
                        </div>
                    </div>
                    <p class="text-2xl font-bold text-slate-800" x-text="formatRupiah(totalKredit)"></p>
                    <p class="text-sm text-rose-600 mt-1"></p>
                </div>
                <div class="bg-white rounded-xl shadow border border-slate-200 p-6">
                    <div class="flex items-center justify-between mb-4">
                        <h3 class="text-sm font-medium text-slate-600">Status</h3>
                        <div class="bg-blue-100 rounded-full p-2">
                            <svg class="w-5 h-5 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                            </svg>
                        </div>
                    </div>
                    <p class="text-2xl font-bold text-slate-800" x-text="statusBalance"></p>
                    <p class="text-sm text-blue-600 mt-1" x-text="statusBalanceDesc"></p>
                </div>
            </div>

            <!-- Neraca Saldo Table Dinamis -->
            <div class="bg-white rounded-xl shadow border border-slate-200 mt-6">
                <div class="border-b border-slate-200 p-4 flex justify-between items-center">
                    <h2 class="font-bold text-slate-600 flex items-center gap-2">
                        <svg class="w-5 h-5 text-blue-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M9 17v-2m3 2v-4m3 4v-6m2 10H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z">
                            </path>
                        </svg>
                        Daftar Akun
                    </h2>
                </div>
                <div class="overflow-x-auto">
                    <table class="min-w-full divide-y divide-slate-200">
                        <thead>
                            <tr class="bg-slate-50">
                                <th
                                    class="px-6 py-3 text-left text-xs font-medium text-slate-500 uppercase tracking-wider">
                                    Kode</th>
                                <th
                                    class="px-6 py-3 text-left text-xs font-medium text-slate-500 uppercase tracking-wider">
                                    Nama Akun</th>
                                <th
                                    class="px-6 py-3 text-right text-xs font-medium text-slate-500 uppercase tracking-wider">
                                    Saldo Awal</th>
                                <th
                                    class="px-6 py-3 text-right text-xs font-medium text-slate-500 uppercase tracking-wider">
                                    Debet</th>
                                <th
                                    class="px-6 py-3 text-right text-xs font-medium text-slate-500 uppercase tracking-wider">
                                    Kredit</th>
                                <th
                                    class="px-6 py-3 text-right text-xs font-medium text-slate-500 uppercase tracking-wider">
                                    Saldo Akhir</th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-slate-200">
                            <template x-if="dataLoaded && neracaSaldoData && neracaSaldoData.length > 0">
                                <template x-for="row in neracaSaldoData" :key="row.account_code">
                                    <tr>
                                        <td class="px-6 py-4 text-sm text-slate-600" x-text="row.account_code"></td>
                                        <td class="px-6 py-4 text-sm text-slate-600" x-text="row.account_name"></td>
                                        <td class="px-6 py-4 text-right text-sm text-slate-600"
                                            x-text="formatRupiah(row.saldo_awal)"></td>
                                        <td class="px-6 py-4 text-right text-sm text-green-600"
                                            x-text="formatRupiah(row.total_debit)"></td>
                                        <td class="px-6 py-4 text-right text-sm text-rose-600"
                                            x-text="formatRupiah(row.total_kredit)"></td>
                                        <td class="px-6 py-4 text-right text-sm text-blue-600"
                                            x-text="formatRupiah(row.saldo_akhir)"></td>
                                    </tr>
                                </template>
                            </template>
                            <template x-if="!neracaSaldoData || neracaSaldoData.length === 0">
                                <tr>
                                    <td colspan="6" class="text-center text-slate-400 py-8">Belum ada data neraca saldo
                                    </td>
                                </tr>
                            </template>
                        </tbody>
                        <tfoot x-show="dataLoaded && neracaSaldoData && neracaSaldoData.length > 0">
                            <tr class="bg-slate-100 font-bold">
                                <td colspan="2" class="px-6 py-4 text-sm text-slate-800">TOTAL</td>
                                <td class="px-6 py-4 text-right text-sm text-slate-800"
                                    x-text="formatRupiah(totalSaldoAwal)"></td>
                                <td class="px-6 py-4 text-right text-sm text-slate-800" x-text="formatRupiah(totalDebet)">
                                </td>
                                <td class="px-6 py-4 text-right text-sm text-slate-800"
                                    x-text="formatRupiah(totalKredit)"></td>
                                <td class="px-6 py-4 text-right text-sm text-slate-800"
                                    x-text="formatRupiah(totalSaldoAkhir)"></td>
                            </tr>
                        </tfoot>
                    </table>
                </div>
            </div>
        </div>
    </div>
    <script src="//unpkg.com/alpinejs" defer></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.5.1/jspdf.umd.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf-autotable/3.8.2/jspdf.plugin.autotable.min.js"></script>
    <script>
        window.API_BASE_URL = "{{ env('API_BASE_URL', 'http://localhost/api') }}";
        window.API_TOKEN = "{{ session('token') }}";

        function neracaSaldoApp() {
            return {
                form: {
                    periode_id: '',
                    level: ''
                },
                neracaSaldoData: [],
                dataLoaded: false,
                totalDebet: 0,
                totalKredit: 0,
                totalSaldoAwal: 0,
                totalSaldoAkhir: 0,
                statusBalance: '-',
                statusBalanceDesc: '',
                fetchNeracaSaldo() {
                    if (!this.form.periode_id || !this.form.level) return;
                    const token = window.API_TOKEN || '';
                    const apiBaseUrl = window.API_BASE_URL;

                    fetch(`${API_BASE_URL}/api/laporan/neraca-saldo?periode_id=${this.form.periode_id}&level=${this.form.level}`, {
                            headers: {
                                'Authorization': `Bearer ${token}`,
                                'Accept': 'application/json',
                            }
                        })
                        .then(res => res.json())
                        .then(data => {
                            this.neracaSaldoData = data;
                            this.dataLoaded = true;
                            this.hitungSummary();
                        })
                        .catch(() => {
                            this.neracaSaldoData = [];
                            this.dataLoaded = false;
                            this.hitungSummary();
                        });
                },
                resetForm() {
                    this.form = {
                        periode_id: '',
                        level: ''
                    };
                    this.neracaSaldoData = [];
                    this.dataLoaded = false;
                    this.hitungSummary();
                },
                hitungSummary() {
                    let debet = 0,
                        kredit = 0,
                        saldoAwal = 0,
                        saldoAkhir = 0;
                    if (this.neracaSaldoData && this.neracaSaldoData.length > 0) {
                        this.neracaSaldoData.forEach(row => {
                            debet += Number(row.total_debit);
                            kredit += Number(row.total_kredit);
                            saldoAwal += Number(row.saldo_awal);
                            saldoAkhir += Number(row.saldo_akhir);
                        });
                    }
                    this.totalDebet = debet;
                    this.totalKredit = kredit;
                    this.totalSaldoAwal = saldoAwal;
                    this.totalSaldoAkhir = saldoAkhir;
                    if (debet === kredit) {
                        this.statusBalance = 'Balance';
                        this.statusBalanceDesc = 'Debet = Kredit';
                    } else {
                        this.statusBalance = 'Not Balance';
                        this.statusBalanceDesc = 'Debet ≠ Kredit';
                    }
                },
                formatRupiah(val) {
                    if (val === null || val === undefined) return '-';
                    return 'Rp ' + Number(val).toLocaleString('id-ID');
                },
                downloadPDF() {
                    if (!this.neracaSaldoData || this.neracaSaldoData.length === 0) {
                        alert('Tidak ada data untuk diunduh!');
                        return;
                    }
                    const {
                        jsPDF
                    } = window.jspdf;
                    const doc = new jsPDF();
                    let y = 10;
                    doc.setFontSize(16);
                    doc.text('Laporan Neraca Saldo', 105, y, {
                        align: 'center'
                    });
                    y += 10;
                    doc.setFontSize(11);
                    doc.text(`Periode ID: ${this.form.periode_id} | Level: ${this.form.level}`, 14, y);
                    y += 7;
                    doc.text(`Total Debet: ${this.formatRupiah(this.totalDebet)}`, 14, y);
                    y += 7;
                    doc.text(`Total Kredit: ${this.formatRupiah(this.totalKredit)}`, 14, y);
                    y += 7;
                    doc.text(`Status: ${this.statusBalance}`, 14, y);
                    y += 7;

                    // Table header
                    const headers = [
                        [
                            'Kode', 'Nama Akun', 'Saldo Awal', 'Debet', 'Kredit', 'Saldo Akhir'
                        ]
                    ];
                    // Table body
                    const body = this.neracaSaldoData.map(row => [
                        row.account_code,
                        row.account_name,
                        this.formatRupiah(row.saldo_awal),
                        this.formatRupiah(row.total_debit),
                        this.formatRupiah(row.total_kredit),
                        this.formatRupiah(row.saldo_akhir)
                    ]);

                    // Use autoTable for better formatting
                    doc.autoTable({
                        head: headers,
                        body: body,
                        startY: y,
                        theme: 'grid',
                        headStyles: {
                            fillColor: [59, 130, 246]
                        },
                        styles: {
                            fontSize: 10
                        },
                    });
                    y = doc.lastAutoTable.finalY + 5;

                    // Footer total
                    doc.setFontSize(11);
                    doc.text('TOTAL', 14, y);
                    doc.text(this.formatRupiah(this.totalSaldoAwal), 80, y, {
                        align: 'right'
                    });
                    doc.text(this.formatRupiah(this.totalDebet), 120, y, {
                        align: 'right'
                    });
                    doc.text(this.formatRupiah(this.totalKredit), 150, y, {
                        align: 'right'
                    });
                    doc.text(this.formatRupiah(this.totalSaldoAkhir), 200, y, {
                        align: 'right'
                    });

                    doc.save('neraca-saldo.pdf');
                }
            }
        }
    </script>
@endsection
