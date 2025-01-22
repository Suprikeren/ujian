<div class="modal fade" id="editModal" tabindex="-1" aria-labelledby="editModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editModalLabel">Edit Data Pembelian</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="editForm" method="POST">
                    @csrf
                    @method('PUT')
                    <input type="hidden" id="edit-id" name="id">

                    <div class="mb-3">
                        <label for="edit-no_transaksi" class="form-label">No Transaksi</label>
                        <select name="no_transaksi" id="edit-no_transaksi" class="form-control" required>
                            <option value="" selected>Masukkan No Transaksi</option>
                            @foreach ($transaksis as $transaksi)
                                <option value="{{ $transaksi->id }}">{{ $transaksi->no_transaksi }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="mb-3">
                        <label for="edit-kode_barang" class="form-label">Kode Barang</label>
                        <select name="kode_barang" id="edit-kode_barang" class="js-example-basic-single form-control">
                            <option value="" selected>Masukkan kode barang</option>
                            @foreach ($barang as $item)
                                <option value="{{ $item->id }}">{{ $item->kode_barang }} - {{ $item->nama_barang }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="mb-3">
                        <label for="edit-qty" class="form-label">Jumlah (Qty)</label>
                        <input type="number" class="form-control" id="edit-qty" name="qty" required>
                    </div>

                    <div class="mb-3">
                        <label for="edit-diskon" class="form-label">Diskon (%)</label>
                        <input type="number" class="form-control" id="edit-diskon" name="diskon" required>
                    </div>

                    <button type="submit" id="edit-submit-btn" class="btn btn-warning">Update</button>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
            </div>
        </div>
    </div>
</div>

@push('script')
    <script>
        $(document).ready(function() {
    $('#editModal').on('shown.bs.modal', function () {
        $('#edit-kode_barang').select2({
            placeholder: 'Pilih Kode Barang',
            allowClear: true,
            dropdownParent: $('#editModal')
        });
    });

    $('.btn-edit').click(function() {
        var id = $(this).data('id');
        var no_transaksi = $(this).data('no_transaksi');
        var kode_barang = $(this).data('kode_barang');
        var qty = $(this).data('qty');
        var diskon = $(this).data('diskon');
        var diskon_rp = $(this).data('diskon_rp');
        var total_rp = $(this).data('total_rp');

        $('#edit-id').val(id);
        $('#edit-no_transaksi').val(no_transaksi).trigger('change');
        $('#edit-kode_barang').val(kode_barang).trigger('change');
        $('#edit-qty').val(qty);
        $('#edit-diskon').val(diskon);

        $('#editModal').modal('show');
    });

    $('#editForm').submit(function(e) {
        e.preventDefault();
        $('#edit-submit-btn').prop('disabled', true);

        let id = $('#edit-id').val();
        let no_transaksi = $('#edit-no_transaksi').val();
        let kode_barang = $('#edit-kode_barang').val();
        let qty = $('#edit-qty').val();
        let diskon = $('#edit-diskon').val();
        let token = $("meta[name='csrf-token']").attr("content");

        $.ajax({
            url: `/dashboard/detail/pembelian/update/${id}`,
            type: 'POST',
            data: {
                '_method': 'PUT',
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
                    $('#editModal').modal('hide');
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
                $('#edit-submit-btn').prop('disabled', false);
            }
        });
    });
});

    </script>
@endpush
