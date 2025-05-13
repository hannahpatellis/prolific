<?php

namespace Art\Base;

use \Exception;
use \PDO;
use Art\Cfa as ChildCfa;
use Art\CfaQuery as ChildCfaQuery;
use Art\Map\CfaTableMap;
use Propel\Runtime\Propel;
use Propel\Runtime\ActiveQuery\Criteria;
use Propel\Runtime\ActiveQuery\ModelCriteria;
use Propel\Runtime\Collection\Collection;
use Propel\Runtime\Connection\ConnectionInterface;
use Propel\Runtime\Exception\PropelException;

/**
 * Base class that represents a query for the `cfa` table.
 *
 * @method     ChildCfaQuery orderByRecordId($order = Criteria::ASC) Order by the record_id column
 * @method     ChildCfaQuery orderByCreatedAt($order = Criteria::ASC) Order by the created_at column
 * @method     ChildCfaQuery orderByUpdatedAt($order = Criteria::ASC) Order by the updated_at column
 * @method     ChildCfaQuery orderByPieceId($order = Criteria::ASC) Order by the piece_id column
 * @method     ChildCfaQuery orderByPieceIdRun($order = Criteria::ASC) Order by the piece_id_run column
 * @method     ChildCfaQuery orderByPieceIdCount($order = Criteria::ASC) Order by the piece_id_count column
 * @method     ChildCfaQuery orderByPrintCompany($order = Criteria::ASC) Order by the print_company column
 * @method     ChildCfaQuery orderByPrintDateSent($order = Criteria::ASC) Order by the print_date_sent column
 * @method     ChildCfaQuery orderByPrintDateReceipt($order = Criteria::ASC) Order by the print_date_receipt column
 * @method     ChildCfaQuery orderByPrintMedium($order = Criteria::ASC) Order by the print_medium column
 * @method     ChildCfaQuery orderByPrintCost($order = Criteria::ASC) Order by the print_cost column
 * @method     ChildCfaQuery orderByPrintNotes($order = Criteria::ASC) Order by the print_notes column
 * @method     ChildCfaQuery orderByBuyerName($order = Criteria::ASC) Order by the buyer_name column
 * @method     ChildCfaQuery orderByBuyerLocation($order = Criteria::ASC) Order by the buyer_location column
 * @method     ChildCfaQuery orderByBuyerDatePurchase($order = Criteria::ASC) Order by the buyer_date_purchase column
 * @method     ChildCfaQuery orderByBuyerDateReceipt($order = Criteria::ASC) Order by the buyer_date_receipt column
 * @method     ChildCfaQuery orderByNotes($order = Criteria::ASC) Order by the notes column
 *
 * @method     ChildCfaQuery groupByRecordId() Group by the record_id column
 * @method     ChildCfaQuery groupByCreatedAt() Group by the created_at column
 * @method     ChildCfaQuery groupByUpdatedAt() Group by the updated_at column
 * @method     ChildCfaQuery groupByPieceId() Group by the piece_id column
 * @method     ChildCfaQuery groupByPieceIdRun() Group by the piece_id_run column
 * @method     ChildCfaQuery groupByPieceIdCount() Group by the piece_id_count column
 * @method     ChildCfaQuery groupByPrintCompany() Group by the print_company column
 * @method     ChildCfaQuery groupByPrintDateSent() Group by the print_date_sent column
 * @method     ChildCfaQuery groupByPrintDateReceipt() Group by the print_date_receipt column
 * @method     ChildCfaQuery groupByPrintMedium() Group by the print_medium column
 * @method     ChildCfaQuery groupByPrintCost() Group by the print_cost column
 * @method     ChildCfaQuery groupByPrintNotes() Group by the print_notes column
 * @method     ChildCfaQuery groupByBuyerName() Group by the buyer_name column
 * @method     ChildCfaQuery groupByBuyerLocation() Group by the buyer_location column
 * @method     ChildCfaQuery groupByBuyerDatePurchase() Group by the buyer_date_purchase column
 * @method     ChildCfaQuery groupByBuyerDateReceipt() Group by the buyer_date_receipt column
 * @method     ChildCfaQuery groupByNotes() Group by the notes column
 *
 * @method     ChildCfaQuery leftJoin($relation) Adds a LEFT JOIN clause to the query
 * @method     ChildCfaQuery rightJoin($relation) Adds a RIGHT JOIN clause to the query
 * @method     ChildCfaQuery innerJoin($relation) Adds a INNER JOIN clause to the query
 *
 * @method     ChildCfaQuery leftJoinWith($relation) Adds a LEFT JOIN clause and with to the query
 * @method     ChildCfaQuery rightJoinWith($relation) Adds a RIGHT JOIN clause and with to the query
 * @method     ChildCfaQuery innerJoinWith($relation) Adds a INNER JOIN clause and with to the query
 *
 * @method     ChildCfa|null findOne(?ConnectionInterface $con = null) Return the first ChildCfa matching the query
 * @method     ChildCfa findOneOrCreate(?ConnectionInterface $con = null) Return the first ChildCfa matching the query, or a new ChildCfa object populated from the query conditions when no match is found
 *
 * @method     ChildCfa|null findOneByRecordId(int $record_id) Return the first ChildCfa filtered by the record_id column
 * @method     ChildCfa|null findOneByCreatedAt(string $created_at) Return the first ChildCfa filtered by the created_at column
 * @method     ChildCfa|null findOneByUpdatedAt(string $updated_at) Return the first ChildCfa filtered by the updated_at column
 * @method     ChildCfa|null findOneByPieceId(int $piece_id) Return the first ChildCfa filtered by the piece_id column
 * @method     ChildCfa|null findOneByPieceIdRun(int $piece_id_run) Return the first ChildCfa filtered by the piece_id_run column
 * @method     ChildCfa|null findOneByPieceIdCount(int $piece_id_count) Return the first ChildCfa filtered by the piece_id_count column
 * @method     ChildCfa|null findOneByPrintCompany(string $print_company) Return the first ChildCfa filtered by the print_company column
 * @method     ChildCfa|null findOneByPrintDateSent(string $print_date_sent) Return the first ChildCfa filtered by the print_date_sent column
 * @method     ChildCfa|null findOneByPrintDateReceipt(string $print_date_receipt) Return the first ChildCfa filtered by the print_date_receipt column
 * @method     ChildCfa|null findOneByPrintMedium(string $print_medium) Return the first ChildCfa filtered by the print_medium column
 * @method     ChildCfa|null findOneByPrintCost(string $print_cost) Return the first ChildCfa filtered by the print_cost column
 * @method     ChildCfa|null findOneByPrintNotes(string $print_notes) Return the first ChildCfa filtered by the print_notes column
 * @method     ChildCfa|null findOneByBuyerName(string $buyer_name) Return the first ChildCfa filtered by the buyer_name column
 * @method     ChildCfa|null findOneByBuyerLocation(string $buyer_location) Return the first ChildCfa filtered by the buyer_location column
 * @method     ChildCfa|null findOneByBuyerDatePurchase(string $buyer_date_purchase) Return the first ChildCfa filtered by the buyer_date_purchase column
 * @method     ChildCfa|null findOneByBuyerDateReceipt(string $buyer_date_receipt) Return the first ChildCfa filtered by the buyer_date_receipt column
 * @method     ChildCfa|null findOneByNotes(string $notes) Return the first ChildCfa filtered by the notes column
 *
 * @method     ChildCfa requirePk($key, ?ConnectionInterface $con = null) Return the ChildCfa by primary key and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildCfa requireOne(?ConnectionInterface $con = null) Return the first ChildCfa matching the query and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildCfa requireOneByRecordId(int $record_id) Return the first ChildCfa filtered by the record_id column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildCfa requireOneByCreatedAt(string $created_at) Return the first ChildCfa filtered by the created_at column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildCfa requireOneByUpdatedAt(string $updated_at) Return the first ChildCfa filtered by the updated_at column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildCfa requireOneByPieceId(int $piece_id) Return the first ChildCfa filtered by the piece_id column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildCfa requireOneByPieceIdRun(int $piece_id_run) Return the first ChildCfa filtered by the piece_id_run column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildCfa requireOneByPieceIdCount(int $piece_id_count) Return the first ChildCfa filtered by the piece_id_count column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildCfa requireOneByPrintCompany(string $print_company) Return the first ChildCfa filtered by the print_company column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildCfa requireOneByPrintDateSent(string $print_date_sent) Return the first ChildCfa filtered by the print_date_sent column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildCfa requireOneByPrintDateReceipt(string $print_date_receipt) Return the first ChildCfa filtered by the print_date_receipt column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildCfa requireOneByPrintMedium(string $print_medium) Return the first ChildCfa filtered by the print_medium column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildCfa requireOneByPrintCost(string $print_cost) Return the first ChildCfa filtered by the print_cost column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildCfa requireOneByPrintNotes(string $print_notes) Return the first ChildCfa filtered by the print_notes column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildCfa requireOneByBuyerName(string $buyer_name) Return the first ChildCfa filtered by the buyer_name column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildCfa requireOneByBuyerLocation(string $buyer_location) Return the first ChildCfa filtered by the buyer_location column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildCfa requireOneByBuyerDatePurchase(string $buyer_date_purchase) Return the first ChildCfa filtered by the buyer_date_purchase column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildCfa requireOneByBuyerDateReceipt(string $buyer_date_receipt) Return the first ChildCfa filtered by the buyer_date_receipt column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildCfa requireOneByNotes(string $notes) Return the first ChildCfa filtered by the notes column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildCfa[]|Collection find(?ConnectionInterface $con = null) Return ChildCfa objects based on current ModelCriteria
 * @psalm-method Collection&\Traversable<ChildCfa> find(?ConnectionInterface $con = null) Return ChildCfa objects based on current ModelCriteria
 *
 * @method     ChildCfa[]|Collection findByRecordId(int|array<int> $record_id) Return ChildCfa objects filtered by the record_id column
 * @psalm-method Collection&\Traversable<ChildCfa> findByRecordId(int|array<int> $record_id) Return ChildCfa objects filtered by the record_id column
 * @method     ChildCfa[]|Collection findByCreatedAt(string|array<string> $created_at) Return ChildCfa objects filtered by the created_at column
 * @psalm-method Collection&\Traversable<ChildCfa> findByCreatedAt(string|array<string> $created_at) Return ChildCfa objects filtered by the created_at column
 * @method     ChildCfa[]|Collection findByUpdatedAt(string|array<string> $updated_at) Return ChildCfa objects filtered by the updated_at column
 * @psalm-method Collection&\Traversable<ChildCfa> findByUpdatedAt(string|array<string> $updated_at) Return ChildCfa objects filtered by the updated_at column
 * @method     ChildCfa[]|Collection findByPieceId(int|array<int> $piece_id) Return ChildCfa objects filtered by the piece_id column
 * @psalm-method Collection&\Traversable<ChildCfa> findByPieceId(int|array<int> $piece_id) Return ChildCfa objects filtered by the piece_id column
 * @method     ChildCfa[]|Collection findByPieceIdRun(int|array<int> $piece_id_run) Return ChildCfa objects filtered by the piece_id_run column
 * @psalm-method Collection&\Traversable<ChildCfa> findByPieceIdRun(int|array<int> $piece_id_run) Return ChildCfa objects filtered by the piece_id_run column
 * @method     ChildCfa[]|Collection findByPieceIdCount(int|array<int> $piece_id_count) Return ChildCfa objects filtered by the piece_id_count column
 * @psalm-method Collection&\Traversable<ChildCfa> findByPieceIdCount(int|array<int> $piece_id_count) Return ChildCfa objects filtered by the piece_id_count column
 * @method     ChildCfa[]|Collection findByPrintCompany(string|array<string> $print_company) Return ChildCfa objects filtered by the print_company column
 * @psalm-method Collection&\Traversable<ChildCfa> findByPrintCompany(string|array<string> $print_company) Return ChildCfa objects filtered by the print_company column
 * @method     ChildCfa[]|Collection findByPrintDateSent(string|array<string> $print_date_sent) Return ChildCfa objects filtered by the print_date_sent column
 * @psalm-method Collection&\Traversable<ChildCfa> findByPrintDateSent(string|array<string> $print_date_sent) Return ChildCfa objects filtered by the print_date_sent column
 * @method     ChildCfa[]|Collection findByPrintDateReceipt(string|array<string> $print_date_receipt) Return ChildCfa objects filtered by the print_date_receipt column
 * @psalm-method Collection&\Traversable<ChildCfa> findByPrintDateReceipt(string|array<string> $print_date_receipt) Return ChildCfa objects filtered by the print_date_receipt column
 * @method     ChildCfa[]|Collection findByPrintMedium(string|array<string> $print_medium) Return ChildCfa objects filtered by the print_medium column
 * @psalm-method Collection&\Traversable<ChildCfa> findByPrintMedium(string|array<string> $print_medium) Return ChildCfa objects filtered by the print_medium column
 * @method     ChildCfa[]|Collection findByPrintCost(string|array<string> $print_cost) Return ChildCfa objects filtered by the print_cost column
 * @psalm-method Collection&\Traversable<ChildCfa> findByPrintCost(string|array<string> $print_cost) Return ChildCfa objects filtered by the print_cost column
 * @method     ChildCfa[]|Collection findByPrintNotes(string|array<string> $print_notes) Return ChildCfa objects filtered by the print_notes column
 * @psalm-method Collection&\Traversable<ChildCfa> findByPrintNotes(string|array<string> $print_notes) Return ChildCfa objects filtered by the print_notes column
 * @method     ChildCfa[]|Collection findByBuyerName(string|array<string> $buyer_name) Return ChildCfa objects filtered by the buyer_name column
 * @psalm-method Collection&\Traversable<ChildCfa> findByBuyerName(string|array<string> $buyer_name) Return ChildCfa objects filtered by the buyer_name column
 * @method     ChildCfa[]|Collection findByBuyerLocation(string|array<string> $buyer_location) Return ChildCfa objects filtered by the buyer_location column
 * @psalm-method Collection&\Traversable<ChildCfa> findByBuyerLocation(string|array<string> $buyer_location) Return ChildCfa objects filtered by the buyer_location column
 * @method     ChildCfa[]|Collection findByBuyerDatePurchase(string|array<string> $buyer_date_purchase) Return ChildCfa objects filtered by the buyer_date_purchase column
 * @psalm-method Collection&\Traversable<ChildCfa> findByBuyerDatePurchase(string|array<string> $buyer_date_purchase) Return ChildCfa objects filtered by the buyer_date_purchase column
 * @method     ChildCfa[]|Collection findByBuyerDateReceipt(string|array<string> $buyer_date_receipt) Return ChildCfa objects filtered by the buyer_date_receipt column
 * @psalm-method Collection&\Traversable<ChildCfa> findByBuyerDateReceipt(string|array<string> $buyer_date_receipt) Return ChildCfa objects filtered by the buyer_date_receipt column
 * @method     ChildCfa[]|Collection findByNotes(string|array<string> $notes) Return ChildCfa objects filtered by the notes column
 * @psalm-method Collection&\Traversable<ChildCfa> findByNotes(string|array<string> $notes) Return ChildCfa objects filtered by the notes column
 *
 * @method     ChildCfa[]|\Propel\Runtime\Util\PropelModelPager paginate($page = 1, $maxPerPage = 10, ?ConnectionInterface $con = null) Issue a SELECT query based on the current ModelCriteria and uses a page and a maximum number of results per page to compute an offset and a limit
 * @psalm-method \Propel\Runtime\Util\PropelModelPager&\Traversable<ChildCfa> paginate($page = 1, $maxPerPage = 10, ?ConnectionInterface $con = null) Issue a SELECT query based on the current ModelCriteria and uses a page and a maximum number of results per page to compute an offset and a limit
 */
