<?php

namespace PHPMaker2021\satusehat;

// Page object
$PasienList = &$Page;
?>
<?php if (!$Page->isExport()) { ?>
<script>
var currentForm, currentPageID;
var fpasienlist;
loadjs.ready("head", function () {
    var $ = jQuery;
    // Form object
    currentPageID = ew.PAGE_ID = "list";
    fpasienlist = currentForm = new ew.Form("fpasienlist", "list");
    fpasienlist.formKeyCountName = '<?= $Page->FormKeyCountName ?>';
    loadjs.done("fpasienlist");
});
var fpasienlistsrch, currentSearchForm, currentAdvancedSearchForm;
loadjs.ready("head", function () {
    var $ = jQuery;
    // Form object for search
    fpasienlistsrch = currentSearchForm = new ew.Form("fpasienlistsrch");

    // Add fields
    var currentTable = <?= JsonEncode(GetClientVar("tables", "pasien")) ?>,
        fields = currentTable.fields;
    fpasienlistsrch.addFields([
        ["id", [], fields.id.isInvalid],
        ["nik", [], fields.nik.isInvalid],
        ["nama", [], fields.nama.isInvalid],
        ["jenis_kelamin", [], fields.jenis_kelamin.isInvalid],
        ["tanggal_lahir", [], fields.tanggal_lahir.isInvalid],
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
        fpasienlistsrch.setInvalid();
    });

    // Validate form
    fpasienlistsrch.validate = function () {
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
    fpasienlistsrch.customValidate = function(fobj) { // DO NOT CHANGE THIS LINE!
        // Your custom validation code here, return false if invalid.
        return true;
    }

    // Use JavaScript validation or not
    fpasienlistsrch.validateRequired = <?= Config("CLIENT_VALIDATE") ? "true" : "false" ?>;

    // Dynamic selection lists

    // Filters
    fpasienlistsrch.filterList = <?= $Page->getFilterList() ?>;
    loadjs.done("fpasienlistsrch");
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
<form name="fpasienlistsrch" id="fpasienlistsrch" class="form-inline ew-form ew-ext-search-form" action="<?= CurrentPageUrl(false) ?>">
<div id="fpasienlistsrch-search-panel" class="<?= $Page->SearchPanelClass ?>">
<input type="hidden" name="cmd" value="search">
<input type="hidden" name="t" value="pasien">
    <div class="ew-extended-search">
<?php
// Render search row
$Page->RowType = ROWTYPE_SEARCH;
$Page->resetAttributes();
$Page->renderRow();
?>
<?php if ($Page->nik->Visible) { // nik ?>
    <?php
        $Page->SearchColumnCount++;
        if (($Page->SearchColumnCount - 1) % $Page->SearchFieldsPerRow == 0) {
            $Page->SearchRowCount++;
    ?>
<div id="xsr_<?= $Page->SearchRowCount ?>" class="ew-row d-sm-flex">
    <?php
        }
     ?>
    <div id="xsc_nik" class="ew-cell form-group">
        <label for="x_nik" class="ew-search-caption ew-label"><?= $Page->nik->caption() ?></label>
        <span class="ew-search-operator">
<?= $Language->phrase("LIKE") ?>
<input type="hidden" name="z_nik" id="z_nik" value="LIKE">
</span>
        <span id="el_pasien_nik" class="ew-search-field">
<input type="<?= $Page->nik->getInputTextType() ?>" data-table="pasien" data-field="x_nik" name="x_nik" id="x_nik" size="30" maxlength="16" placeholder="<?= HtmlEncode($Page->nik->getPlaceHolder()) ?>" value="<?= $Page->nik->EditValue ?>"<?= $Page->nik->editAttributes() ?>>
<div class="invalid-feedback"><?= $Page->nik->getErrorMessage(false) ?></div>
</span>
    </div>
    <?php if ($Page->SearchColumnCount % $Page->SearchFieldsPerRow == 0) { ?>
</div>
    <?php } ?>
<?php } ?>
<?php if ($Page->nama->Visible) { // nama ?>
    <?php
        $Page->SearchColumnCount++;
        if (($Page->SearchColumnCount - 1) % $Page->SearchFieldsPerRow == 0) {
            $Page->SearchRowCount++;
    ?>
<div id="xsr_<?= $Page->SearchRowCount ?>" class="ew-row d-sm-flex">
    <?php
        }
     ?>
    <div id="xsc_nama" class="ew-cell form-group">
        <label for="x_nama" class="ew-search-caption ew-label"><?= $Page->nama->caption() ?></label>
        <span class="ew-search-operator">
<?= $Language->phrase("LIKE") ?>
<input type="hidden" name="z_nama" id="z_nama" value="LIKE">
</span>
        <span id="el_pasien_nama" class="ew-search-field">
<input type="<?= $Page->nama->getInputTextType() ?>" data-table="pasien" data-field="x_nama" name="x_nama" id="x_nama" size="30" maxlength="255" placeholder="<?= HtmlEncode($Page->nama->getPlaceHolder()) ?>" value="<?= $Page->nama->EditValue ?>"<?= $Page->nama->editAttributes() ?>>
<div class="invalid-feedback"><?= $Page->nama->getErrorMessage(false) ?></div>
</span>
    </div>
    <?php if ($Page->SearchColumnCount % $Page->SearchFieldsPerRow == 0) { ?>
</div>
    <?php } ?>
<?php } ?>
<?php if ($Page->no_bpjs->Visible) { // no_bpjs ?>
    <?php
        $Page->SearchColumnCount++;
        if (($Page->SearchColumnCount - 1) % $Page->SearchFieldsPerRow == 0) {
            $Page->SearchRowCount++;
    ?>
<div id="xsr_<?= $Page->SearchRowCount ?>" class="ew-row d-sm-flex">
    <?php
        }
     ?>
    <div id="xsc_no_bpjs" class="ew-cell form-group">
        <label for="x_no_bpjs" class="ew-search-caption ew-label"><?= $Page->no_bpjs->caption() ?></label>
        <span class="ew-search-operator">
<?= $Language->phrase("LIKE") ?>
<input type="hidden" name="z_no_bpjs" id="z_no_bpjs" value="LIKE">
</span>
        <span id="el_pasien_no_bpjs" class="ew-search-field">
<input type="<?= $Page->no_bpjs->getInputTextType() ?>" data-table="pasien" data-field="x_no_bpjs" name="x_no_bpjs" id="x_no_bpjs" size="30" maxlength="13" placeholder="<?= HtmlEncode($Page->no_bpjs->getPlaceHolder()) ?>" value="<?= $Page->no_bpjs->EditValue ?>"<?= $Page->no_bpjs->editAttributes() ?>>
<div class="invalid-feedback"><?= $Page->no_bpjs->getErrorMessage(false) ?></div>
</span>
    </div>
    <?php if ($Page->SearchColumnCount % $Page->SearchFieldsPerRow == 0) { ?>
</div>
    <?php } ?>
<?php } ?>
<?php if ($Page->no_hp->Visible) { // no_hp ?>
    <?php
        $Page->SearchColumnCount++;
        if (($Page->SearchColumnCount - 1) % $Page->SearchFieldsPerRow == 0) {
            $Page->SearchRowCount++;
    ?>
<div id="xsr_<?= $Page->SearchRowCount ?>" class="ew-row d-sm-flex">
    <?php
        }
     ?>
    <div id="xsc_no_hp" class="ew-cell form-group">
        <label for="x_no_hp" class="ew-search-caption ew-label"><?= $Page->no_hp->caption() ?></label>
        <span class="ew-search-operator">
<?= $Language->phrase("LIKE") ?>
<input type="hidden" name="z_no_hp" id="z_no_hp" value="LIKE">
</span>
        <span id="el_pasien_no_hp" class="ew-search-field">
<input type="<?= $Page->no_hp->getInputTextType() ?>" data-table="pasien" data-field="x_no_hp" name="x_no_hp" id="x_no_hp" size="30" maxlength="15" placeholder="<?= HtmlEncode($Page->no_hp->getPlaceHolder()) ?>" value="<?= $Page->no_hp->EditValue ?>"<?= $Page->no_hp->editAttributes() ?>>
<div class="invalid-feedback"><?= $Page->no_hp->getErrorMessage(false) ?></div>
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
<div class="card ew-card ew-grid<?php if ($Page->isAddOrEdit()) { ?> ew-grid-add-edit<?php } ?> pasien">
<form name="fpasienlist" id="fpasienlist" class="form-inline ew-form ew-list-form" action="<?= CurrentPageUrl(false) ?>" method="post">
<?php if (Config("CHECK_TOKEN")) { ?>
<input type="hidden" name="<?= $TokenNameKey ?>" value="<?= $TokenName ?>"><!-- CSRF token name -->
<input type="hidden" name="<?= $TokenValueKey ?>" value="<?= $TokenValue ?>"><!-- CSRF token value -->
<?php } ?>
<input type="hidden" name="t" value="pasien">
<div id="gmp_pasien" class="<?= ResponsiveTableClass() ?>card-body ew-grid-middle-panel">
<?php if ($Page->TotalRecords > 0 || $Page->isGridEdit()) { ?>
<table id="tbl_pasienlist" class="table ew-table"><!-- .ew-table -->
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
<?php if ($Page->id->Visible) { // id ?>
        <th data-name="id" class="<?= $Page->id->headerCellClass() ?>"><div id="elh_pasien_id" class="pasien_id"><?= $Page->renderSort($Page->id) ?></div></th>
<?php } ?>
<?php if ($Page->nik->Visible) { // nik ?>
        <th data-name="nik" class="<?= $Page->nik->headerCellClass() ?>"><div id="elh_pasien_nik" class="pasien_nik"><?= $Page->renderSort($Page->nik) ?></div></th>
<?php } ?>
<?php if ($Page->nama->Visible) { // nama ?>
        <th data-name="nama" class="<?= $Page->nama->headerCellClass() ?>"><div id="elh_pasien_nama" class="pasien_nama"><?= $Page->renderSort($Page->nama) ?></div></th>
<?php } ?>
<?php if ($Page->jenis_kelamin->Visible) { // jenis_kelamin ?>
        <th data-name="jenis_kelamin" class="<?= $Page->jenis_kelamin->headerCellClass() ?>"><div id="elh_pasien_jenis_kelamin" class="pasien_jenis_kelamin"><?= $Page->renderSort($Page->jenis_kelamin) ?></div></th>
<?php } ?>
<?php if ($Page->tanggal_lahir->Visible) { // tanggal_lahir ?>
        <th data-name="tanggal_lahir" class="<?= $Page->tanggal_lahir->headerCellClass() ?>"><div id="elh_pasien_tanggal_lahir" class="pasien_tanggal_lahir"><?= $Page->renderSort($Page->tanggal_lahir) ?></div></th>
<?php } ?>
<?php if ($Page->agama->Visible) { // agama ?>
        <th data-name="agama" class="<?= $Page->agama->headerCellClass() ?>"><div id="elh_pasien_agama" class="pasien_agama"><?= $Page->renderSort($Page->agama) ?></div></th>
<?php } ?>
<?php if ($Page->pekerjaan->Visible) { // pekerjaan ?>
        <th data-name="pekerjaan" class="<?= $Page->pekerjaan->headerCellClass() ?>"><div id="elh_pasien_pekerjaan" class="pasien_pekerjaan"><?= $Page->renderSort($Page->pekerjaan) ?></div></th>
<?php } ?>
<?php if ($Page->pendidikan->Visible) { // pendidikan ?>
        <th data-name="pendidikan" class="<?= $Page->pendidikan->headerCellClass() ?>"><div id="elh_pasien_pendidikan" class="pasien_pendidikan"><?= $Page->renderSort($Page->pendidikan) ?></div></th>
<?php } ?>
<?php if ($Page->status_perkawinan->Visible) { // status_perkawinan ?>
        <th data-name="status_perkawinan" class="<?= $Page->status_perkawinan->headerCellClass() ?>"><div id="elh_pasien_status_perkawinan" class="pasien_status_perkawinan"><?= $Page->renderSort($Page->status_perkawinan) ?></div></th>
<?php } ?>
<?php if ($Page->no_bpjs->Visible) { // no_bpjs ?>
        <th data-name="no_bpjs" class="<?= $Page->no_bpjs->headerCellClass() ?>"><div id="elh_pasien_no_bpjs" class="pasien_no_bpjs"><?= $Page->renderSort($Page->no_bpjs) ?></div></th>
<?php } ?>
<?php if ($Page->no_hp->Visible) { // no_hp ?>
        <th data-name="no_hp" class="<?= $Page->no_hp->headerCellClass() ?>"><div id="elh_pasien_no_hp" class="pasien_no_hp"><?= $Page->renderSort($Page->no_hp) ?></div></th>
<?php } ?>
<?php if ($Page->_password->Visible) { // password ?>
        <th data-name="_password" class="<?= $Page->_password->headerCellClass() ?>"><div id="elh_pasien__password" class="pasien__password"><?= $Page->renderSort($Page->_password) ?></div></th>
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
        $Page->RowAttrs->merge(["data-rowindex" => $Page->RowCount, "id" => "r" . $Page->RowCount . "_pasien", "data-rowtype" => $Page->RowType]);

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
    <?php if ($Page->id->Visible) { // id ?>
        <td data-name="id" <?= $Page->id->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_pasien_id">
<span<?= $Page->id->viewAttributes() ?>>
<?= $Page->id->getViewValue() ?></span>
</span>
</td>
    <?php } ?>
    <?php if ($Page->nik->Visible) { // nik ?>
        <td data-name="nik" <?= $Page->nik->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_pasien_nik">
<span<?= $Page->nik->viewAttributes() ?>>
<?= $Page->nik->getViewValue() ?></span>
</span>
</td>
    <?php } ?>
    <?php if ($Page->nama->Visible) { // nama ?>
        <td data-name="nama" <?= $Page->nama->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_pasien_nama">
<span<?= $Page->nama->viewAttributes() ?>>
<?= $Page->nama->getViewValue() ?></span>
</span>
</td>
    <?php } ?>
    <?php if ($Page->jenis_kelamin->Visible) { // jenis_kelamin ?>
        <td data-name="jenis_kelamin" <?= $Page->jenis_kelamin->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_pasien_jenis_kelamin">
<span<?= $Page->jenis_kelamin->viewAttributes() ?>>
<?= $Page->jenis_kelamin->getViewValue() ?></span>
</span>
</td>
    <?php } ?>
    <?php if ($Page->tanggal_lahir->Visible) { // tanggal_lahir ?>
        <td data-name="tanggal_lahir" <?= $Page->tanggal_lahir->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_pasien_tanggal_lahir">
<span<?= $Page->tanggal_lahir->viewAttributes() ?>>
<?= $Page->tanggal_lahir->getViewValue() ?></span>
</span>
</td>
    <?php } ?>
    <?php if ($Page->agama->Visible) { // agama ?>
        <td data-name="agama" <?= $Page->agama->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_pasien_agama">
<span<?= $Page->agama->viewAttributes() ?>>
<?= $Page->agama->getViewValue() ?></span>
</span>
</td>
    <?php } ?>
    <?php if ($Page->pekerjaan->Visible) { // pekerjaan ?>
        <td data-name="pekerjaan" <?= $Page->pekerjaan->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_pasien_pekerjaan">
<span<?= $Page->pekerjaan->viewAttributes() ?>>
<?= $Page->pekerjaan->getViewValue() ?></span>
</span>
</td>
    <?php } ?>
    <?php if ($Page->pendidikan->Visible) { // pendidikan ?>
        <td data-name="pendidikan" <?= $Page->pendidikan->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_pasien_pendidikan">
<span<?= $Page->pendidikan->viewAttributes() ?>>
<?= $Page->pendidikan->getViewValue() ?></span>
</span>
</td>
    <?php } ?>
    <?php if ($Page->status_perkawinan->Visible) { // status_perkawinan ?>
        <td data-name="status_perkawinan" <?= $Page->status_perkawinan->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_pasien_status_perkawinan">
<span<?= $Page->status_perkawinan->viewAttributes() ?>>
<?= $Page->status_perkawinan->getViewValue() ?></span>
</span>
</td>
    <?php } ?>
    <?php if ($Page->no_bpjs->Visible) { // no_bpjs ?>
        <td data-name="no_bpjs" <?= $Page->no_bpjs->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_pasien_no_bpjs">
<span<?= $Page->no_bpjs->viewAttributes() ?>>
<?= $Page->no_bpjs->getViewValue() ?></span>
</span>
</td>
    <?php } ?>
    <?php if ($Page->no_hp->Visible) { // no_hp ?>
        <td data-name="no_hp" <?= $Page->no_hp->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_pasien_no_hp">
<span<?= $Page->no_hp->viewAttributes() ?>>
<?= $Page->no_hp->getViewValue() ?></span>
</span>
</td>
    <?php } ?>
    <?php if ($Page->_password->Visible) { // password ?>
        <td data-name="_password" <?= $Page->_password->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_pasien__password">
<span<?= $Page->_password->viewAttributes() ?>>
<?= $Page->_password->getViewValue() ?></span>
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
    ew.addEventHandlers("pasien");
});
</script>
<script>
loadjs.ready("load", function () {
    // Write your table-specific startup script here, no need to add script tags.
});
</script>
<?php } ?>
