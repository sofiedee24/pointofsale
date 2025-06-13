<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PosController extends Controller
{
    public function dashboard() { 

        return view('posdashboard');
    }

    public function addCustomer() { 
        return view('addcustomer');
    }

    public function customerList() { 
        return view('customerlist');
    }

    public function addAdmin() { 
        return view('addadmin');
    }

    public function adminList() { 
        return view('adminview');
    }

    public function addCategory() { 
        return view('addcategory');
    }

    public function categoryList() { 
        return view('categorylist');
    }

    public function editCategory() { 
        return view('editcategory');
    }

    public function addProducts() { 
        return view('addproducts');
    }

    public function viewProducts() { 
        return view('productslist');
    }

    public function pushRegister() { 
        return view('auth.registrar');
    }
}