abstract class CfaQuery extends ModelCriteria
{
    protected $entityNotFoundExceptionClass = '\\Propel\\Runtime\\Exception\\EntityNotFoundException';

    /**
     * Initializes internal state of \Art\Base\CfaQuery object.
     *
     * @param string $dbName The database name
     * @param string $modelName The phpName of a model, e.g. 'Book'
     * @param string $modelAlias The alias for the model in this query, e.g. 'b'
     */
    public function __construct($dbName = 'default', $modelName = '\\Art\\Cfa', $modelAlias = null)
    {
        parent::__construct($dbName, $modelName, $modelAlias);
    }

    /**
     * Returns a new ChildCfaQuery object.
     *
     * @param string $modelAlias The alias of a model in the query
     * @param Criteria $criteria Optional Criteria to build the query from
     *
     * @return ChildCfaQuery
     */
    public static function create(?string $modelAlias = null, ?Criteria $criteria = null): Criteria
    {
        if ($criteria instanceof ChildCfaQuery) {
            return $criteria;
        }
        $query = new ChildCfaQuery();
        if (null !== $modelAlias) {
            $query->setModelAlias($modelAlias);
        }
        if ($criteria instanceof Criteria) {
            $query->mergeWith($criteria);
        }

        return $query;
    }

    /**
     * Find object by primary key.
     * Propel uses the instance pool to skip the database if the object exists.
     * Go fast if the query is untouched.
     *
     * <code>
     * $obj  = $c->findPk(12, $con);
     * </code>
     *
     * @param mixed $key Primary key to use for the query
     * @param ConnectionInterface $con an optional connection object
     *
     * @return ChildCfa|array|mixed the result, formatted by the current formatter
     */
    public function findPk($key, ?ConnectionInterface $con = null)
    {
        if ($key === null) {
            return null;
        }

        if ($con === null) {
            $con = Propel::getServiceContainer()->getReadConnection(CfaTableMap::DATABASE_NAME);
        }

        $this->basePreSelect($con);

        if (
            $this->formatter || $this->modelAlias || $this->with || $this->select
            || $this->selectColumns || $this->asColumns || $this->selectModifiers
            || $this->map || $this->having || $this->joins
        ) {
            return $this->findPkComplex($key, $con);
        }

        if ((null !== ($obj = CfaTableMap::getInstanceFromPool(null === $key || is_scalar($key) || is_callable([$key, '__toString']) ? (string) $key : $key)))) {
            // the object is already in the instance pool
            return $obj;
        }

        return $this->findPkSimple($key, $con);
    }

