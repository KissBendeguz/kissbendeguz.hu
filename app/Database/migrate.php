<?php

require_once __DIR__ . '/../Core/Database.php';

use App\Core\Database;

class Migrator {
    private $db;
    private $migrationsDir;

    public function __construct() {
        $this->db = Database::connect();
        $this->migrationsDir = __DIR__ . '/migrations';
        $this->ensureMigrationsTable();
    }

    private function ensureMigrationsTable() {
        $this->db->exec("CREATE TABLE IF NOT EXISTS migrations (
            id INTEGER PRIMARY KEY AUTOINCREMENT,
            migration VARCHAR(255) NOT NULL,
            executed_at DATETIME DEFAULT CURRENT_TIMESTAMP
        )");
    }

    private function getExecutedMigrations() {
        $stmt = $this->db->query("SELECT migration FROM migrations");
        return $stmt->fetchAll(PDO::FETCH_COLUMN);
    }

    public function migrate() {
        echo "Running migrations...\n";
        
        $executed = $this->getExecutedMigrations();
        $files = scandir($this->migrationsDir);
        $newMigrations = [];

        foreach ($files as $file) {
            if ($file === '.' || $file === '..') continue;
            if (pathinfo($file, PATHINFO_EXTENSION) !== 'sql') continue;

            if (!in_array($file, $executed)) {
                $newMigrations[] = $file;
            }
        }

        if (empty($newMigrations)) {
            echo "Nothing to migrate.\n";
            return;
        }

        sort($newMigrations);

        foreach ($newMigrations as $file) {
            echo "Migrating: $file ... ";
            try {
                $sql = file_get_contents($this->migrationsDir . '/' . $file);
                $this->db->exec($sql);
                
                $stmt = $this->db->prepare("INSERT INTO migrations (migration) VALUES (?)");
                $stmt->execute([$file]);
                
                echo "DONE\n";
            } catch (Exception $e) {
                echo "FAILED\n";
                echo "Error: " . $e->getMessage() . "\n";
                exit(1);
            }
        }

        echo "All migrations executed successfully.\n";
    }
}

// Run if called from CLI
if (php_sapi_name() === 'cli') {
    // Load .env logic if needed, but for now we assume Database class handles connection config
    
    // Simplistic .env loader if Database class relies on getenv and not pre-loaded env
    // Assuming keys are set in app/Config or hardcoded for now based on earlier context.
    // If Database uses $_ENV or getenv, we might need to load environment. 
    // Checking Database.php... It uses environment variables. 
    // Creating a simple env loader helper for CLI usage.
    
    $envPath = __DIR__ . '/../../.env';
    if (file_exists($envPath)) {
        $lines = file($envPath, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
        foreach ($lines as $line) {
            if (strpos($line, '#') === 0) continue;
            list($key, $value) = explode('=', $line, 2);
            putenv(trim($key) . '=' . trim($value));
        }
    }
    
    $migrator = new Migrator();
    $migrator->migrate();
}
