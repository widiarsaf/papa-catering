@extends('layouts.template')

@section('title')
<div>
	<h2>Detail Pemesanan</h2>
</div>
@endsection

@section('content')
@include('layouts.errorAlert')
<div class="row">
    <div class="col-8">
        {{-- Search dan Button --}}
        <div class="row my-3">
            <form class="d-flex col-9">
                <input class="form-control mr-2" type="search" placeholder="Cari Produk" aria-label="Search">
                <button class="btn btn-primary" type="submit"><i class="fa fa-search"></i></button>
            </form>
            <button class="btn btn-primary col-3">Tambah Custom</button>
        </div>
        
        {{-- Navigasi --}}
        <ul class="nav nav-pills mb-3 text-center" id="pills-tab" role="tablist">
            <li class="nav-item col-4">
                <a class="nav-link active" id="pills-kue-asin-tab" data-toggle="pill" href="#pills-kue-asin" role="tab" aria-controls="pills-kue-asin" aria-selected="true" style="border:1px solid #007BFF;border-radius:30px">Kue Asin</a>
            </li>
            <li class="nav-item col-4">
                <a class="nav-link" id="pills-kue-manis-tab" data-toggle="pill" href="#pills-kue-manis" role="tab" aria-controls="pills-kue-manis" aria-selected="false" style="border:1px solid #007BFF;border-radius:30px">Kue Manis</a>
            </li>
            <li class="nav-item col-4">
                <a class="nav-link" id="pills-kotak-tab" data-toggle="pill" href="#pills-kotak" role="tab" aria-controls="pills-kotak" aria-selected="false" style="border:1px solid #007BFF;border-radius:30px">Kotak</a>
            </li>
        </ul>
        
        {{-- Content --}}
        <div class="tab-content" id="pills-tabContent">
            <div class="tab-pane fade show active" id="pills-kue-asin" role="tabpanel" aria-labelledby="pills-kue-asin-tab">
                <div class="row">
                    @foreach($products as $product)
                        @if($product->kategori == "Kue Asin" && $product->varian == "Normal")                        
                        <div class="col-4">
                            <div class="card">
                                <div class="card-body">
                                    <h5 class = "mb-3"><b>{{ $product->nama }}</b></h5>
                                    <div class="row">
                                        <div class="col-7">
                                            <h5>Normal: {{ $product->harga_satuan }}</h5><br>
                                        </div>
                                        <div class="col-5">
                                            <button class="btn btn-outline-primary mx-1" style="width:90px;border-radius:10px"
                                            onClick="AddToCart('{{$product->id}}', '{{$product->nama}}', 'normal', '{{$product->harga_satuan}}' )">Normal</button>
                                        </div>
                                    </div>
                                    @continue
                        @elseif($product->kategori == "Kue Asin" && $product->varian == "Mini") 
                                
                                    <div class="row">
                                        <div class="col-7">
                                            <h5>Mini: {{ $product->harga_satuan }}</h5>                                    
                                        </div>
                                        <div class="col-5">
                                            <button class="btn btn-outline-primary mx-1" style="width:90px;border-radius:10px" 
                                            onClick= "AddToCart('{{$product->id}}', '{{$product->nama}}', 'mini', '{{$product->harga_satuan}}')">Mini</button>
                                        </div>
                                    </div>                       
                                </div>
                            </div>
                        </div>
                        @endif
                    @endforeach
                </div>
            </div>
            <div class="tab-pane fade" id="pills-kue-manis" role="tabpanel" aria-labelledby="pills-kue-manis-tab">
                
            </div>
            <div class="tab-pane fade" id="pills-kotak" role="tabpanel" aria-labelledby="pills-kotak-tab">            
            </div>
        </div>        
    </div>
    <div class="col-4">
        <div class="card my-3">
            <div class="card-header text-center" style="background-color:#0B4075;color:white">
                <h4>Keranjang Belanja</h4>
            </div>
            <div class="card-body">
                <div>
                    <h5 class="font-weight-bold">Pesanan</h5>
                    <table class="my-3" id= "cobaTabel">
                    </table>
                </div>
            </div>
        </div>
        
        <div class="card">
            <div class="card-body">
                <h5 class="font-weight-bold">Metode Pengiriman</h5>
                <select name="metode_pengiriman" class="form-control">            
                    <option value="Diantar" selected>Diantar</option>
                    <option value="Diambil">Diambil</option>            
                </select> 
            </div>
        </div>

        <div class="card">
            <div class="card-body">
                <h5 class="font-weight-bold">Pesan dari Customer</h5>
                <textarea name="keterangan" placeholder="Masukkan pesan di sini" style="width:100%;height:100px" class="form-control"></textarea>
            </div>
        </div>

        <div class="card">
            <div class="card-body">
                <h5 class="font-weight-bold">Pesan dari Customer</h5>
                <textarea name="keterangan" placeholder="Masukkan pesan di sini" style="width:100%;height:100px" class="form-control"></textarea>
            </div>
        </div>

        <div class="card">
            <div class="card-body">
                <h5 class="font-weight-bold">Total Harga Pesanan:</h5>
                <p style="font-size:50px" class="text-center">
                    Rp 52000
                </p>
            </div>
        </div>

        <div class="text-center">
            <form action="{{route('storeFromCart')}}" method="POST" class = "hidden" >
                @csrf
                <input type="hidden" class = "sendId" id = "sendId" name="id[]">
                <button class="btn btn-primary" style="width:45%">Simpan</button>
            </form>
            {{-- <button class="btn btn-outline-primary mr-3" style="width:45%">Batalkan</button>
            <button class="btn btn-primary" style="width:45%">Simpan</button> --}}
        </div>
    </div>
