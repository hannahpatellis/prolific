<?php

namespace Art\Base;

use \Exception;
use \PDO;
use Art\Pieces as ChildPieces;
use Art\PiecesQuery as ChildPiecesQuery;
use Art\Map\PiecesTableMap;
use Propel\Runtime\Propel;
use Propel\Runtime\ActiveQuery\Criteria;
use Propel\Runtime\ActiveQuery\ModelCriteria;
use Propel\Runtime\Collection\Collection;
use Propel\Runtime\Connection\ConnectionInterface;
use Propel\Runtime\Exception\PropelException;

/**
 * Base class that represents a query for the `pieces` table.
 *
 * @method     ChildPiecesQuery orderById($order = Criteria::ASC) Order by the id column
 * @method     ChildPiecesQuery orderByTitle($order = Criteria::ASC) Order by the title column
 * @method     ChildPiecesQuery orderByStartDate($order = Criteria::ASC) Order by the start_date column
 * @method     ChildPiecesQuery orderByEndDate($order = Criteria::ASC) Order by the end_date column
 * @method     ChildPiecesQuery orderByCollection($order = Criteria::ASC) Order by the collection column
 * @method     ChildPiecesQuery orderBySubcollection($order = Criteria::ASC) Order by the subcollection column
 * @method     ChildPiecesQuery orderBySizeHeight($order = Criteria::ASC) Order by the size_height column
 * @method     ChildPiecesQuery orderBySizeWidth($order = Criteria::ASC) Order by the size_width column
 * @method     ChildPiecesQuery orderBySizeUnit($order = Criteria::ASC) Order by the size_unit column
 * @method     ChildPiecesQuery orderByTemperature($order = Criteria::ASC) Order by the temperature column
 * @method     ChildPiecesQuery orderByBackground($order = Criteria::ASC) Order by the background column
 * @method     ChildPiecesQuery orderByColors($order = Criteria::ASC) Order by the colors column
 * @method     ChildPiecesQuery orderByDescription($order = Criteria::ASC) Order by the description column
 * @method     ChildPiecesQuery orderByStory($order = Criteria::ASC) Order by the story column
 * @method     ChildPiecesQuery orderByNotes($order = Criteria::ASC) Order by the notes column
 * @method     ChildPiecesQuery orderByAITrainingForm($order = Criteria::ASC) Order by the ai_training_form column
 * @method     ChildPiecesQuery orderByAITrainingColored($order = Criteria::ASC) Order by the ai_training_colored column
 * @method     ChildPiecesQuery orderByAITrainingFinal($order = Criteria::ASC) Order by the ai_training_final column
 * @method     ChildPiecesQuery orderByLocation($order = Criteria::ASC) Order by the location column
 * @method     ChildPiecesQuery orderByThumbnail($order = Criteria::ASC) Order by the thumbnail column
 * @method     ChildPiecesQuery orderByCreatedAt($order = Criteria::ASC) Order by the created_at column
 * @method     ChildPiecesQuery orderByUpdatedAt($order = Criteria::ASC) Order by the updated_at column
 *
 * @method     ChildPiecesQuery groupById() Group by the id column
 * @method     ChildPiecesQuery groupByTitle() Group by the title column
 * @method     ChildPiecesQuery groupByStartDate() Group by the start_date column
 * @method     ChildPiecesQuery groupByEndDate() Group by the end_date column
 * @method     ChildPiecesQuery groupByCollection() Group by the collection column
 * @method     ChildPiecesQuery groupBySubcollection() Group by the subcollection column
 * @method     ChildPiecesQuery groupBySizeHeight() Group by the size_height column
 * @method     ChildPiecesQuery groupBySizeWidth() Group by the size_width column
 * @method     ChildPiecesQuery groupBySizeUnit() Group by the size_unit column
 * @method     ChildPiecesQuery groupByTemperature() Group by the temperature column
 * @method     ChildPiecesQuery groupByBackground() Group by the background column
 * @method     ChildPiecesQuery groupByColors() Group by the colors column
 * @method     ChildPiecesQuery groupByDescription() Group by the description column
 * @method     ChildPiecesQuery groupByStory() Group by the story column
 * @method     ChildPiecesQuery groupByNotes() Group by the notes column
 * @method     ChildPiecesQuery groupByAITrainingForm() Group by the ai_training_form column
 * @method     ChildPiecesQuery groupByAITrainingColored() Group by the ai_training_colored column
 * @method     ChildPiecesQuery groupByAITrainingFinal() Group by the ai_training_final column
 * @method     ChildPiecesQuery groupByLocation() Group by the location column
 * @method     ChildPiecesQuery groupByThumbnail() Group by the thumbnail column
 * @method     ChildPiecesQuery groupByCreatedAt() Group by the created_at column
 * @method     ChildPiecesQuery groupByUpdatedAt() Group by the updated_at column
 *
 * @method     ChildPiecesQuery leftJoin($relation) Adds a LEFT JOIN clause to the query
 * @method     ChildPiecesQuery rightJoin($relation) Adds a RIGHT JOIN clause to the query
 * @method     ChildPiecesQuery innerJoin($relation) Adds a INNER JOIN clause to the query
 *
 * @method     ChildPiecesQuery leftJoinWith($relation) Adds a LEFT JOIN clause and with to the query
 * @method     ChildPiecesQuery rightJoinWith($relation) Adds a RIGHT JOIN clause and with to the query
 * @method     ChildPiecesQuery innerJoinWith($relation) Adds a INNER JOIN clause and with to the query
 *
 * @method     ChildPieces|null findOne(?ConnectionInterface $con = null) Return the first ChildPieces matching the query
 * @method     ChildPieces findOneOrCreate(?ConnectionInterface $con = null) Return the first ChildPieces matching the query, or a new ChildPieces object populated from the query conditions when no match is found
 *
 * @method     ChildPieces|null findOneById(int $id) Return the first ChildPieces filtered by the id column
 * @method     ChildPieces|null findOneByTitle(string $title) Return the first ChildPieces filtered by the title column
 * @method     ChildPieces|null findOneByStartDate(string $start_date) Return the first ChildPieces filtered by the start_date column
 * @method     ChildPieces|null findOneByEndDate(string $end_date) Return the first ChildPieces filtered by the end_date column
 * @method     ChildPieces|null findOneByCollection(string $collection) Return the first ChildPieces filtered by the collection column
 * @method     ChildPieces|null findOneBySubcollection(string $subcollection) Return the first ChildPieces filtered by the subcollection column
 * @method     ChildPieces|null findOneBySizeHeight(string $size_height) Return the first ChildPieces filtered by the size_height column
 * @method     ChildPieces|null findOneBySizeWidth(string $size_width) Return the first ChildPieces filtered by the size_width column
 * @method     ChildPieces|null findOneBySizeUnit(string $size_unit) Return the first ChildPieces filtered by the size_unit column
 * @method     ChildPieces|null findOneByTemperature(string $temperature) Return the first ChildPieces filtered by the temperature column
 * @method     ChildPieces|null findOneByBackground(string $background) Return the first ChildPieces filtered by the background column
 * @method     ChildPieces|null findOneByColors(string $colors) Return the first ChildPieces filtered by the colors column
 * @method     ChildPieces|null findOneByDescription(string $description) Return the first ChildPieces filtered by the description column
 * @method     ChildPieces|null findOneByStory(string $story) Return the first ChildPieces filtered by the story column
 * @method     ChildPieces|null findOneByNotes(string $notes) Return the first ChildPieces filtered by the notes column
 * @method     ChildPieces|null findOneByAITrainingForm(string $ai_training_form) Return the first ChildPieces filtered by the ai_training_form column
 * @method     ChildPieces|null findOneByAITrainingColored(string $ai_training_colored) Return the first ChildPieces filtered by the ai_training_colored column
 * @method     ChildPieces|null findOneByAITrainingFinal(string $ai_training_final) Return the first ChildPieces filtered by the ai_training_final column
 * @method     ChildPieces|null findOneByLocation(string $location) Return the first ChildPieces filtered by the location column
 * @method     ChildPieces|null findOneByThumbnail(string $thumbnail) Return the first ChildPieces filtered by the thumbnail column
 * @method     ChildPieces|null findOneByCreatedAt(string $created_at) Return the first ChildPieces filtered by the created_at column
 * @method     ChildPieces|null findOneByUpdatedAt(string $updated_at) Return the first ChildPieces filtered by the updated_at column
 *
 * @method     ChildPieces requirePk($key, ?ConnectionInterface $con = null) Return the ChildPieces by primary key and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildPieces requireOne(?ConnectionInterface $con = null) Return the first ChildPieces matching the query and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildPieces requireOneById(int $id) Return the first ChildPieces filtered by the id column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildPieces requireOneByTitle(string $title) Return the first ChildPieces filtered by the title column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildPieces requireOneByStartDate(string $start_date) Return the first ChildPieces filtered by the start_date column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildPieces requireOneByEndDate(string $end_date) Return the first ChildPieces filtered by the end_date column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildPieces requireOneByCollection(string $collection) Return the first ChildPieces filtered by the collection column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildPieces requireOneBySubcollection(string $subcollection) Return the first ChildPieces filtered by the subcollection column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildPieces requireOneBySizeHeight(string $size_height) Return the first ChildPieces filtered by the size_height column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildPieces requireOneBySizeWidth(string $size_width) Return the first ChildPieces filtered by the size_width column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildPieces requireOneBySizeUnit(string $size_unit) Return the first ChildPieces filtered by the size_unit column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildPieces requireOneByTemperature(string $temperature) Return the first ChildPieces filtered by the temperature column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildPieces requireOneByBackground(string $background) Return the first ChildPieces filtered by the background column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildPieces requireOneByColors(string $colors) Return the first ChildPieces filtered by the colors column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildPieces requireOneByDescription(string $description) Return the first ChildPieces filtered by the description column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildPieces requireOneByStory(string $story) Return the first ChildPieces filtered by the story column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildPieces requireOneByNotes(string $notes) Return the first ChildPieces filtered by the notes column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildPieces requireOneByAITrainingForm(string $ai_training_form) Return the first ChildPieces filtered by the ai_training_form column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildPieces requireOneByAITrainingColored(string $ai_training_colored) Return the first ChildPieces filtered by the ai_training_colored column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildPieces requireOneByAITrainingFinal(string $ai_training_final) Return the first ChildPieces filtered by the ai_training_final column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildPieces requireOneByLocation(string $location) Return the first ChildPieces filtered by the location column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildPieces requireOneByThumbnail(string $thumbnail) Return the first ChildPieces filtered by the thumbnail column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildPieces requireOneByCreatedAt(string $created_at) Return the first ChildPieces filtered by the created_at column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildPieces requireOneByUpdatedAt(string $updated_at) Return the first ChildPieces filtered by the updated_at column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildPieces[]|Collection find(?ConnectionInterface $con = null) Return ChildPieces objects based on current ModelCriteria
 * @psalm-method Collection&\Traversable<ChildPieces> find(?ConnectionInterface $con = null) Return ChildPieces objects based on current ModelCriteria
 *
 * @method     ChildPieces[]|Collection findById(int|array<int> $id) Return ChildPieces objects filtered by the id column
 * @psalm-method Collection&\Traversable<ChildPieces> findById(int|array<int> $id) Return ChildPieces objects filtered by the id column
 * @method     ChildPieces[]|Collection findByTitle(string|array<string> $title) Return ChildPieces objects filtered by the title column
 * @psalm-method Collection&\Traversable<ChildPieces> findByTitle(string|array<string> $title) Return ChildPieces objects filtered by the title column
 * @method     ChildPieces[]|Collection findByStartDate(string|array<string> $start_date) Return ChildPieces objects filtered by the start_date column
 * @psalm-method Collection&\Traversable<ChildPieces> findByStartDate(string|array<string> $start_date) Return ChildPieces objects filtered by the start_date column
 * @method     ChildPieces[]|Collection findByEndDate(string|array<string> $end_date) Return ChildPieces objects filtered by the end_date column
 * @psalm-method Collection&\Traversable<ChildPieces> findByEndDate(string|array<string> $end_date) Return ChildPieces objects filtered by the end_date column
 * @method     ChildPieces[]|Collection findByCollection(string|array<string> $collection) Return ChildPieces objects filtered by the collection column
 * @psalm-method Collection&\Traversable<ChildPieces> findByCollection(string|array<string> $collection) Return ChildPieces objects filtered by the collection column
 * @method     ChildPieces[]|Collection findBySubcollection(string|array<string> $subcollection) Return ChildPieces objects filtered by the subcollection column
 * @psalm-method Collection&\Traversable<ChildPieces> findBySubcollection(string|array<string> $subcollection) Return ChildPieces objects filtered by the subcollection column
 * @method     ChildPieces[]|Collection findBySizeHeight(string|array<string> $size_height) Return ChildPieces objects filtered by the size_height column
 * @psalm-method Collection&\Traversable<ChildPieces> findBySizeHeight(string|array<string> $size_height) Return ChildPieces objects filtered by the size_height column
 * @method     ChildPieces[]|Collection findBySizeWidth(string|array<string> $size_width) Return ChildPieces objects filtered by the size_width column
 * @psalm-method Collection&\Traversable<ChildPieces> findBySizeWidth(string|array<string> $size_width) Return ChildPieces objects filtered by the size_width column
 * @method     ChildPieces[]|Collection findBySizeUnit(string|array<string> $size_unit) Return ChildPieces objects filtered by the size_unit column
 * @psalm-method Collection&\Traversable<ChildPieces> findBySizeUnit(string|array<string> $size_unit) Return ChildPieces objects filtered by the size_unit column
 * @method     ChildPieces[]|Collection findByTemperature(string|array<string> $temperature) Return ChildPieces objects filtered by the temperature column
 * @psalm-method Collection&\Traversable<ChildPieces> findByTemperature(string|array<string> $temperature) Return ChildPieces objects filtered by the temperature column
 * @method     ChildPieces[]|Collection findByBackground(string|array<string> $background) Return ChildPieces objects filtered by the background column
 * @psalm-method Collection&\Traversable<ChildPieces> findByBackground(string|array<string> $background) Return ChildPieces objects filtered by the background column
 * @method     ChildPieces[]|Collection findByColors(string|array<string> $colors) Return ChildPieces objects filtered by the colors column
 * @psalm-method Collection&\Traversable<ChildPieces> findByColors(string|array<string> $colors) Return ChildPieces objects filtered by the colors column
 * @method     ChildPieces[]|Collection findByDescription(string|array<string> $description) Return ChildPieces objects filtered by the description column
 * @psalm-method Collection&\Traversable<ChildPieces> findByDescription(string|array<string> $description) Return ChildPieces objects filtered by the description column
 * @method     ChildPieces[]|Collection findByStory(string|array<string> $story) Return ChildPieces objects filtered by the story column
 * @psalm-method Collection&\Traversable<ChildPieces> findByStory(string|array<string> $story) Return ChildPieces objects filtered by the story column
 * @method     ChildPieces[]|Collection findByNotes(string|array<string> $notes) Return ChildPieces objects filtered by the notes column
 * @psalm-method Collection&\Traversable<ChildPieces> findByNotes(string|array<string> $notes) Return ChildPieces objects filtered by the notes column
 * @method     ChildPieces[]|Collection findByAITrainingForm(string|array<string> $ai_training_form) Return ChildPieces objects filtered by the ai_training_form column
 * @psalm-method Collection&\Traversable<ChildPieces> findByAITrainingForm(string|array<string> $ai_training_form) Return ChildPieces objects filtered by the ai_training_form column
 * @method     ChildPieces[]|Collection findByAITrainingColored(string|array<string> $ai_training_colored) Return ChildPieces objects filtered by the ai_training_colored column
 * @psalm-method Collection&\Traversable<ChildPieces> findByAITrainingColored(string|array<string> $ai_training_colored) Return ChildPieces objects filtered by the ai_training_colored column
 * @method     ChildPieces[]|Collection findByAITrainingFinal(string|array<string> $ai_training_final) Return ChildPieces objects filtered by the ai_training_final column
 * @psalm-method Collection&\Traversable<ChildPieces> findByAITrainingFinal(string|array<string> $ai_training_final) Return ChildPieces objects filtered by the ai_training_final column
 * @method     ChildPieces[]|Collection findByLocation(string|array<string> $location) Return ChildPieces objects filtered by the location column
 * @psalm-method Collection&\Traversable<ChildPieces> findByLocation(string|array<string> $location) Return ChildPieces objects filtered by the location column
 * @method     ChildPieces[]|Collection findByThumbnail(string|array<string> $thumbnail) Return ChildPieces objects filtered by the thumbnail column
 * @psalm-method Collection&\Traversable<ChildPieces> findByThumbnail(string|array<string> $thumbnail) Return ChildPieces objects filtered by the thumbnail column
 * @method     ChildPieces[]|Collection findByCreatedAt(string|array<string> $created_at) Return ChildPieces objects filtered by the created_at column
 * @psalm-method Collection&\Traversable<ChildPieces> findByCreatedAt(string|array<string> $created_at) Return ChildPieces objects filtered by the created_at column
 * @method     ChildPieces[]|Collection findByUpdatedAt(string|array<string> $updated_at) Return ChildPieces objects filtered by the updated_at column
 * @psalm-method Collection&\Traversable<ChildPieces> findByUpdatedAt(string|array<string> $updated_at) Return ChildPieces objects filtered by the updated_at column
 *
 * @method     ChildPieces[]|\Propel\Runtime\Util\PropelModelPager paginate($page = 1, $maxPerPage = 10, ?ConnectionInterface $con = null) Issue a SELECT query based on the current ModelCriteria and uses a page and a maximum number of results per page to compute an offset and a limit
 * @psalm-method \Propel\Runtime\Util\PropelModelPager&\Traversable<ChildPieces> paginate($page = 1, $maxPerPage = 10, ?ConnectionInterface $con = null) Issue a SELECT query based on the current ModelCriteria and uses a page and a maximum number of results per page to compute an offset and a limit
 */
