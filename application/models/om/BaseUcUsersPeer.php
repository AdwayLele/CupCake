<?php


/**
 * Base static class for performing query and update operations on the 'uc_users' table.
 *
 *
 *
 * This class was autogenerated by Propel 1.7.0 on:
 *
 * 05/02/14 10:56:10
 *
 * @package propel.generator...om
 */
abstract class BaseUcUsersPeer
{

    /** the default database name for this class */
    const DATABASE_NAME = 'cpu';

    /** the table name for this class */
    const TABLE_NAME = 'uc_users';

    /** the related Propel class for this table */
    const OM_CLASS = 'UcUsers';

    /** the related TableMap class for this table */
    const TM_CLASS = 'UcUsersTableMap';

    /** The total number of columns. */
    const NUM_COLUMNS = 12;

    /** The number of lazy-loaded columns. */
    const NUM_LAZY_LOAD_COLUMNS = 0;

    /** The number of columns to hydrate (NUM_COLUMNS - NUM_LAZY_LOAD_COLUMNS) */
    const NUM_HYDRATE_COLUMNS = 12;

    /** the column name for the id field */
    const ID = 'uc_users.id';

    /** the column name for the user_name field */
    const USER_NAME = 'uc_users.user_name';

    /** the column name for the display_name field */
    const DISPLAY_NAME = 'uc_users.display_name';

    /** the column name for the password field */
    const PASSWORD = 'uc_users.password';

    /** the column name for the email field */
    const EMAIL = 'uc_users.email';

    /** the column name for the activation_token field */
    const ACTIVATION_TOKEN = 'uc_users.activation_token';

    /** the column name for the last_activation_request field */
    const LAST_ACTIVATION_REQUEST = 'uc_users.last_activation_request';

    /** the column name for the lost_password_request field */
    const LOST_PASSWORD_REQUEST = 'uc_users.lost_password_request';

    /** the column name for the active field */
    const ACTIVE = 'uc_users.active';

    /** the column name for the title field */
    const TITLE = 'uc_users.title';

    /** the column name for the sign_up_stamp field */
    const SIGN_UP_STAMP = 'uc_users.sign_up_stamp';

    /** the column name for the last_sign_in_stamp field */
    const LAST_SIGN_IN_STAMP = 'uc_users.last_sign_in_stamp';

    /** The default string format for model objects of the related table **/
    const DEFAULT_STRING_FORMAT = 'YAML';

    /**
     * An identity map to hold any loaded instances of UcUsers objects.
     * This must be public so that other peer classes can access this when hydrating from JOIN
     * queries.
     * @var        array UcUsers[]
     */
    public static $instances = array();


    /**
     * holds an array of fieldnames
     *
     * first dimension keys are the type constants
     * e.g. UcUsersPeer::$fieldNames[UcUsersPeer::TYPE_PHPNAME][0] = 'Id'
     */
    protected static $fieldNames = array (
        BasePeer::TYPE_PHPNAME => array ('Id', 'UserName', 'DisplayName', 'Password', 'Email', 'ActivationToken', 'LastActivationRequest', 'LostPasswordRequest', 'Active', 'Title', 'SignUpStamp', 'LastSignInStamp', ),
        BasePeer::TYPE_STUDLYPHPNAME => array ('id', 'userName', 'displayName', 'password', 'email', 'activationToken', 'lastActivationRequest', 'lostPasswordRequest', 'active', 'title', 'signUpStamp', 'lastSignInStamp', ),
        BasePeer::TYPE_COLNAME => array (UcUsersPeer::ID, UcUsersPeer::USER_NAME, UcUsersPeer::DISPLAY_NAME, UcUsersPeer::PASSWORD, UcUsersPeer::EMAIL, UcUsersPeer::ACTIVATION_TOKEN, UcUsersPeer::LAST_ACTIVATION_REQUEST, UcUsersPeer::LOST_PASSWORD_REQUEST, UcUsersPeer::ACTIVE, UcUsersPeer::TITLE, UcUsersPeer::SIGN_UP_STAMP, UcUsersPeer::LAST_SIGN_IN_STAMP, ),
        BasePeer::TYPE_RAW_COLNAME => array ('ID', 'USER_NAME', 'DISPLAY_NAME', 'PASSWORD', 'EMAIL', 'ACTIVATION_TOKEN', 'LAST_ACTIVATION_REQUEST', 'LOST_PASSWORD_REQUEST', 'ACTIVE', 'TITLE', 'SIGN_UP_STAMP', 'LAST_SIGN_IN_STAMP', ),
        BasePeer::TYPE_FIELDNAME => array ('id', 'user_name', 'display_name', 'password', 'email', 'activation_token', 'last_activation_request', 'lost_password_request', 'active', 'title', 'sign_up_stamp', 'last_sign_in_stamp', ),
        BasePeer::TYPE_NUM => array (0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, )
    );

