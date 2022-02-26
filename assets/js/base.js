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
                _this.fn.force_full_width()
                _this.fn.get_custom_vars();
            },
            'get_custom_vars': function () {
              let customVars = $('input#customvars').val().split('===');

              for(let i =0; i<customVars.length; i++) {
                let splitval = customVars[i].split('-_-');
                _this.page[splitval[0]]= splitval[1]
              }
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

$(document).ready(function () {
  let sitename = $('input#sitename').val();

  const millwood = new Millwood(sitename);
    millwood.fn.init()

    $(window).on('resize', function () {
        millwood.fn.force_full_width()
    })

//    console.log(millwood)
})
