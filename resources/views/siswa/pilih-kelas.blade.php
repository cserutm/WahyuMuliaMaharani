<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<title>Pilih Semester & Kelas</title>

<script src="https://cdn.tailwindcss.com"></script>

</head>

<body class="min-h-screen flex items-center justify-center bg-gradient-white">

<div class="bg-white shadow-xl rounded-2xl w-full max-w-md p-8">

<h2 class="text-2xl font-bold text-gray-800 text-center mb-6">
Pilih Semester & Kelas
</h2>

<form action="{{ route('siswa.pilih-kelas.simpan') }}" method="POST" class="space-y-5">
@csrf

<!-- SEMESTER -->
<div>
<label class="block text-sm font-medium text-gray-700 mb-1">
Semester
</label>

<select id="semester"
name="semester_id"
class="w-full border border-gray-300 rounded-lg px-3 py-2 focus:ring-2 focus:ring-blue-500">

<option value="">Pilih Semester</option>

@foreach($semesters as $semester)

<option value="{{ $semester->id }}">
{{ $semester->nama_semester }} - {{ $semester->tahun_ajaran }}
</option>

@endforeach

</select>
</div>


<!-- KELAS -->
<div>
<label class="block text-sm font-medium text-gray-700 mb-1">
Kelas
</label>

<select id="kelas"
name="class_id"
class="w-full border border-gray-300 rounded-lg px-3 py-2 focus:ring-2 focus:ring-blue-500">

<option value="">Pilih Kelas</option>

</select>
</div>


<!-- BUTTON -->
<button type="submit"
class="w-full bg-blue-600 hover:bg-blue-700 text-white font-semibold py-2.5 rounded-lg transition">

Masuk

</button>

</form>

</div>


<script>

// ambil data semester + kelas dari controller
const semesters = @json($semesters);

const semesterSelect = document.getElementById('semester');
const kelasSelect = document.getElementById('kelas');

semesterSelect.addEventListener('change', function(){

let semesterId = this.value;

kelasSelect.innerHTML = '<option value="">Pilih Kelas</option>';

let semester = semesters.find(s => s.id == semesterId);

if(semester){

semester.classes.forEach(function(kelas){

kelasSelect.innerHTML +=
`<option value="${kelas.id}">
${kelas.nama_kelas}
</option>`;

});

}

});

</script>

</body>
</html>