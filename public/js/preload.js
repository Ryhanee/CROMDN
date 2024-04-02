$(function () {
	var preload =$('#preload');
	var loading=0;
	var id=setInterval(frame,2000);

	function frame(){
		if($('#IdUser'))
		{
			clearInterval(id);
			window.open('home','_self');
		}
		else
		{
			if (loading==3000)
			{
				clearInterval(id);
			
					window.open('showLogin','_self');	
			}
			else
			{
				loading=loading+1;
				if (loading==2250)
				{
					preload.style.animation="fadout 1s ease";
				}
			}
		}
	}

});