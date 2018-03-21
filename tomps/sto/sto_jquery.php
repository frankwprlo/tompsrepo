
function scJQGeneralAdd() {
  scLoadScInput('input:text.sc-js-input');
  scLoadScInput('input:password.sc-js-input');
  scLoadScInput('input:checkbox.sc-js-input');
  scLoadScInput('input:radio.sc-js-input');
  scLoadScInput('select.sc-js-input');
  scLoadScInput('textarea.sc-js-input');

} // scJQGeneralAdd

function scFocusField(sField) {
  var $oField = $('#id_sc_field_' + sField);

  if (0 == $oField.length) {
    $oField = $('input[name=' + sField + ']');
  }

  if (0 == $oField.length && document.F1.elements[sField]) {
    $oField = $(document.F1.elements[sField]);
  }

  if (false == scSetFocusOnField($oField) && $("#id_ac_" + sField).length > 0) {
    if (false == scSetFocusOnField($("#id_ac_" + sField))) {
      setTimeout(function() { scSetFocusOnField($("#id_ac_" + sField)); }, 500);
    }
  }
  else {
    setTimeout(function() { scSetFocusOnField($oField); }, 500);
  }
} // scFocusField

function scSetFocusOnField($oField) {
  if ($oField.length > 0 && $oField[0].offsetHeight > 0 && $oField[0].offsetWidth > 0 && !$oField[0].disabled) {
    $oField[0].focus();
    return true;
  }
  return false;
} // scSetFocusOnField

function scEventControl_init(iSeqRow) {
  scEventControl_data["ms_idsto_" + iSeqRow] = {"blur": false, "change": false, "autocomp": false, "original": ""};
  scEventControl_data["ms_witel_" + iSeqRow] = {"blur": false, "change": false, "autocomp": false, "original": ""};
  scEventControl_data["ms_datel_" + iSeqRow] = {"blur": false, "change": false, "autocomp": false, "original": ""};
  scEventControl_data["ms_kodesto_" + iSeqRow] = {"blur": false, "change": false, "autocomp": false, "original": ""};
  scEventControl_data["ms_namasto_" + iSeqRow] = {"blur": false, "change": false, "autocomp": false, "original": ""};
}

function scEventControl_active(iSeqRow) {
  if (scEventControl_data["ms_idsto_" + iSeqRow]["blur"]) {
    return true;
  }
  if (scEventControl_data["ms_idsto_" + iSeqRow]["change"]) {
    return true;
  }
  if (scEventControl_data["ms_witel_" + iSeqRow]["blur"]) {
    return true;
  }
  if (scEventControl_data["ms_witel_" + iSeqRow]["change"]) {
    return true;
  }
  if (scEventControl_data["ms_datel_" + iSeqRow]["blur"]) {
    return true;
  }
  if (scEventControl_data["ms_datel_" + iSeqRow]["change"]) {
    return true;
  }
  if (scEventControl_data["ms_kodesto_" + iSeqRow]["blur"]) {
    return true;
  }
  if (scEventControl_data["ms_kodesto_" + iSeqRow]["change"]) {
    return true;
  }
  if (scEventControl_data["ms_namasto_" + iSeqRow]["blur"]) {
    return true;
  }
  if (scEventControl_data["ms_namasto_" + iSeqRow]["change"]) {
    return true;
  }
  return false;
} // scEventControl_active

function scEventControl_active_all() {
  for (var i = 1; i < iAjaxNewLine; i++) {
    if (scEventControl_active(i)) {
      return true;
    }
  }
  return false;
} // scEventControl_active

function scEventControl_onFocus(oField, iSeq) {
  var fieldId, fieldName;
  fieldId = $(oField).attr("id");
  fieldName = fieldId.substr(12);
  scEventControl_data[fieldName]["blur"] = true;
  if ("ms_witel_" + iSeq == fieldName) {
    scEventControl_data[fieldName]["blur"] = false;
  }
  if ("ms_datel_" + iSeq == fieldName) {
    scEventControl_data[fieldName]["blur"] = false;
  }
  scEventControl_data[fieldName]["change"] = false;
} // scEventControl_onFocus

function scEventControl_onBlur(sFieldName) {
  scEventControl_data[sFieldName]["blur"] = false;
  if (scEventControl_data[sFieldName]["change"]) {
        if (scEventControl_data[sFieldName]["original"] == $("#id_sc_field_" + sFieldName).val()) {
          scEventControl_data[sFieldName]["change"] = false;
        }
  }
} // scEventControl_onBlur

function scEventControl_onChange(sFieldName) {
  scEventControl_data[sFieldName]["change"] = false;
} // scEventControl_onChange

function scEventControl_onAutocomp(sFieldName) {
  scEventControl_data[sFieldName]["autocomp"] = false;
} // scEventControl_onChange

var scEventControl_data = {};

