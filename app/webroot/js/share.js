function calibrephp_share(element, url)
{
    var obj = $(element);

    obj.addClass('loading');

    $.post(url, function(result) {
        obj.removeClass('loading');
    });
}