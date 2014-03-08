/* On document ready, initialize the map, the color picker and the icon picker */
jQuery(document).ready(function ($) {
    // Draw the map as the background
    updateMap();
    // End draw the map as the background
    // Initialize the color picker
    $('#picker').farbtastic('#color');
    var picker = $.farbtastic('#picker');
    picker.linkTo(onColorChange);
    // Initialize the icon picker
    $('select[name=icon]').ImageSelect({
        width: 32,
        height: 37
        });
});
/* Handler for color picker (when the color wheel is clicked, the color text field is updated automatically and also the map */
function onColorChange(color) {
    var elem = document.getElementById("color");
    elem.value = color;
    elem.style.backgroundColor = color;
    var newOptions = {
        styles: [{
                "stylers": [{
                    "hue": color
                    }
                ]
            }
        ]
    };
    // Apply the new color to the map
    applyColorOptions(newOptions);
}
/* Transforms the map type string into a format redable by google maps */
function getMapType(string) {
    switch (string) {
    case 'google.maps.MapTypeId.ROADMAP':
        var type = google.maps.MapTypeId.ROADMAP;
        break;
    case 'google.maps.MapTypeId.SATELLITE':
        var type = google.maps.MapTypeId.SATELLITE;
        break;
    case 'google.maps.MapTypeId.TERRAIN':
        var type = google.maps.MapTypeId.TERRAIN;
        break;
    case 'google.maps.MapTypeId.HYBRID':
        var type = google.maps.MapTypeId.HYBRID;
        break;
    default:
        var type = google.maps.MapTypeId.ROADMAP;
    }
    return type;
}
/* Updates the map with the settings selected in the generator form */
function updateMap() {
    // Get settings selected in the generator form
    var latitude = jQuery("#latitude").val();
    var longitude = jQuery("#longitude").val();
    var html = jQuery("#html").val();
    var popup = Boolean(jQuery("select#popup").val());
    var icon = jQuery("#iconUrl").val();
    var mapType = getMapType(jQuery("select#mapType").val());
    var zoom = parseInt(jQuery("select#zoom").val());
    var panControl = Boolean(jQuery("select#panControl").val());
    var zoomControl = Boolean(jQuery("select#zoomControl").val());
    var mapTypeControl = Boolean(jQuery("select#mapTypeControl").val());
    var scaleControl = Boolean(jQuery("select#scaleControl").val());
    var streetViewControl = Boolean(jQuery("select#streetViewControl").val());
    var scrollWheel = Boolean(jQuery("select#scrollWheel").val());
    var color = jQuery("#color").val();
    // Re-draw the map according to settings selected
    $("#responsive_map").gMap({
        maptype: mapType,
        zoom: zoom,
        markers: [{ // First marker
                latitude: latitude,
                longitude: longitude,
                html: html,
                popup: popup,
                draggable: true,
                flat: true,
                icon: {
                    image: icon,
                    iconsize: [32, 37],
                    iconanchor: [15, 30],
                    shadow: "img/icon-shadow.png",
                    shadowsize: [32, 37],
                    shadowanchor: null
                }
                // End first marker
            }
        ],
        panControl: panControl,
        zoomControl: zoomControl,
        mapTypeControl: mapTypeControl,
        scaleControl: scaleControl,
        streetViewControl: streetViewControl,
        scrollwheel: scrollWheel,
        styles: [{
                "stylers": [{
                        "hue": color
                        }, {
                        "gamma": 1.58
                        }
                        ]
                }
        ],
        onComplete: function () {
        // Resize and re-center the map on window resize event
        var data = $('#responsive_map').data('gmap');
        var gmap = data.gmap;
            window.onresize = function () {
                google.maps.event.trigger(gmap, 'resize');
                $("#responsive_map").gMap('fixAfterResize');
            };
            // On marker drag, update latitude and longitude fields
            google.maps.event.addListener(data.markers[0], 'drag', function() {
               jQuery("#latitude").val(data.markers[0].getPosition().lat());
               jQuery("#longitude").val(data.markers[0].getPosition().lng());
            });
            // Create the address search input field
            createAddressSearchControl(data.markers[0], gmap);
        }
    });
}
// Selects the text inside the given element
function selectText(element) {
    var doc = document
        , text = doc.getElementById(element)
        , range, selection
    ;    
    if (doc.body.createTextRange) {
        range = document.body.createTextRange();
        range.moveToElementText(text);
        range.select();
    } else if (window.getSelection) {
        selection = window.getSelection();        
        range = document.createRange();
        range.selectNodeContents(text);
        selection.removeAllRanges();
        selection.addRange(range);
    }
}

