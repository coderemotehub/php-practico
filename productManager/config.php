<?php
// Load environment variables from .env file
function loadEnvironmentVariables($filePath) {
    if (!file_exists($filePath)) {
        throw new Exception("Environment file not found: " . $filePath);
    }

    $lines = file($filePath, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
    foreach ($lines as $line) {
        if (strpos(trim($line), '#') === 0) {
            continue; // Skip comments
        }
        
        list($name, $value) = explode('=', $line, 2);
        $name = trim($name);
        $value = trim($value);

        if (!array_key_exists($name, $_SERVER) && !array_key_exists($name, $_ENV)) {
            putenv(sprintf("%s=%s", $name, $value));
            $_ENV[$name] = $value;
            $_SERVER[$name] = $value;
        }
    }
}

// Specify the path to your .env file
loadEnvironmentVariables(__DIR__ . '/.env');

// Now you can access your environment variables
define('DB_SERVER', getenv('DB_SERVER'));
define('DB_NAME', getenv('DB_NAME'));
define('DB_USER', getenv('DB_USER'));
define('DB_PASSWORD', getenv('DB_PASSWORD'));

?>
