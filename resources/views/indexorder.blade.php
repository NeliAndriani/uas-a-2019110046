@extends('layout.master')
@section('title', 'Orders List')
@section('content')

<div class="table-responsive">
    <div class="table-wrapper">
        <div class="table-title">
            <div class="row">
                <div class="col-sm-6">
                    <h2><b>Orders List</b></h2>
                </div>
            </div>
        </div>
        <table class="table table-striped table-hover">
            <thead>
                <tr>
                    <th>Id</th>
                    <th>Status</th>
                    <th>Detail Order</th>
                </tr>
            </thead>
            <tbody>

@foreach($orders as $order)
    <tr data-entry-id="{{ $order->id }}">
        <td>
            {{ $order->id ?? '' }}
        </td>
        <td>
            {{ $order->status ? 'Selesai' : 'Menunggu Pembayaran'}}
        </td>
        <td>
            <ul>
            @foreach($order->menus as $item)
                <li>{{ $item->nama }} ({{ $item->pivot->quantity }} x Rp{{ $item->harga }})</li>
            @endforeach
            </ul>
        </td>
        <td>
            {{-- ... buttons ... --}}
        </td>

    </tr>
@endforeach
            </tbody>
        </table>


@endsection
