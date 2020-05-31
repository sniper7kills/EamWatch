(window["webpackJsonp"] = window["webpackJsonp"] || []).push([["js/chunks/partials/pagination"],{

/***/ "./node_modules/babel-loader/lib/index.js?!./node_modules/vue-loader/lib/index.js?!./resources/js/components/pagination.vue?vue&type=script&lang=js&":
/*!*********************************************************************************************************************************************************************!*\
  !*** ./node_modules/babel-loader/lib??ref--4-0!./node_modules/vue-loader/lib??vue-loader-options!./resources/js/components/pagination.vue?vue&type=script&lang=js& ***!
  \*********************************************************************************************************************************************************************/
/*! exports provided: default */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
/* harmony default export */ __webpack_exports__["default"] = ({
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

/***/ "./node_modules/vue-loader/lib/loaders/templateLoader.js?!./node_modules/vue-loader/lib/index.js?!./resources/js/components/pagination.vue?vue&type=template&id=603a89b6&":
/*!*************************************************************************************************************************************************************************************************************!*\
  !*** ./node_modules/vue-loader/lib/loaders/templateLoader.js??vue-loader-options!./node_modules/vue-loader/lib??vue-loader-options!./resources/js/components/pagination.vue?vue&type=template&id=603a89b6& ***!
  \*************************************************************************************************************************************************************************************************************/
/*! exports provided: render, staticRenderFns */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony export (binding) */ __webpack_require__.d(__webpack_exports__, "render", function() { return render; });
/* harmony export (binding) */ __webpack_require__.d(__webpack_exports__, "staticRenderFns", function() { return staticRenderFns; });
var render = function() {
  var _vm = this
  var _h = _vm.$createElement
  var _c = _vm._self._c || _h
  return _c("nav", [
    _vm.pagination.last_page > 0
      ? _c(
          "ul",
          {
            staticClass: "pagination pagination-sm m-0 float-right",
            class: _vm.sizeClass
          },
          [
            _vm.showPrevious()
              ? _c(
                  "li",
                  {
                    staticClass: "page-item",
                    class: { disabled: _vm.pagination.current_page <= 1 }
                  },
                  [
                    _vm.pagination.current_page <= 1
                      ? _c("span", { staticClass: "page-link" }, [
                          _c("span", { attrs: { "aria-hidden": "true" } }, [
                            _vm._v(_vm._s(_vm.config.previousText))
                          ])
                        ])
                      : _vm._e(),
                    _vm._v(" "),
                    _vm.pagination.current_page > 1
                      ? _c(
                          "a",
                          {
                            staticClass: "page-link",
                            attrs: {
                              href: "#",
                              "aria-label": _vm.config.ariaPrevioius
                            },
                            on: {
                              click: function($event) {
                                $event.preventDefault()
                                return _vm.changePage(
                                  _vm.pagination.current_page - 1
                                )
                              }
                            }
                          },
                          [
                            _c("span", { attrs: { "aria-hidden": "true" } }, [
                              _vm._v(_vm._s(_vm.config.previousText))
                            ])
                          ]
                        )
                      : _vm._e()
                  ]
                )
              : _vm._e(),
            _vm._v(" "),
            _vm._l(_vm.array, function(num) {
              return _c(
                "li",
                {
                  staticClass: "page-item",
                  class: { active: num === _vm.pagination.current_page }
                },
                [
                  _c(
                    "a",
                    {
                      staticClass: "page-link",
                      attrs: { href: "#" },
                      on: {
                        click: function($event) {
                          $event.preventDefault()
                          return _vm.changePage(num)
                        }
                      }
                    },
                    [_vm._v(_vm._s(num))]
                  )
                ]
              )
            }),
            _vm._v(" "),
            _vm.showNext()
              ? _c(
                  "li",
                  {
                    staticClass: "page-item",
                    class: {
                      disabled:
                        _vm.pagination.current_page ===
                          _vm.pagination.last_page ||
                        _vm.pagination.last_page === 0
                    }
                  },
                  [
                    _vm.pagination.current_page === _vm.pagination.last_page ||
                    _vm.pagination.last_page === 0
                      ? _c("span", { staticClass: "page-link" }, [
                          _c("span", { attrs: { "aria-hidden": "true" } }, [
                            _vm._v(_vm._s(_vm.config.nextText))
                          ])
                        ])
                      : _vm._e(),
                    _vm._v(" "),
                    _vm.pagination.current_page < _vm.pagination.last_page
                      ? _c(
                          "a",
                          {
                            staticClass: "page-link",
                            attrs: {
                              href: "#",
                              "aria-label": _vm.config.ariaNext
                            },
                            on: {
                              click: function($event) {
                                $event.preventDefault()
                                return _vm.changePage(
                                  _vm.pagination.current_page + 1
                                )
                              }
                            }
                          },
                          [
                            _c("span", { attrs: { "aria-hidden": "true" } }, [
                              _vm._v(_vm._s(_vm.config.nextText))
                            ])
                          ]
                        )
                      : _vm._e()
                  ]
                )
              : _vm._e()
          ],
          2
        )
      : _vm._e()
  ])
}
var staticRenderFns = []
render._withStripped = true



/***/ }),

/***/ "./resources/js/components/pagination.vue":
/*!************************************************!*\
  !*** ./resources/js/components/pagination.vue ***!
  \************************************************/
/*! exports provided: default */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony import */ var _pagination_vue_vue_type_template_id_603a89b6___WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! ./pagination.vue?vue&type=template&id=603a89b6& */ "./resources/js/components/pagination.vue?vue&type=template&id=603a89b6&");
/* harmony import */ var _pagination_vue_vue_type_script_lang_js___WEBPACK_IMPORTED_MODULE_1__ = __webpack_require__(/*! ./pagination.vue?vue&type=script&lang=js& */ "./resources/js/components/pagination.vue?vue&type=script&lang=js&");
/* empty/unused harmony star reexport *//* harmony import */ var _node_modules_vue_loader_lib_runtime_componentNormalizer_js__WEBPACK_IMPORTED_MODULE_2__ = __webpack_require__(/*! ../../../node_modules/vue-loader/lib/runtime/componentNormalizer.js */ "./node_modules/vue-loader/lib/runtime/componentNormalizer.js");





/* normalize component */

var component = Object(_node_modules_vue_loader_lib_runtime_componentNormalizer_js__WEBPACK_IMPORTED_MODULE_2__["default"])(
  _pagination_vue_vue_type_script_lang_js___WEBPACK_IMPORTED_MODULE_1__["default"],
  _pagination_vue_vue_type_template_id_603a89b6___WEBPACK_IMPORTED_MODULE_0__["render"],
  _pagination_vue_vue_type_template_id_603a89b6___WEBPACK_IMPORTED_MODULE_0__["staticRenderFns"],
  false,
  null,
  null,
  null
  
)

/* hot reload */
if (false) { var api; }
component.options.__file = "resources/js/components/pagination.vue"
/* harmony default export */ __webpack_exports__["default"] = (component.exports);

/***/ }),

