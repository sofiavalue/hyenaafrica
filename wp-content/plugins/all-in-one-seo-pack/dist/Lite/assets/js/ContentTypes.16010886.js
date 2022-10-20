import{e as u,a as l,m}from"./index.4776f7d5.js";import{A as _,T as d}from"./TitleDescription.8a1d51e1.js";import{C as h}from"./Card.a455f6aa.js";import{C as f}from"./Tabs.5f143cbd.js";import{C as o,S as v}from"./Schema.e724b202.js";import{n as i}from"./vueComponentNormalizer.58b0a173.js";import"./isArrayLikeObject.5268a676.js";import"./default-i18n.0e73c33c.js";import"./WpTable.8ff25002.js";import"./index.4a5acef5.js";import"./client.d00863cc.js";import"./_commonjsHelpers.10c44588.js";import"./translations.3bc9d58c.js";import"./constants.9efee5f7.js";import"./portal-vue.esm.272b3133.js";import"./attachments.52d4e34c.js";import"./cleanForSlug.788b395f.js";import"./JsonValues.08065e69.js";import"./MaxCounts.5a7ca2fd.js";import"./RadioToggle.18d51233.js";import"./RobotsMeta.43a238ee.js";import"./Checkbox.93944087.js";import"./Checkmark.627d69a4.js";import"./Row.dfea53f7.js";import"./SettingsRow.8a127375.js";import"./GoogleSearchPreview.153cd296.js";import"./HtmlTagsEditor.c1435120.js";import"./Editor.5a52a16a.js";import"./UnfilteredHtml.b3886c4e.js";import"./Tooltip.060399ab.js";import"./Slide.8aaa5049.js";import"./TruSeoScore.98a47fd6.js";import"./Information.d80e4486.js";import"./Textarea.2db5f910.js";import"./Blur.404d53ce.js";import"./Index.7823cadd.js";var b=function(){var t=this,e=t.$createElement,s=t._self._c||e;return s("div",{staticClass:"aioseo-sa-ct-custom-fields-view"},[t.isUnlicensed?t._e():s("custom-fields",{attrs:{type:t.type,object:t.object,options:t.options,"show-bulk":t.showBulk}}),t.isUnlicensed?s("custom-fields-lite",{attrs:{type:t.type,object:t.object,options:t.options,"show-bulk":t.showBulk}}):t._e()],1)},y=[];const g={components:{CustomFields:o,CustomFieldsLite:o},props:{type:{type:String,required:!0},object:{type:Object,required:!0},options:{type:Object,required:!0},showBulk:Boolean},computed:{...u(["isUnlicensed"])}},r={};var $=i(g,b,y,!1,C,null,null,null);function C(t){for(let e in r)this[e]=r[e]}const A=function(){return $.exports}();var S=function(){var t=this,e=t.$createElement,s=t._self._c||e;return s("div",{staticClass:"aioseo-search-appearance-content-types"},t._l(t.postTypes,function(n,c){return s("core-card",{key:c,attrs:{slug:`${n.name}SA`},scopedSlots:t._u([{key:"header",fn:function(){return[s("div",{staticClass:"icon dashicons",class:`${n.icon||"dashicons-admin-post"}`}),s("div",{domProps:{innerHTML:t._s(n.label)}})]},proxy:!0},{key:"tabs",fn:function(){return[s("core-main-tabs",{attrs:{tabs:t.tabs,showSaveButton:!1,active:t.settings.internalTabs[`${n.name}SA`],internal:""},on:{changed:function(p){return t.processChangeTab(n.name,p)}}})]},proxy:!0}],null,!0)},[s("transition",{attrs:{name:"route-fade",mode:"out-in"}},[s(t.settings.internalTabs[`${n.name}SA`],{tag:"component",attrs:{object:n,separator:t.options.searchAppearance.global.separator,options:t.dynamicOptions.searchAppearance.postTypes[n.name],type:"postTypes"}})],1)],1)}),1)},T=[];const x={components:{Advanced:_,CoreCard:h,CoreMainTabs:f,CustomFields:A,Schema:v,TitleDescription:d},data(){return{internalDebounce:null,tabs:[{slug:"title-description",name:this.$t.__("Title & Description",this.$td),access:"aioseo_search_appearance_settings",pro:!1},{slug:"schema",name:this.$t.__("Schema Markup",this.$td),access:"aioseo_search_appearance_settings",pro:!0},{slug:"custom-fields",name:this.$t.__("Custom Fields",this.$td),access:"aioseo_search_appearance_settings",pro:!0},{slug:"advanced",name:this.$t.__("Advanced",this.$td),access:"aioseo_search_appearance_settings",pro:!1}]}},computed:{...l(["options","dynamicOptions","settings"]),postTypes(){return this.$aioseo.postData.postTypes.filter(t=>t.name!=="attachment")}},methods:{...m(["changeTab"]),processChangeTab(t,e){this.internalDebounce||(this.internalDebounce=!0,this.changeTab({slug:`${t}SA`,value:e}),setTimeout(()=>{this.internalDebounce=!1},50))}}},a={};var j=i(x,S,T,!1,k,null,null,null);function k(t){for(let e in a)this[e]=a[e]}const lt=function(){return j.exports}();export{lt as default};