import $ from 'jquery';

$(document).ready(function(){
	$('.del').click(function(ev){
		if (!confirm('Вы действительно хотите удалить эту книгу?')) {
			ev.preventDefault();
			return false;
		}
	});
})