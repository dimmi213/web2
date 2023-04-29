function del(Table) {
  if (confirm("Delete this item?")) {
    const itemID = document.getElementById("DID").value;
    window.location.href = "/Admin/"+Table+"/"+Table+"_Controller.php?action=delete&ID="+itemID;
  }
}
function Product_Details(Table) {
  const table = document.getElementById(Table);
  const ID = document.getElementById("DID");
  const name = document.getElementById("DName");
  const Price = document.getElementById("DPrice");
  const Category = document.getElementById("DCategory");
  const Brand = document.getElementById("DBrand");
  const Img = document.getElementById("Dproduct_img");
  const file = document.getElementById("default_img");
  const Des = document.getElementById("DDescription");
  $(table).on("click", "td", function () {
    var values = [];
    $.each($(this).siblings(), function () {
      values.push($(this).text());
    });
    ID.value = values[0];
    name.value = values[1];
    Price.value = values[2];
    Category.value = values[3];
    Brand.value = values[4];
    Des.value = values[5];
    file.value = values[6];
    Img.src = "image/" + values[6];
  });
}
function Size_Details(Table){
  const table = document.getElementById(Table);
  var id;
  $(table).on("click", "td", function () {
    var values = [];
    $.each($(this).siblings(), function () {
      values.push($(this).text());
    });
    const xmlhttp = new XMLHttpRequest();
    xmlhttp.onreadystatechange = function () {
      if (this.readyState == 4 && this.status == 200) {
        document.getElementById("size_form").innerHTML =
          this.responseText;
      }
    };
    xmlhttp.open("GET", "product/size_details.php?ID=" + values[0], true);
    xmlhttp.send();
    document.getElementById("QuantityModalLabel").innerHTML = values[1];
  });
}

function ChangeSize(Table){
  console.log("run")
  const table = document.getElementById(Table);
  const Quantity = document.getElementById("Quantity");
  $(table).on("click", "td", function () {
    var values = [];
    $.each($(this).siblings(), function () {
      values.push($(this).text());
    });
    console.log(values);
    Quantity.value=[2];
  });
}

function Displayimg(input, img) {
  const img_file = document.getElementById(input);
  const myimg = document.getElementById(img);
  console.log(img_file.value);
  myimg.src = "image/" + img_file.value.split(/(\\|\/)/g).pop();
}

function Order_Details(Table) {
  const table = document.getElementById(Table);
  const Customer_ID = document.getElementById("Customer_ID");
  const Order_ID = document.getElementById("Order_ID");
  const BuyDate = document.getElementById("BuyDate");
  const Status = document.getElementById("Status");
  $(table).on("click", "td", function () {
    var values = [];
    $.each($(this).siblings(), function () {
      values.push($(this).text());
    });
    document.getElementById("Order_Detail_modal").innerHTML ="Order ID: " + values[0];
    Order_ID.value = values[0];
    document.getElementById("DID").value = values[0];
    Customer_ID.value = values[1];
    BuyDate.value = values[2];
    Status.value = values[3];
    //get Order_Details
    const xmlhttp = new XMLHttpRequest();
    xmlhttp.onreadystatechange = function () {
      if (this.readyState == 4 && this.status == 200) {
        document.getElementById("Order_Details_tbl").innerHTML =
          this.responseText;
      }
    };
    console.log("OK");
    xmlhttp.open("GET", "Order/order_details.php?ID=" + values[0], true);
    xmlhttp.send();
  });
}
function getvaluefromtable(table){
  var $row = $(this).closest("tr"),       // Finds the closest row <tr> 
    $tds = $row.find("td");             // Finds all children <td> elements

$.each($tds, function() {               // Visits every single <td> element
    console.log($(this).text());        // Prints out the text within the <td>
});
}
function Account_Details(Table){
  const table = document.getElementById(Table);
  const ID = document.getElementById("DID");
  const Name = document.getElementById("DName");
  const Username = document.getElementById("DUsername");
  const Address = document.getElementById("DAddress");
  const Password = document.getElementById("DPassword");
  const Type = document.getElementById("DType");
  const Phone = document.getElementById("DPhone");
  const Status = document.getElementById("DStatus");
  $(table).on("click", "td", function () {
    var values = [];
    $.each($(this).siblings(), function () {
      values.push($(this).text());
    });
  ID.value = values[0];
  Username.value = values[1];
  Name.value = values[2];
  Phone.value = values[3];
  Address.value = values[4];
  Password.value = values[5];
  Type.value = values[6];
  Status.value = values[7];
});

}
function OrderSearch(url) {
  const fromdate = document.getElementById("fromdate");
  const todate = document.getElementById("todate");
  if ((fromdate.value = null)) alert("");
  const xmlhttp = new XMLHttpRequest();
  xmlhttp.onreadystatechange = function () {
    if (this.readyState == 4 && this.status == 200) {
      document.getElementById("orders").innerHTML = this.responseText;
    }
  };
  console.log("OK");
  xmlhttp.open("GET", "Order/order_details.php?ID=" + values[0], true);
  xmlhttp.send();
}
function test(){
  console.log("testOK")
}
function setAction(action_ID,action_group_ID){
  const status = document.getElementById(action_ID + "." + action_group_ID);
  console.log(status.id);
  console.log(status.checked);
  console.log("run");
  const xmlhttp = new XMLHttpRequest();
  xmlhttp.onreadystatechange = function () {
    if (this.readyState == 4 && this.status == 200) {
    }
  };
  console.log("OK");
  xmlhttp.open("GET", "Account/Acount_Action_Controller.php?action_ID=" + action_ID+"&action_group_ID="+action_group_ID + "&status="+status.checked, true);
  xmlhttp.send();

}

//sort by table header
// $('th').click(function(){
//   var table = $(this).parents('table').eq(0)
//   var rows = table.find('tr:gt(0)').toArray().sort(comparer($(this).index()))
//   this.asc = !this.asc
//   if (!this.asc){rows = rows.reverse()}
//   for (var i = 0; i < rows.length; i++){table.append(rows[i])}
// })
// function comparer(index) {
//   return function(a, b) {
//       var valA = getCellValue(a, index), valB = getCellValue(b, index)
//       return $.isNumeric(valA) && $.isNumeric(valB) ? valA - valB : valA.toString().localeCompare(valB)
//   }
// }
// function getCellValue(row, index){ return $(row).children('td').eq(index).text() }

