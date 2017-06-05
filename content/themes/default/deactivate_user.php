<?php include('includes/header.php'); ?>

<script type="text/javascript" src="//ajax.googleapis.com/ajax/libs/jqueryui/1.10.4/jquery-ui.min.js"></script>
<script type="text/javascript" src="<?=THEME_URL?>/assets/js/jquery.form.min.js"></script>
<script type="text/javascript" src="<?=THEME_URL?>/assets/js/jquery.imagedrag.min.js"></script>







 <div class="container user">
  <div class="mail-section01">
 <div class="row">
 <div class="col-lg-12">
<!--URL::to('user') . '/' . $user->username . '/update'-->
 <form method="POST" action="<?=url()?>/account-settings/<?=Auth::user()->id ?>/deactivated_user" name="deactivated_user" id="deactivated_user">
 <!--<a href="" class="pull-right"></a>-->
<input type="submit" value="Deactivate User" class="btn btn-primary" />
 </form>

</div>
</div>
</div>

 </div>
		




	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.min.css" />
	<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.min.js"></script>

	
	<script>

		$(document).ready(function(){
			var delete_link = '';

			$('.delete').click(function(e){
				e.preventDefault();
				delete_link = $(this).attr('href');
				swal({   title: "Are you sure?",   text: "Do you want to permanantly delete this video?",   type: "warning",   showCancelButton: true,   confirmButtonColor: "#DD6B55",   confirmButtonText: "Yes, delete it!",   closeOnConfirm: false }, function(){    window.location = delete_link });
			    return false;
			});
		});

		
	</script>
	
<?php include('includes/footer.php'); ?>