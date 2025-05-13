<?php

namespace Art\Map;

use Art\Users;
use Art\UsersQuery;
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
 * This class defines the structure of the 'users' table.
 *
 *
 *
 * This map class is used by Propel to do runtime db structure discovery.
 * For example, the createSelectSql() method checks the type of a given column used in an
 * ORDER BY clause to know whether it needs to apply SQL to make the ORDER BY case-insensitive
 * (i.e. if it's a text column type).
 */
class UsersTableMap extends TableMap
{
    use InstancePoolTrait;
    use TableMapTrait;

    /**
     * The (dot-path) name of this class
     */
    public const CLASS_NAME = 'Art.Map.UsersTableMap';

    /**
     * The default database name for this class
     */
    public const DATABASE_NAME = 'default';

    /**
     * The table name for this class
     */
    public const TABLE_NAME = 'users';

    /**
     * The PHP name of this class (PascalCase)
     */
    public const TABLE_PHP_NAME = 'Users';

    /**
     * The related Propel class for this table
     */
    public const OM_CLASS = '\\Art\\Users';

    /**
     * A class that can be returned by this tableMap
     */
    public const CLASS_DEFAULT = 'Art.Users';

    /**
     * The total number of columns
     */
    public const NUM_COLUMNS = 10;

    /**
     * The number of lazy-loaded columns
     */
    public const NUM_LAZY_LOAD_COLUMNS = 0;

    /**
     * The number of columns to hydrate (NUM_COLUMNS - NUM_LAZY_LOAD_COLUMNS)
     */
    public const NUM_HYDRATE_COLUMNS = 10;

    /**
     * the column name for the id field
     */
    public const COL_ID = 'users.id';

    /**
     * the column name for the username field
     */
    public const COL_USERNAME = 'users.username';

    /**
     * the column name for the password_hash field
     */
    public const COL_PASSWORD_HASH = 'users.password_hash';

    /**
     * the column name for the first_name field
     */
    public const COL_FIRST_NAME = 'users.first_name';

    /**
     * the column name for the last_name field
     */
    public const COL_LAST_NAME = 'users.last_name';

    /**
     * the column name for the email field
     */
    public const COL_EMAIL = 'users.email';

    /**
     * the column name for the isAdmin field
     */
    public const COL_ISADMIN = 'users.isAdmin';

    /**
     * the column name for the selectionOnly field
     */
    public const COL_SELECTIONONLY = 'users.selectionOnly';

    /**
     * the column name for the created_at field
     */
    public const COL_CREATED_AT = 'users.created_at';

    /**
     * the column name for the updated_at field
     */
    public const COL_UPDATED_AT = 'users.updated_at';

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
        self::TYPE_PHPNAME       => ['Id', 'Username', 'PasswordHash', 'FirstName', 'LastName', 'Email', 'Isadmin', 'Selectiononly', 'CreatedAt', 'UpdatedAt', ],
        self::TYPE_CAMELNAME     => ['id', 'username', 'passwordHash', 'firstName', 'lastName', 'email', 'isadmin', 'selectiononly', 'createdAt', 'updatedAt', ],
        self::TYPE_COLNAME       => [UsersTableMap::COL_ID, UsersTableMap::COL_USERNAME, UsersTableMap::COL_PASSWORD_HASH, UsersTableMap::COL_FIRST_NAME, UsersTableMap::COL_LAST_NAME, UsersTableMap::COL_EMAIL, UsersTableMap::COL_ISADMIN, UsersTableMap::COL_SELECTIONONLY, UsersTableMap::COL_CREATED_AT, UsersTableMap::COL_UPDATED_AT, ],
        self::TYPE_FIELDNAME     => ['id', 'username', 'password_hash', 'first_name', 'last_name', 'email', 'isAdmin', 'selectionOnly', 'created_at', 'updated_at', ],
        self::TYPE_NUM           => [0, 1, 2, 3, 4, 5, 6, 7, 8, 9, ]
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
        self::TYPE_PHPNAME       => ['Id' => 0, 'Username' => 1, 'PasswordHash' => 2, 'FirstName' => 3, 'LastName' => 4, 'Email' => 5, 'Isadmin' => 6, 'Selectiononly' => 7, 'CreatedAt' => 8, 'UpdatedAt' => 9, ],
        self::TYPE_CAMELNAME     => ['id' => 0, 'username' => 1, 'passwordHash' => 2, 'firstName' => 3, 'lastName' => 4, 'email' => 5, 'isadmin' => 6, 'selectiononly' => 7, 'createdAt' => 8, 'updatedAt' => 9, ],
        self::TYPE_COLNAME       => [UsersTableMap::COL_ID => 0, UsersTableMap::COL_USERNAME => 1, UsersTableMap::COL_PASSWORD_HASH => 2, UsersTableMap::COL_FIRST_NAME => 3, UsersTableMap::COL_LAST_NAME => 4, UsersTableMap::COL_EMAIL => 5, UsersTableMap::COL_ISADMIN => 6, UsersTableMap::COL_SELECTIONONLY => 7, UsersTableMap::COL_CREATED_AT => 8, UsersTableMap::COL_UPDATED_AT => 9, ],
        self::TYPE_FIELDNAME     => ['id' => 0, 'username' => 1, 'password_hash' => 2, 'first_name' => 3, 'last_name' => 4, 'email' => 5, 'isAdmin' => 6, 'selectionOnly' => 7, 'created_at' => 8, 'updated_at' => 9, ],
        self::TYPE_NUM           => [0, 1, 2, 3, 4, 5, 6, 7, 8, 9, ]
    ];

    /**
     * Holds a list of column names and their normalized version.
     *
     * @var array<string>
     */
    protected $normalizedColumnNameMap = [
        'Id' => 'ID',
        'Users.Id' => 'ID',
        'id' => 'ID',
        'users.id' => 'ID',
        'UsersTableMap::COL_ID' => 'ID',
        'COL_ID' => 'ID',
        'Username' => 'USERNAME',
        'Users.Username' => 'USERNAME',
        'username' => 'USERNAME',
        'users.username' => 'USERNAME',
        'UsersTableMap::COL_USERNAME' => 'USERNAME',
        'COL_USERNAME' => 'USERNAME',
        'PasswordHash' => 'PASSWORD_HASH',
        'Users.PasswordHash' => 'PASSWORD_HASH',
        'passwordHash' => 'PASSWORD_HASH',
        'users.passwordHash' => 'PASSWORD_HASH',
        'UsersTableMap::COL_PASSWORD_HASH' => 'PASSWORD_HASH',
        'COL_PASSWORD_HASH' => 'PASSWORD_HASH',
        'password_hash' => 'PASSWORD_HASH',
        'users.password_hash' => 'PASSWORD_HASH',
        'FirstName' => 'FIRST_NAME',
        'Users.FirstName' => 'FIRST_NAME',
        'firstName' => 'FIRST_NAME',
        'users.firstName' => 'FIRST_NAME',
        'UsersTableMap::COL_FIRST_NAME' => 'FIRST_NAME',
        'COL_FIRST_NAME' => 'FIRST_NAME',
        'first_name' => 'FIRST_NAME',
        'users.first_name' => 'FIRST_NAME',
        'LastName' => 'LAST_NAME',
        'Users.LastName' => 'LAST_NAME',
        'lastName' => 'LAST_NAME',
        'users.lastName' => 'LAST_NAME',
        'UsersTableMap::COL_LAST_NAME' => 'LAST_NAME',
        'COL_LAST_NAME' => 'LAST_NAME',
        'last_name' => 'LAST_NAME',
        'users.last_name' => 'LAST_NAME',
        'Email' => 'EMAIL',
        'Users.Email' => 'EMAIL',
        'email' => 'EMAIL',
        'users.email' => 'EMAIL',
        'UsersTableMap::COL_EMAIL' => 'EMAIL',
        'COL_EMAIL' => 'EMAIL',
        'Isadmin' => 'ISADMIN',
        'Users.Isadmin' => 'ISADMIN',
        'isadmin' => 'ISADMIN',
        'users.isadmin' => 'ISADMIN',
        'UsersTableMap::COL_ISADMIN' => 'ISADMIN',
        'COL_ISADMIN' => 'ISADMIN',
        'isAdmin' => 'ISADMIN',
        'users.isAdmin' => 'ISADMIN',
        'Selectiononly' => 'SELECTIONONLY',
        'Users.Selectiononly' => 'SELECTIONONLY',
        'selectiononly' => 'SELECTIONONLY',
        'users.selectiononly' => 'SELECTIONONLY',
        'UsersTableMap::COL_SELECTIONONLY' => 'SELECTIONONLY',
        'COL_SELECTIONONLY' => 'SELECTIONONLY',
        'selectionOnly' => 'SELECTIONONLY',
        'users.selectionOnly' => 'SELECTIONONLY',
        'CreatedAt' => 'CREATED_AT',
        'Users.CreatedAt' => 'CREATED_AT',
        'createdAt' => 'CREATED_AT',
        'users.createdAt' => 'CREATED_AT',
        'UsersTableMap::COL_CREATED_AT' => 'CREATED_AT',
        'COL_CREATED_AT' => 'CREATED_AT',
        'created_at' => 'CREATED_AT',
        'users.created_at' => 'CREATED_AT',
        'UpdatedAt' => 'UPDATED_AT',
        'Users.UpdatedAt' => 'UPDATED_AT',
        'updatedAt' => 'UPDATED_AT',
        'users.updatedAt' => 'UPDATED_AT',
        'UsersTableMap::COL_UPDATED_AT' => 'UPDATED_AT',
        'COL_UPDATED_AT' => 'UPDATED_AT',
        'updated_at' => 'UPDATED_AT',
        'users.updated_at' => 'UPDATED_AT',
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
        $this->setName('users');
        $this->setPhpName('Users');
        $this->setIdentifierQuoting(false);
        $this->setClassName('\\Art\\Users');
        $this->setPackage('Art');
        $this->setUseIdGenerator(true);
        // columns
        $this->addPrimaryKey('id', 'Id', 'INTEGER', true, null, null);
        $this->addColumn('username', 'Username', 'VARCHAR', false, 100, null);
        $this->addColumn('password_hash', 'PasswordHash', 'VARCHAR', false, 100, null);
        $this->addColumn('first_name', 'FirstName', 'VARCHAR', false, 60, null);
        $this->addColumn('last_name', 'LastName', 'VARCHAR', false, 120, null);
        $this->addColumn('email', 'Email', 'VARCHAR', false, 256, null);
        $this->addColumn('isAdmin', 'Isadmin', 'BOOLEAN', true, 1, false);
        $this->addColumn('selectionOnly', 'Selectiononly', 'BOOLEAN', true, 1, true);
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
        return $withPrefix ? UsersTableMap::CLASS_DEFAULT : UsersTableMap::OM_CLASS;
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
     * @return array (Users object, last column rank)
     */
    public static function populateObject(array $row, int $offset = 0, string $indexType = TableMap::TYPE_NUM): array
    {
        $key = UsersTableMap::getPrimaryKeyHashFromRow($row, $offset, $indexType);
        if (null !== ($obj = UsersTableMap::getInstanceFromPool($key))) {
            // We no longer rehydrate the object, since this can cause data loss.
            // See http://www.propelorm.org/ticket/509
            // $obj->hydrate($row, $offset, true); // rehydrate
            $col = $offset + UsersTableMap::NUM_HYDRATE_COLUMNS;
        } else {
            $cls = UsersTableMap::OM_CLASS;
            /** @var Users $obj */
            $obj = new $cls();
            $col = $obj->hydrate($row, $offset, false, $indexType);
            UsersTableMap::addInstanceToPool($obj, $key);
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
            $key = UsersTableMap::getPrimaryKeyHashFromRow($row, 0, $dataFetcher->getIndexType());
            if (null !== ($obj = UsersTableMap::getInstanceFromPool($key))) {
                // We no longer rehydrate the object, since this can cause data loss.
                // See http://www.propelorm.org/ticket/509
                // $obj->hydrate($row, 0, true); // rehydrate
                $results[] = $obj;
            } else {
                /** @var Users $obj */
                $obj = new $cls();
                $obj->hydrate($row);
                $results[] = $obj;
                UsersTableMap::addInstanceToPool($obj, $key);
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
            $criteria->addSelectColumn(UsersTableMap::COL_ID);
            $criteria->addSelectColumn(UsersTableMap::COL_USERNAME);
            $criteria->addSelectColumn(UsersTableMap::COL_PASSWORD_HASH);
            $criteria->addSelectColumn(UsersTableMap::COL_FIRST_NAME);
            $criteria->addSelectColumn(UsersTableMap::COL_LAST_NAME);
            $criteria->addSelectColumn(UsersTableMap::COL_EMAIL);
            $criteria->addSelectColumn(UsersTableMap::COL_ISADMIN);
            $criteria->addSelectColumn(UsersTableMap::COL_SELECTIONONLY);
            $criteria->addSelectColumn(UsersTableMap::COL_CREATED_AT);
            $criteria->addSelectColumn(UsersTableMap::COL_UPDATED_AT);
        } else {
            $criteria->addSelectColumn($alias . '.id');
            $criteria->addSelectColumn($alias . '.username');
            $criteria->addSelectColumn($alias . '.password_hash');
            $criteria->addSelectColumn($alias . '.first_name');
            $criteria->addSelectColumn($alias . '.last_name');
            $criteria->addSelectColumn($alias . '.email');
            $criteria->addSelectColumn($alias . '.isAdmin');
            $criteria->addSelectColumn($alias . '.selectionOnly');
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
            $criteria->removeSelectColumn(UsersTableMap::COL_ID);
            $criteria->removeSelectColumn(UsersTableMap::COL_USERNAME);
            $criteria->removeSelectColumn(UsersTableMap::COL_PASSWORD_HASH);
            $criteria->removeSelectColumn(UsersTableMap::COL_FIRST_NAME);
            $criteria->removeSelectColumn(UsersTableMap::COL_LAST_NAME);
            $criteria->removeSelectColumn(UsersTableMap::COL_EMAIL);
            $criteria->removeSelectColumn(UsersTableMap::COL_ISADMIN);
            $criteria->removeSelectColumn(UsersTableMap::COL_SELECTIONONLY);
            $criteria->removeSelectColumn(UsersTableMap::COL_CREATED_AT);
            $criteria->removeSelectColumn(UsersTableMap::COL_UPDATED_AT);
        } else {
            $criteria->removeSelectColumn($alias . '.id');
            $criteria->removeSelectColumn($alias . '.username');
            $criteria->removeSelectColumn($alias . '.password_hash');
            $criteria->removeSelectColumn($alias . '.first_name');
            $criteria->removeSelectColumn($alias . '.last_name');
            $criteria->removeSelectColumn($alias . '.email');
            $criteria->removeSelectColumn($alias . '.isAdmin');
            $criteria->removeSelectColumn($alias . '.selectionOnly');
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
        return Propel::getServiceContainer()->getDatabaseMap(UsersTableMap::DATABASE_NAME)->getTable(UsersTableMap::TABLE_NAME);
    }

    /**
     * Performs a DELETE on the database, given a Users or Criteria object OR a primary key value.
     *
     * @param mixed $values Criteria or Users object or primary key or array of primary keys
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
            $con = Propel::getServiceContainer()->getWriteConnection(UsersTableMap::DATABASE_NAME);
        }

        if ($values instanceof Criteria) {
            // rename for clarity
            $criteria = $values;
        } elseif ($values instanceof \Art\Users) { // it's a model object
            // create criteria based on pk values
            $criteria = $values->buildPkeyCriteria();
        } else { // it's a primary key, or an array of pks
            $criteria = new Criteria(UsersTableMap::DATABASE_NAME);
            $criteria->add(UsersTableMap::COL_ID, (array) $values, Criteria::IN);
        }

        $query = UsersQuery::create()->mergeWith($criteria);

        if ($values instanceof Criteria) {
            UsersTableMap::clearInstancePool();
        } elseif (!is_object($values)) { // it's a primary key, or an array of pks
            foreach ((array) $values as $singleval) {
                UsersTableMap::removeInstanceFromPool($singleval);
            }
        }

        return $query->delete($con);
    }

    /**
     * Deletes all rows from the users table.
     *
     * @param ConnectionInterface $con the connection to use
     * @return int The number of affected rows (if supported by underlying database driver).
     */
    public static function doDeleteAll(?ConnectionInterface $con = null): int
    {
        return UsersQuery::create()->doDeleteAll($con);
    }

    /**
     * Performs an INSERT on the database, given a Users or Criteria object.
     *
     * @param mixed $criteria Criteria or Users object containing data that is used to create the INSERT statement.
     * @param ConnectionInterface $con the ConnectionInterface connection to use
     * @return mixed The new primary key.
     * @throws \Propel\Runtime\Exception\PropelException Any exceptions caught during processing will be
     *                         rethrown wrapped into a PropelException.
     */
    public static function doInsert($criteria, ?ConnectionInterface $con = null)
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(UsersTableMap::DATABASE_NAME);
        }

        if ($criteria instanceof Criteria) {
            $criteria = clone $criteria; // rename for clarity
        } else {
            $criteria = $criteria->buildCriteria(); // build Criteria from Users object
        }

        if ($criteria->containsKey(UsersTableMap::COL_ID) && $criteria->keyContainsValue(UsersTableMap::COL_ID) ) {
            throw new PropelException('Cannot insert a value for auto-increment primary key ('.UsersTableMap::COL_ID.')');
        }


        // Set the correct dbName
        $query = UsersQuery::create()->mergeWith($criteria);

        // use transaction because $criteria could contain info
        // for more than one table (I guess, conceivably)
        return $con->transaction(function () use ($con, $query) {
            return $query->doInsert($con);
        });
    }

}
