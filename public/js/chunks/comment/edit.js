(window["webpackJsonp"] = window["webpackJsonp"] || []).push([["js/chunks/comment/edit"],{

/***/ "./node_modules/babel-loader/lib/index.js?!./node_modules/vue-loader/lib/index.js?!./resources/js/components/comment/edit.vue?vue&type=script&lang=js&":
/*!***********************************************************************************************************************************************************************!*\
  !*** ./node_modules/babel-loader/lib??ref--4-0!./node_modules/vue-loader/lib??vue-loader-options!./resources/js/components/comment/edit.vue?vue&type=script&lang=js& ***!
  \***********************************************************************************************************************************************************************/
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
/* harmony default export */ __webpack_exports__["default"] = ({
  name: "comment-add",
  data: function data() {
    return {
      comment_id: null,
      message_id: null,
      loading: true,
      submitting: false,
      message: null
    };
  },
  methods: {
    updateComment: function updateComment() {
      var _this = this;

      this.submitting = true;
      axios.put('/api/comments/' + this.comment_id, {
        message: this.message
      }).then(function (response) {
        _this.$router.push({
          name: 'message-view',
          params: {
            message_id: _this.message_id
          }
        });
      });
    },
    loadComment: function loadComment() {
      var _this2 = this;

      axios.get('/api/comments/' + this.comment_id).then(function (response) {
        _this2.message = response.data.data.comment;
        _this2.loading = false;
      });
    }
  },
  mounted: function mounted() {
    this.message_id = this.$route.params.message_id;
    this.comment_id = this.$route.params.comment_id;
    this.loadComment();
  }
});

/***/ }),

/***/ "./node_modules/vue-loader/lib/loaders/templateLoader.js?!./node_modules/vue-loader/lib/index.js?!./resources/js/components/comment/edit.vue?vue&type=template&id=570892f6&scoped=true&":
/*!***************************************************************************************************************************************************************************************************************************!*\
  !*** ./node_modules/vue-loader/lib/loaders/templateLoader.js??vue-loader-options!./node_modules/vue-loader/lib??vue-loader-options!./resources/js/components/comment/edit.vue?vue&type=template&id=570892f6&scoped=true& ***!
  \***************************************************************************************************************************************************************************************************************************/
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
  return _c("div", { staticClass: "card" }, [
    _c("div", { staticClass: "card-header" }, [
      _vm._v("\n        Edit Comment\n    ")
    ]),
    _vm._v(" "),
    _c("div", { staticClass: "card-body" }, [
      _c("textarea", {
        directives: [
          {
            name: "model",
            rawName: "v-model",
            value: _vm.message,
            expression: "message"
          }
        ],
        staticClass: "form-control form-control-sm",
        attrs: {
          disabled: _vm.submitting === true || _vm.loading === true,
          placeholder: "New Comment"
        },
        domProps: { value: _vm.message },
        on: {
          input: function($event) {
            if ($event.target.composing) {
              return
            }
            _vm.message = $event.target.value
          }
        }
      })
    ]),
    _vm._v(" "),
    _c("div", { staticClass: "card-footer" }, [
      _c(
        "button",
        {
          staticClass: "btn btn-primary float-right",
          attrs: {
            disabled: _vm.submitting === true || _vm.loading === true,
            type: "submit"
          },
          on: { click: _vm.updateComment }
        },
        [_vm._v("Edit Comment")]
      )
    ])
  ])
}
var staticRenderFns = []
render._withStripped = true



/***/ }),

/***/ "./resources/js/components/comment/edit.vue":
/*!**************************************************!*\
  !*** ./resources/js/components/comment/edit.vue ***!
  \**************************************************/
/*! exports provided: default */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony import */ var _edit_vue_vue_type_template_id_570892f6_scoped_true___WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! ./edit.vue?vue&type=template&id=570892f6&scoped=true& */ "./resources/js/components/comment/edit.vue?vue&type=template&id=570892f6&scoped=true&");
/* harmony import */ var _edit_vue_vue_type_script_lang_js___WEBPACK_IMPORTED_MODULE_1__ = __webpack_require__(/*! ./edit.vue?vue&type=script&lang=js& */ "./resources/js/components/comment/edit.vue?vue&type=script&lang=js&");
/* empty/unused harmony star reexport *//* harmony import */ var _node_modules_vue_loader_lib_runtime_componentNormalizer_js__WEBPACK_IMPORTED_MODULE_2__ = __webpack_require__(/*! ../../../../node_modules/vue-loader/lib/runtime/componentNormalizer.js */ "./node_modules/vue-loader/lib/runtime/componentNormalizer.js");





