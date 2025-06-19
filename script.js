function changeView() {
  var signUpBox = document.getElementById("signUpBox");
  var signInBox = document.getElementById("signInBox");

  signUpBox.classList.toggle("d-none");
  signInBox.classList.toggle("d-none");
}

function signup() {
  var f = document.getElementById("f");
  var l = document.getElementById("l");
  var e = document.getElementById("e");
  var p = document.getElementById("p");
  var m = document.getElementById("m");
  var g = document.getElementById("g");
  var signUpBox = document.getElementById("signUpBox");
  var signInBox = document.getElementById("signInBox");

  var form = new FormData();
  form.append("f", f.value);
  form.append("l", l.value);
  form.append("e", e.value);
  form.append("p", p.value);
  form.append("m", m.value);
  form.append("g", g.value);

  var request = new XMLHttpRequest();

  request.onreadystatechange = function () {
    if (request.readyState == 4) {
      var text = request.responseText;
      if (text == "Success") {
        signUpBox.classList.toggle("d-none");
        signInBox.classList.toggle("d-none");
      } else {
        document.getElementById("msg").innerHTML = text;
        document.getElementById("msgdiv").className = "d-block";
      }
    }
  };

  request.open("POST", "signUpProcess.php", true);
  request.send(form);
}

function signin() {
  var email = document.getElementById("email2");
  var password = document.getElementById("password2");
  var rememberme = document.getElementById("rememberme");

  var f = new FormData();
  f.append("e", email.value);
  f.append("p", password.value);
  f.append("r", rememberme.checked);

  var r = new XMLHttpRequest();

  r.onreadystatechange = function () {
    if (r.readyState == 4) {
      var t = r.responseText;
      if (t == "Success") {
        window.location = "home.php";
      } else {
        document.getElementById("msg2").innerHTML = t;
        document.getElementById("msgdiv2").className = "d-block";
        // document.getElementById("msg2").innerHTML = t;
      }
    }
  };

  r.open("POST", "signinprocess.php", true);
  r.send(f);
}

var bm;

function forgotpassword() {
  var email = document.getElementById("email2");

  var r = new XMLHttpRequest();

  r.onreadystatechange = function () {
    if (r.readyState == 4) {
      var t = r.responseText;
      if (t == "Success") {
        alert(
          "Verification code has sent to your email. Please check your inbox"
        );
        var m = document.getElementById("forgotpasswordmodel");
        bm = new bootstrap.Modal(m);
        bm.show();
      } else {
        alert(t);
      }
    }
  };

  r.open("GET", "forgotPasswordProcess.php?e=" + email.value, true);
  r.send();
}

function showPassword() {
  var i = document.getElementById("npi");
  var eye = document.getElementById("e1");

  if (i.type == "password") {
    i.type = "text";
    eye.className = "bi bi-eye-fill";
  } else {
    i.type = "password";
    eye.className = "bi bi-eye-slash-fill";
  }
}

function showPassword2() {
  var input = document.getElementById("rnp");
  var eye = document.getElementById("e2");

  if (input.type == "password") {
    input.type = "text";
    eye.className = "bi bi-eye-fill";
  } else {
    input.type = "password";
    eye.className = "bi bi-eye-slash-fill";
  }
}

function resetpw() {
  var email = document.getElementById("email2");
  var np = document.getElementById("npi");
  var rnp = document.getElementById("rnp");
  var vcode = document.getElementById("vc");

  var f = new FormData();
  f.append("e", email.value);
  f.append("n", np.value);
  f.append("r", rnp.value);
  f.append("v", vcode.value);

  var r = new XMLHttpRequest();

  r.onreadystatechange = function () {
    if (r.readyState == 4) {
      var t = r.responseText;
      if (t == "Success") {
        bm.hide();
        alert("Password reset success");
      } else {
        alert(t);
      }
    }
  };

  r.open("POST", "resetPassword.php", true);
  r.send(f);
}

function opensbar() {
  document.getElementById("mainsearch1").classList.add("d-none");
  document.getElementById("search1").classList.remove("d-none");
  document.getElementById("search1").classList.add("d-flex");
}

function remove() {
  document.getElementById("mainsearch1").classList.remove("d-none");
  document.getElementById("mainsearch1").classList.add("d-flex");
  document.getElementById("search1").classList.add("d-none");
  document.getElementById("search1").classList.remove("d-flex");
}

