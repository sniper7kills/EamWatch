"use strict";
(self["webpackChunk"] = self["webpackChunk"] || []).push([["js/chunks/supporter-messages"],{

/***/ "./node_modules/babel-loader/lib/index.js??clonedRuleSet-5.use[0]!./node_modules/vue-loader/lib/index.js??vue-loader-options!./resources/js/components/supporter-messages.vue?vue&type=script&lang=js&":
/*!*************************************************************************************************************************************************************************************************************!*\
  !*** ./node_modules/babel-loader/lib/index.js??clonedRuleSet-5.use[0]!./node_modules/vue-loader/lib/index.js??vue-loader-options!./resources/js/components/supporter-messages.vue?vue&type=script&lang=js& ***!
  \*************************************************************************************************************************************************************************************************************/
/***/ ((__unused_webpack_module, __webpack_exports__, __webpack_require__) => {

__webpack_require__.r(__webpack_exports__);
/* harmony export */ __webpack_require__.d(__webpack_exports__, {
/* harmony export */   "default": () => (__WEBPACK_DEFAULT_EXPORT__)
/* harmony export */ });
/* harmony default export */ const __WEBPACK_DEFAULT_EXPORT__ = ({
  name: "supporter-messages",
  data: function data() {
    return {
      messages: [],
      loading: true,
      pagination: {
        total: 0,
        per_page: 15,
        // required
        current_page: 1,
        // required
        last_page: 0,
        // required
        from: 1,
        to: 15
      },
      paginationOptions: {
        offset: 4,
        previousText: 'Prev',
        nextText: 'Next',
        alwaysShowPrevNext: true
      }
    };
  },
  computed: {
    perPage: function perPage() {
      return this.pagination.per_page;
    }
  },
  watch: {
    perPage: function perPage(oldPerPage, newPerPage) {
      this.pagination.current_page = 1;
      //this.loadMessages();
    }
  },

  methods: {
    loadMessages: function loadMessages() {
      var _this = this;
      var options = {
        params: {
          paginate: this.pagination.per_page,
          page: this.pagination.current_page
        }
      };
      this.loading = true;
      axios.get('/api/supporter-messages', options).then(function (response) {
        _this.messages = response.data.data;
        _this.pagination = response.data.meta;
        _this.loading = false;
      });
    }
  },
  mounted: function mounted() {
    this.loadMessages();
  }
});

/***/ }),

/***/ "./node_modules/babel-loader/lib/index.js??clonedRuleSet-5.use[0]!./node_modules/vue-loader/lib/loaders/templateLoader.js??ruleSet[1].rules[2]!./node_modules/vue-loader/lib/index.js??vue-loader-options!./resources/js/components/supporter-messages.vue?vue&type=template&id=3034cb70&":
/*!************************************************************************************************************************************************************************************************************************************************************************************************!*\
  !*** ./node_modules/babel-loader/lib/index.js??clonedRuleSet-5.use[0]!./node_modules/vue-loader/lib/loaders/templateLoader.js??ruleSet[1].rules[2]!./node_modules/vue-loader/lib/index.js??vue-loader-options!./resources/js/components/supporter-messages.vue?vue&type=template&id=3034cb70& ***!
  \************************************************************************************************************************************************************************************************************************************************************************************************/
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
    staticClass: "col-12"
  }, [_c("div", {
    staticClass: "card"
  }, [_c("div", {
    staticClass: "card-header"
  }, [_c("h3", {
    staticClass: "card-title"
  }, [_vm._v("Supports & Messages")]), _vm._v(" "), _c("div", {
    staticClass: "card-tools"
  }, [_c("a", {
    staticClass: "float-right pl-2",
    attrs: {
      href: ""
    },
    on: {
      click: _vm.loadMessages
    }
  }, [_c("i", {
    staticClass: "fa fa-sync"
  })]), _vm._v(" "), _c("div", {
    staticClass: "input-group input-group-sm",
    staticStyle: {
      width: "150px"
    }
  }, [_vm._m(0), _vm._v(" "), _c("select", {
    directives: [{
      name: "model",
      rawName: "v-model",
      value: _vm.pagination.per_page,
      expression: "pagination.per_page"
    }],
    staticClass: "form-control float-right",
    attrs: {
      disabled: _vm.loading === true
    },
    on: {
      change: function change($event) {
        var $$selectedVal = Array.prototype.filter.call($event.target.options, function (o) {
          return o.selected;
        }).map(function (o) {
          var val = "_value" in o ? o._value : o.value;
          return val;
        });
        _vm.$set(_vm.pagination, "per_page", $event.target.multiple ? $$selectedVal : $$selectedVal[0]);
      }
    }
  }, [_c("option", {
    attrs: {
      value: "5"
    }
  }, [_vm._v("5")]), _vm._v(" "), _c("option", {
    attrs: {
      value: "10"
    }
  }, [_vm._v("10")]), _vm._v(" "), _c("option", {
    attrs: {
      value: "15"
    }
  }, [_vm._v("15")]), _vm._v(" "), _c("option", {
    attrs: {
      value: "20"
    }
  }, [_vm._v("20")]), _vm._v(" "), _c("option", {
    attrs: {
      value: "25"
    }
  }, [_vm._v("25")]), _vm._v(" "), _c("option", {
    attrs: {
      value: "50"
    }
  }, [_vm._v("50")]), _vm._v(" "), _c("option", {
    attrs: {
      value: "75"
    }
  }, [_vm._v("75")]), _vm._v(" "), _c("option", {
    attrs: {
      value: "100"
    }
  }, [_vm._v("100")])])])])]), _vm._v(" "), _c("div", {
    staticClass: "card-body table-responsive p-0"
  }, [_c("table", {
    staticClass: "table table-hover"
  }, [_vm._m(1), _vm._v(" "), _vm.loading === true ? _c("tbody", [_c("tr", [_c("td", {
    attrs: {
      colspan: "6"
    }
  }, [_c("vue-loading", {
    attrs: {
      type: "bubbles",
      color: "#d9544e",
      size: {
        width: "50px",
        height: "50px"
      }
    }
  })], 1)])]) : _vm._e(), _vm._v(" "), _vm.loading === false ? _c("tbody", _vm._l(_vm.messages, function (message) {
    return _c("tr", {
      key: message.id
    }, [_c("td", [_vm._v(_vm._s(message.name))]), _vm._v(" "), _c("td", [_vm._v(_vm._s(message.message))])]);
  }), 0) : _vm._e()])]), _vm._v(" "), _c("div", {
    staticClass: "card-footer clearfix"
  }, [_c("pagination", {
    attrs: {
      pagination: _vm.pagination,
      callback: _vm.loadMessages,
      options: _vm.paginationOptions
    }
  })], 1)])])]);
};
var staticRenderFns = [function () {
  var _vm = this,
    _c = _vm._self._c;
  return _c("div", {
    staticClass: "input-group-prepend"
  }, [_c("span", {
    staticClass: "input-group-text"
  }, [_vm._v("Per Page")])]);
}, function () {
  var _vm = this,
    _c = _vm._self._c;
  return _c("thead", [_c("tr", [_c("th", [_vm._v("Name")]), _vm._v(" "), _c("th", [_vm._v("Message")])])]);
}];
render._withStripped = true;


