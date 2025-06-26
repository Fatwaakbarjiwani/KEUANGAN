@extends('components.sidebar')

@section('content')
    <div class="min-h-screen bg-gray-50/30 font-admin">
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
                    <span class="ml-auto px-3 py-1 bg-sky-100 text-sky-700 rounded-full text-xs font-semibold shadow-sm">
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
                            <p class="text-2xl font-bold text-slate-700 mt-1">Januari 2024</p>
                            <p class="text-xs text-green-600 mt-1">✓ Periode terbuka</p>
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
                            <p class="text-2xl font-bold text-slate-700 mt-1">24</p>
                            <p class="text-xs text-blue-600 mt-1">+2 dari bulan lalu</p>
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
                            <p class="text-2xl font-bold text-slate-700 mt-1">150</p>
                            <p class="text-xs text-purple-600 mt-1">+15 dari bulan lalu</p>
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
                        <span class="text-xs text-slate-400">Bulan ini</span>
                    </div>
                    <div class="space-y-4">
                        <div class="flex items-center justify-between">
                            <div class="flex items-center gap-3">
                                <div class="w-3 h-3 bg-green-500 rounded-full"></div>
                                <span class="text-sm text-slate-600">Pemasukan</span>
                            </div>
                            <div class="text-right">
                                <p class="text-lg font-bold text-green-600">Rp 25.000.000</p>
                                <p class="text-xs text-green-500">+12.5% dari bulan lalu</p>
                            </div>
                        </div>
                        <div class="flex items-center justify-between">
                            <div class="flex items-center gap-3">
                                <div class="w-3 h-3 bg-red-500 rounded-full"></div>
                                <span class="text-sm text-slate-600">Pengeluaran</span>
                            </div>
                            <div class="text-right">
                                <p class="text-lg font-bold text-red-600">Rp 18.500.000</p>
                                <p class="text-xs text-red-500">+8.2% dari bulan lalu</p>
                            </div>
                        </div>
                        <div class="border-t pt-4">
                            <div class="flex items-center justify-between">
                                <span class="text-sm font-medium text-slate-700">Saldo Bersih</span>
                                <p class="text-xl font-bold text-blue-600">Rp 6.500.000</p>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Account Balance Overview -->
                <div class="bg-white rounded-xl shadow border border-slate-200 p-6">
                    <div class="flex items-center justify-between mb-6">
                        <h3 class="text-lg font-semibold text-slate-700">Saldo Akun Utama</h3>
                        <span class="text-xs text-slate-400">Update terakhir: 2 jam lalu</span>
                    </div>
                    <div class="space-y-4">
                        <div class="flex items-center justify-between p-3 bg-green-50 rounded-lg">
                            <div class="flex items-center gap-3">
                                <div class="bg-green-500 rounded-full p-2">
                                    <img src="images/iconSaldo.svg" class="w-4 h-4" alt="">
                                </div>
                                <span class="text-sm font-medium text-slate-700">Kas</span>
                            </div>
                            <p class="text-lg font-bold text-green-600">Rp 8.500.000</p>
                        </div>
                        <div class="flex items-center justify-between p-3 bg-blue-50 rounded-lg">
                            <div class="flex items-center gap-3">
                                <div class="bg-blue-500 rounded-full p-2">
                                    <img src="images/iconBank.svg" class="w-4 h-4" alt="">
                                </div>
                                <span class="text-sm font-medium text-slate-700">Bank</span>
                            </div>
                            <p class="text-lg font-bold text-blue-600">Rp 15.200.000</p>
                        </div>
                        <div class="flex items-center justify-between p-3 bg-yellow-50 rounded-lg">
                            <div class="flex items-center gap-3">
                                <div class="bg-yellow-500 rounded-full p-2">
                                    <img src="images/iconBank.svg" class="w-4 h-4" alt="">
                                </div>
                                <span class="text-sm font-medium text-slate-700">Piutang</span>
                            </div>
                            <p class="text-lg font-bold text-yellow-600">Rp 3.800.000</p>
                        </div>
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
                    <a href="/jurnal-umum" class="text-sm text-blue-600 hover:text-blue-700 font-medium">Lihat Semua</a>
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
                                    No. Bukti</th>
                                <th scope="col"
                                    class="px-6 py-3 text-left text-xs font-medium text-slate-500 uppercase tracking-wider">
                                    Keterangan</th>
                                <th scope="col"
                                    class="px-6 py-3 text-right text-xs font-medium text-slate-500 uppercase tracking-wider">
                                    Debet</th>
                                <th scope="col"
                                    class="px-6 py-3 text-right text-xs font-medium text-slate-500 uppercase tracking-wider">
                                    Kredit</th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-slate-200">
                            <tr class="hover:bg-slate-50">
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-slate-600">15/01/2024</td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-slate-500">JU-015</td>
                                <td class="px-6 py-4 text-sm text-slate-600">Pendapatan Jasa Konsultasi</td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-slate-600 text-right">2.500.000</td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-slate-600 text-right">0</td>
                            </tr>
                            <tr class="hover:bg-slate-50">
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-slate-600">14/01/2024</td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-slate-500">JU-014</td>
                                <td class="px-6 py-4 text-sm text-slate-600">Pembayaran Gaji Karyawan</td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-slate-600 text-right">0</td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-slate-600 text-right">1.800.000</td>
                            </tr>
                            <tr class="hover:bg-slate-50">
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-slate-600">13/01/2024</td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-slate-500">JU-013</td>
                                <td class="px-6 py-4 text-sm text-slate-600">Pembelian Perlengkapan Kantor</td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-slate-600 text-right">0</td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-slate-600 text-right">750.000</td>
                            </tr>
                            <tr class="hover:bg-slate-50">
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-slate-600">12/01/2024</td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-slate-500">JU-012</td>
                                <td class="px-6 py-4 text-sm text-slate-600">Pendapatan Jasa Training</td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-slate-600 text-right">3.000.000</td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-slate-600 text-right">0</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection
