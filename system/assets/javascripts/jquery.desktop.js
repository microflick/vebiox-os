//
// Namespace - Module Pattern.
//

$(function() {
  $('.boxy').boxy();
});

var JQD = (function($, window, document, undefined) {
  // Expose innards of JQD.
  return {
    go: function() {
      for (var i in JQD.init) {
        JQD.init[i]();
      }
    },
    init: {
      frame_breaker: function() {
        if (window.location !== window.top.location) {
          window.top.location = window.location;
        }
      },
      //
      // Initialize the clock.
      //
      clock: function() {
        if (!$('#clock').length) {
          return;
        }

        // Date variables.
        var date_obj = new Date();
        var hour = date_obj.getHours();
        var minute = date_obj.getMinutes();
        var day = date_obj.getDate();
        var year = date_obj.getFullYear();
        var suffix = 'AM';

        // Array for weekday.
        var weekday = [
          'Sunday',
          'Monday',
          'Tuesday',
          'Wednesday',
          'Thursday',
          'Friday',
          'Saturday'
        ];

        // Array for month.
        var month = [
          'January',
          'February',
          'March',
          'April',
          'May',
          'June',
          'July',
          'August',
          'September',
          'October',
          'November',
          'December'
        ];

        // Assign weekday, month, date, year.
        weekday = weekday[date_obj.getDay()];
        month = month[date_obj.getMonth()];

        // AM or PM?
        if (hour >= 12) {
          suffix = 'PM';
        }

        // Convert to 12-hour.
        if (hour > 12) {
          hour = hour - 12;
        }
        else if (hour === 0) {
          // Display 12:XX instead of 0:XX.
          hour = 12;
        }

        // Leading zero, if needed.
        if (minute < 10) {
          minute = '0' + minute;
        }




        // Build two HTML strings.
		var clock_date = month + ' ' + day + '';
        var clock_time = '<div style="font-family: \'Segoe UI Light\'"><div style="color: white; font-size: 700%; margin-top: 25%; margin-left: 150px">' + hour + ':' + minute + ' ' + suffix + '</div><br><br><br><div style="color: white; font-size: 400%; font-weight: normal; margin-left: 150px">' + weekday + '</div><br><br><div style="color: white; font-size: 400%; margin-left: 150px">' + clock_date + '</div></div>';
        
	

        // Shove in the HTML.
        $('#bar_bottom').html(clock_time);

        // Update every 60 seconds.
        setTimeout(JQD.init.clock, 60000);
      },
      //
      // Initialize the desktop.
      //
	  
	  

	  
      desktop: function() {
        // Cancel mousedown, right-click.
        $(document).mousedown(function(ev) {
          var tags = ['a', 'button', 'input', 'select', 'textarea'];

          if (!$(ev.target).closest(tags).length) {
            JQD.util.clear_active();
            ev.preventDefault();
            ev.stopPropagation();
          }
        }).bind('contextmenu', function() {
          return false;
        });

        // Relative or remote links?
         $('a').live('click', function(ev) {
          var url = $(this).attr('href');
          this.blur();

          if (url.match(/^#/)) {
            ev.preventDefault();
            ev.stopPropagation();
          }
          else {
            
          }
        });

        // Make top menus active.
        
			 
		
		// Enable Dashboard button
		
		$('a.dashboard').live('mousedown', function() {
          // Get the link's target.
          var x = $(this).attr('href');
          var y = $(x).find('a').attr('href');

          // Show the taskbar button.
          if ($(x).is(':hidden')) {
            $(x).remove().appendTo('#dock');
            $(x).show('fast');
          }

          // Bring window to front.
          JQD.util.window_flat();
          $(y).addClass('window_stack').show();
        });

       



        // Desktop icons.
        $('a.icon').live('mousedown', function() {
          // Highlight the icon.
          JQD.util.clear_active();
          $(this).addClass('active');
        }).live('dblclick', function() {
          // Get the link's target.
          var x = $(this).attr('href');
          var y = $(x).find('a').attr('href');

          // Show the taskbar button.
          if ($(x).is(':hidden')) {
            $(x).remove().appendTo('#dock');
            $(x).show('fast');
          }

          // Bring window to front.
          JQD.util.window_flat();
          $(y).addClass('window_stack').show();
        }).live('mouseenter', function() {
          $(this).die('mouseenter').draggable({
            revert: true,
            containment: 'parent'
          });
        });

        // Taskbar buttons.
        $('#dock a').live('click', function() {
			
			
          var current = $(this);
		  current.addClass('windowHidden');
			
			
          // Get the link's target.
          var x = $($(this).attr('href'));

          // Hide, if visible.
          if (x.is(':visible')) {
            x.hide();
			current.addClass('windowHidden');
          }
          else {
            // Bring window to front.
            JQD.util.window_flat();
			current.removeClass('windowHidden');
            x.show().addClass('window_stack');
          }
        });

        // Make windows movable.
        $('div.window').live('mousedown', function() {
          // Bring window to front.
          JQD.util.window_flat();
          $(this).addClass('window_stack');
        }).live('mouseenter', function() {
          $(this).die('mouseenter').draggable({
            // Confine to desktop.
            // Movable via top bar only.
            cancel: 'a',
            containment: 'parent',
            handle: 'div.window_top'
          }).resizable({
            containment: 'parent',
            minWidth: 400,
            minHeight: 200
          });

        // Double-click top bar to resize, ala Windows OS.
        }).find('div.window_top').live('dblclick', function() {
          JQD.util.window_resize(this);

        // Double click top bar icon to close, ala Windows OS.
        }).find('img').live('dblclick', function() {
          // Traverse to the close button, and hide its taskbar button.
          $($(this).closest('div.window_top').find('a.window_close').attr('href')).hide('fast');

          // Close the window itself.
          $(this).closest('div.window').hide();

          // Stop propagation to window's top bar.
          return false;
        });

        // Minimize the window.
        $('a.window_min').live('click', function() {
          $(this).closest('div.window').hide();
        });

        // Maximize or restore the window.
        $('a.window_resize').live('click', function() {
          JQD.util.window_resize(this);
        });

        // Close the window.
        $('a.window_close').live('click', function() {
          $(this).closest('div.window').hide();
          $($(this).attr('href')).hide('fast');
        });

       

        $('table.data').each(function() {
          // Add zebra striping, ala Mac OS X.
          $(this).find('tbody tr:odd').addClass('zebra');
        }).find('tr').live('mousedown', function() {
          // Highlight row, ala Mac OS X.
          $(this).closest('tr').addClass('active');
        });
      },
      wallpaper: function() {
        // Add wallpaper last, to prevent blocking.
        if ($('#desktop').length) {
          $('body').prepend('<img id="wallpaper" class="abs" src="system/resources/wallpaper_beta.jpg" />');
        }
      }
    },
    util: {
      //
      // Clear active states, hide menus.
      //
      clear_active: function() {
        $('a.active, tr.active').removeClass('active');
        $('ul.menu').hide();
      },
      //
      // Zero out window z-index.
      //
      window_flat: function() {
        $('div.window').removeClass('window_stack');
      },
      //
      // Resize modal window.
      //
	  

      window_resize: function(el) {
        // Nearest parent window.
        var win = $(el).closest('div.window');

        // Is it maximized already?
        if (win.hasClass('window_full')) {
          // Restore window position.
          win.removeClass('window_full').css({
            'top': win.attr('data-t'),
            'left': win.attr('data-l'),
            'right': win.attr('data-r'),
            'bottom': win.attr('data-b'),
            'width': win.attr('data-w'),
            'height': win.attr('data-h')
          });
        }
        else {
          win.attr({
            // Save window position.
            'data-t': win.css('top'),
            'data-l': win.css('left'),
            'data-r': win.css('right'),
            'data-b': win.css('bottom'),
            'data-w': win.css('width'),
            'data-h': win.css('height')
          }).addClass('window_full').css({
            // Maximize dimensions.
            'top': '0',
            'left': '0',
            'right': '0',
            'bottom': '0',
            'width': '100%',
            'height': '100%'
          });
        }

        // Bring window to front.
        JQD.util.window_flat();
        win.addClass('window_stack');
      }
    }
	
  };
// Pass in jQuery.
})(jQuery, this, this.document);

//
// Kick things off.
//
jQuery(document).ready(function() {
  JQD.go();
});
