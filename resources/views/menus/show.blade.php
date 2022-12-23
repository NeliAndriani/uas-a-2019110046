@extends('layout.master')
@section('title', $menu->title)
@section('content')

<div class="card" style="width: 18rem;">
    <img src="{{ Storage::url($menu->image) }}" class="card-img-top" alt="">
    <div class="card-body">
      <h5 class="card-title"><b>{{ $menu->nama }}</b></h5>
      <p class="card-text">Harga: {{ $menu->harga }}</p>
      <p class="card-text">Rekomendasi: {{ $menu->rekomendasi ? 'Ya' : 'Tidak'}}</p>
      <div class="btn-group" role="group">
      <a href="{{ route('menus.edit', $menu->id) }}" class="btn btn-primary ml-6">Edit</a>
      <form action="{{ route('menus.destroy', $menu->id) }}" method="POST">
        <button type="submit" class="btn btn-danger" ml-6>Delete</button>
        @method('DELETE')
        @csrf
      </form>
    </div>

    </div>
  </div>
@endsection