/***/ }),

/***/ "./resources/js/components/supporter-messages.vue":
/*!********************************************************!*\
  !*** ./resources/js/components/supporter-messages.vue ***!
  \********************************************************/
/***/ ((__unused_webpack_module, __webpack_exports__, __webpack_require__) => {

__webpack_require__.r(__webpack_exports__);
/* harmony export */ __webpack_require__.d(__webpack_exports__, {
/* harmony export */   "default": () => (__WEBPACK_DEFAULT_EXPORT__)
/* harmony export */ });
/* harmony import */ var _supporter_messages_vue_vue_type_template_id_3034cb70___WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! ./supporter-messages.vue?vue&type=template&id=3034cb70& */ "./resources/js/components/supporter-messages.vue?vue&type=template&id=3034cb70&");
/* harmony import */ var _supporter_messages_vue_vue_type_script_lang_js___WEBPACK_IMPORTED_MODULE_1__ = __webpack_require__(/*! ./supporter-messages.vue?vue&type=script&lang=js& */ "./resources/js/components/supporter-messages.vue?vue&type=script&lang=js&");
/* harmony import */ var _node_modules_vue_loader_lib_runtime_componentNormalizer_js__WEBPACK_IMPORTED_MODULE_2__ = __webpack_require__(/*! !../../../node_modules/vue-loader/lib/runtime/componentNormalizer.js */ "./node_modules/vue-loader/lib/runtime/componentNormalizer.js");





/* normalize component */
;
var component = (0,_node_modules_vue_loader_lib_runtime_componentNormalizer_js__WEBPACK_IMPORTED_MODULE_2__["default"])(
  _supporter_messages_vue_vue_type_script_lang_js___WEBPACK_IMPORTED_MODULE_1__["default"],
  _supporter_messages_vue_vue_type_template_id_3034cb70___WEBPACK_IMPORTED_MODULE_0__.render,
  _supporter_messages_vue_vue_type_template_id_3034cb70___WEBPACK_IMPORTED_MODULE_0__.staticRenderFns,
  false,
  null,
  null,
  null
  
)

/* hot reload */
if (false) { var api; }
component.options.__file = "resources/js/components/supporter-messages.vue"
/* harmony default export */ const __WEBPACK_DEFAULT_EXPORT__ = (component.exports);

/***/ }),

