<?php
namespace CisFoundation\CisTableBuilder;

use CisFoundation\CisTableBuilder\Component\CisTableComponent;
use CisFoundation\CisTableBuilder\Exception\TableNotFoundException;
use Illuminate\Support\Facades\Blade;

class CisTableBuilder {

    protected static $tables;

    /**
     * Generates a new table object by table name
     *
     * @param string $tableName
     * @return CisTable
     */
    public static function table($tableName) {
        if(self::$tables == null) {
            self::$tables = collect();
        }

        $table = new CisTable($tableName);
        self::$tables->add($table);

        return $table;
    }

    /**
     * Return the searched table object instance
     *
     * @param string $tableName
     * @return CisTable
     */
    public static function get($tableName) {
        if($searchedTable = self::$tables->where('name',$tableName)->first()) {
            return $searchedTable;
        }
        else {
            throw new TableNotFoundException('The table "'.$tableName.'" not found.');
        }
    }
}
