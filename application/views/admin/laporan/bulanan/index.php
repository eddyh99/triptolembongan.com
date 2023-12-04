<!-- MAIN CONTENT START -->
<div class="container-fluid">
    <!--  Row List User Agent -->
    <div class="row">
        <div class="col-lg-12 d-flex align-items-strech">
            <div class="card w-100 mt-5">
                <div class="card-body ">
                    <form action="<?=base_url()?>laporan/rangkuman_bulanan" method="post">
                        <div class="row d-flex justify-content-end align-items-end form-group mb-3">
                            <div class="col-3">
                                <label class="text-start d-block mb-2">Tipe Agent</label>
                                <select name="tipe" class="form-select">
                                    <option>--- Pilih Tipe Agent ---</option>
                                    <option value="company">Company</option>
                                    <option value="general">General</option>
                                </select>
                            </div>
                            <div class="col-4">
                                <label class="text-start d-block mb-2">Select Month</label>
                                <input type="text" id="tanggal" name="tanggal" class="form-control" autocomplete="off">
                            </div>
                        </div>
                        <div class="row form-group mb-3">
                            <div class="col text-end">
                                <button type="submit" class="btn btn-info">Lihat</button>
                            </div>
                        </div>
                    </form>
                    <hr>
                    <h5 class="card-title fw-semibold mb-4">Rangkuman Bulanan</h5>
                    <table id="table_rangkuman_bulanan" class="table table-striped" style="width:100%">
                        <thead>
                            <tr>
                                <th>Agen</th>
                                <th>Jumlah Tamu</th>
                                <th>Komisi</th> 
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach($laporan as $dt){?>
                                <tr>
                                    <td><?= $dt['namaagen']?></td>
                                    <td><?= $dt['tamu']?></td>
                                    <td>
                                        <?php
                                            $komisi = number_format($dt["charge"] - $dt["rate"],0,".",",");
                                            if($komisi < 0){
                                                echo '<span class="text-danger">(' . trim($komisi, '-') . ')</span>';
                                            } else {
                                                echo $komisi;
                                            }
                                        ?>
                                    </td>
                                </tr>
                            <?php }?>
                        </tbody>
                        <tfoot>
                            <tr>
                                <th colspan="1">&nbsp;</th>
                                <th></th>
                                <th></th> 
                            </tr>
                        </tfoot>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- MAIN CONTENT END -->


