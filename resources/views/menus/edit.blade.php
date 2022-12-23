@extends('layout.master')
@section('title', 'Edit Menu')
@section('content')
    <h2>Update New Menu</h2>

    <form action="{{ route('menus.update', ['menu' => $menu->id]) }}" method="POST" enctype="multipart/form-data">
        @method('PATCH')
        @csrf
        <div class="row">
            <div class="col-md-6 mb-3">
                <label for="nama">Nama</label>
                <input type="text" class="form-control @error('nama') is-invalid @enderror" name="nama" id="nama"
                    value="{{ old('nama') ?? $menu->nama }}">
                @error('nama')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>
        </div>

        <div class="row">
            <div class="form-group col-md-6 mb-3">
                <label for="rekomendasi">Rekomendasi</label>
                <select id="rekomendasi" class="form-control @error('rekomendasi') is-invalid @enderror" name="rekomendasi"
                    value="{{ old('rekomendasi') ?? $menu->rekomendasi ? 'Ya' : 'Tidak'}}"">
                    <option selected>Pilih...</option>
                    <option value="1">Ya</option>
                    <option value="0">Tidak</option>
                </select>
            </div>
        </div>

        <div class="row">
            <div class="col-md-6 mb-3">
                <label for="harga">Harga</label>
                <input type="text" class="form-control @error('harga') is-invalid @enderror" name="harga"
                    id="harga" value="{{ old('harga') ?? $menu->harga }}">
                @error('harga')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>
        </div>
        <div class="row">
            <div class="col-md-6 mb-3">
            <div class="form-group">
                <div class="input-group">
                <div class="input-group-prepend">
                <span class="input-group-text" id="image-label">Image</span>
                </div>
                <div class="custom-file">
                <input type="file" class="custom-file-input" name="image" id="image">
                <label class="custom-file-label" for="image">Choose file</label>
                </div>
                </div>
                @error('image')
                <div class="text-danger">{{ $message }}</div>
                @enderror
                @if ($menu->image)
                <div class="card card-primary">
                <div class="card-body">
                <div class="filter-container p-0 row">
                <div class="filtr-item col-sm-2">
                <a href="{{ Storage::url($menu->image) }}"
                data-toggle="lightbox">
                <img src="{{ Storage::url($menu->image) }}"
                class="img-fluid mb-2"/>
                </a>
                </div>
                </div>
                </div>
                </div>
                @endif
                </div>
            </div>
        </div>


        <div class="row">
            <div class="col-md-6 mb-3">
                <button class="btn btn-primary btn-lg btn-block" type="submit">Update</button>
            </div>
        </div>
    </form>
@endsection


@push('js_after')
    <script>
        // Untuk upload file
        $(".custom-file-input").on("change", function() {
            var fileName = $(this).val().split("\\").pop();
            $(this).siblings(".custom-file-label").addClass("selected").html(fileName);
        });
    </script>
@endpush
