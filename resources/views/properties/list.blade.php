
@extends('layouts.app')

@section('content')

<link rel="stylesheet" href="https://cdn.datatables.net/2.3.2/css/dataTables.dataTables.css" />
<script src="https://cdn.datatables.net/2.3.2/js/dataTables.js"></script>

<table id="myTable" class="display">
    <thead>
        <tr>
            <th>Title</th>
            <th>Location</th>
            <th>Image</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($property as $prop)
            <tr>
                <td>{{ $prop->title }}</td>
                <td>{{ $prop->location }}</td>
                <td>
                    @foreach ($prop->images as $image)
                        <img src="{{ asset('/uploads/property/'.$image->name) }}" alt="{{ $image->name }}" style="max-width: 100px; max-height: 100px;">
                    @endforeach
                </td>
            </tr>
        @endforeach
    </tbody>
</table>

<script>
    $(document).ready( function () {
    $('#myTable').DataTable();
} );
</script>
@endsection