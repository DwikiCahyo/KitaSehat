<?php

namespace PHPMaker2021\satusehat;

use Doctrine\DBAL\ParameterType;

/**
 * Table class for antrean_umum
 */
class AntreanUmum extends DbTable
{
    protected $SqlFrom = "";
    protected $SqlSelect = null;
    protected $SqlSelectList = null;
    protected $SqlWhere = "";
    protected $SqlGroupBy = "";
    protected $SqlHaving = "";
    protected $SqlOrderBy = "";
    public $UseSessionForListSql = true;

    // Column CSS classes
    public $LeftColumnClass = "col-sm-2 col-form-label ew-label";
    public $RightColumnClass = "col-sm-10";
    public $OffsetColumnClass = "col-sm-10 offset-sm-2";
    public $TableLeftColumnClass = "w-col-2";

    // Export
    public $ExportDoc;

    // Fields
    public $id;
    public $nomor_antrean;
    public $waktu;
    public $pasien_id;
    public $fasilitas_id;
    public $rumah_sakit_id;
    public $status;

    // Page ID
    public $PageID = ""; // To be overridden by subclass

    // Constructor
    public function __construct()
    {
        global $Language, $CurrentLanguage;
        parent::__construct();

        // Language object
        $Language = Container("language");
        $this->TableVar = 'antrean_umum';
        $this->TableName = 'antrean_umum';
        $this->TableType = 'TABLE';

        // Update Table
        $this->UpdateTable = "`antrean_umum`";
        $this->Dbid = 'DB';
        $this->ExportAll = true;
        $this->ExportPageBreakCount = 0; // Page break per every n record (PDF only)
        $this->ExportPageOrientation = "portrait"; // Page orientation (PDF only)
        $this->ExportPageSize = "a4"; // Page size (PDF only)
        $this->ExportExcelPageOrientation = ""; // Page orientation (PhpSpreadsheet only)
        $this->ExportExcelPageSize = ""; // Page size (PhpSpreadsheet only)
        $this->ExportWordPageOrientation = "portrait"; // Page orientation (PHPWord only)
        $this->ExportWordColumnWidth = null; // Cell width (PHPWord only)
        $this->DetailAdd = false; // Allow detail add
        $this->DetailEdit = false; // Allow detail edit
        $this->DetailView = false; // Allow detail view
        $this->ShowMultipleDetails = false; // Show multiple details
        $this->GridAddRowCount = 5;
        $this->AllowAddDeleteRow = true; // Allow add/delete row
        $this->UserIDAllowSecurity = Config("DEFAULT_USER_ID_ALLOW_SECURITY"); // Default User ID allowed permissions
        $this->BasicSearch = new BasicSearch($this->TableVar);
        $this->BasicSearch->TypeDefault = "OR";

        // id
        $this->id = new DbField('antrean_umum', 'antrean_umum', 'x_id', 'id', '`id`', '`id`', 20, 20, -1, false, '`id`', false, false, false, 'FORMATTED TEXT', 'NO');
        $this->id->IsAutoIncrement = true; // Autoincrement field
        $this->id->IsPrimaryKey = true; // Primary key field
        $this->id->Sortable = true; // Allow sort
        $this->id->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
        $this->id->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->id->Param, "CustomMsg");
        $this->Fields['id'] = &$this->id;

        // nomor_antrean
        $this->nomor_antrean = new DbField('antrean_umum', 'antrean_umum', 'x_nomor_antrean', 'nomor_antrean', '`nomor_antrean`', '`nomor_antrean`', 3, 11, -1, false, '`nomor_antrean`', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->nomor_antrean->Sortable = true; // Allow sort
        $this->nomor_antrean->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
        $this->nomor_antrean->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->nomor_antrean->Param, "CustomMsg");
        $this->Fields['nomor_antrean'] = &$this->nomor_antrean;

        // waktu
        $this->waktu = new DbField('antrean_umum', 'antrean_umum', 'x_waktu', 'waktu', '`waktu`', CastDateFieldForLike("`waktu`", 0, "DB"), 135, 19, 0, false, '`waktu`', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->waktu->Sortable = true; // Allow sort
        $this->waktu->DefaultErrorMessage = str_replace("%s", $GLOBALS["DATE_FORMAT"], $Language->phrase("IncorrectDate"));
        $this->waktu->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->waktu->Param, "CustomMsg");
        $this->Fields['waktu'] = &$this->waktu;

