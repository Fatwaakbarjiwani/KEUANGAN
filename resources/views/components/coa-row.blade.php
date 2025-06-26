<tr class="hover:bg-slate-50">
    <td class="px-6 py-4 whitespace-nowrap text-sm text-slate-600">{{ $row['id'] ?? '-' }}</td>
    <td class="px-6 py-4 whitespace-nowrap text-sm text-slate-500">{{ $row['account_code'] }}</td>
    <td class="px-6 py-4 text-sm text-slate-600" style="padding-left: {{ $level * 24 }}px">
        @if ($level > 0)
            <svg class="inline w-4 h-4 mr-1 text-sky-400 align-middle" fill="none" stroke="currentColor" stroke-width="2"
                viewBox="0 0 24 24">
                <path
                    d="M9 17v-2m3 2v-4m3 4v-6m2 10H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"
                    stroke-linecap="round" stroke-linejoin="round"></path>
            </svg>
        @endif
        {{ $row['account_name'] }}
    </td>
    <td class="px-6 py-4 whitespace-nowrap">
        <span
            class="inline-flex px-2 py-1 text-xs rounded-full
            @if ($row['account_type'] == 'Asset') bg-green-100 text-green-800
            @elseif($row['account_type'] == 'Kewajiban') bg-yellow-100 text-yellow-800
            @elseif($row['account_type'] == 'Ekuitas') bg-blue-100 text-blue-800
            @elseif($row['account_type'] == 'Pendapatan') bg-sky-100 text-sky-800
            @else bg-red-100 text-red-800 @endif">
            {{ $row['account_type'] }}
        </span>
    </td>
    <td class="px-6 py-4 whitespace-nowrap text-center">
        <div class="flex justify-center space-x-2">
            <button type="button"
                class="btn-edit-coa bg-amber-400 hover:bg-amber-500 text-white py-1 px-3 rounded-md shadow-sm transition focus:outline-none focus:ring-2 focus:ring-amber-200"
                data-id="{{ $row['id'] }}" title="Edit Akun">
                <img src="images/iconEdit.svg" class="min-w-4 min-h-4 w-5" alt="">
            </button>
            <button type="button"
                class="btn-delete-coa bg-rose-400 hover:bg-rose-500 text-white py-1 px-3 rounded-md shadow-sm transition focus:outline-none focus:ring-2 focus:ring-rose-200"
                data-id="{{ $row['id'] }}" title="Hapus Akun">
                <img src="images/iconSampah.svg" class="min-w-4 min-h-4 w-5" alt="">
            </button>
        </div>
    </td>
</tr>
@if (!empty($row['children']))
    @foreach ($row['children'] as $child)
        @include('components.coa-row', ['row' => $child, 'level' => $level + 1])
    @endforeach
@endif
