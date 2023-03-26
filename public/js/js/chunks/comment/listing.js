"use strict";
(self["webpackChunk"] = self["webpackChunk"] || []).push([["js/chunks/comment/listing"],{

/***/ "./node_modules/babel-loader/lib/index.js??clonedRuleSet-5.use[0]!./node_modules/vue-loader/lib/index.js??vue-loader-options!./resources/js/components/comment/listing.vue?vue&type=script&lang=js&":
/*!**********************************************************************************************************************************************************************************************************!*\
  !*** ./node_modules/babel-loader/lib/index.js??clonedRuleSet-5.use[0]!./node_modules/vue-loader/lib/index.js??vue-loader-options!./resources/js/components/comment/listing.vue?vue&type=script&lang=js& ***!
  \**********************************************************************************************************************************************************************************************************/
/***/ ((__unused_webpack_module, __webpack_exports__, __webpack_require__) => {

__webpack_require__.r(__webpack_exports__);
/* harmony export */ __webpack_require__.d(__webpack_exports__, {
/* harmony export */   "default": () => (__WEBPACK_DEFAULT_EXPORT__)
/* harmony export */ });
/* harmony default export */ const __WEBPACK_DEFAULT_EXPORT__ = ({
  name: "CommentListing",
  props: ['message_id', 'recording_id'],
  data: function data() {
    return {
      loading: false,
      comments: null,
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
    }
  },
  methods: {
    loadComments: function loadComments() {
      var _this = this;
      var options = {
        params: {
          message_id: this.message_id,
          recording_id: this.recording_id,
          paginate: this.pagination.per_page,
          page: this.pagination.current_page
        }
      };
      this.loading = true;
      axios.get('/api/comments', options).then(function (response) {
        _this.comments = response.data.data;
        _this.pagination = response.data.meta;
        _this.loading = false;
      });
    }
  },
  mounted: function mounted() {
    this.loadComments();
  }
});

/***/ }),

/***/ "./node_modules/babel-loader/lib/index.js??clonedRuleSet-5.use[0]!./node_modules/vue-loader/lib/loaders/templateLoader.js??ruleSet[1].rules[2]!./node_modules/vue-loader/lib/index.js??vue-loader-options!./resources/js/components/comment/listing.vue?vue&type=template&id=a4f45d4e&scoped=true&":
/*!*********************************************************************************************************************************************************************************************************************************************************************************************************!*\
  !*** ./node_modules/babel-loader/lib/index.js??clonedRuleSet-5.use[0]!./node_modules/vue-loader/lib/loaders/templateLoader.js??ruleSet[1].rules[2]!./node_modules/vue-loader/lib/index.js??vue-loader-options!./resources/js/components/comment/listing.vue?vue&type=template&id=a4f45d4e&scoped=true& ***!
  \*********************************************************************************************************************************************************************************************************************************************************************************************************/
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
    staticClass: "card"
  }, [_c("div", {
    staticClass: "card-header"
  }, [_c("p", {
    staticClass: "card-title"
  }, [_vm._v("Comments")]), _vm._v(" "), _c("div", {
    staticClass: "card-tools"
  }, [_c("a", {
    staticClass: "float-right pl-2",
    attrs: {
      href: ""
    },
    on: {
      click: _vm.loadComments
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
    staticClass: "card-body"
  }, [_vm.loading ? _c("vue-loading", {
    attrs: {
      type: "bubbles",
      color: "#d9544e",
      size: {
        width: "50px",
        height: "50px"
      }
    }
  }) : _vm._e(), _vm._v(" "), _vm._l(_vm.comments, function (comment) {
    return !_vm.loading ? _c("comment-view-stub", {
      key: comment.id,
      attrs: {
        comment: comment
      }
    }) : _vm._e();
  })], 2), _vm._v(" "), _c("div", {
    staticClass: "card-footer clearfix"
  }, [_c("div", {
    staticClass: "row"
  }, [_c("div", {
    staticClass: "col-6"
  }, [_c("comment-add-stub", {
    attrs: {
      message_id: _vm.message_id
    }
  })], 1), _vm._v(" "), _c("div", {
    staticClass: "col-6"
  }, [_c("pagination", {
    attrs: {
      pagination: _vm.pagination,
      callback: _vm.loadComments,
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
}];
render._withStripped = true;


/***/ }),

/***/ "./resources/js/components/comment/listing.vue":
/*!*****************************************************!*\
  !*** ./resources/js/components/comment/listing.vue ***!
  \*****************************************************/
/***/ ((__unused_webpack_module, __webpack_exports__, __webpack_require__) => {

__webpack_require__.r(__webpack_exports__);
/* harmony export */ __webpack_require__.d(__webpack_exports__, {
/* harmony export */   "default": () => (__WEBPACK_DEFAULT_EXPORT__)
/* harmony export */ });
/* harmony import */ var _listing_vue_vue_type_template_id_a4f45d4e_scoped_true___WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! ./listing.vue?vue&type=template&id=a4f45d4e&scoped=true& */ "./resources/js/components/comment/listing.vue?vue&type=template&id=a4f45d4e&scoped=true&");
/* harmony import */ var _listing_vue_vue_type_script_lang_js___WEBPACK_IMPORTED_MODULE_1__ = __webpack_require__(/*! ./listing.vue?vue&type=script&lang=js& */ "./resources/js/components/comment/listing.vue?vue&type=script&lang=js&");
/* harmony import */ var _node_modules_vue_loader_lib_runtime_componentNormalizer_js__WEBPACK_IMPORTED_MODULE_2__ = __webpack_require__(/*! !../../../../node_modules/vue-loader/lib/runtime/componentNormalizer.js */ "./node_modules/vue-loader/lib/runtime/componentNormalizer.js");





/* normalize component */
;
var component = (0,_node_modules_vue_loader_lib_runtime_componentNormalizer_js__WEBPACK_IMPORTED_MODULE_2__["default"])(
  _listing_vue_vue_type_script_lang_js___WEBPACK_IMPORTED_MODULE_1__["default"],
  _listing_vue_vue_type_template_id_a4f45d4e_scoped_true___WEBPACK_IMPORTED_MODULE_0__.render,
  _listing_vue_vue_type_template_id_a4f45d4e_scoped_true___WEBPACK_IMPORTED_MODULE_0__.staticRenderFns,
  false,
  null,
  "a4f45d4e",
  null
  
)

/* hot reload */
if (false) { var api; }
component.options.__file = "resources/js/components/comment/listing.vue"
/* harmony default export */ const __WEBPACK_DEFAULT_EXPORT__ = (component.exports);

/***/ }),

/***/ "./resources/js/components/comment/listing.vue?vue&type=script&lang=js&":
/*!******************************************************************************!*\
  !*** ./resources/js/components/comment/listing.vue?vue&type=script&lang=js& ***!
  \******************************************************************************/
/***/ ((__unused_webpack_module, __webpack_exports__, __webpack_require__) => {

__webpack_require__.r(__webpack_exports__);
/* harmony export */ __webpack_require__.d(__webpack_exports__, {
/* harmony export */   "default": () => (__WEBPACK_DEFAULT_EXPORT__)
/* harmony export */ });
/* harmony import */ var _node_modules_babel_loader_lib_index_js_clonedRuleSet_5_use_0_node_modules_vue_loader_lib_index_js_vue_loader_options_listing_vue_vue_type_script_lang_js___WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! -!../../../../node_modules/babel-loader/lib/index.js??clonedRuleSet-5.use[0]!../../../../node_modules/vue-loader/lib/index.js??vue-loader-options!./listing.vue?vue&type=script&lang=js& */ "./node_modules/babel-loader/lib/index.js??clonedRuleSet-5.use[0]!./node_modules/vue-loader/lib/index.js??vue-loader-options!./resources/js/components/comment/listing.vue?vue&type=script&lang=js&");
 /* harmony default export */ const __WEBPACK_DEFAULT_EXPORT__ = (_node_modules_babel_loader_lib_index_js_clonedRuleSet_5_use_0_node_modules_vue_loader_lib_index_js_vue_loader_options_listing_vue_vue_type_script_lang_js___WEBPACK_IMPORTED_MODULE_0__["default"]); 

/***/ }),

/***/ "./resources/js/components/comment/listing.vue?vue&type=template&id=a4f45d4e&scoped=true&":
/*!************************************************************************************************!*\
  !*** ./resources/js/components/comment/listing.vue?vue&type=template&id=a4f45d4e&scoped=true& ***!
  \************************************************************************************************/
/***/ ((__unused_webpack_module, __webpack_exports__, __webpack_require__) => {

__webpack_require__.r(__webpack_exports__);
/* harmony export */ __webpack_require__.d(__webpack_exports__, {
/* harmony export */   "render": () => (/* reexport safe */ _node_modules_babel_loader_lib_index_js_clonedRuleSet_5_use_0_node_modules_vue_loader_lib_loaders_templateLoader_js_ruleSet_1_rules_2_node_modules_vue_loader_lib_index_js_vue_loader_options_listing_vue_vue_type_template_id_a4f45d4e_scoped_true___WEBPACK_IMPORTED_MODULE_0__.render),
/* harmony export */   "staticRenderFns": () => (/* reexport safe */ _node_modules_babel_loader_lib_index_js_clonedRuleSet_5_use_0_node_modules_vue_loader_lib_loaders_templateLoader_js_ruleSet_1_rules_2_node_modules_vue_loader_lib_index_js_vue_loader_options_listing_vue_vue_type_template_id_a4f45d4e_scoped_true___WEBPACK_IMPORTED_MODULE_0__.staticRenderFns)
/* harmony export */ });
/* harmony import */ var _node_modules_babel_loader_lib_index_js_clonedRuleSet_5_use_0_node_modules_vue_loader_lib_loaders_templateLoader_js_ruleSet_1_rules_2_node_modules_vue_loader_lib_index_js_vue_loader_options_listing_vue_vue_type_template_id_a4f45d4e_scoped_true___WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! -!../../../../node_modules/babel-loader/lib/index.js??clonedRuleSet-5.use[0]!../../../../node_modules/vue-loader/lib/loaders/templateLoader.js??ruleSet[1].rules[2]!../../../../node_modules/vue-loader/lib/index.js??vue-loader-options!./listing.vue?vue&type=template&id=a4f45d4e&scoped=true& */ "./node_modules/babel-loader/lib/index.js??clonedRuleSet-5.use[0]!./node_modules/vue-loader/lib/loaders/templateLoader.js??ruleSet[1].rules[2]!./node_modules/vue-loader/lib/index.js??vue-loader-options!./resources/js/components/comment/listing.vue?vue&type=template&id=a4f45d4e&scoped=true&");


/***/ })

}]);