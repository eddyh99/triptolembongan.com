<!-- MAIN CONTENT START -->
<div class="container-fluid">
    <!--  Row Departure Today -->
    <div class="row">
        <div class="col-lg-12 d-flex align-items-strech">
            <div class="card w-100">
                <div class="card-body">
                    <h5 class="card-title fw-semibold mb-4">Passanger List</h5>
                    <table id="table_laporan" class="table table-striped" style="width:100%">
                        <thead>
                            <tr>
                                <th>Name</th>
                                <th>Nationality</th>
                                <th>OW</th>
                                <th>Return</th>
                                <th>Payment</th>
                                <th>Ticket</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach($result as $dt){?>
                                <tr>
                                    <td><?= $dt['namatamu']?></td>
                                    <td><?= $dt['nasionality']?></td>
                                    <td><?=empty($dt["ow"])?"":"yes"?></td>
                                    <td><?=empty($dt["ow"])?"yes":""?></td>
                                    <td><?= $dt['payment']?></td>
                                    <td><?= $dt['kode_tiket']?></td>
                                </tr>
                            <?php }?>
                        </tbody>
                        <tfoot>
                            <tr>
                                <th>Name</th>
                                <th>Nationality</th>
                                <th>OW</th>
                                <th>Return</th>
                                <th>Payment</th>
                                <th>Ticket</th>
                            </tr>
                        </tfoot>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>



