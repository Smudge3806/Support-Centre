<!DOCTYPE html>
<html>

<head>
<meta content="text/html; charset=utf-8" http-equiv="Content-Type">
<title>Untitled 1</title>
<link rel="stylesheet" href="styles/metro.css">
<link rel="stylesheet" href="styles/main.css">
<link rel="stylesheet" href="styles/about.css">
<link rel="stylesheet" href="styles/pie.css">
<style type="text/css">
	#username
	{
		opacity:0;
	}
</style>
<script type="text/javascript">
	var fadeEffect=function(){
    return{
        init:function(id, flag, target){
            this.elem = document.getElementById(id);
            clearInterval(this.elem.si);
            this.target = target ? target : flag ? 100 : 0;
            this.flag = flag || -1;
            this.alpha = this.elem.style.opacity ? parseFloat(this.elem.style.opacity) * 100 : 0;
            this.si = setInterval(function(){fadeEffect.tween()}, 20);
        },
        tween:function(){
            if(this.alpha == this.target){
                clearInterval(this.si);
            }else{
                var value = Math.round(this.alpha + ((this.target - this.alpha) * .05)) + (1 * this.flag);
                this.elem.style.opacity = value / 100;
                this.elem.style.filter = 'alpha(opacity=' + value + ')';
                this.alpha = value
            }
        }
    }
}();
</script>
</head>

<body>
	<a href="#" onclick="fadeEffect.init('username', 1)">Change Username</a>
	<div class="container" id="username">
		<p>Hello</p>
		<a href="" onclick="fadeEffect.init('username', 0)">Close</a>
	</div>
</body>

</html>
