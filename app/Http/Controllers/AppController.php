<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Party;
use Illuminate\Support\Facades\DB;


class AppController extends Controller
{


    public function index()
    {
        return view("dashboard");
    }

    public function about()
    {
        return view("about");
    }

    // Function to soft delete
    public function delete($table, $id)
    {
        $param = array('is_deleted' => 1);
        DB::table($table)->where('id', $id)->update($param);

        // Redirect back
        return redirect()->back()->withStatus("Record deleted successfully");
    }
}