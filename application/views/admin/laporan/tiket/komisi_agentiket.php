<!-- MAIN CONTENT START -->
<div class="container-fluid">
    <!--  Row List User Agent -->
    <div class="row">
        <div class="col-lg-12 d-flex align-items-strech">
            <div class="card w-100">
                <div class="card-body">
                    <form action="<?=base_url()?>laporan/komisi_tiket_agen/<?=$tipeagent_url?>" method="post">
                        <div class="row d-flex justify-content-end align-items-end form-group mb-3">
                            <div class="col-3">
                                <label class="text-start d-block mb-2">Name Agent</label>
                                <select name="agen" class="form-select">
                                    <?php 
                                        foreach ($agent as $dt){
                                            if($tipeagent_url == 'company'){
                                                if($dt['tipe'] == 'company'){
                                    ?>
                                                <option value="<?=$dt["id"]?>" <?php echo ($dt["id"]==$idagent)?"selected":""?>><?=$dt["nama"]?></option>
                                    
                                    <?php 
                                                }
                                            } else if($tipeagent_url == 'general') {
                                                if($dt['tipe'] == 'general'){
                                    ?>
                                                <option value="<?=$dt["id"]?>" <?php echo ($dt["id"]==$idagent)?"selected":""?>><?=$dt["nama"]?></option>
                                    <?php 
                                                }
                                            }
                                        }
                                    ?>
                                </select>
                            </div>
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
                    </form>
                    <hr>
                    <h5 class="card-title fw-semibold mb-4">Laporan</h5>
                    <table id="table_laporan" class="table table-striped" style="width:100%">
                        <thead>
                            <tr>
                                <th>Kode</th>
                                <th>Adult</th>
                                <th>Child</th>
                                <th>FOC</th>
                                <th>Charge</th>
                                <th>Harga Agen</th>
                                <th>Selisih Komisi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($laporan as $dt){?>
                                <tr>
                                    <td><?=$dt["kode_tiket"]?></td>
                                    <td>
                                        <?php 
                                            echo $dt["dws"];
                                        ?>
                                    </td>
                                    <td>
                                        <?php 
                                            echo $dt["anak"];
                                        ?>
                                    </td>
                                    <td>
                                        <?php 
                                            echo $dt["foc"];
                                        ?>
                                    </td>                                    
                                    <td style="text-align:right">
                                        <?php
                                            echo number_format($dt["charge"],0,".",",");
                                        ?>
                                    </td>
                                    <td style="text-align:right">
                                        <?php
                                            if (!empty($dt["return_from"])){
                                                $total=$dt["dws"]+$dt["anak"];
                                                echo number_format($total*$dt["brkt"]+$total*$dt["kmbl"],0,".",",");
                                            }else{
                                                $total=$dt["dws"]+$dt["anak"];
                                                echo number_format($total*$dt["brkt"],0,".",",");
                                            }
                                        ?>
                                    </td>
                                    <td style="text-align:right;">
                                        <?php
                                            if (!empty($dt["return_from"])){
                                                $total = $dt["dws"] + $dt["anak"];
                                                $total = ($total * $dt["brkt"]) + ($total * $dt["kmbl"]);
                                                $selisih_komisi = number_format($dt["charge"] - $total,0,".",",");
                                                if($selisih_komisi < 0){
                                                    echo '<span class="text-danger">(' . trim($selisih_komisi, '-') . ')</span>';
                                                } else {
                                                    echo $selisih_komisi;
                                                }
                                            }else{
                                                $total = $dt["dws"] + $dt["anak"];
                                                $total = $total * $dt['brkt'];
                                                $selisih_komisi = number_format($dt["charge"] - $total,0,".",",");
                                                if($selisih_komisi < 0){
                                                    echo '<span class="text-danger">(' . trim($selisih_komisi, '-') . ')</span>';
                                                } else {
                                                    echo $selisih_komisi;
                                                }
                                            }
                                        ?>
                                    </td>
                                </tr>                                    
                            <?php } ?>
                        </tbody>
                        <tfoot>
                            <tr>
                                <th colspan="1">&nbsp;</th>
                                <th></th>
                                <th></th>
                                <th></th>
                                <th style="text-align:right"></th> 
                            </tr>
                        </tfoot>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- MAIN CONTENT END -->


