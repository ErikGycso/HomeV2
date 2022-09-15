/* To avoid CSS expressions while still supporting IE 7 and IE 6, use this script */
/* The script tag referencing this file must be placed before the ending body tag. */

/* Use conditional comments in order to target IE 7 and older:
	<!--[if lt IE 8]><!-->
	<script src="ie7/ie7.js"></script>
	<!--<![endif]-->
*/

(function() {
	function addIcon(el, entity) {
		var html = el.innerHTML;
		el.innerHTML = '<span style="font-family: \'gycso\'">' + entity + '</span>' + html;
	}
	var icons = {
		'icon-gycso-person': '&#xe902;',
		'icon-gycso-engranaje': '&#xe903;',
		'icon-gycso-portafolio': '&#xe904;',
		'icon-gycso-candado': '&#xe905;',
		'icon-gycso-pluma': '&#xe900;',
		'icon-gycso-card-info': '&#xe901;',
		'icon-gycso-torniquete': '&#xe90a;',
		'icon-gycso-video-camara': '&#xe90b;',
		'0': 0
		},
		els = document.getElementsByTagName('*'),
		i, c, el;
	for (i = 0; ; i += 1) {
		el = els[i];
		if(!el) {
			break;
		}
		c = el.className;
		c = c.match(/icon-gycso-[^\s'"]+/);
		if (c && icons[c[0]]) {
			addIcon(el, icons[c[0]]);
		}
	}
}());
