<?php
    session_start();
    $_SESSION[0]="";
    for($i=1;$i<=4;$i++){
        $dt[$i] = $i . $i . $i+1 . $i+2 . $i+3;
        $k = $i-1;
        $data = $dt[$i].$_SESSION[$k];
        $hash[$i]=hash("sha256",$data);
        $j =$i +1;
        $_SESSION[$i.$j] =$hash[$i];
        $_SESSION[$i]= $hash[$i];
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/css/bootstrap.min.css">
    <script src="http://localhost:88/dkstore/lib/jquery/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/js/bootstrap.bundle.min.js"></script>
    <title>Document</title>
</head>
<body>
    <div class="container-fluid" style=" width: 2000px; height: 700px;">
        <div class="row" >
            <?php
                for($i =1 ; $i<=4; $i++){
                    $hash[$i] = $_SESSION[$i];
                    $j = $i -1 . $i;
                    $pre[$i] = $_SESSION[$j];
                    $dt[$i] = $i . $i+1 . $i+2 . $i+3;
                    echo '<div class="col-lg-3 mt-4 mb-4">
                            <div class="col-lg-12  pt-1 pb-4 bg-info pl-2 " id="blockchain'.$i.'">
                                <form >
                                    <div class="row mt-5 m-r-2">
                                        <span class="col-lg-3 pt-1">Block:</span>
                                        <input class="col-lg-1 form-control" readonly value="#">
                                        <input class="col-lg-7 form-control" id="block'.$i.'chain1number" onchange  ="updatedata'.$i.'();" type="number" value="'.$i.'">
                                    </div>
                                    <div  class="row mt-5 m-r-2">
                                        <span class="col-lg-3 pt-1">Nonce: </span>
                                        <input class="col-lg-8 form-control" id="block'.$i.'chain1nonce" onkeyup="updatedata'.$i.'();" value="'.$dt[$i].'" type="text">
                                    </div>
                                    <div  class="row mt-5 m-r-2">
                                        <span class="col-lg-3 pt-1">Data: </span>
                                        <textarea class=" col-lg-8  form-control" id="block'.$i.'chain1data" onkeyup="updatedata'.$i.'();"  rows="4"></textarea>
                                    </div>
                                    <div  class="row mt-5 m-r-2">
                                        <span class="col-lg-3 pt-1">Prev: </span>
                                        <input class="col-lg-8 form-control" id="block'.$i.'chain1pre" readonly type="text" value="'.$pre[$i].'" readonly type="text" >
                                    </div>
                                    <div  class="row mt-5 m-r-2">
                                        <span class="col-lg-3 pt-1">Hash: </span>
                                        <input class="col-lg-8 form-control" id="block'.$i.'chain1hash" readonly  type="text" value="'.$hash[$i].'">
                                    </div>
                                    <div  class="row mt-5 m-r-2">
                                        <span class="col-lg-3 pt-1">Hash: </span>
                                        <input class="col-lg-8 form-control" id="block'.$i.'chain1mineButton"  onclick="mine'.$i.'();" readonly type="button" value="mine">
                                    </div>
                                    <input type="hidden" id="hash'.$i.'" value="'.$hash[$i].'">
                                </form>
                            </div>
                        </div>';
                }
                
            ?>
        </div>
    </div>
<script type="text/javascript">
    function updatedata1(){
        let block = $('#block1chain1number').val();
        let nonce = $('#block1chain1nonce').val();
        let data = $('#block1chain1data').val();
        let pre = $('#block1chain1pre').val();
        let dt = block+nonce+data;
        $.get('hash.php',{in:dt},function(data){
            $('#block1chain1hash').val(data);
            $('#block2chain1pre').val(data);
            let hash =  $('#hash1').val();
            if(hash != data){
                document.getElementById('blockchain1').classList.remove('bg-info');
                document.getElementById('blockchain1').classList.add('bg-danger');
            }else{
                document.getElementById('blockchain1').classList.remove('bg-danger');
                document.getElementById('blockchain1').classList.add('bg-info');
                
            }
            updatedata2();
        });
        
    }
    function updatedata2(){
        let block = $('#block2chain1number').val();
        let nonce = $('#block2chain1nonce').val();
        let data = $('#block2chain1data').val();
        let pre = $('#block2chain1pre').val();
        let dt = block+nonce+data+pre;
        $.get('hash.php',{in:dt},function(data){
            $('#block2chain1hash').val(data);
            $('#block3chain1pre').val(data);
            let hash1 =  $('#hash2').val();
            if(hash1 != data){
                document.getElementById('blockchain2').classList.remove('bg-info');
                document.getElementById('blockchain2').classList.add('bg-danger');
            }else{
                document.getElementById('blockchain2').classList.remove('bg-danger');
                document.getElementById('blockchain2').classList.add('bg-info');
            }
            updatedata3();
        });
        
    }
    function updatedata3(){
        let block = $('#block3chain1number').val();
        let nonce = $('#block3chain1nonce').val();
        let data = $('#block3chain1data').val();
        let pre = $('#block3chain1pre').val();
        let dt = block+nonce+data+pre;
        $.get('hash.php',{in:dt},function(data){
            $('#block3chain1hash').val(data);
            $('#block4chain1pre').val(data);
            let hash3 =  $('#hash3').val();
            if(hash3 != data){
                document.getElementById('blockchain3').classList.remove('bg-info');
                document.getElementById('blockchain3').classList.add('bg-danger');
            }else{
                document.getElementById('blockchain3').classList.remove('bg-danger');
                document.getElementById('blockchain3').classList.add('bg-info');
            }
            updatedata4();
        });
        
    }
    function updatedata4(){
        let block = $('#block4chain1number').val();
        let nonce = $('#block4chain1nonce').val();
        let data = $('#block4chain1data').val();
        let pre = $('#block4chain1pre').val();
        let dt = block+nonce+data+pre;
        $.get('hash.php',{in:dt},function(data){
            $('#block4chain1hash').val(data);
            let hash4 = $('#hash4').val();
            if(hash4 != data){
                document.getElementById('blockchain4').classList.remove('bg-info');
                document.getElementById('blockchain4').classList.add('bg-danger');
            }else{
                document.getElementById('blockchain4').classList.remove('bg-danger');
                document.getElementById('blockchain4').classList.add('bg-info');
            }
        });
    }
    function mine1(){
        let hash = $('#block1chain1hash').val();
        $('#hash1').val(hash);
        updatedata1();
    }
    function mine2(){
        let hash = $('#block2chain1hash').val();
        $('#hash2').val(hash);
        updatedata2();
    }
    function mine3(){
        let hash = $('#block3chain1hash').val();
        $('#hash3').val(hash);
        updatedata3();
    }
    function mine4(){
        let hash = $('#block4chain1hash').val();
        $('#hash4').val(hash);
        updatedata4();
    }
    function updateHash(dt){
        $.get('hash.php',{in:dt},function(data){
            $('#block1chain1hash').val(data);
        });
    }
</script>
</body>
</html>