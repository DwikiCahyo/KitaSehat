<?php

namespace PHPMaker2021\satusehat;

// Page object
$WebusersEdit = &$Page;
?>
<script>
var currentForm, currentPageID;
var fwebusersedit;
loadjs.ready("head", function () {
    var $ = jQuery;
    // Form object
    currentPageID = ew.PAGE_ID = "edit";
    fwebusersedit = currentForm = new ew.Form("fwebusersedit", "edit");

    // Add fields
    var currentTable = <?= JsonEncode(GetClientVar("tables", "webusers")) ?>,
        fields = currentTable.fields;
    if (!ew.vars.tables.webusers)
        ew.vars.tables.webusers = currentTable;
    fwebusersedit.addFields([
        ["id", [fields.id.visible && fields.id.required ? ew.Validators.required(fields.id.caption) : null], fields.id.isInvalid],
        ["_username", [fields._username.visible && fields._username.required ? ew.Validators.required(fields._username.caption) : null], fields._username.isInvalid],
        ["_password", [fields._password.visible && fields._password.required ? ew.Validators.required(fields._password.caption) : null], fields._password.isInvalid],
        ["role", [fields.role.visible && fields.role.required ? ew.Validators.required(fields.role.caption) : null], fields.role.isInvalid],
        ["rumah_sakit_id", [fields.rumah_sakit_id.visible && fields.rumah_sakit_id.required ? ew.Validators.required(fields.rumah_sakit_id.caption) : null], fields.rumah_sakit_id.isInvalid],
        ["administrator_rumah_sakit", [fields.administrator_rumah_sakit.visible && fields.administrator_rumah_sakit.required ? ew.Validators.required(fields.administrator_rumah_sakit.caption) : null], fields.administrator_rumah_sakit.isInvalid],
        ["dokter_id", [fields.dokter_id.visible && fields.dokter_id.required ? ew.Validators.required(fields.dokter_id.caption) : null], fields.dokter_id.isInvalid]
    ]);

    // Set invalid fields
    $(function() {
        var f = fwebusersedit,
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
    fwebusersedit.validate = function () {
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
    fwebusersedit.customValidate = function(fobj) { // DO NOT CHANGE THIS LINE!
        // Your custom validation code here, return false if invalid.
        return true;
    }

    // Use JavaScript validation or not
    fwebusersedit.validateRequired = <?= Config("CLIENT_VALIDATE") ? "true" : "false" ?>;

    // Dynamic selection lists
    fwebusersedit.lists.role = <?= $Page->role->toClientList($Page) ?>;
    fwebusersedit.lists.rumah_sakit_id = <?= $Page->rumah_sakit_id->toClientList($Page) ?>;
    fwebusersedit.lists.administrator_rumah_sakit = <?= $Page->administrator_rumah_sakit->toClientList($Page) ?>;
    fwebusersedit.lists.dokter_id = <?= $Page->dokter_id->toClientList($Page) ?>;
    loadjs.done("fwebusersedit");
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
<form name="fwebusersedit" id="fwebusersedit" class="<?= $Page->FormClassName ?>" action="<?= CurrentPageUrl(false) ?>" method="post">
<?php if (Config("CHECK_TOKEN")) { ?>
<input type="hidden" name="<?= $TokenNameKey ?>" value="<?= $TokenName ?>"><!-- CSRF token name -->
<input type="hidden" name="<?= $TokenValueKey ?>" value="<?= $TokenValue ?>"><!-- CSRF token value -->
<?php } ?>
<input type="hidden" name="t" value="webusers">
<input type="hidden" name="action" id="action" value="update">
<input type="hidden" name="modal" value="<?= (int)$Page->IsModal ?>">
<input type="hidden" name="<?= $Page->OldKeyName ?>" value="<?= $Page->OldKey ?>">
<div class="ew-edit-div"><!-- page* -->
<?php if ($Page->id->Visible) { // id ?>
    <div id="r_id" class="form-group row">
        <label id="elh_webusers_id" class="<?= $Page->LeftColumnClass ?>"><?= $Page->id->caption() ?><?= $Page->id->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->id->cellAttributes() ?>>
<span id="el_webusers_id">
<span<?= $Page->id->viewAttributes() ?>>
<input type="text" readonly class="form-control-plaintext" value="<?= HtmlEncode(RemoveHtml($Page->id->getDisplayValue($Page->id->EditValue))) ?>"></span>
</span>
<input type="hidden" data-table="webusers" data-field="x_id" data-hidden="1" name="x_id" id="x_id" value="<?= HtmlEncode($Page->id->CurrentValue) ?>">
</div></div>
    </div>
<?php } ?>
<?php if ($Page->_username->Visible) { // username ?>
    <div id="r__username" class="form-group row">
        <label id="elh_webusers__username" for="x__username" class="<?= $Page->LeftColumnClass ?>"><?= $Page->_username->caption() ?><?= $Page->_username->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->_username->cellAttributes() ?>>
<span id="el_webusers__username">
<input type="<?= $Page->_username->getInputTextType() ?>" data-table="webusers" data-field="x__username" name="x__username" id="x__username" size="30" maxlength="255" placeholder="<?= HtmlEncode($Page->_username->getPlaceHolder()) ?>" value="<?= $Page->_username->EditValue ?>"<?= $Page->_username->editAttributes() ?> aria-describedby="x__username_help">
<?= $Page->_username->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->_username->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->_password->Visible) { // password ?>
    <div id="r__password" class="form-group row">
        <label id="elh_webusers__password" for="x__password" class="<?= $Page->LeftColumnClass ?>"><?= $Page->_password->caption() ?><?= $Page->_password->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->_password->cellAttributes() ?>>
<span id="el_webusers__password">
<div class="input-group">
    <input type="password" name="x__password" id="x__password" autocomplete="new-password" data-field="x__password" value="<?= $Page->_password->EditValue ?>" size="30" maxlength="255" placeholder="<?= HtmlEncode($Page->_password->getPlaceHolder()) ?>"<?= $Page->_password->editAttributes() ?> aria-describedby="x__password_help">
    <div class="input-group-append"><button type="button" class="btn btn-default ew-toggle-password rounded-right" onclick="ew.togglePassword(event);"><i class="fas fa-eye"></i></button></div>
</div>
<?= $Page->_password->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->_password->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->role->Visible) { // role ?>
    <div id="r_role" class="form-group row">
        <label id="elh_webusers_role" for="x_role" class="<?= $Page->LeftColumnClass ?>"><?= $Page->role->caption() ?><?= $Page->role->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->role->cellAttributes() ?>>
<?php if (!$Security->isAdmin() && $Security->isLoggedIn()) { // Non system admin ?>
<span id="el_webusers_role">
<input type="text" readonly class="form-control-plaintext" value="<?= HtmlEncode(RemoveHtml($Page->role->getDisplayValue($Page->role->EditValue))) ?>">
</span>
<?php } else { ?>
<span id="el_webusers_role">
    <select
        id="x_role"
        name="x_role"
        class="form-control ew-select<?= $Page->role->isInvalidClass() ?>"
        data-select2-id="webusers_x_role"
        data-table="webusers"
        data-field="x_role"
        data-value-separator="<?= $Page->role->displayValueSeparatorAttribute() ?>"
        data-placeholder="<?= HtmlEncode($Page->role->getPlaceHolder()) ?>"
        <?= $Page->role->editAttributes() ?>>
        <?= $Page->role->selectOptionListHtml("x_role") ?>
    </select>
    <?= $Page->role->getCustomMessage() ?>
    <div class="invalid-feedback"><?= $Page->role->getErrorMessage() ?></div>
<script>
loadjs.ready("head", function() {
    var el = document.querySelector("select[data-select2-id='webusers_x_role']"),
        options = { name: "x_role", selectId: "webusers_x_role", language: ew.LANGUAGE_ID, dir: ew.IS_RTL ? "rtl" : "ltr" };
    options.data = ew.vars.tables.webusers.fields.role.lookupOptions;
    options.dropdownParent = $(el).closest("#ew-modal-dialog, #ew-add-opt-dialog")[0];
    Object.assign(options, ew.vars.tables.webusers.fields.role.selectOptions);
    ew.createSelect(options);
});
</script>
</span>
<?php } ?>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->rumah_sakit_id->Visible) { // rumah_sakit_id ?>
    <div id="r_rumah_sakit_id" class="form-group row">
        <label id="elh_webusers_rumah_sakit_id" for="x_rumah_sakit_id" class="<?= $Page->LeftColumnClass ?>"><?= $Page->rumah_sakit_id->caption() ?><?= $Page->rumah_sakit_id->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->rumah_sakit_id->cellAttributes() ?>>
<span id="el_webusers_rumah_sakit_id">
<div class="input-group ew-lookup-list" aria-describedby="x_rumah_sakit_id_help">
    <div class="form-control ew-lookup-text" tabindex="-1" id="lu_x_rumah_sakit_id"><?= EmptyValue(strval($Page->rumah_sakit_id->ViewValue)) ? $Language->phrase("PleaseSelect") : $Page->rumah_sakit_id->ViewValue ?></div>
    <div class="input-group-append">
        <button type="button" title="<?= HtmlEncode(str_replace("%s", RemoveHtml($Page->rumah_sakit_id->caption()), $Language->phrase("LookupLink", true))) ?>" class="ew-lookup-btn btn btn-default"<?= ($Page->rumah_sakit_id->ReadOnly || $Page->rumah_sakit_id->Disabled) ? " disabled" : "" ?> onclick="ew.modalLookupShow({lnk:this,el:'x_rumah_sakit_id',m:0,n:10});"><i class="fas fa-search ew-icon"></i></button>
    </div>
</div>
<div class="invalid-feedback"><?= $Page->rumah_sakit_id->getErrorMessage() ?></div>
<?= $Page->rumah_sakit_id->getCustomMessage() ?>
<?= $Page->rumah_sakit_id->Lookup->getParamTag($Page, "p_x_rumah_sakit_id") ?>
<input type="hidden" is="selection-list" data-table="webusers" data-field="x_rumah_sakit_id" data-type="text" data-multiple="0" data-lookup="1" data-value-separator="<?= $Page->rumah_sakit_id->displayValueSeparatorAttribute() ?>" name="x_rumah_sakit_id" id="x_rumah_sakit_id" value="<?= $Page->rumah_sakit_id->CurrentValue ?>"<?= $Page->rumah_sakit_id->editAttributes() ?>>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->administrator_rumah_sakit->Visible) { // administrator_rumah_sakit ?>
    <div id="r_administrator_rumah_sakit" class="form-group row">
        <label id="elh_webusers_administrator_rumah_sakit" for="x_administrator_rumah_sakit" class="<?= $Page->LeftColumnClass ?>"><?= $Page->administrator_rumah_sakit->caption() ?><?= $Page->administrator_rumah_sakit->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->administrator_rumah_sakit->cellAttributes() ?>>
<?php if (!$Security->isAdmin() && $Security->isLoggedIn()) { // Non system admin ?>
<?php if (SameString($Page->id->CurrentValue, CurrentUserID())) { ?>
    <span id="el_webusers_administrator_rumah_sakit">
    <span<?= $Page->administrator_rumah_sakit->viewAttributes() ?>>
    <input type="text" readonly class="form-control-plaintext" value="<?= HtmlEncode(RemoveHtml($Page->administrator_rumah_sakit->getDisplayValue($Page->administrator_rumah_sakit->EditValue))) ?>"></span>
    </span>
    <input type="hidden" data-table="webusers" data-field="x_administrator_rumah_sakit" data-hidden="1" name="x_administrator_rumah_sakit" id="x_administrator_rumah_sakit" value="<?= HtmlEncode($Page->administrator_rumah_sakit->CurrentValue) ?>">
<?php } else { ?>
<span id="el_webusers_administrator_rumah_sakit">
    <select
        id="x_administrator_rumah_sakit"
        name="x_administrator_rumah_sakit"
        class="form-control ew-select<?= $Page->administrator_rumah_sakit->isInvalidClass() ?>"
        data-select2-id="webusers_x_administrator_rumah_sakit"
        data-table="webusers"
        data-field="x_administrator_rumah_sakit"
        data-value-separator="<?= $Page->administrator_rumah_sakit->displayValueSeparatorAttribute() ?>"
        data-placeholder="<?= HtmlEncode($Page->administrator_rumah_sakit->getPlaceHolder()) ?>"
        <?= $Page->administrator_rumah_sakit->editAttributes() ?>>
        <?= $Page->administrator_rumah_sakit->selectOptionListHtml("x_administrator_rumah_sakit") ?>
    </select>
    <?= $Page->administrator_rumah_sakit->getCustomMessage() ?>
    <div class="invalid-feedback"><?= $Page->administrator_rumah_sakit->getErrorMessage() ?></div>
<?= $Page->administrator_rumah_sakit->Lookup->getParamTag($Page, "p_x_administrator_rumah_sakit") ?>
<script>
loadjs.ready("head", function() {
    var el = document.querySelector("select[data-select2-id='webusers_x_administrator_rumah_sakit']"),
        options = { name: "x_administrator_rumah_sakit", selectId: "webusers_x_administrator_rumah_sakit", language: ew.LANGUAGE_ID, dir: ew.IS_RTL ? "rtl" : "ltr" };
    options.dropdownParent = $(el).closest("#ew-modal-dialog, #ew-add-opt-dialog")[0];
    Object.assign(options, ew.vars.tables.webusers.fields.administrator_rumah_sakit.selectOptions);
    ew.createSelect(options);
});
</script>
</span>
<?php } ?>
<?php } else { ?>
<span id="el_webusers_administrator_rumah_sakit">
    <select
        id="x_administrator_rumah_sakit"
        name="x_administrator_rumah_sakit"
        class="form-control ew-select<?= $Page->administrator_rumah_sakit->isInvalidClass() ?>"
        data-select2-id="webusers_x_administrator_rumah_sakit"
        data-table="webusers"
        data-field="x_administrator_rumah_sakit"
        data-value-separator="<?= $Page->administrator_rumah_sakit->displayValueSeparatorAttribute() ?>"
        data-placeholder="<?= HtmlEncode($Page->administrator_rumah_sakit->getPlaceHolder()) ?>"
        <?= $Page->administrator_rumah_sakit->editAttributes() ?>>
        <?= $Page->administrator_rumah_sakit->selectOptionListHtml("x_administrator_rumah_sakit") ?>
    </select>
    <?= $Page->administrator_rumah_sakit->getCustomMessage() ?>
    <div class="invalid-feedback"><?= $Page->administrator_rumah_sakit->getErrorMessage() ?></div>
<?= $Page->administrator_rumah_sakit->Lookup->getParamTag($Page, "p_x_administrator_rumah_sakit") ?>
<script>
loadjs.ready("head", function() {
    var el = document.querySelector("select[data-select2-id='webusers_x_administrator_rumah_sakit']"),
        options = { name: "x_administrator_rumah_sakit", selectId: "webusers_x_administrator_rumah_sakit", language: ew.LANGUAGE_ID, dir: ew.IS_RTL ? "rtl" : "ltr" };
    options.dropdownParent = $(el).closest("#ew-modal-dialog, #ew-add-opt-dialog")[0];
    Object.assign(options, ew.vars.tables.webusers.fields.administrator_rumah_sakit.selectOptions);
    ew.createSelect(options);
});
</script>
</span>
<?php } ?>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->dokter_id->Visible) { // dokter_id ?>
    <div id="r_dokter_id" class="form-group row">
        <label id="elh_webusers_dokter_id" for="x_dokter_id" class="<?= $Page->LeftColumnClass ?>"><?= $Page->dokter_id->caption() ?><?= $Page->dokter_id->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->dokter_id->cellAttributes() ?>>
<span id="el_webusers_dokter_id">
<div class="input-group ew-lookup-list" aria-describedby="x_dokter_id_help">
    <div class="form-control ew-lookup-text" tabindex="-1" id="lu_x_dokter_id"><?= EmptyValue(strval($Page->dokter_id->ViewValue)) ? $Language->phrase("PleaseSelect") : $Page->dokter_id->ViewValue ?></div>
    <div class="input-group-append">
        <button type="button" title="<?= HtmlEncode(str_replace("%s", RemoveHtml($Page->dokter_id->caption()), $Language->phrase("LookupLink", true))) ?>" class="ew-lookup-btn btn btn-default"<?= ($Page->dokter_id->ReadOnly || $Page->dokter_id->Disabled) ? " disabled" : "" ?> onclick="ew.modalLookupShow({lnk:this,el:'x_dokter_id',m:0,n:10});"><i class="fas fa-search ew-icon"></i></button>
    </div>
</div>
<div class="invalid-feedback"><?= $Page->dokter_id->getErrorMessage() ?></div>
<?= $Page->dokter_id->getCustomMessage() ?>
<?= $Page->dokter_id->Lookup->getParamTag($Page, "p_x_dokter_id") ?>
<input type="hidden" is="selection-list" data-table="webusers" data-field="x_dokter_id" data-type="text" data-multiple="0" data-lookup="1" data-value-separator="<?= $Page->dokter_id->displayValueSeparatorAttribute() ?>" name="x_dokter_id" id="x_dokter_id" value="<?= $Page->dokter_id->CurrentValue ?>"<?= $Page->dokter_id->editAttributes() ?>>
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
    ew.addEventHandlers("webusers");
});
</script>
<script>
loadjs.ready("load", function () {
    // Write your table-specific startup script here, no need to add script tags.
});
</script>
