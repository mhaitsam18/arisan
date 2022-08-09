<div id="layoutSidenav_content">
    <main>
        <div class="container-fluid px-4">
            <h2 class="mt-4"><?= $title;  ?></h2>
            <div class="row">
                <div class="card mb-4">
                    <div class="card-header">
                        <i class="fas fa-table me-1"></i>
                        Data Barang
                    </div>

                    <div class="card-body">
                        <table class="table table-bordered" id="dataTable2">
                            <?= $this->session->flashdata('message'); ?>
                            <!-- Button trigger modal -->
                            <thead>
                                <tr class="table-warning">
                                    <th>#</th>
                                    <th>Nama Barang</th>
                                    <th>Volume</th>
                                    <th>Butuh</th>
                                    <th>Terpenuhi</th>
                                    <th>Kurang</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $count = 0;
                                $jml = 0;
                                foreach ($rows as $row) :
                                    $count = $count + 1;
                                ?>
                                    <tr>
                                        <th scope=" row"><?= $count ?></th>
                                        <td><?= $row->nama_barang ?></td>
                                        <td><?= $row->volume ?></td>
                                        <td><?= $row->jumlah_kebutuhan ?></td>
                                        <td><?= $row->terpenuhi ?></td>
                                        <td><?= ($row->jumlah_kebutuhan - $row->terpenuhi < 0) ? 0 : $row->jumlah_kebutuhan - $row->terpenuhi ?></td>
                                        <td>
                                            <button class="btn btn-success btn-sm tombol-terpenuhi" data-placement="top" data-bs-toggle="modal" data-bs-target="#terpenuhiModal" data-id="<?= $row->id ?>">Tambah stok terpenuhi</button>
                                        </td>
                                    </tr>
                                <?php $jml += $row->harga_beli;
                                endforeach; ?>
                            <tfoot>
                                <tr>

                                </tr>
                                <!-- </tfoot>
                            <tr>
                                <th colspan="5">Total</th>
                                <th colspan="2">Rp.<?= number_format($jml, 0, ',', '.') ?></th>
                            </tr>
                            </tbody> -->
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </main>

    <div class="modal fade" id="terpenuhiModal" tabindex="-1" aria-labelledby="terpenuhiModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <?= $this->session->flashdata('message2'); ?>
                    <h5 class="modal-title" id="terpenuhiModalLabel">Edit Stok Terpenuhi</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="<?= base_url('penyelenggara/update_terpenuhi') ?>" method="post" enctype="multipart/form-data">
                        <input type="hidden" name="id" id="id">
                        <div class="row mb-3">
                            <div class="col-sm-12">
                                <label for="terpenuhi" class="col-sm-12 col-form-label">Stok Terpenuhi</label>
                                <input type="number" min="0" class="form-control" id="terpenuhi" name="terpenuhi">
                                <?= form_error('terpenuhi', '<small class="text-danger pl-3">', '</small>'); ?>
                            </div>
                        </div>
                        <button type="button" class="btn btn-secondary btn-sm" data-bs-dismiss="modal">Batal</button>
                        <button type="submit" class="btn btn-success btn-sm">Simpan</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <script src="https://code.jquery.com/jquery-3.1.1.min.js"></script>
    <script type="text/javascript">
        $(function() {

            $('.tombol-terpenuhi').on('click', function() {
                const id = $(this).data('id');
                jQuery.ajax({
                    url: '<?= base_url('Penyelenggara/getUpdateTerpenuhi') ?>',
                    data: {
                        id: id
                    },
                    method: 'post',
                    dataType: 'json',
                    success: function(data) {
                        console.log(data);
                        $('#id').val(data.id);
                        $('#terpenuhi').val(data.terpenuhi);
                        $("#terpenuhi").attr("max", data.jumlah_kebutuhan);
                    }
                });
            });
        });
    </script>