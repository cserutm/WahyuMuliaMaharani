<x-app-layout>

<div class="flex">

@include('guru.sidebar')

<main class="flex-1 ml-64 p-10"
x-data="{ open:false, openEdit:false, editId:null }">

{{-- HEADER --}}
<div class="flex justify-between items-center mb-8">
<div>
<h1 class="text-2xl font-bold text-gray-800">
Manajemen Semester
</h1>
<p class="text-sm text-gray-500">
Kelola semester dan tahun ajaran
</p>
</div>

<button
@click="open=true"
class="inline-flex items-center gap-2
px-4 py-2
bg-white border border-blue-200
text-blue-600
rounded-xl shadow-sm
hover:bg-blue-50 transition">

<svg xmlns="http://www.w3.org/2000/svg"
class="w-5 h-5"
fill="none"
viewBox="0 0 24 24"
stroke="currentColor">
<path stroke-linecap="round"
stroke-linejoin="round"
stroke-width="2"
d="M12 4v16m8-8H4"/>
</svg>

Tambah Semester
</button>
</div>


{{-- STATISTIK --}}
<div class="grid grid-cols-1 sm:grid-cols-3 gap-6 mb-8">

<div class="bg-white rounded-2xl shadow p-6">
<p class="text-sm text-gray-500">Total Semester</p>
<p class="text-2xl font-bold text-gray-800">
{{ $semesters->count() }}
</p>
</div>

<div class="bg-white rounded-2xl shadow p-6">
<p class="text-sm text-gray-500">Semester Ganjil</p>
<p class="text-2xl font-bold text-blue-600">
{{ $semesters->where('nama_semester','Ganjil')->count() }}
</p>
</div>

<div class="bg-white rounded-2xl shadow p-6">
<p class="text-sm text-gray-500">Semester Genap</p>
<p class="text-2xl font-bold text-green-600">
{{ $semesters->where('nama_semester','Genap')->count() }}
</p>
</div>

</div>


{{-- TABLE --}}
<div class="bg-white rounded-2xl shadow-lg overflow-hidden">

<table class="w-full text-sm">

<thead class="bg-gray-50 border-b">
<tr class="text-gray-600">
<th class="px-6 py-4 text-left">No</th>
<th class="px-6 py-4 text-left">Semester</th>
<th class="px-6 py-4 text-left">Tahun Ajaran</th>
<th class="px-6 py-4 text-center">Status</th>
<th class="px-6 py-4 text-center">Aksi</th>
</tr>
</thead>

<tbody class="divide-y">

@forelse($semesters as $semester)
<tr class="hover:bg-gray-50 transition">

<td class="px-6 py-4 text-gray-500">
{{ $loop->iteration }}
</td>

<td class="px-6 py-4 font-semibold text-gray-800">
{{ $semester->nama_semester }}
</td>

<td class="px-6 py-4 text-gray-600">
{{ $semester->tahun_ajaran }}
</td>

<td class="px-6 py-4 text-center">

@if($semester->is_active)

<span class="px-3 py-1 text-xs font-semibold
bg-green-100 text-green-700
rounded-full">
Aktif
</span>

@else

<span class="px-3 py-1 text-xs font-semibold
bg-gray-100 text-gray-500
rounded-full">
Nonaktif
</span>

@endif

</td>

<td class="px-6 py-4">
<div class="flex justify-center gap-3">

{{-- STATUS BUTTON --}}
@if(!$semester->is_active)

<form action="{{ route('guru.semester.activate',$semester->id) }}"
method="POST">
@csrf

<button
title="Aktifkan Semester"
class="p-2 rounded-lg
bg-green-50 text-green-600
hover:bg-green-100 transition">

<svg xmlns="http://www.w3.org/2000/svg"
class="w-5 h-5"
fill="none"
viewBox="0 0 24 24"
stroke="currentColor">

<path stroke-linecap="round"
stroke-linejoin="round"
stroke-width="2"
d="M5 13l4 4L19 7"/>

</svg>

</button>

</form>

@else

<form action="{{ route('guru.semester.deactivate',$semester->id) }}"
method="POST">
@csrf

<button
title="Nonaktifkan Semester"
class="p-2 rounded-lg
bg-yellow-50 text-yellow-600
hover:bg-yellow-100 transition">

<svg xmlns="http://www.w3.org/2000/svg"
class="w-5 h-5"
fill="none"
viewBox="0 0 24 24"
stroke="currentColor">

<path stroke-linecap="round"
stroke-linejoin="round"
stroke-width="2"
d="M6 18L18 6M6 6l12 12"/>

