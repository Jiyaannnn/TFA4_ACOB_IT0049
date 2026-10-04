<?php
namespace App\Controllers;
use App\Models\TaskUserModel;
class Profile extends BaseController {
    public function index(): string {
        // The demo profile comes from the task database's users table, not POS staff.
        return view('pages/profile', ['title' => 'Profile', 'activePage' => 'profile', 'user' => (new TaskUserModel())->first()]);
    }
}
