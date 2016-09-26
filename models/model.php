<?php

class Model {
    private $data = [];
    private $conditions = [];

    public function __set($name, $value) {
        $this->data[$name] = $value;
    }

    public function __get($name) {
        if (array_key_exists($name, $this->data)) {
            return $this->data[$name];
        }
        return null;
    }

    public function __isset($name) {
        return isset($this->data[$name]);
    }

    public function __unset($name) {
        unset($this->data[$name]);
    }

    public static function exec($query) {

        $db = new mysqli(
            $env['host'],
            $env['username'],
            $env['password'],
            $env['database']
        );

        if ($db->connect_errno > 0) {
            throw new Exception('Database error');
        }

        if (! $result = $db->query($query)) {
            throw new Exception('Error executing query');
        }

        if ($result->num_rows == 1) {
            $row = $result->fetch_assoc();
            $class_name = self::name();
            $model = new $class_name();
            foreach (array_keys($row) as $key) {
                $model->$key = $row[$key];
            }
            return $model;
        } else if ($result->num_rows > 0) {
            $results = [];
            while ($row = $result->fetch_assoc()) {
                $class_name = self::name();
                $model = new $class_name();
                foreach (array_keys($row) as $key) {
                    $model->$key = $row[$key];
                }
                $results[] = $model;
            }
            return $results;
            $result->free();
        }
        return $db->insert_id;
    }

    public static function name() {
        return get_called_class();
    }

    public function list() {
        echo "<pre>" . json_encode($this->data) . "</pre>";
    }

    private function list_keys() {
        $key_string = "";
        foreach (array_keys($this->data) as $key) {
            $key_string = empty($key_string) ?
                "$key" :
                "$key_string, $key";
        }
        return $key_string;
    }

    private function list_values() {
        $value_string = "";
        foreach ($this->data as $value) {
            $value_string = empty($value_string) ?
                "'$value'" :
                "$value_string, '$value'";
        }
        return $value_string;
    }

    private function list_sets() {
        $key_string = "";
        foreach (array_keys($this->data) as $key) {
            $key_string = empty($key_string) ?
                "$key = " . "'" . $this->data[$key] . "'":
                "$key_string, $key = " . "'" . $this->data[$key] . "'";
        }
        return $key_string;
    }

    private function list_conditions() {
        $condition_string = "";
        foreach ($this->conditions as $condition) {
            $operator_string = $condition['key'] . " " . $condition['operator']
                . " '" . $condition['value'] . "'";
            $condition_string = empty($condition_string) ?
                "$operator_string" :
                "$condition_string AND $operator_string";
        }
        return $condition_string;
    }

    public function where() {
        $condition = [
            'key' => func_get_arg(0),
            'value' => func_get_arg(1),
            'operator' => func_num_args() == 3 ? func_get_arg(2) : "="
        ];
        $this->conditions[] = $condition;
        return $this;
    }

    public function save() {
        $query = "INSERT INTO "
            . $this->name()
            . " (" . $this->list_keys() . ") VALUES"
            . " (" . $this->list_values() . ");";
        $this->data['id'] = $this->exec($query);
    }

    public function update() {
        if (isset($this->data['id'])) {
            $query = "UPDATE "
                . $this->name() . " SET "
                . $this->list_sets() . " WHERE "
                . $this->name() . ".id = " . $this->data["id"] . ";";
            $this->exec($query);
        }
    }

    public function delete() {
        if (isset($this->data['id'])) {
            $query = "DELETE FROM "
                . $this->name() . " WHERE "
                . $this->name() . ".id = " . $this->data["id"] . ";";
            $this->exec($query);
        }
    }

    public function get() {
        $query = "SELECT * FROM " . $this->name()
            . " WHERE " . $this->list_conditions() . ";";
        return $this->exec($query);
    }

    public static function all() {
        $query = "SELECT * FROM " . self::name() . ";";
        return self::exec($query);
    }

    public static function find($id) {
        $query = "SELECT * FROM " . self::name()
            . " WHERE " . self::name()
            . ".id = $id;";
        return self::exec($query);
    }
}
