<?php

namespace PHPMaker2021\satusehat;

// Table
$pasien = Container("pasien");
?>
<?php if ($pasien->Visible) { ?>
<div class="ew-master-div">
<table id="tbl_pasienmaster" class="table ew-view-table ew-master-table ew-vertical">
    <tbody>
<?php if ($pasien->id->Visible) { // id ?>
        <tr id="r_id">
            <td class="<?= $pasien->TableLeftColumnClass ?>"><?= $pasien->id->caption() ?></td>
            <td <?= $pasien->id->cellAttributes() ?>>
<span id="el_pasien_id">
<span<?= $pasien->id->viewAttributes() ?>>
<?= $pasien->id->getViewValue() ?></span>
</span>
</td>
        </tr>
<?php } ?>
<?php if ($pasien->nik->Visible) { // nik ?>
        <tr id="r_nik">
            <td class="<?= $pasien->TableLeftColumnClass ?>"><?= $pasien->nik->caption() ?></td>
            <td <?= $pasien->nik->cellAttributes() ?>>
<span id="el_pasien_nik">
<span<?= $pasien->nik->viewAttributes() ?>>
<?= $pasien->nik->getViewValue() ?></span>
</span>
</td>
        </tr>
<?php } ?>
<?php if ($pasien->nama->Visible) { // nama ?>
        <tr id="r_nama">
            <td class="<?= $pasien->TableLeftColumnClass ?>"><?= $pasien->nama->caption() ?></td>
            <td <?= $pasien->nama->cellAttributes() ?>>
<span id="el_pasien_nama">
<span<?= $pasien->nama->viewAttributes() ?>>
<?= $pasien->nama->getViewValue() ?></span>
</span>
</td>
        </tr>
<?php } ?>
<?php if ($pasien->jenis_kelamin->Visible) { // jenis_kelamin ?>
        <tr id="r_jenis_kelamin">
            <td class="<?= $pasien->TableLeftColumnClass ?>"><?= $pasien->jenis_kelamin->caption() ?></td>
            <td <?= $pasien->jenis_kelamin->cellAttributes() ?>>
<span id="el_pasien_jenis_kelamin">
<span<?= $pasien->jenis_kelamin->viewAttributes() ?>>
<?= $pasien->jenis_kelamin->getViewValue() ?></span>
</span>
</td>
        </tr>
<?php } ?>
<?php if ($pasien->tanggal_lahir->Visible) { // tanggal_lahir ?>
        <tr id="r_tanggal_lahir">
            <td class="<?= $pasien->TableLeftColumnClass ?>"><?= $pasien->tanggal_lahir->caption() ?></td>
            <td <?= $pasien->tanggal_lahir->cellAttributes() ?>>
<span id="el_pasien_tanggal_lahir">
<span<?= $pasien->tanggal_lahir->viewAttributes() ?>>
<?= $pasien->tanggal_lahir->getViewValue() ?></span>
</span>
</td>
        </tr>
<?php } ?>
<?php if ($pasien->agama->Visible) { // agama ?>
        <tr id="r_agama">
            <td class="<?= $pasien->TableLeftColumnClass ?>"><?= $pasien->agama->caption() ?></td>
            <td <?= $pasien->agama->cellAttributes() ?>>
<span id="el_pasien_agama">
<span<?= $pasien->agama->viewAttributes() ?>>
<?= $pasien->agama->getViewValue() ?></span>
</span>
</td>
        </tr>
<?php } ?>
<?php if ($pasien->pekerjaan->Visible) { // pekerjaan ?>
        <tr id="r_pekerjaan">
            <td class="<?= $pasien->TableLeftColumnClass ?>"><?= $pasien->pekerjaan->caption() ?></td>
            <td <?= $pasien->pekerjaan->cellAttributes() ?>>
<span id="el_pasien_pekerjaan">
<span<?= $pasien->pekerjaan->viewAttributes() ?>>
<?= $pasien->pekerjaan->getViewValue() ?></span>
</span>
</td>
        </tr>
<?php } ?>
<?php if ($pasien->pendidikan->Visible) { // pendidikan ?>
        <tr id="r_pendidikan">
            <td class="<?= $pasien->TableLeftColumnClass ?>"><?= $pasien->pendidikan->caption() ?></td>
            <td <?= $pasien->pendidikan->cellAttributes() ?>>
<span id="el_pasien_pendidikan">
<span<?= $pasien->pendidikan->viewAttributes() ?>>
<?= $pasien->pendidikan->getViewValue() ?></span>
</span>
</td>
        </tr>
<?php } ?>
<?php if ($pasien->status_perkawinan->Visible) { // status_perkawinan ?>
        <tr id="r_status_perkawinan">
            <td class="<?= $pasien->TableLeftColumnClass ?>"><?= $pasien->status_perkawinan->caption() ?></td>
            <td <?= $pasien->status_perkawinan->cellAttributes() ?>>
<span id="el_pasien_status_perkawinan">
<span<?= $pasien->status_perkawinan->viewAttributes() ?>>
<?= $pasien->status_perkawinan->getViewValue() ?></span>
</span>
</td>
        </tr>
<?php } ?>
<?php if ($pasien->no_bpjs->Visible) { // no_bpjs ?>
        <tr id="r_no_bpjs">
            <td class="<?= $pasien->TableLeftColumnClass ?>"><?= $pasien->no_bpjs->caption() ?></td>
            <td <?= $pasien->no_bpjs->cellAttributes() ?>>
<span id="el_pasien_no_bpjs">
<span<?= $pasien->no_bpjs->viewAttributes() ?>>
<?= $pasien->no_bpjs->getViewValue() ?></span>
</span>
</td>
        </tr>
<?php } ?>
<?php if ($pasien->no_hp->Visible) { // no_hp ?>
        <tr id="r_no_hp">
            <td class="<?= $pasien->TableLeftColumnClass ?>"><?= $pasien->no_hp->caption() ?></td>
            <td <?= $pasien->no_hp->cellAttributes() ?>>
<span id="el_pasien_no_hp">
<span<?= $pasien->no_hp->viewAttributes() ?>>
<?= $pasien->no_hp->getViewValue() ?></span>
</span>
</td>
        </tr>
<?php } ?>
<?php if ($pasien->_password->Visible) { // password ?>
        <tr id="r__password">
            <td class="<?= $pasien->TableLeftColumnClass ?>"><?= $pasien->_password->caption() ?></td>
            <td <?= $pasien->_password->cellAttributes() ?>>
<span id="el_pasien__password">
<span<?= $pasien->_password->viewAttributes() ?>>
<?= $pasien->_password->getViewValue() ?></span>
</span>
</td>
        </tr>
<?php } ?>
    </tbody>
</table>
</div>
<?php } ?>