function addToCart(id) {
  var r = new XMLHttpRequest();

  r.onreadystatechange = function () {
    if (r.readyState == 4) {
      window.location.reload();
    }
  };

  r.open("GET", "addtoCartProcess.php?id=" + id, true);
  r.send();
}

function qty_inc(qty) {
  var input = document.getElementById("qty_input");

  if (parseInt(input.value) < qty) {
    var newValue = parseInt(input.value) + 1;
    input.value = newValue.toString();
  } else {
    alert("Maximum quantity has been reached");
    input.value = qty;
  }
}

function qty_dec() {
  var input = document.getElementById("qty_input");

  if (parseInt(input.value) > 1) {
    var newValue = parseInt(input.value) - 1;
    input.value = newValue.toString();
  } else {
    alert("Minimum quantity has been reached");
    input.value = 1;
  }
}

function deleteFromCart(id) {
  var r = new XMLHttpRequest();

  r.onreadystatechange = function () {
    if (r.readyState == 4) {
      window.location.reload();
    }
  };

  r.open("GET", "deleteFromCartProcess.php?id=" + id, true);
  r.send();
}

function basicSearch(x) {
  var txt = document.getElementById("basic_search_txt");

  var f = new FormData();
  f.append("t", txt.value);
  f.append("page", x);

  var r = new XMLHttpRequest();

  r.onreadystatechange = function () {
    if (r.readyState == 4) {
      document.getElementById("basicSearchResult").innerHTML = r.responseText;
    }
  };

  r.open("POST", "basicSearchProcess.php", true);
  r.send(f);
}

function changeImage() {
  var view = document.getElementById("viewImage");
  var file = document.getElementById("profileimg");

  file.onchange = function () {
    var file1 = this.files[0];
    var url = window.URL.createObjectURL(file1);
    view.src = url;
  };
}

function updateProfile() {
  var fname = document.getElementById("fname");
  var lname = document.getElementById("lname");
  var mobile = document.getElementById("mobile");
  var line1 = document.getElementById("line1");
  var line2 = document.getElementById("line2");
  var district = document.getElementById("district");
  var city = document.getElementById("city");
  var pcode = document.getElementById("pcode");
  var province = document.getElementById("province");
  var image = document.getElementById("profileimg");

  var f = new FormData();
  f.append("fn", fname.value);
  f.append("ln", lname.value);
  f.append("m", mobile.value);
  f.append("l1", line1.value);
  f.append("l2", line2.value);
  f.append("p", province.value);
  f.append("d", district.value);
  f.append("pc", pcode.value);
  f.append("c", city.value);

  if (image.files.length == 0) {
    var confirmation = confirm(
      "Are you sure you don't want to update Profile Image?"
    );

    if (confirmation) {
      alert("You have not selected any image.");
    }
  } else {
    f.append("image", image.files[0]);
  }


  var r = new XMLHttpRequest();

  r.onreadystatechange = function () {
    if (r.readyState == 4) {
      if (r.responseText == "Success") {
        window.location.reload();
      } else {
        alert(r.responseText);
      }
    }
  };


  r.open("POST", "updareProfileProcess.php", true);
  r.send(f);
}

function advancedSearch(x) {
  var color = document.getElementById("c");
  var size = document.getElementById("size");
  var from = document.getElementById("pf");
  var to = document.getElementById("pt");
  var sort = document.getElementById("s");
  var txt = document.getElementById("basic_search_txt");

  var f = new FormData();
  f.append("t", txt.value);
  f.append("col", color.value);
  f.append("size", size.value);
  f.append("pf", from.value);
  f.append("to", to.value);
  f.append("s", sort.value);
  f.append("page", x);

  var r = new XMLHttpRequest();

  r.onreadystatechange = function () {
    if (r.readyState == 4) {
      document.getElementById("basicSearchResult").innerHTML = r.responseText;
    }
  };

  r.open("POST", "advancedSearchProcess.php", true);
  r.send(f);
}

function addToWatchlist(id) {
  var r = new XMLHttpRequest();

  r.onreadystatechange = function () {
    if (r.readyState == 4) {
      var t = r.responseText;
      if (t == "removed") {
        document.getElementById("heart" + id).className = "text-dark"; // Fixed here
        window.location.reload();
      } else if (t == "added") {
        document.getElementById("heart" + id).className = "text-danger"; // Fixed here
        window.location.reload();
      } else {
        alert(t);
      }
    }
  };

  r.open("GET", "addToWatchlistProcess.php?id=" + id, true);
  r.send();
}

