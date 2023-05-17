$(document).ready(function () {
  // console.log(events);
  $('#calendar').fullCalendar({
      header: {
        left: 'today, prev, next',
        center: 'title',
        right: 'month, agendaWeek, agendaDay',
      },
      selectable: true,
      selectHelper: true,
      select:function(start, end, allDays) {
        // $('#calendarEvent').modal('toggle');
        
      }
  })
});