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
            <div id="infoCards" class="grid grid-cols-1 md:grid-cols-4 gap-6 mb-8">
                <!-- Akan diisi oleh JS -->
            </div>

            <!-- Filter Section -->
            <div class="bg-white rounded-xl shadow border border-slate-200 p-6 mb-8">
                <h3 class="text-lg font-semibold text-slate-700 mb-4">Filter Laporan</h3>
                <form id="filterForm" class="flex flex-col md:flex-row md:items-end md:gap-4 gap-4">
                    <div class="flex-1 min-w-[200px]">
                        <label class="block text-slate-600 mb-1 text-sm font-medium">Periode</label>
                        <select id="selectPeriode"
                            class="w-full border border-slate-200 rounded-lg focus:border-blue-500 focus:ring-blue-500 text-sm py-2 px-3">
                            <option value="">Pilih Periode</option>
                        </select>
                    </div>
                    <div class="flex-1 min-w-[200px]">
                        <label class="block text-slate-600 mb-1 text-sm font-medium">Level (Opsional)</label>
                        <select id="selectLevel"
                            class="w-full border border-slate-200 rounded-lg focus:border-blue-500 focus:ring-blue-500 text-sm py-2 px-3">
                            <option value="">Semua Level</option>
                            <option value="1">Level 1</option>
                            <option value="2">Level 2</option>
                            <option value="3">Level 3</option>
                        </select>
                    </div>
                    <div class="flex items-end gap-2">
                        <button type="submit" id="tampilkanBtn"
                            class="bg-blue-500 hover:bg-blue-600 text-white font-medium py-2 px-4 rounded-lg transition focus:outline-none focus:ring-2 focus:ring-blue-200">Tampilkan</button>
                        <button type="button" id="downloadPdfBtn"
                            class="bg-green-600 hover:bg-green-700 text-white font-medium py-2 px-4 rounded-lg transition hidden">Download
                            PDF</button>
                        <button type="button" id="resetFilterBtn"
                            class="bg-slate-400 hover:bg-slate-500 text-white font-medium py-2 px-4 rounded-lg transition">Reset</button>
                    </div>
                </form>
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
                        Laporan Saldo Awal
                    </h2>
                    <div class="flex items-center gap-4">
                        <div class="flex items-center gap-2 text-sm text-slate-600">
                            <span class="font-medium">Total Akun:</span>
                            <span id="totalAkun"
                                class="px-2 py-1 bg-blue-100 text-blue-700 rounded-lg text-xs font-medium">0</span>
                        </div>
                        <div class="flex items-center gap-2 text-sm text-slate-600">
                            <span class="font-medium">Status:</span>
                            <span id="statusSaldoAwal"
                                class="px-2 py-1 bg-green-100 text-green-700 rounded-lg text-xs font-medium">-</span>
                        </div>
                    </div>
                </div>
                <div class="overflow-x-auto">
                    <table class="min-w-full divide-y divide-slate-200">
                        <thead>
                            <tr class="bg-slate-50">
                                <th class="px-6 py-3 text-left text-xs font-medium text-slate-500 uppercase tracking-wider">
                                    No</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-slate-500 uppercase tracking-wider">
                                    ID Akun</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-slate-500 uppercase tracking-wider">
                                    Kode Akun</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-slate-500 uppercase tracking-wider">
                                    Nama Rekening</th>
                                <th
                                    class="px-6 py-3 text-right text-xs font-medium text-slate-500 uppercase tracking-wider">
                                    Debet</th>
                                <th
                                    class="px-6 py-3 text-right text-xs font-medium text-slate-500 uppercase tracking-wider">
                                    Kredit</th>
                                <th
                                    class="px-6 py-3 text-center text-xs font-medium text-slate-500 uppercase tracking-wider">
                                    Aksi</th>
                            </tr>
                        </thead>
                        <tbody id="laporanSaldoAwalTableBody" class="bg-white divide-y divide-slate-200">
                            <!-- Data akan diisi oleh JavaScript -->
                        </tbody>
                        <tfoot>
                            <tr class="bg-slate-100 font-bold">
                                <td colspan="4" class="px-6 py-4 text-sm text-slate-800 text-right">TOTAL</td>
                                <td class="px-6 py-4 text-right text-green-700" id="tfootTotalDebet">Rp 0</td>
                                <td class="px-6 py-4 text-right text-rose-700" id="tfootTotalKredit">Rp 0</td>
                                <td></td>
                            </tr>
                        </tfoot>
                    </table>
                </div>
            </div>
        </div>
    </div>
    <!-- jsPDF CDN -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.5.1/jspdf.umd.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf-autotable/3.8.2/jspdf.plugin.autotable.min.js"></script>
    <script>
        window.apiBaseUrl = "{{ env('API_BASE_URL', 'http://localhost/api') }}";
        const token = localStorage.getItem('token');
        let selectedPeriodeId = null;
        let periodeListGlobal = [];

        function formatRupiah(num) {
            return 'Rp ' + Number(num).toLocaleString('id-ID');
        }

        function fetchAndRenderPeriodeDropdown() {
            fetch(`${apiBaseUrl}/api/periode`, {
                    headers: {
                        'Authorization': `Bearer ${token}`
                    }
                })
                .then(res => res.json())
                .then(data => {
                    const periodeList = data.data || data;
                    periodeListGlobal = periodeList; // simpan global
                    const select = document.getElementById('selectPeriode');
                    select.innerHTML = '<option value="">Pilih Periode</option>';
                    periodeList.forEach(p => {
                        select.innerHTML +=
                            `<option value="${p.id}">${p.nama} (${p.tanggal_mulai} s/d ${p.tanggal_selesai})</option>`;
                    });
                    // Tidak ada pemilihan otomatis, tidak fetch data otomatis
                });
        }

        function fetchAndRenderSaldoAwalForPeriode(periodeObj) {
            // periodeObj: objek periode aktif
            let url = `${apiBaseUrl}/api/saldo-awal?periode_id=${periodeObj.id}`;
            fetch(url, {
                    headers: {
                        'Authorization': `Bearer ${token}`
                    }
                })
                .then(res => res.json())
                .then(data => {
                    // render tabel dan info card, info card pakai nama dan tanggal dari periodeObj
                    renderLaporanSaldoAwalTable(data, periodeObj);
                    // Sembunyikan tombol tampilkan, tampilkan tombol download
                    document.getElementById('tampilkanBtn').classList.add('hidden');
                    document.getElementById('downloadPdfBtn').classList.remove('hidden');
                });
        }

        function renderInfoCards(periode, totalDebet, totalKredit, status) {
            const cardIcon = {
                debet: `<div class='bg-green-100 rounded-full p-3 flex items-center justify-center'><svg class='w-6 h-6 text-green-600' fill='none' stroke='currentColor' viewBox='0 0 24 24'><circle cx='12' cy='12' r='10' fill='#d1fae5'/><path stroke-linecap='round' stroke-linejoin='round' stroke-width='2' d='M12 8v8m4-4H8' /></svg></div>`,
                kredit: `<div class='bg-red-100 rounded-full p-3 flex items-center justify-center'><svg class='w-6 h-6 text-red-600' fill='none' stroke='currentColor' viewBox='0 0 24 24'><circle cx='12' cy='12' r='10' fill='#fee2e2'/><path stroke-linecap='round' stroke-linejoin='round' stroke-width='2' d='M8 12h8' /></svg></div>`,
                status: `<div class='bg-blue-100 rounded-full p-3 flex items-center justify-center'><svg class='w-6 h-6 text-blue-600' fill='none' stroke='currentColor' viewBox='0 0 24 24'><circle cx='12' cy='12' r='10' fill='#dbeafe'/><path stroke-linecap='round' stroke-linejoin='round' stroke-width='2' d='M9 12l2 2 4-4' /></svg></div>`
            };
            const nama = periode && periode.nama ? periode.nama : '-';
            const tanggalMulai = periode && periode.tanggal_mulai ? periode.tanggal_mulai : '-';
            const tanggalSelesai = periode && periode.tanggal_selesai ? periode.tanggal_selesai : '-';
            document.getElementById('infoCards').innerHTML = `
                <div class="bg-white rounded-xl shadow border border-slate-200 p-6">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-xs font-medium text-slate-600">Periode</p>
                            <p class="text-lg font-bold text-slate-700 mt-1">${nama}</p>
                            <p class="text-xs text-green-600 mt-1">${tanggalMulai} s/d ${tanggalSelesai}</p>
                        </div>
                        <div class="bg-blue-100 rounded-full p-2 flex items-center justify-center">
                            <svg class="w-6 h-6 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M12 20a8 8 0 100-16 8 8 0 000 16z"></path></svg>
                        </div>
                    </div>
                </div>
                <div class="bg-white rounded-xl shadow border border-slate-200 p-6">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-xs font-medium text-slate-600">Total Debet</p>
                            <p class="text-lg font-bold text-green-600 mt-1">${formatRupiah(totalDebet)}</p>
                        </div>
                        ${cardIcon.debet}
                    </div>
                </div>
                <div class="bg-white rounded-xl shadow border border-slate-200 p-6">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-xs font-medium text-slate-600">Total Kredit</p>
                            <p class="text-lg font-bold text-red-600 mt-1">${formatRupiah(totalKredit)}</p>
                        </div>
                        ${cardIcon.kredit}
            </div>
                </div>
                <div class="bg-white rounded-xl shadow border border-slate-200 p-6">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-xs font-medium text-slate-600">Status</p>
                            <p class="text-lg font-bold ${status === 'Seimbang' ? 'text-blue-600' : 'text-red-600'} mt-1">${status}</p>
                            <p class="text-xs ${status === 'Seimbang' ? 'text-blue-500' : 'text-red-500'} mt-1">${status === 'Seimbang' ? '✓ Debet = Kredit' : 'Debet ≠ Kredit'}</p>
                        </div>
                        ${cardIcon.status}
        </div>
    </div>
            `;
        }

        function renderLaporanSaldoAwalTable(data, periodeObj = null) {
            const tbody = document.getElementById('laporanSaldoAwalTableBody');
            tbody.innerHTML = '';
            let totalDebet = 0,
                totalKredit = 0,
                no = 1;
            if (!data || data.length === 0) {
                tbody.innerHTML =
                    `<tr><td colspan="7" class="text-center text-slate-400 py-4">Data tidak ditemukan.</td></tr>`;
                document.getElementById('totalAkun').textContent = 0;
                document.getElementById('tfootTotalDebet').textContent = formatRupiah(0);
                document.getElementById('tfootTotalKredit').textContent = formatRupiah(0);
                document.getElementById('statusSaldoAwal').textContent = '-';
                renderInfoCards(periodeObj || {}, 0, 0, '-');
                return;
            }
            data.forEach(item => {
                const akun = item.akun || {};
                const jumlah = parseFloat(item.jumlah) || 0;
                let debet = '',
                    kredit = '';
                if (item.tipe_saldo === 'Debit') {
                    debet = formatRupiah(jumlah);
                    totalDebet += jumlah;
                }
                if (item.tipe_saldo === 'Kredit') {
                    kredit = formatRupiah(jumlah);
                    totalKredit += jumlah;
                }
                tbody.innerHTML += `
                    <tr>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-slate-600">${no++}</td>
                        <td class="px-6 py-4 whitespace-nowrap text-xs text-slate-400">${akun.id || '-'}</td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-slate-500">${akun.account_code || '-'}</td>
                        <td class="px-6 py-4 text-sm text-slate-600" style="padding-left: ${(akun.level || 0) * 24}px">
                            ${(akun.level > 0 ? `<svg class='inline w-4 h-4 mr-1 text-sky-400 align-middle' fill='none' stroke='currentColor' stroke-width='2' viewBox='0 0 24 24'><path d='M9 17v-2m3 2v-4m3 4v-6m2 10H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z' stroke-linecap='round' stroke-linejoin='round'></path></svg>` : '')}
                            ${akun.account_name || '-'}
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-right">${debet}</td>
                        <td class="px-6 py-4 whitespace-nowrap text-right">${kredit}</td>
                        <td class="px-6 py-4 whitespace-nowrap text-center">
                            <button class="btn-edit-saldo bg-amber-400 hover:bg-amber-500 text-white p-1 rounded-md mx-1" data-id="${item.id}" title="Edit"><img src="images/iconEdit.svg" class="w-5 h-5" alt="Edit"></button>
                            <button class="btn-delete-saldo bg-rose-400 hover:bg-rose-500 text-white p-1 rounded-md mx-1" data-id="${item.id}" title="Hapus"><img src="images/iconSampah.svg" class="w-5 h-5" alt="Hapus"></button>
                        </td>
                    </tr>
                `;
            });
            document.getElementById('totalAkun').textContent = data.length;
            document.getElementById('tfootTotalDebet').textContent = formatRupiah(totalDebet);
            document.getElementById('tfootTotalKredit').textContent = formatRupiah(totalKredit);
            const status = (totalDebet === totalKredit && totalDebet > 0) ? 'Seimbang' : 'Tidak Seimbang';
            document.getElementById('statusSaldoAwal').textContent = status;
            let periode = periodeObj;
            if (!periode) {
                // Ambil info periode dari dropdown jika tidak ada
                const periodeSelect = document.getElementById('selectPeriode');
                periode = {
                    nama: periodeSelect.options[periodeSelect.selectedIndex]?.text?.replace(/\(.*/, '').trim() || '-',
                    tanggal_mulai: '',
                    tanggal_selesai: ''
                };
            }
            renderInfoCards(periode, totalDebet, totalKredit, status);
        }

        document.addEventListener('DOMContentLoaded', function() {
            fetchAndRenderPeriodeDropdown();
            renderInfoCards({}, 0, 0, '-');
            const tampilkanBtn = document.getElementById('tampilkanBtn');
            const downloadPdfBtn = document.getElementById('downloadPdfBtn');
            const resetFilterBtn = document.getElementById('resetFilterBtn');
            let lastTableData = [];

            document.getElementById('filterForm').onsubmit = function(e) {
                e.preventDefault();
                selectedPeriodeId = document.getElementById('selectPeriode').value;
                const selectedLevel = document.getElementById('selectLevel').value;
                if (!selectedPeriodeId) {
                    Swal.fire({
                        icon: 'warning',
                        title: 'Pilih Periode',
                        text: 'Silakan pilih periode terlebih dahulu.'
                    });
                    return;
                }
                let url = `${apiBaseUrl}/api/saldo-awal?periode_id=${selectedPeriodeId}`;
                if (selectedLevel) url += `&level=${selectedLevel}`;
                fetch(url, {
                        headers: {
                            'Authorization': `Bearer ${token}`
                        }
                    })
                    .then(res => res.json())
                    .then(data => {
                        // Ambil detail periode terpilih dari periodeListGlobal
                        const periodeObj = periodeListGlobal.find(p => p.id == selectedPeriodeId) || {};
                        renderLaporanSaldoAwalTable(data, periodeObj);
                        lastTableData = data;
                        tampilkanBtn.classList.add('hidden');
                        downloadPdfBtn.classList.remove('hidden');
                    });
            };
            downloadPdfBtn.onclick = function() {
                if (!lastTableData || lastTableData.length === 0) return;
                const {
                    jsPDF
                } = window.jspdf;
                const doc = new jsPDF();
                const tableData = lastTableData.map((item, idx) => {
                    const akun = item.akun || {};
                    let debet = '',
                        kredit = '';
                    const jumlah = parseFloat(item.jumlah) || 0;
                    if (item.tipe_saldo === 'Debit') debet = jumlah.toLocaleString('id-ID');
                    if (item.tipe_saldo === 'Kredit') kredit = jumlah.toLocaleString('id-ID');
                    return [
                        idx + 1,
                        akun.id || '-',
                        akun.account_code || '-',
                        akun.account_name || '-',
                        debet,
                        kredit
                    ];
                });
                doc.text('Laporan Saldo Awal', 14, 14);
                doc.autoTable({
                    head: [
                        ['No', 'ID Akun', 'Kode Akun', 'Nama Rekening', 'Debet', 'Kredit']
                    ],
                    body: tableData,
                    startY: 20,
                    styles: {
                        fontSize: 10
                    }
                });
                doc.save('laporan-saldo-awal.pdf');
            };
            resetFilterBtn.onclick = function() {
                document.getElementById('selectPeriode').value = '';
                document.getElementById('selectLevel').value = '';
                document.getElementById('laporanSaldoAwalTableBody').innerHTML = '';
                document.getElementById('totalAkun').textContent = 0;
                document.getElementById('tfootTotalDebet').textContent = 'Rp 0';
                document.getElementById('tfootTotalKredit').textContent = 'Rp 0';
                document.getElementById('statusSaldoAwal').textContent = '-';
                tampilkanBtn.classList.remove('hidden');
                downloadPdfBtn.classList.add('hidden');
                lastTableData = [];
            };
        });
    </script>
@endsection
