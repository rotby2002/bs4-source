<?php
session_start();
include ("../../../config.php");
if(isset($_GET['mail'])){
	$hotmail = $_GET['mail'];
	$loai = $_GET['loai'];
			if($loai == 3){
			if(mysqli_num_rows(mysqli_query($kunloc,"SELECT * FROM hotmail WHERE hotmail = '{$hotmail}' AND loai = '3'"))) {
			    $total = mysqli_num_rows(mysqli_query($kunloc,"SELECT id FROM hotmail WHERE  loai = '3'"));
				mysqli_query($kunloc,"UPDATE hotmail SET hotmail = '{$hotmail}' WHERE hotmail = '{$hotmail}'");
				$echo['trangthai'] = 'update';
				$echo['total'] = $total;
				ECHO json_encode($echo,JSON_UNESCAPED_UNICODE);
			}else{
			    $total = mysqli_num_rows(mysqli_query($kunloc,"SELECT id FROM hotmail WHERE  loai = '3'"));
				mysqli_query($kunloc,"INSERT INTO hotmail SET hotmail = '{$hotmail}',loai = '3'");
				$echo['trangthai'] = 'insert';
				$echo['total'] = $total;
				ECHO json_encode($echo,JSON_UNESCAPED_UNICODE);
			}
			}else if($loai == 4){
			if(mysqli_num_rows(mysqli_query($kunloc,"SELECT * FROM hotmail WHERE hotmail = '{$hotmail}' AND loai = '4'"))) {
			    $total = mysqli_num_rows(mysqli_query($kunloc,"SELECT id FROM hotmail WHERE loai = '4'"));
				mysqli_query($kunloc,"UPDATE hotmail SET hotmail = '{$hotmail}' WHERE hotmail = '{$hotmail}'");
				$echo['trangthai'] = 'update';
				$echo['total'] = $total;
				ECHO json_encode($echo,JSON_UNESCAPED_UNICODE);
			}else{
			    $total = mysqli_num_rows(mysqli_query($kunloc,"SELECT id FROM hotmail WHERE loai = '4'"));
				mysqli_query($kunloc,"INSERT INTO hotmail SET hotmail = '{$hotmail}',loai = '4'");
				$echo['trangthai'] = 'insert';
				$echo['total'] = $total;
				ECHO json_encode($echo,JSON_UNESCAPED_UNICODE);
			}
			}else if($loai == 5){
			if(mysqli_num_rows(mysqli_query($kunloc,"SELECT * FROM hotmail WHERE hotmail = '{$hotmail}' AND loai = '5'"))) {
			    $total = mysqli_num_rows(mysqli_query($kunloc,"SELECT id FROM hotmail WHERE  loai = '5'"));
				mysqli_query($kunloc,"UPDATE hotmail SET hotmail = '{$hotmail}' WHERE hotmail = '{$hotmail}'");
				$echo['trangthai'] = 'update';
				$echo['total'] = $total;
				ECHO json_encode($echo,JSON_UNESCAPED_UNICODE);
			}else{
			    $total = mysqli_num_rows(mysqli_query($kunloc,"SELECT id FROM hotmail WHERE  loai = '5'"));
				mysqli_query($kunloc,"INSERT INTO hotmail SET hotmail = '{$hotmail}', loai = '5'");
				$echo['trangthai'] = 'insert';
				$echo['total'] = $total;
				ECHO json_encode($echo,JSON_UNESCAPED_UNICODE);
			}
		    }else{
		        $total = mysqli_num_rows(mysqli_query($kunloc,"SELECT id FROM hotmail WHERE  loai = '5'"));
		        $echo['trangthai'] = 'die';
			    $echo['total'] = $total;
			    ECHO json_encode($echo,JSON_UNESCAPED_UNICODE);
		    }
			
	exit();
}
?>
<?php include ("../../../main/head.php"); if($username == $admin){ ?>
<body>
<div id="wrapper" class="wrapper" style="padding-top:30px">
    <div class="container">
         <div class="col-md-13">
          <div class="card">
            <div class="card-header text-uppercase text-center"><i class="fa">&#xf11c;</i> Th??m Hotmail - Kunloc <span style="color:red" id="total">0</span></div>
                <div class="card-body"> 
				<div class="form-group">
					<textarea style="height:200px" class="custom-select" id="listhotmail"  placeholder="list hotmail m???i c??i m???t d??ng"></textarea>
				</div>
				<!-- /./ -->
					<div class="form-group has-error has-feedback">
                        <select id="loai" class="custom-select">
                            <option value="3">Lo???i : Hotmail Bangladesh</option>
                            <option value="4">Lo???i : Hotmail Random</option>
                            <option value="5">Lo???i : Hotmail 2006-2011</option>
            		    </select>
                    </div>
                   <!-- /./ -->
		        	<div class="form-group">
						<button type="button" class="btn-xs btn-dark btn-radius" id="submit" onclick="addmail();">B???T ?????U TH??M MAIL...</button>
					</div>
					<!-- /./ -->	
    					<div id="trangthai" style= 'display:none'>
    					S??? Tr??ng :<div id="update" style="color:red">0</div>
    					S??? Th??m :<div id="insert" style="color:red">0</div>
    					S??? Ch???t :<div id="die" style="color:red">0</div>
    					</div>
    				<!-- /./ -->	
                </div>
            </div>
        </div>
<script type="text/javascript">
    function addmail() {
		var insert = 0, update = 0, die = 0;
        var listmail = $('#listhotmail').val();
		var loai = $('#loai').val();
        if (listmail == '') {
            swal("Y??u c???u","C??n thi???u g?? ????!","error");
            return false;
        }
		$('#trangthai').show();
		$('#submit').prop('disabled', true).html('<i class="fa fa-spinner fa-spin"></i> ??ang x??? l??..');
		var mail = listmail.split('\n');
		var total = mail.length;
		for(i = 0; i < total; i++){
		var email = mail[i].trim();
        $.get('Addmail', {mail: email, loai:loai}, function(data, status) {
            var Data = JSON.parse(data);
        			if(Data.trangthai == 'die'){
            			die++;
            			$('#die').text(die);
            			$('#total').text(Data.total);
        			}
        			if(Data.trangthai == 'insert'){
            			insert++;
            			$('#insert').text(insert);
            			$('#total').text(Data.total);
        			}
        			if(Data.trangthai == 'update'){
        				update++;
        				$('#update').text(update);
        				$('#total').text(Data.total);
        			}
                $('#submit').prop('disabled', false).html('Ho??n th??nh');
                }).fail(function(){
        	        swal("Y??u c???u","N???p th???t b???i!","error");
                    $('#submit').prop('disabled', false).html('Ho??n th??nh');
        	    });
        	}
}
</script>
<?php 
}else{
     echo "<script>Swal.fire('Th??ng B??o','B???n Kh??ng C?? Quy???n V??o ????y','error'); setTimeout(function(){ window.location  = '$domain/Home'; }, 2000);</script>";    
} 
?>
</body>
</html>