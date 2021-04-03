(self["webpackChunk"] = self["webpackChunk"] || []).push([["js/chunks/messages/skyking"],{

/***/ "./node_modules/babel-loader/lib/index.js??clonedRuleSet-5[0].rules[0].use[0]!./node_modules/vue-loader/lib/index.js??vue-loader-options!./resources/js/components/messages/skyking.vue?vue&type=script&lang=js&":
/*!***********************************************************************************************************************************************************************************************************************!*\
  !*** ./node_modules/babel-loader/lib/index.js??clonedRuleSet-5[0].rules[0].use[0]!./node_modules/vue-loader/lib/index.js??vue-loader-options!./resources/js/components/messages/skyking.vue?vue&type=script&lang=js& ***!
  \***********************************************************************************************************************************************************************************************************************/
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
/* harmony default export */ const __WEBPACK_DEFAULT_EXPORT__ = ({
  name: "message-listing",
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
      axios.get('/api/skykings', options).then(function (response) {
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

/***/ "./resources/js/components/messages/skyking.vue":
/*!******************************************************!*\
  !*** ./resources/js/components/messages/skyking.vue ***!
  \******************************************************/
/***/ ((__unused_webpack_module, __webpack_exports__, __webpack_require__) => {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony export */ __webpack_require__.d(__webpack_exports__, {
/* harmony export */   "default": () => (__WEBPACK_DEFAULT_EXPORT__)
/* harmony export */ });
/* harmony import */ var _skyking_vue_vue_type_template_id_82ac6380_scoped_true___WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! ./skyking.vue?vue&type=template&id=82ac6380&scoped=true& */ "./resources/js/components/messages/skyking.vue?vue&type=template&id=82ac6380&scoped=true&");
/* harmony import */ var _skyking_vue_vue_type_script_lang_js___WEBPACK_IMPORTED_MODULE_1__ = __webpack_require__(/*! ./skyking.vue?vue&type=script&lang=js& */ "./resources/js/components/messages/skyking.vue?vue&type=script&lang=js&");
/* harmony import */ var _node_modules_vue_loader_lib_runtime_componentNormalizer_js__WEBPACK_IMPORTED_MODULE_2__ = __webpack_require__(/*! !../../../../node_modules/vue-loader/lib/runtime/componentNormalizer.js */ "./node_modules/vue-loader/lib/runtime/componentNormalizer.js");





/* normalize component */
;
var component = (0,_node_modules_vue_loader_lib_runtime_componentNormalizer_js__WEBPACK_IMPORTED_MODULE_2__.default)(
  _skyking_vue_vue_type_script_lang_js___WEBPACK_IMPORTED_MODULE_1__.default,
  _skyking_vue_vue_type_template_id_82ac6380_scoped_true___WEBPACK_IMPORTED_MODULE_0__.render,
  _skyking_vue_vue_type_template_id_82ac6380_scoped_true___WEBPACK_IMPORTED_MODULE_0__.staticRenderFns,
  false,
  null,
  "82ac6380",
  null
  
)

/* hot reload */
if (false) { var api; }
component.options.__file = "resources/js/components/messages/skyking.vue"
/* harmony default export */ const __WEBPACK_DEFAULT_EXPORT__ = (component.exports);

/***/ }),

/***/ "./resources/js/components/messages/skyking.vue?vue&type=script&lang=js&":
/*!*******************************************************************************!*\
  !*** ./resources/js/components/messages/skyking.vue?vue&type=script&lang=js& ***!
  \*******************************************************************************/
/***/ ((__unused_webpack_module, __webpack_exports__, __webpack_require__) => {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony export */ __webpack_require__.d(__webpack_exports__, {
/* harmony export */   "default": () => (__WEBPACK_DEFAULT_EXPORT__)
/* harmony export */ });
/* harmony import */ var _node_modules_babel_loader_lib_index_js_clonedRuleSet_5_0_rules_0_use_0_node_modules_vue_loader_lib_index_js_vue_loader_options_skyking_vue_vue_type_script_lang_js___WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! -!../../../../node_modules/babel-loader/lib/index.js??clonedRuleSet-5[0].rules[0].use[0]!../../../../node_modules/vue-loader/lib/index.js??vue-loader-options!./skyking.vue?vue&type=script&lang=js& */ "./node_modules/babel-loader/lib/index.js??clonedRuleSet-5[0].rules[0].use[0]!./node_modules/vue-loader/lib/index.js??vue-loader-options!./resources/js/components/messages/skyking.vue?vue&type=script&lang=js&");
 /* harmony default export */ const __WEBPACK_DEFAULT_EXPORT__ = (_node_modules_babel_loader_lib_index_js_clonedRuleSet_5_0_rules_0_use_0_node_modules_vue_loader_lib_index_js_vue_loader_options_skyking_vue_vue_type_script_lang_js___WEBPACK_IMPORTED_MODULE_0__.default); 

/***/ }),

/***/ "./resources/js/components/messages/skyking.vue?vue&type=template&id=82ac6380&scoped=true&":
/*!*************************************************************************************************!*\
  !*** ./resources/js/components/messages/skyking.vue?vue&type=template&id=82ac6380&scoped=true& ***!
  \*************************************************************************************************/
/***/ ((__unused_webpack_module, __webpack_exports__, __webpack_require__) => {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony export */ __webpack_require__.d(__webpack_exports__, {
/* harmony export */   "render": () => (/* reexport safe */ _node_modules_vue_loader_lib_loaders_templateLoader_js_vue_loader_options_node_modules_vue_loader_lib_index_js_vue_loader_options_skyking_vue_vue_type_template_id_82ac6380_scoped_true___WEBPACK_IMPORTED_MODULE_0__.render),
/* harmony export */   "staticRenderFns": () => (/* reexport safe */ _node_modules_vue_loader_lib_loaders_templateLoader_js_vue_loader_options_node_modules_vue_loader_lib_index_js_vue_loader_options_skyking_vue_vue_type_template_id_82ac6380_scoped_true___WEBPACK_IMPORTED_MODULE_0__.staticRenderFns)
/* harmony export */ });
/* harmony import */ var _node_modules_vue_loader_lib_loaders_templateLoader_js_vue_loader_options_node_modules_vue_loader_lib_index_js_vue_loader_options_skyking_vue_vue_type_template_id_82ac6380_scoped_true___WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! -!../../../../node_modules/vue-loader/lib/loaders/templateLoader.js??vue-loader-options!../../../../node_modules/vue-loader/lib/index.js??vue-loader-options!./skyking.vue?vue&type=template&id=82ac6380&scoped=true& */ "./node_modules/vue-loader/lib/loaders/templateLoader.js??vue-loader-options!./node_modules/vue-loader/lib/index.js??vue-loader-options!./resources/js/components/messages/skyking.vue?vue&type=template&id=82ac6380&scoped=true&");


/***/ }),

/***/ "./node_modules/vue-loader/lib/loaders/templateLoader.js??vue-loader-options!./node_modules/vue-loader/lib/index.js??vue-loader-options!./resources/js/components/messages/skyking.vue?vue&type=template&id=82ac6380&scoped=true&":
/*!****************************************************************************************************************************************************************************************************************************************!*\
  !*** ./node_modules/vue-loader/lib/loaders/templateLoader.js??vue-loader-options!./node_modules/vue-loader/lib/index.js??vue-loader-options!./resources/js/components/messages/skyking.vue?vue&type=template&id=82ac6380&scoped=true& ***!
  \****************************************************************************************************************************************************************************************************************************************/
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
    _c("div", { staticClass: "col-12" }, [
      _c("div", { staticClass: "card" }, [
        _c("div", { staticClass: "card-header" }, [
          _c("h3", { staticClass: "card-title" }, [_vm._v("Skyking Messages")]),
          _vm._v(" "),
          _c("div", { staticClass: "card-tools" }, [
            _c(
              "a",
              {
                staticClass: "float-right pl-2",
                attrs: { href: "" },
                on: { click: _vm.loadMessages }
              },
              [_c("i", { staticClass: "fa fa-sync" })]
            ),
            _vm._v(" "),
            _c(
              "div",
              {
                staticClass: "input-group input-group-sm",
                staticStyle: { width: "150px" }
              },
              [
                _vm._m(0),
                _vm._v(" "),
                _c(
                  "select",
                  {
                    directives: [
                      {
                        name: "model",
                        rawName: "v-model",
                        value: _vm.pagination.per_page,
                        expression: "pagination.per_page"
                      }
                    ],
                    staticClass: "form-control float-right",
                    attrs: { disabled: _vm.loading === true },
                    on: {
                      change: function($event) {
                        var $$selectedVal = Array.prototype.filter
                          .call($event.target.options, function(o) {
                            return o.selected
                          })
                          .map(function(o) {
                            var val = "_value" in o ? o._value : o.value
                            return val
                          })
                        _vm.$set(
                          _vm.pagination,
                          "per_page",
                          $event.target.multiple
                            ? $$selectedVal
                            : $$selectedVal[0]
                        )
                      }
                    }
                  },
                  [
                    _c("option", { attrs: { value: "5" } }, [_vm._v("5")]),
                    _vm._v(" "),
                    _c("option", { attrs: { value: "10" } }, [_vm._v("10")]),
                    _vm._v(" "),
                    _c("option", { attrs: { value: "15" } }, [_vm._v("15")]),
                    _vm._v(" "),
                    _c("option", { attrs: { value: "20" } }, [_vm._v("20")]),
                    _vm._v(" "),
                    _c("option", { attrs: { value: "25" } }, [_vm._v("25")]),
                    _vm._v(" "),
                    _c("option", { attrs: { value: "50" } }, [_vm._v("50")]),
                    _vm._v(" "),
                    _c("option", { attrs: { value: "75" } }, [_vm._v("75")]),
                    _vm._v(" "),
                    _c("option", { attrs: { value: "100" } }, [_vm._v("100")])
                  ]
                )
              ]
            )
          ])
        ]),
        _vm._v(" "),
        _c("div", { staticClass: "card-body table-responsive p-0" }, [
          _c("table", { staticClass: "table table-hover" }, [
            _vm._m(1),
            _vm._v(" "),
            _vm.loading === true
              ? _c("tbody", [
                  _c("tr", [
                    _c(
                      "td",
                      { attrs: { colspan: "6" } },
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
                ])
              : _vm._e(),
            _vm._v(" "),
            _vm.loading === false
              ? _c(
                  "tbody",
                  _vm._l(_vm.messages, function(message) {
                    return _c("tr", { key: message.id }, [
                      _c("td", [_vm._v(_vm._s(message.type))]),
                      _vm._v(" "),
                      _c("td", [_vm._v(_vm._s(message.time))]),
                      _vm._v(" "),
                      _c("td", [
                        message.receiver === ""
                          ? _c("p", { staticClass: "text-muted text-sm" }, [
                              _c("b", [_vm._v("Sender: ")]),
                              _vm._v(
                                " " +
                                  _vm._s(message.sender) +
                                  "\n                            "
                              )
                            ])
                          : _c("p", { staticClass: "text-muted text-sm" }, [
                              _c("b", [_vm._v("Sender: ")]),
                              _vm._v(" " + _vm._s(message.sender) + " "),
                              _c("br"),
                              _vm._v(" "),
                              _c("b", [_vm._v("Receiver: ")]),
                              _vm._v(
                                " " +
                                  _vm._s(message.receiver) +
                                  "\n                            "
                              )
                            ])
                      ]),
                      _vm._v(" "),
                      _c("td", [
                        _c(
                          "span",
                          { staticStyle: { "font-family": "monospace" } },
                          [_vm._v(_vm._s(message.message))]
                        )
                      ]),
                      _vm._v(" "),
                      _c("td", [
                        _c(
                          "p",
                          { staticClass: "text-muted text-sm" },
                          [
                            _c("b", [_vm._v("Recordings: ")]),
                            _vm._v(" " + _vm._s(message.recording_count) + " "),
                            _c("br"),
                            _vm._v(" "),
                            _c("b", [_vm._v("Comments: ")]),
                            _vm._v(" " + _vm._s(message.comment_count) + " "),
                            _c("br"),
                            _vm._v(" "),
                            _c("b", [_vm._v("Submitter: ")]),
                            _vm._v(" "),
                            message.user.type === "user"
                              ? _c(
                                  "router-link",
                                  {
                                    attrs: {
                                      tag: "a",
                                      to: {
                                        name: "user-view",
                                        params: { user_id: message.user.id }
                                      }
                                    }
                                  },
                                  [
                                    _vm._v(
                                      "\n                                    " +
                                        _vm._s(message.user.name) +
                                        "\n                                "
                                    )
                                  ]
                                )
                              : _vm._e(),
                            _vm._v(" "),
                            message.user.type === "guest"
                              ? _c(
                                  "router-link",
                                  {
                                    attrs: {
                                      tag: "a",
                                      to: {
                                        name: "guest-view",
                                        params: { guest_id: message.user.id }
                                      }
                                    }
                                  },
                                  [
                                    _vm._v(
                                      "\n                                    " +
                                        _vm._s(message.user.name) +
                                        "\n                                "
                                    )
                                  ]
                                )
                              : _vm._e()
                          ],
                          1
                        )
                      ]),
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
                                  params: { message_id: message.id }
                                }
                              }
                            },
                            [_c("i", { staticClass: "fa fa-eye" })]
                          ),
                          _vm._v(" "),
                          message.permissions.update
                            ? _c(
                                "router-link",
                                {
                                  attrs: {
                                    tag: "a",
                                    to: {
                                      name: "message-edit",
                                      params: { message_id: message.id }
                                    }
                                  }
                                },
                                [_c("i", { staticClass: "fa fa-edit" })]
                              )
                            : _vm._e(),
                          _vm._v(" "),
                          message.permissions.delete
                            ? _c(
                                "router-link",
                                {
                                  attrs: {
                                    tag: "a",
                                    to: {
                                      name: "message-delete",
                                      params: { message_id: message.id }
                                    }
                                  }
                                },
                                [_c("i", { staticClass: "fa fa-trash" })]
                              )
                            : _vm._e()
                        ],
                        1
                      )
                    ])
                  }),
                  0
                )
              : _vm._e()
          ])
        ]),
        _vm._v(" "),
        _c(
          "div",
          { staticClass: "card-footer clearfix" },
          [
            _c("pagination", {
              attrs: {
                pagination: _vm.pagination,
                callback: _vm.loadMessages,
                options: _vm.paginationOptions
              }
            })
          ],
          1
        )
      ])
    ])
  ])
}
var staticRenderFns = [
  function() {
    var _vm = this
    var _h = _vm.$createElement
    var _c = _vm._self._c || _h
    return _c("div", { staticClass: "input-group-prepend" }, [
      _c("span", { staticClass: "input-group-text" }, [_vm._v("Per Page")])
    ])
  },
  function() {
    var _vm = this
    var _h = _vm.$createElement
    var _c = _vm._self._c || _h
    return _c("thead", [
      _c("tr", [
        _c("th", [_vm._v("Type")]),
        _vm._v(" "),
        _c("th", [_vm._v("Time")]),
        _vm._v(" "),
        _c("th", [_vm._v("Sender/Receiver")]),
        _vm._v(" "),
        _c("th", [_vm._v("Message")]),
        _vm._v(" "),
        _c("th", [_vm._v("Counts/Submitter")]),
        _vm._v(" "),
        _c("th", [_vm._v("Actions")])
      ])
    ])
  }
]
render._withStripped = true



/***/ })

}]);