</svg>

</button>

</form>

@endif

{{-- EDIT --}}
<button
@click="openEdit=true; editId={{ $semester->id }}"
class="p-2 rounded-lg
bg-blue-50 text-blue-600
hover:bg-blue-100 transition">

<svg xmlns="http://www.w3.org/2000/svg"
class="w-5 h-5"
fill="none"
viewBox="0 0 24 24"
stroke="currentColor">
<path stroke-linecap="round"
stroke-linejoin="round"
stroke-width="2"
d="M11 5H6a2 2 0 00-2 2v11
a2 2 0 002 2h11a2 2 0 002-2v-5
m-1.414-9.414
a2 2 0 112.828 2.828L11.828 15
H9v-2.828l8.586-8.586z"/>
</svg>

</button>

{{-- DELETE --}}
<form action="{{ route('guru.semester.destroy',$semester->id) }}"
method="POST"
onsubmit="return confirm('Yakin hapus semester ini?')">

@csrf
@method('DELETE')

<button
class="p-2 rounded-lg
bg-red-50 text-red-600
hover:bg-red-100 transition">

<svg xmlns="http://www.w3.org/2000/svg"
class="w-5 h-5"
fill="none"
viewBox="0 0 24 24"
stroke="currentColor">

<path stroke-linecap="round"
stroke-linejoin="round"
stroke-width="2"
d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862
a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6"/>

</svg>

</button>

</form>

</div>
</td>

</tr>

@empty
<tr>
<td colspan="5" class="text-center py-10 text-gray-400">
Belum ada data semester
</td>
</tr>
@endforelse

</tbody>

</table>
</div>

{{-- MODAL TAMBAH --}}
<div
x-cloak
x-show="open"
x-transition
class="fixed inset-0 z-50 flex items-center justify-center bg-black bg-opacity-50">

<div
@click.away="open=false"
class="bg-white w-full max-w-md rounded-2xl shadow-xl p-6">

<h2 class="text-xl font-bold mb-4">
Tambah Semester
</h2>

<form action="{{ route('guru.semester.store') }}"
method="POST"
class="space-y-4">
@csrf

<div>
<label class="block text-sm font-medium mb-1">
Nama Semester
</label>

<select name="nama_semester"
class="w-full rounded-lg border-gray-300">
<option value="">Pilih Semester</option>
<option value="Ganjil">Ganjil</option>
<option value="Genap">Genap</option>
</select>
</div>

<div>
<label class="block text-sm font-medium mb-1">
Tahun Ajaran
</label>

<input type="text"
name="tahun_ajaran"
placeholder="2024/2025"
class="w-full rounded-lg border-gray-300">
</div>

<div class="flex justify-end gap-3">
<button type="button"
@click="open=false"
class="px-4 py-2 border rounded-lg">
Batal
</button>

<button type="submit"
class="px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700">
Simpan
</button>
</div>

</form>

</div>
</div>

{{-- MODAL EDIT --}}
@foreach($semesters as $semester)
<div
x-cloak
x-show="openEdit && editId == {{ $semester->id }}"
x-transition
class="fixed inset-0 z-50 flex items-center justify-center bg-black bg-opacity-50">

<div
@click.away="openEdit=false"
class="bg-white w-full max-w-md rounded-2xl shadow-xl p-6">

<h2 class="text-xl font-bold mb-4">
Edit Semester
</h2>

<form
action="{{ route('guru.semester.update',$semester->id) }}"
method="POST"
class="space-y-4">

@csrf
@method('PUT')

<div>
<label class="block text-sm font-medium mb-1">
Nama Semester
</label>

<select name="nama_semester"
class="w-full rounded-lg border-gray-300">

<option value="Ganjil"
{{ $semester->nama_semester == 'Ganjil' ? 'selected' : '' }}>
Ganjil
</option>

<option value="Genap"
{{ $semester->nama_semester == 'Genap' ? 'selected' : '' }}>
Genap
</option>

</select>
</div>

<div>
<label class="block text-sm font-medium mb-1">
Tahun Ajaran
</label>

<input type="text"
name="tahun_ajaran"
value="{{ $semester->tahun_ajaran }}"
class="w-full rounded-lg border-gray-300">
</div>

<div class="flex justify-end gap-3">

<button type="button"
@click="openEdit=false"
class="px-4 py-2 border rounded-lg">
Batal
</button>

<button type="submit"
class="px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700">
Update
</button>

</div>

</form>

</div>
</div>
@endforeach

</main>
</div>

</x-app-layout>