    /**
     * holds an array of keys for quick access to the fieldnames array
     *
     * first dimension keys are the type constants
     * e.g. UcUsersPeer::$fieldNames[BasePeer::TYPE_PHPNAME]['Id'] = 0
     */
    protected static $fieldKeys = array (
        BasePeer::TYPE_PHPNAME => array ('Id' => 0, 'UserName' => 1, 'DisplayName' => 2, 'Password' => 3, 'Email' => 4, 'ActivationToken' => 5, 'LastActivationRequest' => 6, 'LostPasswordRequest' => 7, 'Active' => 8, 'Title' => 9, 'SignUpStamp' => 10, 'LastSignInStamp' => 11, ),
        BasePeer::TYPE_STUDLYPHPNAME => array ('id' => 0, 'userName' => 1, 'displayName' => 2, 'password' => 3, 'email' => 4, 'activationToken' => 5, 'lastActivationRequest' => 6, 'lostPasswordRequest' => 7, 'active' => 8, 'title' => 9, 'signUpStamp' => 10, 'lastSignInStamp' => 11, ),
        BasePeer::TYPE_COLNAME => array (UcUsersPeer::ID => 0, UcUsersPeer::USER_NAME => 1, UcUsersPeer::DISPLAY_NAME => 2, UcUsersPeer::PASSWORD => 3, UcUsersPeer::EMAIL => 4, UcUsersPeer::ACTIVATION_TOKEN => 5, UcUsersPeer::LAST_ACTIVATION_REQUEST => 6, UcUsersPeer::LOST_PASSWORD_REQUEST => 7, UcUsersPeer::ACTIVE => 8, UcUsersPeer::TITLE => 9, UcUsersPeer::SIGN_UP_STAMP => 10, UcUsersPeer::LAST_SIGN_IN_STAMP => 11, ),
        BasePeer::TYPE_RAW_COLNAME => array ('ID' => 0, 'USER_NAME' => 1, 'DISPLAY_NAME' => 2, 'PASSWORD' => 3, 'EMAIL' => 4, 'ACTIVATION_TOKEN' => 5, 'LAST_ACTIVATION_REQUEST' => 6, 'LOST_PASSWORD_REQUEST' => 7, 'ACTIVE' => 8, 'TITLE' => 9, 'SIGN_UP_STAMP' => 10, 'LAST_SIGN_IN_STAMP' => 11, ),
        BasePeer::TYPE_FIELDNAME => array ('id' => 0, 'user_name' => 1, 'display_name' => 2, 'password' => 3, 'email' => 4, 'activation_token' => 5, 'last_activation_request' => 6, 'lost_password_request' => 7, 'active' => 8, 'title' => 9, 'sign_up_stamp' => 10, 'last_sign_in_stamp' => 11, ),
        BasePeer::TYPE_NUM => array (0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, )
    );

    /**
     * Translates a fieldname to another type
     *
     * @param      string $name field name
     * @param      string $fromType One of the class type constants BasePeer::TYPE_PHPNAME, BasePeer::TYPE_STUDLYPHPNAME
     *                         BasePeer::TYPE_COLNAME, BasePeer::TYPE_FIELDNAME, BasePeer::TYPE_NUM
     * @param      string $toType   One of the class type constants
     * @return string          translated name of the field.
     * @throws PropelException - if the specified name could not be found in the fieldname mappings.
     */
    public static function translateFieldName($name, $fromType, $toType)
    {
        $toNames = UcUsersPeer::getFieldNames($toType);
        $key = isset(UcUsersPeer::$fieldKeys[$fromType][$name]) ? UcUsersPeer::$fieldKeys[$fromType][$name] : null;
        if ($key === null) {
            throw new PropelException("'$name' could not be found in the field names of type '$fromType'. These are: " . print_r(UcUsersPeer::$fieldKeys[$fromType], true));
        }

        return $toNames[$key];
    }

