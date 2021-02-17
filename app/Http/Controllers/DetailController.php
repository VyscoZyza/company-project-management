<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;
use App\Models\Post;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use DataTables;


class DetailController extends Controller
{
    private $uid = 4;

    public function show(Request $request)
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
    public function index(Request $request)
    {
        // $task = Post::where('user_id', Auth::id())->latest()->get();
        // $detail = $this->uid;

        if ($request->ajax()) {
            $request->route('detail');
            $data = Post::where('user_id', $request->get('detail'))->latest()->get();
            return Datatables::of($data)
                ->addIndexColumn()
                ->addColumn('action', function ($row) {

                    $btn = ' <a href="javascript:void(0)" data-toggle="tooltip"  data-id="' . $row->id . '" data-original-title="Detail" class="btn btn-success mr-1 btn-sm detailProduct"><span class="fas fa-info"></span></a>';


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

        return view('detail');
    }
    public function edit($id)
    {
        $post = Post::find($id);
        return response()->json($post);
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
