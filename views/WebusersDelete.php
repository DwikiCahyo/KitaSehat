<?php

namespace PHPMaker2021\satusehat;

// Page object
$WebusersDelete = &$Page;
?>
<script>
var currentForm, currentPageID;
var fwebusersdelete;
loadjs.ready("head", function () {
    var $ = jQuery;
    // Form object
    currentPageID = ew.PAGE_ID = "delete";
    fwebusersdelete = currentForm = new ew.Form("fwebusersdelete", "delete");
    loadjs.done("fwebusersdelete");
});
</script>
<script>
loadjs.ready("head", function () {
    // Write your table-specific client script here, no need to add script tags.
});
</script>
<script>
if (!ew.vars.tables.webusers) ew.vars.tables.webusers = <?= JsonEncode(GetClientVar("tables", "webusers")) ?>;
</script>
<?php $Page->showPageHeader(); ?>
<?php
$Page->showMessage();
?>
<form name="fwebusersdelete" id="fwebusersdelete" class="form-inline ew-form ew-delete-form" action="<?= CurrentPageUrl(false) ?>" method="post">
<?php if (Config("CHECK_TOKEN")) { ?>
<input type="hidden" name="<?= $TokenNameKey ?>" value="<?= $TokenName ?>"><!-- CSRF token name -->
<input type="hidden" name="<?= $TokenValueKey ?>" value="<?= $TokenValue ?>"><!-- CSRF token value -->
<?php } ?>
<input type="hidden" name="t" value="webusers">
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
        <th class="<?= $Page->id->headerCellClass() ?>"><span id="elh_webusers_id" class="webusers_id"><?= $Page->id->caption() ?></span></th>
<?php } ?>
<?php if ($Page->_username->Visible) { // username ?>
        <th class="<?= $Page->_username->headerCellClass() ?>"><span id="elh_webusers__username" class="webusers__username"><?= $Page->_username->caption() ?></span></th>
<?php } ?>
<?php if ($Page->_password->Visible) { // password ?>
        <th class="<?= $Page->_password->headerCellClass() ?>"><span id="elh_webusers__password" class="webusers__password"><?= $Page->_password->caption() ?></span></th>
<?php } ?>
<?php if ($Page->role->Visible) { // role ?>
        <th class="<?= $Page->role->headerCellClass() ?>"><span id="elh_webusers_role" class="webusers_role"><?= $Page->role->caption() ?></span></th>
<?php } ?>
<?php if ($Page->rumah_sakit_id->Visible) { // rumah_sakit_id ?>
        <th class="<?= $Page->rumah_sakit_id->headerCellClass() ?>"><span id="elh_webusers_rumah_sakit_id" class="webusers_rumah_sakit_id"><?= $Page->rumah_sakit_id->caption() ?></span></th>
<?php } ?>
<?php if ($Page->administrator_rumah_sakit->Visible) { // administrator_rumah_sakit ?>
        <th class="<?= $Page->administrator_rumah_sakit->headerCellClass() ?>"><span id="elh_webusers_administrator_rumah_sakit" class="webusers_administrator_rumah_sakit"><?= $Page->administrator_rumah_sakit->caption() ?></span></th>
<?php } ?>
<?php if ($Page->dokter_id->Visible) { // dokter_id ?>
        <th class="<?= $Page->dokter_id->headerCellClass() ?>"><span id="elh_webusers_dokter_id" class="webusers_dokter_id"><?= $Page->dokter_id->caption() ?></span></th>
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
<span id="el<?= $Page->RowCount ?>_webusers_id" class="webusers_id">
<span<?= $Page->id->viewAttributes() ?>>
<?= $Page->id->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->_username->Visible) { // username ?>
        <td <?= $Page->_username->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_webusers__username" class="webusers__username">
<span<?= $Page->_username->viewAttributes() ?>>
<?= $Page->_username->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->_password->Visible) { // password ?>
        <td <?= $Page->_password->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_webusers__password" class="webusers__password">
<span<?= $Page->_password->viewAttributes() ?>>
<?= $Page->_password->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->role->Visible) { // role ?>
        <td <?= $Page->role->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_webusers_role" class="webusers_role">
<span<?= $Page->role->viewAttributes() ?>>
<?= $Page->role->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->rumah_sakit_id->Visible) { // rumah_sakit_id ?>
        <td <?= $Page->rumah_sakit_id->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_webusers_rumah_sakit_id" class="webusers_rumah_sakit_id">
<span<?= $Page->rumah_sakit_id->viewAttributes() ?>>
<?= $Page->rumah_sakit_id->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->administrator_rumah_sakit->Visible) { // administrator_rumah_sakit ?>
        <td <?= $Page->administrator_rumah_sakit->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_webusers_administrator_rumah_sakit" class="webusers_administrator_rumah_sakit">
<span<?= $Page->administrator_rumah_sakit->viewAttributes() ?>>
<?= $Page->administrator_rumah_sakit->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->dokter_id->Visible) { // dokter_id ?>
        <td <?= $Page->dokter_id->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_webusers_dokter_id" class="webusers_dokter_id">
<span<?= $Page->dokter_id->viewAttributes() ?>>
<?= $Page->dokter_id->getViewValue() ?></span>
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
