<?php

namespace Art\Base;

use \DateTime;
use \Exception;
use \PDO;
use Art\CfaQuery as ChildCfaQuery;
use Art\Map\CfaTableMap;
use Propel\Runtime\Propel;
use Propel\Runtime\ActiveQuery\Criteria;
use Propel\Runtime\ActiveQuery\ModelCriteria;
use Propel\Runtime\ActiveRecord\ActiveRecordInterface;
use Propel\Runtime\Collection\Collection;
use Propel\Runtime\Connection\ConnectionInterface;
use Propel\Runtime\Exception\BadMethodCallException;
use Propel\Runtime\Exception\LogicException;
use Propel\Runtime\Exception\PropelException;
use Propel\Runtime\Map\TableMap;
use Propel\Runtime\Parser\AbstractParser;
use Propel\Runtime\Util\PropelDateTime;

/**
 * Base class that represents a row from the 'cfa' table.
 *
 *
 *
 * @package    propel.generator.Art.Base
 */
abstract class Cfa implements ActiveRecordInterface
{
    /**
     * TableMap class name
     *
     * @var string
     */
    public const TABLE_MAP = '\\Art\\Map\\CfaTableMap';


    /**
     * attribute to determine if this object has previously been saved.
     * @var bool
     */
    protected $new = true;

    /**
     * attribute to determine whether this object has been deleted.
     * @var bool
     */
    protected $deleted = false;

    /**
     * The columns that have been modified in current object.
     * Tracking modified columns allows us to only update modified columns.
     * @var array
     */
    protected $modifiedColumns = [];

    /**
     * The (virtual) columns that are added at runtime
     * The formatters can add supplementary columns based on a resultset
     * @var array
     */
    protected $virtualColumns = [];

    /**
     * The value for the record_id field.
     *
     * @var        int
     */
    protected $record_id;

    /**
     * The value for the created_at field.
     *
     * Note: this column has a database default value of: (expression) CURRENT_TIMESTAMP
     * @var        DateTime
     */
    protected $created_at;

    /**
     * The value for the updated_at field.
     *
     * Note: this column has a database default value of: (expression) CURRENT_TIMESTAMP
     * @var        DateTime
     */
    protected $updated_at;

    /**
     * The value for the piece_id field.
     *
     * @var        int
     */
    protected $piece_id;

    /**
     * The value for the piece_id_run field.
     *
     * @var        int|null
     */
    protected $piece_id_run;

    /**
     * The value for the piece_id_count field.
     *
     * @var        int|null
     */
    protected $piece_id_count;

    /**
     * The value for the print_company field.
     *
     * @var        string|null
     */
    protected $print_company;

    /**
     * The value for the print_date_sent field.
     *
     * @var        string|null
     */
    protected $print_date_sent;

    /**
     * The value for the print_date_receipt field.
     *
     * @var        string|null
     */
    protected $print_date_receipt;

    /**
     * The value for the print_medium field.
     *
     * @var        string|null
     */
    protected $print_medium;

    /**
     * The value for the print_cost field.
     *
     * @var        string|null
     */
    protected $print_cost;

    /**
     * The value for the print_notes field.
     *
     * @var        string|null
     */
    protected $print_notes;

    /**
     * The value for the buyer_name field.
     *
     * @var        string|null
     */
    protected $buyer_name;

    /**
     * The value for the buyer_location field.
     *
     * @var        string|null
     */
    protected $buyer_location;

    /**
     * The value for the buyer_date_purchase field.
     *
     * @var        string|null
     */
    protected $buyer_date_purchase;

    /**
     * The value for the buyer_date_receipt field.
     *
     * @var        string|null
     */
    protected $buyer_date_receipt;

    /**
     * The value for the notes field.
     *
     * @var        string|null
     */
    protected $notes;

    /**
     * Flag to prevent endless save loop, if this object is referenced
     * by another object which falls in this transaction.
     *
     * @var bool
     */
    protected $alreadyInSave = false;

    /**
     * Applies default values to this object.
     * This method should be called from the object's constructor (or
     * equivalent initialization method).
     * @see __construct()
     */
    public function applyDefaultValues(): void
    {
    }

    /**
     * Initializes internal state of Art\Base\Cfa object.
     * @see applyDefaults()
     */
    public function __construct()
    {
        $this->applyDefaultValues();
    }

    /**
     * Returns whether the object has been modified.
     *
     * @return bool True if the object has been modified.
     */
    public function isModified(): bool
    {
        return !!$this->modifiedColumns;
    }

    /**
     * Has specified column been modified?
     *
     * @param string $col column fully qualified name (TableMap::TYPE_COLNAME), e.g. Book::AUTHOR_ID
     * @return bool True if $col has been modified.
     */
    public function isColumnModified(string $col): bool
    {
        return $this->modifiedColumns && isset($this->modifiedColumns[$col]);
    }

    /**
     * Get the columns that have been modified in this object.
     * @return array A unique list of the modified column names for this object.
     */
    public function getModifiedColumns(): array
    {
        return $this->modifiedColumns ? array_keys($this->modifiedColumns) : [];
    }

    /**
     * Returns whether the object has ever been saved.  This will
     * be false, if the object was retrieved from storage or was created
     * and then saved.
     *
     * @return bool True, if the object has never been persisted.
     */
    public function isNew(): bool
    {
        return $this->new;
    }

    /**
     * Setter for the isNew attribute.  This method will be called
     * by Propel-generated children and objects.
     *
     * @param bool $b the state of the object.
     */
    public function setNew(bool $b): void
    {
        $this->new = $b;
    }

    /**
     * Whether this object has been deleted.
     * @return bool The deleted state of this object.
     */
    public function isDeleted(): bool
    {
        return $this->deleted;
    }

    /**
     * Specify whether this object has been deleted.
     * @param bool $b The deleted state of this object.
     * @return void
     */
    public function setDeleted(bool $b): void
    {
        $this->deleted = $b;
    }

    /**
     * Sets the modified state for the object to be false.
     * @param string $col If supplied, only the specified column is reset.
     * @return void
     */
    public function resetModified(?string $col = null): void
    {
        if (null !== $col) {
            unset($this->modifiedColumns[$col]);
        } else {
            $this->modifiedColumns = [];
        }
    }

    /**
     * Compares this with another <code>Cfa</code> instance.  If
     * <code>obj</code> is an instance of <code>Cfa</code>, delegates to
     * <code>equals(Cfa)</code>.  Otherwise, returns <code>false</code>.
     *
     * @param mixed $obj The object to compare to.
     * @return bool Whether equal to the object specified.
     */
    public function equals($obj): bool
    {
        if (!$obj instanceof static) {
            return false;
        }

        if ($this === $obj) {
            return true;
        }

        if (null === $this->getPrimaryKey() || null === $obj->getPrimaryKey()) {
            return false;
        }

        return $this->getPrimaryKey() === $obj->getPrimaryKey();
    }

    /**
     * Get the associative array of the virtual columns in this object
     *
     * @return array
     */
    public function getVirtualColumns(): array
    {
        return $this->virtualColumns;
    }

    /**
     * Checks the existence of a virtual column in this object
     *
     * @param string $name The virtual column name
     * @return bool
     */
    public function hasVirtualColumn(string $name): bool
    {
        return array_key_exists($name, $this->virtualColumns);
    }

    /**
     * Get the value of a virtual column in this object
     *
     * @param string $name The virtual column name
     * @return mixed
     *
     * @throws \Propel\Runtime\Exception\PropelException
     */
    public function getVirtualColumn(string $name)
    {
        if (!$this->hasVirtualColumn($name)) {
            throw new PropelException(sprintf('Cannot get value of nonexistent virtual column `%s`.', $name));
        }

        return $this->virtualColumns[$name];
    }