    /**
     * Returns an array of field names.
     *
     * @param      string $type The type of fieldnames to return:
     *                      One of the class type constants BasePeer::TYPE_PHPNAME, BasePeer::TYPE_STUDLYPHPNAME
     *                      BasePeer::TYPE_COLNAME, BasePeer::TYPE_FIELDNAME, BasePeer::TYPE_NUM
     * @return array           A list of field names
     * @throws PropelException - if the type is not valid.
     */
    public static function getFieldNames($type = BasePeer::TYPE_PHPNAME)
    {
        if (!array_key_exists($type, UcUsersPeer::$fieldNames)) {
            throw new PropelException('Method getFieldNames() expects the parameter $type to be one of the class constants BasePeer::TYPE_PHPNAME, BasePeer::TYPE_STUDLYPHPNAME, BasePeer::TYPE_COLNAME, BasePeer::TYPE_FIELDNAME, BasePeer::TYPE_NUM. ' . $type . ' was given.');
        }

        return UcUsersPeer::$fieldNames[$type];
    }

    /**
     * Convenience method which changes table.column to alias.column.
     *
     * Using this method you can maintain SQL abstraction while using column aliases.
     * <code>
     *		$c->addAlias("alias1", TablePeer::TABLE_NAME);
     *		$c->addJoin(TablePeer::alias("alias1", TablePeer::PRIMARY_KEY_COLUMN), TablePeer::PRIMARY_KEY_COLUMN);
     * </code>
     * @param      string $alias The alias for the current table.
     * @param      string $column The column name for current table. (i.e. UcUsersPeer::COLUMN_NAME).
     * @return string
     */
    public static function alias($alias, $column)
    {
        return str_replace(UcUsersPeer::TABLE_NAME.'.', $alias.'.', $column);
    }

    /**
     * Add all the columns needed to create a new object.
     *
     * Note: any columns that were marked with lazyLoad="true" in the
     * XML schema will not be added to the select list and only loaded
     * on demand.
     *
     * @param      Criteria $criteria object containing the columns to add.
     * @param      string   $alias    optional table alias
     * @throws PropelException Any exceptions caught during processing will be
     *		 rethrown wrapped into a PropelException.
     */
    public static function addSelectColumns(Criteria $criteria, $alias = null)
    {
        if (null === $alias) {
            $criteria->addSelectColumn(UcUsersPeer::ID);
            $criteria->addSelectColumn(UcUsersPeer::USER_NAME);
            $criteria->addSelectColumn(UcUsersPeer::DISPLAY_NAME);
            $criteria->addSelectColumn(UcUsersPeer::PASSWORD);
            $criteria->addSelectColumn(UcUsersPeer::EMAIL);
            $criteria->addSelectColumn(UcUsersPeer::ACTIVATION_TOKEN);
            $criteria->addSelectColumn(UcUsersPeer::LAST_ACTIVATION_REQUEST);
            $criteria->addSelectColumn(UcUsersPeer::LOST_PASSWORD_REQUEST);
            $criteria->addSelectColumn(UcUsersPeer::ACTIVE);
            $criteria->addSelectColumn(UcUsersPeer::TITLE);
            $criteria->addSelectColumn(UcUsersPeer::SIGN_UP_STAMP);
            $criteria->addSelectColumn(UcUsersPeer::LAST_SIGN_IN_STAMP);
        } else {
            $criteria->addSelectColumn($alias . '.id');
            $criteria->addSelectColumn($alias . '.user_name');
            $criteria->addSelectColumn($alias . '.display_name');
            $criteria->addSelectColumn($alias . '.password');
            $criteria->addSelectColumn($alias . '.email');
            $criteria->addSelectColumn($alias . '.activation_token');
            $criteria->addSelectColumn($alias . '.last_activation_request');
            $criteria->addSelectColumn($alias . '.lost_password_request');
            $criteria->addSelectColumn($alias . '.active');
            $criteria->addSelectColumn($alias . '.title');
            $criteria->addSelectColumn($alias . '.sign_up_stamp');
            $criteria->addSelectColumn($alias . '.last_sign_in_stamp');
        }
    }

