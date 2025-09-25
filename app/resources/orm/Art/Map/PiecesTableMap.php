<?php

namespace Art\Map;

use Art\Pieces;
use Art\PiecesQuery;
use Propel\Runtime\Propel;
use Propel\Runtime\ActiveQuery\Criteria;
use Propel\Runtime\ActiveQuery\InstancePoolTrait;
use Propel\Runtime\Connection\ConnectionInterface;
use Propel\Runtime\DataFetcher\DataFetcherInterface;
use Propel\Runtime\Exception\PropelException;
use Propel\Runtime\Map\RelationMap;
use Propel\Runtime\Map\TableMap;
use Propel\Runtime\Map\TableMapTrait;


/**
 * This class defines the structure of the 'pieces' table.
 *
 *
 *
 * This map class is used by Propel to do runtime db structure discovery.
 * For example, the createSelectSql() method checks the type of a given column used in an
 * ORDER BY clause to know whether it needs to apply SQL to make the ORDER BY case-insensitive
 * (i.e. if it's a text column type).
 */
class PiecesTableMap extends TableMap
{
    use InstancePoolTrait;
    use TableMapTrait;

    /**
     * The (dot-path) name of this class
     */
    public const CLASS_NAME = 'Art.Map.PiecesTableMap';

    /**
     * The default database name for this class
     */
    public const DATABASE_NAME = 'default';

    /**
     * The table name for this class
     */
    public const TABLE_NAME = 'pieces';

    /**
     * The PHP name of this class (PascalCase)
     */
    public const TABLE_PHP_NAME = 'Pieces';

    /**
     * The related Propel class for this table
     */
    public const OM_CLASS = '\\Art\\Pieces';

    /**
     * A class that can be returned by this tableMap
     */
    public const CLASS_DEFAULT = 'Art.Pieces';

    /**
     * The total number of columns
     */
    public const NUM_COLUMNS = 22;

    /**
     * The number of lazy-loaded columns
     */
    public const NUM_LAZY_LOAD_COLUMNS = 0;

    /**
     * The number of columns to hydrate (NUM_COLUMNS - NUM_LAZY_LOAD_COLUMNS)
     */
    public const NUM_HYDRATE_COLUMNS = 22;

    /**
     * the column name for the id field
     */
    public const COL_ID = 'pieces.id';

    /**
     * the column name for the title field
     */
    public const COL_TITLE = 'pieces.title';

    /**
     * the column name for the start_date field
     */
    public const COL_START_DATE = 'pieces.start_date';

    /**
     * the column name for the end_date field
     */
    public const COL_END_DATE = 'pieces.end_date';

    /**
     * the column name for the collection field
     */
    public const COL_COLLECTION = 'pieces.collection';

    /**
     * the column name for the subcollection field
     */
    public const COL_SUBCOLLECTION = 'pieces.subcollection';

    /**
     * the column name for the size_height field
     */
    public const COL_SIZE_HEIGHT = 'pieces.size_height';

    /**
     * the column name for the size_width field
     */
    public const COL_SIZE_WIDTH = 'pieces.size_width';

    /**
     * the column name for the size_unit field
     */
    public const COL_SIZE_UNIT = 'pieces.size_unit';

    /**
     * the column name for the temperature field
     */
    public const COL_TEMPERATURE = 'pieces.temperature';

    /**
     * the column name for the background field
     */
    public const COL_BACKGROUND = 'pieces.background';

    /**
     * the column name for the colors field
     */
    public const COL_COLORS = 'pieces.colors';

    /**
     * the column name for the description field
     */
    public const COL_DESCRIPTION = 'pieces.description';

    /**
     * the column name for the story field
     */
    public const COL_STORY = 'pieces.story';

    /**
     * the column name for the notes field
     */
    public const COL_NOTES = 'pieces.notes';

    /**
     * the column name for the ai_training_form field
     */
    public const COL_AI_TRAINING_FORM = 'pieces.ai_training_form';

    /**
     * the column name for the ai_training_colored field
     */
    public const COL_AI_TRAINING_COLORED = 'pieces.ai_training_colored';

    /**
     * the column name for the ai_training_final field
     */
    public const COL_AI_TRAINING_FINAL = 'pieces.ai_training_final';

    /**
     * the column name for the location field
     */
    public const COL_LOCATION = 'pieces.location';

    /**
     * the column name for the thumbnail field
     */
    public const COL_THUMBNAIL = 'pieces.thumbnail';

    /**
     * the column name for the created_at field
     */
    public const COL_CREATED_AT = 'pieces.created_at';

    /**
     * the column name for the updated_at field
     */
    public const COL_UPDATED_AT = 'pieces.updated_at';

    /**
     * The default string format for model objects of the related table
     */
    public const DEFAULT_STRING_FORMAT = 'YAML';

