<x-app-layout>
    <x-slot name="header">
        @if($experiences->image)
            <div class="relative w-full h-64">
                <img src="{{ asset($experiences->image) }}" alt="{{ $experiences->title }}" class="w-full h-full object-cover rounded-lg shadow-md">
                <div class="absolute inset-0 bg-black bg-opacity-50 flex justify-center items-center">
                    <h1 class="text-white text-3xl font-bold text-center px-4">{{ $experiences->title }}</h1>
                </div>
            </div>
        @else
            <h2 class="font-semibold text-xl text-gray-800 leading-tight text-center py-6">
                {{ $experiences->title }}
            </h2>
        @endif
    </x-slot>

    <div class="py-6 px-4 sm:px-6 lg:px-8">
        <div class="max-w-7xl mx-auto grid grid-cols-1 md:grid-cols-3 gap-6">
            <!-- Container Detail Experience (2/3) -->
            <div class="md:col-span-2 bg-white shadow-md rounded-lg p-6">
                <h2 class="text-2xl font-semibold mb-4">Detail Experience</h2>
                
                <div class="mb-4">
                    <p class="text-gray-700"><strong>Client:</strong> {{ $experiences->client->full_name ?? 'Tidak tersedia' }}</p>
                    <p class="text-gray-700"><strong>Provinsi:</strong> {{ $experiences->province->name ?? 'Tidak tersedia' }}</p>
                </div>

                <div class="text-gray-800 trix-content" style="text-align: justify;">
                    {!! $experiences->desc !!}
                </div>

                <div class="mt-6">
                    <a href="{{ route('experience.index') }}" class="bg-gray-500 text-white px-4 py-2 rounded-lg hover:bg-gray-600">Kembali</a>
                </div>
            </div>

            <!-- Container Related & Random Experiences (1/3) -->
            <div class="bg-gray-50 shadow-md rounded-lg p-6">
                <h3 class="text-lg font-semibold mb-4">Related & Random Experiences</h3>

                @php
                    $combinedExperiences = collect($relatedExperiences)->take(4); // Ambil max 4 related
                    if ($combinedExperiences->count() < 4) {
                        $remaining = 4 - $combinedExperiences->count(); // Hitung sisa slot
                        $randomToAdd = $randomExperiences->take($remaining); // Ambil random sesuai sisa slot
                        $combinedExperiences = $combinedExperiences->merge($randomToAdd); // Gabungkan related + random
                    }
                @endphp

                <div class="grid gap-4">
                    @foreach($combinedExperiences as $experience)
                        <div class="bg-white p-6 rounded-lg shadow">
                            <h5 class="font-semibold py-2">{{ $experience->title }}</h5>
                            <p class="text-gray-700 text-sm"><strong>Client:</strong> {{ $experience->client->full_name ?? 'Tidak tersedia' }}</p>
                            <p class="text-gray-700 text-sm"><strong>Provinsi:</strong> {{ $experience->province->name ?? 'Tidak tersedia' }}</p>
                            <a href="{{ route('experience.show', $experience->id) }}" class="text-blue-500 mt-2 py-2 inline-block">Read More</a>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>

    <style>
        /* Styling for trix-editor content */
        trix-editor, trix-editor .trix-content {
            text-align: justify !important;
        }

        /* Styling for images in figure */
        .trix-content figure,
        .trix-content figure img {
            display: block !important;
            margin-left: auto !important;
            margin-right: auto !important;
            max-width: 80% !important;
            height: auto !important;
            text-align: center !important;
        }

        /* Hide figure captions */
        .trix-content figure figcaption {
            display: none !important;
        }
    </style>

</x-app-layout>
