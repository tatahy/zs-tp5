(window["webpackJsonp"]=window["webpackJsonp"]||[]).push([["chunk-2198da10"],{"01e3":function(t,e,r){"use strict";r.d(e,"a",(function(){return l}));var n=r("dcb3"),a=r("b42e"),i=r("228e"),s=r("365c");function o(t,e,r){return e in t?Object.defineProperty(t,e,{value:r,enumerable:!0,configurable:!0,writable:!0}):t[e]=r,t}var c="BSpinner",l=n["a"].extend({name:c,functional:!0,props:{type:{type:String,default:"border"},label:{type:String},variant:{type:String,default:function(){return Object(i["c"])(c,"variant")}},small:{type:Boolean,default:!1},role:{type:String,default:"status"},tag:{type:String,default:"span"}},render:function(t,e){var r,n=e.props,i=e.data,c=e.slots,l=e.scopedSlots,u=c(),d=l||{},f=Object(s["b"])("label",{},d,u)||n.label;return f&&(f=t("span",{staticClass:"sr-only"},f)),t(n.tag,Object(a["a"])(i,{attrs:{role:f?n.role||"status":null,"aria-hidden":f?null:"true"},class:(r={},o(r,"spinner-".concat(n.type),n.type),o(r,"spinner-".concat(n.type,"-sm"),n.small),o(r,"text-".concat(n.variant),n.variant),r)}),[f||t()])}})},1729:function(t,e,r){"use strict";r.r(e);var n=function(){var t=this,e=t.$createElement,r=t._self._c||e;return r("div",{staticClass:"py-3"},[t.brief.ready?r("div",[r("h4",{staticClass:"text-center"},[t._v(" 设备总数 "),r("b-button",{directives:[{name:"b-toggle",rawName:"v-b-toggle.info",modifiers:{info:!0}},{name:"b-tooltip",rawName:"v-b-tooltip.hover",modifiers:{hover:!0}}],attrs:{variant:"primary",size:"sm",title:"显示/隐藏信息表"}},[r("strong",[t._v(t._s(t.brief.totalNum))])])],1),r("div",{staticClass:"row pt-3"},t._l(t.cards,(function(e,n){return r("div",{key:n,staticClass:"col-md-4 mb-3"},[r("Briefcard",{directives:[{name:"show",rawName:"v-show",value:e.showMe,expression:"card.showMe"}],class:e.showBorder?e.borderCls:"border-0",attrs:{isShow:0==n,title:e.title,items:t.brief[e.name]},on:{"evt-update-items":function(r){return t.onEvtUpdateItems(e.plugStr,r)}}})],1)})),0)]):r("div",{staticClass:"text-center text-warning mt-5"},[r("h4",[t._v("加载中...")]),r("b-spinner")],1),r("b-collapse",{staticClass:"mt-3",attrs:{id:"info"},model:{value:t.infoTbl.visible,callback:function(e){t.$set(t.infoTbl,"visible",e)},expression:"infoTbl.visible"}},[r("div",[r("h5",{staticClass:"text-center"},[r("span",{staticClass:"px-2 py-1 bg-warning rounded"},[t._v(t._s(t.infoTbl.title))])]),r("div",{staticClass:"row pt-1"},[r("div",{staticClass:"col-sm-4"}),r("div",{staticClass:"col-sm-4 text-center"},[t.infoTbl.subTitle?r("span",{staticClass:"text-muted"},[t._v("——"+t._s(t.infoTbl.subTitle))]):t._e()]),r("div",{staticClass:"col-sm-4 text-right"},[r("b-button",{directives:[{name:"b-toggle",rawName:"v-b-toggle.info",modifiers:{info:!0}}],staticClass:"mx-2",attrs:{variant:"outline-secondary",size:"sm"}},[t._v("隐藏")]),r("b-button",{attrs:{variant:"outline-primary",size:"sm"},on:{click:t.resetTblInfo}},[t._v("重置")])],1)])]),t.infoTbl.ready?r("TheTable",{staticClass:"mt-1",attrs:{"head-bg":"bg-warning",fields:t.infoTbl.fields,fieldsProp:t.infoTbl.fieldsProp,items:t.infoTbl.items}}):r("div",{staticClass:"text-center text-warning"},[t._v(" 加载中... "),r("b-spinner")],1)],1)],1)},a=[],i=(r("4160"),r("caad"),r("b0c0"),r("b64b"),r("d3b7"),r("2532"),r("159b"),r("96cf"),r("1da1")),s=r("01e3"),o=r("5843"),c=r("1947"),l=r("be29"),u=r("6c06"),d=r("3c21"),f=r("2326"),b=r("228e"),p=r("938d"),h=r("7b1e"),m=r("d82f"),v=r("3a58"),g=r("8df8");function y(t,e){var r=Object.keys(t);if(Object.getOwnPropertySymbols){var n=Object.getOwnPropertySymbols(t);e&&(n=n.filter((function(e){return Object.getOwnPropertyDescriptor(t,e).enumerable}))),r.push.apply(r,n)}return r}function w(t){for(var e=1;e<arguments.length;e++){var r=null!=arguments[e]?arguments[e]:{};e%2?y(Object(r),!0).forEach((function(e){O(t,e,r[e])})):Object.getOwnPropertyDescriptors?Object.defineProperties(t,Object.getOwnPropertyDescriptors(r)):y(Object(r)).forEach((function(e){Object.defineProperty(t,e,Object.getOwnPropertyDescriptor(r,e))}))}return t}function O(t,e,r){return e in t?Object.defineProperty(t,e,{value:r,enumerable:!0,configurable:!0,writable:!0}):t[e]=r,t}var x="__BV_Tooltip__",j="hover focus",k={focus:!0,hover:!0,click:!0,blur:!0,manual:!0},_=/^html$/i,T=/^noninteractive$/i,C=/^nofade$/i,S=/^(auto|top(left|right)?|bottom(left|right)?|left(top|bottom)?|right(top|bottom)?)$/i,P=/^(window|viewport|scrollParent)$/i,B=/^d\d+$/i,D=/^ds\d+$/i,N=/^dh\d+$/i,E=/^o-?\d+$/i,R=/^v-.+$/i,$=/\s+/,q=function(t,e){var r="BTooltip",n={title:void 0,trigger:"",placement:"top",fallbackPlacement:"flip",container:!1,animation:!0,offset:0,id:null,html:!1,interactive:!0,disabled:!1,delay:Object(b["c"])(r,"delay"),boundary:String(Object(b["c"])(r,"boundary")),boundaryPadding:Object(v["b"])(Object(b["c"])(r,"boundaryPadding"),0),variant:Object(b["c"])(r,"variant"),customClass:Object(b["c"])(r,"customClass")};if(Object(h["g"])(t.value)||Object(h["f"])(t.value)||Object(h["d"])(t.value)?n.title=t.value:Object(m["j"])(t.value)&&(n=w(w({},n),t.value)),Object(h["h"])(n.title)){var a=e.data||{};n.title=a.attrs&&!Object(h["i"])(a.attrs.title)?a.attrs.title:void 0}Object(m["j"])(n.delay)||(n.delay={show:Object(v["b"])(n.delay,0),hide:Object(v["b"])(n.delay,0)}),t.arg&&(n.container="#".concat(t.arg)),Object(m["k"])(t.modifiers).forEach((function(t){if(_.test(t))n.html=!0;else if(T.test(t))n.interactive=!1;else if(C.test(t))n.animation=!1;else if(S.test(t))n.placement=t;else if(P.test(t))t="scrollparent"===t?"scrollParent":t,n.boundary=t;else if(B.test(t)){var e=Object(v["b"])(t.slice(1),0);n.delay.show=e,n.delay.hide=e}else D.test(t)?n.delay.show=Object(v["b"])(t.slice(2),0):N.test(t)?n.delay.hide=Object(v["b"])(t.slice(2),0):E.test(t)?n.offset=Object(v["b"])(t.slice(1),0):R.test(t)&&(n.variant=t.slice(2)||null)}));var i={};return Object(f["b"])(n.trigger||"").filter(u["a"]).join(" ").trim().toLowerCase().split($).forEach((function(t){k[t]&&(i[t]=!0)})),Object(m["k"])(t.modifiers).forEach((function(t){t=t.toLowerCase(),k[t]&&(i[t]=!0)})),n.trigger=Object(m["k"])(i).join(" "),"blur"===n.trigger&&(n.trigger="focus"),n.trigger||(n.trigger=j),n},I=function(t,e,r){if(p["i"]){var n=q(e,r);if(!t[x]){var a=r.context;t[x]=new g["a"]({parent:a,_scopeId:Object(l["a"])(a,void 0)}),t[x].__bv_prev_data__={},t[x].$on("show",(function(){Object(h["d"])(n.title)&&t[x].updateData({title:n.title(t)})}))}var i={title:n.title,triggers:n.trigger,placement:n.placement,fallbackPlacement:n.fallbackPlacement,variant:n.variant,customClass:n.customClass,container:n.container,boundary:n.boundary,delay:n.delay,offset:n.offset,noFade:!n.animation,id:n.id,interactive:n.interactive,disabled:n.disabled,html:n.html},s=t[x].__bv_prev_data__;if(t[x].__bv_prev_data__=i,!Object(d["a"])(i,s)){var o={target:t};Object(m["k"])(i).forEach((function(e){i[e]!==s[e]&&(o[e]="title"===e&&Object(h["d"])(i[e])?i[e](t):i[e])})),t[x].updateData(o)}}},M=function(t){t[x]&&(t[x].$destroy(),t[x]=null),delete t[x]},U={bind:function(t,e,r){I(t,e,r)},componentUpdated:function(t,e,r){r.context.$nextTick((function(){I(t,e,r)}))},unbind:function(t){M(t)}},L=r("39ba"),z=r("90f1"),A=function(){var t=arguments.length>0&&void 0!==arguments[0]?arguments[0]:{},e={status:!1,th:{tag:"div",class:"text-center",txt:"",children:[]},td:{tag:"div",class:"text-center",txt:"",children:[]}};for(var r in e)"th"!=r&&"td"!=r||(t[r]=Object.keys(t).includes(r)?Object.assign({},e[r],t[r]):e[r]);return Object.assign({},e,t)},J={tblName:"info",fields:{name:["id","sn","type","name","location","status","create_time"],prop:{sn:A({th:{txt:"序列号",class:"text-left"},td:{class:"text-left",id:{name:"id",val:""},route:{name:"equipment-data",query:{}},txt:"",children:[{tag:"a",class:"",id:"",href:"javascript()"},{tag:"b-tooltip",txt:"显示采集数据",class:"",target:""}]}}),type:A({th:{txt:"类型"}}),name:A({th:{txt:"名称"}}),location:A({th:{txt:"地址"}}),status:A({status:!0,th:{txt:"状态"}}),create_time:A({th:{txt:"记录时间"}})}}},F={name:"Information",data:function(){return{urlBase:Object(z["b"])()+"equipment/",cards:[{name:"status",title:"设备状态",plugStr:"(状态)",showMe:!0,showBorder:!1,borderCls:"border-info",reqOpt:{tblName:"info",fields:["id","status"],query:{status:{group:"status"}}}},{name:"type",title:"设备类型",plugStr:"(类型)",showMe:!0,showBorder:!1,borderCls:"border-secondary",reqOpt:{tblName:"info",fields:["id","type"],query:{type:{group:"type"}}}},{name:"location",title:"分布地域",plugStr:"(地域)",showMe:!0,showBorder:!1,borderCls:"border-primary",reqOpt:{tblName:"info",fields:["id","location"],query:{location:{group:"location"}}}}],brief:{ready:!1,totalNum:0,type:[],status:[],location:[]},infoTbl:{title:"设备信息概要表",subTitle:"所有设备",fields:"",fieldsProp:J.fields.prop,items:[],ready:!1,visible:!1}}},computed:{showBtnReset:function(){var t=this.brief.totalNum,e=this.infoTbl.items.length;return!!(t-e)}},methods:{fetchTbData:function(){var t=Object(i["a"])(regeneratorRuntime.mark((function t(e,r){var n,a;return regeneratorRuntime.wrap((function(t){while(1)switch(t.prev=t.next){case 0:return n={method:"POST",body:JSON.stringify(r)},a=this.urlBase+e,t.next=4,Object(z["a"])(a,n);case 4:return t.abrupt("return",t.sent);case 5:case"end":return t.stop()}}),t,this)})));function e(e,r){return t.apply(this,arguments)}return e}(),getDataBrief:function(){var t=Object(i["a"])(regeneratorRuntime.mark((function t(){var e,r,n,a,i;return regeneratorRuntime.wrap((function(t){while(1)switch(t.prev=t.next){case 0:if(e={tblName:"info",query:{totalNum:{where:[["id",">","0"]]},type:{group:"type"},location:{group:"location"},status:{group:"status"}}},r=this.brief,r.ready){t.next=7;break}return t.next=5,this.fetchTbData("brief",e);case 5:if(n=t.sent,n.ok){for(i in a=n.cont.items,e.query)r[i]=a[i];r.ready=!0}case 7:case"end":return t.stop()}}),t,this)})));function e(){return t.apply(this,arguments)}return e}(),initDataInfo:function(){var t=Object(i["a"])(regeneratorRuntime.mark((function t(){var e,r,n;return regeneratorRuntime.wrap((function(t){while(1)switch(t.prev=t.next){case 0:if(e={tblName:"info",items:[],fields:J.fields.name,query:{where:[["id",">","0"]],order:{create_time:"desc"}}},r=this.infoTbl,r.ready){t.next=9;break}return r.title="设备信息概要表",r.subTitle="所有设备",t.next=7,this.fetchTbData("info",e);case 7:n=t.sent,n.ok&&(r.fields=n.cont.fields,r.items=n.cont.items,r.ready=!0);case 9:case"end":return t.stop()}}),t,this)})));function e(){return t.apply(this,arguments)}return e}(),resetTblInfo:function(){var t=this.brief.totalNum,e=this.infoTbl.items.length;this.setCardsShow(),t-e&&(this.infoTbl.ready=!1,this.initDataInfo())},updateItems:function(){var t=Object(i["a"])(regeneratorRuntime.mark((function t(e,r){var n,a,i,s,o,c,l;return regeneratorRuntime.wrap((function(t){while(1)switch(t.prev=t.next){case 0:if(n=["设备信息概要表",r.txt,r.idArr],a=n[0],i=n[1],s=n[2],o=this.infoTbl,o.visible=!0,o.subTitle==i){t.next=13;break}return o.ready=!1,o.title=a+e,o.subTitle=i,c={tblName:"info",items:[],fields:J.fields.name,query:{where:[["id","in",s]],order:{create_time:"desc"}}},t.next=10,this.fetchTbData("info",c);case 10:l=t.sent,l.ok&&(o.items=l.cont.items,o.ready=!0),o.ready=!0;case 13:case"end":return t.stop()}}),t,this)})));function e(e,r){return t.apply(this,arguments)}return e}(),setCardsShow:function(){var t=arguments.length>0&&void 0!==arguments[0]?arguments[0]:"";this.cards.forEach((function(t){t.showMe=!0,t.showBorder=!1})),t&&this.cards.forEach((function(e){e.showMe=e.plugStr===t,e.showBorder=e.plugStr===t}))},onEvtUpdateItems:function(t,e){this.setCardsShow(t),this.updateItems(t,e)}},components:{BSpinner:s["a"],BCollapse:o["a"],BButton:c["a"],TheTable:function(){return r.e("chunk-2d215c41").then(r.bind(null,"c031"))},Briefcard:function(){return r.e("chunk-121d7867").then(r.bind(null,"6fb7"))}},directives:{"b-tooltip":U,"b-toggle":L["e"]},created:function(){this.initDataInfo(),this.getDataBrief()}},G=F,V=r("2877"),H=Object(V["a"])(G,n,a,!1,null,"1f3f51de",null);e["default"]=H.exports},"1da1":function(t,e,r){"use strict";r.d(e,"a",(function(){return a}));r("d3b7"),r("e6cf");function n(t,e,r,n,a,i,s){try{var o=t[i](s),c=o.value}catch(l){return void r(l)}o.done?e(c):Promise.resolve(c).then(n,a)}function a(t){return function(){var e=this,r=arguments;return new Promise((function(a,i){var s=t.apply(e,r);function o(t){n(s,a,i,o,c,"next",t)}function c(t){n(s,a,i,o,c,"throw",t)}o(void 0)}))}}},2532:function(t,e,r){"use strict";var n=r("23e7"),a=r("5a34"),i=r("1d80"),s=r("ab13");n({target:"String",proto:!0,forced:!s("includes")},{includes:function(t){return!!~String(i(this)).indexOf(a(t),arguments.length>1?arguments[1]:void 0)}})},"44e7":function(t,e,r){var n=r("861d"),a=r("c6b6"),i=r("b622"),s=i("match");t.exports=function(t){var e;return n(t)&&(void 0!==(e=t[s])?!!e:"RegExp"==a(t))}},"5a34":function(t,e,r){var n=r("44e7");t.exports=function(t){if(n(t))throw TypeError("The method doesn't accept regular expressions");return t}},"90f1":function(t,e,r){"use strict";r.d(e,"a",(function(){return i})),r.d(e,"b",(function(){return o}));r("caad"),r("c975"),r("fb6a"),r("d3b7"),r("2532"),r("3ca3"),r("ddb0"),r("2b3d"),r("96cf");var n=r("1da1"),a=!1;function i(t){return s.apply(this,arguments)}function s(){return s=Object(n["a"])(regeneratorRuntime.mark((function t(e){var r,n,a,i,s,o=arguments;return regeneratorRuntime.wrap((function(t){while(1)switch(t.prev=t.next){case 0:if(r=o.length>1&&void 0!==o[1]?o[1]:{},n=["blob","text","json","formData"],a={method:"GET",headers:{"Content-Type":"application/json"},type:"json"},i={ok:!1},s={ok:!1,cont:{}},r=Object.assign({},a,r),!e||!n.includes(r.type)){t.next=10;break}return t.next=9,fetch(e,r);case 9:i=t.sent;case 10:if(!i.ok){t.next=33;break}s.ok=!0,t.t0=r.type,t.next="blob"===t.t0?15:"text"===t.t0?19:"formData"===t.t0?23:27;break;case 15:return t.next=17,i.blob();case 17:return s.cont=t.sent,t.abrupt("break",31);case 19:return t.next=21,i.text();case 21:return s.cont=t.sent,t.abrupt("break",31);case 23:return t.next=25,i.formData();case 25:return s.cont=t.sent,t.abrupt("break",31);case 27:return t.next=29,i.json();case 29:return s.cont=t.sent,t.abrupt("break",31);case 31:t.next=34;break;case 33:s.cont.data=[{result:i.ok,status:i.status,statusText:i.statusText}];case 34:return t.abrupt("return",s);case 35:case"end":return t.stop()}}),t)}))),s.apply(this,arguments)}function o(){var t=window.location.href,e=t.indexOf("#")>0,r=e?new URL(t.slice(0,t.indexOf("#"))):new URL(t);return a&&(r.port=2e4),r}},ab13:function(t,e,r){var n=r("b622"),a=n("match");t.exports=function(t){var e=/./;try{"/./"[t](e)}catch(r){try{return e[a]=!1,"/./"[t](e)}catch(n){}}return!1}},caad:function(t,e,r){"use strict";var n=r("23e7"),a=r("4d64").includes,i=r("44d2"),s=r("ae40"),o=s("indexOf",{ACCESSORS:!0,1:0});n({target:"Array",proto:!0,forced:!o},{includes:function(t){return a(this,t,arguments.length>1?arguments[1]:void 0)}}),i("includes")}}]);
//# sourceMappingURL=chunk-2198da10.d79b19f5.js.map