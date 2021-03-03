<?php


namespace App\Http\Controllers;

use App\Http\Requests\UpdatePasswordRequest;
use Illuminate\Http\Request;
use App\Models\Post;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use DataTables;
use Exception;


class PageController extends Controller
{
    public function MyTask(Request $request)
    {

        if ($request->ajax()) {

            $data = Post::where('user_id', Auth::user()->uid)->latest();
            return Datatables::of($data)
                ->addIndexColumn()
                ->addColumn('action', function ($row) {
                    $id = $row->id;

                    $btn = ' <a href="javascript:void(0)" data-toggle="tooltip"  data-id="' . $id . '" data-original-title="Detail" class="btn btn-success mr-1 btn-sm detailProduct"><span class="fas fa-info"></span></a>';
                    $btn  = $btn .  '<a href="javascript:void(0)" data-toggle="tooltip"  data-id="' . $id . '" data-original-title="Edit"  class=" edit btn btn-primary btn-sm editProduct"><span class="fas fa-pen"></span></a>';
                    $btn = $btn . ' <a href="javascript:void(0)" data-toggle="tooltip"  data-id="' . $id . '" data-original-title="Delete" class="btn btn-danger btn-sm deleteProduct"><span class="fas fa-trash"></span></a>';


                    return $btn;
                })->addColumn('target_selesai', function ($row) {
                    $date = date("d M Y", strtotime($row->target_selesai));
                    return $date;
                })->addColumn('kpi', function ($row) {
                    if ($row->kpi == "0") {
                        $kpi = "Tidak";
                        return $kpi;
                    } else {
                        $kpi = "Ya";
                        return $kpi;
                    }
                })->addColumn('progress', function ($row) {
                    $pre = (((int)$row->realisasi / (int)$row->target)) * 100;
                    $pro = round($pre, 0);
                    $stat = $row->status;

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
                            $bar = '<div class="progress mt-1" style="height: 20px; background-color: #c7c8d1;";> <div class="progress-bar" role="progressbar" style="width: ' . $pro . '%; background-color: #ffc107; " aria-valuenow="' . $pro . '" aria-valuemin="0" aria-valuemax="100">' . $pro . ' %</div></div>';
                            return $bar;
                        } else if ($pro > 75 and $pro < 100) {
                            $bar = '<div class="progress mt-1" style="height: 20px; background-color: #c7c8d1;";> <div class="progress-bar bg-success" role="progressbar" style="width: ' . $pro . '%; " aria-valuenow="' . $pro . '" aria-valuemin="0" aria-valuemax="100">' . $pro . ' %</div></div>';
                            return $bar;
                        } else if ($pro == 100) {
                            $bar = '<div class="progress mt-1" style="height: 20px; background-color: #c7c8d1;";> <div class="progress-bar bg-primary" role="progressbar" style="width: ' . $pro . '%; " aria-valuenow="' . $pro . '" aria-valuemin="0" aria-valuemax="100">' . $pro . ' %</div></div>';
                            return $bar;
                        }
                    }
                })->addColumn('status', function ($row) {
                    $pre = (((int)$row->realisasi / (int)$row->target)) * 100;
                    $pro = round($pre, 0);
                    $stat = $row->status;
                    // $this->statusBar($row->progress, $row->status);
                    if ($stat == "Dibatalkan") {
                        $stat = '<div class="d-flex flex-column"> <a class="btn btn-dark mr-1 btn-sm text-white">' . $stat . '</a></div>';
                        return $stat;
                    } else {
                        if (
                            $pro >= 0 and $pro <= 25
                        ) {
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
                })->filter(function ($instance) use ($request) {
                    if ($request->get('kpi') == '0' || $request->get('kpi') == '1') {
                        $instance->where('kpi', $request->get('kpi'));
                    }
                    if (!empty($request->get('search'))) {
                        $instance->where(function ($w) use ($request) {
                            $search = $request->get('search');
                            $w->orWhere('title', 'LIKE', "%$search%")
                                ->orWhere('content', 'LIKE', "%$search%")
                                ->orWhere('target_selesai', 'LIKE', "%$search%")
                                ->orWhere('status', 'LIKE', "%$search%")
                                ->orWhere('target', 'LIKE', "%$search%")
                                ->orWhere('realisasi', 'LIKE', "%$search%");
                        });
                    }
                })->rawColumns(['action', 'progress', 'status'])
                ->make(true);
        }

        return view('task.mytask');
    }
    public function TeamTask(Request $request)
    {
        // if (Auth::user()->jabatan != "Staff") {
        //     abort(403);
        // }

        $data = DB::table('posts')
            ->where('bagian', Auth::user()->bagian)
            ->select('user_id', 'name', DB::raw('count(user_id) as total'))
            ->selectRaw('SUM(status = "Selesai") as selesai')
            ->selectRaw('SUM(kpi = "0") as non')
            ->selectRaw('SUM(kpi = "1") as kpi')
            ->selectRaw('count(user_id) - SUM(status = "Selesai") as belum')
            ->groupBy('name')
            ->groupBy('user_id')->get();
        if ($request->ajax()) {
            // $data = DB::table('posts')
            //     ->where('jabatan', Auth::user()->jabatan)
            //     ->select('user_id', 'name', DB::raw('count(user_id) as total'))
            //     ->selectRaw('SUM(status = "Selesai") as selesai')
            //     ->selectRaw('count(user_id) - SUM(status = "Selesai") as belum')
            //     ->groupBy('name')
            //     ->groupBy('user_id')->get();
            return Datatables::of($data)
                ->addColumn('action', function ($row) {
                    $btn = ' <a href="' . route("detail.user", $row->user_id) . '"data-original-title="Detail" class="btn btn-primary mr-1 btn-sm detailProduct"><span class="fas fa-eye"></span></a>';

                    return $btn;
                })
                ->rawColumns(['action'])
                ->addIndexColumn()
                ->make(true);
        }

        return view('task.bagianTask');

        // return view('task.bagianTask2', compact('data'));
    }

