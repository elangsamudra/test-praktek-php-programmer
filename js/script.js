function pagination(totalpages, currentpage) {
  var pagelist = "";
  if (totalpages > 1) {
    currentpage = parseInt(currentpage);
    pagelist += `<ul class="pagination justify-content-center">`;
    const prevClass = currentpage == 1 ? "disabled" : "";
    pagelist += `<li class="page-item${prevClass}"><a class="page-link" href="#" data-page="${
      currentpage - 1
    }">Previous</a></li>`;
    for (let p = 1; p <= totalpages; p++) {
      const activeClass = currentpage == p ? "active" : "";
      pagelist += `<li class="page-item${activeClass}"><a class="page-link" href="#" data-page="${p}">${p}</a></li>`;
    }
    const nextClass = currentpage == totalpages ? "disabled" : "";
    pagelist += `<li class="page-item${nextClass}"><a class="page-link" href="#" data-page="${
      currentpage + 1
    }">Next</a></li>`;
    pagelist += `</ul>`;
  }

  $("#pagination").html(pagelist);
}

// // get player row
function getbarangrow(barangg) {
  var barangRow = "";
  if (barangg) {
    const userphoto = barangg.photo ? barangg.photo : "default.png";
    barangRow = `<tr>
            <td class="align-middle"><img src="uploads/${barangg.photo}" class="img-thumbnail rounded float-left"></td>
            <td class="align-middle">${barangg.nama_barang}</td>
            <td class="align-middle">${barangg.harga_beli}</td>
            <td class="align-middle">${barangg.harga_jual}</td>
            <td class="align-middle">${barangg.stok}</td>
            <td class="align-middle">
              <a href="#" class="btn btn-success mr-3 detail" data-toggle="modal" data-target="#userViewModal"
                title="Detail" data-id="${barangg.id}"><i class="bx bx-detail" aria-hidden="true"></i></a>
              <a href="#" class="btn btn-warning mr-3 edituser" data-toggle="modal" data-target="#userModal"
                title="Edit" data-id="${barangg.id}"><i class="bx bx-edit"></i></a>
              <a href="#" class="btn btn-danger deleteuser" data-userid="14" title="Delete" data-id="${barangg.id}"><i
                  class="bx bx-trash"></i></a>
            </td>
          </tr>`;
  }
  return barangRow;
}

function getbarang() {
  var pageno = $("#currentpage").val();
  $.ajax({
    url: "/Test_Praktek_PHP_Programmer/ajax.php",
    type: "GET",
    dataType: "json",
    data: { page: pageno, action: "getusers" },
    beforeSend: function () {
      $("#overlay").fadeIn();
    },
    success: function (rows) {
      console.log(rows);
      if (rows.barang) {
        var baranglist = "";
        $.each(rows.barang, function (index, barangg) {
          baranglist += getbarangrow(barangg);
        });
        $("#userstable tbody").html(baranglist);
        let totalBarang = rows.count;
        let totalpages = Math.ceil(parseInt(totalBarang) / 4);
        const currentpage = $("#currentpage").val();
        pagination(totalpages, currentpage);
        $("#overlay").fadeOut();
      }
    },
    error: function () {
      console.log("something went wrong");
    },
  });
}

