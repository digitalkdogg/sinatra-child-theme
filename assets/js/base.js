var $ = jQuery
class Millwood {
    constructor(sitename) {
        var _this = this;
        this.sitename = sitename,
        this.page = {
            'url': location.href,
            'name': document.title,
            'location':location,
            //'is_mobile': false
        },
        this.fn = {
            'init': function () {
                if (sitename != undefined) {
                  $('body').addClass(sitename);
                }

                if ($('body').hasClass('home')==true) {
                  let headerHeight = $('#sinatra-header').height()
                  $('#main.site-main').css({top:headerHeight+'px', position:'relative'})
                }
                _this.fn.get_custom_vars();
                _this.fn.force_full_width()

            },
            'get_custom_vars': function () {
              let customVars = $('input#customvars').val().split('===');

              for(let i =0; i<customVars.length; i++) {
                let splitval = customVars[i].split('-_-');
                _this.page[splitval[0]]= splitval[1]
              }
            },
            'force_full_width': function () {
              var outerwidth = $('#main.site-main').width()
            
               $('.force-full-width').each(function () {
                  var leftadjust = -Math.abs($(this).position().left);
                  $(this).css({'width': outerwidth + 'px', 'left': leftadjust + 'px'});
               })

            }
        }
    }
}
  var millwood = null;
$(document).ready(function () {
  let sitename = $('input#sitename').val();

    millwood = new Millwood(sitename);
    millwood.fn.init()

    $(window).on('resize', function () {
        millwood.fn.force_full_width()
    })
})