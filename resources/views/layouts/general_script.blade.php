<script>


var curr_menu = location.pathname.substr(1).split('/')[1];
$('.menu-'+curr_menu).addClass('active');

function HoldOn(light){
	$(light).block({
		message: 'Silahkan menunggu <i class="icon-spinner spinner"></i>',
		overlayCSS: {
			backgroundColor: '#1B2024',
			opacity: 0.85,
			cursor: 'wait'
		},
		css: {
			border: 0,
			padding: 0,
			backgroundColor: 'none',
			color: '#fff',
			width:'100%',
			paddingTop:'10px',
			fontSize:'15pt',
		}
	});
}
function HoldOff(light){
	$(light).unblock();
}
</script>