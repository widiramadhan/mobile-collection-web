<style>
.title{
	font-size : 100px;
	font-weight : bold;
}
.sub-title{
	font-size : 50px;
	font-weight : bold;
}
</style>
<div class="row" style="margin-top:100px;">
	<div class="col-md-12">
		<center>
			<div class="title">404</div>
			<div class="sub-title">Page not found</div>
			<h4>The page you are looking for doesn't exist or an other error occurred. <br><a href = "javascript:history.back()">Go Back to Home</a> to choose a new direction.</h4>
		</center>
	</div>
</div>
<script type="text/javascript">
document.addEventListener("contextmenu", function(e){
    e.preventDefault();
}, false);
document.onkeydown = function(e) {
if(event.keyCode == 123) {
	return false;
	}
	if(e.ctrlKey && e.shiftKey && e.keyCode == 'I'.charCodeAt(0)){
	return false;
	}
	if(e.ctrlKey && e.shiftKey && e.keyCode == 'J'.charCodeAt(0)){
	return false;
	}
	if(e.ctrlKey && e.keyCode == 'U'.charCodeAt(0)){
	return false;
	}
	if(e.ctrlKey && e.shiftKey && e.keyCode == 'C'.charCodeAt(0)){
	return false;
	}

	}
</script>