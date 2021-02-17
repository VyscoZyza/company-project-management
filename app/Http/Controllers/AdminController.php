<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;
use App\Models\Post;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use DataTables;


class AdminController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('role')->only(['index']);
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index(Request $request)
    {
        // $task = Post::where('user_id', Auth::id())->latest()->get();
        if ($request->ajax()) {
            $data = User::where('jabatan', '!=', 'Admin')->latest()->get();
            return Datatables::of($data)
                ->addIndexColumn()
                ->addColumn('action', function ($row) {


                    $btn  =  '<a href="javascript:void(0)" data-toggle="tooltip"  data-id="' . $row->id . '" data-original-title="Edit"  class=" edit btn btn-primary btn-sm editProduct"><span class="fas fa-pen"></span></a>';
                    $btn = $btn . ' <a href="javascript:void(0)" data-toggle="tooltip"  data-id="' . $row->id . '" data-original-title="Delete" class="btn btn-danger btn-sm deleteProduct"><span class="fas fa-trash"></span></a>';


                    return $btn;
                })
                ->rawColumns(['action'])
                ->make(true);
        }

        return view('admin.index');
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // $todayDate = Carbon::now();
        if ($request->password == "") {
            User::updateOrCreate(
                ['id' => $request->id],
                [
                    'name' => $request->name,
                    'email' => $request->email,
                    'bidang' => $request->bidang,
                    'bagian' => $request->bagian,
                    'supervisi' => $request->supervisi,
                    'jabatan' => $request->jabatan,
                ]

            );
            return response()->json(['success' => 'Berhasil disimpan.']);
        } else if (strlen($request->password) > "5" and $request->password == $request->cpassword) {
            $val = bcrypt($request->password);
            User::updateOrCreate(
                ['id' => $request->id],
                [
                    'name' => $request->name,
                    'email' => $request->email,
                    'bidang' => $request->bidang,
                    'bagian' => $request->bagian,
                    'supervisi' => $request->supervisi,
                    'jabatan' => $request->jabatan,
                    'password' => $val,

                ]
            );
            return response()->json(['success' => 'Berhasil disimpan.']);
        } else {
            return Redirect::back()->with('error', 'Operation Successful !');
        }
    }
    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $user = User::find($id);
        return response()->json($user);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        User::find($id)->delete();

        return response()->json(['success' => 'Berhasil dihapus.']);
    }
}