    /**
     * holds an array of fieldnames
     *
     * first dimension keys are the type constants
     * e.g. self::$fieldNames[self::TYPE_PHPNAME][0] = 'Id'
     *
     * @var array<string, mixed>
     */
    protected static $fieldNames = [
        self::TYPE_PHPNAME       => ['Id', 'Title', 'StartDate', 'EndDate', 'Collection', 'Subcollection', 'SizeHeight', 'SizeWidth', 'SizeUnit', 'Temperature', 'Background', 'Colors', 'Description', 'Story', 'Notes', 'AITrainingForm', 'AITrainingColored', 'AITrainingFinal', 'Location', 'Thumbnail', 'CreatedAt', 'UpdatedAt', ],
        self::TYPE_CAMELNAME     => ['id', 'title', 'startDate', 'endDate', 'collection', 'subcollection', 'sizeHeight', 'sizeWidth', 'sizeUnit', 'temperature', 'background', 'colors', 'description', 'story', 'notes', 'aITrainingForm', 'aITrainingColored', 'aITrainingFinal', 'location', 'thumbnail', 'createdAt', 'updatedAt', ],
        self::TYPE_COLNAME       => [PiecesTableMap::COL_ID, PiecesTableMap::COL_TITLE, PiecesTableMap::COL_START_DATE, PiecesTableMap::COL_END_DATE, PiecesTableMap::COL_COLLECTION, PiecesTableMap::COL_SUBCOLLECTION, PiecesTableMap::COL_SIZE_HEIGHT, PiecesTableMap::COL_SIZE_WIDTH, PiecesTableMap::COL_SIZE_UNIT, PiecesTableMap::COL_TEMPERATURE, PiecesTableMap::COL_BACKGROUND, PiecesTableMap::COL_COLORS, PiecesTableMap::COL_DESCRIPTION, PiecesTableMap::COL_STORY, PiecesTableMap::COL_NOTES, PiecesTableMap::COL_AI_TRAINING_FORM, PiecesTableMap::COL_AI_TRAINING_COLORED, PiecesTableMap::COL_AI_TRAINING_FINAL, PiecesTableMap::COL_LOCATION, PiecesTableMap::COL_THUMBNAIL, PiecesTableMap::COL_CREATED_AT, PiecesTableMap::COL_UPDATED_AT, ],
        self::TYPE_FIELDNAME     => ['id', 'title', 'start_date', 'end_date', 'collection', 'subcollection', 'size_height', 'size_width', 'size_unit', 'temperature', 'background', 'colors', 'description', 'story', 'notes', 'ai_training_form', 'ai_training_colored', 'ai_training_final', 'location', 'thumbnail', 'created_at', 'updated_at', ],
        self::TYPE_NUM           => [0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12, 13, 14, 15, 16, 17, 18, 19, 20, 21, ]
    ];

    /**
     * holds an array of keys for quick access to the fieldnames array
     *
     * first dimension keys are the type constants
     * e.g. self::$fieldKeys[self::TYPE_PHPNAME]['Id'] = 0
     *
     * @var array<string, mixed>
     */
    protected static $fieldKeys = [
        self::TYPE_PHPNAME       => ['Id' => 0, 'Title' => 1, 'StartDate' => 2, 'EndDate' => 3, 'Collection' => 4, 'Subcollection' => 5, 'SizeHeight' => 6, 'SizeWidth' => 7, 'SizeUnit' => 8, 'Temperature' => 9, 'Background' => 10, 'Colors' => 11, 'Description' => 12, 'Story' => 13, 'Notes' => 14, 'AITrainingForm' => 15, 'AITrainingColored' => 16, 'AITrainingFinal' => 17, 'Location' => 18, 'Thumbnail' => 19, 'CreatedAt' => 20, 'UpdatedAt' => 21, ],
        self::TYPE_CAMELNAME     => ['id' => 0, 'title' => 1, 'startDate' => 2, 'endDate' => 3, 'collection' => 4, 'subcollection' => 5, 'sizeHeight' => 6, 'sizeWidth' => 7, 'sizeUnit' => 8, 'temperature' => 9, 'background' => 10, 'colors' => 11, 'description' => 12, 'story' => 13, 'notes' => 14, 'aITrainingForm' => 15, 'aITrainingColored' => 16, 'aITrainingFinal' => 17, 'location' => 18, 'thumbnail' => 19, 'createdAt' => 20, 'updatedAt' => 21, ],
        self::TYPE_COLNAME       => [PiecesTableMap::COL_ID => 0, PiecesTableMap::COL_TITLE => 1, PiecesTableMap::COL_START_DATE => 2, PiecesTableMap::COL_END_DATE => 3, PiecesTableMap::COL_COLLECTION => 4, PiecesTableMap::COL_SUBCOLLECTION => 5, PiecesTableMap::COL_SIZE_HEIGHT => 6, PiecesTableMap::COL_SIZE_WIDTH => 7, PiecesTableMap::COL_SIZE_UNIT => 8, PiecesTableMap::COL_TEMPERATURE => 9, PiecesTableMap::COL_BACKGROUND => 10, PiecesTableMap::COL_COLORS => 11, PiecesTableMap::COL_DESCRIPTION => 12, PiecesTableMap::COL_STORY => 13, PiecesTableMap::COL_NOTES => 14, PiecesTableMap::COL_AI_TRAINING_FORM => 15, PiecesTableMap::COL_AI_TRAINING_COLORED => 16, PiecesTableMap::COL_AI_TRAINING_FINAL => 17, PiecesTableMap::COL_LOCATION => 18, PiecesTableMap::COL_THUMBNAIL => 19, PiecesTableMap::COL_CREATED_AT => 20, PiecesTableMap::COL_UPDATED_AT => 21, ],
        self::TYPE_FIELDNAME     => ['id' => 0, 'title' => 1, 'start_date' => 2, 'end_date' => 3, 'collection' => 4, 'subcollection' => 5, 'size_height' => 6, 'size_width' => 7, 'size_unit' => 8, 'temperature' => 9, 'background' => 10, 'colors' => 11, 'description' => 12, 'story' => 13, 'notes' => 14, 'ai_training_form' => 15, 'ai_training_colored' => 16, 'ai_training_final' => 17, 'location' => 18, 'thumbnail' => 19, 'created_at' => 20, 'updated_at' => 21, ],
        self::TYPE_NUM           => [0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12, 13, 14, 15, 16, 17, 18, 19, 20, 21, ]
    ];

