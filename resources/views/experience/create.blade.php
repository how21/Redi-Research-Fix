<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Tambah Experience
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <form action="{{ route('experience.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="mb-4">
                            <label for="title" class="block text-sm font-medium text-gray-700">Judul</label>
                            <input type="text" name="title" id="title" required 
                                class="w-full mt-1 p-2 rounded-lg focus:ring focus:blue-700
                                @error('title') border-red-500 @enderror">
                            
                            @error('title')
                                <p class="text-red-500 text-sm">{{ $message }}</p>
                            @enderror                      
                        </div>                        
                        <div class="mb-4">
                            <label for="client_id" class="block text-sm font-medium text-gray-700">Client</label>
                            <select name="client_id" id="client_id" required class="w-full mt-1 p-2 border border-gray-300 rounded-lg">
                                <option value="">Pilih Client</option>
                                @foreach ($clients as $client)
                                    <option value="{{ $client->id }}">{{ $client->full_name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="mb-4">
                            <label for="province_id" class="block text-sm font-medium text-gray-700">Provinsi</label>
                            <select name="province_id" id="province_id" required class="w-full mt-1 p-2 border border-gray-300 rounded-lg">
                                <option value="">Pilih Provinsi</option>
                                @foreach ($provinces as $province)
                                    <option value="{{ $province->id }}">{{ $province->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="mb-4">
                            <label for="kategori_id" class="block text-sm font-medium text-gray-700">kategori</label>
                            <select name="kategori_id" id="kategori_id" required class="w-full mt-1 p-2 border border-gray-300 rounded-lg">
                                <option value="">Pilih bidang</option>
                                @foreach ($bidangs as $bidang)
                                    <option value="{{ $bidang->id }}">{{ $bidang->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="mb-4">
                            <!-- Tempat Preview Gambar -->
                            <img id="imagePreview" src="#" alt="Preview Gambar" class="mt-2 hidden w-64 h-48 rounded-lg border border-gray-300">
                            <label for="image" class="block text-sm font-medium text-gray-700"></label>
                            <input type="file" name="image" id="image"
                                class="w-full px-4 py-2 border rounded-lg focus:ring-2 focus:ring-blue-400 focus:outline-none @error('image') border-red-500 @enderror"
                                onchange="previewImage(event)">
                            @error('image')
                                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                            @enderror
                        </div>
                        <div class="mb-4">
                            <label for="desc" class="block text-sm font-medium text-gray-700">Deskripsi</label>
                            <input id="desc" type="hidden" name="desc">
                            <trix-editor input="desc" class="trix-content bg-white"></trix-editor>
                        </div>
                        <div class="flex justify-between">
                            <a href="{{ route('experience.index') }}" class="px-4 py-2 bg-gray-500 text-white rounded">Back to List</a>
                            <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded-lg hover:bg-blue-600">
                                Simpan Experience
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <link rel="stylesheet" type="text/css" href="https://unpkg.com/trix@2.0.8/dist/trix.css">
    <script type="text/javascript" src="https://unpkg.com/trix@2.0.8/dist/trix.umd.min.js"></script>

    <script>
    document.addEventListener("DOMContentLoaded", function () {
        let editor = document.querySelector("trix-editor").editor;
        let inputHidden = document.querySelector("#desc");

        document.addEventListener("trix-attachment-add", function(event) {
            let attachment = event.attachment;
            if (attachment.file) {
                uploadImage(attachment);
            }

            setTimeout(() => {
                document.querySelectorAll("figure[data-trix-attachment]").forEach(fig => {
                    fig.style.textAlign = "center";
                    fig.style.display = "block";
                    fig.style.margin = "auto";

                    let img = fig.querySelector("img");
                    if (img) {
                        img.style.display = "block";
                        img.style.margin = "auto";
                        img.style.border = "1px solid #ddd";
                        img.style.cursor = "pointer";
                        img.style.maxWidth = "100%"; // Pastikan tetap responsive
                        img.style.height = "auto";

                        img.addEventListener("click", function () {
                            let newSize = prompt("Masukkan ukuran lebar gambar (% atau px):", img.style.width);
                            if (newSize) {
                                img.style.width = newSize;
                            }
                        });

                        // Tambahkan fitur drag-resize dengan mouse
                        img.addEventListener("mousedown", function (event) {
                            event.preventDefault();
                            let startX = event.clientX;
                            let startWidth = img.offsetWidth;

                            function onMouseMove(e) {
                                let newWidth = startWidth + (e.clientX - startX);
                                img.style.width = newWidth + "px";
                            }

                            function onMouseUp() {
                                document.removeEventListener("mousemove", onMouseMove);
                                document.removeEventListener("mouseup", onMouseUp);
                            }

                            document.addEventListener("mousemove", onMouseMove);
                            document.addEventListener("mouseup", onMouseUp);
                        });
                    }
                });
            }, 100);
        });


        document.addEventListener("trix-change", function() {
            let content = editor.element.innerHTML
                .replace(/<p>/g, '<p style="text-align: justify;">')
                .replace(/<ul>/g, '<ul style="list-style-type: disc; margin-left: 20px;">')
                .replace(/<ol>/g, '<ol style="list-style-type: decimal; margin-left: 20px;">');
            inputHidden.value = content;
        });
    });


        function previewImage(event) {
            const file = event.target.files[0]; // Ambil file yang dipilih
            if (file) {
                const reader = new FileReader();
                reader.onload = function (e) {
                    const preview = document.getElementById('imagePreview');
                    preview.src = e.target.result; // Setel src gambar dengan hasil file yang dipilih
                    preview.classList.remove('hidden'); // Tampilkan gambar preview
                }
                reader.readAsDataURL(file);
            }
        }
    
        function uploadImage(attachment) {
            let formData = new FormData();
            formData.append("image", attachment.file);

            fetch("{{ route('experience.uploadImage') }}", {
                method: "POST",
                body: formData,
                headers: {
                    "X-CSRF-TOKEN": document.querySelector('meta[name="csrf-token"]').getAttribute("content"),
                },
            })
            .then(response => response.json())
            .then(data => {
                if (data.url) {
                    attachment.setAttributes({ url: data.url, href: data.url });
                } else {
                    alert("Upload gambar gagal");
                }
            })
            .catch(error => console.error("Upload error:", error));
        }

    </script>
    

    <style>
        trix-editor, trix-editor .trix-content {
            text-align: justify !important;
        }
        trix-editor .trix-content figure[data-trix-attachment],
        trix-editor .trix-content img {
            text-align: center !important;
            display: block !important;
            margin-left: auto !important;
            margin-right: auto !important;
            max-width: 100% !important;
            height: auto !important;
            border: 1px solid #ddd;
            cursor: pointer;
            user-select: none; /* Mencegah pemilihan gambar */
            pointer-events: auto; /* Hanya bisa klik untuk resize */
        }

        trix-editor .trix-content figure img {
            max-width: 80% !important; /* Atur default max width */
            height: auto !important;
            display: block !important;
            margin: auto !important;
            border: 1px solid #ddd;
            cursor: pointer;
            user-select: none;
        }

        trix-editor .trix-content ul {
            list-style-type: disc !important;
            margin-left: 20px;
        }
        trix-editor .trix-content ol {
            list-style-type: decimal !important;
            margin-left: 20px;
        }
        trix-editor .trix-content li {
            margin-bottom: 5px;
        }
        trix-editor .trix-content p {
            text-align: justify !important;
        }

        /* Menyembunyikan figcaption */
        trix-editor .trix-content figure figcaption {
            display: none !important; /* Hilangkan figcaption */
        }
    </style>
</x-app-layout>
