    // Sidebar
  
    let sidebar = document.querySelector(".sidebar");
    let sidebarBtn = document.querySelector(".sidebarBtn");
    sidebarBtn.onclick = function () {
      sidebar.classList.toggle("active");
      if (sidebar.classList.contains("active")) {
        sidebarBtn.classList.replace("bx-menu", "bx-menu-alt-right");
      } else
        sidebarBtn.classList.replace("bx-menu-alt-right", "bx-menu");
    }
    // Sidebar Function End
    
    // Table Show GET
    
    const tableBody = document.querySelector("#tbody");
    const url = "https://salixv3qa.radiusdirect.net/coreapi/v2/notesTasksCatList?category_type=notes";
    
    var Notes = document.getElementById("category_title");
    var Notes = document.getElementById("category_type");
    var Notes = document.getElementById("active_status");
    var dataTym = document.getElementById("createdAt");
    var Notes = document.getElementById("delete_status");
    var idNum = document.getElementById("id");
    var CategoryId = document.getElementById("category_id");
    
    var list = new Array;
    
    const getTable = (Datas) => {
      if (Datas.length > 0) {
        var template = "";
        Datas.forEach(itemData => {
          template += "<tr data-id=${itemData.id}>";
          template += "<td>" + itemData.category_title + "</td>";
          template += "<td>" + itemData.category_type + "</td>";
          template += "<td>" + itemData.active_status + "</td>";
          template += "<td>" + itemData.createdAt + "</td>";
          template += "<td>" + itemData.delete_status + "</td>";
          template += "<td>" + itemData.id + "</td>";
          template += "<td>" + itemData.category_id + "</td>";
          template += "<td><button type='button' data-bs-toggle='modal' data-bs-target='#myModal' class='btn btn-primary btn-sm' id='editBtn' onclick='editFunction()' data-action='edit' data-id='' + itemData.id + ''>Edit</button><button type='button' class='btn btn-danger btn-sm ms-1' data-action='delete' data-id='" + itemData.id + "'>Dlte</button></td>";
  
        });
        tableBody.innerHTML = template;
      }
    
    }
    
    function showTable() {
      fetch(url, {
        method: "GET",
        headers: {
          "Content-Type": "application/json",
          "Authorization": localStorage.getItem('token')
        }
      })
        .then(res => {
          res.json()
            .then(data => {
              list = data.result;
              console.log("response1", data);
              getTable(list);
            })
        })
    }
    
    window.addEventListener("load", (event) => {
      event.preventDefault();
      showTable();
    });
    // Table Show GET End
    
  // Table Post Start

  function subFunction() {
    const newDatId = {
      "meeting": document.getElementById("createdAt1").value,
      "category_id": document.getElementById("cate_id").value,
      "note_desc": document.getElementById("notesId").value,
      "updated_from": document.getElementById("updateFrom").value
  }
  console.log("newDatId :", newDatId);

  let methods = {
    method: 'POST',
    headers: {
        'Content-Type':
            'application/json;charset=utf-8',
           "Authorization":"Bearer"+" "+localStorage.getItem('token'),
    },
    body: JSON.stringify(newDatId)
}

     let addData = fetch(
  "https://salixv3qa.radiusdirect.net/coreapi/v2/notesCreate",
  methods);
  addData.then(res =>
  res.json()).then(response => {
      console.log('Response : ', response)
      if (response && response.apiStatus) {
        document.getElementById("createdAt1").value = '',
        document.getElementById("cate_id").value = '',
        document.getElementById("notesId").value = '',
        document.getElementById("updateFrom").value = ''
        showTable(),
        alert(response.result)
      } else {
        alert(response.result)
      }
  })
  }
  // Table Post End
  
  // Delete Method Start 

  const apiUrl = "https://salixv3qa.radiusdirect.net/coreapi/v2/notesDelete"
  const modal = document.getElementById("exampleModal")
    
    tableBody.addEventListener("click", function (evnt) {
    
    
      var element = evnt.target;
      var action = element.dataset.action;
      var datId = element.dataset.id;

      if (action === "delete") {
        var rowDataId = {
          "id" : datId
      }
        console.log("delete", datId);
    
        fetch(`${apiUrl}`, {
          method: "POST",
          headers: {
            "Content-Type": "application/json",
            "Authorization": "Bearer"+" "+localStorage.getItem('token')
          },
          body:JSON.stringify(rowDataId)
        })
          .then((data) => {
            console.log(data);
            showTable();
          })
      }
    });
    // Delete Method End 

    // Edit Method Start

    function editFunction() {

      

  //     const rowDatId = {
  //       "id": document.getElementById("createdAt1").value,
  //       "category_id": document.getElementById("cate_id").value,
  //       "note_desc": document.getElementById("notesId").value,
  //   }
  //   console.log("rowDatId :", rowDatId);
  
  //   let editMethod = {
  //     method: 'POST',
  //     headers: {
  //         'Content-Type':'application/json;charset=utf-8',
  //            "Authorization":"Bearer"+" "+localStorage.getItem('token'),
  //     },
  //     body: JSON.stringify(rowDatId)
  // }
  
  //      let editData = fetch(
  //   "https://salixv3qa.radiusdirect.net/coreapi/v2/notesUpdate",
  //   editMethod);
  //   editData.then(res =>
  //   res.json()).then(response => {
  //       console.log('Response : ', response)
  //       if (response && response.apiStatus) {
  //         alert(result.result)
  //       } else {
  //           alert(response.result)
  //       }
  //   })
    }
  // Edit Method End

  // Serch Box Function
  
  (function() {
    'use strict';
  
    var TableFilter = (function() {
      var Arr = Array.prototype;
      var input;
  
      function onInputEvent(e) {
        input = e.target;
        var table1 = document.getElementsByClassName(input.getAttribute('data-table'));
        Arr.forEach.call(table1, function(table) {
          Arr.forEach.call(table.tBodies, function(tbody) {
            Arr.forEach.call(tbody.rows, filter);
          });
        });
      }
  
      function filter(row) {
        var text = row.textContent.toLowerCase();
        var val = input.value.toLowerCase();
        row.style.display = text.indexOf(val) === -1 ? 'none' : 'table-row';
      }
  
      return {
        init: function() {
          var inputs = document.getElementsByClassName('table-filter');
          Arr.forEach.call(inputs, function(input) {
            input.oninput = onInputEvent;
          });
        }
      };
  
    })();
  
   TableFilter.init();
  })();

 // Serch Box Function End

  // Logout Function

//   jQuery(document).ready(function() {

//     Parse.$ = jQuery;
//     Parse.initialize("...", "...");

//     $('.form-logout').on('submit', function (e) {
//         // Prevent Default Submit Event
//         e.preventDefault();

//         console.log("Performing submit");

//         //logout current user
//         if ( Parse.User.current() ) {
//             Parse.User.logOut();

//             // check if really logged out
//             if (Parse.User.current())
//                 console.log("Failed to log out!");
//         }

//         // do redirect
//         //window.location.replace("Sign_In.html");
//         // or
//         window.location.href = "/Sign_In.html";
//     });
// });

  // Logout Function
  
  //  Pagination 
  
  // Pagination End