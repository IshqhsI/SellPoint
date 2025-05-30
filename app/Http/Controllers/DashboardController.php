<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Transaction;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Cache;

class DashboardController extends Controller
{
    public function index()
    {

        $productsCount = Cache::remember('productsCount', 30, function () {
            return Product::count();
        });

        $transactionsCount = Cache::remember('transactionsCount', 30, function () {
            return Transaction::count();
        });

        $soldProductsCount = Cache::remember('sold_products', 30, function () {
            return Transaction::whereDate('created_at', today())->count();
        });

        $salesToday = Cache::remember('salesToday', 30, function () {
            return Transaction::whereDate('created_at', today())->sum('total');
        });

        $weeklyLabels = Cache::remember('weeklyLabels', 30, function () {
            return $this->getWeeklySales()['labels'];
        });

        $weeklyData = Cache::remember('weeklyData', 30, function () {
            return $this->getWeeklySales()['data'];
        });

        $monthlyLabels = Cache::remember('monthlyLabels', 30, function () {
            return $this->getMonthlySales()['labels'];
        });

        $monthlyData = Cache::remember('monthlyData', 30, function () {
            return $this->getMonthlySales()['data'];
        });

        return view('dashboard', compact('productsCount', 'transactionsCount', 'soldProductsCount', 'salesToday', 'weeklyLabels', 'weeklyData', 'monthlyLabels', 'monthlyData'));
    }

    function getWeeklySales()
    {

        $sales = Transaction::select(
            DB::raw("DATE(created_at) as date"),
            DB::raw('SUM(total) as total')
        )->where('created_at', '>=', now()->subDays(6))->groupBy('date')->pluck('total', 'date')->toArray();

        $labels = [];
        $data = [];

        for ($i = 6; $i >= 0; $i--) {
            $date = now()->subDays($i)->format('Y-m-d');
            $labels[] = now()->subDays($i)->format('D');
            $data[] = isset($sales[$date]) ? $sales[$date] : 0;
        }

        return [
            'labels' => $labels,
            'data' => $data
        ];
    }

    function getMonthlySales()
    {

        $sales = Transaction::select(
            DB::raw("TO_CHAR(created_at, 'YYYY-MM') as month"),
            DB::raw('SUM(total) as total')
        )->where('created_at', '>=', now()->subMonths(11))
            ->groupBy('month')
            ->pluck('total', 'month')
            ->toArray();

        $labels = [];
        $data = [];

        for ($i = 11; $i >= 0; $i--) {
            $date = now()->startOfMonth()->subMonths($i);
            $monthKey = $date->format('Y-m');
            $labels[] = $date->format('M Y');

            $data[] = isset($sales[$monthKey]) ? $sales[$monthKey] : 0;
        }

        return [
            'labels' => $labels,
            'data' => $data
        ];
    }
}