/***/ "./resources/js/components/supporter-messages.vue?vue&type=script&lang=js&":
/*!*********************************************************************************!*\
  !*** ./resources/js/components/supporter-messages.vue?vue&type=script&lang=js& ***!
  \*********************************************************************************/
/***/ ((__unused_webpack_module, __webpack_exports__, __webpack_require__) => {

__webpack_require__.r(__webpack_exports__);
/* harmony export */ __webpack_require__.d(__webpack_exports__, {
/* harmony export */   "default": () => (__WEBPACK_DEFAULT_EXPORT__)
/* harmony export */ });
/* harmony import */ var _node_modules_babel_loader_lib_index_js_clonedRuleSet_5_use_0_node_modules_vue_loader_lib_index_js_vue_loader_options_supporter_messages_vue_vue_type_script_lang_js___WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! -!../../../node_modules/babel-loader/lib/index.js??clonedRuleSet-5.use[0]!../../../node_modules/vue-loader/lib/index.js??vue-loader-options!./supporter-messages.vue?vue&type=script&lang=js& */ "./node_modules/babel-loader/lib/index.js??clonedRuleSet-5.use[0]!./node_modules/vue-loader/lib/index.js??vue-loader-options!./resources/js/components/supporter-messages.vue?vue&type=script&lang=js&");
 /* harmony default export */ const __WEBPACK_DEFAULT_EXPORT__ = (_node_modules_babel_loader_lib_index_js_clonedRuleSet_5_use_0_node_modules_vue_loader_lib_index_js_vue_loader_options_supporter_messages_vue_vue_type_script_lang_js___WEBPACK_IMPORTED_MODULE_0__["default"]); 

/***/ }),

/***/ "./resources/js/components/supporter-messages.vue?vue&type=template&id=3034cb70&":
/*!***************************************************************************************!*\
  !*** ./resources/js/components/supporter-messages.vue?vue&type=template&id=3034cb70& ***!
  \***************************************************************************************/
/***/ ((__unused_webpack_module, __webpack_exports__, __webpack_require__) => {

__webpack_require__.r(__webpack_exports__);
/* harmony export */ __webpack_require__.d(__webpack_exports__, {
/* harmony export */   "render": () => (/* reexport safe */ _node_modules_babel_loader_lib_index_js_clonedRuleSet_5_use_0_node_modules_vue_loader_lib_loaders_templateLoader_js_ruleSet_1_rules_2_node_modules_vue_loader_lib_index_js_vue_loader_options_supporter_messages_vue_vue_type_template_id_3034cb70___WEBPACK_IMPORTED_MODULE_0__.render),
/* harmony export */   "staticRenderFns": () => (/* reexport safe */ _node_modules_babel_loader_lib_index_js_clonedRuleSet_5_use_0_node_modules_vue_loader_lib_loaders_templateLoader_js_ruleSet_1_rules_2_node_modules_vue_loader_lib_index_js_vue_loader_options_supporter_messages_vue_vue_type_template_id_3034cb70___WEBPACK_IMPORTED_MODULE_0__.staticRenderFns)
/* harmony export */ });
/* harmony import */ var _node_modules_babel_loader_lib_index_js_clonedRuleSet_5_use_0_node_modules_vue_loader_lib_loaders_templateLoader_js_ruleSet_1_rules_2_node_modules_vue_loader_lib_index_js_vue_loader_options_supporter_messages_vue_vue_type_template_id_3034cb70___WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! -!../../../node_modules/babel-loader/lib/index.js??clonedRuleSet-5.use[0]!../../../node_modules/vue-loader/lib/loaders/templateLoader.js??ruleSet[1].rules[2]!../../../node_modules/vue-loader/lib/index.js??vue-loader-options!./supporter-messages.vue?vue&type=template&id=3034cb70& */ "./node_modules/babel-loader/lib/index.js??clonedRuleSet-5.use[0]!./node_modules/vue-loader/lib/loaders/templateLoader.js??ruleSet[1].rules[2]!./node_modules/vue-loader/lib/index.js??vue-loader-options!./resources/js/components/supporter-messages.vue?vue&type=template&id=3034cb70&");


/***/ })

}]);