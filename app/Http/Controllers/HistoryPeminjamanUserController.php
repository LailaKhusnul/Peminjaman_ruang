<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\PeminjamanUser;
use Illuminate\Support\Facades\Auth;

class HistoryPeminjamanUserController extends Controller
{
    //
    public function index()
    {
        $user = Auth::user();
        $history_peminjaman = PeminjamanUser::where('id', $user->id)
                                            ->where('is_history', true)
                                            ->orderBy('tanggal_selesai', 'desc')
                                            ->get();

        return view('user.history.index', compact('history_peminjaman'));
    }

}
