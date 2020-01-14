<?php if(!class_exists('Rain\Tpl')){exit;}?><!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
<!-- Content Header (Page header) -->
<section class="content-header">
  <h1>    
    JSL Distribuidora - Vales de Funcionários - Mês <?php echo htmlspecialchars( $month, ENT_COMPAT, 'UTF-8', FALSE ); ?>
  </h1>
  <ol class="breadcrumb">
    <li><a href="/"><i class="fa fa-dashboard"></i> Inicio</a></li>
    <li class="active"><a href="/users">Vales</a></li>
  </ol>
</section>

<!-- Main content -->
<section class="content">
  <!--<h2><label style="width: 200px"> VALES A PAGAR </label></h2>-->
  <div class="row">
  	<div class="col-md-12">
  		<div class="box box-primary">
            
            <!--<div class="box-header">-->
              
            <!--</div>-->
            
            <div class="box-body no-padding">
              <table class="table table-striped">
                <thead>
                  <tr>
                    <th style="width: 50px">#</th>
                    <th style="width: 250px">Nome</th>
                    <th style="width: 200px">Valor do Vale</th>                    
                    <th style="width: 200px">Situação</th>
                    <th style="width: 200px">Data Solicitada</th>
                    <!-- <th>Telefone</th> -->
                    <!-- <th>N° PIS</th> -->
                    <!-- <th>CPF</th> -->
                    <!-- <th>RG</th> --> 
                    <!-- <th>Remuneração</th> -->
                    <!-- <th style="width: 60px">Admin</th> -->
                    <!-- <th style="width: 300px">&nbsp;</th> -->
                  </tr>
                </thead>
                <tbody>
                  <?php $counter1=-1;  if( isset($vouchers) && ( is_array($vouchers) || $vouchers instanceof Traversable ) && sizeof($vouchers) ) foreach( $vouchers as $key1 => $value1 ){ $counter1++; ?>
                    <?php if( ($value1["des_status"] === 'Em Aberto') ){ ?>
                  <tr>
                    <td><?php echo htmlspecialchars( $value1["id_voucher"], ENT_COMPAT, 'UTF-8', FALSE ); ?></td>
                    <td><?php echo htmlspecialchars( $value1["des_person"], ENT_COMPAT, 'UTF-8', FALSE ); ?></td>
                    <td>R$ <?php echo formatPrice($value1["int_valor"]); ?></td>                      
                    <td><?php echo htmlspecialchars( $value1["des_status"], ENT_COMPAT, 'UTF-8', FALSE ); ?></td>
                    <td><?php echo formatDate($value1["dt_register_voucher"]); ?></td>
                    <td>
                      <a href="/vouchers/pay/<?php echo htmlspecialchars( $value1["id_voucher"], ENT_COMPAT, 'UTF-8', FALSE ); ?>/<?php echo htmlspecialchars( $value1["id_user"], ENT_COMPAT, 'UTF-8', FALSE ); ?>" onclick="return confirm('O VALE FOI ENTREGUE AO FUNCIONÁRIO?')" class="btn btn-success btn-xs"> PAGAR</a>
                      <!-- <a href="#" class="btn btn-primary btn-xs"><i class="fa fa-edit"></i> Editar</a> -->
                      <a href="/vouchers/<?php echo htmlspecialchars( $value1["id_voucher"], ENT_COMPAT, 'UTF-8', FALSE ); ?>/<?php echo htmlspecialchars( $value1["id_user"], ENT_COMPAT, 'UTF-8', FALSE ); ?>/delete" onclick="return confirm('Deseja realmente excluir este registro?')" class="btn btn-danger btn-xs"><i class="fa fa-trash"></i> Excluir</a>
                    </td>
                  </tr> 
                    <?php } ?>
                  <?php } ?>
                  <!-- <?php $counter1=-1;  if( isset($users) && ( is_array($users) || $users instanceof Traversable ) && sizeof($users) ) foreach( $users as $key1 => $value1 ){ $counter1++; ?>
                  <tr>
                    <td><?php echo htmlspecialchars( $value1["id_user"], ENT_COMPAT, 'UTF-8', FALSE ); ?></td>
                    <td><?php echo htmlspecialchars( $value1["des_person"], ENT_COMPAT, 'UTF-8', FALSE ); ?></td>
                    <td><?php echo htmlspecialchars( $value1["des_email"], ENT_COMPAT, 'UTF-8', FALSE ); ?></td>
                    <td><?php echo htmlspecialchars( $value1["des_login"], ENT_COMPAT, 'UTF-8', FALSE ); ?></td/>
                    <td><?php echo htmlspecialchars( $value1["nr_phone"], ENT_COMPAT, 'UTF-8', FALSE ); ?></td/>
                    <td><?php echo htmlspecialchars( $value1["des_pis"], ENT_COMPAT, 'UTF-8', FALSE ); ?></td/>
                    <td><?php echo htmlspecialchars( $value1["des_cpf"], ENT_COMPAT, 'UTF-8', FALSE ); ?></td/>
                    <td><?php echo htmlspecialchars( $value1["des_rg"], ENT_COMPAT, 'UTF-8', FALSE ); ?></td/>
                    <td><?php echo htmlspecialchars( $value1["num_salario"], ENT_COMPAT, 'UTF-8', FALSE ); ?></td/>
                    <td><?php if( $value1["inadmin"] == 1 ){ ?>Sim<?php }else{ ?>Não<?php } ?></td>
                    <td>
                      <a href="/users/<?php echo htmlspecialchars( $value1["id_user"], ENT_COMPAT, 'UTF-8', FALSE ); ?>" class="btn btn-primary btn-xs"><i class="fa fa-edit"></i> Editar</a>
                      <a href="/users/<?php echo htmlspecialchars( $value1["id_user"], ENT_COMPAT, 'UTF-8', FALSE ); ?>/delete" onclick="return confirm('Deseja realmente excluir este registro?')" class="btn btn-danger btn-xs"><i class="fa fa-trash"></i> Excluir</a>
                    </td>
                  </tr>
                  <?php } ?> -->
                </tbody>
              </table>
            </div>            
            <!-- /.box-body -->
          </div>
  	</div>
  </div>


  <div class="row">
    <div class="col-md-12">
      <div class="box box-primary">
            
            <!--<div class="box-header">-->
              
            <!--</div>-->
            
            <div class="box-body no-padding">
              <table class="table table-striped">
                <thead>
                  <tr>
                    <th style="width: 50px">#</th>
                    <th style="width: 250px">Nome</th>
                    <th style="width: 200px">Valor do Vale</th>                    
                    <th style="width: 200px">Situação</th>
                    <th style="width: 200px">Data Solicitada</th>                    
                  </tr>
                </thead>
                <tbody>
                  <?php $counter1=-1;  if( isset($vouchers) && ( is_array($vouchers) || $vouchers instanceof Traversable ) && sizeof($vouchers) ) foreach( $vouchers as $key1 => $value1 ){ $counter1++; ?>
                    <?php if( ($value1["des_status"] === 'Pago') ){ ?>
                  <tr>
                    <td><?php echo htmlspecialchars( $value1["id_voucher"], ENT_COMPAT, 'UTF-8', FALSE ); ?></td>
                    <td><?php echo htmlspecialchars( $value1["des_person"], ENT_COMPAT, 'UTF-8', FALSE ); ?></td>
                    <td>R$ <?php echo formatPrice($value1["int_valor"]); ?></td>                      
                    <td><?php echo htmlspecialchars( $value1["des_status"], ENT_COMPAT, 'UTF-8', FALSE ); ?></td>
                    <td><?php echo formatDate($value1["dt_register_voucher"]); ?></td>
                    <td></td>
                    <td></td>                    
                  </tr> 
                    <?php } ?>                 
                  <?php } ?>

                </tbody>
              </table>
            </div>            
            <!-- /.box-body -->
          </div>
    </div>
  </div>

</section>
<!-- /.content -->
</div>
<!-- /.content-wrapper -->