/* Address Search Control */
function createAddressSearchControl(marker, map) {
    var control = document.createElement('div');
    var input = document.createElement('input');
    control.appendChild(input);
    control.setAttribute('id', 'locationField');
    input.setAttribute('id', 'locationInput');
    map.controls[google.maps.ControlPosition.TOP_LEFT].push(control);
  
    var ac = new google.maps.places.Autocomplete(input, { types: ['geocode'] });
    google.maps.event.addListener(ac, 'place_changed', function() {
        var place = ac.getPlace();
        
        map.setCenter(place.geometry.location);
        marker.setPosition(place.geometry.location);
        jQuery("#latitude").val(marker.getPosition().lat());
        jQuery("#longitude").val(marker.getPosition().lng());
    });
  
    google.maps.event.addListener(map, 'bounds_changed', function() {
        input.blur();
        input.value = '';
    });
  
    input.onkeyup = submitGeocode(input);
}
/* Geocodes the address enetered in the input field */
function submitGeocode(input) {
  return function(e) {
    var keyCode;
  
    if (window.event) {
      keyCode = window.event.keyCode;
    } else {
      keyCode = e.which;
    }
  
    if (keyCode == 13) {
      geocoder.geocode( { address: input.value }, function(results, status) {
        if (status == google.maps.GeocoderStatus.OK) {
          map.fitBounds(results[0].geometry.viewport);
        } else {
          alert("The location entered could not be found");
        }
      });
    }
  }
}
/* Applies the new color to the map object */
function applyColorOptions(newOptions) {
    var div = $('#responsive_map');
    var map = div.data('gmap').gmap;
    map.setOptions(newOptions);
}
/* Resets the generator form to its default settings */
function reset() {
    document.getElementById("generatorForm").reset();
    document.getElementById('icon').selectedIndex = 1;
    updateMap();
}
/* Closes the lightbox window */
function closeWindow() {
    jQuery("#mapCode").trigger('close');
}
/* Creates the map code and shows it a lightbox, together with usage instructions*/
function getCode() {
    // Show a lightbox
    jQuery("#mapCode").maplightbox();
    // Get the map settings from the generator form
    var latitude = jQuery("#latitude").val();
    var longitude = jQuery("#longitude").val();
    var html = jQuery("#html").val();
    var popup = Boolean(jQuery("select#popup").val());
    var icon = jQuery("#iconUrl").val();
    var mapType = jQuery("select#mapType").val();
    var zoom = parseInt(jQuery("select#zoom").val());
    var panControl = Boolean(jQuery("select#panControl").val());
    var zoomControl = Boolean(jQuery("select#zoomControl").val());
    var mapTypeControl = Boolean(jQuery("select#mapTypeControl").val());
    var scaleControl = Boolean(jQuery("select#scaleControl").val());
    var streetViewControl = Boolean(jQuery("select#streetViewControl").val());
    var scrollWheel = Boolean(jQuery("select#scrollWheel").val());
    var color = jQuery("#color").val();
    // Generate the map code to be shown in the lightbox
    var innerHTML = '<pre>' +
        '&lt;script src="http://maps.googleapis.com/maps/api/js?sensor=false&#038;v=3.exp"&gt;&lt;/script&gt;\n' +
        '&lt;script src="js/jquery.min.js"&gt;&lt;/script&gt;\n' +
        '&lt;script src="js/jquery.gmap.min.js"&gt;&lt;/script&gt;\n' +
        '&lt;script type="text/javascript"&gt;\n' +
        'jQuery(document).ready(function($) {\n' +
        '\t$("#responsive_map").gMap({\n' +
        '\t\t maptype: ' + mapType + ', \n' +
        '\t\t zoom: ' + zoom + ', \n' +
        '\t\t markers: [{\n' +
        '\t\t\t latitude: ' + latitude + ', \n' +
        '\t\t\t longitude: ' + longitude + ', \n' +
        '\t\t\t html: "' + html.replace(/&/g, "&amp;").replace(/</g, "&lt;").replace(/>/g, "&gt;") + '", \n' +
        '\t\t\t popup: ' + popup + ', \n' +
        '\t\t\t flat: true, \n' +
        '\t\t\t icon: { \n' +
        '\t\t\t\t image: "' + icon + '", \n' +
        '\t\t\t\t iconsize: [32, 37], \n' +
        '\t\t\t\t iconanchor: [15, 30], \n' +
        '\t\t\t\t shadow: "icons/icon-shadow.png", \n' +
        '\t\t\t\t shadowsize: [32, 37], \n' +
        '\t\t\t\t shadowanchor: null}\n' +
        '\t\t\t\t} \n' +
        '\t\t\t], \n' +
        '\t\t panControl: ' + panControl + ', \n' +
        '\t\t zoomControl: ' + zoomControl + ', \n' +
        '\t\t mapTypeControl: ' + mapTypeControl + ', \n' +
        '\t\t scaleControl: ' + scaleControl + ', \n' +
        '\t\t streetViewControl: ' + streetViewControl + ', \n' +
        '\t\t scrollwheel: ' + scrollWheel + ', \n' +
        '\t\t styles: [ { "stylers": [ { "hue": "' + color + '" }, { "gamma": 1.58 } ] } ], \n' +
        '\t\t onComplete: function() {\n' +
        '\t\t\t // Resize and re-center the map on window resize event\n' +
        '\t\t\t var gmap = $("#responsive_map").data(\'gmap\').gmap;\n' +
        '\t\t\t window.onresize = function(){\n' +
        '\t\t\t\t google.maps.event.trigger(gmap, \'resize\');\n' +
        '\t\t\t\t $("#responsive_map").gMap(\'fixAfterResize\');\n' +
        '\t\t\t };\n' +
        '\t\t}\n' +
        '\t});\n' +
        '});\n' +
        '&lt;/script&gt;\n' +
        '&lt;div id="responsive_map"&gt;&lt;/div&gt;\n' +
        '&lt;style type="text/css"&gt;\n' +
        '#responsive_map {height: 1080px; width: 100%;}\n' +
        '#responsive_map div {-webkit-border-radius: 10px; -moz-border-radius: 10px; border-radius: 10px;}\n' +
        '.gm-style-iw {max-width: none !important; min-width: none !important; max-height: none !important; min-height: none !important; overflow-y: hidden !important; overflow-x: hidden !important; line-height: normal !important; padding: 5px !important; }\n' +
        '&lt;/style&gt;';
    document.getElementById('innerMap').innerHTML = innerHTML;
}
/* Prototype for the function which shows the lightbox */
(function ($) {
    $.fn.maplightbox = function (options) {
        return this.each(function () {
            var opts = $.extend({}, $.fn.maplightbox.defaults, options),
                $layer = $(),
                $this = $(this),
                $scribdFrame = $('<iframe id="lightb_scribd" style="z-index: ' + (opts.zIndex + 1) + ';padding: 0; margin: 0; border: none; position: absolute; top: 0; left: 0; width: 100%; height: 100%; filter: mask();"/>');
            // Check if there is an existing layer, if there is, make it clear
            var $currentLayers = $(".js_lightb_layer:visible");
            if ($currentLayers.length > 0) {
                $layer = $('<div class="lightb_layer_clear js_lightb_layer"/>');
            } else {
                $layer = $('<div class="lightb_layer js_lightb_layer"/>');
            }
            // Append layer to document body
            $('body').append($this.hide()).append($layer);
            // Set the CSS for layer
            setLayerHeight();
            $layer.css({
                position: 'absolute',
                width: '100%',
                top: 0,
                right: 0,
                bottom: 0,
                left: 0,
                zIndex: (opts.zIndex + 2),
                display: 'none'
            });
            if (!$layer.hasClass('lightb_layer_clear')) {
                $layer.css({
                    background: 'black',
                    opacity: .6
                });
            }
            // Animate-in the lightbox.
            $layer.fadeIn(250, function () {
                autoPosition();
                $this["fadeIn"](300, function () {
                    setLayerHeight();
                    autoPosition();
                    opts.onLoad()
                });
            });
            // Bind resize and scroll events
            $(window).resize(setLayerHeight);
            $(window).resize(autoPosition);
            $(window).scroll(autoPosition);
            $(window).bind('keyup.maplightbox', handleKey);
            // Handle the close event
            $layer.click(function (e) {
                closeBox();
                e.preventDefault;
            });
            $this.delegate(".close", "click", function (e) {
                closeBox();
                e.preventDefault();
            });
            $this.bind('close', closeBox);
            $this.bind('reposition', autoPosition);
            // Function to bind to the window to observe the escape/enter key press
            function handleKey(e) {
                if ((e.keyCode == 27 || (e.DOM_VK_ESCAPE == 27 && e.which == 0))) closeBox();
            }
            // Set the layer height
            function setLayerHeight() {
                if ($(window).height() < $(document).height()) {
                    $layer.css({
                        height: $(document).height() + 'px'
                    });
                    $scribdFrame.css({
                        height: $(document).height() + 'px'
                    });
                } else {
                    $layer.css({
                        height: '100%'
                    });
                }
            }
            // Remove or hide all the elements
            function closeBox() {
                var s = $this[0].style;
                $this.add($layer).hide();
                $scribdFrame.remove();
                // Unbind the events.
                $this.undelegate(".close", "click");
                $(window).unbind('reposition', setLayerHeight);
                $(window).unbind('scroll', autoPosition);
                $(window).unbind('reposition', autoPosition);
                $(window).unbind('keyup.maplightbox');
            }
            // Set the position of the modal window
            function autoPosition() {
                var s = $this[0].style;
                // Re-calculate margin-left CSS
                $this.css({
                    left: '50%',
                    marginLeft: ($this.outerWidth() / 2) * -1,
                    zIndex: (opts.zIndex + 3)
                });
            }
        });
    };
    // Default values
    $.fn.maplightbox.defaults = {
        onLoad: function () {},
        zIndex: 9999
    }
})(jQuery); // JavaScript Document
/*
 * Prototype for the function which shows instead of a selectbox, an icon picker
 * ImageSelect jQuery Plugin
 * Version 1.2
 *
 * lgalvin
 * http://www.liam-galvin.co.uk/imageselect
 *
 */
