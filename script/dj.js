/**
 * Created by Sevenn on 02/08/14.
 */

$(document).ready(function()
{
    setupRotator();
});
function setupRotator()
{
    if($('.textItem').length > 1)
    {
        $('.textItem:first').addClass('current').fadeIn(1500);
        setInterval('textRotate()', 5000);
    }
}
function textRotate()
{
    var current = $('.quotes > .current');
    if(current.next().length == 0)
    {
        current.removeClass('current').fadeOut(1500);
        $('.textItem:first').addClass('current').fadeIn(1500);
    }
    else
    {
        current.removeClass('current').fadeOut(1500);
        current.next().addClass('current').fadeIn(1500);
    }
}