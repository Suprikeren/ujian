<!-- Modal Edit Data -->
<div class="modal fade" id="editModal" tabindex="-1" aria-labelledby="editModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editModalLabel">Edit Data Stok Barang</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="editStockForm" method="POST">
                    @csrf
                    <input type="hidden" id="edit_id" name="id">
                    <div class="mb-3">
                        <label for="edit_kode_barang" class="form-label">Kode Barang</label>
                        <select name="kode_barang" id="edit_kode_barang" class="js-example-basic-single form-control">
                            <option value="" selected>Masukkan kode barang</option>
                            @foreach ($barang as $item)
                                <option value="{{ $item->id }}">{{ $item->kode_barang }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="edit_qty" class="form-label">QTY</label>
                        <input type="number" class="form-control" id="edit_qty" name="qty" required>
                    </div>
                    <button type="submit" id="submitEditBtn" class="btn btn-primary">Update</button>
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
    var table = $('#myTable').DataTable();

    $(document).on('click', '.btn-edit', function() {
        let id = $(this).data('id');
        let kode_barang = $(this).data('kode-barang');
        let qty = $(this).data('qty');

        $('#edit_id').val(id);
        $('#edit_qty').val(qty);

        $('#edit_kode_barang').val(kode_barang).trigger('change');

        $('#editModal').modal('show');
    });

    $('#editStockForm').submit(function(e) {
        e.preventDefault();
        $('#submitEditBtn').prop('disabled', true);

        let id = $('#edit_id').val();
        let kode_barang = $('#edit_kode_barang').val();
        let qty = $('#edit_qty').val();
        let token = $("meta[name='csrf-token']").attr("content");

        $.ajax({
            url: `/dashboard/stocks/update/${id}`,
            type: 'PUT',
            data: {
                '_token': token,
                'kode_barang': kode_barang,
                'qty': qty
            },
            headers: {
                'X-CSRF-TOKEN': token
            },
            success: function(response) {
                if (response.success) {
                    Swal.fire({
                        icon: 'success',
                        title: response.message,
                        showConfirmButton: false,
                        timer: 2000
                    }).then(() => {
                        $('#editModal').modal('hide');

                        var row = table.row(function(idx, data, node) {
                            return data[2].includes(id);
                        });

                        if (row.length) {
                            var rowData = row.data();
                            rowData[0] = response.data.kode_barang;
                            rowData[1] = response.data.qty;
                            rowData[2] = `
                                <button type="button" class="btn btn-warning btn-sm btn-edit" data-id="${response.data.id}" data-kode-barang="${response.data.kode_barang}" data-qty="${response.data.qty}">Edit</button>
                                <button type="button" class="btn btn-danger btn-sm btn-delete" data-id="${response.data.id}">Hapus</button>
                            `;

                            row.data(rowData).invalidate();
                            table.row(row).draw();
                        }
                        $.post("/store/ajax_get_zones", { country_id: $('#country').val() }, function(e) {
                            if (e) {
                                $('#edit_kode_barang').html(e);
                                $('#edit_kode_barang').trigger('change');
                            }
                        });

                        $('#submitEditBtn').prop('disabled', false);
                    });
                } else {
                    Swal.fire({
                        icon: 'error',
                        title: 'Terjadi kesalahan!',
                        text: response.message
                    });

                    $('#submitEditBtn').prop('disabled', false);
                }
            },
            error: function(xhr, status, error) {
                console.error("Terjadi kesalahan saat update data:", error);
                Swal.fire({
                    icon: 'error',
                    title: 'Terjadi kesalahan!',
                    text: 'Tidak dapat terhubung ke server. Coba lagi nanti.'
                });

                $('#submitEditBtn').prop('disabled', false);
            }
        });
    });
});

    </script>
@endpush
