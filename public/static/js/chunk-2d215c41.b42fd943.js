(window["webpackJsonp"]=window["webpackJsonp"]||[]).push([["chunk-2d215c41"],{c031:function(t,e,s){"use strict";s.r(e);var r=function(){var t=this,e=t.$createElement,s=t._self._c||e;return s("div",{staticClass:"table-responsive"},[s("table",{class:"table table-hover "+t.tbClass},[s("thead",{class:t.headBg},[s("tr",t._l(t.fields,(function(e,r){return s("th",{key:r},[t.fieldsProp.hasOwnProperty(e)?[s("div",{class:t.fieldsProp[e]["thClass"]},[t._v(t._s(t.fieldsProp[e]["txt"]))])]:[t._v(t._s(e))]],2)})),0)]),s("tbody",t._l(t.items,(function(e,r){return s("tr",{key:r},t._l(t.fields,(function(r,a){return s("td",{key:a},[t.fieldsProp.hasOwnProperty(r)?[s("div",{class:t.fieldsProp[r]["tdClass"]},[s("span",{class:t.fieldsProp[r]["status"]?t.setStatusCls(e[r]):""},[t._v(t._s(e[r]))])])]:[t._v(t._s(e[r]))]],2)})),0)})),0)])])},a=[],l={name:"TheTable",props:{tbClass:{type:String},headBg:{type:String,default:"thead-light"},fields:{type:Array,required:!0},fieldsProp:{type:Object,default:function(){return{}}},items:{type:Array,required:!0}},data:function(){return{}},computed:{},methods:{setStatusCls:function(t){for(var e=[{txt:"正常",value:"px-2 py-1 alert-success"},{txt:"异常",value:"px-2 py-1 alert-danger"},{txt:"离线",value:"px-2 py-1 alert-warning"}],s="",r=0;r<e.length;r++)if(t===e[r].txt){s=e[r].value;break}return s}}},n=l,i=s("2877"),u=Object(i["a"])(n,r,a,!1,null,null,null);e["default"]=u.exports}}]);
//# sourceMappingURL=chunk-2d215c41.b42fd943.js.map