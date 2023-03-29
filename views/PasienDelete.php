<?php

namespace PHPMaker2021\satusehat;

// Page object
$PasienDelete = &$Page;
?>
<script>
var currentForm, currentPageID;
var fpasiendelete;
loadjs.ready("head", function () {
    var $ = jQuery;
    // Form object
    currentPageID = ew.PAGE_ID = "delete";
    fpasiendelete = currentForm = new ew.Form("fpasiendelete", "delete");
    loadjs.done("fpasiendelete");
});
</script>
<script>
loadjs.ready("head", function () {
    // Write your table-specific client script here, no need to add script tags.
});
</script>
<script>
if (!ew.vars.tables.pasien) ew.vars.tables.pasien = <?= JsonEncode(GetClientVar("tables", "pasien")) ?>;
</script>
<?php $Page->showPageHeader(); ?>
<?php
$Page->showMessage();
?>
<form name="fpasiendelete" id="fpasiendelete" class="form-inline ew-form ew-delete-form" action="<?= CurrentPageUrl(false) ?>" method="post">
<?php if (Config("CHECK_TOKEN")) { ?>
<input type="hidden" name="<?= $TokenNameKey ?>" value="<?= $TokenName ?>"><!-- CSRF token name -->
<input type="hidden" name="<?= $TokenValueKey ?>" value="<?= $TokenValue ?>"><!-- CSRF token value -->
<?php } ?>
<input type="hidden" name="t" value="pasien">
<input type="hidden" name="action" id="action" value="delete">
<?php foreach ($Page->RecKeys as $key) { ?>
<?php $keyvalue = is_array($key) ? implode(Config("COMPOSITE_KEY_SEPARATOR"), $key) : $key; ?>
<input type="hidden" name="key_m[]" value="<?= HtmlEncode($keyvalue) ?>">
<?php } ?>
<div class="card ew-card ew-grid">
<div class="<?= ResponsiveTableClass() ?>card-body ew-grid-middle-panel">
<table class="table ew-table">
    <thead>
    <tr class="ew-table-header">
<?php if ($Page->id->Visible) { // id ?>
        <th class="<?= $Page->id->headerCellClass() ?>"><span id="elh_pasien_id" class="pasien_id"><?= $Page->id->caption() ?></span></th>
<?php } ?>
<?php if ($Page->nik->Visible) { // nik ?>
        <th class="<?= $Page->nik->headerCellClass() ?>"><span id="elh_pasien_nik" class="pasien_nik"><?= $Page->nik->caption() ?></span></th>
<?php } ?>
<?php if ($Page->nama->Visible) { // nama ?>
        <th class="<?= $Page->nama->headerCellClass() ?>"><span id="elh_pasien_nama" class="pasien_nama"><?= $Page->nama->caption() ?></span></th>
<?php } ?>
<?php if ($Page->jenis_kelamin->Visible) { // jenis_kelamin ?>
        <th class="<?= $Page->jenis_kelamin->headerCellClass() ?>"><span id="elh_pasien_jenis_kelamin" class="pasien_jenis_kelamin"><?= $Page->jenis_kelamin->caption() ?></span></th>
<?php } ?>
<?php if ($Page->tanggal_lahir->Visible) { // tanggal_lahir ?>
        <th class="<?= $Page->tanggal_lahir->headerCellClass() ?>"><span id="elh_pasien_tanggal_lahir" class="pasien_tanggal_lahir"><?= $Page->tanggal_lahir->caption() ?></span></th>
<?php } ?>
<?php if ($Page->agama->Visible) { // agama ?>
        <th class="<?= $Page->agama->headerCellClass() ?>"><span id="elh_pasien_agama" class="pasien_agama"><?= $Page->agama->caption() ?></span></th>
<?php } ?>
<?php if ($Page->pekerjaan->Visible) { // pekerjaan ?>
        <th class="<?= $Page->pekerjaan->headerCellClass() ?>"><span id="elh_pasien_pekerjaan" class="pasien_pekerjaan"><?= $Page->pekerjaan->caption() ?></span></th>
<?php } ?>
<?php if ($Page->pendidikan->Visible) { // pendidikan ?>
        <th class="<?= $Page->pendidikan->headerCellClass() ?>"><span id="elh_pasien_pendidikan" class="pasien_pendidikan"><?= $Page->pendidikan->caption() ?></span></th>
<?php } ?>
<?php if ($Page->status_perkawinan->Visible) { // status_perkawinan ?>
        <th class="<?= $Page->status_perkawinan->headerCellClass() ?>"><span id="elh_pasien_status_perkawinan" class="pasien_status_perkawinan"><?= $Page->status_perkawinan->caption() ?></span></th>
<?php } ?>
<?php if ($Page->no_bpjs->Visible) { // no_bpjs ?>
        <th class="<?= $Page->no_bpjs->headerCellClass() ?>"><span id="elh_pasien_no_bpjs" class="pasien_no_bpjs"><?= $Page->no_bpjs->caption() ?></span></th>
<?php } ?>
<?php if ($Page->no_hp->Visible) { // no_hp ?>
        <th class="<?= $Page->no_hp->headerCellClass() ?>"><span id="elh_pasien_no_hp" class="pasien_no_hp"><?= $Page->no_hp->caption() ?></span></th>
<?php } ?>
<?php if ($Page->_password->Visible) { // password ?>
        <th class="<?= $Page->_password->headerCellClass() ?>"><span id="elh_pasien__password" class="pasien__password"><?= $Page->_password->caption() ?></span></th>
<?php } ?>
    </tr>
    </thead>
    <tbody>
