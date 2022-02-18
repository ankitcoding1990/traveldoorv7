{{-- component / dashboard.blade.php --}}

@push('style')
  <style>
      .iti-flag {
          width: 20px;
          height: 15px;
          box-shadow: 0px 0px 1px 0px #888;
          background-image: url("{{asset('assets/images/flags.png')}}") !important;
          background-repeat: no-repeat;
          background-color: #DBDBDB;
          background-position: 20px 0
      }

      div#cke_1_contents {
          height: 250px !important;
      }
      .dash-card{
          background: linear-gradient(313deg, #4a00e0f5, #8e2de2ba);
          padding: 30px;
          text-align: center;
              height: 80%;
      }
      .dash-card .fa{
          color: white;
          padding: 10px 0px;
          font-size: 22px !important;
      }

      .dash-card h3{
          margin-top: 0px;
         font-size: 17px;
         color: white;
         font-weight: bold;
      }
      .table-section{
              margin-top: 40px;
      }
       .dash-card p{
           padding: 10px 0px 16px 0px;
           line-height: 25px;
           font-size: 35px;
      color: white;
      font-weight: bold;
      margin-bottom: 0px;
       }
       .w3-light-grey{
          padding: 50px;
          display: flex;
          justify-content: center;
          align-items: center;
          width: 60px;
          height: 60px;
          border-radius: 50%;
          border-left: 5px solid #4a00e0f5;
          border-top: 5px solid #4a00e0f5;
          border-right: 5px solid rgb(173, 173, 173);
          border-bottom: 5px solid #4a00e0f5;
  }
  .w3-green span{
      font-size: 30px;
      font-weight: bold;
      color: black;
  font-family: cursive;
  }
  .w3-green{
       width: 60px;
       height: 60px;
      border-radius: 50%;
      display: flex;
      justify-content: center;
      align-items: center;
  }
  /*second circle*/
       .w3-light-grey2{
          padding: 50px;
          display: flex;
          justify-content: center;
          align-items: center;
          width: 60px;
          height: 60px;
          border-radius: 50%;
          border-left: 5px solid #4a00e0f5;
          border-top: 5px solid rgb(173, 173, 173);
          border-right: 5px solid rgb(173, 173, 173);
          border-bottom: 5px solid rgb(173, 173, 173);
  }
  .w3-green span{
      font-size: 30px;
      font-weight: bold;
      color: black;

  }
  .w3-green{
       width: 60px;
       height: 60px;
      border-radius: 50%;
      display: flex;
      justify-content: center;
      align-items: center;
  }
  /*third circle*/
       .w3-light-grey3{
          padding: 50px;
          display: flex;
          justify-content: center;
          align-items: center;
          width: 60px;
          height: 60px;
          border-radius: 50%;
          border-left: 5px solid #4a00e0f5;
          border-top: 5px solid #4a00e0f5;
          border-right: 5px solid rgb(173, 173, 173);
          border-bottom: 5px solid rgb(173, 173, 173);
  }
  .w3-green span{
      font-size: 30px;
      font-weight: bold;
      color: black;

  }
  .w3-green{
       width: 60px;
       height: 60px;
      border-radius: 50%;
      display: flex;
      justify-content: center;
      align-items: center;
  }
  /*fourth circle*/
       .w3-light-grey4{
          padding: 50px;
          display: flex;
          justify-content: center;
          align-items: center;
          width: 60px;
          height: 60px;
          border-radius: 50%;
          border-left: 5px solid #4a00e0f5;
          border-top: 5px solid #4a00e0f5;
          border-right: 5px solid #4a00e0f5;
          border-bottom: 5px solid #4a00e0f5;
  }
  .w3-green span{
      font-size: 30px;
      font-weight: bold;
      color: black;

  }

  .w3-green{
       width: 60px;
       height: 60px;
      border-radius: 50%;
      display: flex;
      justify-content: center;
      align-items: center;
  }
  .bar-col{
     margin-bottom: 40px;
      background: white;
      padding: 30px;
      justify-content: center;
      display: flex;
      border-radius: 25px;
      box-shadow: 0px 0px 12px 0px #0000001a;
  }
  .bar-col p{
      color: #4a00e0f5;
      font-weight: bold;
     font-size: 20px;
  }
  canvas{
      box-shadow: 0px 0px 12px 0px #0000001a;
      background: white;
      border-radius: 10px;
      padding: 30px;
  }
  .w3-green span:after{
   content: '\f295';
      position: relative;
      font-family: 'FontAwesome';
      font-size: 17px;
      top: -13px;
      right: -3px;
      font-weight: normal;
  }
  </style>
@endpush


@section('main')
  <section class="cards-section">

     <div class="row">
           <div class="col-md-2">
             <div class="card dash-card">
                <i class="fa fa-user-secret" aria-hidden="true"></i>
                  <p>{{$no_of_agents ?? 0}}</p>
                 <h3>No Of Agents</h3>
             </div>
          </div>
          <div class="col-md-2">
            <div class="card dash-card">
                <i class="fa fa-cart-plus" aria-hidden="true"></i>
                  <p>{{$no_of_suppliers ?? 0 }}</p>
                 <h3>Total Suppliers </h3>
             </div>
         </div>
          <div class="col-md-2">
            <div class="card dash-card">
              <i class="fa fa-ticket" aria-hidden="true"></i>
                <p>{{($no_of_b2b ?? 0) + ($no_of_b2c ?? 0) }}</p>
                 <h3> Total Bookings</h3>
             </div>
         </div>
         <div class="col-md-2">
            <div class="card dash-card">
                <i class="fa fa-briefcase" aria-hidden="true"></i>
                  <p>{{$no_of_b2b ?? 0}}</p>
                 <h3> Total B2B</h3>
             </div>
    </div>
    <div class="col-md-2">
            <div class="card dash-card">
               <i class="fa fa-users" aria-hidden="true"></i>
                 <p>{{$no_of_b2c ?? 0 }}</p>
                 <h3> Total B2C</h3>
             </div>
    </div>
    <div class="col-md-2">
            <div class="card dash-card">
                <i class="fa fa-calendar-check-o" aria-hidden="true"></i>
                  <p>{{$no_of_activities ?? 0}}</p>
                 <h3>No of Activities</h3>
             </div>
    </div>
  </div>
</section>


<section>
<div class="row">
 <div class="col-md-3">
       <div class=" bar-col">
          <div class="w3-light-grey">
             <div class="w3-green"><span>75</span></div>
          </div>
            <p>Arrived</p>
      </div>
 </div>
  <div class="col-md-3">
       <div class=" bar-col">
          <div class="w3-light-grey2">
             <div class="w3-green"><span>25</span></div>
          </div>
            <p>Booked</p>
      </div>
 </div>
  <div class="col-md-3">
       <div class=" bar-col">
          <div class="w3-light-grey3">
             <div class="w3-green"><span>50</span></div>
          </div>
            <p>Live</p>
      </div>
 </div>
  <div class="col-md-3">
       <div class=" bar-col">
          <div class="w3-light-grey4">
             <div class="w3-green"><span>100</span></div>
          </div>
            <p>Visited</p>
      </div>
 </div>
</div>
</section>

<section>
<div class="row">
 <div class="col-lg-6">
     <canvas id="lineChart" width="470" height="300"></canvas>
 </div>
 <div class="col-lg-6">
     <canvas id="bar-chart" width="470" height="300"></canvas>
 </div>
</div>
</section>

<section class="table-section">
<div class="row">
 <div class="col-md-6">
     <div class="table-div">
         <table class="table table-light order-list-table">
    <tbody>
      <thead class="table-heading">
      <tr>
        <th>ORDER ID</th>
        <th>ITEM</th>
        <th>STATUS</th>
        <th>AMOUNT</th>
      </tr>
    </thead>

    <tr>
     <td class="order-no">OR6789</td>
     <td>Mobile</td>
     <td><span class="label label-success">Shipped<span></td>
     <td>$16000</td>

    </tr>
    <tr>
    <td class="order-no">OR4589</td>
     <td>Samsung TV</td>
     <td><span class="label label-warning">Pending</span></td>
     <td>$16000</td>

    </tr>
    <tr>
    <td class="order-no">OR6909</td>
     <td>Ac</td>
     <td><span class="label label-info">Processing</span></td>
     <td>$80000</td>

    </tr>
    <tr>
    <td class="order-no">OR6678</td>
     <td>Samsung Mobile</td>
     <td><span class="label label-danger">Delivered</span></td>
     <td>$30000</td>

    </tr>
    <tr>
    <td class="order-no">OR6789</td>
     <td>Mobile</td>
     <td><span class="label label-success">Shipped</span></td>
     <td>$16000</td>

    </tr>
    <tr>
    <td class="order-no">OR6239</td>
     <td>Mobile</td>
     <td><span class="label label-warning">Pending</span></td>
     <td>$16000</td>

    </tr>
    </tbody>
  </table>
     </div>
 </div>
</div>
</section>
@endsection
@push('scripts')
  <script src="https://cdn.jsdelivr.net/npm/chart.js@2.8.0"></script>
  <script>
      var ctx = document.getElementById('lineChart').getContext('2d');
              var gradientStroke = ctx.createLinearGradient(500, 0, 100, 0);
              gradientStroke.addColorStop(0, "#80b6f4");
              gradientStroke.addColorStop(1, "#f49080");

              var myChart = new Chart(ctx, {
              type: 'line',
              data: {
              datasets: [{
                pointBackgroundColor:'#ff851b',
                pointBorderColor:'#ff851b',
                data: [50, 130, 50, 70, 65, 40],

              label: 'Total Profits',


              // This binds the dataset to the left y axis
              yAxisID: 'left-y-axis',

              backgroundColor: [
                  'rgb(238 238 238 / 44%)'

              ],
              borderColor: gradientStroke,
              borderWidth: 2,
              pointBorderColor: gradientStroke,
              pointBackgroundColor: gradientStroke,
          }, {
            pointBackgroundColor:'#5867dd',
                pointBorderColor:'#5867dd',
                data: [60, 120, 30, 80, 80, 10],
              label: 'Earnings',

              // This binds the dataset to the right y axis
              yAxisID: 'right-y-axis',
              backgroundColor: [
                  'rgb(255 255 255 / 27%)'
              ],
              borderColor: [
                  '#5867dd'
              ],
              borderWidth: 2
          }],
          labels: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun'],

      },
      options: {
          scales: {
              yAxes: [{
                  id: 'left-y-axis',
                  type: 'linear',
                  position: 'left'
              }, {
                  id: 'right-y-axis',
                  type: 'linear',
                  position: 'right',

              }]
          }
      }
  });



    var ctx = document.getElementById('bar-chart').getContext('2d');
               var myChart = new Chart(ctx, {
              type: 'bar',
              data: {
              datasets: [{

                pointBackgroundColor:'#ff851b',
                pointBorderColor:'#ff851b',
                data: [79, 130, 110, 130, 145, 120],

              label: 'Total Profits',
     // This binds the dataset to the left y axis
              yAxisID: 'left-y-axis',
              backgroundColor: [
                  '#8E2DE2',
                  '#8E2DE2',
                  '#8E2DE2',
                  '#8E2DE2',
                  '#8E2DE2',
                  '#8E2DE2'
              ],
              borderColor: [
                  '#8E2DE2',
                  '#8E2DE2',
                  '#8E2DE2',
                  '#8E2DE2',
                  '#8E2DE2',
                  '#8E2DE2'
              ],
              borderWidth: 1
          }, {
            pointBackgroundColor:'#5867dd',
                pointBorderColor:'#5867dd',
            data: [60, 120, 90, 80, 80, 10],
              label: 'Earnings',

              // This binds the dataset to the right y axis
              yAxisID: 'right-y-axis',
              backgroundColor: [
                 '#4A00E0',
                 '#4A00E0',
                  '#4A00E0',
                  '#4A00E0',
                  '#4A00E0',
                  '#4A00E0'
              ],
              borderColor: [
                '#4A00E0',
                 '#4A00E0',
                  '#4A00E0',
                  '#4A00E0',
                  '#4A00E0',
                  '#4A00E0'
              ],

              borderWidth: 1
          }],

          labels: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun'],

      },
      options: {

          scales: {
              yAxes: [{
                  barThickness: 6,  // number (pixels) or 'flex'
                  maxBarThickness: 8,
                  id: 'left-y-axis',
                  type: 'linear',
                  position: 'left',

              }, {
                   barThickness: 6,  // number (pixels) or 'flex'
                  maxBarThickness: 8,
                  id: 'right-y-axis',
                  type: 'linear',
                  position: 'right',

              }]

          }
      }
  });
  </script>

@endpush
