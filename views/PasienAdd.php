<?php

namespace PHPMaker2021\satusehat;

// Page object
$PasienAdd = &$Page;
?>
<script>
var currentForm, currentPageID;
var fpasienadd;
loadjs.ready("head", function () {
    var $ = jQuery;
    // Form object
    currentPageID = ew.PAGE_ID = "add";
    fpasienadd = currentForm = new ew.Form("fpasienadd", "add");

    // Add fields
    var currentTable = <?= JsonEncode(GetClientVar("tables", "pasien")) ?>,
        fields = currentTable.fields;
    if (!ew.vars.tables.pasien)
        ew.vars.tables.pasien = currentTable;
    fpasienadd.addFields([
        ["nik", [fields.nik.visible && fields.nik.required ? ew.Validators.required(fields.nik.caption) : null], fields.nik.isInvalid],
        ["nama", [fields.nama.visible && fields.nama.required ? ew.Validators.required(fields.nama.caption) : null], fields.nama.isInvalid],
        ["jenis_kelamin", [fields.jenis_kelamin.visible && fields.jenis_kelamin.required ? ew.Validators.required(fields.jenis_kelamin.caption) : null], fields.jenis_kelamin.isInvalid],
        ["tanggal_lahir", [fields.tanggal_lahir.visible && fields.tanggal_lahir.required ? ew.Validators.required(fields.tanggal_lahir.caption) : null, ew.Validators.datetime(0)], fields.tanggal_lahir.isInvalid],
        ["agama", [fields.agama.visible && fields.agama.required ? ew.Validators.required(fields.agama.caption) : null], fields.agama.isInvalid],
        ["pekerjaan", [fields.pekerjaan.visible && fields.pekerjaan.required ? ew.Validators.required(fields.pekerjaan.caption) : null], fields.pekerjaan.isInvalid],
        ["pendidikan", [fields.pendidikan.visible && fields.pendidikan.required ? ew.Validators.required(fields.pendidikan.caption) : null], fields.pendidikan.isInvalid],
        ["status_perkawinan", [fields.status_perkawinan.visible && fields.status_perkawinan.required ? ew.Validators.required(fields.status_perkawinan.caption) : null], fields.status_perkawinan.isInvalid],
        ["no_bpjs", [fields.no_bpjs.visible && fields.no_bpjs.required ? ew.Validators.required(fields.no_bpjs.caption) : null], fields.no_bpjs.isInvalid],
        ["no_hp", [fields.no_hp.visible && fields.no_hp.required ? ew.Validators.required(fields.no_hp.caption) : null], fields.no_hp.isInvalid],
        ["_password", [fields._password.visible && fields._password.required ? ew.Validators.required(fields._password.caption) : null], fields._password.isInvalid]
    ]);

    // Set invalid fields
    $(function() {
        var f = fpasienadd,
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
    fpasienadd.validate = function () {
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
    fpasienadd.customValidate = function(fobj) { // DO NOT CHANGE THIS LINE!
        // Your custom validation code here, return false if invalid.
        return true;
    }

    // Use JavaScript validation or not
    fpasienadd.validateRequired = <?= Config("CLIENT_VALIDATE") ? "true" : "false" ?>;

    // Dynamic selection lists
    fpasienadd.lists.jenis_kelamin = <?= $Page->jenis_kelamin->toClientList($Page) ?>;
    fpasienadd.lists.agama = <?= $Page->agama->toClientList($Page) ?>;
    fpasienadd.lists.pekerjaan = <?= $Page->pekerjaan->toClientList($Page) ?>;
    fpasienadd.lists.pendidikan = <?= $Page->pendidikan->toClientList($Page) ?>;
    fpasienadd.lists.status_perkawinan = <?= $Page->status_perkawinan->toClientList($Page) ?>;
    loadjs.done("fpasienadd");
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
<form name="fpasienadd" id="fpasienadd" class="<?= $Page->FormClassName ?>" action="<?= CurrentPageUrl(false) ?>" method="post">
<?php if (Config("CHECK_TOKEN")) { ?>
<input type="hidden" name="<?= $TokenNameKey ?>" value="<?= $TokenName ?>"><!-- CSRF token name -->
<input type="hidden" name="<?= $TokenValueKey ?>" value="<?= $TokenValue ?>"><!-- CSRF token value -->
<?php } ?>
<input type="hidden" name="t" value="pasien">
<input type="hidden" name="action" id="action" value="insert">
<input type="hidden" name="modal" value="<?= (int)$Page->IsModal ?>">
<input type="hidden" name="<?= $Page->OldKeyName ?>" value="<?= $Page->OldKey ?>">
<div class="ew-add-div"><!-- page* -->
<?php if ($Page->nik->Visible) { // nik ?>
    <div id="r_nik" class="form-group row">
        <label id="elh_pasien_nik" for="x_nik" class="<?= $Page->LeftColumnClass ?>"><?= $Page->nik->caption() ?><?= $Page->nik->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->nik->cellAttributes() ?>>
<span id="el_pasien_nik">
<input type="<?= $Page->nik->getInputTextType() ?>" data-table="pasien" data-field="x_nik" name="x_nik" id="x_nik" size="30" maxlength="16" placeholder="<?= HtmlEncode($Page->nik->getPlaceHolder()) ?>" value="<?= $Page->nik->EditValue ?>"<?= $Page->nik->editAttributes() ?> aria-describedby="x_nik_help">
<?= $Page->nik->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->nik->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->nama->Visible) { // nama ?>
    <div id="r_nama" class="form-group row">
        <label id="elh_pasien_nama" for="x_nama" class="<?= $Page->LeftColumnClass ?>"><?= $Page->nama->caption() ?><?= $Page->nama->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->nama->cellAttributes() ?>>
<span id="el_pasien_nama">
<input type="<?= $Page->nama->getInputTextType() ?>" data-table="pasien" data-field="x_nama" name="x_nama" id="x_nama" size="30" maxlength="255" placeholder="<?= HtmlEncode($Page->nama->getPlaceHolder()) ?>" value="<?= $Page->nama->EditValue ?>"<?= $Page->nama->editAttributes() ?> aria-describedby="x_nama_help">
<?= $Page->nama->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->nama->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->jenis_kelamin->Visible) { // jenis_kelamin ?>
    <div id="r_jenis_kelamin" class="form-group row">
        <label id="elh_pasien_jenis_kelamin" class="<?= $Page->LeftColumnClass ?>"><?= $Page->jenis_kelamin->caption() ?><?= $Page->jenis_kelamin->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->jenis_kelamin->cellAttributes() ?>>
<span id="el_pasien_jenis_kelamin">
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
    value="<?= HtmlEncode($Page->jenis_kelamin->CurrentValue) ?>"
    data-type="select-one"
    data-template="tp_x_jenis_kelamin"
    data-target="dsl_x_jenis_kelamin"
    data-repeatcolumn="5"
    class="form-control<?= $Page->jenis_kelamin->isInvalidClass() ?>"
    data-table="pasien"
    data-field="x_jenis_kelamin"
    data-value-separator="<?= $Page->jenis_kelamin->displayValueSeparatorAttribute() ?>"
    <?= $Page->jenis_kelamin->editAttributes() ?>>
<?= $Page->jenis_kelamin->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->jenis_kelamin->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->tanggal_lahir->Visible) { // tanggal_lahir ?>
    <div id="r_tanggal_lahir" class="form-group row">
        <label id="elh_pasien_tanggal_lahir" for="x_tanggal_lahir" class="<?= $Page->LeftColumnClass ?>"><?= $Page->tanggal_lahir->caption() ?><?= $Page->tanggal_lahir->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->tanggal_lahir->cellAttributes() ?>>
<span id="el_pasien_tanggal_lahir">
<input type="<?= $Page->tanggal_lahir->getInputTextType() ?>" data-table="pasien" data-field="x_tanggal_lahir" name="x_tanggal_lahir" id="x_tanggal_lahir" placeholder="<?= HtmlEncode($Page->tanggal_lahir->getPlaceHolder()) ?>" value="<?= $Page->tanggal_lahir->EditValue ?>"<?= $Page->tanggal_lahir->editAttributes() ?> aria-describedby="x_tanggal_lahir_help">
<?= $Page->tanggal_lahir->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->tanggal_lahir->getErrorMessage() ?></div>
<?php if (!$Page->tanggal_lahir->ReadOnly && !$Page->tanggal_lahir->Disabled && !isset($Page->tanggal_lahir->EditAttrs["readonly"]) && !isset($Page->tanggal_lahir->EditAttrs["disabled"])) { ?>
<script>
loadjs.ready(["fpasienadd", "datetimepicker"], function() {
    ew.createDateTimePicker("fpasienadd", "x_tanggal_lahir", {"ignoreReadonly":true,"useCurrent":false,"format":0});
});
</script>
<?php } ?>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->agama->Visible) { // agama ?>
    <div id="r_agama" class="form-group row">
        <label id="elh_pasien_agama" class="<?= $Page->LeftColumnClass ?>"><?= $Page->agama->caption() ?><?= $Page->agama->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->agama->cellAttributes() ?>>
<span id="el_pasien_agama">
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
    value="<?= HtmlEncode($Page->agama->CurrentValue) ?>"
    data-type="select-one"
    data-template="tp_x_agama"
    data-target="dsl_x_agama"
    data-repeatcolumn="5"
    class="form-control<?= $Page->agama->isInvalidClass() ?>"
    data-table="pasien"
    data-field="x_agama"
    data-value-separator="<?= $Page->agama->displayValueSeparatorAttribute() ?>"
    <?= $Page->agama->editAttributes() ?>>
<?= $Page->agama->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->agama->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->pekerjaan->Visible) { // pekerjaan ?>
    <div id="r_pekerjaan" class="form-group row">
        <label id="elh_pasien_pekerjaan" class="<?= $Page->LeftColumnClass ?>"><?= $Page->pekerjaan->caption() ?><?= $Page->pekerjaan->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->pekerjaan->cellAttributes() ?>>
<span id="el_pasien_pekerjaan">
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
    value="<?= HtmlEncode($Page->pekerjaan->CurrentValue) ?>"
    data-type="select-one"
    data-template="tp_x_pekerjaan"
    data-target="dsl_x_pekerjaan"
    data-repeatcolumn="5"
    class="form-control<?= $Page->pekerjaan->isInvalidClass() ?>"
    data-table="pasien"
    data-field="x_pekerjaan"
    data-value-separator="<?= $Page->pekerjaan->displayValueSeparatorAttribute() ?>"
    <?= $Page->pekerjaan->editAttributes() ?>>
<?= $Page->pekerjaan->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->pekerjaan->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->pendidikan->Visible) { // pendidikan ?>
    <div id="r_pendidikan" class="form-group row">
        <label id="elh_pasien_pendidikan" class="<?= $Page->LeftColumnClass ?>"><?= $Page->pendidikan->caption() ?><?= $Page->pendidikan->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->pendidikan->cellAttributes() ?>>
<span id="el_pasien_pendidikan">
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
    value="<?= HtmlEncode($Page->pendidikan->CurrentValue) ?>"
    data-type="select-one"
    data-template="tp_x_pendidikan"
    data-target="dsl_x_pendidikan"
    data-repeatcolumn="5"
    class="form-control<?= $Page->pendidikan->isInvalidClass() ?>"
    data-table="pasien"
    data-field="x_pendidikan"
    data-value-separator="<?= $Page->pendidikan->displayValueSeparatorAttribute() ?>"
    <?= $Page->pendidikan->editAttributes() ?>>
<?= $Page->pendidikan->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->pendidikan->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->status_perkawinan->Visible) { // status_perkawinan ?>
    <div id="r_status_perkawinan" class="form-group row">
        <label id="elh_pasien_status_perkawinan" class="<?= $Page->LeftColumnClass ?>"><?= $Page->status_perkawinan->caption() ?><?= $Page->status_perkawinan->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->status_perkawinan->cellAttributes() ?>>
<span id="el_pasien_status_perkawinan">
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
    value="<?= HtmlEncode($Page->status_perkawinan->CurrentValue) ?>"
    data-type="select-one"
    data-template="tp_x_status_perkawinan"
    data-target="dsl_x_status_perkawinan"
    data-repeatcolumn="5"
    class="form-control<?= $Page->status_perkawinan->isInvalidClass() ?>"
    data-table="pasien"
    data-field="x_status_perkawinan"
    data-value-separator="<?= $Page->status_perkawinan->displayValueSeparatorAttribute() ?>"
    <?= $Page->status_perkawinan->editAttributes() ?>>
<?= $Page->status_perkawinan->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->status_perkawinan->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->no_bpjs->Visible) { // no_bpjs ?>
    <div id="r_no_bpjs" class="form-group row">
        <label id="elh_pasien_no_bpjs" for="x_no_bpjs" class="<?= $Page->LeftColumnClass ?>"><?= $Page->no_bpjs->caption() ?><?= $Page->no_bpjs->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->no_bpjs->cellAttributes() ?>>
<span id="el_pasien_no_bpjs">
<input type="<?= $Page->no_bpjs->getInputTextType() ?>" data-table="pasien" data-field="x_no_bpjs" name="x_no_bpjs" id="x_no_bpjs" size="30" maxlength="13" placeholder="<?= HtmlEncode($Page->no_bpjs->getPlaceHolder()) ?>" value="<?= $Page->no_bpjs->EditValue ?>"<?= $Page->no_bpjs->editAttributes() ?> aria-describedby="x_no_bpjs_help">
<?= $Page->no_bpjs->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->no_bpjs->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->no_hp->Visible) { // no_hp ?>
    <div id="r_no_hp" class="form-group row">
        <label id="elh_pasien_no_hp" for="x_no_hp" class="<?= $Page->LeftColumnClass ?>"><?= $Page->no_hp->caption() ?><?= $Page->no_hp->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->no_hp->cellAttributes() ?>>
<span id="el_pasien_no_hp">
<input type="<?= $Page->no_hp->getInputTextType() ?>" data-table="pasien" data-field="x_no_hp" name="x_no_hp" id="x_no_hp" size="30" maxlength="15" placeholder="<?= HtmlEncode($Page->no_hp->getPlaceHolder()) ?>" value="<?= $Page->no_hp->EditValue ?>"<?= $Page->no_hp->editAttributes() ?> aria-describedby="x_no_hp_help">
<?= $Page->no_hp->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->no_hp->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->_password->Visible) { // password ?>
    <div id="r__password" class="form-group row">
        <label id="elh_pasien__password" for="x__password" class="<?= $Page->LeftColumnClass ?>"><?= $Page->_password->caption() ?><?= $Page->_password->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->_password->cellAttributes() ?>>
<span id="el_pasien__password">
<div class="input-group">
    <input type="password" name="x__password" id="x__password" autocomplete="new-password" data-field="x__password" size="30" maxlength="255" placeholder="<?= HtmlEncode($Page->_password->getPlaceHolder()) ?>"<?= $Page->_password->editAttributes() ?> aria-describedby="x__password_help">
    <div class="input-group-append"><button type="button" class="btn btn-default ew-toggle-password rounded-right" onclick="ew.togglePassword(event);"><i class="fas fa-eye"></i></button></div>
</div>
<?= $Page->_password->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->_password->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
</div><!-- /page* -->
<?php
    if (in_array("kontak_darurat", explode(",", $Page->getCurrentDetailTable())) && $kontak_darurat->DetailAdd) {
?>
<?php if ($Page->getCurrentDetailTable() != "") { ?>
<h4 class="ew-detail-caption"><?= $Language->tablePhrase("kontak_darurat", "TblCaption") ?></h4>
<?php } ?>
<?php include_once "KontakDaruratGrid.php" ?>
<?php } ?>
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
    ew.addEventHandlers("pasien");
});
</script>
<script>
loadjs.ready("load", function () {
    // Write your table-specific startup script here, no need to add script tags.
});
</script>
