<?php

namespace PHPMaker2021\satusehat;

// Page object
$FasilitasRumahSakitDelete = &$Page;
?>
<script>
var currentForm, currentPageID;
var ffasilitas_rumah_sakitdelete;
loadjs.ready("head", function () {
    var $ = jQuery;
    // Form object
    currentPageID = ew.PAGE_ID = "delete";
    ffasilitas_rumah_sakitdelete = currentForm = new ew.Form("ffasilitas_rumah_sakitdelete", "delete");
    loadjs.done("ffasilitas_rumah_sakitdelete");
});
</script>
<script>
loadjs.ready("head", function () {
    // Write your table-specific client script here, no need to add script tags.
});
</script>
<script>
if (!ew.vars.tables.fasilitas_rumah_sakit) ew.vars.tables.fasilitas_rumah_sakit = <?= JsonEncode(GetClientVar("tables", "fasilitas_rumah_sakit")) ?>;
</script>
<?php $Page->showPageHeader(); ?>
<?php
$Page->showMessage();
?>
<form name="ffasilitas_rumah_sakitdelete" id="ffasilitas_rumah_sakitdelete" class="form-inline ew-form ew-delete-form" action="<?= CurrentPageUrl(false) ?>" method="post">
<?php if (Config("CHECK_TOKEN")) { ?>
<input type="hidden" name="<?= $TokenNameKey ?>" value="<?= $TokenName ?>"><!-- CSRF token name -->
<input type="hidden" name="<?= $TokenValueKey ?>" value="<?= $TokenValue ?>"><!-- CSRF token value -->
<?php } ?>
<input type="hidden" name="t" value="fasilitas_rumah_sakit">
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
<?php if ($Page->fasilitas_id->Visible) { // fasilitas_id ?>
        <th class="<?= $Page->fasilitas_id->headerCellClass() ?>"><span id="elh_fasilitas_rumah_sakit_fasilitas_id" class="fasilitas_rumah_sakit_fasilitas_id"><?= $Page->fasilitas_id->caption() ?></span></th>
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
<?php if ($Page->fasilitas_id->Visible) { // fasilitas_id ?>
        <td <?= $Page->fasilitas_id->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_fasilitas_rumah_sakit_fasilitas_id" class="fasilitas_rumah_sakit_fasilitas_id">
<span<?= $Page->fasilitas_id->viewAttributes() ?>>
<?= $Page->fasilitas_id->getViewValue() ?></span>
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