<?php
$Page->RecordCount = 0;
$i = 0;
while (!$Page->Recordset->EOF) {
    $Page->RecordCount++;
    $Page->RowCount++;

    // Set row properties
    $Page->resetAttributes();
    $Page->RowType = ROWTYPE_VIEW; // View

    // Get the field contents
    $Page->loadRowValues($Page->Recordset);

    // Render row
    $Page->renderRow();
?>
    <tr <?= $Page->rowAttributes() ?>>
<?php if ($Page->id->Visible) { // id ?>
        <td <?= $Page->id->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_pasien_id" class="pasien_id">
<span<?= $Page->id->viewAttributes() ?>>
<?= $Page->id->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->nik->Visible) { // nik ?>
        <td <?= $Page->nik->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_pasien_nik" class="pasien_nik">
<span<?= $Page->nik->viewAttributes() ?>>
<?= $Page->nik->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->nama->Visible) { // nama ?>
        <td <?= $Page->nama->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_pasien_nama" class="pasien_nama">
<span<?= $Page->nama->viewAttributes() ?>>
<?= $Page->nama->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->jenis_kelamin->Visible) { // jenis_kelamin ?>
        <td <?= $Page->jenis_kelamin->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_pasien_jenis_kelamin" class="pasien_jenis_kelamin">
<span<?= $Page->jenis_kelamin->viewAttributes() ?>>
<?= $Page->jenis_kelamin->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->tanggal_lahir->Visible) { // tanggal_lahir ?>
        <td <?= $Page->tanggal_lahir->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_pasien_tanggal_lahir" class="pasien_tanggal_lahir">
<span<?= $Page->tanggal_lahir->viewAttributes() ?>>
<?= $Page->tanggal_lahir->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->agama->Visible) { // agama ?>
        <td <?= $Page->agama->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_pasien_agama" class="pasien_agama">
<span<?= $Page->agama->viewAttributes() ?>>
<?= $Page->agama->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->pekerjaan->Visible) { // pekerjaan ?>
        <td <?= $Page->pekerjaan->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_pasien_pekerjaan" class="pasien_pekerjaan">
<span<?= $Page->pekerjaan->viewAttributes() ?>>
<?= $Page->pekerjaan->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->pendidikan->Visible) { // pendidikan ?>
        <td <?= $Page->pendidikan->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_pasien_pendidikan" class="pasien_pendidikan">
<span<?= $Page->pendidikan->viewAttributes() ?>>
<?= $Page->pendidikan->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->status_perkawinan->Visible) { // status_perkawinan ?>
        <td <?= $Page->status_perkawinan->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_pasien_status_perkawinan" class="pasien_status_perkawinan">
<span<?= $Page->status_perkawinan->viewAttributes() ?>>
<?= $Page->status_perkawinan->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->no_bpjs->Visible) { // no_bpjs ?>
        <td <?= $Page->no_bpjs->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_pasien_no_bpjs" class="pasien_no_bpjs">
<span<?= $Page->no_bpjs->viewAttributes() ?>>
<?= $Page->no_bpjs->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->no_hp->Visible) { // no_hp ?>
        <td <?= $Page->no_hp->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_pasien_no_hp" class="pasien_no_hp">
<span<?= $Page->no_hp->viewAttributes() ?>>
<?= $Page->no_hp->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->_password->Visible) { // password ?>
        <td <?= $Page->_password->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_pasien__password" class="pasien__password">
<span<?= $Page->_password->viewAttributes() ?>>
<?= $Page->_password->getViewValue() ?></span>
</span>
</td>
<?php } ?>
    </tr>
<?php
    $Page->Recordset->moveNext();
}
$Page->Recordset->close();
?>
</tbody>
</table>
</div>
</div>
<div>
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit"><?= $Language->phrase("DeleteBtn") ?></button>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" data-href="<?= HtmlEncode(GetUrl($Page->getReturnUrl())) ?>"><?= $Language->phrase("CancelBtn") ?></button>
</div>
</form>
<?php
$Page->showPageFooter();
echo GetDebugMessage();
?>
<script>
loadjs.ready("load", function () {
    // Write your table-specific startup script here, no need to add script tags.
});
</script>
