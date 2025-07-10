<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <script src="https://cdn.tailwindcss.com"></script>
    <title>Sidebar Keuangan</title>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600;700&display=swap" rel="stylesheet">
    <style>
        body,
        .font-admin {
            font-family: 'Inter', sans-serif;
        }
    </style>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/noty@3.2.0-beta-deprecated/lib/noty.css" />
    <script src="https://cdn.jsdelivr.net/npm/noty@3.2.0-beta-deprecated/lib/noty.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>

<body class="bg-gray-100">
    <div class="min-h-screen">
        <!-- Sidebar -->
        <aside
            class="fixed h-screen w-1/6 bg-gradient-to-b from-indigo-700 to-blue-500 flex flex-col items-center shadow-lg">
            <div class="flex flex-col items-center w-full h-full text-sm">
                <div class="py-8 flex flex-col items-center">
                    <img src="https://ui-avatars.com/api/?name=User&background=4F46E5&color=fff"
                        class="rounded-full w-20 h-20 mb-4 border-4 border-white shadow" alt="User Avatar">
                    <h2 class="text-white text-xl font-bold">KEUANGAN KAMI</h2>
                </div>
                <nav class="flex-1 overflow-y-scroll w-full px-2">
                    <ul class="space-y-2">
                        <li>
                            <a href="{{ route('dashboard') }}"
                                class="flex items-center px-4 py-2 rounded-lg text-white transition
                               {{ request()->routeIs('dashboard') ? 'bg-indigo-800' : 'hover:bg-indigo-800' }}">
                                <img src="images/iconHome.svg" class="w-6 h-6 mr-2" alt="">
                                Dashboard
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('coa') }}"
                                class="flex items-center px-4 py-2 rounded-lg text-white transition
                               {{ request()->routeIs('coa') ? 'bg-indigo-800' : 'hover:bg-indigo-800' }}">
                                <img src="images/iconBank.svg" class="w-6 h-6 mr-2" alt="">
                                COA (3 Level)
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('settingPeriode') }}"
                                class="flex items-center px-4 py-2 rounded-lg text-white transition
                                {{ request()->routeIs('settingPeriode') ? 'bg-indigo-800' : 'hover:bg-indigo-800' }}">
                                <img src="images/iconPeriode.svg" class="w-6 h-6 mr-2" alt="">
                                Setting Periode
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('saldoAwal') }}"
                                class="flex items-center px-4 py-2 rounded-lg text-white transition
                                {{ request()->routeIs('saldoAwal') ? 'bg-indigo-800' : 'hover:bg-indigo-800' }}">
                                <img src="images/iconSaldo.svg" class="w-6 h-6 mr-2" alt="">
                                Saldo Awal
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('laporanSaldoAwal') }}"
                                class="flex items-center px-4 py-2 rounded-lg text-white transition
                                {{ request()->routeIs('laporanSaldoAwal') ? 'bg-indigo-800' : 'hover:bg-indigo-800' }}">
                                <img src="images/iconCheckSaldo.svg" class="w-6 h-6 mr-2" alt="">
                                Laporan Saldo Awal
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('jurnalUmum') }}"
                                class="flex items-center px-4 py-2 rounded-lg text-white transition
                                {{ request()->routeIs('jurnalUmum') ? 'bg-indigo-800' : 'hover:bg-indigo-800' }}">
                                <img src="images/iconJurnalUmum.svg" class="w-6 h-6 mr-2" alt="">
                                Jurnal Umum
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('bukuBesar') }}"
                                class="flex items-center px-4 py-2 rounded-lg text-white transition
                                {{ request()->routeIs('bukuBesar') ? 'bg-indigo-800' : 'hover:bg-indigo-800' }}">
                                <img src="images/iconBukuBesar.svg" class="w-6 h-6 mr-2" alt="">
                                Buku Besar
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('neracaSaldo') }}"
                                class="flex items-center px-4 py-2 rounded-lg text-white transition
                                {{ request()->routeIs('neracaSaldo') ? 'bg-indigo-800' : 'hover:bg-indigo-800' }}">
                                <img src="images/iconNeracaSaldo.svg" class="w-6 h-6 mr-2" alt="">
                                Neraca Saldo
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('posisiKeuangan') }}"
                                class="flex items-center px-4 py-2 rounded-lg text-white transition
                                {{ request()->routeIs('posisiKeuangan') ? 'bg-indigo-800' : 'hover:bg-indigo-800' }}">
                                <img src="images/iconKeuangan.svg" class="w-6 h-6 mr-2" alt="">
                                Posisi Keuangan
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('laporan-aktivitas') }}"
                                class="flex items-center px-4 py-2 rounded-lg text-white transition
                                {{ request()->routeIs('laporan-aktivitas') ? 'bg-indigo-800' : 'hover:bg-indigo-800' }}">
                                <img src="images/iconAktifitas.svg" class="w-6 h-6 mr-2" alt="">
                                Laporan Aktivitas
                            </a>
                        </li>
                    </ul>
                </nav>
                <div class="w-full px-2 pb-6 mt-4">
                    <form id="sidebarLogoutForm" method="POST" action="{{ route('logout.submit') }}">
                        @csrf
                        <button type="button"
                            class="flex items-center w-full px-4 py-2 rounded-lg text-white bg-red-500 hover:bg-red-600 transition"
                            onclick="showLogoutSwal()">
                            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" stroke-width="2"
                                viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M17 16l4-4m0 0l-4-4m4 4H7">
                                </path>
                            </svg>
                            Logout
                        </button>
                    </form>
                    <script>
                        function showLogoutSwal() {
                            Swal.fire({
                                title: 'Konfirmasi Logout',
                                text: 'Apakah Anda yakin ingin logout?',
                                icon: 'warning',
                                showCancelButton: true,
                                confirmButtonColor: '#d33',
                                cancelButtonColor: '#3085d6',
                                confirmButtonText: 'Ya, Logout',
                                cancelButtonText: 'Batal'
                            }).then((result) => {
                                if (result.isConfirmed) {
                                    document.getElementById('sidebarLogoutForm').submit();
                                }
                            });
                        }
                    </script>
                </div>
            </div>
        </aside>
        <!-- Main Content -->
        <main class="min-h-screen p-2 md:p-8 absolute w-5/6 right-0 bg-gradient-to-br from-sky-50 to-white">
            @yield('content')
        </main>
    </div>
    <script src="/js/app.js"></script>
</body>

</html>
