(window["webpackJsonp"] = window["webpackJsonp"] || []).push([["js/chunks/user/unban"],{

/***/ "./node_modules/babel-loader/lib/index.js?!./node_modules/vue-loader/lib/index.js?!./resources/js/components/user/unban.vue?vue&type=script&lang=js&":
/*!*********************************************************************************************************************************************************************!*\
  !*** ./node_modules/babel-loader/lib??ref--4-0!./node_modules/vue-loader/lib??vue-loader-options!./resources/js/components/user/unban.vue?vue&type=script&lang=js& ***!
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
//
//
//
//
//
//
/* harmony default export */ __webpack_exports__["default"] = ({
  name: "user-unban",
  data: function data() {
    return {
      user_id: null,
      loading: true,
      user: null
    };
  },
  methods: {
    loadUser: function loadUser() {
      var _this = this;

      axios.get('/api/users/' + this.user_id).then(function (response) {
        _this.user = response.data.data;
        _this.loading = false;
      });
    },
    unbanUser: function unbanUser() {
      var _this2 = this;

      axios.put('/api/users/' + this.user_id, {
        'banned': false
      }).then(function (response) {
        _this2.$router.push({
          name: 'user-view',
          params: {
            user_id: _this2.user.id
          }
        });
      });
    }
  },
  mounted: function mounted() {
    this.user_id = this.$route.params.user_id;
    this.loadUser();
  }
});

/***/ }),

/***/ "./node_modules/vue-loader/lib/loaders/templateLoader.js?!./node_modules/vue-loader/lib/index.js?!./resources/js/components/user/unban.vue?vue&type=template&id=ae3721c6&scoped=true&":
/*!*************************************************************************************************************************************************************************************************************************!*\
  !*** ./node_modules/vue-loader/lib/loaders/templateLoader.js??vue-loader-options!./node_modules/vue-loader/lib??vue-loader-options!./resources/js/components/user/unban.vue?vue&type=template&id=ae3721c6&scoped=true& ***!
  \*************************************************************************************************************************************************************************************************************************/
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
            this.user.permissions.unban
              ? _c("div", { staticClass: "card card-primary card-outline" }, [
                  _c("div", { staticClass: "card-header" }, [
                    _vm._v(
                      "\n                    Unban " +
                        _vm._s(this.user.name) +
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
                          on: { click: _vm.unbanUser }
                        },
                        [_vm._v("Unban User")]
                      ),
                      _vm._v(" "),
                      _c(
                        "router-link",
                        {
                          staticClass: "btn btn-default float-right mr-1",
                          attrs: {
                            tag: "button",
                            to: {
                              name: "user-view",
                              params: { user_id: this.user.id }
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
            !this.user.permissions.unban
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
      _c("p", [_vm._v("About to unban user.... Are you sure?")])
    ])
  },
  function() {
    var _vm = this
    var _h = _vm.$createElement
    var _c = _vm._self._c || _h
    return _c("div", { staticClass: "card-body" }, [
      _c("p", [_vm._v("You lack the permissions to unban a user!")])
    ])
  }
]
render._withStripped = true



/***/ }),

/***/ "./resources/js/components/user/unban.vue":
/*!************************************************!*\
  !*** ./resources/js/components/user/unban.vue ***!
  \************************************************/
/*! exports provided: default */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony import */ var _unban_vue_vue_type_template_id_ae3721c6_scoped_true___WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! ./unban.vue?vue&type=template&id=ae3721c6&scoped=true& */ "./resources/js/components/user/unban.vue?vue&type=template&id=ae3721c6&scoped=true&");
/* harmony import */ var _unban_vue_vue_type_script_lang_js___WEBPACK_IMPORTED_MODULE_1__ = __webpack_require__(/*! ./unban.vue?vue&type=script&lang=js& */ "./resources/js/components/user/unban.vue?vue&type=script&lang=js&");
/* empty/unused harmony star reexport *//* harmony import */ var _node_modules_vue_loader_lib_runtime_componentNormalizer_js__WEBPACK_IMPORTED_MODULE_2__ = __webpack_require__(/*! ../../../../node_modules/vue-loader/lib/runtime/componentNormalizer.js */ "./node_modules/vue-loader/lib/runtime/componentNormalizer.js");





/* normalize component */

var component = Object(_node_modules_vue_loader_lib_runtime_componentNormalizer_js__WEBPACK_IMPORTED_MODULE_2__["default"])(
  _unban_vue_vue_type_script_lang_js___WEBPACK_IMPORTED_MODULE_1__["default"],
  _unban_vue_vue_type_template_id_ae3721c6_scoped_true___WEBPACK_IMPORTED_MODULE_0__["render"],
  _unban_vue_vue_type_template_id_ae3721c6_scoped_true___WEBPACK_IMPORTED_MODULE_0__["staticRenderFns"],
  false,
  null,
  "ae3721c6",
  null
  
)

/* hot reload */
if (false) { var api; }
component.options.__file = "resources/js/components/user/unban.vue"
/* harmony default export */ __webpack_exports__["default"] = (component.exports);

/***/ }),

