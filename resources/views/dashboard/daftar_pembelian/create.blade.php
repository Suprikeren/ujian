@push('css')
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
@endpush

<button type="button" id="btn-create-post" class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#tambahModal">
    Tambah Data Pembelian
</button>

<div class="modal fade" id="tambahModal" tabindex="-1" aria-labelledby="tambahModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="tambahModalLabel">Tambah Data Pembelian</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="stockForm" method="POST">
                    @csrf
                    <div class="mb-3">
                        <label for="no_transaksi" class="form-label">No Transaksi</label>
                        <input type="text" class="form-control" id="no_transaksi" name="no_transaksi" required>
                    </div>
                    <div class="mb-3">
                        <label for="kode_suplier" class="form-label">Kode Suplier</label>
                        <select name="kode_suplier" id="kode_suplier" class="js-example-basic-single form-control">
                            <option value="" selected>Masukkan kode suplier</option>
                            @foreach ($supliers as $item)
                                <option value="{{ $item->id }}">{{ $item->kode_suplier }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="tanggal_beli" class="form-label">Tanggal Beli</label>
                        <input type="date" class="form-control" id="tanggal_beli" name="tanggal_beli" required>
                    </div>
                    <button type="submit" id="submitBtn" class="btn btn-primary">Simpan</button>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
            </div>
        </div>
    </div>
</div>

@push('script')
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    <script src="https://cdn.datatables.net/2.2.1/js/jquery.dataTables.min.js"></script>

    <script>
        $(document).ready(function() {
            $('#tambahModal').on('shown.bs.modal', function () {
                $('#kode_suplier').select2({
                    placeholder: 'Pilih Kode Suplier',
                    allowClear: true,
                    dropdownParent: $('#tambahModal')
                });
            });
            var table = $('#myTable').DataTable();
            $('#stockForm').submit(function(e) {
                e.preventDefault();
                $('#submitBtn').prop('disabled', true);

                let no_transaksi = $('#no_transaksi').val();
                let kode_suplier = $('#kode_suplier').val();
                let tanggal_beli = $('#tanggal_beli').val();
                let token = $("meta[name='csrf-token']").attr("content");

                $.ajax({
                    url: '/dashboard/pembelian/store',
                    type: 'POST',
                    data: {
                        '_token': token,
                        'no_transaksi': no_transaksi,
                        'kode_suplier': kode_suplier,
                        'tanggal_beli' : tanggal_beli,
                    },
                    headers: {
                        'X-CSRF-TOKEN': token
                    },
                    success: function(response) {
                        Swal.fire({
                            icon: 'success',
                            title: response.message,
                            showConfirmButton: false,
                            timer: 2000
                        }).then(() => {
                            $('#tambahModal').modal('hide');
                            table.row.add([
                                response.data.no_transaksi,
                                response.data.kode_suplier,
                                response.data.tanggal_beli,
                                `<button type="button" class="btn btn-warning btn-sm btn-edit" data-id="${response.data.id}" >Edit</button>
                                 <button type="button" class="btn btn-danger btn-sm btn-delete" data-id="${response.data.id}">Hapus</button>`

                            ]).draw(false);
                            $('#stockForm')[0].reset();
                            $('#kode_suplier').val('').trigger('change');
                            $('#submitBtn').prop('disabled', false);
                        });
                    },
                    error: function(xhr, status, error) {
                        if (xhr.responseJSON) {
                            let errorMessage = xhr.responseJSON.message || 'Terjadi kesalahan pada server.';
                            if (xhr.responseJSON.errors) {
                                let validationErrors = Object.values(xhr.responseJSON.errors).join('<br>');
                                errorMessage = validationErrors;
                            }
                            Swal.fire({
                                icon: 'error',
                                title: 'Terjadi kesalahan!',
                                html: errorMessage
                            });
                        } else {
                            Swal.fire({
                                icon: 'error',
                                title: 'Terjadi kesalahan!',
                                text: 'Tidak dapat terhubung ke server. Coba lagi nanti.'
                            });
                        }
                        $('#submitBtn').prop('disabled', false);
                    }
                });
            });
        });
    </script>
@endpush
