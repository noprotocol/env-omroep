<?php

/**
 * Usage
 *   Create a php file in the webroot:

  <?php
  header('Content-Type: text/plain');
  ini_set('display_errors', true);
  echo "Preparing data folder\n";
  require(__DIR__ . '/../vendor/autoload.php');
  $dataFolder = new Noprotocol\EnvOmroep\DataFolder();
  $dataFolder->createLaravelFolders();
  $dataFolder->mkdir('uploads');
  echo "completed\n";

 */

namespace Noprotocol\EnvOmroep;

class DataFolder {

    private $dataPath;

    function __construct() {
        $projectPath = dirname(dirname(dirname(dirname(__DIR__)))); // strip 'src', 'env-oproep', 'noprotocol' and 'vendor'
        if (class_exists('Dotenv', true)) { // Laravel 5.1
            \Dotenv::load($projectPath);
        } elseif (class_exists('Dotenv\Dotenv', true)) { // Laravel 5.2+
            $dotenv = new \Dotenv\Dotenv($projectPath);
            $dotenv->load();
        } else {
            echo "[ERROR] No suitable Dotenv package found\n";
            exit(1);
        }
        $this->dataPath = env('DATA_PATH');
        if (!$this->dataPath) {
            echo "[ERROR] No DATA_PATH defined in the .env\n";
            exit(1);
        }
    }

    /**
     * Create a folder inside the data folder
     * @param string $path
     * @return boolean
     */
    function mkdir($path) {
        if (substr($path, 0, 1) !== '/') {
            $path = '/'.$path;
        }
        if (file_exists($this->dataPath . $path)) {
            if (!is_dir($this->dataPath . $path)) {
                echo "[ERROR] " . $path . " is not a directory\n";
            }
            return true;
        }
        if (mkdir($this->dataPath . $path)) {
            return true;
        }
        echo "[ERROR] Failed to create " . $this->dataPath . $path . " \n";
    }

    /**
     * Create the folders needed for laravel.
     */
    function createLaravelFolders() {
        $this->mkdir('bootstrap');
        $this->mkdir('bootstrap/cache');
        $this->mkdir('storage');
        $this->mkdir('storage/logs');
        $this->mkdir('storage/app');
        $this->mkdir('storage/app/public');
        $this->mkdir('storage/framework');
        $this->mkdir('storage/framework/cache');
        $this->mkdir('storage/framework/sessions');
        $this->mkdir('storage/framework/views');
    }

}
