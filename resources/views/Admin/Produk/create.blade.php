@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Form Input Kategori</h1>
        <form method="POST" action="{{ url('/produk/store') }}" enctype="multipart/form-data">
            @csrf
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="nama">Nama Produk:</label>
                        <input type="text" class="form-control" id="nama" name="nama">
                    </div>
                    <div class="form-group">
                        <label for="stok">Stok:</label>
                        <input type="number" class="form-control" id="stok" name="stok">
                    </div>
                    <div class="form-group">
                        <label for="harga">Harga:</label>
                        <input type="number" step="0.01" class="form-control" id="harga" name="harga">
                    </div>
                    <div class="form-group">
                        <label for="kategori">Kategori:</label>
                        <select id="kategori" name="kategori_id" class="form-control">
                            <option value="">-- Pilih Kategori --</option>
                            @foreach ($kategoris as $kategori)
                                <option value="{{ $kategori->id }}">{{ $kategori->nama }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="row">
                        <!-- Gallery 1 -->
                        <div class="col-md-6">

                            <label for="thumbnail">Thumbnail:</label>
                            <div id="drop-area-1" class="border rounded d-flex justify-content-center align-items-center"
                                style="padding: 35px; cursor: pointer">
                                <div class="text-center">
                                    <i class="bi bi-cloud-arrow-up-fill text-primary" style="font-size: 48px"></i>
                                    <p id="file-info-1" class="mt-3">
                                        Seret dan letakkan gambar Anda di sini atau klik untuk memilih file.
                                        <input type="file" id="thumbnail" name="thumbnail" class="d-none" />
                                    <div id="thumbnail"></div>
                                    </p>
                                </div>
                            </div>

                        </div>

                        <!-- Gallery 2 -->
                        <div class="col-md-6">
                            <label for="gambar_detail1">Gambar_detail1:</label>

                            <div id="drop-area-2" class="border rounded d-flex justify-content-center align-items-center"
                                style="padding: 35px; cursor: pointer">
                                <div class="text-center">
                                    <i class="bi bi-cloud-arrow-up-fill text-primary" style="font-size: 48px"></i>
                                    <p id="file-info-2" class="mt-3">
                                        Seret dan letakkan gambar Anda di sini atau klik untuk memilih file.
                                        <input type="file" id="gambar_detail1" name="gambar_detail1" class="d-none" />
                                    <div id="gambar_detail1"></div>
                                    </p>
                                </div>
                            </div>
                        </div>

                        <!-- Gallery 3 -->
                        <div class="col-md-6">
                            <label for="gambar_detail2">Gambar_detail2:</label>

                            <div id="drop-area-3" class="border rounded d-flex justify-content-center align-items-center"
                                style="padding: 35px; cursor: pointer">
                                <div class="text-center">
                                    <i class="bi bi-cloud-arrow-up-fill text-primary" style="font-size: 48px"></i>
                                    <p id="file-info-3" class="mt-3">
                                        Seret dan letakkan gambar Anda di sini atau klik untuk memilih file.
                                        <input type="file" id="gambar_detail2" name="gambar_detail2" class="d-none" />
                                    <div id="gambar_detail2"></div>
                                    </p>
                                </div>
                            </div>
                        </div>

                        <!-- Gallery 4 -->
                        <div class="col-md-6">
                            <label for="gambar_detail3">Gambar_detail3:</label>

                            <div id="drop-area-4" class="border rounded d-flex justify-content-center align-items-center"
                                style="padding: 35px; cursor: pointer">
                                <div class="text-center">
                                    <i class="bi bi-cloud-arrow-up-fill text-primary" style="font-size: 48px"></i>
                                    <p id="file-info-4" class="mt-3">
                                        Seret dan letakkan gambar Anda di sini atau klik untuk memilih file.
                                        <input type="file" id="gambar_detail3" name="gambar_detail3" class="d-none" />
                                    <div id="gambar_detail3"></div>
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <button type="submit" class="btn btn-primary">Simpan</button>
        </form>
    </div>

    <style>
        .card-body {
            display: flex;
            flex-direction: column;
            justify-content: space-between;
        }

        #thumbnail img,
        #gambar_detail1 img,
        #gambar_detail2 img,
        #gambar_detail3 img {
            max-width: 50%;
            max-height: 100px;
            margin-bottom: 10px;
        }
    </style>

    <script>
        function initializeDropArea(dropAreaId, fileElemId, fileInfoId, galleryId) {
            let dropArea = document.getElementById(dropAreaId);
            let fileElem = document.getElementById(fileElemId);
            let gallery = document.getElementById(galleryId);
            let fileInfo = document.getElementById(fileInfoId);

            ['dragenter', 'dragover', 'dragleave', 'drop'].forEach(eventName => {
                dropArea.addEventListener(eventName, preventDefaults, false);
                document.body.addEventListener(eventName, preventDefaults, false);
            });

            ['dragenter', 'dragover'].forEach(eventName => {
                dropArea.addEventListener(eventName, highlight, false);
            });

            ['dragleave', 'drop'].forEach(eventName => {
                dropArea.addEventListener(eventName, unhighlight, false);
            });

            dropArea.addEventListener('drop', handleDrop, false);

            function preventDefaults(e) {
                e.preventDefault();
                e.stopPropagation();
            }

            function highlight(e) {
                dropArea.classList.add('highlight');
            }

            function unhighlight(e) {
                dropArea.classList.remove('highlight');
            }

            function handleDrop(e) {
                let dt = e.dataTransfer;
                let files = dt.files;
                handleFiles(files);
            }

            dropArea.addEventListener('click', () => {
                fileElem.click();
            });

            fileElem.addEventListener('change', function(e) {
                handleFiles(this.files);
            });

            function handleFiles(files) {
                gallery.innerHTML = '';
                files = [...files];
                files.forEach(previewFile);
            }

            function previewFile(file) {
                let reader = new FileReader();
                reader.readAsDataURL(file);
                reader.onloadend = function() {
                    let img = document.createElement('img');
                    img.src = reader.result;
                    gallery.appendChild(img);
                    fileInfo.textContent = `File terpilih: ${file.name}`;
                }
            }
        }

        initializeDropArea('drop-area-1', 'thumbnail', 'file-info-1', 'thumbnail');
        initializeDropArea('drop-area-2', 'gambar_detail1', 'file-info-2', 'gambar_detail1');
        initializeDropArea('drop-area-3', 'gambar_detail2', 'file-info-3', 'gambar_detail2');
        initializeDropArea('drop-area-4', 'gambar_detail3', 'file-info-4', 'gambar_detail3');
    </script>
@endsection