(function ($) {
    var methods = {
        init: function (options) {
        if (!/select/i.test(this.tagName)) {
                return false;
            }
            var element = $(this);
            var selectName = element.attr('name');
            var id = 'jq_imageselect_' + selectName;
            if ($('#' + id).length > 0) {
                //already exists
                return;
            }
            var iWidth = options.width > options.dropdownWidth ? options.width : options.dropdownWidth;
            var imageSelect = $(document.createElement('div')).attr('id', id).addClass('jqis');
            imageSelect.css('width', iWidth + 'px').css('height', options.height + 'px');
            var header = $(document.createElement('div')).addClass('jqis_header');
            header.css('width', options.width + 'px').css('height', options.height + 'px');
            header.css('text-align', 'center').css('background-color', options.backgroundColor);
            var dropdown = $(document.createElement('div')).addClass('jqis_dropdown');
            dropdown.css('width', options.dropdownWidth + 'px'); //.css('height',options.dropdownHeight +'px');
            dropdown.css('z-index', options.z).css('background-color', options.backgroundColor).css('border', '1px solid ' + options.borderColor);;
            dropdown.hide();
            var selectedImage = $('option:selected', element).text();
            header.attr('lock', options.lock);
            if (options.lock == 'height') {
                header.append('<img style="height:' + options.height + 'px" />');
            } else {
                header.append('<img style="width:' + (options.width - 75) + 'px" />');
            }
            var $options = $('option', element);
            $options.each(function (i, el) {
                dropdown.append('<img style="width:100%" onclick="jQuery(\'select[name=' + selectName + ']\').val(\'' + $(el).val() + '\').ImageSelect(\'close\').ImageSelect(\'update\',{src:\'' + $(el).text() + '\'});" src="' + $(el).text() + '"/>');
            });
            imageSelect.append(header);
            imageSelect.append(dropdown);
            element.after(imageSelect);
            element.hide();
            header.attr('linkedselect', selectName);
            header.children().attr('linkedselect', selectName);
            header.click(function () {
                $('select[name=' + $(this).attr('linkedselect') + ']').ImageSelect('open');
            });
            var w = 0;
            $('.jqis_dropdown img').mouseover(function () {
                $(this).css('opacity', 1);
            }).mouseout(function () {
                $(this).css('opacity', 0.7);
            }).css('opacity', 0.7).each(function (i, el) {
                w = w + $(el).width();
            });
            dropdown.css('max-height', options.dropdownHeight + 'px');
            element.ImageSelect('update', {
                src: selectedImage
            });
        },
        update: function (options) {
            var element = $(this);
            document.getElementById("iconUrl").value = element.val();
            updateMap();
            var selectName = element.attr('name');
            var id = 'jq_imageselect_' + selectName;
            if ($('#' + id + ' .jqis_header').length == 1) {
                var ffix = false;
                if ($('#' + id + ' .jqis_header img').attr('src') != options.src) {
                    ffix = true; //run fix for firefox
                }
                $('#' + id + ' .jqis_header img').attr('src', options.src).css('opacity', 0.1);
                if (ffix) {
                    setTimeout(function () {
                        element.ImageSelect('update', options);
                    }, 1);
                    return;
                }
                if ($('#' + id + ' .jqis_header').attr('lock') == 'height') {
                    $('#' + id + ' .jqis_header img').unbind('load');
                    $('#' + id + ' .jqis_header img').one('load', function () {
                        $(this).parent().stop();
                        //$('.jqis_dropdown',$(this).parent().parent()).stop();
                        $(this).parent().parent().stop();
                        $(this).parent().animate({
                            width: $(this).width() + 60
                        });
                        $(this).parent().parent().animate({
                            width: $(this).width() + 60
                        });
                        $('.jqis_dropdown', $(this).parent().parent()).animate({
                            width: $(this).width() + 50
                        });
                }).each(function () {
                        if (this.complete) $(this).load();
                    });
                } else {
                    $('#' + id + ' .jqis_header img').unbind('load');
                    $('#' + id + ' .jqis_header img').one('load', function () {
                        $(this).parent().parent().stop();
                        $(this).parent().stop();
                        $(this).parent().parent().css('height', ($(this).height() + 2) + 'px');
                        $(this).parent().animate({
                            height: $(this).height() + 2
                        });
                    }).each(function () {
                        if (this.complete) $(this).load();
                });
                }
                $('#' + id + ' .jqis_header img').animate({
                    opacity: 1
                });
            }
        },
        open: function () {
            var element = $(this);
            var selectName = element.attr('name');
            var id = 'jq_imageselect_' + selectName;
            var w = 0;
            if ($('#' + id).length == 1) {
                if ($('#' + id + ' .jqis_dropdown').is(':visible')) {
                    $('#' + id + ' .jqis_dropdown').stop();
                    $('#' + id + ' .jqis_dropdown').slideUp().fadeOut();
                } else {
                    $('#' + id + ' .jqis_dropdown').stop();
                    var mh = $('#' + id + ' .jqis_dropdown').css('max-height').replace(/px/, '');
                    mh = parseInt(mh);
                    window.imageHeightTotal = 0;
                    $('#' + id + ' .jqis_dropdown').show();
                    $('#' + id + ' .jqis_dropdown img').each(function (i, el) {
                        window.imageHeightTotal = window.imageHeightTotal + $(el).height();
                    });
                    var ih = window.imageHeightTotal;
                    mh = (ih < mh && ih > 0) ? ih : mh;
                    $('#' + id + ' .jqis_dropdown').height(mh);
                }
            }
            },
        close: function () {
            var element = $(this);
            var selectName = element.attr('name');
            var id = 'jq_imageselect_' + selectName;
            if ($('#' + id).length == 1) {
                $('#' + id + ' .jqis_dropdown').slideUp().hide();
            }
        },
        remove: function () {
            if (!/select/i.test(this.tagName)) {
                return false;
            }
            var element = $(this);
            var selectName = element.attr('name');
            var id = 'jq_imageselect_' + selectName;
            if ($('#' + id).length > 0) {
                $('#' + id).remove();
                $('select[name=' + selectName + ']').show();
                return;
            }
        }
    };
    $.fn.ImageSelect = function (method, options) {
        if (method == undefined) {
            method = 'init';
        }
        var settings = {
            width: 200,
            height: 75,
            dropdownHeight: 250,
            dropdownWidth: 200,
            z: 99999,
            backgroundColor: '#ffffff',
            border: true,
            borderColor: '#cccccc',
            lock: 'height'
        };
        if (options) {
            $.extend(settings, options);
        }
        if (typeof method === 'object') {
            $.extend(settings, method);
        }
        settings.dropdownWidth = settings.width - 10;
        return this.each(function () {
            if (methods[method]) {
                return methods[method].apply(this, Array(settings));
            } else if (typeof method === 'object' || !method) {
                return methods.init.apply(this, Array(settings));
            } else {
                $.error('Method ' + method + ' does not exist on jQuery.ImageSelect');
            }
        });
    };
})(jQuery);