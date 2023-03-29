<?php

namespace PHPMaker2021\satusehat;

// Set up and run Grid object
$Grid = Container("KontakDaruratGrid");
$Grid->run();
?>
<?php if (!$Grid->isExport()) { ?>
<script>
var currentForm, currentPageID;
var fkontak_daruratgrid;
loadjs.ready("head", function () {
    var $ = jQuery;
    // Form object
    fkontak_daruratgrid = new ew.Form("fkontak_daruratgrid", "grid");
    fkontak_daruratgrid.formKeyCountName = '<?= $Grid->FormKeyCountName ?>';

    // Add fields
    var currentTable = <?= JsonEncode(GetClientVar("tables", "kontak_darurat")) ?>,
        fields = currentTable.fields;
    if (!ew.vars.tables.kontak_darurat)
        ew.vars.tables.kontak_darurat = currentTable;
    fkontak_daruratgrid.addFields([
        ["id", [fields.id.visible && fields.id.required ? ew.Validators.required(fields.id.caption) : null], fields.id.isInvalid],
        ["pasien_id", [fields.pasien_id.visible && fields.pasien_id.required ? ew.Validators.required(fields.pasien_id.caption) : null], fields.pasien_id.isInvalid],
        ["nama", [fields.nama.visible && fields.nama.required ? ew.Validators.required(fields.nama.caption) : null], fields.nama.isInvalid],
        ["no_hp", [fields.no_hp.visible && fields.no_hp.required ? ew.Validators.required(fields.no_hp.caption) : null], fields.no_hp.isInvalid]
    ]);

    // Set invalid fields
    $(function() {
        var f = fkontak_daruratgrid,
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
    fkontak_daruratgrid.validate = function () {
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
            var checkrow = (gridinsert) ? !this.emptyRow(rowIndex) : true;
            if (checkrow) {
                addcnt++;

            // Validate fields
            if (!this.validateFields(rowIndex))
                return false;

            // Call Form_CustomValidate event
            if (!this.customValidate(fobj)) {
                this.focus();
                return false;
            }
            } // End Grid Add checking
        }
        return true;
    }

    // Check empty row
    fkontak_daruratgrid.emptyRow = function (rowIndex) {
        var fobj = this.getForm();
        if (ew.valueChanged(fobj, rowIndex, "pasien_id", false))
            return false;
        if (ew.valueChanged(fobj, rowIndex, "nama", false))
            return false;
        if (ew.valueChanged(fobj, rowIndex, "no_hp", false))
            return false;
        return true;
    }

    // Form_CustomValidate
    fkontak_daruratgrid.customValidate = function(fobj) { // DO NOT CHANGE THIS LINE!
        // Your custom validation code here, return false if invalid.
        return true;
    }

    // Use JavaScript validation or not
    fkontak_daruratgrid.validateRequired = <?= Config("CLIENT_VALIDATE") ? "true" : "false" ?>;

    // Dynamic selection lists
    fkontak_daruratgrid.lists.pasien_id = <?= $Grid->pasien_id->toClientList($Grid) ?>;
    loadjs.done("fkontak_daruratgrid");
});
</script>
<?php } ?>
<?php
$Grid->renderOtherOptions();
?>
<?php if ($Grid->TotalRecords > 0 || $Grid->CurrentAction) { ?>
<div class="card ew-card ew-grid<?php if ($Grid->isAddOrEdit()) { ?> ew-grid-add-edit<?php } ?> kontak_darurat">
<div id="fkontak_daruratgrid" class="ew-form ew-list-form form-inline">
<div id="gmp_kontak_darurat" class="<?= ResponsiveTableClass() ?>card-body ew-grid-middle-panel">
<table id="tbl_kontak_daruratgrid" class="table ew-table"><!-- .ew-table -->
<thead>
    <tr class="ew-table-header">
<?php
// Header row
$Grid->RowType = ROWTYPE_HEADER;

// Render list options
$Grid->renderListOptions();

// Render list options (header, left)
$Grid->ListOptions->render("header", "left");
?>
<?php if ($Grid->id->Visible) { // id ?>
        <th data-name="id" class="<?= $Grid->id->headerCellClass() ?>"><div id="elh_kontak_darurat_id" class="kontak_darurat_id"><?= $Grid->renderSort($Grid->id) ?></div></th>
<?php } ?>
<?php if ($Grid->pasien_id->Visible) { // pasien_id ?>
        <th data-name="pasien_id" class="<?= $Grid->pasien_id->headerCellClass() ?>"><div id="elh_kontak_darurat_pasien_id" class="kontak_darurat_pasien_id"><?= $Grid->renderSort($Grid->pasien_id) ?></div></th>
<?php } ?>
<?php if ($Grid->nama->Visible) { // nama ?>
        <th data-name="nama" class="<?= $Grid->nama->headerCellClass() ?>"><div id="elh_kontak_darurat_nama" class="kontak_darurat_nama"><?= $Grid->renderSort($Grid->nama) ?></div></th>
<?php } ?>
<?php if ($Grid->no_hp->Visible) { // no_hp ?>
        <th data-name="no_hp" class="<?= $Grid->no_hp->headerCellClass() ?>"><div id="elh_kontak_darurat_no_hp" class="kontak_darurat_no_hp"><?= $Grid->renderSort($Grid->no_hp) ?></div></th>
<?php } ?>
<?php
// Render list options (header, right)
$Grid->ListOptions->render("header", "right");
?>
    </tr>
</thead>
<tbody>
<?php
$Grid->StartRecord = 1;
$Grid->StopRecord = $Grid->TotalRecords; // Show all records

// Restore number of post back records
if ($CurrentForm && ($Grid->isConfirm() || $Grid->EventCancelled)) {
    $CurrentForm->Index = -1;
    if ($CurrentForm->hasValue($Grid->FormKeyCountName) && ($Grid->isGridAdd() || $Grid->isGridEdit() || $Grid->isConfirm())) {
        $Grid->KeyCount = $CurrentForm->getValue($Grid->FormKeyCountName);
        $Grid->StopRecord = $Grid->StartRecord + $Grid->KeyCount - 1;
    }
}
$Grid->RecordCount = $Grid->StartRecord - 1;
if ($Grid->Recordset && !$Grid->Recordset->EOF) {
    // Nothing to do
} elseif (!$Grid->AllowAddDeleteRow && $Grid->StopRecord == 0) {
    $Grid->StopRecord = $Grid->GridAddRowCount;
}

// Initialize aggregate
$Grid->RowType = ROWTYPE_AGGREGATEINIT;
$Grid->resetAttributes();
$Grid->renderRow();
if ($Grid->isGridAdd())
    $Grid->RowIndex = 0;
if ($Grid->isGridEdit())
    $Grid->RowIndex = 0;
while ($Grid->RecordCount < $Grid->StopRecord) {
    $Grid->RecordCount++;
    if ($Grid->RecordCount >= $Grid->StartRecord) {
        $Grid->RowCount++;
        if ($Grid->isGridAdd() || $Grid->isGridEdit() || $Grid->isConfirm()) {
            $Grid->RowIndex++;
            $CurrentForm->Index = $Grid->RowIndex;
            if ($CurrentForm->hasValue($Grid->FormActionName) && ($Grid->isConfirm() || $Grid->EventCancelled)) {
                $Grid->RowAction = strval($CurrentForm->getValue($Grid->FormActionName));
            } elseif ($Grid->isGridAdd()) {
                $Grid->RowAction = "insert";
            } else {
                $Grid->RowAction = "";
            }
        }

        // Set up key count
        $Grid->KeyCount = $Grid->RowIndex;

        // Init row class and style
        $Grid->resetAttributes();
        $Grid->CssClass = "";
        if ($Grid->isGridAdd()) {
            if ($Grid->CurrentMode == "copy") {
                $Grid->loadRowValues($Grid->Recordset); // Load row values
                $Grid->OldKey = $Grid->getKey(true); // Get from CurrentValue
            } else {
                $Grid->loadRowValues(); // Load default values
                $Grid->OldKey = "";
            }
        } else {
            $Grid->loadRowValues($Grid->Recordset); // Load row values
            $Grid->OldKey = $Grid->getKey(true); // Get from CurrentValue
        }
        $Grid->setKey($Grid->OldKey);
        $Grid->RowType = ROWTYPE_VIEW; // Render view
        if ($Grid->isGridAdd()) { // Grid add
            $Grid->RowType = ROWTYPE_ADD; // Render add
        }
        if ($Grid->isGridAdd() && $Grid->EventCancelled && !$CurrentForm->hasValue("k_blankrow")) { // Insert failed
            $Grid->restoreCurrentRowFormValues($Grid->RowIndex); // Restore form values
        }
        if ($Grid->isGridEdit()) { // Grid edit
            if ($Grid->EventCancelled) {
                $Grid->restoreCurrentRowFormValues($Grid->RowIndex); // Restore form values
            }
            if ($Grid->RowAction == "insert") {
                $Grid->RowType = ROWTYPE_ADD; // Render add
            } else {
                $Grid->RowType = ROWTYPE_EDIT; // Render edit
            }
        }
        if ($Grid->isGridEdit() && ($Grid->RowType == ROWTYPE_EDIT || $Grid->RowType == ROWTYPE_ADD) && $Grid->EventCancelled) { // Update failed
            $Grid->restoreCurrentRowFormValues($Grid->RowIndex); // Restore form values
        }
        if ($Grid->RowType == ROWTYPE_EDIT) { // Edit row
            $Grid->EditRowCount++;
        }
        if ($Grid->isConfirm()) { // Confirm row
            $Grid->restoreCurrentRowFormValues($Grid->RowIndex); // Restore form values
        }

        // Set up row id / data-rowindex
        $Grid->RowAttrs->merge(["data-rowindex" => $Grid->RowCount, "id" => "r" . $Grid->RowCount . "_kontak_darurat", "data-rowtype" => $Grid->RowType]);

        // Render row
        $Grid->renderRow();

        // Render list options
        $Grid->renderListOptions();

        // Skip delete row / empty row for confirm page
        if ($Grid->RowAction != "delete" && $Grid->RowAction != "insertdelete" && !($Grid->RowAction == "insert" && $Grid->isConfirm() && $Grid->emptyRow())) {
?>
    <tr <?= $Grid->rowAttributes() ?>>
<?php
// Render list options (body, left)
$Grid->ListOptions->render("body", "left", $Grid->RowCount);
?>
    <?php if ($Grid->id->Visible) { // id ?>
        <td data-name="id" <?= $Grid->id->cellAttributes() ?>>
<?php if ($Grid->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?= $Grid->RowCount ?>_kontak_darurat_id" class="form-group"></span>
<input type="hidden" data-table="kontak_darurat" data-field="x_id" data-hidden="1" name="o<?= $Grid->RowIndex ?>_id" id="o<?= $Grid->RowIndex ?>_id" value="<?= HtmlEncode($Grid->id->OldValue) ?>">
<?php } ?>
<?php if ($Grid->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?= $Grid->RowCount ?>_kontak_darurat_id" class="form-group">
<span<?= $Grid->id->viewAttributes() ?>>
<input type="text" readonly class="form-control-plaintext" value="<?= HtmlEncode(RemoveHtml($Grid->id->getDisplayValue($Grid->id->EditValue))) ?>"></span>
</span>
<input type="hidden" data-table="kontak_darurat" data-field="x_id" data-hidden="1" name="x<?= $Grid->RowIndex ?>_id" id="x<?= $Grid->RowIndex ?>_id" value="<?= HtmlEncode($Grid->id->CurrentValue) ?>">
<?php } ?>
<?php if ($Grid->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?= $Grid->RowCount ?>_kontak_darurat_id">
<span<?= $Grid->id->viewAttributes() ?>>
<?= $Grid->id->getViewValue() ?></span>
</span>
<?php if ($Grid->isConfirm()) { ?>
<input type="hidden" data-table="kontak_darurat" data-field="x_id" data-hidden="1" name="fkontak_daruratgrid$x<?= $Grid->RowIndex ?>_id" id="fkontak_daruratgrid$x<?= $Grid->RowIndex ?>_id" value="<?= HtmlEncode($Grid->id->FormValue) ?>">
<input type="hidden" data-table="kontak_darurat" data-field="x_id" data-hidden="1" name="fkontak_daruratgrid$o<?= $Grid->RowIndex ?>_id" id="fkontak_daruratgrid$o<?= $Grid->RowIndex ?>_id" value="<?= HtmlEncode($Grid->id->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
    <?php } else { ?>
            <input type="hidden" data-table="kontak_darurat" data-field="x_id" data-hidden="1" name="x<?= $Grid->RowIndex ?>_id" id="x<?= $Grid->RowIndex ?>_id" value="<?= HtmlEncode($Grid->id->CurrentValue) ?>">
    <?php } ?>
    <?php if ($Grid->pasien_id->Visible) { // pasien_id ?>
        <td data-name="pasien_id" <?= $Grid->pasien_id->cellAttributes() ?>>
<?php if ($Grid->RowType == ROWTYPE_ADD) { // Add record ?>
<?php if ($Grid->pasien_id->getSessionValue() != "") { ?>
<span id="el<?= $Grid->RowCount ?>_kontak_darurat_pasien_id" class="form-group">
<span<?= $Grid->pasien_id->viewAttributes() ?>>
<input type="text" readonly class="form-control-plaintext" value="<?= HtmlEncode(RemoveHtml($Grid->pasien_id->getDisplayValue($Grid->pasien_id->ViewValue))) ?>"></span>
</span>
<input type="hidden" id="x<?= $Grid->RowIndex ?>_pasien_id" name="x<?= $Grid->RowIndex ?>_pasien_id" value="<?= HtmlEncode($Grid->pasien_id->CurrentValue) ?>" data-hidden="1">
<?php } else { ?>
<span id="el<?= $Grid->RowCount ?>_kontak_darurat_pasien_id" class="form-group">
<div class="input-group ew-lookup-list">
    <div class="form-control ew-lookup-text" tabindex="-1" id="lu_x<?= $Grid->RowIndex ?>_pasien_id"><?= EmptyValue(strval($Grid->pasien_id->ViewValue)) ? $Language->phrase("PleaseSelect") : $Grid->pasien_id->ViewValue ?></div>
    <div class="input-group-append">
        <button type="button" title="<?= HtmlEncode(str_replace("%s", RemoveHtml($Grid->pasien_id->caption()), $Language->phrase("LookupLink", true))) ?>" class="ew-lookup-btn btn btn-default"<?= ($Grid->pasien_id->ReadOnly || $Grid->pasien_id->Disabled) ? " disabled" : "" ?> onclick="ew.modalLookupShow({lnk:this,el:'x<?= $Grid->RowIndex ?>_pasien_id',m:0,n:10});"><i class="fas fa-search ew-icon"></i></button>
    </div>
</div>
<div class="invalid-feedback"><?= $Grid->pasien_id->getErrorMessage() ?></div>
<?= $Grid->pasien_id->Lookup->getParamTag($Grid, "p_x" . $Grid->RowIndex . "_pasien_id") ?>
<input type="hidden" is="selection-list" data-table="kontak_darurat" data-field="x_pasien_id" data-type="text" data-multiple="0" data-lookup="1" data-value-separator="<?= $Grid->pasien_id->displayValueSeparatorAttribute() ?>" name="x<?= $Grid->RowIndex ?>_pasien_id" id="x<?= $Grid->RowIndex ?>_pasien_id" value="<?= $Grid->pasien_id->CurrentValue ?>"<?= $Grid->pasien_id->editAttributes() ?>>
</span>
<?php } ?>
<input type="hidden" data-table="kontak_darurat" data-field="x_pasien_id" data-hidden="1" name="o<?= $Grid->RowIndex ?>_pasien_id" id="o<?= $Grid->RowIndex ?>_pasien_id" value="<?= HtmlEncode($Grid->pasien_id->OldValue) ?>">
<?php } ?>
<?php if ($Grid->RowType == ROWTYPE_EDIT) { // Edit record ?>
<?php if ($Grid->pasien_id->getSessionValue() != "") { ?>
<span id="el<?= $Grid->RowCount ?>_kontak_darurat_pasien_id" class="form-group">
<span<?= $Grid->pasien_id->viewAttributes() ?>>
<input type="text" readonly class="form-control-plaintext" value="<?= HtmlEncode(RemoveHtml($Grid->pasien_id->getDisplayValue($Grid->pasien_id->ViewValue))) ?>"></span>
</span>
<input type="hidden" id="x<?= $Grid->RowIndex ?>_pasien_id" name="x<?= $Grid->RowIndex ?>_pasien_id" value="<?= HtmlEncode($Grid->pasien_id->CurrentValue) ?>" data-hidden="1">
<?php } else { ?>
<span id="el<?= $Grid->RowCount ?>_kontak_darurat_pasien_id" class="form-group">
<div class="input-group ew-lookup-list">
    <div class="form-control ew-lookup-text" tabindex="-1" id="lu_x<?= $Grid->RowIndex ?>_pasien_id"><?= EmptyValue(strval($Grid->pasien_id->ViewValue)) ? $Language->phrase("PleaseSelect") : $Grid->pasien_id->ViewValue ?></div>
    <div class="input-group-append">
        <button type="button" title="<?= HtmlEncode(str_replace("%s", RemoveHtml($Grid->pasien_id->caption()), $Language->phrase("LookupLink", true))) ?>" class="ew-lookup-btn btn btn-default"<?= ($Grid->pasien_id->ReadOnly || $Grid->pasien_id->Disabled) ? " disabled" : "" ?> onclick="ew.modalLookupShow({lnk:this,el:'x<?= $Grid->RowIndex ?>_pasien_id',m:0,n:10});"><i class="fas fa-search ew-icon"></i></button>
    </div>
</div>
<div class="invalid-feedback"><?= $Grid->pasien_id->getErrorMessage() ?></div>
<?= $Grid->pasien_id->Lookup->getParamTag($Grid, "p_x" . $Grid->RowIndex . "_pasien_id") ?>
<input type="hidden" is="selection-list" data-table="kontak_darurat" data-field="x_pasien_id" data-type="text" data-multiple="0" data-lookup="1" data-value-separator="<?= $Grid->pasien_id->displayValueSeparatorAttribute() ?>" name="x<?= $Grid->RowIndex ?>_pasien_id" id="x<?= $Grid->RowIndex ?>_pasien_id" value="<?= $Grid->pasien_id->CurrentValue ?>"<?= $Grid->pasien_id->editAttributes() ?>>
</span>
<?php } ?>
<?php } ?>
<?php if ($Grid->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?= $Grid->RowCount ?>_kontak_darurat_pasien_id">
<span<?= $Grid->pasien_id->viewAttributes() ?>>
<?= $Grid->pasien_id->getViewValue() ?></span>
</span>
<?php if ($Grid->isConfirm()) { ?>
<input type="hidden" data-table="kontak_darurat" data-field="x_pasien_id" data-hidden="1" name="fkontak_daruratgrid$x<?= $Grid->RowIndex ?>_pasien_id" id="fkontak_daruratgrid$x<?= $Grid->RowIndex ?>_pasien_id" value="<?= HtmlEncode($Grid->pasien_id->FormValue) ?>">
<input type="hidden" data-table="kontak_darurat" data-field="x_pasien_id" data-hidden="1" name="fkontak_daruratgrid$o<?= $Grid->RowIndex ?>_pasien_id" id="fkontak_daruratgrid$o<?= $Grid->RowIndex ?>_pasien_id" value="<?= HtmlEncode($Grid->pasien_id->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
    <?php } ?>
    <?php if ($Grid->nama->Visible) { // nama ?>
        <td data-name="nama" <?= $Grid->nama->cellAttributes() ?>>
<?php if ($Grid->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?= $Grid->RowCount ?>_kontak_darurat_nama" class="form-group">
<input type="<?= $Grid->nama->getInputTextType() ?>" data-table="kontak_darurat" data-field="x_nama" name="x<?= $Grid->RowIndex ?>_nama" id="x<?= $Grid->RowIndex ?>_nama" size="30" maxlength="255" placeholder="<?= HtmlEncode($Grid->nama->getPlaceHolder()) ?>" value="<?= $Grid->nama->EditValue ?>"<?= $Grid->nama->editAttributes() ?>>
<div class="invalid-feedback"><?= $Grid->nama->getErrorMessage() ?></div>
</span>
<input type="hidden" data-table="kontak_darurat" data-field="x_nama" data-hidden="1" name="o<?= $Grid->RowIndex ?>_nama" id="o<?= $Grid->RowIndex ?>_nama" value="<?= HtmlEncode($Grid->nama->OldValue) ?>">
<?php } ?>
<?php if ($Grid->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?= $Grid->RowCount ?>_kontak_darurat_nama" class="form-group">
<input type="<?= $Grid->nama->getInputTextType() ?>" data-table="kontak_darurat" data-field="x_nama" name="x<?= $Grid->RowIndex ?>_nama" id="x<?= $Grid->RowIndex ?>_nama" size="30" maxlength="255" placeholder="<?= HtmlEncode($Grid->nama->getPlaceHolder()) ?>" value="<?= $Grid->nama->EditValue ?>"<?= $Grid->nama->editAttributes() ?>>
<div class="invalid-feedback"><?= $Grid->nama->getErrorMessage() ?></div>
</span>
<?php } ?>
<?php if ($Grid->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?= $Grid->RowCount ?>_kontak_darurat_nama">
<span<?= $Grid->nama->viewAttributes() ?>>
<?= $Grid->nama->getViewValue() ?></span>
</span>
<?php if ($Grid->isConfirm()) { ?>
<input type="hidden" data-table="kontak_darurat" data-field="x_nama" data-hidden="1" name="fkontak_daruratgrid$x<?= $Grid->RowIndex ?>_nama" id="fkontak_daruratgrid$x<?= $Grid->RowIndex ?>_nama" value="<?= HtmlEncode($Grid->nama->FormValue) ?>">
<input type="hidden" data-table="kontak_darurat" data-field="x_nama" data-hidden="1" name="fkontak_daruratgrid$o<?= $Grid->RowIndex ?>_nama" id="fkontak_daruratgrid$o<?= $Grid->RowIndex ?>_nama" value="<?= HtmlEncode($Grid->nama->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
    <?php } ?>
    <?php if ($Grid->no_hp->Visible) { // no_hp ?>
        <td data-name="no_hp" <?= $Grid->no_hp->cellAttributes() ?>>
<?php if ($Grid->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?= $Grid->RowCount ?>_kontak_darurat_no_hp" class="form-group">
<input type="<?= $Grid->no_hp->getInputTextType() ?>" data-table="kontak_darurat" data-field="x_no_hp" name="x<?= $Grid->RowIndex ?>_no_hp" id="x<?= $Grid->RowIndex ?>_no_hp" size="30" maxlength="15" placeholder="<?= HtmlEncode($Grid->no_hp->getPlaceHolder()) ?>" value="<?= $Grid->no_hp->EditValue ?>"<?= $Grid->no_hp->editAttributes() ?>>
<div class="invalid-feedback"><?= $Grid->no_hp->getErrorMessage() ?></div>
</span>
<input type="hidden" data-table="kontak_darurat" data-field="x_no_hp" data-hidden="1" name="o<?= $Grid->RowIndex ?>_no_hp" id="o<?= $Grid->RowIndex ?>_no_hp" value="<?= HtmlEncode($Grid->no_hp->OldValue) ?>">
<?php } ?>
<?php if ($Grid->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?= $Grid->RowCount ?>_kontak_darurat_no_hp" class="form-group">
<input type="<?= $Grid->no_hp->getInputTextType() ?>" data-table="kontak_darurat" data-field="x_no_hp" name="x<?= $Grid->RowIndex ?>_no_hp" id="x<?= $Grid->RowIndex ?>_no_hp" size="30" maxlength="15" placeholder="<?= HtmlEncode($Grid->no_hp->getPlaceHolder()) ?>" value="<?= $Grid->no_hp->EditValue ?>"<?= $Grid->no_hp->editAttributes() ?>>
<div class="invalid-feedback"><?= $Grid->no_hp->getErrorMessage() ?></div>
</span>
<?php } ?>
<?php if ($Grid->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?= $Grid->RowCount ?>_kontak_darurat_no_hp">
<span<?= $Grid->no_hp->viewAttributes() ?>>
<?= $Grid->no_hp->getViewValue() ?></span>
</span>
<?php if ($Grid->isConfirm()) { ?>
<input type="hidden" data-table="kontak_darurat" data-field="x_no_hp" data-hidden="1" name="fkontak_daruratgrid$x<?= $Grid->RowIndex ?>_no_hp" id="fkontak_daruratgrid$x<?= $Grid->RowIndex ?>_no_hp" value="<?= HtmlEncode($Grid->no_hp->FormValue) ?>">
<input type="hidden" data-table="kontak_darurat" data-field="x_no_hp" data-hidden="1" name="fkontak_daruratgrid$o<?= $Grid->RowIndex ?>_no_hp" id="fkontak_daruratgrid$o<?= $Grid->RowIndex ?>_no_hp" value="<?= HtmlEncode($Grid->no_hp->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
    <?php } ?>
<?php
// Render list options (body, right)
$Grid->ListOptions->render("body", "right", $Grid->RowCount);
?>
    </tr>
<?php if ($Grid->RowType == ROWTYPE_ADD || $Grid->RowType == ROWTYPE_EDIT) { ?>
<script>
loadjs.ready(["fkontak_daruratgrid","load"], function () {
    fkontak_daruratgrid.updateLists(<?= $Grid->RowIndex ?>);
});
</script>
<?php } ?>
<?php
    }
    } // End delete row checking
    if (!$Grid->isGridAdd() || $Grid->CurrentMode == "copy")
        if (!$Grid->Recordset->EOF) {
            $Grid->Recordset->moveNext();
        }
}
?>
<?php
    if ($Grid->CurrentMode == "add" || $Grid->CurrentMode == "copy" || $Grid->CurrentMode == "edit") {
        $Grid->RowIndex = '$rowindex$';
        $Grid->loadRowValues();

        // Set row properties
        $Grid->resetAttributes();
        $Grid->RowAttrs->merge(["data-rowindex" => $Grid->RowIndex, "id" => "r0_kontak_darurat", "data-rowtype" => ROWTYPE_ADD]);
        $Grid->RowAttrs->appendClass("ew-template");
        $Grid->RowType = ROWTYPE_ADD;

        // Render row
        $Grid->renderRow();

        // Render list options
        $Grid->renderListOptions();
        $Grid->StartRowCount = 0;
?>
    <tr <?= $Grid->rowAttributes() ?>>
<?php
// Render list options (body, left)
$Grid->ListOptions->render("body", "left", $Grid->RowIndex);
?>
    <?php if ($Grid->id->Visible) { // id ?>
        <td data-name="id">
<?php if (!$Grid->isConfirm()) { ?>
<span id="el$rowindex$_kontak_darurat_id" class="form-group kontak_darurat_id"></span>
<?php } else { ?>
<span id="el$rowindex$_kontak_darurat_id" class="form-group kontak_darurat_id">
<span<?= $Grid->id->viewAttributes() ?>>
<input type="text" readonly class="form-control-plaintext" value="<?= HtmlEncode(RemoveHtml($Grid->id->getDisplayValue($Grid->id->ViewValue))) ?>"></span>
</span>
<input type="hidden" data-table="kontak_darurat" data-field="x_id" data-hidden="1" name="x<?= $Grid->RowIndex ?>_id" id="x<?= $Grid->RowIndex ?>_id" value="<?= HtmlEncode($Grid->id->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="kontak_darurat" data-field="x_id" data-hidden="1" name="o<?= $Grid->RowIndex ?>_id" id="o<?= $Grid->RowIndex ?>_id" value="<?= HtmlEncode($Grid->id->OldValue) ?>">
</td>
    <?php } ?>
    <?php if ($Grid->pasien_id->Visible) { // pasien_id ?>
        <td data-name="pasien_id">
<?php if (!$Grid->isConfirm()) { ?>
<?php if ($Grid->pasien_id->getSessionValue() != "") { ?>
<span id="el$rowindex$_kontak_darurat_pasien_id" class="form-group kontak_darurat_pasien_id">
<span<?= $Grid->pasien_id->viewAttributes() ?>>
<input type="text" readonly class="form-control-plaintext" value="<?= HtmlEncode(RemoveHtml($Grid->pasien_id->getDisplayValue($Grid->pasien_id->ViewValue))) ?>"></span>
</span>
<input type="hidden" id="x<?= $Grid->RowIndex ?>_pasien_id" name="x<?= $Grid->RowIndex ?>_pasien_id" value="<?= HtmlEncode($Grid->pasien_id->CurrentValue) ?>" data-hidden="1">
<?php } else { ?>
<span id="el$rowindex$_kontak_darurat_pasien_id" class="form-group kontak_darurat_pasien_id">
<div class="input-group ew-lookup-list">
    <div class="form-control ew-lookup-text" tabindex="-1" id="lu_x<?= $Grid->RowIndex ?>_pasien_id"><?= EmptyValue(strval($Grid->pasien_id->ViewValue)) ? $Language->phrase("PleaseSelect") : $Grid->pasien_id->ViewValue ?></div>
    <div class="input-group-append">
        <button type="button" title="<?= HtmlEncode(str_replace("%s", RemoveHtml($Grid->pasien_id->caption()), $Language->phrase("LookupLink", true))) ?>" class="ew-lookup-btn btn btn-default"<?= ($Grid->pasien_id->ReadOnly || $Grid->pasien_id->Disabled) ? " disabled" : "" ?> onclick="ew.modalLookupShow({lnk:this,el:'x<?= $Grid->RowIndex ?>_pasien_id',m:0,n:10});"><i class="fas fa-search ew-icon"></i></button>
    </div>
</div>
<div class="invalid-feedback"><?= $Grid->pasien_id->getErrorMessage() ?></div>
<?= $Grid->pasien_id->Lookup->getParamTag($Grid, "p_x" . $Grid->RowIndex . "_pasien_id") ?>
<input type="hidden" is="selection-list" data-table="kontak_darurat" data-field="x_pasien_id" data-type="text" data-multiple="0" data-lookup="1" data-value-separator="<?= $Grid->pasien_id->displayValueSeparatorAttribute() ?>" name="x<?= $Grid->RowIndex ?>_pasien_id" id="x<?= $Grid->RowIndex ?>_pasien_id" value="<?= $Grid->pasien_id->CurrentValue ?>"<?= $Grid->pasien_id->editAttributes() ?>>
</span>
<?php } ?>
<?php } else { ?>
<span id="el$rowindex$_kontak_darurat_pasien_id" class="form-group kontak_darurat_pasien_id">
<span<?= $Grid->pasien_id->viewAttributes() ?>>
<input type="text" readonly class="form-control-plaintext" value="<?= HtmlEncode(RemoveHtml($Grid->pasien_id->getDisplayValue($Grid->pasien_id->ViewValue))) ?>"></span>
</span>
<input type="hidden" data-table="kontak_darurat" data-field="x_pasien_id" data-hidden="1" name="x<?= $Grid->RowIndex ?>_pasien_id" id="x<?= $Grid->RowIndex ?>_pasien_id" value="<?= HtmlEncode($Grid->pasien_id->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="kontak_darurat" data-field="x_pasien_id" data-hidden="1" name="o<?= $Grid->RowIndex ?>_pasien_id" id="o<?= $Grid->RowIndex ?>_pasien_id" value="<?= HtmlEncode($Grid->pasien_id->OldValue) ?>">
</td>
    <?php } ?>
    <?php if ($Grid->nama->Visible) { // nama ?>
        <td data-name="nama">
<?php if (!$Grid->isConfirm()) { ?>
<span id="el$rowindex$_kontak_darurat_nama" class="form-group kontak_darurat_nama">
<input type="<?= $Grid->nama->getInputTextType() ?>" data-table="kontak_darurat" data-field="x_nama" name="x<?= $Grid->RowIndex ?>_nama" id="x<?= $Grid->RowIndex ?>_nama" size="30" maxlength="255" placeholder="<?= HtmlEncode($Grid->nama->getPlaceHolder()) ?>" value="<?= $Grid->nama->EditValue ?>"<?= $Grid->nama->editAttributes() ?>>
<div class="invalid-feedback"><?= $Grid->nama->getErrorMessage() ?></div>
</span>
<?php } else { ?>
<span id="el$rowindex$_kontak_darurat_nama" class="form-group kontak_darurat_nama">
<span<?= $Grid->nama->viewAttributes() ?>>
<input type="text" readonly class="form-control-plaintext" value="<?= HtmlEncode(RemoveHtml($Grid->nama->getDisplayValue($Grid->nama->ViewValue))) ?>"></span>
</span>
<input type="hidden" data-table="kontak_darurat" data-field="x_nama" data-hidden="1" name="x<?= $Grid->RowIndex ?>_nama" id="x<?= $Grid->RowIndex ?>_nama" value="<?= HtmlEncode($Grid->nama->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="kontak_darurat" data-field="x_nama" data-hidden="1" name="o<?= $Grid->RowIndex ?>_nama" id="o<?= $Grid->RowIndex ?>_nama" value="<?= HtmlEncode($Grid->nama->OldValue) ?>">
</td>
    <?php } ?>
    <?php if ($Grid->no_hp->Visible) { // no_hp ?>
        <td data-name="no_hp">
<?php if (!$Grid->isConfirm()) { ?>
<span id="el$rowindex$_kontak_darurat_no_hp" class="form-group kontak_darurat_no_hp">
<input type="<?= $Grid->no_hp->getInputTextType() ?>" data-table="kontak_darurat" data-field="x_no_hp" name="x<?= $Grid->RowIndex ?>_no_hp" id="x<?= $Grid->RowIndex ?>_no_hp" size="30" maxlength="15" placeholder="<?= HtmlEncode($Grid->no_hp->getPlaceHolder()) ?>" value="<?= $Grid->no_hp->EditValue ?>"<?= $Grid->no_hp->editAttributes() ?>>
<div class="invalid-feedback"><?= $Grid->no_hp->getErrorMessage() ?></div>
</span>
<?php } else { ?>
<span id="el$rowindex$_kontak_darurat_no_hp" class="form-group kontak_darurat_no_hp">
<span<?= $Grid->no_hp->viewAttributes() ?>>
<input type="text" readonly class="form-control-plaintext" value="<?= HtmlEncode(RemoveHtml($Grid->no_hp->getDisplayValue($Grid->no_hp->ViewValue))) ?>"></span>
</span>
<input type="hidden" data-table="kontak_darurat" data-field="x_no_hp" data-hidden="1" name="x<?= $Grid->RowIndex ?>_no_hp" id="x<?= $Grid->RowIndex ?>_no_hp" value="<?= HtmlEncode($Grid->no_hp->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="kontak_darurat" data-field="x_no_hp" data-hidden="1" name="o<?= $Grid->RowIndex ?>_no_hp" id="o<?= $Grid->RowIndex ?>_no_hp" value="<?= HtmlEncode($Grid->no_hp->OldValue) ?>">
</td>
    <?php } ?>
<?php
// Render list options (body, right)
$Grid->ListOptions->render("body", "right", $Grid->RowIndex);
?>
<script>
loadjs.ready(["fkontak_daruratgrid","load"], function() {
    fkontak_daruratgrid.updateLists(<?= $Grid->RowIndex ?>);
});
</script>
    </tr>
<?php
    }
?>
</tbody>
</table><!-- /.ew-table -->
</div><!-- /.ew-grid-middle-panel -->
<?php if ($Grid->CurrentMode == "add" || $Grid->CurrentMode == "copy") { ?>
<input type="hidden" name="<?= $Grid->FormKeyCountName ?>" id="<?= $Grid->FormKeyCountName ?>" value="<?= $Grid->KeyCount ?>">
<?= $Grid->MultiSelectKey ?>
<?php } ?>
<?php if ($Grid->CurrentMode == "edit") { ?>
<input type="hidden" name="<?= $Grid->FormKeyCountName ?>" id="<?= $Grid->FormKeyCountName ?>" value="<?= $Grid->KeyCount ?>">
<?= $Grid->MultiSelectKey ?>
<?php } ?>
<?php if ($Grid->CurrentMode == "") { ?>
<input type="hidden" name="action" id="action" value="">
<?php } ?>
<input type="hidden" name="detailpage" value="fkontak_daruratgrid">
</div><!-- /.ew-list-form -->
<?php
// Close recordset
if ($Grid->Recordset) {
    $Grid->Recordset->close();
}
?>
<?php if ($Grid->ShowOtherOptions) { ?>
<div class="card-footer ew-grid-lower-panel">
<?php $Grid->OtherOptions->render("body", "bottom") ?>
</div>
<div class="clearfix"></div>
<?php } ?>
</div><!-- /.ew-grid -->
<?php } ?>
<?php if ($Grid->TotalRecords == 0 && !$Grid->CurrentAction) { // Show other options ?>
<div class="ew-list-other-options">
<?php $Grid->OtherOptions->render("body") ?>
</div>
<div class="clearfix"></div>
<?php } ?>
<?php if (!$Grid->isExport()) { ?>
<script>
// Field event handlers
loadjs.ready("head", function() {
    ew.addEventHandlers("kontak_darurat");
});
</script>
<script>
loadjs.ready("load", function () {
    // Write your table-specific startup script here, no need to add script tags.
});
</script>
<?php } ?>
