"use strict";
(self["webpackChunk"] = self["webpackChunk"] || []).push([["js/chunks/partials/pagination"],{

/***/ "./node_modules/babel-loader/lib/index.js??clonedRuleSet-5.use[0]!./node_modules/vue-loader/lib/index.js??vue-loader-options!./resources/js/components/pagination.vue?vue&type=script&lang=js&":
/*!*****************************************************************************************************************************************************************************************************!*\
  !*** ./node_modules/babel-loader/lib/index.js??clonedRuleSet-5.use[0]!./node_modules/vue-loader/lib/index.js??vue-loader-options!./resources/js/components/pagination.vue?vue&type=script&lang=js& ***!
  \*****************************************************************************************************************************************************************************************************/
/***/ ((__unused_webpack_module, __webpack_exports__, __webpack_require__) => {

__webpack_require__.r(__webpack_exports__);
/* harmony export */ __webpack_require__.d(__webpack_exports__, {
/* harmony export */   "default": () => (__WEBPACK_DEFAULT_EXPORT__)
/* harmony export */ });
/* harmony default export */ const __WEBPACK_DEFAULT_EXPORT__ = ({
  props: {
    pagination: {
      type: Object,
      required: true
    },
    callback: {
      type: Function,
      required: true
    },
    options: {
      type: Object
    },
    size: {
      type: String
    }
  },
  computed: {
    array: function array() {
      if (this.pagination.last_page <= 0) {
        return [];
      }
      var from = this.pagination.current_page - this.config.offset;
      if (from < 1) {
        from = 1;
      }
      var to = from + this.config.offset * 2;
      if (to >= this.pagination.last_page) {
        to = this.pagination.last_page;
      }
      var arr = [];
      while (from <= to) {
        arr.push(from);
        from += 1;
      }
      return arr;
    },
    config: function config() {
      return Object.assign({
        offset: 3,
        ariaPrevious: 'Previous',
        ariaNext: 'Next',
        previousText: '«',
        nextText: '»',
        alwaysShowPrevNext: false
      }, this.options);
    },
    sizeClass: function sizeClass() {
      if (this.size === 'large') {
        return 'pagination-lg';
      } else if (this.size === 'small') {
        return 'pagination-sm';
      }
      return '';
    }
  },
  watch: {
    'pagination.per_page': function paginationPer_page(newVal, oldVal) {
      // eslint-disable-line
      if (+newVal !== +oldVal) {
        this.callback();
      }
    }
  },
  methods: {
    showPrevious: function showPrevious() {
      return this.config.alwaysShowPrevNext || this.pagination.current_page > 1;
    },
    showNext: function showNext() {
      return this.config.alwaysShowPrevNext || this.pagination.current_page < this.pagination.last_page;
    },
    changePage: function changePage(page) {
      if (this.pagination.current_page === page) {
        return;
      }
      this.$set(this.pagination, 'current_page', page);
      this.callback();
    }
  }
});

/***/ }),

/***/ "./node_modules/babel-loader/lib/index.js??clonedRuleSet-5.use[0]!./node_modules/vue-loader/lib/loaders/templateLoader.js??ruleSet[1].rules[2]!./node_modules/vue-loader/lib/index.js??vue-loader-options!./resources/js/components/pagination.vue?vue&type=template&id=603a89b6&":
/*!****************************************************************************************************************************************************************************************************************************************************************************************!*\
  !*** ./node_modules/babel-loader/lib/index.js??clonedRuleSet-5.use[0]!./node_modules/vue-loader/lib/loaders/templateLoader.js??ruleSet[1].rules[2]!./node_modules/vue-loader/lib/index.js??vue-loader-options!./resources/js/components/pagination.vue?vue&type=template&id=603a89b6& ***!
  \****************************************************************************************************************************************************************************************************************************************************************************************/
/***/ ((__unused_webpack_module, __webpack_exports__, __webpack_require__) => {

__webpack_require__.r(__webpack_exports__);
/* harmony export */ __webpack_require__.d(__webpack_exports__, {
/* harmony export */   "render": () => (/* binding */ render),
/* harmony export */   "staticRenderFns": () => (/* binding */ staticRenderFns)
/* harmony export */ });
var render = function render() {
  var _vm = this,
    _c = _vm._self._c;
  return _c("nav", [_vm.pagination.last_page > 0 ? _c("ul", {
    staticClass: "pagination pagination-sm m-0 float-right",
    "class": _vm.sizeClass
  }, [_vm.showPrevious() ? _c("li", {
    staticClass: "page-item",
    "class": {
      disabled: _vm.pagination.current_page <= 1
    }
  }, [_vm.pagination.current_page <= 1 ? _c("span", {
    staticClass: "page-link"
  }, [_c("span", {
    attrs: {
      "aria-hidden": "true"
    }
  }, [_vm._v(_vm._s(_vm.config.previousText))])]) : _vm._e(), _vm._v(" "), _vm.pagination.current_page > 1 ? _c("a", {
    staticClass: "page-link",
    attrs: {
      href: "#",
      "aria-label": _vm.config.ariaPrevioius
    },
    on: {
      click: function click($event) {
        $event.preventDefault();
        return _vm.changePage(_vm.pagination.current_page - 1);
      }
    }
  }, [_c("span", {
    attrs: {
      "aria-hidden": "true"
    }
  }, [_vm._v(_vm._s(_vm.config.previousText))])]) : _vm._e()]) : _vm._e(), _vm._v(" "), _vm._l(_vm.array, function (num) {
    return _c("li", {
      staticClass: "page-item",
      "class": {
        active: num === _vm.pagination.current_page
      }
    }, [_c("a", {
      staticClass: "page-link",
      attrs: {
        href: "#"
      },
      on: {
        click: function click($event) {
          $event.preventDefault();
          return _vm.changePage(num);
        }
      }
    }, [_vm._v(_vm._s(num))])]);
  }), _vm._v(" "), _vm.showNext() ? _c("li", {
    staticClass: "page-item",
    "class": {
      disabled: _vm.pagination.current_page === _vm.pagination.last_page || _vm.pagination.last_page === 0
    }
  }, [_vm.pagination.current_page === _vm.pagination.last_page || _vm.pagination.last_page === 0 ? _c("span", {
    staticClass: "page-link"
  }, [_c("span", {
    attrs: {
      "aria-hidden": "true"
    }
  }, [_vm._v(_vm._s(_vm.config.nextText))])]) : _vm._e(), _vm._v(" "), _vm.pagination.current_page < _vm.pagination.last_page ? _c("a", {
    staticClass: "page-link",
    attrs: {
      href: "#",
      "aria-label": _vm.config.ariaNext
    },
    on: {
      click: function click($event) {
        $event.preventDefault();
        return _vm.changePage(_vm.pagination.current_page + 1);
      }
    }
  }, [_c("span", {
    attrs: {
      "aria-hidden": "true"
    }
  }, [_vm._v(_vm._s(_vm.config.nextText))])]) : _vm._e()]) : _vm._e()], 2) : _vm._e()]);
};
var staticRenderFns = [];
render._withStripped = true;


/***/ }),

/***/ "./resources/js/components/pagination.vue":
/*!************************************************!*\
  !*** ./resources/js/components/pagination.vue ***!
  \************************************************/
/***/ ((__unused_webpack_module, __webpack_exports__, __webpack_require__) => {

__webpack_require__.r(__webpack_exports__);
/* harmony export */ __webpack_require__.d(__webpack_exports__, {
/* harmony export */   "default": () => (__WEBPACK_DEFAULT_EXPORT__)
/* harmony export */ });
/* harmony import */ var _pagination_vue_vue_type_template_id_603a89b6___WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! ./pagination.vue?vue&type=template&id=603a89b6& */ "./resources/js/components/pagination.vue?vue&type=template&id=603a89b6&");
/* harmony import */ var _pagination_vue_vue_type_script_lang_js___WEBPACK_IMPORTED_MODULE_1__ = __webpack_require__(/*! ./pagination.vue?vue&type=script&lang=js& */ "./resources/js/components/pagination.vue?vue&type=script&lang=js&");
/* harmony import */ var _node_modules_vue_loader_lib_runtime_componentNormalizer_js__WEBPACK_IMPORTED_MODULE_2__ = __webpack_require__(/*! !../../../node_modules/vue-loader/lib/runtime/componentNormalizer.js */ "./node_modules/vue-loader/lib/runtime/componentNormalizer.js");





/* normalize component */
;
var component = (0,_node_modules_vue_loader_lib_runtime_componentNormalizer_js__WEBPACK_IMPORTED_MODULE_2__["default"])(
  _pagination_vue_vue_type_script_lang_js___WEBPACK_IMPORTED_MODULE_1__["default"],
  _pagination_vue_vue_type_template_id_603a89b6___WEBPACK_IMPORTED_MODULE_0__.render,
  _pagination_vue_vue_type_template_id_603a89b6___WEBPACK_IMPORTED_MODULE_0__.staticRenderFns,
  false,
  null,
  null,
  null
  
)

/* hot reload */
if (false) { var api; }
component.options.__file = "resources/js/components/pagination.vue"
/* harmony default export */ const __WEBPACK_DEFAULT_EXPORT__ = (component.exports);

/***/ }),

/***/ "./resources/js/components/pagination.vue?vue&type=script&lang=js&":
/*!*************************************************************************!*\
  !*** ./resources/js/components/pagination.vue?vue&type=script&lang=js& ***!
  \*************************************************************************/
/***/ ((__unused_webpack_module, __webpack_exports__, __webpack_require__) => {

__webpack_require__.r(__webpack_exports__);
/* harmony export */ __webpack_require__.d(__webpack_exports__, {
/* harmony export */   "default": () => (__WEBPACK_DEFAULT_EXPORT__)
/* harmony export */ });
/* harmony import */ var _node_modules_babel_loader_lib_index_js_clonedRuleSet_5_use_0_node_modules_vue_loader_lib_index_js_vue_loader_options_pagination_vue_vue_type_script_lang_js___WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! -!../../../node_modules/babel-loader/lib/index.js??clonedRuleSet-5.use[0]!../../../node_modules/vue-loader/lib/index.js??vue-loader-options!./pagination.vue?vue&type=script&lang=js& */ "./node_modules/babel-loader/lib/index.js??clonedRuleSet-5.use[0]!./node_modules/vue-loader/lib/index.js??vue-loader-options!./resources/js/components/pagination.vue?vue&type=script&lang=js&");
 /* harmony default export */ const __WEBPACK_DEFAULT_EXPORT__ = (_node_modules_babel_loader_lib_index_js_clonedRuleSet_5_use_0_node_modules_vue_loader_lib_index_js_vue_loader_options_pagination_vue_vue_type_script_lang_js___WEBPACK_IMPORTED_MODULE_0__["default"]); 

/***/ }),

/***/ "./resources/js/components/pagination.vue?vue&type=template&id=603a89b6&":
/*!*******************************************************************************!*\
  !*** ./resources/js/components/pagination.vue?vue&type=template&id=603a89b6& ***!
  \*******************************************************************************/
/***/ ((__unused_webpack_module, __webpack_exports__, __webpack_require__) => {

__webpack_require__.r(__webpack_exports__);
/* harmony export */ __webpack_require__.d(__webpack_exports__, {
/* harmony export */   "render": () => (/* reexport safe */ _node_modules_babel_loader_lib_index_js_clonedRuleSet_5_use_0_node_modules_vue_loader_lib_loaders_templateLoader_js_ruleSet_1_rules_2_node_modules_vue_loader_lib_index_js_vue_loader_options_pagination_vue_vue_type_template_id_603a89b6___WEBPACK_IMPORTED_MODULE_0__.render),
/* harmony export */   "staticRenderFns": () => (/* reexport safe */ _node_modules_babel_loader_lib_index_js_clonedRuleSet_5_use_0_node_modules_vue_loader_lib_loaders_templateLoader_js_ruleSet_1_rules_2_node_modules_vue_loader_lib_index_js_vue_loader_options_pagination_vue_vue_type_template_id_603a89b6___WEBPACK_IMPORTED_MODULE_0__.staticRenderFns)
/* harmony export */ });
/* harmony import */ var _node_modules_babel_loader_lib_index_js_clonedRuleSet_5_use_0_node_modules_vue_loader_lib_loaders_templateLoader_js_ruleSet_1_rules_2_node_modules_vue_loader_lib_index_js_vue_loader_options_pagination_vue_vue_type_template_id_603a89b6___WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! -!../../../node_modules/babel-loader/lib/index.js??clonedRuleSet-5.use[0]!../../../node_modules/vue-loader/lib/loaders/templateLoader.js??ruleSet[1].rules[2]!../../../node_modules/vue-loader/lib/index.js??vue-loader-options!./pagination.vue?vue&type=template&id=603a89b6& */ "./node_modules/babel-loader/lib/index.js??clonedRuleSet-5.use[0]!./node_modules/vue-loader/lib/loaders/templateLoader.js??ruleSet[1].rules[2]!./node_modules/vue-loader/lib/index.js??vue-loader-options!./resources/js/components/pagination.vue?vue&type=template&id=603a89b6&");


/***/ })

}]);