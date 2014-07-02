/*
 * @author			Daniyal Hamid
 * 
 * @license			This JavaScript file is a commercial file, available for purchase at 
 *					http://codecanyon.net/user/daniyal/portfolio. Any illegal copying, 
 *					distribution, packaging or re-production of this script for commercial or 
 *					personal use is strictly prohibited and will be considered theft.
 *
 * @copyright		The author is the first owner of copyright and reserves all rights to
 *					all written work contained in this file. Distribution, re-production
 *					or commercial use of the written work in this file, without the author's 
 * 					signed permission, prior consent or a valid license, is strictly prohibited.
 *					The author is protected by the "Copyright, Designs and Patents Act 1988" of 
 *					the United Kingdom. Any infringement of the copyright, in or outside of the
 *					United Kingdom, may result in a lawsuit.
 */


(function(b){var a=new Array();b(document).bind("click",function(c){if(a.length>0){b.each(a,function(e,g){var f=b(g.selected),d=f.data("regionActive");if(null!=d&&g.event==="click"){c.type="regionClick";if(d){g.func.apply(f,[c,true])}else{g.func.apply(f,[c,false])}}})}});b(document).bind("mousemove",function(c){if(a.length>0){b.each(a,function(e,g){var f=b(g.selected),d=f.data("regionActive");if(null!=d&&g.event==="hover"){c.type="regionHover";if(d){g.func.apply(f,[c,true])}else{g.func.apply(f,[c,false])}}})}});b.fn.region=function(f,e){var d=b(this),c=d.data("regionActive");if(f!=="hover"&&f!=="click"){throw new Error('Specified event "'+f+'" is not supported!')}if(!c){d.data("regionActive",false)}a.push({event:f,selected:d,func:e});b(d).bind("mouseenter",function(g){d.data("regionActive",true)});b(d).bind("mouseleave",function(g){d.data("regionActive",false)})}})(jQuery);