(self["webpackChunk"] = self["webpackChunk"] || []).push([["js/chunks/guest/ban"],{

/***/ "./node_modules/babel-loader/lib/index.js??clonedRuleSet-5[0].rules[0].use[0]!./node_modules/vue-loader/lib/index.js??vue-loader-options!./resources/js/components/guest/ban.vue?vue&type=script&lang=js&":
/*!****************************************************************************************************************************************************************************************************************!*\
  !*** ./node_modules/babel-loader/lib/index.js??clonedRuleSet-5[0].rules[0].use[0]!./node_modules/vue-loader/lib/index.js??vue-loader-options!./resources/js/components/guest/ban.vue?vue&type=script&lang=js& ***!
  \****************************************************************************************************************************************************************************************************************/
/***/ ((__unused_webpack_module, __webpack_exports__, __webpack_require__) => {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony export */ __webpack_require__.d(__webpack_exports__, {
/* harmony export */   "default": () => (__WEBPACK_DEFAULT_EXPORT__)
/* harmony export */ });
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
//
//
//
//
//
//
/* harmony default export */ const __WEBPACK_DEFAULT_EXPORT__ = ({
  name: "guest-ban",
  data: function data() {
    return {
      guest_id: null,
      loading: true,
      guest: null
    };
  },
  methods: {
    loadGuest: function loadGuest() {
      var _this = this;

      axios.get('/api/guests/' + this.guest_id).then(function (response) {
        _this.guest = response.data.data;
        _this.loading = false;
      });
    },
    banGuest: function banGuest() {
      var _this2 = this;

      axios.put('/api/guests/' + this.guest_id, {
        'banned': true
      }).then(function (response) {
        _this2.$router.push({
          name: 'guest-view',
          params: {
            guest_id: _this2.guest.id
          }
        });
      });
    }
  },
  mounted: function mounted() {
    this.guest_id = this.$route.params.guest_id;
    this.loadGuest();
  }
});

/***/ }),

/***/ "./resources/js/components/guest/ban.vue":
/*!***********************************************!*\
  !*** ./resources/js/components/guest/ban.vue ***!
  \***********************************************/
/***/ ((__unused_webpack_module, __webpack_exports__, __webpack_require__) => {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony export */ __webpack_require__.d(__webpack_exports__, {
/* harmony export */   "default": () => (__WEBPACK_DEFAULT_EXPORT__)
/* harmony export */ });
/* harmony import */ var _ban_vue_vue_type_template_id_2174699d_scoped_true___WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! ./ban.vue?vue&type=template&id=2174699d&scoped=true& */ "./resources/js/components/guest/ban.vue?vue&type=template&id=2174699d&scoped=true&");
/* harmony import */ var _ban_vue_vue_type_script_lang_js___WEBPACK_IMPORTED_MODULE_1__ = __webpack_require__(/*! ./ban.vue?vue&type=script&lang=js& */ "./resources/js/components/guest/ban.vue?vue&type=script&lang=js&");
/* harmony import */ var _node_modules_vue_loader_lib_runtime_componentNormalizer_js__WEBPACK_IMPORTED_MODULE_2__ = __webpack_require__(/*! !../../../../node_modules/vue-loader/lib/runtime/componentNormalizer.js */ "./node_modules/vue-loader/lib/runtime/componentNormalizer.js");





/* normalize component */
;
var component = (0,_node_modules_vue_loader_lib_runtime_componentNormalizer_js__WEBPACK_IMPORTED_MODULE_2__.default)(
  _ban_vue_vue_type_script_lang_js___WEBPACK_IMPORTED_MODULE_1__.default,
  _ban_vue_vue_type_template_id_2174699d_scoped_true___WEBPACK_IMPORTED_MODULE_0__.render,
  _ban_vue_vue_type_template_id_2174699d_scoped_true___WEBPACK_IMPORTED_MODULE_0__.staticRenderFns,
  false,
  null,
  "2174699d",
  null
  
)

/* hot reload */
if (false) { var api; }
component.options.__file = "resources/js/components/guest/ban.vue"
/* harmony default export */ const __WEBPACK_DEFAULT_EXPORT__ = (component.exports);

/***/ }),

/***/ "./resources/js/components/guest/ban.vue?vue&type=script&lang=js&":
/*!************************************************************************!*\
  !*** ./resources/js/components/guest/ban.vue?vue&type=script&lang=js& ***!
  \************************************************************************/
/***/ ((__unused_webpack_module, __webpack_exports__, __webpack_require__) => {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony export */ __webpack_require__.d(__webpack_exports__, {
/* harmony export */   "default": () => (__WEBPACK_DEFAULT_EXPORT__)
/* harmony export */ });
/* harmony import */ var _node_modules_babel_loader_lib_index_js_clonedRuleSet_5_0_rules_0_use_0_node_modules_vue_loader_lib_index_js_vue_loader_options_ban_vue_vue_type_script_lang_js___WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! -!../../../../node_modules/babel-loader/lib/index.js??clonedRuleSet-5[0].rules[0].use[0]!../../../../node_modules/vue-loader/lib/index.js??vue-loader-options!./ban.vue?vue&type=script&lang=js& */ "./node_modules/babel-loader/lib/index.js??clonedRuleSet-5[0].rules[0].use[0]!./node_modules/vue-loader/lib/index.js??vue-loader-options!./resources/js/components/guest/ban.vue?vue&type=script&lang=js&");
 /* harmony default export */ const __WEBPACK_DEFAULT_EXPORT__ = (_node_modules_babel_loader_lib_index_js_clonedRuleSet_5_0_rules_0_use_0_node_modules_vue_loader_lib_index_js_vue_loader_options_ban_vue_vue_type_script_lang_js___WEBPACK_IMPORTED_MODULE_0__.default); 

/***/ }),

/***/ "./resources/js/components/guest/ban.vue?vue&type=template&id=2174699d&scoped=true&":
/*!******************************************************************************************!*\
  !*** ./resources/js/components/guest/ban.vue?vue&type=template&id=2174699d&scoped=true& ***!
  \******************************************************************************************/
/***/ ((__unused_webpack_module, __webpack_exports__, __webpack_require__) => {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony export */ __webpack_require__.d(__webpack_exports__, {
/* harmony export */   "render": () => (/* reexport safe */ _node_modules_vue_loader_lib_loaders_templateLoader_js_vue_loader_options_node_modules_vue_loader_lib_index_js_vue_loader_options_ban_vue_vue_type_template_id_2174699d_scoped_true___WEBPACK_IMPORTED_MODULE_0__.render),
/* harmony export */   "staticRenderFns": () => (/* reexport safe */ _node_modules_vue_loader_lib_loaders_templateLoader_js_vue_loader_options_node_modules_vue_loader_lib_index_js_vue_loader_options_ban_vue_vue_type_template_id_2174699d_scoped_true___WEBPACK_IMPORTED_MODULE_0__.staticRenderFns)
/* harmony export */ });
/* harmony import */ var _node_modules_vue_loader_lib_loaders_templateLoader_js_vue_loader_options_node_modules_vue_loader_lib_index_js_vue_loader_options_ban_vue_vue_type_template_id_2174699d_scoped_true___WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! -!../../../../node_modules/vue-loader/lib/loaders/templateLoader.js??vue-loader-options!../../../../node_modules/vue-loader/lib/index.js??vue-loader-options!./ban.vue?vue&type=template&id=2174699d&scoped=true& */ "./node_modules/vue-loader/lib/loaders/templateLoader.js??vue-loader-options!./node_modules/vue-loader/lib/index.js??vue-loader-options!./resources/js/components/guest/ban.vue?vue&type=template&id=2174699d&scoped=true&");


/***/ }),

