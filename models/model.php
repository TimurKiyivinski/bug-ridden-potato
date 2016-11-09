<?php

class Model {
    // Array for storing overrides
    private $data = [];
    // Where condition list
    private $conditions = [];
    // XML file
    private static $xml_dir = "./models.xml";
    // XML root tag
    private static $xml_root = "Models";

    // SECTION OVERRIDES
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
    // ENDSECTION OVERRIDES

    // Return called class name
    public static function name() {
        return get_called_class();
    }

    // Return class data as JSON data
    public function list_contents() {
        echo "<pre>" . json_encode($this->data) . "</pre>";
    }

    // List all data keys in CSV
    private function list_keys() {
        $key_string = "";
        foreach (array_keys($this->data) as $key) {
            $key_string = empty($key_string) ?
                "$key" :
                "$key_string, $key";
        }
        return $key_string;
    }

    // Add an additional property
    public function set($key, $value) {
        $this[$key] = $value;
        return $this;
    }

    // Add an additional where clause
    public function where() {
        $condition = [
            'key' => func_get_arg(0),
            'value' => func_get_arg(1)
        ];
        $this->conditions[] = $condition;
        return $this;
    }

    // Save instance based on $data
    public function save() {
    }

    // Update current instance data
    public function update() {
    }

    // Delete current instance
    public function delete() {
    }

    // Execute query on where clauses
    public function get() {
    }

    // Return a list of all returned model instances
    public static function all() {
        $models = [];
        if (file_exists($xml_dir)) {
            $xml = simplexml_load_file($xml_dir);
            print_r($xml);
        }
    }

    // Return a single model instance
    public static function find($id) {
    }
}
