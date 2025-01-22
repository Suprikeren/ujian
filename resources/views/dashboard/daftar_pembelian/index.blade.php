@extends('layouts.master')
@section('title', 'Dashboard-pembelian')
@section('content')
    @push('css')
        <link rel="stylesheet" href="https://cdn.datatables.net/2.2.1/css/dataTables.dataTables.min.css">
    @endpush

    <div class="d-flex justify-content-between align-items-center mb-3">
        <h3 class="mb-0">Daftar pembelian</h3>
        @include('dashboard.daftar_pembelian.create')
    </div>
    <table id="myTable" class="display">
        <thead>
            <tr>
                <th>No Transaksi</th>
                <th>Kode Suplier</th>
                <th>Tanggal Beli</th>
                <th>action</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($pembelians as $key)
            <tr>

                <td> {{$key->no_transaksi}}</td>
                <td> {{$key->suplier->kode_suplier}}</td>
                <td> {{$key->tanggal_beli}} </td>
                <td>

                    <button type="button" class="btn btn-warning btn-sm btn-edit"
    data-id="{{ $key->id }}"
    data-no_transaksi="{{ $key->no_transaksi }}"
    data-kode_suplier="{{ $key->kode_suplier }}"
    data-tanggal_beli="{{ $key->tanggal_beli }}">
    Edit
</button>
                    <button type="button" class="btn btn-danger btn-sm btn-delete" data-id="{{ $key->id }}">Hapus</button>
                </td>
            </tr>
             @endforeach
        </tbody>
    </table>

                    @include('dashboard.daftar_pembelian.edit')




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
                        url: `/dashboard/pembelian/delete/${id}`,
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