/***/ "./node_modules/vue-loader/lib/loaders/templateLoader.js??vue-loader-options!./node_modules/vue-loader/lib/index.js??vue-loader-options!./resources/js/components/guest/ban.vue?vue&type=template&id=2174699d&scoped=true&":
/*!*********************************************************************************************************************************************************************************************************************************!*\
  !*** ./node_modules/vue-loader/lib/loaders/templateLoader.js??vue-loader-options!./node_modules/vue-loader/lib/index.js??vue-loader-options!./resources/js/components/guest/ban.vue?vue&type=template&id=2174699d&scoped=true& ***!
  \*********************************************************************************************************************************************************************************************************************************/
/***/ ((__unused_webpack_module, __webpack_exports__, __webpack_require__) => {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony export */ __webpack_require__.d(__webpack_exports__, {
/* harmony export */   "render": () => (/* binding */ render),
/* harmony export */   "staticRenderFns": () => (/* binding */ staticRenderFns)
/* harmony export */ });
var render = function() {
  var _vm = this
  var _h = _vm.$createElement
  var _c = _vm._self._c || _h
  return _c("div", { staticClass: "row" }, [
    _c("div", { staticClass: "col-12 col-md-12 col-lg-12" }, [
      this.loading
        ? _c("div", { staticClass: "card" }, [
            _c(
              "div",
              { staticClass: "card-body" },
              [
                _c("vue-loading", {
                  attrs: {
                    type: "bubbles",
                    color: "#d9544e",
                    size: { width: "50px", height: "50px" }
                  }
                })
              ],
              1
            )
          ])
        : _vm._e(),
      _vm._v(" "),
      !this.loading
        ? _c("div", [
            this.guest.permissions.ban
              ? _c("div", { staticClass: "card card-primary card-outline" }, [
                  _c("div", { staticClass: "card-header" }, [
                    _vm._v(
                      "\n                    Ban " +
                        _vm._s(this.guest.name) +
                        "\n                "
                    )
                  ]),
                  _vm._v(" "),
                  _vm._m(0),
                  _vm._v(" "),
                  _c(
                    "div",
                    { staticClass: "card-footer" },
                    [
                      _c(
                        "button",
                        {
                          staticClass: "btn btn-danger float-right",
                          on: { click: _vm.banGuest }
                        },
                        [_vm._v("Ban Guest")]
                      ),
                      _vm._v(" "),
                      _c(
                        "router-link",
                        {
                          staticClass: "btn btn-default float-right mr-1",
                          attrs: {
                            tag: "button",
                            to: {
                              name: "guest-view",
                              params: { guest_id: this.guest.id }
                            }
                          }
                        },
                        [
                          _vm._v(
                            "\n                        Back\n                    "
                          )
                        ]
                      )
                    ],
                    1
                  )
                ])
              : _vm._e(),
            _vm._v(" "),
            !this.guest.permissions.ban
              ? _c("div", { staticClass: "card card-danger card-outline" }, [
                  _c("div", { staticClass: "card-header" }, [
                    _vm._v("\n                    Error!\n                ")
                  ]),
                  _vm._v(" "),
                  _vm._m(1)
                ])
              : _vm._e()
          ])
        : _vm._e()
    ])
  ])
}
var staticRenderFns = [
  function() {
    var _vm = this
    var _h = _vm.$createElement
    var _c = _vm._self._c || _h
    return _c("div", { staticClass: "card-body" }, [
      _c("p", [_vm._v("About to ban guest.... Are you sure?")])
    ])
  },
  function() {
    var _vm = this
    var _h = _vm.$createElement
    var _c = _vm._self._c || _h
    return _c("div", { staticClass: "card-body" }, [
      _c("p", [_vm._v("You lack the permissions to ban a guest!")])
    ])
  }
]
render._withStripped = true



/***/ })

}]);