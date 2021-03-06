<?php



/**
 * This class defines the structure of the 'uc_permission_page_matches' table.
 *
 *
 * This class was autogenerated by Propel 1.7.0 on:
 *
 * 05/02/14 10:56:10
 *
 *
 * This map class is used by Propel to do runtime db structure discovery.
 * For example, the createSelectSql() method checks the type of a given column used in an
 * ORDER BY clause to know whether it needs to apply SQL to make the ORDER BY case-insensitive
 * (i.e. if it's a text column type).
 *
 * @package    propel.generator...map
 */
class UcPermissionPageMatchesTableMap extends TableMap
{

    /**
     * The (dot-path) name of this class
     */
    const CLASS_NAME = '..map.UcPermissionPageMatchesTableMap';

    /**
     * Initialize the table attributes, columns and validators
     * Relations are not initialized by this method since they are lazy loaded
     *
     * @return void
     * @throws PropelException
     */
    public function initialize()
    {
        // attributes
        $this->setName('uc_permission_page_matches');
        $this->setPhpName('UcPermissionPageMatches');
        $this->setClassname('UcPermissionPageMatches');
        $this->setPackage('.');
        $this->setUseIdGenerator(true);
        // columns
        $this->addPrimaryKey('id', 'Id', 'INTEGER', true, null, null);
        $this->addColumn('permission_id', 'PermissionId', 'INTEGER', true, null, null);
        $this->addColumn('page_id', 'PageId', 'INTEGER', true, null, null);
        // validators
    } // initialize()

    /**
     * Build the RelationMap objects for this table relationships
     */
    public function buildRelations()
    {
    } // buildRelations()

} // UcPermissionPageMatchesTableMap
