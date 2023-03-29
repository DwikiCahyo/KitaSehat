<?php

namespace PHPMaker2021\satusehat;

// Page object
$PasienView = &$Page;
?>
<?php if (!$Page->isExport()) { ?>
<script>
var currentForm, currentPageID;
var fpasienview;
loadjs.ready("head", function () {
    var $ = jQuery;
    // Form object
    currentPageID = ew.PAGE_ID = "view";
    fpasienview = currentForm = new ew.Form("fpasienview", "view");
    loadjs.done("fpasienview");
});
</script>
<script>
loadjs.ready("head", function () {
    // Write your table-specific client script here, no need to add script tags.
});
</script>
<?php } ?>
<script>
if (!ew.vars.tables.pasien) ew.vars.tables.pasien = <?= JsonEncode(GetClientVar("tables", "pasien")) ?>;
</script>
<?php if (!$Page->isExport()) { ?>
<div class="btn-toolbar ew-toolbar">
<?php $Page->ExportOptions->render("body") ?>
<?php $Page->OtherOptions->render("body") ?>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php $Page->showPageHeader(); ?>
<?php
$Page->showMessage();
?>
<form name="fpasienview" id="fpasienview" class="form-inline ew-form ew-view-form" action="<?= CurrentPageUrl(false) ?>" method="post">
<?php if (Config("CHECK_TOKEN")) { ?>
<input type="hidden" name="<?= $TokenNameKey ?>" value="<?= $TokenName ?>"><!-- CSRF token name -->
<input type="hidden" name="<?= $TokenValueKey ?>" value="<?= $TokenValue ?>"><!-- CSRF token value -->
<?php } ?>
<input type="hidden" name="t" value="pasien">
<input type="hidden" name="modal" value="<?= (int)$Page->IsModal ?>">
<table class="table table-striped table-sm ew-view-table">
<?php if ($Page->id->Visible) { // id ?>
    <tr id="r_id">
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_pasien_id"><?= $Page->id->caption() ?></span></td>
        <td data-name="id" <?= $Page->id->cellAttributes() ?>>
<span id="el_pasien_id">
<span<?= $Page->id->viewAttributes() ?>>
<?= $Page->id->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->nik->Visible) { // nik ?>
    <tr id="r_nik">
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_pasien_nik"><?= $Page->nik->caption() ?></span></td>
        <td data-name="nik" <?= $Page->nik->cellAttributes() ?>>
<span id="el_pasien_nik">
<span<?= $Page->nik->viewAttributes() ?>>
<?= $Page->nik->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->nama->Visible) { // nama ?>
    <tr id="r_nama">
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_pasien_nama"><?= $Page->nama->caption() ?></span></td>
        <td data-name="nama" <?= $Page->nama->cellAttributes() ?>>
<span id="el_pasien_nama">
<span<?= $Page->nama->viewAttributes() ?>>
<?= $Page->nama->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->jenis_kelamin->Visible) { // jenis_kelamin ?>
    <tr id="r_jenis_kelamin">
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_pasien_jenis_kelamin"><?= $Page->jenis_kelamin->caption() ?></span></td>
        <td data-name="jenis_kelamin" <?= $Page->jenis_kelamin->cellAttributes() ?>>
<span id="el_pasien_jenis_kelamin">
<span<?= $Page->jenis_kelamin->viewAttributes() ?>>
<?= $Page->jenis_kelamin->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->tanggal_lahir->Visible) { // tanggal_lahir ?>
    <tr id="r_tanggal_lahir">
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_pasien_tanggal_lahir"><?= $Page->tanggal_lahir->caption() ?></span></td>
        <td data-name="tanggal_lahir" <?= $Page->tanggal_lahir->cellAttributes() ?>>
<span id="el_pasien_tanggal_lahir">
<span<?= $Page->tanggal_lahir->viewAttributes() ?>>
<?= $Page->tanggal_lahir->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->agama->Visible) { // agama ?>
    <tr id="r_agama">
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_pasien_agama"><?= $Page->agama->caption() ?></span></td>
        <td data-name="agama" <?= $Page->agama->cellAttributes() ?>>
<span id="el_pasien_agama">
<span<?= $Page->agama->viewAttributes() ?>>
<?= $Page->agama->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->pekerjaan->Visible) { // pekerjaan ?>
    <tr id="r_pekerjaan">
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_pasien_pekerjaan"><?= $Page->pekerjaan->caption() ?></span></td>
        <td data-name="pekerjaan" <?= $Page->pekerjaan->cellAttributes() ?>>
<span id="el_pasien_pekerjaan">
<span<?= $Page->pekerjaan->viewAttributes() ?>>
<?= $Page->pekerjaan->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->pendidikan->Visible) { // pendidikan ?>
    <tr id="r_pendidikan">
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_pasien_pendidikan"><?= $Page->pendidikan->caption() ?></span></td>
        <td data-name="pendidikan" <?= $Page->pendidikan->cellAttributes() ?>>
<span id="el_pasien_pendidikan">
<span<?= $Page->pendidikan->viewAttributes() ?>>
<?= $Page->pendidikan->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->status_perkawinan->Visible) { // status_perkawinan ?>
    <tr id="r_status_perkawinan">
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_pasien_status_perkawinan"><?= $Page->status_perkawinan->caption() ?></span></td>
        <td data-name="status_perkawinan" <?= $Page->status_perkawinan->cellAttributes() ?>>
<span id="el_pasien_status_perkawinan">
<span<?= $Page->status_perkawinan->viewAttributes() ?>>
<?= $Page->status_perkawinan->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->no_bpjs->Visible) { // no_bpjs ?>
    <tr id="r_no_bpjs">
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_pasien_no_bpjs"><?= $Page->no_bpjs->caption() ?></span></td>
        <td data-name="no_bpjs" <?= $Page->no_bpjs->cellAttributes() ?>>
<span id="el_pasien_no_bpjs">
<span<?= $Page->no_bpjs->viewAttributes() ?>>
<?= $Page->no_bpjs->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->no_hp->Visible) { // no_hp ?>
    <tr id="r_no_hp">
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_pasien_no_hp"><?= $Page->no_hp->caption() ?></span></td>
        <td data-name="no_hp" <?= $Page->no_hp->cellAttributes() ?>>
<span id="el_pasien_no_hp">
<span<?= $Page->no_hp->viewAttributes() ?>>
<?= $Page->no_hp->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->_password->Visible) { // password ?>
    <tr id="r__password">
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_pasien__password"><?= $Page->_password->caption() ?></span></td>
        <td data-name="_password" <?= $Page->_password->cellAttributes() ?>>
<span id="el_pasien__password">
<span<?= $Page->_password->viewAttributes() ?>>
<?= $Page->_password->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
</table>
<?php
    if (in_array("kontak_darurat", explode(",", $Page->getCurrentDetailTable())) && $kontak_darurat->DetailView) {
?>
<?php if ($Page->getCurrentDetailTable() != "") { ?>
<h4 class="ew-detail-caption"><?= $Language->tablePhrase("kontak_darurat", "TblCaption") ?></h4>
<?php } ?>
<?php include_once "KontakDaruratGrid.php" ?>
<?php } ?>
</form>
<?php
$Page->showPageFooter();
echo GetDebugMessage();
?>
<?php if (!$Page->isExport()) { ?>
<script>
loadjs.ready("load", function () {
    // Write your table-specific startup script here, no need to add script tags.
});
</script>
<?php } ?>
