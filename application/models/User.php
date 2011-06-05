<?php
class User extends Zend_Db_Table_Abstract
{
    /**
    * The default table name
    */
    protected $_name = 'user';

    /**
    * Dependent tables
    */
    protected $_dependentTables = array('Product', 'Order');

    /**
     * findByQtdProduct
     *
     * @param <int> $quantity
     */
    public function findByQtdProduct($quantity)
    {
        $select = $this->select()
                       ->setIntegrityCheck(false)
                       ->from('user')
                       ->joinInner('product', 'user.user_id = product.user_id',
                               array('product_per_user'=>'COUNT(*)'))
                       ->group('user.user_id')
                       ->having('product_per_user >= ?', $quantity);

        return $this->fetchAll($select);
    }
}