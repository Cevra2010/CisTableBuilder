<?php
namespace CisFoundation\CisTableBuilder\Component;

use CisFoundation\CisTableBuilder\CisTableBuilder;
use Illuminate\View\Component;

class CisTableComponent extends Component {


    protected $name;

    /* Register
    *
    * @param string $slug
    */

    public $cssClass;
    public $fields;
    public $tableData;
    public $actions;


    public function __construct($name)
    {
        $this->name = $name;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        /** getting the table */
        $table = CisTableBuilder::get($this->name);

        /** setting vars */
        $this->cssClass = $table->getCssClass();
        $this->fields = $table->getFields();
        $this->tableData = $table->getData();
        $this->actions = $table->getActions();

        /** return the view */
        return view("cis-table-builder::table");
    }
}
