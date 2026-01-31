<?php

namespace App\Controllers;

use App\Core\Controller;
use App\Core\Database;

class SeoController extends Controller {
    public function sitemap() {
        $db = Database::connect();
        $settings = $this->getSettings($db);
        $baseUrl = rtrim($settings['seo_canonical_base'] ?? url(), '/');
        
        $lastMod = $settings['updated_at'] ?? date('Y-m-d');
        
        header("Content-Type: application/xml; charset=utf-8");
        echo '<?xml version="1.0" encoding="UTF-8"?>';
        ?>
        <urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">
            <url>
                <loc><?= $baseUrl ?>/</loc>
                <lastmod><?= date('Y-m-d', strtotime($lastMod)) ?></lastmod>
                <changefreq>monthly</changefreq>
                <priority>1.0</priority>
            </url>
        </urlset>
        <?php
        exit;
    }

    public function robots() {
        $db = Database::connect();
        $settings = $this->getSettings($db);
        $baseUrl = rtrim($settings['seo_canonical_base'] ?? url(), '/');
        $robots = $settings['seo_robots'] ?? 'index, follow';

        header("Content-Type: text/plain; charset=utf-8");
        
        if (strpos($robots, 'noindex') !== false) {
            echo "User-agent: *\nDisallow: /\n";
        } else {
            echo "User-agent: *\nAllow: /\n";
            echo "Disallow: /admin\n";
        }
        
        echo "Sitemap: $baseUrl/sitemap.xml";
        exit;
    }

    private function getSettings($db) {
        $stmt = $db->query("SELECT * FROM settings");
        $settings = [];
        foreach ($stmt->fetchAll() as $row) {
            $settings[$row['key']] = $row['value'];
        }
        // Get latest update time from settings for lastmod
        $stmt = $db->query("SELECT MAX(updated_at) as last_mod FROM settings");
        $res = $stmt->fetch();
        if ($res && $res['last_mod']) {
            $settings['updated_at'] = $res['last_mod'];
        }
        return $settings;
    }
}