$(document).ready(function () {
  // add/edit user
  $(document).on("submit", "#addform", function (event) {
    event.preventDefault();
    var alertmsg =
      $("#userid").val().length > 0
        ? "Item has been updated Successfully!"
        : "New Item has been added Successfully!";
    $.ajax({
      url: "/Test_Praktek_PHP_Programmer/ajax.php",
      type: "POST",
      dataType: "json",
      data: new FormData(this),
      processData: false,
      contentType: false,
      beforeSend: function () {
        console.log("wait...");
        $("#overlay").fadeIn();
      },
      success: function (response) {
        console.log(response);
        if (response) {
          $("#userModal").modal("hide");
          $("#addform")[0].reset();
          $(".message").html(alertmsg).fadeIn().delay(3000).fadeOut();
          getbarang();
          $("#overlay").fadeOut();
        }
      },
      error: function () {
        // console.log("Oops! Something went wrong!");
      },
    });
  });

  $(document).on("click", "ul.pagination li a", function (e) {
    e.preventDefault();
    var $this = $(this);
    const pagenum = $this.data("page");
    $("#currentpage").val(pagenum);
    getbarang();
    $this.parent().siblings().removeClass("active");
    $this.parent().addClass("active");
  });

  $(document).on("click", "#addnewbtn", function () {
    $("#addform")[0].reset();
    $("#userid").val("");
  });

  $(document).on("click", "a.edituser", function () {
    var pid = $(this).data("id");

    $.ajax({
      url: "/Test_Praktek_PHP_Programmer/ajax.php",
      type: "GET",
      dataType: "json",
      data: { id: pid, action: "getuser" },
      beforeSend: function () {
        $("#overlay").fadeIn();
      },
      success: function (barangg) {
        if (barangg) {
          $("#nama_barang").val(barangg.nama_barang);
          $("#harga_beli").val(barangg.harga_beli);
          $("#harga_jual").val(barangg.harga_jual);
          $("stok").val(barangg.stok);
          $("#userid").val(barangg.id);
        }
        $("#overlay").fadeOut();
      },
      error: function () {
        console.log("something went wrong");
      },
    });
  });

  $(document).on("click", "a.deleteuser", function (e) {
    e.preventDefault();
    var pid = $(this).data("id");
    if (confirm("Are you sure want to delete this?")) {
      $.ajax({
        url: "/Test_Praktek_PHP_Programmer/ajax.php",
        type: "GET",
        dataType: "json",
        data: { id: pid, action: "deleteuser" },
        beforeSend: function () {
          $("#overlay").fadeIn();
        },
        success: function (res) {
          if (res.deleted == 1) {
            $(".message")
              .html("Item has been deleted successfully!")
              .fadeIn()
              .delay(3000)
              .fadeOut();
            getbarang();
            $("#overlay").fadeOut();
          }
        },
        error: function () {
          console.log("something went wrong");
        },
      });
    }
  });

  $(document).on("click", "a.detail", function () {
    var pid = $(this).data("id");

    $.ajax({
      url: "/Test_Praktek_PHP_Programmer/ajax.php",
      type: "GET",
      dataType: "json",
      data: { id: pid, action: "getuser" },
      success: function (barangg) {
        if (barangg) {
          const userphoto = barangg.photo ? barangg.photo : "default.png";
          const detail = `<div class="row">
          <div class="col-sm-6 col-md-4">
              <img src="uploads/${userphoto}" class="rounded responsive" />
          </div>
          <div class="col-sm-6 col-md-8">
              <h4 class="text-primary">${barangg.nama_barang}</h4>
              <p class="text-secondary">
              <i class="bx bx-purchase-tag" aria-hidden="true"></i> ${barangg.harga_beli}
              <br />
              <i class="bx bxs-purchase-tag" aria-hidden="true"></i> ${barangg.harga_jual}
              <br />
              <i class="bx bx-check" aria-hidden="true"></i> ${barangg.stok}
              </p>
              <!-- Split button -->
          </div>
      </div>`;
          $("#detail").html(detail);
        }
      },
      error: function () {
        console.log("something went wrong");
      },
    });
  });

  $("#searchinput").on("keyup", function () {
    const searchText = $(this).val();
    if (searchText.length > 1) {
      $.ajax({
        url: "/Test_Praktek_PHP_Programmer/ajax.php",
        type: "GET",
        dataType: "json",
        data: { searchQuery: searchText, action: "search" },
        success: function (barang) {
          if (barang) {
            var baranglist = "";
            $.each(barang, function (index, barangg) {
              baranglist += getbarangrow(barangg);
            });
            $("#userstable tbody").html(baranglist);
            $("#pagination").hide();
            $("#overlay").fadeOut();
          }
        },
        error: function () {
          console.log("something went wrong");
        },
      });
    } else {
      getbarang();
      $("#pagination").show();
    }
  });

  getbarang();
});
