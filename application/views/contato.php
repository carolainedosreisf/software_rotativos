<section class="item content" style="margin-top:50px;margin-bottom:50px;">
	<div class="container toparea">
		<div class="underlined-title" id="mensagens">
			<div class="editContent">
				<h1 class="text-center latestitems">Contato</h1>
			</div>
			<div class="wow-hr type_short">
				<span class="wow-hr-h">
				<i class="fa fa-star"></i>
				<i class="fa fa-star"></i>
				<i class="fa fa-star"></i>
				</span>
			</div>
		</div>
		<div class="row">
			<div class="col-lg-8 col-lg-offset-2">
				<form name="form_contato" novalidate ng-submit="setContato()" id="contactform" autocomplete="off">
					<div class="form">
						<div class="col-sm-12">
							<div class="alert alert-danger" role="alert" ng-show="form_contato.$error.required && form_contato.$submitted">
								Preencha os campos destacados!
							</div>
							<div class="alert alert-danger" role="alert" ng-show="form_contato.email.$invalid && !(form_contato.email.$error.required) && (form_contato.$submitted || form_contato.email.$dirty)">
								E-mail Inválido!
							</div>
						</div>
						<div class="col-sm-12" ng-class="form_contato.nome.$invalid && (form_contato.$submitted || form_contato.nome.$dirty)?'has-error':''">
							<label for="nome">Nome:</label>
							<input type="text" name="nome" ng-model="contato.nome" ng-required="true">
						</div>

						<div class="col-sm-12" ng-class="form_contato.email.$invalid && (form_contato.$submitted || form_contato.email.$dirty)?'has-error':''">
							<label for="email">E-mail:</label>
							<input type="email" name="email" ng-model="contato.email" ng-required="true">
						</div>

						<div class="col-sm-12" ng-class="form_contato.assunto.$invalid && (form_contato.$submitted || form_contato.assunto.$dirty)?'has-error':''">
							<label for="assunto">Assunto:</label>
							<input type="text" name="assunto" ng-model="contato.assunto" ng-required="true">
						</div>
						
						<div class="col-sm-12" ng-class="form_contato.mensagem.$invalid && (form_contato.$submitted || form_contato.mensagem.$dirty)?'has-error':''">
							<label for="mensagem">Mensagem:</label>
							<textarea name="mensagem" rows="7" ng-model="contato.mensagem" ng-required="true"></textarea>
						</div>

						<div class="col-sm-12">
							<button type="submit" class="btn-large-black">Enviar Mensagem</button>
						</div>
						
					</div>
				</form>
			</div>
		</div>
	</div>
</section>