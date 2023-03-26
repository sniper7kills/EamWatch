"use strict";
(self["webpackChunk"] = self["webpackChunk"] || []).push([["js/chunks/recording/stub/add"],{

/***/ "./node_modules/babel-loader/lib/index.js??clonedRuleSet-5.use[0]!./node_modules/vue-loader/lib/index.js??vue-loader-options!./resources/js/components/recording/stub/add.vue?vue&type=script&lang=js&":
/*!*************************************************************************************************************************************************************************************************************!*\
  !*** ./node_modules/babel-loader/lib/index.js??clonedRuleSet-5.use[0]!./node_modules/vue-loader/lib/index.js??vue-loader-options!./resources/js/components/recording/stub/add.vue?vue&type=script&lang=js& ***!
  \*************************************************************************************************************************************************************************************************************/
/***/ ((__unused_webpack_module, __webpack_exports__, __webpack_require__) => {

__webpack_require__.r(__webpack_exports__);
/* harmony export */ __webpack_require__.d(__webpack_exports__, {
/* harmony export */   "default": () => (__WEBPACK_DEFAULT_EXPORT__)
/* harmony export */ });
/* harmony default export */ const __WEBPACK_DEFAULT_EXPORT__ = ({
  name: "RecordingAddStub",
  props: ['message_id'],
  data: function data() {
    return {
      uploadProgress: 0,
      uploadFinished: false,
      submitting: false,
      receiver: null,
      frequency: null,
      upload: {
        uuid: null,
        key: null,
        bucket: null,
        name: null,
        content_type: null
      }
    };
  },
  methods: {
    uploadRecording: function uploadRecording() {
      var _this = this;
      this.submitting = true;
      if (this.upload.uuid === null) {
        Vapor.store(this.$refs.recording.files[0], {
          progress: function progress(_progress) {
            _this.uploadProgress = Math.round(_progress * 100);
          }
        }).then(function (response) {
          _this.upload.uuid = response.uuid;
          _this.upload.key = response.key;
          _this.upload.bucket = response.bucket;
          _this.upload.name = _this.$refs.recording.files[0].name;
          _this.upload.content_type = _this.$refs.recording.files[0].type;
          _this.submitRecording();
        })["catch"](function (response) {
          _this.submitting = false;
          console.log(response);
        });
      } else {
        this.submitRecording();
      }
    },
    submitRecording: function submitRecording() {
      var _this2 = this;
      axios.post('/api/recordings', {
        uuid: this.upload.uuid,
        key: this.upload.key,
        bucket: this.upload.bucket,
        name: this.upload.name,
        content_type: this.upload.content_type,
        receiver: this.receiver,
        frequency: this.frequency,
        message_id: this.message_id
      }).then(function (response) {
        _this2.uploadFinished = true;
      })["catch"](function (response) {
        console.log(response);
        _this2.submitting = false;
      });
    }
  }
});

/***/ }),

/***/ "./node_modules/babel-loader/lib/index.js??clonedRuleSet-5.use[0]!./node_modules/vue-loader/lib/loaders/templateLoader.js??ruleSet[1].rules[2]!./node_modules/vue-loader/lib/index.js??vue-loader-options!./resources/js/components/recording/stub/add.vue?vue&type=template&id=0e0c4eae&scoped=true&":
/*!************************************************************************************************************************************************************************************************************************************************************************************************************!*\
  !*** ./node_modules/babel-loader/lib/index.js??clonedRuleSet-5.use[0]!./node_modules/vue-loader/lib/loaders/templateLoader.js??ruleSet[1].rules[2]!./node_modules/vue-loader/lib/index.js??vue-loader-options!./resources/js/components/recording/stub/add.vue?vue&type=template&id=0e0c4eae&scoped=true& ***!
  \************************************************************************************************************************************************************************************************************************************************************************************************************/
/***/ ((__unused_webpack_module, __webpack_exports__, __webpack_require__) => {

__webpack_require__.r(__webpack_exports__);
/* harmony export */ __webpack_require__.d(__webpack_exports__, {
/* harmony export */   "render": () => (/* binding */ render),
/* harmony export */   "staticRenderFns": () => (/* binding */ staticRenderFns)
/* harmony export */ });
var render = function render() {
  var _vm = this,
    _c = _vm._self._c;
  return !_vm.uploadFinished ? _c("div", {
    staticClass: "card"
  }, [_c("div", {
    staticClass: "card-header"
  }, [_vm._v("\n        Add Recording\n    ")]), _vm._v(" "), _c("div", {
    staticClass: "card-body"
  }, [_c("div", {
    staticClass: "row"
  }, [_c("div", {
    staticClass: "col-12 col-md-6"
  }, [_c("div", {
    staticClass: "form-group"
  }, [_c("label", {
    attrs: {
      "for": "receiver"
    }
  }, [_vm._v("Receiver")]), _vm._v(" "), _c("input", {
    directives: [{
      name: "model",
      rawName: "v-model",
      value: _vm.receiver,
      expression: "receiver"
    }],
    staticClass: "form-control",
    "class": {
      "is-invalid": this.$errors.has("receiver")
    },
    attrs: {
      type: "text",
      id: "receiver",
      disabled: _vm.submitting === true
    },
    domProps: {
      value: _vm.receiver
    },
    on: {
      input: function input($event) {
        if ($event.target.composing) return;
        _vm.receiver = $event.target.value;
      }
    }
  }), _vm._v(" "), _c("error", {
    staticClass: "text-danger",
    attrs: {
      input: "receiver"
    }
  })], 1)]), _vm._v(" "), _c("div", {
    staticClass: "col-12 col-md-6"
  }, [_c("div", {
    staticClass: "form-group"
  }, [_c("label", {
    attrs: {
      "for": "frequency"
    }
  }, [_vm._v("Frequency")]), _vm._v(" "), _c("input", {
    directives: [{
      name: "model",
      rawName: "v-model",
      value: _vm.frequency,
      expression: "frequency"
    }],
    staticClass: "form-control",
    "class": {
      "is-invalid": this.$errors.has("frequency")
    },
    attrs: {
      type: "text",
      id: "frequency",
      disabled: _vm.submitting === true
    },
    domProps: {
      value: _vm.frequency
    },
    on: {
      input: function input($event) {
        if ($event.target.composing) return;
        _vm.frequency = $event.target.value;
      }
    }
  }), _vm._v(" "), _c("error", {
    staticClass: "text-danger",
    attrs: {
      input: "frequency"
    }
  })], 1)]), _vm._v(" "), _c("div", {
    staticClass: "col-12"
  }, [_c("div", {
    staticClass: "input-group"
  }, [_c("div", {
    staticClass: "form-group"
  }, [_c("label", {
    attrs: {
      "for": "recording"
    }
  }, [_vm._v("Recording")]), _vm._v(" "), _c("div", {
    staticClass: "custom-file"
  }, [_c("input", {
    ref: "recording",
    staticClass: "custom-file-input",
    "class": {
      "is-invalid": this.$errors.has("recording")
    },
    attrs: {
      type: "file",
      id: "recording",
      disabled: _vm.submitting === true
    }
  }), _vm._v(" "), _c("label", {
    staticClass: "custom-file-label",
    attrs: {
      "for": "recording"
    }
  }, [_vm._v("Choose file")])]), _vm._v(" "), _c("error", {
    staticClass: "text-danger",
    attrs: {
      input: "recording"
    }
  })], 1)]), _vm._v(" "), _vm.submitting ? _c("div", {
    staticClass: "progress progress-xxs"
  }, [_c("div", {
    staticClass: "progress-bar progress-bar-danger progress-bar-striped",
    style: "width: " + _vm.uploadProgress + "%",
    attrs: {
      role: "progressbar",
      "aria-valuenow": _vm.uploadProgress,
      "aria-valuemin": "0",
      "aria-valuemax": "100"
    }
  }, [_c("span", {
    staticClass: "sr-only"
  }, [_vm._v(_vm._s(_vm.uploadProgress) + "% Complete")])])]) : _vm._e()])])]), _vm._v(" "), _c("div", {
    staticClass: "card-footer"
  }, [_c("input", {
    staticClass: "btn btn-primary float-right",
    attrs: {
      disabled: _vm.submitting === true,
      type: "submit",
      value: "Add Recording"
    },
    on: {
      click: _vm.uploadRecording
    }
  })])]) : _vm._e();
};
var staticRenderFns = [];
render._withStripped = true;


/***/ }),

/***/ "./resources/js/components/recording/stub/add.vue":
/*!********************************************************!*\
  !*** ./resources/js/components/recording/stub/add.vue ***!
  \********************************************************/
/***/ ((__unused_webpack_module, __webpack_exports__, __webpack_require__) => {

__webpack_require__.r(__webpack_exports__);
/* harmony export */ __webpack_require__.d(__webpack_exports__, {
/* harmony export */   "default": () => (__WEBPACK_DEFAULT_EXPORT__)
/* harmony export */ });
/* harmony import */ var _add_vue_vue_type_template_id_0e0c4eae_scoped_true___WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! ./add.vue?vue&type=template&id=0e0c4eae&scoped=true& */ "./resources/js/components/recording/stub/add.vue?vue&type=template&id=0e0c4eae&scoped=true&");
/* harmony import */ var _add_vue_vue_type_script_lang_js___WEBPACK_IMPORTED_MODULE_1__ = __webpack_require__(/*! ./add.vue?vue&type=script&lang=js& */ "./resources/js/components/recording/stub/add.vue?vue&type=script&lang=js&");
/* harmony import */ var _node_modules_vue_loader_lib_runtime_componentNormalizer_js__WEBPACK_IMPORTED_MODULE_2__ = __webpack_require__(/*! !../../../../../node_modules/vue-loader/lib/runtime/componentNormalizer.js */ "./node_modules/vue-loader/lib/runtime/componentNormalizer.js");





/* normalize component */
;
var component = (0,_node_modules_vue_loader_lib_runtime_componentNormalizer_js__WEBPACK_IMPORTED_MODULE_2__["default"])(
  _add_vue_vue_type_script_lang_js___WEBPACK_IMPORTED_MODULE_1__["default"],
  _add_vue_vue_type_template_id_0e0c4eae_scoped_true___WEBPACK_IMPORTED_MODULE_0__.render,
  _add_vue_vue_type_template_id_0e0c4eae_scoped_true___WEBPACK_IMPORTED_MODULE_0__.staticRenderFns,
  false,
  null,
  "0e0c4eae",
  null
  
)

/* hot reload */
if (false) { var api; }
component.options.__file = "resources/js/components/recording/stub/add.vue"
/* harmony default export */ const __WEBPACK_DEFAULT_EXPORT__ = (component.exports);

/***/ }),

/***/ "./resources/js/components/recording/stub/add.vue?vue&type=script&lang=js&":
/*!*********************************************************************************!*\
  !*** ./resources/js/components/recording/stub/add.vue?vue&type=script&lang=js& ***!
  \*********************************************************************************/
/***/ ((__unused_webpack_module, __webpack_exports__, __webpack_require__) => {

__webpack_require__.r(__webpack_exports__);
/* harmony export */ __webpack_require__.d(__webpack_exports__, {
/* harmony export */   "default": () => (__WEBPACK_DEFAULT_EXPORT__)
/* harmony export */ });
/* harmony import */ var _node_modules_babel_loader_lib_index_js_clonedRuleSet_5_use_0_node_modules_vue_loader_lib_index_js_vue_loader_options_add_vue_vue_type_script_lang_js___WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! -!../../../../../node_modules/babel-loader/lib/index.js??clonedRuleSet-5.use[0]!../../../../../node_modules/vue-loader/lib/index.js??vue-loader-options!./add.vue?vue&type=script&lang=js& */ "./node_modules/babel-loader/lib/index.js??clonedRuleSet-5.use[0]!./node_modules/vue-loader/lib/index.js??vue-loader-options!./resources/js/components/recording/stub/add.vue?vue&type=script&lang=js&");
 /* harmony default export */ const __WEBPACK_DEFAULT_EXPORT__ = (_node_modules_babel_loader_lib_index_js_clonedRuleSet_5_use_0_node_modules_vue_loader_lib_index_js_vue_loader_options_add_vue_vue_type_script_lang_js___WEBPACK_IMPORTED_MODULE_0__["default"]); 

/***/ }),

/***/ "./resources/js/components/recording/stub/add.vue?vue&type=template&id=0e0c4eae&scoped=true&":
/*!***************************************************************************************************!*\
  !*** ./resources/js/components/recording/stub/add.vue?vue&type=template&id=0e0c4eae&scoped=true& ***!
  \***************************************************************************************************/
/***/ ((__unused_webpack_module, __webpack_exports__, __webpack_require__) => {

__webpack_require__.r(__webpack_exports__);
/* harmony export */ __webpack_require__.d(__webpack_exports__, {
/* harmony export */   "render": () => (/* reexport safe */ _node_modules_babel_loader_lib_index_js_clonedRuleSet_5_use_0_node_modules_vue_loader_lib_loaders_templateLoader_js_ruleSet_1_rules_2_node_modules_vue_loader_lib_index_js_vue_loader_options_add_vue_vue_type_template_id_0e0c4eae_scoped_true___WEBPACK_IMPORTED_MODULE_0__.render),
/* harmony export */   "staticRenderFns": () => (/* reexport safe */ _node_modules_babel_loader_lib_index_js_clonedRuleSet_5_use_0_node_modules_vue_loader_lib_loaders_templateLoader_js_ruleSet_1_rules_2_node_modules_vue_loader_lib_index_js_vue_loader_options_add_vue_vue_type_template_id_0e0c4eae_scoped_true___WEBPACK_IMPORTED_MODULE_0__.staticRenderFns)
/* harmony export */ });
/* harmony import */ var _node_modules_babel_loader_lib_index_js_clonedRuleSet_5_use_0_node_modules_vue_loader_lib_loaders_templateLoader_js_ruleSet_1_rules_2_node_modules_vue_loader_lib_index_js_vue_loader_options_add_vue_vue_type_template_id_0e0c4eae_scoped_true___WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! -!../../../../../node_modules/babel-loader/lib/index.js??clonedRuleSet-5.use[0]!../../../../../node_modules/vue-loader/lib/loaders/templateLoader.js??ruleSet[1].rules[2]!../../../../../node_modules/vue-loader/lib/index.js??vue-loader-options!./add.vue?vue&type=template&id=0e0c4eae&scoped=true& */ "./node_modules/babel-loader/lib/index.js??clonedRuleSet-5.use[0]!./node_modules/vue-loader/lib/loaders/templateLoader.js??ruleSet[1].rules[2]!./node_modules/vue-loader/lib/index.js??vue-loader-options!./resources/js/components/recording/stub/add.vue?vue&type=template&id=0e0c4eae&scoped=true&");


/***/ })

}]);