"use strict";

function _toConsumableArray(arr) { return _arrayWithoutHoles(arr) || _iterableToArray(arr) || _nonIterableSpread(); }

function _nonIterableSpread() { throw new TypeError("Invalid attempt to spread non-iterable instance"); }

function _iterableToArray(iter) { if (Symbol.iterator in Object(iter) || Object.prototype.toString.call(iter) === "[object Arguments]") return Array.from(iter); }

function _arrayWithoutHoles(arr) { if (Array.isArray(arr)) { for (var i = 0, arr2 = new Array(arr.length); i < arr.length; i++) { arr2[i] = arr[i]; } return arr2; } }

var jquery = require("jquery");

window.$ = window.jQuery = jquery;

require("jquery-ui-dist/jquery-ui.js");

$(".item-list").sortable({
  connectWith: '.item-list'
});
$(".item-list").disableSelection();

var readResults = function readResults() {
  var lists = _toConsumableArray(document.getElementsByClassName('item-list'));

  var items = [];
  lists.forEach(function (list) {
    var draggables = list.getElementsByClassName('draggable');

    for (var i = 1; i <= draggables.length; i++) {
      items.push({
        id: draggables[i - 1].id,
        text: draggables[i - 1].innerHTML,
        list_id: list.id,
        position: i
      });
    }
  });
  return items;
};

var save = function save() {
  var items, body;
  return regeneratorRuntime.async(function save$(_context) {
    while (1) {
      switch (_context.prev = _context.next) {
        case 0:
          items = readResults();
          body = JSON.stringify(items);
          $.ajax({
            url: '/list',
            method: 'post',
            dataType: 'json',
            data: {
              items: body
            },
            success: function success(res) {
              if (res.errors && res.errors.length > 0) {
                res.errors.forEach(function (err) {
                  document.getElementsByClassName('error-message')[0].innerHTML += err + '<br>';
                });
                return;
              }

              document.getElementsByClassName('error-message')[0].innerHTML = 'Lists Successfully saved';
            },
            fail: function fail(res) {
              document.getElementsByClassName('error-message')[0].innerHTML = 'Unexpected error';
            }
          });

        case 3:
        case "end":
          return _context.stop();
      }
    }
  });
};

$('#save_lists').on('click', function () {
  save();
});