<!-- MAIN CONTENT START -->
<div class="container-fluid">
    <!--  Row Daftar User Agent -->
    <div class="row my-4">
        <div class="col-lg-12 d-flex align-items-strech">
            <a href="<?= base_url()?>ticket/tambah_ticket" class="btn btn-primary d-flex align-items-center">
                <i class="ti ti-plus fs-5 me-2"></i>
                <span>
                    Tambah Ticket
                </span>
            </a>
        </div>
    </div>
    <!--  Row List User Agent -->
    <div class="row">
        <div class="col-lg-12 d-flex align-items-strech">
            <div class="card w-100">
                <div class="card-body">
                    <h5 class="card-title fw-semibold mb-4">List Ticket</h5>
                    <table id="table_list_agent" class="table table-striped" style="width:100%">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Tujuan</th>
                                <th>Jam</th>
                                <th>Harga</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>1</td>
                                <td>Lembongan - Sanur</td>
                                <td>08:15</td>
                                <td>Rp.300.000,00</td>
                                <td></td>
                            </tr>
                            <tr>
                                <td>2</td>
                                <td>Sanur - Lembongan</td>
                                <td>09:15</td>
                                <td>Rp.300.000,00</td>
                                <td></td>
                            </tr>
                            <tr>
                                <td>3</td>
                                <td>Lembongan - Sanur</td>
                                <td>13:00</td>
                                <td>Rp.300.000,00</td>
                                <td></td>
                            </tr>
                            <tr>
                                <td>4</td>
                                <td>Sanur - Lembongan</td>
                                <td>14:30</td>
                                <td>Rp.300.000,00</td>
                                <td></td>
                            </tr>
                            <tr>
                                <td>5</td>
                                <td>Lembongan - Sanur</td>
                                <td>16:00</td>
                                <td>Rp.300.000,00</td>
                                <td></td>
                            </tr>
                            <tr>
                                <td>6</td>
                                <td>Sanur - Lembongan</td>
                                <td>17:00</td>
                                <td>Rp.300.000,00</td>
                                <td></td>
                            </tr>
                        </tbody>
                        <tfoot>
                            <tr>
                                <th>ID</th>
                                <th>Tujuan</th>
                                <th>Jam</th>
                                <th>Harga</th>
                                <th>Aksi</th>
                            </tr>
                        </tfoot>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- MAIN CONTENT END -->