</div>




{{--
<form action="{{ route('orderDetail.store') }}" method="POST">
    @csrf
    <input type="number" name="order_id" value="{{ $order->id }}" hidden>  
    <div class="form-group">
        <label>Produk</label>
        <select name="product_id" class="form-control">            
            @foreach ($products as $product)                                
                <option value="{{ $product->id }}">{{ $product->nama }}</option>                                
            @endforeach            
        </select>
    </div>
    <div class="form-group">
        <label>Kuantitas</label>
        <input type="number" class="form-control" name="kuantitas">        
    </div>
    <div class="form-group">
        <label>Metode Pengiriman</label>
        <select name="metode_pengiriman" class="form-control">            
            <option value="Diantar">Diantar</option>
            <option value="Diambil">Diambil</option>            
        </select>        
    </div>    
    <div class="form-group">
        <label>Pesan dari Customer</label>
        <textarea class="form-control" rows="3" name="pesan_customer" placeholder="Masukkan pesan"></textarea>
    </div>
    <a href="{{ route('kasir.index') }}"><button type="button" class="btn btn-outline-primary">Kembali</button></a>
    <button type="submit" class="btn btn-primary">Simpan Pesanan</button>
</form>
--}}

<script>
    var items = []
    function AddToCart(id, nama, size, price){
        let parent = document.getElementById('cobaTabel');
        parent.innerHTML += `
            <tr>
                <td class="pr-2">${nama} ${size} </td>
                <td class="px-2"><input type="number" onclick = 'updateQty(${id})' name="kuantitas" value="10" style="width:60px"
                        class="form-control text-center"></td>
                <td class="px-2">Rp. ${price}</td>
                <td class="pl-2"><a class="btn btn-danger" onclick = 'deleteFromCart(${id})'><i class="fa fa-trash"></i></a></td>
            </tr>
        
        `
        // Add to hidden form
        // let sendId = document.getElementById('sendId')
        // items.push({id:id, qty:1});
        // console.log(items);

        // let jsonObj = {}
        // for (let i=0; i < items.length; i++) { 
        //     if (items[i] !==undefined) {
        //          jsonObj[i]=items[i] 
        //     }
        // }s

        // // console.log(jsonObj);
        // sendId.value = items;


        // Using object
        let newData = [[id, 1]];
        items = items.concat(newData)
        console.log(items);
        // let object = JSON.parse(items)
        // console.log(object)
        let sendId = document.getElementsByName('name=id[]')
        sendId.value = items;
        console.log(" " + sendId.value)
        // return sendId.value;




        // console.log(sendId.value);
    }

    function deleteFromCart(id){
        alert(id);
    }

    function updateQty(id){
        alert(id);

    }

    
</script>
@endsection