    /**
     * Set the value of a virtual column in this object
     *
     * @param string $name The virtual column name
     * @param mixed $value The value to give to the virtual column
     *
     * @return $this The current object, for fluid interface
     */
    public function setVirtualColumn(string $name, $value)
    {
        $this->virtualColumns[$name] = $value;

        return $this;
    }

    /**
     * Logs a message using Propel::log().
     *
     * @param string $msg
     * @param int $priority One of the Propel::LOG_* logging levels
     * @return void
     */
    protected function log(string $msg, int $priority = Propel::LOG_INFO): void
    {
        Propel::log(get_class($this) . ': ' . $msg, $priority);
    }

    /**
     * Export the current object properties to a string, using a given parser format
     * <code>
     * $book = BookQuery::create()->findPk(9012);
     * echo $book->exportTo('JSON');
     *  => {"Id":9012,"Title":"Don Juan","ISBN":"0140422161","Price":12.99,"PublisherId":1234,"AuthorId":5678}');
     * </code>
     *
     * @param \Propel\Runtime\Parser\AbstractParser|string $parser An AbstractParser instance, or a format name ('XML', 'YAML', 'JSON', 'CSV')
     * @param bool $includeLazyLoadColumns (optional) Whether to include lazy load(ed) columns. Defaults to TRUE.
     * @param string $keyType (optional) One of the class type constants TableMap::TYPE_PHPNAME, TableMap::TYPE_CAMELNAME, TableMap::TYPE_COLNAME, TableMap::TYPE_FIELDNAME, TableMap::TYPE_NUM. Defaults to TableMap::TYPE_PHPNAME.
     * @return string The exported data
     */
    public function exportTo($parser, bool $includeLazyLoadColumns = true, string $keyType = TableMap::TYPE_PHPNAME): string
    {
        if (!$parser instanceof AbstractParser) {
            $parser = AbstractParser::getParser($parser);
        }

        return $parser->fromArray($this->toArray($keyType, $includeLazyLoadColumns, array(), true));
    }

    /**
     * Clean up internal collections prior to serializing
     * Avoids recursive loops that turn into segmentation faults when serializing
     *
     * @return array<string>
     */
    public function __sleep(): array
    {
        $this->clearAllReferences();

        $cls = new \ReflectionClass($this);
        $propertyNames = [];
        $serializableProperties = array_diff($cls->getProperties(), $cls->getProperties(\ReflectionProperty::IS_STATIC));

        foreach($serializableProperties as $property) {
            $propertyNames[] = $property->getName();
        }

        return $propertyNames;
    }

    /**
     * Get the [record_id] column value.
     *
     * @return int
     */
    public function getRecordId()
    {
        return $this->record_id;
    }

    /**
     * Get the [optionally formatted] temporal [created_at] column value.
     *
     *
     * @param string|null $format The date/time format string (either date()-style or strftime()-style).
     *   If format is NULL, then the raw DateTime object will be returned.
     *
     * @return string|DateTime Formatted date/time value as string or DateTime object (if format is NULL), and 0 if column value is 0000-00-00 00:00:00.
     *
     * @throws \Propel\Runtime\Exception\PropelException - if unable to parse/validate the date/time value.
     *
     * @psalm-return ($format is null ? DateTime : string)
     */
    public function getCreatedAt($format = null)
    {
        if ($format === null) {
            return $this->created_at;
        } else {
            return $this->created_at instanceof \DateTimeInterface ? $this->created_at->format($format) : null;
        }
    }

    /**
     * Get the [optionally formatted] temporal [updated_at] column value.
     *
     *
     * @param string|null $format The date/time format string (either date()-style or strftime()-style).
     *   If format is NULL, then the raw DateTime object will be returned.
     *
     * @return string|DateTime Formatted date/time value as string or DateTime object (if format is NULL), and 0 if column value is 0000-00-00 00:00:00.
     *
     * @throws \Propel\Runtime\Exception\PropelException - if unable to parse/validate the date/time value.
     *
     * @psalm-return ($format is null ? DateTime : string)
     */
    public function getUpdatedAt($format = null)
    {
        if ($format === null) {
            return $this->updated_at;
        } else {
            return $this->updated_at instanceof \DateTimeInterface ? $this->updated_at->format($format) : null;
        }
    }

    /**
     * Get the [piece_id] column value.
     *
     * @return int
     */
    public function getPieceId()
    {
        return $this->piece_id;
    }

    /**
     * Get the [piece_id_run] column value.
     *
     * @return int|null
     */
    public function getPieceIdRun()
    {
        return $this->piece_id_run;
    }

    /**
     * Get the [piece_id_count] column value.
     *
     * @return int|null
     */
    public function getPieceIdCount()
    {
        return $this->piece_id_count;
    }

    /**
     * Get the [print_company] column value.
     *
     * @return string|null
     */
    public function getPrintCompany()
    {
        return $this->print_company;
    }

    /**
     * Get the [print_date_sent] column value.
     *
     * @return string|null
     */
    public function getPrintDateSent()
    {
        return $this->print_date_sent;
    }

    /**
     * Get the [print_date_receipt] column value.
     *
     * @return string|null
     */
    public function getPrintDateReceipt()
    {
        return $this->print_date_receipt;
    }

    /**
     * Get the [print_medium] column value.
     *
     * @return string|null
     */
    public function getPrintMedium()
    {
        return $this->print_medium;
    }

    /**
     * Get the [print_cost] column value.
     *
     * @return string|null
     */
    public function getPrintCost()
    {
        return $this->print_cost;
    }

    /**
     * Get the [print_notes] column value.
     *
     * @return string|null
     */
    public function getPrintNotes()
    {
        return $this->print_notes;
    }

    /**
     * Get the [buyer_name] column value.
     *
     * @return string|null
     */
    public function getBuyerName()
    {
        return $this->buyer_name;
    }

    /**
     * Get the [buyer_location] column value.
     *
     * @return string|null
     */
    public function getBuyerLocation()
    {
        return $this->buyer_location;
    }

    /**
     * Get the [buyer_date_purchase] column value.
     *
     * @return string|null
     */
    public function getBuyerDatePurchase()
    {
        return $this->buyer_date_purchase;
    }

    /**
     * Get the [buyer_date_receipt] column value.
     *
     * @return string|null
     */
    public function getBuyerDateReceipt()
    {
        return $this->buyer_date_receipt;
    }

    /**
     * Get the [notes] column value.
     *
     * @return string|null
     */
    public function getNotes()
    {
        return $this->notes;
    }

    /**
     * Set the value of [record_id] column.
     *
     * @param int $v New value
     * @return $this The current object (for fluent API support)
     */
    public function setRecordId($v)
    {
        if ($v !== null) {
            $v = (int) $v;
        }

        if ($this->record_id !== $v) {
            $this->record_id = $v;
            $this->modifiedColumns[CfaTableMap::COL_RECORD_ID] = true;
        }

        return $this;
    }

    /**
     * Sets the value of [created_at] column to a normalized version of the date/time value specified.
     *
     * @param string|integer|\DateTimeInterface $v string, integer (timestamp), or \DateTimeInterface value.
     *               Empty strings are treated as NULL.
     * @return $this The current object (for fluent API support)
     */
    public function setCreatedAt($v)
    {
        $dt = PropelDateTime::newInstance($v, null, 'DateTime');
        if ($this->created_at !== null || $dt !== null) {
            if ($this->created_at === null || $dt === null || $dt->format("Y-m-d H:i:s.u") !== $this->created_at->format("Y-m-d H:i:s.u")) {
                $this->created_at = $dt === null ? null : clone $dt;
                $this->modifiedColumns[CfaTableMap::COL_CREATED_AT] = true;
            }
        } // if either are not null

        return $this;
    }

