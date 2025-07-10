@extends('components.sidebar')

@section('content')
    <div class="min-h-screen font-admin" x-data="laporanAktivitasApp()" x-init="init()">
        <div class="w-full mx-auto">
            <div class="flex items-center mb-8 gap-4">
                <img src="images/iconAktifitas.svg" class="bg-blue-500 rounded-full p-2 shadow w-12 h-12" alt="">
                <div>
                    <h1 class="text-3xl font-extrabold text-slate-700 tracking-tight mb-2">Laporan Aktivitas</h1>
                    <p class="text-slate-500">Laporan aktivitas keuangan per periode</p>
                </div>
            </div>
            <!-- Filter -->
            <div class="bg-white rounded-xl shadow border border-slate-200 p-6 mb-8">
                <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                    <div>
                        <label class="block text-sm font-medium text-slate-600 mb-2">Periode</label>
                        <select x-model="form.periode_id"
                            class="w-full border border-slate-200 rounded-lg focus:border-blue-500 focus:ring-blue-500 text-sm py-2 px-3">
                            <option value="">Pilih Periode</option>
                            <template x-for="p in periodeList" :key="p.id">
                                <option :value="p.id"
                                    x-text="p.nama + ' (' + p.tanggal_mulai + ' s/d ' + p.tanggal_selesai + ')' "></option>
                            </template>
                        </select>
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-slate-600 mb-2">Level</label>
                        <select x-model="form.level"
                            class="w-full border border-slate-200 rounded-lg focus:border-blue-500 focus:ring-blue-500 text-sm py-2 px-3">
                            <option value="">Semua Level</option>
                            <option value="1">Level 1</option>
                            <option value="2">Level 2</option>
                            <option value="3">Level 3</option>
                        </select>
                    </div>
                    <div class="flex items-end gap-2">
                        <button type="button" @click="fetchLaporanAktivitas"
                            class="w-full text-white bg-blue-600 hover:bg-blue-700 font-medium py-2 px-4 rounded-lg transition relative">
                            <svg class="spinner hidden animate-spin h-4 w-4 text-white absolute left-4"
                                xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                                <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor"
                                    stroke-width="4"></circle>
                                <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8v4a4 4 0 00-4 4H4z"></path>
                            </svg>
                            <span class="btn-text">Tampilkan</span>
                        </button>
                        <button type="button" @click="downloadPDF"
                            class="w-full text-white bg-green-600 hover:bg-green-700 font-medium py-2 px-4 rounded-lg transition relative"
                            x-show="dataLoaded">
                            <svg class="spinner hidden animate-spin h-4 w-4 text-white absolute left-4"
                                xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                                <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor"
                                    stroke-width="4"></circle>
                                <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8v4a4 4 0 00-4 4H4z"></path>
                            </svg>
                            <span class="btn-text">Download PDF</span>
                        </button>
                    </div>
                </div>
            </div>
            <!-- Summary Cards -->
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">
                <div class="bg-white rounded-xl shadow border border-slate-200 p-6">
                    <h3 class="text-sm font-medium text-slate-600 mb-2">Total Pendapatan</h3>
                    <p class="text-2xl font-bold text-green-600" x-text="formatRupiah(aktivitasData.total_pendapatan)"></p>
                </div>
                <div class="bg-white rounded-xl shadow border border-slate-200 p-6">
                    <h3 class="text-sm font-medium text-slate-600 mb-2">Total Beban</h3>
                    <p class="text-2xl font-bold text-rose-600" x-text="formatRupiah(aktivitasData.total_beban)"></p>
                </div>
                <div class="bg-white rounded-xl shadow border border-slate-200 p-6">
                    <h3 class="text-sm font-medium text-slate-600 mb-2">Laba Bersih</h3>
                    <p class="text-2xl font-bold text-blue-600" x-text="formatRupiah(aktivitasData.laba_bersih)"></p>
                </div>
            </div>
            <!-- Table -->
            <div class="bg-white rounded-xl shadow border border-slate-200">
                <div class="border-b border-slate-200 p-4 flex items-center gap-2">
                    <svg class="w-5 h-5 text-blue-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M9 17v-2m3 2v-4m3 4v-6m2 10H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z">
                        </path>
                    </svg>
                    <h2 class="font-bold text-slate-600">Data Aktivitas</h2>
                </div>
                <div class="overflow-x-auto">
                    <table class="min-w-full divide-y divide-slate-200">
                        <thead>
                            <tr class="bg-slate-50">
                                <th class="px-6 py-3 text-left text-xs font-medium text-slate-500 uppercase tracking-wider">
                                    Nama Akun</th>
                                <th
                                    class="px-6 py-3 text-right text-xs font-medium text-slate-500 uppercase tracking-wider">
                                    Periode Pertama</th>
                                <th
                                    class="px-6 py-3 text-right text-xs font-medium text-slate-500 uppercase tracking-wider">
                                    Periode Kedua</th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-slate-200">
                            <!-- Pendapatan -->
                            <tr class="bg-slate-50">
                                <td colspan="3" class="px-6 py-3 text-left text-sm font-semibold text-slate-700">
                                    PENDAPATAN</td>
                            </tr>
                            <template x-if="dataLoaded && aktivitasData.pendapatan && aktivitasData.pendapatan.length > 0">
                                <template x-for="row in flattenAktivitas(aktivitasData.pendapatan)" :key="row.id">
                                    <tr>
                                        <td class="px-6 py-4 text-sm text-slate-600">
                                            <span :style="`padding-left: ${row.indent}px`" x-text="row.account_name"></span>
                                        </td>
                                        <td class="px-6 py-4 text-right text-sm font-medium text-green-600"
                                            x-text="formatRupiah(row.saldo_awal)"></td>
                                        <td class="px-6 py-4 text-right text-sm font-medium text-green-600"
                                            x-text="formatRupiah(row.saldo_akhir)"></td>
                                    </tr>
                                </template>
                            </template>
                            <tr class="bg-slate-50">
                                <td colspan="3" class="px-6 py-3 text-left text-sm font-semibold text-slate-700">BEBAN
                                </td>
                            </tr>
                            <template x-if="dataLoaded && aktivitasData.beban && aktivitasData.beban.length > 0">
                                <template x-for="row in flattenAktivitas(aktivitasData.beban)" :key="row.id">
                                    <tr>
                                        <td class="px-6 py-4 text-sm text-slate-600">
                                            <span :style="`padding-left: ${row.indent}px`"
                                                x-text="row.account_name"></span>
                                        </td>
                                        <td class="px-6 py-4 text-right text-sm font-medium text-rose-600"
                                            x-text="formatRupiah(row.saldo_awal)"></td>
                                        <td class="px-6 py-4 text-right text-sm font-medium text-rose-600"
                                            x-text="formatRupiah(row.saldo_akhir)"></td>
                                    </tr>
                                </template>
                            </template>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    <script src="//unpkg.com/alpinejs" defer></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.5.1/jspdf.umd.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf-autotable/3.8.2/jspdf.plugin.autotable.min.js"></script>
    <script>
        window.apiBaseUrl = "{{ env('API_BASE_URL', 'http://localhost/api') }}";
        const token = localStorage.getItem('token');

        function laporanAktivitasApp() {
            return {
                form: {
                    periode_id: '',
                    level: ''
                },
                periodeList: [],
                aktivitasData: {
                    pendapatan: [],
                    beban: [],
                    total_pendapatan: 0,
                    total_beban: 0,
                    laba_bersih: 0
                },
                dataLoaded: false,

                // Fungsi untuk menangani loading state
                handleLoading(btn, action) {
                    const spinner = btn.querySelector('.spinner');
                    const btnText = btn.querySelector('.btn-text');
                    const originalText = btnText.textContent;

                    spinner.classList.remove('hidden');
                    btnText.textContent = 'Loading...';
                    btn.disabled = true;

                    return Promise.resolve(action())
                        .finally(() => {
                            spinner.classList.add('hidden');
                            btnText.textContent = originalText;
                            btn.disabled = false;
                        });
                },

                init() {
                    this.fetchPeriodeList();
                },
                fetchPeriodeList() {
                    fetch(`${window.apiBaseUrl}/api/periode`, {
                            headers: {
                                Authorization: 'Bearer ' + token,
                                'Accept': 'application/json',
                            }
                        })
                        .then(res => res.json())
                        .then(data => {
                            if (Array.isArray(data)) {
                                this.periodeList = data;
                            } else if (Array.isArray(data.data)) {
                                this.periodeList = data.data;
                            } else {
                                this.periodeList = [];
                            }
                        })
                        .catch(() => {
                            this.periodeList = [];
                        });
                },
                fetchLaporanAktivitas() {
                    if (!this.form.periode_id || !this.form.level) return;

                    const btn = event.target.closest('button');
                    this.handleLoading(btn, async () => {
                        const response = await fetch(
                            `${window.apiBaseUrl}/api/laporan/aktivitas?periode_id=${this.form.periode_id}&level=${this.form.level}`, {
                                headers: {
                                    Authorization: 'Bearer ' + token,
                                    'Accept': 'application/json',
                                }
                            });
                        const data = await response.json();
                        this.aktivitasData = data;
                        this.dataLoaded = true;
                    });
                },
                flattenAktivitas(data, level = 1) {
                    let rows = [];
                    data.forEach(item => {
                        rows.push({
                            ...item,
                            indent: (item.level - 1) * 24 // 24px per level
                        });
                        if (item.children && item.children.length > 0) {
                            rows = rows.concat(this.flattenAktivitas(item.children, level + 1));
                        }
                    });
                    return rows;
                },
                formatRupiah(val) {
                    if (val === null || val === undefined) return '-';
                    return 'Rp ' + Number(val).toLocaleString('id-ID');
                },
                downloadPDF() {
                    if (!this.dataLoaded) {
                        alert('Tidak ada data untuk diunduh!');
                        return;
                    }

                    const btn = event.target.closest('button');
                    this.handleLoading(btn, () => {
                        const {
                            jsPDF
                        } = window.jspdf;
                        const doc = new jsPDF();
                        let y = 10;
                        doc.setFontSize(16);
                        doc.text('Laporan Aktivitas', 105, y, {
                            align: 'center'
                        });
                        y += 10;
                        doc.setFontSize(11);
                        // Cari data periode yang dipilih
                        const periode = this.periodeList.find(p => p.id == this.form.periode_id);
                        let periodeLabel = '-';
                        if (periode) {
                            // Tampilkan nama + range tanggal, atau tahun jika ada
                            periodeLabel = `${periode.nama}`;
                        }
                        doc.text(`Periode: ${periodeLabel} | Level: ${this.form.level}`, 14, y);
                        y += 7;
                        doc.text(`Total Pendapatan: ${this.formatRupiah(this.aktivitasData.total_pendapatan)}`, 14,
                            y);
                        y += 7;
                        doc.text(`Total Beban: ${this.formatRupiah(this.aktivitasData.total_beban)}`, 14, y);
                        y += 7;
                        doc.text(`Laba Bersih: ${this.formatRupiah(this.aktivitasData.laba_bersih)}`, 14, y);
                        y += 7;
                        // Table header
                        const headers = [
                            ['Nama Akun', 'Periode Pertama', 'Periode Kedua']
                        ];
                        const body = [];
                        // Tambahkan label PENDAPATAN
                        body.push([{
                            content: 'PENDAPATAN',
                            colSpan: 3,
                            styles: {
                                fontStyle: 'bold',
                                halign: 'left',
                                fillColor: [240, 240, 255]
                            }
                        }]);
                        // Pendapatan
                        if (this.aktivitasData.pendapatan && this.aktivitasData.pendapatan.length > 0) {
                            this.flattenAktivitas(this.aktivitasData.pendapatan).forEach(row => {
                                body.push([{
                                        content: ' '.repeat(row.indent / 6) + row.account_name,
                                        styles: {
                                            cellPadding: {
                                                left: row.indent
                                            }
                                        }
                                    },
                                    this.formatRupiah(row.saldo_awal),
                                    this.formatRupiah(row.saldo_akhir)
                                ]);
                            });
                        }
                        // Tambahkan label BEBAN
                        body.push([{
                            content: 'BEBAN',
                            colSpan: 3,
                            styles: {
                                fontStyle: 'bold',
                                halign: 'left',
                                fillColor: [255, 240, 240]
                            }
                        }]);
                        // Beban
                        if (this.aktivitasData.beban && this.aktivitasData.beban.length > 0) {
                            this.flattenAktivitas(this.aktivitasData.beban).forEach(row => {
                                body.push([{
                                        content: ' '.repeat(row.indent / 6) + row.account_name,
                                        styles: {
                                            cellPadding: {
                                                left: row.indent
                                            }
                                        }
                                    },
                                    this.formatRupiah(row.saldo_awal),
                                    this.formatRupiah(row.saldo_akhir)
                                ]);
                            });
                        }
                        doc.autoTable({
                            head: headers,
                            body: body,
                            startY: y,
                            theme: 'grid',
                            headStyles: {
                                fillColor: [59, 130, 246]
                            },
                            styles: {
                                fontSize: 10,
                                cellPadding: 3
                            },
                            didParseCell: function(data) {
                                // Untuk label PENDAPATAN/BEBAN, bold dan warna
                                if (data.row.raw && data.row.raw[0] && data.row.raw[0].colSpan === 3) {
                                    data.cell.styles.fontStyle = 'bold';
                                    data.cell.styles.fillColor = data.row.raw[0].content ===
                                        'PENDAPATAN' ? [240,
                                            240, 255
                                        ] : [255, 240, 240];
                                }
                            }
                        });
                        y = doc.lastAutoTable.finalY + 5;
                        doc.setFontSize(11);
                        doc.text('Laba Bersih', 14, y);
                        doc.text(this.formatRupiah(this.aktivitasData.laba_bersih), 80, y, {
                            align: 'right'
                        });
                        doc.save('laporan-aktivitas.pdf');
                    });
                }
            }
        }
    </script>
@endsection
