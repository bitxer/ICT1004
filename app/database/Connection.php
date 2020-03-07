<?php declare(strict_types=1);

require_once("../app/private/database.php");
    interface DB {
        public function connect();
        public function query($table, $fields, $filter);
        public function insert($table, $fields, $values);
        public function update($table, $values, $filter);
        public function delete($table, $filter);
    }

    class MySQL implements DB {
        /**
         * Connection of database to be used
         */
        protected $conn = null;

        /**
         * Creates connection to be used
         * Connection parameters are defined in `database.php`
         */
        public function connect(): void {
            $this->conn = new PDO(DATABASE_URI, DATABASE_USER, DATABASE_PASS);
            $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
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
         * @return  array[2]    array[0]: where clause;
         *                      array[1]: $filter without condition
         */
        private function filter_builder($filter):array {
            $where = '';
            if (!($filter === '') && is_array($filter)){
                // Build where clause
                $where .= 'WHERE';
                // foreach ($filter as $key=>$value){
                //     $where .= " $key $value[0] :$key and";
                //     $filter[$key] = $value[1];
                // }
                $proc = [];
                array_walk($filter ,function ($value,$key) use (&$where, &$proc)
                {
                    $where .= " $key $value[0] :filter_$key and";
                    $proc[":filter_$key"] = $value[1];
                });
            }
            

            return array(rtrim(rtrim($where, "and"), " "), $proc);
        }
        /**
         * Queries the database based on a set of given values
         * @param   string   $table  Table to query from
         * @param   array   $fields Fields to select from (Accepts array or string).
         *                          If an array is specified, the first value should
         *                          be a unique value.
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
         * @return  array
         */
        public function query($table, $fields='*', $filter='', $filter_types=''): array
        {   
            // Build vanilla select query
            $sql = "SELECT ";
            if ($fields === '*'){
                $sql .= "*";
            } else if (is_array($fields)) {
                $sql .= "'";
                $sql .= implode("', '", array_keys($fields));
                $sql .= "'";
            } else {
                die();
            }

            $sql .= " FROM " . $this->construct($table) . " ";

            $filter = $this->filter_builder($filter);
            $sql .= $filter[0];
            $stmt = $this->conn->prepare($sql);
            $stmt->execute($filter[1]);
            $result = $stmt->fetchAll(PDO::FETCH_UNIQUE);

            // Unset database statments
            unset($stmt);
            unset($sql);
            return $result;
        }

        /**
         * Insert given values into database
         * @param   string  $table  Table to insert to
         * @param   mixed   $fields Fields for which the values should be inserted to
         * @param   mixed   $values Values should be a single dimensional array
         *                          containing the values to be  inserted into the
         *                          fields. Values should correspond to the index of
         *                          the field specified in `$fields`
         * @return  bool
         */
        public function insert($table, $fields, $values): bool{
            $sql = "INSERT INTO " . $this->construct($table) . " (`";
            if (is_array($fields)){
                $sql .= implode("`,`", $fields);
            } else {
                $sql .= "`$fields";
            }
            $sql .= "`) VALUES (". implode(",", array_fill(0, count($fields), '?')) .")";
            $stmt = $this->conn->prepare($sql);
            $result = $stmt->execute($values);

            unset($sql);
            unset($stmt);
            return $result;
        }

        /**
         * Update given values into database
         * @param   string   $table  Table to update the values to
         * @param   array   $values Values should be a single dimensional array
         *                          containing the values to be updated with the
         *                          column as the key.
         *                          Example:
         *                          ```
         *                          [
         *                              'name' => 'John',
         *                              'email' => 'john@example.com'
         *                          ]
         *                          ```
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
         * @return  bool
         */
        public function update($table, $values, $filter): bool {
            $sql = "UPDATE " . $this->construct($table) . " SET ";

            $proc = [];
            array_walk($values, function ($value, $key) use (&$sql, &$proc)
            {
                $sql .= "$key = :$key,";
                $proc[":$key"] = $value;
            });
            $sql = rtrim($sql, ',');

            $filter = $this->filter_builder($filter);
            $sql .= " " . $filter[0];

            $values = array_merge($proc, $filter[1]);
            $stmt = $this->conn->prepare($sql);
            $result = $stmt->execute($values);
            unset($sql);
            unset($stmt);
            return $result;
        }

        /**
         * Delete the rows from database
         * @param   mixed   $table  Table to delete the values from
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
         * @return  bool
         */
        public function delete($table, $filter): bool {
            // DELETE FROM table_name WHERE condition
            $sql = "DELETE FROM " . $this->construct($table) . " ";
            $filter = $this->filter_builder($filter);
            
            $sql .= $filter[0];
            $stmt = $this->conn->prepare($sql);
            $result = $stmt->execute($filter[1]);
            
            unset($sql);
            unset($stmt);
            return $result;
        }
    }