    /**
     * Returns the number of rows matching criteria.
     *
     * @param      Criteria $criteria
     * @param      boolean $distinct Whether to select only distinct columns; deprecated: use Criteria->setDistinct() instead.
     * @param      PropelPDO $con
     * @return int Number of matching rows.
     */
    public static function doCount(Criteria $criteria, $distinct = false, PropelPDO $con = null)
    {
        // we may modify criteria, so copy it first
        $criteria = clone $criteria;

        // We need to set the primary table name, since in the case that there are no WHERE columns
        // it will be impossible for the BasePeer::createSelectSql() method to determine which
        // tables go into the FROM clause.
        $criteria->setPrimaryTableName(UcUsersPeer::TABLE_NAME);

        if ($distinct && !in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
            $criteria->setDistinct();
        }

        if (!$criteria->hasSelectClause()) {
            UcUsersPeer::addSelectColumns($criteria);
        }

        $criteria->clearOrderByColumns(); // ORDER BY won't ever affect the count
        $criteria->setDbName(UcUsersPeer::DATABASE_NAME); // Set the correct dbName

        if ($con === null) {
            $con = Propel::getConnection(UcUsersPeer::DATABASE_NAME, Propel::CONNECTION_READ);
        }
        // BasePeer returns a PDOStatement
        $stmt = BasePeer::doCount($criteria, $con);

        if ($row = $stmt->fetch(PDO::FETCH_NUM)) {
            $count = (int) $row[0];
        } else {
            $count = 0; // no rows returned; we infer that means 0 matches.
        }
        $stmt->closeCursor();

        return $count;
    }
    /**
     * Selects one object from the DB.
     *
     * @param      Criteria $criteria object used to create the SELECT statement.
     * @param      PropelPDO $con
     * @return UcUsers
     * @throws PropelException Any exceptions caught during processing will be
     *		 rethrown wrapped into a PropelException.
     */
    public static function doSelectOne(Criteria $criteria, PropelPDO $con = null)
    {
        $critcopy = clone $criteria;
        $critcopy->setLimit(1);
        $objects = UcUsersPeer::doSelect($critcopy, $con);
        if ($objects) {
            return $objects[0];
        }

        return null;
    }
    /**
     * Selects several row from the DB.
     *
     * @param      Criteria $criteria The Criteria object used to build the SELECT statement.
     * @param      PropelPDO $con
     * @return array           Array of selected Objects
     * @throws PropelException Any exceptions caught during processing will be
     *		 rethrown wrapped into a PropelException.
     */
    public static function doSelect(Criteria $criteria, PropelPDO $con = null)
    {
        return UcUsersPeer::populateObjects(UcUsersPeer::doSelectStmt($criteria, $con));
    }
    /**
     * Prepares the Criteria object and uses the parent doSelect() method to execute a PDOStatement.
     *
     * Use this method directly if you want to work with an executed statement directly (for example
     * to perform your own object hydration).
     *
     * @param      Criteria $criteria The Criteria object used to build the SELECT statement.
     * @param      PropelPDO $con The connection to use
     * @throws PropelException Any exceptions caught during processing will be
     *		 rethrown wrapped into a PropelException.
     * @return PDOStatement The executed PDOStatement object.
     * @see        BasePeer::doSelect()
     */
    public static function doSelectStmt(Criteria $criteria, PropelPDO $con = null)
    {
        if ($con === null) {
            $con = Propel::getConnection(UcUsersPeer::DATABASE_NAME, Propel::CONNECTION_READ);
        }

        if (!$criteria->hasSelectClause()) {
            $criteria = clone $criteria;
            UcUsersPeer::addSelectColumns($criteria);
        }

        // Set the correct dbName
        $criteria->setDbName(UcUsersPeer::DATABASE_NAME);

        // BasePeer returns a PDOStatement
        return BasePeer::doSelect($criteria, $con);
    }
    /**
     * Adds an object to the instance pool.
     *
     * Propel keeps cached copies of objects in an instance pool when they are retrieved
     * from the database.  In some cases -- especially when you override doSelect*()
     * methods in your stub classes -- you may need to explicitly add objects
     * to the cache in order to ensure that the same objects are always returned by doSelect*()
     * and retrieveByPK*() calls.
     *
     * @param UcUsers $obj A UcUsers object.
     * @param      string $key (optional) key to use for instance map (for performance boost if key was already calculated externally).
     */
    public static function addInstanceToPool($obj, $key = null)
    {
        if (Propel::isInstancePoolingEnabled()) {
            if ($key === null) {
                $key = (string) $obj->getId();
            } // if key === null
            UcUsersPeer::$instances[$key] = $obj;
        }
    }

