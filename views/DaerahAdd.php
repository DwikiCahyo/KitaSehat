<?php

namespace PHPMaker2021\satusehat;

// Page object
$DaerahAdd = &$Page;
?>
<script>
var currentForm, currentPageID;
var fdaerahadd;
loadjs.ready("head", function () {
    var $ = jQuery;
    // Form object
    currentPageID = ew.PAGE_ID = "add";
    fdaerahadd = currentForm = new ew.Form("fdaerahadd", "add");

    // Add fields
    var currentTable = <?= JsonEncode(GetClientVar("tables", "daerah")) ?>,
        fields = currentTable.fields;
    if (!ew.vars.tables.daerah)
        ew.vars.tables.daerah = currentTable;
    fdaerahadd.addFields([
        ["jenis", [fields.jenis.visible && fields.jenis.required ? ew.Validators.required(fields.jenis.caption) : null], fields.jenis.isInvalid],
        ["nama_daerah", [fields.nama_daerah.visible && fields.nama_daerah.required ? ew.Validators.required(fields.nama_daerah.caption) : null], fields.nama_daerah.isInvalid]
    ]);

    // Set invalid fields
    $(function() {
        var f = fdaerahadd,
            fobj = f.getForm(),
            $fobj = $(fobj),
            $k = $fobj.find("#" + f.formKeyCountName), // Get key_count
            rowcnt = ($k[0]) ? parseInt($k.val(), 10) : 1,
            startcnt = (rowcnt == 0) ? 0 : 1; // Check rowcnt == 0 => Inline-Add
        for (var i = startcnt; i <= rowcnt; i++) {
            var rowIndex = ($k[0]) ? String(i) : "";
            f.setInvalid(rowIndex);
        }
    });

    // Validate form
    fdaerahadd.validate = function () {
        if (!this.validateRequired)
            return true; // Ignore validation
        var fobj = this.getForm(),
            $fobj = $(fobj);
        if ($fobj.find("#confirm").val() == "confirm")
            return true;
        var addcnt = 0,
            $k = $fobj.find("#" + this.formKeyCountName), // Get key_count
            rowcnt = ($k[0]) ? parseInt($k.val(), 10) : 1,
            startcnt = (rowcnt == 0) ? 0 : 1, // Check rowcnt == 0 => Inline-Add
            gridinsert = ["insert", "gridinsert"].includes($fobj.find("#action").val()) && $k[0];
        for (var i = startcnt; i <= rowcnt; i++) {
            var rowIndex = ($k[0]) ? String(i) : "";
            $fobj.data("rowindex", rowIndex);

            // Validate fields
            if (!this.validateFields(rowIndex))
                return false;

            // Call Form_CustomValidate event
            if (!this.customValidate(fobj)) {
                this.focus();
                return false;
            }
        }

        // Process detail forms
        var dfs = $fobj.find("input[name='detailpage']").get();
        for (var i = 0; i < dfs.length; i++) {
            var df = dfs[i],
                val = df.value,
                frm = ew.forms.get(val);
            if (val && frm && !frm.validate())
                return false;
        }
        return true;
    }

    // Form_CustomValidate
    fdaerahadd.customValidate = function(fobj) { // DO NOT CHANGE THIS LINE!
        // Your custom validation code here, return false if invalid.
        return true;
    }

    // Use JavaScript validation or not
    fdaerahadd.validateRequired = <?= Config("CLIENT_VALIDATE") ? "true" : "false" ?>;

    // Dynamic selection lists
    fdaerahadd.lists.jenis = <?= $Page->jenis->toClientList($Page) ?>;
    loadjs.done("fdaerahadd");
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
<form name="fdaerahadd" id="fdaerahadd" class="<?= $Page->FormClassName ?>" action="<?= CurrentPageUrl(false) ?>" method="post">
<?php if (Config("CHECK_TOKEN")) { ?>
<input type="hidden" name="<?= $TokenNameKey ?>" value="<?= $TokenName ?>"><!-- CSRF token name -->
<input type="hidden" name="<?= $TokenValueKey ?>" value="<?= $TokenValue ?>"><!-- CSRF token value -->
<?php } ?>
<input type="hidden" name="t" value="daerah">
<input type="hidden" name="action" id="action" value="insert">
<input type="hidden" name="modal" value="<?= (int)$Page->IsModal ?>">
<input type="hidden" name="<?= $Page->OldKeyName ?>" value="<?= $Page->OldKey ?>">
<div class="ew-add-div"><!-- page* -->
<?php if ($Page->jenis->Visible) { // jenis ?>
    <div id="r_jenis" class="form-group row">
        <label id="elh_daerah_jenis" class="<?= $Page->LeftColumnClass ?>"><?= $Page->jenis->caption() ?><?= $Page->jenis->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->jenis->cellAttributes() ?>>
<span id="el_daerah_jenis">
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
    value="<?= HtmlEncode($Page->jenis->CurrentValue) ?>"
    data-type="select-one"
    data-template="tp_x_jenis"
    data-target="dsl_x_jenis"
    data-repeatcolumn="5"
    class="form-control<?= $Page->jenis->isInvalidClass() ?>"
    data-table="daerah"
    data-field="x_jenis"
    data-value-separator="<?= $Page->jenis->displayValueSeparatorAttribute() ?>"
    <?= $Page->jenis->editAttributes() ?>>
<?= $Page->jenis->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->jenis->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->nama_daerah->Visible) { // nama_daerah ?>
    <div id="r_nama_daerah" class="form-group row">
        <label id="elh_daerah_nama_daerah" for="x_nama_daerah" class="<?= $Page->LeftColumnClass ?>"><?= $Page->nama_daerah->caption() ?><?= $Page->nama_daerah->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->nama_daerah->cellAttributes() ?>>
<span id="el_daerah_nama_daerah">
<input type="<?= $Page->nama_daerah->getInputTextType() ?>" data-table="daerah" data-field="x_nama_daerah" name="x_nama_daerah" id="x_nama_daerah" size="30" maxlength="50" placeholder="<?= HtmlEncode($Page->nama_daerah->getPlaceHolder()) ?>" value="<?= $Page->nama_daerah->EditValue ?>"<?= $Page->nama_daerah->editAttributes() ?> aria-describedby="x_nama_daerah_help">
<?= $Page->nama_daerah->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->nama_daerah->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
</div><!-- /page* -->
<?php if (!$Page->IsModal) { ?>
<div class="form-group row"><!-- buttons .form-group -->
    <div class="<?= $Page->OffsetColumnClass ?>"><!-- buttons offset -->
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit"><?= $Language->phrase("AddBtn") ?></button>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" data-href="<?= HtmlEncode(GetUrl($Page->getReturnUrl())) ?>"><?= $Language->phrase("CancelBtn") ?></button>
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
