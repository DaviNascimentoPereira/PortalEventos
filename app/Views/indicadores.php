<?php
    defined('BASEPATH') OR exit('No direct script access allowed');
?>

<?php
    $jquery_head = true;

    include_once('application/views/static/head.php');
?>

<style type="text/css">
    footer{display:none;}
</style>

<script type="text/javascript" src="includes/Chart.js"></script>

<script type="text/javascript">
    $(document).ready(function(){
        
        window.location.hash = '<?php echo $post['area']; ?>';
    
        var colors = ['#007bff','#28a745','#333333','#c3e6cb','#dc3545','#6c757d'];
        
        <?php
            
            foreach($graficos as $key => $grafico){
        ?>
        var ch_<?php echo $key; ?> = document.getElementById('ch_<?php echo $key; ?>');
        
        var chartData = {
          labels: [<?php echo $grafico['labels']; ?>],
          datasets: [{
            data: [<?php echo $grafico['data']; ?>],
            backgroundColor: 'transparent',
            borderColor: colors[0],
            borderWidth: 4,
            pointBackgroundColor: colors[0]
          }]
        };
        
        if (ch_<?php echo $key; ?>) {
          new Chart(ch_<?php echo $key; ?>, {
          type: 'line',
          data: chartData,
          options: {
            scales: {
              xAxes: [{
                ticks: {
                  beginAtZero: false
                }
              }]
            },
            legend: {
              display: false
            },
            responsive: true
          }
          });
        }
        
        <?php
            }
        ?>
                
        $('button[type=submit]').click(function(){
            
            $('input[name=area]').val($(this).attr('data-area'));
            
        });

    });
</script>

