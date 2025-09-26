<?php

namespace Art\Base;

use \DateTime;
use \Exception;
use \PDO;
use Art\PiecesQuery as ChildPiecesQuery;
use Art\Map\PiecesTableMap;
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
 * Base class that represents a row from the 'pieces' table.
 *
 *
 *
 * @package    propel.generator.Art.Base
 */
abstract class Pieces implements ActiveRecordInterface
{
    /**
     * TableMap class name
     *
     * @var string
     */
    public const TABLE_MAP = '\\Art\\Map\\PiecesTableMap';


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
     * The value for the id field.
     *
     * @var        int
     */
    protected $id;

    /**
     * The value for the title field.
     *
     * @var        string
     */
    protected $title;

    /**
     * The value for the start_date field.
     *
     * @var        string
     */
    protected $start_date;

    /**
     * The value for the end_date field.
     *
     * @var        string
     */
    protected $end_date;

    /**
     * The value for the collection field.
     *
     * @var        string
     */
    protected $collection;

    /**
     * The value for the subcollection field.
     *
     * @var        string
     */
    protected $subcollection;

    /**
     * The value for the size_height field.
     *
     * @var        string
     */
    protected $size_height;

    /**
     * The value for the size_width field.
     *
     * @var        string
     */
    protected $size_width;

    /**
     * The value for the size_unit field.
     *
     * @var        string
     */
    protected $size_unit;

    /**
     * The value for the temperature field.
     *
     * @var        string
     */
    protected $temperature;

    /**
     * The value for the background field.
     *
     * @var        string
     */
    protected $background;

    /**
     * The value for the colors field.
     *
     * @var        string
     */
    protected $colors;

    /**
     * The value for the description field.
     *
     * @var        string
     */
    protected $description;

    /**
     * The value for the story field.
     *
     * @var        string
     */
    protected $story;

    /**
     * The value for the notes field.
     *
     * @var        string
     */
    protected $notes;

    /**
     * The value for the ai_training_form field.
     *
     * @var        string
     */
    protected $ai_training_form;

    /**
     * The value for the ai_training_colored field.
     *
     * @var        string
     */
    protected $ai_training_colored;

    /**
     * The value for the ai_training_final field.
     *
     * @var        string
     */
    protected $ai_training_final;

    /**
     * The value for the training_exports field.
     *
     * Note: this column has a database default value of: (expression) false
     * @var        boolean
     */
    protected $training_exports;

    /**
     * The value for the training_descriptions field.
     *
     * Note: this column has a database default value of: (expression) false
     * @var        boolean
     */
    protected $training_descriptions;

    /**
     * The value for the location field.
     *
     * @var        string
     */
    protected $location;

    /**
     * The value for the thumbnail field.
     *
     * @var        string
     */
    protected $thumbnail;

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
     * Initializes internal state of Art\Base\Pieces object.
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
     * Compares this with another <code>Pieces</code> instance.  If
     * <code>obj</code> is an instance of <code>Pieces</code>, delegates to
     * <code>equals(Pieces)</code>.  Otherwise, returns <code>false</code>.
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
     * Get the [id] column value.
     *
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Get the [title] column value.
     *
     * @return string
     */
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * Get the [start_date] column value.
     *
     * @return string
     */
    public function getStartDate()
    {
        return $this->start_date;
    }

    /**
     * Get the [end_date] column value.
     *
     * @return string
     */
    public function getEndDate()
    {
        return $this->end_date;
    }

    /**
     * Get the [collection] column value.
     *
     * @return string
     */
    public function getCollection()
    {
        return $this->collection;
    }

    /**
     * Get the [subcollection] column value.
     *
     * @return string
     */
    public function getSubcollection()
    {
        return $this->subcollection;
    }

    /**
     * Get the [size_height] column value.
     *
     * @return string
     */
    public function getSizeHeight()
    {
        return $this->size_height;
    }

    /**
     * Get the [size_width] column value.
     *
     * @return string
     */
    public function getSizeWidth()
    {
        return $this->size_width;
    }

    /**
     * Get the [size_unit] column value.
     *
     * @return string
     */
    public function getSizeUnit()
    {
        return $this->size_unit;
    }

    /**
     * Get the [temperature] column value.
     *
     * @return string
     */
    public function getTemperature()
    {
        return $this->temperature;
    }

    /**
     * Get the [background] column value.
     *
     * @return string
     */
    public function getBackground()
    {
        return $this->background;
    }

    /**
     * Get the [colors] column value.
     *
     * @return string
     */
    public function getColors()
    {
        return $this->colors;
    }

    /**
     * Get the [description] column value.
     *
     * @return string
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * Get the [story] column value.
     *
     * @return string
     */
    public function getStory()
    {
        return $this->story;
    }

    /**
     * Get the [notes] column value.
     *
     * @return string
     */
    public function getNotes()
    {
        return $this->notes;
    }

    /**
     * Get the [ai_training_form] column value.
     *
     * @return string
     */
    public function getAITrainingForm()
    {
        return $this->ai_training_form;
    }

    /**
     * Get the [ai_training_colored] column value.
     *
     * @return string
     */
    public function getAITrainingColored()
    {
        return $this->ai_training_colored;
    }

    /**
     * Get the [ai_training_final] column value.
     *
     * @return string
     */
    public function getAITrainingFinal()
    {
        return $this->ai_training_final;
    }

    /**
     * Get the [training_exports] column value.
     *
     * @return boolean
     */
    public function getTrainingExports()
    {
        return $this->training_exports;
    }