    /**
     * Removes an object from the instance pool.
     *
     * Propel keeps cached copies of objects in an instance pool when they are retrieved
     * from the database.  In some cases -- especially when you override doDelete
     * methods in your stub classes -- you may need to explicitly remove objects
     * from the cache in order to prevent returning objects that no longer exist.
     *
     * @param      mixed $value A UcUsers object or a primary key value.
     *
     * @return void
     * @throws PropelException - if the value is invalid.
     */
    public static function removeInstanceFromPool($value)
    {
        if (Propel::isInstancePoolingEnabled() && $value !== null) {
            if (is_object($value) && $value instanceof UcUsers) {
                $key = (string) $value->getId();
            } elseif (is_scalar($value)) {
                // assume we've been passed a primary key
                $key = (string) $value;
            } else {
                $e = new PropelException("Invalid value passed to removeInstanceFromPool().  Expected primary key or UcUsers object; got " . (is_object($value) ? get_class($value) . ' object.' : var_export($value,true)));
                throw $e;
            }

            unset(UcUsersPeer::$instances[$key]);
        }
    } // removeInstanceFromPool()

    /**
     * Retrieves a string version of the primary key from the DB resultset row that can be used to uniquely identify a row in this table.
     *
     * For tables with a single-column primary key, that simple pkey value will be returned.  For tables with
     * a multi-column primary key, a serialize()d version of the primary key will be returned.
     *
     * @param      string $key The key (@see getPrimaryKeyHash()) for this instance.
     * @return UcUsers Found object or null if 1) no instance exists for specified key or 2) instance pooling has been disabled.
     * @see        getPrimaryKeyHash()
     */
    public static function getInstanceFromPool($key)
    {
        if (Propel::isInstancePoolingEnabled()) {
            if (isset(UcUsersPeer::$instances[$key])) {
                return UcUsersPeer::$instances[$key];
            }
        }

        return null; // just to be explicit
    }

    /**
     * Clear the instance pool.
     *
     * @return void
     */
    public static function clearInstancePool($and_clear_all_references = false)
    {
      if ($and_clear_all_references) {
        foreach (UcUsersPeer::$instances as $instance) {
          $instance->clearAllReferences(true);
        }
      }
        UcUsersPeer::$instances = array();
    }

    /**
     * Method to invalidate the instance pool of all tables related to uc_users
     * by a foreign key with ON DELETE CASCADE
     */
    public static function clearRelatedInstancePool()
    {
    }

    /**
     * Retrieves a string version of the primary key from the DB resultset row that can be used to uniquely identify a row in this table.
     *
     * For tables with a single-column primary key, that simple pkey value will be returned.  For tables with
     * a multi-column primary key, a serialize()d version of the primary key will be returned.
     *
     * @param      array $row PropelPDO resultset row.
     * @param      int $startcol The 0-based offset for reading from the resultset row.
     * @return string A string version of PK or null if the components of primary key in result array are all null.
     */
    public static function getPrimaryKeyHashFromRow($row, $startcol = 0)
    {
        // If the PK cannot be derived from the row, return null.
        if ($row[$startcol] === null) {
            return null;
        }

        return (string) $row[$startcol];
    }

    /**
     * Retrieves the primary key from the DB resultset row
     * For tables with a single-column primary key, that simple pkey value will be returned.  For tables with
     * a multi-column primary key, an array of the primary key columns will be returned.
     *
     * @param      array $row PropelPDO resultset row.
     * @param      int $startcol The 0-based offset for reading from the resultset row.
     * @return mixed The primary key of the row
     */
    public static function getPrimaryKeyFromRow($row, $startcol = 0)
    {

        return (int) $row[$startcol];
    }

