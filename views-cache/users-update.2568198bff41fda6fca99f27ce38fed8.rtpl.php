<?php if(!class_exists('Rain\Tpl')){exit;}?><!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
<!-- Content Header (Page header) -->
<section class="content-header">
  <h1>
    Funcionário
  </h1>
</section>

<!-- Main content -->
<section class="content">

  <div class="row">
  	<div class="col-md-12">
  		<div class="box box-primary">
        <div class="box-header with-border">
          <h3 class="box-title">Editar</h3>
        </div>
        <!-- /.box-header -->
        <!-- form start -->
        <form role="form" action="/users/<?php echo htmlspecialchars( $user["id_user"], ENT_COMPAT, 'UTF-8', FALSE ); ?>" method="post">
          <div class="box-body">
            <div class="form-group">
              <label for="desperson">Nome</label>
              <input type="text" class="form-control" id="des_person" name="des_person" placeholder="Digite o Nome" value="<?php echo htmlspecialchars( $user["des_person"], ENT_COMPAT, 'UTF-8', FALSE ); ?>">
            </div>
            <div class="form-group">
              <label for="desperson">N° do PIS</label>
              <input type="text" class="form-control" id="des_pis" name="des_pis" placeholder="N° do PIS" value="<?php echo htmlspecialchars( $user["des_pis"], ENT_COMPAT, 'UTF-8', FALSE ); ?>">
            </div>
            <div class="form-group">
              <label for="desperson">CPF</label>
              <input type="text" class="form-control" id="des_cpf" name="des_cpf" placeholder="N° do CPF" value="<?php echo htmlspecialchars( $user["des_cpf"], ENT_COMPAT, 'UTF-8', FALSE ); ?>">
            </div>
            <div class="form-group">
              <label for="desperson">RG</label>
              <input type="text" class="form-control" id="des_rg" name="des_rg" placeholder="N° do RG" value="<?php echo htmlspecialchars( $user["des_rg"], ENT_COMPAT, 'UTF-8', FALSE ); ?>">
            </div>
            <div class="form-group">
              <label for="desperson">Remuneração</label>
              <input type="text" class="form-control" id="num_salario" name="num_salario" placeholder="Remuneração" value="<?php echo htmlspecialchars( $user["num_salario"], ENT_COMPAT, 'UTF-8', FALSE ); ?>">
            </div>
            <div class="form-group">
              <label for="nrphone">Telefone</label>
              <input type="tel" class="form-control" id="nr_phone" name="nr_phone" placeholder="Digite o Telefone"  value="<?php echo htmlspecialchars( $user["nr_phone"], ENT_COMPAT, 'UTF-8', FALSE ); ?>">
            </div>
            <div class="form-group">
              <label for="desemail">E-mail</label>
              <input type="email" class="form-control" id="des_email" name="des_email" placeholder="Digite o E-mail" value="<?php echo htmlspecialchars( $user["des_email"], ENT_COMPAT, 'UTF-8', FALSE ); ?>">
            </div>
            <div class="form-group">
              <label for="deslogin">Usuário</label>
              <input type="text" class="form-control" id="des_login" name="des_login" placeholder="Digite o Usuário"  value="<?php echo htmlspecialchars( $user["des_login"], ENT_COMPAT, 'UTF-8', FALSE ); ?>">
            </div>
            <div class="checkbox">
              <label>
                <input type="checkbox" name="inadmin" value="1" <?php if( $user["inadmin"] == 1 ){ ?>checked<?php } ?>> Acesso de Administrador
              </label>
            </div>
          </div>
          <!-- /.box-body -->
          <div class="box-footer">
            <button type="submit" class="btn btn-primary">Salvar</button>
          </div>
        </form>
      </div>
  	</div>
  </div>

</section>
<!-- /.content -->
</div>
<!-- /.content-wrapper -->