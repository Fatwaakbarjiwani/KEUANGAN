@extends('components.sidebar')

@section('content')
    <div class="min-h-screen font-admin">
        <div>
            <!-- Info Section -->
            <div class="mb-6 w-full flex flex-col md:flex-row md:items-start md:justify-between gap-4">
                <div class="flex items-center gap-3">
                    <img src="images/iconBukuBesar.svg" class="bg-blue-500 rounded-full p-2 shadow w-12 h-12" alt="">
                    <div>
                        <h1
                            class="text-2xl md:text-3xl font-extrabold text-slate-700 tracking-tight flex items-center gap-2">
                            Buku Besar
                            <span
                                class="ml-2 px-3 py-1 bg-sky-100 text-sky-700 rounded-full text-xs font-semibold shadow-sm">
                                Laporan Keuangan
                            </span>
                        </h1>
                        <div class="text-slate-500 text-sm mt-1 flex items-center gap-2">
                            Menampilkan dan mengunduh laporan buku besar untuk setiap akun
                        </div>
                    </div>
                </div>
            </div>

            <div x-data="bukuBesarApp()">
                <!-- Card Saldo Awal, Saldo Akhir, Total Transaksi di atas form download -->
                <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-6">
                    <!-- Saldo Awal -->
                    <div class="bg-white rounded-xl shadow border border-blue-200 p-6 flex items-center gap-3">
                        <div class="bg-blue-100 rounded-lg p-2">
                            <svg class="w-6 h-6 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <circle cx="12" cy="12" r="10" stroke="currentColor" stroke-width="2"
                                    fill="none" />
                                <path d="M12 8c-2.21 0-4 1.79-4 4s1.79 4 4 4 4-1.79 4-4-1.79-4-4-4z" stroke="currentColor"
                                    stroke-width="2" fill="none" />
                            </svg>
                        </div>
                        <div>
                            <h3 class="text-sm font-semibold text-slate-600">Saldo Awal</h3>
                            <p class="text-slate-800 font-bold"
                                x-text="dataLoaded && bukuBesarData ? formatRupiah(bukuBesarData.saldo_awal) : '-' "></p>
                        </div>
                    </div>
                    <!-- Saldo Akhir -->
                    <div class="bg-white rounded-xl shadow border border-green-200 p-6 flex items-center gap-3">
                        <div class="bg-green-100 rounded-lg p-2">
                            <svg class="w-6 h-6 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <circle cx="12" cy="12" r="10" stroke="currentColor" stroke-width="2"
                                    fill="none" />
                                <path d="M12 8c-2.21 0-4 1.79-4 4s1.79 4 4 4 4-1.79 4-4-1.79-4-4-4z" stroke="currentColor"
                                    stroke-width="2" fill="none" />
                            </svg>
                        </div>
                        <div>
                            <h3 class="text-sm font-semibold text-slate-600">Saldo Akhir</h3>
                            <p class="text-slate-800 font-bold"
                                x-text="dataLoaded && bukuBesarData ? formatRupiah(bukuBesarData.saldo_akhir) : '-' "></p>
                        </div>
                    </div>
                    <!-- Total Transaksi -->
                    <div class="bg-white rounded-xl shadow border border-purple-200 p-6 flex items-center gap-3">
                        <div class="bg-purple-100 rounded-lg p-2">
                            <svg class="w-6 h-6 text-purple-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <circle cx="12" cy="12" r="10" stroke="currentColor" stroke-width="2"
                                    fill="none" />
                                <path d="M12 8c-2.21 0-4 1.79-4 4s1.79 4 4 4 4-1.79 4-4-1.79-4-4-4z" stroke="currentColor"
                                    stroke-width="2" fill="none" />
                            </svg>
                        </div>
                        <div>
                            <h3 class="text-sm font-semibold text-slate-600">Total Transaksi</h3>
                            <p class="text-slate-800 font-bold"
                                x-text="dataLoaded && bukuBesarData && bukuBesarData.jurnals ? bukuBesarData.jurnals.length : '-' ">
                            </p>
                        </div>
                    </div>
                </div>

                <!-- Filter Section -->
                <div class="bg-white rounded-xl shadow border border-slate-200 p-6 mb-6">
                    <form @submit.prevent="fetchBukuBesar" class="grid grid-cols-1 md:grid-cols-4 gap-6">
                        <!-- Akun ID -->
                        <div>
                            <label class="block text-sm font-medium text-slate-600 mb-3">Akun</label>
                            <select x-model="form.akun_id" id="filterAkunId"
                                class="bg-slate-50 border border-slate-300 text-slate-900 text-sm rounded-lg focus:ring-indigo-500 focus:border-indigo-500 block w-full p-3"
                                required>
                                <option value="">Pilih Akun</option>
                                <template x-for="a in coaList" :key="a.id">
                                    <option :value="a.id" x-text="a.account_code + ' - ' + a.account_name">
                                    </option>
                                </template>
                            </select>
                        </div>
                        <!-- Periode ID -->
                        <div>
                            <label class="block text-sm font-medium text-slate-600 mb-3">Periode</label>
                            <select x-model="form.periode_id" id="filterPeriodeId"
                                class="bg-slate-50 border border-slate-300 text-slate-900 text-sm rounded-lg focus:ring-indigo-500 focus:border-indigo-500 block w-full p-3"
                                required>
                                <option value="">Pilih Periode</option>
                                <template x-for="p in periodeList" :key="p.id">
                                    <option :value="p.id"
                                        x-text="p.nama + ' (' + p.tanggal_mulai + ' s/d ' + p.tanggal_selesai + ')' ">
                                    </option>
                                </template>
                            </select>
                        </div>
                        <!-- Start Date -->
                        <div>
                            <label class="block text-sm font-medium text-slate-600 mb-3">Tanggal Mulai</label>
                            <input type="date" x-model="form.start_date"
                                class="bg-slate-50 border border-slate-300 text-slate-900 text-sm rounded-lg focus:ring-indigo-500 focus:border-indigo-500 block w-full p-3"
                                required>
                        </div>
                        <!-- End Date -->
                        <div>
                            <label class="block text-sm font-medium text-slate-600 mb-3">Tanggal Selesai</label>
                            <input type="date" x-model="form.end_date"
                                class="bg-slate-50 border border-slate-300 text-slate-900 text-sm rounded-lg focus:ring-indigo-500 focus:border-indigo-500 block w-full p-3"
                                required>
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
                            <button type="button" @click="fetchBukuBesar"
                                class="flex-1 text-white bg-indigo-600 hover:bg-indigo-700 focus:ring-4 focus:ring-indigo-300 font-medium rounded-lg text-sm px-4 py-3 focus:outline-none transition-colors">
                                <svg class="w-5 h-5 inline mr-2" fill="none" stroke="currentColor"
                                    viewBox="0 0 24 24">
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
                                <svg class="w-5 h-5 inline mr-2" fill="none" stroke="currentColor"
                                    viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z">
                                    </path>
                                </svg>
                                Download PDF
                            </button>
                        </template>
                    </div>

                    <!-- Data Table Buku Besar -->
                    <div class="mt-8" x-show="dataLoaded">
                        <template x-if="bukuBesarData">
                            <div>
                                <div class="overflow-x-auto">
                                    <table class="min-w-full divide-y divide-slate-200 border" id="buku-besar-table">
                                        <thead>
                                            <tr class="bg-slate-50">
                                                <th class="px-4 py-2 text-xs font-medium text-slate-500 uppercase">Tanggal
                                                </th>
                                                <th class="px-4 py-2 text-xs font-medium text-slate-500 uppercase">No.
                                                    Jurnal</th>
                                                <th class="px-4 py-2 text-xs font-medium text-slate-500 uppercase">
                                                    Keterangan</th>
                                                <th
                                                    class="px-4 py-2 text-xs font-medium text-slate-500 uppercase text-right">
                                                    Debet</th>
                                                <th
                                                    class="px-4 py-2 text-xs font-medium text-slate-500 uppercase text-right">
                                                    Kredit</th>
                                                <th
                                                    class="px-4 py-2 text-xs font-medium text-slate-500 uppercase text-right">
                                                    Saldo Berjalan</th>
                                            </tr>
                                        </thead>
                                        <tbody class="bg-white divide-y divide-slate-200">
                                            <template
                                                x-if="bukuBesarData && bukuBesarData.jurnals && bukuBesarData.jurnals.length > 0">
                                                <template x-for="j in bukuBesarData.jurnals" :key="j.id">
                                                    <tr>
                                                        <td class="px-4 py-2 text-sm text-slate-600"
                                                            x-text="formatTanggal(j.jurnal.tanggal)"></td>
                                                        <td class="px-4 py-2 text-sm text-slate-500"
                                                            x-text="j.jurnal.nomor_jurnal"></td>
                                                        <td class="px-4 py-2 text-sm text-slate-600"
                                                            x-text="j.jurnal.keterangan || '-' "></td>
                                                        <td class="px-4 py-2 text-sm text-green-700 text-right"
                                                            x-text="formatRupiah(j.debit)"></td>
                                                        <td class="px-4 py-2 text-sm text-rose-700 text-right"
                                                            x-text="formatRupiah(j.kredit)"></td>
                                                        <td class="px-4 py-2 text-sm text-blue-700 text-right"
                                                            x-text="formatRupiah(j.saldo_berjalan)"></td>
                                                    </tr>
                                                </template>
                                            </template>
                                            <template
                                                x-if="!bukuBesarData || !bukuBesarData.jurnals || bukuBesarData.jurnals.length === 0">
                                                <tr>
                                                    <td colspan="6" class="text-center text-slate-400 py-8">Belum ada
                                                        data buku besar</td>
                                                </tr>
                                            </template>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </template>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Alpine.js CDN -->
    <script>
        window.apiBaseUrl = "{{ env('API_BASE_URL', 'http://localhost/api') }}";
        const token = localStorage.getItem('token');
    </script>
    <script src="//unpkg.com/alpinejs" defer></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.5.1/jspdf.umd.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf-autotable/3.8.2/jspdf.plugin.autotable.min.js"></script>
    <script>
        function bukuBesarApp() {
            return {
                form: {
                    akun_id: '',
                    start_date: '',
                    end_date: '',
                    periode_id: ''
                },
                coaList: [],
                periodeList: [],
                bukuBesarData: null,
                dataLoaded: false,
                loading: false,
                fetchBukuBesar() {
                    if (!this.form.akun_id || !this.form.start_date || !this.form.end_date || !this.form.periode_id) return;
                    this.loading = true;
                    fetch(
                            `${apiBaseUrl}/api/laporan/buku-besar?akun_id=${this.form.akun_id}&start_date=${this.form.start_date}&end_date=${this.form.end_date}&periode_id=${this.form.periode_id}`, {
                                headers: {
                                    'Authorization': `Bearer ${token}`,
                                    'Accept': 'application/json',
                                }
                            }
                        )
                        .then(res => res.json())
                        .then(data => {
                            this.bukuBesarData = data;
                            this.dataLoaded = true;
                        })
                        .catch(() => {
                            this.bukuBesarData = null;
                            this.dataLoaded = false;
                        })
                        .finally(() => {
                            this.loading = false;
                        });
                },
                resetForm() {
                    this.form = {
                        akun_id: '',
                        start_date: '',
                        end_date: '',
                        periode_id: ''
                    };
                    this.bukuBesarData = null;
                    this.dataLoaded = false;
                },
                formatRupiah(val) {
                    if (!val) return '-';
                    return 'Rp ' + Number(val).toLocaleString('id-ID');
                },
                formatTanggal(val) {
                    if (!val) return '-';
                    const d = new Date(val);
                    return d.toLocaleDateString('id-ID');
                },
                downloadPDF() {
                    if (!this.bukuBesarData) return;
                    const {
                        jsPDF
                    } = window.jspdf;
                    const doc = new jsPDF();
                    let y = 10;
                    doc.setFontSize(16);
                    doc.text('Laporan Buku Besar', 105, y, {
                        align: 'center'
                    });
                    y += 10;
                    doc.setFontSize(11);
                    doc.text(`Akun ID: ${this.form.akun_id} | Periode ID: ${this.form.periode_id}`, 14, y);
                    y += 7;
                    doc.text(`Periode: ${this.form.start_date} s/d ${this.form.end_date}`, 14, y);
                    y += 7;
                    doc.text(`Saldo Awal: Rp ${Number(this.bukuBesarData.saldo_awal).toLocaleString('id-ID')}`, 14, y);
                    y += 7;
                    // Table header
                    const headers = [
                        ['Tanggal', 'No. Bukti', 'Keterangan', 'Debet', 'Kredit', 'Saldo']
                    ];
                    // Table body
                    const body = (this.bukuBesarData.jurnals || []).map(j => [
                        this.formatTanggal(j.jurnal.tanggal),
                        j.jurnal.nomor_jurnal,
                        j.jurnal.keterangan || '-',
                        'Rp ' + Number(j.debit).toLocaleString('id-ID'),
                        'Rp ' + Number(j.kredit).toLocaleString('id-ID'),
                        'Rp ' + Number(j.saldo_berjalan).toLocaleString('id-ID')
                    ]);
                    if (body.length > 0) {
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
                    } else {
                        doc.text('Belum ada data buku besar', 14, y);
                        y += 7;
                    }
                    doc.setFontSize(11);
                    doc.text(`Saldo Akhir: Rp ${Number(this.bukuBesarData.saldo_akhir).toLocaleString('id-ID')}`, 14, y);
                    doc.save('buku-besar.pdf');
                },
                fetchCoaList() {
                    fetch(`${window.apiBaseUrl}/api/coa`, {
                            headers: {
                                Authorization: 'Bearer ' + localStorage.getItem('token')
                            }
                        })
                        .then(res => res.json())
                        .then(data => {
                            this.coaList = Array.isArray(data) ? data : [];
                        });
                },
                fetchPeriodeList() {
                    fetch(`${window.apiBaseUrl}/api/periode`, {
                            headers: {
                                Authorization: 'Bearer ' + localStorage.getItem('token')
                            }
                        })
                        .then(res => res.json())
                        .then(data => {
                            this.periodeList = data.data || data;
                        });
                },
                init() {
                    this.fetchCoaList();
                    this.fetchPeriodeList();
                }
            }
        }
    </script>
@endsection
