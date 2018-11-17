function isCheckUsername() {
  //   console.log("ok");
  var msg = document.getElementById("msg_username");
  var dn = document.getElementsByName("dangnhap");
  if (dn[0].value === "") {
    msg.innerText = "";
    return;
  }
  if (dn[0].value !== "") {
    var isVal = /^[A-Za-z][A-Za-z0-9]{5,14}$/.test(dn[0].value);
    if (isVal) {
      if (window.XMLHttpRequest) {
        // code for IE7+, Firefox, Chrome, Opera, Safari
        xmlhttp = new XMLHttpRequest();
      } else {
        // code for IE6, IE5
        xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
      }
      xmlhttp.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {
          msg.innerHTML = this.responseText;
        }
      };
      xmlhttp.open("GET", "checkusername.php?username=" + dn[0].value, true);
      xmlhttp.send();
    } else {
      msg.innerText =
        "Tên đăng nhập bắt đầu phải là chữ cái, theo sau có thể là chữ cái hoặc là số; dài từ 6 đến 15 ký tự.";
    }
  }
}

// is check mk
function ischeckmk() {
  //   console.log("ok");
  var msg = document.getElementById("msg_password");
  var mk = document.getElementsByName("matkhau");
  if (mk[0].value === "") {
    msg.innerText = "";
    return;
  }
  if (mk[0].value !== "") {
    var isVal = /^(?=.*?[A-Za-z])(?=.*?[0-9]).{6,15}$/.test(mk[0].value);
    console.log(isVal);
    if (isVal) {
      msg.innerText = "";
      return;
    } else {
      msg.innerText =
        "Mật khẩu phải có cả chữ cái và số, k được có ký tự khác ngoài chữ cái và số; dài từ 6 đến 15 ký tự";
    }
  }
}
function ischeckmk2() {
  //   console.log("ok");
  var msg = document.getElementById("msg_password2");
  var mk2 = document.getElementsByName("matkhau2");
  var mk1 = document.getElementsByName("matkhau");
  if (mk2[0].value === mk1[0].value) {
    msg.innerText = "";
    return;
  } else {
    msg.innerText = "Mật khẩu khong khop";
  }
}

// show detail product
function showDetail(value) {
  //   console.log("ok");
  var showsp = document.getElementById("showsp");
  if (value === "") {
    showsp.innerText = "";
    return;
  }
  if (window.XMLHttpRequest) {
    // code for IE7+, Firefox, Chrome, Opera, Safari
    xmlhttp = new XMLHttpRequest();
  } else {
    // code for IE6, IE5
    xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
  }
  xmlhttp.onreadystatechange = function() {
    if (this.readyState == 4 && this.status == 200) {
      showsp.innerHTML = this.responseText;
    }
  };
  xmlhttp.open("GET", "product-detail.php?id=" + value, true);
  xmlhttp.send();
}

// show image
function showImg(value) {
  //   console.log(value);

  var showImg = document.getElementById(`showImg${value}`);
  if (value === "") {
    showImg.innerText = "";
    return;
  }
  if (window.XMLHttpRequest) {
    // code for IE7+, Firefox, Chrome, Opera, Safari
    xmlhttp = new XMLHttpRequest();
  } else {
    // code for IE6, IE5
    xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
  }
  xmlhttp.onreadystatechange = function() {
    if (this.readyState == 4 && this.status == 200) {
      showImg.innerHTML = this.responseText;
    }
  };
  xmlhttp.open("GET", "product-image.php?id=" + value, true);
  xmlhttp.send();
}

function removeImg(value) {
  var showImg = document.getElementById(`showImg${value}`);
  showImg.innerText = "";
}

// search product
function searchProduct(value) {
  var datalist = document.getElementById("datalist");
  if (value === "") {
    datalist.innerText = "";
    return;
  }
  if (window.XMLHttpRequest) {
    // code for IE7+, Firefox, Chrome, Opera, Safari
    xmlhttp = new XMLHttpRequest();
  } else {
    // code for IE6, IE5
    xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
  }
  xmlhttp.onreadystatechange = function() {
    if (this.readyState == 4 && this.status == 200) {
      datalist.innerHTML = this.responseText;
    }
  };
  xmlhttp.open("GET", "product-title.php?search=" + value, true);
  xmlhttp.send();
}
