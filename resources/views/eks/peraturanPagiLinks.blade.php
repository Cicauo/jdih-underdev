<?php 
echo $get->links();
?>

<script>
$('.pagination a').on('click', function(e){
	e.preventDefault();
	var url = $(this).attr('href');
	$.get(url, null, function(data){
		search(url);
	});
});

$('.pagination').attr('style','z-index: 0;');
</script>