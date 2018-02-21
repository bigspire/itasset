/* =
	jquery.eventCalendar.js
	version: 0.54
	date: 18-04-2013
	author:
		Jaime Fernandez (@vissit)
	company:
		Paradigma Tecnologico (@paradigmate)
*/

;$.fn.eventCalendar = function(options){



	var eventsOpts = $.extend({}, $.fn.eventCalendar.defaults, options);
	

	// define global vars for the function
	var flags = {
		wrap: "",
		directionLeftMove: "300",
		eventsJson: {}
	}

	// each eventCalendar will execute this function
	this.each(function(){

		flags.wrap = $(this);
		flags.wrap.addClass('eventCalendar-wrap').append("<div class='eventsCalendar-list-wrap'><p class='eventsCalendar-subtitle'></p><span class='eventsCalendar-loading'>loading...</span><div class='eventsCalendar-list-content'><ul class='eventsCalendar-list'></ul></div></div>");

		if (eventsOpts.eventsScrollable) {
			flags.wrap.find('.eventsCalendar-list-content').addClass('scrollable');
		}

		setCalendarWidth();
		$(window).resize(function(){
			setCalendarWidth();
		});
		//flags.directionLeftMove = flags.wrap.width();


		// show current month
		dateSlider('current');

		// get current date task only - ravi
		var d = new Date();
		var n = d.getDate();
		
		// when search  date
		if($('#srch_month').val() != '' && $('#srch_month').val() != undefined){ 
			srch_month = $('#srch_month').val().split('/');
			// modify task month field
			$('#task_month').val(srch_month[1]+'-'+srch_month[0]);
			search_m = srch_month[0] - 1;
			sch_year = d.getFullYear();	
			getEvents(eventsOpts.eventsLimit, sch_year, search_m,false, false);
		}else{	
			cur_day = $('#cur_date').val().split('-');
			tsk_date = cur_day[0] ? cur_day[0] : n;
			getEvents(eventsOpts.eventsLimit,d.getFullYear(), d.getMonth(),tsk_date,false);
		}
		
		changeMonth();

		flags.wrap.on('click','.eventsCalendar-day a',function(e){ 
		//flags.wrap.find('.eventsCalendar-day a').live('click',function(e){
			e.preventDefault();
			var year = flags.wrap.attr('data-current-year'),
				month = flags.wrap.attr('data-current-month'),
				day = $(this).parent().attr('rel');
				
			// remove unread class
			$(this).removeClass('unread_msg');
			$('#show_task').val(1)
			// update read status
			update_read_status(year, month,day);
			
			getEvents(false, year, month, day, "day");
			
		});
		flags.wrap.on('click','.monthTitle', function(e){
		//flags.wrap.find('.monthTitle').live('click',function(e){
			e.preventDefault();
			var year = flags.wrap.attr('data-current-year'),
				month = flags.wrap.attr('data-current-month');
			// show monthly tasks
			
			update_task_month(month, year);
			getEvents(eventsOpts.eventsLimit, year, month,false, "month");
			
		})



	});
	
	/* for updating tasks read status */
	function update_tag(id){ 
		value = id.split('-');				
		// call server side		
		 $.ajax({
			url: $('#root').val()+'update_imp_task/',
			type: "POST",
			data: { id : value[0], tag : value[1] }
		}).done(function( html ){
			//alert(html);
			if(html > 0){				
				// reset tag val.
				get_read = $('#tag-'+html).attr('val').split('-');
				new_status = get_read[1] == '0' ? '1' : '0';
				$('#read-'+html).attr('val', html+'-'+new_status);	
				// enable cache
				$('#pageCache').val(0);
			}			
		});	
	}
	
	/* for updating tasks read status */
	function update_read_status(year, cur_month,day){ 
		// add zero to day
		day = day < 10 ? '0'+day : day;
		month = parseInt(cur_month) + 1;
		month = month  < 10 ? '0'+month : month;
		sel_date = year+'-'+month+'-'+day;	
		type = $('#tskplan_type').val() ? $('#tskplan_type').val() : 'D';
		// call server side		
		 $.ajax({
			url: $('#root').val()+'update_read_status/',
			type: "POST",
			data: { date : sel_date, tsk_type : type }
		}).done(function( html ){		
			//alert(html);
			if(html > 0){
				// total plan count
				if($('#tmtskplan').val() == 1 || $('#tskplan').val() == 1){
					parent_cls = 'plan_count';
					child1 = 'tmplan_count';
					child2 = 'myplan_count';
					page1 = 'tmtskplan';
					page2 = 'tskplan';
				}else{
					parent_cls = 'assign_task_count';
					child1 = 'my_assign_task_count';
					child2 = 'tm_assign_task_count';
					page1 = 'tskassign';
					page2 = 'tmtskassign';
				}			
			
				plan_count = parseInt($.trim($('.'+parent_cls).text()))-html;
				plan_count = plan_count > 0 ? plan_count : '';
				$('.'+parent_cls).html(plan_count);
				// team plan count
				if($('#'+page1).val() == '1'){	
					tmplan_count = parseInt($.trim($('.'+child1).text()))-html;
					tmplan_count = tmplan_count > 0 ? tmplan_count : '';
					$('.'+child1).html(tmplan_count);
				}
				if($('#'+page2).val() == '1'){
					myplan_count = parseInt($.trim($('.'+child2).text()))-html;
					myplan_count = myplan_count > 0 ? myplan_count : '';
					$('.'+child2).html(myplan_count);
				}
			}			
		});	
	}

	
	
	/* function to load fancybox */
	
	flags.wrap.find('.eventsCalendar-list').on('click','.tsk_title',function(e){ 
		
		load_colorBox(this, $(this).attr('val'));			
	});
	
	
	
	/* function to show comment box */
	flags.wrap.find('.eventsCalendar-list').on('click','.commentTsk',function(e){
		// call ajax to fetch comments
		if($(this).attr('data-original-title') == 'View Comment'){
			// destroy tool tip
			$(this).tooltip('destroy');	
			// load preloader
			img_url = $('#webroot').val()+'img/task_loader.gif'; 					
			$(this).html('<img src="'+img_url+'">');	
			//$(this).html('<img  src='+$('#webroot').val()+'img/task_loader.gif/>');
			if($(this).attr('mod') != '' && $(this).attr('mod') != undefined){
				action = 'get_lead_comments';
				prefix = '#lead_tk_'
			}else{
				action = 'get_comments';
				prefix = '#tk_'
			}
			$.ajax({
				url: $('#root').val()+action+'/',
				type: "POST",
				data: { id : $(this).attr('val'), status:  $(this).attr('st')}
			}).done(function( html ){				
				// split the output
				response = html.split('||');				
				$(prefix+response[1]).attr('data-original-title', response[0]).tooltip('show');
				$('.tooltip-inner').addClass('alignLeft');
				// restore the html
				$(prefix+response[1]).html('<i class="icon-comment"></i>');				
			});
		}
		
		
	});
	

	
	
	/* function to hide tooltip when click outside */
	flags.wrap.find('.eventsCalendar-list-content').on('click','.eventsCalendar-list',function(e){	
		$('.tooltip').hide();		
	});
	
	/* function to show tool tip for proper working */
	flags.wrap.find('.eventsCalendar-list').on('mouseover','.calTable',function(e){	
		$('[rel=tooltip]').tooltip({html:true});		
	});
	
	/* task more and less */
	flags.wrap.find('.eventsCalendar-list').on('click','.tsk_more',function(e){
		$(this).prev().show();
		$(this).prev().prev().hide();		
		// toggle links
		$(this).hide();	
		$(this).next().show();
	});
	
	flags.wrap.find('.eventsCalendar-list').on('click','.tsk_less',function(e){
		$(this).prev().prev().hide();
		$(this).prev().prev().prev().show();		
		// toggle links
		$(this).hide();	
		$(this).prev().show();
	});
	
	/* function to change read and unread */
	
	flags.wrap.find('.eventsCalendar-list').on('click','.tsk_unread',function(e){
		$(this).addClass('tsk_read');	
		$(this).removeClass('tsk_unread');	
		$(this).attr('title', 'Important Task');$(this).attr('data-original-title', 'Mark as Important');
		$(this).tooltip("hide");
		// update task read status
		update_tag($(this).attr('val'));
	});
	
	flags.wrap.find('.eventsCalendar-list').on('click','.tsk_read',function(e){
		$(this).removeClass('tsk_read');	
		$(this).addClass('tsk_unread');	
		$(this).attr('title', 'Mark as Important'); $(this).attr('data-original-title', 'Important Task');
		$(this).tooltip("hide");
		// update tags
		update_tag($(this).attr('val'));
	});

	// show event description
	flags.wrap.find('.eventsCalendar-list').on('click','.eventTitle',function(e){
	//flags.wrap.find('.eventsCalendar-list .eventTitle').live('click',function(e){
		if(!eventsOpts.showDescription) {
			e.preventDefault();
			var desc = $(this).parent().find('.eventDesc');

			if (!desc.find('a').size()) {
				var eventUrl = $(this).attr('href');
				var eventTarget = $(this).attr('target');

				// create a button to go to event url
				desc.append('<a href="' + eventUrl + '" target="'+eventTarget+'" class="bt">'+eventsOpts.txt_GoToEventUrl+'</a>')
			}

			if (desc.is(':visible')) {
				desc.slideUp();
			} else {
				if(eventsOpts.onlyOneDescription) {
					flags.wrap.find('.eventDesc').slideUp();
				}
				desc.slideDown();
			}

		}
	});

	function sortJson(a, b){
		return a.date.toLowerCase() > b.date.toLowerCase() ? 1 : -1;
	};

	function dateSlider(show, year, month) {
		var $eventsCalendarSlider = $("<div class='eventsCalendar-slider'></div>"),
			$eventsCalendarMonthWrap = $("<div class='eventsCalendar-monthWrap'></div>"),
			$eventsCalendarTitle = $("<div class='eventsCalendar-currentTitle'><a href='#' class='monthTitle'></a></div>"),
			$eventsCalendarArrows = $("<a href='#' id='prevArrow' class='arrow prev'><span>" + eventsOpts.txt_prev + "</span></a><a id='nextArrow'  href='#' class='arrow next'><span>" + eventsOpts.txt_next + "</span></a>");
			$eventsCalendarDaysList = $("<ul class='eventsCalendar-daysList'></ul>"),
			date = new Date();

		if (!flags.wrap.find('.eventsCalendar-slider').size()) {
			flags.wrap.prepend($eventsCalendarSlider);
			$eventsCalendarSlider.append($eventsCalendarMonthWrap);
		} else {
			flags.wrap.find('.eventsCalendar-slider').append($eventsCalendarMonthWrap);
		}

		flags.wrap.find('.eventsCalendar-monthWrap.currentMonth').removeClass('currentMonth').addClass('oldMonth');
		$eventsCalendarMonthWrap.addClass('currentMonth').append($eventsCalendarTitle, $eventsCalendarDaysList);

		

		// if current show current month & day
		if (show === "current") {
			day = date.getDate();
			$eventsCalendarSlider.append($eventsCalendarArrows);

		} else {
			date = new Date(flags.wrap.attr('data-current-year'),flags.wrap.attr('data-current-month'),1,0,0,0); // current visible month
			day = 0; // not show current day in days list

			moveOfMonth = 1;
			if (show === "prev") {
				moveOfMonth = -1;
			}
			date.setMonth( date.getMonth() + moveOfMonth );

			var tmpDate = new Date();
			if (date.getMonth() === tmpDate.getMonth()) {
				day = tmpDate.getDate();
			}

		}
		
		
		// get date portions
		var year = date.getFullYear();
		
			// when search is clicked edited on 03/08/14 by ravi

			if($('#srch_month').val() != '' && $('#srch_month').val() != undefined){
				srch_month = $('#srch_month').val().split('/');
				currentYear = srch_month[1];
				month = srch_month[0] - 1;
				monthToShow = srch_month[0];	
				// hide prev / next
				$('#prevArrow').hide();
				$('#nextArrow').hide();
			}else{				
				currentYear = (new Date).getFullYear(), // current year
				month = date.getMonth(), // 0-11
				monthToShow = month + 1;
			}

		

		if (show != "current") {
			// month change
			getEvents(eventsOpts.eventsLimit, year, month,false, show);
			mydate = new Date();
			// show only the last month and next month tasks
			diff = month - mydate.getMonth(); 
			new_diff = Math.abs(diff); // make it positive no.
			//alert(new_diff);
			//alert(show);
			$('#nextArrow').show();
			$('#prevArrow').show();				
			if(new_diff >= 1 && show == 'next'){
				$('#nextArrow').hide();				
			}else if(new_diff >= 1 && show == 'prev'){
				$('#prevArrow').hide();				
			}
			// show monthly tasks
			update_task_month(month,year);
		}

		flags.wrap.attr('data-current-month',month)
			.attr('data-current-year',year);

		// add current date info
		
		$eventsCalendarTitle.find('.monthTitle').html(eventsOpts.monthNames[month] + " " + year);

		// print all month days
		var daysOnTheMonth = 32 - new Date(year, month, 32).getDate();
		var daysList = [];
		if (eventsOpts.showDayAsWeeks) {
			$eventsCalendarDaysList.addClass('showAsWeek');

			// show day name in top of calendar
			if (eventsOpts.showDayNameInCalendar) {
				$eventsCalendarDaysList.addClass('showDayNames');

				var i = 0;
				// if week start on monday
				if (eventsOpts.startWeekOnMonday) {
					i = 1;
				}

				for (; i < 7; i++) {
					daysList.push('<li class="eventsCalendar-day-header">'+eventsOpts.dayNamesShort[i]+'</li>');

					if (i === 6 && eventsOpts.startWeekOnMonday) {
						// print sunday header
						daysList.push('<li class="eventsCalendar-day-header">'+eventsOpts.dayNamesShort[0]+'</li>');
					}

				}
			}

			dt=new Date(year, month, 01);
			var weekDay = dt.getDay(); // day of the week where month starts

			if (eventsOpts.startWeekOnMonday) {
				weekDay = dt.getDay() - 1;
			}
			if (weekDay < 0) { weekDay = 6; } // if -1 is because day starts on sunday(0) and week starts on monday
			for (i = weekDay; i > 0; i--) {
				daysList.push('<li class="eventsCalendar-day empty"></li>');
			}
		}
		for (dayCount = 1; dayCount <= daysOnTheMonth; dayCount++) {
			var dayClass = "";

			if (day > 0 && dayCount === day && year === currentYear) {
				dayClass = "today";
			}
			daysList.push('<li id="dayList_' + dayCount + '" rel="'+dayCount+'" class="eventsCalendar-day '+dayClass+'"><a href="#">' + dayCount + '</a></li>');
		}
		$eventsCalendarDaysList.append(daysList.join(''));

		$eventsCalendarSlider.css('height',$eventsCalendarMonthWrap.height()+'px');
	}
	
	function update_task_month(month,year){
		new_month = parseInt(month) + 1;
		new_month = new_month < 10 ? '0'+new_month : new_month;
		$('#task_month').val(year+'-'+new_month);
	}

	function num_abbrev_str(num) {
		var len = num.length, last_char = num.charAt(len - 1), abbrev
		if (len === 2 && num.charAt(0) === '1') {
			abbrev = 'th'
		} else {
			if (last_char === '1') {
				abbrev = 'st'
			} else if (last_char === '2') {
				abbrev = 'nd'
			} else if (last_char === '3') {
				abbrev = 'rd'
			} else {
				abbrev = 'th'
			}
		}
		return num + abbrev
	}

	function getEvents(limit, year, month, day, direction) {
		var limit = limit || 0;
		var year = year || '';
		var day = day || '';

		// to avoid problem with january (month = 0)

		if (typeof month != 'undefined') {
			var month = month;
		} else {
			var month = '';
		}

		//var month = month || '';
		flags.wrap.find('.eventsCalendar-loading').fadeIn();
		// set cache false if rec. updated.
		
		if($('#pageCache').val() == '0'){
			eventsOpts.cacheJson = false;
		}else{
			eventsOpts.cacheJson = true;
		}
		
		if (eventsOpts.jsonData) {
			// user send a json in the plugin params
			eventsOpts.cacheJson = true;
	
			flags.eventsJson = eventsOpts.jsonData;
			
			getEventsData(flags.eventsJson, limit, year, month, day, direction);

		} else if (!eventsOpts.cacheJson || !direction) {
			// first load: load json and save it to future filters
			$.getJSON(eventsOpts.eventsjson + "?limit="+limit+"&year="+year+"&month="+month+"&day="+day, function(data) {
				flags.eventsJson = data; // save data to future filters
				getEventsData(flags.eventsJson, limit, year, month, day, direction);
			}).error(function() {
				showError("error getting json: ");
			});
		} else {
			// filter previus saved json
			getEventsData(flags.eventsJson, limit, year, month, day, direction);
		}

		if (day > '') {
			flags.wrap.find('.current').removeClass('current');
			flags.wrap.find('#dayList_'+day).addClass('current');
		}
	}

	function getEventsData(data, limit, year, month, day, direction){
		directionLeftMove = "-=" + flags.directionLeftMove;
		eventContentHeight = "auto";
		
		
		// add legend
		flags.wrap.find('.eventsCalendar-list-wrap .eventsCalendar-subtitle').after('<table style="font-size:smaller;color:#545454" class="legend"><tbody><tr><td class="legendColorBox" style="padding:7px 2px"><div style="border:1px solid null;"><div style="width:13px;height:13px;overflow:hidden;"><img src="'+$('#webroot').val()+'img/unread.png"></div></div></td><td class="legendLabel">Unread</td><td class="legendColorBox"><div style="border:1px solid null;padding:1px"><div style="width:4px;height:0;border:5px solid #85BBFC;overflow:hidden"></div></div></td><td class="legendLabel">Today</td><td class="legendColorBox"><div style="border:1px solid null;padding:1px"><div style="width:4px;height:0;border:5px solid #F25757;overflow:hidden"></div></div></td><td class="legendLabel">Status&nbsp;Pending</td><td class="legendColorBox"><div style="border:1px solid null;padding:1px"><div style="width:4px;height:0;border:5px solid #2EC943;overflow:hidden"></div></div></td><td class="legendLabel">Status&nbsp;Updated</td><td class="legendColorBox"><div style="border:1px solid null;padding:1px"><div style="width:4px;height:0;border:5px solid #F2CD3A;overflow:hidden"></div></div></td><td class="legendLabel">Upcoming</td><td class="legendColorBox"><div style="border:1px solid null;padding:1px"><div style="width:4px;height:0;border:5px solid #efefef;overflow:hidden"></div></div></td><td class="legendLabel">No&nbsp;tasks</td></tr></tbody></table>');
		//legend = flags.wrap.find('.eventsCalendar-list-wrap .legend');
		//legend.html('hi ravi');

		subtitle = flags.wrap.find('.eventsCalendar-list-wrap .eventsCalendar-subtitle')
		if (!direction) {
			// first load
			subtitle.html(eventsOpts.txt_NextEvents);
			
			eventContentHeight = "auto";
			directionLeftMove = "-=0";
		} else {
			if (day != '') {
				subtitle.html(eventsOpts.txt_SpecificEvents_prev + eventsOpts.monthNames[month] + " " + num_abbrev_str(day) + " " + eventsOpts.txt_SpecificEvents_after);
			} else {
				subtitle.html(eventsOpts.txt_SpecificEvents_prev + eventsOpts.monthNames[month] + " " + eventsOpts.txt_SpecificEvents_after);
			}
			
					
			if (direction === 'prev') {
				directionLeftMove = "+=" + flags.directionLeftMove;
			} else if (direction === 'day' || direction === 'month') {
				directionLeftMove = "+=0";
				eventContentHeight = 0;
			}
		}

		flags.wrap.find('.eventsCalendar-list').animate({
			opacity: eventsOpts.moveOpacity,
			left: directionLeftMove,
			height: eventContentHeight
		}, eventsOpts.moveSpeed, function() {
			flags.wrap.find('.eventsCalendar-list').css({'left':0, 'height': 'auto'}).hide();
			//wrap.find('.eventsCalendar-list li').fadeIn();

			var events = [];
			
			

			data = $(data).sort(sortJson); // sort event by dates
			
			//events.push('<div  style="height:400px;overflow:auto">');
			
			// each event
			if (data.length) {
			
			
			
				if($('#tskplan').val() == 1 && $('#tskplan_type').val() == 'P'){	
					events.push('<table style="margin:0px 20px 20px 10px;width:98%" class="calTable table table-hover table-nomargin"><thead><tr><th width="200">Title</th><th width="250">Description</th><th>Type</th><th  width="80">Start</th  width="80"><th>End</th><th>Customer</th><th>Project</th><th  width="90">Status</th></tr><tbody>');
				}else if($('#tskplan').val() == 1){	
					events.push('<table style="margin:0px 20px 20px 10px;width:98%" class="calTable table table-hover table-nomargin"><thead><tr><th width="200">Title</th><th width="400">Description</th><th>Type</th><th>Date</th><th>Start</th><th>End</th><th>Status</th></tr><tbody>');
				}else if($('#tmtskplan').val() == 1 && $('#tskplan_type').val() == 'P'){
					events.push('<table style="margin:0px 20px 20px 10px;width:98%" class="calTable table table-hover table-nomargin"><thead><tr><th width="200">Title</th><th width="250">Description</th><th width="100">Employee</th><th>Type</th><th  width="80">Start</th><th  width="80">End</th><th>Customer</th><th>Project</th><th  width="90">Status</th></tr><tbody>');
				}else if($('#tmtskplan').val() == 1){	
					events.push('<table style="margin:0px 20px 20px 10px;width:98%" class="calTable table table-hover table-nomargin"><thead><tr><th width="200">Title</th><th width="410">Description</th><th width="100">Employee</th><th>Type</th><th>Date</th><th>Start</th><th>End</th><th>Status</th></tr><tbody>');
				}else if($('#tskassign').val() == 1 && $('#tskplan_type').val() == 'P'){	
					events.push('<table style="margin:0px 20px 20px 10px;width:98%" class="calTable table table-hover table-nomargin"><thead><tr><th width="200">Title</th><th width="200">Description</th><th>Type</th><th  width="80">Start</th><th  width="80">End</th><th>Customer</th><th>Project</th><th  width="90">Status</th><th  width="90">L1 Status</th></tr><tbody>');
				}else if($('#tskassign').val() == 1){	
					events.push('<table style="margin:0px 20px 20px 10px;width:98%" class="calTable table table-hover table-nomargin"><thead><tr><th width="200">Title</th><th width="350">Description</th><th>Type</th><th>Date</th><th>Start</th><th>End</th><th>Status</th><th>L1 Status</th></tr><tbody>');
				}else if($('#tmtskassign').val() == 1 && $('#tskplan_type').val() == 'P'){	
					events.push('<table style="margin:0px 20px 20px 10px;width:98%" class="calTable table table-hover table-nomargin"><thead><tr><th width="200">Title</th><th width="200">Description</th><th width="100">Employee</th><th>Type</th><th width="80">Start</th><th width="80">End</th><th>Customer</th><th>Project</th><th width="90">Status</th><th  width="90">L1 Status</th></tr><tbody>');
				}else if($('#tmtskassign').val() == 1){	
					events.push('<table style="margin:0px 20px 20px 10px;width:98%" class="calTable table table-hover table-nomargin"><thead><tr><th width="200">Title</th><th width="350">Description</th><th width="100">Employee</th><th>Type</th><th>Date</th><th>Start</th><th>End</th><th>Status</th><th>L1 Status</th></tr><tbody>');
				}

				// show or hide event description
				var eventDescClass = '';
				if(!eventsOpts.showDescription) {
					eventDescClass = 'hidden';
				}
				var eventLinkTarget = "_self";
				if(eventsOpts.openEventInNewWindow) {
					eventLinkTarget = '_target';
				}

				var i = 0;
				$.each(data, function(key, event) {
					if (eventsOpts.jsonDateFormat == 'human') {
						var eventDateTime = event.date.split(" "),
							eventDate = eventDateTime[0].split("-"),
							eventTime = eventDateTime[1].split(":"),
							eventYear = eventDate[0],
							eventMonth = parseInt(eventDate[1]) - 1,
							eventDay = parseInt(eventDate[2]),
							//eventMonthToShow = eventMonth,
							eventMonthToShow = parseInt(eventMonth) + 1,
							eventHour = eventTime[0],
							eventMinute = eventTime[1],
							eventSeconds = eventTime[2],
							eventDate = new Date(eventYear, eventMonth, eventDay, eventHour, eventMinute, eventSeconds);
					} else {
						var eventDate = new Date(parseInt(event.date)),
							eventYear = eventDate.getFullYear(),
							eventMonth = eventDate.getMonth(),
							eventDay = eventDate.getDate(),
							eventMonthToShow = eventMonth + 1,
							eventHour = eventDate.getHours(),
							eventMinute = eventDate.getMinutes();

					}

					if (parseInt(eventMinute) <= 9) {
						eventMinute = "0" + parseInt(eventMinute);
					}
	
					m = new Date();
					n = m.getDate();
					mnth = m.getMonth();
					yr = m.getFullYear();
					var duplicate = 0;
					if (limit === 0 || limit > i) {
						// if month or day exist then only show matched events						
						
						if ((month === false || month == eventMonth)
								&& (day == '' || day == eventDay)
								&& (year == '' || year == eventYear) // get only events of current year
							) {
								// if initial load then load only future events
								if (month === false && eventDate < new Date()) {
								
											
								} else {
							
									eventStringDate = eventDay + "/" + eventMonthToShow + "/" + eventYear;
									
									// show the date in the hidden field
									dig_month = eventMonthToShow < 10 ? '0'+eventMonthToShow : eventMonthToShow
									link_date = eventYear + "-" + dig_month + "-" + eventDay;									
									$('#month').val(link_date);
									var duplicate = 0;
									// reset month field
									if(direction != 'month' && direction != 'next' && direction != 'prev' && $('#srch_month').val() == ''){
										$('#task_month').val('');										
									}else{
										// remove duplicates
										//duplicate = remove_duplicate(event.rec_id);
										prev_rec = $('#rec_id').val();
										$('#rec_id').attr('value', prev_rec+','+event.rec_id);
										rec_arr = $('#rec_id').val().split(',');
										rec_count = rec_arr.length;
										$.each(rec_arr, function( key, value ) {									
										if(event.rec_id == value && key){ 
											duplicate++;
										 }
										});
									
									}
									
									/*if (event.url) {
										var eventTitle = '<a href="'+event.url+'" target="' + eventLinkTarget + '" class="eventTitle">' + event.title + '</a>';
									} else {
										var eventTitle = '<span class="eventTitle">'+event.title+'</span>';
									}*/
									//events.push('<li id="' + key + '" class="'+event.type+'"><time datetime="'+eventDate+'"><em>' + eventStringDate + '</em><small>'+eventHour+":"+eventMinute+'</small></time>'+eventTitle+'<p class="eventDesc ' + eventDescClass + '">' + event.description + '</p></li>');
									
									
								
									
									if($('#tskplan').val() == 1  && $('#tskplan_type').val() == 'P'  && duplicate < 2){	
										events.push('<tr id="' + key + '" class="'+event.type+'"><td>'+event.plan_type+' '+ event.title + '</td><td>' + event.description + '</td><td><span class=" ' + eventDescClass + '">' + event.plan_action + '</span></td><td><span class=" ' + eventDescClass + '">' + event.start_time + '</span></td><td><span class=" ' + eventDescClass + '">' + event.end_time + '</span></td><td><span class=" ' + eventDescClass + '">' + event.company + '</span></td><td><span class=" ' + eventDescClass + '">' + event.project + '</span></td><td><span class=" ' + eventDescClass + '">' + event.status + '</span></td></tr>');
									}else if($('#tskplan').val() == 1   && duplicate < 2){	
										events.push('<tr id="' + key + '" class="'+event.type+'"><td>'+event.plan_type+' '+ event.title + '</td><td>' + event.description + '</td><td><span class=" ' + eventDescClass + '">' + event.plan_action + '</span></td><td><span class=" ' + eventDescClass + '">' + event.plan_date + '</span></td><td><span class=" ' + eventDescClass + '">' + event.start_time + '</span></td><td><span class=" ' + eventDescClass + '">' + event.end_time + '</span></td><td><span class=" ' + eventDescClass + '">' + event.status + '</span></td></tr>');
									}else if($('#tmtskplan').val() == 1   && $('#tskplan_type').val() == 'P'  && duplicate < 2){	
										events.push('<tr id="' + key + '" class="'+event.type+'"><td>'+event.plan_type+' '+ event.title + '</td><td>' + event.description + '</td><td><span class=" ' + eventDescClass + '">' + event.user + '</span></td><td><span class=" ' + eventDescClass + '">' + event.plan_action + '</span></td><td><span class=" ' + eventDescClass + '">' + event.start_time + '</span></td><td><span class=" ' + eventDescClass + '">' + event.end_time + '</span></td><td><span class=" ' + eventDescClass + '">' + event.company + '</span></td><td><span class=" ' + eventDescClass + '">' + event.project + '</span></td><td><span class=" ' + eventDescClass + '">' + event.status + '</span></td></tr>');
									}else if($('#tmtskplan').val() == 1   && duplicate < 2){	
										events.push('<tr id="' + key + '" class="'+event.type+'"><td>'+event.plan_type+' '+ event.title + '</td><td>' + event.description + '</td><td><span class=" ' + eventDescClass + '">' + event.user + '</span></td><td><span class=" ' + eventDescClass + '">' + event.plan_action + '</span></td><td><span class=" ' + eventDescClass + '">' + event.plan_date + '</span></td><td><span class=" ' + eventDescClass + '">' + event.start_time + '</span></td><td><span class=" ' + eventDescClass + '">' + event.end_time + '</span></td><td><span class=" ' + eventDescClass + '">' + event.status + '</span></td></tr>');
									}else if($('#tskassign').val() == 1   && $('#tskplan_type').val() == 'P'  && duplicate < 2){	
										events.push('<tr id="' + key + '" class="'+event.type+'"><td>'+event.plan_type+' '+ event.title + '</td><td>' + event.description + '</td><td><span class=" ' + eventDescClass + '">' + event.plan_action + '</span></td><td><span class=" ' + eventDescClass + '">' + event.start_time + '</span></td><td><span class=" ' + eventDescClass + '">' + event.end_time + '</span></td><td><span class=" ' + eventDescClass + '">' + event.company + '</span></td><td><span class=" ' + eventDescClass + '">' + event.project + '</span></td><td><span class=" ' + eventDescClass + '">' + event.status + '</span></td><td><span class=" ' + eventDescClass + '">' + event.lead_status + '</span></td></tr>');
									}else if($('#tskassign').val() == 1   && duplicate < 2){	
										events.push('<tr id="' + key + '" class="'+event.type+'"><td>'+event.plan_type+' '+ event.title + '</td><td>' + event.description + '</td><td><span class=" ' + eventDescClass + '">' + event.plan_action + '</span></td><td><span class=" ' + eventDescClass + '">' + event.plan_date + '</span></td><td><span class=" ' + eventDescClass + '">' + event.start_time + '</span></td><td><span class=" ' + eventDescClass + '">' + event.end_time + '</span></td><td><span class=" ' + eventDescClass + '">' + event.status + '</span></td><td><span class=" ' + eventDescClass + '">' + event.lead_status + '</span></td></tr>');
									}else if($('#tmtskassign').val() == 1 && $('#tskplan_type').val() == 'P'  && duplicate < 2){	
										events.push('<tr id="' + key + '" class="'+event.type+'"><td>'+event.plan_type+' '+ event.title + '</td><td>' + event.description + '</td><td><span class=" ' + eventDescClass + '">' + event.user + '</span></td><td><span class=" ' + eventDescClass + '">' + event.plan_action + '</span></td><td><span class=" ' + eventDescClass + '">' + event.start_time + '</span></td><td><span class=" ' + eventDescClass + '">' + event.end_time + '</span></td><td><span class=" ' + eventDescClass + '">' + event.company + '</span></td><td><span class=" ' + eventDescClass + '">' + event.project + '</span></td><td><span class=" ' + eventDescClass + '">' + event.status + '</span></td><td><span class=" ' + eventDescClass + '">' + event.lead_status + '</span></td></tr>');
									}else if($('#tmtskassign').val() == 1   && duplicate < 2){	
										events.push('<tr id="' + key + '" class="'+event.type+'"><td>'+event.plan_type+' '+ event.title + '</td><td>' + event.description + '</td><td><span class=" ' + eventDescClass + '">' + event.user + '</span></td><td><span class=" ' + eventDescClass + '">' + event.plan_action + '</span></td><td><span class=" ' + eventDescClass + '">' + event.plan_date + '</span></td><td><span class=" ' + eventDescClass + '">' + event.start_time + '</span></td><td><span class=" ' + eventDescClass + '">' + event.end_time + '</span></td><td><span class=" ' + eventDescClass + '">' + event.status + '</span></td><td><span class=" ' + eventDescClass + '">' + event.lead_status + '</span></td></tr>');
									}
									
									i++;
								}
						} 
						
						
					}
					duplicate = 0;
					// add mark in the dayList to the days with events
					if (eventYear == flags.wrap.attr('data-current-year') && eventMonth == flags.wrap.attr('data-current-month')) {
						
						//flags.wrap.find('.currentMonth .eventsCalendar-daysList #dayList_' + parseInt(eventDay)).addClass('dayWithEvents');
						
						
						// for unread tasks
						if(event.read_status == 'U' && $('#show_task').val() != '1'){
							flags.wrap.find('.currentMonth .eventsCalendar-daysList #dayList_' + parseInt(eventDay)+' a').addClass('unread_msg');	
						}
						
						
						var date2 = new Date(eventYear, eventMonth, eventDay);
						var date4 = new Date(yr, mnth, n);
			
						/* for pending / completed events status */
						if(eventDay == n && eventMonth == mnth){ // for today
							flags.wrap.find('.currentMonth .eventsCalendar-daysList #dayList_' + parseInt(eventDay)).addClass('today current');
						}						
						else if($(event.status).text().trim() == 'Pending' && date2 < date4){ 
							// if pending, remove complete tag
							flags.wrap.find('.currentMonth .eventsCalendar-daysList #dayList_' + parseInt(eventDay)).removeClass('dayWithCompleteEvents');
							flags.wrap.find('.currentMonth .eventsCalendar-daysList #dayList_' + parseInt(eventDay)).addClass('dayWithPendingEvents');							
						}else if($(event.status).text().trim() != 'Pending' && date2 < date4){	
							// add completed, only it has no pendings
							if(flags.wrap.find('.currentMonth .eventsCalendar-daysList #dayList_' + parseInt(eventDay)).hasClass('dayWithPendingEvents')){
								
							}else{
								flags.wrap.find('.currentMonth .eventsCalendar-daysList #dayList_' + parseInt(eventDay)).addClass('dayWithCompleteEvents');
							}
													
						}else{
							flags.wrap.find('.currentMonth .eventsCalendar-daysList #dayList_' + parseInt(eventDay)).addClass('dayWithFutureEvents');
						}
						
						
						
						
					}
					
					

				});
			}
			
			//if (i > 0) {
				events.push('</tbody></table>');
				// nul the records id 
				$('#rec_id').val('')
				
				// enable cache
				$('#pageCache').val(1);
				
			//}
			//events.push('</div>');
			
			
			// there is no events on this period
			//if (!events.length) {
			if (i == 0) {
				events.push('<li class="eventsCalendar-noEvents"><p>' + eventsOpts.txt_noEvents + '</p></li>');
				
				//flags.wrap.find('.eventsCalendar-list .calTable').remove();
			}
			flags.wrap.find('.eventsCalendar-loading').hide();

			flags.wrap.find('.eventsCalendar-list')
				.html(events.join(''));

			flags.wrap.find('.eventsCalendar-list').animate({
				opacity: 1,
				height: "toggle"
			}, eventsOpts.moveSpeed);


		});
		setCalendarWidth();
	}

	/* function to remove the duplicates */
	function remove_duplicate(event_rec){
		var duplicate = 0;
		prev_rec = $('#rec_id').val();
		$('#rec_id').attr('value', prev_rec+','+event_rec);
		rec_arr = $('#rec_id').val().split(',');
		rec_count = rec_arr.length;
		$.each(rec_arr, function( key, value ) {									
		if(event_rec == value && key){ 
			duplicate++;
		 }
		});
		
		return duplicate;
	}
	
	function changeMonth() {
		flags.wrap.find('.arrow').click(function(e){
			e.preventDefault();

			if ($(this).hasClass('next')) {
				dateSlider("next");
				var lastMonthMove = '-=' + flags.directionLeftMove;

			} else {
				dateSlider("prev");
				var lastMonthMove = '+=' + flags.directionLeftMove;
			}

			flags.wrap.find('.eventsCalendar-monthWrap.oldMonth').animate({
				opacity: eventsOpts.moveOpacity,
				left: lastMonthMove
			}, eventsOpts.moveSpeed, function() {
				flags.wrap.find('.eventsCalendar-monthWrap.oldMonth').remove();
			});
		});
	}

	function showError(msg) {
		// error hidden for production site
		//flags.wrap.find('.eventsCalendar-list-wrap').html("<span class='eventsCalendar-loading error'>"+msg+" " +eventsOpts.eventsjson+"</span>");
	}

	function setCalendarWidth(){
		// resize calendar width on window resize
		flags.directionLeftMove = flags.wrap.width();
		flags.wrap.find('.eventsCalendar-monthWrap').width(flags.wrap.width() + 'px');

		flags.wrap.find('.eventsCalendar-list-wrap').width(flags.wrap.width() + 'px');

	}
	
	
};


