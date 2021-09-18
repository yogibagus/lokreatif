   <table class="table mt-3">
       <thead class="thead-light">
           <tr>
               <th>Nama Tim</th>
               <th>Bidang Lomba</th>
               <th>Biaya</th>
           </tr>
       </thead>
       <tbody>
           <?php foreach ($tim as $row) { ?>
               <tr>
                   <td scope="row"><?= $row->NAMA_TIM ?></td>
                   <td><?= $row->BIDANG_LOMBA ?></td>
                   <td>Rp <?= number_format($total_team->biaya, 0, ',', '.') ?></td>
               </tr>
           <?php } ?>
           <tr>
               <td></td>
               <td class="text-right">
                   <strong>Fee</strong>
               </td>
               <td>Rp <?= number_format($fee, 0, ',', '.') ?></td>
           </tr>
           <tr>
               <td></td>
               <td class="text-right">
                   <h4>Total Pembayaran</h4>
               </td>
               <td>
                   <h3>
                       Rp <?= number_format($total_bayar, 0, ',', '.') ?>
                   </h3>
               </td>
           </tr>
       </tbody>
   </table>