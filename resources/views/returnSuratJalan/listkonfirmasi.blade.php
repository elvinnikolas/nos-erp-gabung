@extends('index')
@section('content')
<style>
    .btn {
      background-color: DodgerBlue;
      border: none;
      color: white;
      padding: 12px 16px;
      font-size: 16px;
      cursor: pointer;
    }

    /* Darker background on mouse-over */
    .btn:hover {
      background-color: RoyalBlue;
    }
    </style>
 <div class="container">
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0 text-dark">Konfirmasi Surat Jalan Return</h1>
          </div>
          <!-- /.col -->
        </div>
        <!-- /.row -->
      </div>
      <!-- /.container-fluid -->
    </div>

    <div class="card">
      <div class="card-header">
        <form>
          <!-- <button class="btn btn-success">
                    <i class="fas fa-plus">&nbsp;&nbsp;Tambah Data P.O</i>
          </button>-->

          <!-- Contents -->
          <br>
          <div class="form-row">
            <!-- column 1 -->
            <div class="">
              <input
                class="form-control form-control-navbar"
                type="search"
                placeholder="Cari Nomor S.O"
                aria-label="Search"
              >
            </div>
          </div>
          <hr class="style1">
          <div class="form-row">
            <table class="table table-bordered">
              <thead>
                <tr>
                  <th scope="col">Nomor SJR</th>
                  <th scope="col">Tanggal</th>
                  <th scope="col">Action</th>
                </tr>
              </thead>
              <tbody>
                  @foreach ($suratjalanreturns as $suratjalan)
                    <tr>
                        <td>{{ $suratjalan->KodeSuratJalanReturn}}</td>
                        <td>{{ $suratjalan->Tanggal }}</td>
                        <td>
                            <a href="{{ url('/returnSuratJalan/view/'.$suratjalan->KodeSuratJalanReturnId ) }}" class="btn-sm btn btn-primary">
                                <i class="fa fa-eye" aria-hidden="true"></i>
                            </a>
                        </td>
                    </tr>
                  @endforeach
              </tbody>
            </table>
          </div>
        </form>
      </div>
    </div>
    <!-- Button trigger modal -->


    </div>
  </div>
@endsection
