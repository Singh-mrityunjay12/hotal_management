
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
<title>Invoice</title>
<link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500&display=swap" rel="stylesheet">

{{-- <style type="text/css"> 
    * {
        font-family: Verdana, Arial, sans-serif;
    }
    table{
        font-size: x-small;
    }
    tfoot tr td{
        font-weight: bold;
        font-size: x-small;
    }
    .gray {
        background-color: lightgray
    }
    .font{
      font-size: 15px;
    }
    .authority {
        /*text-align: center;*/
        float: right
    }
    .authority h5 {
        margin-top: -10px;
        color: green;
        /*text-align: center;*/
        margin-left: 35px;
    }
    .thanks p {
        color: green;;
        font-size: 16px;
        font-weight: normal;
        font-family: serif;
        margin-top: 20px;
    }
</style> --}}

</head>
<body>

  <table width="100%" style="background: #F7F7F7; padding:0 20px 0 20px;">
    <tr>
        <td valign="top">
          <!-- {{-- <img src="" alt="" width="150"/> --}} -->
          <h2 style="color: green; font-size: 26px;"><strong>EasyShop</strong></h2>
        </td>
        <td align="right">
            <pre class="font" >
               EasyShop Head Office
               Email:support@easylearningbd.com <br>
               Mob: +91-8881903837 <br>
               India ,Delhi<br>

            </pre>
        </td>
    </tr>

  </table>


  <table width="100%" style="background:white; padding:2px;"></table>

  <div class="card">
    <div class="card-body">
        <table width="100%" class="table table-bordered mb-0" style="background:#F7F7F7;>

        <thead class="table-light">
            <tr>
                <th scope="col">Room Type</th>
                <th scope="col">Total Room</th>
                <th scope="col">Price</th>
                <th scope="col">Check In / Out Date</th>
                <th scope="col">Total Days</th>
                <th scope="col">Total </th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td>{{ $editData->room->type->name }}</td>
                <td>{{ $editData->number_of_rooms }}</td>
                <td>${{ $editData->actual_price }}</td>
                <td>
                    <span class="badge bg-primary">{{ $editData->check_in }}</span>  /<br> 
                    <span class="badge bg-warning text-dark">{{ $editData->check_out }}</span></td>
                <td>{{ $editData->total_night }}</td>
                <td>${{ $editData->actual_price *  $editData->number_of_rooms }}</td>
    
            </tr>
        </tbody> 
    
      
    </table>
</div>
</div>

  <br/>

  <table class="table test_table" style="float: right" border="none">
    <tr>
        <td>Subtotal</td>
        <td>${{ $editData->subtotal }}</td>
    </tr>
    <tr>
        <td>Discount</td>
        <td>${{ $editData->discount }}</td>
    </tr>
    <tr>
        <td>Grand Total</td>
        <td>${{ $editData->total_price }}</td>
    </tr>
</table>





  <table class="table test_table" style="float:right; border:none">

 </table>


  <div class="thanks mt-3">
    <p>Thanks For Your Booking..!!</p>
  </div>
  <div class="authority float-right mt-5">
      <p>-----------------------------------</p>
      <h5>Authority Signature:</h5>
    </div>
    
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
 
</body>
</html>

{{-- <div class="card">
    <div class="card-body">
        <table class="table table-bordered mb-0">
            <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">First</th>
                    <th scope="col">Last</th>
                    <th scope="col">Handle</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <th scope="row">1</th>
                    <td>Mark</td>
                    <td>Otto</td>
                    <td>@mdo</td>
                </tr>
                <tr>
                    <th scope="row">2</th>
                    <td>Jacob</td>
                    <td>Thornton</td>
                    <td>@fat</td>
                </tr>
                <tr>
                    <th scope="row">3</th>
                    <td colspan="2">Larry the Bird</td>
                    <td>@twitter</td>
                </tr>
            </tbody>
        </table>
    </div>
</div> --}}