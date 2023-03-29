<?php

namespace PHPMaker2021\satusehat;

// Page object
$WebusersView = &$Page;
?>
<?php if (!$Page->isExport()) { ?>
<script>
var currentForm, currentPageID;
var fwebusersview;
loadjs.ready("head", function () {
    var $ = jQuery;
    // Form object
    currentPageID = ew.PAGE_ID = "view";
    fwebusersview = currentForm = new ew.Form("fwebusersview", "view");
    loadjs.done("fwebusersview");
});
</script>
<script>
loadjs.ready("head", function () {
    // Write your table-specific client script here, no need to add script tags.
});
</script>
<?php } ?>
<script>
if (!ew.vars.tables.webusers) ew.vars.tables.webusers = <?= JsonEncode(GetClientVar("tables", "webusers")) ?>;
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
<form name="fwebusersview" id="fwebusersview" class="form-inline ew-form ew-view-form" action="<?= CurrentPageUrl(false) ?>" method="post">
<?php if (Config("CHECK_TOKEN")) { ?>
<input type="hidden" name="<?= $TokenNameKey ?>" value="<?= $TokenName ?>"><!-- CSRF token name -->
<input type="hidden" name="<?= $TokenValueKey ?>" value="<?= $TokenValue ?>"><!-- CSRF token value -->
<?php } ?>
<input type="hidden" name="t" value="webusers">
<input type="hidden" name="modal" value="<?= (int)$Page->IsModal ?>">
<table class="table table-striped table-sm ew-view-table">
<?php if ($Page->id->Visible) { // id ?>
    <tr id="r_id">
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_webusers_id"><?= $Page->id->caption() ?></span></td>
        <td data-name="id" <?= $Page->id->cellAttributes() ?>>
<span id="el_webusers_id">
<span<?= $Page->id->viewAttributes() ?>>
<?= $Page->id->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->_username->Visible) { // username ?>
    <tr id="r__username">
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_webusers__username"><?= $Page->_username->caption() ?></span></td>
        <td data-name="_username" <?= $Page->_username->cellAttributes() ?>>
<span id="el_webusers__username">
<span<?= $Page->_username->viewAttributes() ?>>
<?= $Page->_username->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->_password->Visible) { // password ?>
    <tr id="r__password">
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_webusers__password"><?= $Page->_password->caption() ?></span></td>
        <td data-name="_password" <?= $Page->_password->cellAttributes() ?>>
<span id="el_webusers__password">
<span<?= $Page->_password->viewAttributes() ?>>
<?= $Page->_password->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->role->Visible) { // role ?>
    <tr id="r_role">
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_webusers_role"><?= $Page->role->caption() ?></span></td>
        <td data-name="role" <?= $Page->role->cellAttributes() ?>>
<span id="el_webusers_role">
<span<?= $Page->role->viewAttributes() ?>>
<?= $Page->role->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->rumah_sakit_id->Visible) { // rumah_sakit_id ?>
    <tr id="r_rumah_sakit_id">
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_webusers_rumah_sakit_id"><?= $Page->rumah_sakit_id->caption() ?></span></td>
        <td data-name="rumah_sakit_id" <?= $Page->rumah_sakit_id->cellAttributes() ?>>
<span id="el_webusers_rumah_sakit_id">
<span<?= $Page->rumah_sakit_id->viewAttributes() ?>>
<?= $Page->rumah_sakit_id->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->administrator_rumah_sakit->Visible) { // administrator_rumah_sakit ?>
    <tr id="r_administrator_rumah_sakit">
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_webusers_administrator_rumah_sakit"><?= $Page->administrator_rumah_sakit->caption() ?></span></td>
        <td data-name="administrator_rumah_sakit" <?= $Page->administrator_rumah_sakit->cellAttributes() ?>>
<span id="el_webusers_administrator_rumah_sakit">
<span<?= $Page->administrator_rumah_sakit->viewAttributes() ?>>
<?= $Page->administrator_rumah_sakit->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->dokter_id->Visible) { // dokter_id ?>
    <tr id="r_dokter_id">
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_webusers_dokter_id"><?= $Page->dokter_id->caption() ?></span></td>
        <td data-name="dokter_id" <?= $Page->dokter_id->cellAttributes() ?>>
<span id="el_webusers_dokter_id">
<span<?= $Page->dokter_id->viewAttributes() ?>>
<?= $Page->dokter_id->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
</table>
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
