<?php
require_once("../app/model/Query.php");
class Model {
    const fields = [];
    const tablename = null;

    public function getValue($field) {
        return $this->{$field};
    }

    public function setValue($field, $value){
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
        $stmt->execute();
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
            $stmt->execute();
        }
    }
}


function get_row($tablename, $fields='*', $filter_by=[]){
    $query = new Query();
    if (is_array($fields)){
        $fields = array_intersect($fields, User::fields);
    }
    $proc = [];
    array_walk($filter_by, function ($value, $key) use (&$proc){
        if (in_array($key, User::fields)){
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
    $users = [];
    array_walk($result, function($row, $id) use (&$users){
        $row['id'] = $id;
        array_push($users, new User($row));
    });
    return count($users) > 0 ? $users : null;
}



?>