        // pasien_id
        $this->pasien_id = new DbField('antrean_umum', 'antrean_umum', 'x_pasien_id', 'pasien_id', '`pasien_id`', '`pasien_id`', 20, 20, -1, false, '`pasien_id`', false, false, false, 'FORMATTED TEXT', 'SELECT');
        $this->pasien_id->Nullable = false; // NOT NULL field
        $this->pasien_id->Required = true; // Required field
        $this->pasien_id->Sortable = true; // Allow sort
        $this->pasien_id->UsePleaseSelect = true; // Use PleaseSelect by default
        $this->pasien_id->PleaseSelectText = $Language->phrase("PleaseSelect"); // "PleaseSelect" text
        $this->pasien_id->Lookup = new Lookup('pasien_id', 'pasien', false, 'id', ["nama","jenis_kelamin","tanggal_lahir",""], [], [], [], [], [], [], '', '');
        $this->pasien_id->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
        $this->pasien_id->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->pasien_id->Param, "CustomMsg");
        $this->Fields['pasien_id'] = &$this->pasien_id;

        // fasilitas_id
        $this->fasilitas_id = new DbField('antrean_umum', 'antrean_umum', 'x_fasilitas_id', 'fasilitas_id', '`fasilitas_id`', '`fasilitas_id`', 3, 11, -1, false, '`fasilitas_id`', false, false, false, 'FORMATTED TEXT', 'SELECT');
        $this->fasilitas_id->Nullable = false; // NOT NULL field
        $this->fasilitas_id->Required = true; // Required field
        $this->fasilitas_id->Sortable = true; // Allow sort
        $this->fasilitas_id->UsePleaseSelect = true; // Use PleaseSelect by default
        $this->fasilitas_id->PleaseSelectText = $Language->phrase("PleaseSelect"); // "PleaseSelect" text
        $this->fasilitas_id->Lookup = new Lookup('fasilitas_id', 'fasilitas', false, 'id', ["nama_layanan","","",""], [], [], [], [], [], [], '', '');
        $this->fasilitas_id->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
        $this->fasilitas_id->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->fasilitas_id->Param, "CustomMsg");
        $this->Fields['fasilitas_id'] = &$this->fasilitas_id;

        // rumah_sakit_id
        $this->rumah_sakit_id = new DbField('antrean_umum', 'antrean_umum', 'x_rumah_sakit_id', 'rumah_sakit_id', '`rumah_sakit_id`', '`rumah_sakit_id`', 20, 20, -1, false, '`rumah_sakit_id`', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->rumah_sakit_id->Nullable = false; // NOT NULL field
        $this->rumah_sakit_id->Required = true; // Required field
        $this->rumah_sakit_id->Sortable = true; // Allow sort
        $this->rumah_sakit_id->Lookup = new Lookup('rumah_sakit_id', 'rumah_sakit', false, 'id', ["nama","","",""], [], [], [], [], [], [], '', '');
        $this->rumah_sakit_id->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
        $this->rumah_sakit_id->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->rumah_sakit_id->Param, "CustomMsg");
        $this->Fields['rumah_sakit_id'] = &$this->rumah_sakit_id;

        // status
        $this->status = new DbField('antrean_umum', 'antrean_umum', 'x_status', 'status', '`status`', '`status`', 202, 13, -1, false, '`status`', false, false, false, 'FORMATTED TEXT', 'RADIO');
        $this->status->Nullable = false; // NOT NULL field
        $this->status->Required = true; // Required field
        $this->status->Sortable = true; // Allow sort
        $this->status->Lookup = new Lookup('status', 'antrean_umum', false, '', ["","","",""], [], [], [], [], [], [], '', '');
        $this->status->OptionCount = 4;
        $this->status->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->status->Param, "CustomMsg");
        $this->Fields['status'] = &$this->status;
    }

    // Field Visibility
    public function getFieldVisibility($fldParm)
    {
        global $Security;
        return $this->$fldParm->Visible; // Returns original value
    }

    // Set left column class (must be predefined col-*-* classes of Bootstrap grid system)
    public function setLeftColumnClass($class)
    {
        if (preg_match('/^col\-(\w+)\-(\d+)$/', $class, $match)) {
            $this->LeftColumnClass = $class . " col-form-label ew-label";
            $this->RightColumnClass = "col-" . $match[1] . "-" . strval(12 - (int)$match[2]);
            $this->OffsetColumnClass = $this->RightColumnClass . " " . str_replace("col-", "offset-", $class);
            $this->TableLeftColumnClass = preg_replace('/^col-\w+-(\d+)$/', "w-col-$1", $class); // Change to w-col-*
        }
    }

    // Single column sort
    public function updateSort(&$fld)
    {
        if ($this->CurrentOrder == $fld->Name) {
            $sortField = $fld->Expression;
            $lastSort = $fld->getSort();
            if (in_array($this->CurrentOrderType, ["ASC", "DESC", "NO"])) {
                $curSort = $this->CurrentOrderType;
            } else {
                $curSort = $lastSort;
            }
            $fld->setSort($curSort);
            $orderBy = in_array($curSort, ["ASC", "DESC"]) ? $sortField . " " . $curSort : "";
            $this->setSessionOrderBy($orderBy); // Save to Session
        } else {
            $fld->setSort("");
        }
    }

    // Table level SQL
    public function getSqlFrom() // From
    {
        return ($this->SqlFrom != "") ? $this->SqlFrom : "`antrean_umum`";
    }

    public function sqlFrom() // For backward compatibility
    {
        return $this->getSqlFrom();
    }

    public function setSqlFrom($v)
    {
        $this->SqlFrom = $v;
    }

    public function getSqlSelect() // Select
    {
        return $this->SqlSelect ?? $this->getQueryBuilder()->select("*");
    }

    public function sqlSelect() // For backward compatibility
    {
        return $this->getSqlSelect();
    }

    public function setSqlSelect($v)
    {
        $this->SqlSelect = $v;
    }

    public function getSqlWhere() // Where
    {
        $where = ($this->SqlWhere != "") ? $this->SqlWhere : "";
        $this->DefaultFilter = (CurrentUserLevel() != -1) ? "`rumah_sakit_id` = '".CurrentUserInfo("rumah_sakit_id")."'" : "";
        AddFilter($where, $this->DefaultFilter);
        return $where;
    }

    public function sqlWhere() // For backward compatibility
    {
        return $this->getSqlWhere();
    }

    public function setSqlWhere($v)
    {
        $this->SqlWhere = $v;
    }

    public function getSqlGroupBy() // Group By
    {
        return ($this->SqlGroupBy != "") ? $this->SqlGroupBy : "";
    }

    public function sqlGroupBy() // For backward compatibility
    {
        return $this->getSqlGroupBy();
    }

    public function setSqlGroupBy($v)
    {
        $this->SqlGroupBy = $v;
    }

    public function getSqlHaving() // Having
    {
        return ($this->SqlHaving != "") ? $this->SqlHaving : "";
    }

    public function sqlHaving() // For backward compatibility
    {
        return $this->getSqlHaving();
    }

    public function setSqlHaving($v)
    {
        $this->SqlHaving = $v;
    }

    public function getSqlOrderBy() // Order By
    {
        return ($this->SqlOrderBy != "") ? $this->SqlOrderBy : $this->DefaultSort;
    }

    public function sqlOrderBy() // For backward compatibility
    {
        return $this->getSqlOrderBy();
    }

    public function setSqlOrderBy($v)
    {
        $this->SqlOrderBy = $v;
    }

    // Apply User ID filters
    public function applyUserIDFilters($filter)
    {
        return $filter;
    }

    // Check if User ID security allows view all
    public function userIDAllow($id = "")
    {
        $allow = $this->UserIDAllowSecurity;
        switch ($id) {
            case "add":
            case "copy":
            case "gridadd":
            case "register":
            case "addopt":
                return (($allow & 1) == 1);
            case "edit":
            case "gridedit":
            case "update":
            case "changepassword":
            case "resetpassword":
                return (($allow & 4) == 4);
            case "delete":
                return (($allow & 2) == 2);
            case "view":
                return (($allow & 32) == 32);
            case "search":
                return (($allow & 64) == 64);
            default:
                return (($allow & 8) == 8);
        }
    }

    /**
     * Get record count
     *
     * @param string|QueryBuilder $sql SQL or QueryBuilder
     * @param mixed $c Connection
     * @return int
     */
    public function getRecordCount($sql, $c = null)
    {
        $cnt = -1;
        $rs = null;
        if ($sql instanceof \Doctrine\DBAL\Query\QueryBuilder) { // Query builder
            $sqlwrk = clone $sql;
            $sqlwrk = $sqlwrk->resetQueryPart("orderBy")->getSQL();
        } else {
            $sqlwrk = $sql;
        }
        $pattern = '/^SELECT\s([\s\S]+)\sFROM\s/i';
        // Skip Custom View / SubQuery / SELECT DISTINCT / ORDER BY
        if (
            ($this->TableType == 'TABLE' || $this->TableType == 'VIEW' || $this->TableType == 'LINKTABLE') &&
            preg_match($pattern, $sqlwrk) && !preg_match('/\(\s*(SELECT[^)]+)\)/i', $sqlwrk) &&
            !preg_match('/^\s*select\s+distinct\s+/i', $sqlwrk) && !preg_match('/\s+order\s+by\s+/i', $sqlwrk)
        ) {
            $sqlwrk = "SELECT COUNT(*) FROM " . preg_replace($pattern, "", $sqlwrk);
        } else {
            $sqlwrk = "SELECT COUNT(*) FROM (" . $sqlwrk . ") COUNT_TABLE";
        }
        $conn = $c ?? $this->getConnection();
        $rs = $conn->executeQuery($sqlwrk);
        $cnt = $rs->fetchColumn();
        if ($cnt !== false) {
            return (int)$cnt;
        }

        // Unable to get count by SELECT COUNT(*), execute the SQL to get record count directly
        return ExecuteRecordCount($sql, $conn);
    }

    // Get SQL
    public function getSql($where, $orderBy = "")
    {
        return $this->buildSelectSql(
            $this->getSqlSelect(),
            $this->getSqlFrom(),
            $this->getSqlWhere(),
            $this->getSqlGroupBy(),
            $this->getSqlHaving(),
            $this->getSqlOrderBy(),
            $where,
            $orderBy
        )->getSQL();
    }

    // Table SQL
    public function getCurrentSql()
    {
        $filter = $this->CurrentFilter;
        $filter = $this->applyUserIDFilters($filter);
        $sort = $this->getSessionOrderBy();
        return $this->getSql($filter, $sort);
    }

    /**
     * Table SQL with List page filter
     *
     * @return QueryBuilder
     */
    public function getListSql()
    {
        $filter = $this->UseSessionForListSql ? $this->getSessionWhere() : "";
        AddFilter($filter, $this->CurrentFilter);
        $filter = $this->applyUserIDFilters($filter);
        $this->recordsetSelecting($filter);
        $select = $this->getSqlSelect();
        $from = $this->getSqlFrom();
        $sort = $this->UseSessionForListSql ? $this->getSessionOrderBy() : "";
        $this->Sort = $sort;
        return $this->buildSelectSql(
            $select,
            $from,
            $this->getSqlWhere(),
            $this->getSqlGroupBy(),
            $this->getSqlHaving(),
            $this->getSqlOrderBy(),
            $filter,
            $sort
        );
    }

    // Get ORDER BY clause
    public function getOrderBy()
    {
        $orderBy = $this->getSqlOrderBy();
        $sort = $this->getSessionOrderBy();
        if ($orderBy != "" && $sort != "") {
            $orderBy .= ", " . $sort;
        } elseif ($sort != "") {
            $orderBy = $sort;
        }
        return $orderBy;
    }

    // Get record count based on filter (for detail record count in master table pages)
    public function loadRecordCount($filter)
    {
        $origFilter = $this->CurrentFilter;
        $this->CurrentFilter = $filter;
        $this->recordsetSelecting($this->CurrentFilter);
        $select = $this->TableType == 'CUSTOMVIEW' ? $this->getSqlSelect() : $this->getQueryBuilder()->select("*");
        $groupBy = $this->TableType == 'CUSTOMVIEW' ? $this->getSqlGroupBy() : "";
        $having = $this->TableType == 'CUSTOMVIEW' ? $this->getSqlHaving() : "";
        $sql = $this->buildSelectSql($select, $this->getSqlFrom(), $this->getSqlWhere(), $groupBy, $having, "", $this->CurrentFilter, "");
        $cnt = $this->getRecordCount($sql);
        $this->CurrentFilter = $origFilter;
        return $cnt;
    }

    // Get record count (for current List page)
    public function listRecordCount()
    {
        $filter = $this->getSessionWhere();
        AddFilter($filter, $this->CurrentFilter);
        $filter = $this->applyUserIDFilters($filter);
        $this->recordsetSelecting($filter);
        $select = $this->TableType == 'CUSTOMVIEW' ? $this->getSqlSelect() : $this->getQueryBuilder()->select("*");
        $groupBy = $this->TableType == 'CUSTOMVIEW' ? $this->getSqlGroupBy() : "";
        $having = $this->TableType == 'CUSTOMVIEW' ? $this->getSqlHaving() : "";
        $sql = $this->buildSelectSql($select, $this->getSqlFrom(), $this->getSqlWhere(), $groupBy, $having, "", $filter, "");
        $cnt = $this->getRecordCount($sql);
        return $cnt;
    }

    /**
     * INSERT statement
     *
     * @param mixed $rs
     * @return QueryBuilder
     */
    protected function insertSql(&$rs)
    {
        $queryBuilder = $this->getQueryBuilder();
        $queryBuilder->insert($this->UpdateTable);
        foreach ($rs as $name => $value) {
            if (!isset($this->Fields[$name]) || $this->Fields[$name]->IsCustom) {
                continue;
            }
            $type = GetParameterType($this->Fields[$name], $value, $this->Dbid);
            $queryBuilder->setValue($this->Fields[$name]->Expression, $queryBuilder->createPositionalParameter($value, $type));
        }
        return $queryBuilder;
    }

    // Insert
    public function insert(&$rs)
    {
        $conn = $this->getConnection();
        $success = $this->insertSql($rs)->execute();
        if ($success) {
            // Get insert id if necessary
            $this->id->setDbValue($conn->lastInsertId());
            $rs['id'] = $this->id->DbValue;
        }
        return $success;
    }

    /**
     * UPDATE statement
     *
     * @param array $rs Data to be updated
     * @param string|array $where WHERE clause
     * @param string $curfilter Filter
     * @return QueryBuilder
     */
    protected function updateSql(&$rs, $where = "", $curfilter = true)
    {
        $queryBuilder = $this->getQueryBuilder();
        $queryBuilder->update($this->UpdateTable);
        foreach ($rs as $name => $value) {
            if (!isset($this->Fields[$name]) || $this->Fields[$name]->IsCustom || $this->Fields[$name]->IsAutoIncrement) {
                continue;
            }
            $type = GetParameterType($this->Fields[$name], $value, $this->Dbid);
            $queryBuilder->set($this->Fields[$name]->Expression, $queryBuilder->createPositionalParameter($value, $type));
        }
        $filter = ($curfilter) ? $this->CurrentFilter : "";
        if (is_array($where)) {
            $where = $this->arrayToFilter($where);
        }
        AddFilter($filter, $where);
        if ($filter != "") {
            $queryBuilder->where($filter);
        }
        return $queryBuilder;
    }

    // Update
    public function update(&$rs, $where = "", $rsold = null, $curfilter = true)
    {
        // If no field is updated, execute may return 0. Treat as success
        $success = $this->updateSql($rs, $where, $curfilter)->execute();
        $success = ($success > 0) ? $success : true;
        return $success;
    }

    /**
     * DELETE statement
     *
     * @param array $rs Key values
     * @param string|array $where WHERE clause
     * @param string $curfilter Filter
     * @return QueryBuilder
     */
    protected function deleteSql(&$rs, $where = "", $curfilter = true)
    {
        $queryBuilder = $this->getQueryBuilder();
        $queryBuilder->delete($this->UpdateTable);
        if (is_array($where)) {
            $where = $this->arrayToFilter($where);
        }
        if ($rs) {
            if (array_key_exists('id', $rs)) {
                AddFilter($where, QuotedName('id', $this->Dbid) . '=' . QuotedValue($rs['id'], $this->id->DataType, $this->Dbid));
            }
        }
        $filter = ($curfilter) ? $this->CurrentFilter : "";
        AddFilter($filter, $where);
        return $queryBuilder->where($filter != "" ? $filter : "0=1");
    }

    // Delete
    public function delete(&$rs, $where = "", $curfilter = false)
    {
        $success = true;
        if ($success) {
            $success = $this->deleteSql($rs, $where, $curfilter)->execute();
        }
        return $success;
    }

    // Load DbValue from recordset or array
    protected function loadDbValues($row)
    {
        if (!is_array($row)) {
            return;
        }
        $this->id->DbValue = $row['id'];
        $this->nomor_antrean->DbValue = $row['nomor_antrean'];
        $this->waktu->DbValue = $row['waktu'];
        $this->pasien_id->DbValue = $row['pasien_id'];
        $this->fasilitas_id->DbValue = $row['fasilitas_id'];
        $this->rumah_sakit_id->DbValue = $row['rumah_sakit_id'];
        $this->status->DbValue = $row['status'];
    }

    // Delete uploaded files
    public function deleteUploadedFiles($row)
    {
        $this->loadDbValues($row);
    }

    // Record filter WHERE clause
    protected function sqlKeyFilter()
    {
        return "`id` = @id@";
    }

    // Get Key
    public function getKey($current = false)
    {
        $keys = [];
        $val = $current ? $this->id->CurrentValue : $this->id->OldValue;
        if (EmptyValue($val)) {
            return "";
        } else {
            $keys[] = $val;
        }
        return implode(Config("COMPOSITE_KEY_SEPARATOR"), $keys);
    }

    // Set Key
    public function setKey($key, $current = false)
    {
        $this->OldKey = strval($key);
        $keys = explode(Config("COMPOSITE_KEY_SEPARATOR"), $this->OldKey);
        if (count($keys) == 1) {
            if ($current) {
                $this->id->CurrentValue = $keys[0];
            } else {
                $this->id->OldValue = $keys[0];
            }
        }
    }

    // Get record filter
    public function getRecordFilter($row = null)
    {
        $keyFilter = $this->sqlKeyFilter();
        if (is_array($row)) {
            $val = array_key_exists('id', $row) ? $row['id'] : null;
        } else {
            $val = $this->id->OldValue !== null ? $this->id->OldValue : $this->id->CurrentValue;
        }
        if (!is_numeric($val)) {
            return "0=1"; // Invalid key
        }
        if ($val === null) {
            return "0=1"; // Invalid key
        } else {
            $keyFilter = str_replace("@id@", AdjustSql($val, $this->Dbid), $keyFilter); // Replace key value
        }
        return $keyFilter;
    }

    // Return page URL
    public function getReturnUrl()
    {
        $referUrl = ReferUrl();
        $referPageName = ReferPageName();
        $name = PROJECT_NAME . "_" . $this->TableVar . "_" . Config("TABLE_RETURN_URL");
        // Get referer URL automatically
        if ($referUrl != "" && $referPageName != CurrentPageName() && $referPageName != "login") { // Referer not same page or login page
            $_SESSION[$name] = $referUrl; // Save to Session
        }
        return $_SESSION[$name] ?? GetUrl("antreanumumlist");
    }

    // Set return page URL
    public function setReturnUrl($v)
    {
        $_SESSION[PROJECT_NAME . "_" . $this->TableVar . "_" . Config("TABLE_RETURN_URL")] = $v;
    }

    // Get modal caption
    public function getModalCaption($pageName)
    {
        global $Language;
        if ($pageName == "antreanumumview") {
            return $Language->phrase("View");
        } elseif ($pageName == "antreanumumedit") {
            return $Language->phrase("Edit");
        } elseif ($pageName == "antreanumumadd") {
            return $Language->phrase("Add");
        } else {
            return "";
        }
    }

    // API page name
    public function getApiPageName($action)
    {
        switch (strtolower($action)) {
            case Config("API_VIEW_ACTION"):
                return "AntreanUmumView";
            case Config("API_ADD_ACTION"):
                return "AntreanUmumAdd";
            case Config("API_EDIT_ACTION"):
                return "AntreanUmumEdit";
            case Config("API_DELETE_ACTION"):
                return "AntreanUmumDelete";
            case Config("API_LIST_ACTION"):
                return "AntreanUmumList";
            default:
                return "";
        }
    }

    // List URL
    public function getListUrl()
    {
        return "antreanumumlist";
    }

    // View URL
    public function getViewUrl($parm = "")
    {
        if ($parm != "") {
            $url = $this->keyUrl("antreanumumview", $this->getUrlParm($parm));
        } else {
            $url = $this->keyUrl("antreanumumview", $this->getUrlParm(Config("TABLE_SHOW_DETAIL") . "="));
        }
        return $this->addMasterUrl($url);
    }

    // Add URL
    public function getAddUrl($parm = "")
    {
        if ($parm != "") {
            $url = "antreanumumadd?" . $this->getUrlParm($parm);
        } else {
            $url = "antreanumumadd";
        }
        return $this->addMasterUrl($url);
    }

    // Edit URL
    public function getEditUrl($parm = "")
    {
        $url = $this->keyUrl("antreanumumedit", $this->getUrlParm($parm));
        return $this->addMasterUrl($url);
    }

    // Inline edit URL
    public function getInlineEditUrl()
    {
        $url = $this->keyUrl(CurrentPageName(), $this->getUrlParm("action=edit"));
        return $this->addMasterUrl($url);
    }

    // Copy URL
    public function getCopyUrl($parm = "")
    {
        $url = $this->keyUrl("antreanumumadd", $this->getUrlParm($parm));
        return $this->addMasterUrl($url);
    }

    // Inline copy URL
    public function getInlineCopyUrl()
    {
        $url = $this->keyUrl(CurrentPageName(), $this->getUrlParm("action=copy"));
        return $this->addMasterUrl($url);
    }

    // Delete URL
    public function getDeleteUrl()
    {
        return $this->keyUrl("antreanumumdelete", $this->getUrlParm());
    }

    // Add master url
    public function addMasterUrl($url)
    {
        return $url;
    }

    public function keyToJson($htmlEncode = false)
    {
        $json = "";
        $json .= "id:" . JsonEncode($this->id->CurrentValue, "number");
        $json = "{" . $json . "}";
        if ($htmlEncode) {
            $json = HtmlEncode($json);
        }
        return $json;
    }

    // Add key value to URL
    public function keyUrl($url, $parm = "")
    {
        if ($this->id->CurrentValue !== null) {
            $url .= "/" . rawurlencode($this->id->CurrentValue);
        } else {
            return "javascript:ew.alert(ew.language.phrase('InvalidRecord'));";
        }
        if ($parm != "") {
            $url .= "?" . $parm;
        }
        return $url;
    }

    // Render sort
    public function renderSort($fld)
    {
        $classId = $fld->TableVar . "_" . $fld->Param;
        $scriptId = str_replace("%id%", $classId, "tpc_%id%");
        $scriptStart = $this->UseCustomTemplate ? "<template id=\"" . $scriptId . "\">" : "";
        $scriptEnd = $this->UseCustomTemplate ? "</template>" : "";
        $jsSort = " class=\"ew-pointer\" onclick=\"ew.sort(event, '" . $this->sortUrl($fld) . "', 1);\"";
        if ($this->sortUrl($fld) == "") {
            $html = <<<NOSORTHTML
{$scriptStart}<div class="ew-table-header-caption">{$fld->caption()}</div>{$scriptEnd}
NOSORTHTML;
        } else {
            if ($fld->getSort() == "ASC") {
                $sortIcon = '<i class="fas fa-sort-up"></i>';
            } elseif ($fld->getSort() == "DESC") {
                $sortIcon = '<i class="fas fa-sort-down"></i>';
            } else {
                $sortIcon = '';
            }
            $html = <<<SORTHTML
{$scriptStart}<div{$jsSort}><div class="ew-table-header-btn"><span class="ew-table-header-caption">{$fld->caption()}</span><span class="ew-table-header-sort">{$sortIcon}</span></div></div>{$scriptEnd}
SORTHTML;
        }
        return $html;
    }

    // Sort URL
    public function sortUrl($fld)
    {
        if (
            $this->CurrentAction || $this->isExport() ||
            in_array($fld->Type, [128, 204, 205])
        ) { // Unsortable data type
                return "";
        } elseif ($fld->Sortable) {
            $urlParm = $this->getUrlParm("order=" . urlencode($fld->Name) . "&amp;ordertype=" . $fld->getNextSort());
            return $this->addMasterUrl(CurrentPageName() . "?" . $urlParm);
        } else {
            return "";
        }
    }

    // Get record keys from Post/Get/Session
    public function getRecordKeys()
    {
        $arKeys = [];
        $arKey = [];
        if (Param("key_m") !== null) {
            $arKeys = Param("key_m");
            $cnt = count($arKeys);
        } else {
            if (($keyValue = Param("id") ?? Route("id")) !== null) {
                $arKeys[] = $keyValue;
            } elseif (IsApi() && (($keyValue = Key(0) ?? Route(2)) !== null)) {
                $arKeys[] = $keyValue;
            } else {
                $arKeys = null; // Do not setup
            }

            //return $arKeys; // Do not return yet, so the values will also be checked by the following code
        }
        // Check keys
        $ar = [];
        if (is_array($arKeys)) {
            foreach ($arKeys as $key) {
                if (!is_numeric($key)) {
                    continue;
                }
                $ar[] = $key;
            }
        }
        return $ar;
    }

    // Get filter from record keys
    public function getFilterFromRecordKeys($setCurrent = true)
    {
        $arKeys = $this->getRecordKeys();
        $keyFilter = "";
        foreach ($arKeys as $key) {
            if ($keyFilter != "") {
                $keyFilter .= " OR ";
            }
            if ($setCurrent) {
                $this->id->CurrentValue = $key;
            } else {
                $this->id->OldValue = $key;
            }
            $keyFilter .= "(" . $this->getRecordFilter() . ")";
        }
        return $keyFilter;
    }

    // Load recordset based on filter
    public function &loadRs($filter)
    {
        $sql = $this->getSql($filter); // Set up filter (WHERE Clause)
        $conn = $this->getConnection();
        $stmt = $conn->executeQuery($sql);
        return $stmt;
    }

    // Load row values from record
    public function loadListRowValues(&$rs)
    {
        if (is_array($rs)) {
            $row = $rs;
        } elseif ($rs && property_exists($rs, "fields")) { // Recordset
            $row = $rs->fields;
        } else {
            return;
        }
        $this->id->setDbValue($row['id']);
        $this->nomor_antrean->setDbValue($row['nomor_antrean']);
        $this->waktu->setDbValue($row['waktu']);
        $this->pasien_id->setDbValue($row['pasien_id']);
        $this->fasilitas_id->setDbValue($row['fasilitas_id']);
        $this->rumah_sakit_id->setDbValue($row['rumah_sakit_id']);
        $this->status->setDbValue($row['status']);
    }

    // Render list row values
    public function renderListRow()
    {
        global $Security, $CurrentLanguage, $Language;

        // Call Row Rendering event
        $this->rowRendering();

        // Common render codes

        // id

        // nomor_antrean

        // waktu

        // pasien_id

        // fasilitas_id

        // rumah_sakit_id

        // status

        // id
        $this->id->ViewValue = $this->id->CurrentValue;
        $this->id->ViewCustomAttributes = "";

        // nomor_antrean
        $this->nomor_antrean->ViewValue = $this->nomor_antrean->CurrentValue;
        $this->nomor_antrean->ViewValue = FormatNumber($this->nomor_antrean->ViewValue, 0, -2, -2, -2);
        $this->nomor_antrean->ViewCustomAttributes = "";

        // waktu
        $this->waktu->ViewValue = $this->waktu->CurrentValue;
        $this->waktu->ViewValue = FormatDateTime($this->waktu->ViewValue, 0);
        $this->waktu->ViewCustomAttributes = "";

        // pasien_id
        $curVal = trim(strval($this->pasien_id->CurrentValue));
        if ($curVal != "") {
            $this->pasien_id->ViewValue = $this->pasien_id->lookupCacheOption($curVal);
            if ($this->pasien_id->ViewValue === null) { // Lookup from database
                $filterWrk = "`id`" . SearchString("=", $curVal, DATATYPE_NUMBER, "");
                $sqlWrk = $this->pasien_id->Lookup->getSql(false, $filterWrk, '', $this, true, true);
                $rswrk = Conn()->executeQuery($sqlWrk)->fetchAll(\PDO::FETCH_BOTH);
                $ari = count($rswrk);
                if ($ari > 0) { // Lookup values found
                    $arwrk = $this->pasien_id->Lookup->renderViewRow($rswrk[0]);
                    $this->pasien_id->ViewValue = $this->pasien_id->displayValue($arwrk);
                } else {
                    $this->pasien_id->ViewValue = $this->pasien_id->CurrentValue;
                }
            }
        } else {
            $this->pasien_id->ViewValue = null;
        }
        $this->pasien_id->ViewCustomAttributes = "";

        // fasilitas_id
        $curVal = trim(strval($this->fasilitas_id->CurrentValue));
        if ($curVal != "") {
            $this->fasilitas_id->ViewValue = $this->fasilitas_id->lookupCacheOption($curVal);
            if ($this->fasilitas_id->ViewValue === null) { // Lookup from database
                $filterWrk = "`id`" . SearchString("=", $curVal, DATATYPE_NUMBER, "");
                $sqlWrk = $this->fasilitas_id->Lookup->getSql(false, $filterWrk, '', $this, true, true);
                $rswrk = Conn()->executeQuery($sqlWrk)->fetchAll(\PDO::FETCH_BOTH);
                $ari = count($rswrk);
                if ($ari > 0) { // Lookup values found
                    $arwrk = $this->fasilitas_id->Lookup->renderViewRow($rswrk[0]);
                    $this->fasilitas_id->ViewValue = $this->fasilitas_id->displayValue($arwrk);
                } else {
                    $this->fasilitas_id->ViewValue = $this->fasilitas_id->CurrentValue;
                }
            }
        } else {
            $this->fasilitas_id->ViewValue = null;
        }
        $this->fasilitas_id->ViewCustomAttributes = "";

        // rumah_sakit_id
        $this->rumah_sakit_id->ViewValue = $this->rumah_sakit_id->CurrentValue;
        $curVal = trim(strval($this->rumah_sakit_id->CurrentValue));
        if ($curVal != "") {
            $this->rumah_sakit_id->ViewValue = $this->rumah_sakit_id->lookupCacheOption($curVal);
            if ($this->rumah_sakit_id->ViewValue === null) { // Lookup from database
                $filterWrk = "`id`" . SearchString("=", $curVal, DATATYPE_NUMBER, "");
                $sqlWrk = $this->rumah_sakit_id->Lookup->getSql(false, $filterWrk, '', $this, true, true);
                $rswrk = Conn()->executeQuery($sqlWrk)->fetchAll(\PDO::FETCH_BOTH);
                $ari = count($rswrk);
                if ($ari > 0) { // Lookup values found
                    $arwrk = $this->rumah_sakit_id->Lookup->renderViewRow($rswrk[0]);
                    $this->rumah_sakit_id->ViewValue = $this->rumah_sakit_id->displayValue($arwrk);
                } else {
                    $this->rumah_sakit_id->ViewValue = $this->rumah_sakit_id->CurrentValue;
                }
            }
        } else {
            $this->rumah_sakit_id->ViewValue = null;
        }
        $this->rumah_sakit_id->ViewCustomAttributes = "";

        // status
        if (strval($this->status->CurrentValue) != "") {
            $this->status->ViewValue = $this->status->optionCaption($this->status->CurrentValue);
        } else {
            $this->status->ViewValue = null;
        }
        $this->status->ViewCustomAttributes = "";

        // id
        $this->id->LinkCustomAttributes = "";
        $this->id->HrefValue = "";
        $this->id->TooltipValue = "";

        // nomor_antrean
        $this->nomor_antrean->LinkCustomAttributes = "";
        $this->nomor_antrean->HrefValue = "";
        $this->nomor_antrean->TooltipValue = "";

        // waktu
        $this->waktu->LinkCustomAttributes = "";
        $this->waktu->HrefValue = "";
        $this->waktu->TooltipValue = "";

        // pasien_id
        $this->pasien_id->LinkCustomAttributes = "";
        $this->pasien_id->HrefValue = "";
        $this->pasien_id->TooltipValue = "";

        // fasilitas_id
        $this->fasilitas_id->LinkCustomAttributes = "";
        $this->fasilitas_id->HrefValue = "";
        $this->fasilitas_id->TooltipValue = "";

        // rumah_sakit_id
        $this->rumah_sakit_id->LinkCustomAttributes = "";
        $this->rumah_sakit_id->HrefValue = "";
        $this->rumah_sakit_id->TooltipValue = "";

        // status
        $this->status->LinkCustomAttributes = "";
        $this->status->HrefValue = "";
        $this->status->TooltipValue = "";

        // Call Row Rendered event
        $this->rowRendered();

        // Save data for Custom Template
        $this->Rows[] = $this->customTemplateFieldValues();
    }

    // Render edit row values
    public function renderEditRow()
    {
        global $Security, $CurrentLanguage, $Language;

        // Call Row Rendering event
        $this->rowRendering();

        // id
        $this->id->EditAttrs["class"] = "form-control";
        $this->id->EditCustomAttributes = "";
        $this->id->EditValue = $this->id->CurrentValue;
        $this->id->ViewCustomAttributes = "";

        // nomor_antrean
        $this->nomor_antrean->EditAttrs["class"] = "form-control";
        $this->nomor_antrean->EditCustomAttributes = "";
        $this->nomor_antrean->EditValue = $this->nomor_antrean->CurrentValue;
        $this->nomor_antrean->EditValue = FormatNumber($this->nomor_antrean->EditValue, 0, -2, -2, -2);
        $this->nomor_antrean->ViewCustomAttributes = "";

        // waktu
        $this->waktu->EditAttrs["class"] = "form-control";
        $this->waktu->EditCustomAttributes = "";
        $this->waktu->EditValue = $this->waktu->CurrentValue;
        $this->waktu->EditValue = FormatDateTime($this->waktu->EditValue, 0);
        $this->waktu->ViewCustomAttributes = "";

        // pasien_id
        $this->pasien_id->EditAttrs["class"] = "form-control";
        $this->pasien_id->EditCustomAttributes = "";
        $curVal = trim(strval($this->pasien_id->CurrentValue));
        if ($curVal != "") {
            $this->pasien_id->EditValue = $this->pasien_id->lookupCacheOption($curVal);
            if ($this->pasien_id->EditValue === null) { // Lookup from database
                $filterWrk = "`id`" . SearchString("=", $curVal, DATATYPE_NUMBER, "");
                $sqlWrk = $this->pasien_id->Lookup->getSql(false, $filterWrk, '', $this, true, true);
                $rswrk = Conn()->executeQuery($sqlWrk)->fetchAll(\PDO::FETCH_BOTH);
                $ari = count($rswrk);
                if ($ari > 0) { // Lookup values found
                    $arwrk = $this->pasien_id->Lookup->renderViewRow($rswrk[0]);
                    $this->pasien_id->EditValue = $this->pasien_id->displayValue($arwrk);
                } else {
                    $this->pasien_id->EditValue = $this->pasien_id->CurrentValue;
                }
            }
        } else {
            $this->pasien_id->EditValue = null;
        }
        $this->pasien_id->ViewCustomAttributes = "";

        // fasilitas_id
        $this->fasilitas_id->EditAttrs["class"] = "form-control";
        $this->fasilitas_id->EditCustomAttributes = "";
        $curVal = trim(strval($this->fasilitas_id->CurrentValue));
        if ($curVal != "") {
            $this->fasilitas_id->EditValue = $this->fasilitas_id->lookupCacheOption($curVal);
            if ($this->fasilitas_id->EditValue === null) { // Lookup from database
                $filterWrk = "`id`" . SearchString("=", $curVal, DATATYPE_NUMBER, "");
                $sqlWrk = $this->fasilitas_id->Lookup->getSql(false, $filterWrk, '', $this, true, true);
                $rswrk = Conn()->executeQuery($sqlWrk)->fetchAll(\PDO::FETCH_BOTH);
                $ari = count($rswrk);
                if ($ari > 0) { // Lookup values found
                    $arwrk = $this->fasilitas_id->Lookup->renderViewRow($rswrk[0]);
                    $this->fasilitas_id->EditValue = $this->fasilitas_id->displayValue($arwrk);
                } else {
                    $this->fasilitas_id->EditValue = $this->fasilitas_id->CurrentValue;
                }
            }
        } else {
            $this->fasilitas_id->EditValue = null;
        }
        $this->fasilitas_id->ViewCustomAttributes = "";

        // rumah_sakit_id
        $this->rumah_sakit_id->EditAttrs["class"] = "form-control";
        $this->rumah_sakit_id->EditCustomAttributes = "";
        $this->rumah_sakit_id->EditValue = $this->rumah_sakit_id->CurrentValue;
        $curVal = trim(strval($this->rumah_sakit_id->CurrentValue));
        if ($curVal != "") {
            $this->rumah_sakit_id->EditValue = $this->rumah_sakit_id->lookupCacheOption($curVal);
            if ($this->rumah_sakit_id->EditValue === null) { // Lookup from database
                $filterWrk = "`id`" . SearchString("=", $curVal, DATATYPE_NUMBER, "");
                $sqlWrk = $this->rumah_sakit_id->Lookup->getSql(false, $filterWrk, '', $this, true, true);
                $rswrk = Conn()->executeQuery($sqlWrk)->fetchAll(\PDO::FETCH_BOTH);
                $ari = count($rswrk);
                if ($ari > 0) { // Lookup values found
                    $arwrk = $this->rumah_sakit_id->Lookup->renderViewRow($rswrk[0]);
                    $this->rumah_sakit_id->EditValue = $this->rumah_sakit_id->displayValue($arwrk);
                } else {
                    $this->rumah_sakit_id->EditValue = $this->rumah_sakit_id->CurrentValue;
                }
            }
        } else {
            $this->rumah_sakit_id->EditValue = null;
        }
        $this->rumah_sakit_id->ViewCustomAttributes = "";

        // status
        $this->status->EditCustomAttributes = "";
        $this->status->EditValue = $this->status->options(false);
        $this->status->PlaceHolder = RemoveHtml($this->status->caption());

        // Call Row Rendered event
        $this->rowRendered();
    }

    // Aggregate list row values
    public function aggregateListRowValues()
    {
    }

    // Aggregate list row (for rendering)
    public function aggregateListRow()
    {
        // Call Row Rendered event
        $this->rowRendered();
    }

    // Export data in HTML/CSV/Word/Excel/Email/PDF format
    public function exportDocument($doc, $recordset, $startRec = 1, $stopRec = 1, $exportPageType = "")
    {
        if (!$recordset || !$doc) {
            return;
        }
        if (!$doc->ExportCustom) {
            // Write header
            $doc->exportTableHeader();
            if ($doc->Horizontal) { // Horizontal format, write header
                $doc->beginExportRow();
                if ($exportPageType == "view") {
                    $doc->exportCaption($this->id);
                    $doc->exportCaption($this->nomor_antrean);
                    $doc->exportCaption($this->waktu);
                    $doc->exportCaption($this->pasien_id);
                    $doc->exportCaption($this->fasilitas_id);
                    $doc->exportCaption($this->rumah_sakit_id);
                    $doc->exportCaption($this->status);
                } else {
                    $doc->exportCaption($this->id);
                    $doc->exportCaption($this->nomor_antrean);
                    $doc->exportCaption($this->waktu);
                    $doc->exportCaption($this->pasien_id);
                    $doc->exportCaption($this->fasilitas_id);
                    $doc->exportCaption($this->rumah_sakit_id);
                    $doc->exportCaption($this->status);
                }
                $doc->endExportRow();
            }
        }

        // Move to first record
        $recCnt = $startRec - 1;
        $stopRec = ($stopRec > 0) ? $stopRec : PHP_INT_MAX;
        while (!$recordset->EOF && $recCnt < $stopRec) {
            $row = $recordset->fields;
            $recCnt++;
            if ($recCnt >= $startRec) {
                $rowCnt = $recCnt - $startRec + 1;

                // Page break
                if ($this->ExportPageBreakCount > 0) {
                    if ($rowCnt > 1 && ($rowCnt - 1) % $this->ExportPageBreakCount == 0) {
                        $doc->exportPageBreak();
                    }
                }
                $this->loadListRowValues($row);

                // Render row
                $this->RowType = ROWTYPE_VIEW; // Render view
                $this->resetAttributes();
                $this->renderListRow();
                if (!$doc->ExportCustom) {
                    $doc->beginExportRow($rowCnt); // Allow CSS styles if enabled
                    if ($exportPageType == "view") {
                        $doc->exportField($this->id);
                        $doc->exportField($this->nomor_antrean);
                        $doc->exportField($this->waktu);
                        $doc->exportField($this->pasien_id);
                        $doc->exportField($this->fasilitas_id);
                        $doc->exportField($this->rumah_sakit_id);
                        $doc->exportField($this->status);
                    } else {
                        $doc->exportField($this->id);
                        $doc->exportField($this->nomor_antrean);
                        $doc->exportField($this->waktu);
                        $doc->exportField($this->pasien_id);
                        $doc->exportField($this->fasilitas_id);
                        $doc->exportField($this->rumah_sakit_id);
                        $doc->exportField($this->status);
                    }
                    $doc->endExportRow($rowCnt);
                }
            }

            // Call Row Export server event
            if ($doc->ExportCustom) {
                $this->rowExport($row);
            }
            $recordset->moveNext();
        }
        if (!$doc->ExportCustom) {
            $doc->exportTableFooter();
        }
    }

    // Get file data
    public function getFileData($fldparm, $key, $resize, $width = 0, $height = 0, $plugins = [])
    {
        // No binary fields
        return false;
    }

    // Table level events

    // Recordset Selecting event
    public function recordsetSelecting(&$filter)
    {
        // Enter your code here
    }

    // Recordset Selected event
    public function recordsetSelected(&$rs)
    {
        //Log("Recordset Selected");
    }

    // Recordset Search Validated event
    public function recordsetSearchValidated()
    {
        // Example:
        //$this->MyField1->AdvancedSearch->SearchValue = "your search criteria"; // Search value
    }

    // Recordset Searching event
    public function recordsetSearching(&$filter)
    {
        // Enter your code here
    }

    // Row_Selecting event
    public function rowSelecting(&$filter)
    {
        // Enter your code here
    }

    // Row Selected event
    public function rowSelected(&$rs)
    {
        //Log("Row Selected");
    }

    // Row Inserting event
    public function rowInserting($rsold, &$rsnew)
    {
        // Enter your code here
        // To cancel, set return value to false
        return true;
    }

    // Row Inserted event
    public function rowInserted($rsold, &$rsnew)
    {
        //Log("Row Inserted");
    }

    // Row Updating event
    public function rowUpdating($rsold, &$rsnew)
    {
        // Enter your code here
        // To cancel, set return value to false
        return true;
    }

    // Row Updated event
    public function rowUpdated($rsold, &$rsnew)
    {
        //Log("Row Updated");
    }

    // Row Update Conflict event
    public function rowUpdateConflict($rsold, &$rsnew)
    {
        // Enter your code here
        // To ignore conflict, set return value to false
        return true;
    }

    // Grid Inserting event
    public function gridInserting()
    {
        // Enter your code here
        // To reject grid insert, set return value to false
        return true;
    }

    // Grid Inserted event
    public function gridInserted($rsnew)
    {
        //Log("Grid Inserted");
    }

    // Grid Updating event
    public function gridUpdating($rsold)
    {
        // Enter your code here
        // To reject grid update, set return value to false
        return true;
    }

    // Grid Updated event
    public function gridUpdated($rsold, $rsnew)
    {
        //Log("Grid Updated");
    }

    // Row Deleting event
    public function rowDeleting(&$rs)
    {
        // Enter your code here
        // To cancel, set return value to False
        return true;
    }

    // Row Deleted event
    public function rowDeleted(&$rs)
    {
        //Log("Row Deleted");
    }

    // Email Sending event
    public function emailSending($email, &$args)
    {
        //var_dump($email); var_dump($args); exit();
        return true;
    }

    // Lookup Selecting event
    public function lookupSelecting($fld, &$filter)
    {
        //var_dump($fld->Name, $fld->Lookup, $filter); // Uncomment to view the filter
        // Enter your code here
    }

    // Row Rendering event
    public function rowRendering()
    {
        // Enter your code here
    }

    // Row Rendered event
    public function rowRendered()
    {
        // To view properties of field class, use:
        //var_dump($this-><FieldName>);
    }

    // User ID Filtering event
    public function userIdFiltering(&$filter)
    {
        // Enter your code here
    }
}
