@extends('layouts.master')
@section('title', 'Dashboard-stock')
@section('content')
    @push('css')
    <meta name="csrf-token" content="{{ csrf_token() }}">
        <link rel="stylesheet" href="https://cdn.datatables.net/2.2.1/css/dataTables.dataTables.min.css">
    @endpush

    <div class="d-flex justify-content-between align-items-center mb-3">
        <a href="{{route('dashboard.stock.export-pdf')}}" class="mb-0">export PDF</a>
        <a href="{{route('dashboard.stock.export-excel')}}" class="mb-0">export Excel</a>
        @include('dashboard.stock.create')
    </div>
    <table id="myTable" class="display">
        <thead>
            <tr>
                <th>Kode Barang</th>
                <th>QTY</th>
                <th>action</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($stocks as $stock)
            <tr>
                <td> {{$stock->barang->kode_barang}}</td>
                <td> {{$stock->qty}} </td>
                <td>
                    <button type="button" class="btn btn-warning btn-sm btn-edit" data-id="{{ $stock->id }}" data-kode-barang="{{ $stock->barang->id }}" data-kode-barang-text="{{ $stock->barang->kode_barang }}" data-qty="{{ $stock->qty }}">Edit</button>
                    <button type="button" class="btn btn-danger btn-sm btn-delete" data-id="{{ $stock->id }}">Hapus</button>
                </td>
            </tr>
             @endforeach
        </tbody>
    </table>

                    @include('dashboard.stock.edit')




    @push('script')
    <script src="https://cdn.datatables.net/2.2.1/js/dataTables.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <script>
    $(document).ready(function() {
        $('#myTable').DataTable();

        $(document).on('click', '.btn-delete', function() {
            let id = $(this).data('id');
            let row = $(this).closest('tr');
            Swal.fire({
                title: 'Apakah Anda yakin?',
                text: 'Data ini akan dihapus!',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonText: 'Hapus',
                cancelButtonText: 'Batal'
            }).then((result) => {
                if (result.isConfirmed) {
                    $.ajax({
                        url: `/dashboard/stocks/delete/${id}`,
                        type: 'DELETE',
                        data: {
                            '_token': $('meta[name="csrf-token"]').attr('content')
                        },
                        success: function(response) {
                            if (response.success) {
                                Swal.fire({
                                    icon: 'success',
                                    title: 'Data berhasil dihapus!',
                                    showConfirmButton: false,
                                    timer: 2000
                                }).then(() => {
                                    var table = $('#myTable').DataTable();
                                    table.row(row).remove().draw();
                                });
                            } else {
                                Swal.fire({
                                    icon: 'error',
                                    title: 'Gagal menghapus data!',
                                    text: response.message
                                });
                            }
                        },
                        error: function(xhr, status, error) {
                            console.log("Error:", error);
                            Swal.fire({
                                icon: 'error',
                                title: 'Terjadi kesalahan!',
                                text: 'Tidak dapat terhubung ke server. Coba lagi nanti.'
                            });
                        }
                    });
                }
            });
        });
    });
</script>

    @endpush

@endsection
