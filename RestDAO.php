<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of RestDAO
 *
 * @author admin
 */
define("RESTDAO_DEF_LANGUAGE", "en_US");

class RestCategory extends Category {

    private static $instance;

    public static function newInstance() {
        if (!self::$instance instanceof self) {
            self::$instance = new self;
        }
        return self::$instance;
    }

    /**
     * Set data related to t_category table
     */
    function __construct() {
        parent::__construct(RESTDAO_DEF_LANGUAGE);
    }

    public function listWhere($where = '', $locale = '') {
        if ($where !== '') {
            $this->dao->where($where);
        }
        if ($locale == '') {
            $locale = RESTDAO_DEF_LANGUAGE;
        }

        $this->dao->select(sprintf("a.*, b.*, c.i_num_items, FIELD(fk_c_locale_code, '%s') as locale_order", $locale));
        $this->dao->from($this->getTableName() . ' as a');
        $this->dao->join(DB_TABLE_PREFIX . 't_category_description as b', 'a.pk_i_id = b.fk_i_category_id', 'INNER');
        $this->dao->join(DB_TABLE_PREFIX . 't_category_stats  as c ', 'a.pk_i_id = c.fk_i_category_id', 'LEFT');
        $this->dao->where("b.s_name != ''");
        $this->dao->orderBy('locale_order', 'DESC');
        $subquery = $this->dao->_getSelect();
        $this->dao->_resetSelect();

        $this->dao->select();
        $this->dao->from(sprintf('(%s) dummytable', $subquery)); // $subselect.'  dummytable');
        $this->dao->groupBy('pk_i_id');
        $this->dao->orderBy('i_position', 'ASC');
        $rs = $this->dao->get();

        if ($rs === false) {
            return array();
        }

        if ($rs->numRows() == 0) {
            return array();
        }

        return $rs->result();
    }

    public function restListEnableGlobal() {
        $this->dao->select("a.*, b.*, c.i_num_items");
        $this->dao->from($this->getTableName() . ' as a');
        $this->dao->join(DB_TABLE_PREFIX . 't_category_description as b', 'a.pk_i_id = b.fk_i_category_id', 'INNER');
        $this->dao->join(DB_TABLE_PREFIX . 't_category_stats  as c ', 'a.pk_i_id = c.fk_i_category_id', 'LEFT');
        $this->dao->where("b.s_name != ''");
        $this->dao->where("a.b_enabled = 1");
        //$this->dao->orderBy('locale_order', 'DESC');
        //$subquery = $this->dao->_getSelect();
        //$this->dao->_resetSelect();
        //$this->dao->orderBy($order);

        $rs = $this->dao->get();

        if ($rs === false) {
            return array();
        }
        return $rs->result();
    }

    public function restListEnabled($locale = '') {
        if ($locale == '') {
            $locale = RESTDAO_DEF_LANGUAGE;
        }

        $this->dao->select(sprintf("a.*, b.*, c.i_num_items, FIELD(fk_c_locale_code, '%s') as locale_order", $locale));
        $this->dao->from($this->getTableName() . ' as a');
        $this->dao->join(DB_TABLE_PREFIX . 't_category_description as b', 'a.pk_i_id = b.fk_i_category_id', 'INNER');
        $this->dao->join(DB_TABLE_PREFIX . 't_category_stats  as c ', 'a.pk_i_id = c.fk_i_category_id', 'LEFT');
        $this->dao->where("b.s_name != ''");
        $this->dao->where("a.b_enabled = 1");
        $this->dao->orderBy('locale_order', 'DESC');
        $subquery = $this->dao->_getSelect();
        $this->dao->_resetSelect();

        $this->dao->select();
        $this->dao->from(sprintf('(%s) dummytable', $subquery)); // $subselect.'  dummytable');
        $this->dao->groupBy('pk_i_id');
        $this->dao->orderBy('i_position', 'ASC');
        $rs = $this->dao->get();

        if ($rs === false) {
            return array();
        }

        if ($rs->numRows() == 0) {
            return array();
        }

        $data = $rs->result();
        return $rs->result();
    }

    public function findByPrimaryKeyGlobal($categoryID = NULL) {
        $this->dao->select("a.*, b.*, c.i_num_items");
        $this->dao->from($this->getTableName() . ' as a');
        $this->dao->join(DB_TABLE_PREFIX . 't_category_description as b', 'a.pk_i_id = b.fk_i_category_id', 'INNER');
        $this->dao->join(DB_TABLE_PREFIX . 't_category_stats  as c ', 'a.pk_i_id = c.fk_i_category_id', 'LEFT');
        $this->dao->where("b.s_name != ''");
        //$this->dao->where("a.b_enabled = 1");
        $this->dao->where(sprintf("a.pk_i_id = %s", $categoryID));

        $rs = $this->dao->get();

        if ($rs === false) {
            return array();
        }
        return $rs->result();
    }

}

class RestItem extends Item {

    private static $instance;

    public static function newInstance() {
        if (!self::$instance instanceof self) {
            self::$instance = new self;
        }
        return self::$instance;
    }

    /**
     * Set data related to t_category table
     */
    function __construct() {
        parent::__construct();
    }

    
}
