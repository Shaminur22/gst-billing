<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Party;
use App\Models\GstBill;   // Make sure you have this model
use Carbon\Carbon;

class AppController extends Controller
{
 public function index()
    {
        // Total Revenue
        $totalRevenue = DB::table('gst_bills')->sum('net_amount');

        // Today's Sales (count of bills created today)
        $todaysSales = DB::table('gst_bills')
            ->whereDate('created_at', today())
            ->count();

        // This Month's Total Revenue
        $monthlySales = DB::table('gst_bills')
            ->whereMonth('created_at', now()->month)
            ->sum('net_amount');

        // Monthly Revenue Data for Chart (Jan to Dec)
        $monthlyDataRaw = DB::table('gst_bills')
            ->select(DB::raw('MONTH(created_at) as month'), DB::raw('SUM(net_amount) as total'))
            ->groupBy('month')
            ->pluck('total', 'month'); // returns like [1=>1000,2=>2000]

        // Fill missing months with 0
        $monthlyData = [];
        for ($i = 1; $i <= 12; $i++) {
            $monthlyData[] = $monthlyDataRaw[$i] ?? 0;
        }

        return view('dashboard', compact('totalRevenue', 'todaysSales', 'monthlySales', 'monthlyData'));
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

        return redirect()->back()->withStatus("Record deleted successfully");
    }
}
