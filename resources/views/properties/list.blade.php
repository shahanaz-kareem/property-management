@extends('layouts.app')

@section('content')
<link rel="stylesheet" href="https://cdn.datatables.net/2.3.2/css/dataTables.dataTables.css" />
  
<script src="https://cdn.datatables.net/2.3.2/js/dataTables.js"></script>
<table id="myTable" class="display">
    <thead>
        <tr>
            <th>Title</th>
            <th>Location</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($property as $prop )
        
       
        <tr>
            <td> {{$prop->title}}</td>  
            <td> {{$prop->location}}</td>
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