<x-app-layout>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
            <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg">
                <div class="max-w-xl">
                    @include('profile.partials.update-profile-information-form')
                </div>
            </div>

            <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg">
                <div class="max-w-xl">
                    @include('profile.partials.update-password-form')
                </div>
            </div>

            <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg">
                <div class="max-w-xl">
                    @include('profile.partials.delete-user-form')
                </div>
            </div>
            {{-- Button Kembali (Clean Style) --}}
        <div class="mt-10 flex justify-end">
            <a href="{{ url()->previous() }}"
               class="inline-flex items-center gap-2
                      px-5 py-2.5 text-sm
                      bg-white border border-gray-300
                      text-gray-600
                      rounded-full
                      hover:bg-gray-50 hover:border-gray-400
                      transition">

                <svg xmlns="http://www.w3.org/2000/svg"
                     viewBox="0 0 24 24"
                     fill="none"
                     stroke="currentColor"
                     stroke-width="1.8"
                     class="w-4 h-4">
                    <path stroke-linecap="round"
                          stroke-linejoin="round"
                          d="M15 18l-6-6 6-6"/>
                </svg>

                <span>Kembali</span>
            </a>
        </div>
        </div>
    </div>
</x-app-layout>
