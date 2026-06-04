<?php
namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Note;
use App\Models\ActivityLog;

class AdminController extends Controller
{
    private function getSidebarData() {
        return [
            'security_alerts' => ActivityLog::whereIn('action', ['suspicious_login_attempt', 'ssrf_attempt_blocked', 'multiple_failed_logins'])->count(),
            'total_users'     => User::count(),
            'total_notes'     => Note::count(),
            'twofa_enabled'   => User::where('google2fa_enabled', 1)->count(),
            'twofa_disabled'  => User::where('google2fa_enabled', 0)->count(),
            'admin_count'     => User::where('is_admin', 1)->count(),
        ];
    }

    public function index() {
        $data = $this->getSidebarData();
        $data['recent_logs'] = ActivityLog::with('user')->latest()->take(15)->get();
        $data['recent_users'] = User::latest()->take(10)->get();
        return view('adminpanel', compact('data'));
    }

    public function logs() {
        $data = $this->getSidebarData();
        $logs = ActivityLog::with('user')->latest()->paginate(30);
        return view('adminlogs', compact('logs', 'data'));
    }

    public function users() {
        $data = $this->getSidebarData();
        $users = User::withCount('notes')->latest()->paginate(20);
        $stats = ['total' => $data['total_users'], 'admins' => $data['admin_count']];
        return view('adminusers', compact('users', 'stats', 'data'));
    }

    public function showUser(User $user) {
        $data = $this->getSidebarData();
        $userLogs = ActivityLog::where('user_id', $user->id)->latest()->take(20)->get();
        $noteCount = $user->notes()->count();
        return view('adminusersshow', compact('user', 'userLogs', 'noteCount', 'data'));
    }

    public function notes() {
        $data = $this->getSidebarData();
        $notes = Note::with('user')->latest()->paginate(20);
        return view('adminnotes', compact('notes', 'data'));
    }

    public function settings() {
        $data = $this->getSidebarData();
        return view('adminsettings', compact('data'));
    }
}