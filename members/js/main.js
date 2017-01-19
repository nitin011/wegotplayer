$(function(){
    var currentDate; // Holds the day clicked when adding a new event
    var currentEvent; // Holds the event object when editing an event
    $('#color').colorpicker(); // Colopicker
    $('#time').timepicker({
        minuteStep: 5,
        showInputs: false,
        disableFocus: true,
        showMeridian: false
    });  // Timepicker
    // Fullcalendar
    $('#calendar').fullCalendar({
        timeFormat: 'H(:mm)',
        header: {
            left: 'prev, next, today',
            center: 'title',
            right: 'month'
        },
        // Get all events stored in database
        events: 'getEvents.php',
        // Handle Day Click
        
        dayClick: function(date, event, view) {
            currentDate = date.format();
            // Open modal to add event
            modal({
                // Available buttons when adding
                buttons: {
                    add: {
                        id: 'add-event', // Buttons id
                        css: 'btn-primary', // Buttons class
                        label: 'Save' // Buttons label
                    }
                },
                title: 'Add Event (' + date.format() + ')' // Modal title
            });
        },
        // Event Mouseover
        eventMouseover: function(calEvent, jsEvent, view){
            var tooltip = '<div class="event-tooltip">' + calEvent.description + '</div>';
            $("body").append(tooltip);
            $(this).mouseover(function(e) {
                $(this).css('z-index', 10000);
                $('.event-tooltip').fadeIn('500');
                $('.event-tooltip').fadeTo('10', 1.9);
            }).mousemove(function(e) {
                    $('.event-tooltip').css('top', e.pageY + 10);
                    $('.event-tooltip').css('left', e.pageX + 20);
                });
        },
        eventMouseout: function(calEvent, jsEvent) {
            $(this).css('z-index', 8);
            $('.event-tooltip').remove();
        },
        // Handle Existing Event Click
        eventClick: function(calEvent, jsEvent, view) {
            // Set currentEvent variable according to the event clicked in the calendar
            currentEvent = calEvent;
            // Open modal to edit or delete event
            modal({
                // Available buttons when editing
                buttons: {
                    delete: {
                        id: 'delete-event',
                        css: 'btn-primary',
                        label: 'Delete'
                    },
                    update: {
                        id: 'update-event',
                        css: 'btn-primary',
                        label: 'Update'
                    }
                },
                title: 'Edit Event "' + calEvent.title + '"',
                event: calEvent
            });
        }
    });
    // Prepares the modal window according to data passed
    function modal(data) {
    	console.log(data);
        // Set modal title
        $('.modal-title').html(data.title);
        // Clear buttons except Cancel
        $('.modal-footer button:not(".btn-default")').remove();
        // Set input values
        if(data.event) {
        if(data.event.holiday==0)
        {
        	$(".show_holiday_off").hide();
			$(".show_holiday_on").show();
        }
        else
        {
        	$(".show_holiday_off").show();
			$(".show_holiday_on").hide();
			
			if(data.event.title==="4:00PM - 4:20PM")
			{
			$('#holiday_off_1').html("<span style='color:#ff0000'>4:00PM - 4:20PM Not Available</span>");	
			}
			if(data.event.title==="4:30PM - 4:50PM")
			{
				$('#holiday_off_2').html("<span style='color:#ff0000'>4:30PM - 4:50PM Not Available</span>");
			}
			if(data.event.title==="5:00PM - 5:20PM") 
			{
				$('#holiday_off_3').html("<span style='color:#ff0000'>5:00PM - 5:20PM Not Available</span>");
			}
			if(data.event.title==="5:20PM - 5:50PM")
			{
				$('#holiday_off_4').html("<span style='color:#ff0000'>5:20PM - 5:50PM Not Available</span>");
			}
			
        }
        }
        $('#title').val(data.event ? data.event.title : '');
        if( ! data.event) {
            // When adding set timepicker to current time
            var now = new Date();
            var time = now.getHours() + ':' + (now.getMinutes() < 10 ? '0' + now.getMinutes() : now.getMinutes());
        } else {
            // When editing set timepicker to event's time
         //   var time = data.event.date.split(' ')[1].slice(0, -3);
           // time = time.charAt(0) === '0' ? time.slice(1) : time;
        }
        $('#time').val(time);
        if(data.event) {
        $('input[name=holiday][value='+data.event.holiday+']').attr('checked', 'checked');
        }
        else
        {
        $('input[name=holiday]').val();	
        }
       // $('input[name=holiday][value='+ data.event ? data.event.status: '0'+']').attr('checked', 'checked'); 
        //$("input[name=holiday]").val(data.event.status);
        $('#description').val(data.event ? data.event.description : '');
        $('#color').val(data.event ? data.event.color : '#3a87ad');
        // Create Butttons
        $.each(data.buttons, function(index, button){
            $('.modal-footer').prepend('<button type="button" id="' + button.id  + '" class="btn ' + button.css + '">' + button.label + '</button>')
        })
        //Show Modal
        $('.modal').modal('show');
    }
    // Handle Click on Add Button
    $('.uk-modal').on('click', '#add-event',  function(e){
        if(validator(['title', 'description'])) {
            $.post('<?php echo base_url(); ?>usercalendar/addEvent', {
                title: $('#title').val(),
                holiday: $("input[name=holiday]:checked").val(),
                description: $('#description').val(),
                date: currentDate 
            }, function(result){
                $('.uk-modal').modal('hide');
                $('#calendar').fullCalendar("refetchEvents");
            });
        }
    });
    // Handle click on Update Button
    $('.modal').on('click', '#update-event',  function(e){
    	if($("input[name=holiday]:checked").val()==1)
    	{
            $.post('updateEvent.php', {
                id: currentEvent._id,
                title: $("input[name=holiday_off]:checked").val(),
                holiday: $("input[name=holiday]:checked").val(),
                date: currentEvent.date.split(' ')[0]  
            }, function(result){
                $('.modal').modal('hide');
                $('#calendar').fullCalendar("refetchEvents");
            });
       
    	}
    	else {
        if(validator(['title', 'description'])) {
            $.post('updateEvent.php', {
                id: currentEvent._id,
                title: $('#title').val(),
                holiday: $("input[name=holiday]:checked").val(),
                description: $('#description').val(),
                date: currentEvent.date.split(' ')[0]  
            }, function(result){
                $('.modal').modal('hide');
                $('#calendar').fullCalendar("refetchEvents");
            });
        }
        }
    });
    // Handle Click on Delete Button
    $('.modal').on('click', '#delete-event',  function(e){
    	$.post('deleteEvent.php', {
                id: currentEvent._id,
                holiday: $("input[name=holiday]:checked").val(),
               }, function(result){
            $('.modal').modal('hide');
            $('#calendar').fullCalendar("refetchEvents");
        });
    });
    // Get Formated Time From Timepicker
   /*
    function getTime() {
           var time = $('#time').val();
           return (time.indexOf(':') == 1 ? '0' + time : time) + ':00';
       }*/
   
    // Dead Basic Validation For Inputs
    function validator(elements) {
        var errors = 0;
        var holiday = $("input[name=holiday]:checked").val();
        if(holiday==0)
        {
        $.each(elements, function(index, element){
            if($.trim($('#' + element).val()) == '') errors++;
        });
        if(errors) {
            $('.error').html('Please insert title and description');
            return false;
        }
        else
        {
        	return true;
        }
        }
        else
        {
        	var isChecked = $("input[name=holiday_off]:checked").val();
        	 if(!isChecked){
         			$('.error').html('Please Select the time slot');
            		return false;
     		}
     		else{
        	 		return true;
     		}
        	
        }
        
    }
});