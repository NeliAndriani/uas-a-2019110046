@extends('layout.master')
@section('title', 'Menus List')
@push('css_after')
    <style>
        td {
            max-width: 0;
            overflow: hidden;
            text-overflow: ellipsis;
            white-space: nowrap;
        }
    </style>
@endpush
@section('content')

    @if (session()->has('success'))
        <div class="alert alert-success" role="alert">
            {{ session()->get('success') }}
        </div>
    @endif


    <div class="table-responsive">
        <div class="table-wrapper">
            <div class="table-title">
                <div class="row">
                    <div class="col-sm-6">
                        <h2><b>Menus List</b></h2>
                    </div>
                    <div class="col-sm-6">
                        <a href="{{ route('menus.create') }}" class="btn btn-success">
                            <i class="fa fa-plus fa-fw" aria-hidden="true"></i>
                            <span>Add New Menu</span>
                        </a>
                    </div>
                </div>
            </div>
            <table class="table table-striped table-hover">
                <thead>
                    <tr>
                        <th>Id</th>
                        <th>Nama</th>
                        <th>Rekomendasi</th>
                        <th>Harga</th>
                    </tr>
                </thead>
                <tbody>

                    @forelse ($menus as $menu)
                        <tr>
                            <td>{{ $menu->id }}</td>
                            <td style="width: 30%">
                                <a href="{{ route('menus.show', $menu->id) }}">
                                    {{ $menu->nama }}
                                </a>
                            </td>
                            <td>{{ $menu->rekomendasi ? 'Ya' : 'Tidak' }}</td>
                            <td>{{ $menu->harga }}</td>
                        </tr>
                    @empty
                        <tr>
                            <td align="center" colspan="6">No data yet.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
@endsection