    /**
     * The returned array will contain objects of the default type or
     * objects that inherit from the default.
     *
     * @throws PropelException Any exceptions caught during processing will be
     *		 rethrown wrapped into a PropelException.
     */
    public static function populateObjects(PDOStatement $stmt)
    {
        $results = array();

        // set the class once to avoid overhead in the loop
        $cls = UcUsersPeer::getOMClass();
        // populate the object(s)
        while ($row = $stmt->fetch(PDO::FETCH_NUM)) {
            $key = UcUsersPeer::getPrimaryKeyHashFromRow($row, 0);
            if (null !== ($obj = UcUsersPeer::getInstanceFromPool($key))) {
                // We no longer rehydrate the object, since this can cause data loss.
                // See http://www.propelorm.org/ticket/509
                // $obj->hydrate($row, 0, true); // rehydrate
                $results[] = $obj;
            } else {
                $obj = new $cls();
                $obj->hydrate($row);
                $results[] = $obj;
                UcUsersPeer::addInstanceToPool($obj, $key);
            } // if key exists
        }
        $stmt->closeCursor();

        return $results;
    }
    /**
     * Populates an object of the default type or an object that inherit from the default.
     *
     * @param      array $row PropelPDO resultset row.
     * @param      int $startcol The 0-based offset for reading from the resultset row.
     * @throws PropelException Any exceptions caught during processing will be
     *		 rethrown wrapped into a PropelException.
     * @return array (UcUsers object, last column rank)
     */
    public static function populateObject($row, $startcol = 0)
    {
        $key = UcUsersPeer::getPrimaryKeyHashFromRow($row, $startcol);
        if (null !== ($obj = UcUsersPeer::getInstanceFromPool($key))) {
            // We no longer rehydrate the object, since this can cause data loss.
            // See http://www.propelorm.org/ticket/509
            // $obj->hydrate($row, $startcol, true); // rehydrate
            $col = $startcol + UcUsersPeer::NUM_HYDRATE_COLUMNS;
        } else {
            $cls = UcUsersPeer::OM_CLASS;
            $obj = new $cls();
            $col = $obj->hydrate($row, $startcol);
            UcUsersPeer::addInstanceToPool($obj, $key);
        }

        return array($obj, $col);
    }

    /**
     * Returns the TableMap related to this peer.
     * This method is not needed for general use but a specific application could have a need.
     * @return TableMap
     * @throws PropelException Any exceptions caught during processing will be
     *		 rethrown wrapped into a PropelException.
     */
    public static function getTableMap()
    {
        return Propel::getDatabaseMap(UcUsersPeer::DATABASE_NAME)->getTable(UcUsersPeer::TABLE_NAME);
    }

    /**
     * Add a TableMap instance to the database for this peer class.
     */
    public static function buildTableMap()
    {
      $dbMap = Propel::getDatabaseMap(BaseUcUsersPeer::DATABASE_NAME);
      if (!$dbMap->hasTable(BaseUcUsersPeer::TABLE_NAME)) {
        $dbMap->addTableObject(new \UcUsersTableMap());
      }
    }

    /**
     * The class that the Peer will make instances of.
     *
     *
     * @return string ClassName
     */
    public static function getOMClass($row = 0, $colnum = 0)
    {
        return UcUsersPeer::OM_CLASS;
    }

    /**
     * Performs an INSERT on the database, given a UcUsers or Criteria object.
     *
     * @param      mixed $values Criteria or UcUsers object containing data that is used to create the INSERT statement.
     * @param      PropelPDO $con the PropelPDO connection to use
     * @return mixed           The new primary key.
     * @throws PropelException Any exceptions caught during processing will be
     *		 rethrown wrapped into a PropelException.
     */
    public static function doInsert($values, PropelPDO $con = null)
    {
        if ($con === null) {
            $con = Propel::getConnection(UcUsersPeer::DATABASE_NAME, Propel::CONNECTION_WRITE);
        }

        if ($values instanceof Criteria) {
            $criteria = clone $values; // rename for clarity
        } else {
            $criteria = $values->buildCriteria(); // build Criteria from UcUsers object
        }

        if ($criteria->containsKey(UcUsersPeer::ID) && $criteria->keyContainsValue(UcUsersPeer::ID) ) {
            throw new PropelException('Cannot insert a value for auto-increment primary key ('.UcUsersPeer::ID.')');
        }


        // Set the correct dbName
        $criteria->setDbName(UcUsersPeer::DATABASE_NAME);

        try {
            // use transaction because $criteria could contain info
            // for more than one table (I guess, conceivably)
            $con->beginTransaction();
            $pk = BasePeer::doInsert($criteria, $con);
            $con->commit();
        } catch (Exception $e) {
            $con->rollBack();
            throw $e;
        }

        return $pk;
    }

