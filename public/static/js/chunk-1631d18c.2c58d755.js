(window["webpackJsonp"]=window["webpackJsonp"]||[]).push([["chunk-1631d18c"],{"01e3":function(t,e,n){"use strict";n.d(e,"a",(function(){return o}));var r=n("dcb3"),a=n("b42e"),s=n("228e"),i=n("365c");function c(t,e,n){return e in t?Object.defineProperty(t,e,{value:n,enumerable:!0,configurable:!0,writable:!0}):t[e]=n,t}var u="BSpinner",o=r["a"].extend({name:u,functional:!0,props:{type:{type:String,default:"border"},label:{type:String},variant:{type:String,default:function(){return Object(s["c"])(u,"variant")}},small:{type:Boolean,default:!1},role:{type:String,default:"status"},tag:{type:String,default:"span"}},render:function(t,e){var n,r=e.props,s=e.data,u=e.slots,o=e.scopedSlots,l=u(),d=o||{},p=Object(i["b"])("label",{},d,l)||r.label;return p&&(p=t("span",{staticClass:"sr-only"},p)),t(r.tag,Object(a["a"])(s,{attrs:{role:p?r.role||"status":null,"aria-hidden":p?null:"true"},class:(n={},c(n,"spinner-".concat(r.type),r.type),c(n,"spinner-".concat(r.type,"-sm"),r.small),c(n,"text-".concat(r.variant),r.variant),n)}),[p||t()])}})},"1da1":function(t,e,n){"use strict";n.d(e,"a",(function(){return a}));n("d3b7"),n("e6cf");function r(t,e,n,r,a,s,i){try{var c=t[s](i),u=c.value}catch(o){return void n(o)}c.done?e(u):Promise.resolve(u).then(r,a)}function a(t){return function(){var e=this,n=arguments;return new Promise((function(a,s){var i=t.apply(e,n);function c(t){r(i,a,s,c,u,"next",t)}function u(t){r(i,a,s,c,u,"throw",t)}c(void 0)}))}}},"90f1":function(t,e,n){"use strict";n.d(e,"a",(function(){return s})),n.d(e,"b",(function(){return c}));n("caad"),n("c975"),n("fb6a"),n("d3b7"),n("2532"),n("3ca3"),n("ddb0"),n("2b3d"),n("96cf");var r=n("1da1"),a=!1;function s(t){return i.apply(this,arguments)}function i(){return i=Object(r["a"])(regeneratorRuntime.mark((function t(e){var n,r,a,s,i,c=arguments;return regeneratorRuntime.wrap((function(t){while(1)switch(t.prev=t.next){case 0:if(n=c.length>1&&void 0!==c[1]?c[1]:{},r=["blob","text","json","formData"],a={method:"GET",headers:{"Content-Type":"application/json"},type:"json"},s={ok:!1},i={ok:!1,cont:{}},n=Object.assign({},a,n),!e||!r.includes(n.type)){t.next=10;break}return t.next=9,fetch(e,n);case 9:s=t.sent;case 10:if(!s.ok){t.next=33;break}i.ok=!0,t.t0=n.type,t.next="blob"===t.t0?15:"text"===t.t0?19:"formData"===t.t0?23:27;break;case 15:return t.next=17,s.blob();case 17:return i.cont=t.sent,t.abrupt("break",31);case 19:return t.next=21,s.text();case 21:return i.cont=t.sent,t.abrupt("break",31);case 23:return t.next=25,s.formData();case 25:return i.cont=t.sent,t.abrupt("break",31);case 27:return t.next=29,s.json();case 29:return i.cont=t.sent,t.abrupt("break",31);case 31:t.next=34;break;case 33:i.cont.data=[{result:s.ok,status:s.status,statusText:s.statusText}];case 34:return t.abrupt("return",i);case 35:case"end":return t.stop()}}),t)}))),i.apply(this,arguments)}function c(){var t=window.location.href,e=t.indexOf("#")>0,n=e?new URL(t.slice(0,t.indexOf("#"))):new URL(t);return a&&(n.port=2e4),n}},f427:function(t,e,n){"use strict";n.r(e);var r=function(){var t=this,e=t.$createElement,n=t._self._c||e;return n("div",[n("h4",{staticClass:"text-center mb-3"},[t._v("设备采集数据类型")]),n("div",[t.tblGroups.ready?[n("TheTable",{staticClass:"mt-1",attrs:{"head-bg":"bg-dark text-light",fields:t.tblGroups.fields.name,fieldsProp:t.tblGroups.fields.prop,items:t.tblGroups.items}}),0==t.tblGroups.items.length?n("h4",{staticClass:"text-center mt-5"},[n("span",{staticClass:"alert alert-primary"},[t._v("无数据")])]):t._e()]:n("div",{staticClass:"text-center"},[n("b-spinner",{attrs:{variant:"secondary",label:"loading..."}}),n("p",{staticClass:"text-center"},[t._v("数据传输中...")])],1)],2)])},a=[],s=(n("caad"),n("b64b"),n("d3b7"),n("2532"),n("96cf"),n("1da1")),i=n("01e3"),c=n("90f1"),u=function(){var t=arguments.length>0&&void 0!==arguments[0]?arguments[0]:{},e={th:{tag:"div",class:"text-left",txt:"",children:[]},td:{tag:"div",class:"text-left",txt:"",children:[]}};for(var n in e)"th"!=n&&"td"!=n||(t[n]=Object.keys(t).includes(n)?Object.assign({},e[n],t[n]):e[n]);return Object.assign({},e,t)},o={fields:{name:["sn","type","name","location","status","data"],prop:{info_id:u({th:{txt:"设备编号"}}),sn:u({th:{txt:"设备序列号"}}),type:u({th:{txt:"设备类型"}}),name:u({th:{txt:"设备名称"}}),customer_id:u({th:{txt:"客户编号"}}),location:u({th:{txt:"设备所在地"}}),status:u({th:{txt:"设备现状"}}),create_time:u({th:{txt:"设备注册时间"}}),data:u({th:{txt:"采集数据类型",class:"text-center"},td:{class:"text-center",id:{name:"info_id",val:""},route:{name:"equipment-chart",query:{}},txt:"",children:[{tag:"a",class:"",id:"",href:"javascript()"},{tag:"b-tooltip",txt:"显示详情",class:"",target:""}]}})}},items:[],ready:!1},l={name:"TheModule",data:function(){return{url:Object(c["b"])(),tblGroups:o,req:null}},computed:{routeQuery:function(){return this.$route.query}},watch:{routeQuery:function(){var t=Object.assign({},this.$route.query);return Object.keys(t).length||this.initData(),t}},methods:{fetchTblData:function(){var t=Object(s["a"])(regeneratorRuntime.mark((function t(e){var n,r,a,s,i;return regeneratorRuntime.wrap((function(t){while(1)switch(t.prev=t.next){case 0:return n=["terminal","equipment/group"],r={tblName:"info",fields:[],where:"",page:""},a=Object.assign({},r,this.req,this.routeQuery),s={method:"POST",body:JSON.stringify(a)},i=n.includes(e)?this.url+e:this.url+n[0],t.next=7,Object(c["a"])(i,s);case 7:return t.abrupt("return",t.sent);case 8:case"end":return t.stop()}}),t,this)})));function e(e){return t.apply(this,arguments)}return e}(),initGroups:function(){var t=Object(s["a"])(regeneratorRuntime.mark((function t(){var e,n;return regeneratorRuntime.wrap((function(t){while(1)switch(t.prev=t.next){case 0:return e=this.tblGroups,this.req=null,this.req={tblName:"data_raw",query:{group:"info_id"}},t.next=5,this.fetchTblData("equipment/group");case 5:n=t.sent,n.ok&&(e.items=n.cont.items,e.ready=!0),e.items.length;case 8:case"end":return t.stop()}}),t,this)})));function e(){return t.apply(this,arguments)}return e}()},components:{BSpinner:i["a"],TheTable:function(){return n.e("chunk-2d215c41").then(n.bind(null,"c031"))}},created:function(){this.initGroups()}},d=l,p=n("2877"),b=Object(p["a"])(d,r,a,!1,null,"0a8d9690",null);e["default"]=b.exports}}]);
//# sourceMappingURL=chunk-1631d18c.2c58d755.js.map