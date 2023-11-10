<!-- MAIN CONTENT START -->
<div class="container-fluid">
    <!--  Row List User Agent -->
    <div class="row">
        <div class="col-lg-12 d-flex align-items-strech">
            <div class="card w-100">
                <div class="card-body">
                    <div class="row d-flex justify-content-end align-items-end form-group mb-3">
                        <div class="col-4">
                            <label class="text-start d-block mb-2">Range Tanggal</label>
                            <input type="text" id="tanggal" name="tanggal" class="form-control" value="" autocomplete="off">
                        </div>
                    </div>
                    <div class="row form-group mb-3">
                        <div class="col text-end">
                            <button type="submit" class="btn btn-info">Lihat</button>
                        </div>
                    </div>
                    <hr>
                    <h5 class="card-title fw-semibold mb-4">Laporan</h5>
                    <table id="table_laporan" class="table table-striped" style="width:100%">
                        <thead>
                            <tr>
                                <th>Tujuan</th>
                                <th>Jam</th>
                                <th>Nama Tamu</th>
                                <th>Nasionality</th>
                                <th>Adult</th>
                                <th>Child</th>
                                <th>Total</th> 
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>Lembongan - Sanur</td>
                                <td>08:15</td>
                                <td>Rich Brian</td>
                                <td>Indonesia</td>
                                <td>2</td>
                                <td>1</td>
                                <td>12.000.000</td>
                            </tr>
                            <tr>
                                <td>Lembongan - Sanur</td>
                                <td>13:00</td>
                                <td>Steven</td>
                                <td>Canada</td>
                                <td>2</td>
                                <td>1</td>
                                <td>20.000.000</td>
                            </tr>
                            <tr>
                                <td>Sanur - Lembongan</td>
                                <td>17:00</td>
                                <td>Ari Pramana</td>
                                <td>Indonesia</td>
                                <td>2</td>
                                <td>1</td>
                                <td>20.000.000</td>
                            </tr>

                        </tbody>
                        <tfoot>
                            <tr>
                                <th>Tujuan</th>
                                <th>Jam</th>
                                <th>Nama Tamu</th>
                                <th>Nasionality</th>
                                <th>Adult</th>
                                <th>Child</th>
                                <th>Total</th> 
                            </tr>
                        </tfoot>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- MAIN CONTENT END -->


