


# other script
# add html class
$('html').addClass 'fixed-height'
$('#sales').parent('.content-wrapper').prop 'style', ''

# window height
wH = parseInt $(window).height()

wH -= 51

$('.pos-ui').css 'height', wH + "px"
