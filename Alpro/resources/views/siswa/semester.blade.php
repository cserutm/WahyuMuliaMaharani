<x-app-layout>

<div class="min-h-screen flex items-center justify-center bg-gray-100">
    <div class="bg-white shadow-xl rounded-2xl w-full max-w-md p-8 text-center">
        <h2 class="text-xl font-semibold text-gray-700">
            Mengecek Status Semester...
        </h2>
    </div>
</div>

{{-- SweetAlert --}}
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<script>
document.addEventListener("DOMContentLoaded", function () {
    Swal.fire({
        icon: 'warning',
        title: 'Semester Nonaktif',
        text: 'Semester anda sudah dinonaktifkan!',
        confirmButtonText: 'OK'
    }).then(() => {

        // 🔥 logout pakai form (Laravel way)
        document.getElementById('logout-form').submit();
    });
});
</script>

{{-- FORM LOGOUT --}}
<form id="logout-form" action="{{ route('logout') }}" method="POST" class="hidden">
    @csrf
</form>

</x-app-layout>