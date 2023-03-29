<?php

namespace PHPMaker2021\satusehat;

// Table
$rumah_sakit = Container("rumah_sakit");
?>
<?php if ($rumah_sakit->Visible) { ?>
<div class="ew-master-div">
<table id="tbl_rumah_sakitmaster" class="table ew-view-table ew-master-table ew-vertical">
    <tbody>
<?php if ($rumah_sakit->id->Visible) { // id ?>
        <tr id="r_id">
            <td class="<?= $rumah_sakit->TableLeftColumnClass ?>"><?= $rumah_sakit->id->caption() ?></td>
            <td <?= $rumah_sakit->id->cellAttributes() ?>>
<span id="el_rumah_sakit_id">
<span<?= $rumah_sakit->id->viewAttributes() ?>>
<?= $rumah_sakit->id->getViewValue() ?></span>
</span>
</td>
        </tr>
<?php } ?>
<?php if ($rumah_sakit->nama->Visible) { // nama ?>
        <tr id="r_nama">
            <td class="<?= $rumah_sakit->TableLeftColumnClass ?>"><?= $rumah_sakit->nama->caption() ?></td>
            <td <?= $rumah_sakit->nama->cellAttributes() ?>>
<span id="el_rumah_sakit_nama">
<span<?= $rumah_sakit->nama->viewAttributes() ?>>
<?= $rumah_sakit->nama->getViewValue() ?></span>
</span>
</td>
        </tr>
<?php } ?>
<?php if ($rumah_sakit->alamat->Visible) { // alamat ?>
        <tr id="r_alamat">
            <td class="<?= $rumah_sakit->TableLeftColumnClass ?>"><?= $rumah_sakit->alamat->caption() ?></td>
            <td <?= $rumah_sakit->alamat->cellAttributes() ?>>
<span id="el_rumah_sakit_alamat">
<span<?= $rumah_sakit->alamat->viewAttributes() ?>>
<?= $rumah_sakit->alamat->getViewValue() ?></span>
</span>
</td>
        </tr>
<?php } ?>
<?php if ($rumah_sakit->daerah_id->Visible) { // daerah_id ?>
        <tr id="r_daerah_id">
            <td class="<?= $rumah_sakit->TableLeftColumnClass ?>"><?= $rumah_sakit->daerah_id->caption() ?></td>
            <td <?= $rumah_sakit->daerah_id->cellAttributes() ?>>
<span id="el_rumah_sakit_daerah_id">
<span<?= $rumah_sakit->daerah_id->viewAttributes() ?>>
<?= $rumah_sakit->daerah_id->getViewValue() ?></span>
</span>
</td>
        </tr>
<?php } ?>
    </tbody>
</table>
</div>
<?php } ?>
