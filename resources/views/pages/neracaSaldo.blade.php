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
                        <label class="block text-sm font-medium text-slate-600 mb-3">Periode</label>
                        <select x-model="form.periode_id"
                            class="bg-slate-50 border border-slate-300 text-slate-900 text-sm rounded-lg focus:ring-indigo-500 focus:border-indigo-500 block w-full p-3"
                            required>
                            <option value="">Pilih Periode</option>
                            <template x-for="p in periodeList" :key="p.id">
                                <option :value="p.id"
                                    x-text="p.nama + ' (' + p.tanggal_mulai + ' s/d ' + p.tanggal_selesai + ')' "></option>
                            </template>
                        </select>
                    </div>
                    <!-- Level -->
                    <div>
                        <label class="block text-sm font-medium text-slate-600 mb-3">Level</label>
                        <select x-model="form.level"
                            class="bg-slate-50 border border-slate-300 text-slate-900 text-sm rounded-lg focus:ring-indigo-500 focus:border-indigo-500 block w-full p-3"
                            required>
                            <option value="">Semua Level</option>
                            <template x-for="level in levelList" :key="level">
                                <option :value="level" x-text="level"></option>
                            </template>
                        </select>
                    </div>
                </form>
                <div class="flex gap-2 mt-6">
                    <button type="button" @click="resetFormWithLoading($event)"
                        class="flex-1 text-slate-600 bg-slate-100 hover:bg-slate-200 focus:ring-4 focus:ring-slate-300 font-medium rounded-lg text-sm px-4 py-3 focus:outline-none transition-colors relative">
                        <svg class="spinner hidden animate-spin h-4 w-4 text-slate-600 absolute left-4"
                            xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                            <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor"
                                stroke-width="4"></circle>
                            <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8v4a4 4 0 00-4 4H4z"></path>
                        </svg>
                        <span class="btn-text">Reset</span>
                    </button>
                    <template x-if="!dataLoaded">
                        <button type="button" @click="fetchNeracaSaldoWithLoading($event)"
                            class="flex-1 text-white bg-indigo-600 hover:bg-indigo-700 focus:ring-4 focus:ring-indigo-300 font-medium rounded-lg text-sm px-4 py-3 focus:outline-none transition-colors relative">
                            <svg class="spinner hidden animate-spin h-5 w-5 text-white absolute left-4"
                                xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                                <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor"
                                    stroke-width="4"></circle>
                                <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8v4a4 4 0 00-4 4H4z"></path>
                            </svg>
                            <span class="btn-text">Tampil</span>
                        </button>
                    </template>
                    <template x-if="dataLoaded">
                        <button type="button" @click="downloadPDFWithLoading($event)"
                            class="flex-1 text-white bg-green-600 hover:bg-green-700 focus:ring-4 focus:ring-green-300 font-medium rounded-lg text-sm px-4 py-3 focus:outline-none transition-colors relative">
                            <svg class="spinner hidden animate-spin h-5 w-5 text-white absolute left-4"
                                xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                                <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor"
                                    stroke-width="4"></circle>
                                <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8v4a4 4 0 00-4 4H4z"></path>
                            </svg>
                            <span class="btn-text">Download PDF</span>
                        </button>
                    </template>
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
                                <th class="px-6 py-3 text-left text-xs font-medium text-slate-500 uppercase tracking-wider">
                                    Kode</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-slate-500 uppercase tracking-wider">
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
                                <template x-for="row in flattenNeracaSaldo(neracaSaldoData)" :key="row.id">
                                    <tr>
                                        <td class="px-6 py-4 text-sm text-slate-600" x-text="row.account_code"></td>
                                        <td class="px-6 py-4 text-sm text-slate-600">
                                            <span :style="`padding-left: ${row.indent}px`" x-text="row.account_name"></span>
                                        </td>
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
                    </table>
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
        window.API_TOKEN = localStorage.getItem('token');

        function neracaSaldoApp() {
            return {
                form: {
                    periode_id: '',
                    level: ''
                },
                periodeList: [],
                levelList: [1, 2, 3], // Sekarang hanya level 1-3
                neracaSaldoData: [],
                dataLoaded: false,
                totalDebet: 0,
                totalKredit: 0,
                totalSaldoAwal: 0,
                totalSaldoAkhir: 0,
                statusBalance: '-',
                statusBalanceDesc: '',
                init() {
                    // Ensure form is properly initialized
                    if (!this.form) {
                        this.form = {
                            periode_id: '',
                            level: ''
                        };
                    }
                    this.fetchPeriodeList();
                },
                fetchPeriodeList() {
                    const token = window.API_TOKEN || '';
                    const apiBaseUrl = window.API_BASE_URL;
                    fetch(`${apiBaseUrl}/api/periode`, {
                            headers: {
                                'Authorization': `Bearer ${token}`,
                                'Accept': 'application/json',
                            }
                        })
                        .then(res => res.json())
                        .then(data => {
                            this.periodeList = data.data || data;
                        });
                },
                async fetchNeracaSaldo() {
                    // Ensure form exists before accessing its properties
                    if (!this.form || !this.form.periode_id || !this.form.level) return;
                    const token = window.API_TOKEN || '';
                    const apiBaseUrl = window.API_BASE_URL;

                    try {
                        const response = await fetch(
                            `${apiBaseUrl}/api/laporan/neraca-saldo?periode_id=${this.form.periode_id}&level=${this.form.level}`, {
                                headers: {
                                    'Authorization': `Bearer ${token}`,
                                    'Accept': 'application/json',
                                }
                            });
                        const data = await response.json();
                        this.neracaSaldoData = data;
                        this.dataLoaded = true;
                        this.hitungSummary();
                    } catch (error) {
                        this.neracaSaldoData = [];
                        this.dataLoaded = false;
                        this.hitungSummary();
                    }
                },
                async resetForm() {
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

                    // Jika filter level 3, data sudah flat, cukup jumlahkan saja
                    if (this.form && this.form.level == 3 && this.neracaSaldoData && this.neracaSaldoData.length > 0) {
                        this.neracaSaldoData.forEach(row => {
                            debet += Number(row.total_debit);
                            kredit += Number(row.total_kredit);
                            saldoAwal += Number(row.saldo_awal);
                            saldoAkhir += Number(row.saldo_akhir);
                        });
                    } else {
                        // Rekursif untuk data bertingkat
                        function sumLevel3(arr) {
                            arr.forEach(row => {
                                if (!row.children || row.children.length === 0) {
                                    debet += Number(row.total_debit);
                                    kredit += Number(row.total_kredit);
                                    saldoAwal += Number(row.saldo_awal);
                                    saldoAkhir += Number(row.saldo_akhir);
                                } else if (row.children && row.children.length > 0) {
                                    sumLevel3(row.children);
                                }
                            });
                        }
                        if (this.neracaSaldoData && this.neracaSaldoData.length > 0) {
                            sumLevel3(this.neracaSaldoData);
                        }
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
                async downloadPDF() {
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
                    // Get period name
                    let periodName = '';
                    if (this.periodeList && this.periodeList.length > 0) {
                        const p = this.periodeList.find(p => p.id == this.form.periode_id);
                        if (p) {
                            periodName = `${p.nama} (${p.tanggal_mulai} s/d ${p.tanggal_selesai})`;
                        }
                    }
                    if (!periodName) periodName = `ID: ${this.form.periode_id}`;
                    doc.text(`Periode: ${periodName} | Level: ${this.form ? this.form.level : ''}`, 14, y);
                    y += 7;
                    // Table header
                    const headers = [
                        [
                            'Kode', 'Nama Akun', 'Saldo Awal', 'Debet', 'Kredit', 'Saldo Akhir'
                        ]
                    ];
                    // Table body - use flattened data to match the displayed table
                    const flattenedData = this.flattenNeracaSaldo(this.neracaSaldoData);
                    const body = flattenedData.map(row => [
                        row.account_code,
                        row.account_name,
                        this.formatRupiah(row.saldo_awal),
                        this.formatRupiah(row.total_debit),
                        this.formatRupiah(row.total_kredit),
                        this.formatRupiah(row.saldo_akhir)
                    ]);
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
                    doc.save('neraca-saldo.pdf');
                },
                flattenNeracaSaldo(data, level = 1) {
                    let rows = [];
                    data.forEach(item => {
                        rows.push({
                            ...item,
                            indent: (item.level - 1) * 24 // 24px per level
                        });
                        if (item.children && item.children.length > 0) {
                            rows = rows.concat(this.flattenNeracaSaldo(item.children, level + 1));
                        }
                    });
                    return rows;
                },
                async resetFormWithLoading(event) {
                    const btn = event.target.closest('button');
                    const spinner = btn.querySelector('.spinner');
                    const btnText = btn.querySelector('.btn-text');
                    const originalText = btnText.textContent;

                    spinner.classList.remove('hidden');
                    btnText.textContent = 'Loading...';
                    btn.disabled = true;

                    try {
                        await this.resetForm();
                    } finally {
                        spinner.classList.add('hidden');
                        btnText.textContent = originalText;
                        btn.disabled = false;
                    }
                },
                async fetchNeracaSaldoWithLoading(event) {
                    const btn = event.target.closest('button');
                    const spinner = btn.querySelector('.spinner');
                    const btnText = btn.querySelector('.btn-text');
                    const originalText = btnText.textContent;

                    spinner.classList.remove('hidden');
                    btnText.textContent = 'Loading...';
                    btn.disabled = true;

                    try {
                        await this.fetchNeracaSaldo();
                    } finally {
                        spinner.classList.add('hidden');
                        btnText.textContent = originalText;
                        btn.disabled = false;
                    }
                },
                async downloadPDFWithLoading(event) {
                    const btn = event.target.closest('button');
                    const spinner = btn.querySelector('.spinner');
                    const btnText = btn.querySelector('.btn-text');
                    const originalText = btnText.textContent;

                    spinner.classList.remove('hidden');
                    btnText.textContent = 'Loading...';
                    btn.disabled = true;

                    try {
                        await this.downloadPDF();
                    } finally {
                        spinner.classList.add('hidden');
                        btnText.textContent = originalText;
                        btn.disabled = false;
                    }
                }
            }
        }

        // Fungsi universal handleLoading
        function handleLoading(btn, action) {
            const spinner = btn.querySelector('.spinner');
            const btnText = btn.querySelector('.btn-text');
            const originalText = btnText ? btnText.textContent : null;
            spinner.classList.remove('hidden');
            if (btnText) btnText.textContent = 'Loading...';
            btn.disabled = true;
            return Promise.resolve(typeof action === 'function' ? action() : action)
                .finally(() => {
                    spinner.classList.add('hidden');
                    if (btnText) btnText.textContent = originalText;
                    btn.disabled = false;
                });
        }
    </script>
@endsection
