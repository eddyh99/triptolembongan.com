<!-- MAIN CONTENT START -->
<div class="container-fluid">
    <!--  Row List User Agent -->
    <div class="row">
        <div class="col-lg-12 d-flex align-items-strech">
            <div class="card w-100">
                <div class="card-body">
                    <form action="<?=base_url()?>laporan/peragenpaket" method="post">
                        <div class="row d-flex justify-content-end align-items-end form-group mb-3">
                            <div class="col-3">
                                <label class="text-start d-block mb-2">Nama Agen</label>
                                <select name="agen" class="form-select">
                                    <option>--- Pilih Nama Agent ---</option>
                                    <?php foreach ($agent as $dt){?>
                                        <option value="<?=$dt["id"]?>" <?php echo ($dt["id"]==$idagent)?"selected":""?>><?=$dt["nama"]?></option>
                                    <?php }?>
                                </select>
                            </div>
                            <div class="col-4">
                                <label class="text-start d-block mb-2">Range Tanggal</label>
                                <input type="text" id="tanggal" name="tanggal" class="form-control"  autocomplete="off">
                            </div>
                        </div>
                        <div class="row form-group mb-3">
                            <div class="col text-end">
                                <button type="submit" class="btn btn-info">Lihat</button>
                            </div>
                        </div>
                    </form>
                    <hr>
                    <h5 class="card-title fw-semibold mb-4">Laporan</h5>
                    <table id="table_laporan" class="table table-striped" style="width:100%">
                        <thead>
                            <tr>
                                <th>Tgl Booking</th>
                                <th>Nama Paket</th>
                                <th>Adult</th>
                                <th>Child</th>
                                <th>FOC</th>
                                <th>Total</th> 
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($laporan as $dt){?>
                                <tr>
                                    <td><?=$dt["tgl_pesan"]?></td>
                                    <td><?=$dt["namapaket"]?></td>
                                    <td><?=$dt["dws"]?></td>
                                    <td><?=$dt["anak"]?></td>
                                    <td><?=$dt["foc"]?></td>
                                    <td style="text-align:right"><?php
                                            $total=$dt["dws"]+$dt["anak"];
                                            echo number_format($total*$dt["harga"],0,".",",");
                                    ?></td>
                                </tr>                                    
                            <?php } ?>
                        </tbody>
                        <tfoot>
                            <tr>
                                <th colspan="2">&nbsp;</th>
                                <th></th>
                                <th></th>
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


