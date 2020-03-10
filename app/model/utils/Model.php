<?php declare(strict_types=1);
require_once("../app/model/utils/Query.php");
class Model {
    /**
     * Placeholder for known fields to be updated
     */
    const fields = [];
    /**
     * Placeholder for tablename
     */
    const tablename = null;

    /**
     * Get value of field
     * @param   string  field   Field to get value for
     * @return  string  value of field
     */
    public function getValue($field=''): Field {
        return $field != null ? $this->{$field} : '';
    }

    /**
     * Set value for field
     * @param   string  field   Field to set value for
     * @param   string  value   Value to be set to field
     * @return  int     1 if succesful and 0 if unsuccessful
     */
    public function setValue($field, $value): int {
        if (in_array($field, static::fields, TRUE)){
            $this->{$field}->setValue($value);
            return 1;
        }
        return 0;
    }

    public function add(){
        $query = new Query();
        $fields = static::fields;
        $stmt = $query->build_insert(static::tablename, $fields);
        $conn = $query->build_connection();
        $stmt = $conn->prepare($stmt);

        array_walk($fields, function($value) use ($stmt){
            $field = $this->{$value};
            $fvalue = $field->getValue();
            $ftype = $field->getType();
            $stmt->bindParam(":$value", $fvalue, $ftype);
        });
        return $stmt->execute();
    }

    public function delete(){
        if ($this->id->getValue() != null){
            $query = new Query();
            $id = $this->id->getName();
            $stmt = $query->build_delete(static::tablename, [$id=>"="]);
            $conn = $query->build_connection();
            $stmt = $conn->prepare($stmt);
            $idtype = $this->id->getType();
            $idval = $this->id->getValue();
            $stmt->bindParam(":filter_$id", $idval, $idtype);
            return $stmt->execute();
        } else {
            return 0;
        }
    }

    public function update() {
        if ($this->id->getValue() != null){
            $query = new Query();
            $id = $this->id->getName();
            $fields = static::fields;
            $stmt = $query->build_update(static::tablename, $fields, [$id=>'=']);
            $conn = $query->build_connection();
            $stmt = $conn->prepare($stmt);
    
            array_walk($fields, function($value) use ($stmt){
                $field = $this->{$value};
                $fvalue = $field->getValue();
                $ftype = $field->getType();
                $stmt->bindParam(":$value", $fvalue, $ftype);
            });
            $idtype = $this->id->getType();
            $idval = $this->id->getValue();
            $stmt->bindParam(":filter_$id", $idval, $idtype);
            return $stmt->execute();
        }
        return false;
    }
}


function get_row($table, $fields='*', $filter_by=[]){
    $tablename = $table::tablename;
    $known_fields = $table::fields;
    $query = new Query();
    if (is_array($fields)){
        $fields = array_intersect($fields, $known_fields);
    }
    $proc = [];
    array_walk($filter_by, function ($value, $key) use (&$proc, $known_fields){
        if (in_array($key, $known_fields)){
            $proc[$key] = $value[0];
        }
    });
    $stmt = $query->build_select($tablename, $fields, $proc);
    $conn = $query->build_connection();
    $stmt = $conn->prepare($stmt);

    array_walk($filter_by, function($value, $key) use ($stmt){
        $field = $key;
        $fvalue = $value[1];
        $stmt->bindParam(":filter_$field", $fvalue);
    });
    
    $result = $stmt->execute();
    $result = $stmt->fetchAll(PDO::FETCH_UNIQUE);
    $model = [];
    array_walk($result, function($row, $id) use (&$model, $table){
        $row['id'] = $id;
        array_push($model, new $table($row));
    });
    return count($model) > 0 ? $model : null;
}

?>