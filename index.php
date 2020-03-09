<html>
    <head><meta http-equiv="Content-Type" content="text/html; charset=utf-8">
        <title>Tambah Data - Game</title>
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
        <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
    </head>
    <body>
        <div class="container mt-4 ml-7 mr-7">
            <h2 class="text-center mb-4">TUGAS WEB SERVICE - MENDATA ASSET 3D GAME</h2>
            
            <div class="row text-center">
              <div class="col-sm"><strong>Nama:</strong> Sativa Wahyu Priyanto</div>
              <div class="col-sm"><strong>Nim:</strong> 17.01.53.0052</div>
            </div>
            
            <div class="notif text-center mt-4 mb-2"></div>
              <div class="form-group">
                <label for="asset">Asset Game</label>
                <input type="text" class="form-control" id="asset" aria-describedby="Asset Game" name="asset">
                <small id="asset" class="form-text text-muted">Masukkan asset game.</small>
              </div>
              <!---->
              <div class="form-group">
                <label for="desc_">Diskripsi</label>
                <input type="text" class="form-control" id="desc_" aria-describedby="Diskripsi" name="asset">
                <small id="asset" class="form-text text-muted">Masukkan Diskripsi Asset.</small>
              </div>
              <!---->
              <div class="input-group mb-3">
              <div class="input-group-prepend">
                <label class="input-group-text" for="inputGroupSelect01">Pilih </label>
              </div>
              <select class="poly" id="inputGroupSelect01">
                <option selected value="1">Low Poly</option>
                <option value="2">High Poly</option>
              </select>
            </div>
            <!---->
            <button type="submit" class="btn btn-primary masukkan">Submit <span class="spin_"></span></button>
            <!---->
             
        </div>
        <div class="container mt-4">
            <table class="table"><thead class="thead-dark">
            <tr>
              <th scope="col">No</th>
              <th scope="col">Asset Title</th>
              <th scope="col">Poly</th>
              <th scope="col">Description</th>
            </tr>
          </thead>
          <tbody class="show_data">
          </tbody>
          </table>
        </div>
        <script>
            function get_data(){
                $.ajax({
                    url: 'http://webservice.postku.org/tugas2/tambah.php',
                    method: "POST",
                    data: {show: 2},
                    dataType: "JSON",
                    success: function(data){
                        $('.show_data').html("");
                        if(data['status'] == 1){
                            for(var i=0;i<data['data'].length;i++){
                                var poly = '';
                                if(data['data'][i][3] == 1){
                                    poly = "Low Poly";
                                }else if(data['data'][i][3] == 2){
                                    poly = "High Poly";
                                }
                                $('.show_data').append('<tr><th scope="row">'+(i+1)+'</th><td>'+data['data'][i][1]+'</td><td>'+poly+'</td><td>'+data['data'][i][2]+'</td></tr>');
                            }
                        }else{
                            $('.show_data').html("Error Get Data.");
                        }
                    },
                    error: function(){
                        $('.show_data').html("");
                        $('.show_data').html("Error Get Data.");
                    },
                    beforeSend: function(){
                        $('.show_data').html('<tr><th scope="row"></th><td></td><td><span class="spinner-border"></span></td><td></td></tr>');
                    }
                })
            }
            $(document).ready(function(){
                
                get_data();
                
                $('.masukkan').click(function(){
                    var asset = $('#asset').val();
                    var desc_ = $('#desc_').val();
                    var pilih = $('.poly option:selected').val();
                    if(asset && desc_ && pilih){
                        $.ajax({
                            url: 'http://webservice.postku.org/tugas2/tambah.php',
                            method: "POST",
                            data: {asset: asset, desc_:desc_, poly:pilih, show:1},
                            dataType: "JSON",
                            success: function(data){
                                setTimeout(function(){ 
                                    $('.spin_').removeClass('spinner-border spinner-border-sm');
                                    $('.masukkan').prop("disabled", false);
                                }, 300);
                                if(data['status']){
                                    get_data();
                                    $('.notif').html('<span class="text-success">'+data['msg']+'</span>');
                                }else{
                                    $('.notif').html('<span class="text-danger">'+data['msg']+'</span>');
                                }
                            },
                            error: function(){
                                setTimeout(function(){ 
                                    $('.spin_').removeClass('spinner-border spinner-border-sm');
                                    $('.masukkan').prop("disabled", false);
                                }, 300);
                                $('.notif').html('<span class="text-danger">Error Masukkan Data!!</span>');
                            },
                            beforeSend: function(){
                                $('.masukkan').prop("disabled", true);
                                $('.spin_').addClass('spinner-border spinner-border-sm');
                            }
                        })
                    }else{
                        $('.notif').html('<span class="text-danger">Lengkapi Dulu Datanya!!</span>');
                    }
                })
            })
        </script>
    </body>
</html>
