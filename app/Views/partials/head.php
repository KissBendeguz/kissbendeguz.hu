<?php
/** @var array $settings */
$title = $settings['seo_title'] ?? $settings['site_name'] . ' - Portfólió';
$desc = $settings['seo_description'] ?? 'Webfejlesztő portfólió';
$robots = $settings['seo_robots'] ?? 'index, follow';
$baseUrl = (isset($_SERVER['HTTPS']) ? "https" : "http") . "://$_SERVER[HTTP_HOST]";
$url = $baseUrl . $_SERVER['REQUEST_URI'];
$defaultImage = $baseUrl . '/' . ltrim(url('assets/img/og-cover.jpg'), '/');

// OG és Twitter képek - teljes URL-ként
$ogImagePath = $settings['og_image'] ?? '';
$ogImage = $ogImagePath ? $baseUrl . '/' . ltrim($ogImagePath, '/') : $defaultImage;

$twitterImagePath = $settings['twitter_image'] ?? '';
$twitterImage = $twitterImagePath ? $baseUrl . '/' . ltrim($twitterImagePath, '/') : $ogImage;
?>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title><?= e($title) ?></title>
<meta name="description" content="<?= e($desc) ?>">
<meta name="robots" content="<?= e($robots) ?>">
<link rel="canonical" href="<?= e($url) ?>">
<link rel="icon" type="image/png" href="<?= asset('assets/img/logo.png') ?>">

<!-- OpenGraph -->
<meta property="og:type" content="<?= e($settings['og_type'] ?? 'website') ?>">
<meta property="og:url" content="<?= e($url) ?>">
<meta property="og:title" content="<?= e($title) ?>">
<meta property="og:description" content="<?= e($desc) ?>">
<meta property="og:image" content="<?= e($ogImage) ?>">
<meta property="og:site_name" content="<?= e($settings['og_site_name'] ?? $settings['site_name'] ?? '') ?>">
<meta property="og:locale" content="<?= e($settings['og_locale'] ?? 'hu_HU') ?>">

<!-- Twitter Card -->
<meta name="twitter:card" content="<?= e($settings['twitter_card'] ?? 'summary_large_image') ?>">
<meta name="twitter:title" content="<?= e($title) ?>">
<meta name="twitter:description" content="<?= e($desc) ?>">
<meta name="twitter:image" content="<?= e($twitterImage) ?>">
<?php if (!empty($settings['twitter_site'])): ?>
<meta name="twitter:site" content="@<?= e($settings['twitter_site']) ?>">
<?php endif; ?>
<?php if (!empty($settings['twitter_creator'])): ?>
<meta name="twitter:creator" content="@<?= e($settings['twitter_creator']) ?>">
<?php endif; ?>

<!-- JSON-LD -->
<script type="application/ld+json">
{
  "@context": "https://schema.org",
  "@type": "Person",
  "name": "Kiss Bendegúz",
  "url": "<?= e($url) ?>",
  "jobTitle": "Full Stack Webfejlesztő",
  "knowsAbout": ["PHP", "JavaScript", "Tailwind CSS", "Angular", "Spring Boot", "Software Engineering"]
}
</script>

<link rel="stylesheet" href="<?= asset('dist/app.css') ?>">
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <!-- Scripts -->
    <script src="<?= asset('dist/app.js') ?>" defer></script>