    /**
     * Holds a list of column names and their normalized version.
     *
     * @var array<string>
     */
    protected $normalizedColumnNameMap = [
        'Id' => 'ID',
        'Pieces.Id' => 'ID',
        'id' => 'ID',
        'pieces.id' => 'ID',
        'PiecesTableMap::COL_ID' => 'ID',
        'COL_ID' => 'ID',
        'Title' => 'TITLE',
        'Pieces.Title' => 'TITLE',
        'title' => 'TITLE',
        'pieces.title' => 'TITLE',
        'PiecesTableMap::COL_TITLE' => 'TITLE',
        'COL_TITLE' => 'TITLE',
        'StartDate' => 'START_DATE',
        'Pieces.StartDate' => 'START_DATE',
        'startDate' => 'START_DATE',
        'pieces.startDate' => 'START_DATE',
        'PiecesTableMap::COL_START_DATE' => 'START_DATE',
        'COL_START_DATE' => 'START_DATE',
        'start_date' => 'START_DATE',
        'pieces.start_date' => 'START_DATE',
        'EndDate' => 'END_DATE',
        'Pieces.EndDate' => 'END_DATE',
        'endDate' => 'END_DATE',
        'pieces.endDate' => 'END_DATE',
        'PiecesTableMap::COL_END_DATE' => 'END_DATE',
        'COL_END_DATE' => 'END_DATE',
        'end_date' => 'END_DATE',
        'pieces.end_date' => 'END_DATE',
        'Collection' => 'COLLECTION',
        'Pieces.Collection' => 'COLLECTION',
        'collection' => 'COLLECTION',
        'pieces.collection' => 'COLLECTION',
        'PiecesTableMap::COL_COLLECTION' => 'COLLECTION',
        'COL_COLLECTION' => 'COLLECTION',
        'Subcollection' => 'SUBCOLLECTION',
        'Pieces.Subcollection' => 'SUBCOLLECTION',
        'subcollection' => 'SUBCOLLECTION',
        'pieces.subcollection' => 'SUBCOLLECTION',
        'PiecesTableMap::COL_SUBCOLLECTION' => 'SUBCOLLECTION',
        'COL_SUBCOLLECTION' => 'SUBCOLLECTION',
        'SizeHeight' => 'SIZE_HEIGHT',
        'Pieces.SizeHeight' => 'SIZE_HEIGHT',
        'sizeHeight' => 'SIZE_HEIGHT',
        'pieces.sizeHeight' => 'SIZE_HEIGHT',
        'PiecesTableMap::COL_SIZE_HEIGHT' => 'SIZE_HEIGHT',
        'COL_SIZE_HEIGHT' => 'SIZE_HEIGHT',
        'size_height' => 'SIZE_HEIGHT',
        'pieces.size_height' => 'SIZE_HEIGHT',
        'SizeWidth' => 'SIZE_WIDTH',
        'Pieces.SizeWidth' => 'SIZE_WIDTH',
        'sizeWidth' => 'SIZE_WIDTH',
        'pieces.sizeWidth' => 'SIZE_WIDTH',
        'PiecesTableMap::COL_SIZE_WIDTH' => 'SIZE_WIDTH',
        'COL_SIZE_WIDTH' => 'SIZE_WIDTH',
        'size_width' => 'SIZE_WIDTH',
        'pieces.size_width' => 'SIZE_WIDTH',
        'SizeUnit' => 'SIZE_UNIT',
        'Pieces.SizeUnit' => 'SIZE_UNIT',
        'sizeUnit' => 'SIZE_UNIT',
        'pieces.sizeUnit' => 'SIZE_UNIT',
        'PiecesTableMap::COL_SIZE_UNIT' => 'SIZE_UNIT',
        'COL_SIZE_UNIT' => 'SIZE_UNIT',
        'size_unit' => 'SIZE_UNIT',
        'pieces.size_unit' => 'SIZE_UNIT',
        'Temperature' => 'TEMPERATURE',
        'Pieces.Temperature' => 'TEMPERATURE',
        'temperature' => 'TEMPERATURE',
        'pieces.temperature' => 'TEMPERATURE',
        'PiecesTableMap::COL_TEMPERATURE' => 'TEMPERATURE',
        'COL_TEMPERATURE' => 'TEMPERATURE',
        'Background' => 'BACKGROUND',
        'Pieces.Background' => 'BACKGROUND',
        'background' => 'BACKGROUND',
        'pieces.background' => 'BACKGROUND',
        'PiecesTableMap::COL_BACKGROUND' => 'BACKGROUND',
        'COL_BACKGROUND' => 'BACKGROUND',
        'Colors' => 'COLORS',
        'Pieces.Colors' => 'COLORS',
        'colors' => 'COLORS',
        'pieces.colors' => 'COLORS',
        'PiecesTableMap::COL_COLORS' => 'COLORS',
        'COL_COLORS' => 'COLORS',
        'Description' => 'DESCRIPTION',
        'Pieces.Description' => 'DESCRIPTION',
        'description' => 'DESCRIPTION',
        'pieces.description' => 'DESCRIPTION',
        'PiecesTableMap::COL_DESCRIPTION' => 'DESCRIPTION',
        'COL_DESCRIPTION' => 'DESCRIPTION',
        'Story' => 'STORY',
        'Pieces.Story' => 'STORY',
        'story' => 'STORY',
        'pieces.story' => 'STORY',
        'PiecesTableMap::COL_STORY' => 'STORY',
        'COL_STORY' => 'STORY',
        'Notes' => 'NOTES',
        'Pieces.Notes' => 'NOTES',
        'notes' => 'NOTES',
        'pieces.notes' => 'NOTES',
        'PiecesTableMap::COL_NOTES' => 'NOTES',
        'COL_NOTES' => 'NOTES',
        'AITrainingForm' => 'AI_TRAINING_FORM',
        'Pieces.AITrainingForm' => 'AI_TRAINING_FORM',
        'aITrainingForm' => 'AI_TRAINING_FORM',
        'pieces.aITrainingForm' => 'AI_TRAINING_FORM',
        'PiecesTableMap::COL_AI_TRAINING_FORM' => 'AI_TRAINING_FORM',
        'COL_AI_TRAINING_FORM' => 'AI_TRAINING_FORM',
        'ai_training_form' => 'AI_TRAINING_FORM',
        'pieces.ai_training_form' => 'AI_TRAINING_FORM',
        'AITrainingColored' => 'AI_TRAINING_COLORED',
        'Pieces.AITrainingColored' => 'AI_TRAINING_COLORED',
        'aITrainingColored' => 'AI_TRAINING_COLORED',
        'pieces.aITrainingColored' => 'AI_TRAINING_COLORED',
        'PiecesTableMap::COL_AI_TRAINING_COLORED' => 'AI_TRAINING_COLORED',
        'COL_AI_TRAINING_COLORED' => 'AI_TRAINING_COLORED',
        'ai_training_colored' => 'AI_TRAINING_COLORED',
        'pieces.ai_training_colored' => 'AI_TRAINING_COLORED',
        'AITrainingFinal' => 'AI_TRAINING_FINAL',
        'Pieces.AITrainingFinal' => 'AI_TRAINING_FINAL',
        'aITrainingFinal' => 'AI_TRAINING_FINAL',
        'pieces.aITrainingFinal' => 'AI_TRAINING_FINAL',
        'PiecesTableMap::COL_AI_TRAINING_FINAL' => 'AI_TRAINING_FINAL',
        'COL_AI_TRAINING_FINAL' => 'AI_TRAINING_FINAL',
        'ai_training_final' => 'AI_TRAINING_FINAL',
        'pieces.ai_training_final' => 'AI_TRAINING_FINAL',
        'Location' => 'LOCATION',
        'Pieces.Location' => 'LOCATION',
        'location' => 'LOCATION',
        'pieces.location' => 'LOCATION',
        'PiecesTableMap::COL_LOCATION' => 'LOCATION',
        'COL_LOCATION' => 'LOCATION',
        'Thumbnail' => 'THUMBNAIL',
        'Pieces.Thumbnail' => 'THUMBNAIL',
        'thumbnail' => 'THUMBNAIL',
        'pieces.thumbnail' => 'THUMBNAIL',
        'PiecesTableMap::COL_THUMBNAIL' => 'THUMBNAIL',
        'COL_THUMBNAIL' => 'THUMBNAIL',
        'CreatedAt' => 'CREATED_AT',
        'Pieces.CreatedAt' => 'CREATED_AT',
        'createdAt' => 'CREATED_AT',
        'pieces.createdAt' => 'CREATED_AT',
        'PiecesTableMap::COL_CREATED_AT' => 'CREATED_AT',
        'COL_CREATED_AT' => 'CREATED_AT',
        'created_at' => 'CREATED_AT',
        'pieces.created_at' => 'CREATED_AT',
        'UpdatedAt' => 'UPDATED_AT',
        'Pieces.UpdatedAt' => 'UPDATED_AT',
        'updatedAt' => 'UPDATED_AT',
        'pieces.updatedAt' => 'UPDATED_AT',
        'PiecesTableMap::COL_UPDATED_AT' => 'UPDATED_AT',
        'COL_UPDATED_AT' => 'UPDATED_AT',
        'updated_at' => 'UPDATED_AT',
        'pieces.updated_at' => 'UPDATED_AT',
    ];