    /**
     * Performs an UPDATE on the database, given a UcUsers or Criteria object.
     *
     * @param      mixed $values Criteria or UcUsers object containing data that is used to create the UPDATE statement.
     * @param      PropelPDO $con The connection to use (specify PropelPDO connection object to exert more control over transactions).
     * @return int             The number of affected rows (if supported by underlying database driver).
     * @throws PropelException Any exceptions caught during processing will be
     *		 rethrown wrapped into a PropelException.
     */
    public static function doUpdate($values, PropelPDO $con = null)
    {
        if ($con === null) {
            $con = Propel::getConnection(UcUsersPeer::DATABASE_NAME, Propel::CONNECTION_WRITE);
        }

        $selectCriteria = new Criteria(UcUsersPeer::DATABASE_NAME);

        if ($values instanceof Criteria) {
            $criteria = clone $values; // rename for clarity

            $comparison = $criteria->getComparison(UcUsersPeer::ID);
            $value = $criteria->remove(UcUsersPeer::ID);
            if ($value) {
                $selectCriteria->add(UcUsersPeer::ID, $value, $comparison);
            } else {
                $selectCriteria->setPrimaryTableName(UcUsersPeer::TABLE_NAME);
            }

        } else { // $values is UcUsers object
            $criteria = $values->buildCriteria(); // gets full criteria
            $selectCriteria = $values->buildPkeyCriteria(); // gets criteria w/ primary key(s)
        }

        // set the correct dbName
        $criteria->setDbName(UcUsersPeer::DATABASE_NAME);

        return BasePeer::doUpdate($selectCriteria, $criteria, $con);
    }

    /**
     * Deletes all rows from the uc_users table.
     *
     * @param      PropelPDO $con the connection to use
     * @return int             The number of affected rows (if supported by underlying database driver).
     * @throws PropelException
     */
    public static function doDeleteAll(PropelPDO $con = null)
    {
        if ($con === null) {
            $con = Propel::getConnection(UcUsersPeer::DATABASE_NAME, Propel::CONNECTION_WRITE);
        }
        $affectedRows = 0; // initialize var to track total num of affected rows
        try {
            // use transaction because $criteria could contain info
            // for more than one table or we could emulating ON DELETE CASCADE, etc.
            $con->beginTransaction();
            $affectedRows += BasePeer::doDeleteAll(UcUsersPeer::TABLE_NAME, $con, UcUsersPeer::DATABASE_NAME);
            // Because this db requires some delete cascade/set null emulation, we have to
            // clear the cached instance *after* the emulation has happened (since
            // instances get re-added by the select statement contained therein).
            UcUsersPeer::clearInstancePool();
            UcUsersPeer::clearRelatedInstancePool();
            $con->commit();

            return $affectedRows;
        } catch (Exception $e) {
            $con->rollBack();
            throw $e;
        }
    }

