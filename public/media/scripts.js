"use strict";

var LocalStorage = new (function () {
  this.storageSpace = "";
  this.data = [];

  this.init = function (localStorageSpage) {
    this.storageSpace = localStorageSpage;
  };

  this.store = function () {
    localStorage.setItem(this.storageSpace, JSON.stringify(this.data));
  };

  this.getAll = function () {
    var localStorageData = JSON.parse(localStorage.getItem(this.storageSpace));
    if (localStorageData !== null) {
      this.data = localStorageData;
    }
    return this.data;
  };

  this.add = function (tracking_number, product_link, done) {
    var id = 0;
    if (this.data.length > 0) {
      $.each(this.data, function (index, item) {
        if (id < item.id) {
          id = item.id;
        }
      });
    }
    var trackingItem = {
      id: id + 1,
      number: tracking_number,
      link: product_link,
      done: done,
    };
    this.data.push(trackingItem);
    this.store();

    return trackingItem;
  };

  this.remove = function (id) {
    var indexItem = -1;
    $.each(this.data, function (index, item) {
      if (id === item.id) {
        indexItem = index;
        return false; //break
      }
    });
    if (indexItem > -1 && indexItem < this.data.length) {
      this.data.splice(indexItem, 1);
      this.store();
    }
  };
})();

$(document).ready(function () {
  LocalStorage.init("bgPostItems");
  var items = LocalStorage.getAll();

  $.each(items, function (index, item) {
    createElement(item);
  });

  $(".add-items").submit(function (event) {
    event.preventDefault();
    var itemNum = $("#tracking-item").val();
    var itemLink = $("#tracking-item-link").val();

    var trackingItem = LocalStorage.add(itemNum, itemLink, false);

    $("#tracking-item").val("");
    $("#tracking-item-link").val("");

    createElement(trackingItem);
  });

  $(document).on("click", ".remove", function (e) {
    e.preventDefault();

    swal({
      title: "Изтрий пратката?",
      icon: "warning",
      buttons: true,
      buttons: ["Не", "Да"],
      dangerMode: true,
    }).then((willDelete) => {
      if (willDelete) {
        var el = $(this);
        var tr = $(this).parents(".table_item");

        LocalStorage.remove(tr.data("item-id"));
        tr.remove();
      }
    });
  });

  function createElement(trackingItem) {
    $.ajax({
      url: "/api/v1/tracking?code=" + trackingItem.number + "&filter=last",
      dataType: "json",
      success: function (data) {
        var tdProductLink = "-";
        if (trackingItem.link !== "") {
          tdProductLink =
            '<a title="към продукта" href=\'' +
            trackingItem.link +
            '\' target="_blank">link</a>';
        }
        var bgPostLink =
          '<a title="www.bgpost.bg" target="_blank" href="http://www.bgpost.bg/IPSWebTracking/IPSWeb_item_events.asp?itemid=' +
          trackingItem.number +
          '">link</a>';

        var trackStatus = "tracking_no_info";
        var trackEvent = "Няма информация за пратката";
        var trackDate = "-";

        if (typeof data.event !== "undefined") {
          trackEvent = data.event;
        }

        if (typeof data.date !== "undefined") {
          trackDate = data.date;
        }

        if (typeof data.status !== "undefined") {
          switch (data.status) {
            case "arrived":
              trackStatus = "tracking_completed";
              break;
            case "traveling_bg":
              trackStatus = "tracking_in_bg";
              break;
            case "traveling":
              trackStatus = "tracking_travel";
              break;
          }
        }

        var table = $("body").find("#tracking-item-table");
        var itemNumber = table.find("tr").length + 1;
        var element =
          '<tr class="table_item ' +
          trackStatus +
          '" data-item-id="' +
          trackingItem.id +
          '">\n' +
          "            <td class='item_num'>" +
          itemNumber +
          "</td>\n" +
          '            <td class="tracking_number">' +
          trackingItem.number +
          "</td>\n" +
          "            <td>(" +
          data.country +
          ") " +
          data.location +
          "</td>\n" +
          '            <td class="track_status">' +
          trackEvent +
          "</td>\n" +
          "            <td>" +
          trackDate +
          "</td>\n" +
          "            <td>" +
          tdProductLink +
          "</td>\n" +
          "            <td>" +
          bgPostLink +
          "</td>\n" +
          "            <td>\n" +
          "                <button title=\"изтрий проследяването\" class='btn btn-danger remove'>x</button>\n" +
          "            </td>\n" +
          "        </tr>";

        table.append(element);
      },
    });
  }
});
