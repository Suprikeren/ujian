@extends('layouts.master')
@section('title', 'Dashboard-suplier')
@section('content')
    @push('css')
        <link rel="stylesheet" href="https://cdn.datatables.net/2.2.1/css/dataTables.dataTables.min.css">
    @endpush

    <table id="myTable" class="display">
        <thead>
            <tr>
                <th>Kode Suplier</th>
                <th>Nama Suplier</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($supliers as $suplier)
            <tr>
                <td> {{$suplier->kode_suplier}}</td>
                <td> {{$suplier->nama_suplier}} </td>
            </tr>
             @endforeach
        </tbody>
    </table>




    @push('script')
    <script src="https://cdn.datatables.net/2.2.1/js/dataTables.min.js"></script>
      <script>
        $(document).ready(function() {
            $('#myTable').DataTable();
        });
    </script>
    @endpush
@endsection
