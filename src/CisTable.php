<?php
namespace CisFoundation\CisTableBuilder;

use App\Models\User;
use Illuminate\Database\Eloquent\Collection;
use stdClass;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Reflector;
use Reflection;
use ReflectionClass;
use ReflectionMethod;

class CisTable {

    /**
     * Name of table
     *
     * @var string
     */
    public $name;

    /**
     * True if search is enabled
     *
     * @var boolean
     */
    public $search = false;

    /**
     * Fields who be searched in
     *
     * @var array
     */
    public $searchFields = [];

    /**
     * Pagination
     *
     * @var boolean
     */
    public $pagination = false;

    /**
     * Set the pagination limit per page
     *
     * @var integer
     */
    public $paginationLimit;

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
     * Actions collection
     *
     * @var mixed
     */
    protected $actions;

    /**
     * Custructing the table object instance
     * set name of table
     *
     * @param string $tableName
     * @return CisTable
     */
    public function __construct($tableName)
    {
        $this->name = $tableName;
        $this->actions = collect();
        return $this;
    }

    /**
     * Set the css class of the table
     *
     * @param string $cssClass
     * @return CisTable
     */
    public function setCssClass($cssClass) {
        $this->cssClass = $cssClass;
        return $this;
    }

    /**
     * Set the search option to true and register the search fields
     *
     * @param array $searchFields
     * @return CisTable
     */
    public function withSearch($searchFields = []) {
        $this->search = true;
        $this->searchFields = $searchFields;
        return $this;
    }

    /**
     * Set the search fields
     *
     * @param array $searchFields
     * @return CisTable
     */
    public function setSearchFields($searchFields) {
        $this->searchFields = $searchFields;
        return $this;
    }

    /**
     * Set the css class of the table
     *
     * @param string $cssClass
     * @return CisTable
     */
    public function getCssClass() {
        return ($this->cssClass ? $this->cssClass : "cis-table");
    }

    public function getFields() {
        return $this->fields;
    }

    public function getData() {
        if(is_array($this->data)) {
            return $this->data;
        }
        elseif($this->data instanceof Collection) {
            return $this->data;
        }
        else {
            return $this->searchOption();
        }
    }

    private function searchOption() {
        if($this->search && request()->get("search")) {
            $class = "{$this->data}::where";

            for($i = 0; $i < count($this->searchFields); $i++) {
                if($i == 0) {
                    $classLoop = $class($this->searchFields[$i],'like','%'.request()->get('search').'%');
                }
                else {
                    $classLoop->orWhere($this->searchFields[$i],'like','%'.request()->get('search').'%');
                }
            }
            if($this->pagination) {
                return $classLoop->paginate($this->paginationLimit);
            }
            else {
                return $classLoop->get();
            }
        }
        else {
            $class = "{$this->data}::paginate";
            return $class($this->paginationLimit);
        }
    }

    public function addAction($name,$route,$parameters = null,$method = "get") {
        $action = new CisTableAction();
        $action->setName($name);
        $action->setRoute($route);
        $action->setParameters($parameters);
        $action->setMethod($method);

        $this->actions->add($action);

        return $this;
    }

    public function getActions() {
        return $this->actions;
    }

    /**
     * Set the data for the table
     *
     * @param mixed $data
     * @return CisTable
     */
    public function setData($data) {
        $this->data = $data;
        return $this;
    }

    public function hasPages() {
        return $this->pagination;
    }

    /**
     * Set the fields to display in the table
     *
     * @param array $fields
     * @return CisTable
     */
    public function setFields(array $fields)
    {
        $this->fields = $fields;
        return $this;
    }

    /**
     * Return whether the search function is active
     *
     * @return boolean
     */
    public function isSearchEnabled() {
        return $this->search;
    }

    /**
     * Enable pagination
     *
     * @param integer $paginationLimit
     * @return CisTable
     */
    public function withPagination($paginationLimit = 12) {
        $this->pagination = true;
        $this->paginationLimit = $paginationLimit;
        if($limit = request()->get('perpage')) {
            $this->paginationLimit = $limit;
        }
        return $this;
    }

    public function getPerPage() {
        return $this->paginationLimit;
    }
}