<style type="text/css">
    .busca{margin-top: 20px;margin-bottom: 20px;}
    .clearfix{height:30px;clear: both;border-bottom: 1px dashed #ccc;margin-bottom: 20px;}
    tbody tr:hover{background: #f9fae8;}
    .total{font-weight: bold;background: #efefef;}
</style>

<div class="container">
    <h1>Indicadores - CRF-SP</h1>
    
    <?php
        $cont = 0;
        
        foreach($graficos as $key => $grafico){
    ?>
    
        <div class="col-md-6">
            
            <h3><?php echo $grafico['nome']; ?></h3>
            
            <div class="card">
                <div class="card-body">
                    <canvas id="ch_<?php echo $key; ?>" class="charts"></canvas>
                </div>
            </div>
        </div>
    <?php
            $cont++;
            
            if($cont % 2 == 0){
                echo '<div class="clearfix"></div>';
            }
            
        }
    ?>
    
    <div class="clearfix"></div>
    
    <form name="" method="post" action="<?php echo current_url(); ?>">
        
        <div class="col-md-6">
            <h3><?php echo $farmaceuticosAtuacao['nome']; ?></h3>
            
            <table class="table">

                <thead>
                    <tr>
                        <th>Ramo</th>
                        <th>Total</th>
                    </tr>
                </thead>

                <tbody>

            <?php
                $total = 0;
                foreach($farmaceuticosAtuacao['dados'] as $linha){

                    echo '
                    <tr>
                        <td>'.trim($linha['ramo']).'</td>
                        <td>'.$linha['total'].'</td>
                    </tr>';
                    
                    $total += $linha['total'];

                }
                
                echo '
                    <tr class="total">
                        <td>TOTAL</td>
                        <td>'.$total.'</td>
                    </tr>';
                
            ?>
                </tbody>
            </table>
        </div>
        
        <div class="col-md-6">
            <h3 id="ind5"><?php echo $estabAtivos['nome']; ?></h3>
            
            <div class="row busca">
                <div class="col-md-4">
                    <select name="ind5_mes" class="form-control">
                        <?php
                            foreach($meses as $key => $value){
                                if($post['ind5_mes'] == $key){
                                    echo '<option value="'.$key.'" selected>'.$value.'</option>';
                                }else{
                                    echo '<option value="'.$key.'">'.$value.'</option>';
                                }
                            }
                        ?>
                    </select>
                </div>
                <div class="col-md-4">
                    <select name="ind5_ano" class="form-control">
                        <?php
                            for($ano = date('Y') - 2; $ano <= date('Y'); $ano++){
                                if($post['ind5_ano'] == $ano){
                                    echo '<option value="'.$ano.'" selected>'.$ano.'</option>';
                                }else{
                                    echo '<option value="'.$ano.'">'.$ano.'</option>';
                                }
                            }
                        ?>
                    </select>
                </div>
                <div class="col-md-4">
                    <button type="submit" class="btn btn-primary" data-area="ind5"><i class="fa fa-refresh"></i> Atualizar</button>
                </div>
            </div>

            <table class="table">

                <thead>
                    <tr>
                        <th>Ramo</th>
                        <th>Total</th>
                    </tr>
                </thead>

                <tbody>

            <?php
                $total = 0;
                
                foreach($estabAtivos['dados'] as $linha){

                    echo '
                    <tr>
                        <td>'.trim($linha['ramo']).'</td>
                        <td>'.$linha['total'].'</td>
                    </tr>';
                    
                    $total += $linha['total'];

                }
                
                echo '
                    <tr class="total">
                        <td>TOTAL</td>
                        <td>'.$total.'</td>
                    </tr>';
            ?>
                </tbody>
            </table>
        </div>
        <!--INICIO INCLUSÃO ATENDIMENTO PELO E-CAT -->
        <div class="clearfix"></div>
        
<div class="col-md-6">
            <h3 id="ind8"><?php echo $atdEcat['nome']; ?></h3>

            <div class="row busca">
                <div class="col-md-3">
                    <select name="ind8_mes" class="form-control">
                        <?php
                            foreach($meses as $key => $value){
                                if($post['ind8_mes'] == $key){
                                    echo '<option value="'.$key.'" selected>'.$value.'</option>';
                                }else{
                                    echo '<option value="'.$key.'">'.$value.'</option>';
                                }
                            }
                        ?>
                    </select>
                </div>
                <div class="col-md-3">
                    <select name="ind8_ano" class="form-control">
                        <?php
                            for($ano = date('Y') - 2; $ano <= date('Y'); $ano++){
                                if($post['ind8_ano'] == $ano){
                                    echo '<option value="'.$ano.'" selected>'.$ano.'</option>';
                                }else{
                                    echo '<option value="'.$ano.'">'.$ano.'</option>';
                                }
                            }
                        ?>
                    </select>
                </div>
                <div class="col-md-3">
                    <button type="submit" class="btn btn-primary" data-area="ind8"><i class="fa fa-refresh"></i> Atualizar</button>
                </div>
            </div>
            <table class="table">

                <thead>
                    <tr>
                        <th>Sistema</th>
                        <th>Assunto</th>
                        <th>Total</th>  <!--A SOMA DO TOTAL REALIZADO SÃO AUTENTICADOS, EM TRAMITE, AGUARDANDO PAGAMENTO, CANCELADOS, NÃO FOI SOMADO EXIGENCIAS-->
                    </tr>
                </thead>

                <tbody>

          <?php
              $total = 0;

              foreach($atdEcat['dados'] as $linha){

                  echo '
                  <tr>
                      <td>'.trim($linha['seccional']).'</td>
                      <td>'.$linha['assunto'].'</td>
                      <td>'.$linha['total'].'</td>
                  </tr>';

                  $total += $linha['total'];

              }

              echo '
                  <tr class="total">
                      <td>TOTAL</td>
                      <td></td>
                      <td>'.$total.'</td>
                  </tr>';
          ?>
                </tbody>
            </table>
        </div>
        <!--FIM INCLUSÃO ATENDIMENTO PELO E-CAT -->

        <div class="clearfix"></div>

        <div class="col-md-6">
            <h3 id="ind6"><?php echo $atdSecAssunto['nome']; ?></h3>
            
            <div class="row busca">
                <div class="col-md-3">
                    <select name="ind6_seccional" class="form-control">
                        <option value="">Seccional (todas)</option>
                        <?php
                            foreach($atdSecAssunto['seccionais'] as $linha){
                                $sec = trim($linha['seccional']);
                                
                                if($post['ind6_seccional'] == $sec){
                                    echo '<option value="'.$sec.'" selected>'.$sec.'</option>';
                                }else{
                                    echo '<option value="'.$sec.'">'.$sec.'</option>';
                                }
                            }
                        ?>
                    </select>
                </div>
                <div class="col-md-3">
                    <select name="ind6_mes" class="form-control">
                        <?php
                            foreach($meses as $key => $value){
                                if($post['ind6_mes'] == $key){
                                    echo '<option value="'.$key.'" selected>'.$value.'</option>';
                                }else{
                                    echo '<option value="'.$key.'">'.$value.'</option>';
                                }
                            }
                        ?>
                    </select>
                </div>
                <div class="col-md-3">
                    <select name="ind6_ano" class="form-control">
                        <?php
                            for($ano = date('Y') - 2; $ano <= date('Y'); $ano++){
                                if($post['ind6_ano'] == $ano){
                                    echo '<option value="'.$ano.'" selected>'.$ano.'</option>';
                                }else{
                                    echo '<option value="'.$ano.'">'.$ano.'</option>';
                                }
                            }
                        ?>
                    </select>
                </div>
                <div class="col-md-3">
                    <button type="submit" class="btn btn-primary" data-area="ind6"><i class="fa fa-refresh"></i> Atualizar</button>
                </div>
            </div>

            <table class="table">

                <thead>
                    <tr>
                        <th>Seccional</th>
                        <th>Assunto</th>
                        <th>Total</th>
                    </tr>
                </thead>

                <tbody>
                    <!-- ANTIGO SEM VALOR TOTAL
            <?php
                foreach($atdSecAssunto['dados'] as $linha){

                    echo '
                    <tr>
                        <td>'.trim($linha['seccional']).'</td>
                        <td>'.$linha['assunto'].'</td>
                        <td>'.$linha['total'].'</td>
                    </tr>';

                }
            ?>
            -->
              <!-- INICIO TESTE valor TOTAL -->
            <?php
             $total = 0;

                foreach($atdSecAssunto['dados'] as $linha){

                    echo '
                    <tr>
                        <td>'.trim($linha['seccional']).'</td>
                        <td>'.$linha['assunto'].'</td>
                        <td>'.$linha['total'].'</td>
                    </tr>';

                    $total += $linha['total'];

                }

                echo '
                    <tr class="total">
                        <td>TOTAL</td>
                        <td></td>
                        <td>'.$total.'</td>
                    </tr>';
            ?>
            <!-- FIM TESTE valor TOTAL -->

                </tbody>
            </table>
        </div>

        <div class="col-md-6">
            <h3 id="ind7"><?php echo $atdSecContato['nome']; ?></h3>

            <div class="row busca">
                <div class="col-md-3">
                    <select name="ind7_seccional" class="form-control">
                        <option value="">Seccional (todas)</option>
                        <?php
                            foreach($atdSecContato['seccionais'] as $linha){
                                $sec = trim($linha['seccional']);
                                
                                if($post['ind7_seccional'] == $sec){
                                    echo '<option value="'.$sec.'" selected>'.$sec.'</option>';
                                }else{
                                    echo '<option value="'.$sec.'">'.$sec.'</option>';
                                }
                            }
                        ?>
                    </select>
                </div>
                <div class="col-md-3">
                    <select name="ind7_mes" class="form-control">
                        <?php
                            foreach($meses as $key => $value){
                                if($post['ind7_mes'] == $key){
                                    echo '<option value="'.$key.'" selected>'.$value.'</option>';
                                }else{
                                    echo '<option value="'.$key.'">'.$value.'</option>';
                                }
                            }
                        ?>
                    </select>
                </div>
                <div class="col-md-3">
                    <select name="ind7_ano" class="form-control">
                        <?php
                            for($ano = date('Y') - 2; $ano <= date('Y'); $ano++){
                                if($post['ind7_ano'] == $ano){
                                    echo '<option value="'.$ano.'" selected>'.$ano.'</option>';
                                }else{
                                    echo '<option value="'.$ano.'">'.$ano.'</option>';
                                }
                            }
                        ?>
                    </select>
                </div>
                <div class="col-md-3">
                    <button type="submit" class="btn btn-primary" data-area="ind7"><i class="fa fa-refresh"></i> Atualizar</button>
                </div>
            </div>

            <table class="table">

                <thead>
                    <tr>
                        <th>Seccional</th>
                        <th>Contato</th>
                        <th>Total</th>
                    </tr>
                </thead>

                <tbody>
                    <!--
            <?php
                foreach($atdSecContato['dados'] as $linha){

                    echo '
                    <tr>
                        <td>'.trim($linha['seccional']).'</td>
                        <td>'.$linha['contato'].'</td>
                        <td>'.$linha['total'].'</td>
                    </tr>';

                }
            ?>
          -->
            <!-- INICIO TESTE valor TOTAL -->
            <?php
                $total = 0;

                foreach($atdSecContato['dados'] as $linha){

                    echo '
                    <tr>
                        <td>'.trim($linha['seccional']).'</td>
                        <td>'.$linha['contato'].'</td>
                        <td>'.$linha['total'].'</td>
                    </tr>';

                    $total += $linha['total'];

                }

                echo '
                  <tr class="total">
                      <td>TOTAL</td>
                      <td></td>
                      <td>'.$total.'</td>
                  </tr>';
            ?>
            <!-- FIM TESTE valor TOTAL -->
                </tbody>
            </table>
        </div>
        
        <input type="hidden" name="area" value="" />
        
    </form>
    
    <div class="clearfix"></div>
    
</div>
    
<?php
    include_once('application/views/static/footer.php');
?>