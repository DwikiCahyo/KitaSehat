<?php

namespace PHPMaker2021\satusehat;

// Page object
$PasienSearch = &$Page;
?>
<script>
var currentForm, currentPageID;
var fpasiensearch, currentSearchForm, currentAdvancedSearchForm;
loadjs.ready("head", function () {
    var $ = jQuery;
    // Form object for search
    <?php if ($Page->IsModal) { ?>
    fpasiensearch = currentAdvancedSearchForm = new ew.Form("fpasiensearch", "search");
    <?php } else { ?>
    fpasiensearch = currentForm = new ew.Form("fpasiensearch", "search");
    <?php } ?>
    currentPageID = ew.PAGE_ID = "search";

    // Add fields
    var currentTable = <?= JsonEncode(GetClientVar("tables", "pasien")) ?>,
        fields = currentTable.fields;
    fpasiensearch.addFields([
        ["id", [ew.Validators.integer], fields.id.isInvalid],
        ["nik", [], fields.nik.isInvalid],
        ["nama", [], fields.nama.isInvalid],
        ["jenis_kelamin", [], fields.jenis_kelamin.isInvalid],
        ["tanggal_lahir", [ew.Validators.datetime(0)], fields.tanggal_lahir.isInvalid],
        ["agama", [], fields.agama.isInvalid],
        ["pekerjaan", [], fields.pekerjaan.isInvalid],
        ["pendidikan", [], fields.pendidikan.isInvalid],
        ["status_perkawinan", [], fields.status_perkawinan.isInvalid],
        ["no_bpjs", [], fields.no_bpjs.isInvalid],
        ["no_hp", [], fields.no_hp.isInvalid],
        ["_password", [], fields._password.isInvalid]
    ]);

    // Set invalid fields
    $(function() {
        fpasiensearch.setInvalid();
    });

    // Validate form
    fpasiensearch.validate = function () {
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
    fpasiensearch.customValidate = function(fobj) { // DO NOT CHANGE THIS LINE!
        // Your custom validation code here, return false if invalid.
        return true;
    }

    // Use JavaScript validation or not
    fpasiensearch.validateRequired = <?= Config("CLIENT_VALIDATE") ? "true" : "false" ?>;

    // Dynamic selection lists
    fpasiensearch.lists.jenis_kelamin = <?= $Page->jenis_kelamin->toClientList($Page) ?>;
    fpasiensearch.lists.agama = <?= $Page->agama->toClientList($Page) ?>;
    fpasiensearch.lists.pekerjaan = <?= $Page->pekerjaan->toClientList($Page) ?>;
    fpasiensearch.lists.pendidikan = <?= $Page->pendidikan->toClientList($Page) ?>;
    fpasiensearch.lists.status_perkawinan = <?= $Page->status_perkawinan->toClientList($Page) ?>;
    loadjs.done("fpasiensearch");
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
<form name="fpasiensearch" id="fpasiensearch" class="<?= $Page->FormClassName ?>" action="<?= CurrentPageUrl(false) ?>" method="post">
<?php if (Config("CHECK_TOKEN")) { ?>
<input type="hidden" name="<?= $TokenNameKey ?>" value="<?= $TokenName ?>"><!-- CSRF token name -->
<input type="hidden" name="<?= $TokenValueKey ?>" value="<?= $TokenValue ?>"><!-- CSRF token value -->
<?php } ?>
<input type="hidden" name="t" value="pasien">
<input type="hidden" name="action" id="action" value="search">
<input type="hidden" name="modal" value="<?= (int)$Page->IsModal ?>">
<div class="ew-search-div"><!-- page* -->
<?php if ($Page->id->Visible) { // id ?>
    <div id="r_id" class="form-group row">
        <label for="x_id" class="<?= $Page->LeftColumnClass ?>"><span id="elh_pasien_id"><?= $Page->id->caption() ?></span>
        <span class="ew-search-operator">
<?= $Language->phrase("=") ?>
<input type="hidden" name="z_id" id="z_id" value="=">
</span>
        </label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->id->cellAttributes() ?>>
            <span id="el_pasien_id" class="ew-search-field ew-search-field-single">
<input type="<?= $Page->id->getInputTextType() ?>" data-table="pasien" data-field="x_id" name="x_id" id="x_id" placeholder="<?= HtmlEncode($Page->id->getPlaceHolder()) ?>" value="<?= $Page->id->EditValue ?>"<?= $Page->id->editAttributes() ?>>
<div class="invalid-feedback"><?= $Page->id->getErrorMessage(false) ?></div>
</span>
        </div></div>
    </div>
<?php } ?>
<?php if ($Page->nik->Visible) { // nik ?>
    <div id="r_nik" class="form-group row">
        <label for="x_nik" class="<?= $Page->LeftColumnClass ?>"><span id="elh_pasien_nik"><?= $Page->nik->caption() ?></span>
        <span class="ew-search-operator">
<?= $Language->phrase("LIKE") ?>
<input type="hidden" name="z_nik" id="z_nik" value="LIKE">
</span>
        </label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->nik->cellAttributes() ?>>
            <span id="el_pasien_nik" class="ew-search-field ew-search-field-single">
<input type="<?= $Page->nik->getInputTextType() ?>" data-table="pasien" data-field="x_nik" name="x_nik" id="x_nik" size="30" maxlength="16" placeholder="<?= HtmlEncode($Page->nik->getPlaceHolder()) ?>" value="<?= $Page->nik->EditValue ?>"<?= $Page->nik->editAttributes() ?>>
<div class="invalid-feedback"><?= $Page->nik->getErrorMessage(false) ?></div>
</span>
        </div></div>
    </div>
<?php } ?>
<?php if ($Page->nama->Visible) { // nama ?>
    <div id="r_nama" class="form-group row">
        <label for="x_nama" class="<?= $Page->LeftColumnClass ?>"><span id="elh_pasien_nama"><?= $Page->nama->caption() ?></span>
        <span class="ew-search-operator">
<?= $Language->phrase("LIKE") ?>
<input type="hidden" name="z_nama" id="z_nama" value="LIKE">
</span>
        </label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->nama->cellAttributes() ?>>
            <span id="el_pasien_nama" class="ew-search-field ew-search-field-single">
<input type="<?= $Page->nama->getInputTextType() ?>" data-table="pasien" data-field="x_nama" name="x_nama" id="x_nama" size="30" maxlength="255" placeholder="<?= HtmlEncode($Page->nama->getPlaceHolder()) ?>" value="<?= $Page->nama->EditValue ?>"<?= $Page->nama->editAttributes() ?>>
<div class="invalid-feedback"><?= $Page->nama->getErrorMessage(false) ?></div>
</span>
        </div></div>
    </div>
<?php } ?>
<?php if ($Page->jenis_kelamin->Visible) { // jenis_kelamin ?>
    <div id="r_jenis_kelamin" class="form-group row">
        <label class="<?= $Page->LeftColumnClass ?>"><span id="elh_pasien_jenis_kelamin"><?= $Page->jenis_kelamin->caption() ?></span>
        <span class="ew-search-operator">
<?= $Language->phrase("=") ?>
<input type="hidden" name="z_jenis_kelamin" id="z_jenis_kelamin" value="=">
</span>
        </label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->jenis_kelamin->cellAttributes() ?>>
            <span id="el_pasien_jenis_kelamin" class="ew-search-field ew-search-field-single">
<template id="tp_x_jenis_kelamin">
    <div class="custom-control custom-radio">
        <input type="radio" class="custom-control-input" data-table="pasien" data-field="x_jenis_kelamin" name="x_jenis_kelamin" id="x_jenis_kelamin"<?= $Page->jenis_kelamin->editAttributes() ?>>
        <label class="custom-control-label"></label>
    </div>
</template>
<div id="dsl_x_jenis_kelamin" class="ew-item-list"></div>
<input type="hidden"
    is="selection-list"
    id="x_jenis_kelamin"
    name="x_jenis_kelamin"
    value="<?= HtmlEncode($Page->jenis_kelamin->AdvancedSearch->SearchValue) ?>"
    data-type="select-one"
    data-template="tp_x_jenis_kelamin"
    data-target="dsl_x_jenis_kelamin"
    data-repeatcolumn="5"
    class="form-control<?= $Page->jenis_kelamin->isInvalidClass() ?>"
    data-table="pasien"
    data-field="x_jenis_kelamin"
    data-value-separator="<?= $Page->jenis_kelamin->displayValueSeparatorAttribute() ?>"
    <?= $Page->jenis_kelamin->editAttributes() ?>>
<div class="invalid-feedback"><?= $Page->jenis_kelamin->getErrorMessage(false) ?></div>
</span>
        </div></div>
    </div>
<?php } ?>
<?php if ($Page->tanggal_lahir->Visible) { // tanggal_lahir ?>
    <div id="r_tanggal_lahir" class="form-group row">
        <label for="x_tanggal_lahir" class="<?= $Page->LeftColumnClass ?>"><span id="elh_pasien_tanggal_lahir"><?= $Page->tanggal_lahir->caption() ?></span>
        <span class="ew-search-operator">
<?= $Language->phrase("=") ?>
<input type="hidden" name="z_tanggal_lahir" id="z_tanggal_lahir" value="=">
</span>
        </label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->tanggal_lahir->cellAttributes() ?>>
            <span id="el_pasien_tanggal_lahir" class="ew-search-field ew-search-field-single">
<input type="<?= $Page->tanggal_lahir->getInputTextType() ?>" data-table="pasien" data-field="x_tanggal_lahir" name="x_tanggal_lahir" id="x_tanggal_lahir" placeholder="<?= HtmlEncode($Page->tanggal_lahir->getPlaceHolder()) ?>" value="<?= $Page->tanggal_lahir->EditValue ?>"<?= $Page->tanggal_lahir->editAttributes() ?>>
<div class="invalid-feedback"><?= $Page->tanggal_lahir->getErrorMessage(false) ?></div>
<?php if (!$Page->tanggal_lahir->ReadOnly && !$Page->tanggal_lahir->Disabled && !isset($Page->tanggal_lahir->EditAttrs["readonly"]) && !isset($Page->tanggal_lahir->EditAttrs["disabled"])) { ?>
<script>
loadjs.ready(["fpasiensearch", "datetimepicker"], function() {
    ew.createDateTimePicker("fpasiensearch", "x_tanggal_lahir", {"ignoreReadonly":true,"useCurrent":false,"format":0});
});
</script>
<?php } ?>
</span>
        </div></div>
    </div>
<?php } ?>
<?php if ($Page->agama->Visible) { // agama ?>
    <div id="r_agama" class="form-group row">
        <label class="<?= $Page->LeftColumnClass ?>"><span id="elh_pasien_agama"><?= $Page->agama->caption() ?></span>
        <span class="ew-search-operator">
<?= $Language->phrase("=") ?>
<input type="hidden" name="z_agama" id="z_agama" value="=">
</span>
        </label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->agama->cellAttributes() ?>>
            <span id="el_pasien_agama" class="ew-search-field ew-search-field-single">
<template id="tp_x_agama">
    <div class="custom-control custom-radio">
        <input type="radio" class="custom-control-input" data-table="pasien" data-field="x_agama" name="x_agama" id="x_agama"<?= $Page->agama->editAttributes() ?>>
        <label class="custom-control-label"></label>
    </div>
</template>
<div id="dsl_x_agama" class="ew-item-list"></div>
<input type="hidden"
    is="selection-list"
    id="x_agama"
    name="x_agama"
    value="<?= HtmlEncode($Page->agama->AdvancedSearch->SearchValue) ?>"
    data-type="select-one"
    data-template="tp_x_agama"
    data-target="dsl_x_agama"
    data-repeatcolumn="5"
    class="form-control<?= $Page->agama->isInvalidClass() ?>"
    data-table="pasien"
    data-field="x_agama"
    data-value-separator="<?= $Page->agama->displayValueSeparatorAttribute() ?>"
    <?= $Page->agama->editAttributes() ?>>
<div class="invalid-feedback"><?= $Page->agama->getErrorMessage(false) ?></div>
</span>
        </div></div>
    </div>
<?php } ?>
<?php if ($Page->pekerjaan->Visible) { // pekerjaan ?>
    <div id="r_pekerjaan" class="form-group row">
        <label class="<?= $Page->LeftColumnClass ?>"><span id="elh_pasien_pekerjaan"><?= $Page->pekerjaan->caption() ?></span>
        <span class="ew-search-operator">
<?= $Language->phrase("=") ?>
<input type="hidden" name="z_pekerjaan" id="z_pekerjaan" value="=">
</span>
        </label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->pekerjaan->cellAttributes() ?>>
            <span id="el_pasien_pekerjaan" class="ew-search-field ew-search-field-single">
<template id="tp_x_pekerjaan">
    <div class="custom-control custom-radio">
        <input type="radio" class="custom-control-input" data-table="pasien" data-field="x_pekerjaan" name="x_pekerjaan" id="x_pekerjaan"<?= $Page->pekerjaan->editAttributes() ?>>
        <label class="custom-control-label"></label>
    </div>
</template>
<div id="dsl_x_pekerjaan" class="ew-item-list"></div>
<input type="hidden"
    is="selection-list"
    id="x_pekerjaan"
    name="x_pekerjaan"
    value="<?= HtmlEncode($Page->pekerjaan->AdvancedSearch->SearchValue) ?>"
    data-type="select-one"
    data-template="tp_x_pekerjaan"
    data-target="dsl_x_pekerjaan"
    data-repeatcolumn="5"
    class="form-control<?= $Page->pekerjaan->isInvalidClass() ?>"
    data-table="pasien"
    data-field="x_pekerjaan"
    data-value-separator="<?= $Page->pekerjaan->displayValueSeparatorAttribute() ?>"
    <?= $Page->pekerjaan->editAttributes() ?>>
<div class="invalid-feedback"><?= $Page->pekerjaan->getErrorMessage(false) ?></div>
</span>
        </div></div>
    </div>
<?php } ?>
<?php if ($Page->pendidikan->Visible) { // pendidikan ?>
    <div id="r_pendidikan" class="form-group row">
        <label class="<?= $Page->LeftColumnClass ?>"><span id="elh_pasien_pendidikan"><?= $Page->pendidikan->caption() ?></span>
        <span class="ew-search-operator">
<?= $Language->phrase("=") ?>
<input type="hidden" name="z_pendidikan" id="z_pendidikan" value="=">
</span>
        </label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->pendidikan->cellAttributes() ?>>
            <span id="el_pasien_pendidikan" class="ew-search-field ew-search-field-single">
<template id="tp_x_pendidikan">
    <div class="custom-control custom-radio">
        <input type="radio" class="custom-control-input" data-table="pasien" data-field="x_pendidikan" name="x_pendidikan" id="x_pendidikan"<?= $Page->pendidikan->editAttributes() ?>>
        <label class="custom-control-label"></label>
    </div>
</template>
<div id="dsl_x_pendidikan" class="ew-item-list"></div>
<input type="hidden"
    is="selection-list"
    id="x_pendidikan"
    name="x_pendidikan"
    value="<?= HtmlEncode($Page->pendidikan->AdvancedSearch->SearchValue) ?>"
    data-type="select-one"
    data-template="tp_x_pendidikan"
    data-target="dsl_x_pendidikan"
    data-repeatcolumn="5"
    class="form-control<?= $Page->pendidikan->isInvalidClass() ?>"
    data-table="pasien"
    data-field="x_pendidikan"
    data-value-separator="<?= $Page->pendidikan->displayValueSeparatorAttribute() ?>"
    <?= $Page->pendidikan->editAttributes() ?>>
<div class="invalid-feedback"><?= $Page->pendidikan->getErrorMessage(false) ?></div>
</span>
        </div></div>
    </div>
<?php } ?>
<?php if ($Page->status_perkawinan->Visible) { // status_perkawinan ?>
    <div id="r_status_perkawinan" class="form-group row">
        <label class="<?= $Page->LeftColumnClass ?>"><span id="elh_pasien_status_perkawinan"><?= $Page->status_perkawinan->caption() ?></span>
        <span class="ew-search-operator">
<?= $Language->phrase("=") ?>
<input type="hidden" name="z_status_perkawinan" id="z_status_perkawinan" value="=">
</span>
        </label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->status_perkawinan->cellAttributes() ?>>
            <span id="el_pasien_status_perkawinan" class="ew-search-field ew-search-field-single">
<template id="tp_x_status_perkawinan">
    <div class="custom-control custom-radio">
        <input type="radio" class="custom-control-input" data-table="pasien" data-field="x_status_perkawinan" name="x_status_perkawinan" id="x_status_perkawinan"<?= $Page->status_perkawinan->editAttributes() ?>>
        <label class="custom-control-label"></label>
    </div>
</template>
<div id="dsl_x_status_perkawinan" class="ew-item-list"></div>
<input type="hidden"
    is="selection-list"
    id="x_status_perkawinan"
    name="x_status_perkawinan"
    value="<?= HtmlEncode($Page->status_perkawinan->AdvancedSearch->SearchValue) ?>"
    data-type="select-one"
    data-template="tp_x_status_perkawinan"
    data-target="dsl_x_status_perkawinan"
    data-repeatcolumn="5"
    class="form-control<?= $Page->status_perkawinan->isInvalidClass() ?>"
    data-table="pasien"
    data-field="x_status_perkawinan"
    data-value-separator="<?= $Page->status_perkawinan->displayValueSeparatorAttribute() ?>"
    <?= $Page->status_perkawinan->editAttributes() ?>>
<div class="invalid-feedback"><?= $Page->status_perkawinan->getErrorMessage(false) ?></div>
</span>
        </div></div>
    </div>
<?php } ?>
<?php if ($Page->no_bpjs->Visible) { // no_bpjs ?>
    <div id="r_no_bpjs" class="form-group row">
        <label for="x_no_bpjs" class="<?= $Page->LeftColumnClass ?>"><span id="elh_pasien_no_bpjs"><?= $Page->no_bpjs->caption() ?></span>
        <span class="ew-search-operator">
<?= $Language->phrase("LIKE") ?>
<input type="hidden" name="z_no_bpjs" id="z_no_bpjs" value="LIKE">
</span>
        </label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->no_bpjs->cellAttributes() ?>>
            <span id="el_pasien_no_bpjs" class="ew-search-field ew-search-field-single">
<input type="<?= $Page->no_bpjs->getInputTextType() ?>" data-table="pasien" data-field="x_no_bpjs" name="x_no_bpjs" id="x_no_bpjs" size="30" maxlength="13" placeholder="<?= HtmlEncode($Page->no_bpjs->getPlaceHolder()) ?>" value="<?= $Page->no_bpjs->EditValue ?>"<?= $Page->no_bpjs->editAttributes() ?>>
<div class="invalid-feedback"><?= $Page->no_bpjs->getErrorMessage(false) ?></div>
</span>
        </div></div>
    </div>
<?php } ?>
<?php if ($Page->no_hp->Visible) { // no_hp ?>
    <div id="r_no_hp" class="form-group row">
        <label for="x_no_hp" class="<?= $Page->LeftColumnClass ?>"><span id="elh_pasien_no_hp"><?= $Page->no_hp->caption() ?></span>
        <span class="ew-search-operator">
<?= $Language->phrase("LIKE") ?>
<input type="hidden" name="z_no_hp" id="z_no_hp" value="LIKE">
</span>
        </label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->no_hp->cellAttributes() ?>>
            <span id="el_pasien_no_hp" class="ew-search-field ew-search-field-single">
<input type="<?= $Page->no_hp->getInputTextType() ?>" data-table="pasien" data-field="x_no_hp" name="x_no_hp" id="x_no_hp" size="30" maxlength="15" placeholder="<?= HtmlEncode($Page->no_hp->getPlaceHolder()) ?>" value="<?= $Page->no_hp->EditValue ?>"<?= $Page->no_hp->editAttributes() ?>>
<div class="invalid-feedback"><?= $Page->no_hp->getErrorMessage(false) ?></div>
</span>
        </div></div>
    </div>
<?php } ?>
<?php if ($Page->_password->Visible) { // password ?>
    <div id="r__password" class="form-group row">
        <label for="x__password" class="<?= $Page->LeftColumnClass ?>"><span id="elh_pasien__password"><?= $Page->_password->caption() ?></span>
        <span class="ew-search-operator">
<?= $Language->phrase("LIKE") ?>
<input type="hidden" name="z__password" id="z__password" value="LIKE">
</span>
        </label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->_password->cellAttributes() ?>>
            <span id="el_pasien__password" class="ew-search-field ew-search-field-single">
<input type="<?= $Page->_password->getInputTextType() ?>" data-table="pasien" data-field="x__password" name="x__password" id="x__password" size="30" maxlength="255" placeholder="<?= HtmlEncode($Page->_password->getPlaceHolder()) ?>" value="<?= $Page->_password->EditValue ?>"<?= $Page->_password->editAttributes() ?>>
<div class="invalid-feedback"><?= $Page->_password->getErrorMessage(false) ?></div>
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
    ew.addEventHandlers("pasien");
});
</script>
<script>
loadjs.ready("load", function () {
    // Write your table-specific startup script here, no need to add script tags.
});
</script>
