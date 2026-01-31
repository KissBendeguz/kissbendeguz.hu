<?php

/** @var \App\Core\Router $router */

$router->get('/', ['App\Controllers\HomeController', 'index']);
$router->get('/stack', ['App\Controllers\HomeController', 'index']); 
$router->post('/contact', ['App\Controllers\HomeController', 'contact']);


$router->get('/adatkezelesi-tajekoztato', ['App\Controllers\LegalController', 'privacy']);
$router->get('/suti-kezeles', ['App\Controllers\LegalController', 'cookies']);

$router->get('/sitemap.xml', ['App\Controllers\SeoController', 'sitemap']);
$router->get('/robots.txt', ['App\Controllers\SeoController', 'robots']);


$router->get('/admin/login', ['App\Controllers\Admin\LoginController', 'showLoginForm']);
$router->post('/admin/login', ['App\Controllers\Admin\LoginController', 'login']);
$router->get('/admin/logout', ['App\Controllers\Admin\LoginController', 'logout']);
$router->get('/admin', ['App\Controllers\Admin\DashboardController', 'index']);
$router->get('/admin/messages', ['App\Controllers\Admin\MessagesController', 'index']);
$router->get('/admin/messages/show', ['App\Controllers\Admin\MessagesController', 'show']);
$router->get('/admin/settings', ['App\Controllers\Admin\SettingsController', 'index']);
$router->post('/admin/settings', ['App\Controllers\Admin\SettingsController', 'update']);

$router->get('/admin/media', ['App\Controllers\Admin\MediaController', 'index']);
$router->post('/admin/media/upload', ['App\Controllers\Admin\MediaController', 'upload']);
$router->get('/admin/media/delete', ['App\Controllers\Admin\MediaController', 'delete']);
$router->get('/admin/projects', ['App\Controllers\Admin\ProjectsController', 'index']);
$router->get('/admin/projects/create', ['App\Controllers\Admin\ProjectsController', 'create']);
$router->post('/admin/projects/store', ['App\Controllers\Admin\ProjectsController', 'store']);
$router->get('/admin/projects/edit', ['App\Controllers\Admin\ProjectsController', 'edit']);
$router->post('/admin/projects/update', ['App\Controllers\Admin\ProjectsController', 'update']);
$router->get('/admin/projects/delete', ['App\Controllers\Admin\ProjectsController', 'delete']);
$router->post('/admin/projects/reorder', ['App\Controllers\Admin\ProjectsController', 'reorder']);

$router->get('/admin/stack', ['App\Controllers\Admin\StackController', 'index']);
$router->post('/admin/stack/store-category', ['App\Controllers\Admin\StackController', 'storeCategory']);
$router->get('/admin/stack/delete-category', ['App\Controllers\Admin\StackController', 'deleteCategory']);
$router->post('/admin/stack/store-item', ['App\Controllers\Admin\StackController', 'storeItem']);
$router->get('/admin/stack/delete-item', ['App\Controllers\Admin\StackController', 'deleteItem']);
$router->post('/admin/stack/reorder-items', ['App\Controllers\Admin\StackController', 'reorderItems']);
$router->post('/admin/stack/reorder-categories', ['App\Controllers\Admin\StackController', 'reorderCategories']);

$router->get('/admin/timeline', ['App\Controllers\Admin\TimelineController', 'index']);
$router->get('/admin/timeline/create', ['App\Controllers\Admin\TimelineController', 'create']);
$router->post('/admin/timeline/store', ['App\Controllers\Admin\TimelineController', 'store']);
$router->get('/admin/timeline/edit', ['App\Controllers\Admin\TimelineController', 'edit']);
$router->post('/admin/timeline/update', ['App\Controllers\Admin\TimelineController', 'update']);
$router->post('/admin/timeline/update', ['App\Controllers\Admin\TimelineController', 'update']);
$router->get('/admin/timeline/delete', ['App\Controllers\Admin\TimelineController', 'delete']);
$router->post('/admin/timeline/reorder', ['App\Controllers\Admin\TimelineController', 'reorder']);

$router->get('/admin/testimonials', ['App\Controllers\Admin\TestimonialController', 'index']);
$router->get('/admin/testimonials/create', ['App\Controllers\Admin\TestimonialController', 'create']);
$router->post('/admin/testimonials/store', ['App\Controllers\Admin\TestimonialController', 'store']);
$router->get('/admin/testimonials/edit', ['App\Controllers\Admin\TestimonialController', 'edit']);
$router->post('/admin/testimonials/update', ['App\Controllers\Admin\TestimonialController', 'update']);
$router->post('/admin/testimonials/update', ['App\Controllers\Admin\TestimonialController', 'update']);
$router->get('/admin/testimonials/delete', ['App\Controllers\Admin\TestimonialController', 'delete']);
$router->post('/admin/testimonials/reorder', ['App\Controllers\Admin\TestimonialController', 'reorder']);
