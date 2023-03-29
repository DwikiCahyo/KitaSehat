<?php

namespace PHPMaker2021\satusehat;

// Page object
$AntreanBpjsList = &$Page;
?>
<?php if (!$Page->isExport()) { ?>
<script>
var currentForm, currentPageID;
var fantrean_bpjslist;
loadjs.ready("head", function () {
    var $ = jQuery;
    // Form object
    currentPageID = ew.PAGE_ID = "list";
    fantrean_bpjslist = currentForm = new ew.Form("fantrean_bpjslist", "list");
    fantrean_bpjslist.formKeyCountName = '<?= $Page->FormKeyCountName ?>';
    loadjs.done("fantrean_bpjslist");
});
var fantrean_bpjslistsrch, currentSearchForm, currentAdvancedSearchForm;
loadjs.ready("head", function () {
    var $ = jQuery;
    // Form object for search
    fantrean_bpjslistsrch = currentSearchForm = new ew.Form("fantrean_bpjslistsrch");

    // Add fields
    var currentTable = <?= JsonEncode(GetClientVar("tables", "antrean_bpjs")) ?>,
        fields = currentTable.fields;
    fantrean_bpjslistsrch.addFields([
        ["nomor_antrean", [], fields.nomor_antrean.isInvalid],
        ["waktu", [], fields.waktu.isInvalid],
        ["pasien_id", [], fields.pasien_id.isInvalid],
        ["fasilitas_id", [], fields.fasilitas_id.isInvalid],
        ["rumah_sakit_id", [], fields.rumah_sakit_id.isInvalid],
        ["status", [], fields.status.isInvalid]
    ]);

    // Set invalid fields
    $(function() {
        fantrean_bpjslistsrch.setInvalid();
    });

    // Validate form
    fantrean_bpjslistsrch.validate = function () {
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
    fantrean_bpjslistsrch.customValidate = function(fobj) { // DO NOT CHANGE THIS LINE!
        // Your custom validation code here, return false if invalid.
        return true;
    }

    // Use JavaScript validation or not
    fantrean_bpjslistsrch.validateRequired = <?= Config("CLIENT_VALIDATE") ? "true" : "false" ?>;

    // Dynamic selection lists
    fantrean_bpjslistsrch.lists.pasien_id = <?= $Page->pasien_id->toClientList($Page) ?>;
    fantrean_bpjslistsrch.lists.fasilitas_id = <?= $Page->fasilitas_id->toClientList($Page) ?>;

    // Filters
    fantrean_bpjslistsrch.filterList = <?= $Page->getFilterList() ?>;
    loadjs.done("fantrean_bpjslistsrch");
});
</script>
<style>
.ew-table-preview-row { /* main table preview row color */
    background-color: #FFFFFF; /* preview row color */
}
.ew-table-preview-row .ew-grid {
    display: table;
}
</style>
<div id="ew-preview" class="d-none"><!-- preview -->
    <div class="ew-nav-tabs"><!-- .ew-nav-tabs -->
        <ul class="nav nav-tabs"></ul>
        <div class="tab-content"><!-- .tab-content -->
            <div class="tab-pane fade active show"></div>
        </div><!-- /.tab-content -->
    </div><!-- /.ew-nav-tabs -->
</div><!-- /preview -->
<script>
loadjs.ready("head", function() {
    ew.PREVIEW_PLACEMENT = ew.CSS_FLIP ? "right" : "left";
    ew.PREVIEW_SINGLE_ROW = false;
    ew.PREVIEW_OVERLAY = false;
    loadjs(ew.PATH_BASE + "js/ewpreview.js", "preview");
});
</script>
<script>
loadjs.ready("head", function () {
    // Write your table-specific client script here, no need to add script tags.
});
</script>
<?php } ?>
<?php if (!$Page->isExport()) { ?>
<div class="btn-toolbar ew-toolbar">
<?php if ($Page->TotalRecords > 0 && $Page->ExportOptions->visible()) { ?>
<?php $Page->ExportOptions->render("body") ?>
<?php } ?>
<?php if ($Page->ImportOptions->visible()) { ?>
<?php $Page->ImportOptions->render("body") ?>
<?php } ?>
<?php if ($Page->SearchOptions->visible()) { ?>
<?php $Page->SearchOptions->render("body") ?>
<?php } ?>
<?php if ($Page->FilterOptions->visible()) { ?>
<?php $Page->FilterOptions->render("body") ?>
<?php } ?>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php
$Page->renderOtherOptions();
?>
<?php if ($Security->canSearch()) { ?>
<?php if (!$Page->isExport() && !$Page->CurrentAction) { ?>
<form name="fantrean_bpjslistsrch" id="fantrean_bpjslistsrch" class="form-inline ew-form ew-ext-search-form" action="<?= CurrentPageUrl(false) ?>">
<div id="fantrean_bpjslistsrch-search-panel" class="<?= $Page->SearchPanelClass ?>">
<input type="hidden" name="cmd" value="search">
<input type="hidden" name="t" value="antrean_bpjs">
    <div class="ew-extended-search">
<?php
// Render search row
$Page->RowType = ROWTYPE_SEARCH;
$Page->resetAttributes();
$Page->renderRow();
?>
<?php if ($Page->pasien_id->Visible) { // pasien_id ?>
    <?php
        $Page->SearchColumnCount++;
        if (($Page->SearchColumnCount - 1) % $Page->SearchFieldsPerRow == 0) {
            $Page->SearchRowCount++;
    ?>
<div id="xsr_<?= $Page->SearchRowCount ?>" class="ew-row d-sm-flex">
    <?php
        }
     ?>
    <div id="xsc_pasien_id" class="ew-cell form-group">
        <label for="x_pasien_id" class="ew-search-caption ew-label"><?= $Page->pasien_id->caption() ?></label>
        <span class="ew-search-operator">
<?= $Language->phrase("=") ?>
<input type="hidden" name="z_pasien_id" id="z_pasien_id" value="=">
</span>
        <span id="el_antrean_bpjs_pasien_id" class="ew-search-field">
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
    </div>
    <?php if ($Page->SearchColumnCount % $Page->SearchFieldsPerRow == 0) { ?>
</div>
    <?php } ?>
<?php } ?>
<?php if ($Page->fasilitas_id->Visible) { // fasilitas_id ?>
    <?php
        $Page->SearchColumnCount++;
        if (($Page->SearchColumnCount - 1) % $Page->SearchFieldsPerRow == 0) {
            $Page->SearchRowCount++;
    ?>
<div id="xsr_<?= $Page->SearchRowCount ?>" class="ew-row d-sm-flex">
    <?php
        }
     ?>
    <div id="xsc_fasilitas_id" class="ew-cell form-group">
        <label for="x_fasilitas_id" class="ew-search-caption ew-label"><?= $Page->fasilitas_id->caption() ?></label>
        <span class="ew-search-operator">
<?= $Language->phrase("=") ?>
<input type="hidden" name="z_fasilitas_id" id="z_fasilitas_id" value="=">
</span>
        <span id="el_antrean_bpjs_fasilitas_id" class="ew-search-field">
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
    </div>
    <?php if ($Page->SearchColumnCount % $Page->SearchFieldsPerRow == 0) { ?>
</div>
    <?php } ?>
<?php } ?>
    <?php if ($Page->SearchColumnCount % $Page->SearchFieldsPerRow > 0) { ?>
</div>
    <?php } ?>
<div id="xsr_<?= $Page->SearchRowCount + 1 ?>" class="ew-row d-sm-flex">
    <button class="btn btn-primary" name="btn-submit" id="btn-submit" type="submit"><?= $Language->phrase("SearchBtn") ?></button>
</div>
    </div><!-- /.ew-extended-search -->
</div><!-- /.ew-search-panel -->
</form>
<?php } ?>
<?php } ?>
<?php $Page->showPageHeader(); ?>
<?php
$Page->showMessage();
?>
<?php if ($Page->TotalRecords > 0 || $Page->CurrentAction) { ?>
<div class="card ew-card ew-grid<?php if ($Page->isAddOrEdit()) { ?> ew-grid-add-edit<?php } ?> antrean_bpjs">
<form name="fantrean_bpjslist" id="fantrean_bpjslist" class="form-inline ew-form ew-list-form" action="<?= CurrentPageUrl(false) ?>" method="post">
<?php if (Config("CHECK_TOKEN")) { ?>
<input type="hidden" name="<?= $TokenNameKey ?>" value="<?= $TokenName ?>"><!-- CSRF token name -->
<input type="hidden" name="<?= $TokenValueKey ?>" value="<?= $TokenValue ?>"><!-- CSRF token value -->
<?php } ?>
<input type="hidden" name="t" value="antrean_bpjs">
<div id="gmp_antrean_bpjs" class="<?= ResponsiveTableClass() ?>card-body ew-grid-middle-panel">
<?php if ($Page->TotalRecords > 0 || $Page->isGridEdit()) { ?>
<table id="tbl_antrean_bpjslist" class="table ew-table"><!-- .ew-table -->
<thead>
    <tr class="ew-table-header">
<?php
// Header row
$Page->RowType = ROWTYPE_HEADER;

// Render list options
$Page->renderListOptions();

// Render list options (header, left)
$Page->ListOptions->render("header", "left");
?>
<?php if ($Page->nomor_antrean->Visible) { // nomor_antrean ?>
        <th data-name="nomor_antrean" class="<?= $Page->nomor_antrean->headerCellClass() ?>"><div id="elh_antrean_bpjs_nomor_antrean" class="antrean_bpjs_nomor_antrean"><?= $Page->renderSort($Page->nomor_antrean) ?></div></th>
<?php } ?>
<?php if ($Page->waktu->Visible) { // waktu ?>
        <th data-name="waktu" class="<?= $Page->waktu->headerCellClass() ?>"><div id="elh_antrean_bpjs_waktu" class="antrean_bpjs_waktu"><?= $Page->renderSort($Page->waktu) ?></div></th>
<?php } ?>
<?php if ($Page->pasien_id->Visible) { // pasien_id ?>
        <th data-name="pasien_id" class="<?= $Page->pasien_id->headerCellClass() ?>"><div id="elh_antrean_bpjs_pasien_id" class="antrean_bpjs_pasien_id"><?= $Page->renderSort($Page->pasien_id) ?></div></th>
<?php } ?>
<?php if ($Page->fasilitas_id->Visible) { // fasilitas_id ?>
        <th data-name="fasilitas_id" class="<?= $Page->fasilitas_id->headerCellClass() ?>"><div id="elh_antrean_bpjs_fasilitas_id" class="antrean_bpjs_fasilitas_id"><?= $Page->renderSort($Page->fasilitas_id) ?></div></th>
<?php } ?>
<?php if ($Page->rumah_sakit_id->Visible) { // rumah_sakit_id ?>
        <th data-name="rumah_sakit_id" class="<?= $Page->rumah_sakit_id->headerCellClass() ?>"><div id="elh_antrean_bpjs_rumah_sakit_id" class="antrean_bpjs_rumah_sakit_id"><?= $Page->renderSort($Page->rumah_sakit_id) ?></div></th>
<?php } ?>
<?php if ($Page->status->Visible) { // status ?>
        <th data-name="status" class="<?= $Page->status->headerCellClass() ?>"><div id="elh_antrean_bpjs_status" class="antrean_bpjs_status"><?= $Page->renderSort($Page->status) ?></div></th>
<?php } ?>
<?php
// Render list options (header, right)
$Page->ListOptions->render("header", "right");
?>
    </tr>
</thead>
<tbody>
<?php
if ($Page->ExportAll && $Page->isExport()) {
    $Page->StopRecord = $Page->TotalRecords;
} else {
    // Set the last record to display
    if ($Page->TotalRecords > $Page->StartRecord + $Page->DisplayRecords - 1) {
        $Page->StopRecord = $Page->StartRecord + $Page->DisplayRecords - 1;
    } else {
        $Page->StopRecord = $Page->TotalRecords;
    }
}
$Page->RecordCount = $Page->StartRecord - 1;
if ($Page->Recordset && !$Page->Recordset->EOF) {
    // Nothing to do
} elseif (!$Page->AllowAddDeleteRow && $Page->StopRecord == 0) {
    $Page->StopRecord = $Page->GridAddRowCount;
}

// Initialize aggregate
$Page->RowType = ROWTYPE_AGGREGATEINIT;
$Page->resetAttributes();
$Page->renderRow();
while ($Page->RecordCount < $Page->StopRecord) {
    $Page->RecordCount++;
    if ($Page->RecordCount >= $Page->StartRecord) {
        $Page->RowCount++;

        // Set up key count
        $Page->KeyCount = $Page->RowIndex;

        // Init row class and style
        $Page->resetAttributes();
        $Page->CssClass = "";
        if ($Page->isGridAdd()) {
            $Page->loadRowValues(); // Load default values
            $Page->OldKey = "";
            $Page->setKey($Page->OldKey);
        } else {
            $Page->loadRowValues($Page->Recordset); // Load row values
            if ($Page->isGridEdit()) {
                $Page->OldKey = $Page->getKey(true); // Get from CurrentValue
                $Page->setKey($Page->OldKey);
            }
        }
        $Page->RowType = ROWTYPE_VIEW; // Render view

        // Set up row id / data-rowindex
        $Page->RowAttrs->merge(["data-rowindex" => $Page->RowCount, "id" => "r" . $Page->RowCount . "_antrean_bpjs", "data-rowtype" => $Page->RowType]);

        // Render row
        $Page->renderRow();

        // Render list options
        $Page->renderListOptions();
?>
    <tr <?= $Page->rowAttributes() ?>>
<?php
// Render list options (body, left)
$Page->ListOptions->render("body", "left", $Page->RowCount);
?>
    <?php if ($Page->nomor_antrean->Visible) { // nomor_antrean ?>
        <td data-name="nomor_antrean" <?= $Page->nomor_antrean->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_antrean_bpjs_nomor_antrean">
<span<?= $Page->nomor_antrean->viewAttributes() ?>>
<?= $Page->nomor_antrean->getViewValue() ?></span>
</span>
</td>
    <?php } ?>
    <?php if ($Page->waktu->Visible) { // waktu ?>
        <td data-name="waktu" <?= $Page->waktu->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_antrean_bpjs_waktu">
<span<?= $Page->waktu->viewAttributes() ?>>
<?= $Page->waktu->getViewValue() ?></span>
</span>
</td>
    <?php } ?>
    <?php if ($Page->pasien_id->Visible) { // pasien_id ?>
        <td data-name="pasien_id" <?= $Page->pasien_id->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_antrean_bpjs_pasien_id">
<span<?= $Page->pasien_id->viewAttributes() ?>>
<?= $Page->pasien_id->getViewValue() ?></span>
</span>
</td>
    <?php } ?>
    <?php if ($Page->fasilitas_id->Visible) { // fasilitas_id ?>
        <td data-name="fasilitas_id" <?= $Page->fasilitas_id->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_antrean_bpjs_fasilitas_id">
<span<?= $Page->fasilitas_id->viewAttributes() ?>>
<?= $Page->fasilitas_id->getViewValue() ?></span>
</span>
</td>
    <?php } ?>
    <?php if ($Page->rumah_sakit_id->Visible) { // rumah_sakit_id ?>
        <td data-name="rumah_sakit_id" <?= $Page->rumah_sakit_id->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_antrean_bpjs_rumah_sakit_id">
<span<?= $Page->rumah_sakit_id->viewAttributes() ?>>
<?= $Page->rumah_sakit_id->getViewValue() ?></span>
</span>
</td>
    <?php } ?>
    <?php if ($Page->status->Visible) { // status ?>
        <td data-name="status" <?= $Page->status->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_antrean_bpjs_status">
<span<?= $Page->status->viewAttributes() ?>>
<?= $Page->status->getViewValue() ?></span>
</span>
</td>
    <?php } ?>
<?php
// Render list options (body, right)
$Page->ListOptions->render("body", "right", $Page->RowCount);
?>
    </tr>
<?php
    }
    if (!$Page->isGridAdd()) {
        $Page->Recordset->moveNext();
    }
}
?>
</tbody>
</table><!-- /.ew-table -->
<?php } ?>
</div><!-- /.ew-grid-middle-panel -->
<?php if (!$Page->CurrentAction) { ?>
<input type="hidden" name="action" id="action" value="">
<?php } ?>
</form><!-- /.ew-list-form -->
<?php
// Close recordset
if ($Page->Recordset) {
    $Page->Recordset->close();
}
?>
<?php if (!$Page->isExport()) { ?>
<div class="card-footer ew-grid-lower-panel">
<?php if (!$Page->isGridAdd()) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?= CurrentPageUrl(false) ?>">
<?= $Page->Pager->render() ?>
</form>
<?php } ?>
<div class="ew-list-other-options">
<?php $Page->OtherOptions->render("body", "bottom") ?>
</div>
<div class="clearfix"></div>
</div>
<?php } ?>
</div><!-- /.ew-grid -->
<?php } ?>
<?php if ($Page->TotalRecords == 0 && !$Page->CurrentAction) { // Show other options ?>
<div class="ew-list-other-options">
<?php $Page->OtherOptions->render("body") ?>
</div>
<div class="clearfix"></div>
<?php } ?>
<?php
$Page->showPageFooter();
echo GetDebugMessage();
?>
<?php if (!$Page->isExport()) { ?>
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
<?php } ?>
