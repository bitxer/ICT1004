<?php declare(strict_types=1);

require_once("../app/private/database.php");

class Query {

    public function build_connection(): PDO{
        $conn = new PDO(DATABASE_URI, DATABASE_USER, DATABASE_PASS);
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        return $conn;
    }

    /**
     * Function to be used to build table name
     * @return string
     */
    private function construct($table): string {
        return "`" . DATABASE_NAME . "`.`$table`";
    }


    /**
     * @param   array   $filter Filter used in where clause. It should have a key
     *                          with the column name and a value with a array of
     *                          2 values. The first should be the condition and
     *                          the second a value used in the where clause.
     *                          Example:
     *                          ```
     *                          [
     *                              'id'=>['=', 1],
     *                              'title'=>['LIKE', 'this'],
     *                              'views'=>['<', 50],
     *                          ]
     *                          ```
     * @return  string
     */
    private function build_filter($filter): string {
        $where = '';
        if (!($filter == null) && is_array($filter)){
            $where .= 'WHERE';
            array_walk($filter ,function ($value,$key) use (&$where)
            {
                $where .= " $key $value :filter_$key and";
            });
        }


        return rtrim(rtrim($where, "and"), " ");
    }

    public function build_select($table, $fields, $filter): string
    {
        // Build vanilla select query
        $sql = "SELECT ";
        if ($fields === '*'){
            $sql .= "*";
        } else if (is_array($fields)) {
            $sql .= "`";
            $sql .= implode("`, `", $fields);
            $sql .= "`";
        } else {
            die();
        }

        $sql .= " FROM " . $this->construct($table) . " ";

        $sql .= $this->build_filter($filter);

        return rtrim($sql, " ");
    }

    public function build_insert($table, $fields): string {
        $sql = "INSERT INTO " . $this->construct($table) . " (`";
        if (is_array($fields)){
            $sql .= implode("`,`", $fields);
        } else {
            $sql .= "`$fields";
        }
        // $sql .= "`) VALUES (". implode(",", array_fill(0, count($fields), '?')) .")";

        $sql .= "`) VALUES (";
        array_walk($fields ,function ($key) use (&$sql)
        {
            $sql .= ":$key,";
        });

        $sql = rtrim($sql, ',');
        $sql .= ")";
        return $sql;
    }

    public function build_update($table, $values, $filter): string {
        $sql = "UPDATE " . $this->construct($table) . " SET ";

        array_walk($values, function ($key) use (&$sql)
        {
            $sql .= "$key = :$key,";
        });

        $sql = rtrim($sql, ',');

        $sql .= " " . $this->build_filter($filter);

        return $sql;
    }

    public function build_delete($table, $filter): string {
        return "DELETE FROM " . $this->construct($table) . " " . $this->build_filter($filter);
    }

}
?>