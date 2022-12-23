@extends('layout.master')
@section('title', 'Order')
@section('content')

    <form action="{{ route('orderStore') }}" method="POST">
        @csrf
        <div class="card">
            <div class="card-header">
                <h3><b>Tambah Order</b></h3>
            </div>
            <div class="card-body">
                <table class="table" id="menus_table">
                    <thead>
                        <tr>
                            <th>Menu</th>
                            <th>Quantity</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr id="menu0">
                            <td>
                                <select name="menus[]" class="form-control">
                                    <option value="">-- choose menu --</option>
                                    @foreach ($menus as $menu)
                                        <option value="{{ $menu->id }}">
                                            {{ $menu->nama }} (Rp{{ $menu->harga }})
                                        </option>
                                    @endforeach
                                </select>
                            </td>
                            <td>
                                <input type="number" name="quantities[]" class="form-control" value="1" />
                            </td>
                        </tr>
                        <tr id="menu1"></tr>
                    </tbody>
                </table>
                <div class="row">
                    <div class="col-md-12">
                        <button id="add_row" class="btn btn-primary pull-left">+ Add Row</button>
                        <button id='delete_row' class="pull-right btn btn-danger">- Delete Row</button>
                    </div>
                </div>

                <br>
                <div class="row">
                    <div class="form-group col-md-6 mb-3">
                        <label for="status">Status</label>
                        <select id="status" class="form-control @error('status') is-invalid @enderror" name="status"
                            value="{{ old('status') }}">
                            <option selected>Pilih...</option>
                            <option value="1">Selesai</option>
                            <option value="0">Menunggu Pembayaran</option>
                        </select>
                    </div>
                </div>

            </div>
        </div>
        <br>
        <div class="row">
            <div class="col-md-12">
            <input class="btn btn-success btn-md " type="submit" value="Save">
        </div>
        </div>
    </form>
@endsection

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    $(document).ready(function() {
        let row_number = 1;
        $("#add_row").click(function(e) {
            e.preventDefault();
            let new_row_number = row_number;
            let new_row = '<tr id="menu' + new_row_number + '">';
            new_row += '<td>';
            new_row += '<select name="menus[]" class="form-control">';
            new_row += '<option value="">-- choose menu --</option>';
            @foreach ($menus as $menu)
                new_row +=
                    '<option value="{{ $menu->id }}">{{ $menu->nama }} (Rp{{ $menu->harga }})</option>';
            @endforeach
            new_row += '</select>';
            new_row += '</td>';
            new_row +=
                '<td><input type="number" name="quantities[]" class="form-control" value="1" /></td>';
            new_row += '</tr>';
            $('#menus_table tbody').append(new_row);
            row_number++;
        });

        $("#delete_row").click(function(e) {
            e.preventDefault();
            if (row_number > 1) {
                $('#menus_table tbody tr:last-child').remove();
                row_number--;
            }
        });
    });
</script>