    /**
     * Sets the value of [updated_at] column to a normalized version of the date/time value specified.
     *
     * @param string|integer|\DateTimeInterface $v string, integer (timestamp), or \DateTimeInterface value.
     *               Empty strings are treated as NULL.
     * @return $this The current object (for fluent API support)
     */
    public function setUpdatedAt($v)
    {
        $dt = PropelDateTime::newInstance($v, null, 'DateTime');
        if ($this->updated_at !== null || $dt !== null) {
            if ($this->updated_at === null || $dt === null || $dt->format("Y-m-d H:i:s.u") !== $this->updated_at->format("Y-m-d H:i:s.u")) {
                $this->updated_at = $dt === null ? null : clone $dt;
                $this->modifiedColumns[CfaTableMap::COL_UPDATED_AT] = true;
            }
        } // if either are not null

        return $this;
    }

    /**
     * Set the value of [piece_id] column.
     *
     * @param int $v New value
     * @return $this The current object (for fluent API support)
     */
    public function setPieceId($v)
    {
        if ($v !== null) {
            $v = (int) $v;
        }

        if ($this->piece_id !== $v) {
            $this->piece_id = $v;
            $this->modifiedColumns[CfaTableMap::COL_PIECE_ID] = true;
        }

        return $this;
    }

    /**
     * Set the value of [piece_id_run] column.
     *
     * @param int|null $v New value
     * @return $this The current object (for fluent API support)
     */
    public function setPieceIdRun($v)
    {
        if ($v !== null) {
            $v = (int) $v;
        }

        if ($this->piece_id_run !== $v) {
            $this->piece_id_run = $v;
            $this->modifiedColumns[CfaTableMap::COL_PIECE_ID_RUN] = true;
        }

        return $this;
    }

    /**
     * Set the value of [piece_id_count] column.
     *
     * @param int|null $v New value
     * @return $this The current object (for fluent API support)
     */
    public function setPieceIdCount($v)
    {
        if ($v !== null) {
            $v = (int) $v;
        }

        if ($this->piece_id_count !== $v) {
            $this->piece_id_count = $v;
            $this->modifiedColumns[CfaTableMap::COL_PIECE_ID_COUNT] = true;
        }

        return $this;
    }

    /**
     * Set the value of [print_company] column.
     *
     * @param string|null $v New value
     * @return $this The current object (for fluent API support)
     */
    public function setPrintCompany($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->print_company !== $v) {
            $this->print_company = $v;
            $this->modifiedColumns[CfaTableMap::COL_PRINT_COMPANY] = true;
        }

