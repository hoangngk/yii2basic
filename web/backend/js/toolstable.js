/**
 * @name Tools Table
 * @description This is example plugin
 * @since 1.0
 * @author <hoangngk n.khanhhoang@gmail.com>
 */
(function( $ )
{
    var defaults = {
        model: '',
        field: 'status',
        redirect: '', 
        ajaxUrl: '/qt-table',
        data: [],
        messageContainer: '.quick-tools-table .message',
        loadingContainer: '.quick-tools-table .loading'
    },
    $message = $(defaults.messageContainer)
    $loading = $(defaults.loadingContainer)

    var methods = 
    {
        init : function(options) 
        {
            var settings = $.extend({}, defaults, options || {});
            methods.ajax(settings)
        },
        ajax : function(settings) 
        { 
            // remove current html
            $message.html('');
            $loading.show()

            $.ajax({
                url: settings.ajaxUrl + '/' + settings.action,
                data: {
                    item: settings.data, 
                    model: settings.model, 
                    field: settings.field
                },
                type: 'POST',
                success: function (res) {
                    $loading.hide()
                    res = JSON.parse(res)

                    if (res.message != '') {
                        $message.html(res.message)
                    } else {
                        window.location.href = settings.redirect
                    }
                }
            })
        },
    };

    $.fn.quickToolsTable = function(methodOrOptions) 
    {
        if ( methods[methodOrOptions] ) {
            return methods[ methodOrOptions ].apply( this, Array.prototype.slice.call( arguments, 1 ));
        } 
        else if ( typeof methodOrOptions === 'object' || ! methodOrOptions ) {
            // Default to "init"
            return methods.init.apply( this, arguments );
        } 
        else {
            $.error( 'Method ' +  methodOrOptions + ' does not exist on jQuery.tooltip' );
        }    
    };
})( jQuery );