    public function CompanyTask(Request $request)
    {
        // if (Auth::user()->jabatan != "Staff") {
        //     abort(403);
        // }

        if ($request->ajax()) {
            $data = DB::table('posts')
                ->select('bagian', DB::raw('count(bagian) as total'))
                ->selectRaw('SUM(status = "Selesai") as selesai')
                ->selectRaw('count(bagian) - SUM(status = "Selesai") as belum')
                ->where('bagian', '!=', '0')
                ->groupBy('bagian')
                ->groupBy('bagian')->get();
            return Datatables::of($data)
                ->addColumn('action', function ($row) {
                    // $link = "route('detail.show',$posts->user_id)";
                    $btn = ' <a href="' . route("detail.bagian", $row->bagian) . '"data-original-title="Detail" class="btn btn-primary mr-1 btn-sm detailProduct"><span class="fas fa-eye"></span></a>';

                    return $btn;
                })
                ->rawColumns(['action'])
                ->addIndexColumn()
                ->make(true);
        }

        return view('task.companyTask');
    }
    public function DivisionTask(Request $request, $bagian)
    {
        // if (Auth::user()->jabatan != "Staff") {
        //     abort(403);
        // }

        $data = DB::table('posts')
            ->where('bagian', $bagian)
            ->select('user_id', 'name', DB::raw('count(user_id) as total'))
            ->selectRaw('SUM(status = "Selesai") as selesai')
            ->selectRaw('SUM(kpi = "0") as non')
            ->selectRaw('SUM(kpi = "1") as kpi')
            ->selectRaw('count(user_id) - SUM(status = "Selesai") as belum')
            ->groupBy('name')
            ->groupBy('user_id')->get();
        if ($request->ajax()) {
            return Datatables::of($data)
                ->addColumn('action', function ($row) {
                    $btn = ' <a href="' . route("detail.user", $row->user_id) . '"data-original-title="Detail" class="btn btn-primary mr-1 btn-sm detailProduct"><span class="fas fa-eye"></span></a>';

                    return $btn;
                })
                ->rawColumns(['action'])
                ->addIndexColumn()
                ->make(true);
        }

        return view('task.bagiantask2');
    }
    public function DetailUser(Request $request, $user_id)
    {
        $user = User::where('uid', $user_id)->get();
        if ($request->ajax()) {

            $data = Post::where('user_id', $user_id)->latest();
            return Datatables::of($data)
                ->addIndexColumn()
                ->addColumn('action', function ($row) {
                    $id = $row->id;
                    $btn = ' <a href="javascript:void(0)" data-toggle="tooltip"  data-id="' . $id . '" data-original-title="Detail" class="btn btn-success mr-1 btn-sm detailProduct"><span class="fas fa-info"></span></a>';
                    return $btn;
                })->addColumn('target_selesai', function ($row) {
                    $date = date("d M Y", strtotime($row->target_selesai));
                    return $date;
                })->addColumn('kpi', function ($row) {
                    if ($row->kpi == "0") {
                        $kpi = "Tidak";
                        return $kpi;
                    } else {
                        $kpi = "Ya";
                        return $kpi;
                    }
                })->addColumn('progress', function ($row) {
                    $pre = (((int)$row->realisasi / (int)$row->target)) * 100;
                    $pro = round($pre, 0);
                    $stat = $row->status;

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
                            $bar = '<div class="progress mt-1" style="height: 20px; background-color: #c7c8d1;";> <div class="progress-bar" role="progressbar" style="width: ' . $pro . '%; background-color: #ffc107; " aria-valuenow="' . $pro . '" aria-valuemin="0" aria-valuemax="100">' . $pro . ' %</div></div>';
                            return $bar;
                        } else if ($pro > 75 and $pro < 100) {
                            $bar = '<div class="progress mt-1" style="height: 20px; background-color: #c7c8d1;";> <div class="progress-bar bg-success" role="progressbar" style="width: ' . $pro . '%; " aria-valuenow="' . $pro . '" aria-valuemin="0" aria-valuemax="100">' . $pro . ' %</div></div>';
                            return $bar;
                        } else if ($pro == 100) {
                            $bar = '<div class="progress mt-1" style="height: 20px; background-color: #c7c8d1;";> <div class="progress-bar bg-primary" role="progressbar" style="width: ' . $pro . '%; " aria-valuenow="' . $pro . '" aria-valuemin="0" aria-valuemax="100">' . $pro . ' %</div></div>';
                            return $bar;
                        }
                    }
                })->addColumn('status', function ($row) {
                    $pre = (((int)$row->realisasi / (int)$row->target)) * 100;
                    $pro = round($pre, 0);
                    $stat = $row->status;
                    // $this->statusBar($row->progress, $row->status);
                    if ($stat == "Dibatalkan") {
                        $stat = '<div class="d-flex flex-column"> <a class="btn btn-dark mr-1 btn-sm text-white">' . $stat . '</a></div>';
                        return $stat;
                    } else {
                        if (
                            $pro >= 0 and $pro <= 25
                        ) {
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
                })->filter(function ($instance) use ($request) {
                    if ($request->get('kpi') == '0' || $request->get('kpi') == '1') {
                        $instance->where('kpi', $request->get('kpi'));
                    }
                    if (!empty($request->get('search'))) {
                        $instance->where(function ($w) use ($request) {
                            $search = $request->get('search');
                            $w->orWhere('title', 'LIKE', "%$search%")
                                ->orWhere('content', 'LIKE', "%$search%")
                                ->orWhere('target_selesai', 'LIKE', "%$search%")
                                ->orWhere('status', 'LIKE', "%$search%")
                                ->orWhere('target', 'LIKE', "%$search%")
                                ->orWhere('realisasi', 'LIKE', "%$search%");
                        });
                    }
                })->rawColumns(['action', 'progress', 'status'])
                ->make(true);
        }

        return view('detail', compact('user'));
    }
    public function UserTask(Request $request, $user_id)
    {
        // $req = "CEK";
        // print_r($req);
        // exit();
        // $id = $request()->user_id;

        if ($request->ajax()) {

            $data = Post::where('user_id', $user_id)->latest()->get();
            // $data = Post::where('user_id', 1000000002)->latest()->get();
            return Datatables::of($data)
                ->addIndexColumn()
                ->addColumn('action', function ($row) {
                    $id = $row->id;
                    // $this->actionButton($row->id);
                    $btn = ' <a href="javascript:void(0)" data-toggle="tooltip"  data-id="' . $id . '" data-original-title="Detail" class="btn btn-success mr-1 btn-sm detailProduct"><span class="fas fa-info"></span></a>';

                    return $btn;
                })->addColumn('target_selesai', function ($row) {
                    $date = date("d M Y", strtotime($row->target_selesai));
                    return $date;
                })->addColumn('kpi', function ($row) {
                    if ($row->kpi == "0") {
                        $kpi = "Tidak";
                        return $kpi;
                    } else {
                        $kpi = "Ya";
                        return $kpi;
                    }

                    $date = date("d M Y", strtotime($row->target_selesai));
                    return $date;
                })->addColumn('progress', function ($row) {
                    $pre = (((int)$row->realisasi / (int)$row->target)) * 100;
                    $pro = round($pre, 0);
                    $stat = $row->status;
                    // $this->progressBar($row->progress, $row->status);

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
                })->addColumn('status', function ($row) {
                    $pre = (((int)$row->realisasi / (int)$row->target)) * 100;
                    $pro = round($pre, 0);
                    $stat = $row->status;
                    // $this->statusBar($row->progress, $row->status);
                    if ($stat == "Dibatalkan") {
                        $stat = '<div class="d-flex flex-column"> <a class="btn btn-dark mr-1 btn-sm text-white">' . $stat . '</a></div>';
                        return $stat;
                    } else {
                        if (
                            $pro >= 0 and $pro <= 25
                        ) {
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
                })
                ->rawColumns(['action', 'progress', 'status'])
                ->make(true);
        }
        return view('detail');
    }
    public function Team(Request $request)
    {
        if (Auth::user()->jabatan != "Staff") {
            abort(403);
        }

        if ($request->ajax()) {
            $data = Post::where('jabatan', Auth::user()->jabatan)->where('supervisi', Auth::user()->supervisi)->where('user_id', '!=', Auth::user()->uid)->latest()->get();
            return Datatables::of($data)
                ->addIndexColumn()
                ->addColumn('action', function ($row) {
                    $id = $row->id;
                    $btn = ' <a href="javascript:void(0)" data-toggle="tooltip"  data-id="' . $id . '" data-original-title="Detail" class="btn btn-success mr-1 btn-sm detailProduct"><span class="fas fa-info"></span></a>';

                    return $btn;
                })->addColumn('target_selesai', function ($row) {
                    $date = date("d M Y", strtotime($row->target_selesai));
                    return $date;
                })->addColumn('kpi', function ($row) {
                    if ($row->kpi == "0") {
                        $kpi = "Tidak";
                        return $kpi;
                    } else {
                        $kpi = "Ya";
                        return $kpi;
                    }

                    $date = date("d M Y", strtotime($row->target_selesai));
                    return $date;
                })->addColumn('progress', function ($row) {
                    $pre = (((int)$row->realisasi / (int)$row->target)) * 100;
                    $pro = round($pre, 0);
                    $stat = $row->status;
                    // $this->progressBar($row->progress, $row->status);

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
                })->addColumn('status', function ($row) {
                    $pre = (((int)$row->realisasi / (int)$row->target)) * 100;
                    $pro = round($pre, 0);
                    $stat = $row->status;
                    // $this->statusBar($row->progress, $row->status);
                    if ($stat == "Dibatalkan") {
                        $stat = '<div class="d-flex flex-column"> <a class="btn btn-dark mr-1 btn-sm text-white">' . $stat . '</a></div>';
                        return $stat;
                    } else {
                        if (
                            $pro >= 0 and $pro <= 25
                        ) {
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
                })->rawColumns(['action', 'progress', 'status'])
                ->make(true);
        }

        return view('role.index');
    }
    public function History()
    {
        if (Auth::user()->level == '01') {
            // $posts = Post::where('user_id', '!=', Auth::user()->id)->where('bagian', Auth::user()->bagian)->where('jabatan', Auth::user()->jabatan)->latest()->paginate(5);
            $posts = Post::where('status', 'Selesai')->orderBy('tanggal_selesai', 'desc')->get();
        } else {
            $posts = Post::where('bagian', Auth::user()->bagian)->where('status', 'Selesai')->orderBy('tanggal_selesai', 'desc')->get();
        }

        return view('history', compact('posts'));
    }
    public function List(Request $request)
    {
        if (

            Auth::user()->jabatan != "Kabag" and
            Auth::user()->jabatan != "Vp"
        ) {
            abort(403);
        }

        if ($request->ajax()) {

            $data = User::where('bagian', Auth::user()->bagian)->where('id', '!=', Auth::user()->id)->orderBy('jabatan', 'desc')->get();
            return Datatables::of($data)
                ->addIndexColumn()
                ->addColumn('action', function ($row) {

                    $btn = ' <a href="javascript:void(0)" data-toggle="tooltip"  data-id="' . $row->id . '" data-original-title="Detail" class="btn btn-success mr-1 btn-sm detailProduct"><span class="fas fa-info"></span></a>';

                    return $btn;
                })->addColumn('target_selesai', function ($row) {
                    $date = date("d M Y", strtotime($row->target_selesai));
                    return $date;
                })
                ->rawColumns(['action'])
                ->make(true);
        }
        return view('role.list');
    }
    public function List2(Request $request)
    {
        if (
            Auth::user()->jabatan != "Vp"
        ) {
            abort(403);
        }
        if ($request->ajax()) {

            $data = User::where('id', '!=', Auth::user()->id)->where('jabatan', '!=', "Admin")->orderBy('level', 'asc')->get();
            return Datatables::of($data)
                ->addIndexColumn()
                ->make(true);
        }
        return view('role.list2');
    }
    public function changePassword()
    {
        return view('changePassword');
    }
    /**
     * @param UpdatePasswordRequest $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function Update(UpdatePasswordRequest $request)
    {
        $request->user()->update([
            'password' => bcrypt($request->get('password'))
        ]);

        return redirect()->route('password.edit');
    }
    public function Show(Request $request)
    {

        $request->route('detail');
        $data = Post::where('user_id', 8)->latest()->get();
        if ($request->ajax()) {
            return Datatables::of($data)
                ->addIndexColumn()
                ->addColumn('action', function ($row) {

                    $btn = ' <a href="javascript:void(0)" data-toggle="tooltip"  data-id="' . $row->id . '" data-original-title="Detail" class="btn btn-success mr-1 btn-sm detailProduct"><span class="fas fa-info"></span></a>';
                    $btn  = $btn .  '<a href="javascript:void(0)" data-toggle="tooltip"  data-id="' . $row->id . '" data-original-title="Edit"  class=" edit btn btn-primary btn-sm editProduct"><span class="fas fa-pen"></span></a>';
                    $btn = $btn . ' <a href="javascript:void(0)" data-toggle="tooltip"  data-id="' . $row->id . '" data-original-title="Delete" class="btn btn-danger btn-sm deleteProduct"><span class="fas fa-trash"></span></a>';


                    return $btn;
                })->addColumn('target_selesai', function ($row) {
                    $date = date("d M Y", strtotime($row->target_selesai));
                    return $date;
                })
                ->addColumn('progress', function ($row) {
                    $pro = $row->progress;
                    if ($row->status == "Dibatalkan") {
                        $bar = '<div class="progress mt-1" style="height: 20px; background-color: #c7c8d1;";> <div class="progress-bar bg-dark" role="progressbar" style="width: ' . $row->progress . '%; " aria-valuenow="' . $row->progress . '" aria-valuemin="0" aria-valuemax="100">' . $row->progress . ' %</div></div>';
                        return $bar;
                    } else {
                        if ($pro >= 0 and $pro <= 25) {
                            $bar = '<div class="progress mt-1" style="height: 20px; background-color: #c7c8d1;";> <div class="progress-bar bg-danger" role="progressbar" style="width: ' . $row->progress . '%; " aria-valuenow="' . $row->progress . '" aria-valuemin="0" aria-valuemax="100">' . $row->progress . ' %</div></div>';
                            return $bar;
                        } else if ($pro > 25 and $pro <= 50) {
                            $bar = '<div class="progress mt-1" style="height: 20px; background-color: #c7c8d1;";> <div class="progress-bar"  role="progressbar" style="width: ' . $row->progress . '%; background-color: #f05716;" aria-valuenow="' . $row->progress . '" aria-valuemin="0" aria-valuemax="100">' . $row->progress . ' %</div></div>';
                            return $bar;
                        } else if ($pro > 50 and $pro <= 75) {
                            $bar = '<div class="progress mt-1" style="height: 20px; background-color: #c7c8d1;";> <div class="progress-bar bg-warning" role="progressbar" style="width: ' . $row->progress . '%; " aria-valuenow="' . $row->progress . '" aria-valuemin="0" aria-valuemax="100">' . $row->progress . ' %</div></div>';
                            return $bar;
                        } else if ($pro > 75 and $pro < 100) {
                            $bar = '<div class="progress mt-1" style="height: 20px; background-color: #c7c8d1;";> <div class="progress-bar bg-success" role="progressbar" style="width: ' . $row->progress . '%; " aria-valuenow="' . $row->progress . '" aria-valuemin="0" aria-valuemax="100">' . $row->progress . ' %</div></div>';
                            return $bar;
                        } else if ($pro == 100) {
                            $bar = '<div class="progress mt-1" style="height: 20px; background-color: #c7c8d1;";> <div class="progress-bar bg-primary" role="progressbar" style="width: ' . $row->progress . '%; " aria-valuenow="' . $row->progress . '" aria-valuemin="0" aria-valuemax="100">' . $row->progress . ' %</div></div>';
                            return $bar;
                        }
                    }
                })->addColumn('status', function ($row) {
                    $pro = $row->progress;
                    if ($row->status == "Dibatalkan") {
                        $stat = '<div class="d-flex flex-column"> <a class="btn btn-dark mr-1 btn-sm text-white">' . $row->status . '</a></div>';
                        return $stat;
                    } else {
                        if ($pro >= 0 and $pro <= 25) {
                            $stat = '<div class="d-flex flex-column"> <a class="btn btn-danger mr-1 btn-sm text-white">' . $row->status . '</a></div>';
                            return $stat;
                        } else if ($pro > 25 and $pro <= 50) {
                            $stat = '<div class="d-flex flex-column"> <a class="btn mr-1 btn-sm text-white" style="background-color: #f05716;">' . $row->status . '</a></div>';
                            return $stat;
                        } else if ($pro > 50 and $pro <= 75) {
                            $stat = '<div class="d-flex flex-column"> <a class="btn btn-warning mr-1 btn-sm text-white ">' . $row->status . '</a></div>';
                            return $stat;
                        } else if ($pro > 75 and $pro < 100) {
                            $stat = '<div class="d-flex flex-column"> <div class="btn btn-success mr-1 btn-sm text-white">' . $row->status . '</div></div>';
                            return $stat;
                        } else if ($pro == 100) {
                            $stat = '<div class="d-flex flex-column"> <div class="btn btn-primary mr-1 btn-sm text-white">' . $row->status . '</div></div>';
                            return $stat;
                        }
                    }
                })
                ->rawColumns(['action', 'progress', 'status'])
                ->make(true);
        }

        return view('detail', compact('data'));
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