    /**
     * Initialize the table attributes and columns
     * Relations are not initialized by this method since they are lazy loaded
     *
     * @return void
     * @throws \Propel\Runtime\Exception\PropelException
     */
    public function initialize(): void
    {
        // attributes
        $this->setName('pieces');
        $this->setPhpName('Pieces');
        $this->setIdentifierQuoting(false);
        $this->setClassName('\\Art\\Pieces');
        $this->setPackage('Art');
        $this->setUseIdGenerator(true);
        // columns
        $this->addPrimaryKey('id', 'Id', 'INTEGER', true, null, null);
        $this->addColumn('title', 'Title', 'VARCHAR', true, 300, null);
        $this->addColumn('start_date', 'StartDate', 'VARCHAR', true, 10, null);
        $this->addColumn('end_date', 'EndDate', 'VARCHAR', true, 10, null);
        $this->addColumn('collection', 'Collection', 'VARCHAR', true, 300, null);
        $this->addColumn('subcollection', 'Subcollection', 'VARCHAR', true, 300, null);
        $this->addColumn('size_height', 'SizeHeight', 'VARCHAR', true, 7, null);
        $this->addColumn('size_width', 'SizeWidth', 'VARCHAR', true, 7, null);
        $this->addColumn('size_unit', 'SizeUnit', 'VARCHAR', true, 2, null);
        $this->addColumn('temperature', 'Temperature', 'VARCHAR', true, 300, null);
        $this->addColumn('background', 'Background', 'VARCHAR', true, 300, null);
        $this->addColumn('colors', 'Colors', 'VARCHAR', true, 300, null);
        $this->addColumn('description', 'Description', 'LONGVARCHAR', true, null, null);
        $this->addColumn('story', 'Story', 'LONGVARCHAR', true, null, null);
        $this->addColumn('notes', 'Notes', 'LONGVARCHAR', true, null, null);
        $this->addColumn('ai_training_form', 'AITrainingForm', 'LONGVARCHAR', true, null, null);
        $this->addColumn('ai_training_colored', 'AITrainingColored', 'LONGVARCHAR', true, null, null);
        $this->addColumn('ai_training_final', 'AITrainingFinal', 'LONGVARCHAR', true, null, null);
        $this->addColumn('location', 'Location', 'VARCHAR', true, 300, null);
        $this->addColumn('thumbnail', 'Thumbnail', 'VARCHAR', true, 300, null);
        $this->addColumn('created_at', 'CreatedAt', 'TIMESTAMP', true, null, 'CURRENT_TIMESTAMP');
        $this->addColumn('updated_at', 'UpdatedAt', 'TIMESTAMP', true, null, 'CURRENT_TIMESTAMP');
    }

