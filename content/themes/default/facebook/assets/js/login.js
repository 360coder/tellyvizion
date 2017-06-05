function Login(){
	var self= this;
	var show_timeout = 0;
	this.init= function(){
		$('.formLogin').submit(function(){
			_that = $(this);
			_data = _that.serialize();
			_data = _data + '&' + $.param({token:token});

			if(!_that.hasClass('disable')){
				_that.addClass('disable');
				self.show_notice('System processing...', 'error');
				$.post(PATH+"User/postLogin", _data, function(data){
					if(data.st == 'success'){
						self.show_notice(data.txt, data.st);
						setTimeout(function(){
							window.location.reload();
						},1000);
					}else{
						self.show_notice(data.txt, data.st);
					}
					_that.removeClass('disable');
				},'json');
			}

			return false;
		});
	};

	this.show_notice= function(txt, class_name){
        $(".msg").removeClass('error success').addClass(class_name).html(txt);

        clearTimeout(show_timeout);
        show_timeout = setTimeout(function(){
            $(".msg").html('');
        }, 8000);
    };
}
Login= new Login();
$(function(){
	Login.init();
});