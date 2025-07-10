@extends('components.sidebar')

@section('content')
    <div class="min-h-screen font-admin">
        <div>
            <div class="flex items-center">
                <h1 class="text-3xl gap-2 font-extrabold text-slate-700 flex items-center tracking-tight">
                    <img src="images/iconBank.svg" class="bg-blue-500 rounded-full p-1 shadow" alt="">
                    Chart of Account (CoA)
                </h1>
                <span class="ml-4 px-3 py-1 bg-sky-100 text-sky-700 rounded-full text-xs font-semibold shadow-sm">
                    Admin Panel
                </span>
            </div>

            <!-- Info Section -->
            <div class="mb-4 flex flex-col md:flex-row md:items-center md:justify-between gap-4">
                <div class="flex items-center gap-2 text-slate-500 text-sm">
                    <svg class="w-5 h-5 text-sky-400" fill="none" stroke="currentColor" stroke-width="2"
                        viewBox="0 0 24 24">
                        <path d="M13 16h-1v-4h-1m1-4h.01M12 20a8 8 0 100-16 8 8 0 000 16z" stroke-linecap="round"
                            stroke-linejoin="round" />
                    </svg>
                    <span>Kelola akun keuangan, filter berdasarkan tipe, dan tambahkan akun baru dengan mudah.</span>
                </div>
                <!-- Search by Tipe Akun -->
                <div class="mb-4">
                    <label for="filterType" class="text-sm font-medium text-slate-600 mr-2">Filter Tipe Akun:</label>
                    <select id="filterType" class="border border-sky-400 rounded-md py-2 px-3 bg-white text-sm">
                        <option value="">Semua</option>
                        <option value="asset">Asset</option>
                        <option value="kewajiban">Kewajiban</option>
                        <option value="ekuitas">Ekuitas</option>
                        <option value="pendapatan">Pendapatan</option>
                        <option value="beban">Beban</option>
                    </select>
                </div>
            </div>

            @if (session('success'))
                <div class="mb-4 p-3 rounded bg-green-100 text-green-800 border border-green-200">{{ session('success') }}
                </div>
            @endif
            @if (session('error'))
                <div class="mb-4 p-3 rounded bg-red-100 text-red-800 border border-red-200">{{ session('error') }}</div>
            @endif

            <!-- Form Tambah Data Baru -->
            <div class="bg-white/90 shadow border border-slate-200 rounded-lg mb-8 p-6 w-full">
                <h2 class="text-base font-semibold text-sky-700 mb-4 flex items-center">
                    <svg class="w-5 h-5 mr-2 text-green-400" fill="none" stroke="currentColor" stroke-width="2"
                        viewBox="0 0 24 24">
                        <path d="M12 5v14m7-7H5" stroke-linecap="round" stroke-linejoin="round" />
                    </svg>
                    Tambah Akun Baru
                </h2>
                <form id="formTambahCoa" autocomplete="off">
                    <div class="grid grid-cols-1 md:grid-cols-3 gap-4 mb-4">
                        <div>
                            <label class="block text-slate-600 mb-1 text-sm">Kode Akun</label>
                            <input type="text" name="account_code" placeholder="Kode Akun" required
                                class="w-full text-sm border border-slate-200 rounded-md focus:border-sky-400 focus:ring focus:ring-sky-100 focus:outline-none py-2 px-3 bg-slate-50 transition" />
                        </div>
                        <div>
                            <label class="block text-slate-600 mb-1 text-sm">Nama Akun</label>
                            <input type="text" name="account_name" placeholder="Nama Akun" required
                                class="w-full text-sm border border-slate-200 rounded-md focus:border-sky-400 focus:ring focus:ring-sky-100 focus:outline-none py-2 px-3 bg-slate-50 transition" />
                        </div>
                        <div>
                            <label class="block text-slate-600 mb-1 text-sm">Level</label>
                            <select name="level" required
                                class="text-sm w-full border border-slate-200 rounded-md focus:border-sky-400 focus:ring focus:ring-sky-100 focus:outline-none py-2 px-3 bg-slate-50 transition">
                                <option value="">Pilih Level</option>
                                <option value="1">1</option>
                                <option value="2">2</option>
                                <option value="3">3</option>
                            </select>
                        </div>
                    </div>
                    <div class="grid grid-cols-1 md:grid-cols-4 gap-4 items-end">
                        <div>
                            <label class="block text-slate-600 mb-1 text-sm">Parent ID</label>
                            <input type="number" name="parent_id" placeholder="Parent ID (opsional)"
                                class="w-full text-sm border border-slate-200 rounded-md focus:border-sky-400 focus:ring focus:ring-sky-100 focus:outline-none py-2 px-3 bg-slate-50 transition" />
                        </div>
                        <div>
                            <label class="block text-slate-600 mb-1 text-sm">Tipe Akun</label>
                            <select name="account_type" required
                                class="text-sm w-full border border-slate-200 rounded-md focus:border-sky-400 focus:ring focus:ring-sky-100 focus:outline-none py-2 px-3 bg-slate-50 transition">
                                <option value="">Pilih Tipe</option>
                                <option value="Asset">Asset</option>
                                <option value="Kewajiban">Kewajiban</option>
                                <option value="Ekuitas">Ekuitas</option>
                                <option value="Pendapatan">Pendapatan</option>
                                <option value="Beban">Beban</option>
                            </select>
                        </div>
                        <div>
                            <label class="block text-slate-600 mb-1 text-sm">Status</label>
                            <select name="is_active" required
                                class="text-sm w-full border border-slate-200 rounded-md focus:border-sky-400 focus:ring focus:ring-sky-100 focus:outline-none py-2 px-3 bg-slate-50 transition">
                                <option value="1">Aktif</option>
                                <option value="0">Tidak Aktif</option>
                            </select>
                        </div>
                        <div class="md:col-span-1">
                            <button type="submit"
                                class="flex items-center text-sm bg-sky-500 hover:bg-sky-600 text-white py-2 px-4 rounded-md shadow transition focus:outline-none focus:ring-2 focus:ring-sky-200 w-full justify-center mt-6 md:mt-0 relative">
                                <svg class="spinner hidden animate-spin h-4 w-4 text-white absolute left-4"
                                    xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                                    <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor"
                                        stroke-width="4"></circle>
                                    <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8v4a4 4 0 00-4 4H4z">
                                    </path>
                                </svg>
                                <span class="btn-text">Tambah</span>
                            </button>
                        </div>
                    </div>
                </form>
                <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
                <script>
                    const token = localStorage.getItem('token');
                    const apiBaseUrl = @json($apiBaseUrl);

                    // Fungsi untuk menangani loading state
                    function handleLoading(btn, action) {
                        const spinner = btn.querySelector('.spinner');
                        const btnText = btn.querySelector('.btn-text');
                        const originalText = btnText ? btnText.textContent : null;

                        spinner.classList.remove('hidden');
                        if (btnText) btnText.textContent = 'Loading...';
                        btn.disabled = true;

                        return Promise.resolve(action())
                            .finally(() => {
                                spinner.classList.add('hidden');
                                if (btnText) btnText.textContent = originalText;
                                btn.disabled = false;
                            });
                    }

                    function fetchAndRenderCoa() {
                        fetch(`${apiBaseUrl}/api/coa`, {
                                headers: {
                                    'Authorization': `Bearer ${token}`
                                }
                            })
                            .then(res => res.json())
                            .then(data => {
                                const coa = data.data || data;
                                renderCoaTable(coa);
                            });
                    }

                    document.addEventListener('DOMContentLoaded', function() {
                        const form = document.getElementById('formTambahCoa');
                        form.onsubmit = function(e) {
                            e.preventDefault();
                            const submitBtn = form.querySelector('button[type="submit"]');

                            handleLoading(submitBtn, async () => {
                                // Ambil data input manual
                                const account_code = form.querySelector('[name="account_code"]').value.trim();
                                const account_name = form.querySelector('[name="account_name"]').value.trim();
                                const level = form.querySelector('[name="level"]').value;
                                const parent_id = form.querySelector('[name="parent_id"]').value;
                                const account_type = form.querySelector('[name="account_type"]').value;
                                const is_active = form.querySelector('[name="is_active"]').value;
                                // Validasi sederhana
                                if (!account_code || !account_name || !level || !account_type || !is_active) {
                                    Swal.fire({
                                        icon: 'warning',
                                        title: 'Peringatan',
                                        text: 'Semua field wajib diisi!',
                                        confirmButtonColor: '#ef4444'
                                    });
                                    return;
                                }
                                // Siapkan data untuk dikirim
                                const data = {
                                    account_code,
                                    account_name,
                                    level,
                                    parent_id,
                                    account_type,
                                    is_active
                                };
                                const response = await fetch(`${apiBaseUrl}/api/coa/create`, {
                                    method: 'POST',
                                    headers: {
                                        'Content-Type': 'application/json',
                                        'Authorization': `Bearer ${token}`
                                    },
                                    body: JSON.stringify(data)
                                });
                                const responseData = await response.json();
                                const isSuccess = response.ok;

                                Swal.fire({
                                    icon: isSuccess ? 'success' : 'error',
                                    title: isSuccess ? 'Berhasil' : 'Gagal',
                                    text: responseData.message || (isSuccess ?
                                        'Akun berhasil ditambahkan.' :
                                        'Gagal menambah akun'),
                                    confirmButtonColor: isSuccess ? '#2563eb' : '#ef4444'
                                }).then(() => {
                                    if (isSuccess) {
                                        form.reset();
                                        fetchAndRenderCoa();
                                    }
                                });
                            });
                        };
                    });
                </script>
            </div>

            <!-- Table Data COA -->
            <div class="bg-white rounded-lg shadow border border-slate-200">
                <div class="border-b border-slate-200 p-4 flex justify-between items-center">
                    <h2 class="font-bold text-slate-600 flex items-center gap-2">
                        <svg class="w-5 h-5 text-blue-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M9 17v-2m3 2v-4m3 4v-6m2 10H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z">
                            </path>
                        </svg>
                        Data Chart of Account
                    </h2>
                    <span class="text-xs text-slate-400">Klik tombol edit/hapus untuk mengelola data</span>
                </div>

                <!-- Table -->
                <div class="overflow-x-auto">
                    <table class="min-w-full divide-y divide-slate-200">
                        <thead>
                            <tr class="bg-slate-50">
                                <th scope="col"
                                    class="px-6 py-3 text-left text-xs font-medium text-slate-500 uppercase tracking-wider">
                                    ID</th>
                                <th scope="col"
                                    class="px-6 py-3 text-left text-xs font-medium text-slate-500 uppercase tracking-wider">
                                    Kode Akun</th>
                                <th scope="col"
                                    class="px-6 py-3 text-left text-xs font-medium text-slate-500 uppercase tracking-wider">
                                    Nama Akun</th>
                                <th scope="col"
                                    class="px-6 py-3 text-left text-xs font-medium text-slate-500 uppercase tracking-wider">
                                    Tipe Akun</th>
                                <th scope="col"
                                    class="px-6 py-3 text-center text-xs font-medium text-slate-500 uppercase tracking-wider">
                                    Aksi</th>
                            </tr>
                        </thead>
                        <tbody id="coaTableBody" class="bg-white divide-y divide-slate-200">
                            <!-- Data akan diisi oleh JavaScript -->
                        </tbody>
                    </table>
                </div>
            </div>

            <!-- Modal Edit COA -->
            <div id="modalEditCoa"
                class="fixed inset-0 z-50 flex items-center justify-center bg-black bg-opacity-30 hidden">
                <div class="bg-white rounded-lg shadow-lg w-full max-w-lg p-6 relative">
                    <button id="closeModalEditCoa" class="absolute top-2 right-2 text-slate-400 hover:text-slate-600">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
                        </svg>
                    </button>
                    <h3 class="text-lg font-semibold text-slate-700 mb-4">Edit Akun COA</h3>
                    <form id="formEditCoa" class="grid grid-cols-1 gap-4">
                        <input type="hidden" name="id" id="edit_coa_id">
                        <div>
                            <label class="block text-slate-600 mb-1 text-sm font-medium">Kode Akun</label>
                            <input type="text" name="account_code" id="edit_account_code" required
                                class="w-full border border-slate-200 rounded-lg text-sm py-2 px-3" />
                        </div>
                        <div>
                            <label class="block text-slate-600 mb-1 text-sm font-medium">Nama Akun</label>
                            <input type="text" name="account_name" id="edit_account_name" required
                                class="w-full border border-slate-200 rounded-lg text-sm py-2 px-3" />
                        </div>
                        <div>
                            <label class="block text-slate-600 mb-1 text-sm font-medium">Level</label>
                            <select name="level" id="edit_level" required
                                class="w-full border border-slate-200 rounded-lg text-sm py-2 px-3">
                                <option value="1">1</option>
                                <option value="2">2</option>
                                <option value="3">3</option>
                            </select>
                        </div>
                        <div>
                            <label class="block text-slate-600 mb-1 text-sm font-medium">Parent ID</label>
                            <input type="number" name="parent_id" id="edit_parent_id"
                                class="w-full border border-slate-200 rounded-lg text-sm py-2 px-3" />
                        </div>
                        <div>
                            <label class="block text-slate-600 mb-1 text-sm font-medium">Tipe Akun</label>
                            <select name="account_type" id="edit_account_type" required
                                class="w-full border border-slate-200 rounded-lg text-sm py-2 px-3">
                                <option value="Asset">Asset</option>
                                <option value="Kewajiban">Kewajiban</option>
                                <option value="Ekuitas">Ekuitas</option>
                                <option value="Pendapatan">Pendapatan</option>
                                <option value="Beban">Beban</option>
                            </select>
                        </div>
                        <div>
                            <label class="block text-slate-600 mb-1 text-sm font-medium">Status</label>
                            <select name="is_active" id="edit_is_active" required
                                class="w-full border border-slate-200 rounded-lg text-sm py-2 px-3">
                                <option value="true">Aktif</option>
                                <option value="false">Tidak Aktif</option>
                            </select>
                        </div>
                        <div>
                            <button type="submit"
                                class="w-full bg-blue-500 hover:bg-blue-600 text-white font-medium py-2 px-4 rounded-lg mt-2 relative">
                                <svg class="spinner hidden animate-spin h-4 w-4 text-white absolute left-4"
                                    xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                                    <circle class="opacity-25" cx="12" cy="12" r="10"
                                        stroke="currentColor" stroke-width="4"></circle>
                                    <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8v4a4 4 0 00-4 4H4z">
                                    </path>
                                </svg>
                                <span class="btn-text">Simpan Perubahan</span>
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <script>
        document.getElementById('filterType').addEventListener('change', function() {
            const type = this.value;
            let url = `${apiBaseUrl}/api/coa`;
            if (type) url += `?type=${type}`;
            fetch(url, {
                    headers: {
                        'Authorization': `Bearer ${token}`
                    }
                })
                .then(res => res.json())
                .then(data => {

                    const coa = data.data || data;
                    renderCoaTable(coa);
                });
        });

        function renderCoaTable(coa) {
            const tbody = document.getElementById('coaTableBody');
            tbody.innerHTML = '';
            if (!coa || coa.length === 0) {
                tbody.innerHTML =
                    `<tr><td colspan="5" class="text-center text-slate-400 py-4">Data tidak ditemukan.</td></tr>`;
                return;
            }
            coa.forEach(row => {
                tbody.innerHTML += renderCoaRow(row, 0);
            });
        }

        function renderCoaRow(row, level) {
            let html = `
        <tr class="hover:bg-slate-50">
            <td class="px-6 py-4 whitespace-nowrap text-sm text-slate-600">${row.id ?? '-'}</td>
            <td class="px-6 py-4 whitespace-nowrap text-sm text-slate-500">${row.account_code}</td>
            <td class="px-6 py-4 text-sm text-slate-600" style="padding-left: ${level * 24}px">
                ${level > 0 ? `<svg class='inline w-4 h-4 mr-1 text-sky-400 align-middle' fill='none' stroke='currentColor' stroke-width='2' viewBox='0 0 24 24'><path d='M9 17v-2m3 2v-4m3 4v-6m2 10H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z' stroke-linecap='round' stroke-linejoin='round'></path></svg>` : ''}
                ${row.account_name}
            </td>
            <td class="px-6 py-4 whitespace-nowrap">
                <span class="inline-flex px-2 py-1 text-xs rounded-full ${
                    row.account_type === 'Asset' ? 'bg-green-100 text-green-800' :
                    row.account_type === 'Kewajiban' ? 'bg-yellow-100 text-yellow-800' :
                    row.account_type === 'Ekuitas' ? 'bg-blue-100 text-blue-800' :
                    row.account_type === 'Pendapatan' ? 'bg-sky-100 text-sky-800' :
                    'bg-red-100 text-red-800'
                }">${row.account_type}</span>
            </td>
            <td class="px-6 py-4 whitespace-nowrap text-center">
                <div class="flex justify-center space-x-2">
                    <button type="button" class="btn-edit-coa bg-amber-400 hover:bg-amber-500 text-white py-1 px-3 rounded-md shadow-sm transition focus:outline-none focus:ring-2 focus:ring-amber-200 relative" data-id="${row.id}" title="Edit Akun">
                        <svg class="spinner hidden animate-spin h-4 w-4 text-white absolute left-1" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                            <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                            <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8v4a4 4 0 00-4 4H4z"></path>
                        </svg>
                        <img src="images/iconEdit.svg" class="min-w-4 min-h-4 w-5 btn-icon" alt="">
                    </button>
                    <button type="button" class="btn-delete-coa bg-rose-400 hover:bg-rose-500 text-white py-1 px-3 rounded-md shadow-sm transition focus:outline-none focus:ring-2 focus:ring-rose-200" data-id="${row.id}" title="Hapus Akun">
                        <img src="images/iconSampah.svg" class="min-w-4 min-h-4 w-5" alt="">
                    </button>
                </div>
            </td>
        </tr>
        `;
            if (row.children && row.children.length > 0) {
                row.children.forEach(child => {
                    html += renderCoaRow(child, level + 1);
                });
            }
            return html;
        }

        // Event delegation untuk tombol edit COA
        document.getElementById('coaTableBody').addEventListener('click', function(e) {
            const btnEdit = e.target.closest('.btn-edit-coa');
            if (btnEdit) {
                const id = btnEdit.getAttribute('data-id');
                fetch(`${apiBaseUrl}/api/coa/${id}`, {
                        headers: {
                            'Authorization': `Bearer ${token}`
                        }
                    })
                    .then(res => res.json())
                    .then(data => {
                        const d = data.data || data;
                        document.getElementById('edit_coa_id').value = d.id;
                        document.getElementById('edit_account_code').value = d.account_code;
                        document.getElementById('edit_account_name').value = d.account_name;
                        document.getElementById('edit_level').value = d.level;
                        document.getElementById('edit_parent_id').value = d.parent_id ?? '';
                        document.getElementById('edit_account_type').value = d.account_type;
                        document.getElementById('edit_is_active').value = d.is_active ? 'true' : 'false';
                        document.getElementById('modalEditCoa').classList.remove('hidden');
                    });
                return;
            }
            const btnDelete = e.target.closest('.btn-delete-coa');
            if (btnDelete) {
                const id = btnDelete.getAttribute('data-id');
                // console.log(id);

                Swal.fire({
                    title: 'Hapus Akun COA?',
                    text: 'Data yang dihapus tidak dapat dikembalikan!',
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#ef4444',
                    cancelButtonColor: '#6b7280',
                    confirmButtonText: 'Ya, hapus!'
                }).then((result) => {
                    if (result.isConfirmed) {
                        fetch(`${apiBaseUrl}/api/coa/${id}`, {
                                method: 'DELETE',
                                headers: {
                                    'Authorization': `Bearer ${token}`
                                }
                            })
                            .then(res => {
                                const isSuccess = res.ok;
                                return res.json().then(data => ({
                                    data,
                                    isSuccess
                                }));
                            })
                            .then(({
                                data,
                                isSuccess
                            }) => {
                                Swal.fire({
                                    icon: isSuccess ? 'success' : 'error',
                                    title: isSuccess ? 'Berhasil' : 'Gagal',
                                    text: data.message || (isSuccess ?
                                        'Akun berhasil dihapus.' : 'Gagal menghapus akun'),
                                    confirmButtonColor: isSuccess ? '#2563eb' : '#ef4444'
                                }).then(() => {
                                    if (isSuccess) fetchAndRenderCoa();
                                });
                            })
                            .catch(() => {
                                Swal.fire({
                                    icon: 'error',
                                    title: 'Gagal',
                                    text: 'Terjadi kesalahan',
                                    confirmButtonColor: '#ef4444'
                                });
                            });
                    }
                });
            }
        });

        // Tutup modal
        document.getElementById('closeModalEditCoa').onclick = function() {
            document.getElementById('modalEditCoa').classList.add('hidden');
        };
        document.getElementById('modalEditCoa').addEventListener('click', function(e) {
            if (e.target === this) this.classList.add('hidden');
        });

        // Submit edit
        document.getElementById('formEditCoa').onsubmit = function(e) {
            e.preventDefault();
            const submitBtn = this.querySelector('button[type="submit"]');

            handleLoading(submitBtn, async () => {
                const id = document.getElementById('edit_coa_id').value;
                const body = {
                    account_code: document.getElementById('edit_account_code').value,
                    account_name: document.getElementById('edit_account_name').value,
                    level: parseInt(document.getElementById('edit_level').value),
                    parent_id: document.getElementById('edit_parent_id').value ? parseInt(document
                        .getElementById('edit_parent_id').value) : null,
                    account_type: document.getElementById('edit_account_type').value,
                    is_active: document.getElementById('edit_is_active').value === 'true'
                };
                const response = await fetch(`${apiBaseUrl}/api/coa/${id}`, {
                    method: 'PUT',
                    headers: {
                        'Content-Type': 'application/json',
                        'Authorization': `Bearer ${token}`
                    },
                    body: JSON.stringify(body)
                });
                const responseData = await response.json();
                const isSuccess = response.ok;

                Swal.fire({
                    icon: isSuccess ? 'success' : 'error',
                    title: isSuccess ? 'Berhasil' : 'Gagal',
                    text: responseData.message || (isSuccess ? 'Akun berhasil diupdate.' :
                        'Gagal update akun'),
                    confirmButtonColor: isSuccess ? '#2563eb' : '#ef4444'
                }).then(() => {
                    if (isSuccess) {
                        document.getElementById('modalEditCoa').classList.add('hidden');
                        fetchAndRenderCoa();
                    }
                });
            });
        };

        // Ambil data COA saat halaman pertama kali dimuat
        document.addEventListener('DOMContentLoaded', function() {
            fetchAndRenderCoa()
        });
    </script>
@endsection
