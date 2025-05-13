<?php

namespace Art\Map;

use Art\Cfa;
use Art\CfaQuery;
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
 * This class defines the structure of the 'cfa' table.
 *
 *
 *
 * This map class is used by Propel to do runtime db structure discovery.
 * For example, the createSelectSql() method checks the type of a given column used in an
 * ORDER BY clause to know whether it needs to apply SQL to make the ORDER BY case-insensitive
 * (i.e. if it's a text column type).
 */
class CfaTableMap extends TableMap
{
    use InstancePoolTrait;
    use TableMapTrait;

    /**
     * The (dot-path) name of this class
     */
    public const CLASS_NAME = 'Art.Map.CfaTableMap';

    /**
     * The default database name for this class
     */
    public const DATABASE_NAME = 'default';

    /**
     * The table name for this class
     */
    public const TABLE_NAME = 'cfa';

    /**
     * The PHP name of this class (PascalCase)
     */
    public const TABLE_PHP_NAME = 'Cfa';

    /**
     * The related Propel class for this table
     */
    public const OM_CLASS = '\\Art\\Cfa';

    /**
     * A class that can be returned by this tableMap
     */
    public const CLASS_DEFAULT = 'Art.Cfa';

    /**
     * The total number of columns
     */
    public const NUM_COLUMNS = 17;

    /**
     * The number of lazy-loaded columns
     */
    public const NUM_LAZY_LOAD_COLUMNS = 0;

    /**
     * The number of columns to hydrate (NUM_COLUMNS - NUM_LAZY_LOAD_COLUMNS)
     */
    public const NUM_HYDRATE_COLUMNS = 17;

    /**
     * the column name for the record_id field
     */
    public const COL_RECORD_ID = 'cfa.record_id';

    /**
     * the column name for the created_at field
     */
    public const COL_CREATED_AT = 'cfa.created_at';

    /**
     * the column name for the updated_at field
     */
    public const COL_UPDATED_AT = 'cfa.updated_at';

    /**
     * the column name for the piece_id field
     */
    public const COL_PIECE_ID = 'cfa.piece_id';

    /**
     * the column name for the piece_id_run field
     */
    public const COL_PIECE_ID_RUN = 'cfa.piece_id_run';

    /**
     * the column name for the piece_id_count field
     */
    public const COL_PIECE_ID_COUNT = 'cfa.piece_id_count';

    /**
     * the column name for the print_company field
     */
    public const COL_PRINT_COMPANY = 'cfa.print_company';

    /**
     * the column name for the print_date_sent field
     */
    public const COL_PRINT_DATE_SENT = 'cfa.print_date_sent';

    /**
     * the column name for the print_date_receipt field
     */
    public const COL_PRINT_DATE_RECEIPT = 'cfa.print_date_receipt';

    /**
     * the column name for the print_medium field
     */
    public const COL_PRINT_MEDIUM = 'cfa.print_medium';

    /**
     * the column name for the print_cost field
     */
    public const COL_PRINT_COST = 'cfa.print_cost';

    /**
     * the column name for the print_notes field
     */
    public const COL_PRINT_NOTES = 'cfa.print_notes';

    /**
     * the column name for the buyer_name field
     */
    public const COL_BUYER_NAME = 'cfa.buyer_name';

    /**
     * the column name for the buyer_location field
     */
    public const COL_BUYER_LOCATION = 'cfa.buyer_location';

    /**
     * the column name for the buyer_date_purchase field
     */
    public const COL_BUYER_DATE_PURCHASE = 'cfa.buyer_date_purchase';

    /**
     * the column name for the buyer_date_receipt field
     */
    public const COL_BUYER_DATE_RECEIPT = 'cfa.buyer_date_receipt';

    /**
     * the column name for the notes field
     */
    public const COL_NOTES = 'cfa.notes';

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
        self::TYPE_PHPNAME       => ['RecordId', 'CreatedAt', 'UpdatedAt', 'PieceId', 'PieceIdRun', 'PieceIdCount', 'PrintCompany', 'PrintDateSent', 'PrintDateReceipt', 'PrintMedium', 'PrintCost', 'PrintNotes', 'BuyerName', 'BuyerLocation', 'BuyerDatePurchase', 'BuyerDateReceipt', 'Notes', ],
        self::TYPE_CAMELNAME     => ['recordId', 'createdAt', 'updatedAt', 'pieceId', 'pieceIdRun', 'pieceIdCount', 'printCompany', 'printDateSent', 'printDateReceipt', 'printMedium', 'printCost', 'printNotes', 'buyerName', 'buyerLocation', 'buyerDatePurchase', 'buyerDateReceipt', 'notes', ],
        self::TYPE_COLNAME       => [CfaTableMap::COL_RECORD_ID, CfaTableMap::COL_CREATED_AT, CfaTableMap::COL_UPDATED_AT, CfaTableMap::COL_PIECE_ID, CfaTableMap::COL_PIECE_ID_RUN, CfaTableMap::COL_PIECE_ID_COUNT, CfaTableMap::COL_PRINT_COMPANY, CfaTableMap::COL_PRINT_DATE_SENT, CfaTableMap::COL_PRINT_DATE_RECEIPT, CfaTableMap::COL_PRINT_MEDIUM, CfaTableMap::COL_PRINT_COST, CfaTableMap::COL_PRINT_NOTES, CfaTableMap::COL_BUYER_NAME, CfaTableMap::COL_BUYER_LOCATION, CfaTableMap::COL_BUYER_DATE_PURCHASE, CfaTableMap::COL_BUYER_DATE_RECEIPT, CfaTableMap::COL_NOTES, ],
        self::TYPE_FIELDNAME     => ['record_id', 'created_at', 'updated_at', 'piece_id', 'piece_id_run', 'piece_id_count', 'print_company', 'print_date_sent', 'print_date_receipt', 'print_medium', 'print_cost', 'print_notes', 'buyer_name', 'buyer_location', 'buyer_date_purchase', 'buyer_date_receipt', 'notes', ],
        self::TYPE_NUM           => [0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12, 13, 14, 15, 16, ]
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
        self::TYPE_PHPNAME       => ['RecordId' => 0, 'CreatedAt' => 1, 'UpdatedAt' => 2, 'PieceId' => 3, 'PieceIdRun' => 4, 'PieceIdCount' => 5, 'PrintCompany' => 6, 'PrintDateSent' => 7, 'PrintDateReceipt' => 8, 'PrintMedium' => 9, 'PrintCost' => 10, 'PrintNotes' => 11, 'BuyerName' => 12, 'BuyerLocation' => 13, 'BuyerDatePurchase' => 14, 'BuyerDateReceipt' => 15, 'Notes' => 16, ],
        self::TYPE_CAMELNAME     => ['recordId' => 0, 'createdAt' => 1, 'updatedAt' => 2, 'pieceId' => 3, 'pieceIdRun' => 4, 'pieceIdCount' => 5, 'printCompany' => 6, 'printDateSent' => 7, 'printDateReceipt' => 8, 'printMedium' => 9, 'printCost' => 10, 'printNotes' => 11, 'buyerName' => 12, 'buyerLocation' => 13, 'buyerDatePurchase' => 14, 'buyerDateReceipt' => 15, 'notes' => 16, ],
        self::TYPE_COLNAME       => [CfaTableMap::COL_RECORD_ID => 0, CfaTableMap::COL_CREATED_AT => 1, CfaTableMap::COL_UPDATED_AT => 2, CfaTableMap::COL_PIECE_ID => 3, CfaTableMap::COL_PIECE_ID_RUN => 4, CfaTableMap::COL_PIECE_ID_COUNT => 5, CfaTableMap::COL_PRINT_COMPANY => 6, CfaTableMap::COL_PRINT_DATE_SENT => 7, CfaTableMap::COL_PRINT_DATE_RECEIPT => 8, CfaTableMap::COL_PRINT_MEDIUM => 9, CfaTableMap::COL_PRINT_COST => 10, CfaTableMap::COL_PRINT_NOTES => 11, CfaTableMap::COL_BUYER_NAME => 12, CfaTableMap::COL_BUYER_LOCATION => 13, CfaTableMap::COL_BUYER_DATE_PURCHASE => 14, CfaTableMap::COL_BUYER_DATE_RECEIPT => 15, CfaTableMap::COL_NOTES => 16, ],
        self::TYPE_FIELDNAME     => ['record_id' => 0, 'created_at' => 1, 'updated_at' => 2, 'piece_id' => 3, 'piece_id_run' => 4, 'piece_id_count' => 5, 'print_company' => 6, 'print_date_sent' => 7, 'print_date_receipt' => 8, 'print_medium' => 9, 'print_cost' => 10, 'print_notes' => 11, 'buyer_name' => 12, 'buyer_location' => 13, 'buyer_date_purchase' => 14, 'buyer_date_receipt' => 15, 'notes' => 16, ],
        self::TYPE_NUM           => [0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12, 13, 14, 15, 16, ]
    ];

    /**
     * Holds a list of column names and their normalized version.
     *
     * @var array<string>
     */
    protected $normalizedColumnNameMap = [
        'RecordId' => 'RECORD_ID',
        'Cfa.RecordId' => 'RECORD_ID',
        'recordId' => 'RECORD_ID',
        'cfa.recordId' => 'RECORD_ID',
        'CfaTableMap::COL_RECORD_ID' => 'RECORD_ID',
        'COL_RECORD_ID' => 'RECORD_ID',
        'record_id' => 'RECORD_ID',
        'cfa.record_id' => 'RECORD_ID',
        'CreatedAt' => 'CREATED_AT',
        'Cfa.CreatedAt' => 'CREATED_AT',
        'createdAt' => 'CREATED_AT',
        'cfa.createdAt' => 'CREATED_AT',
        'CfaTableMap::COL_CREATED_AT' => 'CREATED_AT',
        'COL_CREATED_AT' => 'CREATED_AT',
        'created_at' => 'CREATED_AT',
        'cfa.created_at' => 'CREATED_AT',
        'UpdatedAt' => 'UPDATED_AT',
        'Cfa.UpdatedAt' => 'UPDATED_AT',
        'updatedAt' => 'UPDATED_AT',
        'cfa.updatedAt' => 'UPDATED_AT',
        'CfaTableMap::COL_UPDATED_AT' => 'UPDATED_AT',
        'COL_UPDATED_AT' => 'UPDATED_AT',
        'updated_at' => 'UPDATED_AT',
        'cfa.updated_at' => 'UPDATED_AT',
        'PieceId' => 'PIECE_ID',
        'Cfa.PieceId' => 'PIECE_ID',
        'pieceId' => 'PIECE_ID',
        'cfa.pieceId' => 'PIECE_ID',
        'CfaTableMap::COL_PIECE_ID' => 'PIECE_ID',
        'COL_PIECE_ID' => 'PIECE_ID',
        'piece_id' => 'PIECE_ID',
        'cfa.piece_id' => 'PIECE_ID',
        'PieceIdRun' => 'PIECE_ID_RUN',
        'Cfa.PieceIdRun' => 'PIECE_ID_RUN',
        'pieceIdRun' => 'PIECE_ID_RUN',
        'cfa.pieceIdRun' => 'PIECE_ID_RUN',
        'CfaTableMap::COL_PIECE_ID_RUN' => 'PIECE_ID_RUN',
        'COL_PIECE_ID_RUN' => 'PIECE_ID_RUN',
        'piece_id_run' => 'PIECE_ID_RUN',
        'cfa.piece_id_run' => 'PIECE_ID_RUN',
        'PieceIdCount' => 'PIECE_ID_COUNT',
        'Cfa.PieceIdCount' => 'PIECE_ID_COUNT',
        'pieceIdCount' => 'PIECE_ID_COUNT',
        'cfa.pieceIdCount' => 'PIECE_ID_COUNT',
        'CfaTableMap::COL_PIECE_ID_COUNT' => 'PIECE_ID_COUNT',
        'COL_PIECE_ID_COUNT' => 'PIECE_ID_COUNT',
        'piece_id_count' => 'PIECE_ID_COUNT',
        'cfa.piece_id_count' => 'PIECE_ID_COUNT',
        'PrintCompany' => 'PRINT_COMPANY',
        'Cfa.PrintCompany' => 'PRINT_COMPANY',
        'printCompany' => 'PRINT_COMPANY',
        'cfa.printCompany' => 'PRINT_COMPANY',
        'CfaTableMap::COL_PRINT_COMPANY' => 'PRINT_COMPANY',
        'COL_PRINT_COMPANY' => 'PRINT_COMPANY',
        'print_company' => 'PRINT_COMPANY',
        'cfa.print_company' => 'PRINT_COMPANY',
        'PrintDateSent' => 'PRINT_DATE_SENT',
        'Cfa.PrintDateSent' => 'PRINT_DATE_SENT',
        'printDateSent' => 'PRINT_DATE_SENT',
        'cfa.printDateSent' => 'PRINT_DATE_SENT',
        'CfaTableMap::COL_PRINT_DATE_SENT' => 'PRINT_DATE_SENT',
        'COL_PRINT_DATE_SENT' => 'PRINT_DATE_SENT',
        'print_date_sent' => 'PRINT_DATE_SENT',
        'cfa.print_date_sent' => 'PRINT_DATE_SENT',
        'PrintDateReceipt' => 'PRINT_DATE_RECEIPT',
        'Cfa.PrintDateReceipt' => 'PRINT_DATE_RECEIPT',
        'printDateReceipt' => 'PRINT_DATE_RECEIPT',
        'cfa.printDateReceipt' => 'PRINT_DATE_RECEIPT',
        'CfaTableMap::COL_PRINT_DATE_RECEIPT' => 'PRINT_DATE_RECEIPT',
        'COL_PRINT_DATE_RECEIPT' => 'PRINT_DATE_RECEIPT',
        'print_date_receipt' => 'PRINT_DATE_RECEIPT',
        'cfa.print_date_receipt' => 'PRINT_DATE_RECEIPT',
        'PrintMedium' => 'PRINT_MEDIUM',
        'Cfa.PrintMedium' => 'PRINT_MEDIUM',
        'printMedium' => 'PRINT_MEDIUM',
        'cfa.printMedium' => 'PRINT_MEDIUM',
        'CfaTableMap::COL_PRINT_MEDIUM' => 'PRINT_MEDIUM',
        'COL_PRINT_MEDIUM' => 'PRINT_MEDIUM',
        'print_medium' => 'PRINT_MEDIUM',
        'cfa.print_medium' => 'PRINT_MEDIUM',
        'PrintCost' => 'PRINT_COST',
        'Cfa.PrintCost' => 'PRINT_COST',
        'printCost' => 'PRINT_COST',
        'cfa.printCost' => 'PRINT_COST',
        'CfaTableMap::COL_PRINT_COST' => 'PRINT_COST',
        'COL_PRINT_COST' => 'PRINT_COST',
        'print_cost' => 'PRINT_COST',
        'cfa.print_cost' => 'PRINT_COST',
        'PrintNotes' => 'PRINT_NOTES',
        'Cfa.PrintNotes' => 'PRINT_NOTES',
        'printNotes' => 'PRINT_NOTES',
        'cfa.printNotes' => 'PRINT_NOTES',
        'CfaTableMap::COL_PRINT_NOTES' => 'PRINT_NOTES',
        'COL_PRINT_NOTES' => 'PRINT_NOTES',
        'print_notes' => 'PRINT_NOTES',
        'cfa.print_notes' => 'PRINT_NOTES',
        'BuyerName' => 'BUYER_NAME',
        'Cfa.BuyerName' => 'BUYER_NAME',
        'buyerName' => 'BUYER_NAME',
        'cfa.buyerName' => 'BUYER_NAME',
        'CfaTableMap::COL_BUYER_NAME' => 'BUYER_NAME',
        'COL_BUYER_NAME' => 'BUYER_NAME',
        'buyer_name' => 'BUYER_NAME',
        'cfa.buyer_name' => 'BUYER_NAME',
        'BuyerLocation' => 'BUYER_LOCATION',
        'Cfa.BuyerLocation' => 'BUYER_LOCATION',
        'buyerLocation' => 'BUYER_LOCATION',
        'cfa.buyerLocation' => 'BUYER_LOCATION',
        'CfaTableMap::COL_BUYER_LOCATION' => 'BUYER_LOCATION',
        'COL_BUYER_LOCATION' => 'BUYER_LOCATION',
        'buyer_location' => 'BUYER_LOCATION',
        'cfa.buyer_location' => 'BUYER_LOCATION',
        'BuyerDatePurchase' => 'BUYER_DATE_PURCHASE',
        'Cfa.BuyerDatePurchase' => 'BUYER_DATE_PURCHASE',
        'buyerDatePurchase' => 'BUYER_DATE_PURCHASE',
        'cfa.buyerDatePurchase' => 'BUYER_DATE_PURCHASE',
        'CfaTableMap::COL_BUYER_DATE_PURCHASE' => 'BUYER_DATE_PURCHASE',
        'COL_BUYER_DATE_PURCHASE' => 'BUYER_DATE_PURCHASE',
        'buyer_date_purchase' => 'BUYER_DATE_PURCHASE',
        'cfa.buyer_date_purchase' => 'BUYER_DATE_PURCHASE',
        'BuyerDateReceipt' => 'BUYER_DATE_RECEIPT',
        'Cfa.BuyerDateReceipt' => 'BUYER_DATE_RECEIPT',
        'buyerDateReceipt' => 'BUYER_DATE_RECEIPT',
        'cfa.buyerDateReceipt' => 'BUYER_DATE_RECEIPT',
        'CfaTableMap::COL_BUYER_DATE_RECEIPT' => 'BUYER_DATE_RECEIPT',
        'COL_BUYER_DATE_RECEIPT' => 'BUYER_DATE_RECEIPT',
        'buyer_date_receipt' => 'BUYER_DATE_RECEIPT',
        'cfa.buyer_date_receipt' => 'BUYER_DATE_RECEIPT',
        'Notes' => 'NOTES',
        'Cfa.Notes' => 'NOTES',
        'notes' => 'NOTES',
        'cfa.notes' => 'NOTES',
        'CfaTableMap::COL_NOTES' => 'NOTES',
        'COL_NOTES' => 'NOTES',
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
        $this->setName('cfa');
        $this->setPhpName('Cfa');
        $this->setIdentifierQuoting(false);
        $this->setClassName('\\Art\\Cfa');
        $this->setPackage('Art');
        $this->setUseIdGenerator(true);
        // columns
        $this->addPrimaryKey('record_id', 'RecordId', 'INTEGER', true, null, null);
        $this->addColumn('created_at', 'CreatedAt', 'TIMESTAMP', true, null, 'CURRENT_TIMESTAMP');
        $this->addColumn('updated_at', 'UpdatedAt', 'TIMESTAMP', true, null, 'CURRENT_TIMESTAMP');
        $this->addColumn('piece_id', 'PieceId', 'INTEGER', true, null, null);
        $this->addColumn('piece_id_run', 'PieceIdRun', 'INTEGER', false, null, null);
        $this->addColumn('piece_id_count', 'PieceIdCount', 'INTEGER', false, null, null);
        $this->addColumn('print_company', 'PrintCompany', 'VARCHAR', false, 255, null);
        $this->addColumn('print_date_sent', 'PrintDateSent', 'VARCHAR', false, 255, null);
        $this->addColumn('print_date_receipt', 'PrintDateReceipt', 'VARCHAR', false, 255, null);
        $this->addColumn('print_medium', 'PrintMedium', 'VARCHAR', false, 255, null);
        $this->addColumn('print_cost', 'PrintCost', 'VARCHAR', false, 255, null);
        $this->addColumn('print_notes', 'PrintNotes', 'VARCHAR', false, 255, null);
        $this->addColumn('buyer_name', 'BuyerName', 'VARCHAR', false, 255, null);
        $this->addColumn('buyer_location', 'BuyerLocation', 'VARCHAR', false, 255, null);
        $this->addColumn('buyer_date_purchase', 'BuyerDatePurchase', 'VARCHAR', false, 255, null);
        $this->addColumn('buyer_date_receipt', 'BuyerDateReceipt', 'VARCHAR', false, 255, null);
        $this->addColumn('notes', 'Notes', 'LONGVARCHAR', false, null, null);
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
        if ($row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('RecordId', TableMap::TYPE_PHPNAME, $indexType)] === null) {
            return null;
        }

        return null === $row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('RecordId', TableMap::TYPE_PHPNAME, $indexType)] || is_scalar($row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('RecordId', TableMap::TYPE_PHPNAME, $indexType)]) || is_callable([$row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('RecordId', TableMap::TYPE_PHPNAME, $indexType)], '__toString']) ? (string) $row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('RecordId', TableMap::TYPE_PHPNAME, $indexType)] : $row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('RecordId', TableMap::TYPE_PHPNAME, $indexType)];
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
                : self::translateFieldName('RecordId', TableMap::TYPE_PHPNAME, $indexType)
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
        return $withPrefix ? CfaTableMap::CLASS_DEFAULT : CfaTableMap::OM_CLASS;
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
     * @return array (Cfa object, last column rank)
     */
    public static function populateObject(array $row, int $offset = 0, string $indexType = TableMap::TYPE_NUM): array
    {
        $key = CfaTableMap::getPrimaryKeyHashFromRow($row, $offset, $indexType);
        if (null !== ($obj = CfaTableMap::getInstanceFromPool($key))) {
            // We no longer rehydrate the object, since this can cause data loss.
            // See http://www.propelorm.org/ticket/509
            // $obj->hydrate($row, $offset, true); // rehydrate
            $col = $offset + CfaTableMap::NUM_HYDRATE_COLUMNS;
        } else {
            $cls = CfaTableMap::OM_CLASS;
            /** @var Cfa $obj */
            $obj = new $cls();
            $col = $obj->hydrate($row, $offset, false, $indexType);
            CfaTableMap::addInstanceToPool($obj, $key);
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
            $key = CfaTableMap::getPrimaryKeyHashFromRow($row, 0, $dataFetcher->getIndexType());
            if (null !== ($obj = CfaTableMap::getInstanceFromPool($key))) {
                // We no longer rehydrate the object, since this can cause data loss.
                // See http://www.propelorm.org/ticket/509
                // $obj->hydrate($row, 0, true); // rehydrate
                $results[] = $obj;
            } else {
                /** @var Cfa $obj */
                $obj = new $cls();
                $obj->hydrate($row);
                $results[] = $obj;
                CfaTableMap::addInstanceToPool($obj, $key);
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
            $criteria->addSelectColumn(CfaTableMap::COL_RECORD_ID);
            $criteria->addSelectColumn(CfaTableMap::COL_CREATED_AT);
            $criteria->addSelectColumn(CfaTableMap::COL_UPDATED_AT);
            $criteria->addSelectColumn(CfaTableMap::COL_PIECE_ID);
            $criteria->addSelectColumn(CfaTableMap::COL_PIECE_ID_RUN);
            $criteria->addSelectColumn(CfaTableMap::COL_PIECE_ID_COUNT);
            $criteria->addSelectColumn(CfaTableMap::COL_PRINT_COMPANY);
            $criteria->addSelectColumn(CfaTableMap::COL_PRINT_DATE_SENT);
            $criteria->addSelectColumn(CfaTableMap::COL_PRINT_DATE_RECEIPT);
            $criteria->addSelectColumn(CfaTableMap::COL_PRINT_MEDIUM);
            $criteria->addSelectColumn(CfaTableMap::COL_PRINT_COST);
            $criteria->addSelectColumn(CfaTableMap::COL_PRINT_NOTES);
            $criteria->addSelectColumn(CfaTableMap::COL_BUYER_NAME);
            $criteria->addSelectColumn(CfaTableMap::COL_BUYER_LOCATION);
            $criteria->addSelectColumn(CfaTableMap::COL_BUYER_DATE_PURCHASE);
            $criteria->addSelectColumn(CfaTableMap::COL_BUYER_DATE_RECEIPT);
            $criteria->addSelectColumn(CfaTableMap::COL_NOTES);
        } else {
            $criteria->addSelectColumn($alias . '.record_id');
            $criteria->addSelectColumn($alias . '.created_at');
            $criteria->addSelectColumn($alias . '.updated_at');
            $criteria->addSelectColumn($alias . '.piece_id');
            $criteria->addSelectColumn($alias . '.piece_id_run');
            $criteria->addSelectColumn($alias . '.piece_id_count');
            $criteria->addSelectColumn($alias . '.print_company');
            $criteria->addSelectColumn($alias . '.print_date_sent');
            $criteria->addSelectColumn($alias . '.print_date_receipt');
            $criteria->addSelectColumn($alias . '.print_medium');
            $criteria->addSelectColumn($alias . '.print_cost');
            $criteria->addSelectColumn($alias . '.print_notes');
            $criteria->addSelectColumn($alias . '.buyer_name');
            $criteria->addSelectColumn($alias . '.buyer_location');
            $criteria->addSelectColumn($alias . '.buyer_date_purchase');
            $criteria->addSelectColumn($alias . '.buyer_date_receipt');
            $criteria->addSelectColumn($alias . '.notes');
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
            $criteria->removeSelectColumn(CfaTableMap::COL_RECORD_ID);
            $criteria->removeSelectColumn(CfaTableMap::COL_CREATED_AT);
            $criteria->removeSelectColumn(CfaTableMap::COL_UPDATED_AT);
            $criteria->removeSelectColumn(CfaTableMap::COL_PIECE_ID);
            $criteria->removeSelectColumn(CfaTableMap::COL_PIECE_ID_RUN);
            $criteria->removeSelectColumn(CfaTableMap::COL_PIECE_ID_COUNT);
            $criteria->removeSelectColumn(CfaTableMap::COL_PRINT_COMPANY);
            $criteria->removeSelectColumn(CfaTableMap::COL_PRINT_DATE_SENT);
            $criteria->removeSelectColumn(CfaTableMap::COL_PRINT_DATE_RECEIPT);
            $criteria->removeSelectColumn(CfaTableMap::COL_PRINT_MEDIUM);
            $criteria->removeSelectColumn(CfaTableMap::COL_PRINT_COST);
            $criteria->removeSelectColumn(CfaTableMap::COL_PRINT_NOTES);
            $criteria->removeSelectColumn(CfaTableMap::COL_BUYER_NAME);
            $criteria->removeSelectColumn(CfaTableMap::COL_BUYER_LOCATION);
            $criteria->removeSelectColumn(CfaTableMap::COL_BUYER_DATE_PURCHASE);
            $criteria->removeSelectColumn(CfaTableMap::COL_BUYER_DATE_RECEIPT);
            $criteria->removeSelectColumn(CfaTableMap::COL_NOTES);
        } else {
            $criteria->removeSelectColumn($alias . '.record_id');
            $criteria->removeSelectColumn($alias . '.created_at');
            $criteria->removeSelectColumn($alias . '.updated_at');
            $criteria->removeSelectColumn($alias . '.piece_id');
            $criteria->removeSelectColumn($alias . '.piece_id_run');
            $criteria->removeSelectColumn($alias . '.piece_id_count');
            $criteria->removeSelectColumn($alias . '.print_company');
            $criteria->removeSelectColumn($alias . '.print_date_sent');
            $criteria->removeSelectColumn($alias . '.print_date_receipt');
            $criteria->removeSelectColumn($alias . '.print_medium');
            $criteria->removeSelectColumn($alias . '.print_cost');
            $criteria->removeSelectColumn($alias . '.print_notes');
            $criteria->removeSelectColumn($alias . '.buyer_name');
            $criteria->removeSelectColumn($alias . '.buyer_location');
            $criteria->removeSelectColumn($alias . '.buyer_date_purchase');
            $criteria->removeSelectColumn($alias . '.buyer_date_receipt');
            $criteria->removeSelectColumn($alias . '.notes');
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
        return Propel::getServiceContainer()->getDatabaseMap(CfaTableMap::DATABASE_NAME)->getTable(CfaTableMap::TABLE_NAME);
    }

    /**
     * Performs a DELETE on the database, given a Cfa or Criteria object OR a primary key value.
     *
     * @param mixed $values Criteria or Cfa object or primary key or array of primary keys
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
            $con = Propel::getServiceContainer()->getWriteConnection(CfaTableMap::DATABASE_NAME);
        }

        if ($values instanceof Criteria) {
            // rename for clarity
            $criteria = $values;
        } elseif ($values instanceof \Art\Cfa) { // it's a model object
            // create criteria based on pk values
            $criteria = $values->buildPkeyCriteria();
        } else { // it's a primary key, or an array of pks
            $criteria = new Criteria(CfaTableMap::DATABASE_NAME);
            $criteria->add(CfaTableMap::COL_RECORD_ID, (array) $values, Criteria::IN);
        }

        $query = CfaQuery::create()->mergeWith($criteria);

        if ($values instanceof Criteria) {
            CfaTableMap::clearInstancePool();
        } elseif (!is_object($values)) { // it's a primary key, or an array of pks
            foreach ((array) $values as $singleval) {
                CfaTableMap::removeInstanceFromPool($singleval);
            }
        }

        return $query->delete($con);
    }

    /**
     * Deletes all rows from the cfa table.
     *
     * @param ConnectionInterface $con the connection to use
     * @return int The number of affected rows (if supported by underlying database driver).
     */
    public static function doDeleteAll(?ConnectionInterface $con = null): int
    {
        return CfaQuery::create()->doDeleteAll($con);
    }

    /**
     * Performs an INSERT on the database, given a Cfa or Criteria object.
     *
     * @param mixed $criteria Criteria or Cfa object containing data that is used to create the INSERT statement.
     * @param ConnectionInterface $con the ConnectionInterface connection to use
     * @return mixed The new primary key.
     * @throws \Propel\Runtime\Exception\PropelException Any exceptions caught during processing will be
     *                         rethrown wrapped into a PropelException.
     */
    public static function doInsert($criteria, ?ConnectionInterface $con = null)
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(CfaTableMap::DATABASE_NAME);
        }

        if ($criteria instanceof Criteria) {
            $criteria = clone $criteria; // rename for clarity
        } else {
            $criteria = $criteria->buildCriteria(); // build Criteria from Cfa object
        }

        if ($criteria->containsKey(CfaTableMap::COL_RECORD_ID) && $criteria->keyContainsValue(CfaTableMap::COL_RECORD_ID) ) {
            throw new PropelException('Cannot insert a value for auto-increment primary key ('.CfaTableMap::COL_RECORD_ID.')');
        }


        // Set the correct dbName
        $query = CfaQuery::create()->mergeWith($criteria);

        // use transaction because $criteria could contain info
        // for more than one table (I guess, conceivably)
        return $con->transaction(function () use ($con, $query) {
            return $query->doInsert($con);
        });
    }

}