abstract class PiecesQuery extends ModelCriteria
{
    protected $entityNotFoundExceptionClass = '\\Propel\\Runtime\\Exception\\EntityNotFoundException';

    /**
     * Initializes internal state of \Art\Base\PiecesQuery object.
     *
     * @param string $dbName The database name
     * @param string $modelName The phpName of a model, e.g. 'Book'
     * @param string $modelAlias The alias for the model in this query, e.g. 'b'
     */
    public function __construct($dbName = 'default', $modelName = '\\Art\\Pieces', $modelAlias = null)
    {
        parent::__construct($dbName, $modelName, $modelAlias);
    }

    /**
     * Returns a new ChildPiecesQuery object.
     *
     * @param string $modelAlias The alias of a model in the query
     * @param Criteria $criteria Optional Criteria to build the query from
     *
     * @return ChildPiecesQuery
     */
    public static function create(?string $modelAlias = null, ?Criteria $criteria = null): Criteria
    {
        if ($criteria instanceof ChildPiecesQuery) {
            return $criteria;
        }
        $query = new ChildPiecesQuery();
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
     * @return ChildPieces|array|mixed the result, formatted by the current formatter
     */
    public function findPk($key, ?ConnectionInterface $con = null)
    {
        if ($key === null) {
            return null;
        }

        if ($con === null) {
            $con = Propel::getServiceContainer()->getReadConnection(PiecesTableMap::DATABASE_NAME);
        }

        $this->basePreSelect($con);

        if (
            $this->formatter || $this->modelAlias || $this->with || $this->select
            || $this->selectColumns || $this->asColumns || $this->selectModifiers
            || $this->map || $this->having || $this->joins
        ) {
            return $this->findPkComplex($key, $con);
        }

        if ((null !== ($obj = PiecesTableMap::getInstanceFromPool(null === $key || is_scalar($key) || is_callable([$key, '__toString']) ? (string) $key : $key)))) {
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
     * @return ChildPieces A model object, or null if the key is not found
     */
    protected function findPkSimple($key, ConnectionInterface $con)
    {
        $sql = 'SELECT id, title, start_date, end_date, collection, subcollection, size_height, size_width, size_unit, temperature, background, colors, description, story, notes, ai_training_form, ai_training_colored, ai_training_final, location, thumbnail, created_at, updated_at FROM pieces WHERE id = :p0';
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
            /** @var ChildPieces $obj */
            $obj = new ChildPieces();
            $obj->hydrate($row);
            PiecesTableMap::addInstanceToPool($obj, null === $key || is_scalar($key) || is_callable([$key, '__toString']) ? (string) $key : $key);
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
     * @return ChildPieces|array|mixed the result, formatted by the current formatter
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

        $this->addUsingAlias(PiecesTableMap::COL_ID, $key, Criteria::EQUAL);

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

        $this->addUsingAlias(PiecesTableMap::COL_ID, $keys, Criteria::IN);

        return $this;
    }

    /**
     * Filter the query on the id column
     *
     * Example usage:
     * <code>
     * $query->filterById(1234); // WHERE id = 1234
     * $query->filterById(array(12, 34)); // WHERE id IN (12, 34)
     * $query->filterById(array('min' => 12)); // WHERE id > 12
     * </code>
     *
     * @param mixed $id The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterById($id = null, ?string $comparison = null)
    {
        if (is_array($id)) {
            $useMinMax = false;
            if (isset($id['min'])) {
                $this->addUsingAlias(PiecesTableMap::COL_ID, $id['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($id['max'])) {
                $this->addUsingAlias(PiecesTableMap::COL_ID, $id['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(PiecesTableMap::COL_ID, $id, $comparison);

        return $this;
    }

    /**
     * Filter the query on the title column
     *
     * Example usage:
     * <code>
     * $query->filterByTitle('fooValue');   // WHERE title = 'fooValue'
     * $query->filterByTitle('%fooValue%', Criteria::LIKE); // WHERE title LIKE '%fooValue%'
     * $query->filterByTitle(['foo', 'bar']); // WHERE title IN ('foo', 'bar')
     * </code>
     *
     * @param string|string[] $title The value to use as filter.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByTitle($title = null, ?string $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($title)) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(PiecesTableMap::COL_TITLE, $title, $comparison);

        return $this;
    }

    /**
     * Filter the query on the start_date column
     *
     * Example usage:
     * <code>
     * $query->filterByStartDate('fooValue');   // WHERE start_date = 'fooValue'
     * $query->filterByStartDate('%fooValue%', Criteria::LIKE); // WHERE start_date LIKE '%fooValue%'
     * $query->filterByStartDate(['foo', 'bar']); // WHERE start_date IN ('foo', 'bar')
     * </code>
     *
     * @param string|string[] $startDate The value to use as filter.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByStartDate($startDate = null, ?string $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($startDate)) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(PiecesTableMap::COL_START_DATE, $startDate, $comparison);

        return $this;
    }

    /**
     * Filter the query on the end_date column
     *
     * Example usage:
     * <code>
     * $query->filterByEndDate('fooValue');   // WHERE end_date = 'fooValue'
     * $query->filterByEndDate('%fooValue%', Criteria::LIKE); // WHERE end_date LIKE '%fooValue%'
     * $query->filterByEndDate(['foo', 'bar']); // WHERE end_date IN ('foo', 'bar')
     * </code>
     *
     * @param string|string[] $endDate The value to use as filter.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByEndDate($endDate = null, ?string $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($endDate)) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(PiecesTableMap::COL_END_DATE, $endDate, $comparison);

        return $this;
    }

    /**
     * Filter the query on the collection column
     *
     * Example usage:
     * <code>
     * $query->filterByCollection('fooValue');   // WHERE collection = 'fooValue'
     * $query->filterByCollection('%fooValue%', Criteria::LIKE); // WHERE collection LIKE '%fooValue%'
     * $query->filterByCollection(['foo', 'bar']); // WHERE collection IN ('foo', 'bar')
     * </code>
     *
     * @param string|string[] $collection The value to use as filter.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByCollection($collection = null, ?string $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($collection)) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(PiecesTableMap::COL_COLLECTION, $collection, $comparison);

        return $this;
    }

    /**
     * Filter the query on the subcollection column
     *
     * Example usage:
     * <code>
     * $query->filterBySubcollection('fooValue');   // WHERE subcollection = 'fooValue'
     * $query->filterBySubcollection('%fooValue%', Criteria::LIKE); // WHERE subcollection LIKE '%fooValue%'
     * $query->filterBySubcollection(['foo', 'bar']); // WHERE subcollection IN ('foo', 'bar')
     * </code>
     *
     * @param string|string[] $subcollection The value to use as filter.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterBySubcollection($subcollection = null, ?string $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($subcollection)) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(PiecesTableMap::COL_SUBCOLLECTION, $subcollection, $comparison);

        return $this;
    }

    /**
     * Filter the query on the size_height column
     *
     * Example usage:
     * <code>
     * $query->filterBySizeHeight('fooValue');   // WHERE size_height = 'fooValue'
     * $query->filterBySizeHeight('%fooValue%', Criteria::LIKE); // WHERE size_height LIKE '%fooValue%'
     * $query->filterBySizeHeight(['foo', 'bar']); // WHERE size_height IN ('foo', 'bar')
     * </code>
     *
     * @param string|string[] $sizeHeight The value to use as filter.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterBySizeHeight($sizeHeight = null, ?string $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($sizeHeight)) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(PiecesTableMap::COL_SIZE_HEIGHT, $sizeHeight, $comparison);

        return $this;
    }

    /**
     * Filter the query on the size_width column
     *
     * Example usage:
     * <code>
     * $query->filterBySizeWidth('fooValue');   // WHERE size_width = 'fooValue'
     * $query->filterBySizeWidth('%fooValue%', Criteria::LIKE); // WHERE size_width LIKE '%fooValue%'
     * $query->filterBySizeWidth(['foo', 'bar']); // WHERE size_width IN ('foo', 'bar')
     * </code>
     *
     * @param string|string[] $sizeWidth The value to use as filter.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterBySizeWidth($sizeWidth = null, ?string $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($sizeWidth)) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(PiecesTableMap::COL_SIZE_WIDTH, $sizeWidth, $comparison);

        return $this;
    }

    /**
     * Filter the query on the size_unit column
     *
     * Example usage:
     * <code>
     * $query->filterBySizeUnit('fooValue');   // WHERE size_unit = 'fooValue'
     * $query->filterBySizeUnit('%fooValue%', Criteria::LIKE); // WHERE size_unit LIKE '%fooValue%'
     * $query->filterBySizeUnit(['foo', 'bar']); // WHERE size_unit IN ('foo', 'bar')
     * </code>
     *
     * @param string|string[] $sizeUnit The value to use as filter.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterBySizeUnit($sizeUnit = null, ?string $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($sizeUnit)) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(PiecesTableMap::COL_SIZE_UNIT, $sizeUnit, $comparison);

        return $this;
    }

    /**
     * Filter the query on the temperature column
     *
     * Example usage:
     * <code>
     * $query->filterByTemperature('fooValue');   // WHERE temperature = 'fooValue'
     * $query->filterByTemperature('%fooValue%', Criteria::LIKE); // WHERE temperature LIKE '%fooValue%'
     * $query->filterByTemperature(['foo', 'bar']); // WHERE temperature IN ('foo', 'bar')
     * </code>
     *
     * @param string|string[] $temperature The value to use as filter.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByTemperature($temperature = null, ?string $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($temperature)) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(PiecesTableMap::COL_TEMPERATURE, $temperature, $comparison);

        return $this;
    }

    /**
     * Filter the query on the background column
     *
     * Example usage:
     * <code>
     * $query->filterByBackground('fooValue');   // WHERE background = 'fooValue'
     * $query->filterByBackground('%fooValue%', Criteria::LIKE); // WHERE background LIKE '%fooValue%'
     * $query->filterByBackground(['foo', 'bar']); // WHERE background IN ('foo', 'bar')
     * </code>
     *
     * @param string|string[] $background The value to use as filter.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByBackground($background = null, ?string $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($background)) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(PiecesTableMap::COL_BACKGROUND, $background, $comparison);

        return $this;
    }

    /**
     * Filter the query on the colors column
     *
     * Example usage:
     * <code>
     * $query->filterByColors('fooValue');   // WHERE colors = 'fooValue'
     * $query->filterByColors('%fooValue%', Criteria::LIKE); // WHERE colors LIKE '%fooValue%'
     * $query->filterByColors(['foo', 'bar']); // WHERE colors IN ('foo', 'bar')
     * </code>
     *
     * @param string|string[] $colors The value to use as filter.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByColors($colors = null, ?string $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($colors)) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(PiecesTableMap::COL_COLORS, $colors, $comparison);

        return $this;
    }

    /**
     * Filter the query on the description column
     *
     * Example usage:
     * <code>
     * $query->filterByDescription('fooValue');   // WHERE description = 'fooValue'
     * $query->filterByDescription('%fooValue%', Criteria::LIKE); // WHERE description LIKE '%fooValue%'
     * $query->filterByDescription(['foo', 'bar']); // WHERE description IN ('foo', 'bar')
     * </code>
     *
     * @param string|string[] $description The value to use as filter.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByDescription($description = null, ?string $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($description)) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(PiecesTableMap::COL_DESCRIPTION, $description, $comparison);

        return $this;
    }

    /**
     * Filter the query on the story column
     *
     * Example usage:
     * <code>
     * $query->filterByStory('fooValue');   // WHERE story = 'fooValue'
     * $query->filterByStory('%fooValue%', Criteria::LIKE); // WHERE story LIKE '%fooValue%'
     * $query->filterByStory(['foo', 'bar']); // WHERE story IN ('foo', 'bar')
     * </code>
     *
     * @param string|string[] $story The value to use as filter.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByStory($story = null, ?string $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($story)) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(PiecesTableMap::COL_STORY, $story, $comparison);

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

        $this->addUsingAlias(PiecesTableMap::COL_NOTES, $notes, $comparison);

        return $this;
    }

    /**
     * Filter the query on the ai_training_form column
     *
     * Example usage:
     * <code>
     * $query->filterByAITrainingForm('fooValue');   // WHERE ai_training_form = 'fooValue'
     * $query->filterByAITrainingForm('%fooValue%', Criteria::LIKE); // WHERE ai_training_form LIKE '%fooValue%'
     * $query->filterByAITrainingForm(['foo', 'bar']); // WHERE ai_training_form IN ('foo', 'bar')
     * </code>
     *
     * @param string|string[] $aITrainingForm The value to use as filter.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByAITrainingForm($aITrainingForm = null, ?string $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($aITrainingForm)) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(PiecesTableMap::COL_AI_TRAINING_FORM, $aITrainingForm, $comparison);

        return $this;
    }

    /**
     * Filter the query on the ai_training_colored column
     *
     * Example usage:
     * <code>
     * $query->filterByAITrainingColored('fooValue');   // WHERE ai_training_colored = 'fooValue'
     * $query->filterByAITrainingColored('%fooValue%', Criteria::LIKE); // WHERE ai_training_colored LIKE '%fooValue%'
     * $query->filterByAITrainingColored(['foo', 'bar']); // WHERE ai_training_colored IN ('foo', 'bar')
     * </code>
     *
     * @param string|string[] $aITrainingColored The value to use as filter.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByAITrainingColored($aITrainingColored = null, ?string $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($aITrainingColored)) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(PiecesTableMap::COL_AI_TRAINING_COLORED, $aITrainingColored, $comparison);

        return $this;
    }

    /**
     * Filter the query on the ai_training_final column
     *
     * Example usage:
     * <code>
     * $query->filterByAITrainingFinal('fooValue');   // WHERE ai_training_final = 'fooValue'
     * $query->filterByAITrainingFinal('%fooValue%', Criteria::LIKE); // WHERE ai_training_final LIKE '%fooValue%'
     * $query->filterByAITrainingFinal(['foo', 'bar']); // WHERE ai_training_final IN ('foo', 'bar')
     * </code>
     *
     * @param string|string[] $aITrainingFinal The value to use as filter.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByAITrainingFinal($aITrainingFinal = null, ?string $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($aITrainingFinal)) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(PiecesTableMap::COL_AI_TRAINING_FINAL, $aITrainingFinal, $comparison);

        return $this;
    }

    /**
     * Filter the query on the location column
     *
     * Example usage:
     * <code>
     * $query->filterByLocation('fooValue');   // WHERE location = 'fooValue'
     * $query->filterByLocation('%fooValue%', Criteria::LIKE); // WHERE location LIKE '%fooValue%'
     * $query->filterByLocation(['foo', 'bar']); // WHERE location IN ('foo', 'bar')
     * </code>
     *
     * @param string|string[] $location The value to use as filter.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByLocation($location = null, ?string $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($location)) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(PiecesTableMap::COL_LOCATION, $location, $comparison);

        return $this;
    }

    /**
     * Filter the query on the thumbnail column
     *
     * Example usage:
     * <code>
     * $query->filterByThumbnail('fooValue');   // WHERE thumbnail = 'fooValue'
     * $query->filterByThumbnail('%fooValue%', Criteria::LIKE); // WHERE thumbnail LIKE '%fooValue%'
     * $query->filterByThumbnail(['foo', 'bar']); // WHERE thumbnail IN ('foo', 'bar')
     * </code>
     *
     * @param string|string[] $thumbnail The value to use as filter.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByThumbnail($thumbnail = null, ?string $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($thumbnail)) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(PiecesTableMap::COL_THUMBNAIL, $thumbnail, $comparison);

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
                $this->addUsingAlias(PiecesTableMap::COL_CREATED_AT, $createdAt['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($createdAt['max'])) {
                $this->addUsingAlias(PiecesTableMap::COL_CREATED_AT, $createdAt['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(PiecesTableMap::COL_CREATED_AT, $createdAt, $comparison);

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
                $this->addUsingAlias(PiecesTableMap::COL_UPDATED_AT, $updatedAt['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($updatedAt['max'])) {
                $this->addUsingAlias(PiecesTableMap::COL_UPDATED_AT, $updatedAt['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(PiecesTableMap::COL_UPDATED_AT, $updatedAt, $comparison);

        return $this;
    }

    /**
     * Exclude object from result
     *
     * @param ChildPieces $pieces Object to remove from the list of results
     *
     * @return $this The current query, for fluid interface
     */
    public function prune($pieces = null)
    {
        if ($pieces) {
            $this->addUsingAlias(PiecesTableMap::COL_ID, $pieces->getId(), Criteria::NOT_EQUAL);
        }

        return $this;
    }

    /**
     * Deletes all rows from the pieces table.
     *
     * @param ConnectionInterface $con the connection to use
     * @return int The number of affected rows (if supported by underlying database driver).
     */
    public function doDeleteAll(?ConnectionInterface $con = null): int
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(PiecesTableMap::DATABASE_NAME);
        }

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con) {
            $affectedRows = 0; // initialize var to track total num of affected rows
            $affectedRows += parent::doDeleteAll($con);
            // Because this db requires some delete cascade/set null emulation, we have to
            // clear the cached instance *after* the emulation has happened (since
            // instances get re-added by the select statement contained therein).
            PiecesTableMap::clearInstancePool();
            PiecesTableMap::clearRelatedInstancePool();

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
            $con = Propel::getServiceContainer()->getWriteConnection(PiecesTableMap::DATABASE_NAME);
        }

        $criteria = $this;

        // Set the correct dbName
        $criteria->setDbName(PiecesTableMap::DATABASE_NAME);

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con, $criteria) {
            $affectedRows = 0; // initialize var to track total num of affected rows

            PiecesTableMap::removeInstanceFromPool($criteria);

            $affectedRows += ModelCriteria::delete($con);
            PiecesTableMap::clearRelatedInstancePool();

            return $affectedRows;
        });
    }

}