    /**
     * Get the [training_exports] column value.
     *
     * @return boolean
     */
    public function isTrainingExports()
    {
        return $this->getTrainingExports();
    }

    /**
     * Get the [training_descriptions] column value.
     *
     * @return boolean
     */
    public function getTrainingDescriptions()
    {
        return $this->training_descriptions;
    }

    /**
     * Get the [training_descriptions] column value.
     *
     * @return boolean
     */
    public function isTrainingDescriptions()
    {
        return $this->getTrainingDescriptions();
    }

    /**
     * Get the [location] column value.
     *
     * @return string
     */
    public function getLocation()
    {
        return $this->location;
    }

    /**
     * Get the [thumbnail] column value.
     *
     * @return string
     */
    public function getThumbnail()
    {
        return $this->thumbnail;
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
     * Set the value of [id] column.
     *
     * @param int $v New value
     * @return $this The current object (for fluent API support)
     */
    public function setId($v)
    {
        if ($v !== null) {
            $v = (int) $v;
        }

        if ($this->id !== $v) {
            $this->id = $v;
            $this->modifiedColumns[PiecesTableMap::COL_ID] = true;
        }

        return $this;
    }

    /**
     * Set the value of [title] column.
     *
     * @param string $v New value
     * @return $this The current object (for fluent API support)
     */
    public function setTitle($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->title !== $v) {
            $this->title = $v;
            $this->modifiedColumns[PiecesTableMap::COL_TITLE] = true;
        }

        return $this;
    }

    /**
     * Set the value of [start_date] column.
     *
     * @param string $v New value
     * @return $this The current object (for fluent API support)
     */
    public function setStartDate($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->start_date !== $v) {
            $this->start_date = $v;
            $this->modifiedColumns[PiecesTableMap::COL_START_DATE] = true;
        }