function changeStatus(id) {
  var product_id = id;

  var r = new XMLHttpRequest();

  r.onreadystatechange = function () {
    if (r.readyState == 4) {
      var t = r.responseText;

      if (t == "deactivated") {
        alert("Product Deactivated");
        window.location.reload();
      } else if (t == "activated") {
        alert("Product Activated");
        window.location.reload();
      } else {
        alert(t);
      }
    }
  };

  r.open("GET", "changeStatusProcess.php?p=" + product_id, true);
  r.send();
}

function sort1(x) {
  var search = document.getElementById("s");
  var time = "0";

  if (document.getElementById("n").checked) {
    time = "1";
  } else if (document.getElementById("o").checked) {
    time = "2";
  }

  var qty = "0";

  if (document.getElementById("h").checked) {
    qty = "1";
  } else if (document.getElementById("l").checked) {
    qty = "2";
  }

  var con = "0";

  if (document.getElementById("b").checked) {
    con = "1";
  } else if (document.getElementById("u").checked) {
    con = "2";
  }

  var f = new FormData();

  f.append("s", search.value);
  f.append("t", time);
  f.append("q", qty);
  f.append("c", con);
  f.append("page", x);

  var r = new XMLHttpRequest();

  r.onreadystatechange = function () {
    if (r.readyState == 4) {
      var t = r.responseText;

      document.getElementById("sort").innerHTML = t;
    }
  };

  r.open("POST", "sortProcess.php", true);
  r.send(f);
}

function sendID(id) {
  var r = new XMLHttpRequest();

  r.onreadystatechange = function () {
    if (r.readyState == 4) {
      var t = r.responseText;
      if (t == "Success") {
        window.location = "updateProduct.php";
      } else {
        alert(t);
      }
    }
  };

  r.open("GET", "sendProductIdProcess.php?id=" + id, true);
  r.send();
}

function changeProductImage() {
  const imageUploader = document.getElementById("imageuploader");
  const files = imageUploader.files;

  if (files.length > 3) {
      alert("Please select 3 or fewer images.");
      return;
  }

  for (let i = 0; i < 3; i++) {
      const preview = document.getElementById("i" + i);
      if (files[i]) {
          const fileURL = URL.createObjectURL(files[i]);
          preview.src = fileURL;
      } else {
          // Reset remaining previews if fewer than 3 images are uploaded
          preview.src = "resources/addImg.svg";
      }
  }
}

function addProduct() {
  var category = document.getElementById("category");
  var title = document.getElementById("title");
  var size = document.getElementById("size");
  var colour = document.getElementById("clr");
  var qty = document.getElementById("qty");
  var dwc = document.getElementById("dwc");
  var doc = document.getElementById("doc");
  var image = document.getElementById("imageuploader");
  var cost = document.getElementById("cost");
  var desc = document.getElementById("desc");

  var f = new FormData();

  f.append("ca", category.value);
  f.append("s", size.value);
  f.append("t", title.value);
  f.append("col", colour.value);
  f.append("qty", qty.value);
  f.append("cost", cost.value);
  f.append("dwc", dwc.value);
  f.append("doc", doc.value);
  f.append("desc", desc.value);

  var file_count = image.files.length;

  for (var x = 0; x < file_count; x++) {
    f.append("image" + x, image.files[x]);
  }

  var r = new XMLHttpRequest();

  r.onreadystatechange = function () {
    if (r.readyState == 4) {
      var t = r.responseText;
      if (t == "Product saved successfullyProduct Image Saved Successfully") {
        window.location.reload();
      } else {
        alert(t);
        window.location.reload();

      }
    }
  };

  r.open("POST", "addProductProcess.php", true);
  r.send(f);
}

function signout() {
  var r = new XMLHttpRequest();

  r.onreadystatechange = function () {
    if (r.readyState == 4) {
      var t = r.responseText;
      if (t == "Successs") {
        window.location.reload();
      } else {
        alert(t);
      }
    }
  };

  r.open("GET", "signoutProcess.php", true);
  r.send();
}

function deleteProduct(id) {
  var r = new XMLHttpRequest();

  r.onreadystatechange = function () {
    if (r.readyState == 4) {
      var t = r.responseText;
      if (t == "success") {
        window.location.reload();
      } else {
        alert(t);
      }
    }
  };

  r.open("GET", "deleteProductProcess.php?id=" + id, true);
  r.send();
}

