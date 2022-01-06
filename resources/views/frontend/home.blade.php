<!doctype html>
<html lang="en">
  <head>
    
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css" integrity="sha384-AYmEC3Yw5cVb3ZcuHtOA93w35dYTsvhLPVnYs9eStHfGJvOvKxVfELGroGkvsg+p" crossorigin="anonymous"/>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <link rel="stylesheet" href="{{asset('css/mystyle.css')}}">
    <title>Warehouse PC</title>
  </head>
  
  <body>
    
    <nav class="navbar">
        <div class="container">
       <div class="d-flex">
        <i class="fas fa-align-justify"></i>
           <span class="navbar-brand" href="">Warehouse PC</span>
           <form class="ms-3 d-md-none">
               <input class="searchbtn" type="text" class="form-control">
           </form>
       </div>
    </div>
      </nav>

      {{-- Main Content --}}
      <div class="container">
        <div class="hero-image">
        </div>
      

       <div class="row mt-3">
           <div class="col-md-6">
               <div class="subimage1"></div>
           </div>
           <div class="col-md-6">
                <div class="subimage2"></div>
           </div>
       </div>

       <section class="main-component mt-5">
       <div class="row">
           <h4>Komponen Utama PC </h4>
       </div>
      <span class="line"></span>

      @foreach($komponen as $k)
      <div class="row mt-3">
          <div class="col-md-2">
              <h5>Pilih {{$k->nama_komponen}}</h5>
          </div>
          @php
                $subkomponen = DB::table('sub_komponens')->where('komponen_id', $k->id)->get(); 
          @endphp

         
          <div class="col-md-7">
            <select onchange="kalkulasi(this.getAttribute('data-id'),this.value)" class="form-select" data-id="{{$k->id}}" id="subkomponen{{$k->id}}"  name="subkomponen{{$k->id}}" aria-label="Default select example">
                <option selected value="0">Pilih Sub Komponen</option>
                @foreach($subkomponen as $sk)
                <option value="{{$sk->harga}}">{{$sk->nama_subkomponen}} - <span class="badge bg-success">Rp.{{$sk->harga}}</span></option> 
                @endforeach
              </select>
          </div>
          <div class="col-md-1">
              <input onchange="kalkulasiQty(this.getAttribute('data-id'))" type="number" data-id="{{$k->id}}" id="qty{{$k->id}}" min="0" class="form-control" placeholder="Qty" value="1">
          </div>
          <div class="col-md-2">
            <div class="input-group"  >
                <span class="input-group-text" id="basic-addon1">Rp.</span>
                <input type="text" id="hargasub{{$k->id}}" class="form-control"   aria-label="Username" aria-describedby="basic-addon1" value="0">
              </div>
              
          </div>
      </div>
      @endforeach
      <span class="line mt-4"></span>
      <div class="row mt-3">
        <div class="col-md-9"></div>
        <div class="col-md-1"><h5>Total</h5></div>
        <div class="col-md-2">
          <div class="input-group"  >
                <input type="text" id="total" class="form-control"   aria-label="Username" aria-describedby="basic-addon1" value="0" style="border-radius: 15px">
              </div>
        </div>
      </div>
       </section>
    </div>

      </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>

  </body>

  <script>

      

      function total()
      {
        
        $('#total').val(0)
        var total = 0;
        
        for(var i = 1; i <= {{$jmlData}}; i++){
          var hargaSubKomponen = parseInt($("#hargasub"+i).val())
          total += hargaSubKomponen          
        }

        console.log(total)

        $('#total').val(total);
      }

      


      function kalkulasi(id,harga){

            totalSekarang = $("#total").val();
            
            var qty = $("#qty"+id).val();
            
            var hargaSubKomponen = harga * qty;
           
            $("#hargasub"+id).val(hargaSubKomponen);  

            total()   
      }

      function kalkulasiQty(id){
        
           var harga = $("#subkomponen"+id).val();
        
            var qty = $("#qty"+id).val();
            var hargaSubKomponen = harga * qty;
            
           $("#hargasub"+id).val(hargaSubKomponen); 
           
           total()
     }

      
  </script>
</html>