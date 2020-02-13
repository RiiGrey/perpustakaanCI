
<script>
 
 $(document).ready(function() {
  
 
     //datatables
     $('#datatable').DataTable({ 
  
         "processing": true, 
         "serverSide": true, 
         "order": [], 
  
         // Load data for the table's content from an Ajax source
         "ajax": {
             "url": "<?php echo site_url('pinjam/fetchPinjam')?>",
             "type": "POST"
         },
  
         //Set column definition initialisation properties.
         "columnDefs": [
         { 
             "targets": [ 0 ], 
             "orderable": false,
         },
         ],
  
     });
  
 });
 
 
 </script>
 