<?php

namespace Noprotocol\EnvOmroep;

use Illuminate\Foundation\Application;

/**
 * Custom application to overwrite the storage & bootstrap/cache folder based on an .env setting.
 */
class LaravelApplication extends Application {

    public function __construct($basePath = null) {
        parent::__construct($basePath);
        if (class_exists('Dotenv', true)) { // Laravel 5.1
            \Dotenv::load($this->environmentPath(), $this->environmentFile());
        } elseif (class_exists('Dotenv\Dotenv', true)) { // Laravel 5.2+
            $dotenv = new \Dotenv\Dotenv($this->environmentPath(), $this->environmentFile());
            $dotenv->load();
        }
        if (env('DATA_PATH') && !$this->runningInConsole()) {
            $this->useStoragePath(env('DATA_PATH').'/storage');
        }
    }

    public function getCachedServicesPath() {
        if (env('DATA_PATH') && !$this->runningInConsole()) {
            return env('DATA_PATH') . '/bootstrap/services.php';
        }
        return parent::getCachedServicesPath();
    }

}