/***/ "./resources/js/components/pagination.vue?vue&type=script&lang=js&":
/*!*************************************************************************!*\
  !*** ./resources/js/components/pagination.vue?vue&type=script&lang=js& ***!
  \*************************************************************************/
/*! exports provided: default */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony import */ var _node_modules_babel_loader_lib_index_js_ref_4_0_node_modules_vue_loader_lib_index_js_vue_loader_options_pagination_vue_vue_type_script_lang_js___WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! -!../../../node_modules/babel-loader/lib??ref--4-0!../../../node_modules/vue-loader/lib??vue-loader-options!./pagination.vue?vue&type=script&lang=js& */ "./node_modules/babel-loader/lib/index.js?!./node_modules/vue-loader/lib/index.js?!./resources/js/components/pagination.vue?vue&type=script&lang=js&");
/* empty/unused harmony star reexport */ /* harmony default export */ __webpack_exports__["default"] = (_node_modules_babel_loader_lib_index_js_ref_4_0_node_modules_vue_loader_lib_index_js_vue_loader_options_pagination_vue_vue_type_script_lang_js___WEBPACK_IMPORTED_MODULE_0__["default"]); 

/***/ }),

/***/ "./resources/js/components/pagination.vue?vue&type=template&id=603a89b6&":
/*!*******************************************************************************!*\
  !*** ./resources/js/components/pagination.vue?vue&type=template&id=603a89b6& ***!
  \*******************************************************************************/
/*! exports provided: render, staticRenderFns */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony import */ var _node_modules_vue_loader_lib_loaders_templateLoader_js_vue_loader_options_node_modules_vue_loader_lib_index_js_vue_loader_options_pagination_vue_vue_type_template_id_603a89b6___WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! -!../../../node_modules/vue-loader/lib/loaders/templateLoader.js??vue-loader-options!../../../node_modules/vue-loader/lib??vue-loader-options!./pagination.vue?vue&type=template&id=603a89b6& */ "./node_modules/vue-loader/lib/loaders/templateLoader.js?!./node_modules/vue-loader/lib/index.js?!./resources/js/components/pagination.vue?vue&type=template&id=603a89b6&");
/* harmony reexport (safe) */ __webpack_require__.d(__webpack_exports__, "render", function() { return _node_modules_vue_loader_lib_loaders_templateLoader_js_vue_loader_options_node_modules_vue_loader_lib_index_js_vue_loader_options_pagination_vue_vue_type_template_id_603a89b6___WEBPACK_IMPORTED_MODULE_0__["render"]; });

/* harmony reexport (safe) */ __webpack_require__.d(__webpack_exports__, "staticRenderFns", function() { return _node_modules_vue_loader_lib_loaders_templateLoader_js_vue_loader_options_node_modules_vue_loader_lib_index_js_vue_loader_options_pagination_vue_vue_type_template_id_603a89b6___WEBPACK_IMPORTED_MODULE_0__["staticRenderFns"]; });



/***/ })

}]);