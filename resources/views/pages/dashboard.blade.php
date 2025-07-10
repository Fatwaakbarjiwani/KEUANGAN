@extends('components.sidebar')

@section('content')
    <div class="min-h-screen bg-gray-50/30 font-admin">
        <div x-data="dashboardApp()">
            <!-- Header -->
            <div>
                <div class="mb-8">
                    <div class="flex items-center gap-3">
                        <div class="bg-blue-500 rounded-full p-3 shadow-lg">
                            <img src="images/iconKeuangan.svg" class="w-8 h-8" alt="">
                        </div>
                        <div>
                            <h1 class="text-3xl font-extrabold text-slate-700 tracking-tight">Dashboard</h1>
                            <p class="text-slate-500 mt-1">Selamat datang di Sistem Manajemen Keuangan</p>
                        </div>
                        <span
                            class="ml-auto px-3 py-1 bg-sky-100 text-sky-700 rounded-full text-xs font-semibold shadow-sm">
                            Admin Panel
                        </span>
                    </div>
                </div>

                <!-- Info Cards -->
                <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">
                    <div class="bg-white rounded-xl shadow border border-slate-200 p-6">
                        <div class="flex items-center justify-between">
                            <div>
                                <p class="text-sm font-medium text-slate-600">Periode Aktif</p>
                                <template x-if="activePeriode">
                                    <div>
                                        <p class="text-2xl font-bold text-slate-700 mt-1" x-text="activePeriode.nama"></p>
                                        <p class="text-xs text-green-600 mt-1"
                                            x-text="activePeriode.status === 'aktif' ? '✓ Periode terbuka' : '✗ Periode tertutup'">
                                        </p>
                                    </div>
                                </template>
                                <template x-if="!activePeriode">
                                    <div>
                                        <p class="text-2xl font-bold text-slate-700 mt-1">-</p>
                                        <p class="text-xs text-red-600 mt-1">Tidak ada periode aktif</p>
                                    </div>
                                </template>
                            </div>
                            <div class="bg-blue-100 rounded-full p-3">
                                <img src="images/iconPeriode.svg" class="w-6 h-6" alt="">
                            </div>
                        </div>
                    </div>

                    <div class="bg-white rounded-xl shadow border border-slate-200 p-6">
                        <div class="flex items-center justify-between">
                            <div>
                                <p class="text-sm font-medium text-slate-600">Total Akun</p>
                                <p class="text-2xl font-bold text-slate-700 mt-1" x-text="totalAccounts"></p>
                                <p class="text-xs text-blue-600 mt-1">Chart of Accounts</p>
                            </div>
                            <div class="bg-green-100 rounded-full p-3">
                                <img src="images/iconBank.svg" class="w-6 h-6" alt="">
                            </div>
                        </div>
                    </div>

                    <div class="bg-white rounded-xl shadow border border-slate-200 p-6">
                        <div class="flex items-center justify-between">
                            <div>
                                <p class="text-sm font-medium text-slate-600">Total Transaksi</p>
                                <p class="text-2xl font-bold text-slate-700 mt-1" x-text="totalTransactions"></p>
                                <p class="text-xs text-purple-600 mt-1">Jurnal Umum</p>
                            </div>
                            <div class="bg-purple-100 rounded-full p-3">
                                <img src="images/iconJurnal.svg" class="w-6 h-6" alt="">
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Financial Summary -->
                <div class="grid grid-cols-1 lg:grid-cols-2 gap-6 mb-8">
                    <!-- Income vs Expense Chart -->
                    <div class="bg-white rounded-xl shadow border border-slate-200 p-6">
                        <div class="flex items-center justify-between mb-6">
                            <h3 class="text-lg font-semibold text-slate-700">Pemasukan vs Pengeluaran</h3>
                            <span class="text-xs text-slate-400">Periode Aktif</span>
                        </div>
                        <div class="space-y-4">
                            <div class="flex items-center justify-between">
                                <div class="flex items-center gap-3">
                                    <div class="w-3 h-3 bg-green-500 rounded-full"></div>
                                    <span class="text-sm text-slate-600">Pemasukan</span>
                                </div>
                                <div class="text-right">
                                    <p class="text-lg font-bold text-green-600" x-text="formatRupiah(totalPemasukan)"></p>
                                    <p class="text-xs text-green-500">Pendapatan</p>
                                </div>
                            </div>
                            <div class="flex items-center justify-between">
                                <div class="flex items-center gap-3">
                                    <div class="w-3 h-3 bg-red-500 rounded-full"></div>
                                    <span class="text-sm text-slate-600">Pengeluaran</span>
                                </div>
                                <div class="text-right">
                                    <p class="text-lg font-bold text-red-600" x-text="formatRupiah(totalPengeluaran)"></p>
                                    <p class="text-xs text-red-500">Beban</p>
                                </div>
                            </div>
                            <div class="border-t pt-4">
                                <div class="flex items-center justify-between">
                                    <span class="text-sm font-medium text-slate-700">Saldo Bersih</span>
                                    <p class="text-xl font-bold text-blue-600"
                                        x-text="formatRupiah(totalPemasukan - totalPengeluaran)"></p>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Account Balance Overview -->
                    <div class="bg-white rounded-xl shadow border border-slate-200 p-6">
                        <div class="flex items-center justify-between mb-6">
                            <h3 class="text-lg font-semibold text-slate-700">Saldo Akun Utama</h3>
                            <span class="text-xs text-slate-400">Update terakhir: <span x-text="lastUpdate"></span></span>
                        </div>
                        <div class="space-y-4">
                            <template x-for="account in mainAccounts" :key="account.id">
                                <div class="flex items-center justify-between p-3 bg-green-50 rounded-lg">
                                    <div class="flex items-center gap-3">
                                        <div class="bg-green-500 rounded-full p-2">
                                            <img src="images/iconSaldo.svg" class="w-4 h-4" alt="">
                                        </div>
                                        <span class="text-sm font-medium text-slate-700"
                                            x-text="account.account_name"></span>
                                    </div>
                                    <p class="text-lg font-bold text-green-600" x-text="formatRupiah(account.saldo_akhir)">
                                    </p>
                                </div>
                            </template>
                            <template x-if="mainAccounts.length === 0">
                                <div class="text-center text-slate-400 py-4">
                                    Tidak ada data saldo akun
                                </div>
                            </template>
                        </div>
                    </div>
                </div>

                <!-- Quick Actions -->
                <div class="bg-white rounded-xl shadow border border-slate-200 p-6 mb-8">
                    <h3 class="text-lg font-semibold text-slate-700 mb-6">Aksi Cepat</h3>
                    <div class="grid grid-cols-2 md:grid-cols-4 gap-4">
                        <a href="/coa" class="group">
                            <div class="bg-slate-50 hover:bg-slate-100 rounded-lg p-4 text-center transition-colors">
                                <div
                                    class="bg-blue-500 rounded-full p-3 w-fit mx-auto mb-3 group-hover:bg-blue-600 transition-colors">
                                    <img src="images/iconBank.svg" class="w-6 h-6" alt="">
                                </div>
                                <p class="text-sm font-medium text-slate-700">Chart of Account</p>
                                <p class="text-xs text-slate-500 mt-1">Kelola akun</p>
                            </div>
                        </a>

                        <a href="/saldo-awal" class="group">
                            <div class="bg-slate-50 hover:bg-slate-100 rounded-lg p-4 text-center transition-colors">
                                <div
                                    class="bg-green-500 rounded-full p-3 w-fit mx-auto mb-3 group-hover:bg-green-600 transition-colors">
                                    <img src="images/iconSaldo.svg" class="w-6 h-6" alt="">
                                </div>
                                <p class="text-sm font-medium text-slate-700">Saldo Awal</p>
                                <p class="text-xs text-slate-500 mt-1">Set saldo awal</p>
                            </div>
                        </a>

                        <a href="/jurnal-umum" class="group">
                            <div class="bg-slate-50 hover:bg-slate-100 rounded-lg p-4 text-center transition-colors">
                                <div
                                    class="bg-purple-500 rounded-full p-3 w-fit mx-auto mb-3 group-hover:bg-purple-600 transition-colors">
                                    <img src="images/iconJurnal.svg" class="w-6 h-6" alt="">
                                </div>
                                <p class="text-sm font-medium text-slate-700">Jurnal Umum</p>
                                <p class="text-xs text-slate-500 mt-1">Input transaksi</p>
                            </div>
                        </a>

                        <a href="/buku-besar" class="group">
                            <div class="bg-slate-50 hover:bg-slate-100 rounded-lg p-4 text-center transition-colors">
                                <div
                                    class="bg-orange-500 rounded-full p-3 w-fit mx-auto mb-3 group-hover:bg-orange-600 transition-colors">
                                    <img src="images/iconBukuBesar.svg" class="w-6 h-6" alt="">
                                </div>
                                <p class="text-sm font-medium text-slate-700">Buku Besar</p>
                                <p class="text-xs text-slate-500 mt-1">Lihat laporan</p>
                            </div>
                        </a>
                    </div>
                </div>

                <!-- Recent Transactions -->
                <div class="bg-white rounded-xl shadow border border-slate-200 p-6">
                    <div class="flex items-center justify-between mb-6">
                        <h3 class="text-lg font-semibold text-slate-700">Transaksi Terbaru</h3>
                        <a href="/jurnal-umum" class="text-sm text-blue-600 hover:text-blue-700 font-medium">Lihat
                            Semua</a>
                    </div>
                    <div class="overflow-x-auto">
                        <table class="min-w-full divide-y divide-slate-200">
                            <thead>
                                <tr class="bg-slate-50">
                                    <th scope="col"
                                        class="px-6 py-3 text-left text-xs font-medium text-slate-500 uppercase tracking-wider">
                                        Tanggal</th>
                                    <th scope="col"
                                        class="px-6 py-3 text-left text-xs font-medium text-slate-500 uppercase tracking-wider">
                                        No. Jurnal</th>
                                    <th scope="col"
                                        class="px-6 py-3 text-left text-xs font-medium text-slate-500 uppercase tracking-wider">
                                        Keterangan</th>
                                    <th scope="col"
                                        class="px-6 py-3 text-left text-xs font-medium text-slate-500 uppercase tracking-wider">
                                        Tipe</th>
                                    <th scope="col"
                                        class="px-6 py-3 text-right text-xs font-medium text-slate-500 uppercase tracking-wider">
                                        Debet</th>
                                    <th scope="col"
                                        class="px-6 py-3 text-right text-xs font-medium text-slate-500 uppercase tracking-wider">
                                        Kredit</th>
                                </tr>
                            </thead>
                            <tbody class="bg-white divide-y divide-slate-200">
                                <template x-if="recentTransactions.length > 0">
                                    <template x-for="transaction in recentTransactions" :key="transaction.id">
                                        <tr class="hover:bg-slate-50">
                                            <td class="px-6 py-4 whitespace-nowrap text-sm text-slate-600"
                                                x-text="formatDate(transaction.tanggal)"></td>
                                            <td class="px-6 py-4 whitespace-nowrap text-sm text-slate-500"
                                                x-text="transaction.nomor_jurnal"></td>
                                            <td class="px-6 py-4 text-sm text-slate-600" x-text="transaction.keterangan">
                                            </td>
                                            <td class="px-6 py-4 text-sm">
                                                <span class="px-2 py-1 rounded-full text-xs font-medium"
                                                    :class="transaction.tipe === 'Pemasukan' ? 'bg-green-100 text-green-800' :
                                                        'bg-red-100 text-red-800'"
                                                    x-text="transaction.tipe">
                                                </span>
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap text-sm text-slate-600 text-right"
                                                x-text="formatRupiah(transaction.total_debet)"></td>
                                            <td class="px-6 py-4 whitespace-nowrap text-sm text-slate-600 text-right"
                                                x-text="formatRupiah(transaction.total_kredit)"></td>
                                        </tr>
                                    </template>
                                </template>
                                <template x-if="recentTransactions.length === 0">
                                    <tr>
                                        <td colspan="6" class="text-center text-slate-400 py-4">Tidak ada transaksi
                                            terbaru</td>
                                    </tr>
                                </template>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="//unpkg.com/alpinejs" defer></script>
    <script>
        window.API_BASE_URL = "{{ env('API_BASE_URL', 'http://localhost/api') }}";
        window.API_TOKEN = localStorage.getItem('token');

        function dashboardApp() {
            return {
                activePeriode: null,
                totalAccounts: 0,
                totalTransactions: 0,
                totalPemasukan: 0,
                totalPengeluaran: 0,
                mainAccounts: [],
                recentTransactions: [],
                lastUpdate: 'Loading...',

                async init() {
                    await this.loadDashboardData();
                    // Update setiap 5 menit
                    setInterval(() => this.loadDashboardData(), 5 * 60 * 1000);
                },

                async loadDashboardData() {
                    try {
                        await Promise.all([
                            this.fetchActivePeriode(),
                            this.fetchTotalAccounts(),
                            this.fetchTotalTransactions(),
                            this.fetchFinancialSummary(),
                            this.fetchMainAccounts(),
                            this.fetchRecentTransactions()
                        ]);
                        this.lastUpdate = new Date().toLocaleTimeString('id-ID');
                    } catch (error) {
                        console.error('Error loading dashboard data:', error);
                    }
                },

                async fetchActivePeriode() {
                    const token = window.API_TOKEN || '';
                    const response = await fetch(`${window.API_BASE_URL}/api/periode`, {
                        headers: {
                            'Authorization': `Bearer ${token}`,
                            'Accept': 'application/json',
                        }
                    });
                    const data = await response.json();
                    const periodeList = data.data || data;
                    this.activePeriode = periodeList.find(p => p.status === 'aktif') || null;
                },

                async fetchTotalAccounts() {
                    const token = window.API_TOKEN || '';
                    const response = await fetch(`${window.API_BASE_URL}/api/coa`, {
                        headers: {
                            'Authorization': `Bearer ${token}`,
                            'Accept': 'application/json',
                        }
                    });
                    const data = await response.json();
                    const accounts = data.data || data;
                    this.totalAccounts = accounts.length || 0;
                },

                async fetchTotalTransactions() {
                    const token = window.API_TOKEN || '';
                    const response = await fetch(`${window.API_BASE_URL}/api/jurnal`, {
                        headers: {
                            'Authorization': `Bearer ${token}`,
                            'Accept': 'application/json',
                        }
                    });
                    const data = await response.json();
                    const transactions = data.data || data;
                    this.totalTransactions = transactions.length || 0;
                },

                async fetchFinancialSummary() {
                    if (!this.activePeriode) return;

                    const token = window.API_TOKEN || '';
                    const response = await fetch(
                        `${window.API_BASE_URL}/api/laporan/aktivitas?periode_id=${this.activePeriode.id}&level=3`, {
                            headers: {
                                'Authorization': `Bearer ${token}`,
                                'Accept': 'application/json',
                            }
                        });
                    const data = await response.json();

                    // Hitung total pemasukan dan pengeluaran
                    this.totalPemasukan = 0;
                    this.totalPengeluaran = 0;

                    if (data.pemasukan) {
                        data.pemasukan.forEach(item => {
                            this.totalPemasukan += parseFloat(item.saldo_akhir || 0);
                        });
                    }

                    if (data.pengeluaran) {
                        data.pengeluaran.forEach(item => {
                            this.totalPengeluaran += parseFloat(item.saldo_akhir || 0);
                        });
                    }
                },

                async fetchMainAccounts() {
                    if (!this.activePeriode) return;

                    const token = window.API_TOKEN || '';
                    const response = await fetch(
                        `${window.API_BASE_URL}/api/laporan/posisi-keuangan?periode_id=${this.activePeriode.id}&level=3`, {
                            headers: {
                                'Authorization': `Bearer ${token}`,
                                'Accept': 'application/json',
                            }
                        });
                    const data = await response.json();

                    // Ambil akun utama (kas, bank, piutang)
                    const mainAccountCodes = ['1101', '1102', '1201']; // Sesuaikan dengan kode akun utama
                    this.mainAccounts = [];

                    if (data.asset) {
                        data.asset.forEach(item => {
                            if (mainAccountCodes.includes(item.account_code)) {
                                this.mainAccounts.push(item);
                            }
                        });
                    }

                    // Batasi hanya 3 akun utama
                    this.mainAccounts = this.mainAccounts.slice(0, 3);
                },

                async fetchRecentTransactions() {
                    const token = window.API_TOKEN || '';
                    const response = await fetch(`${window.API_BASE_URL}/api/jurnal`, {
                        headers: {
                            'Authorization': `Bearer ${token}`,
                            'Accept': 'application/json',
                        }
                    });
                    const data = await response.json();
                    const transactions = data.data || data;

                    // Hitung total debet dan kredit dari detail jurnal
                    const processedTransactions = transactions.map(transaction => {
                        let totalDebet = 0;
                        let totalKredit = 0;

                        if (transaction.detail && transaction.detail.length > 0) {
                            transaction.detail.forEach(detail => {
                                totalDebet += parseFloat(detail.debit || 0);
                                totalKredit += parseFloat(detail.kredit || 0);
                            });
                        }

                        return {
                            ...transaction,
                            total_debet: totalDebet,
                            total_kredit: totalKredit
                        };
                    });

                    // Ambil 5 transaksi terbaru
                    this.recentTransactions = processedTransactions.slice(0, 5);
                },

                formatRupiah(val) {
                    if (val === null || val === undefined || val === 0) return 'Rp 0';
                    return 'Rp ' + Number(val).toLocaleString('id-ID');
                },

                formatDate(dateStr) {
                    if (!dateStr) return '-';
                    const date = new Date(dateStr);
                    return date.toLocaleDateString('id-ID');
                }
            }
        }
    </script>
@endsection
