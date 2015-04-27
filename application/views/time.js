$(function(){
	/**
	*Добавляем в левое верхнее меню часы
	*/
	var dur = 4350;//Длительность анимации
	var time = function(){
		var go = function(){
			//Возвращяет строку с ошибкой или строку времени розделённую ТЭГОМ!
			var getTime = function(){
				try{
					var time = new Date();
					var date = time.getDate()+'';
					var month = time.getMonth()+1+'';
					var year = String(Number(time.getYear()) + 1900);
					var hms = time.toTimeString().slice(0,8);
					var res = date+'.'+month+'.'+year+'<br>'+hms;
				}catch(e){
					return e.message;
				}
				delete time;
				return res;
			};
			//Добавляет актуальное время в элемент меню
			var add = function(){
				//$('div.menu ul.menu li.time a img').hide();
				var timeA = $('div.menu ul.menu li.time a');
				if(timeA.text() === ''){
					var h = timeA.width();
					timeA.css({
						'width': '0',
						'opacity': 0
						});
					timeA.html(res);
					timeA.animate({
						'width' : h,
						'opacity' : '1'
					},{
						duration: dur
					});
				}else{
					timeA.html(res);
				}

			};
			var res = getTime();
			add();
		};
		setInterval(go, 1000);
		//console.log($('ul.menu li.time').text());
	};
	/**
	*Добавляем в правое верхнее меню приветствие пользователю
	*/
	var guest = function(){
		/**
		*Делаем плавающим вправо ,
		так работает анимация справа-налево , но бок с рывками 
		и позиционированием - надо через марджин выставлять его 
		*/
		var addFloatRight = function(){
			var g = $('li.user a');
			console.log();
			//while(g.parent().siblings().eq(0).children().eq(0).html() !== ''){
				var w = g.width();
				var h = g.height();
				g.parent().css({
					'float' : 'right'
				});
				g.css({
						'float': 'right',
						'width' : 0,
						'opacity': 0,
						'margin-top' : '50px',
						
						
				});
				g.html('Добрый вечер <br>Вася');
				g.animate({
						'width' : w,
						'opacity' : '+=1'
					}, {
						'duration' : dur
					});
			//}
		};
		/**
		*Вариан с появлением справа на лево - 
		вставляю перед ним вставляю клона и потом его прячу , 
		мой соответственно появится
		*/
		var addByClone = function(){
			var g = $('li.user a');
			var gH = g.width();
			var li = g.parent();
			var ul = li.parent();
			var div = li.parent().parent();
			var divH = div.width();
			div.css({
					'overflow' : 'hidden', 
					
				});
			ul.css({
				'width' : divH*1 + gH * 1, 
			});
			var gC = li.clone();
			gC.html('');
			gC.insertBefore(li);
			g.css({
				//'background' : 'yellow',
				'opacity' : '0'
			})
			g.html('Здарова <br> Василич');
			gC.css({
				//'background' : 'red',
				
			});
			gC.animate({
				'width' : '0'
			}, {
				'duration' : dur
			});
			g.animate({
				'opacity' : '1'
			}, {
				'duration' : dur	
			});
		};
		//setTimeout(add, 1000);
		setTimeout(addByClone, 500);
	};
	time();
	guest();
});