// define the parameters with the default values of the function
$.fn.eventCalendar.defaults = {
    eventsjson: 'js/events.json',
	eventsLimit: 10,
	monthNames: [ "January", "February", "March", "April", "May", "June",
		"July", "August", "September", "October", "November", "December" ],
	dayNames: [ 'Sunday','Monday','Tuesday','Wednesday',
		'Thursday','Friday','Saturday' ],
	dayNamesShort: [ 'Sun','Mon','Tue','Wed', 'Thu','Fri','Sat' ],
	txt_noEvents: "There are no task plan in this period",
	txt_SpecificEvents_prev: "",
	txt_SpecificEvents_after: "",
	txt_next: "next",
	txt_prev: "prev",
	txt_NextEvents: "",
	txt_GoToEventUrl: "View Details",
	showDayAsWeeks: true,
	startWeekOnMonday: true,
	showDayNameInCalendar: true,
	showDescription: false,
	onlyOneDescription: true,
	openEventInNewWindow: false,
	eventsScrollable: false,
	jsonDateFormat: 'timestamp', // you can use also "human" 'YYYY-MM-DD HH:MM:SS'
	moveSpeed: 500,	// speed of month move when you clic on a new date
	moveOpacity: 0.15, // month and events fadeOut to this opacity
	jsonData: "", 	// to load and inline json (not ajax calls)
	cacheJson: true	// if true plugin get a json only first time and after plugin filter events
					// if false plugin get a new json on each date change
};


