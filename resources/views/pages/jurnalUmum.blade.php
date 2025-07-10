@extends('components.sidebar')

@section('content')
    <div class="min-h-screen font-admin">
        <div class="">
            <div class="mb-2 flex items-center gap-3">
                <img src="images/iconJurnal.svg" class="bg-blue-500 rounded-full p-1 shadow" alt="">
                <h1 class="text-2xl md:text-3xl font-extrabold text-slate-700 tracking-tight flex items-center gap-2">
                    Jurnal Umum
                    <span class="ml-2 px-3 py-1 bg-sky-100 text-sky-700 rounded-full text-xs font-semibold shadow-sm">Admin
                        Panel</span>
                </h1>
            </div>
            <!-- Info Section pindah ke bawah header -->
            <div class="mb-6 flex items-center gap-2 text-slate-500 text-sm">
                <img src="images/iconInfo.svg" class="w-5 h-5" alt="">
                <span>Isi data jurnal umum, lalu tambahkan detail transaksi. Total debet dan kredit harus seimbang sebelum
                    simpan.</span>
            </div>

            <div class="flex flex-col md:flex-row gap-6 items-start">
                <!-- Form Input Jurnal -->
                <div class="flex-1/2 bg-white/90 border border-slate-200 rounded-lg shadow p-6 mb-6 md:mb-0">
                    <form id="formJurnalUmum" autocomplete="off">
                        <div class="grid grid-cols-1 gap-4">
                            <div>
                                <label class="block text-slate-600 text-sm font-semibold mb-1">Tanggal</label>
                                <input type="date" id="inputTanggal" name="tanggal" required
                                    class="w-full border border-slate-200 rounded-md py-2 px-3 bg-slate-50 focus:outline-none focus:border-sky-400 transition" />
                            </div>
                            <div>
                                <label class="block text-slate-600 text-sm font-semibold mb-1">Tipe</label>
                                <select id="inputTipe" name="tipe" required
                                    class="w-full border border-slate-200 rounded-md py-2 px-3 bg-slate-50 focus:outline-none focus:border-sky-400 transition">
                                    <option value="">Pilih Tipe</option>
                                    <option value="Pemasukan">Pemasukan</option>
                                    <option value="Pengeluaran">Pengeluaran</option>
                                </select>
                            </div>
                            <div>
                                <label class="block text-slate-600 text-sm font-semibold mb-1">Periode</label>
                                <select id="inputPeriode" name="periode_id" required
                                    class="w-full border border-slate-200 rounded-md py-2 px-3 bg-slate-50 focus:outline-none focus:border-sky-400 transition">
                                    <option value="">Pilih Periode</option>
                                </select>
                            </div>
                            <div>
                                <label class="block text-slate-600 text-sm font-semibold mb-1">Keterangan</label>
                                <textarea id="inputKeterangan" name="keterangan" rows="2" required
                                    class="w-full border border-slate-200 rounded-md py-2 px-3 bg-slate-50 focus:outline-none focus:border-sky-400 transition"></textarea>
                            </div>
                        </div>
                    </form>
                </div>

                <!-- Table Detail Jurnal -->
                <div class="flex-[2] bg-white rounded-xl shadow border border-slate-200 sticky top-6 self-start">
                    <div class="border-b border-slate-200 p-4 flex justify-between items-center">
                        <h2 class="font-bold text-slate-600 flex items-center gap-2">
                            <svg class="w-5 h-5 text-blue-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M9 17v-2m3 2v-4m3 4v-6m2 10H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z">
                                </path>
                            </svg>
                            Detail Transaksi
                        </h2>
                        <div class="flex items-center gap-4">
                            <div class="flex items-center gap-2 text-sm text-slate-600">
                                <span class="font-medium">Total Baris:</span>
                                <span id="totalBaris"
                                    class="px-2 py-1 bg-blue-100 text-blue-700 rounded-lg text-xs font-medium">2</span>
                            </div>
                            <div class="flex items-center gap-2 text-sm text-slate-600">
                                <span class="font-medium">Status:</span>
                                <span id="statusJurnal"
                                    class="px-2 py-1 bg-green-100 text-green-700 rounded-lg text-xs font-medium">Aktif</span>
                            </div>
                        </div>
                    </div>
                    <div class="overflow-x-auto">
                        <table class="min-w-full divide-y divide-slate-200">
                            <thead>
                                <tr class="bg-slate-50">
                                    <th
                                        class="px-6 py-3 text-left text-xs font-medium text-slate-500 uppercase tracking-wider">
                                        No</th>
                                    <th
                                        class="px-6 py-3 text-left text-xs font-medium text-slate-500 uppercase tracking-wider">
                                        Akun</th>
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
                            <tbody id="detailTableBody" class="bg-white divide-y divide-slate-200">
                                <!-- Baris detail akan diisi JS -->
                            </tbody>
                            <tfoot>
                                <tr class="bg-slate-50">
                                    <td colspan="2" class="px-6 py-4 text-right text-slate-700">Total</td>
                                    <td class="px-6 py-4 text-right text-green-700" id="tfootTotalDebet">Rp 0</td>
                                    <td class="px-6 py-4 text-right text-rose-700" id="tfootTotalKredit">Rp 0</td>
                                    <td></td>
                                </tr>
                            </tfoot>
                        </table>
                    </div>
                    <div class="flex flex-wrap gap-3 p-4 border-t border-slate-200">
                        <button type="button" id="resetDetailBtn"
                            class="bg-slate-400 hover:bg-slate-500 text-white font-semibold px-6 py-2 rounded-md shadow transition focus:outline-none focus:ring-2 focus:ring-slate-200 relative">
                            <svg class="spinner hidden animate-spin h-4 w-4 text-white absolute left-4"
                                xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                                <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor"
                                    stroke-width="4"></circle>
                                <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8v4a4 4 0 00-4 4H4z"></path>
                            </svg>
                            <span class="btn-text">Reset</span>
                        </button>
                        <button type="button" id="addDetailBtn"
                            class="bg-sky-500 hover:bg-sky-600 text-white font-semibold px-6 py-2 rounded-md shadow transition focus:outline-none focus:ring-2 focus:ring-sky-200 relative">
                            <svg class="spinner hidden animate-spin h-4 w-4 text-white absolute left-4"
                                xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                                <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor"
                                    stroke-width="4"></circle>
                                <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8v4a4 4 0 00-4 4H4z">
                                </path>
                            </svg>
                            <span class="btn-text">Tambah</span>
                        </button>
                        <button type="button" id="simpanJurnalBtn"
                            class="bg-green-500 hover:bg-green-600 text-white font-semibold px-6 py-2 rounded-md shadow transition focus:outline-none focus:ring-2 focus:ring-green-200 relative">
                            <svg class="spinner hidden animate-spin h-4 w-4 text-white absolute left-4"
                                xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                                <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor"
                                    stroke-width="4"></circle>
                                <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8v4a4 4 0 00-4 4H4z">
                                </path>
                            </svg>
                            <span class="btn-text">Simpan</span>
                        </button>
                    </div>
                </div>
            </div>
            <!-- Card Response Jurnal -->
            <div id="jurnalResponseCard" class="max-w-2xl mx-auto mt-8"></div>
        </div>
    </div>

    <script>
        const token = localStorage.getItem('token');
        const apiBaseUrl = window.apiBaseUrl || '{{ env('API_BASE_URL', 'http://localhost/api') }}';
        let coaList = [];
        let periodeList = [];
        let detailRows = [{
                akun_id: '',
                debet: '',
                kredit: ''
            },
            {
                akun_id: '',
                debet: '',
                kredit: ''
            }
        ];

        // Fungsi untuk menangani loading state
        function handleLoading(btn, action) {
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
        }

        function formatRupiah(num) {
            return 'Rp ' + Number(num || 0).toLocaleString('id-ID');
        }

        function renderPeriodeDropdown() {
            fetch(`${apiBaseUrl}/api/periode`, {
                    headers: {
                        'Authorization': `Bearer ${token}`
                    }
                })
                .then(res => res.json())
                .then(data => {
                    periodeList = data.data || data;
                    const select = document.getElementById('inputPeriode');

                    // Find active period
                    const activePeriod = periodeList.find(p => p.status && p.status.toLowerCase() === 'aktif');

                    if (activePeriod) {
                        // Only show active period and make it read-only
                        select.innerHTML =
                            `<option value="${activePeriod.id}" selected>${activePeriod.nama} (${activePeriod.tanggal_mulai} s/d ${activePeriod.tanggal_selesai}) - Aktif</option>`;
                        select.disabled = true;
                        select.classList.add('bg-slate-100', 'cursor-not-allowed');

                        // Trigger change event to update any dependent fields
                        select.dispatchEvent(new Event('change'));
                    } else {
                        // No active period found
                        select.innerHTML = '<option value="">Tidak ada periode aktif</option>';
                        select.disabled = true;
                        select.classList.add('bg-slate-100', 'cursor-not-allowed');
                    }
                });
        }

        function renderCoaDropdownOptions(selectedId) {
            return coaList.map(a =>
                `<option value="${a.id}"${a.id == selectedId ? ' selected' : ''}>${a.account_code} - ${a.account_name}</option>`
            ).join('');
        }

        function renderDetailTable() {
            const tbody = document.getElementById('detailTableBody');
            tbody.innerHTML = '';
            let totalDebet = 0,
                totalKredit = 0;
            detailRows.forEach((row, idx) => {
                totalDebet += Number(row.debet) || 0;
                totalKredit += Number(row.kredit) || 0;
                tbody.innerHTML += `
                <tr>
                    <td class="px-6 py-4 text-sm text-slate-600">${idx+1}</td>
                    <td class="px-6 py-4">
                        <select class="w-full border border-slate-200 rounded-md py-2 px-3 bg-slate-50 focus:outline-none focus:border-sky-400 transition text-sm detail-akun" data-idx="${idx}">
                            <option value="">Pilih Akun</option>
                            ${renderCoaDropdownOptions(row.akun_id)}
                        </select>
                    </td>
                    <td class="px-6 py-4 text-right">
                        <input type="number" min="0" class="w-32 border border-green-200 rounded-full px-3 py-1 text-green-700 bg-green-50 font-semibold text-sm shadow-sm focus:outline-none focus:border-green-400 text-center detail-debet" data-idx="${idx}" value="${row.debet}" />
                    </td>
                    <td class="px-6 py-4 text-right">
                        <input type="number" min="0" class="w-32 border border-rose-200 rounded-full px-3 py-1 text-rose-700 bg-rose-50 font-semibold text-sm shadow-sm focus:outline-none focus:border-rose-400 text-center detail-kredit" data-idx="${idx}" value="${row.kredit}" />
                    </td>
                    <td class="px-6 py-4 text-center">
                        <button type="button" class="bg-rose-400 hover:bg-rose-500 text-white rounded-md px-2 py-2 shadow transition focus:outline-none focus:ring-2 focus:ring-rose-200 font-semibold btn-hapus-detail" data-idx="${idx}" title="Hapus" ${detailRows.length <= 2 ? 'disabled' : ''}>
                            <img src="images/iconSampah.svg" class="w-5 min-w-5 min-h-5" alt="">
                        </button>
                    </td>
                </tr>
            `;
            });
            document.getElementById('tfootTotalDebet').textContent = formatRupiah(totalDebet);
            document.getElementById('tfootTotalKredit').textContent = formatRupiah(totalKredit);
            document.getElementById('totalBaris').textContent = detailRows.length;
        }

        function resetDetailRows() {
            detailRows = [{
                    akun_id: '',
                    debet: '',
                    kredit: ''
                },
                {
                    akun_id: '',
                    debet: '',
                    kredit: ''
                }
            ];
            renderDetailTable();
        }

        function addDetailRow() {
            detailRows.push({
                akun_id: '',
                debet: '',
                kredit: ''
            });
            renderDetailTable();
        }

        function removeDetailRow(idx) {
            if (detailRows.length > 2) {
                detailRows.splice(idx, 1);
                renderDetailTable();
            }
        }

        function updateDetailRow(idx, field, value) {
            detailRows[idx][field] = value;
            renderDetailTable();
        }

        function fetchCoaList() {
            fetch(`${apiBaseUrl}/api/coa/level-2-3`, {
                    headers: {
                        'Authorization': `Bearer ${token}`
                    }
                })
                .then(res => res.json())
                .then(data => {
                    coaList = (data.data || data).map(a => ({
                        id: a.id,
                        account_code: a.account_code,
                        account_name: a.account_name
                    }));
                    renderDetailTable();
                });
        }
        document.addEventListener('DOMContentLoaded', function() {
            renderPeriodeDropdown();
            fetchCoaList();
            renderDetailTable();
            document.getElementById('addDetailBtn').onclick = function() {
                handleLoading(this, () => {
                    addDetailRow();
                });
            };
            document.getElementById('resetDetailBtn').onclick = function() {
                handleLoading(this, () => {
                    resetDetailRows();
                });
            };
            document.getElementById('detailTableBody').addEventListener('change', function(e) {
                const idx = e.target.getAttribute('data-idx');
                if (e.target.classList.contains('detail-akun')) {
                    updateDetailRow(idx, 'akun_id', e.target.value);
                } else if (e.target.classList.contains('detail-debet')) {
                    updateDetailRow(idx, 'debet', e.target.value);
                } else if (e.target.classList.contains('detail-kredit')) {
                    updateDetailRow(idx, 'kredit', e.target.value);
                }
            });
            document.getElementById('detailTableBody').addEventListener('click', function(e) {
                if (e.target.closest('.btn-hapus-detail')) {
                    const idx = e.target.closest('.btn-hapus-detail').getAttribute('data-idx');
                    removeDetailRow(idx);
                }
            });
            document.getElementById('simpanJurnalBtn').onclick = function() {
                // Validasi
                const tanggal = document.getElementById('inputTanggal').value;
                const tipe = document.getElementById('inputTipe').value;
                const periode_id = document.getElementById('inputPeriode').value;
                const keterangan = document.getElementById('inputKeterangan').value.trim();
                if (!tanggal || !tipe || !periode_id || !keterangan) {
                    Swal.fire({
                        icon: 'warning',
                        title: 'Lengkapi Data',
                        text: 'Semua field wajib diisi.'
                    });
                    return;
                }
                if (detailRows.length < 2) {
                    Swal.fire({
                        icon: 'warning',
                        title: 'Detail Kurang',
                        text: 'Minimal 2 baris detail.'
                    });
                    return;
                }
                for (const row of detailRows) {
                    if (!row.akun_id || (!row.debet && !row.kredit)) {
                        Swal.fire({
                            icon: 'warning',
                            title: 'Detail Tidak Lengkap',
                            text: 'Semua baris harus pilih akun dan isi debet/kredit.'
                        });
                        return;
                    }
                }
                const totalDebet = detailRows.reduce((sum, r) => sum + Number(r.debet) || 0, 0);
                const totalKredit = detailRows.reduce((sum, r) => sum + Number(r.kredit) || 0, 0);
                if (totalDebet !== totalKredit) {
                    Swal.fire({
                        icon: 'error',
                        title: 'Debet ≠ Kredit',
                        text: 'Total debet dan kredit harus sama.'
                    });
                    return;
                }

                // Kirim data dengan loading state
                handleLoading(this, async () => {
                    const req = {
                        tanggal,
                        keterangan,
                        tipe,
                        periode_id: Number(periode_id),
                        details: detailRows.map(r => ({
                            akun_id: Number(r.akun_id),
                            debit: Number(r.debet) || 0,
                            kredit: Number(r.kredit) || 0
                        }))
                    };

                    try {
                        const response = await fetch(`${apiBaseUrl}/api/jurnal`, {
                            method: 'POST',
                            headers: {
                                'Content-Type': 'application/json',
                                'Authorization': `Bearer ${token}`
                            },
                            body: JSON.stringify(req)
                        });
                        const data = await response.json();

                        if (response.ok) {
                            showJurnalResponseCard(data);
                            document.getElementById('formJurnalUmum').reset();
                            resetDetailRows();
                        } else {
                            Swal.fire({
                                icon: 'error',
                                title: 'Gagal',
                                text: data.message || 'Gagal menyimpan jurnal.'
                            });
                        }
                    } catch (error) {
                        Swal.fire({
                            icon: 'error',
                            title: 'Gagal',
                            text: 'Terjadi kesalahan.'
                        });
                    }
                });
            };
        });

        function showJurnalResponseCard(data) {
            const card = `
        <div class="bg-white rounded-xl shadow border border-slate-200 p-6 flex flex-col gap-2">
            <div class="flex flex-wrap gap-4 items-center mb-2">
                <span class="text-xs font-medium text-slate-500">Nomor Jurnal</span>
                <span class="text-lg font-bold text-blue-700">${data.nomor_jurnal || '-'}</span>
                <span class="text-xs font-medium text-slate-500">Status</span>
                <span class="text-sm font-semibold ${data.status === 'Draft' ? 'text-amber-600' : 'text-green-600'}">${data.status || '-'}</span>
            </div>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-2">
                <div><span class="text-xs text-slate-500">Tanggal</span><br><span class="font-semibold text-slate-700">${data.tanggal ? data.tanggal.substring(0,10) : '-'}</span></div>
                <div><span class="text-xs text-slate-500">Tipe</span><br><span class="font-semibold text-slate-700">${data.tipe || '-'}</span></div>
                <div class="md:col-span-2"><span class="text-xs text-slate-500">Keterangan</span><br><span class="font-semibold text-slate-700">${data.keterangan || '-'}</span></div>
                <div><span class="text-xs text-slate-500">Periode</span><br><span class="font-semibold text-slate-700">${data.periode_id || '-'}</span></div>
            </div>
        </div>`;
            document.getElementById('jurnalResponseCard').innerHTML = card;
        }
    </script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
@endsection
