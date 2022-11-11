@extends('layout.template')
<!-- START FORM -->
@section('konten') 

<form action='{{ url('useratm') }}' method='post'>
@csrf 
<div class="my-3 p-3 bg-body rounded shadow-sm">
    <a href='{{ url('useratm') }}' class="btn btn-secondary"><< kembali</a>
    <div class="mb-3 row">
        <label for="norek" class="col-sm-2 col-form-label">No.Rek</label>
        <div class="col-sm-10">
            <input type="number" class="form-control" name='norek' value="{{ Session::get('norek') }}" id="norek">
        </div>
    </div>
    <div class="mb-3 row">
        <label for="nama" class="col-sm-2 col-form-label">Nama</label>
        <div class="col-sm-10">
            <input type="text" class="form-control" name='nama' value="{{ Session::get('nama') }}" id="nama">
        </div>
    </div>
    <div class="mb-3 row">
        <label for="atmbank" class="col-sm-2 col-form-label">ATM Bank</label>
        <div class="col-sm-10">
            <input type="text" class="form-control" name='atmbank' value="{{ Session::get('atmbank') }}" id="atmbank">
        </div>
    </div>
    <div class="mb-3 row">
        <label for="atmbank" class="col-sm-2 col-form-label"></label>
        <div class="col-sm-10"><button type="submit" class="btn btn-primary" name="submit">SIMPAN</button></div>
    </div>
</div>
</form>
<!-- AKHIR FORM -->
@endsection