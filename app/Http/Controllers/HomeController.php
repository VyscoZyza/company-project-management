<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;
use App\Models\Post;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use DataTables;


class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
        // $this->middleware('role')->only(['index']);
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index(Request $request)
    {
        // $task = Post::where('user_id', Auth::id())->latest()->get();

        return view('Home');
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $todayDate = Carbon::now();
        $pre = (((int)$request->realisasi / (int)$request->target)) * 100;
        $pro = round($pre, 0);
        if ($pro == 100) {
            $val = 'Selesai';
            $selesai = $todayDate;
        } else {
            $val = $request->status;
            $selesai = $request->tanggal_selesai;
        }
        Post::updateOrCreate(
            ['id' => $request->id],
            [
                'user_id' => $request->user_id,
                'title' => $request->title,
                'content' => $request->content,
                'kpi' => $request->kpi,
                'realisasi' => $request->realisasi,
                'target' => $request->target,
                'status' => $val,
                'target_selesai' => $request->target_selesai,
                'user_id' => $request->user_id,
                'name' => $request->name,
                'jabatan' => $request->jabatan,
                'supervisi' => $request->supervisi,
                'bagian' => $request->bagian,
                'bidang' => $request->bidang,
                'tanggal_selesai' => $selesai,
            ]
        );

        return response()->json(['success' => 'Berhasil disimpan.']);
    }
    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $post = Post::find($id);
        return response()->json($post);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Post::find($id)->delete();

        return response()->json(['success' => 'Berhasil dihapus.']);
    }
    public function actionButton($id)
    {
        $btn = ' <a href="javascript:void(0)" data-toggle="tooltip"  data-id="' . $id . '" data-original-title="Detail" class="btn btn-success mr-1 btn-sm detailProduct"><span class="fas fa-info"></span></a>';
        $btn  = $btn .  '<a href="javascript:void(0)" data-toggle="tooltip"  data-id="' . $id . '" data-original-title="Edit"  class=" edit btn btn-primary btn-sm editProduct"><span class="fas fa-pen"></span></a>';
        $btn = $btn . ' <a href="javascript:void(0)" data-toggle="tooltip"  data-id="' . $id . '" data-original-title="Delete" class="btn btn-danger btn-sm deleteProduct"><span class="fas fa-trash"></span></a>';


        return $btn;
    }
    public function progressBar($pro, $stat)
    {
        if ($stat == "Dibatalkan") {
            $bar = '<div class="progress mt-1" style="height: 20px; background-color: #c7c8d1;";> <div class="progress-bar bg-dark" role="progressbar" style="width: ' . $pro . '%; " aria-valuenow="' . $pro . '" aria-valuemin="0" aria-valuemax="100">' . $pro . ' %</div></div>';
            return $bar;
        } else {
            if ($pro >= 0 and $pro <= 25) {
                $bar = '<div class="progress mt-1" style="height: 20px; background-color: #c7c8d1;";> <div class="progress-bar bg-danger" role="progressbar" style="width: ' . $pro . '%; " aria-valuenow="' . $pro . '" aria-valuemin="0" aria-valuemax="100">' . $pro . ' %</div></div>';
                return $bar;
            } else if ($pro > 25 and $pro <= 50) {
                $bar = '<div class="progress mt-1" style="height: 20px; background-color: #c7c8d1;";> <div class="progress-bar"  role="progressbar" style="width: ' . $pro . '%; background-color: #f05716;" aria-valuenow="' . $pro . '" aria-valuemin="0" aria-valuemax="100">' . $pro . ' %</div></div>';
                return $bar;
            } else if ($pro > 50 and $pro <= 75) {
                $bar = '<div class="progress mt-1" style="height: 20px; background-color: #c7c8d1;";> <div class="progress-bar bg-warning" role="progressbar" style="width: ' . $pro . '%; " aria-valuenow="' . $pro . '" aria-valuemin="0" aria-valuemax="100">' . $pro . ' %</div></div>';
                return $bar;
            } else if ($pro > 75 and $pro < 100) {
                $bar = '<div class="progress mt-1" style="height: 20px; background-color: #c7c8d1;";> <div class="progress-bar bg-success" role="progressbar" style="width: ' . $pro . '%; " aria-valuenow="' . $pro . '" aria-valuemin="0" aria-valuemax="100">' . $pro . ' %</div></div>';
                return $bar;
            } else if ($pro == 100) {
                $bar = '<div class="progress mt-1" style="height: 20px; background-color: #c7c8d1;";> <div class="progress-bar bg-primary" role="progressbar" style="width: ' . $pro . '%; " aria-valuenow="' . $pro . '" aria-valuemin="0" aria-valuemax="100">' . $pro . ' %</div></div>';
                return $bar;
            }
        }
    }
    public function statusBar($pro, $stat)
    {
        if ($stat == "Dibatalkan") {
            $stat = '<div class="d-flex flex-column"> <a class="btn btn-dark mr-1 btn-sm text-white">' . $stat . '</a></div>';
            return $stat;
        } else {
            if ($pro >= 0 and $pro <= 25) {
                $stat = '<div class="d-flex flex-column"> <a class="btn btn-danger mr-1 btn-sm text-white">' . $stat . '</a></div>';
                return $stat;
            } else if ($pro > 25 and $pro <= 50) {
                $stat = '<div class="d-flex flex-column"> <a class="btn mr-1 btn-sm text-white" style="background-color: #f05716;">' . $stat . '</a></div>';
                return $stat;
            } else if ($pro > 50 and $pro <= 75) {
                $stat = '<div class="d-flex flex-column"> <a class="btn btn-warning mr-1 btn-sm text-white ">' . $stat . '</a></div>';
                return $stat;
            } else if ($pro > 75 and $pro < 100) {
                $stat = '<div class="d-flex flex-column"> <div class="btn btn-success mr-1 btn-sm text-white">' . $stat . '</div></div>';
                return $stat;
            } else if ($pro == 100) {
                $stat = '<div class="d-flex flex-column"> <div class="btn btn-primary mr-1 btn-sm text-white">' . $stat . '</div></div>';
                return $stat;
            }
        }
    }
}
