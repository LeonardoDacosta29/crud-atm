<?php

namespace App\Http\Controllers;

use App\Models\useratm;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\DB;

class useratmController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $katakunci = $request->katakunci;
        $jumlahbaris = 5;
        if (strlen($katakunci)) {
            $data = useratm::where('norek', 'like', "%$katakunci%")
                ->orWhere('nama', 'like', "%$katakunci%")
                ->orWhere('atmbank', 'like', "%$katakunci%")
                ->paginate($jumlahbaris);
        } else {
            $data = useratm::orderBy('norek', 'desc')->paginate($jumlahbaris);
        }
        return view('useratm.index')->with('data', $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('useratm.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        Session::flash('norek', $request->norek);
        Session::flash('nama', $request->nama);
        Session::flash('atmbank', $request->atmbank);

        $request->validate([
            'norek' => 'required|numeric|unique:useratm,norek',
            'nama' => 'required',
            'atmbank' => 'required',
        ],[
            'norek.required' => 'No.Rek wajib diisi',
            'norek.numeric' => 'No.Rek wajib dalam angka',
            'norek.unique' => 'No.Rek yang diisikan sudah ada dalam database',
            'norek.required' => 'Nama wajib diisi',
            'atmbank.required' => 'ATM Bank wajib diisi',
        ]);

        DB::beginTransaction();

        try{
            $data = [
                'norek' => $request->norek,
                'nama' => $request->nama,
                'atmbank' => $request->atmbank,

            ];
            useratm::create($data);
            DB::commit();
            return redirect()->to('useratm')->with('success', 'Berhasil menambahkan data');
        }catch(\Throwable $th){
            DB::rollBack();
            return 'Eror Mas Bro!!';
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $data = useratm::where('norek', $id)->first();
        return view('useratm.edit')->with('data', $data);
    }

    /**
     * the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'nama' => 'required',
            'atmbank' => 'required',
        ], [
            'nama.required' => 'Nama wajib diisi',
            'atmbank.required' => 'ATM Bank wajib diisi',
        ]);
        $data = [
            'nama' => $request->nama,
            'atmbank' => $request->jurusan,
        ];
        useratm::where('norek', $id)->update($data);
        return redirect()->to('useratm')->with('success', 'Berhasil melakukan update data');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        useratm::where('norek', $id)->delete();
        return redirect()->to('useratm')->with('success', 'Berhasil melakukan delete data');
    }
}
