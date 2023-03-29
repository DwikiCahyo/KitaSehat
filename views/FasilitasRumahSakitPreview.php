<?php

namespace PHPMaker2021\satusehat;

// Page object
$FasilitasRumahSakitPreview = &$Page;
?>
<script>
if (!ew.vars.tables.fasilitas_rumah_sakit) ew.vars.tables.fasilitas_rumah_sakit = <?= JsonEncode(GetClientVar("tables", "fasilitas_rumah_sakit")) ?>;
</script>
<?php $Page->showPageHeader(); ?>
<?php if ($Page->TotalRecords > 0) { ?>
<div class="card ew-grid fasilitas_rumah_sakit"><!-- .card -->
<div class="<?= ResponsiveTableClass() ?>card-body ew-grid-middle-panel ew-preview-middle-panel"><!-- .table-responsive -->
<table class="table ew-table ew-preview-table"><!-- .table -->
    <thead><!-- Table header -->
        <tr class="ew-table-header">
<?php
// Render list options
$Page->renderListOptions();

// Render list options (header, left)
$Page->ListOptions->render("header", "left");
?>
<?php if ($Page->fasilitas_id->Visible) { // fasilitas_id ?>
    <?php if ($Page->SortUrl($Page->fasilitas_id) == "") { ?>
        <th class="<?= $Page->fasilitas_id->headerCellClass() ?>"><?= $Page->fasilitas_id->caption() ?></th>
    <?php } else { ?>
        <th class="<?= $Page->fasilitas_id->headerCellClass() ?>"><div class="ew-pointer" data-sort="<?= HtmlEncode($Page->fasilitas_id->Name) ?>" data-sort-type="1" data-sort-order="<?= $Page->fasilitas_id->getNextSort() ?>">
            <div class="ew-table-header-btn"><span class="ew-table-header-caption"><?= $Page->fasilitas_id->caption() ?></span><span class="ew-table-header-sort"><?php if ($Page->fasilitas_id->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($Page->fasilitas_id->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span>
        </div></div></th>
    <?php } ?>
<?php } ?>
<?php
// Render list options (header, right)
$Page->ListOptions->render("header", "right");
?>
        </tr>
    </thead>
    <tbody><!-- Table body -->
<?php
$Page->RecCount = 0;
$Page->RowCount = 0;
while ($Page->Recordset && !$Page->Recordset->EOF) {
    // Init row class and style
    $Page->RecCount++;
    $Page->RowCount++;
    $Page->CssStyle = "";
    $Page->loadListRowValues($Page->Recordset);

    // Render row
    $Page->RowType = ROWTYPE_PREVIEW; // Preview record
    $Page->resetAttributes();
    $Page->renderListRow();

    // Render list options
    $Page->renderListOptions();
?>
    <tr <?= $Page->rowAttributes() ?>>
<?php
// Render list options (body, left)
$Page->ListOptions->render("body", "left", $Page->RowCount);
?>
<?php if ($Page->fasilitas_id->Visible) { // fasilitas_id ?>
        <!-- fasilitas_id -->
        <td<?= $Page->fasilitas_id->cellAttributes() ?>>
<span<?= $Page->fasilitas_id->viewAttributes() ?>>
<?= $Page->fasilitas_id->getViewValue() ?></span>
</td>
<?php } ?>
<?php
// Render list options (body, right)
$Page->ListOptions->render("body", "right", $Page->RowCount);
?>
    </tr>
<?php
    $Page->Recordset->moveNext();
} // while
?>
    </tbody>
</table><!-- /.table -->
</div><!-- /.table-responsive -->
<div class="card-footer ew-grid-lower-panel ew-preview-lower-panel"><!-- .card-footer -->
<?= $Page->Pager->render() ?>
<?php } else { // No record ?>
<div class="card no-border">
<div class="ew-detail-count"><?= $Language->phrase("NoRecord") ?></div>
<?php } ?>
<div class="ew-preview-other-options">
<?php
    foreach ($Page->OtherOptions as $option)
        $option->render("body");
?>
</div>
<?php if ($Page->TotalRecords > 0) { ?>
<div class="clearfix"></div>
</div><!-- /.card-footer -->
<?php } ?>
</div><!-- /.card -->
<?php
$Page->showPageFooter();
echo GetDebugMessage();
?>
<?php
if ($Page->Recordset) {
    $Page->Recordset->close();
}
?>
