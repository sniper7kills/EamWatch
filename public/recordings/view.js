(window["webpackJsonp"] = window["webpackJsonp"] || []).push([["recordings/view"],{

/***/ "./node_modules/babel-loader/lib/index.js?!./node_modules/vue-loader/lib/index.js?!./resources/js/components/recording/view.vue?vue&type=script&lang=js&":
/*!*************************************************************************************************************************************************************************!*\
  !*** ./node_modules/babel-loader/lib??ref--4-0!./node_modules/vue-loader/lib??vue-loader-options!./resources/js/components/recording/view.vue?vue&type=script&lang=js& ***!
  \*************************************************************************************************************************************************************************/
/*! exports provided: default */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony import */ var vue_plyr__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! vue-plyr */ "./node_modules/vue-plyr/dist/vue-plyr.mjs");
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
//
//

/* harmony default export */ __webpack_exports__["default"] = ({
  name: "recording-view",
  data: function data() {
    return {
      recording_id: null,
      loading: true,
      recording: null
    };
  },
  methods: {
    loadRecording: function loadRecording() {
      var _this = this;

      axios.get('/api/recordings/' + this.recording_id).then(function (response) {
        _this.recording = response.data.data;
        _this.loading = false;
      });
    }
  },
  mounted: function mounted() {
    this.recording_id = this.$route.params.recording_id;
    this.loadRecording();
  },
  components: {
    VuePlyr: vue_plyr__WEBPACK_IMPORTED_MODULE_0__["default"]
  }
});

/***/ }),

/***/ "./node_modules/vue-loader/lib/loaders/templateLoader.js?!./node_modules/vue-loader/lib/index.js?!./resources/js/components/recording/view.vue?vue&type=template&id=1c47dce4&scoped=true&":
/*!*****************************************************************************************************************************************************************************************************************************!*\
  !*** ./node_modules/vue-loader/lib/loaders/templateLoader.js??vue-loader-options!./node_modules/vue-loader/lib??vue-loader-options!./resources/js/components/recording/view.vue?vue&type=template&id=1c47dce4&scoped=true& ***!
  \*****************************************************************************************************************************************************************************************************************************/
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
  return _c("div", [
    _c("div", { staticClass: "row" }, [
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
          ? _c("div", { staticClass: "card" }, [
              _c("div", { staticClass: "card-header" }, [
                _vm._v(
                  "\n                    Recording " +
                    _vm._s(this.recording.id) +
                    "\n                "
                )
              ]),
              _vm._v(" "),
              _c("div", { staticClass: "card-body" }, [
                _c("div", { staticClass: "row" }, [
                  _c("div", { staticClass: "col-12 col-md-6" }, [
                    _c("table", { staticClass: "table" }, [
                      _c("tbody", [
                        _c("tr", [
                          _c("td", [_vm._v("Frequency")]),
                          _vm._v(" "),
                          _c("td", [_vm._v(_vm._s(this.recording.frequency))])
                        ]),
                        _vm._v(" "),
                        _c("tr", [
                          _c("td", [_vm._v("Receiver")]),
                          _vm._v(" "),
                          _c("td", [_vm._v(_vm._s(this.recording.receiver))])
                        ]),
                        _vm._v(" "),
                        this.recording.message.length !== 0
                          ? _c("tr", [
                              _c("td", [_vm._v("Message")]),
                              _vm._v(" "),
                              _c(
                                "td",
                                [
                                  _c(
                                    "router-link",
                                    {
                                      attrs: {
                                        tag: "a",
                                        to: {
                                          name: "message-view",
                                          params: {
                                            message_id: this.recording.message
                                              .id
                                          }
                                        }
                                      }
                                    },
                                    [
                                      _vm._v(
                                        "\n                                                " +
                                          _vm._s(this.recording.message.id) +
                                          "\n                                            "
                                      )
                                    ]
                                  )
                                ],
                                1
                              )
                            ])
                          : _vm._e()
                      ])
                    ])
                  ]),
                  _vm._v(" "),
                  _c(
                    "div",
                    { staticClass: "col-12 col-md-6" },
                    [
                      _c("vue-plyr", [
                        _c("audio", [
                          _c("source", {
                            attrs: {
                              src: this.recording.link,
                              type: "audio/mp3"
                            }
                          })
                        ])
                      ])
                    ],
                    1
                  )
                ])
              ]),
              _vm._v(" "),
              _c("div", { staticClass: "card-footer" }, [
                _c(
                  "div",
                  { staticClass: "text-sm float-right" },
                  [
                    _c("b", [_vm._v("Submitted By:")]),
                    _vm._v(" "),
                    this.recording.user.type === "user"
                      ? _c(
                          "router-link",
                          {
                            attrs: {
                              tag: "a",
                              to: {
                                name: "user-view",
                                params: { user_id: this.recording.user.id }
                              }
                            }
                          },
                          [
                            _vm._v(
                              "\n                            " +
                                _vm._s(this.recording.user.name) +
                                "\n                        "
                            )
                          ]
                        )
                      : _vm._e(),
                    _vm._v(" "),
                    this.recording.user.type === "guest"
                      ? _c(
                          "router-link",
                          {
                            attrs: {
                              tag: "a",
                              to: {
                                name: "guest-view",
                                params: { guest_id: this.recording.user.id }
                              }
                            }
                          },
                          [
                            _vm._v(
                              "\n                            " +
                                _vm._s(this.recording.user.name) +
                                "\n                        "
                            )
                          ]
                        )
                      : _vm._e()
                  ],
                  1
                )
              ])
            ])
          : _vm._e()
      ]),
      _vm._v(" "),
      _c(
        "div",
        { staticClass: "col-12 col-md-12 col-lg-12" },
        [
          this.loading
            ? _c("div", { staticClass: "card" }, [
                _c("div", { staticClass: "card-header" }, [
                  _vm._v("\n                    Comments\n                ")
                ]),
                _vm._v(" "),
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
            ? _c("comment-listing", {
                attrs: {
                  recording_id: _vm.recording_id.id,
                  comments: this.recording.comments
                }
              })
            : _vm._e()
        ],
        1
      )
    ])
  ])
}
var staticRenderFns = []
render._withStripped = true



