"use strict";
(self["webpackChunk"] = self["webpackChunk"] || []).push([["js/chunks/messages/view"],{

/***/ "./node_modules/babel-loader/lib/index.js??clonedRuleSet-5.use[0]!./node_modules/vue-loader/lib/index.js??vue-loader-options!./resources/js/components/messages/view.vue?vue&type=script&lang=js&":
/*!********************************************************************************************************************************************************************************************************!*\
  !*** ./node_modules/babel-loader/lib/index.js??clonedRuleSet-5.use[0]!./node_modules/vue-loader/lib/index.js??vue-loader-options!./resources/js/components/messages/view.vue?vue&type=script&lang=js& ***!
  \********************************************************************************************************************************************************************************************************/
/***/ ((__unused_webpack_module, __webpack_exports__, __webpack_require__) => {

__webpack_require__.r(__webpack_exports__);
/* harmony export */ __webpack_require__.d(__webpack_exports__, {
/* harmony export */   "default": () => (__WEBPACK_DEFAULT_EXPORT__)
/* harmony export */ });
/* harmony default export */ const __WEBPACK_DEFAULT_EXPORT__ = ({
  name: "message-view",
  data: function data() {
    return {
      message_id: null,
      loading: true,
      message: null
    };
  },
  methods: {
    loadMessage: function loadMessage() {
      var _this = this;
      axios.get('/api/messages/' + this.message_id).then(function (response) {
        _this.message = response.data.data;
        _this.loading = false;
      });
    },
    formatMessage: function formatMessage(message, type) {
      if (type === "ALLSTATIONS") {
        var messageLength = message.length;
        var chunks = message.match(/.{1,30}/g);
        var formatted = chunks.join('\r\n');
        if (messageLength !== 30) {
          return "[" + messageLength + " CHAR]" + '\r\n' + formatted;
        }
        return formatted;
      }
      return message;
    }
  },
  mounted: function mounted() {
    this.message_id = this.$route.params.message_id;
    this.loadMessage();
  }
});

/***/ }),

/***/ "./node_modules/babel-loader/lib/index.js??clonedRuleSet-5.use[0]!./node_modules/vue-loader/lib/loaders/templateLoader.js??ruleSet[1].rules[2]!./node_modules/vue-loader/lib/index.js??vue-loader-options!./resources/js/components/messages/view.vue?vue&type=template&id=b7b15d66&scoped=true&":
/*!*******************************************************************************************************************************************************************************************************************************************************************************************************!*\
  !*** ./node_modules/babel-loader/lib/index.js??clonedRuleSet-5.use[0]!./node_modules/vue-loader/lib/loaders/templateLoader.js??ruleSet[1].rules[2]!./node_modules/vue-loader/lib/index.js??vue-loader-options!./resources/js/components/messages/view.vue?vue&type=template&id=b7b15d66&scoped=true& ***!
  \*******************************************************************************************************************************************************************************************************************************************************************************************************/
/***/ ((__unused_webpack_module, __webpack_exports__, __webpack_require__) => {

__webpack_require__.r(__webpack_exports__);
/* harmony export */ __webpack_require__.d(__webpack_exports__, {
/* harmony export */   "render": () => (/* binding */ render),
/* harmony export */   "staticRenderFns": () => (/* binding */ staticRenderFns)
/* harmony export */ });
var render = function render() {
  var _vm = this,
    _c = _vm._self._c;
  return _c("div", {
    staticClass: "row"
  }, [_c("div", {
    staticClass: "col-12 col-md-12 col-lg-8"
  }, [this.loading ? _c("div", {
    staticClass: "card"
  }, [_c("div", {
    staticClass: "card-body"
  }, [_c("vue-loading", {
    attrs: {
      type: "bubbles",
      color: "#d9544e",
      size: {
        width: "50px",
        height: "50px"
      }
    }
  })], 1)]) : _vm._e(), _vm._v(" "), !this.loading ? _c("div", {
    staticClass: "card"
  }, [_c("div", {
    staticClass: "card-header"
  }, [_c("h3", {
    staticClass: "card-title"
  }, [_vm._v("Message " + _vm._s(this.message.id))]), _vm._v(" "), _c("div", {
    staticClass: "card-tools"
  }, [_vm.message.permissions.update ? _c("router-link", {
    attrs: {
      tag: "a",
      to: {
        name: "message-edit",
        params: {
          message_id: _vm.message.id
        }
      }
    }
  }, [_c("i", {
    staticClass: "fa fa-edit"
  })]) : _vm._e(), _vm._v(" "), _vm.message.permissions["delete"] ? _c("router-link", {
    attrs: {
      tag: "a",
      to: {
        name: "message-delete",
        params: {
          message_id: _vm.message.id
        }
      }
    }
  }, [_c("i", {
    staticClass: "fa fa-trash"
  })]) : _vm._e()], 1)]), _vm._v(" "), _c("div", {
    staticClass: "card-body"
  }, [_c("table", {
    staticClass: "table table-bordered"
  }, [_c("tbody", [_c("tr", [_c("td", [_vm._v("Broadcast Time")]), _vm._v(" "), _c("td", [_vm._v(_vm._s(this.message.time))])]), _vm._v(" "), _c("tr", [_c("td", [_vm._v("Message Type")]), _vm._v(" "), _c("td", [_vm._v(_vm._s(this.message.type))])]), _vm._v(" "), _c("tr", [_c("td", [_vm._v("Sender")]), _vm._v(" "), _c("td", [_vm._v(_vm._s(this.message.sender))])]), _vm._v(" "), _c("tr", [_c("td", [_vm._v("Receiver")]), _vm._v(" "), _c("td", [_vm._v(_vm._s(this.message.receiver))])])])]), _vm._v(" "), _c("div", {
    staticClass: "row"
  }, [_c("div", {
    staticClass: "col-12"
  }, [_c("div", {
    staticClass: "info-box bg-light"
  }, [_c("div", {
    staticClass: "info-box-content"
  }, [_c("span", {
    staticClass: "info-box-number text-center text-muted mb-0"
  }, [_c("pre", {
    staticStyle: {
      "overflow-x": "auto",
      "white-space": "-o-pre-wrap",
      "word-wrap": "break-word"
    },
    domProps: {
      innerHTML: _vm._s(_vm.formatMessage(_vm.message.message, _vm.message.type))
    }
  })])])])])])]), _vm._v(" "), _c("div", {
    staticClass: "card-footer clearfix"
  }, [_c("div", {
    staticClass: "text-sm float-right"
  }, [_c("b", [_vm._v("Submitted By:")]), _vm._v(" "), this.message.user.type === "user" ? _c("router-link", {
    attrs: {
      tag: "a",
      to: {
        name: "user-view",
        params: {
          user_id: this.message.user.id
        }
      }
    }
  }, [_vm._v("\n                        " + _vm._s(this.message.user.name) + "\n                    ")]) : _vm._e(), _vm._v(" "), this.message.user.type === "guest" ? _c("router-link", {
    attrs: {
      tag: "a",
      to: {
        name: "guest-view",
        params: {
          guest_id: this.message.user.id
        }
      }
    }
  }, [_vm._v("\n                        " + _vm._s(this.message.user.name) + "\n                    ")]) : _vm._e()], 1)])]) : _vm._e()]), _vm._v(" "), _c("div", {
    staticClass: "col-12 col-md-12 col-lg-4"
  }, [_c("div", {
    staticClass: "row"
  }, [_c("div", {
    staticClass: "col-12"
  }, [_c("div", {
    staticClass: "card"
  }, [_c("div", {
    staticClass: "card-header"
  }, [_vm._v("\n                        Message Recordings\n                    ")]), _vm._v(" "), _c("div", {
    staticClass: "card-body"
  }, [this.loading ? _c("vue-loading", {
    attrs: {
      type: "bubbles",
      color: "#d9544e",
      size: {
        width: "50px",
        height: "50px"
      }
    }
  }) : _vm._e(), _vm._v(" "), !this.loading ? _c("div", [_c("recording-list-stub", {
    attrs: {
      recordings: _vm.message.recordings
    }
  })], 1) : _vm._e()], 1), _vm._v(" "), _c("div", {
    staticClass: "card-footer clearfix"
  })])]), _vm._v(" "), _c("div", {
    staticClass: "col-12"
  }, [!this.loading ? _c("recording-add-stub", {
    attrs: {
      message_id: _vm.message.id
    }
  }) : _vm._e()], 1)])]), _vm._v(" "), _c("div", {
    staticClass: "col-12 col-md-12 col-lg-12"
  }, [this.loading ? _c("div", {
    staticClass: "card"
  }, [_vm._m(0), _vm._v(" "), _c("div", {
    staticClass: "card-body"
  }, [_c("vue-loading", {
    attrs: {
      type: "bubbles",
      color: "#d9544e",
      size: {
        width: "50px",
        height: "50px"
      }
    }
  })], 1)]) : _vm._e(), _vm._v(" "), !this.loading ? _c("comment-listing", {
    attrs: {
      message_id: _vm.message.id
    }
  }) : _vm._e()], 1)]);
};
var staticRenderFns = [function () {
  var _vm = this,
    _c = _vm._self._c;
  return _c("div", {
    staticClass: "card-header"
  }, [_c("p", {
    staticClass: "card-title"
  }, [_vm._v("Comments")])]);
}];
render._withStripped = true;


/***/ }),

/***/ "./resources/js/components/messages/view.vue":
/*!***************************************************!*\
  !*** ./resources/js/components/messages/view.vue ***!
  \***************************************************/
/***/ ((__unused_webpack_module, __webpack_exports__, __webpack_require__) => {

__webpack_require__.r(__webpack_exports__);
/* harmony export */ __webpack_require__.d(__webpack_exports__, {
/* harmony export */   "default": () => (__WEBPACK_DEFAULT_EXPORT__)
/* harmony export */ });
/* harmony import */ var _view_vue_vue_type_template_id_b7b15d66_scoped_true___WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! ./view.vue?vue&type=template&id=b7b15d66&scoped=true& */ "./resources/js/components/messages/view.vue?vue&type=template&id=b7b15d66&scoped=true&");
/* harmony import */ var _view_vue_vue_type_script_lang_js___WEBPACK_IMPORTED_MODULE_1__ = __webpack_require__(/*! ./view.vue?vue&type=script&lang=js& */ "./resources/js/components/messages/view.vue?vue&type=script&lang=js&");
/* harmony import */ var _node_modules_vue_loader_lib_runtime_componentNormalizer_js__WEBPACK_IMPORTED_MODULE_2__ = __webpack_require__(/*! !../../../../node_modules/vue-loader/lib/runtime/componentNormalizer.js */ "./node_modules/vue-loader/lib/runtime/componentNormalizer.js");





/* normalize component */
;
var component = (0,_node_modules_vue_loader_lib_runtime_componentNormalizer_js__WEBPACK_IMPORTED_MODULE_2__["default"])(
  _view_vue_vue_type_script_lang_js___WEBPACK_IMPORTED_MODULE_1__["default"],
  _view_vue_vue_type_template_id_b7b15d66_scoped_true___WEBPACK_IMPORTED_MODULE_0__.render,
  _view_vue_vue_type_template_id_b7b15d66_scoped_true___WEBPACK_IMPORTED_MODULE_0__.staticRenderFns,
  false,
  null,
  "b7b15d66",
  null
  
)

/* hot reload */
if (false) { var api; }
component.options.__file = "resources/js/components/messages/view.vue"
/* harmony default export */ const __WEBPACK_DEFAULT_EXPORT__ = (component.exports);

/***/ }),

/***/ "./resources/js/components/messages/view.vue?vue&type=script&lang=js&":
/*!****************************************************************************!*\
  !*** ./resources/js/components/messages/view.vue?vue&type=script&lang=js& ***!
  \****************************************************************************/
/***/ ((__unused_webpack_module, __webpack_exports__, __webpack_require__) => {

__webpack_require__.r(__webpack_exports__);
/* harmony export */ __webpack_require__.d(__webpack_exports__, {
/* harmony export */   "default": () => (__WEBPACK_DEFAULT_EXPORT__)
/* harmony export */ });
/* harmony import */ var _node_modules_babel_loader_lib_index_js_clonedRuleSet_5_use_0_node_modules_vue_loader_lib_index_js_vue_loader_options_view_vue_vue_type_script_lang_js___WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! -!../../../../node_modules/babel-loader/lib/index.js??clonedRuleSet-5.use[0]!../../../../node_modules/vue-loader/lib/index.js??vue-loader-options!./view.vue?vue&type=script&lang=js& */ "./node_modules/babel-loader/lib/index.js??clonedRuleSet-5.use[0]!./node_modules/vue-loader/lib/index.js??vue-loader-options!./resources/js/components/messages/view.vue?vue&type=script&lang=js&");
 /* harmony default export */ const __WEBPACK_DEFAULT_EXPORT__ = (_node_modules_babel_loader_lib_index_js_clonedRuleSet_5_use_0_node_modules_vue_loader_lib_index_js_vue_loader_options_view_vue_vue_type_script_lang_js___WEBPACK_IMPORTED_MODULE_0__["default"]); 

/***/ }),

/***/ "./resources/js/components/messages/view.vue?vue&type=template&id=b7b15d66&scoped=true&":
/*!**********************************************************************************************!*\
  !*** ./resources/js/components/messages/view.vue?vue&type=template&id=b7b15d66&scoped=true& ***!
  \**********************************************************************************************/
/***/ ((__unused_webpack_module, __webpack_exports__, __webpack_require__) => {

__webpack_require__.r(__webpack_exports__);
/* harmony export */ __webpack_require__.d(__webpack_exports__, {
/* harmony export */   "render": () => (/* reexport safe */ _node_modules_babel_loader_lib_index_js_clonedRuleSet_5_use_0_node_modules_vue_loader_lib_loaders_templateLoader_js_ruleSet_1_rules_2_node_modules_vue_loader_lib_index_js_vue_loader_options_view_vue_vue_type_template_id_b7b15d66_scoped_true___WEBPACK_IMPORTED_MODULE_0__.render),
/* harmony export */   "staticRenderFns": () => (/* reexport safe */ _node_modules_babel_loader_lib_index_js_clonedRuleSet_5_use_0_node_modules_vue_loader_lib_loaders_templateLoader_js_ruleSet_1_rules_2_node_modules_vue_loader_lib_index_js_vue_loader_options_view_vue_vue_type_template_id_b7b15d66_scoped_true___WEBPACK_IMPORTED_MODULE_0__.staticRenderFns)
/* harmony export */ });
/* harmony import */ var _node_modules_babel_loader_lib_index_js_clonedRuleSet_5_use_0_node_modules_vue_loader_lib_loaders_templateLoader_js_ruleSet_1_rules_2_node_modules_vue_loader_lib_index_js_vue_loader_options_view_vue_vue_type_template_id_b7b15d66_scoped_true___WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! -!../../../../node_modules/babel-loader/lib/index.js??clonedRuleSet-5.use[0]!../../../../node_modules/vue-loader/lib/loaders/templateLoader.js??ruleSet[1].rules[2]!../../../../node_modules/vue-loader/lib/index.js??vue-loader-options!./view.vue?vue&type=template&id=b7b15d66&scoped=true& */ "./node_modules/babel-loader/lib/index.js??clonedRuleSet-5.use[0]!./node_modules/vue-loader/lib/loaders/templateLoader.js??ruleSet[1].rules[2]!./node_modules/vue-loader/lib/index.js??vue-loader-options!./resources/js/components/messages/view.vue?vue&type=template&id=b7b15d66&scoped=true&");


/***/ })

}]);