function removeFromWatchlist(id) {
  var r = new XMLHttpRequest();

  r.onreadystatechange = function () {
    if (r.readyState == 4) {
      var t = r.responseText;
      if (t == "success") {
        window.location.reload();
      } else {
        alert(t);
      }
    }
  };

  r.open("GET", "RemoveWatchlistProcess.php?id=" + id, true);
  r.send();
}

function watchlistSearch(x) {
  var txt = document.getElementById("watchlist_txt");

  var f = new FormData();
  f.append("t", txt.value);
  f.append("page", x);

  var r = new XMLHttpRequest();

  r.onreadystatechange = function () {
    if (r.readyState == 4) {
      var t = r.responseText;
      document.getElementById("basicSearchResult").innerHTML = t;
    }
  };

  r.open("POST", "watchlistSearchProcess.php", true);
  r.send(f);
}

function deleteAdmin(id) {
  alert("OK");
  // var r = new XMLHttpRequest();

  // r.onreadystatechange = function () {
  //   if (r.readyState == 4) {
  //     var t = r.responseText;
  //     if (t == "success") {
  //       window.location.reload();
  //     } else {
  //       window.location.reload();
  //     }
  //   }
  // };

  // r.open("GET", "deleteFromManageusers.php?id=" + id, true);
  // r.send();
}

function loadMainImage(id) {
  var image = document.getElementById("productImg" + id).src;
  var main = document.getElementById("mainImg");
  main.style.backgroundImage = "url(" + image + ")";
}

function checkValue(qty) {
  var input = document.getElementById("qty_input");

  if (input.value <= 0) {
    alert("Quantity must be 1 or more");
    input.value = 1;
  } else if (input.value > qty) {
    alert("Maximum quantity achieved");
    input.value = qty;
  }
}

function qty_inc(qty) {
  var input = document.getElementById("qty_input");

  if (input.value < qty) {
    var newValue = parseInt(input.value) + 1;
    input.value = newValue.toString();
  } else {
    alert("Maximum quantity has achieved");
    input.value = qty;
  }
}

function qty_dec() {
  var input = document.getElementById("qty_input");

  if (input.value > 1) {
    var newValue = parseInt(input.value) - 1;
    input.value = newValue.toString();
  } else {
    alert("Minimum quantity has achieved");
    input.value = 1;
  }
}

// function payNow(id) {
//   var qty = document.getElementById("qty_input").value;

//   var r = new XMLHttpRequest();

//   r.onreadystatechange = function () {
//     if (r.readyState == 4) {
//       var t = r.responseText;
//       var obj = JSON.parse(t);

//       var mail = obj["mail"];
//       var amount = obj["amount"];

//       if (t == "1") {
//         alert("Please log in or sign up");
//         window.location = "index.php";
//       } else if (t == "2") {
//         alert("Please update your profile first");
//         window.location = "myProfile.php";
//       } else {
//         // Payment completed. It can be a successful failure.
//         payhere.onCompleted = function onCompleted(orderId) {
//           console.log("Payment completed. OrderID:" + orderId);

//           saveInvoice(orderId, id, mail, amount, qty);

//           hash = to_upper_case(md5("1222046" + orderId + amount + "LKR" + to_upper_case(md5("MjgzNTg5NTkyMTE5MjEyMjY1MzAxMDQ4NjA1MjA5MzAwOTAxNTIyMA=="))))
//           // Note: validate the payment and show success or failure page to the customer
//         };

//         // Payment window closed
//         payhere.onDismissed = function onDismissed() {
//           // Note: Prompt user to pay again or show an error page
//           console.log("Payment dismissed");
//         };

//         // Error occurred
//         payhere.onError = function onError(error) {
//           // Note: show an error page
//           console.log("Error:" + error);
//         };

//         // Put the payment variables here
//         var payment = {
//           "sandbox": true,
//           "merchant_id": "1222046", // Replace your Merchant ID
//           "return_url": "http://localhost/she/singleproductview.php?id" + id, // Important
//           "cancel_url": "http://localhost/she/singleproductview.php?id" + id, // Important
//           "notify_url": "http://sample.com/notify",
//           "order_id": obj["id"],
//           "items": obj["item"],
//           "amount": amount,
//           "currency": "LKR",
//           "hash":obj["hash"],
//           "first_name": obj["fname"],
//           "last_name": obj["lname"],
//           "email": mail,
//           "phone": obj["mobile"],
//           "address": obj["address"],
//           "city": obj["city"],
//           "country": "Sri Lanka",
//           "delivery_address": obj["address"],
//           "delivery_city": obj["city"],
//           "delivery_country": "Sri Lanka",
//           "custom_1": "",
//           "custom_2": "",
//         };

