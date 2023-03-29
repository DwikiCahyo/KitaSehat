<?php

namespace PHPMaker2021\satusehat;

// Page object
$AntreanBpjsSearch = &$Page;
?>
<script>
var currentForm, currentPageID;
var fantrean_bpjssearch, currentSearchForm, currentAdvancedSearchForm;
loadjs.ready("head", function () {
    var $ = jQuery;
    // Form object for search
    <?php if ($Page->IsModal) { ?>
    fantrean_bpjssearch = currentAdvancedSearchForm = new ew.Form("fantrean_bpjssearch", "search");
    <?php } else { ?>
    fantrean_bpjssearch = currentForm = new ew.Form("fantrean_bpjssearch", "search");
    <?php } ?>
    currentPageID = ew.PAGE_ID = "search";

    // Add fields
    var currentTable = <?= JsonEncode(GetClientVar("tables", "antrean_bpjs")) ?>,
        fields = currentTable.fields;
    fantrean_bpjssearch.addFields([
        ["id", [ew.Validators.integer], fields.id.isInvalid],
        ["nomor_antrean", [ew.Validators.integer], fields.nomor_antrean.isInvalid],
        ["waktu", [ew.Validators.datetime(0)], fields.waktu.isInvalid],
        ["pasien_id", [], fields.pasien_id.isInvalid],
        ["fasilitas_id", [], fields.fasilitas_id.isInvalid],
        ["rumah_sakit_id", [ew.Validators.integer], fields.rumah_sakit_id.isInvalid],
        ["status", [], fields.status.isInvalid]
    ]);

    // Set invalid fields
    $(function() {
        fantrean_bpjssearch.setInvalid();
    });

    // Validate form
    fantrean_bpjssearch.validate = function () {
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
    fantrean_bpjssearch.customValidate = function(fobj) { // DO NOT CHANGE THIS LINE!
        // Your custom validation code here, return false if invalid.
        return true;
    }

    // Use JavaScript validation or not
    fantrean_bpjssearch.validateRequired = <?= Config("CLIENT_VALIDATE") ? "true" : "false" ?>;

    // Dynamic selection lists
    fantrean_bpjssearch.lists.pasien_id = <?= $Page->pasien_id->toClientList($Page) ?>;
    fantrean_bpjssearch.lists.fasilitas_id = <?= $Page->fasilitas_id->toClientList($Page) ?>;
    fantrean_bpjssearch.lists.rumah_sakit_id = <?= $Page->rumah_sakit_id->toClientList($Page) ?>;
    fantrean_bpjssearch.lists.status = <?= $Page->status->toClientList($Page) ?>;
    loadjs.done("fantrean_bpjssearch");
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
<form name="fantrean_bpjssearch" id="fantrean_bpjssearch" class="<?= $Page->FormClassName ?>" action="<?= CurrentPageUrl(false) ?>" method="post">
<?php if (Config("CHECK_TOKEN")) { ?>
<input type="hidden" name="<?= $TokenNameKey ?>" value="<?= $TokenName ?>"><!-- CSRF token name -->
<input type="hidden" name="<?= $TokenValueKey ?>" value="<?= $TokenValue ?>"><!-- CSRF token value -->
<?php } ?>
<input type="hidden" name="t" value="antrean_bpjs">
<input type="hidden" name="action" id="action" value="search">
<input type="hidden" name="modal" value="<?= (int)$Page->IsModal ?>">
<div class="ew-search-div"><!-- page* -->
<?php if ($Page->id->Visible) { // id ?>
    <div id="r_id" class="form-group row">
        <label for="x_id" class="<?= $Page->LeftColumnClass ?>"><span id="elh_antrean_bpjs_id"><?= $Page->id->caption() ?></span>
        <span class="ew-search-operator">
<?= $Language->phrase("=") ?>
<input type="hidden" name="z_id" id="z_id" value="=">
</span>
        </label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->id->cellAttributes() ?>>
            <span id="el_antrean_bpjs_id" class="ew-search-field ew-search-field-single">
<input type="<?= $Page->id->getInputTextType() ?>" data-table="antrean_bpjs" data-field="x_id" name="x_id" id="x_id" placeholder="<?= HtmlEncode($Page->id->getPlaceHolder()) ?>" value="<?= $Page->id->EditValue ?>"<?= $Page->id->editAttributes() ?>>
<div class="invalid-feedback"><?= $Page->id->getErrorMessage(false) ?></div>
</span>
        </div></div>
    </div>
<?php } ?>
<?php if ($Page->nomor_antrean->Visible) { // nomor_antrean ?>
    <div id="r_nomor_antrean" class="form-group row">
        <label for="x_nomor_antrean" class="<?= $Page->LeftColumnClass ?>"><span id="elh_antrean_bpjs_nomor_antrean"><?= $Page->nomor_antrean->caption() ?></span>
        <span class="ew-search-operator">
<?= $Language->phrase("=") ?>
<input type="hidden" name="z_nomor_antrean" id="z_nomor_antrean" value="=">
</span>
        </label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->nomor_antrean->cellAttributes() ?>>
            <span id="el_antrean_bpjs_nomor_antrean" class="ew-search-field ew-search-field-single">
<input type="<?= $Page->nomor_antrean->getInputTextType() ?>" data-table="antrean_bpjs" data-field="x_nomor_antrean" name="x_nomor_antrean" id="x_nomor_antrean" size="30" placeholder="<?= HtmlEncode($Page->nomor_antrean->getPlaceHolder()) ?>" value="<?= $Page->nomor_antrean->EditValue ?>"<?= $Page->nomor_antrean->editAttributes() ?>>
<div class="invalid-feedback"><?= $Page->nomor_antrean->getErrorMessage(false) ?></div>
</span>
        </div></div>
    </div>
<?php } ?>
<?php if ($Page->waktu->Visible) { // waktu ?>
    <div id="r_waktu" class="form-group row">
        <label for="x_waktu" class="<?= $Page->LeftColumnClass ?>"><span id="elh_antrean_bpjs_waktu"><?= $Page->waktu->caption() ?></span>
        <span class="ew-search-operator">
<?= $Language->phrase("=") ?>
<input type="hidden" name="z_waktu" id="z_waktu" value="=">
</span>
        </label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->waktu->cellAttributes() ?>>
            <span id="el_antrean_bpjs_waktu" class="ew-search-field ew-search-field-single">
<input type="<?= $Page->waktu->getInputTextType() ?>" data-table="antrean_bpjs" data-field="x_waktu" name="x_waktu" id="x_waktu" placeholder="<?= HtmlEncode($Page->waktu->getPlaceHolder()) ?>" value="<?= $Page->waktu->EditValue ?>"<?= $Page->waktu->editAttributes() ?>>
<div class="invalid-feedback"><?= $Page->waktu->getErrorMessage(false) ?></div>
<?php if (!$Page->waktu->ReadOnly && !$Page->waktu->Disabled && !isset($Page->waktu->EditAttrs["readonly"]) && !isset($Page->waktu->EditAttrs["disabled"])) { ?>
<script>
loadjs.ready(["fantrean_bpjssearch", "datetimepicker"], function() {
    ew.createDateTimePicker("fantrean_bpjssearch", "x_waktu", {"ignoreReadonly":true,"useCurrent":false,"format":0});
});
</script>
<?php } ?>
</span>
        </div></div>
    </div>
<?php } ?>
<?php if ($Page->pasien_id->Visible) { // pasien_id ?>
    <div id="r_pasien_id" class="form-group row">
        <label for="x_pasien_id" class="<?= $Page->LeftColumnClass ?>"><span id="elh_antrean_bpjs_pasien_id"><?= $Page->pasien_id->caption() ?></span>
        <span class="ew-search-operator">
<?= $Language->phrase("=") ?>
<input type="hidden" name="z_pasien_id" id="z_pasien_id" value="=">
</span>
        </label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->pasien_id->cellAttributes() ?>>
            <span id="el_antrean_bpjs_pasien_id" class="ew-search-field ew-search-field-single">
<div class="input-group ew-lookup-list">
    <div class="form-control ew-lookup-text" tabindex="-1" id="lu_x_pasien_id"><?= EmptyValue(strval($Page->pasien_id->AdvancedSearch->ViewValue)) ? $Language->phrase("PleaseSelect") : $Page->pasien_id->AdvancedSearch->ViewValue ?></div>
    <div class="input-group-append">
        <button type="button" title="<?= HtmlEncode(str_replace("%s", RemoveHtml($Page->pasien_id->caption()), $Language->phrase("LookupLink", true))) ?>" class="ew-lookup-btn btn btn-default"<?= ($Page->pasien_id->ReadOnly || $Page->pasien_id->Disabled) ? " disabled" : "" ?> onclick="ew.modalLookupShow({lnk:this,el:'x_pasien_id',m:0,n:10});"><i class="fas fa-search ew-icon"></i></button>
    </div>
</div>
<div class="invalid-feedback"><?= $Page->pasien_id->getErrorMessage(false) ?></div>
<?= $Page->pasien_id->Lookup->getParamTag($Page, "p_x_pasien_id") ?>
<input type="hidden" is="selection-list" data-table="antrean_bpjs" data-field="x_pasien_id" data-type="text" data-multiple="0" data-lookup="1" data-value-separator="<?= $Page->pasien_id->displayValueSeparatorAttribute() ?>" name="x_pasien_id" id="x_pasien_id" value="<?= $Page->pasien_id->AdvancedSearch->SearchValue ?>"<?= $Page->pasien_id->editAttributes() ?>>
</span>
        </div></div>
    </div>
<?php } ?>
<?php if ($Page->fasilitas_id->Visible) { // fasilitas_id ?>
    <div id="r_fasilitas_id" class="form-group row">
        <label for="x_fasilitas_id" class="<?= $Page->LeftColumnClass ?>"><span id="elh_antrean_bpjs_fasilitas_id"><?= $Page->fasilitas_id->caption() ?></span>
        <span class="ew-search-operator">
<?= $Language->phrase("=") ?>
<input type="hidden" name="z_fasilitas_id" id="z_fasilitas_id" value="=">
</span>
        </label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->fasilitas_id->cellAttributes() ?>>
            <span id="el_antrean_bpjs_fasilitas_id" class="ew-search-field ew-search-field-single">
<div class="input-group ew-lookup-list">
    <div class="form-control ew-lookup-text" tabindex="-1" id="lu_x_fasilitas_id"><?= EmptyValue(strval($Page->fasilitas_id->AdvancedSearch->ViewValue)) ? $Language->phrase("PleaseSelect") : $Page->fasilitas_id->AdvancedSearch->ViewValue ?></div>
    <div class="input-group-append">
        <button type="button" title="<?= HtmlEncode(str_replace("%s", RemoveHtml($Page->fasilitas_id->caption()), $Language->phrase("LookupLink", true))) ?>" class="ew-lookup-btn btn btn-default"<?= ($Page->fasilitas_id->ReadOnly || $Page->fasilitas_id->Disabled) ? " disabled" : "" ?> onclick="ew.modalLookupShow({lnk:this,el:'x_fasilitas_id',m:0,n:10});"><i class="fas fa-search ew-icon"></i></button>
    </div>
</div>
<div class="invalid-feedback"><?= $Page->fasilitas_id->getErrorMessage(false) ?></div>
<?= $Page->fasilitas_id->Lookup->getParamTag($Page, "p_x_fasilitas_id") ?>
<input type="hidden" is="selection-list" data-table="antrean_bpjs" data-field="x_fasilitas_id" data-type="text" data-multiple="0" data-lookup="1" data-value-separator="<?= $Page->fasilitas_id->displayValueSeparatorAttribute() ?>" name="x_fasilitas_id" id="x_fasilitas_id" value="<?= $Page->fasilitas_id->AdvancedSearch->SearchValue ?>"<?= $Page->fasilitas_id->editAttributes() ?>>
</span>
        </div></div>
    </div>
<?php } ?>
<?php if ($Page->rumah_sakit_id->Visible) { // rumah_sakit_id ?>
    <div id="r_rumah_sakit_id" class="form-group row">
        <label class="<?= $Page->LeftColumnClass ?>"><span id="elh_antrean_bpjs_rumah_sakit_id"><?= $Page->rumah_sakit_id->caption() ?></span>
        <span class="ew-search-operator">
<?= $Language->phrase("=") ?>
<input type="hidden" name="z_rumah_sakit_id" id="z_rumah_sakit_id" value="=">
</span>
        </label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->rumah_sakit_id->cellAttributes() ?>>
            <span id="el_antrean_bpjs_rumah_sakit_id" class="ew-search-field ew-search-field-single">
<?php
$onchange = $Page->rumah_sakit_id->EditAttrs->prepend("onchange", "");
$onchange = ($onchange) ? ' onchange="' . JsEncode($onchange) . '"' : '';
$Page->rumah_sakit_id->EditAttrs["onchange"] = "";
?>
<span id="as_x_rumah_sakit_id" class="ew-auto-suggest">
    <input type="<?= $Page->rumah_sakit_id->getInputTextType() ?>" class="form-control" name="sv_x_rumah_sakit_id" id="sv_x_rumah_sakit_id" value="<?= RemoveHtml($Page->rumah_sakit_id->EditValue) ?>" size="30" placeholder="<?= HtmlEncode($Page->rumah_sakit_id->getPlaceHolder()) ?>" data-placeholder="<?= HtmlEncode($Page->rumah_sakit_id->getPlaceHolder()) ?>"<?= $Page->rumah_sakit_id->editAttributes() ?>>
</span>
<input type="hidden" is="selection-list" class="form-control" data-table="antrean_bpjs" data-field="x_rumah_sakit_id" data-input="sv_x_rumah_sakit_id" data-value-separator="<?= $Page->rumah_sakit_id->displayValueSeparatorAttribute() ?>" name="x_rumah_sakit_id" id="x_rumah_sakit_id" value="<?= HtmlEncode($Page->rumah_sakit_id->AdvancedSearch->SearchValue) ?>"<?= $onchange ?>>
<div class="invalid-feedback"><?= $Page->rumah_sakit_id->getErrorMessage(false) ?></div>
<script>
loadjs.ready(["fantrean_bpjssearch"], function() {
    fantrean_bpjssearch.createAutoSuggest(Object.assign({"id":"x_rumah_sakit_id","forceSelect":false}, ew.vars.tables.antrean_bpjs.fields.rumah_sakit_id.autoSuggestOptions));
});
</script>
<?= $Page->rumah_sakit_id->Lookup->getParamTag($Page, "p_x_rumah_sakit_id") ?>
</span>
        </div></div>
    </div>
<?php } ?>
<?php if ($Page->status->Visible) { // status ?>
    <div id="r_status" class="form-group row">
        <label class="<?= $Page->LeftColumnClass ?>"><span id="elh_antrean_bpjs_status"><?= $Page->status->caption() ?></span>
        <span class="ew-search-operator">
<?= $Language->phrase("=") ?>
<input type="hidden" name="z_status" id="z_status" value="=">
</span>
        </label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->status->cellAttributes() ?>>
            <span id="el_antrean_bpjs_status" class="ew-search-field ew-search-field-single">
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
    value="<?= HtmlEncode($Page->status->AdvancedSearch->SearchValue) ?>"
    data-type="select-one"
    data-template="tp_x_status"
    data-target="dsl_x_status"
    data-repeatcolumn="5"
    class="form-control<?= $Page->status->isInvalidClass() ?>"
    data-table="antrean_bpjs"
    data-field="x_status"
    data-value-separator="<?= $Page->status->displayValueSeparatorAttribute() ?>"
    <?= $Page->status->editAttributes() ?>>
<div class="invalid-feedback"><?= $Page->status->getErrorMessage(false) ?></div>
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
    ew.addEventHandlers("antrean_bpjs");
});
</script>
<script>
loadjs.ready("load", function () {
    // Write your table-specific startup script here, no need to add script tags.
});
</script>
