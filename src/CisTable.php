<?php
namespace CisFoundation\CisTableBuilder;

class CisTable {

    /**
     * Name of table
     *
     * @var string
     */
    public $name;

    /**
     * Name of css class for table
     *
     * @var string
     */
    protected $cssClass;

    /**
     * Data collection
     *
     * @var
     */
    protected $data;

    /**
     * Visible fields in table
     *
     * @var array
     */
    protected $fields;

    /**
     * Custructing the table object instance
     * set name of table
     *
     * @param string $tableName
     */
    public function __construct($tableName)
    {
        $this->name = $tableName;
    }

    /**
     * Set the css class of the table
     *
     * @param string $cssClass
     * @return void
     */
    public function setCssClass($cssClass) {
        $this->cssClass = $cssClass;
    }

    /**
     * Set the css class of the table
     *
     * @param string $cssClass
     * @return void
     */
    public function getCssClass() {
        return ($this->cssClass ? $this->cssClass : "cis-table");
    }

    public function getFields() {
        return $this->fields;
    }

    public function getData() {
        return $this->data;
    }

    /**
     * Set the data for the table
     *
     * @param mixed $data
     * @return void
     */
    public function setData($data) {
        $this->data = $data;
    }

    /**
     * Set the fields to display in the table
     *
     * @param array $fields
     * @return void
     */
    public function setFields(array $fields)
    {
        $this->fields = $fields;
    }
}
