<?php

namespace App;

use Illuminate\Support\Facades\DB;

trait DBHelper {

    public static function table_defaults($table) {

        $sql = " SELECT COLUMN_NAME, COLUMN_DEFAULT  
            FROM information_schema.COLUMNS 
            WHERE TABLE_SCHEMA = :db AND TABLE_NAME = :table 
            ORDER BY ORDINAL_POSITION ";

        $columns = DB::select($sql, ['db'=>DB::connection()->getDatabaseName(), 'table' => $table]);

        $defaults = [];
        foreach ($columns as $column) {
            $defaults[$column->COLUMN_NAME] = $column->COLUMN_DEFAULT ? $column->COLUMN_DEFAULT : ''; 
        }
        return $defaults;
    }
    
}