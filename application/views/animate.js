$(function(){
    /**
     *Анимация верхнего меню
    */
	var topAnimate = function(){
		/* Old code :))
		var mLeft = function(target, dur) {
			//what = 'margin-'+what;
			target.css({
				'margin-left' : '-250px',
				'display' : 'block',
				'opacity' : '0'
			});
			var xxx = function(){
				target.animate({
					'margin-left' : '0',
					'opacity' : '1'
				}, dur);
			};
			setTimeout(xxx, 800);
		};
		var mRight = function(target, dur){
			//what = 'margin-'+what;
				target.css({
					'margin-right' : '-250px',
					'display' : 'block',
					'opacity' : '0'
				});
			var xxx = function(){
				//console.log(target);
				target.animate({
					'margin-right' : '0',
					'opacity' : '1'
				}, dur);
			};
			setTimeout(xxx, 800);
		};
		*/

		var marginAnimate = function (target, duration, side)
		{
			/**
			*Анимационно появление элемента , отрабатую ошибки , забиваю 
			*значения по-умолчанию, создаю 2 функции!!(КАПУТ!) для анимации слева\спарава
			*/
			try {
				if  (!(target instanceof $)) 
					throw new Error('Can`t animate ' + target + ' It`s not JQuery object!');
				if (duration == undefined || duration == false || duration == null)	
					//throw new Error(duration + ' Is null || false || undefined');
					duration = 400;
				if (side != 'right') {
					//throw new Error(side + ' isn`t \'left\' or \'right\'');
					target.css({
						'display' : 'block',
						'margin-left' : '-500px',
						'opacity' : 0
					});
					var goAnime = function ()
					{
						target.animate({
							'margin-left' : '0px',
							'opacity' : 1
						}, duration);
					};
				} else {
					target.css({
							'display' : 'block',
							'margin-right' : '-500px',
							'opacity' : 0
					});	
					var goAnime = function ()
					{
						target.animate({
							'margin-right' : '0px',
							'opacity' : 1
						}, duration);
					};
				}
				setTimeout(goAnime, 800);
			} catch(e) {
				console.log(e.message);
			}
		}
		var dur = 300;
		marginAnimate($('li.item1 a span'), dur, 'left');
		marginAnimate($('li.item4 a span'), dur, 'right');
		

	};
    /**
     *Отмена работы двух ссылок в верхнем меню Смены и Сеансы
     * - по прозьбе пользователей мобильных устройств
    */
    var stopLink = function(){
        $('a.top').each(function(num, targ){
            if (num == 1 || num == 2) {
                $(targ).on('click', function(e){
                    e.preventDefault();
                });
            }
        });
    };
    stopLink();
    topAnimate();
});