/***/ }),

/***/ "./resources/js/components/recording/view.vue":
/*!****************************************************!*\
  !*** ./resources/js/components/recording/view.vue ***!
  \****************************************************/
/*! exports provided: default */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony import */ var _view_vue_vue_type_template_id_1c47dce4_scoped_true___WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! ./view.vue?vue&type=template&id=1c47dce4&scoped=true& */ "./resources/js/components/recording/view.vue?vue&type=template&id=1c47dce4&scoped=true&");
/* harmony import */ var _view_vue_vue_type_script_lang_js___WEBPACK_IMPORTED_MODULE_1__ = __webpack_require__(/*! ./view.vue?vue&type=script&lang=js& */ "./resources/js/components/recording/view.vue?vue&type=script&lang=js&");
/* empty/unused harmony star reexport *//* harmony import */ var _node_modules_vue_loader_lib_runtime_componentNormalizer_js__WEBPACK_IMPORTED_MODULE_2__ = __webpack_require__(/*! ../../../../node_modules/vue-loader/lib/runtime/componentNormalizer.js */ "./node_modules/vue-loader/lib/runtime/componentNormalizer.js");





/* normalize component */

var component = Object(_node_modules_vue_loader_lib_runtime_componentNormalizer_js__WEBPACK_IMPORTED_MODULE_2__["default"])(
  _view_vue_vue_type_script_lang_js___WEBPACK_IMPORTED_MODULE_1__["default"],
  _view_vue_vue_type_template_id_1c47dce4_scoped_true___WEBPACK_IMPORTED_MODULE_0__["render"],
  _view_vue_vue_type_template_id_1c47dce4_scoped_true___WEBPACK_IMPORTED_MODULE_0__["staticRenderFns"],
  false,
  null,
  "1c47dce4",
  null
  
)

/* hot reload */
if (false) { var api; }
component.options.__file = "resources/js/components/recording/view.vue"
/* harmony default export */ __webpack_exports__["default"] = (component.exports);

/***/ }),

/***/ "./resources/js/components/recording/view.vue?vue&type=script&lang=js&":
/*!*****************************************************************************!*\
  !*** ./resources/js/components/recording/view.vue?vue&type=script&lang=js& ***!
  \*****************************************************************************/
/*! exports provided: default */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony import */ var _node_modules_babel_loader_lib_index_js_ref_4_0_node_modules_vue_loader_lib_index_js_vue_loader_options_view_vue_vue_type_script_lang_js___WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! -!../../../../node_modules/babel-loader/lib??ref--4-0!../../../../node_modules/vue-loader/lib??vue-loader-options!./view.vue?vue&type=script&lang=js& */ "./node_modules/babel-loader/lib/index.js?!./node_modules/vue-loader/lib/index.js?!./resources/js/components/recording/view.vue?vue&type=script&lang=js&");
/* empty/unused harmony star reexport */ /* harmony default export */ __webpack_exports__["default"] = (_node_modules_babel_loader_lib_index_js_ref_4_0_node_modules_vue_loader_lib_index_js_vue_loader_options_view_vue_vue_type_script_lang_js___WEBPACK_IMPORTED_MODULE_0__["default"]); 

/***/ }),

/***/ "./resources/js/components/recording/view.vue?vue&type=template&id=1c47dce4&scoped=true&":
/*!***********************************************************************************************!*\
  !*** ./resources/js/components/recording/view.vue?vue&type=template&id=1c47dce4&scoped=true& ***!
  \***********************************************************************************************/
/*! exports provided: render, staticRenderFns */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony import */ var _node_modules_vue_loader_lib_loaders_templateLoader_js_vue_loader_options_node_modules_vue_loader_lib_index_js_vue_loader_options_view_vue_vue_type_template_id_1c47dce4_scoped_true___WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! -!../../../../node_modules/vue-loader/lib/loaders/templateLoader.js??vue-loader-options!../../../../node_modules/vue-loader/lib??vue-loader-options!./view.vue?vue&type=template&id=1c47dce4&scoped=true& */ "./node_modules/vue-loader/lib/loaders/templateLoader.js?!./node_modules/vue-loader/lib/index.js?!./resources/js/components/recording/view.vue?vue&type=template&id=1c47dce4&scoped=true&");
/* harmony reexport (safe) */ __webpack_require__.d(__webpack_exports__, "render", function() { return _node_modules_vue_loader_lib_loaders_templateLoader_js_vue_loader_options_node_modules_vue_loader_lib_index_js_vue_loader_options_view_vue_vue_type_template_id_1c47dce4_scoped_true___WEBPACK_IMPORTED_MODULE_0__["render"]; });

/* harmony reexport (safe) */ __webpack_require__.d(__webpack_exports__, "staticRenderFns", function() { return _node_modules_vue_loader_lib_loaders_templateLoader_js_vue_loader_options_node_modules_vue_loader_lib_index_js_vue_loader_options_view_vue_vue_type_template_id_1c47dce4_scoped_true___WEBPACK_IMPORTED_MODULE_0__["staticRenderFns"]; });



/***/ })

}]);