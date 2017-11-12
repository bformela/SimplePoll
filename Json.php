<?php

declare(strict_types=1);

class Json {

    private $file_name;
    private $data;

    public function __construct(array $data, $file_name = 'poll.json') {
        $this->file_name = $file_name;
        $this->data = $data;
    }

    public function getData() {
        return $this->data;
    }

    public function setData($data) {
        $this->data = $data;
    }

    public function write_json() {
        if (empty($this->data)) die('<p>Brak danych do zapisu.</p>');
        $content = json_encode($this->data, JSON_PRETTY_PRINT);
        $write = file_put_contents($this->file_name, $content, LOCK_EX);
        if (!$write) die('<p>Zapis do pliku zakończony niepowodzeniem.</p>');
    }

    public function read_json() {
        $json_data = file_get_contents($this->file_name);
        if (!$json_data) die('<p>Odczyt z pliku zakończony niepowodzeniem.</p>');
        $this->data = json_decode($json_data, true);
    }

    public function init_file() {
        if (file_exists($this->file_name)) {
            $this->read_json();
            return true;
        } else {
            $this->write_json();
            return false;
        }
    }
}