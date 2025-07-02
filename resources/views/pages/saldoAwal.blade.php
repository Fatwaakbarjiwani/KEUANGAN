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

                            <span id="totalAkun" class="px-2 py-1 bg-blue-100 text-blue-700 rounded-lg text-xs font-medium">
                                0
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
                    <div class="my-4 px-6 flex items-center gap-4">
                        <label for="selectPeriode" class="text-sm font-medium text-slate-600 mr-2">Pilih Periode:</label>
                        <select id="selectPeriode" class="border border-sky-400 rounded-md py-2 px-3 bg-white text-sm">
                            <option value="">-- Pilih Periode --</option>
                        </select>
                    </div>

                    <table class="min-w-full divide-y divide-slate-200">
                        <thead>
                            <tr class="bg-slate-50">
                                <th scope="col"
                                    class="px-6 py-3 text-left text-xs font-medium text-slate-500 uppercase tracking-wider">
                                    No</th>
                                <th scope="col"
                                    class="px-6 py-3 text-left text-xs font-medium text-slate-500 uppercase tracking-wider">
                                    ID Akun</th>
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
                        <tbody id="saldoAwalTableBody" class="bg-white divide-y divide-slate-200">
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
                    <div class="flex justify-end my-6 px-2">
                        <button id="submitSaldoAwal"
                            class="bg-blue-600 hover:bg-blue-700 text-white font-bold py-2 px-6 rounded-lg shadow disabled:opacity-50 disabled:cursor-not-allowed"
                            disabled>
                            Simpan Saldo Awal
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Alpine.js CDN -->
    <script src="//unpkg.com/alpinejs" defer></script>
    <script>
        window.apiBaseUrl = "{{ env('API_BASE_URL', 'http://localhost/api') }}";
        const token = localStorage.getItem('token');

        function renderCoaTable(coa, tbody) {
            tbody.innerHTML = '';
            let akunCount = 0;
            if (!coa || coa.length === 0) {
                tbody.innerHTML =
                    `<tr><td colspan="7" class="text-center text-slate-400 py-4">Data tidak ditemukan.</td></tr>`;
                document.getElementById('totalAkun').textContent = 0;
                return;
            }
            let no = 1;

            function renderRow(row, level) {
                akunCount++;
                let html = `
                    <tr>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-slate-600">${no++}</td>
                        <td class="px-6 py-4 whitespace-nowrap text-xs text-slate-400">${row.id}</td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-slate-500">${row.account_code}</td>
                        <td class="px-6 py-4 text-sm text-slate-600" style="padding-left: ${level * 24}px">
                            ${level > 0 ? `<svg class='inline w-4 h-4 mr-1 text-sky-400 align-middle' fill='none' stroke='currentColor' stroke-width='2' viewBox='0 0 24 24'><path d='M9 17v-2m3 2v-4m3 4v-6m2 10H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z' stroke-linecap='round' stroke-linejoin='round'></path></svg>` : ''}
                            ${row.account_name}
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-right"><input type="number" min="0" value="0" class="debet-input border rounded px-2 py-1 w-36 text-right" data-id="${row.id}"></td>
                        <td class="px-6 py-4 whitespace-nowrap text-right"><input type="number" min="0" value="0" class="kredit-input border rounded px-2 py-1 w-36 text-right" data-id="${row.id}"></td>
                        <td class="px-6 py-4 whitespace-nowrap text-center">-</td>
                    </tr>
                `;
                if (row.children && row.children.length > 0) {
                    row.children.forEach(child => {
                        html += renderRow(child, level + 1);
                    });
                }
                return html;
            }
            coa.forEach(row => {
                tbody.innerHTML += renderRow(row, 0);
            });
            document.getElementById('totalAkun').textContent = akunCount;
        }

        let selectedPeriodeId = null;

        function fetchAndRenderPeriodeDropdown() {
            fetch(`${window.apiBaseUrl}/api/periode`, {
                    headers: {
                        'Authorization': `Bearer ${token}`
                    }
                })
                .then(res => res.json())
                .then(data => {
                    const periodeList = data.data || data;
                    const select = document.getElementById('selectPeriode');
                    select.innerHTML = '<option value="">-- Pilih Periode --</option>';
                    periodeList.forEach(p => {
                        select.innerHTML +=
                            `<option value="${p.id}">${p.nama} (${p.tanggal_mulai} s/d ${p.tanggal_selesai})</option>`;
                    });
                });
        }

        document.addEventListener('DOMContentLoaded', function() {
            fetchAndRenderPeriodeDropdown();
            fetch(`${apiBaseUrl}/api/coa`, {
                    headers: {
                        'Authorization': `Bearer ${token}`
                    }
                })
                .then(res => res.json())
                .then(data => {
                    const coa = data.data || data;
                    renderCoaTable(coa, document.getElementById('saldoAwalTableBody'));
                });
            document.getElementById('selectPeriode').addEventListener('change', function() {
                selectedPeriodeId = this.value;
                updateTotalDebetKredit();
            });
        });

        function formatRupiah(num) {
            return 'Rp ' + Number(num).toLocaleString('id-ID');
        }

        function getSaldoAwalItems() {
            const debetInputs = document.querySelectorAll('.debet-input');
            const kreditInputs = document.querySelectorAll('.kredit-input');
            const items = [];
            debetInputs.forEach(input => {
                const jumlah = parseFloat(input.value) || 0;
                if (jumlah > 0) {
                    items.push({
                        akun_id: input.dataset.id,
                        jumlah,
                        tipe_saldo: 'Debit'
                    });
                }
            });
            kreditInputs.forEach(input => {
                const jumlah = parseFloat(input.value) || 0;
                if (jumlah > 0) {
                    items.push({
                        akun_id: input.dataset.id,
                        jumlah,
                        tipe_saldo: 'Kredit'
                    });
                }
            });
            return items;
        }

        function updateTotalDebetKredit() {
            let totalDebet = 0,
                totalKredit = 0;
            document.querySelectorAll('.debet-input').forEach(input => {
                totalDebet += parseFloat(input.value) || 0;
            });
            document.querySelectorAll('.kredit-input').forEach(input => {
                totalKredit += parseFloat(input.value) || 0;
            });
            // Update total di bawah tabel
            document.getElementById('tfootTotalDebet').textContent = formatRupiah(totalDebet);
            document.getElementById('tfootTotalKredit').textContent = formatRupiah(totalKredit);
            // Validasi: tombol submit aktif hanya jika total debet = total kredit, periode dipilih, dan > 0
            const canSubmit = totalDebet === totalKredit && totalDebet > 0 && selectedPeriodeId;
            document.getElementById('submitSaldoAwal').disabled = !canSubmit;
        }

        document.addEventListener('input', function(e) {
            if (e.target.classList.contains('debet-input') || e.target.classList.contains('kredit-input')) {
                updateTotalDebetKredit();
            }
        });

        document.getElementById('submitSaldoAwal').addEventListener('click', function() {
            if (!selectedPeriodeId) {
                Swal.fire({
                    icon: 'warning',
                    title: 'Pilih Periode',
                    text: 'Silakan pilih periode terlebih dahulu.'
                });
                return;
            }
            const items = getSaldoAwalItems();
            const totalAkun = parseInt(document.getElementById('totalAkun').textContent, 10);
            // Validasi: jumlah item yang akan dikirim harus sama dengan jumlah akun di tabel
            if (items.length === 0) {
                Swal.fire({
                    icon: 'warning',
                    title: 'Data Kosong',
                    text: 'Isi nominal debet/kredit terlebih dahulu.'
                });
                return;
            }
            fetch(`${window.apiBaseUrl}/api/saldo-awal/batch`, {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'Authorization': `Bearer ${token}`
                    },
                    body: JSON.stringify({
                        periode_id: selectedPeriodeId,
                        items
                    })
                })
                .then(res => res.json())
                .then(data => {
                    // Penanganan error 422 akun_id_duplikat
                    if (data.error && Array.isArray(data.akun_id_duplikat)) {
                        Swal.fire({
                            icon: 'error',
                            title: 'Gagal',
                            html: `
                            <div>${data.error}</div>
                            <div class="mt-2 text-sm text-slate-700">
                                Akun duplikat: <b>${data.akun_id_duplikat.join(', ')}</b>
                            </div>
                        `,
                            confirmButtonColor: '#ef4444'
                        });
                        document.querySelectorAll('.debet-input, .kredit-input').forEach(input => {
                            if (data.akun_id_duplikat.includes(input.dataset.id)) {
                                input.classList.add('border-red-500', 'ring-2', 'ring-red-200');
                            } else {
                                input.classList.remove('border-red-500', 'ring-2', 'ring-red-200');
                            }
                        });
                        return;
                    }
                    // Sukses seperti biasa
                    const isSuccess = data && data.data && Array.isArray(data.data);
                    const message = data.message || (isSuccess ? 'Saldo awal berhasil disimpan.' :
                        'Gagal menyimpan saldo awal');
                    Swal.fire({
                        icon: isSuccess ? 'success' : 'error',
                        title: isSuccess ? 'Berhasil' : 'Gagal',
                        text: message,
                        confirmButtonColor: isSuccess ? '#2563eb' : '#ef4444'
                    });
                    if (isSuccess) {
                        // Reset input dan highlight
                        document.querySelectorAll('.debet-input, .kredit-input').forEach(input => {
                            input.value = 0;
                            input.classList.remove('border-red-500', 'ring-2', 'ring-red-200');
                        });
                        updateTotalDebetKredit();
                    }
                });
        });
    </script>
@endsection
