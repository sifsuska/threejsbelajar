<?php
/*include_once('conf/connect_db.php');*/
include_once('conf/koneksi.php');
?>

<script src="assets/js/w3.js"></script>
<link rel="stylesheet" href="assets/css/w3.css">
<style>
table {
    border-spacing: 0;
    width: 100%;
    border: 1px solid #ddd;
    margin-left: auto;
    margin-right: auto;
}

th {
    cursor: pointer;
}

th, td {
    text-align: center;
    padding: 10px;
}

tr:nth-child(even) {
    background-color: #f2f2f2
}

body
{
    counter-reset: Serial;           /* Set the Serial counter to 0 */
}

tr td:first-child:before
{
  counter-increment: Serial;      /* Increment the Serial counter */
  content: counter(Serial); /* Display the counter */
}
</style>

<h1 align="center">Top Skor</h1>
         <table id="myTable" style="width: 1100px;">

            <tr>
            <th onclick="w3.sortHTML('#myTable', '.item', 'td:nth-child(1)')" style="cursor:pointer">No.</th>
            <th onclick="w3.sortHTML('#myTable', '.item', 'td:nth-child(2)')" style="cursor:pointer">Nama</th>
            <th onclick="w3.sortHTML('#myTable', '.item', 'td:nth-child(3)')" style="cursor:pointer">Jumlah benar</th>
            <th onclick="w3.sortHTML('#myTable', '.item', 'td:nth-child(4)')" style="cursor:pointer">Persentase</th>
           </tr>

           <?php
           $query=mysql_query('select * from quiz_takers');
           while($row=mysql_fetch_assoc($query)){ ?>
           
           <tr class="item">
            <td></td>
            <td><?= $row['username'] ?></td>
            <td><?= $row['marks'] ?></td>
            <td><?= $row['percentage'] ?></td>
           <?php } ?>
        
         </table>
         