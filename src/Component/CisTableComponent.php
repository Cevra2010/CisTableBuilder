<?php
namespace CisFoundation\CisTableBuilder\Component;

use CisFoundation\CisTableBuilder\CisTableBuilder;
use Illuminate\Support\Facades\Request;
use Illuminate\Support\Facades\Route;
use Illuminate\View\Component;

class CisTableComponent extends Component {

    /**
     * Name of action
     *
     * @var string
     */
    protected $name;

    /**
     * Css class of table
     *
     * @var string
     */
    public $cssClass;

    /**
     * fields
     *
     * @var array
     */
    public $fields;

    /**
     * Table data
     *
     * @var mixed
     */
    public $tableData;

    /**
     * actions
     *
     * @var array
     */
    public $actions;

    /**
     * pagination
     *
     * @var boolean
     */
    public $pagination;

    /**
     * search
     *
     * @var boolean
     */
    public $search;

    /**
     * search route
     *
     * @var string
     */
    public $searchRoute = null;

    /**
     * limit per page
     *
     * @var integer
     */
    public $perpage;

    /**
     * Undocumented variable
     *
     * @var [type]
     */
    public $resetFilersRoute;


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
        $this->search = $table->isSearchEnabled();
        $this->resetFilersRoute = route(Route::getCurrentRoute()->getName());
        if($table->hasPages()) {
            $this->pagination = true;
            $this->searchRoute = Request::url();
            $this->perpage = $table->getPerPage();
        }

        /** return the view */
        return view("cis-table-builder::table");
    }
}
