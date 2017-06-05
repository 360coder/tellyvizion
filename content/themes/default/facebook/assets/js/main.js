function Main(){
	var self= this;
	var show_timeout = 0;
	this.init= function(){
		self.resize();
		if($('.listCore').length > 0){
			self.chart();
		}
		$('.listCore').height($(window).height());
		$('.listCore').width($('.box-listCore').width());
		$('.listCore a').click(function(){
			_id = $(this).attr("href");
			$('html,body').animate({ scrollTop: $(_id).offset().top - 50},'medium');
			return false;
		});
		
		if($('.datepicker').length > 0){
			$('.datepicker').daterangepicker({dateLimit: { months: 3 }});
		}

		$('.CheckAll').click(function(){
			_that = $(this);
			if(_that.is(':checked')){
				$('.checkItem').prop('checked', true);
			}else{
				$('.checkItem').prop('checked', false);
			}
		});

		$('.btnDeleteAll').click(function(){
			_that = $(this);
			_data = $('.formList').serialize();
			_data = _data + '&' + $.param({_token:token});
			var popup = confirm("Are you sure delete item?");
			if (popup == true) {
				if(!_that.hasClass('disable')){
					_that.addClass('disable');
					self.show_notice('System processing...', 'error');
					$.post(PATH + "/facebook/postDeleteAll", _data, function(data){
						window.location.reload();
						_that.removeClass('disable');
					},'json');
				}
			}

			return false;
		});

		$('.btnStatusAll').click(function(){
			_that   = $(this);
			_data   = $('.formList').serialize();
			_status = (_that.hasClass('item-show'))?1:0;
			_data   = _data + '&' + $.param({_token:token,status:_status});

			if(!_that.hasClass('disable')){
				_that.addClass('disable');
				self.show_notice('System processing...', 'error');
				$.post(PATH + "/facebook/postStatusAll", _data, function(data){
					window.location.reload();
					_that.removeClass('disable');
				},'json');
			}

			return false;
		});
		
		$('.btnDelete').click(function(){
			_that = $(this);
			_id   = _that.parents('tr').data('id');
			_data = $.param({_token:token, id:_id});
			var popup = confirm("Are you sure delete item?");
			if (popup == true) {
			   	$.post(PATH + "/facebook/postDelete", _data, function(data){
			   		if(data.st == 'success'){
						window.location.reload();
					}else{
						alert(data.txt);
					}
			   	},'json');
			}
		});

		$('.formUpdate').submit(function(){
			_that = $(this);
			_data = _that.serialize();
			_data = _data + '&' + $.param({_token:token});

			if(!_that.hasClass('disable')){
				_that.addClass('disable');
				self.show_notice('System processing...', 'error');
				$.post(PATH + "/facebook/postUpdate", _data, function(data){
					if(data.st == 'success'){
						self.show_notice(data.txt, data.st);
						setTimeout(function(){
							switch(module){
								case 'Facebook':
									name = 'page';
									break;
								case 'User':
									name = 'user';
									break;
								case 'Facebook_category':
									name = 'category';
									break;
								default:
									name = module;
									break;
							}
							window.location.assign(PATH + name);
						},1000);
					}else{
						self.show_notice(data.txt, data.st);
					}
					_that.removeClass('disable');
				},'json');
			}

			return false;
		});

		$('.formPermission').submit(function(){
			_that = $(this);
			_data = _that.serialize();
			_data = _data + '&' + $.param({_token:token});

			if(!_that.hasClass('disable')){
				_that.addClass('disable');
				self.show_notice('System processing...', 'error');
				$.post(PATH + "/facebook/postPermission", _data, function(data){
					if(data.st == 'success'){
						self.show_notice(data.txt, data.st);
						setTimeout(function(){
							switch(module){
								case 'Facebook':
									name = 'page';
									break;
								case 'User':
									name = 'user';
									break;
								case 'Facebook_category':
									name = 'category';
									break;
								default:
									name = module;
									break;
							}
							window.location.assign(PATH + name);
						},1000);
					}else{
						self.show_notice(data.txt, data.st);
					}
					_that.removeClass('disable');
				},'json');
			}

			return false;
		});

		$('.formUpdatePassword').submit(function(){
			_that = $(this);
			_data = _that.serialize();
			_data = _data + '&' + $.param({_token:token});

			if(!_that.hasClass('disable')){
				_that.addClass('disable');
				self.show_notice('System processing...', 'error');
				$.post(PATH + "User/postUpdatePassword", _data, function(data){
					if(data.st == 'success'){
						self.show_notice(data.txt, data.st);
						setTimeout(function(){
							window.location.assign(PATH);
						},1000);
					}else{
						self.show_notice(data.txt, data.st);
					}
					_that.removeClass('disable');
				},'json');
			}

			return false;
		});

		//Menu Page
        var topMenu = $(".listCore"),
        topMenuHeight = -70,

        // All list items
        menuItems = topMenu.find("a"),

        // Anchors corresponding to menu items
        scrollItems = menuItems.map(function(){
          	var item = $($(this).attr("href"));
          	if (item.length) { return item; }
        });

        // Bind to scroll
        $(window).scroll(function(){
            // Get container scroll position
            var fromTop = $(this).scrollTop()+topMenuHeight;

            // Get id of current scroll item
            var cur = scrollItems.map(function(){
            	if ($(this).offset().top < fromTop)
            		return this;
            });

            // Get the id of the current element
            cur = cur[cur.length-1];
            var id = cur && cur.length ? cur[0].id : "";

            // Set/remove active class
            menuItems
                .parent().removeClass("active")
                .end().filter("[href=#"+id+"]").parent().addClass("active");
        });

		$(window).scroll(function(){
			var pos_scroll = $(window).scrollTop();
			if(pos_scroll >= 0){
				$('.listCore').addClass('fixed');
			}else{
				$('.listCore').removeClass('fixed');
			}
		});
	};

	this.CountValue = function(element, data){
		var CountValue = 0;
        $.each(data, function(index,value){
            CountValue += value[1];
        });
        $("."+element).html(self.formatNumber(CountValue));
	};

	this.MostValue = function(element, data){
		var MostValue = 0;
		var Key = 0;
        $.each(data, function(index,value){
        	if(MostValue < value[1]){
        		MostValue = value[1];
            	Key = value[0];
        	}
        });
        $("."+element).html(self.formatNumber(Key));
	};

	this.AvgValue = function(element, data){
		var MostValue = 0;
		var Key = 0;
        $.each(data, function(index,value){
            Key++;
    		MostValue += value[1];
        });
        $("."+element).html(Math.round(MostValue/Key));
	};

	this.formatNumber = function(number)
	{
	    var number = number.toFixed(2) + '';
	    var x = number.split('.');
	    var x1 = x[0];
	    var x2 = x.length > 1 ? '.' + x[1] : '';
	    var rgx = /(\d+)(\d{3})/;
	    while (rgx.test(x1)) {
	        x1 = x1.replace(rgx, '$1' + ',' + '$2');
	    }
	    return x1 + x2;
	};

	this.chart = function(){
		_timeout = 0;
		setTimeout(function(){ self.ajax_chart('reachchart'); },_timeout);

		_timeout += 2000;
		setTimeout(function(){ self.ajax_chart('postschart'); },_timeout);

		_timeout += 2000;
		setTimeout(function(){ self.ajax_chart('tabchart'); },_timeout);

		_timeout += 4000;
		setTimeout(function(){ self.ajax_chart('fanschart'); },_timeout);

		_timeout += 2000;
		setTimeout(function(){ self.ajax_chart('likeschart'); },_timeout);

		_timeout += 2000;
		setTimeout(function(){ self.ajax_chart('genderchart'); },_timeout);

		_timeout += 2000;
		setTimeout(function(){ self.ajax_chart('countrychart'); },_timeout);

		_timeout += 2000;
		setTimeout(function(){ self.ajax_chart('citychart'); },_timeout);
		
		_timeout += 2000;
		setTimeout(function(){ self.ajax_chart('sourcechart'); },_timeout);
	};

	this.ajax_chart = function(element){
		$('.' + element).html('');
		self.startPageLoading('.' + element);
		_daterange = $('.daterange').val();
		_data = $.param({_token:token, daterange: _daterange});
		$.post(PATH + '/ajax_' + element, _data, function(data){
			$('.' + element).html(data);
			self.stopPageLoading('.' + element);
		});
	};

	this.Highcharts = function(options){
		$(options.element).highcharts({
	        chart: {
	            zoomType: 'x',
	            height  : (options.height)?options.height:350
	        },
	        title: {
	            text: (options.title)?options.title:''
	        },
	        subtitle: {
	            text: (options.subtitle)?options.subtitle:''
	        },
	        xAxis: {
	            type: (options.titlex)?options.titlex:'',
	            dateTimeLabelFormats: {
                    day: (options.format)?options.format:'%b %e',
                },
                tickInterval: (options.tick)?1:0,
                labels: {
		            enabled: true,
	            	formatter: function() { return (options.formatterx)?options.data[this.value][0]:moment(this.value).format("MMM D"); },
		        }
	        },
	        yAxis: {
	            title: {
	                text: (options.titley)?options.titley:''
	            }
	        },
	        legend: {
	            enabled: true
	        },
	        tooltip: {
	            crosshairs: (options.crosshairs)?true:false,
	            shared: true
	        },
	        plotOptions: {
	        	spline: {
	                marker: {
	                    radius: 4,
	                    lineColor: '#666666',
	                    lineWidth: 1
	                }
	            },
	            line: {
	                marker: {
	                    radius: 4,
	                    lineColor: '#666666',
	                    lineWidth: 1
	                },
	                color: (options.colory)?options.colory:Highcharts.getOptions().colors[5]
	            },
	            area: {
	                fillColor: {
	                    linearGradient: {
	                        x1: 0,
	                        y1: 0,
	                        x2: 0,
	                        y2: 1
	                    },
	                    stops: [
	                        [0, (options.colorx)?options.colorx:Highcharts.getOptions().colors[5]],
	                        [1, Highcharts.Color((options.colory)?options.colory:Highcharts.getOptions().colors[5]).setOpacity(1).get('rgba')]
	                    ]
	                },
	                marker: {
	                    radius: 0
	                },
	                color: (options.colory)?options.colory:Highcharts.getOptions().colors[5],
	                lineWidth: 1,
	                states: {
	                    hover: {
	                        lineWidth: 0
	                    }
	                },
	                threshold: null
	            },
	            pie: {
	            	tooltip: {
		        	    valueSuffix: '%',
		        	    pointFormatter: function() {
		        	    	return '<span style="color: '+this.series.tooltipOptions.backgroundColor+'">\u25CF</span> '+this.series.name+': <b>'+self.round(this.percentage,2)+'%</b><br/>.'
		            	}
		            },
	            }
	        },

	        series: (options.multi)?options.data:[{ type: (options.type)?options.type:'line',name: (options.name)?options.name:'', data: (options.data)?options.data:'', dataLabels: (options.dataLabels)?options.dataLabels:'{point.y}' }]
	    });
		list_chart.push(options.element);
	};

	this.colorTop = function(index){
		switch(index){
			case 1:
				color = 'red';
				break;
			case 2:
				color = 'green';
				break;
			case 3:
				color = 'blue';
				break;
			default:
				color = 'grey';
				break;
		}
		return color;
	};

	this.round = function(value, decimals) {
	    return Number(Math.round(value + 'e' + decimals) + 'e-' + decimals);
	};

	this.resizeChart = function(){
		setTimeout(function(){ 
      		jQuery(window).trigger("resize"); 
          		var _width = $('.item-metric').width() - 30;
          		for (var i = 0; i < list_chart.length; i++) {
           		var chart = jQuery(list_chart[i]).highcharts();
            	chart.reflow()
          	};
        }, 300);
	};

	this.resize = function(){
		$(window).resize(function(){
			$('.listCore').height($(window).height());
			$('.listCore').width($('.box-listCore').width());
		});
	};

	this.formatNumber = function(number)
	{
	    var number = number.toFixed(0) + '';
	    var x = number.split('.');
	    var x1 = x[0];
	    var x2 = x.length > 1 ? '.' + x[1] : '';
	    var rgx = /(\d+)(\d{3})/;
	    while (rgx.test(x1)) {
	        x1 = x1.replace(rgx, '$1' + ',' + '$2');
	    }
	    return x1 + x2;
	};

	this.show_notice= function(txt, class_name){
        $('.msg').removeClass('error success').addClass(class_name).html(txt);

        clearTimeout(show_timeout);
        show_timeout = setTimeout(function(){
            $('.msg').html('');
        }, 8000);
    };

    this.startPageLoading = function(element,overplay) {
        if (element) {
            $(element).append('<div class="page-spinner-bar"><div class="bounce1"></div><div class="bounce2"></div><div class="bounce3"></div></div>');
        } else {
            $('body').append('<div class="page-spinner-bar"><div class="bounce1"></div><div class="bounce2"></div><div class="bounce3"></div></div>');
        }
    };

    this.stopPageLoading = function(element) {
        $(element + ' .page-loading, '+element + '.page-spinner-bar').remove();
    };
}
Main= new Main();
$(function(){
	Main.init();
});