        return $this;
    }

    /**
     * Set the value of [print_date_sent] column.
     *
     * @param string|null $v New value
     * @return $this The current object (for fluent API support)
     */
    public function setPrintDateSent($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->print_date_sent !== $v) {
            $this->print_date_sent = $v;
            $this->modifiedColumns[CfaTableMap::COL_PRINT_DATE_SENT] = true;
        }

        return $this;
    }

    /**
     * Set the value of [print_date_receipt] column.
     *
     * @param string|null $v New value
     * @return $this The current object (for fluent API support)
     */
    public function setPrintDateReceipt($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->print_date_receipt !== $v) {
            $this->print_date_receipt = $v;
            $this->modifiedColumns[CfaTableMap::COL_PRINT_DATE_RECEIPT] = true;
        }

        return $this;
    }

    /**
     * Set the value of [print_medium] column.
     *
     * @param string|null $v New value
     * @return $this The current object (for fluent API support)
     */
    public function setPrintMedium($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->print_medium !== $v) {
            $this->print_medium = $v;
            $this->modifiedColumns[CfaTableMap::COL_PRINT_MEDIUM] = true;
        }

        return $this;
    }

    /**
     * Set the value of [print_cost] column.
     *
     * @param string|null $v New value
     * @return $this The current object (for fluent API support)
     */
    public function setPrintCost($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->print_cost !== $v) {
            $this->print_cost = $v;
            $this->modifiedColumns[CfaTableMap::COL_PRINT_COST] = true;
        }

        return $this;
    }

    /**
     * Set the value of [print_notes] column.
     *
     * @param string|null $v New value
     * @return $this The current object (for fluent API support)
     */
    public function setPrintNotes($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->print_notes !== $v) {
            $this->print_notes = $v;
            $this->modifiedColumns[CfaTableMap::COL_PRINT_NOTES] = true;
        }

        return $this;
    }

    /**
     * Set the value of [buyer_name] column.
     *
     * @param string|null $v New value
     * @return $this The current object (for fluent API support)
     */
    public function setBuyerName($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->buyer_name !== $v) {
            $this->buyer_name = $v;
            $this->modifiedColumns[CfaTableMap::COL_BUYER_NAME] = true;
        }

        return $this;
    }

    /**
     * Set the value of [buyer_location] column.
     *
     * @param string|null $v New value
     * @return $this The current object (for fluent API support)
     */
    public function setBuyerLocation($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->buyer_location !== $v) {
            $this->buyer_location = $v;
            $this->modifiedColumns[CfaTableMap::COL_BUYER_LOCATION] = true;
        }

        return $this;
    }

    /**
     * Set the value of [buyer_date_purchase] column.
     *
     * @param string|null $v New value
     * @return $this The current object (for fluent API support)
     */
    public function setBuyerDatePurchase($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->buyer_date_purchase !== $v) {
            $this->buyer_date_purchase = $v;
            $this->modifiedColumns[CfaTableMap::COL_BUYER_DATE_PURCHASE] = true;
        }

        return $this;
    }

    /**
     * Set the value of [buyer_date_receipt] column.
     *
     * @param string|null $v New value
     * @return $this The current object (for fluent API support)
     */
    public function setBuyerDateReceipt($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->buyer_date_receipt !== $v) {
            $this->buyer_date_receipt = $v;
            $this->modifiedColumns[CfaTableMap::COL_BUYER_DATE_RECEIPT] = true;
        }

        return $this;
    }

    /**
     * Set the value of [notes] column.
     *
     * @param string|null $v New value
     * @return $this The current object (for fluent API support)
     */
    public function setNotes($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->notes !== $v) {
            $this->notes = $v;
            $this->modifiedColumns[CfaTableMap::COL_NOTES] = true;
        }

        return $this;
    }

    /**
     * Indicates whether the columns in this object are only set to default values.
     *
     * This method can be used in conjunction with isModified() to indicate whether an object is both
     * modified _and_ has some values set which are non-default.
     *
     * @return bool Whether the columns in this object are only been set with default values.
     */
    public function hasOnlyDefaultValues(): bool
    {
        // otherwise, everything was equal, so return TRUE
        return true;
    }

    /**
     * Hydrates (populates) the object variables with values from the database resultset.
     *
     * An offset (0-based "start column") is specified so that objects can be hydrated
     * with a subset of the columns in the resultset rows.  This is needed, for example,
     * for results of JOIN queries where the resultset row includes columns from two or
     * more tables.
     *
     * @param array $row The row returned by DataFetcher->fetch().
     * @param int $startcol 0-based offset column which indicates which resultset column to start with.
     * @param bool $rehydrate Whether this object is being re-hydrated from the database.
     * @param string $indexType The index type of $row. Mostly DataFetcher->getIndexType().
                                  One of the class type constants TableMap::TYPE_PHPNAME, TableMap::TYPE_CAMELNAME
     *                            TableMap::TYPE_COLNAME, TableMap::TYPE_FIELDNAME, TableMap::TYPE_NUM.
     *
     * @return int next starting column
     * @throws \Propel\Runtime\Exception\PropelException - Any caught Exception will be rewrapped as a PropelException.
     */
    public function hydrate(array $row, int $startcol = 0, bool $rehydrate = false, string $indexType = TableMap::TYPE_NUM): int
    {
        try {

            $col = $row[TableMap::TYPE_NUM == $indexType ? 0 + $startcol : CfaTableMap::translateFieldName('RecordId', TableMap::TYPE_PHPNAME, $indexType)];
            $this->record_id = (null !== $col) ? (int) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 1 + $startcol : CfaTableMap::translateFieldName('CreatedAt', TableMap::TYPE_PHPNAME, $indexType)];
            if ($col === '0000-00-00 00:00:00') {
                $col = null;
            }
            $this->created_at = (null !== $col) ? PropelDateTime::newInstance($col, null, 'DateTime') : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 2 + $startcol : CfaTableMap::translateFieldName('UpdatedAt', TableMap::TYPE_PHPNAME, $indexType)];
            if ($col === '0000-00-00 00:00:00') {
                $col = null;
            }
            $this->updated_at = (null !== $col) ? PropelDateTime::newInstance($col, null, 'DateTime') : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 3 + $startcol : CfaTableMap::translateFieldName('PieceId', TableMap::TYPE_PHPNAME, $indexType)];
            $this->piece_id = (null !== $col) ? (int) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 4 + $startcol : CfaTableMap::translateFieldName('PieceIdRun', TableMap::TYPE_PHPNAME, $indexType)];
            $this->piece_id_run = (null !== $col) ? (int) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 5 + $startcol : CfaTableMap::translateFieldName('PieceIdCount', TableMap::TYPE_PHPNAME, $indexType)];
            $this->piece_id_count = (null !== $col) ? (int) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 6 + $startcol : CfaTableMap::translateFieldName('PrintCompany', TableMap::TYPE_PHPNAME, $indexType)];
            $this->print_company = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 7 + $startcol : CfaTableMap::translateFieldName('PrintDateSent', TableMap::TYPE_PHPNAME, $indexType)];
            $this->print_date_sent = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 8 + $startcol : CfaTableMap::translateFieldName('PrintDateReceipt', TableMap::TYPE_PHPNAME, $indexType)];
            $this->print_date_receipt = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 9 + $startcol : CfaTableMap::translateFieldName('PrintMedium', TableMap::TYPE_PHPNAME, $indexType)];
            $this->print_medium = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 10 + $startcol : CfaTableMap::translateFieldName('PrintCost', TableMap::TYPE_PHPNAME, $indexType)];
            $this->print_cost = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 11 + $startcol : CfaTableMap::translateFieldName('PrintNotes', TableMap::TYPE_PHPNAME, $indexType)];
            $this->print_notes = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 12 + $startcol : CfaTableMap::translateFieldName('BuyerName', TableMap::TYPE_PHPNAME, $indexType)];
            $this->buyer_name = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 13 + $startcol : CfaTableMap::translateFieldName('BuyerLocation', TableMap::TYPE_PHPNAME, $indexType)];
            $this->buyer_location = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 14 + $startcol : CfaTableMap::translateFieldName('BuyerDatePurchase', TableMap::TYPE_PHPNAME, $indexType)];
            $this->buyer_date_purchase = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 15 + $startcol : CfaTableMap::translateFieldName('BuyerDateReceipt', TableMap::TYPE_PHPNAME, $indexType)];
            $this->buyer_date_receipt = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 16 + $startcol : CfaTableMap::translateFieldName('Notes', TableMap::TYPE_PHPNAME, $indexType)];
            $this->notes = (null !== $col) ? (string) $col : null;

            $this->resetModified();
            $this->setNew(false);

            if ($rehydrate) {
                $this->ensureConsistency();
            }

            return $startcol + 17; // 17 = CfaTableMap::NUM_HYDRATE_COLUMNS.

        } catch (Exception $e) {
            throw new PropelException(sprintf('Error populating %s object', '\\Art\\Cfa'), 0, $e);
        }
    }

    /**
     * Checks and repairs the internal consistency of the object.
     *
     * This method is executed after an already-instantiated object is re-hydrated
     * from the database.  It exists to check any foreign keys to make sure that
     * the objects related to the current object are correct based on foreign key.
     *
     * You can override this method in the stub class, but you should always invoke
     * the base method from the overridden method (i.e. parent::ensureConsistency()),
     * in case your model changes.
     *
     * @throws \Propel\Runtime\Exception\PropelException
     * @return void
     */
    public function ensureConsistency(): void
    {
    }

    /**
     * Reloads this object from datastore based on primary key and (optionally) resets all associated objects.
     *
     * This will only work if the object has been saved and has a valid primary key set.
     *
     * @param bool $deep (optional) Whether to also de-associated any related objects.
     * @param ConnectionInterface $con (optional) The ConnectionInterface connection to use.
     * @return void
     * @throws \Propel\Runtime\Exception\PropelException - if this object is deleted, unsaved or doesn't have pk match in db
     */
    public function reload(bool $deep = false, ?ConnectionInterface $con = null): void
    {
        if ($this->isDeleted()) {
            throw new PropelException("Cannot reload a deleted object.");
        }

        if ($this->isNew()) {
            throw new PropelException("Cannot reload an unsaved object.");
        }

        if ($con === null) {
            $con = Propel::getServiceContainer()->getReadConnection(CfaTableMap::DATABASE_NAME);
        }

        // We don't need to alter the object instance pool; we're just modifying this instance
        // already in the pool.

        $dataFetcher = ChildCfaQuery::create(null, $this->buildPkeyCriteria())->setFormatter(ModelCriteria::FORMAT_STATEMENT)->find($con);
        $row = $dataFetcher->fetch();
        $dataFetcher->close();
        if (!$row) {
            throw new PropelException('Cannot find matching row in the database to reload object values.');
        }
        $this->hydrate($row, 0, true, $dataFetcher->getIndexType()); // rehydrate

        if ($deep) {  // also de-associate any related objects?

        } // if (deep)
    }

    /**
     * Removes this object from datastore and sets delete attribute.
     *
     * @param ConnectionInterface $con
     * @return void
     * @throws \Propel\Runtime\Exception\PropelException
     * @see Cfa::setDeleted()
     * @see Cfa::isDeleted()
     */
    public function delete(?ConnectionInterface $con = null): void
    {
        if ($this->isDeleted()) {
            throw new PropelException("This object has already been deleted.");
        }

        if ($con === null) {
            $con = Propel::getServiceContainer()->getWriteConnection(CfaTableMap::DATABASE_NAME);
        }

        $con->transaction(function () use ($con) {
            $deleteQuery = ChildCfaQuery::create()
                ->filterByPrimaryKey($this->getPrimaryKey());
            $ret = $this->preDelete($con);
            if ($ret) {
                $deleteQuery->delete($con);
                $this->postDelete($con);
                $this->setDeleted(true);
            }
        });
    }

    /**
     * Persists this object to the database.
     *
     * If the object is new, it inserts it; otherwise an update is performed.
     * All modified related objects will also be persisted in the doSave()
     * method.  This method wraps all precipitate database operations in a
     * single transaction.
     *
     * @param ConnectionInterface $con
     * @return int The number of rows affected by this insert/update and any referring fk objects' save() operations.
     * @throws \Propel\Runtime\Exception\PropelException
     * @see doSave()
     */
    public function save(?ConnectionInterface $con = null): int
    {
        if ($this->isDeleted()) {
            throw new PropelException("You cannot save an object that has been deleted.");
        }

        if ($this->alreadyInSave) {
            return 0;
        }

        if ($con === null) {
            $con = Propel::getServiceContainer()->getWriteConnection(CfaTableMap::DATABASE_NAME);
        }

        return $con->transaction(function () use ($con) {
            $ret = $this->preSave($con);
            $isInsert = $this->isNew();
            if ($isInsert) {
                $ret = $ret && $this->preInsert($con);
            } else {
                $ret = $ret && $this->preUpdate($con);
            }
            if ($ret) {
                $affectedRows = $this->doSave($con);
                if ($isInsert) {
                    $this->postInsert($con);
                } else {
                    $this->postUpdate($con);
                }
                $this->postSave($con);
                CfaTableMap::addInstanceToPool($this);
            } else {
                $affectedRows = 0;
            }

            return $affectedRows;
        });
    }

    /**
     * Performs the work of inserting or updating the row in the database.
     *
     * If the object is new, it inserts it; otherwise an update is performed.
     * All related objects are also updated in this method.
     *
     * @param ConnectionInterface $con
     * @return int The number of rows affected by this insert/update and any referring fk objects' save() operations.
     * @throws \Propel\Runtime\Exception\PropelException
     * @see save()
     */
    protected function doSave(ConnectionInterface $con): int
    {
        $affectedRows = 0; // initialize var to track total num of affected rows
        if (!$this->alreadyInSave) {
            $this->alreadyInSave = true;

            if ($this->isNew() || $this->isModified()) {
                // persist changes
                if ($this->isNew()) {
                    $this->doInsert($con);
                    $affectedRows += 1;
                } else {
                    $affectedRows += $this->doUpdate($con);
                }
                $this->resetModified();
            }

            $this->alreadyInSave = false;

        }

        return $affectedRows;
    }

    /**
     * Insert the row in the database.
     *
     * @param ConnectionInterface $con
     *
     * @throws \Propel\Runtime\Exception\PropelException
     * @see doSave()
     */
    protected function doInsert(ConnectionInterface $con): void
    {
        $modifiedColumns = [];
        $index = 0;

        $this->modifiedColumns[CfaTableMap::COL_RECORD_ID] = true;
        if (null !== $this->record_id) {
            throw new PropelException('Cannot insert a value for auto-increment primary key (' . CfaTableMap::COL_RECORD_ID . ')');
        }

         // check the columns in natural order for more readable SQL queries
        if ($this->isColumnModified(CfaTableMap::COL_RECORD_ID)) {
            $modifiedColumns[':p' . $index++]  = 'record_id';
        }
        if ($this->isColumnModified(CfaTableMap::COL_CREATED_AT)) {
            $modifiedColumns[':p' . $index++]  = 'created_at';
        }
        if ($this->isColumnModified(CfaTableMap::COL_UPDATED_AT)) {
            $modifiedColumns[':p' . $index++]  = 'updated_at';
        }
        if ($this->isColumnModified(CfaTableMap::COL_PIECE_ID)) {
            $modifiedColumns[':p' . $index++]  = 'piece_id';
        }
        if ($this->isColumnModified(CfaTableMap::COL_PIECE_ID_RUN)) {
            $modifiedColumns[':p' . $index++]  = 'piece_id_run';
        }
        if ($this->isColumnModified(CfaTableMap::COL_PIECE_ID_COUNT)) {
            $modifiedColumns[':p' . $index++]  = 'piece_id_count';
        }
        if ($this->isColumnModified(CfaTableMap::COL_PRINT_COMPANY)) {
            $modifiedColumns[':p' . $index++]  = 'print_company';
        }
        if ($this->isColumnModified(CfaTableMap::COL_PRINT_DATE_SENT)) {
            $modifiedColumns[':p' . $index++]  = 'print_date_sent';
        }
        if ($this->isColumnModified(CfaTableMap::COL_PRINT_DATE_RECEIPT)) {
            $modifiedColumns[':p' . $index++]  = 'print_date_receipt';
        }
        if ($this->isColumnModified(CfaTableMap::COL_PRINT_MEDIUM)) {
            $modifiedColumns[':p' . $index++]  = 'print_medium';
        }
        if ($this->isColumnModified(CfaTableMap::COL_PRINT_COST)) {
            $modifiedColumns[':p' . $index++]  = 'print_cost';
        }
        if ($this->isColumnModified(CfaTableMap::COL_PRINT_NOTES)) {
            $modifiedColumns[':p' . $index++]  = 'print_notes';
        }
        if ($this->isColumnModified(CfaTableMap::COL_BUYER_NAME)) {
            $modifiedColumns[':p' . $index++]  = 'buyer_name';
        }
        if ($this->isColumnModified(CfaTableMap::COL_BUYER_LOCATION)) {
            $modifiedColumns[':p' . $index++]  = 'buyer_location';
        }
        if ($this->isColumnModified(CfaTableMap::COL_BUYER_DATE_PURCHASE)) {
            $modifiedColumns[':p' . $index++]  = 'buyer_date_purchase';
        }
        if ($this->isColumnModified(CfaTableMap::COL_BUYER_DATE_RECEIPT)) {
            $modifiedColumns[':p' . $index++]  = 'buyer_date_receipt';
        }
        if ($this->isColumnModified(CfaTableMap::COL_NOTES)) {
            $modifiedColumns[':p' . $index++]  = 'notes';
        }

        $sql = sprintf(
            'INSERT INTO cfa (%s) VALUES (%s)',
            implode(', ', $modifiedColumns),
            implode(', ', array_keys($modifiedColumns))
        );

        try {
            $stmt = $con->prepare($sql);
            foreach ($modifiedColumns as $identifier => $columnName) {
                switch ($columnName) {
                    case 'record_id':
                        $stmt->bindValue($identifier, $this->record_id, PDO::PARAM_INT);

                        break;
                    case 'created_at':
                        $stmt->bindValue($identifier, $this->created_at ? $this->created_at->format("Y-m-d H:i:s.u") : null, PDO::PARAM_STR);

                        break;
                    case 'updated_at':
                        $stmt->bindValue($identifier, $this->updated_at ? $this->updated_at->format("Y-m-d H:i:s.u") : null, PDO::PARAM_STR);

                        break;
                    case 'piece_id':
                        $stmt->bindValue($identifier, $this->piece_id, PDO::PARAM_INT);

                        break;
                    case 'piece_id_run':
                        $stmt->bindValue($identifier, $this->piece_id_run, PDO::PARAM_INT);

                        break;
                    case 'piece_id_count':
                        $stmt->bindValue($identifier, $this->piece_id_count, PDO::PARAM_INT);

                        break;
                    case 'print_company':
                        $stmt->bindValue($identifier, $this->print_company, PDO::PARAM_STR);

                        break;
                    case 'print_date_sent':
                        $stmt->bindValue($identifier, $this->print_date_sent, PDO::PARAM_STR);

                        break;
                    case 'print_date_receipt':
                        $stmt->bindValue($identifier, $this->print_date_receipt, PDO::PARAM_STR);

                        break;
                    case 'print_medium':
                        $stmt->bindValue($identifier, $this->print_medium, PDO::PARAM_STR);

                        break;
                    case 'print_cost':
                        $stmt->bindValue($identifier, $this->print_cost, PDO::PARAM_STR);

                        break;
                    case 'print_notes':
                        $stmt->bindValue($identifier, $this->print_notes, PDO::PARAM_STR);

                        break;
                    case 'buyer_name':
                        $stmt->bindValue($identifier, $this->buyer_name, PDO::PARAM_STR);

                        break;
                    case 'buyer_location':
                        $stmt->bindValue($identifier, $this->buyer_location, PDO::PARAM_STR);

                        break;
                    case 'buyer_date_purchase':
                        $stmt->bindValue($identifier, $this->buyer_date_purchase, PDO::PARAM_STR);

                        break;
                    case 'buyer_date_receipt':
                        $stmt->bindValue($identifier, $this->buyer_date_receipt, PDO::PARAM_STR);

                        break;
                    case 'notes':
                        $stmt->bindValue($identifier, $this->notes, PDO::PARAM_STR);

                        break;
                }
            }
            $stmt->execute();
        } catch (Exception $e) {
            Propel::log($e->getMessage(), Propel::LOG_ERR);
            throw new PropelException(sprintf('Unable to execute INSERT statement [%s]', $sql), 0, $e);
        }

        try {
            $pk = $con->lastInsertId();
        } catch (Exception $e) {
            throw new PropelException('Unable to get autoincrement id.', 0, $e);
        }
        $this->setRecordId($pk);

        $this->setNew(false);
    }

    /**
     * Update the row in the database.
     *
     * @param ConnectionInterface $con
     *
     * @return int Number of updated rows
     * @see doSave()
     */
    protected function doUpdate(ConnectionInterface $con): int
    {
        $selectCriteria = $this->buildPkeyCriteria();
        $valuesCriteria = $this->buildCriteria();

        return $selectCriteria->doUpdate($valuesCriteria, $con);
    }

    /**
     * Retrieves a field from the object by name passed in as a string.
     *
     * @param string $name name
     * @param string $type The type of fieldname the $name is of:
     *                     one of the class type constants TableMap::TYPE_PHPNAME, TableMap::TYPE_CAMELNAME
     *                     TableMap::TYPE_COLNAME, TableMap::TYPE_FIELDNAME, TableMap::TYPE_NUM.
     *                     Defaults to TableMap::TYPE_PHPNAME.
     * @return mixed Value of field.
     */
    public function getByName(string $name, string $type = TableMap::TYPE_PHPNAME)
    {
        $pos = CfaTableMap::translateFieldName($name, $type, TableMap::TYPE_NUM);
        $field = $this->getByPosition($pos);

        return $field;
    }

    /**
     * Retrieves a field from the object by Position as specified in the xml schema.
     * Zero-based.
     *
     * @param int $pos Position in XML schema
     * @return mixed Value of field at $pos
     */
    public function getByPosition(int $pos)
    {
        switch ($pos) {
            case 0:
                return $this->getRecordId();

            case 1:
                return $this->getCreatedAt();

            case 2:
                return $this->getUpdatedAt();

            case 3:
                return $this->getPieceId();

            case 4:
                return $this->getPieceIdRun();

            case 5:
                return $this->getPieceIdCount();

            case 6:
                return $this->getPrintCompany();

            case 7:
                return $this->getPrintDateSent();

            case 8:
                return $this->getPrintDateReceipt();

            case 9:
                return $this->getPrintMedium();

            case 10:
                return $this->getPrintCost();

            case 11:
                return $this->getPrintNotes();

            case 12:
                return $this->getBuyerName();

            case 13:
                return $this->getBuyerLocation();

            case 14:
                return $this->getBuyerDatePurchase();

            case 15:
                return $this->getBuyerDateReceipt();

            case 16:
                return $this->getNotes();

            default:
                return null;
        } // switch()
    }

    /**
     * Exports the object as an array.
     *
     * You can specify the key type of the array by passing one of the class
     * type constants.
     *
     * @param string $keyType (optional) One of the class type constants TableMap::TYPE_PHPNAME, TableMap::TYPE_CAMELNAME,
     *                    TableMap::TYPE_COLNAME, TableMap::TYPE_FIELDNAME, TableMap::TYPE_NUM.
     *                    Defaults to TableMap::TYPE_PHPNAME.
     * @param bool $includeLazyLoadColumns (optional) Whether to include lazy loaded columns. Defaults to TRUE.
     * @param array $alreadyDumpedObjects List of objects to skip to avoid recursion
     *
     * @return array An associative array containing the field names (as keys) and field values
     */
    public function toArray(string $keyType = TableMap::TYPE_PHPNAME, bool $includeLazyLoadColumns = true, array $alreadyDumpedObjects = []): array
    {
        if (isset($alreadyDumpedObjects['Cfa'][$this->hashCode()])) {
            return ['*RECURSION*'];
        }
        $alreadyDumpedObjects['Cfa'][$this->hashCode()] = true;
        $keys = CfaTableMap::getFieldNames($keyType);
        $result = [
            $keys[0] => $this->getRecordId(),
            $keys[1] => $this->getCreatedAt(),
            $keys[2] => $this->getUpdatedAt(),
            $keys[3] => $this->getPieceId(),
            $keys[4] => $this->getPieceIdRun(),
            $keys[5] => $this->getPieceIdCount(),
            $keys[6] => $this->getPrintCompany(),
            $keys[7] => $this->getPrintDateSent(),
            $keys[8] => $this->getPrintDateReceipt(),
            $keys[9] => $this->getPrintMedium(),
            $keys[10] => $this->getPrintCost(),
            $keys[11] => $this->getPrintNotes(),
            $keys[12] => $this->getBuyerName(),
            $keys[13] => $this->getBuyerLocation(),
            $keys[14] => $this->getBuyerDatePurchase(),
            $keys[15] => $this->getBuyerDateReceipt(),
            $keys[16] => $this->getNotes(),
        ];
        if ($result[$keys[1]] instanceof \DateTimeInterface) {
            $result[$keys[1]] = $result[$keys[1]]->format('Y-m-d H:i:s.u');
        }

        if ($result[$keys[2]] instanceof \DateTimeInterface) {
            $result[$keys[2]] = $result[$keys[2]]->format('Y-m-d H:i:s.u');
        }

        $virtualColumns = $this->virtualColumns;
        foreach ($virtualColumns as $key => $virtualColumn) {
            $result[$key] = $virtualColumn;
        }


        return $result;
    }

    /**
     * Sets a field from the object by name passed in as a string.
     *
     * @param string $name
     * @param mixed $value field value
     * @param string $type The type of fieldname the $name is of:
     *                one of the class type constants TableMap::TYPE_PHPNAME, TableMap::TYPE_CAMELNAME
     *                TableMap::TYPE_COLNAME, TableMap::TYPE_FIELDNAME, TableMap::TYPE_NUM.
     *                Defaults to TableMap::TYPE_PHPNAME.
     * @return $this
     */
    public function setByName(string $name, $value, string $type = TableMap::TYPE_PHPNAME)
    {
        $pos = CfaTableMap::translateFieldName($name, $type, TableMap::TYPE_NUM);

        $this->setByPosition($pos, $value);

        return $this;
    }

    /**
     * Sets a field from the object by Position as specified in the xml schema.
     * Zero-based.
     *
     * @param int $pos position in xml schema
     * @param mixed $value field value
     * @return $this
     */
    public function setByPosition(int $pos, $value)
    {
        switch ($pos) {
            case 0:
                $this->setRecordId($value);
                break;
            case 1:
                $this->setCreatedAt($value);
                break;
            case 2:
                $this->setUpdatedAt($value);
                break;
            case 3:
                $this->setPieceId($value);
                break;
            case 4:
                $this->setPieceIdRun($value);
                break;
            case 5:
                $this->setPieceIdCount($value);
                break;
            case 6:
                $this->setPrintCompany($value);
                break;
            case 7:
                $this->setPrintDateSent($value);
                break;
            case 8:
                $this->setPrintDateReceipt($value);
                break;
            case 9:
                $this->setPrintMedium($value);
                break;
            case 10:
                $this->setPrintCost($value);
                break;
            case 11:
                $this->setPrintNotes($value);
                break;
            case 12:
                $this->setBuyerName($value);
                break;
            case 13:
                $this->setBuyerLocation($value);
                break;
            case 14:
                $this->setBuyerDatePurchase($value);
                break;
            case 15:
                $this->setBuyerDateReceipt($value);
                break;
            case 16:
                $this->setNotes($value);
                break;
        } // switch()

        return $this;
    }

    /**
     * Populates the object using an array.
     *
     * This is particularly useful when populating an object from one of the
     * request arrays (e.g. $_POST).  This method goes through the column
     * names, checking to see whether a matching key exists in populated
     * array. If so the setByName() method is called for that column.
     *
     * You can specify the key type of the array by additionally passing one
     * of the class type constants TableMap::TYPE_PHPNAME, TableMap::TYPE_CAMELNAME,
     * TableMap::TYPE_COLNAME, TableMap::TYPE_FIELDNAME, TableMap::TYPE_NUM.
     * The default key type is the column's TableMap::TYPE_PHPNAME.
     *
     * @param array $arr An array to populate the object from.
     * @param string $keyType The type of keys the array uses.
     * @return $this
     */
    public function fromArray(array $arr, string $keyType = TableMap::TYPE_PHPNAME)
    {
        $keys = CfaTableMap::getFieldNames($keyType);

        if (array_key_exists($keys[0], $arr)) {
            $this->setRecordId($arr[$keys[0]]);
        }
        if (array_key_exists($keys[1], $arr)) {
            $this->setCreatedAt($arr[$keys[1]]);
        }
        if (array_key_exists($keys[2], $arr)) {
            $this->setUpdatedAt($arr[$keys[2]]);
        }
        if (array_key_exists($keys[3], $arr)) {
            $this->setPieceId($arr[$keys[3]]);
        }
        if (array_key_exists($keys[4], $arr)) {
            $this->setPieceIdRun($arr[$keys[4]]);
        }
        if (array_key_exists($keys[5], $arr)) {
            $this->setPieceIdCount($arr[$keys[5]]);
        }
        if (array_key_exists($keys[6], $arr)) {
            $this->setPrintCompany($arr[$keys[6]]);
        }
        if (array_key_exists($keys[7], $arr)) {
            $this->setPrintDateSent($arr[$keys[7]]);
        }
        if (array_key_exists($keys[8], $arr)) {
            $this->setPrintDateReceipt($arr[$keys[8]]);
        }
        if (array_key_exists($keys[9], $arr)) {
            $this->setPrintMedium($arr[$keys[9]]);
        }
        if (array_key_exists($keys[10], $arr)) {
            $this->setPrintCost($arr[$keys[10]]);
        }
        if (array_key_exists($keys[11], $arr)) {
            $this->setPrintNotes($arr[$keys[11]]);
        }
        if (array_key_exists($keys[12], $arr)) {
            $this->setBuyerName($arr[$keys[12]]);
        }
        if (array_key_exists($keys[13], $arr)) {
            $this->setBuyerLocation($arr[$keys[13]]);
        }
        if (array_key_exists($keys[14], $arr)) {
            $this->setBuyerDatePurchase($arr[$keys[14]]);
        }
        if (array_key_exists($keys[15], $arr)) {
            $this->setBuyerDateReceipt($arr[$keys[15]]);
        }
        if (array_key_exists($keys[16], $arr)) {
            $this->setNotes($arr[$keys[16]]);
        }

        return $this;
    }

     /**
     * Populate the current object from a string, using a given parser format
     * <code>
     * $book = new Book();
     * $book->importFrom('JSON', '{"Id":9012,"Title":"Don Juan","ISBN":"0140422161","Price":12.99,"PublisherId":1234,"AuthorId":5678}');
     * </code>
     *
     * You can specify the key type of the array by additionally passing one
     * of the class type constants TableMap::TYPE_PHPNAME, TableMap::TYPE_CAMELNAME,
     * TableMap::TYPE_COLNAME, TableMap::TYPE_FIELDNAME, TableMap::TYPE_NUM.
     * The default key type is the column's TableMap::TYPE_PHPNAME.
     *
     * @param mixed $parser A AbstractParser instance,
     *                       or a format name ('XML', 'YAML', 'JSON', 'CSV')
     * @param string $data The source data to import from
     * @param string $keyType The type of keys the array uses.
     *
     * @return $this The current object, for fluid interface
     */
    public function importFrom($parser, string $data, string $keyType = TableMap::TYPE_PHPNAME)
    {
        if (!$parser instanceof AbstractParser) {
            $parser = AbstractParser::getParser($parser);
        }

        $this->fromArray($parser->toArray($data), $keyType);

        return $this;
    }

    /**
     * Build a Criteria object containing the values of all modified columns in this object.
     *
     * @return \Propel\Runtime\ActiveQuery\Criteria The Criteria object containing all modified values.
     */
    public function buildCriteria(): Criteria
    {
        $criteria = new Criteria(CfaTableMap::DATABASE_NAME);

        if ($this->isColumnModified(CfaTableMap::COL_RECORD_ID)) {
            $criteria->add(CfaTableMap::COL_RECORD_ID, $this->record_id);
        }
        if ($this->isColumnModified(CfaTableMap::COL_CREATED_AT)) {
            $criteria->add(CfaTableMap::COL_CREATED_AT, $this->created_at);
        }
        if ($this->isColumnModified(CfaTableMap::COL_UPDATED_AT)) {
            $criteria->add(CfaTableMap::COL_UPDATED_AT, $this->updated_at);
        }
        if ($this->isColumnModified(CfaTableMap::COL_PIECE_ID)) {
            $criteria->add(CfaTableMap::COL_PIECE_ID, $this->piece_id);
        }
        if ($this->isColumnModified(CfaTableMap::COL_PIECE_ID_RUN)) {
            $criteria->add(CfaTableMap::COL_PIECE_ID_RUN, $this->piece_id_run);
        }
        if ($this->isColumnModified(CfaTableMap::COL_PIECE_ID_COUNT)) {
            $criteria->add(CfaTableMap::COL_PIECE_ID_COUNT, $this->piece_id_count);
        }
        if ($this->isColumnModified(CfaTableMap::COL_PRINT_COMPANY)) {
            $criteria->add(CfaTableMap::COL_PRINT_COMPANY, $this->print_company);
        }
        if ($this->isColumnModified(CfaTableMap::COL_PRINT_DATE_SENT)) {
            $criteria->add(CfaTableMap::COL_PRINT_DATE_SENT, $this->print_date_sent);
        }
        if ($this->isColumnModified(CfaTableMap::COL_PRINT_DATE_RECEIPT)) {
            $criteria->add(CfaTableMap::COL_PRINT_DATE_RECEIPT, $this->print_date_receipt);
        }
        if ($this->isColumnModified(CfaTableMap::COL_PRINT_MEDIUM)) {
            $criteria->add(CfaTableMap::COL_PRINT_MEDIUM, $this->print_medium);
        }
        if ($this->isColumnModified(CfaTableMap::COL_PRINT_COST)) {
            $criteria->add(CfaTableMap::COL_PRINT_COST, $this->print_cost);
        }
        if ($this->isColumnModified(CfaTableMap::COL_PRINT_NOTES)) {
            $criteria->add(CfaTableMap::COL_PRINT_NOTES, $this->print_notes);
        }
        if ($this->isColumnModified(CfaTableMap::COL_BUYER_NAME)) {
            $criteria->add(CfaTableMap::COL_BUYER_NAME, $this->buyer_name);
        }
        if ($this->isColumnModified(CfaTableMap::COL_BUYER_LOCATION)) {
            $criteria->add(CfaTableMap::COL_BUYER_LOCATION, $this->buyer_location);
        }
        if ($this->isColumnModified(CfaTableMap::COL_BUYER_DATE_PURCHASE)) {
            $criteria->add(CfaTableMap::COL_BUYER_DATE_PURCHASE, $this->buyer_date_purchase);
        }
        if ($this->isColumnModified(CfaTableMap::COL_BUYER_DATE_RECEIPT)) {
            $criteria->add(CfaTableMap::COL_BUYER_DATE_RECEIPT, $this->buyer_date_receipt);
        }
        if ($this->isColumnModified(CfaTableMap::COL_NOTES)) {
            $criteria->add(CfaTableMap::COL_NOTES, $this->notes);
        }

        return $criteria;
    }

    /**
     * Builds a Criteria object containing the primary key for this object.
     *
     * Unlike buildCriteria() this method includes the primary key values regardless
     * of whether they have been modified.
     *
     * @throws LogicException if no primary key is defined
     *
     * @return \Propel\Runtime\ActiveQuery\Criteria The Criteria object containing value(s) for primary key(s).
     */
    public function buildPkeyCriteria(): Criteria
    {
        $criteria = ChildCfaQuery::create();
        $criteria->add(CfaTableMap::COL_RECORD_ID, $this->record_id);

        return $criteria;
    }

    /**
     * If the primary key is not null, return the hashcode of the
     * primary key. Otherwise, return the hash code of the object.
     *
     * @return int|string Hashcode
     */
    public function hashCode()
    {
        $validPk = null !== $this->getRecordId();

        $validPrimaryKeyFKs = 0;
        $primaryKeyFKs = [];

        if ($validPk) {
            return crc32(json_encode($this->getPrimaryKey(), JSON_UNESCAPED_UNICODE));
        } elseif ($validPrimaryKeyFKs) {
            return crc32(json_encode($primaryKeyFKs, JSON_UNESCAPED_UNICODE));
        }

        return spl_object_hash($this);
    }

    /**
     * Returns the primary key for this object (row).
     * @return int
     */
    public function getPrimaryKey()
    {
        return $this->getRecordId();
    }

    /**
     * Generic method to set the primary key (record_id column).
     *
     * @param int|null $key Primary key.
     * @return void
     */
    public function setPrimaryKey(?int $key = null): void
    {
        $this->setRecordId($key);
    }

    /**
     * Returns true if the primary key for this object is null.
     *
     * @return bool
     */
    public function isPrimaryKeyNull(): bool
    {
        return null === $this->getRecordId();
    }

    /**
     * Sets contents of passed object to values from current object.
     *
     * If desired, this method can also make copies of all associated (fkey referrers)
     * objects.
     *
     * @param object $copyObj An object of \Art\Cfa (or compatible) type.
     * @param bool $deepCopy Whether to also copy all rows that refer (by fkey) to the current row.
     * @param bool $makeNew Whether to reset autoincrement PKs and make the object new.
     * @throws \Propel\Runtime\Exception\PropelException
     * @return void
     */
    public function copyInto(object $copyObj, bool $deepCopy = false, bool $makeNew = true): void
    {
        $copyObj->setCreatedAt($this->getCreatedAt());
        $copyObj->setUpdatedAt($this->getUpdatedAt());
        $copyObj->setPieceId($this->getPieceId());
        $copyObj->setPieceIdRun($this->getPieceIdRun());
        $copyObj->setPieceIdCount($this->getPieceIdCount());
        $copyObj->setPrintCompany($this->getPrintCompany());
        $copyObj->setPrintDateSent($this->getPrintDateSent());
        $copyObj->setPrintDateReceipt($this->getPrintDateReceipt());
        $copyObj->setPrintMedium($this->getPrintMedium());
        $copyObj->setPrintCost($this->getPrintCost());
        $copyObj->setPrintNotes($this->getPrintNotes());
        $copyObj->setBuyerName($this->getBuyerName());
        $copyObj->setBuyerLocation($this->getBuyerLocation());
        $copyObj->setBuyerDatePurchase($this->getBuyerDatePurchase());
        $copyObj->setBuyerDateReceipt($this->getBuyerDateReceipt());
        $copyObj->setNotes($this->getNotes());
        if ($makeNew) {
            $copyObj->setNew(true);
            $copyObj->setRecordId(NULL); // this is a auto-increment column, so set to default value
        }
    }

    /**
     * Makes a copy of this object that will be inserted as a new row in table when saved.
     * It creates a new object filling in the simple attributes, but skipping any primary
     * keys that are defined for the table.
     *
     * If desired, this method can also make copies of all associated (fkey referrers)
     * objects.
     *
     * @param bool $deepCopy Whether to also copy all rows that refer (by fkey) to the current row.
     * @return \Art\Cfa Clone of current object.
     * @throws \Propel\Runtime\Exception\PropelException
     */
    public function copy(bool $deepCopy = false)
    {
        // we use get_class(), because this might be a subclass
        $clazz = get_class($this);
        $copyObj = new $clazz();
        $this->copyInto($copyObj, $deepCopy);

        return $copyObj;
    }

    /**
     * Clears the current object, sets all attributes to their default values and removes
     * outgoing references as well as back-references (from other objects to this one. Results probably in a database
     * change of those foreign objects when you call `save` there).
     *
     * @return $this
     */
    public function clear()
    {
        $this->record_id = null;
        $this->created_at = null;
        $this->updated_at = null;
        $this->piece_id = null;
        $this->piece_id_run = null;
        $this->piece_id_count = null;
        $this->print_company = null;
        $this->print_date_sent = null;
        $this->print_date_receipt = null;
        $this->print_medium = null;
        $this->print_cost = null;
        $this->print_notes = null;
        $this->buyer_name = null;
        $this->buyer_location = null;
        $this->buyer_date_purchase = null;
        $this->buyer_date_receipt = null;
        $this->notes = null;
        $this->alreadyInSave = false;
        $this->clearAllReferences();
        $this->applyDefaultValues();
        $this->resetModified();
        $this->setNew(true);
        $this->setDeleted(false);

        return $this;
    }

    /**
     * Resets all references and back-references to other model objects or collections of model objects.
     *
     * This method is used to reset all php object references (not the actual reference in the database).
     * Necessary for object serialisation.
     *
     * @param bool $deep Whether to also clear the references on all referrer objects.
     * @return $this
     */
    public function clearAllReferences(bool $deep = false)
    {
        if ($deep) {
        } // if ($deep)

        return $this;
    }

    /**
     * Return the string representation of this object
     *
     * @return string
     */
    public function __toString()
    {
        return (string) $this->exportTo(CfaTableMap::DEFAULT_STRING_FORMAT);
    }

    /**
     * Code to be run before persisting the object
     * @param ConnectionInterface|null $con
     * @return bool
     */
    public function preSave(?ConnectionInterface $con = null): bool
    {
                return true;
    }

    /**
     * Code to be run after persisting the object
     * @param ConnectionInterface|null $con
     * @return void
     */
    public function postSave(?ConnectionInterface $con = null): void
    {
            }

    /**
     * Code to be run before inserting to database
     * @param ConnectionInterface|null $con
     * @return bool
     */
    public function preInsert(?ConnectionInterface $con = null): bool
    {
                return true;
    }

    /**
     * Code to be run after inserting to database
     * @param ConnectionInterface|null $con
     * @return void
     */
    public function postInsert(?ConnectionInterface $con = null): void
    {
            }

    /**
     * Code to be run before updating the object in database
     * @param ConnectionInterface|null $con
     * @return bool
     */
    public function preUpdate(?ConnectionInterface $con = null): bool
    {
                return true;
    }

    /**
     * Code to be run after updating the object in database
     * @param ConnectionInterface|null $con
     * @return void
     */
    public function postUpdate(?ConnectionInterface $con = null): void
    {
            }

    /**
     * Code to be run before deleting the object in database
     * @param ConnectionInterface|null $con
     * @return bool
     */
    public function preDelete(?ConnectionInterface $con = null): bool
    {
                return true;
    }

    /**
     * Code to be run after deleting the object in database
     * @param ConnectionInterface|null $con
     * @return void
     */
    public function postDelete(?ConnectionInterface $con = null): void
    {
            }


    /**
     * Derived method to catches calls to undefined methods.
     *
     * Provides magic import/export method support (fromXML()/toXML(), fromYAML()/toYAML(), etc.).
     * Allows to define default __call() behavior if you overwrite __call()
     *
     * @param string $name
     * @param mixed $params
     *
     * @return array|string
     */
    public function __call($name, $params)
    {
        if (0 === strpos($name, 'get')) {
            $virtualColumn = substr($name, 3);
            if ($this->hasVirtualColumn($virtualColumn)) {
                return $this->getVirtualColumn($virtualColumn);
            }

            $virtualColumn = lcfirst($virtualColumn);
            if ($this->hasVirtualColumn($virtualColumn)) {
                return $this->getVirtualColumn($virtualColumn);
            }
        }

        if (0 === strpos($name, 'from')) {
            $format = substr($name, 4);
            $inputData = $params[0];
            $keyType = $params[1] ?? TableMap::TYPE_PHPNAME;

            return $this->importFrom($format, $inputData, $keyType);
        }

        if (0 === strpos($name, 'to')) {
            $format = substr($name, 2);
            $includeLazyLoadColumns = $params[0] ?? true;
            $keyType = $params[1] ?? TableMap::TYPE_PHPNAME;

            return $this->exportTo($format, $includeLazyLoadColumns, $keyType);
        }

        throw new BadMethodCallException(sprintf('Call to undefined method: %s.', $name));
    }

}