/* normalize component */

var component = Object(_node_modules_vue_loader_lib_runtime_componentNormalizer_js__WEBPACK_IMPORTED_MODULE_2__["default"])(
  _edit_vue_vue_type_script_lang_js___WEBPACK_IMPORTED_MODULE_1__["default"],
  _edit_vue_vue_type_template_id_570892f6_scoped_true___WEBPACK_IMPORTED_MODULE_0__["render"],
  _edit_vue_vue_type_template_id_570892f6_scoped_true___WEBPACK_IMPORTED_MODULE_0__["staticRenderFns"],
  false,
  null,
  "570892f6",
  null
  
)

/* hot reload */
if (false) { var api; }
component.options.__file = "resources/js/components/comment/edit.vue"
/* harmony default export */ __webpack_exports__["default"] = (component.exports);

/***/ }),

/***/ "./resources/js/components/comment/edit.vue?vue&type=script&lang=js&":
/*!***************************************************************************!*\
  !*** ./resources/js/components/comment/edit.vue?vue&type=script&lang=js& ***!
  \***************************************************************************/
/*! exports provided: default */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony import */ var _node_modules_babel_loader_lib_index_js_ref_4_0_node_modules_vue_loader_lib_index_js_vue_loader_options_edit_vue_vue_type_script_lang_js___WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! -!../../../../node_modules/babel-loader/lib??ref--4-0!../../../../node_modules/vue-loader/lib??vue-loader-options!./edit.vue?vue&type=script&lang=js& */ "./node_modules/babel-loader/lib/index.js?!./node_modules/vue-loader/lib/index.js?!./resources/js/components/comment/edit.vue?vue&type=script&lang=js&");
/* empty/unused harmony star reexport */ /* harmony default export */ __webpack_exports__["default"] = (_node_modules_babel_loader_lib_index_js_ref_4_0_node_modules_vue_loader_lib_index_js_vue_loader_options_edit_vue_vue_type_script_lang_js___WEBPACK_IMPORTED_MODULE_0__["default"]); 

/***/ }),

/***/ "./resources/js/components/comment/edit.vue?vue&type=template&id=570892f6&scoped=true&":
/*!*********************************************************************************************!*\
  !*** ./resources/js/components/comment/edit.vue?vue&type=template&id=570892f6&scoped=true& ***!
  \*********************************************************************************************/
/*! exports provided: render, staticRenderFns */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony import */ var _node_modules_vue_loader_lib_loaders_templateLoader_js_vue_loader_options_node_modules_vue_loader_lib_index_js_vue_loader_options_edit_vue_vue_type_template_id_570892f6_scoped_true___WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! -!../../../../node_modules/vue-loader/lib/loaders/templateLoader.js??vue-loader-options!../../../../node_modules/vue-loader/lib??vue-loader-options!./edit.vue?vue&type=template&id=570892f6&scoped=true& */ "./node_modules/vue-loader/lib/loaders/templateLoader.js?!./node_modules/vue-loader/lib/index.js?!./resources/js/components/comment/edit.vue?vue&type=template&id=570892f6&scoped=true&");
/* harmony reexport (safe) */ __webpack_require__.d(__webpack_exports__, "render", function() { return _node_modules_vue_loader_lib_loaders_templateLoader_js_vue_loader_options_node_modules_vue_loader_lib_index_js_vue_loader_options_edit_vue_vue_type_template_id_570892f6_scoped_true___WEBPACK_IMPORTED_MODULE_0__["render"]; });

/* harmony reexport (safe) */ __webpack_require__.d(__webpack_exports__, "staticRenderFns", function() { return _node_modules_vue_loader_lib_loaders_templateLoader_js_vue_loader_options_node_modules_vue_loader_lib_index_js_vue_loader_options_edit_vue_vue_type_template_id_570892f6_scoped_true___WEBPACK_IMPORTED_MODULE_0__["staticRenderFns"]; });



/***/ })

}]);