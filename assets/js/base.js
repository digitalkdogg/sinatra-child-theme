var $ = jQuery
class Millwood {
    constructor() {
        var _this = this;
        this.fn = {
            'init': function () {
                _this.fn.force_full_width()
            },
            'force_full_width': function () {
               var windowwidth = $(window).width();
               var containerwidth = $('#primary.content-area').width();
               var leftadjust = -Math.abs((windowwidth - containerwidth) / 2);
              
               $('.force-full-width').each(function () {
                 $(this).css({'width': windowwidth + 'px', 'left': leftadjust + 'px'});
               })

            }
        }
    }   
}

const millwood = new Millwood();
$(document).ready(function () {
    millwood.fn.init()

    $(window).on('resize', function () {
        millwood.fn.force_full_width()
    })
})