//         // Show the payhere.js popup, when "PayHere Pay" is clicked
//         // document.getElementById('payhere-payment').onclick = function (e) {
//         payhere.startPayment(payment);
//         // };
//       }
//     }
//   };

//   r.open("GET", "buyNowProcess.php?id=" + id + "&qty=" + qty, true);
//   r.send();
// }

// function payNow(id) {
//   var qty = document.getElementById("qty_input").value;

//   var r = new XMLHttpRequest();
//   r.onreadystatechange = function () {
//     if (r.readyState == 4) {
//       var t = r.responseText;
//       var obj = JSON.parse(t);

//       var mail = obj["mail"];
//       var amount = obj["amount"];

//       if (t == "1") {
//         alert("Please Log in or Sign up");
//         window.location = "index.php";
//       } else if (t == "2") {
//         alert("Please update your profile first");
//         window.location = "myProfile.php";
//       } else {
//         // Payment completed. It can be a successful failure.
//         payhere.onCompleted = function onCompleted(orderId) {
//           console.log("Payment completed. OrderID:" + orderId);

//           saveInvoice(orderId, id, mail, amount, qty);
//           // Note: validate the payment and show success or failure page to the customer

//           hash = to_upper_case(
//             md5(
//               "1227430" +
//                 orderId +
//                 amount +
//                 "LKR" +
//                 to_upper_case(
//                   md5("NTEzMTY5NjI2MjY4Njc1OTk2NTUyNTQ4NjY1NDMyNjk2Njc5MDE=")
//                 )
//             )
//           );
//         };

//         // Payment window closed
//         payhere.onDismissed = function onDismissed() {
//           // Note: Prompt user to pay again or show an error page
//           console.log("Payment dismissed");
//         };

//         // Error occurred
//         payhere.onError = function onError(error) {
//           // Note: show an error page
//           console.log("Error:" + error);
//         };

//         // Put the payment variables here
//         var payment = {
//           sandbox: true,
//           merchant_id: "1227430", // Replace your Merchant ID
//           return_url: "http://localhost/she/singleproductview.php?id=" + id, // Important
//           cancel_url: "http://localhost/she/singleproductview.php?id=" + id, // Important
//           notify_url: "http://sample.com/notify",
//           order_id: obj["id"],
//           items: obj["item"],
//           amount: amount,
//           currency: "LKR",
//           hash: obj["hash"], // *Replace with generated hash retrieved from backend
//           first_name: obj["fname"],
//           last_name: obj["lname"],
//           email: mail,
//           phone: obj["mobile"],
//           address: obj["address"],
//           city: obj["city"],
//           country: "Sri Lanka",
//           delivery_address: obj["address"],
//           delivery_city: obj["city"],
//           delivery_country: "Sri Lanka",
//           custom_1: "",
//           custom_2: "",
//         };

//         // Show the payhere.js popup, when "PayHere Pay" is clicked
//         // document.getElementById('payhere-payment').onclick = function(e) {
//         payhere.startPayment(payment);
//         // };
//       }
//     }
//   };

//   r.open("GET", "buyNowProcess.php?id=" + id + "&qty=" + qty, true);
//   r.send();
// }

function payments(id) {
  var qty = document.getElementById("qty_input").value;
  var r = new XMLHttpRequest();

  r.onreadystatechange = function () {
    if (r.readyState == 4) {
      var t = r.responseText;
      var obj = JSON.parse(t);

      var mail = obj["mail"];
      var amount = obj["amount"];
      // var qty = obj["amount"];
      var orderId = obj["id"];

      saveInvoice(orderId, id, mail, amount, qty);
    }
  };

  r.open("GET", "buyNowProcess.php?id=" + id + "&qty=" + qty, true);
  r.send();
}

function saveInvoice(orderId, id, mail, amount, qty) {
  var f = new FormData();
  f.append("o", orderId);
  f.append("i", id);
  f.append("m", mail);
  f.append("a", amount);
  f.append("q", qty);

  var r = new XMLHttpRequest();

  r.onreadystatechange = function () {
    if (r.readyState == 4) {
      var t = r.responseText;
      if (t == "1") {
        window.location = "invoice.php?id=" + orderId;
      } else {
        alert(t);
      }
    }
  };

  r.open("POST", "saveInvoice.php", true);
  r.send(f);
}