    /**
     * Build the RelationMap objects for this table relationships
     *
     * @return void
     */
    public function buildRelations(): void
    {
    }

    /**
     * Retrieves a string version of the primary key from the DB resultset row that can be used to uniquely identify a row in this table.
     *
     * For tables with a single-column primary key, that simple pkey value will be returned.  For tables with
     * a multi-column primary key, a serialize()d version of the primary key will be returned.
     *
     * @param array $row Resultset row.
     * @param int $offset The 0-based offset for reading from the resultset row.
     * @param string $indexType One of the class type constants TableMap::TYPE_PHPNAME, TableMap::TYPE_CAMELNAME
     *                           TableMap::TYPE_COLNAME, TableMap::TYPE_FIELDNAME, TableMap::TYPE_NUM
     *
     * @return string|null The primary key hash of the row
     */
    public static function getPrimaryKeyHashFromRow(array $row, int $offset = 0, string $indexType = TableMap::TYPE_NUM): ?string
    {
        // If the PK cannot be derived from the row, return NULL.
        if ($row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('Id', TableMap::TYPE_PHPNAME, $indexType)] === null) {
            return null;
        }

        return null === $row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('Id', TableMap::TYPE_PHPNAME, $indexType)] || is_scalar($row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('Id', TableMap::TYPE_PHPNAME, $indexType)]) || is_callable([$row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('Id', TableMap::TYPE_PHPNAME, $indexType)], '__toString']) ? (string) $row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('Id', TableMap::TYPE_PHPNAME, $indexType)] : $row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('Id', TableMap::TYPE_PHPNAME, $indexType)];
    }

    /**
     * Retrieves the primary key from the DB resultset row
     * For tables with a single-column primary key, that simple pkey value will be returned.  For tables with
     * a multi-column primary key, an array of the primary key columns will be returned.
     *
     * @param array $row Resultset row.
     * @param int $offset The 0-based offset for reading from the resultset row.
     * @param string $indexType One of the class type constants TableMap::TYPE_PHPNAME, TableMap::TYPE_CAMELNAME
     *                           TableMap::TYPE_COLNAME, TableMap::TYPE_FIELDNAME, TableMap::TYPE_NUM
     *
     * @return mixed The primary key of the row
     */
    public static function getPrimaryKeyFromRow(array $row, int $offset = 0, string $indexType = TableMap::TYPE_NUM)
    {
        return (int) $row[
            $indexType == TableMap::TYPE_NUM
                ? 0 + $offset
                : self::translateFieldName('Id', TableMap::TYPE_PHPNAME, $indexType)
        ];
    }

    /**
     * The class that the tableMap will make instances of.
     *
     * If $withPrefix is true, the returned path
     * uses a dot-path notation which is translated into a path
     * relative to a location on the PHP include_path.
     * (e.g. path.to.MyClass -> 'path/to/MyClass.php')
     *
     * @param bool $withPrefix Whether to return the path with the class name
     * @return string path.to.ClassName
     */
    public static function getOMClass(bool $withPrefix = true): string
    {
        return $withPrefix ? PiecesTableMap::CLASS_DEFAULT : PiecesTableMap::OM_CLASS;
    }

    /**
     * Populates an object of the default type or an object that inherit from the default.
     *
     * @param array $row Row returned by DataFetcher->fetch().
     * @param int $offset The 0-based offset for reading from the resultset row.
     * @param string $indexType The index type of $row. Mostly DataFetcher->getIndexType().
                                 One of the class type constants TableMap::TYPE_PHPNAME, TableMap::TYPE_CAMELNAME
     *                           TableMap::TYPE_COLNAME, TableMap::TYPE_FIELDNAME, TableMap::TYPE_NUM.
     *
     * @throws \Propel\Runtime\Exception\PropelException Any exceptions caught during processing will be
     *                         rethrown wrapped into a PropelException.
     * @return array (Pieces object, last column rank)
     */
    public static function populateObject(array $row, int $offset = 0, string $indexType = TableMap::TYPE_NUM): array
    {
        $key = PiecesTableMap::getPrimaryKeyHashFromRow($row, $offset, $indexType);
        if (null !== ($obj = PiecesTableMap::getInstanceFromPool($key))) {
            // We no longer rehydrate the object, since this can cause data loss.
            // See http://www.propelorm.org/ticket/509
            // $obj->hydrate($row, $offset, true); // rehydrate
            $col = $offset + PiecesTableMap::NUM_HYDRATE_COLUMNS;
        } else {
            $cls = PiecesTableMap::OM_CLASS;
            /** @var Pieces $obj */
            $obj = new $cls();
            $col = $obj->hydrate($row, $offset, false, $indexType);
            PiecesTableMap::addInstanceToPool($obj, $key);
        }

        return [$obj, $col];
    }

    /**
     * The returned array will contain objects of the default type or
     * objects that inherit from the default.
     *
     * @param DataFetcherInterface $dataFetcher
     * @return array<object>
     * @throws \Propel\Runtime\Exception\PropelException Any exceptions caught during processing will be
     *                         rethrown wrapped into a PropelException.
     */
    public static function populateObjects(DataFetcherInterface $dataFetcher): array
    {
        $results = [];

        // set the class once to avoid overhead in the loop
        $cls = static::getOMClass(false);
        // populate the object(s)
        while ($row = $dataFetcher->fetch()) {
            $key = PiecesTableMap::getPrimaryKeyHashFromRow($row, 0, $dataFetcher->getIndexType());
            if (null !== ($obj = PiecesTableMap::getInstanceFromPool($key))) {
                // We no longer rehydrate the object, since this can cause data loss.
                // See http://www.propelorm.org/ticket/509
                // $obj->hydrate($row, 0, true); // rehydrate
                $results[] = $obj;
            } else {
                /** @var Pieces $obj */
                $obj = new $cls();
                $obj->hydrate($row);
                $results[] = $obj;
                PiecesTableMap::addInstanceToPool($obj, $key);
            } // if key exists
        }

        return $results;
    }
    /**
     * Add all the columns needed to create a new object.
     *
     * Note: any columns that were marked with lazyLoad="true" in the
     * XML schema will not be added to the select list and only loaded
     * on demand.
     *
     * @param Criteria $criteria Object containing the columns to add.
     * @param string|null $alias Optional table alias
     * @throws \Propel\Runtime\Exception\PropelException Any exceptions caught during processing will be
     *                         rethrown wrapped into a PropelException.
     * @return void
     */
    public static function addSelectColumns(Criteria $criteria, ?string $alias = null): void
    {
        if (null === $alias) {
            $criteria->addSelectColumn(PiecesTableMap::COL_ID);
            $criteria->addSelectColumn(PiecesTableMap::COL_TITLE);
            $criteria->addSelectColumn(PiecesTableMap::COL_START_DATE);
            $criteria->addSelectColumn(PiecesTableMap::COL_END_DATE);
            $criteria->addSelectColumn(PiecesTableMap::COL_COLLECTION);
            $criteria->addSelectColumn(PiecesTableMap::COL_SUBCOLLECTION);
            $criteria->addSelectColumn(PiecesTableMap::COL_SIZE_HEIGHT);
            $criteria->addSelectColumn(PiecesTableMap::COL_SIZE_WIDTH);
            $criteria->addSelectColumn(PiecesTableMap::COL_SIZE_UNIT);
            $criteria->addSelectColumn(PiecesTableMap::COL_TEMPERATURE);
            $criteria->addSelectColumn(PiecesTableMap::COL_BACKGROUND);
            $criteria->addSelectColumn(PiecesTableMap::COL_COLORS);
            $criteria->addSelectColumn(PiecesTableMap::COL_DESCRIPTION);
            $criteria->addSelectColumn(PiecesTableMap::COL_STORY);
            $criteria->addSelectColumn(PiecesTableMap::COL_NOTES);
            $criteria->addSelectColumn(PiecesTableMap::COL_AI_TRAINING_FORM);
            $criteria->addSelectColumn(PiecesTableMap::COL_AI_TRAINING_COLORED);
            $criteria->addSelectColumn(PiecesTableMap::COL_AI_TRAINING_FINAL);
            $criteria->addSelectColumn(PiecesTableMap::COL_LOCATION);
            $criteria->addSelectColumn(PiecesTableMap::COL_THUMBNAIL);
            $criteria->addSelectColumn(PiecesTableMap::COL_CREATED_AT);
            $criteria->addSelectColumn(PiecesTableMap::COL_UPDATED_AT);
        } else {
            $criteria->addSelectColumn($alias . '.id');
            $criteria->addSelectColumn($alias . '.title');
            $criteria->addSelectColumn($alias . '.start_date');
            $criteria->addSelectColumn($alias . '.end_date');
            $criteria->addSelectColumn($alias . '.collection');
            $criteria->addSelectColumn($alias . '.subcollection');
            $criteria->addSelectColumn($alias . '.size_height');
            $criteria->addSelectColumn($alias . '.size_width');
            $criteria->addSelectColumn($alias . '.size_unit');
            $criteria->addSelectColumn($alias . '.temperature');
            $criteria->addSelectColumn($alias . '.background');
            $criteria->addSelectColumn($alias . '.colors');
            $criteria->addSelectColumn($alias . '.description');
            $criteria->addSelectColumn($alias . '.story');
            $criteria->addSelectColumn($alias . '.notes');
            $criteria->addSelectColumn($alias . '.ai_training_form');
            $criteria->addSelectColumn($alias . '.ai_training_colored');
            $criteria->addSelectColumn($alias . '.ai_training_final');
            $criteria->addSelectColumn($alias . '.location');
            $criteria->addSelectColumn($alias . '.thumbnail');
            $criteria->addSelectColumn($alias . '.created_at');
            $criteria->addSelectColumn($alias . '.updated_at');
        }
    }

    /**
     * Remove all the columns needed to create a new object.
     *
     * Note: any columns that were marked with lazyLoad="true" in the
     * XML schema will not be removed as they are only loaded on demand.
     *
     * @param Criteria $criteria Object containing the columns to remove.
     * @param string|null $alias Optional table alias
     * @throws \Propel\Runtime\Exception\PropelException Any exceptions caught during processing will be
     *                         rethrown wrapped into a PropelException.
     * @return void
     */
    public static function removeSelectColumns(Criteria $criteria, ?string $alias = null): void
    {
        if (null === $alias) {
            $criteria->removeSelectColumn(PiecesTableMap::COL_ID);
            $criteria->removeSelectColumn(PiecesTableMap::COL_TITLE);
            $criteria->removeSelectColumn(PiecesTableMap::COL_START_DATE);
            $criteria->removeSelectColumn(PiecesTableMap::COL_END_DATE);
            $criteria->removeSelectColumn(PiecesTableMap::COL_COLLECTION);
            $criteria->removeSelectColumn(PiecesTableMap::COL_SUBCOLLECTION);
            $criteria->removeSelectColumn(PiecesTableMap::COL_SIZE_HEIGHT);
            $criteria->removeSelectColumn(PiecesTableMap::COL_SIZE_WIDTH);
            $criteria->removeSelectColumn(PiecesTableMap::COL_SIZE_UNIT);
            $criteria->removeSelectColumn(PiecesTableMap::COL_TEMPERATURE);
            $criteria->removeSelectColumn(PiecesTableMap::COL_BACKGROUND);
            $criteria->removeSelectColumn(PiecesTableMap::COL_COLORS);
            $criteria->removeSelectColumn(PiecesTableMap::COL_DESCRIPTION);
            $criteria->removeSelectColumn(PiecesTableMap::COL_STORY);
            $criteria->removeSelectColumn(PiecesTableMap::COL_NOTES);
            $criteria->removeSelectColumn(PiecesTableMap::COL_AI_TRAINING_FORM);
            $criteria->removeSelectColumn(PiecesTableMap::COL_AI_TRAINING_COLORED);
            $criteria->removeSelectColumn(PiecesTableMap::COL_AI_TRAINING_FINAL);
            $criteria->removeSelectColumn(PiecesTableMap::COL_LOCATION);
            $criteria->removeSelectColumn(PiecesTableMap::COL_THUMBNAIL);
            $criteria->removeSelectColumn(PiecesTableMap::COL_CREATED_AT);
            $criteria->removeSelectColumn(PiecesTableMap::COL_UPDATED_AT);
        } else {
            $criteria->removeSelectColumn($alias . '.id');
            $criteria->removeSelectColumn($alias . '.title');
            $criteria->removeSelectColumn($alias . '.start_date');
            $criteria->removeSelectColumn($alias . '.end_date');
            $criteria->removeSelectColumn($alias . '.collection');
            $criteria->removeSelectColumn($alias . '.subcollection');
            $criteria->removeSelectColumn($alias . '.size_height');
            $criteria->removeSelectColumn($alias . '.size_width');
            $criteria->removeSelectColumn($alias . '.size_unit');
            $criteria->removeSelectColumn($alias . '.temperature');
            $criteria->removeSelectColumn($alias . '.background');
            $criteria->removeSelectColumn($alias . '.colors');
            $criteria->removeSelectColumn($alias . '.description');
            $criteria->removeSelectColumn($alias . '.story');
            $criteria->removeSelectColumn($alias . '.notes');
            $criteria->removeSelectColumn($alias . '.ai_training_form');
            $criteria->removeSelectColumn($alias . '.ai_training_colored');
            $criteria->removeSelectColumn($alias . '.ai_training_final');
            $criteria->removeSelectColumn($alias . '.location');
            $criteria->removeSelectColumn($alias . '.thumbnail');
            $criteria->removeSelectColumn($alias . '.created_at');
            $criteria->removeSelectColumn($alias . '.updated_at');
        }
    }

    /**
     * Returns the TableMap related to this object.
     * This method is not needed for general use but a specific application could have a need.
     * @return TableMap
     * @throws \Propel\Runtime\Exception\PropelException Any exceptions caught during processing will be
     *                         rethrown wrapped into a PropelException.
     */
    public static function getTableMap(): TableMap
    {
        return Propel::getServiceContainer()->getDatabaseMap(PiecesTableMap::DATABASE_NAME)->getTable(PiecesTableMap::TABLE_NAME);
    }

    /**
     * Performs a DELETE on the database, given a Pieces or Criteria object OR a primary key value.
     *
     * @param mixed $values Criteria or Pieces object or primary key or array of primary keys
     *              which is used to create the DELETE statement
     * @param ConnectionInterface $con the connection to use
     * @return int The number of affected rows (if supported by underlying database driver).  This includes CASCADE-related rows
     *                         if supported by native driver or if emulated using Propel.
     * @throws \Propel\Runtime\Exception\PropelException Any exceptions caught during processing will be
     *                         rethrown wrapped into a PropelException.
     */
     public static function doDelete($values, ?ConnectionInterface $con = null): int
     {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(PiecesTableMap::DATABASE_NAME);
        }

        if ($values instanceof Criteria) {
            // rename for clarity
            $criteria = $values;
        } elseif ($values instanceof \Art\Pieces) { // it's a model object
            // create criteria based on pk values
            $criteria = $values->buildPkeyCriteria();
        } else { // it's a primary key, or an array of pks
            $criteria = new Criteria(PiecesTableMap::DATABASE_NAME);
            $criteria->add(PiecesTableMap::COL_ID, (array) $values, Criteria::IN);
        }

        $query = PiecesQuery::create()->mergeWith($criteria);

        if ($values instanceof Criteria) {
            PiecesTableMap::clearInstancePool();
        } elseif (!is_object($values)) { // it's a primary key, or an array of pks
            foreach ((array) $values as $singleval) {
                PiecesTableMap::removeInstanceFromPool($singleval);
            }
        }

        return $query->delete($con);
    }

    /**
     * Deletes all rows from the pieces table.
     *
     * @param ConnectionInterface $con the connection to use
     * @return int The number of affected rows (if supported by underlying database driver).
     */
    public static function doDeleteAll(?ConnectionInterface $con = null): int
    {
        return PiecesQuery::create()->doDeleteAll($con);
    }

    /**
     * Performs an INSERT on the database, given a Pieces or Criteria object.
     *
     * @param mixed $criteria Criteria or Pieces object containing data that is used to create the INSERT statement.
     * @param ConnectionInterface $con the ConnectionInterface connection to use
     * @return mixed The new primary key.
     * @throws \Propel\Runtime\Exception\PropelException Any exceptions caught during processing will be
     *                         rethrown wrapped into a PropelException.
     */
    public static function doInsert($criteria, ?ConnectionInterface $con = null)
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(PiecesTableMap::DATABASE_NAME);
        }

        if ($criteria instanceof Criteria) {
            $criteria = clone $criteria; // rename for clarity
        } else {
            $criteria = $criteria->buildCriteria(); // build Criteria from Pieces object
        }

        if ($criteria->containsKey(PiecesTableMap::COL_ID) && $criteria->keyContainsValue(PiecesTableMap::COL_ID) ) {
            throw new PropelException('Cannot insert a value for auto-increment primary key ('.PiecesTableMap::COL_ID.')');
        }


        // Set the correct dbName
        $query = PiecesQuery::create()->mergeWith($criteria);

        // use transaction because $criteria could contain info
        // for more than one table (I guess, conceivably)
        return $con->transaction(function () use ($con, $query) {
            return $query->doInsert($con);
        });
    }

}
