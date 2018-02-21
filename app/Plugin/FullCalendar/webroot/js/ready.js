/*
 * webroot/js/ready.js 
 * CakePHP Full Calendar Plugin
 *
 * Copyright (c) 2010 Silas Montgomery
 * http://silasmontgomery.com
 *
 * Licensed under MIT
 * http://www.opensource.org/licenses/mit-license.php
 */

// JavaScript Document
$(document).ready(function() {

	$(window).load(function() {
		jQuery('#loading-image').hide();		
	});
	
	
	
	if($('#event_theme').val() != ''){
		theme = true;
	}else{
		theme = false;
	}
    // page is now ready, initialize the calendar...
    $('#calendar').fullCalendar({
		theme: theme,
		header: {
    		left:   'title',
    		center: '',
    		right:  'today month,agendaWeek,agendaDay prev,next'
		},
		defaultView: 'month',
		firstHour: 8,
		weekMode: 'variable',
		aspectRatio: 2,
		editable: true,
		events: plgFcRoot + "/events/feed",
		timeFormat: 'H:mm', 
		buttonText:
		{
			today:    'Today',
			month:    'Month',
			week:     'Week',
			day:      'Day'
		},
		selectable: true,
			selectHelper: true,
			select: function(start, end) {
				var title = prompt('Event Title:');
				var eventData;
				if (title) {
					eventData = {
						title: title,
						start: start,
						end: end
					};
					var startdate = new Date(start);
					var startyear = startdate.getFullYear();
					var startday = startdate.getDate();
					var startmonth = startdate.getMonth()+1;
					var starthour = startdate.getHours();
					var startminute = startdate.getMinutes();
					var enddate = new Date(end);
					var endyear = enddate.getFullYear();
					var endday = enddate.getDate();
					var endmonth = enddate.getMonth()+1;
					var endhour = enddate.getHours();
					var endminute = enddate.getMinutes();
					var url = plgFcRoot + "/events/create?title="+title+"&start="+startyear+"-"+startmonth+"-"+startday+" "+starthour+":"+startminute+":00&end="+endyear+"-"+endmonth+"-"+endday+" "+endhour+":"+endminute+":00";
					$.post(url, function(data){window.location.reload();});
					
					$('#calendar').fullCalendar('renderEvent', eventData, true); // stick? = true

				}
				$('#calendar').fullCalendar('unselect');
			},

		
		/*eventRender: function(event, element) {
        	element.qtip({
				content: event.details,
				position: { 
					target: 'mouse',
					adjust: {
						x: 10,
						y: -5
					}
				},
				style: {
					name: 'light',
					tip: 'leftTop'
				}
        	});
    	},*/
		eventDragStart: function(event) {
			//$(this).qtip("destroy");
		},
	
		eventDrop: function(event) {
			var startdate = new Date(event.start);
			var startyear = startdate.getFullYear();
			var startday = startdate.getDate();
			var startmonth = startdate.getMonth()+1;
			var starthour = startdate.getHours();
			var startminute = startdate.getMinutes();
			var enddate = new Date(event.end);
			var endyear = enddate.getFullYear();
			var endday = enddate.getDate();
			var endmonth = enddate.getMonth()+1;
			var endhour = enddate.getHours();
			var endminute = enddate.getMinutes();
			if(event.allDay == true) {
				var allday = 1;
			} else {
				var allday = 0;
			}
			var url = plgFcRoot + "/events/update?id="+event.id+"&start="+startyear+"-"+startmonth+"-"+startday+" "+starthour+":"+startminute+":00&end="+endyear+"-"+endmonth+"-"+endday+" "+endhour+":"+endminute+":00&allday="+allday;
			$.post(url, function(data){});
		},
		
		eventResizeStart: function(event) {
			//$(this).qtip("destroy");
		},
		eventResize: function(event) {
			var startdate = new Date(event.start);
			var startyear = startdate.getFullYear();
			var startday = startdate.getDate();
			var startmonth = startdate.getMonth()+1;
			var starthour = startdate.getHours();
			var startminute = startdate.getMinutes();
			var enddate = new Date(event.end);
			var endyear = enddate.getFullYear();
			var endday = enddate.getDate();
			var endmonth = enddate.getMonth()+1;
			var endhour = enddate.getHours();
			var endminute = enddate.getMinutes();
			var url = plgFcRoot + "/events/update?id="+event.id+"&start="+startyear+"-"+startmonth+"-"+startday+" "+starthour+":"+startminute+":00&end="+endyear+"-"+endmonth+"-"+endday+" "+endhour+":"+endminute+":00";
			$.post(url, function(data){});
		}
    })
	
	

});
