<?php require('list_negara.php'); ?>
<!-- MAIN CONTENT START -->
<div class="container-fluid">
    <!-- <div class="row my-4">
        <div class="col-lg-12 d-flex align-items-strech">
            <a href="<?= base_url()?>ticket" class="btn btn-outline-primary d-flex align-items-center">
                <i class="ti ti-chevron-left fs-5 me-2"></i>
                <span>
                    Kembali
                </span>
            </a>
        </div>
    </div> -->
    <!--  Row Daftar User Agent -->
    <div class="row">
        <div class="col-lg-12 d-flex align-items-strech">
            <div class="card w-100">
                <div class="card-body">
                    <h5 class="card-title fw-semibold mb-4">Booking Ticket</h5>
                    <form action="<?= base_url()?>booking/booking_tiket_proses" method="POST">
                        <div class="row">
                            <div class="row">
                                <div class="row">
                                    <div class="mb-4 col-12 col-md-6">
                                        <label for="kode_ticket" class="form-label">Kode Ticket</label>
                                        <div class="wrapper-kode-ticket d-flex align-items-center justify-content-between">
                                            <input type="text" class="fw-bold fs-5 text-success border-0" id="kode_ticket" name="kode_ticket" readonly 
                                                value="TIX<?php $num = mt_rand(100000,999999); printf("%d", $num);?>"/>
                                            <i class="ti ti-ticket fs-6 text-success"></i>
                                        </div>
                                    </div>
                                    <div class="mb-4 col-12 col-md-5 ">
                                        <label for="freecharge" class="form-label">Pilih Agen</label>
                                        <select class="agent-select2" name="nama_agent">
                                            <option ></option>
                                            <?php foreach($agent as $ag){?>
                                                <option value="<?= $ag['id']?>"><?= $ag['nama']?></option>
                                            <?php }?>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            
                            <!-- DEWASA -->
                            <div class="row wraping-add-booking-dewasa">
                                <div class="row">
                                    <h4 class="fw-bolder text-decoration-underline">Dewasa</h4>
                                    <div class="mb-4 col-12 col-md-6 wrap-nama-tamu">
                                        <label for="nama_tamu_dewasa" class="form-label">Nama Tamu</label>
                                        <div class="d-flex align-items-center">
                                            <select id="nama_tamu_dewasa" class="nama-tamu-select2" name="nama_tamu_dewasa[]">
                                                <option></option>
                                            </select>
                                            <!-- <input type="text" class="form-control " id="nama_tamu_dewasa" name="nama_tamu_dewasa[]" placeholder="masukkan nama tamu..."> -->
                                        </div>
                                    </div>
                                    <div class="mb-4 col-12 col-md-5 wrap-nasionality">
                                        <label for="nasionality-select2" class="form-label">Nasionality</label>
                                        <select name="nasionality_dewasa[]" id="nasionality-dewasa-select2" class="nasionality-select2">
                                            <option value=""></option>
                                            <?php foreach($list_negara as $dt){?>
                                                <option value="<?= $dt['name']?>"><?= $dt['name']?></option>
                                            <?php }?>
                                        </select>
                                    </div>
                                    <div class="col-md-1 d-flex align-items-center">
                                        <i class="ti ti-circle-plus add-nama-tamu-dewasa fs-8" style="cursor: pointer;"></i>
                                        <!-- <input type="submit"> -->
                                        <!-- <i class="ti ti-circle-check save-tamu-dewasa fs-8 text-success" id="save-tamu-dewasa" style="cursor: pointer;"></i> -->
                                    </div>
                                </div>
                            </div>
    
                            <hr>

                            <!-- ANAK -->
                            <div class="row wraping-add-booking-anak">
                                <div class="row">
                                    <h4 class="fw-bolder text-decoration-underline">Anak-anak</h4>
                                    <div class="mb-4 col-12 col-md-6 wrap-nama-tamu">
                                        <label for="nama_tamu_anak" class="form-label">Nama Tamu</label>
                                        <div class="d-flex align-items-center">
                                            <select id="nama_tamu_anak" class="nama-tamu-select2" name="nama_tamu_anak[]">
                                                <option></option>
                                            </select>
                                            <!-- <input type="text" class="form-control" id="nama_tamu_anak" name="nama_tamu_anak[]" placeholder="masukkan nama tamu..."> -->
                                        </div>
                                    </div>
                                    <div class="mb-4 col-12 col-md-5 wrap-nasionality">
                                        <label for="nasionality" class="form-label">Nasionality</label>
                                        <select name="nasionality_anak[]" id="nasionality-anak-select2" class="nasionality-select2">
                                            <option value=""></option>
                                            <?php foreach($list_negara as $dt){?>
                                                <option value="<?= $dt['name']?>"><?= $dt['name']?></option>
                                            <?php }?>
                                        </select>
                                    </div>
                                    <div class="col-md-1 d-flex align-items-center">
                                        <i class="ti ti-circle-plus add-nama-tamu-anak fs-8" style="cursor: pointer;"></i>
                                    </div>
                                </div>
                            </div>

                            <hr>

                            <!-- FOC -->
                            <div class="row wraping-add-booking-foc mb-3">
                                <div class="row">
                                    <h4 class="fw-bolder text-decoration-underline">Free of Charge</h4>
                                    <div class="mb-4 col-12 col-md-6 wrap-nama-tamu">
                                        <label for="nama_tamu_foc" class="form-label">Nama Tamu</label>
                                        <div class="d-flex align-items-center">
                                            <select id="nama_tamu_foc" class="nama-tamu-select2" name="nama_tamu_foc[]">
                                                <option></option>
                                            </select>
                                            <!-- <input type="text" class="form-control" id="nama_tamu_foc" name="nama_tamu_foc[]" placeholder="masukkan nama tamu..."> -->
                                        </div>
                                    </div>
                                    <div class="mb-4 col-12 col-md-5 wrap-nasionality">
                                        <label for="nasionality" class="form-label">Nasionality</label>
                                        <select name="nasionality_foc[]" id="nasionality-foc-select2" class="nasionality-select2">
                                            <option value=""></option>
                                            <?php foreach($list_negara as $dt){?>
                                                <option value="<?= $dt['name']?>"><?= $dt['name']?></option>
                                            <?php }?>
                                        </select>
                                    </div>
                                    <div class="col-md-1 d-flex align-items-center">
                                        <i class="ti ti-circle-plus add-nama-tamu-foc fs-8" style="cursor: pointer;"></i>
                                    </div>
                                </div>
                            </div>

                            <!-- <select class="nasionality-select2" name="nasionality[]">
                                <option ></option>
                                <option value="AF" data-capital="Kabul">Afghanistan</option>
                                <option value="AX" data-capital="Mariehamn">Aland Islands</option>
                                <option value="AL" data-capital="Tirana">Albania</option>
                                <option value="DZ" data-capital="Algiers">Algeria</option>
                                <option value="AS" data-capital="Pago Pago">American Samoa</option>
                                <option value="AD" data-capital="Andorra la Vella">Andorra</option>
                                <option value="AO" data-capital="Luanda">Angola</option>
                                <option value="AI" data-capital="The Valley">Anguilla</option>
                                <option value="AG" data-capital="St. John's">Antigua and Barbuda</option>
                                <option value="AR" data-capital="Buenos Aires">Argentina</option>
                                <option value="AM" data-capital="Yerevan">Armenia</option>
                                <option value="AW" data-capital="Oranjestad">Aruba</option>
                                <option value="AU" data-capital="Canberra">Australia</option>
                                <option value="AT" data-capital="Vienna">Austria</option>
                                <option value="AZ" data-capital="Baku">Azerbaijan</option>
                                <option value="BS" data-capital="Nassau">Bahamas</option>
                                <option value="BH" data-capital="Manama">Bahrain</option>
                                <option value="BD" data-capital="Dhaka">Bangladesh</option>
                                <option value="BB" data-capital="Bridgetown">Barbados</option>
                                <option value="BY" data-capital="Minsk">Belarus</option>
                                <option value="BE" data-capital="Brussels">Belgium</option>
                                <option value="BZ" data-capital="Belmopan">Belize</option>
                                <option value="BJ" data-capital="Porto-Novo">Benin</option>
                                <option value="BM" data-capital="Hamilton">Bermuda</option>
                                <option value="BT" data-capital="Thimphu">Bhutan</option>
                                <option value="BO" data-capital="Sucre">Bolivia</option>
                                <option value="BA" data-capital="Sarajevo">Bosnia and Herzegovina</option>
                                <option value="BW" data-capital="Gaborone">Botswana</option>
                                <option value="BR" data-capital="Brasília">Brazil</option>
                                <option value="IO" data-capital="Diego Garcia">British Indian Ocean Territory</option>
                                <option value="BN" data-capital="Bandar Seri Begawan">Brunei Darussalam</option>
                                <option value="BG" data-capital="Sofia">Bulgaria</option>
                                <option value="BF" data-capital="Ouagadougou">Burkina Faso</option>
                                <option value="BI" data-capital="Bujumbura">Burundi</option>
                                <option value="CV" data-capital="Praia">Cabo Verde</option>
                                <option value="KH" data-capital="Phnom Penh">Cambodia</option>
                                <option value="CM" data-capital="Yaoundé">Cameroon</option>
                                <option value="CA" data-capital="Ottawa">Canada</option>
                                <option value="KY" data-capital="George Town">Cayman Islands</option>
                                <option value="CF" data-capital="Bangui">Central African Republic</option>
                                <option value="TD" data-capital="N'Djamena">Chad</option>
                                <option value="CL" data-capital="Santiago">Chile</option>
                                <option value="CN" data-capital="Beijing">China</option>
                                <option value="CX" data-capital="Flying Fish Cove">Christmas Island</option>
                                <option value="CC" data-capital="West Island">Cocos (Keeling) Islands</option>
                                <option value="CO" data-capital="Bogotá">Colombia</option>
                                <option value="KM" data-capital="Moroni">Comoros</option>
                                <option value="CK" data-capital="Avarua">Cook Islands</option>
                                <option value="CR" data-capital="San José">Costa Rica</option>
                                <option value="HR" data-capital="Zagreb">Croatia</option>
                                <option value="CU" data-capital="Havana">Cuba</option>
                                <option value="CW" data-capital="Willemstad">Curaçao</option>
                                <option value="CY" data-capital="Nicosia">Cyprus</option>
                                <option value="CZ" data-capital="Prague">Czech Republic</option>
                                <option value="CI" data-capital="Yamoussoukro">Côte d'Ivoire</option>
                                <option value="CD" data-capital="Kinshasa">Democratic Republic of the Congo</option>
                                <option value="DK" data-capital="Copenhagen">Denmark</option>
                                <option value="DJ" data-capital="Djibouti">Djibouti</option>
                                <option value="DM" data-capital="Roseau">Dominica</option>
                                <option value="DO" data-capital="Santo Domingo">Dominican Republic</option>
                                <option value="EC" data-capital="Quito">Ecuador</option>
                                <option value="EG" data-capital="Cairo">Egypt</option>
                                <option value="SV" data-capital="San Salvador">El Salvador</option>
                                <option value="GQ" data-capital="Malabo">Equatorial Guinea</option>
                                <option value="ER" data-capital="Asmara">Eritrea</option>
                                <option value="EE" data-capital="Tallinn">Estonia</option>
                                <option value="ET" data-capital="Addis Ababa">Ethiopia</option>
                                <option value="FK" data-capital="Stanley">Falkland Islands</option>
                                <option value="FO" data-capital="Tórshavn">Faroe Islands</option>
                                <option value="FM" data-capital="Palikir">Federated States of Micronesia</option>
                                <option value="FJ" data-capital="Suva">Fiji</option>
                                <option value="FI" data-capital="Helsinki">Finland</option>
                                <option value="MK" data-capital="Skopje">Former Yugoslav Republic of Macedonia</option>
                                <option value="FR" data-capital="Paris">France</option>
                                <option value="PF" data-capital="Papeete">French Polynesia</option>
                                <option value="GA" data-capital="Libreville">Gabon</option>
                                <option value="GM" data-capital="Banjul">Gambia</option>
                                <option value="GE" data-capital="Tbilisi">Georgia</option>
                                <option value="DE" data-capital="Berlin">Germany</option>
                                <option value="GH" data-capital="Accra">Ghana</option>
                                <option value="GI" data-capital="Gibraltar">Gibraltar</option>
                                <option value="GR" data-capital="Athens">Greece</option>
                                <option value="GL" data-capital="Nuuk">Greenland</option>
                                <option value="GD" data-capital="St. George's">Grenada</option>
                                <option value="GU" data-capital="Hagåtña">Guam</option>
                                <option value="GT" data-capital="Guatemala City">Guatemala</option>
                                <option value="GG" data-capital="Saint Peter Port">Guernsey</option>
                                <option value="GN" data-capital="Conakry">Guinea</option>
                                <option value="GW" data-capital="Bissau">Guinea-Bissau</option>
                                <option value="GY" data-capital="Georgetown">Guyana</option>
                                <option value="HT" data-capital="Port-au-Prince">Haiti</option>
                                <option value="VA" data-capital="Vatican City">Holy See</option>
                                <option value="HN" data-capital="Tegucigalpa">Honduras</option>
                                <option value="HK" data-capital="Hong Kong">Hong Kong</option>
                                <option value="HU" data-capital="Budapest">Hungary</option>
                                <option value="IS" data-capital="Reykjavik">Iceland</option>
                                <option value="IN" data-capital="New Delhi">India</option>
                                <option value="ID" data-capital="Jakarta">Indonesia</option>
                                <option value="IR" data-capital="Tehran">Iran</option>
                                <option value="IQ" data-capital="Baghdad">Iraq</option>
                                <option value="IE" data-capital="Dublin">Ireland</option>
                                <option value="IM" data-capital="Douglas">Isle of Man</option>
                                <option value="IL" data-capital="Jerusalem">Israel</option>
                                <option value="IT" data-capital="Rome">Italy</option>
                                <option value="JM" data-capital="Kingston">Jamaica</option>
                                <option value="JP" data-capital="Tokyo">Japan</option>
                                <option value="JE" data-capital="Saint Helier">Jersey</option>
                                <option value="JO" data-capital="Amman">Jordan</option>
                                <option value="KZ" data-capital="Astana">Kazakhstan</option>
                                <option value="KE" data-capital="Nairobi">Kenya</option>
                                <option value="KI" data-capital="South Tarawa">Kiribati</option>
                                <option value="KW" data-capital="Kuwait City">Kuwait</option>
                                <option value="KG" data-capital="Bishkek">Kyrgyzstan</option>
                                <option value="LA" data-capital="Vientiane">Laos</option>
                                <option value="LV" data-capital="Riga">Latvia</option>
                                <option value="LB" data-capital="Beirut">Lebanon</option>
                                <option value="LS" data-capital="Maseru">Lesotho</option>
                                <option value="LR" data-capital="Monrovia">Liberia</option>
                                <option value="LY" data-capital="Tripoli">Libya</option>
                                <option value="LI" data-capital="Vaduz">Liechtenstein</option>
                                <option value="LT" data-capital="Vilnius">Lithuania</option>
                                <option value="LU" data-capital="Luxembourg City">Luxembourg</option>
                                <option value="MO" data-capital="Macau">Macau</option>
                                <option value="MG" data-capital="Antananarivo">Madagascar</option>
                                <option value="MW" data-capital="Lilongwe">Malawi</option>
                                <option value="MY" data-capital="Kuala Lumpur">Malaysia</option>
                                <option value="MV" data-capital="Malé">Maldives</option>
                                <option value="ML" data-capital="Bamako">Mali</option>
                                <option value="MT" data-capital="Valletta">Malta</option>
                                <option value="MH" data-capital="Majuro">Marshall Islands</option>
                                <option value="MQ" data-capital="Fort-de-France">Martinique</option>
                                <option value="MR" data-capital="Nouakchott">Mauritania</option>
                                <option value="MU" data-capital="Port Louis">Mauritius</option>
                                <option value="MX" data-capital="Mexico City">Mexico</option>
                                <option value="MD" data-capital="Chișinău">Moldova</option>
                                <option value="MC" data-capital="Monaco">Monaco</option>
                                <option value="MN" data-capital="Ulaanbaatar">Mongolia</option>
                                <option value="ME" data-capital="Podgorica">Montenegro</option>
                                <option value="MS" data-capital="Little Bay, Brades, Plymouth">Montserrat</option>
                                <option value="MA" data-capital="Rabat">Morocco</option>
                                <option value="MZ" data-capital="Maputo">Mozambique</option>
                                <option value="MM" data-capital="Naypyidaw">Myanmar</option>
                                <option value="NA" data-capital="Windhoek">Namibia</option>
                                <option value="NR" data-capital="Yaren District">Nauru</option>
                                <option value="NP" data-capital="Kathmandu">Nepal</option>
                                <option value="NL" data-capital="Amsterdam">Netherlands</option>
                                <option value="NZ" data-capital="Wellington">New Zealand</option>
                                <option value="NI" data-capital="Managua">Nicaragua</option>
                                <option value="NE" data-capital="Niamey">Niger</option>
                                <option value="NG" data-capital="Abuja">Nigeria</option>
                                <option value="NU" data-capital="Alofi">Niue</option>
                                <option value="NF" data-capital="Kingston">Norfolk Island</option>
                                <option value="KP" data-capital="Pyongyang">North Korea</option>
                                <option value="MP" data-capital="Capitol Hill">Northern Mariana Islands</option>
                                <option value="NO" data-capital="Oslo">Norway</option>
                                <option value="OM" data-capital="Muscat">Oman</option>
                                <option value="PK" data-capital="Islamabad">Pakistan</option>
                                <option value="PW" data-capital="Ngerulmud">Palau</option>
                                <option value="PA" data-capital="Panama City">Panama</option>
                                <option value="PG" data-capital="Port Moresby">Papua New Guinea</option>
                                <option value="PY" data-capital="Asunción">Paraguay</option>
                                <option value="PE" data-capital="Lima">Peru</option>
                                <option value="PH" data-capital="Manila">Philippines</option>
                                <option value="PN" data-capital="Adamstown">Pitcairn</option>
                                <option value="PL" data-capital="Warsaw">Poland</option>
                                <option value="PT" data-capital="Lisbon">Portugal</option>
                                <option value="PR" data-capital="San Juan">Puerto Rico</option>
                                <option value="QA" data-capital="Doha">Qatar</option>
                                <option value="CG" data-capital="Brazzaville">Republic of the Congo</option>
                                <option value="RO" data-capital="Bucharest">Romania</option>
                                <option value="RU" data-capital="Moscow">Russia</option>
                                <option value="RW" data-capital="Kigali">Rwanda</option>
                                <option value="BL" data-capital="Gustavia">Saint Barthélemy</option>
                                <option value="KN" data-capital="Basseterre">Saint Kitts and Nevis</option>
                                <option value="LC" data-capital="Castries">Saint Lucia</option>
                                <option value="VC" data-capital="Kingstown">Saint Vincent and the Grenadines</option>
                                <option value="WS" data-capital="Apia">Samoa</option>
                                <option value="SM" data-capital="San Marino">San Marino</option>
                                <option value="ST" data-capital="São Tomé">Sao Tome and Principe</option>
                                <option value="SA" data-capital="Riyadh">Saudi Arabia</option>
                                <option value="SN" data-capital="Dakar">Senegal</option>
                                <option value="RS" data-capital="Belgrade">Serbia</option>
                                <option value="SC" data-capital="Victoria">Seychelles</option>
                                <option value="SL" data-capital="Freetown">Sierra Leone</option>
                                <option value="SG" data-capital="Singapore">Singapore</option>
                                <option value="SX" data-capital="Philipsburg">Sint Maarten</option>
                                <option value="SK" data-capital="Bratislava">Slovakia</option>
                                <option value="SI" data-capital="Ljubljana">Slovenia</option>
                                <option value="SB" data-capital="Honiara">Solomon Islands</option>
                                <option value="SO" data-capital="Mogadishu">Somalia</option>
                                <option value="ZA" data-capital="Pretoria">South Africa</option>
                                <option value="KR" data-capital="Seoul">South Korea</option>
                                <option value="SS" data-capital="Juba">South Sudan</option>
                                <option value="ES" data-capital="Madrid">Spain</option>
                                <option value="LK" data-capital="Sri Jayawardenepura Kotte, Colombo">Sri Lanka</option>
                                <option value="PS" data-capital="Ramallah">State of Palestine</option>
                                <option value="SD" data-capital="Khartoum">Sudan</option>
                                <option value="SR" data-capital="Paramaribo">Suriname</option>
                                <option value="SZ" data-capital="Lobamba, Mbabane">Swaziland</option>
                                <option value="SE" data-capital="Stockholm">Sweden</option>
                                <option value="CH" data-capital="Bern">Switzerland</option>
                                <option value="SY" data-capital="Damascus">Syrian Arab Republic</option>
                                <option value="TW" data-capital="Taipei">Taiwan</option>
                                <option value="TJ" data-capital="Dushanbe">Tajikistan</option>
                                <option value="TZ" data-capital="Dodoma">Tanzania</option>
                                <option value="TH" data-capital="Bangkok">Thailand</option>
                                <option value="TL" data-capital="Dili">Timor-Leste</option>
                                <option value="TG" data-capital="Lomé">Togo</option>
                                <option value="TK" data-capital="Nukunonu, Atafu,Tokelau">Tokelau</option>
                                <option value="TO" data-capital="Nukuʻalofa">Tonga</option>
                                <option value="TT" data-capital="Port of Spain">Trinidad and Tobago</option>
                                <option value="TN" data-capital="Tunis">Tunisia</option>
                                <option value="TR" data-capital="Ankara">Turkey</option>
                                <option value="TM" data-capital="Ashgabat">Turkmenistan</option>
                                <option value="TC" data-capital="Cockburn Town">Turks and Caicos Islands</option>
                                <option value="TV" data-capital="Funafuti">Tuvalu</option>
                                <option value="UG" data-capital="Kampala">Uganda</option>
                                <option value="UA" data-capital="Kiev">Ukraine</option>
                                <option value="AE" data-capital="Abu Dhabi">United Arab Emirates</option>
                                <option value="GB" data-capital="London">United Kingdom</option>
                                <option value="US" data-capital="Washington, D.C.">United States of America</option>
                                <option value="UY" data-capital="Montevideo">Uruguay</option>
                                <option value="UZ" data-capital="Tashkent">Uzbekistan</option>
                                <option value="VU" data-capital="Port Vila">Vanuatu</option>
                                <option value="VE" data-capital="Caracas">Venezuela</option>
                                <option value="VN" data-capital="Hanoi">Vietnam</option>
                                <option value="VG" data-capital="Road Town">Virgin Islands (British)</option>
                                <option value="VI" data-capital="Charlotte Amalie">Virgin Islands (U.S.)</option>
                                <option value="EH" data-capital="Laayoune">Western Sahara</option>
                                <option value="YE" data-capital="Sana'a">Yemen</option>
                                <option value="ZM" data-capital="Lusaka">Zambia</option>
                                <option value="ZW" data-capital="Harare">Zimbabwe</option>
                            </select> -->
                            <!-- <label for="adult" class="form-label">Penumpang Adult</label>
                            <input type="number" class="form-control" id="adult" name="adult" placeholder="masukkan jumlah penumpang dewasa...">
                            <div class="mb-4 col-12 col-md-6">
                                <label for="child" class="form-label">Penumpang Child</label>
                                <input type="number" class="form-control" id="child" name="child" placeholder="masukkan jumlah penumpang anak-anak...">
                            </div>  -->


                            <div class="mb-4 col-12 col-md-6 ">
                                <label for="freecharge" class="form-label">Tujuan</label>
                                <div class="d-flex ">
                                    <div class="form-check">
                                        <input class="form-check-input cursor-pointer" type="radio" name="tipetujuan" id="onewayradio" value="onewayradio" >
                                        <label class="form-check-label cursor-pointer" for="onewayradio">
                                            One Way
                                        </label>
                                    </div>
                                    <div class="form-check ms-3">
                                        <input class="form-check-input cursor-pointer" type="radio" name="tipetujuan" id="returnradio" value="returnradio" checked>
                                        <label class="form-check-label cursor-pointer" for="returnradio">
                                            Return
                                        </label>
                                    </div>
                                </div>

                                <div class="mt-3">
                                    <select class="depart-select2" name="depart">
                                        <option ></option>
                                        <?php foreach($ticket as $tk){?>
                                            <option value="<?= $tk['id']?>"><?= $tk['tujuan']?> || <?= $tk['berangkat']?></option>
                                        <?php }?>
       
                                    </select>
                                </div>

                                <div class="mt-3">
                                    <select class="return-select2" name="return_from">
                                        <option ></option>
                                        <?php foreach($ticket as $tk){?>
                                            <option value="<?= $tk['id']?>"><?= $tk['tujuan']?> || <?= $tk['berangkat']?></option>
                                        <?php }?>
                                    </select>
                                </div>
                            </div>

                            <div class="mb-4 col-12 col-md-6 ">
                                <div>
                                    <label for="tglberangkat" class="form-label">Tanggal Keberangkatan</label>
                                    <div class="form-control d-flex">
                                        <input type="text" class="w-100 border-0 cursor-pointer" name="tglberangkat" id="tglberangkat" autocomplete="off">
                                        <label for="tglberangkat" class="cursor-pointer">
                                            <i class="ti ti-calendar-event fs-6"></i>
                                        </label>
                                    </div>
                                </div>
                                <div class="mt-3">
                                    <label for="tglkembali" class="form-label">Tanggal Kembali</label>
                                    <div class="form-control d-flex">
                                        <input type="text" class="w-100 border-0 cursor-pointer" name="tglkembali" id="tglkembali" autocomplete="off">
                                        <label for="tglkembali" class="cursor-pointer">
                                            <i class="ti ti-calendar-event fs-6"></i>
                                        </label>
                                    </div>
                                </div>
                            </div>

                            <div class="mb-4 col-12 col-md-6 ">
                                <label for="pickup" class="form-label">Pickup Lembongan</label>
                                <input type="text" class="form-control" id="pickup" name="pickup"  placeholder="masukkan pickup Lembongan...">
                            </div>

                            <div class="mb-4 col-12 col-md-6 ">
                                <label for="dropoff" class="form-label">Drop off Bali</label>
                                <input type="text" class="form-control" id="dropoff" name="dropoff" placeholder="masukkan drop off Bali...">
                            </div>

                            <div class="mb-4 col-12 col-md-6 ">
                                <label for="catatan" class="form-label">Remarks</label>
                                <input type="text" class="form-control" id="catatan" name="catatan" placeholder="masukkan catatan tamu...">
                            </div>
                        </div>
                        <button type="submit" class="btn btn-primary mt-3">Order Sekarang</button>
                  </form>
                </div>
            </div>
        </div>
    </div>

</div>
<!-- MAIN CONTENT END -->

<!-- SWEET ALERT START -->
<?php if(isset($_SESSION["success"])) { ?>
    <script>
        setTimeout(function() {
            Swal.fire({
                html: '<?= $_SESSION['success'] ?>',
                position: 'top',
                timer: 3000,
                showCloseButton: true,
                showConfirmButton: false,
                icon: 'success',
                timer: 2000,
                timerProgressBar: true,
            });
        }, 100);
    </script>
<?php } ?>
<!-- SWEET ALERT END -->


