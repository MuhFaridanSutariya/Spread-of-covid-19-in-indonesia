<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css" integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">

    <title>Monitor the spread of covid-19</title>
  </head>
  <body>
      <div class="jumbotron jumbotron-fluid bg-primary text-white">
          <div class="container text-center">
           <h1 class="display-4">Corona Virus</h1>
           <p class="lead">
             <h2>
               MONITOR THE SPREAD OF COVID-19 GLOBAL
               <br> IN REAL-TIME
               <br> let's begin together to maintain our personal health.
             </h2>
           </p>
       </div>
      </div>

      <style type="text/css">
        .box{
          padding: 30px 40px;
          border-radius: 5px;
        }
      </style>

      <div class="container">
        <div class="row">
          <div class="col-md-4">
            <div class="bg-danger box text-white">
              <div class="row">
                <div class="col-md-6">
                  <h5>Positive</h5>
                  <h2 id="data-kasus"> 1234 </h2>
                  <h5>Person</h5>
                </div>
                <div class="col-md-4">
                  <img src="img/sad.svg" style="width: 100px;">
                </div>
              </div>
            </div>
          </div>

      <div class="col-md-4">
            <div class="bg-info box text-white">
              <div class="row">
                <div class="col-md-6">
                  <h5>Died</h5>
                  <h2 id="data-mati"> 1234 </h2>
                  <h5>Person</h5>
                </div>
                <div class="col-md-4">
                  <img src="img/cry.svg" style="width: 100px;">
                </div>
              </div>
            </div>
          </div>

          <div class="col-md-4">
            <div class="bg-success box text-white">
              <div class="row">
                <div class="col-md-6">
                  <h5>Recover</h5>
                  <h2 id="data-sembuh"> 1234 </h2>
                  <h5>Person</h5>
                </div>
                <div class="col-md-4">
                  <img src="img/happy.svg" style="width: 100px;">
                </div>
              </div>
            </div>
          </div>

          <div class="col-md-12 mt-3">
            <div class="bg-primary box text-white">
              <div class="row">
                <div class="col-md-3">
                  <h5>INDONESIA</h5>
                  <h5 id="data-id"> Positive : 12 Person <br>
                  Died : 20 Person <br> Died : 3 Person </h5>
                </div>
                <div class="col-md-4">
                  <img src="img/indonesia.svg" style="width: 150px;">
                </div>
              </div>
            </div>
          </div>

        </div>
        <!--Akhir Row-->

          <div class="card mt-3">
    <div class="card-header bg-success text-white">
      <b>Data Kasus Corona Virus Berdasarkan Provinsi</b>
    </div>
    <div class="card-body">
      <table class="table table-bordered">
          <thead>
            <th>No.</th>
            <th>Nama Provinsi</th>
            <th>Positif</th>
            <th>Sembuh</th>
            <th>Meninggal</th>
          </thead>
          <tbody id="table-data">
            
          </tbody>
        </table>
    </div>
  </div>

        


      </div>
      <!--Akhir Container -->
      <footer class="bg-primary text-center text-white mt-3 bt-2 pb-2">
        Create by : "Muhammad Faridan Sutariya"
      </footer>


    

    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.2.1.min.js"></script>
  </body>
</html>

<script>
  $(document).ready(function(){

    //panggil fungsi menampilkan semua data global
    semuaData();
    dataNegara();
    dataProvinsi();

    //untuk refresh otomatis
    setInterval(function(){
      semuaData();
      dataNegara();
      dataProvinsi();
    }, 3000);

    function semuaData(){
        $.ajax({
          url : 'https://coronavirus-19-api.herokuapp.com/all',
          success : function(data){
            try{
              var json = data;
              var kasus = data.cases;
              var meninggal = data.deaths;
              var sembuh = data.recovered;

              $('#data-kasus').html(kasus);
              $('#data-mati').html(meninggal);
              $('#data-sembuh').html(sembuh);

            }catch{
              alert('Errorr');
            }
          }
        });
    }

    function dataNegara(){
       $.ajax({
          url : 'https://coronavirus-19-api.herokuapp.com/countries',
          success : function(data){
            try{

              var json = data;
              var html = [];

              if(json.length > 0){
                var i;
                for(i = 0; i < json.length; i++){
                  var dataNegara = json[i];
                  var namaNegara = dataNegara.country;

                  if(namaNegara === 'Indonesia'){
                    var kasus = dataNegara.cases;
                    var mati = dataNegara.deaths;
                    var sembuh = dataNegara.recovered;
                    $('#data-id').html(
                      'Positive : '+kasus+' orang <br> Died : '+mati+' orang <br> Recover : '+sembuh+' orang')
                  }
                }
              }


            }catch{
              alert('Error');
            }
          }
        });
    }

    function dataProvinsi(){
      $.ajax({
          url : 'curl.php',
          type : 'GET',
          success : function(data){
            try{
              
              $('#table-data').html(data);

            }catch{
              alert('Errorr');
            }
          }
        });
    }

  });
</script>