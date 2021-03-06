<?php if(!class_exists('Rain\Tpl')){exit;}?><!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
<!-- Content Header (Page header) -->
<section class="content-header">
  <h1>
    Cadastrar Funcionário
  </h1>
  <ol class="breadcrumb">
    <li><a href="/"><i class="fa fa-dashboard"></i> Inicio</a></li>
    <li><a href="/users">Funcionários</a></li>
    <li class="active"><a href="/users/create">Cadastrar</a></li>
  </ol>
</section>

<!-- Main content -->
<section class="content">

  <div class="row">
  	<div class="col-md-12">
  		<div class="box box-success">
        <div class="box-header with-border">
          <h3 class="box-title">Funcionário</h3>
        </div>
        <!-- /.box-header -->        
        <?php if( $MsgError != '' ){ ?>
          <div class="alert alert-danger">
            <?php echo htmlspecialchars( $MsgError, ENT_COMPAT, 'UTF-8', FALSE ); ?>
          </div>
        <?php } ?>
        <!-- form start -->
        <form role="form" action="/users/create" method="post">
          <div class="box-body">
            <div class="form-group">
              <label for="desperson">Nome</label>
              <input type="text" class="form-control" id="des_person" name="des_person" placeholder="Digite o nome">
            </div>
            <div class="form-group">
              <label for="desperson">N° do PIS</label>
              <input type="text" class="form-control" id="des_pis" name="des_pis" placeholder="N° do PIS">
            </div>
            <div class="form-group">
              <label for="desperson">CPF</label>
              <input type="text" class="form-control" id="des_cpf" name="des_cpf" placeholder="N° do CPF">
            </div>
            <div class="form-group">
              <label for="desperson">RG</label>
              <input type="text" class="form-control" id="des_rg" name="des_rg" placeholder="N° do RG">
            </div>
            <div class="form-group">
              <label for="desperson">Remuneração</label>
              <input type="text" class="form-control" id="num_salario" name="num_salario" placeholder="Remuneração">
            </div>
            <div class="form-group">
              <label for="nrphone">Telefone</label>
              <input type="tel" class="form-control" id="nr_phone" name="nr_phone" placeholder="Digite o telefone">
            </div>
            <div class="form-group">
              <label for="desemail">E-mail</label>
              <input type="email" class="form-control" id="des_email" name="des_email" placeholder="Digite o e-mail">
            </div>
            <div class="form-group">
              <label for="deslogin">Usuário</label>
              <input type="text" class="form-control" id="des_login" name="des_login" placeholder="Digite o usuário">
            </div>
            <div class="form-group">
              <label for="despassword">Senha</label>
              <input type="password" class="form-control" id="des_password" name="des_password" placeholder="Digite a senha">
            </div>
            <div class="checkbox">
              <label>
                <input type="checkbox" name="inadmin" value="1"> Acesso de Administrador
              </label>
            </div>
          </div>
          <!-- /.box-body -->
          <div class="box-footer">
            <button type="submit" class="btn btn-success">Cadastrar</button>
          </div>
        </form>
      </div>
  	</div>
  </div>

</section>
<!-- /.content -->
</div>
<!-- /.content-wrapper -->