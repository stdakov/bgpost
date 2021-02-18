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
  if (items.length > 0) {
    $.each(items, function (index, item) {
      createElement(item);
    });
  } else {
    $("#table-box").hide();
    $("#no_item_alert").show();
  }

  $(".add-items").submit(function (event) {
    event.preventDefault();
    var itemNum = $("#tracking-item").val();
    var itemLink = $("#tracking-item-link").val();

    // if (
    //   true ||
    //   /^[R|r|C||c|E|e|V|v]{1}[a-zA-Z]{1}\d{9}[a-zA-Z]{2}$/.test(itemNum) ||
    //   /^[P|p]{1}[S|s]{1}.{11}$$/.test(itemNum)
    // ) {
    var trackingItem = LocalStorage.add(itemNum, itemLink, false);

    $("#tracking-item").val("");
    $("#tracking-item-link").val("");

    createElement(trackingItem);
    // } else {
    //   swal("Въведохте грешен номер!", "", "warning");
    // }
  });

  $(document).on("click", ".remove", function (e) {
    e.preventDefault();

    swal({
      title: "Изтрий пратката?",
      icon: "error",
      buttons: true,
      buttons: ["Не", "Да"],
      dangerMode: true,
    }).then((willDelete) => {
      if (willDelete) {
        var el = $(this);

        var tr = $(this).parents(".table_item");
        var nextEl = tr.next();
        if (nextEl.hasClass("footable-detail-row")) {
          nextEl.remove();
        }

        LocalStorage.remove(tr.data("item-id"));
        tr.remove();
      }
    });
  });

  $(document).on("click", "table tbody tr", function (e) {
    //e.preventDefault();
    // $("body")
    //   .find("#tracking-item-table")
    //   .find("tr")
    //   .each(function (index) {
    //     $(this).css("background-color", "#fff");
    //   });
    // $(this).css("background-color", "#e6e6e6");
  });

  function createElement(trackingItem) {
    $.ajax({
      url: "/api/v1/tracking?code=" + trackingItem.number + "&filter=last",
      dataType: "json",
      success: function (data) {
        var tdProductLink = "-";
        if (trackingItem.link !== "") {
          tdProductLink =
            '<a title="продукт" href=\'' +
            trackingItem.link +
            '\' target="_blank">продукт</a>';
        }
        var bgPostLink =
          '<a title="www.bgpost.bg" target="_blank" href="http://www.bgpost.bg/IPSWebTracking/IPSWeb_item_events.asp?itemid=' +
          trackingItem.number +
          '">история</a>';

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
          '            <td style="text-align: center">\n' +
          "                <button title=\"изтрий проследяването\" class='btn btn-sm btn-danger remove'>" +
          '<svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-trash" viewBox="0 0 16 16"><path d="M5.5 5.5A.5.5 0 0 1 6 6v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm2.5 0a.5.5 0 0 1 .5.5v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm3 .5a.5.5 0 0 0-1 0v6a.5.5 0 0 0 1 0V6z"/><path fill-rule="evenodd" d="M14.5 3a1 1 0 0 1-1 1H13v9a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V4h-.5a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1H6a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1h3.5a1 1 0 0 1 1 1v1zM4.118 4L4 4.059V13a1 1 0 0 0 1 1h6a1 1 0 0 0 1-1V4.059L11.882 4H4.118zM2.5 3V2h11v1h-11z"/></svg>' +
          "</button>\n" +
          "            </td>\n" +
          "        </tr>";

        table.append(element);
        $(".table").footable();
        $("#table-box").show();
        $("#no_item_alert").hide();
      },
    });
  }
});
