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
                    <form action="/suratJalan/confirm/{{$id}}" method="post">
                        @csrf
                        <!-- Contents -->
                        <br>
                        <div class="form-row">
                            <!-- column 1 -->
                            <div class="form-group col-md-3">
                                <div class="form-group">
                                    <label for="">No S.O</label>
                                    <input type="text" class="form-control" name="Expired" readonly="readonly" value="{{$suratjalan->KodeSO}}" id="inputBerlaku">
                                </div>
                                <div class="form-group">
                                    <label for="inputDate">Tanggal</label>
                                    <input type="date" class="form-control" name="Tanggal" id="inputDate" readonly="readonly" value="{{$suratjalan->Tanggal}}">
                                </div>
                                <div class="form-group">
                                    <label for="inputBerlaku">Alamat</label>
                                    <input type="text" class="form-control" name="Alamat" id="inputBerlaku" readonly="readonly" value="{{$suratjalan->Alamat}}">
                                </div>
                                <div class="form-group">
                                    <label for="inputTerm">Sopir</label>
                                    <input type="text" class="form-control" name="KodeSopir" id="inputBerlaku" readonly="readonly" value="{{$driver->Nama}}">
                                </div>
                                <div class="form-group">
                                    <label for="inputMatauang">Mata Uang</label>
                                    <input type="text" class="form-control" name="KodeSopir" id="inputBerlaku" readonly="readonly" value="{{$matauang->NamaMataUang}}">
                                </div>
                            </div>
                            <!-- pembatas -->
                            <div class="form-group col-md-1"></div>
                            <!-- column 2 -->
                            <div class="form-group col-md-4">
                                <div class="form-group">
                                    <label for="inputPO">No Polisi</label>
                                    <input type="text" class="form-control" name="nopol" readonly="readonly" value="{{$suratjalan->Nopol}}">
                                </div>
                                <div class="form-group">
                                    <label for="inputGudang">Gudang</label>
                                    <input type="text" class="form-control" name="KodeLokasi" readonly="readonly" value="{{$lokasi->NamaLokasi}}">
                                </div>
                                <div class="form-group">
                                    <label for="inputPelanggan">Pelanggan</label>
                                    <input type="text" class="form-control" name="KodePelanggan" readonly="readonly" value="{{$pelanggan->KodePelanggan}}">
                                </div>
                                <div class="form-group">
                                    <label for="inputPelanggan">Diskon</label>
                                    <input type="number" readonly="readonly" class="diskon form-control diskon" name="diskon" id="inputBerlaku" value="{{$suratjalan->Diskon}}" >
                                </div>
                                <div class="form-group">
                                    <label for="inputPelanggan">PPn</label>
                                    <input type="text" readonly="readonly" class="diskon form-control ppn" name="ppn" id="inputBerlaku" value="{{$suratjalan->PPN}}" >
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
                                            <input type="text" readonly="readonly" name="item[]" value="{{$data->NamaItem}}">
                                        </td>
                                        <td>
                                            <input type="number" readonly="readonly" onchange="qty({{$key+1}})" name="qty[]" class="form-control qty{{$key+1}}" required="" value="{{$data->jml}}">
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
                                    <a href="{{ url('/suratJalan/print/'.$id) }}"><button type="button" class="btn btn-primary"><i class="fa fa-print"></i></button></a>
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
</script>
@endsection