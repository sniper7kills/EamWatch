"use strict";(self.webpackChunk=self.webpackChunk||[]).push([[496],{9082:(t,s,e)=>{e.r(s),e.d(s,{default:()=>n});const i={name:"comment-add",props:["message_id","recording_id"],data:function(){return{submitted:!1,submitting:!1,message:null}},methods:{submitComment:function(){var t=this;this.submitting=!0,axios.post("/api/comments",{message:this.message,message_id:this.message_id,recording_id:this.recording_id}).then((function(s){t.submitting=!1,t.submitted=!0}))}}};const n=(0,e(1900).Z)(i,(function(){var t=this,s=t._self._c;return this.submitted?t._e():s("form",{staticClass:"form-horizontal"},[s("div",{staticClass:"input-group input-group-sm mb-0"},[s("textarea",{directives:[{name:"model",rawName:"v-model",value:t.message,expression:"message"}],staticClass:"form-control form-control-sm",attrs:{disabled:!0===t.submitting,placeholder:"New Comment"},domProps:{value:t.message},on:{input:function(s){s.target.composing||(t.message=s.target.value)}}}),t._v(" "),s("div",{staticClass:"input-group-append"},[s("button",{staticClass:"btn btn-primary",attrs:{disabled:!0===t.submitting,type:"submit"},on:{click:t.submitComment}},[t._v("Add Comment")])])])])}),[],!1,null,"7066e71a",null).exports}}]);