function scJQEventsAdd(iSeqRow) {
  $('#id_sc_field_ms_kodesto_' + iSeqRow).bind('blur', function() { sc_sto_ms_kodesto__onblur(this, iSeqRow) })
                                         .bind('change', function() { sc_sto_ms_kodesto__onchange(this, iSeqRow) })
                                         .bind('focus', function() { sc_sto_ms_kodesto__onfocus(this, iSeqRow) });
  $('#id_sc_field_ms_namasto_' + iSeqRow).bind('blur', function() { sc_sto_ms_namasto__onblur(this, iSeqRow) })
                                         .bind('change', function() { sc_sto_ms_namasto__onchange(this, iSeqRow) })
                                         .bind('focus', function() { sc_sto_ms_namasto__onfocus(this, iSeqRow) });
  $('#id_sc_field_ms_idsto_' + iSeqRow).bind('blur', function() { sc_sto_ms_idsto__onblur(this, iSeqRow) })
                                       .bind('change', function() { sc_sto_ms_idsto__onchange(this, iSeqRow) })
                                       .bind('focus', function() { sc_sto_ms_idsto__onfocus(this, iSeqRow) });
  $('#id_sc_field_ms_datel_' + iSeqRow).bind('blur', function() { sc_sto_ms_datel__onblur(this, iSeqRow) })
                                       .bind('change', function() { sc_sto_ms_datel__onchange(this, iSeqRow) })
                                       .bind('focus', function() { sc_sto_ms_datel__onfocus(this, iSeqRow) });
  $('#id_sc_field_ms_witel_' + iSeqRow).bind('blur', function() { sc_sto_ms_witel__onblur(this, iSeqRow) })
                                       .bind('change', function() { sc_sto_ms_witel__onchange(this, iSeqRow) })
                                       .bind('focus', function() { sc_sto_ms_witel__onfocus(this, iSeqRow) });
} // scJQEventsAdd

function sc_sto_ms_kodesto__onblur(oThis, iSeqRow) {
  do_ajax_sto_validate_ms_kodesto_(iSeqRow);
  scCssBlur(oThis, iSeqRow);
}

function sc_sto_ms_kodesto__onchange(oThis, iSeqRow) {
  nm_check_insert(iSeqRow);
}

function sc_sto_ms_kodesto__onfocus(oThis, iSeqRow) {
  scEventControl_onFocus(oThis, iSeqRow);
  scCssFocus(oThis, iSeqRow);
}

function sc_sto_ms_namasto__onblur(oThis, iSeqRow) {
  do_ajax_sto_validate_ms_namasto_(iSeqRow);
  scCssBlur(oThis, iSeqRow);
}

function sc_sto_ms_namasto__onchange(oThis, iSeqRow) {
  nm_check_insert(iSeqRow);
}

function sc_sto_ms_namasto__onfocus(oThis, iSeqRow) {
  scEventControl_onFocus(oThis, iSeqRow);
  scCssFocus(oThis, iSeqRow);
}

function sc_sto_ms_idsto__onblur(oThis, iSeqRow) {
  do_ajax_sto_validate_ms_idsto_(iSeqRow);
  scCssBlur(oThis, iSeqRow);
}

function sc_sto_ms_idsto__onchange(oThis, iSeqRow) {
  nm_check_insert(iSeqRow);
}

function sc_sto_ms_idsto__onfocus(oThis, iSeqRow) {
  scEventControl_onFocus(oThis, iSeqRow);
  scCssFocus(oThis, iSeqRow);
}

function sc_sto_ms_datel__onblur(oThis, iSeqRow) {
  do_ajax_sto_validate_ms_datel_(iSeqRow);
  scCssBlur(oThis, iSeqRow);
}

function sc_sto_ms_datel__onchange(oThis, iSeqRow) {
  nm_check_insert(iSeqRow);
}

function sc_sto_ms_datel__onfocus(oThis, iSeqRow) {
  scEventControl_onFocus(oThis, iSeqRow);
  scCssFocus(oThis, iSeqRow);
}

function sc_sto_ms_witel__onblur(oThis, iSeqRow) {
  do_ajax_sto_validate_ms_witel_(iSeqRow);
  scCssBlur(oThis, iSeqRow);
}

function sc_sto_ms_witel__onchange(oThis, iSeqRow) {
  do_ajax_sto_refresh_ms_witel_(iSeqRow);
  nm_check_insert(iSeqRow);
}

function sc_sto_ms_witel__onfocus(oThis, iSeqRow) {
  scEventControl_onFocus(oThis, iSeqRow);
  scCssFocus(oThis, iSeqRow);
}

function scResetPagesDisplay() {
        $(".sc-form-page").show();
}

function scHidePage(pageNo) {
        $("#id_sto_form" + pageNo).hide();
}

function scCheckNoPageSelected() {
        if (!$(".sc-form-page").filter(".scTabActive").filter(":visible").length) {
                var inactiveTabs = $(".sc-form-page").filter(".scTabInactive").filter(":visible");
                if (inactiveTabs.length) {
                        var tabNo = $(inactiveTabs[0]).attr("id").substr(11);
                }
        }
}
function scJQUploadAdd(iSeqRow) {
} // scJQUploadAdd


function scJQElementsAdd(iLine) {
  scJQEventsAdd(iLine);
  scEventControl_init(iLine);
  scJQUploadAdd(iLine);
} // scJQElementsAdd

