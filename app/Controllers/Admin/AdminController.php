<?php

namespace App\Controllers\Admin;

use App\Core\Controller;
use App\Core\Auth;

class AdminController extends Controller {
    public function __construct() {
        if (!Auth::check()) {
            $this->redirect('/admin/login');
        }
    }
}
