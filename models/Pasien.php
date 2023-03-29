<?php

namespace PHPMaker2021\satusehat;

use Doctrine\DBAL\ParameterType;

/**
 * Table class for pasien
 */
class Pasien extends DbTable
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
    public $nik;
    public $nama;
    public $jenis_kelamin;
    public $tanggal_lahir;
    public $agama;
    public $pekerjaan;
    public $pendidikan;
    public $status_perkawinan;
    public $no_bpjs;
    public $no_hp;
    public $_password;

    // Page ID
    public $PageID = ""; // To be overridden by subclass

    // Constructor
    public function __construct()
    {
        global $Language, $CurrentLanguage;
        parent::__construct();

        // Language object
        $Language = Container("language");
        $this->TableVar = 'pasien';
        $this->TableName = 'pasien';
        $this->TableType = 'TABLE';

        // Update Table
        $this->UpdateTable = "`pasien`";
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
        $this->id = new DbField('pasien', 'pasien', 'x_id', 'id', '`id`', '`id`', 20, 20, -1, false, '`id`', false, false, false, 'FORMATTED TEXT', 'NO');
        $this->id->IsAutoIncrement = true; // Autoincrement field
        $this->id->IsPrimaryKey = true; // Primary key field
        $this->id->IsForeignKey = true; // Foreign key field
        $this->id->Sortable = true; // Allow sort
        $this->id->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
        $this->id->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->id->Param, "CustomMsg");
        $this->Fields['id'] = &$this->id;

        // nik
        $this->nik = new DbField('pasien', 'pasien', 'x_nik', 'nik', '`nik`', '`nik`', 200, 16, -1, false, '`nik`', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->nik->Nullable = false; // NOT NULL field
        $this->nik->Required = true; // Required field
        $this->nik->Sortable = true; // Allow sort
        $this->nik->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->nik->Param, "CustomMsg");
        $this->Fields['nik'] = &$this->nik;

        // nama
        $this->nama = new DbField('pasien', 'pasien', 'x_nama', 'nama', '`nama`', '`nama`', 200, 255, -1, false, '`nama`', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->nama->Sortable = true; // Allow sort
        $this->nama->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->nama->Param, "CustomMsg");
        $this->Fields['nama'] = &$this->nama;

        // jenis_kelamin
        $this->jenis_kelamin = new DbField('pasien', 'pasien', 'x_jenis_kelamin', 'jenis_kelamin', '`jenis_kelamin`', '`jenis_kelamin`', 202, 11, -1, false, '`jenis_kelamin`', false, false, false, 'FORMATTED TEXT', 'RADIO');
        $this->jenis_kelamin->Sortable = true; // Allow sort
        $this->jenis_kelamin->Lookup = new Lookup('jenis_kelamin', 'pasien', false, '', ["","","",""], [], [], [], [], [], [], '', '');
        $this->jenis_kelamin->OptionCount = 2;
        $this->jenis_kelamin->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->jenis_kelamin->Param, "CustomMsg");
        $this->Fields['jenis_kelamin'] = &$this->jenis_kelamin;

        // tanggal_lahir
        $this->tanggal_lahir = new DbField('pasien', 'pasien', 'x_tanggal_lahir', 'tanggal_lahir', '`tanggal_lahir`', CastDateFieldForLike("`tanggal_lahir`", 0, "DB"), 133, 10, 0, false, '`tanggal_lahir`', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->tanggal_lahir->Sortable = true; // Allow sort
        $this->tanggal_lahir->DefaultErrorMessage = str_replace("%s", $GLOBALS["DATE_FORMAT"], $Language->phrase("IncorrectDate"));
        $this->tanggal_lahir->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->tanggal_lahir->Param, "CustomMsg");
        $this->Fields['tanggal_lahir'] = &$this->tanggal_lahir;

        // agama
        $this->agama = new DbField('pasien', 'pasien', 'x_agama', 'agama', '`agama`', '`agama`', 202, 9, -1, false, '`agama`', false, false, false, 'FORMATTED TEXT', 'RADIO');
        $this->agama->Sortable = true; // Allow sort
        $this->agama->Lookup = new Lookup('agama', 'pasien', false, '', ["","","",""], [], [], [], [], [], [], '', '');
        $this->agama->OptionCount = 6;
        $this->agama->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->agama->Param, "CustomMsg");
        $this->Fields['agama'] = &$this->agama;

        // pekerjaan
        $this->pekerjaan = new DbField('pasien', 'pasien', 'x_pekerjaan', 'pekerjaan', '`pekerjaan`', '`pekerjaan`', 202, 26, -1, false, '`pekerjaan`', false, false, false, 'FORMATTED TEXT', 'RADIO');
        $this->pekerjaan->Sortable = true; // Allow sort
        $this->pekerjaan->Lookup = new Lookup('pekerjaan', 'pasien', false, '', ["","","",""], [], [], [], [], [], [], '', '');
        $this->pekerjaan->OptionCount = 13;
        $this->pekerjaan->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->pekerjaan->Param, "CustomMsg");
        $this->Fields['pekerjaan'] = &$this->pekerjaan;

        // pendidikan
        $this->pendidikan = new DbField('pasien', 'pasien', 'x_pendidikan', 'pendidikan', '`pendidikan`', '`pendidikan`', 202, 27, -1, false, '`pendidikan`', false, false, false, 'FORMATTED TEXT', 'RADIO');
        $this->pendidikan->Sortable = true; // Allow sort
        $this->pendidikan->Lookup = new Lookup('pendidikan', 'pasien', false, '', ["","","",""], [], [], [], [], [], [], '', '');
        $this->pendidikan->OptionCount = 10;
        $this->pendidikan->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->pendidikan->Param, "CustomMsg");
        $this->Fields['pendidikan'] = &$this->pendidikan;

        // status_perkawinan
        $this->status_perkawinan = new DbField('pasien', 'pasien', 'x_status_perkawinan', 'status_perkawinan', '`status_perkawinan`', '`status_perkawinan`', 202, 11, -1, false, '`status_perkawinan`', false, false, false, 'FORMATTED TEXT', 'RADIO');
        $this->status_perkawinan->Sortable = true; // Allow sort
        $this->status_perkawinan->Lookup = new Lookup('status_perkawinan', 'pasien', false, '', ["","","",""], [], [], [], [], [], [], '', '');
        $this->status_perkawinan->OptionCount = 4;
        $this->status_perkawinan->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->status_perkawinan->Param, "CustomMsg");
        $this->Fields['status_perkawinan'] = &$this->status_perkawinan;

        // no_bpjs
        $this->no_bpjs = new DbField('pasien', 'pasien', 'x_no_bpjs', 'no_bpjs', '`no_bpjs`', '`no_bpjs`', 200, 13, -1, false, '`no_bpjs`', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->no_bpjs->Sortable = true; // Allow sort
        $this->no_bpjs->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->no_bpjs->Param, "CustomMsg");
        $this->Fields['no_bpjs'] = &$this->no_bpjs;

        // no_hp
        $this->no_hp = new DbField('pasien', 'pasien', 'x_no_hp', 'no_hp', '`no_hp`', '`no_hp`', 200, 15, -1, false, '`no_hp`', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->no_hp->Required = true; // Required field
        $this->no_hp->Sortable = true; // Allow sort
        $this->no_hp->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->no_hp->Param, "CustomMsg");
        $this->Fields['no_hp'] = &$this->no_hp;

        // password
        $this->_password = new DbField('pasien', 'pasien', 'x__password', 'password', '`password`', '`password`', 200, 255, -1, false, '`password`', false, false, false, 'FORMATTED TEXT', 'PASSWORD');
        $this->_password->Nullable = false; // NOT NULL field
        $this->_password->Required = true; // Required field
        $this->_password->Sortable = true; // Allow sort
        $this->_password->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->_password->Param, "CustomMsg");
        $this->Fields['password'] = &$this->_password;
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

    // Current detail table name
    public function getCurrentDetailTable()
    {
        return Session(PROJECT_NAME . "_" . $this->TableVar . "_" . Config("TABLE_DETAIL_TABLE"));
    }

    public function setCurrentDetailTable($v)
    {
        $_SESSION[PROJECT_NAME . "_" . $this->TableVar . "_" . Config("TABLE_DETAIL_TABLE")] = $v;
    }

    // Get detail url
    public function getDetailUrl()
    {
        // Detail url
        $detailUrl = "";
        if ($this->getCurrentDetailTable() == "kontak_darurat") {
            $detailUrl = Container("kontak_darurat")->getListUrl() . "?" . Config("TABLE_SHOW_MASTER") . "=" . $this->TableVar;
            $detailUrl .= "&" . GetForeignKeyUrl("fk_id", $this->id->CurrentValue);
        }
        if ($detailUrl == "") {
            $detailUrl = "pasienlist";
        }
        return $detailUrl;
    }

    // Table level SQL
    public function getSqlFrom() // From
    {
        return ($this->SqlFrom != "") ? $this->SqlFrom : "`pasien`";
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
        $this->DefaultFilter = "";
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
        $this->nik->DbValue = $row['nik'];
        $this->nama->DbValue = $row['nama'];
        $this->jenis_kelamin->DbValue = $row['jenis_kelamin'];
        $this->tanggal_lahir->DbValue = $row['tanggal_lahir'];
        $this->agama->DbValue = $row['agama'];
        $this->pekerjaan->DbValue = $row['pekerjaan'];
        $this->pendidikan->DbValue = $row['pendidikan'];
        $this->status_perkawinan->DbValue = $row['status_perkawinan'];
        $this->no_bpjs->DbValue = $row['no_bpjs'];
        $this->no_hp->DbValue = $row['no_hp'];
        $this->_password->DbValue = $row['password'];
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
        return $_SESSION[$name] ?? GetUrl("pasienlist");
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
        if ($pageName == "pasienview") {
            return $Language->phrase("View");
        } elseif ($pageName == "pasienedit") {
            return $Language->phrase("Edit");
        } elseif ($pageName == "pasienadd") {
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
                return "PasienView";
            case Config("API_ADD_ACTION"):
                return "PasienAdd";
            case Config("API_EDIT_ACTION"):
                return "PasienEdit";
            case Config("API_DELETE_ACTION"):
                return "PasienDelete";
            case Config("API_LIST_ACTION"):
                return "PasienList";
            default:
                return "";
        }
    }

    // List URL
    public function getListUrl()
    {
        return "pasienlist";
    }

    // View URL
    public function getViewUrl($parm = "")
    {
        if ($parm != "") {
            $url = $this->keyUrl("pasienview", $this->getUrlParm($parm));
        } else {
            $url = $this->keyUrl("pasienview", $this->getUrlParm(Config("TABLE_SHOW_DETAIL") . "="));
        }
        return $this->addMasterUrl($url);
    }

    // Add URL
    public function getAddUrl($parm = "")
    {
        if ($parm != "") {
            $url = "pasienadd?" . $this->getUrlParm($parm);
        } else {
            $url = "pasienadd";
        }
        return $this->addMasterUrl($url);
    }

    // Edit URL
    public function getEditUrl($parm = "")
    {
        if ($parm != "") {
            $url = $this->keyUrl("pasienedit", $this->getUrlParm($parm));
        } else {
            $url = $this->keyUrl("pasienedit", $this->getUrlParm(Config("TABLE_SHOW_DETAIL") . "="));
        }
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
        if ($parm != "") {
            $url = $this->keyUrl("pasienadd", $this->getUrlParm($parm));
        } else {
            $url = $this->keyUrl("pasienadd", $this->getUrlParm(Config("TABLE_SHOW_DETAIL") . "="));
        }
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
        return $this->keyUrl("pasiendelete", $this->getUrlParm());
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
        $this->nik->setDbValue($row['nik']);
        $this->nama->setDbValue($row['nama']);
        $this->jenis_kelamin->setDbValue($row['jenis_kelamin']);
        $this->tanggal_lahir->setDbValue($row['tanggal_lahir']);
        $this->agama->setDbValue($row['agama']);
        $this->pekerjaan->setDbValue($row['pekerjaan']);
        $this->pendidikan->setDbValue($row['pendidikan']);
        $this->status_perkawinan->setDbValue($row['status_perkawinan']);
        $this->no_bpjs->setDbValue($row['no_bpjs']);
        $this->no_hp->setDbValue($row['no_hp']);
        $this->_password->setDbValue($row['password']);
    }

    // Render list row values
    public function renderListRow()
    {
        global $Security, $CurrentLanguage, $Language;

        // Call Row Rendering event
        $this->rowRendering();

        // Common render codes

        // id

        // nik

        // nama

        // jenis_kelamin

        // tanggal_lahir

        // agama

        // pekerjaan

        // pendidikan

        // status_perkawinan

        // no_bpjs

        // no_hp

        // password

        // id
        $this->id->ViewValue = $this->id->CurrentValue;
        $this->id->ViewCustomAttributes = "";

        // nik
        $this->nik->ViewValue = $this->nik->CurrentValue;
        $this->nik->ViewCustomAttributes = "";

        // nama
        $this->nama->ViewValue = $this->nama->CurrentValue;
        $this->nama->ViewCustomAttributes = "";

        // jenis_kelamin
        if (strval($this->jenis_kelamin->CurrentValue) != "") {
            $this->jenis_kelamin->ViewValue = $this->jenis_kelamin->optionCaption($this->jenis_kelamin->CurrentValue);
        } else {
            $this->jenis_kelamin->ViewValue = null;
        }
        $this->jenis_kelamin->ViewCustomAttributes = "";

        // tanggal_lahir
        $this->tanggal_lahir->ViewValue = $this->tanggal_lahir->CurrentValue;
        $this->tanggal_lahir->ViewValue = FormatDateTime($this->tanggal_lahir->ViewValue, 0);
        $this->tanggal_lahir->ViewCustomAttributes = "";

        // agama
        if (strval($this->agama->CurrentValue) != "") {
            $this->agama->ViewValue = $this->agama->optionCaption($this->agama->CurrentValue);
        } else {
            $this->agama->ViewValue = null;
        }
        $this->agama->ViewCustomAttributes = "";

        // pekerjaan
        if (strval($this->pekerjaan->CurrentValue) != "") {
            $this->pekerjaan->ViewValue = $this->pekerjaan->optionCaption($this->pekerjaan->CurrentValue);
        } else {
            $this->pekerjaan->ViewValue = null;
        }
        $this->pekerjaan->ViewCustomAttributes = "";

        // pendidikan
        if (strval($this->pendidikan->CurrentValue) != "") {
            $this->pendidikan->ViewValue = $this->pendidikan->optionCaption($this->pendidikan->CurrentValue);
        } else {
            $this->pendidikan->ViewValue = null;
        }
        $this->pendidikan->ViewCustomAttributes = "";

        // status_perkawinan
        if (strval($this->status_perkawinan->CurrentValue) != "") {
            $this->status_perkawinan->ViewValue = $this->status_perkawinan->optionCaption($this->status_perkawinan->CurrentValue);
        } else {
            $this->status_perkawinan->ViewValue = null;
        }
        $this->status_perkawinan->ViewCustomAttributes = "";

        // no_bpjs
        $this->no_bpjs->ViewValue = $this->no_bpjs->CurrentValue;
        $this->no_bpjs->ViewCustomAttributes = "";

        // no_hp
        $this->no_hp->ViewValue = $this->no_hp->CurrentValue;
        $this->no_hp->ViewCustomAttributes = "";

        // password
        $this->_password->ViewValue = $Language->phrase("PasswordMask");
        $this->_password->ViewCustomAttributes = "";

        // id
        $this->id->LinkCustomAttributes = "";
        $this->id->HrefValue = "";
        $this->id->TooltipValue = "";

        // nik
        $this->nik->LinkCustomAttributes = "";
        $this->nik->HrefValue = "";
        $this->nik->TooltipValue = "";

        // nama
        $this->nama->LinkCustomAttributes = "";
        $this->nama->HrefValue = "";
        $this->nama->TooltipValue = "";

        // jenis_kelamin
        $this->jenis_kelamin->LinkCustomAttributes = "";
        $this->jenis_kelamin->HrefValue = "";
        $this->jenis_kelamin->TooltipValue = "";

        // tanggal_lahir
        $this->tanggal_lahir->LinkCustomAttributes = "";
        $this->tanggal_lahir->HrefValue = "";
        $this->tanggal_lahir->TooltipValue = "";

        // agama
        $this->agama->LinkCustomAttributes = "";
        $this->agama->HrefValue = "";
        $this->agama->TooltipValue = "";

        // pekerjaan
        $this->pekerjaan->LinkCustomAttributes = "";
        $this->pekerjaan->HrefValue = "";
        $this->pekerjaan->TooltipValue = "";

        // pendidikan
        $this->pendidikan->LinkCustomAttributes = "";
        $this->pendidikan->HrefValue = "";
        $this->pendidikan->TooltipValue = "";

        // status_perkawinan
        $this->status_perkawinan->LinkCustomAttributes = "";
        $this->status_perkawinan->HrefValue = "";
        $this->status_perkawinan->TooltipValue = "";

        // no_bpjs
        $this->no_bpjs->LinkCustomAttributes = "";
        $this->no_bpjs->HrefValue = "";
        $this->no_bpjs->TooltipValue = "";

        // no_hp
        $this->no_hp->LinkCustomAttributes = "";
        $this->no_hp->HrefValue = "";
        $this->no_hp->TooltipValue = "";

        // password
        $this->_password->LinkCustomAttributes = "";
        $this->_password->HrefValue = "";
        $this->_password->TooltipValue = "";

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

        // nik
        $this->nik->EditAttrs["class"] = "form-control";
        $this->nik->EditCustomAttributes = "";
        if (!$this->nik->Raw) {
            $this->nik->CurrentValue = HtmlDecode($this->nik->CurrentValue);
        }
        $this->nik->EditValue = $this->nik->CurrentValue;
        $this->nik->PlaceHolder = RemoveHtml($this->nik->caption());

        // nama
        $this->nama->EditAttrs["class"] = "form-control";
        $this->nama->EditCustomAttributes = "";
        if (!$this->nama->Raw) {
            $this->nama->CurrentValue = HtmlDecode($this->nama->CurrentValue);
        }
        $this->nama->EditValue = $this->nama->CurrentValue;
        $this->nama->PlaceHolder = RemoveHtml($this->nama->caption());

        // jenis_kelamin
        $this->jenis_kelamin->EditCustomAttributes = "";
        $this->jenis_kelamin->EditValue = $this->jenis_kelamin->options(false);
        $this->jenis_kelamin->PlaceHolder = RemoveHtml($this->jenis_kelamin->caption());

        // tanggal_lahir
        $this->tanggal_lahir->EditAttrs["class"] = "form-control";
        $this->tanggal_lahir->EditCustomAttributes = "";
        $this->tanggal_lahir->EditValue = FormatDateTime($this->tanggal_lahir->CurrentValue, 8);
        $this->tanggal_lahir->PlaceHolder = RemoveHtml($this->tanggal_lahir->caption());

        // agama
        $this->agama->EditCustomAttributes = "";
        $this->agama->EditValue = $this->agama->options(false);
        $this->agama->PlaceHolder = RemoveHtml($this->agama->caption());

        // pekerjaan
        $this->pekerjaan->EditCustomAttributes = "";
        $this->pekerjaan->EditValue = $this->pekerjaan->options(false);
        $this->pekerjaan->PlaceHolder = RemoveHtml($this->pekerjaan->caption());

        // pendidikan
        $this->pendidikan->EditCustomAttributes = "";
        $this->pendidikan->EditValue = $this->pendidikan->options(false);
        $this->pendidikan->PlaceHolder = RemoveHtml($this->pendidikan->caption());

        // status_perkawinan
        $this->status_perkawinan->EditCustomAttributes = "";
        $this->status_perkawinan->EditValue = $this->status_perkawinan->options(false);
        $this->status_perkawinan->PlaceHolder = RemoveHtml($this->status_perkawinan->caption());

        // no_bpjs
        $this->no_bpjs->EditAttrs["class"] = "form-control";
        $this->no_bpjs->EditCustomAttributes = "";
        if (!$this->no_bpjs->Raw) {
            $this->no_bpjs->CurrentValue = HtmlDecode($this->no_bpjs->CurrentValue);
        }
        $this->no_bpjs->EditValue = $this->no_bpjs->CurrentValue;
        $this->no_bpjs->PlaceHolder = RemoveHtml($this->no_bpjs->caption());

        // no_hp
        $this->no_hp->EditAttrs["class"] = "form-control";
        $this->no_hp->EditCustomAttributes = "";
        if (!$this->no_hp->Raw) {
            $this->no_hp->CurrentValue = HtmlDecode($this->no_hp->CurrentValue);
        }
        $this->no_hp->EditValue = $this->no_hp->CurrentValue;
        $this->no_hp->PlaceHolder = RemoveHtml($this->no_hp->caption());

        // password
        $this->_password->EditAttrs["class"] = "form-control";
        $this->_password->EditCustomAttributes = "";
        $this->_password->EditValue = $Language->phrase("PasswordMask"); // Show as masked password
        $this->_password->PlaceHolder = RemoveHtml($this->_password->caption());

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
                    $doc->exportCaption($this->nik);
                    $doc->exportCaption($this->nama);
                    $doc->exportCaption($this->jenis_kelamin);
                    $doc->exportCaption($this->tanggal_lahir);
                    $doc->exportCaption($this->agama);
                    $doc->exportCaption($this->pekerjaan);
                    $doc->exportCaption($this->pendidikan);
                    $doc->exportCaption($this->status_perkawinan);
                    $doc->exportCaption($this->no_bpjs);
                    $doc->exportCaption($this->no_hp);
                    $doc->exportCaption($this->_password);
                } else {
                    $doc->exportCaption($this->id);
                    $doc->exportCaption($this->nik);
                    $doc->exportCaption($this->nama);
                    $doc->exportCaption($this->jenis_kelamin);
                    $doc->exportCaption($this->tanggal_lahir);
                    $doc->exportCaption($this->agama);
                    $doc->exportCaption($this->pekerjaan);
                    $doc->exportCaption($this->pendidikan);
                    $doc->exportCaption($this->status_perkawinan);
                    $doc->exportCaption($this->no_bpjs);
                    $doc->exportCaption($this->no_hp);
                    $doc->exportCaption($this->_password);
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
                        $doc->exportField($this->nik);
                        $doc->exportField($this->nama);
                        $doc->exportField($this->jenis_kelamin);
                        $doc->exportField($this->tanggal_lahir);
                        $doc->exportField($this->agama);
                        $doc->exportField($this->pekerjaan);
                        $doc->exportField($this->pendidikan);
                        $doc->exportField($this->status_perkawinan);
                        $doc->exportField($this->no_bpjs);
                        $doc->exportField($this->no_hp);
                        $doc->exportField($this->_password);
                    } else {
                        $doc->exportField($this->id);
                        $doc->exportField($this->nik);
                        $doc->exportField($this->nama);
                        $doc->exportField($this->jenis_kelamin);
                        $doc->exportField($this->tanggal_lahir);
                        $doc->exportField($this->agama);
                        $doc->exportField($this->pekerjaan);
                        $doc->exportField($this->pendidikan);
                        $doc->exportField($this->status_perkawinan);
                        $doc->exportField($this->no_bpjs);
                        $doc->exportField($this->no_hp);
                        $doc->exportField($this->_password);
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
