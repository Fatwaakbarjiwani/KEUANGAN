@extends('components.sidebar')

@section('content')
    <div class="min-h-screen bg-gray-50/30 font-admin">
        <!-- Header -->
        <div class="">
            <div class="mb-8">
                <div class="flex items-center gap-3">
                    <div class="bg-blue-500 rounded-full p-2 shadow-lg">
                        <img src="images/iconPeriode.svg" class="w-8 h-8" alt="">
                    </div>
                    <div>
                        <h1 class="text-3xl font-extrabold text-slate-700 tracking-tight">Setting Periode</h1>
                        <p class="text-slate-500 mt-1">Kelola periode akuntansi dan status pembukuan</p>
                    </div>
                    <span class="ml-auto px-3 py-1 bg-sky-100 text-sky-700 rounded-full text-xs font-semibold shadow-sm">
                        Admin Panel
                    </span>
                </div>
            </div>

            <!-- Info Cards -->
            <div class="grid grid-cols-1 md:grid-cols-4 gap-6 mb-8">
                <div class="bg-white rounded-xl shadow border border-slate-200 p-4">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-xs font-medium text-slate-600">Periode Aktif</p>
                            @php $aktif = collect($periode)->firstWhere('status', 'aktif'); @endphp
                            <p class="text-lg font-bold text-slate-700 mt-1">{{ $aktif['nama'] ?? '-' }}</p>
                            <p class="text-xs text-green-600 mt-1">
                                @if ($aktif)
                                    {{ $aktif['tanggal_mulai'] }} s/d {{ $aktif['tanggal_selesai'] }}
                                @else
                                    Tidak ada periode aktif
                                @endif
                            </p>
                        </div>
                        <div class="bg-green-100 rounded-full p-2 flex items-center justify-center">
                            <svg class="w-6 h-6 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                            </svg>
                        </div>
                    </div>
                </div>

                <div class="bg-white rounded-xl shadow border border-slate-200 p-4">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-xs font-medium text-slate-600">Total Periode</p>
                            <p class="text-lg font-bold text-slate-700 mt-1">{{ count($periode) }}</p>
                            <p class="text-xs text-blue-600 mt-1">Periode tersedia</p>
                        </div>
                        <div class="bg-blue-100 rounded-full p-2 flex items-center justify-center">
                            <svg class="w-6 h-6 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z">
                                </path>
                            </svg>
                        </div>
                    </div>
                </div>

                <div class="bg-white rounded-xl shadow border border-slate-200 p-4">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-xs font-medium text-slate-600">Periode Tertutup</p>
                            @php $tertutup = collect($periode)->where('status', 'tutup')->count(); @endphp
                            <p class="text-lg font-bold text-slate-700 mt-1">{{ $tertutup }}</p>
                            <p class="text-xs text-slate-600 mt-1">Periode selesai</p>
                        </div>
                        <div class="bg-slate-100 rounded-full p-2 flex items-center justify-center">
                            <svg class="w-6 h-6 text-slate-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M6 18L18 6M6 6l12 12"></path>
                            </svg>
                        </div>
                    </div>
                </div>

                <div class="bg-white rounded-xl shadow border border-slate-200 p-4">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-xs font-medium text-slate-600">Status Sistem</p>
                            <p class="text-lg font-bold {{ $aktif ? 'text-green-600' : 'text-slate-600' }} mt-1">
                                {{ $aktif ? 'Aktif' : 'Tutup' }}
                            </p>
                            <p class="text-xs {{ $aktif ? 'text-green-500' : 'text-slate-500' }} mt-1">
                                {{ $aktif ? '✓ Sistem berjalan normal' : 'Sistem tidak aktif' }}
                            </p>
                        </div>
                        <div
                            class="{{ $aktif ? 'bg-green-100' : 'bg-slate-100' }} rounded-full p-2 flex items-center justify-center">
                            <svg class="w-6 h-6 {{ $aktif ? 'text-green-600' : 'text-slate-600' }}" fill="none"
                                stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M13 10V3L4 14h7v7l9-11h-7z"></path>
                            </svg>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Form Tambah Periode Baru -->
            <div class="bg-white rounded-xl shadow border border-slate-200 p-6 mb-8">
                <h3 class="text-lg font-semibold text-slate-700 mb-4 flex items-center">
                    <svg class="w-5 h-5 mr-2 text-green-400" fill="none" stroke="currentColor" stroke-width="2"
                        viewBox="0 0 24 24">
                        <path d="M12 5v14m7-7H5" stroke-linecap="round" stroke-linejoin="round" />
                    </svg>
                    Tambah Periode Baru
                </h3>
                <form method="POST" action="{{ route('periode.store') }}"
                    class="grid grid-cols-1 md:grid-cols-4 gap-4 items-end">
                    @csrf
                    <div>
                        <label class="block text-slate-600 mb-1 text-sm font-medium">Nama Periode</label>
                        <input type="text" name="nama" placeholder="Contoh: 2024" required
                            class="w-full border border-slate-200 rounded-lg focus:border-blue-500 focus:ring-blue-500 text-sm py-2 px-3" />
                    </div>
                    <div>
                        <label class="block text-slate-600 mb-1 text-sm font-medium">Tanggal Mulai</label>
                        <input type="date" name="tanggal_mulai" required
                            class="w-full border border-slate-200 rounded-lg focus:border-blue-500 focus:ring-blue-500 text-sm py-2 px-3" />
                    </div>
                    <div>
                        <label class="block text-slate-600 mb-1 text-sm font-medium">Tanggal Selesai</label>
                        <input type="date" name="tanggal_selesai" required
                            class="w-full border border-slate-200 rounded-lg focus:border-blue-500 focus:ring-blue-500 text-sm py-2 px-3" />
                    </div>
                    <div>
                        <label class="block text-slate-600 mb-1 text-sm font-medium">Status</label>
                        <select name="status" required
                            class="w-full border border-slate-200 rounded-lg focus:border-blue-500 focus:ring-blue-500 text-sm py-2 px-3">
                            <option value="Aktif">Aktif</option>
                            <option value="Tutup">Tutup</option>
                        </select>
                    </div>
                    <div>
                        <button type="submit"
                            class="w-full bg-blue-500 hover:bg-blue-600 text-white font-medium py-2 px-4 rounded-lg transition focus:outline-none focus:ring-2 focus:ring-blue-200 mt-6 md:mt-0">
                            Tambah Periode
                        </button>
                    </div>
                </form>
            </div>

            <!-- Periode Table -->
            <div class="bg-white rounded-xl shadow border border-slate-200">
                <div class="border-b border-slate-200 p-4 flex justify-between items-center">
                    <h2 class="font-bold text-slate-600 flex items-center gap-2">
                        <svg class="w-5 h-5 text-blue-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z">
                            </path>
                        </svg>
                        Daftar Periode Akuntansi
                    </h2>
                    <div class="flex items-center gap-4">
                        <div class="flex items-center gap-2 text-sm text-slate-600">
                            <span class="font-medium">Total Periode:</span>
                            <span class="px-2 py-1 bg-blue-100 text-blue-700 rounded-lg text-xs font-medium">
                                {{ count($periode) }}
                            </span>
                        </div>
                        <div class="flex items-center gap-2 text-sm text-slate-600">
                            <span class="font-medium">Status:</span>
                            <span class="px-2 py-1 bg-green-100 text-green-700 rounded-lg text-xs font-medium">
                                {{ collect($periode)->where('status', 'aktif')->count() > 0 ? 'Aktif' : 'Tutup' }}
                            </span>
                        </div>
                    </div>
                </div>

                <!-- Table -->
                <div class="overflow-x-auto">
                    <table class="min-w-full divide-y divide-slate-200">
                        <thead>
                            <tr class="bg-slate-50">
                                <th scope="col"
                                    class="px-6 py-3 text-left text-xs font-medium text-slate-500 uppercase tracking-wider">
                                    No</th>
                                <th scope="col"
                                    class="px-6 py-3 text-left text-xs font-medium text-slate-500 uppercase tracking-wider">
                                    Nama</th>
                                <th scope="col"
                                    class="px-6 py-3 text-left text-xs font-medium text-slate-500 uppercase tracking-wider">
                                    Tanggal Mulai</th>
                                <th scope="col"
                                    class="px-6 py-3 text-left text-xs font-medium text-slate-500 uppercase tracking-wider">
                                    Tanggal Selesai</th>
                                <th scope="col"
                                    class="px-6 py-3 text-center text-xs font-medium text-slate-500 uppercase tracking-wider">
                                    Status</th>
                                <th scope="col"
                                    class="px-6 py-3 text-center text-xs font-medium text-slate-500 uppercase tracking-wider">
                                    Aksi</th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-slate-200">
                            @forelse($periode as $i => $row)
                                <tr class="hover:bg-slate-50">
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-slate-600">{{ $i + 1 }}
                                    </td>
                                    <td class="px-6 py-4 text-sm text-slate-700">{{ $row['nama'] }}</td>
                                    <td class="px-6 py-4 text-sm text-slate-600">{{ $row['tanggal_mulai'] }}</td>
                                    <td class="px-6 py-4 text-sm text-slate-600">{{ $row['tanggal_selesai'] }}</td>
                                    <td class="px-6 py-4 text-center">
                                        <span
                                            class="inline-flex px-2 py-1 text-xs rounded-full
                                            @if ($row['status'] == 'aktif') bg-green-100 text-green-800
                                            @else bg-slate-100 text-slate-700 @endif">
                                            {{ ucfirst($row['status']) }}
                                        </span>
                                    </td>
                                    <td class="px-6 py-4 text-center">
                                        <div class="flex justify-center space-x-2">
                                            <button type="button"
                                                class="bg-amber-400 hover:bg-amber-500 text-white py-1 px-3 rounded-md shadow-sm transition focus:outline-none focus:ring-2 focus:ring-amber-200 btn-edit-periode"
                                                data-id="{{ $row['id'] }}" title="Edit Periode">
                                                <img src="/images/iconEdit.svg" alt="">
                                            </button>
                                            <button type="button"
                                                class="bg-rose-400 hover:bg-rose-500 text-white py-1 px-3 rounded-md shadow-sm transition focus:outline-none focus:ring-2 focus:ring-rose-200 btn-delete-periode"
                                                title="Hapus Periode" data-id="{{ $row['id'] }}">
                                                <img src="/images/iconSampah.svg" alt="">
                                            </button>
                                        </div>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="6" class="px-6 py-4 text-center text-slate-400">Data tidak ditemukan.
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    @if (session('success'))
        <script>
            Swal.fire({
                icon: 'success',
                title: 'Berhasil',
                text: @json(session('success')),
                confirmButtonColor: '#2563eb'
            });
        </script>
    @endif
    @if (session('error'))
        <script>
            let msg = @json(session('error'));
            let isSuccess = msg.toLowerCase().includes('berhasil');
            Swal.fire({
                icon: isSuccess ? 'success' : 'error',
                title: isSuccess ? 'Berhasil' : 'Gagal',
                text: msg,
                confirmButtonColor: isSuccess ? '#2563eb' : '#ef4444'
            });
        </script>
    @endif
    <!-- Modal Edit Periode -->
    <div id="modalEditPeriode" class="fixed inset-0 z-50 flex items-center justify-center bg-black bg-opacity-30 hidden">
        <div class="bg-white rounded-lg shadow-lg w-full max-w-lg p-6 relative">
            <button id="closeModalEdit" class="absolute top-2 right-2 text-slate-400 hover:text-slate-600">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
                </svg>
            </button>
            <h3 class="text-lg font-semibold text-slate-700 mb-4">Edit Periode</h3>
            <form id="formEditPeriode" class="grid grid-cols-1 gap-4">
                <input type="hidden" name="id" id="edit_id">
                <div>
                    <label class="block text-slate-600 mb-1 text-sm font-medium">Nama Periode</label>
                    <input type="text" name="nama" id="edit_nama" required
                        class="w-full border border-slate-200 rounded-lg focus:border-blue-500 focus:ring-blue-500 text-sm py-2 px-3" />
                </div>
                <div>
                    <label class="block text-slate-600 mb-1 text-sm font-medium">Tanggal Mulai</label>
                    <input type="date" name="tanggal_mulai" id="edit_tanggal_mulai" required
                        class="w-full border border-slate-200 rounded-lg focus:border-blue-500 focus:ring-blue-500 text-sm py-2 px-3" />
                </div>
                <div>
                    <label class="block text-slate-600 mb-1 text-sm font-medium">Tanggal Selesai</label>
                    <input type="date" name="tanggal_selesai" id="edit_tanggal_selesai" required
                        class="w-full border border-slate-200 rounded-lg focus:border-blue-500 focus:ring-blue-500 text-sm py-2 px-3" />
                </div>
                <div>
                    <label class="block text-slate-600 mb-1 text-sm font-medium">Status</label>
                    <select name="status" id="edit_status" required
                        class="w-full border border-slate-200 rounded-lg focus:border-blue-500 focus:ring-blue-500 text-sm py-2 px-3">
                        <option value="Aktif">Aktif</option>
                        <option value="Tutup">Tutup</option>
                    </select>
                </div>
                <div>
                    <button type="submit"
                        class="w-full bg-blue-500 hover:bg-blue-600 text-white font-medium py-2 px-4 rounded-lg transition focus:outline-none focus:ring-2 focus:ring-blue-200 mt-2">Simpan
                        Perubahan</button>
                </div>
            </form>
        </div>
    </div>
    <script>
        const apiBaseUrl = @json($apiBaseUrl);
        const token = @json(session('token'));
        document.addEventListener('DOMContentLoaded', function() {
            // Open Edit Modal and fill data
            document.querySelectorAll('.btn-edit-periode').forEach(btn => {
                btn.addEventListener('click', function() {
                    const id = this.getAttribute('data-id');
                    fetch(`${apiBaseUrl}/api/periode/${id}`, {
                            headers: {
                                'Authorization': `Bearer ${token}`
                            }
                        })
                        .then(res => res.json())
                        .then(data => {
                            const d = data.data || data;
                            document.getElementById('edit_id').value = d.id;
                            document.getElementById('edit_nama').value = d.nama;
                            document.getElementById('edit_tanggal_mulai').value = d
                                .tanggal_mulai;
                            document.getElementById('edit_tanggal_selesai').value = d
                                .tanggal_selesai;
                            document.getElementById('edit_status').value = d.status.charAt(0)
                                .toUpperCase() + d.status.slice(1);
                            document.getElementById('modalEditPeriode').classList.remove(
                                'hidden');
                        })
                        .catch(() => {
                            Swal.fire({
                                icon: 'error',
                                title: 'Gagal',
                                text: 'Gagal mengambil data periode',
                                confirmButtonColor: '#ef4444'
                            });
                        });
                });
            });

            // Close modal
            document.getElementById('closeModalEdit').onclick = function() {
                document.getElementById('modalEditPeriode').classList.add('hidden');
            };
            // Close modal on outside click
            document.getElementById('modalEditPeriode').addEventListener('click', function(e) {
                if (e.target === this) this.classList.add('hidden');
            });

            // Submit Edit
            document.getElementById('formEditPeriode').onsubmit = function(e) {
                e.preventDefault();
                const id = document.getElementById('edit_id').value;
                const body = {
                    nama: document.getElementById('edit_nama').value,
                    tanggal_mulai: document.getElementById('edit_tanggal_mulai').value,
                    tanggal_selesai: document.getElementById('edit_tanggal_selesai').value,
                    status: document.getElementById('edit_status').value
                };
                fetch(`${apiBaseUrl}/api/periode/${id}`, {
                        method: 'PUT',
                        headers: {
                            'Content-Type': 'application/json',
                            'Authorization': `Bearer ${token}`
                        },
                        body: JSON.stringify(body)
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
                            text: data.message || (isSuccess ? 'Periode berhasil diupdate.' :
                                'Gagal update periode'),
                            confirmButtonColor: isSuccess ? '#2563eb' : '#ef4444'
                        }).then(() => {
                            if (isSuccess) location.reload();
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
            };

            // Delete Periode
            document.querySelectorAll('.btn-delete-periode').forEach(btn => {
                btn.addEventListener('click', function() {
                    const id = this.getAttribute('data-id');
                    Swal.fire({
                        title: 'Hapus Periode?',
                        text: 'Data yang dihapus tidak dapat dikembalikan!',
                        icon: 'warning',
                        showCancelButton: true,
                        confirmButtonColor: '#ef4444',
                        cancelButtonColor: '#6b7280',
                        confirmButtonText: 'Ya, hapus!'
                    }).then((result) => {
                        if (result.isConfirmed) {
                            fetch(`${apiBaseUrl}/api/periode/${id}`, {
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
                                            'Periode berhasil dihapus.' :
                                            'Gagal menghapus periode'),
                                        confirmButtonColor: isSuccess ?
                                            '#2563eb' : '#ef4444'
                                    }).then(() => {
                                        if (isSuccess) location.reload();
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
                });
            });
        });
    </script>
@endsection
