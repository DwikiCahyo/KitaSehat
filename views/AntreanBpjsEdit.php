<?php

namespace PHPMaker2021\satusehat;

// Page object
$AntreanBpjsEdit = &$Page;
?>
<script>
var currentForm, currentPageID;
var fantrean_bpjsedit;
loadjs.ready("head", function () {
    var $ = jQuery;
    // Form object
    currentPageID = ew.PAGE_ID = "edit";
    fantrean_bpjsedit = currentForm = new ew.Form("fantrean_bpjsedit", "edit");

    // Add fields
    var currentTable = <?= JsonEncode(GetClientVar("tables", "antrean_bpjs")) ?>,
        fields = currentTable.fields;
    if (!ew.vars.tables.antrean_bpjs)
        ew.vars.tables.antrean_bpjs = currentTable;
    fantrean_bpjsedit.addFields([
        ["id", [fields.id.visible && fields.id.required ? ew.Validators.required(fields.id.caption) : null], fields.id.isInvalid],
        ["nomor_antrean", [fields.nomor_antrean.visible && fields.nomor_antrean.required ? ew.Validators.required(fields.nomor_antrean.caption) : null], fields.nomor_antrean.isInvalid],
        ["waktu", [fields.waktu.visible && fields.waktu.required ? ew.Validators.required(fields.waktu.caption) : null], fields.waktu.isInvalid],
        ["pasien_id", [fields.pasien_id.visible && fields.pasien_id.required ? ew.Validators.required(fields.pasien_id.caption) : null], fields.pasien_id.isInvalid],
        ["fasilitas_id", [fields.fasilitas_id.visible && fields.fasilitas_id.required ? ew.Validators.required(fields.fasilitas_id.caption) : null], fields.fasilitas_id.isInvalid],
        ["rumah_sakit_id", [fields.rumah_sakit_id.visible && fields.rumah_sakit_id.required ? ew.Validators.required(fields.rumah_sakit_id.caption) : null], fields.rumah_sakit_id.isInvalid],
        ["status", [fields.status.visible && fields.status.required ? ew.Validators.required(fields.status.caption) : null], fields.status.isInvalid]
    ]);

    // Set invalid fields
    $(function() {
        var f = fantrean_bpjsedit,
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
    fantrean_bpjsedit.validate = function () {
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
    fantrean_bpjsedit.customValidate = function(fobj) { // DO NOT CHANGE THIS LINE!
        // Your custom validation code here, return false if invalid.
        return true;
    }

    // Use JavaScript validation or not
    fantrean_bpjsedit.validateRequired = <?= Config("CLIENT_VALIDATE") ? "true" : "false" ?>;

    // Dynamic selection lists
    fantrean_bpjsedit.lists.status = <?= $Page->status->toClientList($Page) ?>;
    loadjs.done("fantrean_bpjsedit");
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
<form name="fantrean_bpjsedit" id="fantrean_bpjsedit" class="<?= $Page->FormClassName ?>" action="<?= CurrentPageUrl(false) ?>" method="post">
<?php if (Config("CHECK_TOKEN")) { ?>
<input type="hidden" name="<?= $TokenNameKey ?>" value="<?= $TokenName ?>"><!-- CSRF token name -->
<input type="hidden" name="<?= $TokenValueKey ?>" value="<?= $TokenValue ?>"><!-- CSRF token value -->
<?php } ?>
<input type="hidden" name="t" value="antrean_bpjs">
<input type="hidden" name="action" id="action" value="update">
<input type="hidden" name="modal" value="<?= (int)$Page->IsModal ?>">
<input type="hidden" name="<?= $Page->OldKeyName ?>" value="<?= $Page->OldKey ?>">
<div class="ew-edit-div"><!-- page* -->
<?php if ($Page->id->Visible) { // id ?>
    <div id="r_id" class="form-group row">
        <label id="elh_antrean_bpjs_id" class="<?= $Page->LeftColumnClass ?>"><?= $Page->id->caption() ?><?= $Page->id->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->id->cellAttributes() ?>>
<span id="el_antrean_bpjs_id">
<span<?= $Page->id->viewAttributes() ?>>
<input type="text" readonly class="form-control-plaintext" value="<?= HtmlEncode(RemoveHtml($Page->id->getDisplayValue($Page->id->EditValue))) ?>"></span>
</span>
<input type="hidden" data-table="antrean_bpjs" data-field="x_id" data-hidden="1" name="x_id" id="x_id" value="<?= HtmlEncode($Page->id->CurrentValue) ?>">
</div></div>
    </div>
<?php } ?>
<?php if ($Page->nomor_antrean->Visible) { // nomor_antrean ?>
    <div id="r_nomor_antrean" class="form-group row">
        <label id="elh_antrean_bpjs_nomor_antrean" for="x_nomor_antrean" class="<?= $Page->LeftColumnClass ?>"><?= $Page->nomor_antrean->caption() ?><?= $Page->nomor_antrean->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->nomor_antrean->cellAttributes() ?>>
<span id="el_antrean_bpjs_nomor_antrean">
<span<?= $Page->nomor_antrean->viewAttributes() ?>>
<input type="text" readonly class="form-control-plaintext" value="<?= HtmlEncode(RemoveHtml($Page->nomor_antrean->getDisplayValue($Page->nomor_antrean->EditValue))) ?>"></span>
</span>
<input type="hidden" data-table="antrean_bpjs" data-field="x_nomor_antrean" data-hidden="1" name="x_nomor_antrean" id="x_nomor_antrean" value="<?= HtmlEncode($Page->nomor_antrean->CurrentValue) ?>">
</div></div>
    </div>
<?php } ?>
<?php if ($Page->waktu->Visible) { // waktu ?>
    <div id="r_waktu" class="form-group row">
        <label id="elh_antrean_bpjs_waktu" for="x_waktu" class="<?= $Page->LeftColumnClass ?>"><?= $Page->waktu->caption() ?><?= $Page->waktu->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->waktu->cellAttributes() ?>>
<span id="el_antrean_bpjs_waktu">
<span<?= $Page->waktu->viewAttributes() ?>>
<input type="text" readonly class="form-control-plaintext" value="<?= HtmlEncode(RemoveHtml($Page->waktu->getDisplayValue($Page->waktu->EditValue))) ?>"></span>
</span>
<input type="hidden" data-table="antrean_bpjs" data-field="x_waktu" data-hidden="1" name="x_waktu" id="x_waktu" value="<?= HtmlEncode($Page->waktu->CurrentValue) ?>">
</div></div>
    </div>
<?php } ?>
<?php if ($Page->pasien_id->Visible) { // pasien_id ?>
    <div id="r_pasien_id" class="form-group row">
        <label id="elh_antrean_bpjs_pasien_id" for="x_pasien_id" class="<?= $Page->LeftColumnClass ?>"><?= $Page->pasien_id->caption() ?><?= $Page->pasien_id->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->pasien_id->cellAttributes() ?>>
<span id="el_antrean_bpjs_pasien_id">
<span<?= $Page->pasien_id->viewAttributes() ?>>
<input type="text" readonly class="form-control-plaintext" value="<?= HtmlEncode(RemoveHtml($Page->pasien_id->getDisplayValue($Page->pasien_id->EditValue))) ?>"></span>
</span>
<input type="hidden" data-table="antrean_bpjs" data-field="x_pasien_id" data-hidden="1" name="x_pasien_id" id="x_pasien_id" value="<?= HtmlEncode($Page->pasien_id->CurrentValue) ?>">
</div></div>
    </div>
<?php } ?>
<?php if ($Page->fasilitas_id->Visible) { // fasilitas_id ?>
    <div id="r_fasilitas_id" class="form-group row">
        <label id="elh_antrean_bpjs_fasilitas_id" for="x_fasilitas_id" class="<?= $Page->LeftColumnClass ?>"><?= $Page->fasilitas_id->caption() ?><?= $Page->fasilitas_id->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->fasilitas_id->cellAttributes() ?>>
<span id="el_antrean_bpjs_fasilitas_id">
<span<?= $Page->fasilitas_id->viewAttributes() ?>>
<input type="text" readonly class="form-control-plaintext" value="<?= HtmlEncode(RemoveHtml($Page->fasilitas_id->getDisplayValue($Page->fasilitas_id->EditValue))) ?>"></span>
</span>
<input type="hidden" data-table="antrean_bpjs" data-field="x_fasilitas_id" data-hidden="1" name="x_fasilitas_id" id="x_fasilitas_id" value="<?= HtmlEncode($Page->fasilitas_id->CurrentValue) ?>">
</div></div>
    </div>
<?php } ?>
<?php if ($Page->rumah_sakit_id->Visible) { // rumah_sakit_id ?>
    <div id="r_rumah_sakit_id" class="form-group row">
        <label id="elh_antrean_bpjs_rumah_sakit_id" class="<?= $Page->LeftColumnClass ?>"><?= $Page->rumah_sakit_id->caption() ?><?= $Page->rumah_sakit_id->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->rumah_sakit_id->cellAttributes() ?>>
<span id="el_antrean_bpjs_rumah_sakit_id">
<span<?= $Page->rumah_sakit_id->viewAttributes() ?>>
<input type="text" readonly class="form-control-plaintext" value="<?= HtmlEncode(RemoveHtml($Page->rumah_sakit_id->getDisplayValue($Page->rumah_sakit_id->EditValue))) ?>"></span>
</span>
<input type="hidden" data-table="antrean_bpjs" data-field="x_rumah_sakit_id" data-hidden="1" name="x_rumah_sakit_id" id="x_rumah_sakit_id" value="<?= HtmlEncode($Page->rumah_sakit_id->CurrentValue) ?>">
</div></div>
    </div>
<?php } ?>
<?php if ($Page->status->Visible) { // status ?>
    <div id="r_status" class="form-group row">
        <label id="elh_antrean_bpjs_status" class="<?= $Page->LeftColumnClass ?>"><?= $Page->status->caption() ?><?= $Page->status->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->status->cellAttributes() ?>>
<span id="el_antrean_bpjs_status">
<template id="tp_x_status">
    <div class="custom-control custom-radio">
        <input type="radio" class="custom-control-input" data-table="antrean_bpjs" data-field="x_status" name="x_status" id="x_status"<?= $Page->status->editAttributes() ?>>
        <label class="custom-control-label"></label>
    </div>
</template>
<div id="dsl_x_status" class="ew-item-list"></div>
<input type="hidden"
    is="selection-list"
    id="x_status"
    name="x_status"
    value="<?= HtmlEncode($Page->status->CurrentValue) ?>"
    data-type="select-one"
    data-template="tp_x_status"
    data-target="dsl_x_status"
    data-repeatcolumn="5"
    class="form-control<?= $Page->status->isInvalidClass() ?>"
    data-table="antrean_bpjs"
    data-field="x_status"
    data-value-separator="<?= $Page->status->displayValueSeparatorAttribute() ?>"
    <?= $Page->status->editAttributes() ?>>
<?= $Page->status->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->status->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
</div><!-- /page* -->
<?php if (!$Page->IsModal) { ?>
<div class="form-group row"><!-- buttons .form-group -->
    <div class="<?= $Page->OffsetColumnClass ?>"><!-- buttons offset -->
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit"><?= $Language->phrase("SaveBtn") ?></button>
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
    ew.addEventHandlers("antrean_bpjs");
});
</script>
<script>
loadjs.ready("load", function () {
    // Write your table-specific startup script here, no need to add script tags.
});
</script>