function PrintInvoice() {
  var body = document.body.innerHTML;
  var page = document.getElementById("page").innerHTML;
  document.body.innerHTML = page;
  window.print();
  document.body.innerHTML = body;
}

function PrintInvoice1() {
  var body = document.body.innerHTML;
  var page = document.getElementById("page1").innerHTML;
  document.body.innerHTML = page;
  window.print();
  document.body.innerHTML = body;
}

function PrintInvoice2() {
  var body = document.body.innerHTML;
  var page = document.getElementById("page2").innerHTML;
  document.body.innerHTML = page;
  window.print();
  document.body.innerHTML = body;
}

function PrintInvoice3() {
  var body = document.body.innerHTML;
  var page = document.getElementById("page3").innerHTML;
  document.body.innerHTML = page;
  window.print();
  document.body.innerHTML = body;
}

// function PrintInvoice4() {
//   var body = document.body.innerHTML;
//   var page = document.getElementById("page4").innerHTML;
//   document.body.innerHTML = page;
//   window.print();
//   document.body.innerHTML = body;
// }

function PrintInvoice4() {
  var body = document.body.innerHTML;
  var page = document.getElementById("page4").innerHTML;
  document.body.innerHTML = page;

  // Delay printing to allow time for the chart to render
  setTimeout(function () {
    window.print();
    document.body.innerHTML = body;
  }, 1000); // Adjust the delay as necessary
}

function shopSearch(x) {
  var txt = document.getElementById("t");
  var category = document.getElementById("c1");
  var colour = document.getElementById("c3");
  var size = document.getElementById("size");
  var sort = document.getElementById("s");

  var f = new FormData();
  f.append("t", txt.value);
  f.append("cat", category.value);
  f.append("col", colour.value);
  f.append("size", size.value);
  f.append("s", sort.value);
  f.append("page", x);

  var r = new XMLHttpRequest();

  r.onreadystatechange = function () {
    if (r.readyState == 4) {
      var t = r.responseText;
      document.getElementById("viewArea").innerHTML = t;
    }
  };

  r.open("POST", "shopSearchProcess.php", true);
  r.send(f);
}

function payNowCart(id) {
  alert(id);
  var qty = document.getElementById("qty_input").value;
  var r = new XMLHttpRequest();

  r.onreadystatechange = function () {
    if (r.readyState == 4) {
      var t = r.responseText;
      var obj = JSON.parse(t);

      var mail = obj["mail"];
      var amount = obj["amount"];

      if (t == "1") {
        alert("Please log in or sign up");
        window.location = "index.php";
      } else if (t == "2") {
        alert("Please update your profile first");
        window.location = "myProfile.php";
      } else {
        // Payment completed. It can be a successful failure.
        payhere.onCompleted = function onCompleted(orderId) {
          console.log("Payment completed. OrderID:" + orderId);

          saveInvoice(orderId, id, mail, amount, qty);

          // Note: validate the payment and show success or failure page to the customer
        };

        // Payment window closed
        payhere.onDismissed = function onDismissed() {
          // Note: Prompt user to pay again or show an error page
          console.log("Payment dismissed");
        };

        // Error occurred
        payhere.onError = function onError(error) {
          // Note: show an error page
          console.log("Error:" + error);
        };

        // Put the payment variables here
        var payment = {
          sandbox: true,
          merchant_id: "1221623", // Replace your Merchant ID
          return_url: "http://localhost/she/singleproductview.php?id" + id, // Important
          cancel_url: "http://localhost/she/singleproductview.php?id" + id, // Important
          notify_url: "http://sample.com/notify",
          order_id: obj["id"],
          items: obj["item"],
          amount: amount,
          currency: "LKR",
          first_name: obj["fname"],
          last_name: obj["lname"],
          email: mail,
          phone: obj["mobile"],
          address: obj["address"],
          city: obj["city"],
          country: "Sri Lanka",
          delivery_address: obj["address"],
          delivery_city: obj["city"],
          delivery_country: "Sri Lanka",
          custom_1: "",
          custom_2: "",
        };

        // Show the payhere.js popup, when "PayHere Pay" is clicked
        // document.getElementById('payhere-payment').onclick = function (e) {
        payhere.startPayment(payment);
        // };
      }
    }
  };

  r.open("GET", "buyNowProcessCart.php?id=" + id + "&qty=" + qty, true);
  r.send();
}