    /**
     * Find object by primary key using raw SQL to go fast.
     * Bypass doSelect() and the object formatter by using generated code.
     *
     * @param mixed $key Primary key to use for the query
     * @param ConnectionInterface $con A connection object
     *
     * @throws \Propel\Runtime\Exception\PropelException
     *
     * @return ChildCfa A model object, or null if the key is not found
     */
    protected function findPkSimple($key, ConnectionInterface $con)
    {
        $sql = 'SELECT record_id, created_at, updated_at, piece_id, piece_id_run, piece_id_count, print_company, print_date_sent, print_date_receipt, print_medium, print_cost, print_notes, buyer_name, buyer_location, buyer_date_purchase, buyer_date_receipt, notes FROM cfa WHERE record_id = :p0';
        try {
            $stmt = $con->prepare($sql);
            $stmt->bindValue(':p0', $key, PDO::PARAM_INT);
            $stmt->execute();
        } catch (Exception $e) {
            Propel::log($e->getMessage(), Propel::LOG_ERR);
            throw new PropelException(sprintf('Unable to execute SELECT statement [%s]', $sql), 0, $e);
        }
        $obj = null;
        if ($row = $stmt->fetch(\PDO::FETCH_NUM)) {
            /** @var ChildCfa $obj */
            $obj = new ChildCfa();
            $obj->hydrate($row);
            CfaTableMap::addInstanceToPool($obj, null === $key || is_scalar($key) || is_callable([$key, '__toString']) ? (string) $key : $key);
        }
        $stmt->closeCursor();

        return $obj;
    }

