<?php

namespace App\Controllers;

class Home extends BaseController
{
    public function index()
    {
        if(logged_in()) {
            if(in_groups('admin')) {
                return redirect()->to('/admin');
            } else if(in_groups('wali_kelas')) {
                return redirect()->to('/wali_kelas');
            }
        } else {
            return redirect()->to('/login');
        }
    }
}