var av;

function adminVerification() {
  var email = document.getElementById("e");

  var f = new FormData();
  f.append("e", email.value);

  var r = new XMLHttpRequest();

  r.onreadystatechange = function () {
    if (r.readyState == 4) {
      var t = r.responseText;
      if (t == "Success") {
        var adminVerificationmodal =
          document.getElementById("verificationmodal");
        av = new bootstrap.Modal(adminVerificationmodal);
        av.show();
      } else {
        alert(t);
      }
    }
  };

  r.open("POST", "adminVerificationProcess.php", true);
  r.send(f);
}

function verify() {
  var vcode = document.getElementById("vcode").value;
  var r = new XMLHttpRequest();

  r.onreadystatechange = function () {
    if (r.readyState == 4) {
      var t = r.responseText;
      if (t == "success") {
        av.hide();
        window.location = "adminIndex.php";
      } else {
        alert(t);
      }
    }
  };

  r.open("GET", "adminIndex.php?v=" + vcode, true);
  r.send();
}

function userBlock(email) {
  var request = new XMLHttpRequest();

  request.onreadystatechange = function () {
    if (request.readyState == 4) {
      var txt = request.responseText;
      if (txt == "Blocked") {
        document.getElementById("ub" + email).innerHTML = "Unblock";
        document.getElementById("ub" + email).classList = "btn btn-success";
      } else if (txt == "Unblocked") {
        document.getElementById("ub" + email).innerHTML = "Block";
        document.getElementById("ub" + email).classList = "btn btn-danger";
      } else {
        alert(txt);
      }
    }
  };

  request.open("GET", "userBlockProcess.php?email=" + email, true);
  request.send();
}

function blockProduct(id) {
  var request = new XMLHttpRequest();

  request.onreadystatechange = function () {
    if (request.readyState == 4) {
      var txt = request.responseText;
      if (txt == "blocked") {
        document.getElementById("pb" + id).innerHTML = "Unblock";
        document.getElementById("pb" + id).classList = "btn btn-success";
      } else if (txt == "unblocked") {
        document.getElementById("pb" + id).innerHTML = "Block";
        document.getElementById("pb" + id).classList = "btn btn-danger";
      } else {
        alert(txt);
      }
    }
  };

  request.open("GET", "productBlockProcess.php?id=" + id, true);
  request.send();
}

var cm;
function addNewCategory() {
  var m = document.getElementById("addCategoryModal");
  cm = new bootstrap.Modal(m);
  cm.show();
}

var vc;
var e;
var n;
function verifyCategory() {
  var ncm = document.getElementById("addCategoryVerificationModal");
  vc = new bootstrap.Modal(ncm);

  e = document.getElementById("e").value;
  n = document.getElementById("n").value;

  var f = new FormData();
  f.append("email", e);
  f.append("name", n);

  var r = new XMLHttpRequest();

  r.onreadystatechange = function () {
    if (r.readyState == 4) {
      var t = r.responseText;
      if (t == "Success") {
        cm.hide();
        vc.show();
      } else {
        alert(t);
      }
    }
  };

  r.open("POST", "addNewCategoryProcess.php", true);
  r.send(f);
}

function saveCategory() {
  var txt = document.getElementById("txt").value;

  var f = new FormData();
  f.append("t", txt);
  f.append("e", e);
  f.append("n", n);

  var r = new XMLHttpRequest();

  r.onreadystatechange = function () {
    if (r.readyState == 4) {
      var t = r.responseText;
      if (t == "success") {
        vc.hide();
        window.location.reload();
      } else {
        alert(t);
      }
    }
  };

  r.open("POST", "SaveCategoryProcess.php", true);
  r.send(f);
}

function changeStatus1(id) {
  var r = new XMLHttpRequest();

  r.onreadystatechange = function () {
    if (r.readyState == 4) {
      var t = r.responseText;

      if (t == "1") {
        document.getElementById("btn" + id).innerHTML = "Packing";
        document.getElementById("btn" + id).classList =
          "btn btn-warning fw-bold mt-1 mb-1";
      } else if (t == "2") {
        document.getElementById("btn" + id).innerHTML = "Dispatch";
        document.getElementById("btn" + id).classList =
          "btn btn-info fw-bold mt-1 mb-1";
      } else if (t == "3") {
        document.getElementById("btn" + id).innerHTML = "Shipping";
        document.getElementById("btn" + id).classList =
          "btn btn-primary fw-bold mt-1 mb-1";
      } else if (t == "4") {
        document.getElementById("btn" + id).innerHTML = "Delivered";
        document.getElementById("btn" + id).classList =
          "btn bg-danger fw-bold mt-1 mb-1 disabled";
      } else {
        alert(t);
      }
    }
  };

  r.open("GET", "changeinvoiceStatusProcess.php?id=" + id, true);
  r.send();
}

