
		<?php foreach ($this->cart->contents() as $items){ ?>
			<tr>
				<td><?= $items['kodebuku'] ?></td>	 
				<td><?= $items['judul'] ?></td> 
				<td><?= $items['qty'] ?></td>
				<td><?= $items['harga'] ?></td>
				<td><?= $total = $items['harga']*$items['qty'] ?></td>
				<td><a onClick='delete_row("<?= $items['rowid'] ?>")'>Hapus</a></td>			
			</tr>
		<?php
		}
		?> 
		
<script>
var site_url = '<?=site_url()?>';

function delete_row (id){
$.get(site_url+'/myigniter/deleterow/'+id, function(data) {
	/*optional stuff to do after success */
	kolom();
	total();
	});
}
</script>