    /**
     * Performs a DELETE on the database, given a UcUsers or Criteria object OR a primary key value.
     *
     * @param      mixed $values Criteria or UcUsers object or primary key or array of primary keys
     *              which is used to create the DELETE statement
     * @param      PropelPDO $con the connection to use
     * @return int The number of affected rows (if supported by underlying database driver).  This includes CASCADE-related rows
     *				if supported by native driver or if emulated using Propel.
     * @throws PropelException Any exceptions caught during processing will be
     *		 rethrown wrapped into a PropelException.
     */
     public static function doDelete($values, PropelPDO $con = null)
     {
        if ($con === null) {
            $con = Propel::getConnection(UcUsersPeer::DATABASE_NAME, Propel::CONNECTION_WRITE);
        }

        if ($values instanceof Criteria) {
            // invalidate the cache for all objects of this type, since we have no
            // way of knowing (without running a query) what objects should be invalidated
            // from the cache based on this Criteria.
            UcUsersPeer::clearInstancePool();
            // rename for clarity
            $criteria = clone $values;
        } elseif ($values instanceof UcUsers) { // it's a model object
            // invalidate the cache for this single object
            UcUsersPeer::removeInstanceFromPool($values);
            // create criteria based on pk values
            $criteria = $values->buildPkeyCriteria();
        } else { // it's a primary key, or an array of pks
            $criteria = new Criteria(UcUsersPeer::DATABASE_NAME);
            $criteria->add(UcUsersPeer::ID, (array) $values, Criteria::IN);
            // invalidate the cache for this object(s)
            foreach ((array) $values as $singleval) {
                UcUsersPeer::removeInstanceFromPool($singleval);
            }
        }

        // Set the correct dbName
        $criteria->setDbName(UcUsersPeer::DATABASE_NAME);

        $affectedRows = 0; // initialize var to track total num of affected rows

        try {
            // use transaction because $criteria could contain info
            // for more than one table or we could emulating ON DELETE CASCADE, etc.
            $con->beginTransaction();

            $affectedRows += BasePeer::doDelete($criteria, $con);
            UcUsersPeer::clearRelatedInstancePool();
            $con->commit();

            return $affectedRows;
        } catch (Exception $e) {
            $con->rollBack();
            throw $e;
        }
    }

    /**
     * Validates all modified columns of given UcUsers object.
     * If parameter $columns is either a single column name or an array of column names
     * than only those columns are validated.
     *
     * NOTICE: This does not apply to primary or foreign keys for now.
     *
     * @param UcUsers $obj The object to validate.
     * @param      mixed $cols Column name or array of column names.
     *
     * @return mixed TRUE if all columns are valid or the error message of the first invalid column.
     */
    public static function doValidate($obj, $cols = null)
    {
        $columns = array();

        if ($cols) {
            $dbMap = Propel::getDatabaseMap(UcUsersPeer::DATABASE_NAME);
            $tableMap = $dbMap->getTable(UcUsersPeer::TABLE_NAME);

            if (! is_array($cols)) {
                $cols = array($cols);
            }

            foreach ($cols as $colName) {
                if ($tableMap->hasColumn($colName)) {
                    $get = 'get' . $tableMap->getColumn($colName)->getPhpName();
                    $columns[$colName] = $obj->$get();
                }
            }
        } else {

        }

        return BasePeer::doValidate(UcUsersPeer::DATABASE_NAME, UcUsersPeer::TABLE_NAME, $columns);
    }

    /**
     * Retrieve a single object by pkey.
     *
     * @param int $pk the primary key.
     * @param      PropelPDO $con the connection to use
     * @return UcUsers
     */
    public static function retrieveByPK($pk, PropelPDO $con = null)
    {

        if (null !== ($obj = UcUsersPeer::getInstanceFromPool((string) $pk))) {
            return $obj;
        }

        if ($con === null) {
            $con = Propel::getConnection(UcUsersPeer::DATABASE_NAME, Propel::CONNECTION_READ);
        }

        $criteria = new Criteria(UcUsersPeer::DATABASE_NAME);
        $criteria->add(UcUsersPeer::ID, $pk);

        $v = UcUsersPeer::doSelect($criteria, $con);

        return !empty($v) > 0 ? $v[0] : null;
    }

    /**
     * Retrieve multiple objects by pkey.
     *
     * @param      array $pks List of primary keys
     * @param      PropelPDO $con the connection to use
     * @return UcUsers[]
     * @throws PropelException Any exceptions caught during processing will be
     *		 rethrown wrapped into a PropelException.
     */
    public static function retrieveByPKs($pks, PropelPDO $con = null)
    {
        if ($con === null) {
            $con = Propel::getConnection(UcUsersPeer::DATABASE_NAME, Propel::CONNECTION_READ);
        }

        $objs = null;
        if (empty($pks)) {
            $objs = array();
        } else {
            $criteria = new Criteria(UcUsersPeer::DATABASE_NAME);
            $criteria->add(UcUsersPeer::ID, $pks, Criteria::IN);
            $objs = UcUsersPeer::doSelect($criteria, $con);
        }

        return $objs;
    }

} // BaseUcUsersPeer

// This is the static code needed to register the TableMap for this table with the main Propel class.
//
BaseUcUsersPeer::buildTableMap();
