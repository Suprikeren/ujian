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
                        <select name="no_transaksi" id="no_transaksi" class="form-control" required>
                            <option value="" selected>Masukkan No Transaksi</option>
                            @foreach ($transaksis as $transaksi)
                                <option value="{{ $transaksi->id }}">{{ $transaksi->no_transaksi }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="mb-3">
                        <label for="kode_barang" class="form-label">Kode Barang</label>
                        <select name="kode_barang" id="kode_barang" class="js-example-basic-single form-control">
                            <option value="" selected>Masukkan kode barang</option>
                            @foreach ($barang as $item)
                                <option value="{{ $item->id }}">{{ $item->kode_barang }} - {{ $item->nama_barang }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="qty" class="form-label">Jumlah (Qty)</label>
                        <input type="number" class="form-control" id="qty" name="qty" required>
                    </div>
                    <div class="mb-3">
                        <label for="diskon" class="form-label">Diskon (%)</label>
                        <input type="number" class="form-control" id="diskon" name="diskon" required>
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

    <script>
        $(document).ready(function() {
            $('#tambahModal').on('shown.bs.modal', function () {
                $('#kode_barang').select2({
                    placeholder: 'Pilih Kode Barang',
                    allowClear: true,
                    dropdownParent: $('#tambahModal')
                });
            });


            $('#stockForm').submit(function(e) {
                e.preventDefault();
                $('#submitBtn').prop('disabled', true);

                let no_transaksi = $('#no_transaksi').val();
                let kode_barang = $('#kode_barang').val();
                let qty = $('#qty').val();
                let diskon = $('#diskon').val();
                let token = $("meta[name='csrf-token']").attr("content");

                $.ajax({
                    url: '/dashboard/detail/pembelian/store',
                    type: 'POST',
                    data: {
                        '_token': token,
                        'no_transaksi': no_transaksi,
                        'kode_barang': kode_barang,
                        'qty': qty,
                        'diskon': diskon,
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
                            $('#stockForm')[0].reset();
                            $('#kode_barang').val('').trigger('change');
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

        $(document).ajaxStop(function(){
    window.location.reload();
});
    </script>
@endpush
