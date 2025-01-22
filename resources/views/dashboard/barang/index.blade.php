@extends('layouts.master')
@section('title', 'Dashboard-barang')
@section('content')
    @push('css')
        <link rel="stylesheet" href="https://cdn.datatables.net/2.2.1/css/dataTables.dataTables.min.css">
    @endpush

    <table id="myTable" class="display">
        <thead>
            <tr>
                <th>Kode Barang</th>
                <th>Nama Barang</th>
                <th> Satuan </th>
                <th>Harga Beli</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($barangs as $barang)
            <tr>
                <td> {{$barang->kode_barang}}</td>
                <td> {{$barang->nama_barang}} </td>
                <td>{{$barang->satuan}} </td>
                <td>{{$barang->harga_beli}} </td>
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