function sendMessage() {
  var name = document.getElementById("name").value;
  var subject = document.getElementById("subject").value;
  var message = document.getElementById("message").value;

  var f = new FormData();
  f.append("n", name);
  f.append("s", subject);
  f.append("m", message);

  var r = new XMLHttpRequest();

  r.onreadystatechange = function () {
    if (r.readyState == 4) {
      var t = r.responseText;
      if (t == "success") {
        alert("Message has been Sent");
      } else {
        alert(t);
      }
    }
  };

  r.open("POST", "messageProcess.php", true);
  r.send(f);
}

var pm;
function viewProductModal(id) {
  var m = document.getElementById("viewProductModal" + id);
  pm = new bootstrap.Modal(m);
  pm.show();
}

var mm;
function viewMsgModal(email) {
  var m = document.getElementById("userMsgModal" + email);
  mm = new bootstrap.Modal(m);
  mm.show();
}

function viewMessages(email) {
  var r = new XMLHttpRequest();

  r.onreadystatechange = function () {
    if (r.readyState == 4) {
      var t = r.responseText;

      document.getElementById("chat_box").innerHTML = t;
      document.getElementById("chat_box").className = "d-block";
      document.getElementById("type").className = "d-block";
    }
  };

  r.open("GET", "viewMsgProcess.php?e=" + email, true);
  r.send();

  document.getElementById("empty").className = "d-none";
}

function send_msg() {
  var email = document.getElementById("rmail");
  var txt = document.getElementById("msg_txt").value;

  var f = new FormData();
  f.append("e", email.innerHTML);
  f.append("t", txt);

  var r = new XMLHttpRequest();

  r.onreadystatechange = function () {
    if (r.readyState == 4) {
      var t = r.responseText;
      if (t == "success") {
        document.getElementById("msg_txt").value = "";
        // document.getElementById("boxrece").className = "d-block";
        // document.getElementById("para").innerHTML = txt;
      } else {
        alert(t);
      }
    }
  };

  r.open("POST", "sendMsgProcess.php", true);
  r.send(f);
}

function viewMessages1(email) {
  document.getElementById("empty").className = "d-none";
  document.getElementById("chat_box").className = " d-block";
  document.getElementById("typemsg").className = " d-block";

  var r = new XMLHttpRequest();

  r.onreadystatechange = function () {
    if (r.readyState == 4) {
      var t = r.responseText;
      document.getElementById("chat_box").innerHTML = t;
      document.getElementById("chat_box").className = " d-block";
    }
  };

  r.open("GET", "viewMsgProcess1.php?e=" + email, true);
  r.send();
}

function send_msguser() {
  var txt = document.getElementById("msg_txt1");

  var f = new FormData();
  f.append("t", txt.value);

  var r = new XMLHttpRequest();

  r.onreadystatechange = function () {
    if (r.readyState == 4) {
      var t = r.responseText;
      if (t == "success") {
        document.getElementById("msg_txt1").value = "";
        // document.getElementById("para").innerHTML = "ok";
        // document.getElementById("boxrece").className = "d-block";
      }
    }
  };

  r.open("POST", "sendMsgProcess1.php", true);
  r.send(f);
}

function searchName() {
  var txt = document.getElementById("searchName");

  var f = new FormData();
  f.append("t", txt.value);

  var r = new XMLHttpRequest();

  r.onreadystatechange = function () {
    if (r.readyState == 4) {
      var t = r.responseText;
      // alert(t);
      document.getElementById("userName").innerHTML = t;
    }
  };

  r.open("POST", "searchNameProcess.php", true);
  r.send(f);
}

function startTime() {
  const today = new Date();
  let h = today.getHours();
  let m = today.getMinutes();
  let s = today.getSeconds();
  m = checkTime(m);
  s = checkTime(s);
  document.getElementById("txt").innerHTML = h + ":" + m + ":" + s;
  setTimeout(startTime, 1000);
}

function checkTime(i) {
  if (i < 10) {
    i = "0" + i;
  } // add zero in front of numbers < 10
  return i;
}