/***/ "./resources/js/components/user/unban.vue?vue&type=script&lang=js&":
/*!*************************************************************************!*\
  !*** ./resources/js/components/user/unban.vue?vue&type=script&lang=js& ***!
  \*************************************************************************/
/*! exports provided: default */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony import */ var _node_modules_babel_loader_lib_index_js_ref_4_0_node_modules_vue_loader_lib_index_js_vue_loader_options_unban_vue_vue_type_script_lang_js___WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! -!../../../../node_modules/babel-loader/lib??ref--4-0!../../../../node_modules/vue-loader/lib??vue-loader-options!./unban.vue?vue&type=script&lang=js& */ "./node_modules/babel-loader/lib/index.js?!./node_modules/vue-loader/lib/index.js?!./resources/js/components/user/unban.vue?vue&type=script&lang=js&");
/* empty/unused harmony star reexport */ /* harmony default export */ __webpack_exports__["default"] = (_node_modules_babel_loader_lib_index_js_ref_4_0_node_modules_vue_loader_lib_index_js_vue_loader_options_unban_vue_vue_type_script_lang_js___WEBPACK_IMPORTED_MODULE_0__["default"]); 

/***/ }),

/***/ "./resources/js/components/user/unban.vue?vue&type=template&id=ae3721c6&scoped=true&":
/*!*******************************************************************************************!*\
  !*** ./resources/js/components/user/unban.vue?vue&type=template&id=ae3721c6&scoped=true& ***!
  \*******************************************************************************************/
/*! exports provided: render, staticRenderFns */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony import */ var _node_modules_vue_loader_lib_loaders_templateLoader_js_vue_loader_options_node_modules_vue_loader_lib_index_js_vue_loader_options_unban_vue_vue_type_template_id_ae3721c6_scoped_true___WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! -!../../../../node_modules/vue-loader/lib/loaders/templateLoader.js??vue-loader-options!../../../../node_modules/vue-loader/lib??vue-loader-options!./unban.vue?vue&type=template&id=ae3721c6&scoped=true& */ "./node_modules/vue-loader/lib/loaders/templateLoader.js?!./node_modules/vue-loader/lib/index.js?!./resources/js/components/user/unban.vue?vue&type=template&id=ae3721c6&scoped=true&");
/* harmony reexport (safe) */ __webpack_require__.d(__webpack_exports__, "render", function() { return _node_modules_vue_loader_lib_loaders_templateLoader_js_vue_loader_options_node_modules_vue_loader_lib_index_js_vue_loader_options_unban_vue_vue_type_template_id_ae3721c6_scoped_true___WEBPACK_IMPORTED_MODULE_0__["render"]; });

/* harmony reexport (safe) */ __webpack_require__.d(__webpack_exports__, "staticRenderFns", function() { return _node_modules_vue_loader_lib_loaders_templateLoader_js_vue_loader_options_node_modules_vue_loader_lib_index_js_vue_loader_options_unban_vue_vue_type_template_id_ae3721c6_scoped_true___WEBPACK_IMPORTED_MODULE_0__["staticRenderFns"]; });



/***/ })

}]);