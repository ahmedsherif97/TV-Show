<?php

namespace App\Http\Controllers\Dashboard;

use Illuminate\Http\Request;
use Modules\Task\App\Models\Task;
use Illuminate\Support\Facades\Auth;
use Modules\Meeting\App\Models\Meeting;
use Modules\Workflow\App\Models\Application;
use Carbon\Carbon;

class DashboardController extends Controller
{
    public function index()
    {
        return view('dashboard.index');
    }
}
