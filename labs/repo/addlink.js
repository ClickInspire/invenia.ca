(function ($) {
        insertShortcode = function(mytext,link) {
                        var win = window.dialogArguments || opener || parent || top;
                        var shortcode='<a href=\"'+link+'\">'+mytext+'</a>';
                        win.send_to_editor(shortcode);
                }

        $(function () {
                $('#insert_shortcode').bind('click',function() {
                                var link= $('#link').val();
                                var mytext=$('#mytext').val();
                                insertShortcode(mytext,link);
                });
        });
})(jQuery);