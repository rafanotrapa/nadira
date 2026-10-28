<?php
/**
 * api/db.php — SQLite Database Initialization and Helper Functions
 * BRITAKAN Platform
 */

declare(strict_types=1);

$dbPath = __DIR__ . '/../data/britakan.sqlite';
$isNew = !file_exists($dbPath);

try {
    $pdo = new PDO('sqlite:' . $dbPath);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);

    if ($isNew) {
        // Create reports table
        $pdo->exec("
            CREATE TABLE reports (
                id INTEGER PRIMARY KEY AUTOINCREMENT,
                reference_id TEXT UNIQUE NOT NULL,
                category TEXT NOT NULL,
                role TEXT NOT NULL,
                description TEXT NOT NULL,
                status TEXT DEFAULT 'Received',
                created_at DATETIME DEFAULT CURRENT_TIMESTAMP
            )
        ");

        // Create admin users table
        $pdo->exec("
            CREATE TABLE admins (
                id INTEGER PRIMARY KEY AUTOINCREMENT,
                username TEXT UNIQUE NOT NULL,
                password_hash TEXT NOT NULL,
                role TEXT DEFAULT 'moderator'
            )
        ");

        // Seed default admin (admin / britakan2026)
        $stmt = $pdo->prepare("INSERT OR IGNORE INTO admins (username, password_hash, role) VALUES (?, ?, ?)");
        $stmt->execute(['admin', password_hash('britakan2026', PASSWORD_DEFAULT), 'superadmin']);

        // Seed sample report for tracking demo
        $stmt = $pdo->prepare("INSERT INTO reports (reference_id, category, role, description, status) VALUES (?, ?, ?, ?, ?)");
        $stmt->execute(['BRITAKAN-DEMO-9999', 'Bullying', 'I experienced the incident', 'Sample incident report for tracking demonstration.', 'Initial Review']);
    }
} catch (PDOException $e) {
    // Fallback if SQLite fails
    $pdo = null;
}
