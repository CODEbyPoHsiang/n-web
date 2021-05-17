$(function () {
	$('.hamburger').click(function (event) {
		//全部關閉
		$('.navUl li ul').removeClass('active');
		$('.navUl li').removeClass('active');

		//取得點擊的漢堡
		var hamburger = $(this);
		//判斷漢堡是否是active的狀態
		if (!hamburger.hasClass('active')) {
			//不是active的狀態，執行以下動作
			$('.hamburger').addClass('active');
			$('nav').addClass('active');
		} else {
			//是的話，執行以下動作
			$('.hamburger').removeClass('active');
			$('nav').removeClass('active');
		}
	});

	$('.navUl li').click(function (event) {
	});

	//註冊 navUl 裡面第一層的li 點擊事件
	$('.navUl li').click(function (event) {
		//取得點擊li的資訊（例如：navLi01）
		var navLi = $(this);

		//判斷是否是鎖定
		if (!navLi.hasClass('lock')) {
			//不是鎖定，執行以下動作

			//判斷li是否是active的狀態
			if (!navLi.hasClass('active')) {
				//不是active的狀態，執行以下動作

				//取得li底下所有的ul，並增加active class
				navLi.find("ul").addClass('active');
				//取得li增加active class
				navLi.addClass('active');
			} else {
				//是的話全部縮合
				$('.navUl li ul').removeClass('active');
				$('.navUl li').removeClass('active');
			}
		} else {
			//是鎖定，執行以下動作
			return false;
		}
	});

	//註冊 navUl 裡面第二層li 點擊事件
	$('.navUl li ul li').click(function (event) {
		var navSecondUi = $(this);
		//判斷是否是鎖定
		if (!navSecondUi.hasClass('lock')) {
			//不是鎖定，執行以下動作
			$('.hamburger').removeClass('active');
			$('nav').removeClass('active');
		} else {
			//是鎖定，執行以下動作
			return false;
		}
	});
});
