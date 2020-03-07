<?php declare(strict_types=1);

class Field {
    private const allowed_type = [PDO::PARAM_STR, PDO::PARAM_INT];
    private $name = null;
    private $type = null;
    private $value = null;

    function __construct($name, $type=PDO::PARAM_STR) {
        $this->name = $name;
        if (in_array($type, $this::allowed_type, TRUE)) {
            $this->type = $type;
        }
    }

    public function getValue(){
        return $this->value;
    }

    public function getName(){
        return $this->name;
    }

    public function getType(){
        return $this->type;
    }

    public function setValue($value) {
        if ($this->type === $this::allowed_type[0]){
            $this->value = (string) $value;
            return true;
        } else if ($this->type === $this::allowed_type[1]){
            $this->value = (int) $value;
            return true;
        } else {
            return false;
        }
    }
}

?>