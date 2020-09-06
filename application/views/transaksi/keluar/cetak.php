<html>
  <head>
    <meta charset="UTF-8">
      <link href="<?php echo base_url('assets/css/bootstrap.min.css'); ?>" rel="stylesheet" >
        <!-- Ionicons -->
      <link href="<?php echo base_url('assets/css/ionicons.min.css'); ?>" rel="stylesheet">      
  </head>
  <body onload="window.print(); setTimeout(window.close, 0);">
  <style type="text/css">
    table td {
      border-top: none !important;      
    }
    
  </style>
    <section class="invoice">
      <div class="row">
        <div class="col-md-12">     
            <div class="box-header">  
              <h3 class="box-title" align="center"><p class="lead"><i class="fa fa-archive"></i>  <label>SERAH TERIMA BARANG</label></p> </h3>              
               
            </div>
            <div class="col-xs-12">
              <table >
                <tr>
                  <td style="width:25%">No. Transaksi</td>                  
                  <td>: <?php echo $keluar['kode_transaksi']?></td>
                </tr>
                <tr>
                  <td style="width:25%">Tgl Transaksi</td>                  
                  <td>: <?php echo tgl_lengkap($keluar['tgl_transaksi'])?></td>                    
                </tr>
                <tr>
                  <td style="width:25%">Nama Penerima</td>                  
                  <td>: <?php echo $keluar['nama_pengguna']?></td>                    
                </tr>
                <tr>
                  <td style="width:25%">Bagian</td>                  
                  <td>: <?php echo $keluar['nama']?></td>                    
                </tr>
              </table>             
            </div>
            
            <div class="col-xs-12">
            <br>
              <table class="table table-sm table-bordered">
                  <tr>
                    <th style="width:20%">Nama Barang</th>
                    <th style="width:20%">Merek</th>
                    <th>Spesifikasi</th>
                    <th style="width:15%" class="text-center">Qty</th>
                    <th>Keterangan</th>
                  </tr>
                  <tr>
                    <?php                       
                      foreach ($record as $r ) {                    
                        echo'
                          <tr>
                          <td>'.$r->nama_barang.'</td>
                          <td>'.$r->merek_barang.'</td>
                          <td>'.$r->spesifikasi.'</td>                            
                          <td class="text-center">'.$r->qty_keluar.'</td> 
                          <td>'.$r->catatan.'</td> 
                          </tr>';
                      }
                    ?>
                  </tr>                             
              </table>              
                <small class="pull-right">Date: <?php echo tanggal_indo();?></small>         
            </div> 

          </div>        
      </div><br>
      <div class="row">
        <div class="col-xs-4">
        </div>
        <div class="col-xs-4">
          <p>Mengetahui,</p>
          <br><br>
          <p>........................</p>
        </div>
        <div class="col-xs-4">
          <p>Penerima</p>
          <br><br>
          <p><?php echo $keluar['nama_pengguna'] ?></p>
        </div>
      </div>
    </section>
  </body>
</html>