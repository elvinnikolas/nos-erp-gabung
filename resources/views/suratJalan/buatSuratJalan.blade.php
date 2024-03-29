@extends('index')
@section('content')
<style type="text/css">
    form{
        margin: 20px 0;
    }
    form input, button{
        padding: 5px;
    }
    table{
        width: 100%;
        margin-bottom: 20px;
        border-collapse: collapse;
    }
    table, th, td{
        border: 1px solid #cdcdcd;
    }
    table th, table td{
        padding: 10px;
        text-align: left;
    }
</style>
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="x_panel">
                <div class="x_title">
                    <h1>Surat Jalan</h1>
                </div>
                <div class="x_content">
                    <form action="/suratJalan/store/{{$id}}" method="post" class="formsub">
                        @csrf

                        <!-- Contents -->
                        <br>
                        <div class="form-row">
                            <!-- column 1 -->
                            <div class="form-group col-md-3">
                                <div class="form-group">
                                    <label for="">No S.O</label>
                                    <select name="KodeSO" class="form-control" id="KodeSO" onchange="refresh(this)">
                                        @foreach($pemesananpenjualan as $data)
                                            @if($data->KodeSO == $id)
                                                <option selected="selected" value="{{$data->KodeSO}}">{{$data->KodeSO}}</option>
                                            @else
                                                <option value="{{$data->KodeSO}}">{{$data->KodeSO}}</option>
                                            @endif
                                            
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="inputDate">Tanggal</label>
                                    <input type="date" class="form-control" name="Tanggal" id="inputDate" required="required">
                                </div>
                                <div class="form-group">
                                    <label for="inputBerlaku">Alamat</label>
                                    <input type="text" class="form-control" name="Alamat" id="inputBerlaku" required="required">
                                </div>
                                <div class="form-group">
                                    <label for="inputTerm">Sopir</label>
                                    <select name="KodeSopir" class="form-control" id="KodeSO" onchange="refresh(this)">
                                        @foreach($drivers as $data)
                                            <option selected="selected" value="{{$data->IDKaryawan}}">{{$data->Nama}}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="inputMatauang">Mata Uang</label>
                                    <select class="form-control" name="KodeMataUang" id="inputMatauang" placeholder="Pilih mata uang">
                                        @foreach($matauang as $mu)
                                        <option value="{{$mu->KodeMataUang}}">{{$mu->NamaMataUang}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <!-- pembatas -->
                            <div class="form-group col-md-1"></div>
                            <!-- column 2 -->
                            <div class="form-group col-md-4">
                                <div class="form-group">
                                    <label for="inputPO">No Polisi</label>
                                    <input type="text" class="form-control" name="nopol" required="required">
                                </div>
                                <div class="form-group">
                                    <label for="inputGudang">Gudang</label>
                                    <select class="form-control" name="KodeLokasi" id="inputGudang">
                                        @foreach($lokasis as $lok)
                                        <option value="{{$lok->KodeLokasi}}">{{$lok->NamaLokasi}}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="inputPelanggan">Pelanggan</label>
                                    <select class="form-control" name="KodePelanggan" id="inputPelanggan">
                                        @foreach($pelanggans as $pel)
                                        <option value="{{$pel->KodePelanggan}}">{{$pel->NamaPelanggan}}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="inputPelanggan">Diskon</label>
                                    <input type="number" readonly="readonly" class="diskon form-control diskon" name="diskon" id="inputBerlaku" value="{{$so->Diskon}}" >
                                </div>
                                <div class="form-group">
                                    <label for="inputPelanggan">PPn</label>
                                    <input type="text" readonly="readonly" class="diskon form-control ppn" name="ppn" id="inputBerlaku" value="{{$so->PPN}}" >
                                </div>
                            </div>
                            <!-- pembatas -->
                            <div class="form-group col-md-1"></div>
                            <!-- column 3 -->
                            <!-- <div class="form-group col-md-3">
                                <label for="inputKeterangan">Keterangan</label>
                                <textarea class="form-control" name="Keterangan" id="inputKeterangan" rows="5"></textarea>
                                <br><br>
                            </div> -->
                        </div>
                        <div class="form-row">
                            <div class="form-group col-md-12">
                                <table id="items">
                                    <tr>
                                        <td>nama barang</td>
                                        <td>qty</td>
                                        <td>satuan</td>
                                        <td>harga</td>
                                        <td>keterangan</td>
                                        <td>total</td>
                                    </tr>
                                    @foreach($items as $key => $data)
                                    <tr class="rowinput">
                                        <td>
                                            <input type="text" readonly="readonly" value="{{$data->NamaItem}}">
                                            <input type="hidden" readonly="readonly" name="item[]" value="{{$data->KodeItem}}">
                                        </td>
                                        <td>
                                            <input type="number" onchange="qty({{$key+1}})" name="qty[]" class="form-control qty{{$key+1}} qtyj" required="" value="{{$data->jml}}">
                                            <input type="hidden" class="max{{$key+1}}" value="{{$data->jml}}">
                                        </td>
                                        <td>
                                            {{$data->NamaSatuan}}
                                        </td>
                                        <td>
                                            <input readonly="" type="text" name="price[]" class="form-control price{{$key+1}}" required="" value="{{$data->HargaJual}}">
                                        </td>
                                        <td>
                                            {{$data->Keterangan}}
                                        </td>
                                        <td>
                                            <input readonly="" type="text" name="total[]" class="form-control total{{$key+1}}" required="" value="{{$data->HargaJual * $data->jml}}">
                                        </td>
                                    </tr>
                                    @endforeach
                                    
                                </table>
                                <div class="col-md-9">
                                    <button type="submit" class="btn btn-success">Simpan</button>
                                    <button type="submit" class="btn btn-danger">Batal</button>
                                </div>
                                <div class="col-md-3">
                                    <label for="inputPelanggan">Subtotal</label>
                                    <input type="hidden" value="{{sizeof($items)}}" name="" class="tot">
                                    <input type="text" readonly="" class="form-control befDis" id="inputBerlaku" placeholder="">
                                    <label for="inputPelanggan">Nilai PPN</label>
                                    <input type="text" readonly="" name="ppnval" class="ppnval form-control">
                                    <input type="hidden" name="diskonval" class="diskonval ">
                                    <label for="inputPelanggan">Total</label>
                                    <input type="text" readonly="" class="form-control subtotal" name="subtotal" id="inputBerlaku" placeholder="">
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<script type="text/javascript">
    
    function refresh(val){
        var base ="{{ url('/') }}"+"/suratJalan/create/"+val.value;
        window.location.href = base;
    }

    updatePrice($(".tot").val());

    function updatePrice(tot){

        $(".subtotal").val(0);
        var diskon=0;
        if($(".diskon").val()!=""){
            diskon = parseInt($(".diskon").val());
        }
        for(var i=1; i<=tot;i++){
            if($(".total"+i).val()!=undefined){
                $(".subtotal").val(parseInt($(".subtotal").val())+parseInt($(".total"+i).val()));
            }
        }
        var befDis = $(".subtotal").val();
        diskon = parseInt($(".subtotal").val())*diskon/100;
        $(".subtotal").val(parseInt($(".subtotal").val())-diskon);
        var ppn =$(".ppn").val();
        if(ppn=="ya"){
            ppn = parseInt(befDis)*10/100;
        }
        $(".ppnval").val(ppn);
        $(".diskonval").val(diskon);
        $(".befDis").val(parseInt($(".subtotal").val()));
        $(".subtotal").val(parseInt($(".subtotal").val())+ppn);
    }

    function qty(int){
        var qty =$(".qty"+int).val();
        var max =$(".max"+int).val();
        if(parseInt(qty)>parseInt(max)){
            $(".qty"+int).val(max);
        }
        var qty =$(".qty"+int).val();
        var price =$(".price"+int).val();
        $(".total"+int).val(price*qty);
        var count =$(".tot").val();
        updatePrice(count);
    }

    $('.formsub').submit(function(event){
        tot = $(".tot").val();
        for (var i = 1; i <= tot; i++) {
            if (typeof $(".qty"+i).val()=== 'undefined'){
            }else{
                if ($(".qty"+i).val() == 0){
                    event.preventDefault();
                    $(".qty"+i).focus();
                }
            }
            
        }
        
    });
</script>
@endsection