<?php if(!class_exists('Rain\Tpl')){exit;}?><!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
<!-- Content Header (Page header) -->
<section class="content-header">
  <h1>
    Lancamento de Vale
  </h1>
  <ol class="breadcrumb">
    <li><a href="/"><i class="fa fa-dashboard"></i> Inicio</a></li>
    <li><a href="/vouchers">Vales</a></li>
    <li class="active"><a href="/voucher/create">Lançar</a></li>
  </ol>
</section>

<!-- Main content -->
<section class="content">

  <div class="row">
  	<div class="col-md-5">
  		<div class="box box-success">
        <div class="box-header with-border">
          <h3 class="box-title"> Olá - <?php echo htmlspecialchars( $user, ENT_COMPAT, 'UTF-8', FALSE ); ?></h3>          
        </div>
        <!-- /.box-header -->
        <!-- form start -->
        <?php if( $MsgError != '' ){ ?>
          <div class="alert alert-danger">
            <?php echo htmlspecialchars( $MsgError, ENT_COMPAT, 'UTF-8', FALSE ); ?>
          </div>
        <?php } ?>
        <form role="form" action="/voucher/create" method="post">
          <div class="box-body">
            <div class="form-group">
              <label for="desperson">VALOR DO VALE</label>
              <input type="text" class="form-control" id="int_valor" name="int_valor" placeholder="Digite o valor do vale">
            </div>                                  
          </div>
          <!-- /.box-body -->
          <div class="box-footer">
            <button type="submit" class="btn btn-success">Lançar</button>
          </div>
        </form>
      </div>
  	</div>
  </div>

</section>
<!-- /.content -->
</div>
<!-- /.content-wrapper -->