    /**
     * Find object by primary key.
     *
     * @param mixed $key Primary key to use for the query
     * @param ConnectionInterface $con A connection object
     *
     * @return ChildCfa|array|mixed the result, formatted by the current formatter
     */
    protected function findPkComplex($key, ConnectionInterface $con)
    {
        // As the query uses a PK condition, no limit(1) is necessary.
        $criteria = $this->isKeepQuery() ? clone $this : $this;
        $dataFetcher = $criteria
            ->filterByPrimaryKey($key)
            ->doSelect($con);

        return $criteria->getFormatter()->init($criteria)->formatOne($dataFetcher);
    }

    /**
     * Find objects by primary key
     * <code>
     * $objs = $c->findPks(array(12, 56, 832), $con);
     * </code>
     * @param array $keys Primary keys to use for the query
     * @param ConnectionInterface $con an optional connection object
     *
     * @return Collection|array|mixed the list of results, formatted by the current formatter
     */
    public function findPks($keys, ?ConnectionInterface $con = null)
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getReadConnection($this->getDbName());
        }
        $this->basePreSelect($con);
        $criteria = $this->isKeepQuery() ? clone $this : $this;
        $dataFetcher = $criteria
            ->filterByPrimaryKeys($keys)
            ->doSelect($con);

        return $criteria->getFormatter()->init($criteria)->format($dataFetcher);
    }

    /**
     * Filter the query by primary key
     *
     * @param mixed $key Primary key to use for the query
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByPrimaryKey($key)
    {

        $this->addUsingAlias(CfaTableMap::COL_RECORD_ID, $key, Criteria::EQUAL);

        return $this;
    }

    /**
     * Filter the query by a list of primary keys
     *
     * @param array|int $keys The list of primary key to use for the query
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByPrimaryKeys($keys)
    {

        $this->addUsingAlias(CfaTableMap::COL_RECORD_ID, $keys, Criteria::IN);

        return $this;
    }

    /**
     * Filter the query on the record_id column
     *
     * Example usage:
     * <code>
     * $query->filterByRecordId(1234); // WHERE record_id = 1234
     * $query->filterByRecordId(array(12, 34)); // WHERE record_id IN (12, 34)
     * $query->filterByRecordId(array('min' => 12)); // WHERE record_id > 12
     * </code>
     *
     * @param mixed $recordId The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByRecordId($recordId = null, ?string $comparison = null)
    {
        if (is_array($recordId)) {
            $useMinMax = false;
            if (isset($recordId['min'])) {
                $this->addUsingAlias(CfaTableMap::COL_RECORD_ID, $recordId['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($recordId['max'])) {
                $this->addUsingAlias(CfaTableMap::COL_RECORD_ID, $recordId['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(CfaTableMap::COL_RECORD_ID, $recordId, $comparison);

        return $this;
    }

    /**
     * Filter the query on the created_at column
     *
     * Example usage:
     * <code>
     * $query->filterByCreatedAt('2011-03-14'); // WHERE created_at = '2011-03-14'
     * $query->filterByCreatedAt('now'); // WHERE created_at = '2011-03-14'
     * $query->filterByCreatedAt(array('max' => 'yesterday')); // WHERE created_at > '2011-03-13'
     * </code>
     *
     * @param mixed $createdAt The value to use as filter.
     *              Values can be integers (unix timestamps), DateTime objects, or strings.
     *              Empty strings are treated as NULL.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByCreatedAt($createdAt = null, ?string $comparison = null)
    {
        if (is_array($createdAt)) {
            $useMinMax = false;
            if (isset($createdAt['min'])) {
                $this->addUsingAlias(CfaTableMap::COL_CREATED_AT, $createdAt['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($createdAt['max'])) {
                $this->addUsingAlias(CfaTableMap::COL_CREATED_AT, $createdAt['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(CfaTableMap::COL_CREATED_AT, $createdAt, $comparison);

        return $this;
    }

    /**
     * Filter the query on the updated_at column
     *
     * Example usage:
     * <code>
     * $query->filterByUpdatedAt('2011-03-14'); // WHERE updated_at = '2011-03-14'
     * $query->filterByUpdatedAt('now'); // WHERE updated_at = '2011-03-14'
     * $query->filterByUpdatedAt(array('max' => 'yesterday')); // WHERE updated_at > '2011-03-13'
     * </code>
     *
     * @param mixed $updatedAt The value to use as filter.
     *              Values can be integers (unix timestamps), DateTime objects, or strings.
     *              Empty strings are treated as NULL.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByUpdatedAt($updatedAt = null, ?string $comparison = null)
    {
        if (is_array($updatedAt)) {
            $useMinMax = false;
            if (isset($updatedAt['min'])) {
                $this->addUsingAlias(CfaTableMap::COL_UPDATED_AT, $updatedAt['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($updatedAt['max'])) {
                $this->addUsingAlias(CfaTableMap::COL_UPDATED_AT, $updatedAt['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(CfaTableMap::COL_UPDATED_AT, $updatedAt, $comparison);

        return $this;
    }

    /**
     * Filter the query on the piece_id column
     *
     * Example usage:
     * <code>
     * $query->filterByPieceId(1234); // WHERE piece_id = 1234
     * $query->filterByPieceId(array(12, 34)); // WHERE piece_id IN (12, 34)
     * $query->filterByPieceId(array('min' => 12)); // WHERE piece_id > 12
     * </code>
     *
     * @param mixed $pieceId The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByPieceId($pieceId = null, ?string $comparison = null)
    {
        if (is_array($pieceId)) {
            $useMinMax = false;
            if (isset($pieceId['min'])) {
                $this->addUsingAlias(CfaTableMap::COL_PIECE_ID, $pieceId['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($pieceId['max'])) {
                $this->addUsingAlias(CfaTableMap::COL_PIECE_ID, $pieceId['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(CfaTableMap::COL_PIECE_ID, $pieceId, $comparison);

        return $this;
    }

    /**
     * Filter the query on the piece_id_run column
     *
     * Example usage:
     * <code>
     * $query->filterByPieceIdRun(1234); // WHERE piece_id_run = 1234
     * $query->filterByPieceIdRun(array(12, 34)); // WHERE piece_id_run IN (12, 34)
     * $query->filterByPieceIdRun(array('min' => 12)); // WHERE piece_id_run > 12
     * </code>
     *
     * @param mixed $pieceIdRun The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByPieceIdRun($pieceIdRun = null, ?string $comparison = null)
    {
        if (is_array($pieceIdRun)) {
            $useMinMax = false;
            if (isset($pieceIdRun['min'])) {
                $this->addUsingAlias(CfaTableMap::COL_PIECE_ID_RUN, $pieceIdRun['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($pieceIdRun['max'])) {
                $this->addUsingAlias(CfaTableMap::COL_PIECE_ID_RUN, $pieceIdRun['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(CfaTableMap::COL_PIECE_ID_RUN, $pieceIdRun, $comparison);

        return $this;
    }

    /**
     * Filter the query on the piece_id_count column
     *
     * Example usage:
     * <code>
     * $query->filterByPieceIdCount(1234); // WHERE piece_id_count = 1234
     * $query->filterByPieceIdCount(array(12, 34)); // WHERE piece_id_count IN (12, 34)
     * $query->filterByPieceIdCount(array('min' => 12)); // WHERE piece_id_count > 12
     * </code>
     *
     * @param mixed $pieceIdCount The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByPieceIdCount($pieceIdCount = null, ?string $comparison = null)
    {
        if (is_array($pieceIdCount)) {
            $useMinMax = false;
            if (isset($pieceIdCount['min'])) {
                $this->addUsingAlias(CfaTableMap::COL_PIECE_ID_COUNT, $pieceIdCount['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($pieceIdCount['max'])) {
                $this->addUsingAlias(CfaTableMap::COL_PIECE_ID_COUNT, $pieceIdCount['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(CfaTableMap::COL_PIECE_ID_COUNT, $pieceIdCount, $comparison);

        return $this;
    }

    /**
     * Filter the query on the print_company column
     *
     * Example usage:
     * <code>
     * $query->filterByPrintCompany('fooValue');   // WHERE print_company = 'fooValue'
     * $query->filterByPrintCompany('%fooValue%', Criteria::LIKE); // WHERE print_company LIKE '%fooValue%'
     * $query->filterByPrintCompany(['foo', 'bar']); // WHERE print_company IN ('foo', 'bar')
     * </code>
     *
     * @param string|string[] $printCompany The value to use as filter.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByPrintCompany($printCompany = null, ?string $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($printCompany)) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(CfaTableMap::COL_PRINT_COMPANY, $printCompany, $comparison);

        return $this;
    }

    /**
     * Filter the query on the print_date_sent column
     *
     * Example usage:
     * <code>
     * $query->filterByPrintDateSent('fooValue');   // WHERE print_date_sent = 'fooValue'
     * $query->filterByPrintDateSent('%fooValue%', Criteria::LIKE); // WHERE print_date_sent LIKE '%fooValue%'
     * $query->filterByPrintDateSent(['foo', 'bar']); // WHERE print_date_sent IN ('foo', 'bar')
     * </code>
     *
     * @param string|string[] $printDateSent The value to use as filter.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByPrintDateSent($printDateSent = null, ?string $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($printDateSent)) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(CfaTableMap::COL_PRINT_DATE_SENT, $printDateSent, $comparison);

        return $this;
    }

    /**
     * Filter the query on the print_date_receipt column
     *
     * Example usage:
     * <code>
     * $query->filterByPrintDateReceipt('fooValue');   // WHERE print_date_receipt = 'fooValue'
     * $query->filterByPrintDateReceipt('%fooValue%', Criteria::LIKE); // WHERE print_date_receipt LIKE '%fooValue%'
     * $query->filterByPrintDateReceipt(['foo', 'bar']); // WHERE print_date_receipt IN ('foo', 'bar')
     * </code>
     *
     * @param string|string[] $printDateReceipt The value to use as filter.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByPrintDateReceipt($printDateReceipt = null, ?string $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($printDateReceipt)) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(CfaTableMap::COL_PRINT_DATE_RECEIPT, $printDateReceipt, $comparison);

        return $this;
    }

    /**
     * Filter the query on the print_medium column
     *
     * Example usage:
     * <code>
     * $query->filterByPrintMedium('fooValue');   // WHERE print_medium = 'fooValue'
     * $query->filterByPrintMedium('%fooValue%', Criteria::LIKE); // WHERE print_medium LIKE '%fooValue%'
     * $query->filterByPrintMedium(['foo', 'bar']); // WHERE print_medium IN ('foo', 'bar')
     * </code>
     *
     * @param string|string[] $printMedium The value to use as filter.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByPrintMedium($printMedium = null, ?string $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($printMedium)) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(CfaTableMap::COL_PRINT_MEDIUM, $printMedium, $comparison);

        return $this;
    }

    /**
     * Filter the query on the print_cost column
     *
     * Example usage:
     * <code>
     * $query->filterByPrintCost('fooValue');   // WHERE print_cost = 'fooValue'
     * $query->filterByPrintCost('%fooValue%', Criteria::LIKE); // WHERE print_cost LIKE '%fooValue%'
     * $query->filterByPrintCost(['foo', 'bar']); // WHERE print_cost IN ('foo', 'bar')
     * </code>
     *
     * @param string|string[] $printCost The value to use as filter.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByPrintCost($printCost = null, ?string $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($printCost)) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(CfaTableMap::COL_PRINT_COST, $printCost, $comparison);

        return $this;
    }

    /**
     * Filter the query on the print_notes column
     *
     * Example usage:
     * <code>
     * $query->filterByPrintNotes('fooValue');   // WHERE print_notes = 'fooValue'
     * $query->filterByPrintNotes('%fooValue%', Criteria::LIKE); // WHERE print_notes LIKE '%fooValue%'
     * $query->filterByPrintNotes(['foo', 'bar']); // WHERE print_notes IN ('foo', 'bar')
     * </code>
     *
     * @param string|string[] $printNotes The value to use as filter.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByPrintNotes($printNotes = null, ?string $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($printNotes)) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(CfaTableMap::COL_PRINT_NOTES, $printNotes, $comparison);

        return $this;
    }

    /**
     * Filter the query on the buyer_name column
     *
     * Example usage:
     * <code>
     * $query->filterByBuyerName('fooValue');   // WHERE buyer_name = 'fooValue'
     * $query->filterByBuyerName('%fooValue%', Criteria::LIKE); // WHERE buyer_name LIKE '%fooValue%'
     * $query->filterByBuyerName(['foo', 'bar']); // WHERE buyer_name IN ('foo', 'bar')
     * </code>
     *
     * @param string|string[] $buyerName The value to use as filter.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByBuyerName($buyerName = null, ?string $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($buyerName)) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(CfaTableMap::COL_BUYER_NAME, $buyerName, $comparison);

        return $this;
    }

    /**
     * Filter the query on the buyer_location column
     *
     * Example usage:
     * <code>
     * $query->filterByBuyerLocation('fooValue');   // WHERE buyer_location = 'fooValue'
     * $query->filterByBuyerLocation('%fooValue%', Criteria::LIKE); // WHERE buyer_location LIKE '%fooValue%'
     * $query->filterByBuyerLocation(['foo', 'bar']); // WHERE buyer_location IN ('foo', 'bar')
     * </code>
     *
     * @param string|string[] $buyerLocation The value to use as filter.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByBuyerLocation($buyerLocation = null, ?string $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($buyerLocation)) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(CfaTableMap::COL_BUYER_LOCATION, $buyerLocation, $comparison);

        return $this;
    }

    /**
     * Filter the query on the buyer_date_purchase column
     *
     * Example usage:
     * <code>
     * $query->filterByBuyerDatePurchase('fooValue');   // WHERE buyer_date_purchase = 'fooValue'
     * $query->filterByBuyerDatePurchase('%fooValue%', Criteria::LIKE); // WHERE buyer_date_purchase LIKE '%fooValue%'
     * $query->filterByBuyerDatePurchase(['foo', 'bar']); // WHERE buyer_date_purchase IN ('foo', 'bar')
     * </code>
     *
     * @param string|string[] $buyerDatePurchase The value to use as filter.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByBuyerDatePurchase($buyerDatePurchase = null, ?string $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($buyerDatePurchase)) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(CfaTableMap::COL_BUYER_DATE_PURCHASE, $buyerDatePurchase, $comparison);

        return $this;
    }

    /**
     * Filter the query on the buyer_date_receipt column
     *
     * Example usage:
     * <code>
     * $query->filterByBuyerDateReceipt('fooValue');   // WHERE buyer_date_receipt = 'fooValue'
     * $query->filterByBuyerDateReceipt('%fooValue%', Criteria::LIKE); // WHERE buyer_date_receipt LIKE '%fooValue%'
     * $query->filterByBuyerDateReceipt(['foo', 'bar']); // WHERE buyer_date_receipt IN ('foo', 'bar')
     * </code>
     *
     * @param string|string[] $buyerDateReceipt The value to use as filter.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByBuyerDateReceipt($buyerDateReceipt = null, ?string $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($buyerDateReceipt)) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(CfaTableMap::COL_BUYER_DATE_RECEIPT, $buyerDateReceipt, $comparison);

        return $this;
    }

    /**
     * Filter the query on the notes column
     *
     * Example usage:
     * <code>
     * $query->filterByNotes('fooValue');   // WHERE notes = 'fooValue'
     * $query->filterByNotes('%fooValue%', Criteria::LIKE); // WHERE notes LIKE '%fooValue%'
     * $query->filterByNotes(['foo', 'bar']); // WHERE notes IN ('foo', 'bar')
     * </code>
     *
     * @param string|string[] $notes The value to use as filter.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByNotes($notes = null, ?string $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($notes)) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(CfaTableMap::COL_NOTES, $notes, $comparison);

        return $this;
    }

    /**
     * Exclude object from result
     *
     * @param ChildCfa $cfa Object to remove from the list of results
     *
     * @return $this The current query, for fluid interface
     */
    public function prune($cfa = null)
    {
        if ($cfa) {
            $this->addUsingAlias(CfaTableMap::COL_RECORD_ID, $cfa->getRecordId(), Criteria::NOT_EQUAL);
        }

        return $this;
    }

    /**
     * Deletes all rows from the cfa table.
     *
     * @param ConnectionInterface $con the connection to use
     * @return int The number of affected rows (if supported by underlying database driver).
     */
    public function doDeleteAll(?ConnectionInterface $con = null): int
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(CfaTableMap::DATABASE_NAME);
        }

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con) {
            $affectedRows = 0; // initialize var to track total num of affected rows
            $affectedRows += parent::doDeleteAll($con);
            // Because this db requires some delete cascade/set null emulation, we have to
            // clear the cached instance *after* the emulation has happened (since
            // instances get re-added by the select statement contained therein).
            CfaTableMap::clearInstancePool();
            CfaTableMap::clearRelatedInstancePool();

            return $affectedRows;
        });
    }

    /**
     * Performs a DELETE on the database based on the current ModelCriteria
     *
     * @param ConnectionInterface $con the connection to use
     * @return int The number of affected rows (if supported by underlying database driver).  This includes CASCADE-related rows
     *                         if supported by native driver or if emulated using Propel.
     * @throws \Propel\Runtime\Exception\PropelException Any exceptions caught during processing will be
     *                         rethrown wrapped into a PropelException.
     */
    public function delete(?ConnectionInterface $con = null): int
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(CfaTableMap::DATABASE_NAME);
        }

        $criteria = $this;

        // Set the correct dbName
        $criteria->setDbName(CfaTableMap::DATABASE_NAME);

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con, $criteria) {
            $affectedRows = 0; // initialize var to track total num of affected rows

            CfaTableMap::removeInstanceFromPool($criteria);

            $affectedRows += ModelCriteria::delete($con);
            CfaTableMap::clearRelatedInstancePool();

            return $affectedRows;
        });
    }

}
