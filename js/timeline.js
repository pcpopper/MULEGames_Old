var Timeline = Class.create({
    initialize: function (data, options) {
        this.data = JSON.parse(data);
        this.defaults = {
            // none
        };
        this.options = Object.extend(this.defaults,options || {});
        this.getEvents();
    },
    getEvents: function () {
        console.dir(this.data[0]);
        var i = 0;
        this.data.each(function(id) {
            var eventLineHTML = '<div class="eventLine" id="event_' + i + '"><div class="circle"></div></div>';
            $('timelineContent').insert(eventLineHTML);
            i++;
            if (i > 10) throw $break;
        });
    }
});