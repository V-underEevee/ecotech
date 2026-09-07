<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Service;
use App\Models\BlogPost;
use App\Models\Product;
use Illuminate\Http\Request;

/**
 * Controlador del panel de administración
 * 
 * Gestiona el dashboard y estadísticas del sistema
 */
class AdminController extends Controller
{
    /**
     * Muestra el dashboard con estadísticas
     * 
     * Calcula datos reales desde la base de datos:
     * - Total de usuarios
     * - Total de servicios
     * - Total de posts
     * - Total de productos
     * - Servicio más contratado
     * - Usuario con más servicios
     * - Servicios activos/cancelados
     * - Últimos servicios contratados
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        // Estadísticas básicas
        $totalUsers = User::count();
        $totalServices = Service::count();
        $totalPosts = BlogPost::count();
        $totalProducts = Product::count();

        // Servicio más contratado
        $mostPopularService = Service::select('service_name')
            ->selectRaw('COUNT(*) as total')
            ->groupBy('service_name')
            ->orderBy('total', 'desc')
            ->first();

        // Usuario con más servicios contratados
        $topUser = User::withCount('services')
            ->orderBy('services_count', 'desc')
            ->first();

        // Servicios por estado
        $activeServices = Service::where('status', 'activo')->count();
        $cancelledServices = Service::where('status', 'cancelado')->count();

        // Últimos servicios contratados
        $recentServices = Service::with('user')
            ->orderBy('created_at', 'desc')
            ->limit(5)
            ->get();

        return view('admin.dashboard', compact(
            'totalUsers',
            'totalServices',
            'totalPosts',
            'totalProducts',
            'mostPopularService',
            'topUser',
            'activeServices',
            'cancelledServices',
            'recentServices'
        ));
    }
}