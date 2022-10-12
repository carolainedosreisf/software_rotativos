<section class="content-block" style="background-color:#282e40;">
	<div class="container text-center">
		<div class="row">
			<div class="col-sm-10 col-sm-offset-1">
				<div class="contatos">
					<span class="item-contatos">
						<i class="fa fa-envelope"></i> <span><?php echo $EmpresaSoftware['Email']; ?></span>
					</span>
					<span class="item-contatos">
						<i class="fa fa-phone"></i> <span><?php echo $EmpresaSoftware['NumeroTelefone1Format']; ?></span>
					</span>
					<?php if(trim($EmpresaSoftware['NumeroTelefone2'])!=''){ ?>
					<span class="item-contatos">
						<i class="fa fa-phone"></i> <span><?php echo $EmpresaSoftware['NumeroTelefone2Format']; ?></span>
					</span>
					<?php } ?>
				</div>
			</div>
		</div>

		<div class="row">
			<div class="col-sm-10 col-sm-offset-1">
				<ul class="social-iconsfooter">
					<li><a href="#"><i class="fa fa-phone"></i></a></li>
					<li><a href="#"><i class="fa fa-envelope"></i></a></li>
					<li><a href="#"><i class="fa fa-facebook"></i></a></li>
					<li><a href="#"><i class="fa fa-instagram"></i></a></li>
				</ul>
			</div>
		</div>
	</div>
</section>


<!-- FOOTER =============================-->
<div class="footer text-center">
	<div class="container">
		<div class="row">
			<p>
				Copyright <?php echo Date('Y');?> Todos os direitos reservados - <?php echo $EmpresaSoftware['Nome']; ?>
			</p>
		</div>
	</div>
</div>

<!-- SCRIPTS =============================-->
<script src="<?php echo base_url('assets/js/jquery-.js'); ?>"></script>
<script src="<?php echo base_url('assets/js/bootstrap.min.js'); ?>"></script>
<script src="<?php echo base_url('assets/js/anim.js'); ?>"></script>
<script src="<?php echo base_url('assets/js/owl.carousel.js '); ?>"></script>
<script>
//----HOVER CAPTION---//	  
jQuery(document).ready(function ($) {
	$('.fadeshop').hover(
		function(){
			$(this).find('.captionshop').fadeIn(150);
		},
		function(){
			$(this).find('.captionshop').fadeOut(150);
		}
	);
});
</script>
	
</body>
</html>