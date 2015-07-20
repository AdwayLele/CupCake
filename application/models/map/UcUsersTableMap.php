<?php



/**
 * This class defines the structure of the 'uc_users' table.
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
class UcUsersTableMap extends TableMap
{

    /**
     * The (dot-path) name of this class
     */
    const CLASS_NAME = '..map.UcUsersTableMap';

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
        $this->setName('uc_users');
        $this->setPhpName('UcUsers');
        $this->setClassname('UcUsers');
        $this->setPackage('.');
        $this->setUseIdGenerator(true);
        // columns
        $this->addPrimaryKey('id', 'Id', 'INTEGER', true, null, null);
        $this->addColumn('user_name', 'UserName', 'VARCHAR', true, 50, null);
        $this->addColumn('display_name', 'DisplayName', 'VARCHAR', true, 50, null);
        $this->addColumn('password', 'Password', 'VARCHAR', true, 225, null);
        $this->addColumn('email', 'Email', 'VARCHAR', true, 150, null);
        $this->addColumn('activation_token', 'ActivationToken', 'VARCHAR', true, 225, null);
        $this->addColumn('last_activation_request', 'LastActivationRequest', 'INTEGER', true, null, null);
        $this->addColumn('lost_password_request', 'LostPasswordRequest', 'BOOLEAN', true, 1, null);
        $this->addColumn('active', 'Active', 'BOOLEAN', true, 1, null);
        $this->addColumn('title', 'Title', 'VARCHAR', true, 150, null);
        $this->addColumn('sign_up_stamp', 'SignUpStamp', 'INTEGER', true, null, null);
        $this->addColumn('last_sign_in_stamp', 'LastSignInStamp', 'INTEGER', true, null, null);
        // validators
    } // initialize()

    /**
     * Build the RelationMap objects for this table relationships
     */
    public function buildRelations()
    {
    } // buildRelations()

} // UcUsersTableMap