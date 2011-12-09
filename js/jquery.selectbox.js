;(function(){$.fn.selCust=function(a){return this.each(function(){if("SELECT"!=this.tagName.toUpperCase()){return}new l(this,a)})};var h={skin:"selCust",suffix:"__selCust",hiddenSuffix:"__selCustHidden",initialHiddenValue:"",emptyText:"",autoFill:false,triggerSelected:true,filterFn:null,dropUp:false,separator:",",showListCallback:null,hideListCallback:null,initCallback:null,initEventsCallback:null,changeCallback:null,textChangeCallback:null,checkWidth:true};$.selCust=function(c,d){if(c.tagName.toUpperCase()!="SELECT")return;this.config=$.extend({},h,d||{});this.selectbox=$(c);this.options=this.selectbox.children().filter("option");this.wrapper=this.selectbox.wrap("<div>").hide().parent().addClass("divselect").addClass(this.config.skin);this.input=$("<input type='text' />").appendTo(this.wrapper).attr("autocomplete","off").attr("value","").attr("name",this.selectbox.attr("name")+this.config.suffix);this.hidden=$("<input type='hidden' />").appendTo(this.wrapper).attr("autocomplete","off").attr("value",this.config.initialHiddenValue).attr("name",this.selectbox.attr("name")+this.config.hiddenSuffix);this.icon=$("<div />").appendTo(this.wrapper).addClass("icon");this.listWrapper=$("<div />").appendTo(this.wrapper).addClass("list-wrapper");this.updateDrop();this.list=$("<ul />").appendTo(this.listWrapper);var e=this;var f=[];this.options.each(function(){var a=$.trim($(this).text());if(e.config.checkWidth){f.push($("<li />").appendTo(e.list).html("<span>"+a+"</span>").addClass("visible").find("span").outerWidth())}else{$("<li />").appendTo(e.list).html("<span>"+a+"</span>").addClass("visible")}});this.listItems=this.list.children();if(f.length){f=f.sort(function(a,b){return a-b});var g=f[f.length-1]}this.singleItemHeight=this.listItems.outerHeight();this.listWrapper.addClass("invisible");if($.browser.opera){this.wrapper.css({position:"relative",left:"0",top:"0"})}this.filterFn=("function"==typeof(this.config.filterFn))?this.config.filterFn:this.filterFn;this.lastKey=null;this.multiple=this.selectbox.attr("multiple");var e=this;this.wrapper.data("sc:lastEvent","click");this.overflowCSS="overflowY";if((this.config.checkWidth)&&(this.listWrapper.innerWidth()<g)){this.overflowCSS="overflow"}this.notify("init");this.initEvents()};var l=$.selCust;l.fn=l.prototype={};l.fn.extend=l.extend=$.extend;l.fn.extend({initEvents:function(){var a=this;this.icon.bind("click",function(e){if(!a.wrapper.data("sc:positionY")){a.wrapper.data("sc:positionY",e.pageY)}});this.input.bind("click",function(e){if(!a.wrapper.data("sc:positionY")){a.wrapper.data("sc:positionY",e.pageY)}});this.wrapper.bind("click",function(e){if(!a.wrapper.data("sc:positionY")){a.wrapper.data("sc:positionY",e.pageY)}});this.icon.bind("click",function(){if(a.input.attr("disabled")){a.input.attr("disabled",false)}a.wrapper.data("sc:lastEvent","click");a.filter();a.iconClick()});this.listItems.bind("mouseover",function(e){if("LI"==e.target.nodeName.toUpperCase()){a.highlight(e.target)}else{a.highlight($(e.target).parent())}});this.listItems.bind("click",function(e){a.listItemClick($(e.target))});this.input.bind("keyup",function(e){a.wrapper.data("sc:lastEvent","key");a.keyUp(e)});this.input.bind("keypress",function(e){if(l.KEY.RETURN==e.keyCode){e.preventDefault()}if(l.KEY.TAB==e.keyCode)e.preventDefault()});$(document).bind("click",function(e){if((a.icon.get(0)==e.target)||(a.input.get(0)==e.target))return;a.hideList()});this.triggerSelected();this.applyEmptyText();this.input.bind("click",function(e){a.wrapper.data("sc:lastEvent","click");a.icon.trigger("click")});this.wrapper.bind("click",function(){a.wrapper.data("sc:lastEvent","click")});this.input.bind("keydown",function(e){if(9==e.keyCode){e.preventDefault()}});this.wrapper.bind("keyup",function(e){var k=e.keyCode;for(key in l.KEY){if(l.KEY[key]==k){return}}a.wrapper.data("sc:lastEvent","key")});this.input.bind("click",function(){a.wrapper.data("sc:lastEvent","click")});this.icon.bind("click",function(e){if(!a.wrapper.data("sc:positionY")){a.wrapper.data("sc:positionY",e.pageY)}});this.input.bind("click",function(e){if(!a.wrapper.data("sc:positionY")){a.wrapper.data("sc:positionY",e.pageY)}});this.wrapper.bind("click",function(e){if(!a.wrapper.data("sc:positionY")){a.wrapper.data("sc:positionY",e.pageY)}});this.notify("initEvents")},getTextValue:function(){return this.__getValue("input")},getCurrentTextValue:function(){return this.__getCurrentValue("input")},getHiddenValue:function(){return this.__getValue("hidden")},getCurrentHiddenValue:function(){return this.__getCurrentValue("hidden")},__getValue:function(a){a=this[a];if(!this.multiple)return $.trim(a.val());var b=a.val().split(this.config.separator);var c=[];for(var i=0,len=b.length;i<len;++i){c.push($.trim(b[i]))}c=l.normalizeArray(c);return c},__getCurrentValue:function(a){a=this[a];if(!this.multiple)return $.trim(a.val());return $.trim(a.val().split(this.config.separator).pop())},iconClick:function(){if(this.listVisible()){this.hideList();this.input.blur()}else{this.showList();this.input.focus();if(this.input.val().length){this.selection(this.input.get(0),0,this.input.val().length)}}},listVisible:function(){return this.listWrapper.hasClass("visible")},showList:function(){if(!this.listItems.filter(".visible").length)return;this.listWrapper.removeClass("invisible").addClass("visible");this.wrapper.css("zIndex","99999");this.listWrapper.css("zIndex","99999");this.setListHeight();var a=this.listWrapper.height();var b=this.wrapper.height();var c=parseInt(this.wrapper.data("sc:positionY"))+b+a;var d=$(window).height()+$(document).scrollTop();if(c>d){this.setDropUp(true)}else{this.setDropUp(false)}if(""==$.trim(this.input.val())){this.highlightFirst();this.listWrapper.scrollTop(0)}else{this.highlightSelected()}this.notify("showList")},hideList:function(){if(this.listWrapper.hasClass("invisible"))return;this.listWrapper.removeClass("visible").addClass("invisible");this.wrapper.css("zIndex","0");this.listWrapper.css("zIndex","99999");this.notify("hideList")},getListItemsHeight:function(){var a=this.singleItemHeight;return a*this.liLen()},setOverflow:function(){var a=this.getListMaxHeight();if(this.getListItemsHeight()>a)this.listWrapper.css(this.overflowCSS,"scroll");else this.listWrapper.css(this.overflowCSS,"hidden")},highlight:function(a){if((l.KEY.DOWN==this.lastKey)||(l.KEY.UP==this.lastKey))return;this.listItems.removeClass("active");$(a).addClass("active")},setdivselectValue:function(a,b,c){var d=this.input.val();var v="";if(this.multiple){v=this.getTextValue();if(b)v.pop();v.push($.trim(a));v=l.normalizeArray(v);v=v.join(this.config.separator)+this.config.separator}else{v=$.trim(a)}this.input.val(v);this.setHiddenValue(a);this.filter();if(c)this.hideList();this.input.removeClass("empty");if(this.multiple)this.input.focus();if(this.input.val()!=d)this.notify("textChange")},setHiddenValue:function(a){var b=false;a=$.trim(a);var c=this.hidden.val();if(!this.multiple){for(var i=0,len=this.options.length;i<len;++i){if(a==this.options.eq(i).text()){this.hidden.val(this.options.eq(i).val());b=true;break}}}else{var d=this.getTextValue();var e=[];for(var i=0,len=d.length;i<len;++i){for(var j=0,len1=this.options.length;j<len1;++j){if(d[i]==this.options.eq(j).text()){e.push(this.options.eq(j).val())}}}if(e.length){b=true;this.hidden.val(e.join(this.config.separator))}}if(!b){this.hidden.val(this.config.initialHiddenValue)}if(c!=this.hidden.val())this.notify("change");this.selectbox.val(this.hidden.val());this.selectbox.trigger("change")},listItemClick:function(a){this.setdivselectValue(a.text(),true,true);this.inputFocus()},filter:function(){if("yes"==this.wrapper.data("sc:optionsChanged")){var c=this;this.listItems.remove();this.options=this.selectbox.children().filter("option");this.options.each(function(){var a=$.trim($(this).text());$("<li />").appendTo(c.list).text(a).addClass("visible")});this.listItems=this.list.children();this.listItems.bind("mouseover",function(e){c.highlight(e.target)});this.listItems.bind("click",function(e){c.listItemClick($(e.target))});c.wrapper.data("sc:optionsChanged","")}var d=this.input.val();var c=this;this.listItems.each(function(){var a=$(this);var b=a.text();if(c.filterFn.call(c,c.getCurrentTextValue(),b,c.getTextValue())){a.removeClass("invisible").addClass("visible")}else{a.removeClass("visible").addClass("invisible")}});this.setOverflow();this.setListHeight()},filterFn:function(a,b,c){if("click"==this.wrapper.data("sc:lastEvent")){return true}if(!this.multiple){return b.toLowerCase().indexOf(a.toLowerCase())==0}else{for(var i=0,len=c.length;i<len;++i){if(b==c[i]){return false}}return b.toLowerCase().search(a.toLowerCase())==0}},getListMaxHeight:function(){var a=parseInt(this.listWrapper.css("maxHeight"),10);if(isNaN(a)){a=this.singleItemHeight*10}return a},setListHeight:function(){var a=this.getListItemsHeight();var b=this.getListMaxHeight();var c=this.listWrapper.height();if(a<c){this.listWrapper.height(a);return a}else if(a>c){this.listWrapper.height(Math.min(b,a));return Math.min(b,a)}},getActive:function(){return this.listItems.filter(".active")},keyUp:function(e){this.lastKey=e.keyCode;var k=l.KEY;switch(e.keyCode){case k.RETURN:case k.TAB:this.setdivselectValue(this.getActive().text(),true,true);if(!this.multiple)this.input.blur();break;case k.DOWN:this.highlightNext();break;case k.UP:this.highlightPrev();break;case k.ESC:this.hideList();break;default:this.inputChanged();break}},liLen:function(){return this.listItems.filter(".visible").length},inputChanged:function(){this.filter();if(this.liLen()){this.showList();this.setOverflow();this.setListHeight()}else{this.hideList()}this.setHiddenValue(this.input.val());this.notify("textChange")},highlightFirst:function(){this.listItems.removeClass("active").filter(".visible:eq(0)").addClass("active");this.autoFill()},highlightSelected:function(){this.listItems.removeClass("active");var b=$.trim(this.input.val());try{this.listItems.each(function(){var a=$(this);if(a.text()==b){a.addClass("active");self.listWrapper.scrollTop(0);self.scrollDown()}})}catch(e){}},highlightNext:function(){var a=this.getActive().next();while(a.hasClass("invisible")&&a.length){a=a.next()}if(a.length){this.listItems.removeClass("active");a.addClass("active");this.scrollDown()}},scrollDown:function(){if("scroll"!=this.listWrapper.css(this.overflowCSS))return;var a=this.getActiveIndex()+1;var b=this.listItems.outerHeight()*a-this.listWrapper.height();if($.browser.msie)b+=a;if(this.listWrapper.scrollTop()<b)this.listWrapper.scrollTop(b)},highlightPrev:function(){var a=this.getActive().prev();while(a.length&&a.hasClass("invisible"))a=a.prev();if(a.length){this.getActive().removeClass("active");a.addClass("active");this.scrollUp()}},getActiveIndex:function(){return $.inArray(this.getActive().get(0),this.listItems.filter(".visible").get())},scrollUp:function(){if("scroll"!=this.listWrapper.css(this.overflowCSS))return;var a=this.getActiveIndex()*this.listItems.outerHeight();if(this.listWrapper.scrollTop()>a){this.listWrapper.scrollTop(a)}},applyEmptyText:function(){if(!this.config.emptyText.length)return;var a=this;this.input.bind("focus",function(){a.inputFocus()}).bind("blur",function(){a.inputBlur()});if(""==this.input.val()){this.input.addClass("empty").val(this.config.emptyText)}},inputFocus:function(){if(this.input.hasClass("empty")){this.input.removeClass("empty").val("")}},inputBlur:function(){if(""==this.input.val()){this.input.addClass("empty").val(this.config.emptyText)}},triggerSelected:function(){if(!this.config.triggerSelected)return;var a=this;try{this.options.each(function(){if($(this).attr("selected")){a.setdivselectValue($(this).text(),false,true);throw new Exception();}})}catch(e){return}a.setdivselectValue(this.options.eq(0).text(),false,false)},autoFill:function(){if(!this.config.autoFill||(l.KEY.BACKSPACE==this.lastKey)||this.multiple)return;var a=this.input.val();var b=this.getActive().text();this.input.val(b);this.selection(this.input.get(0),a.length,b.length)},selection:function(a,b,c){if(a.createTextRange){var d=a.createTextRange();d.collapse(true);d.moveStart("character",b);d.moveEnd("character",c);d.select()}else if(a.setSelectionRange){a.setSelectionRange(b,c)}else{if(a.selectionStart){a.selectionStart=b;a.selectionEnd=c}}},updateDrop:function(){if(this.config.dropUp)this.listWrapper.addClass("list-wrapper-up");else this.listWrapper.removeClass("list-wrapper-up")},setDropUp:function(a){this.config.dropUp=a;this.updateDrop()},notify:function(a){if(!$.isFunction(this.config[a+"Callback"]))return;this.config[a+"Callback"].call(this)}});l.extend({KEY:{UP:38,DOWN:40,DEL:46,TAB:9,RETURN:13,ESC:27,COMMA:188,PAGEUP:33,PAGEDOWN:34,BACKSPACE:8},log:function(a){var b=$("#log");b.html(b.html()+a+"<br />")},createSelectbox:function(a){var b=$("<select />").appendTo(a.container).attr({name:a.name,id:a.id,size:"1"});if(a.multiple)b.attr("multiple",true);var c=a.data;var d=false;for(var i=0,len=c.length;i<len;++i){d=c[i].selected||false;$("<option />").appendTo(b).attr("value",c[i].value).text(c[i].text).attr("selected",d)}return b.get(0)},create:function(b){var c={name:"",id:"",data:[],multiple:false,container:$(document),url:"",ajaxData:{}};b=$.extend({},c,b||{});if(b.url){return $.getJSON(b.url,b.ajaxData,function(a){delete b.url;delete b.ajaxData;b.data=a;return l.create(b)})}b.container=$(b.container);var d=l.createSelectbox(b);return new l(d,b)},deactivate:function(b){b=$(b);b.each(function(){if("SELECT"!=this.tagName.toUpperCase()){return}var a=$(this);if(!a.parent().is(".divselect")){return}})},activate:function(b){b=$(b);b.each(function(){if("SELECT"!=this.tagName.toUpperCase()){return}var a=$(this);if(!a.parent().is(".divselect")){return}a.parent().find("input[type='text']").attr("disabled",false)})},changeOptions:function(f){f=$(f);f.each(function(){if("SELECT"!=this.tagName.toUpperCase()){return}var a=$(this);var b=a.parent();var c=b.find("input[type='text']");var d=b.find("ul").parent();d.removeClass("visible").addClass("invisible");b.css("zIndex","0");d.css("zIndex","99999");c.val("");b.data("sc:optionsChanged","yes");var e=a;e.parent().find("input[type='text']").val(e.find("option:eq(0)").text());e.parent().data("sc:lastEvent","click");e.find("option:eq(0)").attr('selected','selected')})},normalizeArray:function(a){var b=[];for(var i=0,len=a.length;i<len;++i){if(""==a[i])continue;b.push(a[i])}return b}})})(jQuery);