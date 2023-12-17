@extends('layouts.app')

@section('style')
    <link rel="stylesheet" href="{{ asset('include') }}/css/upload.css">
@endsection
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
                    <div class="form-group">
                        <label for="size">Size:</label>
                        <input type="text" class="form-control" id="size" name="size">
                    </div>

                    <div class="form-group">
                        <label for="deskripsi">Deskripsi:</label>
                        <textarea class="form-control" id="deskripsi" name="deskripsi"></textarea>
                    </div>

                    <div class="row">
                        <!-- Thumbnail -->
                        <div class="col-md-6">
                            <div class="card">
                                <div class="top">
                                    <p>Thumbnail Produk</p>
                                </div>
                                <div class="drag-area" ondragover="handleDragOverThumb(event)" id="thumbnailDragArea"
                                    ondrop="handleThumbnailDrop(event)">
                                    <span class="visible">
                                        Drag & drop image here or
                                        <span class="select" role="button" onclick="selectThumbnailFile()">Browse</span>
                                    </span>
                                    <span class="on-drop">Drop images here</span>
                                    <input type="file" name="thumbnail" class="file-input file" id="thumbnailInput"
                                        onchange="handleThumbnailFileSelect(event)" />
                                </div>
                                <div class="container image-grid" id="thumbnailPreview"></div>
                            </div>
                        </div>


                        {{-- Detail --}}
                        <div class="col-md-6">
                            <div class="card">
                                <div class="top">
                                    <p>Detail Produk</p>
                                </div>
                                <div class="drag-area" ondragover="handleDragOver(event)" id="dragArea"
                                    ondrop="handleDrop(event)">
                                    <span class="visible">
                                        Drag & drop image here or
                                        <span class="select" role="button" onclick="selectFile()">Browse</span>
                                    </span>
                                    <span class="on-drop">Drop images here</span>
                                    <input name="gambar_detail[]" type="file" class="file-input file" id="fileInput"
                                        multiple onchange="handleFileSelect(event)" />
                                </div>
                                <div class="container" class="image-grid" id="imagePreview"></div>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
            <button type="submit" class="btn btn-primary mt-5">Simpan</button>
        </form>
    </div>
@endsection
@section('script')
    <script src="{{ asset('include') }}/js/upload.js"></script>
@endsection