        return $this;
    }

    /**
     * Set the value of [end_date] column.
     *
     * @param string $v New value
     * @return $this The current object (for fluent API support)
     */
    public function setEndDate($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->end_date !== $v) {
            $this->end_date = $v;
            $this->modifiedColumns[PiecesTableMap::COL_END_DATE] = true;
        }

        return $this;
    }

    /**
     * Set the value of [collection] column.
     *
     * @param string $v New value
     * @return $this The current object (for fluent API support)
     */
    public function setCollection($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->collection !== $v) {
            $this->collection = $v;
            $this->modifiedColumns[PiecesTableMap::COL_COLLECTION] = true;
        }

        return $this;
    }

    /**
     * Set the value of [subcollection] column.
     *
     * @param string $v New value
     * @return $this The current object (for fluent API support)
     */
    public function setSubcollection($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->subcollection !== $v) {
            $this->subcollection = $v;
            $this->modifiedColumns[PiecesTableMap::COL_SUBCOLLECTION] = true;
        }

        return $this;
    }

    /**
     * Set the value of [size_height] column.
     *
     * @param string $v New value
     * @return $this The current object (for fluent API support)
     */
    public function setSizeHeight($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->size_height !== $v) {
            $this->size_height = $v;
            $this->modifiedColumns[PiecesTableMap::COL_SIZE_HEIGHT] = true;
        }

        return $this;
    }

    /**
     * Set the value of [size_width] column.
     *
     * @param string $v New value
     * @return $this The current object (for fluent API support)
     */
    public function setSizeWidth($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->size_width !== $v) {
            $this->size_width = $v;
            $this->modifiedColumns[PiecesTableMap::COL_SIZE_WIDTH] = true;
        }

        return $this;
    }

    /**
     * Set the value of [size_unit] column.
     *
     * @param string $v New value
     * @return $this The current object (for fluent API support)
     */
    public function setSizeUnit($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->size_unit !== $v) {
            $this->size_unit = $v;
            $this->modifiedColumns[PiecesTableMap::COL_SIZE_UNIT] = true;
        }

        return $this;
    }

    /**
     * Set the value of [temperature] column.
     *
     * @param string $v New value
     * @return $this The current object (for fluent API support)
     */
    public function setTemperature($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->temperature !== $v) {
            $this->temperature = $v;
            $this->modifiedColumns[PiecesTableMap::COL_TEMPERATURE] = true;
        }

        return $this;
    }

    /**
     * Set the value of [background] column.
     *
     * @param string $v New value
     * @return $this The current object (for fluent API support)
     */
    public function setBackground($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->background !== $v) {
            $this->background = $v;
            $this->modifiedColumns[PiecesTableMap::COL_BACKGROUND] = true;
        }

        return $this;
    }

    /**
     * Set the value of [colors] column.
     *
     * @param string $v New value
     * @return $this The current object (for fluent API support)
     */
    public function setColors($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->colors !== $v) {
            $this->colors = $v;
            $this->modifiedColumns[PiecesTableMap::COL_COLORS] = true;
        }

        return $this;
    }

    /**
     * Set the value of [description] column.
     *
     * @param string $v New value
     * @return $this The current object (for fluent API support)
     */
    public function setDescription($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->description !== $v) {
            $this->description = $v;
            $this->modifiedColumns[PiecesTableMap::COL_DESCRIPTION] = true;
        }

        return $this;
    }

    /**
     * Set the value of [story] column.
     *
     * @param string $v New value
     * @return $this The current object (for fluent API support)
     */
    public function setStory($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->story !== $v) {
            $this->story = $v;
            $this->modifiedColumns[PiecesTableMap::COL_STORY] = true;
        }

        return $this;
    }

    /**
     * Set the value of [notes] column.
     *
     * @param string $v New value
     * @return $this The current object (for fluent API support)
     */
    public function setNotes($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->notes !== $v) {
            $this->notes = $v;
            $this->modifiedColumns[PiecesTableMap::COL_NOTES] = true;
        }

        return $this;
    }

    /**
     * Set the value of [ai_training_form] column.
     *
     * @param string $v New value
     * @return $this The current object (for fluent API support)
     */
    public function setAITrainingForm($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->ai_training_form !== $v) {
            $this->ai_training_form = $v;
            $this->modifiedColumns[PiecesTableMap::COL_AI_TRAINING_FORM] = true;
        }

        return $this;
    }

    /**
     * Set the value of [ai_training_colored] column.
     *
     * @param string $v New value
     * @return $this The current object (for fluent API support)
     */
    public function setAITrainingColored($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->ai_training_colored !== $v) {
            $this->ai_training_colored = $v;
            $this->modifiedColumns[PiecesTableMap::COL_AI_TRAINING_COLORED] = true;
        }

        return $this;
    }

    /**
     * Set the value of [ai_training_final] column.
     *
     * @param string $v New value
     * @return $this The current object (for fluent API support)
     */
    public function setAITrainingFinal($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->ai_training_final !== $v) {
            $this->ai_training_final = $v;
            $this->modifiedColumns[PiecesTableMap::COL_AI_TRAINING_FINAL] = true;
        }

        return $this;
    }

    /**
     * Sets the value of the [training_exports] column.
     * Non-boolean arguments are converted using the following rules:
     *   * 1, '1', 'true',  'on',  and 'yes' are converted to boolean true
     *   * 0, '0', 'false', 'off', and 'no'  are converted to boolean false
     * Check on string values is case insensitive (so 'FaLsE' is seen as 'false').
     *
     * @param bool|integer|string $v The new value
     * @return $this The current object (for fluent API support)
     */
    public function setTrainingExports($v)
    {
        if ($v !== null) {
            if (is_string($v)) {
                $v = in_array(strtolower($v), array('false', 'off', '-', 'no', 'n', '0', '')) ? false : true;
            } else {
                $v = (boolean) $v;
            }
        }

        if ($this->training_exports !== $v) {
            $this->training_exports = $v;
            $this->modifiedColumns[PiecesTableMap::COL_TRAINING_EXPORTS] = true;
        }

        return $this;
    }

    /**
     * Sets the value of the [training_descriptions] column.
     * Non-boolean arguments are converted using the following rules:
     *   * 1, '1', 'true',  'on',  and 'yes' are converted to boolean true
     *   * 0, '0', 'false', 'off', and 'no'  are converted to boolean false
     * Check on string values is case insensitive (so 'FaLsE' is seen as 'false').
     *
     * @param bool|integer|string $v The new value
     * @return $this The current object (for fluent API support)
     */
    public function setTrainingDescriptions($v)
    {
        if ($v !== null) {
            if (is_string($v)) {
                $v = in_array(strtolower($v), array('false', 'off', '-', 'no', 'n', '0', '')) ? false : true;
            } else {
                $v = (boolean) $v;
            }
        }

        if ($this->training_descriptions !== $v) {
            $this->training_descriptions = $v;
            $this->modifiedColumns[PiecesTableMap::COL_TRAINING_DESCRIPTIONS] = true;
        }

        return $this;
    }

    /**
     * Set the value of [location] column.
     *
     * @param string $v New value
     * @return $this The current object (for fluent API support)
     */
    public function setLocation($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->location !== $v) {
            $this->location = $v;
            $this->modifiedColumns[PiecesTableMap::COL_LOCATION] = true;
        }

        return $this;
    }

    /**
     * Set the value of [thumbnail] column.
     *
     * @param string $v New value
     * @return $this The current object (for fluent API support)
     */
    public function setThumbnail($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->thumbnail !== $v) {
            $this->thumbnail = $v;
            $this->modifiedColumns[PiecesTableMap::COL_THUMBNAIL] = true;
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
                $this->modifiedColumns[PiecesTableMap::COL_CREATED_AT] = true;
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
                $this->modifiedColumns[PiecesTableMap::COL_UPDATED_AT] = true;
            }
        } // if either are not null

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

            $col = $row[TableMap::TYPE_NUM == $indexType ? 0 + $startcol : PiecesTableMap::translateFieldName('Id', TableMap::TYPE_PHPNAME, $indexType)];
            $this->id = (null !== $col) ? (int) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 1 + $startcol : PiecesTableMap::translateFieldName('Title', TableMap::TYPE_PHPNAME, $indexType)];
            $this->title = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 2 + $startcol : PiecesTableMap::translateFieldName('StartDate', TableMap::TYPE_PHPNAME, $indexType)];
            $this->start_date = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 3 + $startcol : PiecesTableMap::translateFieldName('EndDate', TableMap::TYPE_PHPNAME, $indexType)];
            $this->end_date = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 4 + $startcol : PiecesTableMap::translateFieldName('Collection', TableMap::TYPE_PHPNAME, $indexType)];
            $this->collection = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 5 + $startcol : PiecesTableMap::translateFieldName('Subcollection', TableMap::TYPE_PHPNAME, $indexType)];
            $this->subcollection = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 6 + $startcol : PiecesTableMap::translateFieldName('SizeHeight', TableMap::TYPE_PHPNAME, $indexType)];
            $this->size_height = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 7 + $startcol : PiecesTableMap::translateFieldName('SizeWidth', TableMap::TYPE_PHPNAME, $indexType)];
            $this->size_width = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 8 + $startcol : PiecesTableMap::translateFieldName('SizeUnit', TableMap::TYPE_PHPNAME, $indexType)];
            $this->size_unit = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 9 + $startcol : PiecesTableMap::translateFieldName('Temperature', TableMap::TYPE_PHPNAME, $indexType)];
            $this->temperature = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 10 + $startcol : PiecesTableMap::translateFieldName('Background', TableMap::TYPE_PHPNAME, $indexType)];
            $this->background = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 11 + $startcol : PiecesTableMap::translateFieldName('Colors', TableMap::TYPE_PHPNAME, $indexType)];
            $this->colors = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 12 + $startcol : PiecesTableMap::translateFieldName('Description', TableMap::TYPE_PHPNAME, $indexType)];
            $this->description = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 13 + $startcol : PiecesTableMap::translateFieldName('Story', TableMap::TYPE_PHPNAME, $indexType)];
            $this->story = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 14 + $startcol : PiecesTableMap::translateFieldName('Notes', TableMap::TYPE_PHPNAME, $indexType)];
            $this->notes = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 15 + $startcol : PiecesTableMap::translateFieldName('AITrainingForm', TableMap::TYPE_PHPNAME, $indexType)];
            $this->ai_training_form = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 16 + $startcol : PiecesTableMap::translateFieldName('AITrainingColored', TableMap::TYPE_PHPNAME, $indexType)];
            $this->ai_training_colored = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 17 + $startcol : PiecesTableMap::translateFieldName('AITrainingFinal', TableMap::TYPE_PHPNAME, $indexType)];
            $this->ai_training_final = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 18 + $startcol : PiecesTableMap::translateFieldName('TrainingExports', TableMap::TYPE_PHPNAME, $indexType)];
            $this->training_exports = (null !== $col) ? (boolean) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 19 + $startcol : PiecesTableMap::translateFieldName('TrainingDescriptions', TableMap::TYPE_PHPNAME, $indexType)];
            $this->training_descriptions = (null !== $col) ? (boolean) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 20 + $startcol : PiecesTableMap::translateFieldName('Location', TableMap::TYPE_PHPNAME, $indexType)];
            $this->location = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 21 + $startcol : PiecesTableMap::translateFieldName('Thumbnail', TableMap::TYPE_PHPNAME, $indexType)];
            $this->thumbnail = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 22 + $startcol : PiecesTableMap::translateFieldName('CreatedAt', TableMap::TYPE_PHPNAME, $indexType)];
            if ($col === '0000-00-00 00:00:00') {
                $col = null;
            }
            $this->created_at = (null !== $col) ? PropelDateTime::newInstance($col, null, 'DateTime') : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 23 + $startcol : PiecesTableMap::translateFieldName('UpdatedAt', TableMap::TYPE_PHPNAME, $indexType)];
            if ($col === '0000-00-00 00:00:00') {
                $col = null;
            }
            $this->updated_at = (null !== $col) ? PropelDateTime::newInstance($col, null, 'DateTime') : null;

            $this->resetModified();
            $this->setNew(false);

            if ($rehydrate) {
                $this->ensureConsistency();
            }

            return $startcol + 24; // 24 = PiecesTableMap::NUM_HYDRATE_COLUMNS.

        } catch (Exception $e) {
            throw new PropelException(sprintf('Error populating %s object', '\\Art\\Pieces'), 0, $e);
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
            $con = Propel::getServiceContainer()->getReadConnection(PiecesTableMap::DATABASE_NAME);
        }

        // We don't need to alter the object instance pool; we're just modifying this instance
        // already in the pool.

        $dataFetcher = ChildPiecesQuery::create(null, $this->buildPkeyCriteria())->setFormatter(ModelCriteria::FORMAT_STATEMENT)->find($con);
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
     * @see Pieces::setDeleted()
     * @see Pieces::isDeleted()
     */
    public function delete(?ConnectionInterface $con = null): void
    {
        if ($this->isDeleted()) {
            throw new PropelException("This object has already been deleted.");
        }

        if ($con === null) {
            $con = Propel::getServiceContainer()->getWriteConnection(PiecesTableMap::DATABASE_NAME);
        }

        $con->transaction(function () use ($con) {
            $deleteQuery = ChildPiecesQuery::create()
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
            $con = Propel::getServiceContainer()->getWriteConnection(PiecesTableMap::DATABASE_NAME);
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
                PiecesTableMap::addInstanceToPool($this);
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

        $this->modifiedColumns[PiecesTableMap::COL_ID] = true;
        if (null !== $this->id) {
            throw new PropelException('Cannot insert a value for auto-increment primary key (' . PiecesTableMap::COL_ID . ')');
        }

         // check the columns in natural order for more readable SQL queries
        if ($this->isColumnModified(PiecesTableMap::COL_ID)) {
            $modifiedColumns[':p' . $index++]  = 'id';
        }
        if ($this->isColumnModified(PiecesTableMap::COL_TITLE)) {
            $modifiedColumns[':p' . $index++]  = 'title';
        }
        if ($this->isColumnModified(PiecesTableMap::COL_START_DATE)) {
            $modifiedColumns[':p' . $index++]  = 'start_date';
        }
        if ($this->isColumnModified(PiecesTableMap::COL_END_DATE)) {
            $modifiedColumns[':p' . $index++]  = 'end_date';
        }
        if ($this->isColumnModified(PiecesTableMap::COL_COLLECTION)) {
            $modifiedColumns[':p' . $index++]  = 'collection';
        }
        if ($this->isColumnModified(PiecesTableMap::COL_SUBCOLLECTION)) {
            $modifiedColumns[':p' . $index++]  = 'subcollection';
        }
        if ($this->isColumnModified(PiecesTableMap::COL_SIZE_HEIGHT)) {
            $modifiedColumns[':p' . $index++]  = 'size_height';
        }
        if ($this->isColumnModified(PiecesTableMap::COL_SIZE_WIDTH)) {
            $modifiedColumns[':p' . $index++]  = 'size_width';
        }
        if ($this->isColumnModified(PiecesTableMap::COL_SIZE_UNIT)) {
            $modifiedColumns[':p' . $index++]  = 'size_unit';
        }
        if ($this->isColumnModified(PiecesTableMap::COL_TEMPERATURE)) {
            $modifiedColumns[':p' . $index++]  = 'temperature';
        }
        if ($this->isColumnModified(PiecesTableMap::COL_BACKGROUND)) {
            $modifiedColumns[':p' . $index++]  = 'background';
        }
        if ($this->isColumnModified(PiecesTableMap::COL_COLORS)) {
            $modifiedColumns[':p' . $index++]  = 'colors';
        }
        if ($this->isColumnModified(PiecesTableMap::COL_DESCRIPTION)) {
            $modifiedColumns[':p' . $index++]  = 'description';
        }
        if ($this->isColumnModified(PiecesTableMap::COL_STORY)) {
            $modifiedColumns[':p' . $index++]  = 'story';
        }
        if ($this->isColumnModified(PiecesTableMap::COL_NOTES)) {
            $modifiedColumns[':p' . $index++]  = 'notes';
        }
        if ($this->isColumnModified(PiecesTableMap::COL_AI_TRAINING_FORM)) {
            $modifiedColumns[':p' . $index++]  = 'ai_training_form';
        }
        if ($this->isColumnModified(PiecesTableMap::COL_AI_TRAINING_COLORED)) {
            $modifiedColumns[':p' . $index++]  = 'ai_training_colored';
        }
        if ($this->isColumnModified(PiecesTableMap::COL_AI_TRAINING_FINAL)) {
            $modifiedColumns[':p' . $index++]  = 'ai_training_final';
        }
        if ($this->isColumnModified(PiecesTableMap::COL_TRAINING_EXPORTS)) {
            $modifiedColumns[':p' . $index++]  = 'training_exports';
        }
        if ($this->isColumnModified(PiecesTableMap::COL_TRAINING_DESCRIPTIONS)) {
            $modifiedColumns[':p' . $index++]  = 'training_descriptions';
        }
        if ($this->isColumnModified(PiecesTableMap::COL_LOCATION)) {
            $modifiedColumns[':p' . $index++]  = 'location';
        }
        if ($this->isColumnModified(PiecesTableMap::COL_THUMBNAIL)) {
            $modifiedColumns[':p' . $index++]  = 'thumbnail';
        }
        if ($this->isColumnModified(PiecesTableMap::COL_CREATED_AT)) {
            $modifiedColumns[':p' . $index++]  = 'created_at';
        }
        if ($this->isColumnModified(PiecesTableMap::COL_UPDATED_AT)) {
            $modifiedColumns[':p' . $index++]  = 'updated_at';
        }

        $sql = sprintf(
            'INSERT INTO pieces (%s) VALUES (%s)',
            implode(', ', $modifiedColumns),
            implode(', ', array_keys($modifiedColumns))
        );

        try {
            $stmt = $con->prepare($sql);
            foreach ($modifiedColumns as $identifier => $columnName) {
                switch ($columnName) {
                    case 'id':
                        $stmt->bindValue($identifier, $this->id, PDO::PARAM_INT);

                        break;
                    case 'title':
                        $stmt->bindValue($identifier, $this->title, PDO::PARAM_STR);

                        break;
                    case 'start_date':
                        $stmt->bindValue($identifier, $this->start_date, PDO::PARAM_STR);

                        break;
                    case 'end_date':
                        $stmt->bindValue($identifier, $this->end_date, PDO::PARAM_STR);

                        break;
                    case 'collection':
                        $stmt->bindValue($identifier, $this->collection, PDO::PARAM_STR);

                        break;
                    case 'subcollection':
                        $stmt->bindValue($identifier, $this->subcollection, PDO::PARAM_STR);

                        break;
                    case 'size_height':
                        $stmt->bindValue($identifier, $this->size_height, PDO::PARAM_STR);

                        break;
                    case 'size_width':
                        $stmt->bindValue($identifier, $this->size_width, PDO::PARAM_STR);

                        break;
                    case 'size_unit':
                        $stmt->bindValue($identifier, $this->size_unit, PDO::PARAM_STR);

                        break;
                    case 'temperature':
                        $stmt->bindValue($identifier, $this->temperature, PDO::PARAM_STR);

                        break;
                    case 'background':
                        $stmt->bindValue($identifier, $this->background, PDO::PARAM_STR);

                        break;
                    case 'colors':
                        $stmt->bindValue($identifier, $this->colors, PDO::PARAM_STR);

                        break;
                    case 'description':
                        $stmt->bindValue($identifier, $this->description, PDO::PARAM_STR);

                        break;
                    case 'story':
                        $stmt->bindValue($identifier, $this->story, PDO::PARAM_STR);

                        break;
                    case 'notes':
                        $stmt->bindValue($identifier, $this->notes, PDO::PARAM_STR);

                        break;
                    case 'ai_training_form':
                        $stmt->bindValue($identifier, $this->ai_training_form, PDO::PARAM_STR);

                        break;
                    case 'ai_training_colored':
                        $stmt->bindValue($identifier, $this->ai_training_colored, PDO::PARAM_STR);

                        break;
                    case 'ai_training_final':
                        $stmt->bindValue($identifier, $this->ai_training_final, PDO::PARAM_STR);

                        break;
                    case 'training_exports':
                        $stmt->bindValue($identifier, (int) $this->training_exports, PDO::PARAM_INT);

                        break;
                    case 'training_descriptions':
                        $stmt->bindValue($identifier, (int) $this->training_descriptions, PDO::PARAM_INT);

                        break;
                    case 'location':
                        $stmt->bindValue($identifier, $this->location, PDO::PARAM_STR);

                        break;
                    case 'thumbnail':
                        $stmt->bindValue($identifier, $this->thumbnail, PDO::PARAM_STR);

                        break;
                    case 'created_at':
                        $stmt->bindValue($identifier, $this->created_at ? $this->created_at->format("Y-m-d H:i:s.u") : null, PDO::PARAM_STR);

                        break;
                    case 'updated_at':
                        $stmt->bindValue($identifier, $this->updated_at ? $this->updated_at->format("Y-m-d H:i:s.u") : null, PDO::PARAM_STR);

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
        $this->setId($pk);

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
        $pos = PiecesTableMap::translateFieldName($name, $type, TableMap::TYPE_NUM);
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
                return $this->getId();

            case 1:
                return $this->getTitle();

            case 2:
                return $this->getStartDate();

            case 3:
                return $this->getEndDate();

            case 4:
                return $this->getCollection();

            case 5:
                return $this->getSubcollection();

            case 6:
                return $this->getSizeHeight();

            case 7:
                return $this->getSizeWidth();

            case 8:
                return $this->getSizeUnit();

            case 9:
                return $this->getTemperature();

            case 10:
                return $this->getBackground();

            case 11:
                return $this->getColors();

            case 12:
                return $this->getDescription();

            case 13:
                return $this->getStory();

            case 14:
                return $this->getNotes();

            case 15:
                return $this->getAITrainingForm();

            case 16:
                return $this->getAITrainingColored();

            case 17:
                return $this->getAITrainingFinal();

            case 18:
                return $this->getTrainingExports();

            case 19:
                return $this->getTrainingDescriptions();

            case 20:
                return $this->getLocation();

            case 21:
                return $this->getThumbnail();

            case 22:
                return $this->getCreatedAt();

            case 23:
                return $this->getUpdatedAt();

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
        if (isset($alreadyDumpedObjects['Pieces'][$this->hashCode()])) {
            return ['*RECURSION*'];
        }
        $alreadyDumpedObjects['Pieces'][$this->hashCode()] = true;
        $keys = PiecesTableMap::getFieldNames($keyType);
        $result = [
            $keys[0] => $this->getId(),
            $keys[1] => $this->getTitle(),
            $keys[2] => $this->getStartDate(),
            $keys[3] => $this->getEndDate(),
            $keys[4] => $this->getCollection(),
            $keys[5] => $this->getSubcollection(),
            $keys[6] => $this->getSizeHeight(),
            $keys[7] => $this->getSizeWidth(),
            $keys[8] => $this->getSizeUnit(),
            $keys[9] => $this->getTemperature(),
            $keys[10] => $this->getBackground(),
            $keys[11] => $this->getColors(),
            $keys[12] => $this->getDescription(),
            $keys[13] => $this->getStory(),
            $keys[14] => $this->getNotes(),
            $keys[15] => $this->getAITrainingForm(),
            $keys[16] => $this->getAITrainingColored(),
            $keys[17] => $this->getAITrainingFinal(),
            $keys[18] => $this->getTrainingExports(),
            $keys[19] => $this->getTrainingDescriptions(),
            $keys[20] => $this->getLocation(),
            $keys[21] => $this->getThumbnail(),
            $keys[22] => $this->getCreatedAt(),
            $keys[23] => $this->getUpdatedAt(),
        ];
        if ($result[$keys[22]] instanceof \DateTimeInterface) {
            $result[$keys[22]] = $result[$keys[22]]->format('Y-m-d H:i:s.u');
        }

        if ($result[$keys[23]] instanceof \DateTimeInterface) {
            $result[$keys[23]] = $result[$keys[23]]->format('Y-m-d H:i:s.u');
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
        $pos = PiecesTableMap::translateFieldName($name, $type, TableMap::TYPE_NUM);

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
                $this->setId($value);
                break;
            case 1:
                $this->setTitle($value);
                break;
            case 2:
                $this->setStartDate($value);
                break;
            case 3:
                $this->setEndDate($value);
                break;
            case 4:
                $this->setCollection($value);
                break;
            case 5:
                $this->setSubcollection($value);
                break;
            case 6:
                $this->setSizeHeight($value);
                break;
            case 7:
                $this->setSizeWidth($value);
                break;
            case 8:
                $this->setSizeUnit($value);
                break;
            case 9:
                $this->setTemperature($value);
                break;
            case 10:
                $this->setBackground($value);
                break;
            case 11:
                $this->setColors($value);
                break;
            case 12:
                $this->setDescription($value);
                break;
            case 13:
                $this->setStory($value);
                break;
            case 14:
                $this->setNotes($value);
                break;
            case 15:
                $this->setAITrainingForm($value);
                break;
            case 16:
                $this->setAITrainingColored($value);
                break;
            case 17:
                $this->setAITrainingFinal($value);
                break;
            case 18:
                $this->setTrainingExports($value);
                break;
            case 19:
                $this->setTrainingDescriptions($value);
                break;
            case 20:
                $this->setLocation($value);
                break;
            case 21:
                $this->setThumbnail($value);
                break;
            case 22:
                $this->setCreatedAt($value);
                break;
            case 23:
                $this->setUpdatedAt($value);
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
        $keys = PiecesTableMap::getFieldNames($keyType);

        if (array_key_exists($keys[0], $arr)) {
            $this->setId($arr[$keys[0]]);
        }
        if (array_key_exists($keys[1], $arr)) {
            $this->setTitle($arr[$keys[1]]);
        }
        if (array_key_exists($keys[2], $arr)) {
            $this->setStartDate($arr[$keys[2]]);
        }
        if (array_key_exists($keys[3], $arr)) {
            $this->setEndDate($arr[$keys[3]]);
        }
        if (array_key_exists($keys[4], $arr)) {
            $this->setCollection($arr[$keys[4]]);
        }
        if (array_key_exists($keys[5], $arr)) {
            $this->setSubcollection($arr[$keys[5]]);
        }
        if (array_key_exists($keys[6], $arr)) {
            $this->setSizeHeight($arr[$keys[6]]);
        }
        if (array_key_exists($keys[7], $arr)) {
            $this->setSizeWidth($arr[$keys[7]]);
        }
        if (array_key_exists($keys[8], $arr)) {
            $this->setSizeUnit($arr[$keys[8]]);
        }
        if (array_key_exists($keys[9], $arr)) {
            $this->setTemperature($arr[$keys[9]]);
        }
        if (array_key_exists($keys[10], $arr)) {
            $this->setBackground($arr[$keys[10]]);
        }
        if (array_key_exists($keys[11], $arr)) {
            $this->setColors($arr[$keys[11]]);
        }
        if (array_key_exists($keys[12], $arr)) {
            $this->setDescription($arr[$keys[12]]);
        }
        if (array_key_exists($keys[13], $arr)) {
            $this->setStory($arr[$keys[13]]);
        }
        if (array_key_exists($keys[14], $arr)) {
            $this->setNotes($arr[$keys[14]]);
        }
        if (array_key_exists($keys[15], $arr)) {
            $this->setAITrainingForm($arr[$keys[15]]);
        }
        if (array_key_exists($keys[16], $arr)) {
            $this->setAITrainingColored($arr[$keys[16]]);
        }
        if (array_key_exists($keys[17], $arr)) {
            $this->setAITrainingFinal($arr[$keys[17]]);
        }
        if (array_key_exists($keys[18], $arr)) {
            $this->setTrainingExports($arr[$keys[18]]);
        }
        if (array_key_exists($keys[19], $arr)) {
            $this->setTrainingDescriptions($arr[$keys[19]]);
        }
        if (array_key_exists($keys[20], $arr)) {
            $this->setLocation($arr[$keys[20]]);
        }
        if (array_key_exists($keys[21], $arr)) {
            $this->setThumbnail($arr[$keys[21]]);
        }
        if (array_key_exists($keys[22], $arr)) {
            $this->setCreatedAt($arr[$keys[22]]);
        }
        if (array_key_exists($keys[23], $arr)) {
            $this->setUpdatedAt($arr[$keys[23]]);
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
        $criteria = new Criteria(PiecesTableMap::DATABASE_NAME);

        if ($this->isColumnModified(PiecesTableMap::COL_ID)) {
            $criteria->add(PiecesTableMap::COL_ID, $this->id);
        }
        if ($this->isColumnModified(PiecesTableMap::COL_TITLE)) {
            $criteria->add(PiecesTableMap::COL_TITLE, $this->title);
        }
        if ($this->isColumnModified(PiecesTableMap::COL_START_DATE)) {
            $criteria->add(PiecesTableMap::COL_START_DATE, $this->start_date);
        }
        if ($this->isColumnModified(PiecesTableMap::COL_END_DATE)) {
            $criteria->add(PiecesTableMap::COL_END_DATE, $this->end_date);
        }
        if ($this->isColumnModified(PiecesTableMap::COL_COLLECTION)) {
            $criteria->add(PiecesTableMap::COL_COLLECTION, $this->collection);
        }
        if ($this->isColumnModified(PiecesTableMap::COL_SUBCOLLECTION)) {
            $criteria->add(PiecesTableMap::COL_SUBCOLLECTION, $this->subcollection);
        }
        if ($this->isColumnModified(PiecesTableMap::COL_SIZE_HEIGHT)) {
            $criteria->add(PiecesTableMap::COL_SIZE_HEIGHT, $this->size_height);
        }
        if ($this->isColumnModified(PiecesTableMap::COL_SIZE_WIDTH)) {
            $criteria->add(PiecesTableMap::COL_SIZE_WIDTH, $this->size_width);
        }
        if ($this->isColumnModified(PiecesTableMap::COL_SIZE_UNIT)) {
            $criteria->add(PiecesTableMap::COL_SIZE_UNIT, $this->size_unit);
        }
        if ($this->isColumnModified(PiecesTableMap::COL_TEMPERATURE)) {
            $criteria->add(PiecesTableMap::COL_TEMPERATURE, $this->temperature);
        }
        if ($this->isColumnModified(PiecesTableMap::COL_BACKGROUND)) {
            $criteria->add(PiecesTableMap::COL_BACKGROUND, $this->background);
        }
        if ($this->isColumnModified(PiecesTableMap::COL_COLORS)) {
            $criteria->add(PiecesTableMap::COL_COLORS, $this->colors);
        }
        if ($this->isColumnModified(PiecesTableMap::COL_DESCRIPTION)) {
            $criteria->add(PiecesTableMap::COL_DESCRIPTION, $this->description);
        }
        if ($this->isColumnModified(PiecesTableMap::COL_STORY)) {
            $criteria->add(PiecesTableMap::COL_STORY, $this->story);
        }
        if ($this->isColumnModified(PiecesTableMap::COL_NOTES)) {
            $criteria->add(PiecesTableMap::COL_NOTES, $this->notes);
        }
        if ($this->isColumnModified(PiecesTableMap::COL_AI_TRAINING_FORM)) {
            $criteria->add(PiecesTableMap::COL_AI_TRAINING_FORM, $this->ai_training_form);
        }
        if ($this->isColumnModified(PiecesTableMap::COL_AI_TRAINING_COLORED)) {
            $criteria->add(PiecesTableMap::COL_AI_TRAINING_COLORED, $this->ai_training_colored);
        }
        if ($this->isColumnModified(PiecesTableMap::COL_AI_TRAINING_FINAL)) {
            $criteria->add(PiecesTableMap::COL_AI_TRAINING_FINAL, $this->ai_training_final);
        }
        if ($this->isColumnModified(PiecesTableMap::COL_TRAINING_EXPORTS)) {
            $criteria->add(PiecesTableMap::COL_TRAINING_EXPORTS, $this->training_exports);
        }
        if ($this->isColumnModified(PiecesTableMap::COL_TRAINING_DESCRIPTIONS)) {
            $criteria->add(PiecesTableMap::COL_TRAINING_DESCRIPTIONS, $this->training_descriptions);
        }
        if ($this->isColumnModified(PiecesTableMap::COL_LOCATION)) {
            $criteria->add(PiecesTableMap::COL_LOCATION, $this->location);
        }
        if ($this->isColumnModified(PiecesTableMap::COL_THUMBNAIL)) {
            $criteria->add(PiecesTableMap::COL_THUMBNAIL, $this->thumbnail);
        }
        if ($this->isColumnModified(PiecesTableMap::COL_CREATED_AT)) {
            $criteria->add(PiecesTableMap::COL_CREATED_AT, $this->created_at);
        }
        if ($this->isColumnModified(PiecesTableMap::COL_UPDATED_AT)) {
            $criteria->add(PiecesTableMap::COL_UPDATED_AT, $this->updated_at);
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
        $criteria = ChildPiecesQuery::create();
        $criteria->add(PiecesTableMap::COL_ID, $this->id);

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
        $validPk = null !== $this->getId();

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
        return $this->getId();
    }

    /**
     * Generic method to set the primary key (id column).
     *
     * @param int|null $key Primary key.
     * @return void
     */
    public function setPrimaryKey(?int $key = null): void
    {
        $this->setId($key);
    }

    /**
     * Returns true if the primary key for this object is null.
     *
     * @return bool
     */
    public function isPrimaryKeyNull(): bool
    {
        return null === $this->getId();
    }

    /**
     * Sets contents of passed object to values from current object.
     *
     * If desired, this method can also make copies of all associated (fkey referrers)
     * objects.
     *
     * @param object $copyObj An object of \Art\Pieces (or compatible) type.
     * @param bool $deepCopy Whether to also copy all rows that refer (by fkey) to the current row.
     * @param bool $makeNew Whether to reset autoincrement PKs and make the object new.
     * @throws \Propel\Runtime\Exception\PropelException
     * @return void
     */
    public function copyInto(object $copyObj, bool $deepCopy = false, bool $makeNew = true): void
    {
        $copyObj->setTitle($this->getTitle());
        $copyObj->setStartDate($this->getStartDate());
        $copyObj->setEndDate($this->getEndDate());
        $copyObj->setCollection($this->getCollection());
        $copyObj->setSubcollection($this->getSubcollection());
        $copyObj->setSizeHeight($this->getSizeHeight());
        $copyObj->setSizeWidth($this->getSizeWidth());
        $copyObj->setSizeUnit($this->getSizeUnit());
        $copyObj->setTemperature($this->getTemperature());
        $copyObj->setBackground($this->getBackground());
        $copyObj->setColors($this->getColors());
        $copyObj->setDescription($this->getDescription());
        $copyObj->setStory($this->getStory());
        $copyObj->setNotes($this->getNotes());
        $copyObj->setAITrainingForm($this->getAITrainingForm());
        $copyObj->setAITrainingColored($this->getAITrainingColored());
        $copyObj->setAITrainingFinal($this->getAITrainingFinal());
        $copyObj->setTrainingExports($this->getTrainingExports());
        $copyObj->setTrainingDescriptions($this->getTrainingDescriptions());
        $copyObj->setLocation($this->getLocation());
        $copyObj->setThumbnail($this->getThumbnail());
        $copyObj->setCreatedAt($this->getCreatedAt());
        $copyObj->setUpdatedAt($this->getUpdatedAt());
        if ($makeNew) {
            $copyObj->setNew(true);
            $copyObj->setId(NULL); // this is a auto-increment column, so set to default value
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
     * @return \Art\Pieces Clone of current object.
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
        $this->id = null;
        $this->title = null;
        $this->start_date = null;
        $this->end_date = null;
        $this->collection = null;
        $this->subcollection = null;
        $this->size_height = null;
        $this->size_width = null;
        $this->size_unit = null;
        $this->temperature = null;
        $this->background = null;
        $this->colors = null;
        $this->description = null;
        $this->story = null;
        $this->notes = null;
        $this->ai_training_form = null;
        $this->ai_training_colored = null;
        $this->ai_training_final = null;
        $this->training_exports = null;
        $this->training_descriptions = null;
        $this->location = null;
        $this->thumbnail = null;
        $this->created_at = null;
        $this->updated_at = null;
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
        return (string) $this->exportTo(PiecesTableMap::DEFAULT_STRING_FORMAT);
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
