<?php

namespace PHPMaker2021\satusehat;

// Page object
$DaerahSearch = &$Page;
?>
<script>
var currentForm, currentPageID;
var fdaerahsearch, currentSearchForm, currentAdvancedSearchForm;
loadjs.ready("head", function () {
    var $ = jQuery;
    // Form object for search
    <?php if ($Page->IsModal) { ?>
    fdaerahsearch = currentAdvancedSearchForm = new ew.Form("fdaerahsearch", "search");
    <?php } else { ?>
    fdaerahsearch = currentForm = new ew.Form("fdaerahsearch", "search");
    <?php } ?>
    currentPageID = ew.PAGE_ID = "search";

    // Add fields
    var currentTable = <?= JsonEncode(GetClientVar("tables", "daerah")) ?>,
        fields = currentTable.fields;
    fdaerahsearch.addFields([
        ["id", [ew.Validators.integer], fields.id.isInvalid],
        ["jenis", [], fields.jenis.isInvalid],
        ["nama_daerah", [], fields.nama_daerah.isInvalid]
    ]);

    // Set invalid fields
    $(function() {
        fdaerahsearch.setInvalid();
    });

    // Validate form
    fdaerahsearch.validate = function () {
        if (!this.validateRequired)
            return true; // Ignore validation
        var fobj = this.getForm(),
            $fobj = $(fobj),
            rowIndex = "";
        $fobj.data("rowindex", rowIndex);

        // Validate fields
        if (!this.validateFields(rowIndex))
            return false;

        // Call Form_CustomValidate event
        if (!this.customValidate(fobj)) {
            this.focus();
            return false;
        }
        return true;
    }

    // Form_CustomValidate
    fdaerahsearch.customValidate = function(fobj) { // DO NOT CHANGE THIS LINE!
        // Your custom validation code here, return false if invalid.
        return true;
    }

    // Use JavaScript validation or not
    fdaerahsearch.validateRequired = <?= Config("CLIENT_VALIDATE") ? "true" : "false" ?>;

    // Dynamic selection lists
    fdaerahsearch.lists.jenis = <?= $Page->jenis->toClientList($Page) ?>;
    loadjs.done("fdaerahsearch");
});
</script>
<script>
loadjs.ready("head", function () {
    // Write your table-specific client script here, no need to add script tags.
});
</script>
<?php $Page->showPageHeader(); ?>
<?php
$Page->showMessage();
?>
<form name="fdaerahsearch" id="fdaerahsearch" class="<?= $Page->FormClassName ?>" action="<?= CurrentPageUrl(false) ?>" method="post">
<?php if (Config("CHECK_TOKEN")) { ?>
<input type="hidden" name="<?= $TokenNameKey ?>" value="<?= $TokenName ?>"><!-- CSRF token name -->
<input type="hidden" name="<?= $TokenValueKey ?>" value="<?= $TokenValue ?>"><!-- CSRF token value -->
<?php } ?>
<input type="hidden" name="t" value="daerah">
<input type="hidden" name="action" id="action" value="search">
<input type="hidden" name="modal" value="<?= (int)$Page->IsModal ?>">
<div class="ew-search-div"><!-- page* -->
<?php if ($Page->id->Visible) { // id ?>
    <div id="r_id" class="form-group row">
        <label for="x_id" class="<?= $Page->LeftColumnClass ?>"><span id="elh_daerah_id"><?= $Page->id->caption() ?></span>
        <span class="ew-search-operator">
<?= $Language->phrase("=") ?>
<input type="hidden" name="z_id" id="z_id" value="=">
</span>
        </label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->id->cellAttributes() ?>>
            <span id="el_daerah_id" class="ew-search-field ew-search-field-single">
<input type="<?= $Page->id->getInputTextType() ?>" data-table="daerah" data-field="x_id" name="x_id" id="x_id" placeholder="<?= HtmlEncode($Page->id->getPlaceHolder()) ?>" value="<?= $Page->id->EditValue ?>"<?= $Page->id->editAttributes() ?>>
<div class="invalid-feedback"><?= $Page->id->getErrorMessage(false) ?></div>
</span>
        </div></div>
    </div>
<?php } ?>
<?php if ($Page->jenis->Visible) { // jenis ?>
    <div id="r_jenis" class="form-group row">
        <label class="<?= $Page->LeftColumnClass ?>"><span id="elh_daerah_jenis"><?= $Page->jenis->caption() ?></span>
        <span class="ew-search-operator">
<?= $Language->phrase("=") ?>
<input type="hidden" name="z_jenis" id="z_jenis" value="=">
</span>
        </label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->jenis->cellAttributes() ?>>
            <span id="el_daerah_jenis" class="ew-search-field ew-search-field-single">
<template id="tp_x_jenis">
    <div class="custom-control custom-radio">
        <input type="radio" class="custom-control-input" data-table="daerah" data-field="x_jenis" name="x_jenis" id="x_jenis"<?= $Page->jenis->editAttributes() ?>>
        <label class="custom-control-label"></label>
    </div>
</template>
<div id="dsl_x_jenis" class="ew-item-list"></div>
<input type="hidden"
    is="selection-list"
    id="x_jenis"
    name="x_jenis"
    value="<?= HtmlEncode($Page->jenis->AdvancedSearch->SearchValue) ?>"
    data-type="select-one"
    data-template="tp_x_jenis"
    data-target="dsl_x_jenis"
    data-repeatcolumn="5"
    class="form-control<?= $Page->jenis->isInvalidClass() ?>"
    data-table="daerah"
    data-field="x_jenis"
    data-value-separator="<?= $Page->jenis->displayValueSeparatorAttribute() ?>"
    <?= $Page->jenis->editAttributes() ?>>
<div class="invalid-feedback"><?= $Page->jenis->getErrorMessage(false) ?></div>
</span>
        </div></div>
    </div>
<?php } ?>
<?php if ($Page->nama_daerah->Visible) { // nama_daerah ?>
    <div id="r_nama_daerah" class="form-group row">
        <label for="x_nama_daerah" class="<?= $Page->LeftColumnClass ?>"><span id="elh_daerah_nama_daerah"><?= $Page->nama_daerah->caption() ?></span>
        <span class="ew-search-operator">
<?= $Language->phrase("LIKE") ?>
<input type="hidden" name="z_nama_daerah" id="z_nama_daerah" value="LIKE">
</span>
        </label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->nama_daerah->cellAttributes() ?>>
            <span id="el_daerah_nama_daerah" class="ew-search-field ew-search-field-single">
<input type="<?= $Page->nama_daerah->getInputTextType() ?>" data-table="daerah" data-field="x_nama_daerah" name="x_nama_daerah" id="x_nama_daerah" size="30" maxlength="50" placeholder="<?= HtmlEncode($Page->nama_daerah->getPlaceHolder()) ?>" value="<?= $Page->nama_daerah->EditValue ?>"<?= $Page->nama_daerah->editAttributes() ?>>
<div class="invalid-feedback"><?= $Page->nama_daerah->getErrorMessage(false) ?></div>
</span>
        </div></div>
    </div>
<?php } ?>
</div><!-- /page* -->
<?php if (!$Page->IsModal) { ?>
<div class="form-group row"><!-- buttons .form-group -->
    <div class="<?= $Page->OffsetColumnClass ?>"><!-- buttons offset -->
        <button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit"><?= $Language->phrase("Search") ?></button>
        <button class="btn btn-default ew-btn" name="btn-reset" id="btn-reset" type="button" onclick="location.reload();"><?= $Language->phrase("Reset") ?></button>
    </div><!-- /buttons offset -->
</div><!-- /buttons .form-group -->
<?php } ?>
</form>
<?php
$Page->showPageFooter();
echo GetDebugMessage();
?>
<script>
// Field event handlers
loadjs.ready("head", function() {
    ew.addEventHandlers("daerah");
});
</script>
<script>
loadjs.ready("load", function () {
    // Write your table-specific startup script here, no need to add script tags.
});
</script>
